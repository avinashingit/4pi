<?php
	session_start();
	$_SESSION['vj'] = '4dbb5a2f9314875d41855940f194da51e2bf06b8bfbbd53257fcfbb3115e468e6c6862485992163e22a7ba03b41bac72e128532b70032bbb5cdf6bf7d20de668';

	if(isset($_SESSION['vj']))	
		{

			error_reporting(E_ALL ^ E_NOTICE);
			//error_reporting(E_ALL ^ E_WARNING);

				require_once 'miniClasses/miniPost.php';
				require_once 'miniClasses/miniComment.php';
				require_once '../../QOB/qob.php';
				require_once '../fetch.php';
				
				
				$_SESSION['jx']="998"; //999 for latest posts 998 for popular posts 997 for important posts
				
				//echo $_SESSION['mq']; 
				
				if(!isset($_SESSION['qc']))
					{
						$_SESSION['qc'] = array();
					}
				
				include 'functions.php';

			popular(-1);
		}
	else
		{
			echo "It's an error <br/>";
			echo '405';
		}
		
	function popular($modeBit)
		{
			$conObj = new QoB();
			$limit = 5;
			$maxLimit = 20*$limit;
			$noOfPostsShown = 0;
			$hashname = $_SESSION['vj'];
			$values1 = array(0 => array($hashname=>'s') );
			$result1 = $conObj->fetchAll("SELECT userId FROM users WHERE userIdHash = ?", $values1);
			$outputa = array();
			
			if($conObj->error == "")
				{
					if($result1 != "")
						{
							$currentUserId = $result1['userId'];
							
							//$modeBit = -1 indicates that this function is called while reloading.
							//$modeBit = 1 indicates that this function is called when user keeps scrolling down.
							
							$outputArray = array();
							
							//$outputArray[0] contains number of valid records,initially 0.
							//$outputArray[1] contains number of records processed, initially -1.
							
							$outputArray[0] = 0;
							$outputArray[1] = -1;
							
							$noOfValidRecords = 0;
							$postIdHashArray = array();
							
							if($modeBit == -1)
								{
									$_SESSION['qc'] = array();
									while(($outputArray[0]<$limit) and (($outputArray[1] < 0) or ($outputArray[1]>$limit)))
										{
											$outputArray = fetchTillLimit($outputArray[0],$maxLimit,$currentUserId);
											while($noOfValidRecords < $outputArray[0])
												{
													$postIdHashArray[$noOfValidRecords] = $outputArray[$noOfValidRecords + 2];
													$noOfValidRecords++;
												}
										}
										
									$outputa = fetchPosts($postIdHashArray);
									//echo "This is the output array <br/>";
									//print_r($outputa);
									//echo '<br/>';
								}
								
							else
								{
									while(($outputArray[0]<$limit) and (($outputArray[1] < 0) or ($outputArray[1]>$limit)))
										{
											$outputArray = fetchTillLimit($outputArray[0],$maxLimit,$currentUserId);
											while($noOfValidRecords < $outputArray[0])
												{
													$postIdHashArray[$noOfValidRecords] = $outputArray[$noOfValidRecords + 2];
													$noOfValidRecords++;
												}
										}
										
									$outputa = fetchPosts($postIdHashArray);
									//echo "This is the output array <br/>";
									//print_r($outputa);
									//echo '<br/>';
								}
								
							$outputArrayLength = count($outputa);
							for($i = 1;$i<$outputArrayLength;$i++)
								{
									
									echo '<h3>POSTID</h3><br>' .$outputa[$i]->postId.'<br>';
									/*echo '<h3>SHARED WITH</h3><br>' .$outputa[$i]->sharedWith.'<br>';
									echo '<h3>POST VALIDITY</h3><br>' .$outputa[$i]->postValidity.'<br>';
									echo '<h3>POST USERs ID</h3><br>' .$outputa[$i]->postUserId.'<br>';
									echo '<h3>PROFILE PIC</h3><br>' .$outputa[$i]->postProfilePic.'<br>';
									*/
									
									//echo '<h3>POST USER NAME</h3><br>' .$outputa[$i]->postUserName.'<br>';
									echo '<h3>SUBJECT</h3><br>' .$outputa[$i]->postSubject.'<br>';
									/*echo '<h3>CONTENT</h3><br>' .$outputa[$i]->postContent.'<br>';
									echo '<h3>NO OF STARS</h3><br>' .$outputa[$i]->noOfStars.'<br>';
									echo '<h3>NO OF COMMENTS</h3><br>' .$outputa[$i]->noOfComments.'<br>';
									*/
									
									/*echo '<h3>NO OF MAIL TOs</h3><br>' .$outputa[$i]->noOfMailTos.'<br>';
									echo '<h3>NO OF SEEN</h3><br>' .$outputa[$i]->postSeenNumber.'<br>';
									echo '<h3>TIMESTAMP</h3><br>' .$outputa[$i]->postCreationTime.'<br>';
									echo '<h3>FOLLOW</h3><br>' .$outputa[$i]->followPost.'<br>';
									echo '<h3>COMMENTS</h3><br>';
									*/
									//$jasonarray[$i] = $outputa[$i];
								}	
						}
					else
						{
							echo "No values found for Query 1<br/>";
						}
					
					
				}
			else
				{
					//echo 'Error in Query 1<br />';
					//echo $conObj->error.'<br />';
				}
		}
		
		
	function fetchTillLimit($noOfValidRecords,$maxLimit,$currentUserId)
		{
			$conObj = new QoB();
			$returnArray = array();
			$noOfProcessedRecords = 0;
			
			//return array starts from 2, 0 and 1 are reserved for number of valid records shown and no of records processed.
			$returnArrayIndex = 2;
			
			$sessionArrayLength = count($_SESSION['qc']);
			
			$limit = $maxLimit/20;
			
			if($sessionArrayLength == 0)
				{
					$values2 = array(0 => array(0 => 'i'),1 => array($maxLimit => 'i'));
					$result2 = $conObj->select("SELECT postIdHash,sharedWith,hiddenTo,lifetime,userId FROM post ORDER BY popularityIndex DESC LIMIT ?,?",$values2);
					
					if($conObj->error == "")
						{
							while(($noOfValidRecords<$limit) and ($row2 = $conObj->fetch($result2)))
								{
									$_SESSION['qc'][$sessionArrayLength] = $row2['postIdHash'];
									$sessionArrayLength++;
									
									$date = date_create();
									$currentTimestamp = date_timestamp_get($date);
									
									if((hiddenTo($currentUserId,$row2['hiddenTo']) == 1) and ($currentTimestamp < $row2['lifetime']) and ((isSharedTo($currentUserId,$row2['sharedWith']) == 1) or ($currentUserId == $row2['userId'])))
										{
											$returnArray[$returnArrayIndex] = $row2['postIdHash'];
											$noOfValidRecords++;
											$returnArrayIndex++;
										}
										
									$noOfProcessedRecords++;	
								}
							
							$returnArray[0] = $noOfValidRecords;
							$returnArray[1] = $noOfProcessedRecords;
						}
					else
						{
							echo "Error in query of fetchTillLimit where sessionArrayLength = 0<br/>";
							echo $conObj->error.'<br/>';
						}
				}
				
			else
				{
					$values3 = array();
					$sessionArrayIndex = 0;
					
					$sql = "SELECT postIdHash,sharedWith,hiddenTo,lifetime,userId FROM post WHERE postIdHash != ";
					while($sessionArrayIndex < $sessionArrayLength)
						{
							if($sessionArrayIndex == $sessionArrayLength-1)
								{
									$sql = $sql."?";
								}
							else
								{
									$sql = $sql."?,";
								}
							
							$values3[$sessionArrayIndex] = array($_SESSION['qc'][$sessionArrayIndex] => 's');	
							$sessionArrayIndex++;
						}
						
					$sql = $sql."ORDER BY popularityIndex DESC LIMIT ?,?";
					$values3[$sessionArrayIndex] = array(0 => 'i');
					$values3[$sessionArrayIndex+1] = array($maxLimit => 'i');
					
					$result3 = $conObj->select($sql,$values3);
					
					if($conObj->error == "")
						{
							while(($noOfValidRecords<$limit) and ($row3 = $conObj->fetch($result3)))
								{
									$_SESSION['qc'][$sessionArrayLength] = $row3['postIdHash'];
									$sessionArrayLength++;
									
									$date = date_create();
									$currentTimestamp = date_timestamp_get($date);
									
									if((hiddenTo($currentUserId,$row3['hiddenTo']) == 1) and ($currentTimestamp < $row3['lifetime']) and ((isSharedTo($currentUserId,$row3['sharedWith']) == 1) or ($currentUserId == $row3['userId'])))
										{
											$returnArray[$returnArrayIndex] = $row3['postIdHash'];
											$noOfValidRecords++;
											$returnArrayIndex++;
										}
										
									$noOfProcessedRecords++;	
								}
							
							$returnArray[0] = $noOfValidRecords;
							$returnArray[1] = $noOfProcessedRecords;	
						}
						
					else
						{
							echo "Error in query of fetchTillLimit where sessionArrayLength != 0<br/>";
							echo $conObj->error.'<br/>';
						}
				}
				
			return $returnArray;	
		}
		
		
		
	function fetchPosts($postIdHashArray)
		{
			$conObj = new QoB();
			
			echo 'Hi fetch posts<br/>';
			$postIdHashArrayLength = count($postIdHashArray);
			
			echo 'The post Id Hash Array Length is '.$postIdHashArrayLength.'<br/>';
			$returnArray = array();
			
			//Starts from 1, 0 is left to check whether there are any posts or not.
			$returnArrayIndex = 1;
			
			if($postIdHashArrayLength == 0)
				{
					$returnArrayIndex[0] = -1;
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
						
					$sql = $sql." ORDER BY popularityIndex DESC";
					
					echo "The value of sql is ".$sql."<br/>";
					echo "The value of values array is <br/>";
					
					print_r($values4);
					
					echo '<br/>';
					
					$result4 = $conObj->select($sql,$values4);
					
					if($conObj->error == "")
					{
						while($latestPosts = $conObj->fetch($result4))
						{
							echo "This is lifetime ".$latestPosts['lifetime']."<br/>";
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
							//echo $currentUserId." ".$latestPosts['userId'];
							
							if(strcasecmp($currentUserId,$latestPosts['userId']) == 0)
								{
									//echo "compared correctly";
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
											//echo 'No values found for Query of Comments<br />';	
										}
								
								}
							else
								{
									//echo 'Error in Query of comments<br />';
									//echo $conObj->error.'<br />';
									//return -1;
								}
							
							$hasStarred = hasStarred($currentUserId, $latestPosts['starredBy']);
							
							
							//print_r($outputac);
							//echo $outputac[1]->commentUserId;
							//echo '<br /> above obj'.$postOwner;
							
							$returnArray[$returnArrayIndex] = new miniPost($latestPosts['postIdHash'],$latestPosts['sharedWith'],$days,$postUserName,$latestPosts['subject'],$latestPosts['content'],$latestPosts['starCount'],$latestPosts['commentCount'],$latestPosts['mailCount'],$latestPosts['seenCount'],$timestamp,$followPost,$userIdHash,$latestPosts['userId'],$hasStarred,$outputac,$postOwner );
							
							//echo "This is the returnArray [".$returnArrayIndex."] value is <br/>";
							//echo $returnArray[$returnArrayIndex]
							
							/*echo '<h3>POSTID</h3><br>' .$returnArray[$returnArrayIndex]->postId.'<br>';
							echo '<h3>SHARED WITH</h3><br>' .$returnArray[$returnArrayIndex]->sharedWith.'<br>';
							echo '<h3>POST VALIDITY</h3><br>' .$returnArray[$returnArrayIndex]->postValidity.'<br>';
							echo '<h3>POST USERs ID</h3><br>' .$returnArray[$returnArrayIndex]->postUserId.'<br>';
							echo '<h3>PROFILE PIC</h3><br>' .$returnArray[$returnArrayIndex]->postProfilePic.'<br>';

							echo '<h3>POST USER NAME</h3><br>' .$returnArray[$returnArrayIndex]->postUserName.'<br>';
							echo '<h3>SUBJECT</h3><br>' .$returnArray[$returnArrayIndex]->postSubject.'<br>';
							echo '<h3>CONTENT</h3><br>' .$returnArray[$returnArrayIndex]->postContent.'<br>';
							echo '<h3>NO OF STARS</h3><br>' .$returnArray[$returnArrayIndex]->noOfStars.'<br>';
							echo '<h3>NO OF COMMENTS</h3><br>' .$returnArray[$returnArrayIndex]->noOfComments.'<br>';

							echo '<h3>NO OF MAIL TOs</h3><br>' .$returnArray[$returnArrayIndex]->noOfMailTos.'<br>';
							echo '<h3>NO OF SEEN</h3><br>' .$returnArray[$returnArrayIndex]->postSeenNumber.'<br>';
							echo '<h3>TIMESTAMP</h3><br>' .$returnArray[$returnArrayIndex]->postCreationTime.'<br>';
							echo '<h3>FOLLOW</h3><br>' .$returnArray[$returnArrayIndex]->followPost.'<br>';
							echo '<h3>COMMENTS</h3><br>';*/

							$returnArrayIndex++;
								
						}
					}
				else
					{
						echo "Error in query of fetchpost <br/>";
						echo $conObj->error.'<br/>';
					}
				
				}
					
			return $returnArray;		
		}
				
				
	
	//////echo 'second call to important <br />';
	//echo 'session variable'.$_SESSION['mq'].'<br />';
	//slatest();

?>
