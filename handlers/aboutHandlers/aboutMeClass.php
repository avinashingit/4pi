<?php
	class about
	{
		public $profilePicture;
		public $name; //alias of the user
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
			public $degreeId;
			public $degree;
			public $schoolName;//alias of the
			public $duration;
			public $minDuration;
			public $score;
			public $scoreType;
			public $isOwner;
			
			public function __construct($degreeId,$degree,$schoolName,$duration,$minDuration,$score,$scoreType,$isOwner)
				{
					$this->degreeId=$degreeId;
					$this->degree = $degree ;
					$this->schoolName=$schoolName;
					$this->duration = $duration ;
					$this->minDuration = $minDuration;
					$this->score = $score ;
					$this->scoreType=$scoreType;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		
	class achievements
		{
			public $achievementId;
			public $competition;
			public $location;
			public $description;
			public $position;
			//public $achieveddate;
			public $isOwner;
			public function __construct($achievementId,$competition,$location,$description,$position,$isOwner)
				{
					$this->achievementId = $achievementId;
					$this->competition = $competition;
					$this->location = $location;
					$this->description = $description;
					$this->position = $position;
					//$this->achieveddate = $achieveddate;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		
	class certifiedCourses
		{
			public $courseId;
			public $title;
			public $duration;
			public $minDuration;
			public $institutename;
			public $isOwner;
			public function __construct($courseId,$title,$duration,$minDuration,$institutename,$isOwner)
				{
					$this->courseId = $courseId;
					$this->title = $title;
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->institutename = $institutename;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	/*class competitions
		{
			public $competitionId;
			public $title;
			public $competitionDate;
			public $place;
			public $description;
			public $isOwner;
			public function __construct($competitionId,$title,$competitionDate,$place,$description,$isOwner)
				{
					$this->competitionId=$competitionId;
					$this->title = $title;
					$this->competitionDate = $competitionDate;
					$this->place = $place;
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}*/
		
	class experience
		{
			public $experienceId;
			public $organisation;
			public $duration;
			public $minDuration;
			public $designation;
			public $isFeaturing;
			public $isOwner;
			public function __construct($experienceId,$organisation,$duration,$minDuration,$designation,$isFeaturing,$isOwner)
				{
					$this->experienceId=$experienceId;
					$this->organisation = $organisation;
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->designation = $designation;
					//$this->description = $description;
					$this->isFeaturing=$isFeaturing;
					$this->isOwner=$isOwner;
					return $this;
				}
		}
		

	class leaveMessage
		{
			public $leaveMessageId;
			public 	$name;
			public 	$mailId;
			public 	$message;
			public $isOwner;
			public function __construct($leaveMessageId,$name,$mailId,$message,$isOwner)
				{
					$this->leaveMessageId=$leaveMessageId;
					$this->name = $name;
					$this->mailId = $mailId;
					$this->message = $message;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	/*class objective
		{
			public $description;
			public $isOwner;
			public function __construct($description,$isOwner)
				{	
					$this->description = $description;
					$this->isOwner=$isOwner;
					return $this;
				}
		}*/

	class projects
		{
			public $projectId;
			public $projectTitle;
			public $role;
			public $duration;
			public $minDuration;
			public $description;
			public $teamMembers;
			public $organisation;
			public $isOwner;
			public function __construct($projectId,$title,$role,$duration,$minDuration,$description,$teamMembers,$organisation,$isOwner)
				{
					$this->projectId=$projectId;
					$this->projectTitle = $title;
					$this->duration = $duration;
					$this->role = $role;
					$this->minDuration = $minDuration;
					$this->description = $description;
					$this->teamMembers = $teamMembers;
					$this->organisation = $organisation;
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

	class interests
		{
			public $interests;
			public $isOwner;
			public function __construct($interests,$isOwner)
				{	
					$this->interests = $interests;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

	class workshops
		{
			public $workshopId;
			public $duration;
			public $minDuration;
			public $workshopName;
			public $place;
			public $attendees;
			public $isOwner;
			public function __construct($workshopId,$duration,$minDuration,$title,$place,$attendees,$isOwner)
				{	
					$this->workshopId=$workshopId;
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->workshopName= $title;
					$this->place = $place;
					$this->attendees = $attendees;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

			
				
		
	

			
		
		
		
	

	
	
	
	
?>