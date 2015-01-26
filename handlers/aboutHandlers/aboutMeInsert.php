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

if ($mode=1) {

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
else if ($mode=2) {

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

	academicsInsert($user,$_POST['_degree'],$_POST['_schoolName'],$_POST['_duration']),$_POST['_score'],$_POST['_scoreType']);

}
else if ($mode=3) {

	# Achievements Insert
	/*$competition=$_POST['_eventName'];
	$description=$_POST['_description'];
	$position=$_POST['_position'];
	$location=$_POST['_location'];
	$achievedDate=$_POST['_achievedDate'];
*/
	achievmentsInsert($user,$_POST['_eventName'],$_POST['_description'],$_POST['_position'],$_POST['_location'],$_POST['_achievedDate'])
}
else if ($mode=4) {

	# Certifications Insert
	//$title=$_POST['_courseName'];
	//$timeString=explode("-",$_POST['_duration']);
	//$start=toTimestamp($timeString[0]);
	//$start=$timeString[0];
	//$end=toTimestamp($timeString[1]);
	//$end=$timeString[1];
	//$instituteName=$_POST['_institute'];

	certifiedCoursesInsert($user,$_POST['_courseName'],$_POST['_duration'],$_POST['_institute'])
}
else if ($mode=5) {

	# Experience Insert
	//$organisation=$_POST[''];
	//$start=$_POST[''];
	//$duration=$_POST[]
	//$end=$_POST[''];
	//$title=$_POST[''];
	//$description=$_POST[''];

	experienceInsert($user,$_POST['_company'],$_POST['duration'],$_POST['_role']);
}
else if ($mode=6) {

	# Projects Insert
	$titl=$_POST[''];
	$role=$_POST[''];
	$start=$_POST[''];
	$end=$_POST[''];
	$description=$_POST[''];

	projectInsert($user,$title,$role,$start,$end,$description)
}
else if ($mode=7) {

	# SkillSet Insert
	$skill=$_POST[''];
	$rating=$_POST[''];

	skillSetInsert($user,$skill,$rating)
}
else if ($mode=8) {\

	# WorkshopsInsert
	$title=$_POST[''];
	$start=$_POST[''];
	$end=$_POST[''];
	$place=$_POST[''];
	$attendes=$_POST[''];

	workshopsInsert($user,$title,$start,$end,$place,$attendes)
}
else {
	# Erroneous Mode Sent
	echo 16;
	exit();
}


