<?php
session_start();	
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B009".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_pollId']="df5812ac54f9591e41f1b6befd20932f578698d70b496573c4a18215907bcbf760f493249deb4a82ad35273a231266b008798fa1562f846450c338f1f0ac7031";
	$_POST['_votes']=[3];*/
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
//var_dump($_POST);
if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}


//Actual editPoll Code Starts
$pollIdHash=$_POST['_pollId'];
$pollAnswerVotesArray=$_POST['_votes'];
// var_dump($_POST['_votes']);
$userIdHash=$_SESSION['vj'];
$conn= new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in vote Poll")>0)
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
			//Due to possibility of voting on a poll deleted by the owner at that time but change not reflected in the user's display.
			notifyAdmin("Suspicious pollIdHash in vote poll",$userId.",sh:".$pollIdHash);
			echo 6;
			exit();
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
		$pollOptions=$poll['options'];
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
		$pollId=$poll['pollId'];
		$pollOwner=$poll['userId'];
		if(isThere($votedBy,$userId)==-1)
		{
			$pollExistingVotes=$poll['optionVotes'];
			$pollExistingVotesArray=explode(',', $pollExistingVotes);
			$pollOptionsArray=explode(',', $pollOptions);
			if($votedBy=="")
			{
				$votedBy=$votedBy.$userId;
			}
			else
			{
				$votedBy=$votedBy.",".$userId;
			}

			// var_dump($pollExistingVotesArray);

			for($i=0;$i<count($pollAnswerVotesArray);$i++)
			{
				$temp=((int)$pollExistingVotesArray[(int)$pollAnswerVotesArray[$i]])+1;
				$pollExistingVotesArray[(int)$pollAnswerVotesArray[$i]]=(string)$temp;
			}
			
			$optionCount=count($pollOptionsArray);
			for($i=0;$i<$optionCount;$i++)
			{
				$optionsAndVotes[$i]=array($pollOptionsArray[$i] , (int)$pollExistingVotesArray[$i]);
			}
			$pollUpdatedVotes=implode(",",$pollExistingVotesArray);
			$editPollSQL="UPDATE poll SET optionVotes = ?, votedBy=? WHERE pollIdHash= ?";

			$values[0]=array($pollUpdatedVotes => 's');
			$values[1]=array($votedBy => 's');
			$values[2]=array($pollIdHash => 's');


			$result=$conn->insert($editPollSQL,$values);
			if($conn->error==""&&$result==true)
			{
				sendNotification($userId,$pollOwner,9,$pollId,700);
				sendNotification($userId,$votedBy,10,$pollId,700);
				if($poll['pollType']!=3)
				{
					echo json_encode($optionsAndVotes);
				}
				else
				{
					echo 3;
				}
				
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
			echo 5;
		}
		
	}
}
?>