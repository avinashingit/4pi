<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
	require_once('/miniClasses/miniIdeaPost.php');
	
	$postId=$_POST['_ideaPostIdHash'];
	
	$conn=new QoB();
	$userIdHash=$_SESSION['vj'];
	
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
				
				$getLatestPostsSQL="SELECT * FROM ideaposttable WHERE ideaPostIdHash = ?";
		
				$values[]=array($postId => 's');
				
				$posts=$conn->select($getLatestPostsSQL,$values);
				
				if($conn->error=="")
				{
					$i=0;
					$finalArray = array();
					
					if($result = $conn->fetch($posts))
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
						
						//$finalArray[] = $obj;
						//$displayCount=$displayCount+1;
						print_r(json_encode($obj));
					}
					else{
						echo 404;
						exit();
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