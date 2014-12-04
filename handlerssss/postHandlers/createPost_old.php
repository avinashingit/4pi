<?php
require_once('QOB/qob.php');
	require_once('QOB/qobConfig.php');
	require_once('QOB/helper.php');

function validateSharedWith($str){
		$regstr;
		$conn=new QOB();
		if(strlen($str==0))
		{
			$storeString="^.{9}$";
			$regstr=$storeString;
			return $regstr;
		
		}
		if(strlen($str)==1)
		{
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.{5}".$str.".{3}$";
			$values[]=array('_____'.$str.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}			
		}
		else if(strlen($str)==2){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$storeString="^.{3}".$str.".{4}$";
			$values[]=array('____'.$str.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}			
		
		}
		else if(strlen($str)==3){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			
			$values[]=array('___'.$str.'___'=>'s');
			$storeString1='^.{3}'.$str.'.{3}$';
			$values1[]=array($str.'______'=>'s');
			$storeString2='^'.$str.'.{6}$';
			$result=$conn->fetchALL($sql,$values,true);
			//
			
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					$result2=$conn->fetchALL($sql,$values1,true);
					if($conn->error!=''){
						return "Invalid";
					}
					else{
						if(isset($result2)){
							//echo "Accepted";
							$regstr=$storeString;
							return $regstr;
						}
						else
						{
							return "Invalid";
						}
					}
				}
			}		
			
			/*
			if($result==0){
			//echo "Invalid Entry";
			
			        $result=$conn->fetchALL($sql,$values1,true);
        			if($result==0){
	        		return "Invalid";
	        		}
	        		else{
	        			echo "Accepted";
	        			$regstr=$storeString2;
	        			return $regstr;
	        		}
			
			}
			else{
				echo "Accepted";
				$regstr=$storeString1;
				return $regstr;
			}*/
			
		}
		else if(strlen($str)==4){
			$dividedstr=explode($str);
			$searchString=$divide[0].$divide[1].$divide[2]."__".$divide[3];
			$storeString=$divide[0].$divide[1].$divide[2].".{2}".$divide[3];
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[]=array($searchString.'___'=>'s');
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		
		}
		else if(strlen($str)==5){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[]=array($str.'____'=>'s');
			$storeString=$str.".{4}";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
		
		}
		else if(strlen($str)==6){
			$sql="SELECT * FROM users WHERE userId LIKE ?";
			$values[]=array($str.'___'=>'s');
			$storeString=$str.".{3}";
			$result=$conn->fetchALL($sql,$values,true);
			if($conn->error!=''){
				return "Invalid";
			}
			else{
				if(isset($result)){
					//echo "Accepted";
					$regstr=$storeString;
					return $regstr;
				}
				else
				{
					return "Invalid";
				}
			}		
			
		
		}
	
	
	}



		$conn=new QOB();
		$content=$_POST['content'];
		$userHash=$_POST['xn'];
		$sharedWith=$_POST['sharedWith'];
		$sanitizedSharedWith=validateSharedWith($sharedWith);
		if($sanitizedSharedWith=="Invalid"){
			echo 16;
			exit();
		}
		$subject=$_POST['subject'];
		$getUserSQL="SELECT * FROM users WHERE hash=?";
		$values[]=array($userHash => 's');
		$resultSet=$conn->fetchALL($getUserSQL,$values,false);
		$lifetime=$_POST['lifetime'];
		$ispermanent=$_POST['isPermanent'];
		//========================================
		//$postId=generatePostID();
		//========================================
		if($resultSet->num_rows!=1){
		echo 13;
		exit();
		}
		else{
			echo 1;
			$time=time();
			$createPostSQL="INSERT INTO posts (userId,timestamp,content,sharedWith,reportedBy, spamCount,postId,subject,starCount,mailCount, mailedBy,lifetime,starredBy,status,lastUpdated, likeIndex,commentIndex,impIndex,requestPermanence) VALUES(?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?)";
			$values[]=array($resultSet['userId'])=>'s');
			$values[]=array($time=>'i');
			$values[]=array($content=>'s');
			
			$values[]=array($sanitizedSharedWith=>'s');
			$values[]=array(''=>'s');//reportedBy
			$values[]=array(0=>'i');//spamCount
			
			$values[]=array($postId=>'s');//postID
			$values[]=array($subject=>'s');//subject
			$values[]=array(0=>'i');//starCount

			$values[]=array(0=>'i');//mailCount
			$values[]=array(''=>'s');//mailedBy
			$values[]=array($lifetime=>'s');//lifetime
			
			$values[]=array(''=>'s');//starredBy
			$values[]=array('active'=>'s');//status
			$values[]=array($time=>'s');//lastupdated
			
			$values[]=array($resultSet['userId'])=>'s');//likeIndex
			$values[]=array(time()=>'i');//commentIndex
			$values[]=array($content=>'s');//impIndex
			
			$values[]=array($requestPermanence=>'i');//requestPermanence
			
			$SQLResponse=$conn->insert($createPostSQL,$values);
			//------------------------------------------------------------------------!!!!!-----
			if($conn->error=="")
			{
				
				echo 3;
			}
			else{
				echo 12;
			}
			//------------------------------------------------------------------------!!!!!-----
		}
		
?>