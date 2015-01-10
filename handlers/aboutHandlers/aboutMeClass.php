<?php
	class about
	{
		public $profilePicture;
		public $name;
		public $dob;	
		public $description;
		public $resume;
		public $highestDegree;
		public $currentProfession;
		public $hobbies;
		public $mailId;
		public $showMailId;
		public $address;	
		public $phone;
		public $showPhone;
		public $city;
		public $facebookId;
		public $twitterId;
		public $googleId;
		public $linkedinId;
		public $pinterestId;
		public $isOwner;
		
		public function __construct($profilePicture,$name,$dob,$description,$resume,$highestDegree,
			$currentProfession,$hobbies,$mailId,$showMailId,$address,$phone,$showPhone,
			$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,$isOwner)
			{
				$this->profilePicture = $profilePicture;
				$this->name = $name; 
				$this->dob = $dob;	
				$this->description = $description;
				$this->resume = $resume;
				$this->highestDegree=$highestDegree;
				$this->currentProfession=$currentProfession;
				$this->hobbies = $hobbies;
				$this->mailId = $mailId;
				$this->showMailId=$showMailId;
				$this->address = $address;	
				$this->phone = $phone;
				$this->showPhone=$showPhone;
				$this->city = $city;
				$this->facebookId=$facebookId;
				$this->twitterId=$twitterId;
				$this->googleId=$googleId;
				$this->linkedinId=$linkedinId;
				$this->pinterestId=$pinterestId;
				$this->isOwner=$isOwner;

				return $this;
			}
			
	}
	
	
	class academics
		{	
			public $degree;
			public $name;
			public $duration;
			public $minDuration;
			public $cgpa;
			public $isOwner;
			
			public function __construct($degree,$name,$duration,$minDuration,$cgpa,$isOwner)
				{
					$this->degree = $degree ;
					$this->name = $name ;
					$this->duration = $duration ;
					$this->minDuration = $minDuration;
					$this->cgpa = $cgpa ;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		
	class achievements
		{
			public $competition;
			public $description;
			public $position;
			public $achieveddate;
			public $isOwner;
			public function __construct($competition,$description,$position,$achieveddate,$isOwner)
				{
					$this->competition = $competition;
					$this->description = $description;
					$this->position = $position;
					$this->achieveddate = $achieveddate;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		
	class certifiedCourses
		{
			public $title;
			public $duration;
			public $institutename;
			public $isOwner;
			public function __construct($title,$duration,$institutename,$isOwner)
				{
					$this->title = $title;
					$this->duration = $duration;
					$this->institutename = $institutename;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	class competitions
		{
			public $title;
			public $competitionDate;
			public $place;
			public $description;
			public $isOwner;
			public function __construct($title,$competitionDate,$place,$description,$isOwner)
				{
					$this->title = $title;
					$this->competitionDate = $competitionDate;
					$this->place = $place;
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		
	class experience
		{
			public $organisation;
			public $duration;
			public $minDuration;
			public $title;
			public $description;
			public $isOwner;
			public function __construct($organisation,$duration,$minDuration,$title,$description,$isOwner)
				{
					$this->organisation = $organisation;
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->title = $title;
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		

	class leaveMessage
		{
			public 	$name;
			public 	$mailId;
			public 	$message;
			public $isOwner;
			public function __construct($name,$mailId,$message,$isOwner)
				{
					$this->name = $name;
					$this->mailId = $mailId;
					$this->message = $message;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	class objective
		{
			public $description;
			public $isOwner;
			public function __construct($description,$isOwner)
				{	
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	class projects
		{
			public $title;
			public $role;
			public $duration;
			public $minDuration;
			public $description;
			public $isOwner;
			public function __construct($title,$role,$duration,$minDuration,$description,$isOwner)
				{	
					$this->title = $title;
					$this->duration = $duration;
					$this->role = $role;
					$this->minDuration = $minDuration;
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}				
	
	class skillSet
		{
			public $skills;
			public $rating;
			public $isOwner;
			public function __construct($skills,$rating,$isOwner)
				{	
					$this->skills = $skills;
					$this->rating = $rating;
					$this->isOwner=$isOwner;
					return $this;
				}
		}		
		
	/*class socialMedia
		{
			public $facebookId;
			public $googleId;
			public $twitterId;
			public $linkedinId;
			public $isOwner;
			public function __construct($facebookId,$googleId,$twitterId,$linkedinId,$isOwner)
				{	 
					$this->facebookId = $facebookId;
					$this->googleId = $googleId;
					$this->twitterId = $twitterId;
					$this->linkedinId = $linkedinId;
					$this->isOwner=$isOwner;
					return $this;
				}
		}*/
		

	class toolkit
		{
			public $tools;
			public $isOwner;
			public function __construct($tools,$isOwner)
				{	
					$this->tools = $tools;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	class workshops
		{
			public $duration;
			public $minDuration;
			public $title;
			public $place;
			public $attendees;
			public $isOwner;
			public function __construct($duration,$minDuration,$title,$place,$attendees,$isOwner)
				{	
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->title = $title;
					$this->place = $place;
					$this->attendees = $attendees;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

			
				
		
	

			
		
		
		
	

	
	
	
	
?>