<?php

	session_start();
	//$_SESSION['vj'] = '4dbb5a2f9314875d41855940f194da51e2bf06b8bfbbd53257fcfbb3115e468e6c6862485992163e22a7ba03b41bac72e128532b70032bbb5cdf6bf7d20de668';
	
	if(isset($_SESSION['vj']))
		{
			error_reporting(E_ALL ^ E_NOTICE);
			//error_reporting(E_ALL ^ E_WARNING);
			require_once 'miniClasses/miniPost.php';
			require_once 'miniClasses/miniComment.php';
			require_once '../../QOB/qob.php';
			require_once '../fetch.php';
			require_once 'functions.php';
			
			$_SESSION['jx']="999"; //999 for latest posts 998 for popular posts 997 for important posts
			//$arrayOfPostsShown = array();
			//print_r($_POST['_posts']);
			latest($_POST['_posts']);

		}

	else
		{
			//////echo "Session Variable not set error <br/>";
			echo "404<br/>";
		}
		
	function latest($arrayOfPostsShown)
		{
			$conObj = new QoB();
			$limit = 5;
			
			$values1 = array(0 => array($_SESSION['vj'] => 's'));
			$result1 = $conObj->fetchAll("SELECT userId FROM users WHERE userIdHash = ?",$values1);
			$outputa = array();
			$postIdHashArray = array();
			
			if($conObj->error == "")
				{
					if($result1 != "")
						{
							$currentUserId = $result1['userId'];
							
							//////echo "This the current user id <br/>";
							//////echo $currentUserId.'<br/>';
							
							$postIdHashArray = fetchPostIdHashes($arrayOfPostsShown,$limit,$currentUserId);
							////print_r($postIdHashArray);
							
							$outputa = fetchPosts($postIdHashArray,$currentUserId);

							if($outputa[0] == 1)
								{
									$outputArrayLength = count($outputa);
									$jasonarray;
									
									for($i = 0;$i<$outputArrayLength-1;$i++)
										{
											
											//////////echo '<h3>POSTID</h3><br>' .$outputa[$i]->postId.'<br>';
											/*//////////echo '<h3>SHARED WITH</h3><br>' .$outputa[$i]->sharedWith.'<br>';
											//////////echo '<h3>POST VALIDITY</h3><br>' .$outputa[$i]->postValidity.'<br>';
											//////////echo '<h3>POST USERs ID</h3><br>' .$outputa[$i]->postUserId.'<br>';
											//////////echo '<h3>PROFILE PIC</h3><br>' .$outputa[$i]->postProfilePic.'<br>';
											*/
											
											////////////echo '<h3>POST USER NAME</h3><br>' .$outputa[$i]->postUserName.'<br>';
											//////echo '<h3>SUBJECT</h3><br>' .$outputa[$i+1]->postSubject.'<br>';
											//////////echo '<h3>CONTENT</h3><br>' .$outputa[$i]->postContent.'<br>';
											/*//////////echo '<h3>NO OF STARS</h3><br>' .$outputa[$i]->noOfStars.'<br>';
											//////////echo '<h3>NO OF COMMENTS</h3><br>' .$outputa[$i]->noOfComments.'<br>';
											*/
											
											/*//////////echo '<h3>NO OF MAIL TOs</h3><br>' .$outputa[$i]->noOfMailTos.'<br>';
											//////////echo '<h3>NO OF SEEN</h3><br>' .$outputa[$i]->postSeenNumber.'<br>';
											//////////echo '<h3>TIMESTAMP</h3><br>' .$outputa[$i]->postCreationTime.'<br>';
											//////////echo '<h3>FOLLOW</h3><br>' .$outputa[$i]->followPost.'<br>';
											//////////echo '<h3>COMMENTS</h3><br>';
											*/
											$jasonarray[$i] = $outputa[$i+1];
											
										}

										print_r(json_encode($jasonarray));
								}
							else if($outputa[0] == -1)
								{
									//////echo "No posts left to fetch <br/>";
									echo 404;
								}
						}
						
					else
						{
							//////echo "No values found for Query 1 of latest function <br/>";
						}
				}
				
			else
				{
					//////echo "Error in Query 1 of latest function <br/>";
					//////echo $conObj->error.'<br/>';
				}
				
			
			
			
		}
		
	function fetchPostIdHashes($arrayOfPostsShown,$limit,$currentUserId)
		{

			/*echo "This is the posts shown array<br/>";
			print_r($arrayOfPostsShown);
			echo '<br/>';*/

			$conObj = new QoB();
			$arrayOfPostsShownLength = count($arrayOfPostsShown);
			
			//Current user id is nothing but roll number.
			//$regex stores userId regular expression.
			
			$regex = getRollNoRegex($currentUserId);
			
			//echo "This the value of regex <br/>";
			//echo $regex.'<br/>';
			
			$rollNoToCompare = '%'.$currentUserId.'%';
			//echo "This the value of rollNoToCompare <br/>";
			//echo $rollNoToCompare.'<br/>';
			
			$date = date_create();
			$currentTimestamp = date_timestamp_get($date);
			
			//echo "This the value of currentTimestamp <br/>";
			//echo $currentTimestamp.'<br/>';
			
			$returnArray = array();
			
			
			//CHECK LIFETIME FETCH....
			
			if($arrayOfPostsShownLength == 0)
				{
					$values2 = array(0=> array($currentUserId => 's'),1 => array($regex => 's'), 2=> array($rollNoToCompare => 's'), 3=> array($currentTimestamp => 'i'), 4 => array(0 => 'i'), 5 => array($limit => 'i'));	
					
					$result2 = $conObj->select("SELECT postIdHash FROM post WHERE ((userId = ?) or (sharedWith REGEXP ?)) AND (hiddenTo NOT LIKE ?) AND (lifetime > ?) ORDER BY timestamp DESC LIMIT ?,?",$values2);
					
					if($conObj->error == "")
						{
							$returnArrayIndex = 0;
							
							while($postIdHashes = $conObj->fetch($result2))
								{
									////echo "hi<br/>";
									////echo "This is the postIdHash<br/>";
									////echo $postIdHashes['postIdHash'].'<br/>';
									
									$returnArray[$returnArrayIndex] = $postIdHashes['postIdHash'];
									$returnArrayIndex++;
								}
						}
						
					else
						{
							//////echo "Error in Query 2 where arrayOfPostsShown length = 0, Query in fetchPostIdHashes <br/>";
							//////echo $conObj->error.'<br/>';
						}
				}
				
			else if($arrayOfPostsShownLength > 0)
				{
					// echo "hi length ! =0 <br/>";

					$sql = "SELECT postIdHash FROM post WHERE ((userId = ?) or (sharedWith REGEXP ?)) AND (hiddenTo NOT LIKE ?) AND (lifetime > ?) AND (postIdHash != ";
					
					$arrayOfPostsShownIndex = 0;
					$values2 = array();
					
					$values2[0] = array($currentUserId => 's');
					$values2[1] = array($regex => 's');
					$values2[2] = array($rollNoToCompare => 's');
					$values2[3] = array($currentTimestamp => 'i');
					
					while($arrayOfPostsShownIndex<$arrayOfPostsShownLength)
						{
							if($arrayOfPostsShownIndex == $arrayOfPostsShownLength - 1)
								{
									$sql = $sql." ? )";
								}
							else
								{
									$sql = $sql." ? ) AND (postIdHash != ";
								}
								
							$values2[$arrayOfPostsShownIndex+4] = array($arrayOfPostsShown[$arrayOfPostsShownIndex]=>'s');
							$arrayOfPostsShownIndex++;
						}
						
					$sql = $sql." ORDER BY timestamp DESC LIMIT ?,?";
					//echo "This is the value of sql <br/>";
					//echo $sql.'<br/>';
					$values2[$arrayOfPostsShownIndex+4] = array(0 => 'i');
					$values2[$arrayOfPostsShownIndex+5] = array($limit => 'i');
					
					//echo "This is the values array <br/>";
					//print_r($values2);

					$result2 = $conObj->select($sql,$values2);
					
					if($conObj->error == "")
						{
							$returnArrayIndex = 0;
							
							while($postIdHashes = $conObj->fetch($result2))
								{
									$returnArray[$returnArrayIndex] = $postIdHashes['postIdHash'];
									$returnArrayIndex++;
								}
						}
						
					else
						{
							//echo "Error in Query 2 where arrayOfPostsShown length != 0, Query in fetchPostIdHashes <br/>";
							//echo $conObj->error.'<br/>';
						}
				}
				
			return $returnArray;
		}
		
	function fetchPosts($postIdHashArray,$currentUserId)
		{
			$conObj = new QoB();
			
			//////////echo 'Hi fetch posts<br/>';
			$postIdHashArrayLength = count($postIdHashArray);
			
			//////////echo 'The post Id Hash Array Length is '.$postIdHashArrayLength.'<br/>';
			$returnArray = array();
			
			//Starts from 1, 0 is left to check whether there are any posts or not.
			$returnArrayIndex = 1;
			
			if($postIdHashArrayLength == 0)
				{
					$returnArray[0] = -1;
				}
			else
				{
					$returnArray[0] = 1;
					
					$sql = "SELECT * FROM post WHERE postIdHash = ";
					$postIdHashArrayIndex = 0;
					$values4 = array();
					
					while(($postIdHashArrayIndex < $postIdHashArrayLength))
						{
							if($postIdHashArrayIndex == $postIdHashArrayLength-1)
								{
									$sql = $sql."?";
								}
							else
								{
									$sql = $sql."? or postIdHash = ";
								}
								
							$values4[$postIdHashArrayIndex] = array($postIdHashArray[$postIdHashArrayIndex] => 's');
							$postIdHashArrayIndex++;	
							
						}
						
					$sql = $sql." ORDER BY timestamp DESC";
					
					//////////echo "The value of sql is ".$sql."<br/>";
					//////////echo "The value of values array is <br/>";
					
					// //////print_r($values4);
					
					//////////echo '<br/>';
					
					$result4 = $conObj->select($sql,$values4);
					
					if($conObj->error == "")
					{
						while($latestPosts = $conObj->fetch($result4))
						{
							//////////echo "This is lifetime ".$latestPosts['lifetime']."<br/>";
							$days = ($latestPosts['lifetime'] - $latestPosts['timestamp'])/86400;
							$followPost = isFollowing($latestPosts['userId'],$latestPosts['followers']);
							$userIdHash = getHash($latestPosts['userId']);
							
							//print $userIdHash;
							$postUserName = getName($latestPosts['userId']);
							//print $postUserName;
							$ts = new DateTime();
							$ts->setTimestamp($latestPosts['timestamp']);
							$timestamp=$ts->format(DateTime::ISO8601);
							// $timestamp="2008-07-17T09:24:17Z";
							$postOwner=-1;
							////////////echo $currentUserId." ".$latestPosts['userId'];
							
							if(strcasecmp($currentUserId,$latestPosts['userId']) == 0)
								{
									////////////echo "compared correctly";
									$postOwner = 1;
								}
							else
								{
									$postOwner = -1;
								}
								
							$postId = 'p'.$latestPosts['postId'].'c';
							$commentResult = $conObj->select("SELECT * FROM ".$postId." ORDER BY timestamp DESC LIMIT 0,3");
							
							$userId = "";
							
							if($conObj->error == "")
								{
									$noofelementsc = 0;
									$outputac = "";
									
									while($postComments = $conObj->fetch($commentResult))
										{
											$commentId = $postComments['commentId'];
											$content = $postComments['content'];
											$userId = $postComments['userId'];
											
											$userIdHash = getHash($userId);
											
											$personTags = $postComments['personTags'];
											$timestamp = $postComments['timestamp'];
											$commentIdHash = $postComments['commentIdHash'];
											
											//$idAndName = getIdAndName($userIdHash);
											//$commentUserId = $idAndName[1];
											$commentUserName = getName($userId);
											$commentOwner = -1;

											if($userIdHash == $_SESSION['vj'])
												{
													$commentOwner = 1;
												}

											
											
											$objc = new miniComment($latestPosts['postIdHash'],$userIdHash,$postComments['content'],$postComments['timestamp'],$postComments['commentIdHash'],$userId,$commentUserName,$commentOwner);
											
											$outputac[$noofelementsc] = $objc;
											
											$noofelementsc++;
										}
									
									if($noofelementsc == 0)
										{
											////////////echo 'No values found for Query of Comments<br />';	
										}
								
								}
							else
								{
									////////////echo 'Error in Query of comments<br />';
									////////////echo $conObj->error.'<br />';
									//return -1;
								}
							
							$hasStarred = hasStarred($currentUserId, $latestPosts['starredBy']);
							
							
							////////print_r($outputac);
							////////////echo $outputac[1]->commentUserId;
							////////////echo '<br /> above obj'.$postOwner;
							///
							/*$strx="";
							for($i=0;$i<strlen($latestPosts['sharedWith']);$i++)
							{
								if($latestPosts['sharedWith'][$i]!='^' && $latestPosts['sharedWith'][$i]!='.' && $latestPosts['sharedWith'][$i]!='$')
								{
									$strx=$strx.$latestPosts['sharedWith'][$i];
								}
							}*/
							
							$returnArray[$returnArrayIndex] = new miniPost($latestPosts['postIdHash'],$latestPosts['sharedWith'],$days,$postUserName,$latestPosts['subject'],$latestPosts['content'],$latestPosts['starCount'],$latestPosts['commentCount'],$latestPosts['mailCount'],$latestPosts['seenCount'],$timestamp,$followPost,$userIdHash,$latestPosts['userId'],$hasStarred,$outputac,$postOwner );

							//////echo "Value of jason encode object <br/>";
							////print_r(json_encode($returnArray[$returnArrayIndex]));
							$returnArrayIndex++;
								
						}
					}
				else
					{
						//////////echo "Error in query of fetchpost <br/>";
						//////////echo $conObj->error.'<br/>';
					}
				
				}
					
			return $returnArray;		
		}	
?>