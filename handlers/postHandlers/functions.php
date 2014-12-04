<?php
	//Contains functions which will be used in post fetching.
	
	function sharedWith($userid,$sharedwith)
		{
			//if(strcasecmp($userid,$sharedwith) == 0)
				//{
					return 1;
				//}
		}
		
	function isFollowing($userId,$followers)
		{
			if(stripos($followers,$userId)===false)
				{
					return 1;
				}
			else
				{
					return -1;
				}
		}
		
	function hasStarred($userId,$hasStarred)
		{
			if(stripos($hasStarred,$userId)===false)
				{
					return -1;
				}
			else
				{
					return 1;
				}
		}
		
		
	function hiddenTo($userId,$hiddenTo)
		{
			if(stripos($hiddenTo,$userId) === false)
				{
					return 1;
				}
			else
				{
					return -1;
				}
		}

	function getHash($userId)
		{
			$conObj = new QoB();
			$values1 = array(0 => array($userId => 's'));
			////echo "*********".$userId;
			$result1 = $conObj->fetchall("SELECT userIdHash FROM users WHERE userId = ? ",$values1,false);
			
			//print_r( $result1);
			
			$output;
			if($conObj->error == "")
				{
					if($result1!= "")
						{
							$output = $result1['userIdHash'];
							return $output;
						}
					
					else
						{
							//////echo 'No values found for Query 1 in function getHash<br />';
							return -1;
						}
				}
			
			else
				{
					//////echo 'Error in Query 1 of function getHash<br />';
					//////echo $conObj->error.'<br />';
					return -1;
				}
		}
		
	function getName($userId)
		{
			$conObj = new QoB();
			$values1 = array(0 => array($userId => 's'));
			
			//Should fetch alias not name.
			
			$result1 = $conObj->fetchall("SELECT name FROM users WHERE userId = ?",$values1,false);
			//$output;
			if($conObj->error == "")
				{
					if($result1 != "")
						{
							return $result1['name'];
						
						}
					
					else
						{
							//////echo 'No values found for Query 1 in function getName<br />';
							
							return -1;
						}
				}
			
			else
				{
					///////echo 'Error in Query 1 of function getName<br />';
					//////echo $conObj->error.'<br />';
					
					return -1;
				}
		}
	
	function getIdAndName($userIdHash)
		{
			$conObj = new QoB();
			$values1 = array(0 => array($userIdHash => 's'));
			$result1 = $conObj->fetchall("SELECT alias,userId FROM users WHERE userIdHash = ?",$values1,false);
			$output;
			if($conObj->error == "")
				{
					if($result1!="")
						{
							$output = array($result1['alias'],$result1['userId']);
							return $output;
						
						}
					
					else
						{
							//////echo 'No values found for Query 1 of function getIdAndName<br />';
							return -1;
						}
						
				}
			else
				{
					//////echo 'Error in Query 1 of function getIdAndName<br />';
					//////echo $conObj->error.'<br />';
					
					return -1;
				}
		}
?>