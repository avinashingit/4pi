 <?php

        class studentSearchResult
            {
                public $userId;
                public $name;
                public $userIdHash;
                public $gender;
            
                public function __construct($userId, $name, $userIdHash, $gender)
                    {
                        $this->userId = $userId;
                        $this->name = $name;
                        $this->userIdHash = $userIdHash;
                        $this->gender=$gender;
                    }

            } // end of class


        class postSearchResult
            {
                public $postIdHash;
                public $postSubject;
                public $postOwnerHash;
                public $postOwnerName;
            
                public function __construct($postIdHash, $postSubject, $postOwnerHash, $postOwnerName)
                    {
                        $this->postIdHash = $postIdHash;
                        $this->postSubject = $postSubject;
                        $this->postOwnerHash = $postOwnerHash;
                        $this->postOwnerName = $postOwnerName;
                    }

            } // end of class


        class eventSearchResult
            {
                public $eventIdHash;
                public $eventName;
            
                public function __construct($eventIdHash, $eventName)
                    {
                        $this->eventIdHash = $eventIdHash;
                        $this->eventName = $eventName;
                    }

            } // end of class


        class pollSearchResult
            {
                public $pollIdHash;
                public $pollDescription;
            
                public function __construct($pollIdHash, $pollDescription)
                    {
                        $this->pollIdHash = $pollIdHash;
                        $this->pollDescription = $pollDescription;
                    }

            } // end of class
?>