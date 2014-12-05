<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B021".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_eventId']="0f5e5132d3ab48f0e3c1f33900a764227e441a53cce32b8ac20808325afd61eb59176fa04f830bf34dec8061fddb7e8f45a60fe7f0e313616a6956ba9e46bfba";

	$_POST['_description']="Telisina Cheppanu";*/
	
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

	//Actual CreateEvent Code Starts
	$eventIdHash=$_POST['_eventId'];
	$winnersDescription=$_POST['_description'];

	$conn= new QoB();
	if($winnersDescription=="")
	{
		echo 16;
		exit();
	}

	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in editEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in editEvent",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In editEvent",$userIdHash);
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
				if(blockUserByHash($userIdHash,"Tampering EventIdHash in editEvent",$userId.",sh:".$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Suspicious eventIdHash in editEvent",$userId.",sh:".$eventIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$eventUserId=$event['userId'];
			$eventTimestamp=$event['timestamp'];
			if($eventUserId!=$userId)
			{
				if(blockUserByHash($userIdHash,"Illegal Attempt to Edit Event",$userId.",sh:".$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Illegal Attempt to Edit Event",$userId.",sh:".$eventIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			
			$lastUpdated=time();
			$eventTime=$event['eventTime'];
			$rawTime=changeToRawTimeFormat($eventTime);
			$eventDate=$event['eventDate'];
			$rawDate=changeToRawDateFormat($eventDate);
			$eventStatus="Completed";

			//$eventIdHash=hash("sha512", $eventId.POEVHASH);
			$UpdateEventSQL="UPDATE event SET winners=?, eventStatus = ? WHERE eventIdHash=?";
			$values[0]=array($winnersDescription => 's');
			$values[1]=array($eventStatus => 's');
			$values[2]=array($eventIdHash => 's');
			
			$result=$conn->update($UpdateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				$attendCount=$event['attendCount'];
				$seenCount=$event['seenCount'];
				$isAttender=1;
				$eventOwner=1;
				if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled")
				{
					$eventStatus=getEventStatus($event);
				}
				else
				{
					$eventStatus=$event['eventStatus'];
				}
				$ts = new DateTime();
				$ts->setTimestamp($eventTimestamp);
				$eventCreationTime=$ts->format(DateTime::ISO8601);
				$eventObj=new miniEvent($eventIdHash,$event['organisedBy'],$event['eventName'],$event['type'],$event['content'],
				$rawDate,$rawTime,$event['eventVenue'],$attendCount,$event['sharedWith'], 
				$seenCount,$eventOwner,1,$event['eventDurationHrs'],$event['eventDurationMin'], $eventStatus,$eventCreationTime);
				print_r(json_encode($eventObj));
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in Create Event",$userId);
				echo 12;
				exit();
			}
		}
	}
?>