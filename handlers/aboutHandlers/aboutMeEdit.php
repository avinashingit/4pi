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
require_once('./miniPoll.php');
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
if($mode =1)
{
	#about Edit
	aboutMeEdit($user,$_POST['_dob'],$_POST['_description'],$_POST['_hobbies'],$_POST['_mailId'],$_POST['_showMailId'],$_POST['_address'],$_POST['_phone'],$_POST['_showPhone'],$_POST['_city'],$_POST['_fbLink'],$_POST['_twitterLink'],$_POST['_g+Link'],$_POST['_inLink'],$_POST['_ptrestLink']);
}
else if($mode=2)
{
	#academics Edit
	academicsEdit($user,$_POST['_degree'],$_POST['_schoolName'],$_POST['_duration']),$_POST['_score'],$_POST['_scoreType'],$_POST['_degreeId']);
}
else if($mode=3)
{
	#achievements Edit
	achievmentsEdit($user,$_POST['_eventName'],$_POST['_description'],$_POST['_position'],$_POST['_location'],$_POST['_achievementId'],$_POST['_achievedDate']);
}
else if($mode=4)
{
	#certifiedCourses Edit
	certifiedCoursesEdit($user,$_POST['_courseName'],$_POST['_duration'],$_POST['_institute'],$_POST['_courseId']);
}
else if($mode=5)
{
	#experience Edit
	experienceEdit($user,$_POST['_company'],$_POST['duration'],$_POST['_role'],$_POST['_experienceId']);
}
else if($mode=6)
{
	#projects Edit
	projectEdit($user,$_POST['_projectTitle'],$_POST['_projectPosition'],$_POST['_duration'],$_POST['_teamMembers'],$_POST['_projectCompany'],$_POST['_projectId']);
}
else if($mode=7)
{
	#workshop Edit
	workshopsEdit($user,$_POST['_workshopName'],$_POST['_duration'],$_POST['_location'],$_POST['_peopleAttended'],$_POST['_workshopId']);
}
else 
{
	# Erroneous Mode Sent
	echo 16;
	exit();
}

function aboutMeEdit($user,$dob,$description,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId)
	{

		$date = date_parse($dob);
		$dobTimestamp = strtotime($dob);
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);

		$profilePic=getProfilePicLocation($userIdHash);
		if($_FILES["file"]["name"]!='')
		{
			$resume=$_FILES['file']['name'];
			$allowedExts = array("pdf", "png","jpg","jpeg","docx","doc");
			$extension = end(explode(".", $_FILES["file"]["name"][$i]));
			if ((($_FILES["file"]["type"] == "application/pdf")	|| ($_FILES["file"]["type"] == "image/png")	|| ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "application/docx")) && ($_FILES["file"]["size"] < 8192576) && in_array($extension, $allowedExts))
			{
				if ($_FILES["file"]["error"] > 0)
				{
					echo 6;
					//echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
					notifyAdmin("Resume Upload Error Code: " . $_FILES["file"]["error"] ,$userId);
					exit();
				}
				else
				{
					if (array_map('file_exists',glob(__DIR__."/../../files/resumes/$userId.*")))
					{
						array_map('unlink',glob(__DIR__."/../../files/resumes/$userId.*"));
					}
					move_uploaded_file($_FILE["file"]["tmp_name"],"../../files/resumes/".$userId.'.'.$extension);
					$resume=$userId.$extension;
				}
			}
		}
		
		if(($description != "") and ($resume != "") and ($hobbies != "") and ($address != "") and ($phone != "") and ($city != "") and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
		{
			$conObj = new QoB();
			
			$userAlias=$user['alias'];
			$userId = $user['userId'];
			$values = array();
			
			$values[0] = array($dob => 's');
			$values[1] = array($description => 's');
			$values[2] = array($resume => 's');
			$values[3] = array($hobbies => 's');
			$values[4] = array($mailId => 's');
			$values[5] = array($address => 's');
			$values[6] = array($phone => 's');
			$values[7] = array($city => 's');
			$values[8] = array($showMailId => 's');
			$values[9] = array($showPhone => 's');
			$values[10]= array($facebookId => 's');
			$values[11]= array($twitterId=> 's');
			$values[12]= array($googleId => 's');
			$values[13]= array($linkedinId => 's');
			$values[14]= array($pinterestId => 's');
			$values[15]= array($userId => 's');

			
			$result1 = $conObj->update("UPDATE about SET dob=?,description=?,resume=?, hobbies=?,mailid=?,address=?,phone=?,city=?, showMailId=?,showPhone=?,facebookId=?,twitterId=?,googleId=?, linkedinId=?,pinterestId=? WHERE userId= ?",$values);
			
			if($conObj->error == "")
			{
				$aboutObj = new about($profilePic,$userAlias,$dob,$description,$resume,$highestDegree,
					$currentProfession,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,
					$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,1);
				print_r(json_encode($aboutObj));
			}
			else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While editing in about Edit",$userId);
				echo 12;
				exit();
			}
				
		}
		else
		{
			echo 16;
			exit();
		}
	}

