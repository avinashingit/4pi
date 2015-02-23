<?php
session_start();
	require_once('/../../QOB/qob.php');
	require_once('/miniClasses/miniIdeaPost.php');
	require_once('/../../handlers/fetch.php');
	

/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
*/

	
		$conn=new QoB();
		$content=$_POST['_ideaContent'];//1
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
				$ideaPostUserName=$user['alias'];
				$userId=$user['userId'];
				
				//$postId ia genrated Automatically so !!27!!
				
				$FetchMaxPostIDSQL="SELECT MAX(ideaPostId) as ideaPostId FROM ideaposttable";
				$maxPostID=$conn->fetchALL($FetchMaxPostIDSQL,false);
				$pid=$maxPostID['ideaPostId'];
				if($pid == NULL)
				{
					$pid = $pid+1;
				}
				$ideaPostId=$pid+1;
				$ideaPostIdHash = hash("sha512", $ideaPostId.SALT);

				//$files=$_POST['_files'];
				
				$date=date('y-m-d');
				$dateArray = explode("-",$date);
				$date = $dateArray[2]."-".$dateArray[1]."-".$dateArray[0];

				$createPostSQL="INSERT INTO ideaposttable (userIdHash, userId, name, ideaPostId, ideaPostIdHash, appreciaters, appreciateCount, depreciaters, depreciateCount, ideaPostDate, ideaDescription) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
				
				$values[0] = array($userIdHash=>'s');
				
				$values[1] = array($userId=>'s');
				
				$values[2] = array($ideaPostUserName=>'s');//posting user name
				
				$values[3] = array($ideaPostId=>'i');//postID
				
				$values[4] = array($ideaPostIdHash=>'s');//postidhash
				
				$values[5] = array(''=>'s');//appreciaters
				
				$values[6] = array(0=>'i');//appreciatersCount
				
				$values[7] = array(''=>'s');//depreciaters
				
				$values[8] = array(0=>'i');//depreciateCount
				
				$values[9]=array($date=>'s'); //Created Date
				
				$values[10]=array($content=>'s'); //Idea Content
				
				$SQLResponse=$conn->insert($createPostSQL, $values);
				//------------------------------------------------------------------------!!!!!-----
				if($conn->error=="")
				{
					$postUserIdHash=$userIdHash;
					$ideaUserId = $userId;
					$postUserName=$user['alias'];
					$postId = $ideaPostId;
					$postIdHash = $ideaPostIdHash;
					$appreciaters = '';
					$appreciateCount = 0;
					$hasAppreciated = -1;
					$depreciaters = '';
					$depreciateCount = 0;
					$hasDepreciated = -1;
					$ideaPostDate = $date;
					$postContent = $content;
					$postOwner = 1;
					$proPicLocation=__DIR__.'/../../img/proPics/'.$user['userIdHash'].'.jpg';
					if(file_exists($proPicLocation))
					{
						$proPicExists=1;
					}
					else
					{
						$proPicExists=-1;
					}
					$reqDateTime = requiredDateTime(date('Y-m-d H:i:s'));
					$postObj=new miniIdeaPost($postUserIdHash, $ideaUserId, $postUserName, $postId, $postIdHash, $appreciaters, $appreciateCount, $hasAppreciated, $depreciaters, $depreciateCount, $hasDepreciated, $ideaPostDate, $postContent, $postOwner, $reqDateTime, $proPicExists, $user['gender']);
						
					print_r(json_encode($postObj));
						
						//$conn->completeTransaction();
				}  
				else
				{
					echo $conn->error;
				} 
			
			}	//------------------------------------------------------------------------!!!!!-----
		
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