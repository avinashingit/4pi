<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('../fetch.php');

//testing inputs begin
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B017".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_postId']="8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5";*/

//testing inputs end
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
							$starCount=$starCount+1;

							$date = date_create();
							
							//$likeIndexUpdated = ($post['likeIndex'] + date_timestamp_get($date))/2;
							$likeIndexUpdated=($post['likeIndex']+time())/2;
							$likeIndexUpdated="".$likeIndexUpdated;
							//secho $likeIndexUpdated." is uli";

							$popularityIndexUpdated = $likeIndexUpdated + 1.4 * ($post['commentIndex']);
							$popularityIndexUpdated="".$popularityIndexUpdated;
							//echo $popularityIndexUpdated." is upi";
							$impIndexUpdated = $likeIndexUpdated + 2 * ($post['mailToIndex']);
							$impIndexUpdated="".$impIndexUpdated;
							
							//echo $impIndexUpdated." is uii";
							$values2 = array(0 => array($likeIndexUpdated => 's'), 1 => array($popularityIndexUpdated => 's'), 2 => array($impIndexUpdated => 's'), 3 => array($starCount => 'i'), 4 => (array($starredBy => 's')), 5 => array($postIdHash => 's'));
							
							$result2 = $conn->update("UPDATE post SET likeIndex = ?, popularityIndex = ?, impIndex = ?, starCount= ? ,starredBy= ? WHERE postIdHash = ?",$values2,false);
							
							//$StarPostSQL="UPDATE post WHERE postIdHash = ? SET starCount= ? ,starredBy= ? ";
							if($conn->error == ""&&$result2==true)
								{
									//echo 'Updated successfully Mode 1<br />';
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
							blockUserbyHash($_SESSION['vj'],"Tampering the StarCount!",$postId);
							
							$_SESSION=array();
							session_destroy();
							echo 12;
						}
					}
				
				
			}
		}





//call likeindex and popularity index updater
?>