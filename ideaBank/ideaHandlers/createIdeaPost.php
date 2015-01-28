<?php
	require_once('/../../QOB/qob.php');
	require_once('/miniClasses/miniIdeaPost.php');
	require_once('/../../handlers/fetch.php');
	

/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
*/
//$_POST['_ideaContent']="HELLO IM TESTING U. hello im testing dmnsvbds !!!!!!";
	
		$conn=new QoB();
		$content=$_POST['_ideaContent'];//1
		//echo $_POST['_ideaContent']."<br />";
		$userIdHash=$_SESSION['vj'];
		$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
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
				$ideaPostUserName=$user['name'];
				$userId=$user['userId'];
				
				//$displayStatus=1;//25
				
				//$userIdHash;//26
				//$postId ia genrated Automatically so !!27!!
				
				$FetchMaxPostIDSQL="SELECT MAX(ideaPostId) as ideaPostId FROM ideaposttable";
				$maxPostID=$conn->fetchALL($FetchMaxPostIDSQL,false);
				$pid=$maxPostID['ideaPostId'];
				if($pid == NULL)
				{
					$pid = $pid+1;
				}
				//echo $pid."<br />";
				$ideaPostId=$pid+1;
				//echo $ideaPostId."<br />";
				$ideaPostIdHash = hash("sha512", $ideaPostId.SALT);

				//$files=$_POST['_files'];
				
				$date=date('y-m-d');
				
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
				     // *****************  Do Nothing   ********************
					//echo "Successful<br />";
					 /*
					 $CreateCommentTableSQL='CREATE TABLE `'.DB.'`.`'.'p'.$ideaPostId ;
					
					//$nconn = @new mysqli(HOST, USER, PASSWORD, DB);
					//$conn->runSimpleQuery($CreateCommentTableSQL);
					//$preparedStatement=$nconn->prepare($CreateCommentTableSQL);
					if($conn->error!="")
					{
						echo 12;
						
						$conn->rollbackTransaction();
					}
					else
					{*/
					$postUserIdHash=$userIdHash;
					$ideaUserId = $userId;
					$postUserName=$user['name'];
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
					
					$postObj=new miniIdeaPost($postUserIdHash, $ideaUserId, $postUserName, $postId, $postIdHash, $appreciaters, $appreciateCount, $hasAppreciated, $depreciaters, $depreciateCount, $hasDepreciated, $ideaPostDate, $postContent, $postOwner);
						
					print_r(json_encode($postObj));
						
						//$conn->completeTransaction();
				}  
				else
				{
					//echo "Before<br />";
					// echo $conn->error;
					//echo "After<br />";
					//$conn->rollbackTransaction();
				} 
			
			}	//------------------------------------------------------------------------!!!!!-----
		
		}

?>