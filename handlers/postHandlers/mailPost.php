<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
	//Testing Inputs Start
///$userIdHash=$_SESSION['vj']=hash("sha512","COE12B009".SALT);
// 	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
//  $_POST['_postId']="16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1";
// 	//Testing Inputs End
// $_POST['_emailId']="COE12B009@iiitdm.ac.in";
// Code 3: SUCCESS!!
// Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
// Code 12: Database ERROR!!
// Code 16: Erroneous Entry By USER!!
// Code 10: MailError!!
// Code 1: Mailed Again By an Old user.

	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in mailPost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in MailPost!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{

			$postIdHash=$_POST['_postId'];
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with PostIdHash!! In MailPost");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$postId=$post['postId'];
				$userId=$user['userId'];
				//validation needed
				$emailId=$_POST['_emailId'];
				//validation
				$subject="Mail Post Request for '".$post['subject']."' By '".$user['name']."'";
				$content=$post['content'];
				$attachments=$post['filesAttached'];
				if(mailContent($emailId,$content,$subject,$attachments)==true)
				{
					$mailedBy=$post['mailedBy'];
					$mailCount=$post['mailCount'];
					if(stripos($mailedBy, $userId)===false)
					{
						if($mailedBy=="")
						{
							$mailedBy=$userId;
						}
						else
						{
							$mailedBy=$mailedBy.",".$userId;
						}
						$mailCount=$mailCount+1;
						$date = date_create();
							
						$mailToIndexUpdated = ($post['mailToIndex'] + date_timestamp_get($date))/2;
						$mailToIndexUpdated="".$mailToIndexUpdated;	
						$impIndexUpdated = $post['likeIndex'] + 2 * $mailToIndexUpdated;
						$impIndexUpdated="".$impIndexUpdated;	
						$values2 = array( 0 => array($mailToIndexUpdated => 's'), 1 => array($impIndexUpdated => 's'), 2 => array($mailedBy =>'s'), 3 =>array($mailCount => 'i'), 4 => array($postId => 's'));
							
						$result2 = $conn->update("UPDATE post SET mailToIndex = ? ,impIndex = ?, mailedBy = ?, mailCount = ? WHERE postId = ? ",$values2,false);
						if($conn->error==""&&$result2==true)
						{
							print_r(json_encode($mailCount));
						}
						else
						{
							notifyAdmin("Conn.Error: ".$conn->error."! In Updating Post In mailPost. PostId:".$postId,$userId);
							echo 12;
						}
					}
					else
					{
						echo 1;
					}


					
				}
				else
				{
					echo 10;
				}
			}

		}

	}
//fetch post



//update Post


//call mailtoindex and impindex updaters

?>