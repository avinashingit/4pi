<?php
//------Credits------//
//
//
//---Definitions of all Edit Functions for About Me.
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

session_start();
require_once('../../QOB/qob.php');
require_once('../pollHandlers/miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","MDS13M001".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_refresh']=0;
	$_POST['sgk']=array();*/

//Testing Content Ends
	
/* Return Codes and their meanings.
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

$conn=new QoB();
$userIdHash=$_SESSION['vj'];
//$userId=$_POST['_userId'];
$mode=$_POST['_mode'];

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
if(($user=getUserFromHash($userIdHash))==false)
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
$userId=$user['userId'];
$mode=$_POST['_mode'];
/*if($mode =1)
{
	#about Edit
	aboutMeEdit($user,$_POST['_dob'],$_POST['_description'],$_POST['_hobbies'],$_POST['_mailId'],$_POST['_showMailId'],$_POST['_address'],$_POST['_phone'],$_POST['_showPhone'],$_POST['_city'],$_POST['_fbLink'],$_POST['_twitterLink'],$_POST['_g+Link'],$_POST['_inLink'],$_POST['_ptrestLink']);
}
else */

if($mode==2)
{
	#academics Edit
	academicsDelete($user,$_POST['_degreeId']);
}
else if($mode==3)
{
	#achievements Edit
	achievementsDelete($user,$_POST['_achievementId']);
}
else if($mode==4)
{
	#certifiedCourses Edit
	coursesDelete($user,$_POST['_courseId']);
}
else if($mode==5)
{
	#experience Edit
	experienceDelete($user,$_POST['_experienceId']);
}
else if($mode==6)
{
	#projects Edit
	projectDelete($user,$_POST['_projectId']);
}
else if($mode==7)
{
	#workshop Edit
	workshopsDelete($user,$_POST['_workshopId']);
}
else 
{
	# Erroneous Mode Sent
	echo 16;
	exit();
}



function academicsDelete($user,$idString)
	{	
		$id=(int)substr($idString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM academics WHERE userId =? AND degreeId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in academics:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in academics",$userId);
			echo 12;
			exit();
		}			
	}

function achievementsDelete($user,$IdString)
	{	
		$id=(int)substr($IdString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM achievements WHERE userId =? AND achievementId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in achievements:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in academics",$userId);
			echo 12;
			exit();
		}			
	}

function coursesDelete($user,$IdString)
	{	
		$id=(int)substr($IdString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM certifiedcourses WHERE userId =? AND courseId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in courses:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in courses",$userId);
			echo 12;
			exit();
		}			
	}


function experienceDelete($user,$IdString)
	{	
		$id=(int)substr($IdString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM experience WHERE userId =? AND experienceId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in experience:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in experience",$userId);
			echo 12;
			exit();
		}			
	}

function projectDelete($user,$IdString)
	{	
		$id=(int)substr($IdString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM projects WHERE userId =? AND projectId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in projects:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in projects",$userId);
			echo 12;
			exit();
		}			
	}

function workshopsDelete($user,$IdString)
	{	
		$id=(int)substr($IdString, 1);
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		//$degreeId = '';
		
		$values = array(0 => array($userId => 's'),1 =>array($id=> 'i') );
		
		$result1 = $conObj->update("DELETE FROM workshops WHERE userId =? AND workshopId=?",$values);
		
		if($conObj->error == "")
		{
			/*echo 'Succesfull Insert <br />';*/
			if($conObj->getAffectedRows()==1)
			{
				echo 3;
			}
			else
			{
				notifyAdmin("suspicious attempt to delete content in workshops:".$degreeId,$userId);
				echo 6;
				exit();
			}	
		}
		else
		{
			notifyAdmin("Conn.Error".$conObj->error."! While deleting record in workshops",$userId);
			echo 12;
			exit();
		}			
	}
?>