<?php
require_once('QOB/qob.php');
require_once('handlers/fetch.php');
function login()
	{
		$conObj = new QoB();
		$userId = strtoupper($_POST['_username']);
		$password = $_POST['_password'];
		$passwordHash=hash("sha512",$password.PASSSALT);
		//$userIdHash = hash("sha512",$userId.SALT);
		$values1 = array(0 => array($userId => 's'),1 => array($passwordHash => 's'));
		$result1 = $conObj->fetchAll("SELECT userId,isActive,password FROM users WHERE userId = ? AND password = ?",$values1,false);
		if($conObj->error == "")
			{
				if($result1 != "")
					{
						if($result1['password']=="")
						{
							echo -3;// Check the mail to set the password.
						}
						else
						{
							if($result1['isActive']==1)
							{
								session_start();
								$logId=loginLog($userId);
								if($logId>0)
								{
									$userIdHash=hash("sha512",$userId.SALT);
									$_SESSION['vj'] = $userIdHash;
									// echo '<script>console.log($userIdHash)</script>';


									$secondUserIdHash = hash("sha512",$userIdHash.SALT2);
									$_SESSION['tn'] = $secondUserIdHash;
									// echo '<script>console.log($secondUserIdHash)<script>';
									//echo $secondUserIdHash;

									$_SESSION['userId'] = $userId;
									
									$_SESSION['logId']=$logId;
									$_SESSION['jq'] = 0;
									$_SESSION['mq'] = 0;
									$_SESSION['qq'] = 0;
									echo 1;
								}
								else
								{
									echo 22;//Problem with noting the login details
								}
							}
							else
							{
								echo 9;// User is blocked by administrator.
							}
						}
						
						

						
					}
				else
					{
						//echo 'No values found for Query 1<br />';
						echo -1;// Error in credentials entered by the user.
					}
			}
		else
			{
				//echo 'Error in Query 1<br />';
				//echo $conObj->error.'<br />';
				echo -2;// Error in Query!!!!
			}
	}
	
	login();

//echo "1";
	
?>