<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');
//testing inputs begin
	// $_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";

//testing inputs end

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
		notifyAdmin("Suspicious session variable in hidePost",$userIdHash);
		//echo "Suspicious session variable in hidePost, ".$userIdHash;
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in hidePost!!",$userIdHash);
			//echo "Critical Error!! in hidePost!!".$userIdHash;
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{
			//print_r($user);
			$postIdHash=$_POST['_postId'];
			if(($post=getPostFromHash($postIdHash))==false)
			{
				//Detected tampered postIdHash
				notifyAdmin("Suspicious postIdHash in hidePost",$userId.",sh:".$postIdHash);
				echo 6;
				exit();
			}
			else
			{
				//print_r($post);
				//print_r($user);
				$postId=$post['postId'];
				$hiddenTo=$post['hiddenTo'];
				$userId=$user['userId'];
				//echo $hiddenTo." is the existing hiddenTo ";
				//echo $userId." is the userId ";
				if(stripos($hiddenTo,$userId)===false)
				{
					if($hiddenTo=="")
					{
						$hiddenTo=$userId;
					}
					else
					{
						$hiddenTo=$hiddenTo.",".$userId;
						//echo $hiddenTo." is the updated hiddenTo ";
					}
					$UpdatePostSQL="UPDATE post SET hiddenTo = ? WHERE postIdHash= ?";
					
					$values[0]=array($hiddenTo => 's');
					$values[1]=array($postIdHash => 's');
					$result=$conn->update($UpdatePostSQL,$values);
					if($conn->error==""&&$result==true)
					{
						echo 3;
					}
					else
					{

						notifyAdmin("Conn.Error:".$conn->error."in Updating Post. In hidepost".$postId,$userId);
						//echo "Conn.Error:".$conn->error."in Updating Post. In hidepost".$postId.",".$userId;
						echo 12;
					}
				}
				else
				{
					notifyAdmin("Suspicious Hide Attempt in HidePost",$userId);
					//echo "Suspicious Hide Attempt in HidePost,".$userId;
					$_SESSION=array();
					session_destroy();
					echo 13;
				}
			}
		}
	}

?>