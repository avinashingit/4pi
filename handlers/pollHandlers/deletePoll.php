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
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B021".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);

	$_POST['_pollId']="5e35561202448dbb76e2a337060c28692a9d70c3627a97c2f2dc13c4542f49e5e4d97033b4719b3ec5836a1d1db51ce5640036ded3ea4e56f1ff4c245cfdb214";*/

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


	//Actual Deletepoll Code Starts
	$pollIdHash=$_POST['_pollId'];
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in Deletepoll")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in Deletepoll",$userIdHash.",sh:".$_SESSION['tn']);
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
			notifyAdmin("Critical Error In Deletepoll",$userIdHash);
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
				//Assuming the user tried to delete an already deleted poll
				notifyAdmin("Suspicious pollIdHash in delete poll",$userId.",sh:".$pollIdHash);
				echo 5;
				exit();
			}
			$pollUserId=$poll['userId'];
			$pollId=$poll['pollId'];
			if($pollUserId!=$userId)
			{
				if(blockUserByHash($userIdHash,"Illegal Attempt to Delete poll",$userId.",sh:".$pollIdHash)>0)
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Illegal Attempt to Delete poll",$userId.",sh:".$pollIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}
			$conn->startTransaction();
			$DeletePollSQL="DELETE FROM poll WHERE pollIdHash=?";
			$values[0]=array($pollIdHash => 's');
			$result=$conn->delete($DeletePollSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				$pollId=$poll['pollId'];
				$deletePollNotifSQL="DELETE FROM notifications WHERE objectId= ? AND objectType=700";
				$values1[0]=array($pollId => 's');
				$result=$conn->delete($deletePollNotifSQL,$values1);
				if($conn->error=="")
				{
					echo 3;
					$conn->completeTransaction();
				}
				else
				{
					$cr=$conn->error;
					$conn->rollbackTransaction();
					notifyAdmin("Conn. Error :".$cr." while deleting notifications in delete poll.", $pollUserId);
					echo 12;
					exit();
				}
			}
			else
			{
				$cr=$conn->error;
				$conn->rollbackTransaction();
				notifyAdmin("Conn.Error".$cr."! In Delete poll",$pollUserId);
				echo 12;
				exit();
			}
		}
	}
?>