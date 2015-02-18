<?php
session_start();
require_once('../QOB/qob.php');
require_once('fetch.php');

/*
TO FRONT END DEVELOPER

INPUT:  Search keyword - _inputVal

OUTPUT: Array of four types of arrays
                Type1: Array of users (userId, name, userIdHash) - 2 users
                Type2: Array of posts (postIdHash, postSubject, postOwnerHash, postOwnerName) - 2 posts
                Type3: Array of events (eventIdHash, eventName) - 2 events
                Type4: Array of polls (pollIdHash, pollDescription) - 2 polls

If any of the types does not match the keyword it is sent as an empty array.
Each time exactly I send an array of four entries with entries having arrays or null
For example:
if a keyword matches only users and events
Then resultant array would be:
Array[0] = Array of users matched
Array[1] = null (empty)
Array[2] = Array of events matched
Array[3] = null (emtpy)


 */


// $_POST['_inputVal']="the";


if(isset($_SESSION['vj']))
    {
        require_once("../classes/search.php");




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

                        $user=getUserFromHash($_SESSION['vj']);


                        $values[0] = array($outputString=>"s");
                        $values[1] = array($outputString=>"s"); 
                        $values[2] = array($outputString=>"s");
                        $values[3] = array($outputString=>"s");

                        $values1[0] = array($outputString=>"s");
                        $values1[1] = array($outputString=>"s");
                        $values1[2] = array(getRollNoRegex($user['userId'])=>'s'); 
                        $values1[3] = array($outputString=>"s");
                        $values1[4] = array($outputString=>"s");

                        $query1 = "select name, userId, userIdHash, gender from users where  (match(name) against (? in boolean mode)) or (match(userId) against (? in boolean mode)) order by (match(name) against (? in boolean mode))+(match(userId) against (? in boolean mode))  desc limit 2 offset 0";

                        $query2 = "select P.postIdHash, P.subject, U.name as userName, U.userIdHash as userIdHash from post as P, users as U where ((match(P.subject) against (? in boolean mode)) or (match(P.content) against (? in boolean mode))) and (P.userId=U.userId) AND P.sharedWith REGEXP ? order by (match(P.subject) against (? in boolean mode))+(match(P.content) against (? in boolean mode)) desc limit 2 offset 0";

                        $query3 = "select eventName, eventIdHash from event where (match(eventName) against (? in boolean mode)) or (match(content) against (? in boolean mode)) AND sharedWith REGEXP ? order by (match(eventName) against (? in boolean mode))+(match(content) against (? in boolean mode)) desc limit 2 offset 0";

                        $query4 = "select pollIdHash, question from poll where (match(question) against (? in boolean mode)) or (match(options) against (? in boolean mode)) AND sharedWith REGEXP ? order by (match(question) against (? in boolean mode))+(match(options) against (? in boolean mode)) desc limit 2 offset 0";


                        require_once("../QOB/qob.php");
                        $qob = new QOB();
                        $returnResults=array();
                        $returnResults[0]=array();
                        $returnResults[1]=array();
                        $returnResults[2]=array();
                        $returnResults[3]=array();
                        
                          // TO FETCH STUDENT SEARCH RESULTS   
                        $result = $qob->select($query1, $values);
                        
                        if($qob->error=="")
                            {
                                if($result)
                                    {
                                        $studentSearchResults = [];
                                        $count=0;
                                        while($record = $qob->fetch($result))
                                            {
                                                if(file_exists(__DIR__.'/../img/proPics/'.$record['userIdHash'].".jpg"))
                                                {
                                                    $proPicExists=1;
                                                }
                                                else
                                                {
                                                    $proPicExists=-1;
                                                }
                                                $resultObj = new studentSearchResult($record['userId'], $record['name'], $record['userIdHash'],$record['gender'],$proPicExists);
                                                $studentSearchResults[] = $resultObj;
                                                $count++;
                                            }
                                        if(!$count)
                                           ; //echo 131;//no results found
                                        else
                                            $returnResults[0]=$studentSearchResults;
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
                                echo '133'.'u';//database error
                            }
                            // TO FETCH STUDENT SEARCH RESULTS   








                        
                            // TO FETCH POST SEARCH RESULTS   
                        $result = $qob->select($query2, $values1);
                        
                        if($qob->error=="")
                            {
                                if($result)
                                    {
                                        $postSearchResults=[];
                                        $count=0;
                                        while($record = $qob->fetch($result))
                                            {
                                                $resultObj = new postSearchResult($record['postIdHash'], $record['subject'], $record['userIdHash'], $record['userName']);

                                                // var_dump($resultObj);
                                                $postSearchResults[] = $resultObj;
                                                $count++;
                                            }
                                        if($count)
                                            $returnResults[1]=$postSearchResults;
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
                                echo $qob->error;
                                echo '133'.'pos';//database error
                            }
                        /*     TO FETCH POST SEARCH RESULTS   */






                        
                        //  TO FETCH EVENT SEARCH RESULTS   
                        $result = $qob->select($query3, $values1);
                        
                        if($qob->error=="")
                            {
                                if($result)
                                    {
                                        $eventSearchResults=[];
                                        $count=0;
                                        while($record = $qob->fetch($result))
                                            {
                                                $resultObj = new eventSearchResult($record['eventIdHash'], $record['eventName']);
                                                $eventSearchResults[] = $resultObj;
                                                $count++;
                                            }
                                        if(!$count)
                                            ;//echo 131;//no results found
                                        else
                                            $returnResults[2]=$eventSearchResults;
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
                                echo $qob->error;
                                echo '133'.'e';//database error
                            }
                        /*     TO FETCH EVENT SEARCH RESULTS   */









                        
                        //   TO FETCH POLL SEARCH RESULTS   
                        $result = $qob->select($query4, $values1);
                        
                        if($qob->error=="")
                            {
                                if($result)
                                    {
                                        $pollSearchResults=[];
                                        $count=0;
                                        while($record = $qob->fetch($result))
                                            {
                                                $resultObj = new pollSearchResult($record['pollIdHash'], $record['question']);
                                                $pollSearchResults[] = $resultObj;
                                                $count++;
                                            }
                                        if(!$count)
                                            ;//echo 131;//no results found
                                        else
                                            $returnResults[3]=$pollSearchResults;
                                    }
                                else
                                    echo 132;//logical error
                            }
                        else
                            {
                               echo $qob->error;
                                echo '133'.'po';//database error
                            }
                             // TO FETCH POLL SEARCH RESULTS   */



                    print_r(json_encode($returnResults));





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


?>