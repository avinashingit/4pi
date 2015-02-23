<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
	require_once('miniClasses/miniComment.php');
	//require_once('postupdater.php');
//testing inputs begin
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B019".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";
	$_POST['_personTags']="";
	$_POST['_commentContent']="People need to be patient for some time!!!";*/
//testing inputs end
/*
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task!
Code 6: Content Unavailable!
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

$content=$_POST['_commentContent'];
$postIdHash=$_POST['_postId'];
if($content!=""&&$postIdHash!="")
{
	$conn=new QoB();
	//Fetch User
	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		$combination=$userIdHash.",".$_SESSION['tn'];
		if(blockUserByHash($userIdHash,"Suspicious session variable in InsertComment")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in insertComment",$userIdHash.",sh:".$_SESSION['tn']);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
	}
	else
	{
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! in Insert Comment",$userIdHash);
				echo 13;
				$_SESSION=array();
				session_destroy();
				exit();
			}
			else
			{
				
				if(($post=getPostFromHash($postIdHash))==false)
				{
					//Detected tampered postIdHash
					/*blockUserByHash($userIdHash,"Tampering of PostIdHash Suspected!! In InsertComment.",$postIdHash);
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();*/
					notifyAdmin("Suspicious postIdHash in insertComment",$userId.",sh:".$postIdHash);
					echo 6;
					exit();
				}
				else
				{
					$postId=$post['postId'];
					$tablename="p".$postId."c";
					//$personTags=$_POST['_personTags'];
					$personTags="";
					//$userIdHash=$_POST['_hash'];
					
					$timestamp=time();
					$userId=$commentUserId=$user['userId'];
					$FetchMaxCommentIdSQL="SELECT MAX(commentId) AS commentId FROM `".$tablename."`";
					$maxCommentID=$conn->fetchAll($FetchMaxCommentIdSQL,"",false);
					if($conn->error=="")
					{
						
						$cId=$maxCommentID['commentId'];
						if($cId==NULL)
						{
							$commentId=1;
						}
						else
						{
							$commentId=$cId+1;
						}						
						$commentIdHash=hash("sha384", $commentId.COMHASH);
						$commentUserName=$user['alias'];
						//$commentUserName=$user['alias'];
						$postCommentCount=$post['commentCount'];
						$insertCommentSQL="INSERT INTO ".$tablename." (commentIdHash,content,userId,timestamp,personTags,commentId) VALUES(?,?,?,?,?,?)";
						$values[0]=array($commentIdHash => 's');
						$values[1]=array($content => 's');
						$values[2]=array($userId => 's');
						$values[3]=array($timestamp => 's');
						$values[4]=array($personTags => 's');
						$values[5]=array($commentId => 'i');
						$conn->startTransaction();
						$result=$conn->insert($insertCommentSQL,$values);
						if($conn->error==''&&$result==true)
						{
							$commentOwner=1;
							$ts = new DateTime();
							$ts->setTimestamp($timestamp);
							$CommentCreationTime=$ts->format(DateTime::ISO8601);
							$profilePicExists=hasProfilePic($user['userIdHash']);
							$commentObj= new miniComment($postIdHash,$userIdHash,$content,$CommentCreationTime,
													$commentIdHash,$commentUserId,$commentUserName,$commentOwner,$user['gender'],$profilePicExists,$user['name']);
							
							if(updatePostIndexesOnComment($post,$userId,$conn))
							{
								$conn->completeTransaction();
								$followers=$post['followers'];
								if($followers!="")
								{
									sendNotification($userId,$followers,3,$postId,500);
								}
								sendNotification($userId,$post['userId'],2,$postId,500);
								print_r(json_encode($commentObj));
							}
							else
							{
								$cr=$conn->error;
								$conn->rollbackTransaction();
								notifyAdmin("Conn.Error".$cr."!!Error Updating Comment Index in insertComment. Tablename: ".$tablename, $userId);
								echo 12;
								exit();
							}
						}
						else
						{
							$cr=$conn->error;
							$conn->rollbackTransaction();
							notifyAdmin("Conn.Error:".$cr."!! In insertComment. Tablename:".$tablename, $userId);
							//echo "Conn.Error:".$cr."!! In insertComment. Tablename:".$tablename.$userId;
							echo 12;
							exit();
						}
					}
					else
					{
						notifyAdmin("Conn.Error.: ".$conn->error."!!In Max ID Fetch in InsertComment. Tablename:".$tablename,$commentUserId);
						echo 12;
						exit();
					}
					
				}				
			}
	}
}
else
{
	notifyAdmin("Attempt to post an empty comment",$_SESSION['vj']);
	echo 16;
}
	
?>