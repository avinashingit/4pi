<?php

//------Credits------//
//
//
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

session_start();	
require_once('../../QOB/qob.php');
require_once('./miniPoll.php');
require_once('../fetch.php');
//Testing Content Starts
	/*$userIdHash=$_SESSION['vj']=hash("sha512","EDM12B012".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);
	$_POST['_pollId']="6c3b5a62fa26c9e18e026fdc3feae29b824103141efe1da6d93e2427511c72003b6cb3cd9a735d3719da8a3b4460e1b7e86778633efe878136467ce91d22c427";
	$_POST['_pollQuestion']="Some Other Poll number";
	$_POST['_pollType']=2;
	$_POST['_pollOptions']=['nopt1','nopt2','nopt3'];
	$_POST['_pollOptionType']=2;
	$_POST['_sharedWith']="EDS,EVD,EDM11";*/
//Testing Content Ends


/*
Code 3: SUCCESS!!
Code 5: Attempt to redo a already done task or !
Code 6: Content Unavailable!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!

*/

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}


//Actual editPoll Code Starts
$pollIdHash=$_POST['_pollId'];
$pollQuestion=$_POST['_pollQuestion'];
$pollType=$_POST['_pollType'];
$pollOptionsArray=$_POST['_pollOptions'];
$pollOptionsType=$_POST['_pollOptionType'];
$rawSharedWith=$_POST['_sharedWith'];


$pollOptionsCount=count($pollOptionsArray);
if($pollQuestion==""||$pollOptionsCount<=1)
{
	echo 15;
	exit();
}

for($i=0;$i<$pollOptionsCount;$i++)
{
	if(strlen($pollOptionsArray[$i])>36)
	{
		echo 16;// Longer options cause distortion in result charts in front-end. I know 36 is way too less but cant help.
		exit();
	}
}

if($pollType!=1&&$pollType!=2&&$pollType!=3)
{
	echo 17;
	exit();
}
if($pollOptionsType!=1&&$pollOptionsType!=2)
{
	echo 18;
	exit();
}
if($rawSharedWith=="")
{
	echo 19;
	exit();
}
$conn= new QoB();
$userIdHash=$_SESSION['vj'];
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in editPoll")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in editPoll",$userIdHash.",sh:".$_SESSION['tn']);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
}
else
{
	if(($user=getUserFromHash($userIdHash))==false)
	{
		notifyAdmin("Critical Error In editPoll",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{


		$userId=$user['userId'];
		$userName=$user['name'];
		if(($poll=getPollFromHash($pollIdHash))==false)
		{
			/*if(blockUserByHash($userIdHash,"Tampering pollIdHash in editPoll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Suspicious pollIdHash in editpoll",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}*/
			notifyAdmin("Suspicious postIdHash in editPoll",$userId.",sh:".$pollIdHash);
			echo 6;
			exit();
		}
		if($poll['approvalStatus']==1)
		{
			/*if(blockUserByHash($userIdHash,"Attempt To Edit an approved poll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Attempt to edit an approved poll",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}*/
			notifyAdmin("Attempt to edit an approved poll ",$userId.",sh:".$postIdHash);
			echo 5;
			exit();

		}

		$pollUserId=$poll['userId'];
		if($pollUserId!=$userId)
		{
			if(blockUserByHash($userIdHash,"Illegal Attempt to Edit Poll",$userId.",sh:".$pollIdHash)>0)
			{
				$_SESSION=array();
				session_destroy();
				echo 14;
				exit();
			}
			else
			{
				notifyAdmin("Illegal Attempt to Edit Poll",$userId.",sh:".$pollIdHash);
				$_SESSION=array();
				session_destroy();
				echo 13;
				exit();
			}
		}

		$splitSharedWith=explode(",", $rawSharedWith);

		$n=count($splitSharedWith);
		$sharedWith="";
		if(stripos($rawSharedWith,"All")===false)
		{
			if($rawSharedWith!=",")
			{
				for($i=0;$i<$n;$i++)
				{
					if($splitSharedWith[$i]!="")
					{
						//echo $i.",".$splitSharedWith[$i]."<br/>";
						$out=newValidateSharedWith($splitSharedWith[$i]);
						if($out=="Invalid")
						{
							echo 16;
							exit();
						}
						else
						{
							//echo $out;
							if($sharedWith=="")
							{
								$sharedWith=$out;
							}
							else
							{
								$sharedWith=$sharedWith.",".$out;
							}
						}
					}
				}//2
			}
			else
			{
				echo 16;
				exit();
			}	
		}
		else
		{
			$sharedWith="All";
		}
		$pollOptions=implode(',',$pollOptionsArray);
		
		for($i=0;$i<count($pollOptionsArray);$i++)
			$optionVotesArray[]=0;
		$optionVotes=implode(',',$optionVotesArray);
		$isSAC=isSAC($pollUserId);
		
		if($isSAC==1)
		{
			$editPollSQL="UPDATE poll SET pollType = ?,question = ? ,options = ?,optionsType =? ,optionCount = ?, sharedWith = ?,optionVotes= ?, approvalStatus=1 
						WHERE pollIdHash= ?";
		}
		else
		{
			$editPollSQL="UPDATE poll SET pollType = ?,question = ? ,options = ?,optionsType =? ,optionCount = ?, sharedWith = ?,optionVotes= ?, approvalStatus=0 
						WHERE pollIdHash= ?";
		}

		$values[0]=array($pollType => 's');
		$values[1]=array($pollQuestion => 's');
		$values[2]=array($pollOptions => 's');
		$values[3]=array($pollOptionsType => 's');
		$values[4]=array($pollOptionsCount => 's');
		$values[5]=array($sharedWith => 's');
		$values[6]=array($optionVotes => 's');
		$values[7]=array($pollIdHash => 's');


		$result=$conn->insert($editPollSQL,$values);
		if($conn->error==""&&$result==true)
		{
			//Success
			if($isSAC!=1)
			{	
				$approvalStatus=0;
				resetNotification($userId,SAC,16,$pollId,700);
			}	
			else
			{
				$approvalStatus=1;
			}
			
			$timestamp=$poll['timestamp'];			
			$ts = new DateTime();
			$ts->setTimestamp($timestamp);
			$pollCreationTime=$ts->format(DateTime::ISO8601);
			$pollStatus=0;
			$hasVoted=-1;
			for($i=0;$i<$pollOptionsCount;$i++)
			{
				$optionsAndVotes[$i]=array($pollOptionsArray[$i] , (int)$optionVotesArray[$i]);
			}
			/*$proPicLocation='../../img/proPics/'.$userIdHash.'.jpg';
			if(file_exists($proPicLocation))
			{
				$proPicExists=1;
			}
			else
			{
				$proPicExists=-1;
			}*/
			$isSAC=isSAC($pollUserId);
			
			$pollObj=new miniPoll($pollIdHash,$pollQuestion,$pollType,$pollOptionsArray,$pollOptionsType,$sharedWith,$hasVoted,$optionAndVotes,$pollCreationTime,$pollStatus,1,$isSAC,$approvalStatus);
			print_r(json_encode($pollObj));
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While inserting in edit Poll",$userId);
			echo 12;
			exit();
		}
	}
}
?>