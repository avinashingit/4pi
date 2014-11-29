<?php
	require_once('../QOB/qob.php');
	require_once('../fetch.php');
/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
Code 10: MailError!!
*/
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in unfollowPost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		return 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash)==false)
		{
			notifyAdmin("Critical Error!! in unfollowPost!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			return 13;
		}
		else
		{

			$postIdHash=$_POST['_postId'];
			if(($post=getPostFromHash($postIdHash)==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In unfollowPost");
				$_SESSION=array();
				session_destroy();
				return 13;
			}
			else
			{
				$followers=$post['followers'];
				$userId=$user['userId'];
				if(strpos($followers, $userId)==true)
				{
					$splitfollowers=explode(",", $followers);
					foreach ($splitfollowers as $nusers) {
						if($nusers!=$userId)
						{
							if($nfollowers="")
							{
								$nfollowers=$userId;
							}
							else
							{
								$nfollowers=$nfollowers.",".$nuserId;
							}
						}
					}

					
					$UpdatePostSQL="UPDATE post WHERE postIdHash= ? SET followers = ?"
					$values[]=array($postIdHash => 's');
					$values[]=array($nfollowers => 's');
					$result=$conn->update($UpdatePostSQL,$values)
					if($conn->error==""&&$result==true)
					{
						return 3;
					}
					else
					{
						return 12;
					}
				}
				else
				{
					notifyAdmin("Suspicious unfollow Attempt in unfollowPost",$userId);
					$_SESSION=array();
					session_destroy();
					return 13;
				}
			}
		}
	}

?>