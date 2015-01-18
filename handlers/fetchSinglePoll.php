<?php
session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('.pollHandlers/miniPoll.php');
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
$requestedPoll=$_POST['_pollId'];


$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in single poll")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in single poll",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In singlepoll",$userIdHash);
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
		$getRequestedPollsSQL="SELECT poll.*, users.name FROM poll INNER JOIN users ON poll.userId=users.userId WHERE sharedWith REGEXP ? AND pollIdHash=? ";

		$values[0]=array($finalStudentRegex => 's');
		$values[1]=array($requestedPoll => 's');	
		//var_dump($values);
		//echo $getLatestPollsSQL;
		$displayCount=0;
		$result=$conn->select($getRequestedPollsSQL,$values);
		if($conn->error=="")
		{
			//Success
			if(($poll=$conn->fetch($result)))
			{
				/*$options=$poll['options'];
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
				
				$pollCreationTime=toTimeAgoFormat($poll['timestamp']);
				$pollStatus=$poll['pollStatus'];
				$pollObj=new miniPoll($poll['pollIdHash'],$poll['name'],$poll['question'],$poll['pollType'],$optionsArray, 
									$poll['optionsType'],$poll['sharedWith'],$hasVoted,$optionsAndVotes,$pollCreationTime,$pollStatus,$isOwner);
				//print_r(json_encode($pollObj));*/
				$pollObj=getPollObject($poll,$userId);
				print_r(json_encode($pollObj));
				
			}
			else
			{
				echo 404;
				exit();
			}
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While fetching in single polls",$userId);
			echo 12;
			exit();
		}
	}
}