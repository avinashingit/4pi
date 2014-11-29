<?php

	require("../../PHPMailer_v5.1/class.phpmailer.php");
	function postFetch($postid)
		{
			$conObj = new QoB();
			$values1 = array(0 => array($postid => 's'));
			$result1 = $conObj->fetchall("SELECT * FROM post WHERE postId = ?",$values1,false);
			if($conObj->error == "")
				{
					if($result1 != "")
						{
							$userId = $row2['userId'];
							$content = $row2['content'];
							$timestamp = $row2['timestamp'];
							$reportedBy = $row2['reportedBy'];
							$spamCount = $row2['spamCount'];
													
							$postId = $row2['postId'];
							$subject = $row2['subject'];
							$starCount = $row2['starCount'];
							$mailCount = $row2['mailCount'];
							$mailedBy = $row2['mailedBy'];
							
							$isPermanent = $row2['isPermanent'];
							$starredBy = $row2['starredBy'];
							$displayStatus = $row2['displayStatus'];
							$lastUpdated = $row2['lastUpdated'];
							$likeIndex = $row2['likeIndex'];
							
							$commentIndex = $row2['commentIndex'];
							$lifetime = $row2['lifetime'];
							$impIndex = $row2['impIndex'];
							$requestPermanence = $row2['$requestPermanence'];
							$popularityIndex = $row2['popularityIndex'];
							
							$followers = $row2['followers'];
							$hiddenTo = $row2['hiddenTo'];
							$filesAttached = $row2['filesAttached'];
							$commentCount = $row2['commentCount'];
							$mailToIndex = $row2['mailToIndex'];
							
							$taggedUsers = $row2['taggedUsers'];
							$seenBy = $row2['seenBy'];
							$seenCount = $row2['seenCount'];
							$sharedWith = $row2['sharedWith'];
							
							$postObj = new Post($userId,$subject,$content,$seenCount,$postId,$starCount,$mailCount,$commentCount,$timestamp,$reportedBy,$spamCount,$mailedby,$isPermanent,$starredBy,$displayStatus,$lastUpdated,$likeIndex,$commentIndex,$lifetime,$impIndex,
                                $requestPermanence,$popularityIndex,$followers,$hiddenTo,$filesAttached,$mailToIndex,$sharedWith,$seenBy,$taggedUsers);
							
							return $postObj;
						
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


		function isfollowing($hash,$follwers)
		{
			$followersarray = explode(',',$followers);
			$nooffollowers = count($followersarray);
			
			$output = 0;
			for($i = 0;$i<$nooffollowers;$i++)
				{
					if(strcmp($hash,$followersarray[$i]) == 0)
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

		function hiddenTo($userId,$hiddenTo)
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
		function hasStarred($userId,$starredBy)
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
		function blockUserByHash($userIdHash,$crime,$privateData="")
		{
			$conn=new QoB();
			$isActive=0;
			$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion) VALUES(?,?)";
			$UpdateUserSQL="UPDATE users SET isActive=? WHERE userIdHash= ?";
			$values[0]=array($isActive=>'i');
			$values[1]=array($userIdHash=>'s');
			$result=$conn->update($UpdateUserSQL,$values);
			if($conn->error==""&&$result==true)
			{
				$adminNotif="Blocked: ".$crime.",".$privateData;
				$user=getUserFromHash($userIdHash);
				//$userId=$user['userId'];
				$values1[0]=array($userIdHash =>'s');
				$values1[1]=array($adminNotif => 's');
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
		function notifyAdmin($notification,$userIdentity)
		{
			$conn=new QoB();
			$notification="Notify: ".$notification;
			$noteCrimeSQL="INSERT INTO suspicious (userId, suspicion) VALUES(?,?)";
			$values1[0]=array($userIdentity =>'s');
			$values1[1]=array($notification => 's');
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

		function mailContent($userId,$content,$subject,$attachments="")
		{
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "coe12b013@iiitdm.ac.in";  // GMAIL username
			$mail->Password   = "";            // GMAIL password

			$mail->From       = "4pi-IIIT D&M Kancheepuram";
			$mail->FromName   = "Admin @ 4pi-IIIT D&M Kancheepuram";
			$mail->Subject    = $subject;
			$mail->WordWrap   = 500; // set word wrap
			$mail->AddAddress($userId."@iiitdm.ac.in");
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
			$mail->IsHTML();
			if(!$mail->send())
			{
				notifyAdmin($mail->ErrorInfo."!!!! PostSubject: ".$subject,$userId);
				return false;
			}
			else
			{
				$mail->ClearAddresses();
				return true;
			}

		}

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

		function updatePostIndexesOnComment($postArray,$conn)
		{
			$postIdHash=$postArray['postIdHash'];
			$date = date_create();

			$commentCount=$postArray['commentCount'];
			$commentCount=$commentCount+1;
							
			$commentIndexUpdated = ($postArray['commentIndex'] + date_timestamp_get($date))/2;
							
			$popularityIndexUpdated = $postArray['likeIndex']+ 1.4 * $commentIndexUpdated;
							
			$values = array(0 => array($commentIndexUpdated => 'i'), 1 => array($popularityIndexUpdated => 'i'), 2 => array($commentCount => 'i'), 3 => array($postIdHash => 's'),);
							
			$result = $conn->update("UPDATE post SET commentIndex = ?, popularityIndex = ?,commentCount = ? WHERE postIdHash = ? ",$values);
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

		function changeToRawSharedWith($sharedWith)
		{
			$sharedWithRegex="([0-9\^\$\{\}\.]+)";
			$rawSharedWith=ereg_replace($sharedWithRegex, '', $sharedWith);
			return $rawSharedWith;
		}
		function changeToEventDateFormat($date)
		{
			$dateRegex="([-]+)";
			$eventDate=ereg_replace($dateRegex, '', $date);
			return $eventDate;
		}
		function changeToEventTimeFormat($time)
		{
			$timeRegex="([:]+)";
			$eventTime=ereg_replace($timeRegex, '', $time);
			return $eventTime;
		}
		function changeToRawDateFormat($eventDate)
		{
			$nDate=str_split($eventDate,2);
			$rawDate=implode("-",$nDate);
			return $rawDate;
		}

		function changeToRawTimeFormat($eventTime)
		{
			$nTime=str_split($eventTime,2);
			$rawTime=implode(":",$nTime);
			return $rawTime;
		}

		function isSharedTo($userId,$sharedWith)
		{
			$nSharedWith=explode(",",$sharedWith);
			foreach($nSharedWith as $exp)
			{
				if(ereg($exp,$userId))
				{
					return true;
				}
			}
			return false;
		}

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
//---------Examples and Test Code Executed On Online Compiler Starts------------------------------ 


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
echo $rawTime;*/
?>
