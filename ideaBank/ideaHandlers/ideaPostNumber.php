<?php
session_start();
	require_once('../../QOB/qob.php');
	require_once('/miniClasses/miniIdeaPost.php');
	require_once('../../handlers/fetch.php');
	

/*
Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
Code 16: Erroneous Entry By USER!!
*/
//$_POST['_ideaContent']="HELLO IM TESTING U. hello im testing dmnsvbds !!!!!!";
	
		$conn=new QoB();
		$userIdHash=$_SESSION['vj'];
		$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
		if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
		{
				$combination=$userIdHash.",".$_SESSION['tn'];
				notifyAdmin("Suspicious Session variable in CreatePost",$combination);
				$_SESSION=array();
				session_destroy();
				echo 13;
		}
		else
		{ 
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! In createPost",$userIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
			}
			else
			{
				$arrayValues = $conn->select("SELECT * FROM ideaposttable");
				//------------------------------------------------------------------------!!!!!-----
				if($conn->error=="")
				{
					$count = 0;
					while($result = $conn->fetch($arrayValues,false))
					{
						$count++;
					}
					echo $count;		
				}  
				else
				{
					echo $conn->error;
				} 
			
			}	//------------------------------------------------------------------------!!!!!-----
		
		}

?>