function aboutMeInsert($user,$dob,$description,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId)
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
				/*if(file_exists("../../files/resumes/" . $_FILES["file"]["name"]))
				{
					unlink("../../files/resumes/" . $_FILES["file"]["name"]);
				}*/
				if (array_map('file_exists',glob(__DIR__."/../../files/resumes/$userId.*")))
				{
					array_map('unlink',glob(__DIR__."/../../files/resumes/$userId.*"));
				}
				move_uploaded_file($_FILE["file"]["tmp_name"],"../../files/resumes/".$userId.'.'.$extension);
				$resume=$userId.$extension;
			}
		}
	}
	
	if(($profilePic != "") and ($description != "") and ($resume != "") and ($hobbies != "") and ($address != "") and ($phone != "") and ($city != "") and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
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
					$aboutObj = new about($profilePicture,$userAlias,$dob,$description,$resume,$highestDegree,
						$currentProfession,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,
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

function academicsInsert($user,$degree,$schoolName,$durationString,$score,$scoreType)
{	
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
					$values = array(0 => array($userId => 's'), 1 => array($degree => 's'), 2 => array($schoolName => 's'), 3 => array($startDateTimestamp => 's'), 4 => array($endDateTimestamp => 's'),5 => array($score => 's'),6 => array($scoreType => 'i'));
					
					$result1 = $conObj->insert("INSERT INTO academics(userId,degree,schoolName,start,end, score,scoreType) VALUES(?,?,?,?,?, ?,?)",$values);
					
					if($conObj->error == "")
					{
						/*echo 'Succesfull Insert <br />';*/
						$duration=getDuration($start,$end);
						$minDuration=getMinDuration($start,$end);
						$degreeId="d".$conObj->getInsertId();
						$degreeObj= new academics($degreeId,$degree,$schoolName,$duration,$minDuration,$score,$scoreType,1);
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
		echo 'No values found <br/>';
		echo 404;
	}
	
}
		


function achievmentsInsert($user,$competition,$description,$position,$location,achievedDate='')
	{

		$date = date_parse($achievedDate);
		$achievedDateTimestamp = strtotime($achievedDate);
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);	
		
		if(($competition != '') and ($description != '') and ($position != '') and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"]) ) and ($achievedDateTimestamp < $currentTimestamp))
			{
		
				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				
				if($conObj->error == "")
					{
						if($result0 != "")
							{*/ 
								$conObj = new QoB();
								$userId = $user['userId']; 
							
								echo "This is the value of timestamp <br/>";
								echo $achievedDateTimestamp.'<br/>';
							
								$values = array(0 => array($userId => 's'), 1 => array($competition => 's'), 2 => array($description => 's'), 3 => array($position => 's'), 4 => array($location => 's'), 5=>array($achievedDate => 's'));
								
								$result1 = $conObj->insert("INSERT INTO achievements(userId,competition,description,position,location,achievedDate) VALUES(?,?,?,?,?,?)",$values);
								
								if($conObj->error == "")
									{
										$achievementId="ach".$conObj->getInsertId();
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

function certifiedCoursesInsert($user,$title,$durationString,$instituteName)
	{
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
									$courseId=$conObj->getInsertId();
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
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$userId = $user['userId'];
							$values = array(0 => array($userId => 's'),1 => array($organisation => 's'),2 => array($startDateTimestamp => 's'),3 => array($endDateTimestamp => 's'), 4 => array($title => 's') , 5=> array($featuring => 'i'));
							
							$result1 = $conObj->insert("INSERT INTO experience(userId,organisation,start,end,title) VALUES(?,?,?,?,?)",$values);
							
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$experienceId=$conObj->getInsertId();
									$experienceObj=new experience($experienceId,$organisation,$duration,$minDuration,$designation,1);
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
				echo 404;
			}
			
		
	}

function projectInsert($user,$title,$role,$durationString,$description,$teamMembers)
	{
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
							
							$result1 = $conObj->insert("INSERT INTO projects(userId,title,role,start,end, description,teamMembers) VALUES(?,?,?,?,?, ?,?)",$values);
							if($conObj->error == "")
								{
									//echo 'Succesfull Insert <br />';
									$duration=getDuration($startDateTimestamp,$endDateTimestamp);
									$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
									$projectId=$conObj->getInsertId();
									$projectObj=new projects($projectId,$title,$role,$duration,$minDuration,$description,$teamMembers,1);
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
				echo 404;
			}
		
	}

function skillSetInsert($user,$skill,$rating)
	{
		if(($skill!='') and ($rating != 0))
			{
				$conObj = new QoB();
				/*$values0 = array(0 => array($_SESSION['vj'] => 's'));
				$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
				if($conObj->error == "")
					{
						if($result0 != "")
						{*/
							$userId = $user['userId'];
							$values = array();
							
							$values[0] = array($userId => 's'); 
							$values[1] = array($skill => 's');
							$values[2] = array($rating => 's');
							
							$result1 = $conObj->insert("INSERT INTO skillset(userId,skills,rating) VALUES(?,?,?)",$values);
							if($conObj->error == "")
								{
									//echo 'Successfull Insert <br />';
									$skillsObj=new skillSet($skills,$rating,1);
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
			}
		else
			{
				echo 404;
			}
			
		
	}

function workshopsInsert($user,$title,$durationString,$place,$attendes)
	{
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
		
		if(($place != '') and ($attendes != '') and ($title != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp <=$endDateTimestamp))
			{
				$conObj = new QoB();
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
							$values[2] = array($start => 's');
							$values[3] = array($end => 's');
							$values[4] = array($place => 's');
							$values[5] = array($attendes => 'i');
							
							$result1 = $conObj->insert("INSERT INTO workshops(uid,title,start,end,place,attendes) VALUES(?,?,?,?,?,?)",$values);
							
							if($conObj->error == "")
								{
									echo 'Succesfull Insert <br />';
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
				echo 404;
			}
			
		
	}
?>