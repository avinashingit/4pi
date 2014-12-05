<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
$_SESSION['jx']="1001"; //1001 for latest events 1002 for upcoming events 1003 for winners
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","MDS13M001".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();*/

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

//Upcoming Event Offset - vgr
//Processed Event Hashes - sgk
$userIdHash=$_SESSION['vj'];
$refresh=$_POST['_refresh'];
$ProcessedHashes=array();
$inputHashes=$_POST['sgk'];
if(count($inputHashes)!=0)
{
	$ProcessedHashes=explode(",", $inputHashes);
	$ProcessedHashesCount=count($ProcessedHashes);
}
else
{
	$ProcessedHashesCount=0;
}

$conn=new QoB();
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in latestEvent")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in latest Event",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In latestEvent",$userIdHash);
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
			$getLatestEventsSQL="SELECT * FROM event WHERE ((sharedWith REGEXP ?";
			
			$values[0]=array($finalStudentRegex => 's');
			for($i=0;$i<$ProcessedHashesCount;$i++)
			{
				$getLatestEventsSQL=$getlatestEventsSQL." AND postIdHash!=?";
				$values[$i+1]=array($ProcessedHashes[$i] => 's');
			}
			$SQLEndPart=") OR userId=?)  AND ( eventDate> ? OR (eventDate= ? AND eventTime> ?)) ORDER BY timestamp DESC";
			$values[$i+1]=array($userId => 's');
			$values[$i+2]=array($currentDate => 'i');
			$values[$i+3]=array($currentDate => 'i');
			$values[$i+4]=array($currentTime => 'i');
			//var_dump($values);
			$getLatestEventsSQL=$getLatestEventsSQL.$SQLEndPart;
			//echo $getLatestEventsSQL;
			$displayCount=0;
			$result=$conn->select($getLatestEventsSQL,$values);
			if($conn->error=="")
			{
				//Success
				$eventObjArray=array();
				while(($event=$conn->fetch($result))&&$displayCount<10)
				{
					$eventUserId=$event['userId'];
					if($eventUserId==$userId)
					{
						$eventOwner=1;
					}
					else
					{
						$eventOwner=-1;
					}
					if(stripos($event['attenders'], $userId)===false)
					{
						$isAttender=-1;
					}
					else
					{
						$isAttender=1;
					}
					$eventTime=$event['eventTime'];
					$rawTime=changeToRawTimeFormat($eventTime);
					$eventDate=$event['eventDate'];
					$rawDate=changeToRawDateFormat($eventDate);
					if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled")
					{
						$eventStatus=getEventStatus($event);
					}
					else
					{
						$eventStatus=$event['eventStatus'];
					}

					$ts = new DateTime();
					$ts->setTimestamp($event['timestamp']);
					$eventCreationTime=$ts->format(DateTime::ISO8601);
					$rawSharedWith=changeToRawSharedWith($event['sharedWith']);
					$eventObj=new miniEvent($event['eventIdHash'],$event['organisedBy'],$event['eventName'],$event['type'],$event['content'],
						$rawDate,$rawTime,$event['eventVenue'],$event['attendCount'],$rawSharedWith, $event['seenCount'],$eventOwner,$isAttender,
						$event['eventDurationHrs'],$event['eventDurationMin'],$eventStatus,$eventCreationTime);
					//print_r(json_encode($eventObj));
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
				notifyAdmin("Conn.Error".$conn->error."! While inserting in latestEvents",$userId);
				echo 12;
				exit();
			}
		}
	}