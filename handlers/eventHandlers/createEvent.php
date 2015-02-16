<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B021".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_content']="Some Other Event";
	$_POST['_eventName']="SomeOther Peru kuda!";
	$_POST['_venue']="Some Place";
	$_POST['_eventType']="Some type";

	$_POST['_eventDate']="21/10/2015";
	$_POST['_eventTime']="17:10";
	$_POST['_eventDurationHrs']=2;
	$_POST['_eventDurationMin']=45;
	$_POST['_sharedWith']="EDS,EVD,EDM11";
	$_POST['_eventOrgName']="Something Raju";*/
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


	//Actual CreateEvent Code Starts
	$eventContent=$_POST['_content'];
	$eventName=$_POST['_eventName'];
	$eventVenue=$_POST['_venue'];
	$type=$_POST['_eventType'];

	$rawDate=$_POST['_eventDate'];
	$rawTime=$_POST['_eventTime'];
	$eventDurationHrs="".$_POST['_eventDurationHrs'];
	$eventDurationMin="".$_POST['_eventDurationMin'];
	$rawSharedWith=$_POST['_sharedWith'];
	$organisedBy=$_POST['_eventOrgName'];

	$rawSharedWith=trim($rawSharedWith);

	$conn= new QoB();
	if($rawTime==""||$rawDate==""||$type==""||$eventName==""||$eventContent==""||$eventVenue==""||$organisedBy==""||$rawSharedWith==""||$eventDurationHrs==""||$eventDurationMin=="")
	{
		//echo "something empty";
		echo 16;
		exit();
	}
	if(strlen($eventContent)>1000)
	{
		echo 16;
		exit();
	}
	if(strlen($rawDate)!=10||strlen($rawTime)!=5)
	{
		//echo "Date Time Validate";
		echo 16;
		exit();
	}
	if(preg_match('/^[0-9]{1,}$/', $eventDurationHrs)==0||preg_match('/^[0-9]{1,}$/', $eventDurationMin)==0)
	{
		//echo "Hr-min Validate";
		echo 16;
		exit();		
	}
	if($eventDurationMin!=15&&$eventDurationMin!=30&&$eventDurationMin!=45&&$eventDurationMin!=0)
	{
		//echo "Min validate";
		echo 16;
		exit();
	}
	$eventDuration=$eventDurationHrs.":".$eventDurationMin;
	if(validateDate($rawDate)==false||validateTime($rawTime)==false)
	{
		//echo "validate";
		echo 16;
		exit();
	}

	$eventDate=changeToEventDateFormat($rawDate);
	$eventTime=changeToEventTimeFormat($rawTime);

	if(validateEventDateAndTime($eventDate,$eventTime)==false)
	{
		echo 16;
		exit();
	}
	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in createEvent")>0)//Happy Birthday to Myself!! Its October 21st!! 00:00 hrs
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in createEvent",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In CreateEvent",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
		else
		{
			$userId=$user['userId'];
			$splitSharedWith=explode(",", $rawSharedWith);

			$n=count($splitSharedWith);
			$sharedWith="";
			if(stripos($rawSharedWith,"ALL")===false)
			{
				if($rawSharedWith!=",")
				{
					for($i=0;$i<$n;$i++)
					{
						if($splitSharedWith[$i]!="")
						{
							//echo $i.",".$splitSharedWith[$i]."<br/>";
							$out=newValidateSharedWith($splitSharedWith[$i]);
							if($out=="Invalid")
							{
								echo 16;
								exit();
							}
							else
							{
								//echo $out;
								if($sharedWith=="")
								{
									$sharedWith=$out;
								}
								else
								{
									$sharedWith=$sharedWith.",".$out;
								}
							}
						}
					}//2
				}
				else
				{
					echo 16;
					exit();
				}	
			}
			else
			{
				$sharedWith="All";
			}

			$FetchMaxEventIDSQL="SELECT MAX(eventId) as maxEventId FROM event";
			$maxEventID=$conn->fetchALL($FetchMaxEventIDSQL,false);
			if($conn->error!=""||$maxEventID=="")
			{
				notifyAdmin("Conn.Error.:".$conn->error."!In Create Event!!",$userId);
				echo 12;
				exit();
			}
			$eId=$maxEventID['maxEventId'];
			
			if($eId==NULL)
			{
				$eventId=1;
			}
			else
			{
				$eventId=$eId+1;
			}
			$timestamp=$lastUpdated=time();
			$eventIdHash=hash("sha512", $eventId.POEVHASH);
			$CreateEventSQL="INSERT INTO event (eventId,eventIdHash,timestamp ,eventName,content,eventVenue,
				organisedBy,eventTime,eventDate,type,sharedWith,lastUpdated, userId,eventDurationHrs,eventDurationMin) 
				VALUES(?,?,?,?,?,?, ?,?,?,?,?,?, ?,?,?)";
			$values[0]=array($eventId => 'i');
			$values[1]=array($eventIdHash => 's');
			$values[2]=array($timestamp => 'i');
			$values[3]=array($eventName => 's');
			$values[4]=array($eventContent => 's');
			$values[5]=array($eventVenue => 's');

			$values[6]=array($organisedBy => 's');
			$values[7]=array($eventTime => 's');
			$values[8]=array($eventDate => 's');
			$values[9]=array($type => 's');
			$values[10]=array($sharedWith => 's');
			$values[11]=array($lastUpdated => 'i');
			
			$values[12]=array($userId => 's');
			$values[13]=array($eventDurationHrs => 's');
			$values[14]=array($eventDurationMin => 's');
			//$values[15]=array($eventStatus => 's');
			$result=$conn->insert($CreateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				sendNotification($userId,SAC,15,$eventId,600);

				$attendCount=0;
				$seenCount=0;
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
				$ts->setTimestamp($timestamp);
				$eventCreationTime=$ts->format(DateTime::ISO8601);
				$proPicLocation='../../img/proPics/'.$userIdHash.'.jpg';
				if(file_exists($proPicLocation))
				{
					$proPicExists=1;
				}
				else
				{
					$proPicExists=-1;
				}
				$isCoCAS=-1;
				if($userId==COCAS)
				{
					$isCoCAS=1;
				}

				$eventObj=new miniEvent($eventIdHash,$organisedBy,$eventName,$type,$eventContent,
				$rawDate,$rawTime,$eventVenue,$attendCount,$rawSharedWith, 
				$seenCount,$eventOwner,$isAttender,$eventDurationHrs,$eventDurationMin,"As Scheduled",$eventCreationTime,$user['gender'],$proPicExists,$user['name'],$user['userIdHash'],$user['userId'],$isCoCAS,0);
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