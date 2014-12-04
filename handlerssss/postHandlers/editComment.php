<?php
session_start();
require_once('../../QOB/qob.php');
require_once('../fetch.php');
require_once('miniClasses/miniComment.php');
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
Code 10: MailError!!
*/
$commentContent=$_POST['_commentContent'];
$postIdHash=$_POST['_postId'];
$commentIdHash=$_POST['_commentId'];
if($commentContent!=""&&$postIdHash!=""&&$commentIdHash!="")
{
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in EditComment",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in EditComment!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{

			
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In EditComment");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				
				$userId=$user['userId'];
				//$postUserId=$post['userId'];
				$postId=$post['postId'];
				$commentCount=$post['commentCount'];
				$commentTableName="p".$postId."c";
				
				$personTags="";
				if(($comment=getCommentByPostIdAndHash($postId,$commentIdHash))==true)
				{
					$commentUserId=$comment['userId'];
					$commentId=$comment['commentId'];


					if($commentUserId==$userId)
					{
						$UpdateCommentSQL="UPDATE ".$commentTableName." SET content=?, personTags=? WHERE commentIdHash=? ";
						//$values[]=array($commentTableName => 's');
						$values[0]=array($commentContent => 's');
						$values[1]=array($personTags => 's');
						$values[2]=array($commentIdHash => 's');
						//$conn->startTransaction();
						$res=$conn->update($UpdateCommentSQL,$values);
						if($conn->error==""&&$res==true)
						{
							//$conn->completeTransaction();
							//echo minicomment object
							$commentPostIdHash=$postIdHash;
							$commentUserName=$user['alias'];
							$commentTime=$comment['timestamp'];
							$commentUserIdHash=$userIdHash;
							$commentObj= new miniComment($commentPostIdHash,$commentUserIdHash,$commentContent,$commentTime,
								$commentIdHash,$commentUserId,$commentUserName);
							// print_r(json_encode($commentObj));
							echo "commented";

						}
						else
						{
							notifyAdmin("Conn.Error:".$conn->error."!! In EditComment ".$commentId.". Tablename:".$commentTableName,$userId);
							//$conn->rollbackTransaction();
							echo 12;
						}
					}
					else
					{
						blockUserByHash($userIdHash,"Tampering commentId Suspected!! In EditComment(1),".$commentIdHash);
						$_SESSION=array();
						session_destroy();
						echo 13;
					}
				}
				else
				{
					//Detected tampered commentIdHash
					blockUserByHash($userIdHash,"Tampering commentId Suspected!! In EditComment(2),".$commentIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
				}				
			}
		}
	}
}
else
{
	notifyAdmin("Attempt to enter empty Comment in Edit Comment",$userId);
	echo 16;
}
	

?>