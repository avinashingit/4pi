<?php
	require_once '../QOB/qob.php';
	session_start();
	$_SESSION['vj'] = '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a' ;
	
	if(isset($_SESSION['vj']))
		{
			academicsInsert('BTECH','COE','22-08-2012','22-08-2016','8.86');
			
		}
		
	else
		{
			echo 404;
		}
	
	// ***** LOGIC OF DEGREE ******//
					
	/* There are 5 degree's :-
	
	1) P.H.D
	2) M.D.E.S
	3) B.T.E.C.H
	4) S.E.C(secondary school)
	5) S.N.R.S.E.C(senior secondary school)
	
	Now logic for id is find it's number for e.q a/A becomes 1, b/B becomes 2 (case insensitive), the  replace the character with the number associated with the alphabet that comes after it by adding it's (index + 1).
	
	For e.g P.H.D, p's index starts with 1, so alphabet that comes after adding 1 to p is q. Now leave it then after leaving q we get r, so number associated with r is 18, so in place of p write 18.
	
	ID for each degree are :-
	
	1) P.H.D :- 18118
	2) M.D.E.S :- 157924
	3) B.T.E.C.H :- 4239814
	4) S.E.C(secondary school) :- 2187
	5) S.N.R.S.E.C(senior secondary school) :- 211722241110 
	
	*/
	// ************************************************************ //
	
	
	//********* WORKING OF FUNCTION academicsInsert **************//
	
	/*
		First check is to see whether all the details are passed or not.
		Secondly from the userIdHash I fetch the userId. This is query 0.
		Once I get the userId, I then generate Id for the degree entered, and then insert it into table.
		If degree entered failed there is a $check variable which checks whether degree entered is valid or not. 
	*/
	
	//*************************************************************//
	function academicsInsert($degreeOriginal,$name,$start,$end,$cgpa)
		{		
			$startDate = date_parse($start);
			$startDateTimestamp = strtotime($start);
			
			//echo $startDateTimestamp.'<br/>';
			
			$endDate = date_parse($end);
			$endDateTimestamp = strtotime($end);

			//echo $endDateTimestamp.'<br/>';
			
			$date1 = date_create();
			$currentTimestamp = date_timestamp_get($date1);
			
			
			if(($degreeOriginal != '') and ($name != '') and ($cgpa !='') and (($startDate["error_count"] == 0) and checkdate($startDate["month"], $startDate["day"], $startDate["year"])) and (($endDate["error_count"] == 0) and checkdate($endDate["month"], $endDate["day"], $endDate["year"])) and ($startDateTimestamp < $currentTimestamp) and ($startDateTimestamp - $endDateTimestamp !=0)and($startDateTimestamp < $endDateTimestamp))
				{
					$conObj = new QoB();
					$values0 = array(0 => array($_SESSION['vj'] => 's'));
					$result0 = $conObj->fetchall("SELECT userId FROM users WHERE userIdHash = ?",$values0);
					if($conObj->error == "")
						{
							if($result0 != "")
							{
								$userId = $result0['userId'];
								$degreeId = '';
								$check = 1;
								if($degreeOriginal == "PHD")
									{
										$degreeId = "18118";
									}
								
								else if($degreeOriginal == "MDES")
									{
										$degreeId = "157924";
									}	
								
								else if($degreeOriginal == "BTECH")
									{
										$degreeId = "4239814";
									}

								
								else if($degreeOriginal == "Secondary School")
									{
										$degreeId = "2187";
									}


								else if($degreeOriginal == "Senior Secondary School" )
									{
										$degreeId = "211722241110";
									}
									
								else
									{
										$check = -1;
									}
								
								if($check == 1)
									{
										$values1 = array(0 => array($userId => 's'), 1 => array($degreeId => 's'), 2 => array($name => 's'), 3 => array($startDateTimestamp => 's'), 4 => array($endDateTimestamp => 's'),5 => array($cgpa => 's'));
										
										$result1 = $conObj->insert("INSERT INTO academics(uid,degree,name,start,end,cgpa) VALUES(?,?,?,?,?,?)",$values1);
										
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
										echo "The degree entered is wrong please check again <br/>";
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
					echo 'No values found <br/>';
					echo 404;
				}
			
		}
		
		
	
	
?>