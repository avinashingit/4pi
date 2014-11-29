<?php
require_once('QOB/qob.php');
function login()
	{
		$conObj = new QoB();
		$userId = strtoupper($_POST['_username']);
		$password = $_POST['_password'];
		$userIdHash = hash("sha512",$userId.SALT);
		$values1 = array(0 => array($userId => 's'),1 => array($password => 's'));
		$result1 = $conObj->fetchall("SELECT userId FROM users WHERE userId = ? AND password = ?",$values1,false);
		if($conObj->error == "")
			{
				if($result1 != "")
					{
						session_start();

						$userIdHash=hash("sha512",$userId.SALT);
						$_SESSION['vj'] = $userIdHash;
						$secondUserIdHash = hash("sha512",$userIdHash.SALT2);
						$_SESSION['tn'] = $secondUserIdHash;
						//echo $secondUserIdHash;
						$_SESSION['jq'] = 0;
						$_SESSION['mq'] = 0;
						$_SESSION['qq'] = 0;
						echo 1;
					}
				else
					{
						//echo 'No values found for Query 1<br />';
						echo -1;
					}
			}
		else
			{
				//echo 'Error in Query 1<br />';
				//echo $conObj->error.'<br />';
				echo -1;
			}
	}
	
	login();

//echo "1";
	
?>