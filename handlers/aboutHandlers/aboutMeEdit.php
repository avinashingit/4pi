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
if($mode==1)
{
	//#about Edit
	aboutMeEdit($user,$_POST['_dob'],$_POST['_description']);
}
else if($mode==2)
{
	//#achievements Edit
	achievmentsEdit($user,$_POST['_eventName'],$_POST['_description'],$_POST['_position'],$_POST['_location'],$_POST['_achievementId'],$_POST['_achievedDate']);
}
else if($mode==3)
{
	//#academics Edit
	academicsEdit($user,$_POST['_degree'],$_POST['_schoolName'],$_POST['_duration']),$_POST['_score'],$_POST['_scoreType'],$_POST['_degreeId']);
}
else if($mode==4)
{
	//#certifiedCourses Edit
	certifiedCoursesEdit($user,$_POST['_courseName'],$_POST['_duration'],$_POST['_institute'],$_POST['_courseId']);
}
else if($mode==5)
{
	//#experience Edit
	experienceEdit($user,$_POST['_company'],$_POST['duration'],$_POST['_role'],$_POST['_experienceId'],$_POST['_isFeaturring']);
}
else if($mode==6)
{
	//#projects Edit
	projectEdit($user,$_POST['_projectTitle'],$_POST['_projectPosition'],$_POST['_duration'],$_POST['_projectDescription'],$_POST['_teamMembers'],$_POST['_projectCompany'],$_POST['_projectId']);
}
else if($mode==7)
{
	//#workshop Edit
	workshopsEdit($user,$_POST['_workshopName'],$_POST['_duration'],$_POST['_location'],$_POST['_peopleAttended'],$_POST['_workshopId']);
}
else if($mode == 8)
{
	//# SkillSet Insert
	skillSetInsert($user,$_POST['_skill'],$_POST['_rating']);
}
else if($mode == 9)
{
	//#toolkit insert
	toolkitInsert($user,$_POST['_tools']);
}
else if($mode ==10)
{
	//#interests Insert
	interestsInsert($user,$_POST['_interests']);
}
else if($mode ==11)
{
	//bottomPartEdit
	aboutMeBottomEdit($_POST['_mailId'],$_POST['_showMailId'],$_POST['_address'],$_POST['_phone'],$_POST['_showPhone'],$_POST['_city'],$_POST['_fbLink'],$_POST['_twitterLink'],$_POST['_g+Link'],$_POST['_inLink'],$_POST['_ptrestLink']);
}
else 
{
	# Erroneous Mode Sent
	echo 16;
	exit();
}

