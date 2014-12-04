<?php
		$conn=new QoB();
		$content=$_POST['_postContent'];//1		
		$rawsharedWith=$_POST['_share'];
		$splitSharedWith=explode(",",$rawsharedWith);
		$n=count($splitsharedWith);
		$postIdHash=$_POST['_postId'];
		$sharedWith="";
		$post=getPostFromHash($postIdHash);
		$userId=$post['userId'];
		$userIdHash=hash("sha512",$userId.SALT);

		if($userIdHash!=$_SESSION['vj'])
		{
			if(blockUserByHash($_SESSION['vj'],"Suspicious session Variable")>=2)
			{
				notifyAdmin("Suspicious session Variable",$userId);
				$_SESSION=array();
				session_destroy();
				return 14;
			}
			else
			{
				$_SESSION=array();
				session_destroy();
				return 13;
			}
			

		}
		else{

				for($i=0;$i<$n;$i++)
				{
					$out=validateSharedWith($splitsharedWith[$i]);
					if($out=="Invalid")
					{
						return 16;
					}
					else{
						$sharedWith=$sharedWith.",".$out;
					}
				}//2
				

				$subject=$_POST['_subject'];//3
						
				$lifetime=$_POST['_validity'];
				
				$isPermanent=false;//4
				
				
				$lastUpdated=time();//7+4=11
				//$seenCount=$starCount=$commentCount=$spamCount=$mailCount=0;//5+7+4=16
				//$seenBy=$mailedBy=$starredBy=$reportedBy=$hiddenTo=$followers='';//6+16=22

				//24
				
				//$displayStatus=1;//25
				//$userIdHash;//26
				//$postId ia genrated Automatically so !!27!!
				//$filesAttached 
				
				$taggedUsers="";//29
				
				$postIdHash = hash("sha512",$postId.SALT);
				//$userIdHash=hash("sha512",$userId.SALT);
				$files=$_POST['_files'];
				if($lifetime=="9999")
				{
					
					$requestPermanence=true;
					
					$lifetime=180;

				}
				else if($lifetime==1||$lifetime==7||$lifetime==15||$lifetime==30||$lifetime==90||$lifetime==180||$lifetime==360)
				{
				
					$requestPermanence=false;

				}
				else
				{
					if(blockUserByHash($_SESSION['vj'],"Illegal Comment Lifetime"))
					{
						echo 14;
						$_SESSION=array();
						session_destroy();
					}
					else
					{
						echo 13;
						$_SESSION=array();
						session_destroy();
					}
					exit();
				}
				$time=time();
				
				$updatePostSQL="UPDATE post  set(content = ?,
					sharedWith = ?,
					subject = ?,
					lifetime = ?,
					lastUpdated = ?,
					requestPermanence = ?,filesAttached = ?,postIdHash = ?) VALUES(?, ?,?,?,?,  ?,?)";
				//$values[]=array($userIdHash=>'s');
				//$values[]=array($time=>'i');
				$values[]=array($content=>'s');
				
				$values[]=array($sharedWith=>'s');
				//$values[]=array(''=>'s');//reportedBy
				//$values[]=array(0=>'i');//spamCount
				
				//$values[]=array($postId=>'s');//postID
				$values[]=array($subject=>'s');//subject
				//$values[]=array(0=>'i');//starCount

				//$values[]=array(0=>'i');//mailCount
				//$values[]=array(''=>'s');//mailedBy
				$values[]=array($lifetime=>'s');//lifetime
				
				//$values[]=array(''=>'s');//starredBy
				//$values[]=array('active'=>'s');//status
				$values[]=array($time=>'s');//lastUpdated
				
				/*$values[]=array($likeIndex=>'i');//likeIndex
				$values[]=array($commentIndex=>'i');//commentIndex
				$values[]=array($impIndex=>'i');//impIndex
				$values[]=array($mailToIndex=>'i');//mailToIndex
				$values[]=array($popularityIndex=>'i')//popularityIndex*/
				
				$values[]=array($requestPermanence=>'i');//requestPermanence
				$values[]=array($filesAttached =>'s');//filesAttached
				//$values[]=array($postIdHash=>'s');//postidhash
				//$values[]=array($postUserName=>'s');//posting user name
				
				$SQLResponse=$conn->update($updatePostSQL,$values);
				//------------------------------------------------------------------------!!!!!-----
				if($conn->error=="")
				{
						$postUserName=$user['name'];
						$postValidity=$lifetime;
						$postSubject=$subject;
						$postContent=$content;
						$noOfStars=$starCount;
						$noOfComments=$commentCount;
						$noOfMailTos=$mailCount;
						$postSeenNumber=$seenCount;
						$postCreationTime=$timestamp;
						$followPost=1;
						$postUserIdHash=$userIdHash;
						$hasStarred=hasStarred($userId,$user['starredBy']);

						$postObj=new miniPost($postIdHash,$sharedWith,$postValidity,$postUserName,$postSubject,$postContent, 
			$noOfStars,$noOfComments, $noOfMailTos,$postSeenNumber,$postCreationTime,$followPost,$postUserIdHash,$userId,$hasStarred);
						echo json_encode($postObj);
					}
				}
				else{
					echo $conn->error;
				}
				
			//------------------------------------------------------------------------!!!!!-----
		}
?>