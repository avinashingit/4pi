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
		notifyAdmin("Suspicious session variable in followPost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		return 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in followPost!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			return 13;
		}
		else
		{

			$postIdHash=$_POST['_postId'];
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In followPost");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$postId=$post['postId'];
				$followers=$post['followers'];
				$userId=$user['userId'];
				if(stripos($followers, $userId)===false)
				{
					if($followers="")
					{
						$followers=$userId;
					}
					else
					{
						$followers=$followers.",".$userId;
					}
					$UpdatePostSQL="UPDATE post SET followers = ? WHERE postIdHash= ? ";
					
					$values[0]=array($followers => 's');
					$values[1]=array($postIdHash => 's');
					$result=$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true)
					{
						echo 3;
					}
					else
					{
						notifyAdmin("Conn.Error:".$conn->error."in Updating Post. In followpost".$postId,$userId);
						return 12;
					}
				}
				else
				{
					/*notifyAdmin("Suspicious follow Attempt in followPost.".$postId,$userId);
					$_SESSION=array();
					session_destroy();
					return 13;*/
					$nfollowers="";
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
					$UpdatePostSQL="UPDATE post SET followers = ? WHERE postIdHash= ? ";
					
					$values[0]=array($nfollowers => 's');
					$values[1]=array($postIdHash => 's');
					$result=$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true)
					{
						return 3;
					}
					else
					{
						notifyAdmin("Conn.Error:".$conn->error."in Updating Post. In unfollowpost".$postId,$userId);
						return 12;
					}
				}
			}
		}
	}

?>