function aboutMeEdit($user,$dob,$description,$mailId,$showMailId,$address,$phone,$showPhone,$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId)
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
		if($_FILES["_resume"]["name"]!='')
		{
			$resume=$_FILES['_resume']['name'];
			$allowedExts = array("pdf", "png","jpg","jpeg","docx","doc");
			$extension = end(explode(".", $_FILES["_resume"]["name"]));
			if ((($_FILES["_resume"]["type"] == "application/pdf")	|| ($_FILES["_resume"]["type"] == "image/png")	|| ($_FILES["_resume"]["type"] == "image/jpeg") || ($_FILES["_resume"]["type"] == "image/jpg") || ($_FILES["_resume"]["type"] == "application/docx")) && ($_FILES["_resume"]["size"] < 8192576) && in_array($extension, $allowedExts))
			{
				if ($_FILES["_resume"]["error"] > 0)
				{
					echo 6;
					//echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
					notifyAdmin("Resume Upload Error Code: " . $_FILES["_resume"]["error"] ,$userId);
					exit();
				}
				else
				{
					if (array_map('file_exists',glob(__DIR__."/../../files/resumes/$userId.*")))
					{
						array_map('unlink',glob(__DIR__."/../../files/resumes/$userId.*"));
					}
					move_uploaded_file($_FILE["_resume"]["tmp_name"],"../../files/resumes/".$userId.'.'.$extension);
					$resume=$userId.$extension;
				}
			}
		}
		if($_FILES["_profilePic"]["name"]!='')
		{
			$userIdHash=$user['userIdHash'];
			$resume=$_FILES['_profilePic']['name'];
			$allowedExts = array("jpg","jpeg");
			$extension = end(explode(".", $_FILES["_profilePic"]["name"]));
			if (( ($_FILES["_profilePic"]["type"] == "image/jpeg") || ($_FILES["_profilePic"]["type"] == "image/jpg") ) && ($_FILES["_profilePic"]["size"] <= 4194304) && in_array($extension, $allowedExts))
			{
				if ($_FILES["_profilePic"]["error"] > 0)
				{
					echo 6;
					//echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
					notifyAdmin("Propic Upload Error Code: " . $_FILES["_profilePic"]["error"] ,$userId);
					exit();
				}
				else
				{
					if (array_map('file_exists',glob(__DIR__."/../../img/proPics/$userIdHash.jpg")))
					{
						array_map('unlink',glob(__DIR__."/../../img/proPics/$userIdHash.jpg"));
					}
					/*$tempImage=imagecreatefromjpeg($_FILES["_profilePic"]["tmp_name"])
					$destination="../../img/proPics/".$userIdHash.'.jpg';
					$quality=getQuality($_FILES["_profilePic"]["size"]);
					imagejpeg($tempImage, $destination, $quality);*/

					$thumb = new Imagick();
					$thumb->readImage($_FILES["_profilePic"]["tmp_name"]);
					$thumb->resizeImage(200,200,Imagick::FILTER_CATROM,1);
					$thumb->writeImage($_FILES["_profilePic"]["tmp_name"]);
					$thumb->destroy();
					/*move_uploaded_file($_FILES["_profilePic"]["tmp_name"],"../../img/proPics/".$userIdHash.'.jpg');*/
					
				}
			}
		}


		if((($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
		{
			$conObj = new QoB();
			
			$userAlias=$user['alias'];
			$userId = $user['userId'];
			$values = array();
			$highestDegree=getDegree($userId);
			
			$values[0] = array($dob => 's');
			$values[1] = array($description => 's');
			$values[2] = array($resume => 's');
			//$values[3] = array($hobbies => 's');
			/*$values[3] = array($mailId => 's');
			$values[4] = array($address => 's');
			$values[5] = array($phone => 's');
			$values[6] = array($city => 's');
			$values[7] = array($showMailId => 's');
			$values[8] = array($showPhone => 's');
			$values[9]= array($facebookId => 's');
			$values[10]= array($twitterId=> 's');
			$values[11]= array($googleId => 's');
			$values[12]= array($linkedinId => 's');
			$values[13]= array($pinterestId => 's');*/
			$values[3]= array($userId => 's');

			
			$result1 = $conObj->update("UPDATE about SET dob=?,description=?,resume=? WHERE userId= ?",$values);
			
			if($conObj->error == "")
			{
				$aboutObj = new about($userAlias,$dob,$description,$resume,$highestDegree,
					'','','', '','','','', '','','','','',1);
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
function aboutMeBottomEdit($mailId,$showMailId,$address,$phone,$showPhone, $city, $fbLink, $twitterLink,$g+Link, $inLink, $ptrestLink)
{
	$userAlias=$user['alias'];
	$conObj=new QoB();
	$values[1] = array($mailId => 's');
	$values[2] = array($address => 's');
	$values[3] = array($phone => 's');
	$values[4] = array($city => 's');
	$values[5] = array($showMailId => 's');
	$values[6] = array($showPhone => 's');
	$values[7]= array($facebookId => 's');
	$values[8]= array($twitterId=> 's');
	$values[9]= array($googleId => 's');
	$values[10]= array($linkedinId => 's');
	$values[11]= array($pinterestId => 's');
	$values[12]= array($userId => 's');
	$result=$conObj->update("UPDATE about SET mailid=?,address=?,phone=?,city=?, showMailId=?,showPhone=?,facebookId=?,twitterId=?,googleId=?, linkedinId=?,pinterestId=? WHERE userId= ?",$values);
	if($conObj->error == "")
	{
		$aboutObj = new about($userAlias,"",'','','',
			'','',$mailId,$showMailId, $address,$phoneArray,$showPhoneArray,
			$city, $facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,1);
		print_r(json_encode($aboutObj));
	}
	else
	{
		notifyAdmin("Conn.Error".$conObj->error."! While editing in about Edit",$userId);
		echo 12;
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
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = dateStringToTimestamp($date1);
		
		
		if((($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp < $endDateTimestamp) and ($scoreType==0 || $scoreType==1))
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
					$degreeObj= new academics($degreeIdString,$degree,$schoolName,$location,$duration,$minDuration,$score,$scoreType,1);
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
		$achievedDateTimestamp = dateStringToTimestamp($achievedDate);
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);	
		
		if((($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"]) ) and ($achievedDateTimestamp < $currentTimestamp))
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
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		
		if((($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0) and ($startDateTimestamp < $endDateTimestamp))
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
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if((($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0) and($startDateTimestamp <=$endDateTimestamp))
			{
				$conObj = new QoB();
				$conObj->startTransaction();
				//Turn off Featuring for other experiences of user to set it for upcoming experince.
				if($featuring = 1)
				{
					$conn=new QoB();
					$val[0]=array($userId => 's');
					$res=$conObj->update("UPDATE experience SET isfeaturing=0 WHERE userId=?",$val);
					if(($cr=$conn->error)!="")
						{
							$conObj->rollbackTransaction();
							notifyAdmin("Conn Error: ".$cr."in experience Edit 1"$experienceId,$userId);
							echo 12;
							exit();
						}
				}

				$userId = $user['userId'];
				$values = array(0 => array($organisation => 's'),1 => array($startDateTimestamp => 's'),2 => array($endDateTimestamp => 's'), 3 => array($title => 's') , 4 => array($featuring => 'i'), 5 => array($userId => 's'),6 => array($experienceId => 'i'));
				
				$result1 = $conObj->update("UPDATE experience SET organisation=?,start=?,end=?,title=?,featuring=? WHERE userId=? AND experienceId =?",$values);
				
				if($conObj->error == "")
				{
					//echo 'Succesfull Insert <br />';
					if($conObj->getAffectedRows()==1)
					{
						$conn=new QoB();
						$val[0]=array($$experienceId=> 'i');
						$val[1]=array($userId => 's');
						
						$res=$conObj->update("UPDATE about SET work = ? WHERE userId=?",$val);
						if(($cr=$conObj->error)!="")
						{
							$conObj->rollbackTransaction();
							notifyAdmin("Conn Error: ".$cr."in experience Edit 2"$experienceId,$userId);
							echo 12;
							exit();
						}
						$conObj->completeTransaction();
						$duration=getDuration($startDateTimestamp,$endDateTimestamp);
						$minDuration=getMinDuration($startDateTimestamp,$endDateTimestamp);
						//$experienceId="e".$conObj->getInsertId();
						$experienceObj=new experience($experienceIdString,$organisation,$duration,$minDuration,$designation,1);
						print_r(json_encode($experienceObj));
					}
					else
					{
						$conObj->rollbackTransaction();
						notifyAdmin("suspicious attempt to change content in experience:".$experienceId,$userId);
						echo 6;
						exit();
					}	
				}
				else
				{
					$cr=$conObj->error;
					$conObj->rollbackTransaction();
					notifyAdmin("Conn.Error".$cr."! While Editing record in experience",$userId);
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
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if((($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp <= $endDateTimestamp))
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
				$result1 = $conObj->update("UPDATE projects SET projectName=?,role=?,start=?,end=?, description=?,teamMembers=?,organisation=? WHERE userId =? AND projectId=?",$values);
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
		$startDateTimestamp = dateStringToTimestamp($start);
		
		//echo $startDateTimestamp.'<br/>';
		
		$endDate = date_parse($end);
		$endDateTimestamp = dateStringToTimestamp($end);

		//echo $endDateTimestamp.'<br/>';
		
		$date1 = date_create();
		$currentTimestamp = date_timestamp_get($date1);
		
		//echo $currentTimestamp.'<br/>';
		
		if((($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp <=$endDateTimestamp))
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

				$result1 = $conObj->update("UPDATE workshops SET workshopName=?,start=?,end=?,place=?,attendCount=? WHERE userId=? AND workshopId=?",$values);
				
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

	function skillSetEdit($user,$skillArray,$ratingArray)
	{
		/*if(!((count($skillArray)==0) and (count($ratingArray) == 0)))
		{*/
			/*$skillArray=explode(',',$skill);
			$ratingArray=explode(',',$rating);*/
			$skillArrayCount=count($skillArray);
			$ratingArrayCount=count($ratingArray);
			if($skillArrayCount!=$ratingArrayCount)
			{
				echo 16;
				exit();
			}

			/*if($skillArrayCount==0)
			{
				echo 16;
				exit();
			}*/

			$i=0;
			$userId = $user['userId'];
			/*$skillRecord=getSkillsByUser($userId);
			
			$existingSkills=$skillRecord['skills'];
			$existingRating=$skillRecord['rating'];
			$existingSkillsArray=explode(',', $existingSkills);
			$existingRatingArray=explode(',', $existingRating);*/
			$existingSkills="";
			$existingRating="";
			$existingSkillsArray=array();
			$existingRatingArray=array();

			$hasRepeated=false;
			$repeatedSkills=array();
			for ($k=0;$k<$skillArrayCount;$k++) 
			{
				$skill=trim($skillArray[$k]);
				if(isThereInCSV($existingSkills,$skill)===false)
				{
					$existingSkillsArray[]=$skill;
					$existingRatingArray[]=$ratingArray[$k];
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
				}
				else
				{
					$hasRepeated=true;
					$repeatedSkills[]=$skill;
				}
				# code...
			}
			for($i=0;$i<$skillArrayCount-1;$i++)
			{
				for($j=0;$j<$skillArrayCount-1;$j++)
				{
					if($existingRatingArray[$j]<$existingRatingArray[$j+1])
					{
						$temp1=$existingRatingArray[$j];
						$temp2=$existingSkillsArray[$j];
						$existingRatingArray[$j]=$existingRatingArray[$j+1];
						$existingSkillsArray[$j]=$existingSkillsArray[$j+1]
						$existingRatingArray[$j+1]=$temp1;
						$existingSkillsArray[$j+1]=$temp2;
					}
				}
			}
			$message="";
			$errorCode=3;
			if($hasRepeated)
			{
				$repeatedSkills=implode(', ',$repeatedSkills);
				$message=$repeatedSkills. " already exists.";
				$errorCode=19; //Code 19 for partial success
			}

			while($i<count($existingSkillsArray))
			{
				$outObj[$i]=array($existingSkillsArray[$i],(int)$existingRatingArray[$i]);
				$i++;
			}
			
			$conObj = new QoB();
			$updatedSkills=implode(',',$existingSkillsArray);
			$updatedRating=implode(',',$existingRatingArray);
			
						
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

					$skillsObj=new skillSet($exitstingSkillsArray,$existingRatingArray,1,json_encode($outObj),$message,$errorCode);
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
			echo 16;
			exit();
		}*/
						
			
		
	}

	function toolkitEdit($user,$toolsArray)
	{
		
		$toolsArrayCount=count($toolsArray);

		if($toolsArrayCount==0)
		{
			echo 16;
			exit();
		}

		$i=0;
		$userId = $user['userId'];
		//$toolRecord=getToolsByUser($userId);
		
		//$existingTools=$toolRecord['skills'];

		//$existingToolsArray=explode(',', $existingTools);
		$existingTools="";
		$existingToolsArray=array();

		$hasRepeated=false;
		$repeatedTools=array();
		for ($k=0;$k<$toolArrayCount;$k++) 
		{
			$tool=trim($toolArray[$k]);
			if(isThereInCSV($existingTools,$tool)===false)
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
		
		$message="";
		$errorCode=3;
		if($hasRepeated)
		{
			$repeatedTools=implode(', ',$repeatedTools);
			$message=$repeatedTools. " already exists.";
			$errorCode=19; //Code 19 for partial success
		}

		$conObj = new QoB();
		
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
		
	}

	function interestsEdit($user,$interestsArray)
	{
		
		$interestsArrayCount=count($interestsArray);

		if($interestsArrayCount==0)
		{
			echo 16;
			exit();
		}

		$i=0;
		$userId = $user['userId'];
		/*$interestRecord=getInterestsByUser($userId);
		
		$existingInterests=$interestRecord['interests'];

		$existingInterestsArray=explode(',', $existingInterests);*/

		$existingInterests="";
		$existingInterestsArray=array();

		$hasRepeated=false;
		$repeatedInterests=array();
		for ($k=0;$k<$interestArrayCount;$k++) 
		{
			$interest=trim($interestArray[$k]);
			if(isThereInCSV($existingInterests,$interest)===false)
			{
				$existingInterestsArray[]=$interest;
				if($existingInterests=="")
				{
					$existingInterests=$interest;
				}
				else
				{
					$existingInterests.=",".interest;
				}
			}
			else
			{
				$hasRepeated=true;
				$repeatedInterests[]=$interest;
			}
		}
		$message="";
		$errorCode=3;
		if($hasRepeated)
		{
			$repeatedInterests=implode(', ',$repeatedInterests);
			$message=$repeatedInterests. " already exists.";
			$errorCode=19; //Code 19 for partial success
		}

		$conObj = new QoB();
		
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
	}


//Old Working Functions - Dropped as they wont check repititions
/*function skillSetInsert($user,$skill,$rating)
	{
		$skillArray=explode(',',$skill);
		$ratingArray=explode(',',$rating);
		if(count($skillArray)!=count($ratingArray))
		{
			echo 16;
			exit();
		}
		$i=0;
		while($i<count($skillArray))
		{
			$outObj[$i]=array($skillArray[$i],(int)$ratingArray[$i]);
		}
		
		$conObj = new QoB();

		
		$userId = $user['userId'];
		$values = array();
		
		$values[0] = array($userId => 's'); 
		$values[1] = array($skill => 's');
		$values[2] = array($rating => 's');
		$values[3] = array($skill => 's');
		$values[4] = array($rating => 's');

		$result1 = $conObj->update("INSERT INTO skillset(userId,skills,rating) VALUES(?,?,?)  ON DUPLICATE KEY UPDATE skills = ? , rating = ?",$values);
		if($conObj->error == "")
			{
				//echo 'Successfull Insert <br />';

				$skillsObj=new skillSet(json_encode($outObj),$skillArray,$ratingArray,1);
				print_r(json_encode($skillsObj));
			}
		else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While creating record in skillset",$userId);
				echo 12;
				exit();	
			}	
		
	}

	function toolkitInsert($user,$tools)
	{
		
		$conObj = new QoB();
		
		$userId = $user['userId'];
		$values = array();
		
		$values[0] = array($userId => 's'); 
		$values[1] = array($tools => 's');
		$values[2] = array($tools => 's');
		
		$result1 = $conObj->update("INSERT INTO toolkit(userId,tools) VALUES(?,?) ON DUPLICATE KEY UPDATE tools=?",$values);
		if($conObj->error == "")
			{
				//echo 'Successfull Insert <br />';
				$toolsObj=new toolkit($tools,1);
				print_r(json_encode($toolsObj));
			}
		else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While creating record in toolkit",$userId);
				echo 12;
				exit();
			}
								
	}

	function interestsInsert($user,$interests)
	{
		$conObj = new QoB();
				
		$userId = $user['userId'];
		$values = array();
		
		$values[0] = array($userId => 's'); 
		$values[1] = array($interests => 's');
		$values[2] = array($interests => 's');
		
		$result1 = $conObj->update("INSERT INTO interests(userId,interests) VALUES(?,?)  ON DUPLICATE KEY UPDATE interests=?",$values);
		if($conObj->error == "")
			{
				//echo 'Successfull Insert <br />';
				$toolsObj=new toolkit($tools,1);
				print_r(json_encode($toolsObj));
			}
		else
			{
				notifyAdmin("Conn.Error".$conObj->error."! While creating record in toolkit",$userId);
				echo 12;
				exit();
			}		
	}*/
?>