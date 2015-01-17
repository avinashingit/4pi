<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","EDM12B009".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_eventId']="4fd09779dc874a8842cb4d1e06ec5d6b3c939e928dda3e5b9f7de9fb609f02be863492cdfdbc024027335db623f651b15c8b0862295ba9ece62c1eeddfc802f1";
*/
//Testing Content Ends
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

//Upcoming Event Offset

$userIdHash=$_SESSION['vj'];
$eventIdHash=$_POST['_eventId'];
// echo $eventIdHash;
$conn=new QoB();
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in attendEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in attend Event",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In attendEvent",$userIdHash);
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
				if(blockUserByHash($userIdHash,"Suspicious eventIdHash in attendEvent",$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Suspicious eventIdHash in attend Event",$userIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$eventOwner=$event['userId'];
			$eventId=$event['eventId'];
			$attenders=$event['attenders'];
			$attendCount=$event['attendCount'];
			if(stripos($attenders,$userId)===false)
			{
				if($attenders=="")
				{
					$attenders=$userId;
				}
				else
				{
					$attenders=$attenders.",".$userId;
				}
				$attendCount++;
			}
			else
			{
				if(blockUserByHash($userIdHash,"Tampering AttendCount",$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Tampering Attend Count. eIdHash:".$eventIdHash,$userIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$UpdateEventSQL="UPDATE event SET attenders = ?, attendCount=? WHERE eventIdHash=?";
			$values[0]=array($attenders => 's');
			$values[1]=array($attendCount =>'i');
			$values[2]=array($eventIdHash => 's');
			$result=$conn->update($UpdateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				echo $attendCount;
				sendNotification($userId,$eventOwner,7,$eventId,600);
				sendNotification($userId,$attenders,8,$eventId,600);
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in attendEvent",$userId);
				echo 12;
				exit();
			}
		}
	}
?>