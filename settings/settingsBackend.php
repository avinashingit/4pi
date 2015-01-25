<?php

require_once('../QOB/qob.php');

function changeAlias($alias)
	{
		$conObj = new QoB();

		$values[0] = $alias;

		$values[1] = $_SESSION['cookieName'];

		$sql = "update users set alias=? where userIdHash=?";

		$result = $conObj->update($sql, $values);

		if($conObj->error=="")
		
			if($result)
		
				return 1;
		
			else
		
				return 504;
		
		else
		
			return 404;
	}


function changePassword($password)
	{
		$conObj = new QoB();

		$passSalt = "HiGhRandOM8907899";

		$values[0] = hash('sha256', $password.$passSalt);

		$values[1] = $_SESSION['cookieName'];

		$sql = "update users set password=? where userIdHash=?";

		$result = $conObj->update($sql, $values);

		if($conObj->error=="")
		
			if($result)
		
				return 1;
		
			else
		
				return 504;
		
		else
		
			return 404;
	}


function changePrimaryEmail($email)
	{
		$conObj = new QoB();

		$values[0] = $email;

		$values[1] = $_SESSION['sessionName'];

		$sql = "update users set email=? where userIdHash=?";

		$result = $conObj->update($sql, $values);

		if($conObj->error=="")
		
			if($result)
			
				return 1;
			
			else
			
				return 504;
		
		else
			
			return 404;
	}


function profilePicture($pic)
	{
		$tp = explode(".", $pic["profilePic"]["name"]);

		$extension = end($tp);

		if (($pic["profilePic"]["size"] < 500000) && $extension=="jpg")
			{
				if ($pic["profilePic"]["error"][0] > 0 || $pic["profilePic"]["error"][1]>0)
				    {
				    	return 504;
				    }
				else
					{
						if (file_exists("images/proPics" . $_SESSION['sessionName'].'.jpg'))
			  				{
			     				unlink("images/proPics" . $_SESSION['sessionName'].'.jpg');
				 			}

				 		move_uploaded_file($pic["profilePic"]["tmp_name"],"img/proPics".$_SESSION['sessionName'].'.jpg');

						return 1;
					}
			}
		else
			return 404;
	}

?>