<?php
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
				echo 5;
				exit();
			}
			$pollUserId=$poll['userId'];
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
			$DeletePollSQL="DELETE FROM poll WHERE pollIdHash=?";
			$values[0]=array($pollIdHash => 's');
			$result=$conn->delete($DeletePollSQL,$values);
			if($conn->error==""&&$result==true)
			{
				//Success
				echo 3;
			}
			else
			{
				notifyAdmin("Conn.Error".$conn->error."! In Delete poll",$userId);
				echo 12;
				exit();
			}
		}
	}
?>