<?php
	require_once ('../QOB/qob.php')
	function indexUpdater($mode,$postIdHash,$conObj)
		{
			if($mode == 1)
				{
					//IF A LIKE COMES ON POST
					$values1 = array(0 => ($postIdHash => 's'));
					$result1 = $conObj->fetchall("SELECT likeIndex,commentIndex,mailToIndex FROM post WHERE postIdHash = ?",$values1,false);
					if($conObj->error == "")
						{
							$date = date_create();
							
							$likeIndexUpdated = ($result1['likeIndex'] + date_timestamp_get($date))/2;
							
							$popularityIndexUpdated = $likeIndexUpdated + 1.4 * ($result1['commentIndex']);
							
							$impIndexUpdated = $likeIndexUpdated + 2 * ($result1['mailToIndex']);
							
							$values2 = array(0 => array($postid => 's'), 1 => array($likeIndexUpdated => 'i'), 2 => array($popularityIndexUpdated => 'i'), 3 => array($impIndexUpdated => 'i'));
							
							$result2 = $conObj->update("UPDATE post WHERE postidHash = ? SET likeIndex = ?,popularityIndex = ?,impIndex = ?",$values2,false);
							
							if($conObj->error == "")
								{
									//echo 'Updated successfully Mode 1<br />';
									return true;
								}
							
							else
								{
									//echo 'Error in Query 2 of Mode 1<br />';
									//echo $conObj->error;
									return false;
								}
						}
					else
						{
							//echo 'Error in Query 1 of Mode 1';
							//echo $conObj->error;
							return true;
						}
					
				}
			
			elseif($mode == 2)
				{
					//IF A COMMENT COMES ON POST
					$values1 = array(0 => ($postid => 's'));
					$result1 = $conObj->fetchall("SELECT likeIndex,commentIndex FROM post WHERE postIdHash = ?",$values1,false);
					if($conObj->error == "")
						{
							$date = date_create();

							$commentCount=$result1['commentCount'];
							$commentCount=$commentCount+1;
							
							$commentIndexUpdated = ($result1['commentIndex'] + date_timestamp_get($date))/2;
							
							$popularityIndexUpdated = $result1['likeIndex']+ 1.4 * $commentIndexUpdated;
							
							$values2 = array(0 => array($postid => 's'), 1 => array($commentIndexUpdated => 'i'), 2 => array($popularityIndexUpdated => 'i'), 3 => array($commentCount => 'i'));
							
							$result2 = $conObj->update("UPDATE post WHERE postIdHash = ? SET commentIndex = ?, popularityIndex = ?,commentCount",$values2,false);
							
							if($conObj->error == "")
								{
									//echo 'Updated successfully<br />';
									return true;
								}
							
							else
								{
									/*echo 'Error in Query 2 of Mode 2<br />';
									echo $conObj->error.'<br />';*/
									return false;
								}
						}
					else
						{
							//echo 'Error in Query 1 of Mode 2<br />';
							//echo $conObj->error.'<br />';
							return false;
						}
					
				}
			
			elseif($mode == 3)
				{
					//IF A MAILTO COMES ON POST
					$values1 = array(0 => ($postid => 's'));
					$result1 = $conObj->fetchall("SELECT likeIndex,mailToIndex FROM post WHERE postIdHash = ?",$values1,false);
					if($conObj->error == "")
						{
							$date = date_create();
							
							$mailToIndexUpdated = ($result1['mailToIndex'] + date_timestamp_get($date))/2;
							
							$impIndexUpdated = $result1['likeIndex'] + 2 * $mailToIndexUpdated;
							
							$values2 = array(0 => array($postid => 's'), 1 => array($mailToIndexUpdated => 'i'), 2 => array($impIndexUpdated => 'i'));
							
							$result2 = $conObj->update("UPDATE post WHERE postidHash = ? SET mailToIndex = ? ,impIndex = ?",$values2,false);
							
							if($conObj->error == "")
								{
									//echo 'Updated successfully Mode 3<br />';
									return true;
								}
							
							else
								{
									//echo 'Error in Query 2 of Mode 3<br />';
									//echo $conObj->error.'<br />';
									return false;
								}
						}
					else
						{
							//echo 'Error in Query 1 of Mode 3<br />';
							//echo $conObj->error.'<br />';
							return false;
						}
					
				}
			
		}
	
?>

