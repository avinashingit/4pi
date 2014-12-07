<?php
require_once("../QOB/qob.php");



class studentSearchResult
{
     public $userId;
     public $name;
    
    public function __constructor($userId, $name)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

} // end of Comment



function homeSearch($inputString)
    {
        if($inputString!="")
            {
                $qob = new QOB();
                $values[0] = array($inputString=>"s");
                $values[1] = array($inputString=>"s");
                $query = "select name, userId from users where (match(userId) against (?)) or (match(userId) against (?)) limit 9 offset 0";
                
                // $result = $qob->select($query, $values);
                $result = $qob->fetchall($query, $values);
                print_r($result);
                
               /* if($qob->error=="")
                    {
                        if($result)
                            {
                                $searchResults=[];
                                while($record = $qob->fetch($result))
                                    {
                                        $resultObj = new studentSearchResult($record['userId'], $record['name']);
                                        $searchResults[] = $resultObj;
                                        echo $resultObj;
                                        echo "HELLO";
                                    }
                                
                                print_r(json_encode($searchResults));
                            }
                        else
                            echo 131;
                    }
                else
                    echo 132;*/
            
            }
        else
            echo 133;//return some error number
    }
    homeSearch($_POST['_inputVal']);
?>