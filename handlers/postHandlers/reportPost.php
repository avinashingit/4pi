<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');

//testing inputs begin
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B021".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="d7e3c3e07e768c84515242733f4bdeb924e3471cc989b7fc395a6ec6ab0b4d726fccc77e93dbed8ba92e9b9574130f243947eb01353cf46b78d1c3525dfea2b3";
	$_POST['_reason']="Some Hypothetical Reason!!";*/
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

	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		$combination=$userIdHash.",".$_SESSION['tn'];
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in reportPost")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in reportPost",$userIdHash.",sh:".$_SESSION['tn']);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
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
			$userId=$user['userId'];
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				notifyAdmin("Suspicious postIdHash in reportPost",$userId.",sh:".$postIdHash);
				echo 6;
				exit();
	}
			else
			{

				$reportedBy=$post['reportedBy'];
				
				$spamCount=$post['spamCount'];
				$hiddenTo=$post['hiddenTo'];
				//echo "Hi".$hiddenTo;
				$postId=$post['postId'];
				$reason=$_POST['_reason'];
				$ObjectType="500";
				// echo $userId;
				// echo $post['sharedWith'];
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
					if($hiddenTo=='')
					{
						$hiddenTo=$userId;
						//echo $hiddenTo;
					}
					else
					{
						$hiddenTo=$hiddenTo.",".$userId;
						//echo $hiddenTo;
					}
					$spamCount++;

					$UpdatePostSQL="UPDATE post  SET reportedBy = ?, spamCount= ?, hiddenTo = ? WHERE postIdHash= ?";
					$UpdatePostSQL2="UPDATE post  SET reportedBy = ?, spamCount= ?, hiddenTo = ?, displayStatus=? WHERE postIdHash= ?";
					
					$values[0]=array($reportedBy => 's');
					$values[1]=array($spamCount => 'i');
					$values[2]=array($hiddenTo => 's');
					$values[3]=array($postIdHash => 's');

					$displayStatus=0;
					$values2[0]=array($reportedBy => 's');
					$values2[1]=array($spamCount => 'i');
					$values2[2]=array($hiddenTo => 's');
					$values2[3]=array($displayStatus => 's');
					$values2[4]=array($postIdHash => 's');
					$conn->startTransaction();
					if($spamCount>=3)
					{
						$result=$conn->update($UpdatePostSQL2,$values2);
					}
					else
					{
						$result=$conn->update($UpdatePostSQL,$values);
					}
					
					if($conn->error==""&&$result==true)
					{
						//$timestamp=time();
						//$timestamp="".$timestamp;
						$ReportSpamSQL="INSERT INTO reportspams(userId,reason,objectId,objectType) VALUES(?,?,?,?)";
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