<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B006".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_eventId']="0f5e5132d3ab48f0e3c1f33900a764227e441a53cce32b8ac20808325afd61eb59176fa04f830bf34dec8061fddb7e8f45a60fe7f0e313616a6956ba9e46bfba";

	$_POST['_content']="Telisina Cheppanu";
	$_POST['_eventName']="Edayithe Neekenti";
	$_POST['_venue']="Chepte Naakenti";
	$_POST['_eventType']="Telusukunna Use ledu le";
	$_POST['_status']="Postponed";
	$_POST['_eventDate']="25/10/2015";
	$_POST['_eventTime']="21:10";
	$_POST['_eventDurationHrs']=3;
	$_POST['_evnetDurationMin']=30;
	$_POST['_sharedWith']="MDM,12B,COEB";
	$_POST['_eventOrgName']="Sarvam Rajni Kanth";*/
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
	$eventIdHash=$_POST['_eventId'];
	$eventContent=$_POST['_content'];
	$eventName=$_POST['_eventName'];
	$eventVenue=$_POST['_venue'];
	$type=$_POST['_eventType'];
	$eventStatus=$_POST['_status'];
	$rawDate=$_POST['_eventDate'];
	$rawTime=$_POST['_eventTime'];
	$eventDurationHrs="".$_POST['_eventDurationHrs'];
	$eventDurationMin="".$_POST['_eventDurationMin'];
	$rawSharedWith=$_POST['_sharedWith'];
	$organisedBy=$_POST['_eventOrgName'];
	$eventCategory=$_POST['_eventCategory'];
	$rawSharedWith=trim($rawSharedWith);

	$conn= new QoB();
	if($rawTime==""||$rawDate==""||$type==""||$eventName==""||$eventContent==""||$eventVenue==""||$organisedBy==""||$rawSharedWith=="")
	{
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
		echo 16;
		exit();
	}
	if(preg_match('/^[0-9]{1,}$/', $eventDurationHrs)==0||preg_match('/^[0-9]{1,}$/', $eventDurationMin)==0)
	{
		echo 16;
		exit();		
	}
	if($eventDurationMin!=15&&$eventDurationMin!=30&&$eventDurationMin!=45&&$eventDurationMin!=00)
	{
		echo 16;
		exit();
	}
	$eventDuration=$eventDurationHrs.":".$eventDurationMin;
	if(validateDate($rawDate)==false||validateTime($rawTime)==false)
	{
		echo 16;
		exit();
	}
	if($eventStatus!="As Scheduled"&&$eventStatus!="On Hold"&&$eventStatus!="Postponed"&&$eventStatus!="Cancelled"&&$eventStatus!="Preponed")
	{
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

	if($eventCategory!='nonTechnical'&&$eventCategory!='technical')
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
				/*if(blockUserByHash($userIdHash,"Tampering EventIdHash in editEvent",$userId.",sh:".$eventIdHash)>0)
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
				}*/
				notifyAdmin("Suspicious eventIdHash in editPevent",$userId.",sh:".$eventIdHash);
				echo 6;
				exit();
			}
			if(getEventStatus($event,1)=="Completed")
			{
				notifyAdmin("attempt to edit a completed event".",sh:".$event['eventId']],$userIdHash);
				$_SESSION=array();
				session_destroy();
				echo 16;
				exit();
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
			
			$lastUpdated=time();
			$isCOCAS=isCOCAS($userId);
			$isCULSEC=isCULSEC($userId);
			//$eventIdHash=hash("sha512", $eventId.POEVHASH);
			if($isCOCAS==1&&$eventCategory=="technical")
			{
				$UpdateEventSQL="UPDATE event SET eventName=?,content=?,eventVenue=?,
				organisedBy=?,eventTime=?,eventDate=?,type=?,sharedWith=?,
				lastUpdated=?,eventDurationHrs=?, eventDurationMin=?, eventStatus=?, eventCategory= ?,displayStatus=1,approvalStatus=1 WHERE eventIdHash=?";
			}
			else if($isCULSEC==1&&$eventCategory=="nonTechnical")
			{
				$UpdateEventSQL="UPDATE event SET eventName=?,content=?,eventVenue=?,
				organisedBy=?,eventTime=?,eventDate=?,type=?,sharedWith=?,
				lastUpdated=?,eventDurationHrs=?, eventDurationMin=?, eventStatus=?, eventCategory= ?,displayStatus=1,approvalStatus=1 WHERE eventIdHash=?";
			}
			else
			{
				$UpdateEventSQL="UPDATE event SET eventName=?,content=?,eventVenue=?,
				organisedBy=?,eventTime=?,eventDate=?,type=?,sharedWith=?,
				lastUpdated=?,eventDurationHrs=?, eventDurationMin=?, eventStatus=?, eventCategory= ?,displayStatus=0,approvalStatus=0 WHERE eventIdHash=?";
			}
			
			//$values[0]=array($eventId => 'i');
			//$values[1]=array($eventIdHash => 's');
			//$values[2]=array($timestamp => 'i');
			$values[0]=array($eventName => 's');
			$values[1]=array($eventContent => 's');
			$values[2]=array($eventVenue => 's');

			$values[3]=array($organisedBy => 's');
			$values[4]=array($eventTime => 's');
			$values[5]=array($eventDate => 's');
			$values[6]=array($type => 's');
			$values[7]=array($sharedWith => 's');

			$values[8]=array($lastUpdated => 'i');
			$values[9]=array($eventDurationHrs => 's');
			$values[10]=array($eventDurationMin => 's' );
			$values[11]=array($eventStatus => 's');
			$values[12]=array($eventIdHash => 's');
			$values[13]=array($eventCategory => 's');
			
			//$values[12]=array($userId => 's');
			$result=$conn->update($UpdateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				if($isCOCASorCULSEC!=1)
				{
					$approvalStatus=0;
					if($eventCategory=="technical")
					{
						resetNotification($userId,COCAS,15,$eventId,600);
					}
					else
					{
						resetNotification($userId,CULSEC,15,$eventId,600);
					}
				}
				else
				{
					$approvalStatus=1;
				}
				
				$attendCount=$event['attendCount'];
				$seenCount=$event['seenCount'];
				$isAttender=1;
				$eventOwner=1;
				$ts = new DateTime();
				$ts->setTimestamp($eventTimestamp);
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

				
				
				$eventObj=new miniEvent($eventIdHash,$organisedBy,$eventName,$type,$eventContent,
				$rawDate,$rawTime,$eventVenue,$attendCount,$rawSharedWith, 
				$seenCount,$eventOwner,$isAttender,$eventDurationHrs,$eventDurationMin, 
				$eventStatus,$eventCreationTime,$user['gender'],$proPicExists,$user['name'],$user['userIdHash'],$user['userId'],$isCOCASorCULSEC,$approvalStatus);
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