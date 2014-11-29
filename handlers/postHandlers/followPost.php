<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
//testing Inputs start
$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
 $_POST['_postId']="16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1";

//Testing Inputs End
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
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in followPost!!",$userIdHash);
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
				//echo "before".$followers;
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
					//echo "now".$followers;
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
						echo 12;
					}
				}
				else
				{
					/*notifyAdmin("Suspicious follow Attempt in followPost.".$postId,$userId);
					$_SESSION=array();
					session_destroy();
					echo 13;*/
					$nfollowers="";
					$splitfollowers=explode(",", $followers);
					foreach ($splitfollowers as $nusers) {
						if($nusers!=$userId)
						{
							if($nfollowers=="")
							{
								$nfollowers=$userId;
							}
							else
							{
								$nfollowers=$nfollowers.",".$nusers;
							}
						}
					}
					$UpdatePostSQL="UPDATE post SET followers = ? WHERE postIdHash= ? ";
					
					$values[0]=array($nfollowers => 's');
					$values[1]=array($postIdHash => 's');
					$result=$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true)
					{
						echo 3;
					}
					else
					{
						notifyAdmin("Conn.Error:".$conn->error."in Updating Post. In unfollowpost".$postId,$userId);
						echo 12;
					}
				}
			}
		}
	}

?>