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
	//$_POST['_ideaPostId'] =28;
	
	$postId=$_POST['_ideaPostId'];
	
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
				
				$getLatestPostsSQL="SELECT * FROM ideaposttable WHERE ideaPostId = ?";
		
				$values[]=array($postId => 'i');
				
				$posts=$conn->select($getLatestPostsSQL,$values);
				
				if($conn->error=="")
				{
					$i=0;
					$finalArray = array();
					
					while($result = $conn->fetch($posts))
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