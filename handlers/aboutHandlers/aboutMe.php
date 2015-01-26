<?php
//------Credits------//
//
//
//---Definitions of all Fetching Functions for aboutMe.
//---Author : K Roopesh Reddy ,COE12B025.
//---Email : coe12b025@iiitdm.ac.in
//
//---Editor -1: Hari Krishna Majety , COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//
session_start();
require_once('../../QOB/qob.php');
require_once('aboutMeClass.php');
require_once('../fetch.php');
//Testing Content Starts
	$userIdHash=$_SESSION['vj']=hash("sha512","COE13B001".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_userId']='COE12B025';
	$_POST['_mode']=7;


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
// Id Types
/*
academics(degree) - d.*
achievements - a.*
courses - c.*
experience - e.*
projects - p.*
workshops - w.*
*/
//

$conn=new QoB();
$currentUserId="Guest";
$userId=$_POST['_userId'];
$mode=$_POST['_mode'];
$isOwner=0;

if(isset($_SESSION['vj'])&&isset($_SESSION['tn']))
{
	$currentUserIdHash=$_SESSION['vj'];
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in aboutMe")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in aboutMe",$userIdHash.",sh:".$_SESSION['tn']);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
	}
	if(($user=getUserFromHash($currentUserIdHash))==false)
	{
		if(blockUserByHash($userIdHash,"Suspicious Session Variable in aboutMe")>0)
		{
			$_SESSION=array();
			session_destroy();
			echo 14;
			exit();
		}
		else
		{
			notifyAdmin("Suspicious Session Variable in aboutMe",$userIdHash.",sh:".$_SESSION['tn']);
			$_SESSION=array();
			session_destroy();
			echo 13;
			exit();
		}
	}
	$currentUserId=$user['userId'];
	if($user['userId']==$userId)
	{
		$isOwner=1;
	}
}

aboutMe($userId,$mode,$isOwner);






	/*if(isset($_SESSION['vj']))
		{
			require_once'QOB/qob.php';
			require_once 'aboutMeClass.php';
			aboutMe($userId,$mode);
	
			// In about me database all the 'uid' columns should contain userId not userIdHashes. 
		}
	
	else
		{
			echo 404;
		}*/
	
