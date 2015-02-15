<?php
//------Credits------//
//
//
//---Definitions of all Fetching Functions for aboutMe.
//
//---Author: Hari Krishna Majety , COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//


/* Return Codes and their meanings.
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task!
Code 6: Content Unavailable!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!
Code 17: Mailing Error!!
Code 80: Invalid Email
Code 81: User hasn't edited aboutMe yet.
Code 82: user have no primary email.
*/
//Testing Inputs

/*$fromName=$_POST['_fromName']="Hari Krishna M"

$email=$_POST['_fromEmail']="thehk";

$message=trim($_POST['_message']);

$toUserId=$_POST['_userId'];*/

//Testing Inputs End

session_start();
require_once('/../QOB/qob.php');
require_once('./aboutHandlers/aboutMeClass.php');
require_once('../PHPMailer_v5.1/class.phpmailer.php');
require_once('fetch.php');

$fromName=$_POST['_name'];

$email=$_POST['_email'];

$message=trim($_POST['_message']);

$toUserId=$_POST['_userId'];

if($message=="")
{
	echo 16;
}

if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
{
	echo 80;
	exit();
}
else
{
	if(($user=getAboutUserFromId($toUserId))==false)
	{
		echo 13;
		exit();
	}
	else
	{
		if($user=="")
		{
			echo 81;
			exit();
		}
		if($user['mailid']=="")
		{
			echo 82;
			exit();
		}

		$currentTimestamp=time();
		
		$confirmationCode=hash("sha512",$email.$currentTimestamp);
		
		$insertIntoLeaveMessageSQL="INSERT INTO leaveMessage (email,message,userId,extHash,fromName) VALUES(?,?,?,?,?)";
		
		$values[0]=array($email => 's');
		
		$values[1]=array($message => 's');
		
		$values[2]=array($toUserId => 's');
		
		$values[3]=array($confirmationCode => 's');
		
		$values[4]=array($fromName => 's');
		
		$conn=new QoB();
		
		$result=$conn->insert($insertIntoLeaveMessageSQL,$values);
		
		if($conn->error=="")
		{
			$AbsoluteLocation = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
			
			$AbsoluteLocation .= $_SERVER['HTTP_HOST'];
			
			$AbsoluteLocation .= "/4pi/handlers/verifyAndSend.php?token=".urlencode($confirmationCode);
			
			$subject="Verify Email Address to send message to $toUserId";
			
			$mailBody="<center><strong>--!!This is an Automated Email. Don't Waste Your TIME Replying to this email address!!--</strong></center><br/>";
			
			$mailBody=$mailBody."<p><strong>Subject:</strong>".$subject."<br/></p>";
			
			$mailBody=$mailBody."<p><strong>Content:</strong> Click on the following link to verify your email address and send message to $toUserId.</p> <br/>".$AbsoluteLocation."<br/><br/>";
			
			$mailBody=$mailBody."<p>Have A Nice Time<br/>Regards,<br/><strong>4pi-Admin</strong><br/></p>";
			
			$mailerObject=getMailerObject();
			
			$emailId=$email;
			
			if(sendEmail($mailerObject,$emailId,$mailBody,$subject))
			{
				echo 3;
			}
			else
			{
				echo 17;
			}
		}
		else
		{
			echo 12;
		}
	}
}




?>