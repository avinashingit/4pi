<?php
session_start();	
//error_reporting(E_ALL ^ E_NOTICE);
require_once('./../QOB/qob.php');
require_once('fetch.php');
//$_SESSION['jx']="999"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts
	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B014".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_presentNotifications']=array('4703b990c16af860e82f0323cfce186ab13e849364bebf262aefaa7ac4c0cb583d46e56c8161dc7922292b399cf9534f78dd5c4c102fc2421ac7b8d237d822b5','17077654b04d85cc3be5a1553ff0cf739594fdf6cc31b35d6e350aa4d7b8736933dc580559f585c3e2c6c3d3aa1cefe560c595d6718f94a0fc02dfa510e8a1de');

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
$ProcessedHashes=$_POST['_presentNotifications'];
var_dump($ProcessedHashes);
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
		if($result==true)
		{
			echo 3;
		}
		else
		{
			echo 12;
		}
	}
}