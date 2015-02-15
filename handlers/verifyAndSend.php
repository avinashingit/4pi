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
Code 161: Invalid Email
*/
session_start();
require_once('..//QOB/qob.php');
require_once('./aboutHandlers/aboutMeClass.php');
require_once('fetch.php');
require_once('../PHPMailer_v5.1/class.phpmailer.php');
?>


<html>

	<body>

		<div align=center class="div1">


<?php
		if(isset($_GET['token']))
		{
			$extHash=$_GET['token'];
			if(($leaveMessageRecord=getLeaveMessageRecord($extHash))==false)
			{
				//var_dump($user);
				echo "<h3><strong>Some Error Occurred. Retry sending your Message. </a></strong></h3><br/>";
			}
			else
			{
				if($leaveMessageRecord['isValid']==1)
				{
					$userId=$resetRecord['userId'];
					
					$user=getAboutUserFromId($userId);
					
					$toMailId=$user['mailid'];
					
					$fromMailId=$leaveMessageRecord['email'];
					
					$fromName=$leaveMessageRecord['fromName'];

					$message=$leaveMessageRecord['message'];
					
					$subject="$fromMailId has sent you a message From 4Pi";
					
					$mailBody="<center><strong>--!!This is an Automated Email. Don't Waste Your TIME Replying to this email address!!--</strong></center><br/>";
					
					$mailBody=$mailBody."<p><strong>Subject:</strong>".$subject."<br/></p>";

					$mailBody=$mailBody."<p><strong>Sender Name:</strong>".$fromName."<br/></p>";
					
					$mailBody=$mailBody."<p><strong>Message:</strong></p> <br/><p>".$message."</p><br/><br/>";
					
					$mailBody=$mailBody."<center><strong>--!!End Of the Message!!--</strong></center><br/>";

					$mailBody=$mailBody."<p>Have A Nice Time<br/>Regards,<br/><strong>4pi-Admin</strong><br/></p>";
					
					$mailerObject=getMailerObject();
					
					$emailId=$toMailId;
					
					if(sendEmail($mailerObject,$emailId,$mailBody,$subject))
					{
						echo "<h3><strong>Message Sent to the requested user($userId).</strong></h3><br/>";

						$invalidateExtHashSQL="UPDATE leaveMessage SET isValid=0 WHERE extHash=?";
					
						$values2[0]=array($extHash => 's');
						
						$conn=new QoB();

						$conn->update($invalidateExtHashSQL,$values2);

						if($conn->error!="")
						{
							notifyAdmin("Conn. Error".$conn->error." While invalidating leave message",$leaveMessageRecord['messageid']);
						}
					}
					else
					{
						echo "<h3><strong>Some Error Occurred in sending mail. Please Retry.</strong></h3><br/>";
					}
					
				}
			}
		}
		else
		{
?>

			<br/><br/>	
			
			<h2><strong>Enough Of Mischief!! Go to <a href="../index.php">homepage</a></strong></h2><br/>
			
			</div>
		
		</body>
	
	</html>

<?php

			exit();	
		}


?>