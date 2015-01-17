<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');

//testing inputs begin
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B011".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="002c5f4230c72e4696a68f63591abc7c0678fc73e4ded86e5fba21d7204b416a4e6c139fd1a0635af9b005afefd6effc7b6bab5f01a2bbad72ce32fde69eedf0";*/

//testing inputs end

/*
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task!
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

	
$conn=new QoB();
$postIdHash=$_POST['_postId'];
$userIdHash=$_SESSION['vj'];
//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in StarPost");
		
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! in Star Post");
				
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				//fetch post
				$post=getPostFromHash($postIdHash);
				if($post==false)
					{
						//Detected tampered postIdHash
						blockUserbyHash($userIdHash,"Meddling with postIdHash in star Post","Post Id:",$post['postId']);
						
						$_SESSION=array();
						session_destroy();
						echo 13;
					}
					else
					{
						$postId=$post['postId'];
						$starCount=$post['starCount'];
						$starredBy=$post['starredBy'];
						$userId=$user['userId'];
						if(stripos($starredBy,$userId)===false)
						{
						
							//update post
							if($starredBy=="")
							{
								$starredBy=$starredBy.$userId;
							}
							else
							{
								$starredBy=$starredBy.",".$userId;
							}
							$followers=$post['followers'];
							/*if(stripos($followers,$userId)===false)
							{
								if($followers=="")
								{
									$followers=$userId;
								}
								else
								{
									$followers=$followers.",".$userId;
								}
							}*/
							$starCount=$starCount+1;
							$date = date_create();
							
							//$likeIndexUpdated = ($post['likeIndex'] + date_timestamp_get($date))/2;
							$likeIndexUpdated=($post['likeIndex']+time())/2;
							
							//secho $likeIndexUpdated." is uli";

							$popularityIndexUpdated = $likeIndexUpdated + 1.4 * ($post['commentIndex']);
							
							//echo $popularityIndexUpdated." is upi";
							$impIndexUpdated = $likeIndexUpdated + 2 * ($post['mailToIndex']);
							$impIndexUpdated="".$impIndexUpdated;
							$likeIndexUpdated="".$likeIndexUpdated;
							$popularityIndexUpdated="".$popularityIndexUpdated;
							
							//echo $impIndexUpdated." is uii";
							$values2 = array(0 => array($likeIndexUpdated => 's'), 1 => array($popularityIndexUpdated => 's'), 2 => array($impIndexUpdated => 's'), 3 => array($starCount => 'i'), 4 => (array($starredBy => 's')),  5 => array($postIdHash => 's'));
							
							$result2 = $conn->update("UPDATE post SET likeIndex = ?, popularityIndex = ?, impIndex = ?, starCount= ? ,starredBy= ? WHERE postIdHash = ?",$values2);
							
							//$StarPostSQL="UPDATE post WHERE postIdHash = ? SET starCount= ? ,starredBy= ? ";
							if($conn->error == ""&&$result2==true)
								{
									//echo 'Updated successfully Mode 1<br />';
									sendNotification($userId,$post['userId'],1,$post['postId'],500);									
									echo json_encode($starCount);
								}
							
							else
								{
									//echo 'Error in Query 2 of Mode 1<br />';
									//echo $conObj->error;
									notifyAdmin("Conn.Error:".$conn->error."! In Updating Posts in starPost.".$postId,$userId);
									echo 12;
								}
						}
						else
						{
							//Detected an attempt to Increase StarCount;
							/*blockUserbyHash($_SESSION['vj'],"Tampering the StarCount!",$postId);
							
							$_SESSION=array();
							session_destroy();*/
							echo 5;
						}
					}
				
				
			}
		}





//call likeindex and popularity index updater
?>