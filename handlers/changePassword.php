<?php

session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('./../QOB/qob.php');
require_once('fetch.php');
//$_SESSION['jx']="999"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts
	$userIdHash=$_SESSION['vj'];
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

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

*/

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

if($_POST['_password']==""||$_POST['_confirmPassword']=="")
{
	echo 16;
	exit();
}
$oldPassword=$_POST['_oldPassword'];
$password=$_POST['_password'];
$confirmPassword=$_POST['_confirmPassword'];
if($password!=$confirmPassword)
{
	echo 16;
	exit();
}
//Upcoming Event Offset - vgr
//Processed Event Hashes - sgk
//$userIdHash=$_SESSION['vj'];
//$refresh=$_POST['_refresh'];
$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in changePassword")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in changePassword",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
else
{
	if(($user=getUserFromHash($userIdHash))==false)
	{
		notifyAdmin("Critical Error In change password",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$returnVal=changePassword($userId,$oldPassword,$password);
		echo $returnVal;
	}
}
?>