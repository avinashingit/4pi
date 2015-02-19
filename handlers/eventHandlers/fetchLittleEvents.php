<?php

session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniLittleEvent.php');
require_once('../fetch.php');

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

$userIdHash=$_SESSION['vj'];

$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in fetchLittleEvents")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in fetchLittleEvents",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In latestEvents",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$finalStudentRegex=getRollNoRegex($userId);
		$values[0]=array($finalStudentRegex => 's');
		$getLatestEventsSQL="SELECT * FROM event WHERE sharedWith REGEXP ? AND approvalStatus=1 AND displayStatus = 1 ORDER BY timestamp DESC";
		$result=$conn->select($getLatestEventsSQL,$values);
		$displayCount=0;
		if($conn->error=="")
		{
			//Success
			$littleEventsObjectArray=array();
			while(($event=$conn->fetch($result))&&($displayCount<=3))
			{
				if($event['eventName']=="")
				{
					$content=substr($event['content'],0,35).'...';
				}
				else
				{
					$content=substr($event['eventName'],0,35);
				}
				$eventObject=new miniLittleEvent($event['eventIdHash'],$content);
				$littleEventsObjectArray[]=$eventObject;
				$displayCount++;
			}

			if($displayCount==0)
			{
				echo 404;
				exit();
			}
			else
			{
				print_r(json_encode($littleEventsObjectArray));
			}
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While inserting in littleEvents",$userId);
			echo 12;
			exit();
		}

	}
}