<?php

session_start();
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","MDS13M001".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();*/

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

$conn=new QoB();
$currentUserIdHash=$_SESSION['vj'];
$userId=$_POST['_userId'];
//$mode=$_POST['_mode'];

if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in aboutMe insert")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in aboutMe Insert",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
if(($user=getUserFromHash($currentUserIdHash))==false)
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in aboutMe insert")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in aboutMe insert",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
	
function aboutMeInsert($profilePic,$dob,$description,$resume,$hobbies,$mailId,$address,$phone,$city)
{

	$date = date_parse($dob);
	$dobTimestamp = strtotime($dob);
	
	$date1 = date_create();
	$currentTimestamp = date_timestamp_get($date1);
	
	if(($profilePic != "") and ($description != "") and ($resume != "") and ($hobbies != "") and ($address != "") and ($phone != "") and ($city != "") and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
	{
		$conObj = new QoB();
		$values0 = array(0 => array($_SESSION['vj'] => 's'));
		$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		if($conObj->error == "")
		{
			if($result0 != "")
			{
				$userId = $result0['userId'];
				$values1 = array();
				
				$values1[0] = array($userId => 's');
				$values1[1] = array($profilePic => 's');
				$values1[2] = array($dobTimestamp => 's');
				$values1[3] = array($description => 's');
				$values1[4] = array($resume => 's');
				$values1[5] = array($hobbies => 's');
				$values1[6] = array($mailId => 's');
				$values1[7] = array($address => 's');
				$values1[8] = array($phone => 's');
				$values1[9] = array($city => 's');
				
				$result1 = $conObj->insert("INSERT INTO about(uid,propic,dob,description,resume,hobbies,mailid,address,phone,city) VALUES(?,?,?,?,?,?,?,?,?,?)",$values1);
				
				if($conObj->error == "")
				{
					echo 'Succesfull Insert <br />';
				}
				else
				{
					echo 'Error in Query 1 <br />';
					echo $conObj->error.'<br />';
				}
			}
			else
			{
				echo 'No values found for Query 0<br />';
			}
		}
		else
		{
			echo 'Error in Query 0<br />';
			echo $conObj->error.'<br />';
		}
	}
	else
	{
		echo 404;
	}
		
	
}
?>