<?php

session_start();	
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../QOB/qob.php');
require_once('./miniClasses/miniLittlePost.php');
require_once('../fetch.php');

if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

$userIdHash=$_SESSION['vj'];

$conn=new QoB();
if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
{
	if(blockUserByHash($userIdHash,"Suspicious Session Variable in fetchLittlePosts")>0)
	{
		$_SESSION=array();
		session_destroy();
		echo 14;
		exit();
	}
	else
	{
		notifyAdmin("Suspicious Session Variable in fetchLatestPosts",$userIdHash.",sh:".$_SESSION['tn']);
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
		notifyAdmin("Critical Error In latestpoll",$userIdHash);
		$_SESSION=array();
		session_destroy();
		echo 13;
		exit();
	}
	else
	{
		$userId=$user['userId'];
		$finalStudentRegex=getRollNoRegex($userId);
		$values[0]=array($finalStudentRegex => 's');
		$getLatestPostsSQL="SELECT post.* FROM post WHERE (sharedWith REGEXP ?) ORDER BY timestamp DESC";
		$result=$conn->select($getLatestPostsSQL,$values);
		$displayCount=0;
		if($conn->error=="")
		{
			//Success
			$littlePostObjectArray=array();
			while(($post=$conn->fetch($result))&&($displayCount<=6))
			{
				if($post['subject']=="")
				{
					$content=substr($post['content'],0,35).'...';
				}
				else
				{
					$content=substr($post['subject'],0,35);
				}
				$postObject=new miniLittlePost($post['postIdHash'],$content);
				$littlePostObjectArray[]=$postObject;
				$displayCount++;
			}

			if($displayCount==0)
			{
				echo 404;
				exit();
			}
			else
			{
				print_r(json_encode($littlePostObjectArray));
			}
		}
		else
		{
			notifyAdmin("Conn.Error".$conn->error."! While inserting in latestpolls",$userId);
			echo 12;
			exit();
		}

	}
}