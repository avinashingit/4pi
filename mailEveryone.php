<?php

// require_once('QOB/qobConfig.php');

// require_once('QOB/qob.php');
set_time_limit(0);
error_reporting(E_ALL);

ob_implicit_flush(TRUE);
ob_end_flush();
ob_start('mb_output_handler');

ini_set("max_execution_time", 1200);

mysql_connect("localhost","root","isquarer");

mysql_select_db("iiitdmstudentsportal");

require_once("./PHPMailer_v5.1/class.phpmailer.php");

require_once('./handlers/fetch.php');

error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_ALL);

$sql="SELECT * FROM `users` WHERE userId LIKE 'MDM11B%' ORDER BY userId";
//$sql="SELECT * FROM users WHERE userId='COE12B005'";
$results=mysql_query($sql);
$mailerObj=getMailerObject();

$count=0;
while($row=mysql_fetch_array($results))
{
	if($count%10==0)
	{
		$mailerObj=getMailerObject();
	}
		$email=$row['userId']."@iiitdm.ac.in";
		$subject="4pi(Student Portal) Beta Testing Phase-2";

		$content="<h2 style='background-color:black;color:white;border:1px solid black;height='80px'><center><img src='cid:logo_2u' width='50px' height='50px'>&nbsp;&nbsp;&nbsp;&nbsp;<br/>Registration for 4pi beta version</center></h2><br/>";

		$content="<h2 style='background-color:black;color:white;border:1px solid black;height='80px'><center><img src='cid:logo_2u' width='50px' height='50px'>&nbsp;&nbsp;&nbsp;&nbsp;<br/>Registration for 4pi beta version</center></h2><br/>";

		$content.="<center>HI! This is just Beta Testing. Bugs if found will be fixed and final version will be released. <br/>. Please click the following link to register.<br/>";
		$content.="http://172.17.3.72/4pi/initial.php?ref=".$row['userIdHash']."<br/>";
		// $content.="Please note that the above link will be valid for only 17 hours, 2 minutes and 15 seconds.";
		// $content.="<br/><br/>The Site will be up till midnight only.<br/><br/>";
		// $content.="Just kidding, Web master, IIITD&M</center>";
		sendEmail($mailerObj,$email,$content,$subject,"");
		echo $row['userId'].'<br/>';

		$count++;
	//}
}

?>