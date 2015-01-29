<?php
	session_start();
	require_once('../../QOB/qob.php');
	require_once('/miniClasses/miniIdeaPost.php');
	require_once('../../handlers/fetch.php');
	//require_once('../QOB/qobConfig.php');
	//require_once('../QOB/helper.php');

/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
Code 10: MailError!!
*/

//Actual Code Starts

		$conn=new QoB();
		//1		
		$ideaPostId=$_POST['_ideaPostId'];
		$content=$_POST['_ideaDescription'];
		
		$ideaPost=getIdeaPostFromHash($ideaPostId);
		$userId=$ideaPost['userId'];
		$userIdHash=hash("sha512",$userId.SALT);

		if($userIdHash!=$_SESSION['vj'])
		{
			if(blockUserByHash($_SESSION['vj'],"Suspicious session Variable")>=2)
			{
				notifyAdmin("Suspicious session Variable",$userId);
				$_SESSION=array();
				session_destroy();
				echo 14;
			}
			else
			{
				$_SESSION=array();
				session_destroy();
				echo 13;
			}	
		}
		else{
		
				if(($user=getUserFromHash($userIdHash))==false)
				{
					//echo "Hello<br />";
					notifyAdmin("Critical Error!! In createPost",$userIdHash);
					$_SESSION=array();
					session_destroy();
					echo 13;
				}
				else
				{
				
					$ideaPostIdHash = hash("sha512",$ideaPostId.SALT);
					$userIdHash=hash("sha512",$userId.SALT);
					
					$date=date('y-m-d');
					
					$updatePostSQL="UPDATE ideaposttable SET ideaPostDate = ?, ideaDescription = ? WHERE ideaPostIdHash = ?";
							
					$values[0]=array($date=>'s');
					$values[1]=array($content=>'s');
					$values[2]=array($ideaPostIdHash=>'s');
					
					$SQLResponse=$conn->update($updatePostSQL,$values);
					//------------------------------------------------------------------------!!!!!-----
					if($conn->error=="")
					{
							$postUserIdHash=$userIdHash;
							//$userId
							$postUserName=$user['name'];
							//$ideaPostId
							//$ideaPostIdHash
							$appreciaters = $ideaPost['appreciaters'];
							$appreciateCount = $ideaPost['appreciateCount'];
							$hasAppreciated = isThere($ideaPost['appreciaters'],$userId);
							$depreciaters = $ideaPost['depreciaters'];
							$depreciateCount = $ideaPost['depreciateCount'];
							$hasDepreciated = isThere($ideaPost['depreciaters'],$userId);
							//$date
							//$content
							$postOwner = $ideaPost['postOwner'];

							$postObj=new miniIdeaPost($postUserIdHash, $userId, $postUserName, $ideaPostId, $ideaPostIdHash, $appreciaters, $appreciateCount, $hasAppreciated, $depreciaters, $depreciateCount, $hasDepreciated, $date, $content, $postOwner );
							echo json_encode($postObj);
					}
					else{
						echo $conn->error;
					}
				}
			}	
			//------------------------------------------------------------------------!!!!!-----
		
function getIdeaPostFromHash($postId){

			$conn=new QoB();
			$values = array(0 => array($postId => 's'));
			$result = $conn->fetchAll("SELECT * FROM ideaposttable WHERE ideaPostId = ?",$values,false);
			if($conn->error==""&&$result!="")
			{
				return $result;
			}
			else
			{
				return false;
			}
}
		
?>
