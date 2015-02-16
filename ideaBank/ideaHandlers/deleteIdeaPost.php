<?php
	session_start();
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
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
		notifyAdmin("Suspicious session variable in DeletePost",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//echo "Else hai <br />";
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			//echo "Session destroying<br />";
			notifyAdmin("Critical Error!! in DeletePost!!",$userIdHash);
			$_SESSION=array();
			session_destroy();
			echo 13;
		}
		else
		{
			//echo "Else Hai 2 <br />";
			$ideaPostIdHash = $_POST['_ideaPostId'];
			if(($ideaPost=fetchIdeaPostByHash($ideaPostIdHash))==false)
			{
				//echo "Detected tampered<br />";
				//Detected tampered postIdHash
				blockUserByHash($userIdHash,"Messing with postIdHash!! In DeletePost");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$postUserId=$ideaPost['userId'];
				$ideaPostId=$ideaPost['ideaPostId'];
				$userId=$user['userId'];
				if($postUserId==$userId)
				{
					//$conn->startTransaction();
					//echo "Post user Id<br />";
					$UpdatePostSQL="DELETE FROM ideaposttable WHERE ideaPostId= ?";
					$values[]=array($ideaPostIdHash => 's');
					$conn->update($UpdatePostSQL,$values);
					if($conn->error=="")
					{
						
						echo 3;
						//return 3;
					}
					else
					{
						echo 12;
					}
				}
				else
				{
					//blockUserByHash($userId,"Illegal Delete Attempt in DeletePost: ".$ideaPostIdHash);
					//echo "Hello<br />";
					$_SESSION=array();
					session_destroy();
					echo 13;
				}
			}
		}
	}
	
	function fetchIdeaPostByHash($ideaPostIdHash){
	$conn=new QoB();
	$values = array(0 => array($ideaPostIdHash => 's'));
	$result = $conn->fetchAll("SELECT * FROM ideaposttable WHERE ideaPostId = ?",$values,false);
	//echo "Fetch All <br />";
	if($conn->error==""&&$result!="")
		{
			//echo $result;
			return $result;
		}
		else
		{
			//echo "Nothing".$result;
			return false;
		}
	}

?>