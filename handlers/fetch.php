<?php

	require("../../PHPMailer_v5.1/class.phpmailer.php");
		
	function getUserFromHash($userHash)
	{
		$conn=new QoB();
		$fetchUserSQL="SELECT * FROM users WHERE userIdHash= ?";
		$values[0]=array($userHash=>'s');
		$result=$conn->fetchAll($fetchUserSQL,$values);
		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function getUserFromId($userId)
	{
		$conn=new QoB();
		$fetchUserSQL="SELECT * FROM users WHERE userId= ?";
		$values[0]=array($userId=>'s');
		$result=$conn->fetchAll($fetchUserSQL,$values);
		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function getPostFromHash($postIdHash)
	{
		$conn=new QoB();
		$values = array(0 => array($postIdHash => 's'));
		$result = $conn->fetchAll("SELECT * FROM post WHERE postIdHash = ?",$values,false);
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


	function getEventFromHash($eventIdHash)
	{
		$conn=new QoB();
		$values = array(0 => array($eventIdHash => 's'));
		$result = $conn->fetchAll("SELECT * FROM event WHERE eventIdHash = ?",$values,false);
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	function getPollFromHash($pollIdHash)
	{
		$conn=new QoB();
		$values = array(0 => array($pollIdHash => 's'));
		$result = $conn->fetchAll("SELECT * FROM poll WHERE pollIdHash = ?",$values,false);
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	function hasReported($userId,$hiddenTo)
	{
		$hiddenToarray = explode(',',$hiddenTo);
		$noofhidden = count($hiddenToarray);
		
		$output = 0;
		for($i = 0;$i<$noofhidden;$i++)
			{
				if(strcmp($userId,$hiddenToarray[$i]) == 0)
					{
						$output++;
						break;
					}
			}
			
		if($output == 0)
			{
				return -1;
			}
		else
			{
				return 1;
			}
	}
	function blockUserByHash($userIdHash,$crime,$privateData="")
	{
		$conn=new QoB();
		$isActive=0;
		$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion) VALUES(?,?)";
		$UpdateUserSQL="UPDATE users SET isActive=? WHERE userIdHash= ?";
		$values[0]=array($isActive=>'i');
		$values[1]=array($userIdHash=>'s');
		$result=$conn->update($UpdateUserSQL,$values);
		if($conn->error==""&&$result==true)
		{
			$adminNotif="Blocked: ".$crime.",".$privateData;
			//$user=getUserFromHash($userIdHash);
			//$userId=$user['userId'];
			$values1[0]=array($userIdHash =>'s');
			$values1[1]=array($adminNotif => 's');
			$result2=$conn->insert($noteCrimeSQL,$values1);
			if($conn->error==""&&$result2==true){
				return 3;
			}
			else{
				return 2;
			}
		}
		else
		{
			return -1;
		}
	}
	function notifyAdmin($notification,$userIdentity)
	{
		$conn=new QoB();
		$notification="Notify: ".$notification;
		$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion) VALUES(?,?)";
		$values1[0]=array($userIdentity =>'s');
		$values1[1]=array($notification => 's');
		$result=$conn->insert($noteCrimeSQL,$values1);
		if($conn->error==""&&$result==true)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function mailContent($emailId,$content,$subject,$attachments="")
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.mail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port

		$mail->Username   = "4pi@programmer.net";  // GMAIL username
		$mail->Password   = "110720@iiitdmK";            // GMAIL password

		$mail->From       = "4pi-IIIT D&M Kancheepuram";
		$mail->FromName   = "Admin @ 4pi-IIIT D&M Kancheepuram";
		$mail->Subject    = $subject;
		$mail->WordWrap   = 500; // set word wrap
		$mail->AddAddress($emailId);
		$mailBody="<center><strong>--This is an Automated Email. Don't Waste Your TIME Replying to this email address!!--</strong></center><br/>";
		$mailBody=$mailBody."<strong>Subject:</strong>".$subject."<br/>";
		$mailBody=$mailBody."<strong>Content:</strong><br/>".$content."<br/><br/>";
		$mailBody=$mailBody."Have A Nice Time<br/>Regards,<br/><strong>4pi-Admin</strong><br/>";

		$mail->Body       = $mailBody;
		if($attachments!="")
		{
			$splitAttachments=explode(",",$attachments);
			$attachmentCount=count($splitAttachments);
			for($i=0;$i<$attachmentCount;$i++)
				{
					$mail->AddAttachment($splitAttachments[$i]);
				}
		}
		//$mail->isSMTP();
		
		if(!$mail->send())
		{
			notifyAdmin($mail->ErrorInfo."!!!! PostSubject: ".$subject,$userId);
			return false;
		}
		else
		{
			$mail->ClearAddresses();
			return true;
		}

	}

	function getCommentByPostIdAndHash($postId,$commentIdHash)
	{
		$conn = new QoB();
		$commentTable="p".$postId."c";
		$GetCommentSQL="SELECT * FROM ".$commentTable." WHERE commentIdHash= ?";
		// $values[]=array("commentTable" => 's');
		// $values[]=array($commentTable => 's');
		$values[0]=array($commentIdHash => 's');
		$result=$conn->fetchAll($GetCommentSQL,$values,false);
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	function updatePostIndexesOnComment($postArray,$userId,$conn)
	{
		$postIdHash=$postArray['postIdHash'];
		$date = date_create();
		$followers=$postArray['followers'];
		if(stripos($followers,$userId)===false)
		{
			if($followers=="")
			{
				$followers=$userId;
			}
			else
			{
				$followers=$followers.",".$userId;
			}
		}

		$commentCount=$postArray['commentCount'];
		$commentCount=$commentCount+1;
						
		$commentIndexUpdated = ($postArray['commentIndex'] + date_timestamp_get($date))/2;
						
		$popularityIndexUpdated = $postArray['likeIndex']+ 1.4 * $commentIndexUpdated;
						
		$values = array(0 => array($commentIndexUpdated => 'i'), 1 => array($popularityIndexUpdated => 'i'), 2 => array($commentCount => 'i'), 3 => array($followers => 's'),4 => array($postIdHash => 's'));
						
		$result = $conn->update("UPDATE post SET commentIndex = ?, popularityIndex = ?,commentCount = ?,followers = ? WHERE postIdHash = ? ",$values);
		if($conn->error == ""&&$result==true)
		{
			//echo 'Updated successfully<br />';
			return true;
		}
		else
		{
			/*echo 'Error in Query 2 of Mode 2<br />';
			echo $conObj->error.'<br />';*/
			return false;
		}
	}

	function changeToRawSharedWith($sharedWith)
	{
		$sharedWithRegex="([\.]+)";
		$rawSharedWith=preg_replace($sharedWithRegex, '', $sharedWith);
		if($rawSharedWith=="")
		{
			return "EVERYONE";
		}
		return $rawSharedWith;
	}
	function changeToEventDateFormat($date)
	{
		$nDate=explode("/", $date);
		$eventDate=$nDate[2].$nDate[1].$nDate[0];
		/*$dateRegex="([/]+)";
		$eventDate=preg_replace($dateRegex, '', $date);*/
		return $eventDate;
	}
	function changeToEventTimeFormat($time)
	{
		$timeRegex="([:]+)";
		$eventTime=preg_replace($timeRegex, '', $time);
		return $eventTime;
	}
	function changeToRawDateFormat($eventDate)
	{
		//echo $eventDate;
		$nndate[0]=substr($eventDate, 6,2);//day
		$nndate[1]=substr($eventDate, 4,2);//month
		$nndate[2]=substr($eventDate, 0,4);//year
		//var_dump($nndate);
		/*$nDate=str_split($eventDate,4);
		$nndate=str_split($nDate[0],2);
		$nndate[2]=$nDate[1];*/
		$rawDate=implode("/",$nndate);
		return $rawDate;
	}

	function changeToRawTimeFormat($eventTime)
	{
		$nTime=str_split($eventTime,2);
		$rawTime=implode(":",$nTime);
		return $rawTime;
	}

	function isSharedTo($userId,$sharedWith)
	{
		//$nSharedWith=explode(",",$sharedWith);
		$finalRegex=getRollNoRegex($userId);
		if(preg_match('/'.$finalRegex.'/',$sharedWith))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function isThere($haystack,$needle)
	{
		if(stripos($haystack, $needle)===false)
		{
			return -1;
		}
		else
		{
			return 1;
		}
	}

	function validateDate($rawDate)
	{
		$ndate=explode('/',$rawDate);
		//var_dump($ndate);
		if($ndate[2]<2007||$ndate[2]>2030)
		{
			return false;
		}
		if($ndate[2]%4==0)
		{
			$daysArray=[31,29,31,30,31, 30,31,31,30,31, 30,31];
			if($ndate[1]>=1&&$ndate[1]<=12)
			{
				if($ndate[0]>=0&&$ndate[0]<=$daysArray[$ndate[1]-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			$daysArray=[31,28,31,30,31, 30,31,31,30,31, 30,31];
			if($ndate[1]>=1&&$ndate[1]<=12)
			{
				if($ndate[0]>=0&&$ndate[0]<=$daysArray[$ndate[1]-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	function validateTime($rawTime)
	{
		$nTime=explode(":",$rawTime);
		if($nTime[0]<0||$nTime[0]>23||$nTime[1]<0||$nTime[1]>59)
		{
			return false;
		}
		return true;
	}

	function validateEventDateAndTime($eventDate,$eventTime)
	{
		date_default_timezone_set("Asia/Kolkata");
		$currentDate=date("Ymd",time());
		$currentTime=date("Hi",time());
		$currentDate=(int)$currentDate;
		$currentTime=(int)$currentTime;
		if($eventDate<$currentDate||($eventDate==$currentDate&&$eventTime<$currentTime))
			return false;
		return true;

	}

	function getEventStatus($event,$isAttending)
	{
		date_default_timezone_set("Asia/Kolkata");
		$currentDate=date("Ymd",time());
		$currentDate=(int)$currentDate;
		$actualStatus="";
		if($event['eventDate']==$currentDate)
		{
			$eventTimeHr=(int)(substr($event['eventTime'],0,2));
			$eventTimeMin=(int)(substr($event['eventTime'], 2,2));
			$eventEndHr=$eventTimeHr+$event['eventDurationHrs'];
			$eventEndMin=$eventTimeMin+$event['eventDurationMin'];
			if($eventEndMin>=60)
			{
				$eventEndMin=$eventEndMin%60;
				$eventEndHr++;
				$eventEndHr=$eventEndHr%24;
			}
			$currentHr=(int)(date("H",time()));
			$currentMin=(int)date("i",time());
			if($currentHr<$eventEndHr&&$currentHr>=$eventTimeHr)
			{
				$actualStatus="Ongoing";
			}
			else if($currentHr>=$eventTimeHr&&$currentHr==$eventEndHr&&$currentMin<$eventEndMin)
			{
				$actualStatus="Ongoing";
			}
			else if($currentHr<$eventTimeHr)
			{
				$actualStatus="As Scheduled";
			}
			else if($currentHr==$eventTimeHr&&$currentMin<$eventTimeMin)
			{
				$actualStatus="As Scheduled";
			}
			else if($currentHr>$eventEndHr)
			{
				$actualStatus="Completed";
			}
			else if($currentHr==$eventEndHr&&$currentMin>=$eventEndMin)
			{
				$actualStatus="Completed";
			}
		}
		else if($event['eventDate']<$currentDate)
		{
			$actualStatus="Completed";
		}
		else
		{
			$actualStatus="As Scheduled";
		}

		if($isAttending==1)
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled"&&$event['eventStatus']!="Preponed"&&$event['eventStatus']!="Postponed")
			{
				return $actualStatus;
			}
			else
			{
				return $event['eventStatus'];
			}
		}
		else
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled")
			{
				return $actualStatus;
			}
			else
			{
				return $event['eventStatus'];
			}
		}
	}


	function getRollNoRegex($rollno)
	{
		$stud['year']=substr($rollno, 3,2);
		$stud['branch']=substr($rollno,0,3);
		$stud['degree']=substr($rollno, 5,1);
		$stud['branchYear']=substr($rollno,0,5);
		$stud['branchDegree']=$stud['branch'].$stud['degree'];
		$stud['yearDegree']=$stud['year'].$stud['degree'];
		$stud['branchYearDegree']=$stud['branch'].$stud['yearDegree'];
		$regexString="(".$stud['year']."|".$stud['branch']."|".$stud['degree']."|".$stud['branchYear']."|".$stud['branchDegree']."|".$stud['yearDegree']."|".$stud['branchYearDegree'].")";
		$finalRegexString="(,".$regexString.",?)|(^".$regexString.",?)|(^All$)";
		return $finalRegexString;
	}
	
	function isCoCAS($userId)
	{
		if($userId=="COE12B013"||$userId=="COE12B009")
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	function getDegree($userId)
	{
		$currentYear=date('Y',time());
		$currentMonth=date('m',time());
		$startYear=(int)(substr($userId,3,2));
		$currentYearSliced=(int)(substr($currentYear, 2);
		$isAlumni=0;
		
		$degree="B.Tech";
		$rollNoArray=explode('',$userId);
		if($rollNoArray[5]=='D')
		{
			$degree="Ph.D";
		}
		else if($rollNoArray[5]=='M')
		{
			$degree="M.Des";
			if($startYear+2==$currentYearSliced)
			{
				if((int)currentMonth>6)
				{
					$degree=$degree." Alumnus";
				}
			}
		}
		else if($rollNoArray[5]=='I')
		{
			$degree="B.Tech Dual Degree";
			if($startYear+5==$currentYearSliced)
			{
				if((int)currentMonth>6)
				{
					$degree=$degree." Alumnus";
				}
			}
		}
		else if($rollNoArray[5]=='B')
		{
			$degree="B.Tech";
			if($startYear+4==$currentYearSliced)
			{
				if((int)currentMonth>6)
				{
					$degree=$degree." Alumnus";
				}
			}
		}
		
		return $degree;
	}
	function getDuration($start,$end)
	{
		$startYearMonthDate=date('Y/m/d',$start);
		$endYearMonthDate=date('Y/m/d',$end);
		$duration=$startYearMonthDate."-".$endYearMonthDate;
	}
	function getMinDuration($start,$end)
	{
		$startYearMonthDate=date('Y/m',$start);
		$endYearMonthDate=date('Y/m',$end);
		$duration=$startYearMonthDate."-".$endYearMonthDate;
	}
	function newValidateSharedWith($str)
	{
		$conn=new QOB();
		
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array('_____'.$str.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}	
		}
		else if(strlen($str)==2){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array('___'.$str.'____'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
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
			$values1[0]=array($str.'______'=>'s');
			$storeString2='^'.$str.'......$';
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
					return $str;
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
							return $str;
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
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($searchString.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
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
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
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
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
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
	}

	function notifyPeople($toBeNotified,$objectId,$from,$type)
	{
		if($toBeNotified!="")
		{

			$list=explode(',', $toBeNotified);
			foreach ($list as $userId)
			{
				$InsertNotificationSQL="IF EXISTS(SELECT * FROM notifications WHERE objectId= ? and type=?) 
											UPDATE notifications SET message=?, ";
			}
		}
	}
//---------Examples, old functions and Test Code Executed On Online Compiler Starts------------------------------ 

/*function validateSharedWith($str)
	{
		$regstr;
		$conn=new QOB();
		
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.....".$str."...$";
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
			$storeString="^...".$str."....$";
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
			$storeString1='^...'.$str.'...$';
			$values1[0]=array($str.'______'=>'s');
			$storeString2='^'.$str.'......$';
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
			$storeString='^'.$divide[0].$divide[1].$divide[2]."..".$divide[3]."...$";
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
			$storeString="^".$str."....$";
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
			$storeString="^".$str."...$";
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
	}//END OF validateSharedWith Function!!!!!!*/

/*$regex="^.{3}$";
$word="boys";
if(ereg($regex,$word))
{
	echo 1;
}
else
{
	echo 2;
}	

$regex="([0-9\^\$\{\}\.]+)";
$word="^.{3}COE.{3}$";
$word2=ereg_replace($regex,'',$word);
echo $word2;*/

//$arr2 = str_split($str, 3);		

/*
    $a1 = array("1","2","3");
    $a2 = array("a");
    $a3 = array();
   
    echo "a1 is: '".implode("','",$a1)."'<br>";
    echo "a2 is: '".implode("','",$a2)."'<br>";
    echo "a3 is: '".implode("','",$a3)."'<br>";


will produce:
===========
a1 is: '1','2','3'
a2 is: 'a'
a3 is: ''*/

/*$time="21-10-21";
$timeRegex="([-]+)";
$eventTime=ereg_replace($timeRegex,'',$time);
echo $eventTime;
$nTime=str_split($eventTime,2);
print_r($nTime);
$rawTime=implode("-",$nTime);
echo $rawTime;

<?php
$str="COE12B013";
//echo $str[2];
$str=str_split($str);
$year=array_slice($str,3,2);
var_dump($year);
?>*/
?>
