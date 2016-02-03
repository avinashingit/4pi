<?php
//------Credits------//
//
//
//---Definitions of all Helper Functions for the whole Backend management.
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//Some Statements Which help you understand some typical variable names.
// 1- You Search for a 'Needle' in a 'Haystack'
// 2- Anything 'Raw' is what is fetched from front-end or something which needs to be sent to front-end
//
//---Credits Ends---//


error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED^E_STRICT);

	require_once("miniNotification.php");
	require_once("postHandlers/miniClasses/miniPost.php");
	require_once("postHandlers/miniClasses/miniComment.php");
	require_once("eventHandlers/miniEvent.php");
	require_once("pollHandlers/miniPoll.php");
	// include_once("../QOB/qob.php");

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function uploadPicture($file,$user)
	{
		if($file["name"]!='')
		{
			$userIdHash=$user['userIdHash'];

			$resume=$file['name'];

			$allowedExts = array("jpg","jpeg");

			$extension = end(explode(".", $file["name"]));

			if (( ($file["type"] == "image/jpeg") || ($file["type"] == "image/jpg") ) && ($file["size"] <= 8388608) && in_array($extension, $allowedExts))
			{
				if ($file["error"] > 0)
				{
					echo 6;
					notifyAdmin("Propic Upload Error Code: " . $file["error"] ,$userId);
					exit();
				}
				else
				{
					if (array_map('file_exists',glob(__DIR__."/../img/proPics/$userIdHash.jpg")))
					{
						array_map('unlink',glob(__DIR__."/../img/proPics/$userIdHash.jpg"));
					}
					
					$uploadedfile = $file['tmp_name'];

					$src = imagecreatefromjpeg($uploadedfile);

					list($width,$height)=getimagesize($uploadedfile);

					$newwidth=200;

					$newheight=(1.15)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

					$fileLocation=__DIR__."/../img/proPics/$userIdHash.jpg";

					//$fileLocation2=__DIR__."/../img/proPicsTemp/$userIdHash.jpg";

					//echo $fileLocation;

					//imagejpeg($tmp,$fileLocation2,100);

					if(imagejpeg($tmp,$fileLocation,100))
					{
						//echo "Uploaded Picture successfully ".$fileLocation;
						imagedestroy($src);

						imagedestroy($tmp);

						return true;
					}
					else
					{
						return false;
					}
				}
			}
		}
	}	


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getUserFromHash($userHash)
	{
		$conn=new QoB();

		$fetchUserSQL="SELECT * FROM users WHERE userIdHash= ?";

		$values[0]=array($userHash=>'s');

		$result=$conn->fetchAll($fetchUserSQL,$values);

		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function removeProPic($userIdHash)
	{
		if (array_map('file_exists',glob(__DIR__."/../img/proPics/$userIdHash.jpg")))
		{
			array_map('unlink',glob(__DIR__."/../img/proPics/$userIdHash.jpg"));

			return true;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function removeResume($userId)
	{
		if (array_map('file_exists',glob(__DIR__."/../../files/resumes/$userId.*")))
		{
			array_map('unlink',glob(__DIR__."/../../files/resumes/$userId.*"));

			return true;
		}
		else
		{
			return false; 
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function setPassword($userId,$password,$alias)
	{
		$hashedPassword=hash("sha512",$password.PASSSALT);

		$values[0]=array($hashedPassword=>'s');

		$values[1]=array($alias => 's');

		$values[2]=array($userId => 's');

		$setPasswordSQL="UPDATE users SET password=?,alias=?,isActive=1 WHERE userId=? AND password=''";

		$conn=new QoB();

		$result=$conn->update($setPasswordSQL,$values);

		if($conn->error=="")
		{
			return 1;
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In setting password for userId:".$userId,$userId);
			return 0;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function resetPassword($userId,$password)
	{
		$hashedPassword=hash("sha512",$password.PASSSALT);

		$values[0]=array($hashedPassword=>'s');

		$values[1]=array($userId => 's');

		$resetPasswordSQL="UPDATE users SET password=? WHERE userId=?";
		
		$result=$conn->update($setPasswordSQL,$values);

		if($conn->error=="")
		{
			return 1;
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In resetting password for userId:".$userId,$userId);
			return 0;
		}
		
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function changePassword($userId,$oldpassword,$password)
	{
		$hashedPassword=hash("sha512",$password.PASSSALT);

		$oldpasswordHash=hash("sha512",$oldpassword.PASSSALT);

		$values[0]=array($hashedPassword=>'s');

		$values[1]=array($userId => 's');

		$values[2]=array($oldpasswordHash => 's');

		$setPasswordSQL="UPDATE users SET password=? WHERE userId=? AND password = ?";

		$conn=new QoB();

		$result=$conn->update($setPasswordSQL,$values);

		if($conn->error=="")
		{
			$rowsAffected=$conn->getMatchedRowsOnUpdate();

			if(($rowsAffected)==1)
			{
				return 3;
			}
			else
			{
				return 17;//old password wrong
			}
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In changing password for userId:".$userId,$userId);
			return 12;
		}
		
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function loginLog($userId)
	{	
		$conn=new QoB();

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$os_platform    =   "Unknown OS Platform";

    	$os_array=  array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

	    foreach ($os_array as $regex => $value) 
	    { 
	        if (preg_match($regex, $user_agent)) 
	        {
	            $os_platform = $value;
	        }
    	}

    	$browser        =   "Unknown Browser";

	    $browser_array  =   array(
	                            '/msie/i'       =>  'Internet Explorer',
	                            '/firefox/i'    =>  'Firefox',
	                            '/safari/i'     =>  'Safari',
	                            '/chrome/i'     =>  'Chrome',
	                            '/opera/i'      =>  'Opera',
	                            '/netscape/i'   =>  'Netscape',
	                            '/maxthon/i'    =>  'Maxthon',
	                            '/konqueror/i'  =>  'Konqueror',
	                            '/mobile/i'     =>  'Handheld Browser'
	                        );

	    foreach ($browser_array as $regex => $value) 
	    { 
	        if (preg_match($regex, $user_agent)) 
	        {
	            $browser    =   $value;
	        }
	    }
	    $ipAddress=$_SERVER['REMOTE_ADDR'];

	    $OsAndBrowser=$browser." On ".$os_platform;

		$LogDetailsSQL="INSERT INTO loginlog (userId,osbrowser,ipaddress) VALUES(?,?,?)";

		$values[0]=array($userId => 's');

		$values[1]=array($OsAndBrowser => 's');

		$values[2]=array($ipAddress => 's');

		$result=$conn->insert($LogDetailsSQL,$values);

		if($conn->error==""&&$result==true)
		{
			$logId=$conn->getInsertId();

			return $logId;
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In inserting LoginLog for userId:".$userId,$userId);
			return 0;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function logoutLog($logId)
	{
		$conn=new QoB();

		$timestamp=time();

		$logoutTime=toTimeAgoFormat($timestamp);

		$logoutLogSQL="UPDATE loginlog SET logoutTime= ? WHERE logId=?";

		$values[0]=array($logoutTime => 's');

		$values[1]=array($logId => 'i');

		$result=$conn->update($logoutLogSQL,$values);

		if($conn->error==""&&$result==true)
		{
			return true;
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In inserting LoginLog for LogId:".$logId,$logId);
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getUserFromId($userId)
	{
		$conn=new QoB();

		$fetchUserSQL="SELECT * FROM users WHERE userId= ?";

		$values[0]=array($userId=>'s');

		$result=$conn->fetchAll($fetchUserSQL,$values);
		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getAboutUserFromId($userId)
	{
		$conn=new QoB();

		$fetchUserSQL="SELECT * FROM about WHERE userId= ?";

		$values[0]=array($userId=>'s');

		$result=$conn->fetchAll($fetchUserSQL,$values);

		if($conn->error=="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getResetPassRecord($extHash)
	{
		$conn=new QoB();

		$fetchUserSQL="SELECT * FROM resetPassword WHERE extHash= ?";

		$values[0]=array($extHash=>'s');

		$result=$conn->fetchAll($fetchUserSQL,$values);

		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getLeaveMessageRecord($extHash)
	{
		$conn=new QoB();

		$fetchUserSQL="SELECT * FROM leaveMessage WHERE extHash= ?";

		$values[0]=array($extHash=>'s');

		$result=$conn->fetchAll($fetchUserSQL,$values);

		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//	

	function getPostFromHash($postIdHash)
	{
		$conn=new QoB();

		$values = array(0 => array($postIdHash => 's'));

		$result = $conn->fetchAll("SELECT * FROM post WHERE postIdHash = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getEventFromHash($eventIdHash)
	{
		$conn=new QoB();

		$values = array(0 => array($eventIdHash => 's'));

		$result = $conn->fetchAll("SELECT * FROM event WHERE eventIdHash = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getPollFromHash($pollIdHash)
	{
		$conn=new QoB();

		$values = array(0 => array($pollIdHash => 's'));

		$result = $conn->fetchAll("SELECT * FROM poll WHERE pollIdHash = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getSkillsByUser($userId)
	{
		$conn=new QoB();

		$values = array(0 => array($userId => 's'));

		$result = $conn->fetchAll("SELECT * FROM skillset WHERE userId = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getToolsByUser($userId)
	{
		$conn=new QoB();

		$values = array(0 => array($userId => 's'));

		$result = $conn->fetchAll("SELECT * FROM toolkit WHERE userId = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getInterestsByUser($userId)
	{
		$conn=new QoB();

		$values = array(0 => array($userId => 's'));

		$result = $conn->fetchAll("SELECT * FROM interests WHERE userId = ?",$values,false);

		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function hasReported($userId,$hiddenTo)
	{
		$hiddenToarray = explode(',',$hiddenTo);

		$noofhidden = count($hiddenToarray);
		
		$output = 0;

		for($i = 0;$i<$noofhidden;$i++)
			{
				if(strcmp($userId,$hiddenToarray[$i]) == 0)
					{
						$output++;
						break;
					}
			}
			
		if($output == 0)
			{
				return -1;
			}
		else
			{
				return 1;
			}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function blockUserByHash($userIdHash,$crime,$privateData="")
	{
		$conn=new QoB();

		$isActive=0;

		$ip=$_SERVER['REMOTE_ADDR'];

		

		$UpdateUserSQL="UPDATE users SET isActive=? WHERE userIdHash= ?";

		$values[0]=array($isActive=>'i');

		$values[1]=array($userIdHash=>'s');



		$result=$conn->update($UpdateUserSQL,$values);

		if($conn->error==""&&$result==true)
		{
			$adminNotif="Blocked: ".$crime.",".$userIdHash.",".$privateData;

			//$user=getUserFromHash($userIdHash);

			//$userId=$user['userId'];

			$values1[0]=array($userIdHash =>'s');

			$values1[1]=array($adminNotif => 's');

			$values1[2]=array($ip=>'s');

			$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion,ip) VALUES(?,?,?)";

			$result2=$conn->insert($noteCrimeSQL,$values1);

			if($conn->error==""&&$result2==true){
				return 3;
			}
			else{
				return 2;
			}
		}
		else
		{
			return -1;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function notifyAdmin($notification,$userIdentity)
	{
		$conn= new QoB();

		$ip=$_SERVER['REMOTE_ADDR'];

		$notification="Notify: ".$notification.",  IP: ".$ip;

		$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion, ip) VALUES(?,?,?)";

		$values1[0]=array($userIdentity =>'s');

		$values1[1]=array($notification => 's');

		$values[2]=array($ip=>'s');

		$result=$conn->insert($noteCrimeSQL,$values1);

		if($conn->error==""&&$result==true)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getMailerObject()
	{
		try
		{
			$mail = new PHPMailer(true);

			$mail->IsSMTP();

			$mail->IsHTML();

			$mail->Timeout    = 45;

			$mail->SMTPAuth   = true;                  // enable SMTP authentication

			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

			$mail->Port       = 465;                  // set the SMTP port

			$mail->Username   = "root.4pi@gmail.com";  // MAIL username

			$mail->Password   = "110720@iiitdmK";            // MAIL password

			$mail->Sender     = "4pi@programmer.net";

			$mail->From       = "4pi IIITDM-Kancheepuram";

			$mail->FromName   = "Admin @ 4pi-IIIT D&M Kancheepuram";

			$mail->AddEmbeddedImage('img/reg.jpg','logo_2u');

		}
		catch(phpmailerException $e)
		{
			notifyAdmin($e->errorMessage()."!!!! MailSubject: ".$subject,$userId);
			return false;
		}
		return $mail;
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function sendEmail($mailerObject,$emailId,$content,$subject,$attachments="")
	{
		try
		{
			$mail= $mailerObject;

			$mail->Subject    = $subject;

			$mail->WordWrap   = 500; // set word wrap

			$mail->AddAddress($emailId); //attaches the receiver email address.

			$mail->Body       = $content;

			if($attachments!="")
			{
				$splitAttachments=explode(",",$attachments);

				$attachmentCount=count($splitAttachments);

				for($i=0;$i<$attachmentCount;$i++)
					{
						$mail->AddAttachment($splitAttachments[$i]);
					}
			}
			//$mail->isSMTP();
		
			$mail->send();

			$mail->ClearAddresses();

			return true;
		}
		catch(phpmailerException $e)
		{
			notifyAdmin($e->errorMessage()."!!!! MailSubject: ".$subject,$userId);
			return false;
		}

	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function mailContent($emailId,$post,$user,$attachments="")
	{
		
		try
		{
			$mail = getMailerObject();

			$mail->Subject    ="4Pi: Post[".$post['subject']."] Forwarded By '".$user['name']."'";

			$mail->WordWrap   = 500; // set word wrap

			$mail->AddAddress($emailId);

			$mailBody="<center><strong>--This is an Automated Email. Don't Waste Your TIME Replying to this email address!!--</strong></center><br/>";

			$mailBody=$mailBody."----------------Start --------------<br/><br/>";

			$mailBody=$mailBody."<strong>Post Subject:</strong> ".$post['subject']."<br/>";

			$mailBody=$mailBody."<strong>Post Content:</strong><br/>".$post['content']."<br/><br/>";

			$mailBody=$mailBody."----------------End --------------<br/><br/><br/>";

			$mailBody=$mailBody."Have A Nice Time<br/>Regards,<br/><strong>4pi-MailerBot</strong><br/>";

			$mail->Body       = $mailBody;

			if($attachments!="")
			{
				$splitAttachments=explode(",",$attachments);

				$attachmentCount=count($splitAttachments);

				for($i=0;$i<$attachmentCount;$i++)
					{
						$mail->AddAttachment($splitAttachments[$i]);
					}
			}
			//$mail->isSMTP();
		
			$mail->send();
		
			$mail->ClearAddresses();
		
			return true;
		}
		catch(phpmailerException $e)
		{
			notifyAdmin($e->errorMessage()."!!!! MailSubject: ".$subject,$userId);
			return false;
		}

	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getCommentByPostIdAndHash($postId,$commentIdHash)
	{
		$conn = new QoB();
	
		$commentTable="p".$postId."c";
	
		$GetCommentSQL="SELECT * FROM ".$commentTable." WHERE commentIdHash= ?";
	
		// $values[]=array("commentTable" => 's');
	
		// $values[]=array($commentTable => 's');
	
		$values[0]=array($commentIdHash => 's');
	
		$result=$conn->fetchAll($GetCommentSQL,$values,false);
	
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	//careful!! it returns record not array.
	function getAllCommentsByPostId($postId)
	{
		$conn = new QoB();
	
		$commentTable="p".$postId."c";
	
		$GetCommentSQL="SELECT ".$commentTable.".*,users.alias,users.name,users.userIdHash,users.gender FROM ".$commentTable." INNER JOIN users ON users.userId=".$commentTable.".userId ORDER BY timestamp";
	
		// $values[]=array("commentTable" => 's');
	
		// $values[]=array($commentTable => 's');
	
		//$values[0]=array($commentIdHash => 's');
	
		$result=$conn->select($GetCommentSQL);
	
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	//careful! returns result set not array
	function getFewCommentsByPostId($postId,$commentCount=3)
	{
		$conn = new QoB();
	
		$commentTable="p".$postId."c";
	
		$GetCommentSQL="SELECT ".$commentTable.".*,users.alias,users.name,users.userIdHash,users.gender FROM ".$commentTable." INNER JOIN users ON users.userId=".$commentTable.".userId ORDER BY timestamp DESC LIMIT 0,".$commentCount;
	
		// $values[]=array("commentTable" => 's');
	
		// $values[]=array($commentTable => 's');
	
		//$values[0]=array($commentIdHash => 's');
	
		$result=$conn->select($GetCommentSQL);
	
		//var_dump($result);
	
		if($conn->error==""&&$result!="")
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getAllCommentsArrayByPostId($postId)
	{
		$conn = new QoB();
	
		$commentTable="p".$postId."c";
	
		$GetCommentSQL="SELECT ".$commentTable.".*,users.alias,users.name,users.userIdHash,users.gender FROM ".$commentTable." INNER JOIN users ON users.userId=".$commentTable.".userId ORDER BY timestamp";
	
		// $values[]=array("commentTable" => 's');
	
		// $values[]=array($commentTable => 's');
	
		//$values[0]=array($commentIdHash => 's');
	
		$result=$conn->select($GetCommentSQL);
	
		$out=array();
	
		if($conn->error==""&&$result!="")
		{
			while($record=$conn->fetch($result))
			{
				$out[]=$record;
			}
			//var_dump($out);
			return $out;
		}
		else
		{
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//



	function updatePostIndexesOnComment($postArray,$userId,$conn)
	{
		$postIdHash=$postArray['postIdHash'];
	
		$date = date_create();
	
		$followers=$postArray['followers'];
	
		if(stripos($followers,$userId)===false)
		{
			if($followers=="")
			{
				$followers=$userId;
			}
			else
			{
				$followers=$followers.",".$userId;
			}
		}

		$commentCount=$postArray['commentCount'];
	
		$commentCount=$commentCount+1;
						
		$commentIndexUpdated = ($postArray['commentIndex'] + date_timestamp_get($date))/2;
						
		$popularityIndexUpdated = $postArray['likeIndex']+ 1.4 * $commentIndexUpdated;

		$commentIndexUpdated="".$commentIndexUpdated;

		$popularityIndexUpdated = "".$popularityIndexUpdated;
						
		$values = array(0 => array($commentIndexUpdated => 's'), 1 => array($popularityIndexUpdated => 's'), 2 => array($commentCount => 'i'), 3 => array($followers => 's'),4 => array($postIdHash => 's'));
						
		$result = $conn->update("UPDATE post SET commentIndex = ?, popularityIndex = ?,commentCount = ?,followers = ? WHERE postIdHash = ? ",$values);
	
		if($conn->error == ""&&$result==true)
		{
			//echo 'Updated successfully<br />';
			return true;
		}
		else
		{
			/*echo 'Error in Query 2 of Mode 2<br />';
			echo $conObj->error.'<br />';*/
			return false;
		}
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function changeToRawSharedWith($sharedWith)
	{
		$sharedWithRegex="([\.]+)";
	
		$rawSharedWith=preg_replace($sharedWithRegex, '', $sharedWith);
	
		if($rawSharedWith=="")
		{
			return "EVERYONE";
		}
		return $rawSharedWith;
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	//Anything 'Raw' is what is fetched from front-end or something which needs to be sent to front-end
	function changeToEventDateFormat($date)
	{
		$nDate=explode("/", $date);
	
		$eventDate=$nDate[2].$nDate[1].$nDate[0];
	
		/*$dateRegex="([/]+)";
	
		$eventDate=preg_replace($dateRegex, '', $date);*/
	
		return $eventDate;
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function changeToEventTimeFormat($time)
	{
		$timeArr=explode(':',$time);
		$timeHr=$timeArr[0];
		$timeMin=$timeArr[1];

		/*if($timeHr<10)
		{
			$timeArr[0]='0'.$timeArr[0];
		}*/
		$eventTime=$timeArr[0].$timeArr[1];
		return $eventTime;
		/*$timeRegex="([:]+)";
	
		$eventTime=preg_replace($timeRegex, '', $time);
	
		return $eventTime;*/
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function changeToRawDateFormat($eventDate)
	{
		//echo $eventDate;
		$nndate[0]=substr($eventDate, 6,2);//day
	
		$nndate[1]=substr($eventDate, 4,2);//month
	
		$nndate[2]=substr($eventDate, 0,4);//year
	
		//var_dump($nndate);
	
		/*$nDate=str_split($eventDate,4);
	
		$nndate=str_split($nDate[0],2);
	
		$nndate[2]=$nDate[1];*/
	
		$rawDate=implode("/",$nndate);
	
		return $rawDate;
	
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function changeToRawTimeFormat($eventTime)
	{
	
		$nTime=str_split($eventTime,2);
	
		$rawTime=implode(":",$nTime);
	
		return $rawTime;
	
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function isSharedTo($userId,$sharedWith)
	{
		//$nSharedWith=explode(",",$sharedWith);
	
		$finalRegex=getRollNoRegex($userId);
	
		if(preg_match('/'.$finalRegex.'/',$sharedWith))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	//Try to avaoid. Use Carefully. Prefer isThereInCSV() than this.
	function isThere($haystack,$needle)
	{
		if(stripos($haystack, $needle)===false)
		{
			return -1;
		}
		else
		{
			return 1;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function validateDate($rawDate,$seperator='/')
	{
		$ndate=explode($seperator,$rawDate);
	
		//var_dump($ndate);
	
		if($ndate[2]<1947||$ndate[2]>2050)
		{
			return false;
		}
		if($ndate[2]%4==0)
		{
			$daysArray=[31,29,31,30,31, 30,31,31,30,31, 30,31];
	
			if($ndate[1]>=1&&$ndate[1]<=12)
			{
				if($ndate[0]>=0&&$ndate[0]<=$daysArray[$ndate[1]-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			$daysArray=[31,28,31,30,31, 30,31,31,30,31, 30,31];
	
			if($ndate[1]>=1&&$ndate[1]<=12)
			{
				if($ndate[0]>=0&&$ndate[0]<=$daysArray[$ndate[1]-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function validateTime($rawTime)
	{
		$nTime=explode(":",$rawTime);
	
		if($nTime[0]<0||$nTime[0]>23||$nTime[1]<0||$nTime[1]>59)
		{
			return false;
		}
		return true;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//
	
	function dateStringToTimestamp($dateString,$seperator='/')
	{
		if(validateDate($dateString,$seperator))
		{
			$splitDate=explode($seperator,$dateString);
	
			$year=$splitDate[2];
	
			$month=$splitDate[1];
	
			$day=$splitDate[0];
	
			$timestamp = mktime(0, 0, 0, $month, $day, $year);
	
			return $timestamp;
		}
		else
		{
			return false;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function validateEventDateAndTime($eventDate,$eventTime)
	{
		date_default_timezone_set("Asia/Kolkata");
	
		$currentDate=date("Ymd",time());
	
		$currentTime=date("Hi",time());
	
		$currentDate=(int)$currentDate;
	
		$currentTime=(int)$currentTime;
	
		if($eventDate<$currentDate||($eventDate==$currentDate&&$eventTime<$currentTime))
			return false;
		return true;

	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function validateAboutMeDateString($dateString)
	{
		$time=array();
	
		$currentTime=time();
	
		if($dateString!="-")
		{
			$timestring=explode('-', $dateString);

			//var_dump($timestring);

			$start=$timestring[0];

			$end=$timestring[1];

			if($start!="")
			{
				if(($time['start']=dateStringToTimestamp($start))==false)
				{
					//echo "Returning False1";
					return false;
				}

			}
			else
			{
				//echo "Start Empty";
				$time['start']="";
			}
			if($end!="")
			{
				if(($time['end']=dateStringToTimestamp($end))==false)
				{
					//echo "Returning False2";
					return false;
				}
				else 
				{
					//var_dump($time);
					//echo $currentTime;
					if($time['start']<=$currentTime&&$time['start']<=$time['end'])
					{
						return $time;
					}
					else
					{
						//echo "Returning False3";
						return false;
					}
				}
			}
			else
			{
				//echo "End Empty";
				$time['end']="";
			}
		}
		else
		{
			//echo "String Empty";
			$time['start']="";

			$time['end']="";

			return $time;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	/*function getEventStatus($event,$isAttending)
	{
		date_default_timezone_set("Asia/Kolkata");
 
		$currentDate=date("Ymd",time());
 
 		//echo $currentDate." is the Current Date<br/>";

 		//echo $event['eventDate']." is the Event Date<br/>";

		$currentDate=(int)$currentDate;
 
		$actualStatus="";
 
		if($event['eventDate']==$currentDate)
		{
			$eventTimeHr=(int)(substr($event['eventTime'],0,2));
 
			$eventTimeMin=(int)(substr($event['eventTime'], 2,2));
 			
			//echo $eventTimeHr.":".$eventTimeMin." is the event time<br/> ";

			$eventEndHr=$eventTimeHr+$event['eventDurationHrs'];
 
			$eventEndMin=$eventTimeMin+$event['eventDurationMin'];

			//echo $event['eventDurationHrs'].":".$event['eventDurationMin']." is the event Duration<br/> ";
 
			if($eventEndMin>=60)
			{
				$eventEndMin=$eventEndMin%60;
 
				$eventEndHr++;
 
				$eventEndHr=$eventEndHr%24;
 
			}
			//echo $eventEndHr.":".$eventEndMin." is the event end time<br/> ";
			$currentHr=(int)(date("H",time()));
 
			$currentMin=(int)date("i",time());
			//echo $currentHr.":".$currentMin." is the current time<br/>";

			if($currentHr<$eventTimeHr)
			{
				$actualStatus="As Scheduled";
			}
			else if($currentHr==$eventTimeHr )
			{
				//Event starts in this hour
				if($currentMin<$eventTimeMin)
				{
					$actualStatus="As Scheduled";
				}
				else
				{
					//event has started in this hour
					if($currentHr<$eventEndHr)
					{
						$actualStatus="Ongoing";
					}
					else if($currentHr==$eventEndHr)
					{
						//event is going to end in this hour only
						if($currentMin<=$eventEndMin)
						{
							//event hasnt yet ended
							$actualStatus="Ongoing";
						}
						else
						{
							//event ended in this hour
							$actualStatus="Completed";
						}
					}
					else
					{
						//event ended but this part of the code is actually unreacheable
						$actualStatus="Completed";
					}
				}
			}
			else
			{
				if($currentHr<$eventEndHr)
				{
					$actualStatus="Ongoing";
				}
				else if($currentHr==$eventEndHr)
				{
					if($currentMin<=$eventEndMin)
					{
						$actualStatus="Ongoing";
					}
					else
					{
						$actualStatus="Completed";
					}
				}
				else
				{
					$actualStatus="Completed";
				}
			}
		}
		else if($event['eventDate']<$currentDate)
		{
			$actualStatus="Completed";
		}
		else
		{
			$actualStatus="As Scheduled";
		}
 
		if($isAttending==1)
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled"&&$event['eventStatus']!="Preponed"&&$event['eventStatus']!="Postponed")
			{
				//echo 1;
				return $actualStatus;
			}
			else
			{
				//echo 2;
				return $event['eventStatus'];
			}
		}
		else
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled")
			{
				//echo 3;
				return $actualStatus;
			}
			else
			{
				//echo 4;
				return $event['eventStatus'];
			}
		}
	}*/

//****************************************************************************************************************//
	function getEventStatus($event,$isAttending)
	{
		date_default_timezone_set("Asia/Kolkata");
 
		//$currentDate=date("Ymd",time());
 
 		//echo $currentDate." is the Current Date<br/>";

 		//echo $event['eventDate']." is the Event Date<br/>";

		$actualStatus="";

		$currentDate=(int)$currentDate;
 
		$eventTimeHr=(int)(substr($event['eventTime'],0,2));
 
		$eventTimeMin=(int)(substr($event['eventTime'], 2,2));

		$a = strptime($event['eventDate'], '%Y%m%d');
		
		$eventStartTimestamp = mktime($eventTimeHr, $eventTimeMin, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);

		$currentTime=time();

		$eventEndTimestamp=$eventStartTimestamp+(60*60*$eventTimeHr+60*$eventTimeMin);

		if($currentTime<$eventStartTimestamp)
		{
			$actualStatus="As Scheduled";
		}
		else if($currentTime>=$eventStartTimestamp&&$currentTime<$eventEndTimestamp)
		{
			$actualStatus="Ongoing";
		}
		else
		{
			$actualStatus="As Scheduled";
		}
		
 
		if($isAttending==1)
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled"&&$event['eventStatus']!="Preponed"&&$event['eventStatus']!="Postponed")
			{
				//echo 1;
				return $actualStatus;
			}
			else
			{
				//echo 2;
				return $event['eventStatus'];
			}
		}
		else
		{
			if($event['eventStatus']!="On Hold"&&$event['eventStatus']!="Cancelled")
			{
				//echo 3;
				return $actualStatus;
			}
			else
			{
				//echo 4;
				return $event['eventStatus'];
			}
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//

	//used to get the regular expression to match against sharedwith. Can't be used for other purposes
	function getRollNoRegex($rollno)
	{
		$stud['year']=substr($rollno, 3,2);

		$stud['branch']=substr($rollno,0,3);

		$stud['degree']=substr($rollno, 5,1);

		$stud['branchYear']=substr($rollno,0,5);

		$stud['branchDegree']=$stud['branch'].$stud['degree'];

		$stud['yearDegree']=$stud['year'].$stud['degree'];

		$stud['branchYearDegree']=$stud['branch'].$stud['yearDegree'];

		$regexString="(".$stud['year']."|".$stud['branch']."|".$stud['degree']."|".$stud['branchYear']."|".$stud['branchDegree']."|".$stud['yearDegree']."|".$stud['branchYearDegree'].")";

		$finalRegexString="(,".$regexString.",?)|(^".$regexString.",?)|(^All$)";

		return $finalRegexString;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	//cause for malfunction in isThereInCSV() if the needle is an empty string. That Function returns true if empty string is passed as needle.
	function isThereInCSVRegex($needle)
	{
		//$finalRegexString="(,".$needle.",)|(^".$needle.",)|(^".$needle."$)|(,".$needle."$)";
		$finalRegexString="(^$needle$)|(^$needle,)|(,$needle,)|(,$needle$)";
		return $finalRegexString;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	//Remember that function returns true if the needle is empty.
	function isThereInCSV($haystack,$needle)
	{
		$finalRegexString=isThereInCSVRegex($needle);

		if(preg_match('/'.$finalRegexString.'/',$haystack))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	function isThereInCSVNonRegex($haystack,$needle,$seperator=",")
	{
		$haystackArray=explode($seperator,$haystack);
		return in_array($needle, $haystackArray);


	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function isCOCAS($userId)
	{
		if($userId==COCAS)
		{
			return 1;
		}
		else
		{
			return -1;
		}
	}



	function isCOCASorCULSEC($userId)
	{
		if($userId==COCAS || $userId ==CULSEC)
		{
			return 1;
		}
		else
		{
			return -1;
		}
	}


	function isCULSEC($userId)
	{
		if($userId==CULSEC)
		{
			return 1;
		}
		else
		{
			return -1;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function isSAC($userId)
	{
		if($userId==SAC)
		{
			return 1;
		}
		else
		{
			return -1;
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getDegree($userId)
	{
		$currentYear=date('Y',time());

		$currentMonth=date('m',time());

		$startYear=(int)(substr($userId,3,2));

		$currentYearSliced=(int)(substr($currentYear, 2));

		$isAlumni=0;
		
		$degree="B.Tech";

		$rollNoArray=str_split($userId);

		if($rollNoArray[5]=='D')
		{
			$degree="Ph.D Student";
		}
		else if($rollNoArray[5]=='M')
		{
			$degree="M.Des";

			if($startYear+2==$currentYearSliced)
			{
				if(((int)currentMonth)>6)
				{
					$degree=$degree." Alumnus";
				}
			}
			else if($startYear+2<$currentYearSliced)
			{
				$degree=$degree." Alumnus";
			}
		}
		else if($rollNoArray[5]=='I')
		{
			$degree="B.Tech Dual Degree";

			if($startYear+5==$currentYearSliced)
			{
				if((int)currentMonth>6)
				{
					$degree=$degree." Alumnus";
				}
			}
			else if($startYear+5<$currentYearSliced)
			{
				$degree=$degree." Alumnus";
			}
		}
		else if($rollNoArray[5]=='B')
		{
			$degree="B.Tech";

			if($startYear+4==$currentYearSliced)
			{
				if((int)currentMonth>6)
				{
					$degree=$degree." Alumnus";
				}
			}
			else if($startYear+4<$currentYearSliced)
			{
				$degree=$degree." Alumnus";
			}
			
		}
		
		return $degree;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getDuration($start,$end)
	{
		if($start==0)
		{
			$startYearMonthDate="";
		}
		else
		{
			$startYearMonthDate=date('d/m/Y',$start);
		}
		if($end==0)
		{
			$endYearMonthDate="";
		}
		else
		{
			$endYearMonthDate=date('d/m/Y',$end);
		}
		$duration=$startYearMonthDate."-".$endYearMonthDate;

		return $duration;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getMinDuration($start,$end)
	{
		if($start==0)
		{
			$startYearMonthDate="";
		}
		else
		{
			$startYearMonthDate=date('M,Y',$start);
		}
		if($end==0)
		{
			$endYearMonthDate="";
		}
		else
		{
			$endYearMonthDate=date('M,Y',$end);
		}
		$duration=$startYearMonthDate."-".$endYearMonthDate;

		return $duration;
		
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function toTimestamp($dateString)
	{
		return strtotime($dateString);
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function toTimeAgoFormat($timestamp)
	{
		$ts= new DateTime();

		$ts->setTimestamp($timestamp);

		$timeAgoFormat=$ts->format(DateTime::ISO8601);

		return $timeAgoFormat;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getProfilePicLocation($userIdHash)
	{
		$proPicLocation=__DIR__.'/../img/proPics/'.$userIdHash.'.jpg';

		return $proPicLocation;
	}


	function hasProfilePic($userIdHash)
	{
		$proPicLocation=getProfilePicLocation($userIdHash);
		if(file_exists($proPicLocation))
		{
			return 1;
		}
		else
		{
			return -1;
		}
	}
	
//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getQuatlity($size)
	{
		$RequiredSize=32768;

		if($size<=$RequiredSize)
		{
			$quality=100;
		}
		else if($size>$RequiredSize and $size<=2*$requiredSize)
		{
			$quality=100/2;
		}
		else if($size>2*$RequiredSize and $size<=4*$requiredSize)
		{
			$quality=100/4;
		}
		else if($size>4*$RequiredSize and $size<=8*$requiredSize)
		{
			$quality=100/8;
		}
		else if($size>8*$RequiredSize and $size<=16*$requiredSize)
		{
			$quality=100/16;
		}
		else if($size>16*$RequiredSize and $size<=32*$requiredSize)
		{
			$quality=100/32;
		}
		else if($size>32*$RequiredSize and $size<=64*$requiredSize)
		{
			$quality=100/64;
		}
		else if($size>64*$RequiredSize and $size<=128*$requiredSize)
		{
			$quality=100/128;
		}
		else
		{
			$quality=100/128;
		}
		return $quality;

	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getPollObject($poll,$userId)
	{
		$options=$poll['options'];

		$optionsArray=explode(',', $options);

		$optionCount=count($optionsArray);

		$hasVoted=isThere($poll['votedBy'],$userId);

		$optionVotes=$poll['optionVotes'];

		$optionVotesArray=explode(',', $optionVotes);

		$optionsAndVotes[]=array();

		if($poll['pollType']!=3&&$poll['pollStatus']!=1)
		{
			for($i=0;$i<$optionCount;$i++)
			{
				$optionsAndVotes[$i]=array($optionsArray[$i] ,(int)$optionVotesArray[$i]);
			}
		}

		
		if($poll['userId']==$userId)
		{
			$isOwner=1;
		}
		else
		{
			$isOwner=-1;
		}
		$proPicLocation=__DIR__.'/../img/proPics/'.$poll['userIdHash'].'.jpg';

		if(file_exists($proPicLocation))
		{
			$proPicExists=1;
		}
		else
		{
			$proPicExists=-1;
		}

		$isSAC=isSAC($userId);

		/*if($poll['approvalStatus']==0)
		{
			$isApproved=-1;
		}
		else
		{
			$isApproved=1;
		}*/
		//Code until release of final version


		//code until release of final version
		$pollCreationTime=toTimeAgoFormat($poll['timestamp']);

		$pollStatus=$poll['pollStatus'];

		$pollObj=new miniPoll($poll['pollIdHash'],$poll['question'],$poll['pollType'],$optionsArray, 
							$poll['optionsType'],$poll['sharedWith'],$hasVoted,$optionsAndVotes,$pollCreationTime,$pollStatus,$isOwner,$isSAC,$poll['approvalStatus']);
		return $pollObj;
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getEventObject($event,$userId)
	{
		if(stripos($event['attenders'], $userId)===false)
		{
			$isAttender=-1;
		}
		else
		{
			$isAttender=1;
		}

		$eventStatus=getEventStatus($event,$isAttender);

		$eventUserId=$event['userId'];

		if($eventUserId==$userId)
		{
			$eventOwner=1;
		}
		else
		{
			$eventOwner=-1;
		}

		$eventTime=$event['eventTime'];

		$rawTime=changeToRawTimeFormat($eventTime);

		$eventDate=$event['eventDate'];

		$rawDate=changeToRawDateFormat($eventDate);

		$eventCreationTime=toTimeAgoFormat($event['timestamp']);

		$rawSharedWith=changeToRawSharedWith($event['sharedWith']);

		$proPicLocation=__DIR__.'/../img/proPics/'.$event['userIdHash'].'.jpg';

		if(file_exists($proPicLocation))
		{
			$proPicExists=1;
		}
		else
		{
			$proPicExists=-1;
		}
		$isCOCAS=-1;
		if($userId==COCAS && $event['eventCategory']=="technical")
			$isCOCAS=1;
		else if($userId==CULSEC && $event['eventCategory']=="nonTechnical")
			$isCOCAS=1;
		else
			$isCOCAS=-1;
		
		if($event['approvalStatus']==0)
		{
			$isApproved=-1;
		}
		else
		{
			$isApproved=1;
		}
	
		$eventObj=new miniEvent($event['eventIdHash'],$event['organisedBy'],$event['eventName'],$event['type'],$event['content'],$rawDate,$rawTime,$event['eventVenue'],$event['attendCount'],$rawSharedWith, $event['seenCount'],$eventOwner,$isAttender,$event['eventDurationHrs'],$event['eventDurationMin'],$eventStatus,$eventCreationTime,$isCOCAS,$isApproved,$event['eventCategory']);
		
		return $eventObj;
	}


//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	function getPostObjectWithFewComments($post,$userId,$commentCount=3)
	{
		$conn=new QoB();

		$postValidity=($post['lifetime']-$post['timestamp'])/86400;

		$postCreationTime=toTimeAgoFormat($post['timestamp']);

		if(stripos($post['followers'],$userId)===false)
		{
			$followPost=1;
		}
		else
		{
			$followPost=-1;
		}

		if($post['userId']==$userId)
		{
			$postOwner=1;
		}
		else
		{
			$postOwner=-1;
		}

		$hasStarred=isThere($post['starredBy'],$userId);

		$postComments=getFewCommentsByPostId($post['postId'],$commentCount);

		$comments=array();

		if($postComments!=false)
		{
			while ($record=$conn->fetch($postComments))
			{
				//var_dump($record);
				$comments[]=getCommentObject($record,$userId,$post['postIdHash']);
			}
			//var_dump($comments);
		}

		$proPicLocation=__DIR__.'/../img/proPics/'.$post['userIdHash'].'.jpg';

		if(file_exists($proPicLocation))
		{
			$proPicExists=1;
		}
		else
		{
			$proPicExists=-1;
		}

		if($post['isPermanent']==0)
		{
			if($post['requestPermanence']==1)
			{
				$postValidity=9999;
			}
		}

		$postObj=new miniPost($post['postIdHash'],$post['sharedWith'],$postValidity,$post['alias'],$post['subject'],$post['content'], $post['starCount'],$post['commentCount'], $post['mailCount'],$post['seenCount'],$postCreationTime,$followPost,$post['userIdHash'],$post['userId'],$hasStarred, $comments,$postOwner,$post['gender'],$proPicExists,$post['name'],$post['isPermanent']);

		return $postObj;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getPostObjectWithAllComments($post,$userId)
	{
		$conn=new QoB();

		$postValidity=($post['lifetime']-$post['timestamp'])/86400;

		$postCreationTime=toTimeAgoFormat($post['timestamp']);

		if(stripos($post['followers'],$userId)===false)
		{
			$followPost=1;
		}
		else
		{
			$followPost=-1;
		}
		if($post['userId']==$userId)
		{
			$postOwner=1;
		}
		else
		{
			$postOwner=-1;
		}
		$hasStarred=isThere($post['starredBy'],$userId);

		$postComments=getAllCommentsByPostId($post['postId']);

		$comments=array();

		if($postComments!=false)
		{
			while ($record=$conn->fetch($postComments))
			{
				//var_dump($record);
				$comments[]=getCommentObject($record,$userId,$post['postIdHash']);
			}
		}
		$proPicLocation=__DIR__.'/../img/proPics/'.$post["userIdHash"].'.jpg';

		if(file_exists($proPicLocation))
		{
			$proPicExists=1;
		}
		else
		{
			$proPicExists=-1;
		}

		if($post['isPermanent']==0)
		{
			if($post['requestPermanence']==1)
			{
				$postValidity=9999;
			}
		}

		$postObj=new miniPost($post['postIdHash'],$post['sharedWith'],$postValidity,$post['alias'],$post['subject'],$post['content'], $post['starCount'],$post['commentCount'], $post['mailCount'],$post['seenCount'],$postCreationTime,$followPost,$post['userIdHash'],$post['userId'],$hasStarred, $comments,$postOwner,$post['gender'],$proPicExists,$post['name'],$post['isPermanent']);
		
		return $postObj;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	//Requires comment object with details of the user as well( i.e. result of a join on users and comment tables)
	function getCommentObject($comment,$receiverUserId,$commentPostIdHash)
	{
		$commentTime=toTimeAgoFormat($comment['timestamp']);
		
		if($receiverUserId==$comment['userId'])
		{
			$commentOwner=1;
		}
		else
		{
			$commentOwner=-1;
		}
		
		$proPicLocation=__DIR__.'/../img/proPics/'.$comment['userIdHash'].'.jpg';
		
		if(file_exists($proPicLocation))
		{
			$proPicExists=1;
		}
		else
		{
			$proPicExists=-1;
		}
		
		$commentObj=new miniComment($commentPostIdHash,$comment['userIdHash'],$comment['content'],$commentTime,
								$comment['commentIdHash'],$comment['userId'],$comment['alias'], $commentOwner, $comment['gender'], $proPicExists,$comment['name']);
		
		return $commentObj;
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	//Object Type 500-Post,600-Event, 700-Poll,0-Miscellaneous
	function sendNotification($fromUserId,$toUserIds,$notifType,$objectId,$objectType)
	{
		$conn=new QoB();
		
		$FetchMaxNotifIDSQL="SELECT MAX(notificationId) as maxNotificationId FROM notifications";
		
		$maxNotificationID=$conn->fetchALL($FetchMaxNotifIDSQL,false);
		
		if($conn->error!=""||$maxNotificationID=="")
		{
			notifyAdmin("Conn.Error.:".$conn->error."!In create notification!!",$userId);
			echo 12;
			exit();
		}
		
		$eId=$maxNotificationID['maxNotificationId'];
		
		if($eId==NULL)
		{
			$notificationId=1;
		}
		else
		{
			$notificationId=$eId+1;
		}
		$timestamp=time();
		
		$toUserIds=explode(',',$toUserIds);
		
		$conn->startTransaction();

		foreach ($toUserIds as $userId) 
		{
			// notifyAdmin("Just Testing notif.:".$fromUserId."!In create notification2!!",$userId);
			if($fromUserId!=$userId)
			{
				
				$notificationIdHash=hash("sha512",$notificationId.HASHNOTIF);

				if($objectType==500)
				{
					$objectIdHash=hash("sha256",$objectId.POCHASH);
				}
				else if($objectType==600)
				{
					$objectIdHash=hash("sha224",$objectId.POEVHASH);
				}
				else if($objectType==700)
				{
					$objectIdHash=hash("sha224",$objectId.POLLHASH);
				}
		
				$sendNotificationSQL="INSERT INTO notifications(objectId,type,objectType,userId,timestamp,notificationId,notificationIdHash) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE actionCount= CASE WHEN seen=0 THEN actionCount+1 WHEN seen=1 THEN 1 END, seen=0";
		    	
		    	$values[0]=array($objectIdHash => 's');
		    	
		    	$values[1]=array($notifType => 'i');
		    	
		    	$values[2]=array($objectType => 's');
		    	
		    	$values[3]=array($userId => 's');
		    	
		    	$values[4]=array($timestamp => 's');
		    	
		    	$values[5]=array($notificationId => 's');
		    	
		    	$values[6]=array($notificationIdHash => 's');
		    	
		    	/*$values[7]=array($objectId => 's');
		    	
		    	$values[8]=array($notifType => 'i');
		    	
		    	$values[9]=array($objectType => 's');
		    	
		    	$values[10]=array($userId => 's');*/
		    	
		    	$result=$conn->update($sendNotificationSQL,$values);
		    	
		    	if($conn->error!=""&&$result!=true)
		    	{
		    		
					$cr=$conn->error;

					$conn->rollbackTransaction();

					notifyAdmin("Conn.Error:".$cr."! In sending notifications for object id:".$objectId." , notif type: ".$notifType.", to userId:".$userId.", FromUserId:".$fromUserId,$userId);
					
					return false;

		    	}
		    	else
		    	{
		    		//return true;
				
					//affected rows = 2 if an update occurs, 1 if an insert occurs
		    		if(($rows=$conn->getAffectedRows())==1)
					{
						$notificationId++;
					}
		    	}
		    	//$notificationId++;
		    	//echo "notifid:".$notificationId;
			}
			
		}

		$conn->completeTransaction();
		return true;
		
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

function resetNotification($fromUserId,$toUserIds,$notifType,$objectId,$objectType)
	{
		$conn=new QoB();
		
		$FetchMaxNotifIDSQL="SELECT MAX(notificationId) as maxNotificationId FROM notifications";
		
		$maxNotificationID=$conn->fetchALL($FetchMaxNotifIDSQL,false);
		
		if($conn->error!=""||$maxNotificationID=="")
		{
			notifyAdmin("Conn.Error.:".$conn->error."!In create notification!!",$userId);
		
			echo 12;
		
			exit();
		}
		
		$eId=$maxNotificationID['maxNotificationId'];
		
		if($eId==NULL)
		{
			$notificationId=1;
		}
		else
		{
			$notificationId=$eId+1;
		}
		$timestamp=time();
		
		$toUserIds=explode(',',$toUserIds);
		
		foreach ($toUserIds as $userId) 
		{
			if($fromUserId!=$userId)
			{		
				$notificationIdHash=hash("sha512",$notificationId.HASHNOTIF);
			
				$sendNotificationSQL="INSERT INTO notifications(objectId,type,objectType,userId,timestamp,notificationId,notificationIdHash) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE seen=0";

		    	$values[0]=array($objectId => 's');

		    	$values[1]=array($notifType => 'i');

		    	$values[2]=array($objectType => 's');

		    	$values[3]=array($userId => 's');

		    	$values[4]=array($timestamp => 's');

		    	$values[5]=array($notificationId => 's');

		    	$values[6]=array($notificationIdHash => 's');
		    	
		    	/*$values[7]=array($objectId => 's');

		    	$values[8]=array($notifType => 'i');

		    	$values[9]=array($objectType => 's');

		    	$values[10]=array($userId => 's');*/
		    			    	
		    	$result=$conn->update($sendNotificationSQL,$values);
		    	
		    	if($conn->error!=""&&$result!=true)
		    	{
		    	
		    		notifyAdmin("Conn.Error:".$conn->error."! In sending notifications for object id:".$objectId." , notif type: ".$notifType.", to userId:".$userId.", FromUserId:".$fromUserId,$userId);
				
					return false;

		    	}
		    	else
		    	{
		    		//return true;
					//affected rows = 2 if an update occurs, 1 if an insert occurs
		    		if(($rows=$conn->getAffectedRows())==1)
					{
						$notificationId++;
					}
		    	}
		    	//$notificationId++;
		    	//echo "notifid:".$notificationId;
			}
			
		}
		
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//
	
	function readNotifications($userId,$displayedNotifArray)
	{
		$notifCount=count($displayedNotifArray);
		
		if($notifCount!=0)
		{
			$conn=new QoB();
		
			$i=0;
		
			$notificationReadSQL="UPDATE notifications SET seen=1 WHERE userId= ? AND ( notificationIdHash = ?";
		
			$values[0]=array($userId =>'s');
		
			$values[1]=array($displayedNotifArray[$i] => 's');
		
			for($i=0;$i<$notifCount-1;$i++)
			{
				$notificationReadSQL.=" OR notificationIdHash= ?";
		
				$values[$i+2]=array($displayedNotifArray[$i+1]=>'s');
			}
		
			$notificationReadSQL.=" )";
		
			//echo $notificationReadSQL;
		
			$result=$conn->update($notificationReadSQL,$values);
			
			if($conn->error==""&&$result==true)
			{
				return true;
			}
			else
			{
				notifyAdmin("Conn.Error:".$conn->error."! In updating Notifications for userId:".$userId,$userId);
				return false;
			}	
		}		
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function getNotifications($userId,$displayedNotifArray)
	{
		/* Types of Notifications:

		1-starredYourPost
		2-commentedOnYourPost
		3-alsoCommentedOnPost
		4-mailedYourPost
		5-commentedOnPostYouMailed
		6-reportSpamReply
		7-attendingYourEvent
		8-alsoAttendingEvent
		9-answeredYourPoll
		10-alsoAnsweredPoll
		11-approvedEvent
		12-notApprovedEvent
		13-approvedPoll
		14-notApprovedPoll
		answeredYourThread
		alsoAnsweredOnThread
		upvotedYourThreadAnswer
		commentedOnYourThread
		alsoCommentedOnThread
		commentedOnYourThreadAnswer
		alsoCommentedOnThreadAnswer*/
		$conn = new QoB();
		
		$displayedNotifCount=count($displayedNotifArray);
		
		$notificationModels[0]=array("You have no notifications yet!",0);
		
		$notificationModels[1]=array(" star for your Post"," members starred your Post");
		
		$notificationModels[2]=array(" new comment on your Post", " new comments on your Post");
		
		//$notificationModels[3]=array(" new comment on the post you have commented "," new comments on the post you have commented");
		
		$notificationModels[3]=array(" member also commented on the post  "," members also commented on the post ");
		
		$notificationModels[4]=array(" member mailed your post"," members mailed your post");
		
		$notificationModels[5]=array(" new comment on the post you mailed"," new comments on the post you mailed");
		
		$notificationModels[6]=array(" The post has been removed as you requested.","The post was not removed due to lack of substantial reason.");
		
		$notificationModels[7]=array(" member is attending your event"," members are attending your event");
		
		$notificationModels[8]=array(" more person is also attending the event you are attending"," more members are also attending the event you are attending ");
		
		$notificationModels[9]=array(" member voted your poll"," members voted your poll");
		
		$notificationModels[10]=array(" member also answered the poll you answered"," members also answered the poll you answered");
		
		$notificationModels[11]=array(" of your event has been approved .", " Error in Notif. Code 11. Kindly intimate Admin if seen.");
		
		$notificationModels[12]=array(" of your event has been rejected.", " Error in Notif. Code 12 .Kindly intimate Admin if seen. ");
		
		$notificationModels[13]=array(" of your poll has been approved.", " Error in Notif. Code 13 .Kindly intimate Admin if seen.");
		
		$notificationModels[14]=array(" of your poll has been rejected.", " Error in Notif. Code 14. Kindly intimate Admin if seen.");

		$notificationModels[15]=array(" new event is awaiting your approval", " Error in Notif. Code 15.  Kindly intimate Admin if seen.");

		$notificationModels[16]=array(" new poll is awaiting your approval", " Error in Notif. Code 16. Kindly intimate Admin if seen.");



		$notificationFetchSQL="SELECT `notifications`.*, CASE objectType WHEN 500 THEN post.subject WHEN 600 THEN `event`.eventName WHEN 700 THEN `poll`.question END AS label FROM `notifications`  LEFT JOIN `post` ON (`notifications`.objectType=500 AND `notifications`.objectId=`post`.postIdHash) LEFT JOIN `event` ON (`notifications`.objectType=600 AND `notifications`.objectId=`event`.eventIdHash) LEFT JOIN `poll` ON (`notifications`.objectType=700 AND `notifications`.objectId=`poll`.pollIdHash) WHERE notifications.userId=? ";
		//$notificationFetchSQL="SELECT `notifications`.*, `post`.subject AS label FROM `notifications`  INNER JOIN `post` ON (`notifications`.objectType=500 AND `notifications`.objectId=`post`.postIdHash) WHERE notifications.userId = ? UNION SELECT `notifications`.*,  `event`.eventName AS label FROM `notifications`  INNER JOIN `event` ON (`notifications`.objectType=600 AND `notifications`.objectId=`event`.eventIdHash) WHERE notifications.userId = ? UNION (SELECT `notifications`.*,  `poll`.question AS label FROM `notifications`  INNER JOIN `poll` ON (`notifications`.objectType=700 AND `notifications`.objectId=`poll`.pollIdHash) WHERE notifications.userId=? )";
		
		$values[0]=array($userId => 's');
		/*$values[1]=array($userId => 's');
		$values[2]=array($userId => 's');*/
		
		for($i=0;$i<$displayedNotifCount;$i++)
		{
			$notificationFetchSQL .= "AND notificationIdHash != ? ";
			
			$values[$i+1]=array($displayedNotifArray[$i] => 's');
		}
		$notificationFetchSQL .= "ORDER BY timestamp LIMIT 0,7";
		//echo $notificationFetchSQL;
		//var_dump($values);
		$result=$conn->select($notificationFetchSQL,$values);
		//var_dump($result);
		if($conn->error=="")
		{
			$displayCount=0;
			
			$notificationObjArray=array();
			
			while(($notif=$conn->fetch($result))&&$displayCount<7)
			{
				if($notif['actionCount']==1)
				{
					$notification=$notif['actionCount'].$notificationModels[(int)$notif['type']][0];
				}
				else
				{
					$notification=$notif['actionCount'].$notificationModels[(int)$notif['type']][1];
				}
				
				$notifObject=new miniNotification($notif['notificationIdHash'],$notification,$notif['type'],$notif['objectId'],$notif['objectType'],$notif['timestamp'],$notif['seen'],$notif['label']);
				//print_r($notifObject);
			
				$notificationObjArray[]=$notifObject;
				//var_dump($notifObject);
				$displayCount++;
			}
			if($displayCount==0)
			{
				return false;
			}
			else
			{
				return $notificationObjArray;
			}
		}
		else
		{
			notifyAdmin("Conn.Error:".$conn->error."! In sending notifications for object id:".$objectId." , notif type: ".$notifType.", to userId:".$userId.", FromUserId:".$fromUserId,$userId);
			return 12;
		}

	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//

	function newValidateSharedWith($str)
	{
		$conn=new QoB();
		
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array('_____'.$str.'___'=>'s');
			
			$result=$conn->fetchALL($sql,$values,true);
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}	
		}
		else if(strlen($str)==2){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array('___'.$str.'____'=>'s');
			
			$result=$conn->fetchALL($sql,$values,true);
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}			
		}
		else if(strlen($str)==3){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array('___'.$str.'___'=>'s');
			
			$values1[0]=array($str.'______'=>'s');
			
			$storeString2='^'.$str.'......$';
			
			$result=$conn->fetchALL($sql,$values,true);
			//
			if($conn->error!=''){
			
				notifyAdmin("Conn.Error".$conn->error."In validate Shared With1",$userId);
				//echo $conn->error;
				return "Invalid";
			}
			else{
			
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					$result2=$conn->fetchALL($sql,$values1,true);
			
					if($conn->error!=""){
						notifyAdmin("Conn.Error".$conn->error."In validate Shared With2",$userId);
						//echo $conn->error;
						return "Invalid";
					}
					else{
						if($result2>=1){
							//echo "Accepted";
							return $str;
						}
						else
						{
							//echo "here";
							return "Invalid";
						}
					}
				}
			}		
		}
		else if(strlen($str)==4){
			$divide=str_split($str);
			
			$searchString=$divide[0].$divide[1].$divide[2]."__".$divide[3];
			
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array($searchString.'___'=>'s');
			
			$result=$conn->fetchALL($sql,$values,true);
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==5){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array($str.'____'=>'s');
			
			$result=$conn->fetchALL($sql,$values,true);
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==6){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[0]=array($str.'___'=>'s');
			
			$result=$conn->fetchALL($sql,$values,true);
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					return $str;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else{
			return "Invalid";
		}
	}

//****************************************************************************************************************//
//****************************************************************************************************************//
//****************************************************************************************************************//


	/*function notifyPeople($toBeNotified,$objectId,$from,$type)
	{
		if($toBeNotified!="")
		{

			$list=explode(',', $toBeNotified);
			foreach ($list as $userId)
			{
				$InsertNotificationSQL="IF EXISTS(SELECT * FROM notifications WHERE objectId= ? and type=?) 
											UPDATE notifications SET message=?, ";
			}
		}
	}*/
//---------Examples, old functions and Test Code Executed On Online Compiler Starts------------------------------ 

/*function validateSharedWith($str)
	{
		$regstr;
		$conn=new QoB();
		
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.....".$str."...$";
			$values[0]=array('_____'.$str.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}	
		}
		else if(strlen($str)==2){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^...".$str."....$";
			$values[0]=array('___'.$str.'____'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}			
		}
		else if(strlen($str)==3){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array('___'.$str.'___'=>'s');
			$storeString1='^...'.$str.'...$';
			$values1[0]=array($str.'______'=>'s');
			$storeString2='^'.$str.'......$';
			$result=$conn->fetchALL($sql,$values,true);
			//
			if($conn->error!=''){
				notifyAdmin("Conn.Error".$conn->error."In validate Shared With1",$userId);
				//echo $conn->error;
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString1;
					return $regstr;
				}
				else
				{
					$result2=$conn->fetchALL($sql,$values1,true);
					if($conn->error!=""){
						notifyAdmin("Conn.Error".$conn->error."In validate Shared With2",$userId);
						//echo $conn->error;
						return "Invalid";
					}
					else{
						if($result2>=1){
							//echo "Accepted";
							$regstr=$storeString2;
							return $regstr;
						}
						else
						{
							//echo "here";
							return "Invalid";
						}
					}
				}
			}		
		}
		else if(strlen($str)==4){
			$divide=str_split($str);
			$searchString=$divide[0].$divide[1].$divide[2]."__".$divide[3];
			$storeString='^'.$divide[0].$divide[1].$divide[2]."..".$divide[3]."...$";
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($searchString.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==5){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($str.'____'=>'s');
			$storeString="^".$str."....$";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else if(strlen($str)==6){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[0]=array($str.'___'=>'s');
			$storeString="^".$str."...$";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if($result>=1){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		}
		else{
			return "Invalid";
		}
	}//END OF validateSharedWith Function!!!!!!*/

/*$regex="^.{3}$";
$word="boys";
if(ereg($regex,$word))
{
	echo 1;
}
else
{
	echo 2;
}	

$regex="([0-9\^\$\{\}\.]+)";
$word="^.{3}COE.{3}$";
$word2=ereg_replace($regex,'',$word);
echo $word2;*/

//$arr2 = str_split($str, 3);		

/*
    $a1 = array("1","2","3");
    $a2 = array("a");
    $a3 = array();
   
    echo "a1 is: '".implode("','",$a1)."'<br>";
    echo "a2 is: '".implode("','",$a2)."'<br>";
    echo "a3 is: '".implode("','",$a3)."'<br>";


will produce:
===========
a1 is: '1','2','3'
a2 is: 'a'
a3 is: ''*/

/*$time="21-10-21";
$timeRegex="([-]+)";
$eventTime=ereg_replace($timeRegex,'',$time);
echo $eventTime;
$nTime=str_split($eventTime,2);
print_r($nTime);
$rawTime=implode("-",$nTime);
echo $rawTime;

<?php
$str="COE12B013";
//echo $str[2];
$str=str_split($str);
$year=array_slice($str,3,2);
var_dump($year);
?>*/
?>
