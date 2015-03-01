<?php

//------Credits------//
//
//
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_eventId']="6c3b5a62fa26c9e18e026fdc3feae29b824103141efe1da6d93e2427511c72003b6cb3cd9a735d3719da8a3b4460e1b7e86778633efe878136467ce91d22c427";*/
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
//var_dump($_POST);
if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

//Actual editEvent Code Starts
$eventIdHash=$_POST['_eventId'];
$eventStatus=$_POST['_status'];
if($eventStatus!=1&&$eventStatus!=-1)
{
	echo 16;
	exit();
}
$userIdHash=$_SESSION['vj'];
$conn= new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in approve Event")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in approve Event",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In approve event",$userIdHash);
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
			notifyAdmin("Suspicious eventIdHash in approve eventl",$userId.",sh:".$eventIdHash);
			echo 6;
			exit();
		}
		if(!( (isCOCAS($userId)==1&&$event['eventCategory']=="technical")||
			  (isCULSEC($userId)==1)&&$event['eventCategory']=='nonTechnical') )
		{
			if(blockUserByHash($userIdHash,"Unauthorized Attempt to approve event",$userId.",sh:".$eventIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Unauthorized attempt to approve event",$userId.",sh:".$eventIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		if($eventStatus==1)
		{
			$editEventSQL="UPDATE event SET displayStatus=1, approvalStatus = ? WHERE eventIdHash= ?";
		}
		else
		{
			$editEventSQL="UPDATE event SET displayStatus=0, approvalStatus = ? WHERE eventIdHash= ?";
		}
		

		$values[0]=array($eventStatus => 'i');
		$values[1]=array($eventIdHash => 's');
		$result=$conn->insert($editEventSQL,$values);
		$eventOwner=$event['userId'];
		$eventId=$event['eventId'];
		if($conn->error==""&&$result==true)
		{
			if($eventStatus==1)
			{
				sendNotification($userId,$eventOwner,11,$eventId,600);
			}
			else
			{
				sendNotification($userId,$eventOwner,12,$eventId,600);
			}
			echo 3;
			exit();
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While approving Event",$userId);
			echo 12;
			exit();
		}
		
	}
}
?>