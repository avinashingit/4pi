<?php
	require_once '../QOB/qob.php';
	session_start();
	
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			experienceInsert('IIT BOMBAY','10-05-2014','6-06-2014','WORD PREDICTION AND WORD COMPLETION USING TRIE','INTERNSHIP UNDER SWARACHAKRA TEAM');
		}
		
	else
		{
			echo 404;
		}
		
	// ********* ALGORITHM SAME AS ACHIEVEMENTS ******************************** //	
		
	function experienceInsert($organisation,$start,$end,$title,$description)
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
			
			if(($organisation != '') and ($description != '') and ($title != '') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($endDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0) and($startDateTimestamp <=$endDateTimestamp))
				{
				
					$conObj = new QoB();
					$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
			
					if($conObj->error == "")
						{
							if($result0 != "")
							{
								$userId = $result0['userId'];
								$values1 = array(0 => array($userId => 's'),1 => array($organisation => 's'),2 => array($startDateTimestamp => 's'),3 => array($endDateTimestamp => 's'), 4 => array($title => 's'), 5 => array($description => 's'));
								
								$result1 = $conObj->insert("INSERT INTO experience(uid,organisation,start,end,title,description) VALUES(?,?,?,?,?,?)",$values1);
								
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
					//echo 'details entered are wrong <br/>';
					echo 404;
				}
				
			
		}
	
	
?>