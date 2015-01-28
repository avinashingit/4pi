<?php
	session_start();
	require_once('../../QOB/qob.php');
	require_once('../../handlers/fetch.php');
	require_once('/miniClasses/miniIdeaPost.php');

$conn=new QoB();
$ideaPostId = $_POST['_ideaPostId'];
$userIdHash=$_SESSION['vj'];
$_SESSION['sh'] = hash("sha512",$userIdHash.SALT2);
//Checking the session varianles. Second Level Protection
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['sh'])
	{
		notifyAdmin("Suspicious session variable in InsertComment");
		
		$_SESSION=array();
		session_destroy();
		return 13;
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! in Insert Comment");
				$_SESSION=array();
				session_destroy();
				return 13;
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
						return 13;
					}
					else
					{
						//echo 'Hai <br />';
						$appreciateCount = $ideaPost['appreciateCount'];
						$appreciatedBy = $ideaPost['appreciaters'];
						$userId = $user['userId'];
						
						if(stripos($appreciatedBy,$userId)===false)
						{
						
							//update post
							if($appreciatedBy=="")
							{
								$appreciatedBy=$appreciatedBy.$userId;
							}
							else
							{
								$appreciatedBy=$appreciatedBy.",".$userId;
							}
							$appreciateCount=$appreciateCount+1;
							
							$values2 = array(0 => array($appreciateCount => 'i'), 1 => (array($appreciatedBy => 's')), 2 => (array($ideaPostId => 'i')));
							
							$result2 = $conn->update("UPDATE ideaposttable SET  appreciateCount= ? , appreciaters = ? WHERE ideaPostId = ?" ,$values2,false);
							
							if($conn->error == "")
								{
									//echo 'Updated successfully Mode 1<br />';
									echo $appreciateCount;
									//return json_encode($appreciateCount);
								}
							
							else
								{
									echo 'Error in Query 2 of Mode 1<br />';
									//echo $conObj->error;
									return -1;
								}
						}
						else
						{
							//Detected an attempt to Increase StarCount;
							blockUserbyHash($_SESSION['vj'],"Tampering the StarCount!");
							//echo "else hai session destroy<br />";
							$_SESSION=array();
							session_destroy();
							return 13;
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