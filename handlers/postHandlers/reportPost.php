<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');

//testing inputs begin
// 	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
// 	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
// 	$_POST['_postId']="16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1";
// 	$_POST['_reason']="Some Hypothetical Reason!!";
// //testing inputs end
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
		$combination=$userIdHash.",".$_SESSION['tn'];
		notifyAdmin("Suspicious session variable in reportPost",$combination);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in reportPost!!",$userIdHash);
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
				blockUserByHash($userIdHash,"Messing with PostIdHash!! In reportost");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{

				$reportedBy=$post['reportedBy'];
				$userId=$user['userId'];
				$spamCount=$post['spamCount'];
				$hiddenTo=$post['hiddenTo'];
				$postId=$post['postId'];
				$reason=$_POST['_reason'];
				$ObjectType="Post";
				if(isSharedTo($userId,$post['sharedWith'])==false)
				{
					if(blockUserByHash($userIdHash,"Illegal Attempt to Report Post",$postId.",".$userId)>0)
					{
						$_SESSION=array();
						session_destroy();
						echo 14;
						exit();
					}
					else
					{
						notifyAdmin("Illegal Attempt to Report Post",$userId.",".$postId);
						$_SESSION=array();
						session_destroy();
						echo 13;
						exit();
					}
					
				}
				if((stripos($reportedBy, $userId)===false)&&(stripos($hiddenTo, $userId)===false))
				{
					if($reportedBy=="")
					{
						$reportedBy=$userId;
					}
					else
					{
						$reportedBy=$reportedBy.",".$userId;
					}
					if($hiddenTo=="")
					{
						$hiddenTo=$userId;
					}
					else
					{
						$hiddenTo=$hiddenTo.",".$userId;
					}
					$spamCount++;
					$UpdatePostSQL="UPDATE post  SET reportedBy = ?, spamCount= ?, hiddenTo = ? WHERE postIdHash= ?";
					
					
					$values[0]=array($reportedBy => 's');
					$values[1]=array($spamCount => 'i');
					$values[2]=array($hiddenTo => 's');
					$values[3]=array($postIdHash => 's');
					$conn->startTransaction();
					$result=$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true) 
					{
						//$timestamp=time();
						//$timestamp="".$timestamp;
						$ReportSpamSQL="INSERT INTO reportspams(userId,reason,objectId,ObjectType) VALUES(?,?,?,?)";
						$values1[0]=array($userId =>'s');
						$values1[1]=array($reason => 's');
						$values1[2]=array($postId => 's');
						$values1[3]=array($ObjectType => 's');
						//$values1[4]=array($timestamp => 's');
						$res=$conn->insert($ReportSpamSQL,$values1);
						if($conn->error==""&&$res==true)
						{
							echo 3;
							$conn->completeTransaction();
						}
						else
						{
							$cr=$conn->error;
							$conn->rollbackTransaction();
							notifyAdmin("Conn.Error:".$cr."in inserting into reportspams. In reportpost.".$postId,$userId);
							echo 12;
						}
					}
					else
					{
						$cr=$conn->error;
						$conn->rollbackTransaction();
						notifyAdmin("Conn.Error:".$cr."in Updating Post. In reportpost.".$postId,$userId);
						echo 12;
					}
				}
				else
				{
					blockUserByHash($userIdHash,"Suspicious reportSpam Attempt");
					$_SESSION=array();
					session_destroy();
					echo 13;
				}
			}
		}
	}

?>