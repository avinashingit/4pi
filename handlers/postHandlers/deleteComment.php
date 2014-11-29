<?php
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
	//Testing Inputs Start
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";
	$_POST['_commentId']="8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5";
	//Testing Inputs End*/
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
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In DeleteComment");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$commentIdHash=$_POST['_commentId'];
				$userId=$user['userId'];
				//$postUserId=$post['userId'];
				$postId=$post['postId'];
				$commentCount=$post['commentCount'];
				$commentTableName="p".$postId."c";
				if(($comment=getCommentByPostIdAndHash($postId,$commentIdHash))==true)
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
							$UpdatePostSQL="UPDATE post SET commentCount = ? WHERE postIdHash = ?";
							
							$values1[0]=array($commentCount => 'i');
							$values1[1]=array($postIdHash => 's');
							$res=$conn->update($UpdatePostSQL,$values1);
							if($conn->error==""&&$res==true)
							{
								$conn->completeTransaction();
								echo 3;
							}
							else
							{
								$cr=$conn->error;
								$conn->rollbackTransaction();
								notifyAdmin("Conn.Error: ".$cr."Updating Comment Count in deleteComment. CommentId:".$commentId." CommentTable:".$commentTableName,$userId);
								echo 12;
							}
						}
						else
						{
							$cr=$conn->error;
							$conn->rollbackTransaction();
							notifyAdmin("Conn.Error: ".$cr."Deleting Comment in deleteComment. CommentId:".$commentId." CommentTable:".$commentTableName,$userId);
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