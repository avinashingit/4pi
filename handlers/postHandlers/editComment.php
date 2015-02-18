<?php
session_start();
require_once('../../QOB/qob.php');
require_once('../fetch.php');
require_once('miniClasses/miniComment.php');
//Testing Inputs Start
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";
	$_POST['_personTags']="";
	$_POST['_commentId']="8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5";
	$_POST['_commentContent']="Shit! Our Names Dint Come Till Now";*/

//Testing Inputs End
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!
*/

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

$commentContent=trim($_POST['_commentContent']);
if($commentContent=="")
{
	blockUserByHash($userIdHash,"Messing with postIdHash!! In EditComment");
	$_SESSION=array();
	session_destroy();
	echo 14;
	exit();
}
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

			$userId=$user['userId'];
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In EditComment");
				$_SESSION=array();
				session_destroy();
				echo 14;
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
							$profilePicExists=hasProfilePic($user['userIdHash']);
							$commentObj= new miniComment($commentPostIdHash,$commentUserIdHash,$commentContent,$commentTime,
								$commentIdHash,$commentUserId,$commentUserName,1,$user['gender'],$profilePicExists,$user['name']);
							 print_r(json_encode($commentObj));
							//echo "commented";

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
						echo 14;
					}
				}
				else
				{
					//Detected tampered commentIdHash
					blockUserByHash($userIdHash,"Tampering commentId Suspected!! In EditComment(2),".$commentIdHash);
					$_SESSION=array();
					session_destroy();
					echo 14;
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