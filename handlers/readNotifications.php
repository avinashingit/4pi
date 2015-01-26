<?php

//------Credits------//
//
//
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

session_start();	
//error_reporting(E_ALL ^ E_NOTICE);
require_once('./../QOB/qob.php');
require_once('fetch.php');

//$_SESSION['jx']="999"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B014".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_presentNotifications']=array();*/

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

//Upcoming Event Offset - vgr
//Processed Event Hashes - sgk
$userIdHash=$_SESSION['vj'];
//$refresh=$_POST['_refresh'];
$ProcessedHashes=array();
$ProcessedHashes=$_POST['_readNotifications'];
// var_dump($ProcessedHashes);
if(count($ProcessedHashes)!=0)
{
	// $ProcessedHashes=explode(",", $inputHashes);
	$ProcessedHashesCount=count($ProcessedHashes);
}
else
{
	$ProcessedHashesCount=0;
}
// $ProcessedHashes=$inputHashes;
// echo $ProcessedHashesCount;
// var_dump($ProcessedHashes);
$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in read notifications")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in read notifications",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In read notifications",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$result=readNotifications($userId,$ProcessedHashes);
		if($result!=false)
		{
			echo 12;
		}
		else
		{
			echo 3;
		}
	}
}