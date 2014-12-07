<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
/*	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B006".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_pollId']="df5812ac54f9591e41f1b6befd20932f578698d70b496573c4a18215907bcbf760f493249deb4a82ad35273a231266b008798fa1562f846450c338f1f0ac7031";
	$_POST['_votes']=[1];*/
//Testing Content Ends


/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!
*/
var_dump($_POST);
if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}


//Actual editPoll Code Starts
$pollIdHash=$_POST['_pollId'];
$pollAnswerVotesArray=$_POST['_votes'];

$userIdHash=$_SESSION['vj'];
$conn= new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in vote Poll")>0)//Happy Birthday to Myself!! Its October 21st!! 00:00 hrs
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in vote Poll",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In vote Poll",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];

		if(($poll=getPollFromHash($pollIdHash))==false)
		{
			if(blockUserByHash($userIdHash,"Tampering pollIdHash in vote Poll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Suspicious pollIdHash in vote poll",$userId.",sh:".$PollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		if($poll['optionsType']==1&&count($pollAnswerVotesArray)!=1)
		{
			if(blockUserByHash($userIdHash,"Attempt to vote multiple options for a single answer poll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Attempt to vote multiple options for a single answer poll",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		//$pollOptions=$poll['options'];
		if($poll['approvalStatus']!=1||$poll['pollStatus']==0)
		{
			if(blockUserByHash($userIdHash,"Illegal Attempt to vote an unapproved or closed poll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Illegal attempt to vote an unapproved or closed poll",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		$sharedWith=$poll['sharedWith'];
		if(isSharedTo($userId,$sharedWith)==false)
		{
			if(blockUserByHash($userIdHash,"Attempt to vote a poll which is not shared",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Attempt to vote a poll which is not shared",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		$votedBy=$poll['votedBy'];
		if(isThere($votedBy,$userId)==-1)
		{
			$pollExistingVotes=$poll['optionVotes'];
			$pollExistingVotesArray=explode(',', $pollExistingVotes);
			
			if($votedBy=="")
			{
				$votedBy=$votedBy.$userId;
			}
			else
			{
				$votedBy=$votedBy.",".$userId;
			}

			foreach ($pollAnswerVotesArray as $option ) 
			{
				$temp=((int)$pollExistingVotesArray[$option])+1;
				$pollExistingVotesArray[$option]=(string)$temp;
			}
			$pollUpdatedVotes=implode(",",$pollExistingVotesArray);
			$editPollSQL="UPDATE poll SET optionVotes = ?, votedBy=? WHERE pollIdHash= ?";

			$values[0]=array($pollUpdatedVotes => 's');
			$values[1]=array($votedBy => 's');
			$values[2]=array($pollIdHash => 's');


			$result=$conn->insert($editPollSQL,$values);
			if($conn->error==""&&$result==true)
			{
				print_r(json_encode($pollExistingVotesArray));
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! While inserting in vote Poll",$userId);
				echo 12;
				exit();
			}
		}
		else
		{
			if(blockUserByHash($userIdHash,"Attempt To Re Vote",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Attempt To Re Vote",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}
		
	}
}
?>