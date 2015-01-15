<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniClasses/miniPost.php');
require_once('../fetch.php');
$_SESSION['jx']="1004"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts
	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();

//Testing Content Ends
/*
Code 3: SUCCESS!!
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
$refresh=$_POST['_refresh'];
$ProcessedHashes=array();
$inputHashes=$_POST['_postsList'];
if(count($inputHashes)!=0)
{
	$ProcessedHashes=explode(",", $inputHashes);
	$ProcessedHashesCount=count($ProcessedHashes);
}
else
{
	$ProcessedHashesCount=0;
}

$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in latestpost")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in latest post",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In latestpost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$i=0;
		
		$currentTimestamp=time();
		$finalStudentRegex=getRollNoRegex($userId);
		$hiddenToRegex=isThereInCSVRegex($userId);
		$getLatestPostsSQL="SELECT post.*, users.name,users.userIdHash FROM post INNER JOIN users ON post.userId=users.userId WHERE ((sharedWith REGEXP ?";
		
		$values[0]=array($finalStudentRegex => 's');
		$i=0;
		for($i=0;$i<$ProcessedHashesCount;$i++)
		{
			$getLatestPostsSQL=$getlatestPostsSQL." AND postIdHash!=?";
			$values[$i+1]=array($ProcessedHashes[$i] => 's');
		}
		$SQLEndPart=" AND hiddenTo NOT REGEXP ? AND post.lifetime > ? ) OR post.userId=?) AND displayStatus = 1 ORDER BY impIndex DESC";
		$values[$i+1]=array($hiddenToRegex => 's');
		$values[$i+2]=array($currentTimestamp => 's');
		$values[$i+3]=array($userId => 's');
		
		//var_dump($values);
		$getLatestPostsSQL=$getLatestPostsSQL.$SQLEndPart;
		//echo $getLatestPostsSQL;
		$displayCount=0;
		$result=$conn->select($getLatestPostsSQL,$values);
		//var_dump($result);
		if($conn->error=="")
		{
			//Success
			$postObjArray=array();
			while(($post=$conn->fetch($result))&&$displayCount<10)
			{
				$postObj=getPostObjectWithFewComments($post,$userId);
				$postObjArray[]=$postObj;
				$displayCount++;
			}

			if($displayCount==0)
			{
				echo 404;
				exit();
			}
			else
			{
				print_r(json_encode($postObjArray));
			}
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While inserting in latestposts",$userId);
			echo 12;
			exit();
		}
	}
}