function academicsEdit($user,$degree,$schoolName,$durationString,$score,$scoreType,$degreeIdString)
	{	
		$degreeId=(int)substr($degreeIdString, 1);

		$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		$startDate = date_parse($start);
		$startDateTimestamp = strtotime($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = strtotime($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		
		if(($degreeName != '') and ($name != '') and ($score !='') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp < $endDateTimestamp))
		{
			$conObj = new QoB();
			
			$userAlias=$user['alias'];
			$userId = $user['userId'];
			//$degreeId = '';
			
			$values = array(0 => array($degree => 's'), 1 => array($schoolName => 's'), 2 => array($startDateTimestamp => 's'), 3 => array($endDateTimestamp => 's'),4 => array($score => 's'),5 => array($scoreType => 'i'),6 => array($userId => 's'),7 =>array($degreeId=> 'i') );
			
			$result1 = $conObj->update("UPDATE academics SET degree=?,schoolName=?,start=?,end=?, score=?,scoreType=? WHERE userId =? AND degreeId=?",$values);
			
			if($conObj->error == "")
			{
				/*echo 'Succesfull Insert <br />';*/
				if($conObj->getAffectedRows()==1)
				{
					$duration=getDuration($start,$end);
					$minDuration=getMinDuration($start,$end);
					//$degreeId="d".$conObj->getInsertId();
					$degreeObj= new academics($degreeIdString,$degree,$schoolName,$duration,$minDuration,$score,$scoreType,1);
					print_r(json_encode($degreeObj));
				}
				else
				{
					notifyAdmin("suspicious attempt to change content in academics:".$degreeId,$userId);
					echo 6;
					exit();
				}	
			}
			else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While editing record in academics",$userId);
				echo 12;
				exit();
			}			
		}
		else
		{
			echo 16;
			exit();
		}
		
	}

function achievmentsEdit($user,$competition,$description,$position,$location,$achievementIdString,$achievedDate='')
	{
		$achievementId=(int)substr($achievementIdString, 1);

		$date = date_parse($achievedDate);
		$achievedDateTimestamp = strtotime($achievedDate);
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);	
		
		if(($competition != '') and ($description != '') and ($position != '') and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"]) ) and ($achievedDateTimestamp < $currentTimestamp))
		{

			$conObj = new QoB();
			
			$userId = $user['userId']; 
		
			$values = array(0  => array($competition => 's'), 1 => array($description => 's'), 2 => array($position => 's'), 3 => array($location => 's'), 4=>array($achievedDate => 's'), 5=> array($userId => 's'), 6=>array($achievementId => 's'));
			
			$result1 = $conObj->update("UPDATE achievements SET competition=?, description=?, position=?, location=?, achievedDate=?, WHERE userId = ? AND achievementId = ? ",$values);
			
			if($conObj->error == "")
			{
				if($conObj->getAffectedRows()==1)
				{
					//$achievementId="a".$conObj->getInsertId();
					$obj= new achievements($achievementIdString,$competition,$location,$description,$position,1);
					print_r(json_encode($obj));
				}
				else
				{
					notifyAdmin("suspicious attempt to change content in achievements:".$achievementId,$userId);
					echo 6;
					exit();
				}	
			}
			else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While editing record in achievements",$userId);
				echo 12;
				exit();

			}
		}
	}

