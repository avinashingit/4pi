<?php

// require_once('QOB/qobConfig.php');

// require_once('QOB/qob.php');
set_time_limit(0);
error_reporting(E_ALL ^ E_DEPRECATED);

ob_implicit_flush(TRUE);
ob_end_flush();
ob_start('mb_output_handler');

ini_set("max_execution_time", 120000000000);

mysql_connect("localhost","root","isquarer") or die("Could not connect");

mysql_select_db("iiitdmstudentsportal") or die("COuld not ");

require_once("./PHPMailer_v5.1/class.phpmailer.php");

require_once('QOB/qob.php');

require_once('./handlers/fetch.php');

error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_ALL);

$sql="SELECT * FROM `users` WHERE  userId ='PHY13D001'";
//$sql="SELECT * FROM users order by userId";
$results=mysql_query($sql);
$mailerObj=getMailerObject();

echo mysql_num_rows($results);

$count=0;
while($row=mysql_fetch_array($results))
{
	if($count%10==0)
	{
		$mailerObj=getMailerObject();
	}
		$email=$row['userId']."@iiitdm.ac.in";
		$subject=" Register for 4pi(Student Portal)";

		$content="<center><a href='http://172.16.1.251/4pi/initial.php?ref=".$row['userIdHash']."'><img src='cid:logo_2u' width='500' height='600' >&nbsp;&nbsp;&nbsp;&nbsp;<br /><h2><a href='http://172.16.1.251/4pi/initial.php?ref=".$row['userIdHash']."'>Register in 4pi.</a><br /><a href='http://172.16.1.251/4pi/'>Link to 4pi.</a></h2>";
		// $content.="Please note that the above link will be valid for only 17 hours, 2 minutes and 15 seconds.";
		// $content.="<br/><br/>The Site will be up till midnight only.<br/><br/>";
		// $content.="Just kidding, Web master, IIITD&M</center>";
		sendEmail($mailerObj,$email,$content,$subject,"");
		echo $row['userId'].'<br/>';

		$count++;
	//}
}

?>