<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('./../QOB/qob.php');
require_once('fetch.php');
//$_SESSION['jx']="999"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts

//Testing Content Ends
/*
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task!
Code 6: Content Unavailable!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!
Code 17: Wrong Current Password Entered!

*/

if($_POST['_p1']==""||$_POST['_p2']=="")
{
	echo 161;
	exit();
}

$password=$_POST['_p1'];
$confirmPassword=$_POST['_p2'];
if($password!=$confirmPassword)
{
	echo 162;
	exit();
}
//Upcoming Event Offset - vgr
//Processed Event Hashes - sgk
//$userIdHash=$_SESSION['vj'];
$userIdHash=$_POST['_userIdHash'];
//$refresh=$_POST['_refresh'];

$conn=new QoB();
	if(($user=getUserFromHash($userIdHash))==false)
	{
		notifyAdmin("Critical Error In set password",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		if($user['password']=="")
		{
			if(setPassword($userId,$password))
			{
				$_SESSION['vj']=$userIdHash;
				$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
				echo 3;
			}
			else
			{
				echo 12;
			}
		}
		else
		{
			echo 6;
		}
	}
?>