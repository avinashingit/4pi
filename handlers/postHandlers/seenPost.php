<?php
session_start();
require_once('../../QOB/qob.php');
require_once('postupdater.php');
require_once('../fetch.php');
//testing inputs begin
/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B017".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a";
*/
//testing inputs end

//1 if already noted, 2 if updated, -1 in case of failure.

$conn = new QoB();
$userIdHash=$_SESSION['vj'];
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in seenPost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		if(($user=getUserFromHash($userIdHash))==false)
		{
			notifyAdmin("Critical Error!! in seenPost!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{
			$userId=$user['userId'];
			$postIdHash=$_POST['_postId'];
			if(($post=getPostFromHash($postIdHash))===false)
			{
				blockUserByHash($userIdHash,"Messing with PostIdHash!! In Seenpost");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$seenBy=$post['seenBy'];
				$seenCount=$post['seenCount'];
				$postId=$post['postId'];
				//$user=getUserFromHash($userIdHash);
				
				if(stripos($seenBy,$userId)!==false)
				{
					echo 1;
				}
				else
				{
					//update seenCount and seenBy
					if($seenBy=="")
					{
						$seenBy=$userId;
					}
					else
					{
						$seenBy=$seenBy.",".$userId;
					}
					$seenCount=$seenCount+1;
					$UpdateSeenSQL="UPDATE post SET seenBy = ? WHERE postIdHash = ? ";
					$values[0]=array($seenBy=>'s');
					$values[1]=array($postIdHash=>'s');
					$result=$conn->update($UpdateSeenSQL,$values);
					if($conn->error==""&&$result==true)
					{
						echo 2;
					}
					else
					{
						notifyAdmin("Conn.Error:".$conn->error." in Updating Post in seenPost. ".$postId,$userId);
						echo -1;
					}

				}
			}

			
		}


		
	}
?>