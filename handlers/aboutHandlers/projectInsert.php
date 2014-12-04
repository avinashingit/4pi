<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	if(isset($_SESSION['vj']))
		{
			projectInsert('4pi','Backend developer, algo designer of post','13-09-2014','01-12-2014','4pi is an interactive social media website like facebook for students of iiitKancheepuram');
		}
		
	else
		{
			echo 404;
		}
		
	function projectInsert($title,$role,$start,$end,$description)
		{
		
			$startDate = date_parse($start);
			$startDateTimestamp = strtotime($start);
			
			//echo $startDateTimestamp.'<br/>';
			
			$endDate = date_parse($end);
			$endDateTimestamp = strtotime($end);

			//echo $endDateTimestamp.'<br/>';
			
			$date1 = date_create();
			$currentTimestamp = date_timestamp_get($date1);
			
			//echo $currentTimestamp.'<br/>';
			
			if(($title != '') and ($description != '') and ($role != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp <= $endDateTimestamp))
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
								$values1[1] = array($title => 's');
								$values1[2] = array($role => 's');
								$values1[3] = array($startDateTimestamp => 's');
								$values1[4] = array($endDateTimestamp => 's'); 
								$values1[5] = array($description => 's');
								
								$result1 = $conObj->insert("INSERT INTO projects(uid,title,role,start,end,description) VALUES(?,?,?,?,?,?)",$values1);
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