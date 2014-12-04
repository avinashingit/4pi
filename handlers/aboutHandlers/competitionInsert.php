<?php
	require_once '../QOB/qob.php';
	session_start();
	
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			competitionInsert('Game design Workshop from that atvantkar sir','27-06-2014','IITB','Designing a game');
		}
	else
		{
			echo 404;
		}
		
	// ********************* ALGORITHM BEHIND competitionInsert FUNCTION ******************//
	/*
		Same as achievments firstly validate all, then insert.
	*/	
	// ***********************************************************************************//
	
	function competitionInsert($title,$competitionDate,$place,$description)
		{
			$date = date_parse($competitionDate);
			$competitionDateTimestamp = strtotime($competitionDate);
			
			$date1 = date_create();
			$currentTimestamp = date_timestamp_get($date1);
			
			if(($title != '') and ($place != '') and ($description != '') and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"])) and ($competitionDateTimestamp < $currentTimestamp))
				{
					$conObj = new QoB();
					$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
					if($conObj->error == "")
						{
							if($result0 != "")
							{
								$userId = $result0['userId'];
								
								$values1 = array(0 => array($userId => 's'),1 => array($title => 's'),2 => array($competitionDateTimestamp => 's'),3 => array($place => 's'),4 => array($description => 's'));
								
								$result1 = $conObj->insert("INSERT INTO competitions(uid,title,compdate,place,description) VALUES(?,?,?,?,?)",$values1);
								
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