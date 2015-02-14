<?php

require_once('QOB/qobConfig.php');

require_once('QOB/qob.php');

require_once("./PHPMailer_v5.1/class.phpmailer.php");

require_once('./handlers/fetch.php');

error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_ALL);

$sql="SELECT userId,userIdHash FROM users";

$results=mysql_query($sql);

/*while($row=mysql_fetch_array($results))
{
	$email=$row[0]."@iiitdm.ac.in";
	$subject="Registration starts on Students portal of IIITDM";
	$content="Please click the following link to register.";
	$content.="http://172.17.3.20/4pi/initial.php?userId=".$row[1];
	mailContent($email,$content,$subject,$attachments="");
}*/

$email="COE12B009"."@iiitdm.ac.in";
$subject="Registration starts on Students portal of IIITDM";
$content="Please click the following link to register.";
$content.="http://172.17.3.20/4pi/initial.php?userId="."COE11B005";
mailContent($email,$content,$subject,$attachments="");



?>