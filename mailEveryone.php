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

$conn= new QoB();
$sql="SELECT * FROM `users` WHERE  userId='COE12B013' or userId = 'EDM12B012' or userId='COE12B009'  or userId = 'COE12B025'";
//$sql="SELECT * FROM users order by userId";
$results=mysql_query($sql) or die (mysql_error());
$mailerObj=getMailerObject();

//echo mysql_num_rows($results);

$maxEmails=1; //No. of maximum emails 
$count=$maxEmails;

$i=0;
$oldp = 0;
$senderEmail = array("root.4pi@gmail.com","root2.4pi@gmail.com","root3.4pi@gmail.com");
//var_dump($email);
while($row=mysql_fetch_array($results))
{
	if($count==$maxEmails*4)
	{
		$count=$maxEmails;
	}
	
	$p = (int)($count/$maxEmails)-1; 
	if($p!=$oldp)
	{
		$oldp = $p;
		$mailerObj=getMailerObject($senderEmail[$p]);
	}
	
	$email=$row['userId']."@iiitdm.ac.in";
	$subject=" Important!! Activate your 4pi (student portal) account.";

	$content= "Hi <strong>".ucwords(strtolower($row['name']))."</strong>, <br/> <center><p>4pi is the Student portal of IIITDM Kancheepuram and is an interactive information sharing platform which is accessible to all( and only to) the students in the institute. From now on, all the information about club activities, event updates, opinion polls and feedback will be taken through student portal.<br/> <strong>So activate your account by clicking the link below.</strong></p><br/><a href='http://172.16.1.222/4pi/initial.php?ref=".$row['userIdHash']."'><img src='cid:logo_2u' width='500' height='600' >&nbsp;&nbsp;&nbsp;&nbsp;</a><br /><h2><a href='http://172.16.1.222/4pi/initial.php?ref=" .$row['userIdHash']. "'>Activate now!</a></h2>";
	// $content.="Please note that the above link will be valid for only 17 hours, 2 minutes and 15 seconds.";
	// $content.="<br/><br/>The Site will be up till midnight only.<br/><br/>";
	// $content.="Just kidding, Web master, IIITD&M</center>";
	//sendEmail($mailerObj,$email,$content,$subject,"");
	//echo $content;
	$insertSql = "INSERT INTO mailedactivationlist (userId) VALUES (?)";
	$vals[0]=array($row['userId'] => 's');
	$result1=$conn->insert($insertSql,$vals);
	if($conn->error!="")
	{
		echo "Error after sending $count emails. Error while inserting ".$row['userId']." And the error is ".$conn->error;
		break;
	}
	echo $row['userId'].' '.$senderEmail[$p].'<br/>';

	$count++;
//}

	$i++;
}

?>