function certifiedCoursesEdit($user,$title,$durationString,$instituteName,$courseIdString)
	{
		$courseId=(int)substr($courseIdString, 1);

		$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		$startDate = date_parse($start);
		$startDateTimestamp = strtotime($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = strtotime($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		
		if(($title != '') and ($instituteName != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0) and ($startDateTimestamp < $endDateTimestamp))
			{
				$conObj = new QoB();
				
				$userId = $user['userId'];
				$values = array(0 => array($title => 's'), 1 => array($startDateTimestamp => 's'),2 => array($endDateTimestamp => 's'), 3=> array($instituteName => 's'),4 => array($userId => 's'),5=> array($courseId => 'i'));
				
				$result1 = $conObj->update("UPDATE certifiedcourses SET courseName=?,start=?,end=?,instituteName=? WHERE userId=? AND courseId=? ",$values);
				
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					if($conObj->getAffectedRows()==1)
					{
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						//$courseId="c".$conObj->getInsertId();

						$courseObj = new certifiedCourses($courseIdString,$title,$duration,$minDuration,$instituteName,1);
						print_r(json_encode($courseObj));
					}
					else
					{
						notifyAdmin("suspicious attempt to change content in courses:".$courseId,$userId);
						echo 6;
						exit();
					}	
				}
				else
				{
					notifyAdmin("Conn.Error".$conObj->error."! While editing record in certified Courses",$userId);
					echo 12;
					exit();
				}			
			}
		else
			{
				echo 16;
				exit();
			}
		
	}


function experienceEdit($user,$organisation,$durationString,$title,$featuring,$experienceIdString)
	{
		$experienceId=(int)substr($experienceIdString, 1);

		$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];
				
		$startDate = date_parse($start);
		$startDateTimestamp = strtotime($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = strtotime($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if(($organisation != '') and ($title != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0) and($startDateTimestamp <=$endDateTimestamp))
			{
				$conObj = new QoB();
				
				//Turn off Featuring for other experiences of user to set it for upcoming experince.
				if($featuring = 1)
				{
					$conn=new QoB();
					$val[0]=array($userId => 's');
					$res=$conn->update("UPDATE experience SET isfeaturing=0 WHERE userId=?",$val);
					if($conn->error!="")
					{
						echo 12;
						exit();
					}
				}

				$userId = $user['userId'];
				$values = array(0 => array($organisation => 's'),1 => array($startDateTimestamp => 's'),2 => array($endDateTimestamp => 's'), 3 => array($title => 's') , 4 => array($featuring => 'i'), 5 => array($userId => 's'),6 => array($experienceId => 'i'));
				
				$result1 = $conObj->insert("UPDATE experience SET organisation=?,start=?,end=?,title=?,featuring=? WHERE userId=? AND experienceId =?",$values);
				
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					if($conObj->getAffectedRows()==1)
					{
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						//$experienceId="e".$conObj->getInsertId();
						$experienceObj=new experience($experienceIdString,$organisation,$duration,$minDuration,$designation,1);
						print_r(json_encode($experienceObj));
					}
					else
					{
						notifyAdmin("suspicious attempt to change content in experience:".$experienceId,$userId);
						echo 6;
						exit();
					}	
				}
				else
				{
					notifyAdmin("Conn.Error".$conObj->error."! While Editing record in experience",$userId);
					echo 12;
					exit();
				}			
			}
			
		else
			{
				echo 16;
				exit();
			}
	}

function projectEdit($user,$title,$role,$durationString,$description,$teamMembers,$organisation,$projectIdString)
	{
		$projectId=(int)substr($projectIdString, 1);

		$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		$startDate = date_parse($start);
		$startDateTimestamp = strtotime($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = strtotime($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if(($title != '') and ($description != '') and ($role != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp <= $endDateTimestamp))
			{
				$conObj = new QoB();
				
				$userId = $user['userId'];
				$values = array();
				
				
				$values[0] = array($title => 's');
				$values[1] = array($role => 's');
				$values[2] = array($startDateTimestamp => 's');
				$values[3] = array($endDateTimestamp => 's'); 
				$values[4] = array($description => 's');
				$values[5] = array($teamMembers => 's');
				$values[6] = array($organisation => 's');
				$values[7] = array($userId => 's');
				$values[8] = array($projectId => 's')
				$result1 = $conObj->insert("UPDATE projects SET projectName=?,role=?,start=?,end=?, description=?,teamMembers=?,organisation=? WHERE userId =? AND projectId=?",$values);
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					if($conObj->getAffectedRows()==1)
					{
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						//$projectId="p".$conObj->getInsertId();
						$projectObj=new projects($projectIdString,$title,$role,$duration,$minDuration,$description,$teamMembers,$organisation,1);
						print_r(json_encode($projectObj));
					}
					else
					{
						notifyAdmin("suspicious attempt to change content in project:".$projectId,$userId);
						echo 6;
						exit();
					}	
				}
				else
				{
					notifyAdmin("Conn.Error".$conObj->error."! While editing record in projects",$userId);
					echo 12;
					exit();
				}
			}
		else
			{
				echo 16;
				exit();
			}
		
	}

function workshopsEdit($user,$title,$durationString,$place,$attendCount,$workshopIdString)
	{
		$workshopId=(int)substr($workshopIdString, 1);
		$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		$startDate = date_parse($start);
		$startDateTimestamp = strtotime($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = strtotime($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if(($place != '') and ($attendCount != '') and ($title != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp <=$endDateTimestamp))
			{
				$conObj = new QoB();
			
				$userId = $user['userId'];
				$values = array();
				
				
				$values[0] = array($title => 's');
				$values[1] = array($startDateTimestamp => 's');
				$values[2] = array($endDateTimestamp => 's');
				$values[3] = array($place => 's');
				$values[4] = array($attendCount => 'i');
				$values[5] = array($userId => 's');
				$values[6] = array($workshopId => 'i');

				$result1 = $conObj->insert("UPDATE workshops SET workshopName=?,start=?,end=?,place=?,attendCount=? WHERE userId=? AND workshopId=?",$values);
				
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					if($conObj->getAffectedRows()==1)
					{
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						//$workshopId="w".$conObj->getInsertId();
						$workshopObj=new workshops($workshopIdString,$duration,$minDuration,$title,$place,$attendCount,1);
						print_r(json_encode($projectObj));
					}
					else
					{
						notifyAdmin("suspicious attempt to change content in workshop:".$workshopId,$userId);
						echo 6;
						exit();
					}
				}
				else
				{
					notifyAdmin("Conn.Error".$conObj->error."! While editing record in workshops",$userId);
					echo 12;
					exit();
				}
			}
			
		else	
			{
				echo 16;
				exit();
			}	
	}
?>