<?php
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
		$userIdHash=$_SESSION['vj']='0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22';
		$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
		if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
		{
				$combination=$userIdHash.",".$_SESSION['tn'];
				notifyAdmin("Suspicious Session variable in CreatePost",$combination);
				$_SESSION=array();
				session_destroy();
				return 13;
		}
		else
		{ 
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! In createPost",$userIdHash);
				$_SESSION=array();
				session_destroy();
				return 13;
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