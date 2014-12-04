<?php
	session_start();	
	require_once('../../QOB/qob.php');
	require_once('./miniClasses/miniPost.php');
	require_once('../fetch.php');
	
	/*$userIdHash=$_SESSION['vj']=hash("sha512","COE12B013".SALT);
	$_SESSION['tn']=hash("sha512",$userIdHash.SALT2);*/
	
	 //Inputs for testing
	/*$_POST['_postContent']="Some random Stuff";
	$_POST['_share']="EDS,COE,EDM,MDM";
	$_POST['_validity']=30;
	$_POST['_subject']="Reply!!"; */
	//Inputs for testing ends  
	
	//echo $_SESSION['vj'].' '.$_SESSION['tn'];
	//print_r($_SESSION);


/*Code 3: SUCCESS!!
Code 13: SECURITY ALERT!! SUSPICIOUS BEHAVIOUR!!
Code 12: Database ERROR!!
code 14: Suspicious Behaviour and Blocked!
Code 16: Erroneous Entry By USER!!
Code 11: Session Variables unset!!*/


if(!(isset($_SESSION['vj'])&&isset($_SESSION['tn'])))
{
	echo 11;
	exit();
}

//var_dump($_POST);
//echo $_POST['_share'];*/





//Actual Code Starts
	$conn= new QoB();
	$userIdHash=$_SESSION['vj'];
	//echo $_SESSION['vj'];
	//Checking the session varianles. Second Level Protection
	
	if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
	{
		// var_dump($_SESSION);
		// echo hash("sha512",$userIdHash.SALT2).'<br/>'.$_SESSION['tn'];
		notifyAdmin("Suspicious session variable in createPost",$userIdHash);
		//$_SESSION=array();
		//session_destroy();
		echo 13;
		exit();
	}
	else
	{
		//Checking if the user Exists with the given hash! Third Level protection!!
		if(($user=getUserFromHash($userIdHash))==false)
		{
			//echo "a";
			notifyAdmin("Critical Error!! in createPost!!",$userIdHash);
			//$_SESSION=array();
			//session_destroy();
			echo 13;
			exit();
		}
		else
		{
			$content=trim($_POST['_postContent']);//1
			if($content=="")
			{
				echo 16;
				exit();
			}
			$postUserName=$user['name'];
			$userId=$user['userId'];
			$rawsharedWith=$_POST['_share'];
			$rawsharedWith=trim($rawsharedWith);
			//echo $rawsharedWith;
			if($rawsharedWith=="")
			{
				echo 16;
				exit();
			}
			$splitSharedWith=explode(",",$rawsharedWith);
			$n=count($splitSharedWith);
			//echo $n+1;
			//var_dump($splitSharedWith);
			$sharedWith="";
			if(stripos($rawsharedWith,"All")===false)
			{
				if($rawsharedWith!=",")
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
			//echo $sharedWith;
			
			$subject=trim($_POST['_subject']);//3
			$lifetime=$_POST['_validity'];
			$isPermanent=false;//4
			if($lifetime==9999)
			{
				$requestPermanence=true;
				$lifetime=180;
			}
			else if(($lifetime==1)||($lifetime==7)||($lifetime==15)||($lifetime==30)||($lifetime==90)||($lifetime==180)||($lifetime==365))
			{
				$requestPermanence=false;
			}
			else
			{
				if(blockUserByHash($_SESSION['vj'],"Illegal Post Lifetime in createPost"))
				{
					$_SESSION=array();
					session_destroy();
					echo 14;
					exit();
				}
				else
				{
					notifyAdmin("Illegal Post Lifetime in CreatePost",$userId);
					$_SESSION=array();
					session_destroy();
					echo 13;
					exit();
				}
			}

			$lifetime=$lifetime*86400+time();
			$mailToIndex=$commentIndex=$likeIndex=$lastUpdated=$timestamp="".time();//7+4=11
			$popularityIndex=$impIndex=0;
			$seenCount=$starCount=$commentCount=$spamCount=$mailCount=0;//5+7+4=16
			$displayStatus=1;//25
			$taggedUsers="";//29
			
			$FetchMaxPostIDSQL="SELECT MAX(postId) as maxPostId FROM post";
			$maxPostID=$conn->fetchALL($FetchMaxPostIDSQL,false);
			if($conn->error!="")
			{
				notifyAdmin("Conn.Error.:".$conn->error."!In Create Post!!",$userId);
				//echo "max12";
				exit();
			}
			else
			{
				$pid=$maxPostID['maxPostId'];
				if($pid!=NULL)
				{
					$postId=$pid+1;	
				}
				else
				{
					$postId=1;
				}
			}
			
			
			
			
			
			$postIdHash = hash("sha512", $postId.POCHASH);
			$filesAttached="";
			$followers=$userId;

			$conn->startTransaction();
			$createPostSQL="INSERT INTO post (userId,timestamp,content,
				sharedWith,
				subject,
				lifetime,
				lastUpdated,
				likeIndex,commentIndex,impIndex,mailToIndex,popularityIndex,
				requestPermanence,filesAttached,postIdHash,followers,postId) VALUES(?,?,?, ?,?,?,?, ?,?,?,?,?, ?,?,?,?,?)";
			

			$values[0]=array($userId=>'s');
			$values[1]=array($timestamp=>'i');
			$values[2]=array($content=>'s');
			
			$values[3]=array($sharedWith=>'s');
						
			$values[4]=array($subject=>'s');//subject


			$values[5]=array($lifetime=>'s');//lifetime
				
			$values[6]=array($timestamp=>'s');//lastUpdated
			
			$values[7]=array($likeIndex=>'s');//likeIndex
			$values[8]=array($commentIndex=>'s');//commentIndex
			$values[9]=array($impIndex=>'s');//impIndex
			$values[10]=array($mailToIndex=>'s');//mailToIndex
			$values[11]=array($popularityIndex=>'s');//popularityIndex
			
			$values[12]=array($requestPermanence=>'i');//requestPermanence
			$values[13]=array($filesAttached =>'s');//filesAttached
			$values[14]=array($postIdHash=>'s');//postidhash
			$values[15]=array($followers => 's' );
			$values[16]=array($postId => 'i');
			$SQLResponse=$conn->insert($createPostSQL,$values);
			if($conn->error=="")
				{
					 //echo "in comment";
					 $CreateCommentTableSQL='CREATE TABLE `'.DB.'`.`'.'p'.$postId.'c'.'` (
					`commentId` INT NOT NULL AUTO_INCREMENT,
					`content` TEXT NOT NULL ,
					`userId` TEXT NOT NULL ,
					`personTags` LONGTEXT NULL ,
					`timestamp` BIGINT NOT NULL,
					`commentIdHash` VARCHAR(128) NOT NULL,
					PRIMARY KEY (`commentId`,`commentIdHash`) 
					) ENGINE = InnoDB ';
					//echo $CreateCommentTableSQL;
					//$nconn = @new mysqli(HOST, USER, PASSWORD, DB);
					$res=$conn->runSimpleQuery($CreateCommentTableSQL);
					//$preparedStatement=$nconn->prepare($CreateCommentTableSQL);
					//if($conn->error!=""&&$res==false)
					if($conn->error!="")
					{
						$cr=$conn->error;
						$conn->rollbackTransaction();
						//echo "Conn.Error: ".$cr."!!InCreatePostComment".$userId;
						notifyAdmin("Conn.Error: ".$cr."!!InCreatePostComment",$userId);						
						echo 12;
						exit();
					}
					else
					{
						//echo "finished Comment";
						
						$postUserName=$user['name'];
						$postValidity=$_POST['_validity'];
						$postSubject=$subject;
						$postContent=$content;
						$noOfStars=$starCount;
						$noOfComments=$commentCount;
						$noOfMailTos=$mailCount;
						$postSeenNumber=$seenCount;
						// $postCreationTime=$timestamp;

						$ts = new DateTime();
						$ts->setTimestamp($timestamp);
						$postCreationTime=$ts->format(DateTime::ISO8601);


						$followPost=1;
						$postUserIdHash=$userIdHash;
						$hasStarred = -1;
						$comments="";
						$isOwner=1;
							$postObj=new miniPost($postIdHash,$rawsharedWith,$postValidity,$postUserName,$postSubject,$postContent, 
							$noOfStars,$noOfComments, $noOfMailTos,$postSeenNumber,$postCreationTime,$followPost,$postUserIdHash,$userId,$hasStarred,$comments,$isOwner);
							
							
						
						//$postObj = getPostFromHash($postIdHash);
						
						$conn->completeTransaction();
						
						//print_r $postObj;
						//echo $postObj['userId'];
						//print_r(json_encode($postObj));
						print_r(json_encode($postObj));
						
						
						//var_dump($postObj);
						//echo 'success';
					}
				}
				else
				{
					$cr=$conn->error;
					//echo $conn->error;
					$conn->rollbackTransaction();
					notifyAdmin("Conn.Error".$cr."!! In CreatePost", $userId);
					echo 12;
					exit();
				}
		}

	}

?>