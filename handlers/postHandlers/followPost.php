<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
//testing Inputs start
/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B016".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
 $_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";
*/
//Testing Inputs End
/*
Code 3: SUCCESS!!
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