<?php
	session_start();
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
	require_once('/miniClasses/miniIdeaPost.php');
	
	$ProcessedHashes=array();
	if(count($_POST['_ideaPosts'])!=0)
	$ProcessedHashes=$_POST['_ideaPosts'];
	//echo count($ProcessedHashes);
	if(count($ProcessedHashes)!=0)
	{
		$ProcessedHashesCount=count($ProcessedHashes);
	}
	else
	{
		$ProcessedHashesCount=0;
	}
	
	$conn=new QoB();
	$userIdHash=$_SESSION['vj'];
	$proPicLocation="";
	$proPicExists = -1;
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
		{
				$combination=$userIdHash.",".$_SESSION['tn'];
				notifyAdmin("Suspicious Session variable in CreatePost",$combination);
				$_SESSION=array();
				session_destroy();
				echo 13;
		}
		else
		{
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! In createPost",$userIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$postOwner = 0;
				$getLatestPostsSQL="SELECT * FROM ideaposttable WHERE postOwner = ?";
		
				$values[0]=array($postOwner => 'i');
				
				$i=0;
				for($i=0;$i<$ProcessedHashesCount;$i++)
				{
					$getLatestPostsSQL=$getLatestPostsSQL." AND ideaPostId != ?";
					$values[$i+1]=array($ProcessedHashes[$i] => 'i');
				}
				$SQLEndPart="  ORDER BY timestamp DESC LIMIT 0,6";
				
				// var_dump($values);
				$getLatestPostsSQL=$getLatestPostsSQL.$SQLEndPart;
				$displayCount=0;
				$posts=$conn->select($getLatestPostsSQL,$values);
				
				if($conn->error=="")
				{
					$i=0;
					$finalArray = array();
					
					while(($result = $conn->fetch($posts)) && ($displayCount< 6))
					{
						if(strcasecmp($userIdHash,$result['userIdHash']) == 0)
						{
							$result['postOwner'] = 1;
						}
						
						$appreciaters = $result['appreciaters'];

						if(empty($appreciaters))
						{
							$hasAppreciated = -1;
						}
						else{
							if(strpos($appreciaters, $user['userId']) !== false)
							{
								$hasAppreciated = 1;
							}
							else{
								$hasAppreciated = -1;
							}
						}
						
						$depreciaters = $result['depreciaters'];
						
						if(empty($depreciaters))
						{
							$hasDepreciated = -1;
						}
						else{
							if(strpos($depreciaters, $user['userId']) !== false)
							{
								$hasDepreciated = 1;
							}
							else{
								$hasDepreciated = -1;
							}
						}

						$proPicLocation=__DIR__.'/../../img/proPics/'.$result['userIdHash'].'.jpg';
						if(file_exists($proPicLocation))
						{
							$proPicExists=1;
						}
						else
						{
							$proPicExists=-1;
						}
						$genderQuery = getUserFromHash($result['userIdHash']);
						$reqDateTime = requiredDateTime($result['timeStamp']);
						$obj = new miniIdeaPost($result['userIdHash'], $result['userId'], $genderQuery['alias'], $result['ideaPostId'], $result['ideaPostIdHash'], $result['appreciaters'], $result['appreciateCount'], $hasAppreciated, $result['depreciaters'], $result['depreciateCount'], $hasDepreciated, $result['ideaPostDate'], $result['ideaDescription'], $result['postOwner'], $reqDateTime, $proPicExists, $genderQuery['gender']);
						
						$finalArray[] = $obj;
						$displayCount=$displayCount+1;
					}
					if($displayCount==0)
					{
						echo 404;
						exit();
					}
					else{
						print_r(json_encode($finalArray));
					}
				}
				else
				{
					notifyAdmin("Conn.Error".$conn->error."! While inserting in latestposts");
					echo 12;
					exit();
				}
			}
		}

		function requiredDateTime($dateTimestr){
			$dateMonthYear = substr($dateTimestr,0,10);
			$day = strftime("%A",strtotime($dateMonthYear));
			$day = substr($day,0,3);
			$monthArray = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
			$month = substr($dateMonthYear, 5,2);
			$getMonth = "";
			if($month == "01"){
				$getMonth = $monthArray[0];
			}else if($month == "02"){
				$getMonth = $monthArray[1];
			}else if($month == "03"){
				$getMonth = $monthArray[2];
			}else if($month == "04"){
				$getMonth = $monthArray[3];
			}else if($month == "05"){
				$getMonth = $monthArray[4];
			}else if($month == "06"){
				$getMonth = $monthArray[5];
			}else if($month == "07"){
				$getMonth = $monthArray[6];
			}else if($month == "08"){
				$getMonth = $monthArray[7];
			}else if($month == "09"){
				$getMonth = $monthArray[8];
			}else if($month == "10"){
				$getMonth = $monthArray[9];
			}else if($month == "11"){
				$getMonth = $monthArray[10];
			}else if($month == "12"){
				$getMonth = $monthArray[11];
			}
			$date = substr($dateMonthYear,8,2);
			$year = substr($dateMonthYear,0,4);
			$newTime = date('h:i A', strtotime($dateTimestr));
			$datetime = $day.', '.$getMonth.' '.$date.', '.$year.' at '.$newTime;
			return json_encode($datetime);
		}
?>