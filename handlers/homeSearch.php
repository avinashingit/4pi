<?php
require_once("../QOB/qob.php");



class studentSearchResult
    {
        public $userId;
        public $name;
    
        public function __construct($userId, $name)
            {
                $this->userId = $userId;
                $this->name = $name;
            }

    } // end of class



function homeSearch($inputString)
    {
        if($inputString!="")
            {
                $qob = new QOB();

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
                $query = "select name, userId from users where (match(name) against (?)) or (match(userId) against (?)) order by (match(name) against (?))+(match(userId) against (?)) desc limit 9 offset 0";
                
                $result = $qob->select($query, $values);
                
                if($qob->error=="")
                    {
                        if($result)
                            {
                                $searchResults=[];
                                $count=0;
                                while($record = $qob->fetch($result))
                                    {
                                        $resultObj = new studentSearchResult($record['userId'], $record['name']);
                                        $searchResults[] = $resultObj;
                                        $count++;
                                    }
                                if($count)
                                    print_r(json_encode($searchResults));
                                else 131;//no results found
                            }
                        else
                            echo 132;//logical error
                    }
                else
                    {
                        echo 133;//database error
                    }
            
            }
        else
            echo 134;//invalid inputs
    }
homeSearch($_POST['_inputVal']);
?>