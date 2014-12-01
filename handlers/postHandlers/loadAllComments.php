<?php
	session_start();
	// $_SESSION['vj'] = '4dbb5a2f9314875d41855940f194da51e2bf06b8bfbbd53257fcfbb3115e468e6c6862485992163e22a7ba03b41bac72e128532b70032bbb5cdf6bf7d20de668';
	if(isset($_SESSION['vj']))
		{
			error_reporting(E_ALL ^ E_NOTICE);
			//error_reporting(E_ALL ^ E_WARNING);
			//require_once 'miniClasses/miniPost.php';
			require_once 'miniClasses/miniComment.php';
			require_once '../../QOB/qob.php';
			require_once '../fetch.php';
			require_once 'functions.php';
			
			
			// $postIdHash = '1e2bb9cac49e1c326d8bff7d110f334ca013f1073a352735f1b8afc21e1f2334935bc8ebac9e4eaadbaab193d32226ba35538db1c5e9a015658e842d49322731';
			commentFetch($_POST['_postId']);
			
		}

	else
		{
			//echo "It's an error <br/>";
			echo 11;
		}
	
	function commentFetch($postIdHash)
		{
			$conObj = new QoB();
			$outputa = array();
			$noOfComments = 0;
							
			$values1 = array(0 => array($postIdHash => 's'));
			$result1 = $conObj->fetchAll("SELECT postId FROM post WHERE postIdHash = ?",$values1);
			
			if($conObj->error == "")
				{
					if($result1!="")
						{
							$postId = 'p'.$result1['postId'].'c';
							//echo "This is postId <br/>";
							//echo $postId.'<br/>';
							
							$commentResult = $conObj->select("SELECT * FROM ".$postId." ORDER BY timestamp ASC ");
							
							if($conObj->error == "")
								{
									while($postComments = $conObj->fetch($commentResult))
								
										{
											////echo "HI while <br/>";
											
											$commentId = $postComments['commentId'];
											
											//echo "This is commentId <br/>";
											//echo $commentId.'<br/>';
											
											$content = $postComments['content'];
											$userId = $postComments['userId'];
											
											//echo "This is the user id <br/>";
											//echo $userId.'<br/>';
											
											$userIdHash = getHash($userId);
											
											$personTags = $postComments['personTags'];
											$timestamp = $postComments['timestamp'];
											$commentIdHash = $postComments['commentIdHash'];
											
											//$idAndName = getIdAndName($userIdHash);
											//$commentUserId = $idAndName[1];
											$commentUserName = getName($userId);
											
											//echo "This is comment user name <br/>";
											//echo $commentUserName.'<br/>';
											
											$commentOwner = -1;

											if($userIdHash == $_SESSION['vj'])
												{
													$commentOwner = 1;
												}

						
											//echo "This is comment content <br/>";
											//echo $postComments['content']."<br/>";
											
											$objc = new miniComment($postIdHash,$userIdHash,$postComments['content'],$postComments['timestamp'],$postComments['commentIdHash'],$userId,$commentUserName,$commentOwner);
											
											//print_r(json_encode($objc));
											
											//echo $objc->commentContent.'<br/>';
											
											
											$outputa[$noOfComments+1] = $objc;
											
											//echo "This is the output array <br/>";
											//echo $outputa[$noOfComments+1]->commentContent.'<br/>';
											////echo ($noOfComments+1).'<br/>';
											$noOfComments++;
											
											
										}
										
										if($noOfComments == 0)
											{
												$outputa[0] = -1;
											}
											
										else if($noOfComments > 0)
											{
												$outputa[0] = 1;
											}			
										
								}
								
							else
								{
									//echo "Error in comments Query <br/>";
									//echo $conObj->error."<br/>";
								}
						}
					else
						{
							//echo "No values found for Query 1 <br/>";
						}
				}
				
			else
				{
					//echo "Error in Query 1 <br/>";
					//echo $conObj->error.'<br/>';
				}
							
			//echo "The output array is <br/><br/>";
			$outputArrayLength = count($outputa);
			$jasonArray = array();
		
			for($i = 0;$i<$outputArrayLength-1;$i++)
				{
					//echo "<h3>commentUserName </h3>".$outputa[$i+1]->commentUserName."<br/>";
					////echo "<h3> </h3>".."<br/>";
					////echo "<h3> </h3>".."<br/>";
					////echo "<h3> </h3>".."<br/>";
					////echo "<h3> </h3>".."<br/>";
					$jasonArray[$i] = $outputa[$i+1];
				}
				
			//echo "<br/><br/>---------*********---------";
			if($outputa[0] == 1)
				{
				print_r(json_encode($jasonArray));

				}

			else if($outputa[0] == -1)
				{
					echo 404;
				}		
			// return $outputa;	
		}
		
	
	
?>