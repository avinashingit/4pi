<?php

session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniLittlePoll.php');
require_once('../fetch.php');

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

$userIdHash=$_SESSION['vj'];

$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in fetchLittlePolls")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in fetchLittlePolls",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In latestpoll",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$finalStudentRegex=getRollNoRegex($userId);
		$values[0]=array($finalStudentRegex => 's');
		$getLatestPollsSQL="SELECT poll.* FROM poll WHERE (sharedWith REGEXP ?) AND approvalStatus=1 AND pollStatus = 1 ORDER BY timestamp DESC";
		$result=$conn->select($getLatestPollsSQL,$values);
		$displayCount=0;
		if($conn->error=="")
		{
			//Success
			$littlePollObjectArray=array();
			while(($poll=$conn->fetch($result))&&($displayCount<=3))
			{
				$content=substr($poll['question'],0,20).'...';
				$pollObject=new miniLittlePoll($poll['pollId'],$content);
				$littlePollObjectArray[]=$pollObject;
				$displayCount++;
			}

			if($displayCount==0)
			{
				echo 404;
				exit();
			}
			else
			{
				print_r(json_encode($littlePollObjectArray));
			}
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While inserting in latestpolls",$userId);
			echo 12;
			exit();
		}

	}
}