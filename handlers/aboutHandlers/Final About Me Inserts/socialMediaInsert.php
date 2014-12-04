<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	if(isset($_SESSION['vj']))
		{
			socialMediaInsert('krreddybpl@gmail.com','krreddybpl@gmail.com','krreddybpl@gmail.com','krreddybpl@gmail.com');
		}
	else
		{
			echo 404;
		}
	
	// ******* ALGORITHM FOR socialMediaInsert ************************** //
	/*
		BASICALLY TO CHECK WHETHER THE GIVEN ID ARE VALID IF THEY ARE THERE. IF USER DOESN'T ENTER THE ID AT ALL THEN LEAVE IT.
	*/
	// ****************************************************************** //
	
	function socialMediaInsert($facebookId,$googleId,$twitterId,$linkedinId)
		{
			if((($facebookId == '') or (filter_var($facebookId, FILTER_VALIDATE_EMAIL))) and (($googleId == '') or (filter_var($googleId, FILTER_VALIDATE_EMAIL))) and (($twitterId == '') or (filter_var($twitterId, FILTER_VALIDATE_EMAIL))) and (($linkedinId == '') or (filter_var($linkedinId, FILTER_VALIDATE_EMAIL))) )
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
								$values1[1] = array($facebookId => 's');
								$values1[2] = array($googleId => 's');
								$values1[3] = array($twitterId => 's');
								$values1[4] = array($linkedinId => 's');
								
								$result1 = $conObj->insert("INSERT INTO socialmedia(uid,facebookid,googleid,twitterid,linkedinid) VALUES(?,?,?,?,?)",$values1);
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