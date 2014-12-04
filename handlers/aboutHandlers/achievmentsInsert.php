<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			achievmentsInsert('vielage 12345','quiz contest','3rd','20-02-1998');
		}
		
	else
		{
			echo 404;
		}
		
		
	//******************* ALGO OF achievmentsInsert FUNCTION **************//
	
	/*
		Firstly I check whether all details are passed to me or not and also whether the date that is passed is valid or not.
		Also the date's timestamp must be less than the current timestamp for the achievement to be a valid one. So first if takes care of all these.
		
		Then normally i insert all into the achievments tables in the database.
		
		Constrain is the date must be passed like dd - mm - yy format. <<---- /// imp ///.
		
	*/
	
	// ******************************************************************//
	
	function achievmentsInsert($competition,$description,$position,$achievedDate)
		{
			$date = date_parse($achievedDate);
			$achievedDateTimestamp = strtotime($achievedDate);
			
			$date1 = date_create();
			$currentTimestamp = date_timestamp_get($date1);	
			
			if(($competition != '') and ($description != '') and ($position != '') and (($date["error_count"] == 0) and checkdate($date["month"], $date["day"], $date["year"]) ) and ($achievedDateTimestamp < $currentTimestamp))
				{
			
					$conObj = new QoB();
					$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
					
					if($conObj->error == "")
						{
							if($result0 != "")
								{
									$userId = $result0['userId']; 
								
									echo "This is the value of timestamp <br/>";
									echo $achievedDateTimestamp.'<br/>';
								
									$values1 = array(0 => array($userId => 's'), 1 => array($competition => 's'), 2 => array($description => 's'), 3 => array($position => 's'), 4 => array($achievedDateTimestamp => 's'));
									
									$result1 = $conObj->insert("INSERT INTO achievements(uid,competition,description,position,achieveddate) VALUES(?,?,?,?,?)",$values1);
									
									if($conObj->error == "")
										{
											echo 'Successful Insert<br />';
										}
									else
										{
											echo 'Error in Query 1 <br />';
											echo $conObj->error.'<br />';
										}
								}
							else
								{
									echo 'No values found for Query 0 <br />';
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
					echo 'No values found <br/>';
					echo 404;
				}
			
			
		}
	
	
?>