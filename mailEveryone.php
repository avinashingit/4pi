<?php

// require_once('QOB/qobConfig.php');

// require_once('QOB/qob.php');
// 

mysql_connect("localhost","root","root");

mysql_select_db("iiitdmstudentsportal");

require_once("./PHPMailer_v5.1/class.phpmailer.php");

require_once('./handlers/fetch.php');

error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_ALL);

$sql="SELECT * FROM users";
$results=mysql_query($sql);
$mailerObj=getMailerObject();
while($row=mysql_fetch_array($results))
{
	if($row['userId']=="COE11B005" ||$row['userId']=="COE12B009" ||$row['userId']=="COE12B013" ||$row['userId']=="EDM11B021" )
	{
		$email=$row['userId']."@iiitdm.ac.in";
		$subject="Registration starts for Students portal, IIITDM";
		$content="Please click the following link to register.<br/>";
		$content.="http://172.17.3.20/4pi/initial.php?ref=".$row['userIdHash']."<br/>";
		$content.="Please note that the above link will be valid for only 17 hours, 2 minutes and 15 seconds.";
		$content."<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
		$content.="Just kidding, Web master, IIITD&M";
		sendEmail($mailerObj,$email,$content,$subject,"");
	}
}
/*$email="COE11B005"."@iiitdm.ac.in";
$subject="Registration starts on Students portal of IIITDM";
$content="Please click the following link to register.<br/>";
$content.="http://172.17.3.20/4pi/initial.php?userId="."COE11B005";
$content="Everything is done.";*/




?>