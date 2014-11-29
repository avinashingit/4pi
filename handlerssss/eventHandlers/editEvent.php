<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniEvent.php');
require_once('../fetch.php');
//Testing Content Starts
	$userIdHash=$_SESSION['vj']=hash("sha512","EDM12B021".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_eventId']="0218124b992b38dd672b65c809b95b8ab5eec28808bed6b4339b4fe922f8e942636460a938075e0bd0510ec674413f35fe7c63baf6ed4be62eee2e155f0ce13f";

	$_POST['content']="Telidu";
	$_POST['eventName']="Peru Chepparu";
	$_POST['venue']="Cheptaru aagu!!";
	$_POST['eventType']="Avesapadaddu";

	$_POST['eventDate']="24-10-21";
	$_POST['eventTime']="13:10";
	$_POST['sharedWith']="MDM,MDS,I";
	$_POST['eventOrgName']="Rajni Kanth";
//Testing Content Ends


/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
*/

function validateSharedWith($str){
		$regstr;
		$conn=new QOB();
		if(strlen($str)==0)
		{
			$storeString="^.{9}$";
			$regstr=$storeString;
			return $regstr;
		}
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.{5}".$str.".{3}$";
			$values[0]=array('_____'.$str.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}	
		}
		else if(strlen($str)==2){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.{3}".$str.".{4}$";
			$values[0]=array('___'.$str.'____'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}			
		}
		else if(strlen($str)==3){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array('___'.$str.'___'=>'s');
			$storeString1='^.{3}'.$str.'.{3}$';
			$values1[0]=array($str.'______'=>'s');
			$storeString2='^'.$str.'.{6}$';
			$result=$conn->fetchALL($sql,$values,true);
			//
			if($conn->error!=''){
				notifyAdmin("Conn.Error".$conn->error."In validate Shared With1",$userId);
				//echo $conn->error;
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString1;
					return $regstr;
				}
				else
				{
					$result2=$conn->fetchALL($sql,$values1,true);
					if($conn->error!=""){
						notifyAdmin("Conn.Error".$conn->error."In validate Shared With2",$userId);
						//echo $conn->error;
						return "Invalid";
					}
					else{
						if($result2>=1){
							//echo "Accepted";
							$regstr=$storeString2;
							return $regstr;
						}
						else
						{
							//echo "here";
							return "Invalid";
						}
					}
				}
			}		
		}
		else if(strlen($str)==4){
			$divide=str_split($str);
			$searchString=$divide[0].$divide[1].$divide[2]."__".$divide[3];
			$storeString='^'.$divide[0].$divide[1].$divide[2].".{2}".$divide[3].".{3}$";
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($searchString.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==5){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($str.'____'=>'s');
			$storeString="^".$str.".{4}$";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==6){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($str.'___'=>'s');
			$storeString="^".$str.".{3}$";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else{
			return "Invalid";
		}
	}//END OF validateSharedWith Function!!!!!!

	//Actual CreateEvent Code Starts
	$eventIdHash=$_POST['_eventId'];
	$eventContent=$_POST['content'];
	$eventName=$_POST['eventName'];
	$eventVenue=$_POST['venue'];
	$type=$_POST['eventType'];

	$rawDate=$_POST['eventDate'];
	$rawTime=$_POST['eventTime'];
	$rawSharedWith=$_POST['sharedWith'];
	$organisedBy=$_POST['eventOrgName'];

	$rawSharedWith=trim($rawSharedWith);

	$conn= new QoB();
	if($rawTime==""||$rawDate==""||$type==""||$eventName==""||$eventContent==""||$eventVenue==""||$organisedBy==""||$rawSharedWith=="")
	{
		echo 16;
		exit();
	}
	if(strlen($rawDate)!=8||strlen($rawTime)!=5)
	{
		echo 16;
		exit();
	}
	$eventDate=changeToEventDateFormat($rawDate);
	$eventTime=changeToEventTimeFormat($rawTime);
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
				if(blockUserByHash($userIdHash,"Tampering EventIdHash in editEvent",$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Suspicious eventIdHash in editEvent",$userIdHash.",sh:".$eventIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$eventUserId=$event['userId'];
			if($eventUserId!=$userId)
			{
				if(blockUserByHash($userIdHash,"Illegal Attempt to Edit Event",$eventIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Illegal Attempt to Edit Event",$userIdHash.",sh:".$eventIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$splitSharedWith=explode(",", $rawSharedWith);

			$n=count($splitSharedWith);
			$sharedWith="";
			if($rawSharedWith!=",")
			{
				for($i=0;$i<$n;$i++)
				{
					if($splitSharedWith[$i]!="")
					{
						//echo $i.",".$splitSharedWith[$i]."<br/>";
						$out=validateSharedWith($splitSharedWith[$i]);
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
			
			$lastUpdated=time();
			//$eventIdHash=hash("sha512", $eventId.POEVHASH);
			$UpdateEventSQL="UPDATE event SET eventName=?,content=?,eventVenue=?,
				organisedBy=?,eventTime=?,eventDate=?,type=?,sharedWith=?,lastUpdated=? WHERE eventIdHash=?";
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
			$values[9]=array($eventIdHash => 's');
			//$values[12]=array($userId => 's');
			$result=$conn->update($UpdateEventSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				$attendCount=$event['attendCount'];
				$seenCount=$event['seenCount'];
				$isAttender=isThere($event['attenders'],$userId);
				$eventOwner=1;
				$eventObj=new miniEvent($eventIdHash,$organisedBy,$eventName,$type,$eventContent,
		$rawDate,$rawTime,$eventVenue,$attendCount,$rawSharedWith, $seenCount,$eventOwner,$isAttender);
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