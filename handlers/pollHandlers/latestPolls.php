<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
$_SESSION['jx']="1004"; //1001 for latest Polls 1002 for upcoming polls 1003 for winners 1004 for latestPolls
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","MDS13M001".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();*/

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
$inputHashes=$_POST['_pollsList'];
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
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in latestpoll")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in latest poll",$userIdHash.",sh:".$_SESSION['tn']);
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
		$i=0;
		

		$finalStudentRegex=getRollNoRegex($userId);
		$getLatestPollsSQL="SELECT poll.*, users.name FROM poll INNER JOIN users ON poll.userId=users.userId WHERE ((sharedWith REGEXP ?";
		
		$values[0]=array($finalStudentRegex => 's');
		for($i=0;$i<$ProcessedHashesCount;$i++)
		{
			$getLatestPollsSQL=$getlatestPollsSQL." AND pollIdHash!=?";
			$values[$i+1]=array($ProcessedHashes[$i] => 's');
		}
		$SQLEndPart=") OR poll.userId=?) ORDER BY timestamp DESC";
		$values[$i+1]=array($userId => 's');
		
		//var_dump($values);
		$getLatestPollsSQL=$getLatestPollsSQL.$SQLEndPart;
		//echo $getLatestPollsSQL;
		$displayCount=0;
		$result=$conn->select($getLatestPollsSQL,$values);
		if($conn->error=="")
		{
			//Success
			$pollObjArray=array();
			while(($poll=$conn->fetch($result))&&$displayCount<10)
			{
				$options=$poll['options'];
				$optionsArray=explode(',', $options);
				$optionCount=count($optionsArray);
				$hasVoted=isThere($poll['votedBy'],$userId);
				$optionVotes=$poll['optionVotes'];
				$optionVotesArray=explode(',', $optionVotes);
				for($i=0;$i<$optionCount;$i++)
				{
					$optionsAndVotes[$i]=array($optionsArray[$i] ,(int)$optionVotesArray[$i]);
				}
				if($poll['userId']==$userId)
				{
					$isOwner=1;
				}
				else
				{
					$isOwner=-1;
				}
				$ts = new DateTime();
				$ts->setTimestamp($poll['timestamp']);
				$pollCreationTime=$ts->format(DateTime::ISO8601);
				$pollStatus=$poll['pollStatus'];
				$pollObj=new miniPoll($poll['pollIdHash'],$poll['name'],$poll['question'],$poll['pollType'],$optionsArray, 
									$poll['optionsType'],$poll['sharedWith'],$hasVoted,$optionsAndVotes,$pollCreationTime,$pollStatus,$isOwner);
				//print_r(json_encode($pollObj));
				$pollObjArray[]=$pollObj;
				$displayCount++;
			}

			if($displayCount==0)
			{
				echo 404;
				exit();
			}
			else
			{
				print_r(json_encode($pollObjArray));
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