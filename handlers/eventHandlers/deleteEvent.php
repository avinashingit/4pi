<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
/*	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B006".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_eventId']="0218124b992b38dd672b65c809b95b8ab5eec28808bed6b4339b4fe922f8e942636460a938075e0bd0510ec674413f35fe7c63baf6ed4be62eee2e155f0ce13f";
*/
//Testing Content Ends


/*
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task!
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


	//Actual DeleteEvent Code Starts
	$eventIdHash=$_POST['_eventId'];
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in DeleteEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in DeleteEvent",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In DeleteEvent",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
		else
		{
			$userId=$user['userId'];
			if(($event=getEventFromHash($eventIdHash))==false)
			{
				//Assuming the user tried to delete an already deleted event
				echo 5;
				exit();
			}
			$eventUserId=$event['userId'];
			if($eventUserId!=$userId)
			{
				if(blockUserByHash($userIdHash,"Illegal Attempt to Delete Event",$userId.",sh:".$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Illegal Attempt to Delete Event",$userId.",sh:".$eventIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$DeleteEventSQL="DELETE FROM event WHERE eventIdHash=?";
			$values[0]=array($eventIdHash => 's');
			$result=$conn->delete($DeleteEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				echo 3;
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! In Delete Event",$userId);
				echo 12;
				exit();
			}
		}
	}
?>