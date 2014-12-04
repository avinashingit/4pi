<?php
	require_once('../QOB/qob.php');
	require_once('../fetch.php');
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
Code 10: MailError!!
*/
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in DeleteComment",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in DeleteComment!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{

			$postIdHash=$_POST['_postId'];
			if(($post=fetchPostByHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In DeleteComment");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$commentIdHash=$_POST['_commentIdHash'];
				$userId=$user['userId'];
				//$postUserId=$post['userId'];
				$postId=$post['postId'];
				$commentCount=$post['commentCount'];
				$commentTableName="p".$postId."c";
				if(($comment=fetchCommentByPostIdAndHash($postId,$commentIdHash))==true)
				{
					$commentUserId=$comment['userId'];
					$commentId=$comment['commentId'];
					if($commentUserId==$userId)
					{
						$DeleteCommentSQL="DELETE FROM ".$commentTableName." WHERE commentIdHash=?";
						//$values[]=array($commentTableName => 's');
						$values[0]=array($commentIdHash => 's');
						$conn->startTransaction();
						$result=$conn->delete($DeleteCommentSQL,$values);
						if($conn->error==""&&$result==true)
						{
							$commentCount=$commentCount-1;
							$UpdatePostSQL="UPDATE post SET commentCount =? WHERE postIdHash = ?";
							
							$values1[0]=array($commentCount => 'i');
							$values1[1]=array($postIdHash => 's');
							$res=$conn->update($UpdatePostSQL,$values1);
							if($conn->error=""&&$res==true)
							{
								$conn->completeTransaction();
								echo 3;
							}
							else
							{
								$cr=$conn->error;
								$conn->rollbackTransaction();
								notifyAdmin("Conn.Error: "$cr."Updating Comment Count in deleteComment. CommentId:".$commentId." CommentTable:".$commentTableName,$userId);
								echo 12;
							}
						}
						else
						{
							$cr=$conn->error;
							$conn->rollbackTransaction();
							notifyAdmin("Conn.Error: "$cr."Deleting Comment in deleteComment. CommentId:".$commentId." CommentTable:".$commentTableName,$userId);
							echo 12;
						}
					}
					else
					{
						blockUserByHash($userIdHash,"Tampering commentId Suspected!! In DeleteComment(1),".$commentIdHash);
						$_SESSION=array();
						session_destroy();
						echo 13;
					}
				}
				else
				{
					//Detected tampered commentIdHash
					blockUserByHash($userIdHash,"Tampering commentId Suspected!! In DeleteComment(2),".$commentIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
				}				
			}
		}
	}

?>