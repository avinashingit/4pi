<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B017".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	//$_SESSION['vgr']=0;
	$_POST['_eventId']="0218124b992b38dd672b65c809b95b8ab5eec28808bed6b4339b4fe922f8e942636460a938075e0bd0510ec674413f35fe7c63baf6ed4be62eee2e155f0ce13f";*/

//Testing Content Ends
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
*/

//1 if already noted, 2 if updated, -1 in case of failure.

$userIdHash=$_SESSION['vj'];
$eventIdHash=$_POST['_eventId'];
$conn=new QoB();
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in seenEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in seenEvent",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In seenEvent",$userIdHash);
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
				if(blockUserByHash($userIdHash,"Suspicious eventIdHash in seenEvent",$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Suspicious eventIdHash in seenEvent",$userIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$seenBy=$event['seenBy'];
			$seenCount=$event['seenCount'];
			if(stripos($seenBy,$userId)===false)
			{
				if($seenBy=="")
				{
					$seenBy=$userId;
				}
				else
				{
					$seenBy=$seenBy.",".$userId;
				}
				$seenCount++;
			}
			else
			{
				echo 1;
				exit();
			}
			$UpdateEventSQL="UPDATE event SET seenBy = ?, seenCount=? WHERE eventIdHash=?";
			$values[0]=array($seenBy => 's');
			$values[1]=array($seenCount =>'i');
			$values[2]=array($eventIdHash => 's');
			$result=$conn->update($UpdateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				echo 2;
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in attendEvent",$userId);
				echo -1;
			}
		}
	}
?>