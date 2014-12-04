<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			aboutMeInsert('profilePic','08-09-1994','hi I am good','resume','coding','krreddybpl@gmail.com','address','phone','bhopal');
		}
		
	else
		{
			echo 404;
		}
	
	function aboutMeInsert($profilePic,$dob,$description,$resume,$hobbies,$mailId,$address,$phone,$city)
		{
		
			$date = date_parse($dob);
			$dobTimestamp = strtotime($dob);
			
			$date1 = date_create();
			$currentTimestamp = date_timestamp_get($date1);
			
			if(($profilePic != "") and ($description != "") and ($resume != "") and ($hobbies != "") and ($address != "") and ($phone != "") and ($city != "") and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($dobTimestamp < $currentTimestamp) and ((filter_var($mailId, FILTER_VALIDATE_EMAIL)) or ($mailId == "")))
				{
					$conObj = new QoB();
					$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
					if($conObj->error == "")
						{
							if($result0 != "")
							{
								$userId = $result0['userId'];
								$values1 = array();
								
								$values1[0] = array($userId => 's');
								$values1[1] = array($profilePic => 's');
								$values1[2] = array($dobTimestamp => 's');
								$values1[3] = array($description => 's');
								$values1[4] = array($resume => 's');
								$values1[5] = array($hobbies => 's');
								$values1[6] = array($mailId => 's');
								$values1[7] = array($address => 's');
								$values1[8] = array($phone => 's');
								$values1[9] = array($city => 's');
								
								$result1 = $conObj->insert("INSERT INTO about(uid,propic,dob,description,resume,hobbies,mailid,address,phone,city) VALUES(?,?,?,?,?,?,?,?,?,?)",$values1);
								
								if($conObj->error == "")
									{
										echo 'Succesfull Insert <br />';
									}
								else
									{
										echo 'Error in Query 1 <br />';
										echo $conObj->error.'<br />';
									}
							}
							else
							{
								echo 'No values found for Query 0<br />';
							}
						}
					else
						{
							echo 'Error in Query 0<br />';
							echo $conObj->error.'<br />';
						}
				}
			else
				{
					echo 404;
				}
				
			
		}
?>