function aboutMe($userId,$mode,$isOwner)
{
	$conObj = new QoB();
	if($mode == 1)
	{
		echo 'entered mode :'.$mode;
		//To fetch Details of about.
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchAll("SELECT users.alias,users.userIdHash,experience.organisation,experience.designation,about.* FROM users LEFT JOIN about ON users.userId=about.userId LEFT JOIN experience ON experience.userId=about.userId AND experience.experienceId=about.work WHERE about.userId = ?",$values1,false);
		var_dump($result1);
		if($conObj->error == "")
		{
			
			if($result1 != "")
			{
				$date1 = date("d-m-y" , $result1['dob']);
				/*($profilePicture,$name,$dob,$description,$resume,$highestDegree,
				$currentProfession,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,
				$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,$isOwner)*/
				$highestDegree=getDegree($userId);
				$proPicLocation=getProfilePicLocation($result1['userIdHash']);
				$work="Student";
				if($result1['organisation']!="")
					$work=$result1['designation']." at ".$result1['organisation'];
				$obj = new about($proPicLocation,$result1['alias'],$result1['dob'],$result1['description'],$result1['resume'], 
					$highestDegree,$work, $result1['hobbies'],$result1['mailid'],$result1['showMailId'],$result1['address'],explode(',',$result1['phone']),explode(',',$result1['showPhone']),$result1['city'],$result1['facebookId'],$result1['twitterId'],$result1['googleId'],$result1['linkedinId'],$result1['pinterestId'],isOwner);
				print_r(json_encode($obj));
			}
			else
			{
				echo 404;
				exit();
			}		
			
				
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching Top Part of aboutMe:".$userId,$currentUserId);
			echo 12;			
		}
		
		
		
	}
		
	else if($mode == 2)
	{
		//To fetch Details of achievements
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM achievements WHERE userId = ? ORDER BY achieveddate DESC",$values1);
		if($conObj->error == "")
		{	
			$noOfElementsA = 0;
			while($achievements = $conObj->fetch($result1))
			{	
				$date1 = date("d-m-y" , $$achievements['achieveddate']);
				$obj = new achievements("a".$achievements['achievementId'],$achievements['competition'],$achievements['location'],$achievements['description'],$achievements['position'],$date1,$isOwner);
				$outputa[$noOfElementsA] = $obj;
				$noOfElementsA++;
			}
			print_r($outputa);	
			if($noOfElementsA == 0)
			{
				echo 404;
			}
			
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching achievements of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
		
	else if($mode == 3)
	{
		//To fetch Details of academics
		
		// ***** LOGIC OF DEGREE ******//
		
		/* There are 5 degree's :-
		
		1) P.H.D
		2) M.D.E.S
		3) B.T.E.C.H
		4) S.E.C(secondary school)
		5) S.N.R.S.E.C(senior secondary school)
		
		Now logic for id is find it's number for e.q a/A becomes 1, b/B becomes 2 (case insensitive), the  replace the character with the number associated with the alphabet that comes after it by adding it's (index + 1).
		
		For e.g P.H.D, p's index starts with 1, so alphabet that comes after adding 1 to p is q. Now leave it then after leaving q we get r, so number associated with r is 18, so in place of p write 18.
		
		ID for each degree are :-
		
		1) P.H.D :- 18118
		2) M.D.E.S :- 157924
		3) B.T.E.C.H :- 4239814
		4) S.E.C(secondary school) :- 2187
		5) S.N.R.S.E.C(senior secondary school) :- 211722241110 
		
		*/
		
		$values1 = array(0 => array($userId=> 's'));
		$result1 = $conObj->select("SELECT * FROM academics WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsAc = 0;
			while($academics = $conObj->fetch($result1))
			{
				
				
			    /*if($academics['degree'] == '18118')
				{
					$degree = "PHD";
				}
				
			    else if($academics['degree'] == '157924')
				{
					$degree = "MDES";
				}	
				
			    else if($academics['degree'] == '4239814')
				{
					$degree = "BTECH";
				}

				
			    else if($academics['degree'] == '2187')
				{
					$degree = "Secondary School";
				}


			    else if($academics['degree'] == '211722241110' )
				{
					$degree = "Senior Secondary School";
				}*/
				$startDateTimestamp=$academics['start'];
				$endDateTimestamp=$academics['end'];
				$duration=getDuration($startDateTimestamp,$endDateTimestamp);
				$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);								
				$obj = new academics("d".$academics['degreeId'],$academics['degree'],$academics['name'],$duration,$minDuration,$academics['cgpa'],$isOwner);
				$outputa[$noOfElementsAc] = $obj;
				$noOfElementsAc++;
			}
			print_r($outputa);
			if($noOfElementsAc == 0)
			{
				echo 404;		
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching academics of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
		
	else if($mode == 4)
	{
		//To fetch Details of certifiedCourses
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM certifiedcourses WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsC = 0;
			while($courses = $conObj->fetch($result1))
			{	
				$startDateTimestamp=$courses['start'];
				$endDateTimestamp=$courses['end'];
				$duration=getDuration($startDateTimestamp,$endDateTimestamp);
				$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
				$obj = new certifiedCourses("c".$courses['courseId'],$courses['courseName'],$duration,$minDuration,$courses['instituteName'],$isOwner);
				$outputa[$noOfElementsC] = $obj;
				$noOfElementsC++;
			}
			print_r($outputa);
			if($noOfElementsC == 0)
			{
				echo 404;
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching certifiedCourses of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}

	elseif($mode == 11)
	{
		/*//To fetch Details of competitions
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM competitions WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsCo = 0;
			while($competitions = $conObj->fetch($result1))
			{
				$obj = new competitions($competitions['title'],$competitions['compdate'],$competitions['place'],$competitions['description'],$isOwner);
				$outputa[$noOfElementsCo] = $obj;
				$noOfElementsCo++;
			}
			print_r($outputa);
			if($noOfElementsCo == 0)
			{
				echo 'No values found for Query 1 in mode 5<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode <br/>';
			echo $conObj->error;
		}*/
	}
	
	elseif($mode == 5)
	{
		//To fetch Details of experience
		$values1 = array(0 => array($userId=> 's'));
		$result1 = $conObj->select("SELECT * FROM experience WHERE userId = ?",$values1);
		$noOfElementsE = 0;
		if($conObj->error == "")
		{
			while($experience = $conObj->fetch($result1))
			{
				$startDateTimestamp=$experience['start'];
				$endDateTimestamp=$experience['end'];
				$duration=getDuration($startDateTimestamp,$endDateTimestamp);
				$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
				$obj = new experience("e".$experience['experienceId'],$experience['organisation'],$duration,$minDuration,$experience['designation'],$experience['jobDescription'],$isOwner);
				$outputa[$noOfElementsE] = $obj;
				$noOfElementsE++;
			}
			print_r($outputa);
			if($noOfElementsE == 0)
			{
				echo 404;
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching experience of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
	
	elseif($mode == 14)
	{
		//To fetch Details of leaveMessage
		/*$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM leavemessage WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsM = 0;
			while($leaveMessage = $conObj->fetch($result1))
			{
				$obj = new leaveMessage($leaveMessage['leaveMessageId'],$leaveMessage['name'],$leaveMessage['mailid'],$leaveMessage['message'],$isOwner);
				$outputa[$noOfElementsM] = $obj;
				$noOfElementsM++;
			}
			print_r($outputa);
			if($noOfElementsM == 0)
			{
				echo 404;
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching leave Message of aboutMe:".$userId,$currentUserId);
			echo 12;
		}*/
	}
		
	elseif($mode == 12)
	{
		/*//To fetch Details of objective
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchall("SELECT * FROM objective WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new objective($result1['description'],$isOwner);
				print_r($obj);
			}
				
			else
			{
				echo 'No values found for Query 1 in mode 8<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 8<br/>';
			echo $conObj->error;
		}*/
	}
	
	elseif($mode == 6)
	{
		//To fetch Details of projects
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM projects WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsP = 0;
			while($projects = $conObj->fetch($result1))
			{
				$startDateTimestamp=$projects['start'];
				$endDateTimestamp=$projects['end'];
				$duration=getDuration($startDateTimestamp,$endDateTimestamp);
				$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
				$obj = new projects("p".$projects['projectId'],$projects['projectName'],$projects['role'],$duration,$minDuration,$projects['description'],$projects['teamMembers'],$isOwner);
				$outputa[$noOfElementsP] = $obj;
				$noOfElementsP++;
			}
			print_r($outputa);	
			if($noOfElementsP == 0)
			{
				echo 404;
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching projects of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}	
	else if($mode == 7)
	{
		//To fetch Details of workshop
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM workshops WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsW = 0;
			while($workshops = $conObj->fetch($result1))
			{
				$startDateTimestamp=$workshops['start'];
				$endDateTimestamp=$workshops['end'];
				$duration=getDuration($startDateTimestamp,$endDateTimestamp);
				$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
				$obj = new workshops("w".$workshops['workshopId'],$workshops['workshopName'],$duration,$minDuration,$workshops['place'],$workshops['attendersCount'],$isOwner);
				$outputa[$noOfElementsW] = $obj;
				$noOfElementsW++;
			}
			print_r($outputa);
			if($noOfElementsW == 0)
			{
				echo 404;
				exit();
			}
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching workshops of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
	elseif($mode == 8)
	{
		//To fetch Details of skillset
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchAll("SELECT * FROM skillset WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new skillSet($result1['skills'],$result1['rating'],$isOwner);
			
				print_r(json_encode($obj));
			}
			else
			{
				echo 404;
			}
			
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching skillSet of aboutMe:".$userId,$currentUserId);
			echo 12;
		}

	}
	
	elseif($mode == 13)
	{
		/*//To fetch Details of socialmedia
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchall("SELECT * FROM socialmedia WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new socialmedia($result1['facebookId'],$result1['googleId'],$result1['twitterId'],$result1['linkedinId'],$isOwner);
				print_r($obj);
			}
			else
			{
				echo 'No values found for Query 1 in mode 11<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 11 <br/>';
			echo $conObj->error;
		}*/
	}
		
	else if($mode == 9)
	{
		//To fetch Details of toolkit
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchAll("SELECT * FROM toolkit WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new toolkit($result1['tools'],$isOwner);
				print_r(json_encode($obj));
			}
			else
			{
				echo 404;
				exit();
			}
			
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching toolkit of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
		
	
	else if($mode == 10)
	{
		//To fetch Details of interests
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchAll("SELECT * FROM interests WHERE userId = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new interests($result1['interests'],$isOwner);
				print_r(json_encode($obj));
			}
			else
			{
				echo 404;
				exit();
			}
			
		}
		else
		{
			notifyAdmin("Conn.Error: ".$conn->error."! In fetching toolkit of aboutMe:".$userId,$currentUserId);
			echo 12;
		}
	}
	else
	{
		notifyAdmin("Wrong mode sent:".$userId,$currentUserId);
		echo 16;
	}
	
	
}
		
		
		
		
?>