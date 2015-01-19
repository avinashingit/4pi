<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
$_SESSION['jx']="1003"; //1001 for latest events 1002 for upcoming events 1003 for winners
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B017".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();*/

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

//Upcoming Event Offset - vgr
//Processed Event Hashes - sgk
$userIdHash=$_SESSION['vj'];
$refresh=$_POST['_refresh'];
$ProcessedHashes=array();
$inputHashes=$_POST['sgk'];
if(count($ProcessedHashes)!=0)
{
	$ProcessedHashesCount=count($ProcessedHashes);
}
else
{
	$ProcessedHashesCount=0;
}

$conn=new QoB();
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in upcomingEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in upcoming Event",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In upcomingEvent",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
		else
		{
			$userId=$user['userId'];
			$i=0;

			date_default_timezone_set("Asia/Kolkata");
			$currentDate=date("Ymd",time());
			$currentTime=date("Hi",time());
			$currentDate=(int)$currentDate;
			$currentTime=(int)$currentTime;
			$finalStudentRegex=getRollNoRegex($userId);
			//$getUpcomingEventsSQL="SELECT * FROM event WHERE ((sharedWith REGEXP ?) OR userId=?)  AND (eventDate<=?)";
			
			//Code till final release with approvals
			$getLatestEventsSQL="SELECT event.*,users.name,users.userIdHash,users.gender FROM event INNER JOIN users ON event.userId=users.userId WHERE ((sharedWith REGEXP ?) OR userId=?) AND ( eventDate>= ?)";
			$values[0]=array($finalStudentRegex => 's');
			$values[1]=array($userId => 's');
			$values[2]=array($currentDate => 'i');
			for($i=0;$i<$ProcessedHashesCount;$i++)
			{
				$getUpcomingEventsSQL=$getUpcomingEventsSQL." AND event.eventIdHash!=?";
				$values[$i+3]=array($ProcessedHashes[$i] => 's');
			}
			$SQLEndPart=" ORDER BY eventDate,eventTime";
			
			
			//var_dump($values);
			$getUpcomingEventsSQL=$getUpcomingEventsSQL.$SQLEndPart;
			//echo $getUpcomingEventsSQL;
			$displayCount=0;
			$result=$conn->select($getUpcomingEventsSQL,$values);
			if($conn->error=="")
			{
				//Success
				$eventObjArray=array();
				while(($event=$conn->fetch($result))&&$displayCount<10)
				{
					/*if(stripos($event['attenders'], $userId)===false)
					{
						$isAttender=-1;
					}
					else
					{
						$isAttender=1;
					}
					$eventStatus=getEventStatus($event,$isAttender);
					if($eventStatus!="Completed")
					{
						continue;
					}
					$eventUserId=$event['userId'];
					if($eventUserId==$userId)
					{
						$eventOwner=1;
					}
					else
					{
						$eventOwner=-1;
					}
					$eventTime=$event['eventTime'];
					$rawTime=changeToRawTimeFormat($eventTime);
					$eventDate=$event['eventDate'];
					$rawDate=changeToRawDateFormat($eventDate);
					$ts = new DateTime();
					$ts->setTimestamp($event['timestamp']);
					$eventCreationTime=$ts->format(DateTime::ISO8601);
					$rawSharedWith=changeToRawSharedWith($event['sharedWith']);
					$eventObj=new miniEvent($event['eventIdHash'],$event['organisedBy'],$event['eventName'],$event['type'],$event['content'],
						$rawDate,$rawTime,$event['eventVenue'],$event['attendCount'],$rawSharedWith, $event['seenCount'],$eventOwner,$isAttender,
						$event['eventDurationHrs'],$event['eventDurationMin'],$eventStatus,$eventCreationTime);*/
					//print_r(json_encode($eventObj));
					$eventObj=getEventObject($event,$userId);
					$eventObjArray[]=$eventObj;
					$displayCount++;
				}
				if($displayCount==0)
				{
					echo 404;
					exit();
				}
				else
				{
					print_r(json_encode($eventObjArray));
				}
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in upcomingEvent",$userId);
				echo 12;
				exit();
			}
		}
	}
?>