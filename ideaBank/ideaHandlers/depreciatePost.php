<?php
	session_start();
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
	require_once('/miniClasses/miniIdeaPost.php');

$conn=new QoB();
$ideaPostId = $_POST['_ideaPostId'];
$userIdHash=$_SESSION['vj'];
//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		notifyAdmin("Suspicious session variable in InsertComment");
		
		$_SESSION=array();
		session_destroy();
		echo 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! in Insert Comment");
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				//fetch post
				$ideaPost=fetchIdeaPostByHash($ideaPostId);
				if($ideaPost==false)
					{
						//Detected tampered postIdHash
						blockUserbyHash($userIdHash,"Meddling with postIdHash");
						//echo 'hello <br />';
						$_SESSION=array();
						session_destroy();
						echo 13;
					}
					else
					{
						//echo 'Hai <br />';
						$depreciateCount = $ideaPost['depreciateCount'];
						$depreciatedBy = $ideaPost['depreciaters'];
						$userId = $user['userId'];
						
						if(stripos($depreciatedBy,$userId)===false)
						{
						
							//update post
							if($depreciatedBy=="")
							{
								$depreciatedBy=$depreciatedBy.$userId;
							}
							else
							{
								$depreciatedBy=$depreciatedBy.",".$userId;
							}
							$depreciateCount=$depreciateCount+1;
							
							$values2 = array(0 => array($depreciateCount => 'i'), 1 => (array($depreciatedBy => 's')), 2 => (array($ideaPostId => 'i')));
							
							$result2 = $conn->update("UPDATE ideaposttable SET  depreciateCount= ? , depreciaters = ? WHERE ideaPostId = ?" ,$values2,false);
							
							if($conn->error == "")
								{
									//echo 'Updated successfully Mode 1<br />';
									echo $depreciateCount;
									//return json_encode($appreciateCount);
								}
							
							else
								{
									//echo 'Error in Query 2 of Mode 1<br />';
									//echo $conn->error;
									echo -1;
								}
						}
						else
						{
							//Detected an attempt to Increase StarCount;
							blockUserbyHash($_SESSION['vj'],"Tampering the StarCount!");
							//echo "else hai session destroy<br />";
							$_SESSION=array();
							session_destroy();
							echo 13;
						}
					}
				
				
			}
	}

	
	function fetchIdeaPostByHash($ideaPostId){
	$conn=new QoB();
	$values = array(0 => array($ideaPostId => 's'));
	$result = $conn->fetchAll("SELECT * FROM ideaposttable WHERE ideaPostId = ?",$values,false);
	//echo "Fetch All <br />";
	if($conn->error==""&&$result!="")
		{
			//echo $result;
			return $result;
		}
		else
		{
			echo "Nothing".$result;
			return false;
		}
	}
	
	
?>