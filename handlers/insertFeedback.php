<?php
session_start();	
require_once('../QOB/qob.php');
require_once('fetch.php');
//Testing Content Starts
/*	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B006".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_eventId']="0218124b992b38dd672b65c809b95b8ab5eec28808bed6b4339b4fe922f8e942636460a938075e0bd0510ec674413f35fe7c63baf6ed4be62eee2e155f0ce13f";
*/
//Testing Content Ends


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


	//Actual InsertFeedback Code Starts
	$feedback=$_POST['_feedback'];
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in InsertFeedback")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in InsertFeedback",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In InsertFeedback",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
		else
		{
			$userId=$user['userId'];
						
			$insertFeedbackSQL="INSERT INTO feedback(userId,feedback,) VALUES (?,?)";
			$values[0]=array($userId => 's');
			$values[1]=array($feedback => 's');

			$result=$conn->insert($insertFeedbackSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				echo 3;
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! In InsertFeedback",$userId);
				echo 12;
				exit();
			}
		}
	}
?>