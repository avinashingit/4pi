<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			objectiveInsert('Hi i am good how r you');
		}
		
	else
		{
			echo 404;
		}
	function objectiveInsert($description)
		{
			$conObj = new QoB();
			$values0 = array(0 => array($_SESSION['vj'] => 's'));
			$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
		
			if(($description != ''))
				{
					if($conObj->error == "")
						{
							if($result0 != "")
							{
								$userId = $result0['userId'];
								$values1 = array();
								
								$values1[0] = array($userId => 's');
								$values1[1] = array($description => 's');
								
								$result1 = $conObj->insert("INSERT INTO objective(uid,description) VALUES (?,?)",$values1);
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