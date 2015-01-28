<?php
session_start();

/*
TO FRONT END DEVELOPER

INPUT:  Search keyword - _inputVal

OUTPUT: Array of two types of arrays
                Type1: Array of users (userId, name, userIdHash) - 2 users
                Type2: Array of posts (postIdHash, postSubject, postOwnerHash, postOwnerName) - 2 posts

If any of the types does not match the keyword it is sent as an empty array.
Each time exactly I send an array of four entries with entries having arrays or null
For example:
if a keyword matches only users 
Then resultant array would be:
Array[0] = Array of users matched
Array[1] = null (empty)

 */



$userIdHash=$_SESSION['vj']='0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22';
//$_POST['_inputVal'] = "the";

if(isset($_SESSION['vj']))
	{
		$userIdHash=$_SESSION['vj']='0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22';
        require_once("ideaHandlers/miniClasses/ideasearchclass.php");
		//include("ideaHandlers/miniClasses/miniIdeaPost.php");
		//require_once('fetch.php');


        function globalSearch($inputString)
            {
                if($inputString!="")
                    {
                        $vals = explode($inputString, " ");
                        $outputString="";
                        $flag=0;

                        foreach ($vals as $key => $value)
                            {
                                $outputString .= " *".$value."*";
                                $flag=1;
                            }

                        if($flag)
                            $outputString = "*".$inputString."*";

                        $values[0] = array($outputString=>"s");
                        $values[1] = array($outputString=>"s");
                        $values[2] = array($outputString=>"s");
                        $values[3] = array($outputString=>"s");
						//echo $outputString."<br />";
                        $query1 = "select name, userId, userIdHash, gender from users where (match(name) against (? in boolean mode)) or (match(userId) against (? in boolean mode)) order by (match(name) against (? in boolean mode))+(match(userId) against (? in boolean mode)) desc limit 2 offset 0";

                        $query2 = "select * from ideaposttable where ideaDescription LIKE ?  limit 2 offset 0 ";
						
						 //$query2 = "select ideaDescription, userId, name from ideaposttable where (match(ideaDescription) against (? in boolean mode)) or (match(name) against (? in boolean mode)) order by (match(ideaDescription) against (? in boolean mode))+(match(name) against (? in boolean mode)) desc limit 2 offset 0";
						
						//$query2= "select * from ideaposttable";
						
                        require_once("../QOB/qob.php");
                        $qob = new QOB();
                        
                        //    TO FETCH STUDENT SEARCH RESULTS   
                        $result = $qob->select($query1, $values);
                        //$returnResults= array();
						
                        if($qob->error=="")
                            {
                                if($result)
                                    {
                                        $studentSearchResults = [];
                                        $count=0;
                                        while($record = $qob->fetch($result))
                                            {
                                                $resultObj = new studentSearchResult($record['userId'], $record['name'], $record['userIdHash'],$record['gender']);
                                                $studentSearchResults[] = $resultObj;
                                                $count++;
                                            }
										$returnResults[0]="";
                                        if(!$count)
                                          ; //echo 131;//no results found
                                        else
											{
												$returnResults[0]=$studentSearchResults;
											}
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
								echo $qob->error;
                                echo 133;//database error
                            }
                            //TO FETCH STUDENT SEARCH RESULTS   







						$values="";
						$vals = explode($inputString, " ");
                        $outputString="";
                        $flag=0;

                        foreach ($vals as $key => $value)
                            {
                                $outputString .= " %".$value."%";
                                $flag=1;
                            }

                        if($flag)
                            $outputString = "%".$inputString."%";
						
						
						//$outputString = "%".$outputString."%";
                        $values[0] = array($outputString=>"s");
                       // $values[1] = array($outputString=>"s");
                            // TO FETCH POST SEARCH RESULTS   
                       $result = $qob->select($query2, $values);
                        //echo $result;
                        if($qob->error=="")
                            {
                                if($result)
                                    {
										$userIdHash=$_SESSION['vj'];
										if(($user=getUserFromHash($userIdHash))==false)
											{
												//notifyAdmin("Critical Error!! In createPost",$userIdHash);
												$_SESSION=array();
												session_destroy();
												return 13;
											}
										else
										{
										
											$postSearchResults=[];
											$count=0;
											while($record = $qob->fetch($result))
												{
													
													if(strcasecmp($userIdHash,$record['userIdHash']) == 0)
													{
														$record['postOwner'] = 1;
													}
													
													$appreciaters = $record['appreciaters'];

													if(empty($appreciaters))
													{
														$hasAppreciated = -1;
													}
													else{
														if(strpos($appreciaters, $user['userId']) !== false)
														{
															$hasAppreciated = 1;
														}
														else{
															$hasAppreciated = -1;
														}
													}
													
													$depreciaters = $record['depreciaters'];
													
													if(empty($depreciaters))
													{
														$hasDepreciated = -1;
													}
													else{
														if(strpos($depreciaters, $user['userId']) !== false)
														{
															$hasDepreciated = 1;
														}
														else{
															$hasDepreciated = -1;
														}
													}
													
													$tempstr = $record['ideaDescription'];
													if(strlen($tempstr)>75)
													{
														$tempstr = substr($record['ideaDescription'], 0 , 50);
														$tempstr = $tempstr.".........";
													}
													$resultObj = new postSearchResult($record['userIdHash'], $record['userId'], $record['name'], $record['ideaPostId'], $record['ideaPostIdHash'], $record['appreciaters'], $record['appreciateCount'], $hasAppreciated, $record['depreciaters'], $record['depreciateCount'], $hasDepreciated, $record['ideaPostDate'], $record['ideaDescription'], $tempstr);
													$postSearchResults[] = $resultObj;
													$count++;
												}
											$returnResults[1]="";
											if($count)
												$returnResults[1]=$postSearchResults;
										}
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
                                echo $qob->error.'<br />';
                                echo 133;//database error
                            } 
                        /*     TO FETCH POST SEARCH RESULTS   */
					
                    print_r(json_encode($returnResults));
					//}




                    }
                else
                    echo 134;//invalid inputs
            }


        //$searchKeyword="sai kumar";
        // globalSearch($searchKeyword);
        globalSearch($_POST['_inputVal']);

    }
else
{
    session_destroy();
    echo 13;//invalid attempt
}

function getUserFromHash($userHash)
	{
		$conn=new QoB();
		$fetchUserSQL="SELECT * FROM users WHERE userIdHash= ?";
		$values[0]=array($userHash=>'s');
		$result=$conn->fetchAll($fetchUserSQL,$values);
		if($conn->error==""&&$result!="")
		{	
			return $result;
		}
		else
		{
			return false;
		}
	}

?>