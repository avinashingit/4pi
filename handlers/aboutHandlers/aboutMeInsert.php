<?php
//------Credits------//
//
//
//---Definitions of all Insert Functions for aboutMe.
//---Author : K Roopesh Reddy ,COE12B025.
//---Email : coe12b025@iiitdm.ac.in
//
//---Editor-1: Hari Krishna Majety , COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//
session_start();
require_once('../../QOB/qob.php');
require_once('../fetch.php');
require_once('aboutMeClass.php');
//Testing Content Starts
	$userIdHash=$_SESSION['vj']=hash("sha512","COE12B014".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_skill']=array("matlab","php","php","");
	$_POST['_rating']=array(10,20,15,9);
	$_POST['_mode']=8;

//$_POST['_company'],$_POST['_duration'],$_POST['_role'],$_POST['isfeaturing']
//$_POST['_degree'],$_POST['_schoolName'],$_POST['location'],$_POST['_duration'],$_POST['_score'],$_POST['_scoreType']
//$_POST['_workshopName'],$_POST['_duration'],$_POST['_location'],$_POST['_peopleAttended']

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
courses - C.* Its Capital C. Careful!!
experience - e.*
projects - p.*
workshops - w.*
*/
//
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

if ($mode==1) {

	# AboutMe Insert
	/*$dob=$_POST['_dob'];
	//validateDate($dob,'-');
	$description=$_POST['_description'];
	//$resume='';
	if($_FILES["file"]["name"][$i]!='')
	{
	
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
				if(file_exists("../../files/resumes/" . $_FILES["file"]["name"]))
				{
					unlink("../../files/resumes/" . $_FILES["file"]["name"]);
				}
				move_uploaded_file($_FILE["file"]["tmp_name"],"../../files/resumes/".$userId.'.'.$extension);
				$resume=$userId.$extension;
			}
		}
	}*/

/*	$hobbies=$_POST['_hobbies'];
	$mailId=$_POST['_mailId'];
	$showMailId=$_POST['_showMailId'];
	$address=$_POST['_address'];
	$phone=$_POST['_phone'];
	$showPhone=$_POST['_showPhone'];
	$city=$_POST['_city'];
	$facebookId=$_POST['_fbLink'];
	$twitterId=$_POST['_twitterLink'];
	$googleId=$_POST['_g+Link'];
	$linkedinId=$_POST['_inLink'];
	$pinterestId=$_POST['_ptrestLink'];*/

	aboutMeInsert($user,$_POST['_dob'],$_POST['_description'],$_POST['_hobbies'],$_POST['_mailId'],$_POST['_showMailId'],$_POST['_address'],$_POST['_phone'],$_POST['_showPhone'],$_POST['_city'],$_POST['_fbLink'],$_POST['_twitterLink'],$_POST['_g+Link'],$_POST['_inLink'],$_POST['_ptrestLink']);

}
else if ($mode==2) {

	# Achievements Insert
	/*$competition=$_POST['_eventName'];
	$description=$_POST['_description'];
	$position=$_POST['_position'];
	$location=$_POST['_location'];
	$achievedDate=$_POST['_achievedDate'];
*/
	achievmentsInsert($user,$_POST['_eventName'],$_POST['_description'],$_POST['_position'],$_POST['_location'],$_POST['_achievedDate']);
}
else if ($mode==3) {

	# Academics Insert
	/*$degreeName=$_POST['_degree'];
	$schoolName=$_POST['_schoolName'];
	//$start=$_POST['_start'];
	$timeString=explode("-",$_POST['_duration']);
	validateDate()
	$start=toTimestamp($timeString[0]);
	$end=toTimestamp($timeString[1]);
	$score=$_POST['_score'];
	$scoreType=$_POST['_scoreType'];*/

	academicsInsert($user,$_POST['_degree'],$_POST['_schoolName'],$_POST['location'],$_POST['_duration'],$_POST['_score'],$_POST['_scoreType'],$_POST['location']);

}

else if ($mode==4) {

	# Certifications Insert
	//$title=$_POST['_courseName'];
	//$timeString=explode("-",$_POST['_duration']);
	//$start=toTimestamp($timeString[0]);
	//$start=$timeString[0];
	//$end=toTimestamp($timeString[1]);
	//$end=$timeString[1];
	//$instituteName=$_POST['_institute'];

	certifiedCoursesInsert($user,$_POST['_courseName'],$_POST['_duration'],$_POST['_institute']);
}
else if ($mode==5) {

	# Experience Insert
	//$organisation=$_POST[''];
	//$start=$_POST[''];
	//$duration=$_POST[]
	//$end=$_POST[''];
	//$title=$_POST[''];
	//$description=$_POST[''];

	experienceInsert($user,$_POST['_company'],$_POST['_duration'],$_POST['_role'],$_POST['_isfeaturing']);
}
else if ($mode==6) {

	# Projects Insert
	$title=$_POST[''];
	$role=$_POST[''];
	$start=$_POST[''];
	$end=$_POST[''];
	$teamMembers=$_POST[''];
	$company=$_POST[''];

	projectInsert($user,$_POST['_projectTitle'],$_POST['_projectPosition'],$_POST['_duration'],$_POST['_projectDescription'],$_POST['_teamMembers'],$_POST['_projectCompany']);
}

else if ($mode==7) {

	# WorkshopsInsert
/*	$title=$_POST[''];
	$start=$_POST[''];
	$end=$_POST[''];
	$place=$_POST[''];
	$attendCount=$_POST[''];*/

	workshopsInsert($user,$_POST['_workshopName'],$_POST['_duration'],$_POST['_location'],$_POST['_peopleAttended']);
}
else if ($mode==8) {

	# SkillSet Insert
/*	$skill=$_POST[''];
	$rating=$_POST[''];*/

	skillSetInsert($user,$_POST['_skill'],$_POST['_rating']);
}
else if ($mode==9)
{
	#toolkit insert
	toolkitInsert($user,$_POST['_tools']);
}
else if ($mode == 10)
{
	#interests Insert
	interestsInsert($user,$_POST['_interests']);
}
else {
	# Erroneous Mode Sent
	echo 16;
	exit();
}

//Deprecated!!! No Insert for about me. Only Update
function aboutMeInsert($user,$dob,$description,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId)
{
	$phoneArray=$phone;
	$showPhoneArray=$showPhone;
	$phone=implode(',',$phone);
	$showPhone=implode(',',$showPhone);
	$date = date_parse($dob);
	$dobTimestamp = dateStringToTimestamp($dob);
	
	$date1 = date_create();
	$currentTimestamp = date_timestamp_get($date1);

	//$profilePic=getProfilePicLocation($userIdHash);

	if($_FILES["file"]["name"]!='')
	{
		$resume=$_FILES['_resume']['name'];
		$allowedExts = array("pdf", "png","jpg","jpeg","docx","doc");
		$extension = end(explode(".", $_FILES["_resume"]["name"][$i]));
		if ((($_FILES["_resume"]["type"] == "application/pdf")	|| ($_FILES["_resume"]["type"] == "image/png")	|| ($_FILES["_resume"]["type"] == "image/jpeg") || ($_FILES["_resume"]["type"] == "image/jpg") || ($_FILES["_resume"]["type"] == "application/docx")) && ($_FILES["_resume"]["size"] < 8192576) && in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo 6;
				//echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
				notifyAdmin("Resume Upload Error Code: " . $_FILES["_resume"]["error"] ,$userId);
				exit();
			}
			else
			{
				/*if(file_exists("../../files/resumes/" . $_FILES["file"]["name"]))
				{
					unlink("../../files/resumes/" . $_FILES["file"]["name"]);
				}*/
				if (array_map('file_exists',glob(__DIR__."/../../files/resumes/$userId.*")))
				{
					array_map('unlink',glob(__DIR__."/../../files/resumes/$userId.*"));
				}
				move_uploaded_file($_FILE["_resume"]["tmp_name"],"../../files/resumes/".$userId.'.'.$extension);
				$resume=$userId.$extension;
			}
		}
	}
	
	if(!(($description == "") and ($resume == "") and ($hobbies == "") and ($address == "") and ($phone == "") and ($city == "")) and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
	{
		$conObj = new QoB();
		/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
		$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		if($conObj->error == "")
		{
			if($result0 != "")
			{
				*/



				$userAlias=$user['alias'];
				$userId = $user['userId'];
				$values = array();
				
				$values[0] = array($userId => 's');
				$values[1] = array($dob => 's');
				$values[2] = array($description => 's');
				$values[3] = array($resume => 's');
				$values[4] = array($hobbies => 's');
				$values[5] = array($mailId => 's');
				$values[6] = array($address => 's');
				$values[7] = array($phone => 's');
				$values[8] = array($city => 's');
				$values[9] = array($showMailId => 's');
				$values[10]= array($showPhone => 's');
				$values[11]= array($facebookId => 's');
				$values[12]= array($twitterId=> 's');
				$values[13]= array($googleId => 's');
				$values[14]= array($linkedinId => 's');
				$values[15]= array($pinterestId => 's');


				
				$result1 = $conObj->insert("INSERT INTO about(userId,dob,description,resume, hobbies,mailid,address,phone,city, showMailId,showPhone,facebookId,twitterId,googleId, linkedinId,pinterestId) VALUES(?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?)",$values);
				
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					/*($profilePicture,$name,$dob,$description,$resume,$highestDegree,
						$currentProfession,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,
						$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,$isOwner)*/
					$aboutObj = new about($userAlias,$dob,$description,$resume,$highestDegree,
						$currentProfession,$hobbies,$mailId,$showMailId,$address,$phoneArray,$showPhoneArray,
						$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,1);
					print_r(json_encode($aboutObj));
				}
				else
				{
					/*echo 'Error in Query 1 <br />';
					echo $conObj->error.'<br />';*/
					notifyAdmin("Conn.Error".$conObj->error."! While inserting in about Insert",$userId);
					echo 12;
					exit();
				}
			/*}
			else
			{
				echo 'No values found for Query 0<br />';
			}
		}
		else
		{
			echo 'Error in Query 0<br />';
			echo $conObj->error.'<br />';
		}*/
	}
	else
	{
		echo 16;
		exit();
	}
		
	
}

function academicsInsert($user,$degree,$schoolName,$location,$durationString,$score,$scoreType,$location)
{	
	/*$timeString=explode("-",$durationString);
	//var_dump($timeString);
	$start=$timeString[0];
	$end=$timeString[1];

	//$startDate = date_parse($start);
	$startDateTimestamp = dateStringToTimestamp($start);
	
	//echo $startDateTimestamp." ";
	
	//$endDate = date_parse($end);
	$endDateTimestamp = dateStringToTimestamp($end);

	//echo $endDateTimestamp." ";
	//
	echo $scoreType;
	
	$date1 = date_create();
	$currentTimestamp = date_timestamp_get($date1);*/
	//echo $currentTimestamp;
	if(!($scoreType!="" and ($scoreType==2 || $scoreType==1))
	{
		echo 16;
		exit();
	}
	if(!($degree=="") and (($time=validateAboutMeDateString($durationString))!=false) )
	{
		$startDateTimestamp=$time['start'];
		$endDateTimestamp=$time['end'];
		$conObj = new QoB();
		/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
		$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		if($conObj->error == "")
		{
			if($result0 != "")
			{*/
				$userAlias=$user['alias'];
				$userId = $user['userId'];
				$degreeId = '';
				/*$check = 1;
				if($degreeName == "PHD")
					{
						$degreeId = "18118";
					}
				
				else if($degreeName == "MDES")
					{
						$degreeId = "157924";
					}	
				
				else if($degreeName == "BTECH")
					{
						$degreeId = "4239814";
					}

				
				else if($degreeName == "Secondary School")
					{
						$degreeId = "2187";
					}


				else if($degreeName == "Senior Secondary School" )
					{
						$degreeId = "211722241110";
					}
					
				else
					{
						$check = -1;
					}
				
				if($check == 1)
				{*/
					$values = array(0 => array($userId => 's'), 1 => array($degree => 's'), 2 => array($schoolName => 's'), 3 => array($startDateTimestamp => 's'), 4 => array($endDateTimestamp => 's'),5 => array($score => 's'),6 => array($scoreType => 'i'),7=>array($location => 's'));
					
					$result1 = $conObj->insert("INSERT INTO academics(userId,degree,schoolName,start,end, score,scoreType,location) VALUES(?,?,?,?,?, ?,?,?)",$values);
					
					if($conObj->error == "")
					{
						/*echo 'Succesfull Insert <br />';*/
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						$degreeId="d".$conObj->getInsertId();
						$degreeObj= new academics($degreeId,$degree,$schoolName,$location,$duration,$minDuration,$score,$scoreType,1);
						print_r(json_encode($degreeObj));
					}
					else
					{
						notifyAdmin("Conn.Error".$conObj->error."! While creating record in academics",$userId);
						echo 12;
						exit();
					}
				/*}
				else
				{
					echo "The degree entered is wrong please check again <br/>";
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
			}*/
	}
	
	else
	{
		//echo 'No values found <br/>';
		echo 16;
		exit();
	}
	
}
		


function achievmentsInsert($user,$competition,$description,$position,$location,$achievedDate='')
	{
		//No achieved Date For now
		/*$date = date_parse($achievedDate);
		$achievedDateTimestamp = dateStringToTimestamp($achievedDate);*/
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);	
		
		if(!($competition == '') )
			{
		
				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				
				if($conObj->error == "")
					{
						if($result0 != "")
							{*/ 
								$userId = $user['userId']; 
							
								//echo "This is the value of timestamp <br/>";
								//echo $achievedDateTimestamp.'<br/>';
							
								$values = array(0 => array($userId => 's'), 1 => array($competition => 's'), 2 => array($description => 's'), 3 => array($position => 's'), 4 => array($location => 's'), 5=>array($achievedDate => 's'));
								
								$result1 = $conObj->insert("INSERT INTO achievements(userId,competition,description,position,location,achievedDate) VALUES(?,?,?,?,?,?)",$values);
								
								if($conObj->error == "")
									{
										$achievementId="a".$conObj->getInsertId();
										$obj= new achievements($achievementId,$competition,$location,$description,$position,1);
										print_r(json_encode($obj));
									}
								else
									{
										notifyAdmin("Conn.Error".$conObj->error."! While creating record in achievements",$userId);
										echo 12;
										exit();
									}
							/*}
						else
							{
								echo 'No values found for Query 0 <br />';
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
				echo 'No values found <br/>';
				echo 404;
			}*/
		
		
	}

}

function certifiedCoursesInsert($user,$title,$durationString,$instituteName)
	{
		/*$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		// $startDate = date_parse($start);
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		// $endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);*/
		
		
		if(!(($title == '') and ($instituteName == '')) and (($time=validateAboutMeDateString($durationString))!=false))
			{
				$startDateTimestamp=$time['start'];
				$endDateTimestamp=$time['end'];
				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$userId = $user['userId'];
							$values = array(0 => array($userId => 's'),1 => array($title => 's'), 2 => array($startDateTimestamp => 's'),3 => array($endDateTimestamp => 's'), 4=> array($instituteName => 's'));
							
							$result1 = $conObj->insert("INSERT INTO certifiedcourses(userId,courseName,start,end,instituteName) VALUES(?,?,?,?,?)",$values);
							
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$courseId="C".$conObj->getInsertId();

									$courseObj = new certifiedCourses($courseId,$title,$duration,$minDuration,$instituteName,1);
									print_r(json_encode($courseObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in certified Courses",$userId);
									echo 12;
									exit();
								}
						/*}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
				
			}
		else
			{
				echo 16;
				exit();
			}
		
	}

function experienceInsert($user,$organisation,$durationString,$title,$featuring)
	{
		/*$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];
				
		// $startDate = date_parse($start);
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		// $endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		//$date1 = date_create();
		//$currentTimestamp = date_timestamp_get($date1);
		$currentTimestamp = time();*/
		
		//echo $currentTimestamp.'<br/>';
		
		if(!($title == '') and (($time=validateAboutMeDateString($durationString))!=false))
			{
				
				$startDateTimestamp=$time['start'];
				$endDateTimestamp=$time['end'];
				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							//Turn off Featuring for other experiences of user to set it for upcoming experince.
							if($featuring == 1)
							{
								$conn=new QoB();
								$val[0]=array($userId => 's');
								$res=$conn->update("UPDATE experience SET featuring=0 WHERE userId=?",$val);
								if($conn->error!="")
								{
									notifyAdmin("Conn.Error".$conObj->error."! While editing featuring in experience",$userId);
									echo 12;
									exit();
								}
							}

							$userId = $user['userId'];
							$values = array(0 => array($userId => 's'),1 => array($organisation => 's'),2 => array($startDateTimestamp => 's'),3 => array($endDateTimestamp => 's'), 4 => array($title => 's') , 5=> array($featuring => 'i'));
							
							$result1 = $conObj->insert("INSERT INTO experience(userId,organisation,startDate,endDate,designation,featuring) VALUES(?,?,?,?,?,?)",$values);
							
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$experienceId="e".$conObj->getInsertId();
									$experienceObj=new experience($experienceId,$organisation,$duration,$minDuration,$title,$featuring,1);
									print_r(json_encode($experienceObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in experience",$userId);
									echo 12;
									exit();
								}
					/*	}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
			}
			
		else
			{
				//echo 'details entered are wrong <br/>';
				echo 16;
				exit();
			}
			
		
	}

function projectInsert($user,$title,$role,$durationString,$description,$teamMembers,$organisation)
	{
		/*$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];
	
		// $startDate = date_parse($start);
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		// $endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		echo $endDate;

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);*/
		
		//echo $currentTimestamp.'<br/>';
		
		if(!($title == '') and (($time=validateAboutMeDateString($durationString))!=false))
			{
				$conObj = new QoB();
				$startDateTimestamp=$time['start'];
				$endDateTimestamp=$time['end'];
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);

				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$userId = $user['userId'];
							$values = array();
							
							$values[0] = array($userId => 's');
							$values[1] = array($title => 's');
							$values[2] = array($role => 's');
							$values[3] = array($startDateTimestamp => 's');
							$values[4] = array($endDateTimestamp => 's'); 
							$values[5] = array($description => 's');
							$values[6] = array($teamMembers => 's');
							$values[7] = array($organisation => 's');
							
							$result1 = $conObj->insert("INSERT INTO projects(userId,projectName,role,start,end, description,teamMembers,organisation) VALUES(?,?,?,?,?, ?,?,?)",$values);
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$projectId="p".$conObj->getInsertId();
									$projectObj=new projects($projectId,$title,$role,$duration,$minDuration,$description,$teamMembers,$organisation,1);
									print_r(json_encode($projectObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in projects",$userId);
									echo 12;
									exit();
								}
					/*	}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
			}
			
		else
			{
				echo 16;
				exit();
			}
		
	}

function workshopsInsert($user,$title,$durationString,$place,$attendCount)
	{
		/*$timeString=explode("-",$durationString);
		$start=$timeString[0];
		$end=$timeString[1];

		// $startDate = date_parse($start);
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		// $endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);*/
		
		//echo $currentTimestamp.'<br/>';
		
		if(!($title == '') and (($time=validateAboutMeDateString($durationString))!=false))
			{
				$conObj = new QoB();
				$startDateTimestamp=$time['start'];
				$endDateTimestamp=$time['end'];
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$userId = $user['userId'];
							$values = array();
							
							$values[0] = array($userId => 's');
							$values[1] = array($title => 's');
							$values[2] = array($startDateTimestamp => 's');
							$values[3] = array($endDateTimestamp => 's');
							$values[4] = array($place => 's');
							$values[5] = array($attendCount => 'i');
							
							$result1 = $conObj->insert("INSERT INTO workshops(userId,workshopName,start,end,place,attendersCount) VALUES(?,?,?,?,?,?)",$values);
							
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$workshopId="w".$conObj->getInsertId();
									$workshopObj=new workshops($workshopId,$duration,$minDuration,$title,$place,$attendCount,1);
									print_r(json_encode($workshopObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in workshops",$userId);
									echo 12;
									exit();
								}
					/*	}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
			}
			
		else	
			{
				echo 16;
				exit();
			}
			
		
	}

function skillSetInsert($user,$skillArray,$ratingArray)
	{
		/*if(!((count($skillArray)==0) and (count($ratingArray) == 0)))
		{*/
			/*$skillArray=explode(',',$skill);
			$ratingArray=explode(',',$rating);*/
			//var_dump($skillArray);
			if(!(is_array($skillArray)&&is_array($ratingArray)))
			{
				echo 16;
				exit();
			}
			$skillArrayCount=count($skillArray);
			$ratingArrayCount=count($ratingArray);
			if($skillArrayCount!=$ratingArrayCount)
			{
				echo 16;
				exit();
			}

			if($skillArrayCount==0)
			{
				echo 16;
				exit();
			}

			$i=0;
			$userId = $user['userId'];
			$skillRecord=getSkillsByUser($userId);
			
			$existingSkills=$skillRecord['skills'];
			var_dump($existingSkills);
			$existingRating=$skillRecord['rating'];
			if($existingSkills!="")
			{
				$existingSkillsArray=explode(',', $existingSkills);
				$existingRatingArray=explode(',', $existingRating);
			}
			else
			{
				$existingSkillsArray=array();
				$existingRatingArray=array();
			}
			echo "<br>";
			var_dump($existingSkillsArray);
			$empty=false;
			$hasRepeated=false;
			$repeatedSkills=array();
			$updatedSkillCount=$skillArrayCount;
			for ($k=0;$k<$skillArrayCount;$k++) 
			{
				$skill=trim($skillArray[$k]);
				if($skill=="")
				{
					$empty=true;
				}
				else
				{
					if(isThereInCSV($existingSkills,$skill)==false)
					{
						$existingSkillsArray[]=$skill;
						$existingRatingArray[]=$ratingArray[$k];
						$updatedSkillCount++;
						if($existingSkills=="")
						{
							$existingSkills=$skill;
							$existingRating=$ratingArray[$k];
						}
						else
						{
							$existingSkills.=",".$skill;
							$existingRating.=",".$ratingArray[$k];
						}
						echo "$existingSkills";
					}
					else
					{
						$hasRepeated=true;
						$repeatedSkills[]=$skill;
					}
				}
			}
			//echo $updatedSkillCount;
			//Sorting the Skills in decreasing order of rating
			for($i=0;$i<$updatedSkillCount-1;$i++)
			{
				for($j=0;$j<$updatedSkillCount-1;$j++)
				{
					//echo $existingRatingArray[$j];
					if($existingRatingArray[$j]<$existingRatingArray[$j+1])
					{
						//echo $existingRatingArray[$j+1];
						$temp1=$existingRatingArray[$j];
						$temp2=$existingSkillsArray[$j];
						$existingRatingArray[$j]=$existingRatingArray[$j+1];
						$existingSkillsArray[$j]=$existingSkillsArray[$j+1];
						$existingRatingArray[$j+1]=$temp1;
						$existingSkillsArray[$j+1]=$temp2;
					}
				}
			}
			//Sorting Ends
			$message="";
			$errorCode=3;
			if($empty)
			{
				$message="Some Fields left empty. Please Fill or Remove them. ";
				$errorCode=19;
			}
			if($hasRepeated)
			{
				$repeatedSkills=implode(', ',$repeatedSkills);
				$message.=$repeatedSkills. " already exists.";
				$errorCode=19; //Code 19 for partial success
			}
			$i=0;
			while($i<count($existingSkillsArray))
			{
				$outObj[$i]=array($existingSkillsArray[$i],(int)$existingRatingArray[$i]);
				$i++;
			}
			/*if(($skill!='') and ($rating != 0))
				{*/
					$conObj = new QoB();
					$updatedSkills=implode(',',$existingSkillsArray);
					$updatedRating=implode(',',$existingRatingArray);
					/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
					if($conObj->error == "")
						{
							if($result0 != "")
							{*/
								
								$values = array();
								
								$values[0] = array($userId => 's'); 
								$values[1] = array($updatedSkills => 's');
								$values[2] = array($updatedRating => 's');
								$values[3] = array($updatedSkills => 's');
								$values[4] = array($updatedRating => 's');

								$result1 = $conObj->update("INSERT INTO skillset(userId,skills,rating) VALUES(?,?,?)  ON DUPLICATE KEY UPDATE skills = ? , rating = ?",$values);
								if($conObj->error == "")
								{
									//echo 'Successfull Insert <br />';

									$skillsObj=new skillSet($existingSkillsArray,$existingRatingArray,1,json_encode($outObj),$message,$errorCode);
									print_r(json_encode($skillsObj));
								}
								else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in skillset",$userId);
									echo 12;
									exit();
								}
							/*}
							else
							{
								echo 'No values found for Query 0<br />';
							}
						}
					else
						{
							echo 'Error in Query 0<br />';
							echo $conObj->error.'<br />';
						}*/
		/*}
		else
		{
			echo 16;
			exit();
		}*/
			
		
	}

	function toolkitInsert($user,$toolsArray)
	{
		/*if(count($toolsArray)!=0)
			{*/
				if(!(is_array($toolsArray)))
				{
					echo 16;
					exit();
				}
				$toolsArrayCount=count($toolsArray);

				if($toolsArrayCount==0)
				{
					echo 16;
					exit();
				}

				$i=0;
				$userId = $user['userId'];
				$toolRecord=getToolsByUser($userId);
				
				$existingTools=$toolRecord['tools'];
				if($existingTools!="")
				{
					$existingToolsArray=explode(',', $existingTools);
				}
				else
				{
					$existingToolsArray=array();
				}
				

				$empty=false;
				$hasRepeated=false;
				$repeatedTools=array();
				for ($k=0;$k<$toolsArrayCount;$k++) 
				{
					$tool=trim($toolsArray[$k]);
					if($tool=="")
					{
						$empty=true;
					}
					else
					{
						if(isThereInCSV($existingTools,$tool)==false)
						{
							$existingToolsArray[]=$tool;
							if($existingTools=="")
							{
								$existingTools=$tool;
							}
							else
							{
								$existingTools.=",".$tool;
							}
						}
						else
						{
							$hasRepeated=true;
							$repeatedTools[]=$tool;
						}
					}
				}
				$message="";
				$errorCode=3;
				if($empty)
				{
					$message="Some Fields left empty. Please Fill or Remove them. ";
					$errorCode=19;
				}
				if($hasRepeated)
				{
					$repeatedTools=implode(', ',$repeatedTools);
					$message.=$repeatedTools. " already exists.";
					$errorCode=19; //Code 19 for partial success
				}

				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							// var_dump($existingToolsArray);
							$updatedTools=implode(',',$existingToolsArray);
							$values = array();
							
							$values[0] = array($userId => 's'); 
							$values[1] = array($updatedTools => 's');
							$values[2] = array($updatedTools => 's');
							
							$result1 = $conObj->update("INSERT INTO toolkit(userId,tools) VALUES(?,?) ON DUPLICATE KEY UPDATE tools=?",$values);
							if($conObj->error == "")
								{
									//echo 'Successfull Insert <br />';
									$toolsObj=new toolkit($existingToolsArray,1,$message,$errorCode);
									print_r(json_encode($toolsObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in toolkit",$userId);
									echo 12;
									exit();
								}
						/*}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
			/*}
		else
			{
				echo 16;
				exit();
			}*/
			
		
	}

	function interestsInsert($user,$interestsArray)
	{
		/*if(count($interestsArray)!=0)
			{*/
				// var_dump($interestsArray);
				if(!(is_array($interestsArray)))
				{
					echo 16;
					exit();
				}
				$interestsArrayCount=count($interestsArray);
				//var_dump($interestsArray);
				if($interestsArrayCount==0)
				{
					echo 16;
					exit();
				}

				$i=0;
				$userId = $user['userId'];
				$interestRecord=getInterestsByUser($userId);
				var_dump($interestRecord);
				$existingInterests=$interestRecord['interests'];
				if($existingInterests!="")
				{
					$existingInterestsArray=explode(',', $existingInterests);
				}
				else
				{
					$existingInterestsArray=array();
				}
				

				var_dump($existingInterestsArray);
				$hasRepeated=false;
				$empty=false;
				$repeatedInterests=array();
				for ($k=0;$k<$interestsArrayCount;$k++) 
				{
					$interest=trim($interestsArray[$k]);
					//echo $existingInterests." and ".$interest;
					if($interest=="")
					{
						$empty=true;
					}
					else
					{
						if(isThereInCSV($existingInterests,$interest)==false)
						{
							$existingInterestsArray[]=$interest;
							if($existingInterests=="")
							{
								$existingInterests=$interest;
							}
							else
							{
								$existingInterests.=",".$interest;
							}
							echo $existingInterests."<br>";
						}
						else
						{
							//echo "Found Repitition $interest";
							$hasRepeated=true;
							$repeatedInterests[]=$interest;
						}
					}
				}
				//echo "<br> after edit";
				//var_dump($existingInterestsArray);
				$message="";
				$errorCode=3;
				if($empty)
				{
					$message="Some Fields left empty. Please Fill or Remove them. ";
					$errorCode=19;
				}
				
				if($hasRepeated)
				{
					$repeatedInterests=implode(', ',$repeatedInterests);
					$message.=$repeatedInterests. " already exists.";
					$errorCode=19; //Code 19 for partial success
				}

				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$updatedInterests=implode(',',$existingInterestsArray);
							$userId = $user['userId'];
							$values = array();
							
							$values[0] = array($userId => 's'); 
							$values[1] = array($updatedInterests => 's');
							$values[2] = array($updatedInterests => 's');
							
							$result1 = $conObj->update("INSERT INTO interests(userId,interests) VALUES(?,?)  ON DUPLICATE KEY UPDATE interests=?",$values);
							if($conObj->error == "")
								{
									//echo 'Successfull Insert <br />';
									$interestsObj=new interests($existingInterestsArray,1,$message,$errorCode);
									print_r(json_encode($interestsObj));
								}
							else
								{
									notifyAdmin("Conn.Error".$conObj->error."! While creating record in interests",$userId);
									echo 12;
									exit();
								}
						/*}
						else
						{
							echo 'No values found for Query 0<br />';
						}
					}
				else
					{
						echo 'Error in Query 0<br />';
						echo $conObj->error.'<br />';
					}*/
			/*}
		else
			{
				echo 16;
				exit();
			}*/
			
		
	}

	/*function leaveMessageInsert($receiverUserId,$senderName,$senderMailId,$message)
	{
		$conn=new QoB();
		$values = array(0 => array($userId => 's'));
		$result = $conn->fetchAll("INSERT INTO interests() WHERE userId = ?",$values,false);
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}*/

?>