<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once("../../PHPMailer_v5.1/class.phpmailer.php");
	require_once('../fetch.php');
	//Testing Inputs Start
/*$userIdHash=$_SESSION['vj']=hash("sha512","COE11B005".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
 $_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";*/
	//Testing Inputs End

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
				notifyAdmin("Suspicious postIdHash in mailPost",$userId.",sh:".$postIdHash);
				echo 6;
				exit();
			}
			else
			{
				$postId=$post['postId'];
				$userId=$user['userId'];
				//validation needed
				$emailId=$_POST['_email'];
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
					}
					$followers=$post['followers'];
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
					$mailCount=$mailCount+1;
					$date = date_create();
						
					$mailToIndexUpdated = ($post['mailToIndex'] + date_timestamp_get($date))/2;
					$mailToIndexUpdated="".$mailToIndexUpdated;	
					$impIndexUpdated = $post['likeIndex'] + 2 * $mailToIndexUpdated;
					$impIndexUpdated="".$impIndexUpdated;	
					$values2 = array( 0 => array($mailToIndexUpdated => 's'), 1 => array($impIndexUpdated => 's'), 2 => array($mailedBy =>'s'), 3 =>array($mailCount => 'i'), 4 => array($followers => 's'), 5 => array($postId => 's'));	
					$result2 = $conn->update("UPDATE post SET mailToIndex = ? ,impIndex = ?, mailedBy = ?, mailCount = ?, followers=? WHERE postId = ? ",$values2,false);
					if($conn->error==""&&$result2==true)
					{
						sendNotification($userId,$followers,3,$postId,500);
						sendNotification($userId,$post['userId'],4,$postId,500);
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
					echo 10;
				}
			}

		}

	}
//fetch post



//update Post


//call mailtoindex and impindex updaters

?>