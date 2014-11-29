/*$userId,$subject,$content,$seenCount,$postId,$starCount,$mailCount,$commentCount,$timestamp,$reportedBy,
        $spamCount,$mailedby,$isPermanent,$starredBy,$displayStatus,$lastUpdated,$likeIndex,$commentIndex,$lifetime,$impIndex,
        $requestPermanence,$popularityIndex,$followers,$hiddenTo,$filesAttached,$mailToIndex,$sharedWith,$seenBy.$taggedUsers*/
		$conn=new QoB();
		//$nconn = new mysqli(HOST, USER, PASSWORD, DB);
		$content=$_POST['_postContent'];//1
		$userIdHash=$_SESSION['vj'];

		if(hash("sha512",$userIdHash.SALT2)!=$_SESSION['tn'])
		{
			/*if(blockUserByHash($_SESSION['vj']))
			{
				echo 14;
				$_SESSION=array();
				session_destroy();
			}
			else if(blockUserByHash($userIdHash))
			{
				echo 14;
				$_SESSION=array();
				session_destroy();
			}
			else
			{*/
				$combination=$userIdHash.",".$_SESSION['tn'];
				notifyAdmin("Suspicious Session variable in CreatePost",$combination);
				$_SESSION=array();
				session_destroy();
				return 13;
			//}
			

		}
		else
		{
			if(($user=getUserFromHash($userIdHash))==false)
			{
				notifyAdmin("Critical Error!! In createPost",$userIdHash);
				$_SESSION=array();
				session_destroy();
				return 13;
			}
			else
			{
				$postUserName=$user['name'];
				$userId=$user['userId'];
				$rawsharedWith=$_POST['_share'];
				$splitSharedWith=explode(",",$rawsharedWith);
				$n=count($splitsharedWith);
				$sharedWith="";
				for($i=0;$i<$n;$i++)
				{

					$out=validateSharedWith($splitsharedWith[$i]);
					if($out=="Invalid")
					{
						echo 16;
						exit();
					}
					else
					{
						$sharedWith=$sharedWith.",".$out;
					}
				}//2
				

				$subject=$_POST['_subject'];//3
						
				$lifetime=$_POST['_validity'];
				$isPermanent=false;//4
				
				
				$mailToIndex=$popularityIndex=$commentIndex=$impIndex=$likeIndex=$lastUpdated=$timestamp=time();//7+4=11
				$seenCount=$starCount=$commentCount=$spamCount=$mailCount=0;//5+7+4=16
				//$seenBy=$mailedBy=$starredBy=$reportedBy=$hiddenTo=$followers='';//6+16=22

				if($lifetime=="Request 'Forever'")
				{
					$requestPermanence=true;
					$lifetime=180;
				}
				else
				{
					$requestPermanence=false;
				}//24
				$displayStatus=1;//25
				//$userIdHash;//26
				//$postId ia genrated Automatically so !!27!!
				//$filesAttached 
				$taggedUsers="";//29
				$FetchMaxPostIDSQL="SELECT MAX(postId) FROM post";
				$maxPostID=$conn->fetchALL($FetchMaxPostIDSQL,,false);
				$pid=$maxPostID['postId'];
				$postId=$pid+1;
				$postIdHash = hash("sha512", $postId.SALT);

				$files=$_POST['_files'];


				
				$time=time();
				$conn->startTransaction();
				$createPostSQL="INSERT INTO post (userId,timestamp,content,
					sharedWith,
					subject,
					lifetime,
					lastUpdated,
					$likeIndex,$commentIndex,$impIndex,$mailToIndex,$popularityIndex,
					requestPermanence,filesAttached,postIdHash) VALUES(?,?,?, ?,?,?,?, ?,?,?,?,?, ?,?,?,?)";
				$values[]=array($userId=>'s');
				$values[]=array($time=>'i');
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
				
				$values[]=array($likeIndex=>'i');//likeIndex
				$values[]=array($commentIndex=>'i');//commentIndex
				$values[]=array($impIndex=>'i');//impIndex
				$values[]=array($mailToIndex=>'i');//mailToIndex
				$values[]=array($popularityIndex=>'i')//popularityIndex
				
				$values[]=array($requestPermanence=>'i');//requestPermanence
				$values[]=array($filesAttached =>'s');//filesAttached
				$values[]=array($postIdHash=>'s');//postidhash
				//$values[]=array($postUserName=>'s');//posting user name
				
				$SQLResponse=$conn->insert($createPostSQL,$values);
				//------------------------------------------------------------------------!!!!!-----
				if($conn->error=="")
				{
					 
					 $CreateCommentTableSQL='CREATE TABLE `'.DB.'`.`'.'p'.$postId.'c'.'` (
					`commentId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`content` TEXT NOT NULL ,
					`userIdHash` TEXT NOT NULL ,
					`personTags` LONGTEXT NULL ,
					`timestamp` BIGINT NOT NULL,
					`commentIdHash` TEXT NOT NULL 
					) ENGINE = MYISAM ';
					
					//$nconn = @new mysqli(HOST, USER, PASSWORD, DB);
					$conn->runSimpleQuery($CreateCommentTableSQL);
					//$preparedStatement=$nconn->prepare($CreateCommentTableSQL);
					if($conn->error!="")
					{
						echo 12;
						
						$conn->rollbackTransaction();
					}
					else
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
						$followPost=isFollowing();
						$postUserIdHash=$userIdHash;
							$postObj=new miniPost($postIdHash,$sharedWith,$postValidity,$postUserName,$postSubject,$postContent, 
			$noOfStars,$noOfComments, $noOfMailTos,$postSeenNumber,$postCreationTime,$followPost,$postUserIdHash,$userId,$hasStarred);
						
						echo json_encode($postObj);
						
						$conn->completeTransaction();
					}
				}
				else
				{
					echo $conn->error;
					
					$conn->rollbackTransaction();
				}
			
			}	//------------------------------------------------------------------------!!!!!-----
		
		}