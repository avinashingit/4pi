<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B017".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	//$_SESSION['vgr']=0;
	$_POST['_refresh']=0;*/

//Testing Content Ends
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
*/
//Upcoming Event Offset

$userIdHash=$_SESSION['vj'];
$refresh=$_POST['_refresh'];
if($refresh==1)
{
	$_SESSION['vgr']=0;
}
$offset=$_SESSION['vgr'];
$conn=new QoB();
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in latest events")>0)
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
			
			
			$noffset=$offset+3;
			$getUpcomingEventsSQL="SELECT * FROM event ORDER BY timestamp DESC LIMIT ?,?";
			$values[0]=array($offset => 'i');
			$values[1]=array($noffset => 'i');
			$displayCount=0;
			$result=$conn->select($getUpcomingEventsSQL,$values);
			if($conn->error=="")
			{
				//Success
				$processedEvents=0;
				while(($event=$conn->fetch($result))&&$displayCount<3)
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
					if(isSharedTo($userId,$event['sharedWith'])||$eventOwner==1)
					{
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
						$rawSharedWith=changeToRawSharedWith($event['sharedWith']);
						$eventObj=new miniEvent($event['eventIdHash'],$event['organisedBy'],$event['eventName'],$event['type'],$event['content'],
							$rawDate,$rawTime,$event['eventVenue'],$event['attendCount'],$rawSharedWith, $event['seenCount'],$eventOwner,$isAttender);
						echo $displayCount;
						echo "<br/>";
						print_r(json_encode($eventObj));
						$displayCount++;
					}
					$processedEvents++;
					
				}

				/*
				$eventObj=new miniEvent($eventIdHash,$organisedBy,$eventName,$type,$eventContent,
							$rawDate,$rawTime,$eventVenue,$attendCount,$rawSharedWith, $seenCount,$eventOwner,$isAttender);
				print_r(json_encode($eventObj));*/
				$_SESSION['vgr']=$_SESSION['vgr']+$processedEvents;
				if($processedEvents==0||$displayCount==0)
				{
					echo 404;
					exit();
				}
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in latestEvent",$userId);
				echo 12;
				exit();
			}
		}
	}
?>