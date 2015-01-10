<?php

session_start();
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

$conn=new QoB();
$currentUserIdHash=$_SESSION['vj'];
$userId=$_POST['_userId'];
$mode=$_POST['_mode'];

if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in createEvent")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in createEvent",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
if(($user=getUserFromHash($currentUserIdHash))==false)
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in createEvent")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in createEvent",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
$isOwner=0;
if($user['userId']==$userId)
{
	$isOwner=1;
}



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
		//To fetch Details of about.
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchall("SELECT about.*, FROM about WHERE uid = ?",$values1,false);
		
		if($conObj->error == "")
		{
			if($result1 != "")
			{
				
					
				$date1 = date("d-m-y" , $result1['dob']);
				
				$obj = new about($result1['propic'],$name,$result1['dob'],$result1['description'],$result1['resume'],$result1['hobbies'],$result1['mailid'],$result1['address'],$result1['phone'],$result1['city'],$isOwner);
				print_r($obj);
				
			}
			else
			{
				echo 'No values found for Query 1 in mode 1<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 1<br />';
			echo $conObj->error;
		}
		
		
		
	}
		
	elseif($mode == 2)
	{
		//To fetch Details of achievements
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM achievements WHERE uid = ? ORDER BY achieveddate DESC",$values1);
		if($conObj->error == "")
		{	
			$noOfElementsA = 0;
			while($achievements = $conObj->fetch($result1))
			{	
				$date1 = date("d-m-y" , $$achievements['achieveddate']);
				$obj = new achievements($achievements['competition'],$achievements['description'],$achievements['position'],$date1,$isOwner);
				$outputa[$noOfElementsA] = $obj;
				$noOfElementsA++;
			}
			print_r($outputa);	
			if($noOfElementsA == 0)
			{
				echo 'No values found for Query 1 in mode 2<br />';
			}
			
		}
		else
		{
			echo 'Error in Query 1 in mode2<br />';
			echo $conObj->error;
		}
	}
		
	elseif($mode == 3)
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
		$result1 = $conObj->select("SELECT * FROM academics WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsAc = 0;
			while($academics = $conObj->fetch($result1))
			{
				$degree = '';
				
			    if($academics['degree'] == '18118')
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
				}										
				$obj = new academics($degree,$academics['name'],$academics['start'],$academics['end'],$academics['cgpa'],$isOwner);
				$outputa[$noOfElementsAc] = $obj;
				$noOfElementsAc++;
			}
			print_r($outputa);
			if($noOfElementsAc == 0)
			{
				echo 'No values found for Query 1 in mode 3<br />';		
			}
		}
		else
			{
				echo 'Error in Query 1 in mode 3<br/>';
				echo $conObj->error;
			}
	}
		
	elseif($mode == 4)
	{
		//To fetch Details of certifiedCourses
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM certifiedcoursesdummy WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsC = 0;
			while($courses = $conObj->fetch($result1))
			{	
				$obj = new certifiedCourses($courses['title'],$courses['duration'],$courses['institutename'],$isOwner);
				$outputa[$noOfElementsC] = $obj;
				$noOfElementsC++;
			}
			print_r($outputa);
			if($noOfElementsC == 0)
			{
				echo 'No values found for Query 1 in mode 4<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 4<br/>';
			echo $conObj->error;
		}
	}

	elseif($mode == 5)
	{
		//To fetch Details of competitions
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM competitions WHERE uid = ?",$values1);
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
		}
	}
	
	elseif($mode == 6)
	{
		//To fetch Details of experience
		$values1 = array(0 => array($userId=> 's'));
		$result1 = $conObj->select("SELECT * FROM experience WHERE uid = ?",$values1);
		$noOfElementsE = 0;
		if($conObj->error == "")
		{
			while($experience = $conObj->fetch($result1))
			{
				$obj = new experience($experience['organisation'],$experience['start'],$experience['end'],$experience['title'],$experience['description'],$isOwner);
				$outputa[$noOfElementsE] = $obj;
				$noOfElementsE++;
			}
			print_r($outputa);
			if($noOfElementsE == 0)
			{
				echo 'No values found for Query 1 in mode 6<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 6<br/>';
			echo $conObj->error;
		}
	}
	
	elseif($mode == 7)
	{
		//To fetch Details of leaveMessage
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM leavemessage WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsM = 0;
			while($leaveMessage = $conObj->fetch($result1))
			{
				$obj = new leaveMessage($leaveMessage['name'],$leaveMessage['mailid'],$leaveMessage['message'],$isOwner);
				$outputa[$noOfElementsM] = $obj;
				$noOfElementsM++;
			}
			print_r($outputa);
			if($noOfElementsM = 0)
			{
				echo 'No values found for Query 1 in mode 7<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 7<br/>';
			echo $conObj->error;
		}
	}
		
	elseif($mode == 8)
	{
		//To fetch Details of objective
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchall("SELECT * FROM objective WHERE uid = ?",$values1);
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
		}
	}
	
	elseif($mode == 9)
	{
		//To fetch Details of projects
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM projects WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsP = 0;
			while($projects = $conObj->fetch($result1))
			{
				$obj = new projects($projects['title'],$projects['role'],$projects['start'],$projects['end'],$projects['description'],$isOwner);
				$outputa[$noOfElementsP] = $obj;
				$noOfElementsP++;
			}
			print_r($outputa);	
			if($noOfElementsP == 0)
			{
				echo 'No values found for Query 1 in mode 9<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 9<br/>';
			echo $conObj->error;
		}
	}	
	
	elseif($mode == 10)
	{
		//To fetch Details of skillset
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM skillset WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsS = 0;
			while($skillSets = $conObj->fetch($result1))
			{
				$obj = new skillSet($skillSets['skills'],$skillSets['rating'],$isOwner);
				$outputa[$noOfElementsS] = $obj;
				$noOfElementsS++;
			}
			print_r($outputa);
			if($noOfElementsS == 0)
			{
				echo 'No values found for Query 1 in mode 10<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 10 <br/>';
			echo $conObj->error;
		}

	}
	
	elseif($mode == 11)
	{
		//To fetch Details of socialmedia
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->fetchall("SELECT * FROM socialmedia WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			if($result1!="")
			{
				$obj = new socialmedia($result1['facebookid'],$result1['googleid'],$result1['twitterid'],$result1['linkedinid'],$isOwner);
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
		}
	}
		
	elseif($mode == 12)
	{
		//To fetch Details of toolkit
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM toolkit WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementT = 0;
			while($toolkit = $conObj->fetch($result1))
			{
				$obj = new toolkit($toolkit['tools'],$isOwner);
				$outputa[$noOfElementT] = $obj;
				$noOfElementT++;
			}
			print_r($outputa);
			if($noOfElementT == 0)
			{
				echo 'No values found for Query 1 in mode 12<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 12 <br/>';
			echo $conObj->error;
		}
	}
		
	elseif($mode == 13)
	{
		//To fetch Details of workshop
		$values1 = array(0 => array($userId => 's'));
		$result1 = $conObj->select("SELECT * FROM workshops WHERE uid = ?",$values1);
		if($conObj->error == "")
		{
			$noOfElementsW = 0;
			while($workshops = $conObj->fetch($result1))
			{
				$obj = new workshops($workshops['title'],$workshops['start'],$workshops['end'],$workshops['place'],$workshops['attendees'],$isOwner);
				$outputa[$noOfElementsW] = $obj;
				$noOfElementsW++;
			}
			print_r($outputa);
			if($noOfElementsW == 0)
			{
				echo 'No values found for Query 1 in mode 13<br />';
			}
		}
		else
		{
			echo 'Error in Query 1 in mode 13 <br/>';
			echo $conObj->error;
		}
	}	
	
	
}
		
		
		
		
?>