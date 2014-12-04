<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');

//testing inputs begin
	//$_POST['_postId']="002c5f4230c72e4696a68f63591abc7c0678fc73e4ded86e5fba21d7204b416a4e6c139fd1a0635af9b005afefd6effc7b6bab5f01a2bbad72ce32fde69eedf0";

//testing inputs end
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
					//$ReportSpamSQL="INSERT INTO reportspams()"
					
					$values[0]=array($reportedBy => 's');
					$values[1]=array($spamCount => 'i');
					$values[2]=array($hiddenTo => 's');
					$values[3]=array($postIdHash => 's');
					$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true)
					{
						echo 3;
					}
					else
					{
						notifyAdmin("Conn.Error:".$conn->error."in Updating Post. In reportpost.".$postId,$userId);
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