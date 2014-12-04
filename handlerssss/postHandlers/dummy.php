<?php

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//error_reporting(E_ALL ^ E_WARNING);

	include 'miniPost.php';
	include 'miniComment.php';
	require '../QOB/qob.php';
	session_start();
	//$_SESSION['vj'] = "12345";
	$_SESSION['mq'] = 2;
	
	function sharedWith($userid,$sharedwith)
		{
			//if(strcasecmp($userid,$sharedwith) == 0)
				//{
					return 1;
				//}
		}
		
	function isFollowing($userId,$followers)
		{
			$followersarray = explode(',',$followers);
			$nooffollowers = count($followersarray);
			
			$output = 0;
			for($i = 0;$i<$nooffollowers;$i++)
				{
					if(strcmp($userId,$followersarray[$i]) == 0)
						{
							$output++;
							break;
						}
				}
				
			if($output == 0)
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
			$hiddenToarray = explode(',',$hiddenTo);
			$noofhidden = count($hiddenToarray);
			
			$output = 0;
			for($i = 0;$i<$noofhidden;$i++)
				{
					if(strcmp($userId,$hiddenToarray[$i]) == 0)
						{
							$output++;
							break;
						}
				}
				
			if($output == 0)
				{
					return -1;
				}
			else
				{
					return 1;
				}
		}

	function getHash($userId)
		{
			$conObj = new QoB();
			$values1 = array(0 => array($userId => 's'));
			////echo "*********".$userId;
			$result1 = $conObj->fetchall("SELECT userId FROM users WHERE userId = ? ",$values1,false);
			
			//print_r( $result1);
			
			$output;
			if($conObj->error == "")
				{
					if($result1!= "")
						{
							$output = $result1['userId'];
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
		
	
		
	function latest()
		{
			$conObj = new QoB();
			$limit = 5;
			$maxlimit = 20*$limit;
			$noofpostsshown = 0;
			$hashname = $_SESSION['vj'];
			$values1 = array(0 => array($hashname=>'s') );
			$result1 = $conObj->select("SELECT userId FROM users WHERE userId = ?", $values1);
			
			if($conObj->error == "")
				{
					$row1 = $conObj->fetch($result1);
					$userid = $row1['userId'];
					$values2 = array(0 => array($_SESSION['mq']=>'i'), 1 => array($maxlimit=>'i')); 
					$result2 = $conObj->select("SELECT * FROM post order by timestamp DESC LIMIT ?,?",$values2);
							
					if($conObj->error == "")
						{
							$noofelements2 = 0;
							while(($row2 = $conObj->fetch($result2))&&($noofpostsshown<$limit))
								{
									
									$sharedWith = $row2['sharedWith'];
									
									if(sharedwith($userid,$sharedWith) == 1)
										{
											$hiddenTo = $row2['hiddenTo'];
											$isHidden = hiddenTo($userid,$hiddenTo);
											if($isHidden == -1)
												{
													$userId = $row2['userId'];
													$content = $row2['content'];
													$timestamp = $row2['timestamp'];
													$reportedBy = $row2['reportedBy'];
													$spamCount = $row2['spamCount'];
													
													$postId = $row2['postId'];
													$subject = $row2['subject'];
													$starCount = $row2['starCount'];
													$mailCount = $row2['mailCount'];
													$mailedBy = $row2['mailedBy'];
													
													$isPermanent = $row2['isPermanent'];
													$starredBy = $row2['starredBy'];
													$displayStatus = $row2['displayStatus'];
													$lastUpdated = $row2['lastUpdated'];
													$likeIndex = $row2['likeIndex'];
													
													$commentIndex = $row2['commentIndex'];
													$lifetime = $row2['lifetime'];
													$impIndex = $row2['impIndex'];
													$requestPermanence = $row2['requestPermanence'];
													$popularityIndex = $row2['popularityIndex'];
													
													$followers = $row2['followers'];
													$filesAttached = $row2['filesAttached'];
													$commentCount = $row2['commentCount'];
													$mailToIndex = $row2['mailToIndex'];
													
													$taggedUsers = $row2['taggedUsers'];
													$seenBy = $row2['seenBy'];
													$seenCount = $row2['seenCount'];
													//$postUserName = $row2['$postUserName'];
													$postIdHash = $row2['postIdHash'];
													
													//$postProfilePic;
													$followPost = isFollowing($userId,$followers);
													
													
													$userIdHash = getHash($userId);
													
													//print $userIdHash;
													
													
													$postUserName = getName($userId);
													
													//print $postUserName;
													
													$obj = new miniPost($postIdHash,$sharedWith,$lifetime,$postUserName,$subject,$content,$starCount,$commentCount,$mailCount,$seenCount,$timestamp,$followPost,$userIdHash,$userId);
													
													$outputa[$noofpostsshown] = $obj;
													
													/*//$commentvalues = array(0 => array($postId => 's'));
													$commentResult = $conObj->select("SELECT * FROM ".$postId." ORDER BY timestamp DESC LIMIT 0,3");
													
													if($conObj->error == "")
														{
															$noofelementsc = 0;
															while($rowc = $conObj->fetch($commentResult))
																{
																	$commentId = $rowc['$commentId'];
																	$content = $rowc['$content'];
																	$userIdHash = $rowc['userIdHash'];
																	
																	$personTags = $rowc['personTags'];
																	$timestamp = $rowc['timestamp'];
																	$commentIdHash = $rowc['commentIdHash'];
																	
																	$idAndName = getIdAndName($userIdHash);
																	$commentUserId = $idAndName[1];
																	$commentUserName = $idAndName[0];
																	
																	$objc = new miniComment($postIdHash,$userIdHash,$content,$timestamp,$commentIdHash,$commentUserId,$commentUserName);
																	$outputa1[$noofpostsshown][$noofelementsc] = $objc;
																	
																	$noofelementsc++;
																}
															
															if(noofelementsc == 0)
																{
																	//////echo 'No values found for Query of Comments<br />';
																	
																}
														}
													
													else
														{
															//////echo 'Error in Query of comments<br />';
															//////echo $conObj->error.'<br />';
															return -1;
														}
														
														*/
														
													$noofpostsshown++;	
												}
											
										}
									
									$noofelements2++;
								}
							
							$_SESSION['mq'] = $_SESSION['mq'] + $noofelements2; 
							if($noofelements2 == 0)
								{
									return 'No values found for Query2';
								}
							
						}
							
					else
						{
							////echo 'Error in Query 2<br />';
							// ////echo $conObj->error.'<br />';
						}
					
							
				}
			
			else
				{
					//////echo 'Error in Query 1 <br />';
					//////echo $conObj->error.'<br />';
				}
				
			
			$outputarraylength = count($outputa);
			$jasonarray;
			
			for($i = 0;$i<$outputarraylength;$i++)
				{
					/*////echo '<h2>POSTID</h2><br>' $outputarraylength[$i]->$postId.'<br>';
					////echo '<h2>SHARED WITH</h2><br>' $outputarraylength[$i]->$sharedWith.'<br>';
					////echo '<h2>POST VALIDITY</h2><br>' $outputarraylength[$i]->$postValidity.'<br>';
					////echo '<h2>POST USERs ID</h2><br>' $outputarraylength[$i]->$postUserId.'<br>';
					////echo '<h2>PROFILE PIC</h2><br>' $outputarraylength[$i]->$postProfilePic.'<br>';

					////echo '<h2>POST USER NAME</h2><br>' $outputarraylength[$i]->$postUserName.'<br>';
					////echo '<h2>SUBJECT</h2><br>' $outputarraylength[$i]->$postSubject.'<br>';
					////echo '<h2>CONTENT</h2><br>' $outputarraylength[$i]->$postContent.'<br>';
					////echo '<h2>NO OF STARS</h2><br>' $outputarraylength[$i]->$noOfStars.'<br>';
					////echo '<h2>NO OF COMMENTS</h2><br>' $outputarraylength[$i]->$noOfComments.'<br>';

					////echo '<h2>NO OF MAIL TOs</h2><br>' $outputarraylength[$i]->$noOfMailTos.'<br>';
					////echo '<h2>NO OF SEEN</h2><br>' $outputarraylength[$i]->$postSeenNumber.'<br>';
					////echo '<h2>TIMESTAMP</h2><br>' $outputarraylength[$i]->$postCreationTime.'<br>';
					////echo '<h2>FOLLOW</h2><br>' $outputarraylength[$i]->$followPost.'<br>';
					*/
					
					$jasonarray[$i] = json_encode($outputa[$i]);
				}
				
			print_r($jasonarray);	
			
		}

	latest();
	
	//////echo 'second call to important <br />';
	//////echo 'session variable'.$_SESSION['mq'].'<br />';
	//latest();

?>
