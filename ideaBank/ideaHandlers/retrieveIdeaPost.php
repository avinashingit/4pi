<?php
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
	require_once('/miniClasses/miniIdeaPost.php');
	
	//$limit = 6;
	//$maxLimit = $limit * 20;
	//$noOfPostsShown = 0;
	
	//$_POST['_call'] = -1;
	//$_SESSION['mq']=0;
	//$finalArray;
	//if($_POST['_call'] == -1)
	//{
	//	$_SESSION['mq']=0;
	//}
	
	//$userIdHash=$_SESSION['vj'];
	//$_POST['_ideaPosts'] =[28];
	
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
	$userIdHash=$_SESSION['vj']='0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22';
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
		{
				$combination=$userIdHash.",".$_SESSION['tn'];
				notifyAdmin("Suspicious Session variable in CreatePost",$combination);
				$_SESSION=array();
				session_destroy();
				return 13;
		}
		else
		{
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! In createPost",$userIdHash);
				$_SESSION=array();
				session_destroy();
				return 13;
			}
			else
			{
				$postOwner = 0;
				//$arrayValues = $conn->select("SELECT * FROM ideaposttable ORDER BY timeStamp DESC LIMIT ?,? ",$values);
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
						
						$obj = new miniIdeaPost($result['userIdHash'], $result['userId'], $result['name'], $result['ideaPostId'], $result['ideaPostIdHash'], $result['appreciaters'], $result['appreciateCount'], $hasAppreciated, $result['depreciaters'], $result['depreciateCount'], $hasDepreciated, $result['ideaPostDate'], $result['ideaDescription'], $result['postOwner']);
						
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
?>