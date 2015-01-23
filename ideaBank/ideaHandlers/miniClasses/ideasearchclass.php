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
                public $userIdHash;
				public $userId;// to show edit and delete #1- Owner# 2 - Not Owner
				public $name;
				public $ideaPostId;//to identify the post
				public $ideaPostIdHash;//tpost id hash
				public $appreciaters;//
				public $appreciateCount;
				public $hasAppreciated;
				public $depreciaters;
				public $depreciateCount;
				public $hasDepreciated;
				public $ideaPostDate;
				public $ideaDescription;
				public $ideaContent;
            
                public function __construct($userIdHash, $userId, $name, $ideaPostId, $ideaPostIdHash, $appreciaters, $appreciateCount, $hasAppreciated, $depreciaters, $depreciateCount, $hasDepreciated, $ideaPostDate, $ideaDescription, $ideaContent)
				{
				
					$this->userIdHash = $userIdHash;
					$this->userId = $userId;
					$this->name = $name;
					$this->ideaPostId = $ideaPostId;
					$this->ideaPostIdHash = $ideaPostIdHash;
					$this->appreciaters = $appreciaters;
					$this->appreciateCount = $appreciateCount;
					$this->hasAppreciated = $hasAppreciated;
					$this->depreciaters = $depreciaters;
					$this->depreciateCount = $depreciateCount;
					$this->hasDepreciated = $hasDepreciated;
					$this->ideaPostDate=$ideaPostDate;
					$this->ideaDescription=$ideaDescription;
					$this->ideaContent=$ideaContent;

					return $this;
				}
            } // end of class
?>