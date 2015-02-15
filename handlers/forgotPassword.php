<?php

session_start();	
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED^E_STRICT);
require_once('./../QOB/qob.php');
require_once("../PHPMailer_v5.1/class.phpmailer.php");
require_once('fetch.php');
?>
<html>
	<body>
		<div align=center class="div1">

<?php
if(isset($_POST['userId']))
{
	$userId=$_POST['userId'];
	if(($user=getUserFromId($userId))==false)
	{
		var_dump($user);
		echo "<h3><strong>Enter A Valid UserId</strong></h3><br/>";
	}
	else
	{
		if($user['password']=='')
		{
			echo "<h3><strong>You haven't set any password yet. Check your Institute mail for link to set password for first time or contact administrator/developers for further assistance.</h3>";
		}
		else
		{
			$currentTime=time();
			$externalHash=hash("sha512",$userId.$currentTime);
			$conn=new QoB();
			$values[0]=array($externalHash =>'s');
			$values[1]=array($userId => 's');
			$insertIntoResetPassSQL="INSERT INTO resetPassword(extHash,userId) VALUES(?,?)";
			$result=$conn->insert($insertIntoResetPassSQL,$values);
			if($conn->error=="")
			{
				$AbsoluteLocation = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
				$AbsoluteLocation .= $_SERVER['HTTP_HOST'];
				$AbsoluteLocation .= "/4pi/handlers/resetPassword.php?token=".urlencode($externalHash);
				$subject="Reset Your 4pi Login Password";
				$mailBody="<center><strong>--!!This is an Automated Email. Don't Waste Your TIME Replying to this email address!!--</strong></center><br/>";
				$mailBody=$mailBody."<p><strong>Subject:</strong>".$subject."<br/></p>";
				$mailBody=$mailBody."<p><strong>Content:</strong> Click on the following link to reset your 4pi password.</p> <br/>".$AbsoluteLocation."<br/><br/>";
				$mailBody=$mailBody."<p>Have A Nice Time<br/>Regards,<br/><strong>4pi-Admin</strong><br/></p>";
				$mailerObject=getMailerObject();
				$emailId=$userId."@iiitdm.ac.in";
				if(sendEmail($mailerObject,$emailId,$mailBody,$subject))
				{
					echo "<br/><h3><strong>Password reset link sent to your institute EmailId($emailId) successfully.</strong></h3><br/>";
				}
				else
				{
					echo "<h3><strong>Some error occurred in sending Email. Please Try again later. Admin has been intimated.</strong></h3><br/>";
				}
			}
			else
			{
				notifyAdmin("Conn Error:".$conn->error." in forgot Password",$userId);
				echo "<h3><strong>Some unexpected error Occured. This may be due to server overload. Please try again later. Admin has been intimated.</strong></h3><br/>";
			}
		}
		
	}
}

?>

			<br/>
			<br/>
			<p> Enter your User-Id to receive the Reset Password Link.</p>
			<form action="forgotPassword.php" method="POST">
				<p class=formtext>UserId : <input type="text" name="userId"/></p>
    			<input type="submit" class = "btn btn-large btn-success" value="Send Reset Password Link"/>	
			</form>
		</div>'
	</body>
</html>
