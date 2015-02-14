<?php

require_once('QOB/qobConfig.php');

// require_once('QOB/qob.php');

require_once("./PHPMailer_v5.1/class.phpmailer.php");

require_once('./handlers/fetch.php');

error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_ALL);

$sql="SELECT * FROM users";
$results=mysql_query($sql);
$mailerObj=getMailerObject();
while($row=mysql_fetch_array($results))
{
	echo $row;
	if($row[0]=="COE12B009")
	{
		$email=$row[0]."@iiitdm.ac.in";
		$subject="Registration starts on Students portal of IIITDM";
		$content="Please click the following link to register.<br/>";
		$content.="http://172.17.3.20/4pi/initial.php?userId=".$row[1];
		// sendEmail($mailerObj,$email,$content,$subject,"");
	}
	
}



/*$email="COE11B005"."@iiitdm.ac.in";
$subject="Registration starts on Students portal of IIITDM";
$content="Please click the following link to register.<br/>";
$content.="http://172.17.3.20/4pi/initial.php?userId="."COE11B005";
$content="Everything is done.";*/




?>