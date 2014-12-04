<?php
	class about
	{
		public $profilePicture;
		public $name;
		public $dob;	
		public $description;
		public $resume;
		public $hobbies;
		public $mailId;
		public $address;		
		public $phone;
		public $city;
		
		public function __construct($profilePicture,$name,$dob,$description,$resume,$hobbies,$mailId,$address,$phone,$city)
			{
				$this->profilePicture = $profilePicture;
				$this->name = $name; 
				$this->dob = $dob;	
				$this->description = $description;
				$this->resume = $resume;
				$this->hobbies = $hobbies;
				$this->mailId = $mailId;
				$this->address = $address;		
				$this->phone = $phone;
				$this->city = $city;
				
				return $this;
			}
			
	}
	
	
	class academics
		{	
			public $degree;
			public $name;
			public $start;
			public $end;
			public $cgpa;
			
			public function __construct($degree,$name,$start,$end,$cgpa)
				{
					$this->degree = $degree ;
					$this->name = $name ;
					$this->start = $start ;
					$this->end = $end;
					$this->cgpa = $cgpa ;
					return $this;
				}
		}
		
	class achievements
		{
			public $competition;
			public $description;
			public $position;
			public $achieveddate;
			
			public function __construct($competition,$description,$position,$achieveddate)
				{
					$this->competition = $competition;
					$this->description = $description;
					$this->position = $position;
					$this->achieveddate = $achieveddate;
					return $this;
				}
		}
		
	class certifiedCourses
		{
			public $title;
			public $duration;
			public $institutename;
			
			public function __construct($title,$duration,$institutename)
				{
					$this->title = $title;
					$this->duration = $duration;
					$this->institutename = $institutename;
					return $this;
				}
		}

	class competitions
		{
			public $title;
			public $competitionDate;
			public $place;
			public $description;
			
			public function __construct($title,$competitionDate,$place,$description)
				{
					$this->title = $title;
					$this->competitionDate = $competitionDate;
					$this->place = $place;
					$this->description = $description;
					return $this;
				}
		}
		
	class experience
		{
			public $organisation;
			public $start;
			public $end;
			public $title;
			public $description;
			
			public function __construct($organisation,$start,$end,$title,$description)
				{
					$this->organisation = $organisation;
					$this->start = $start;
					$this->end = $end;
					$this->title = $title;
					$this->description = $description;
					return $this;
				}
		}
		

	class leaveMessage
		{
			public 	$name;
			public 	$mailId;
			public 	$message;
				
			public function __construct($name,$mailId,$message)
				{
					$this->name = $name;
					$this->mailId = $mailId;
					$this->message = $message;
					return $this;
				}
		}

	class objective
		{
			public $description;
			public function __construct($description)
				{	
					$this->description = $description;
					return $this;
				}
		}

	class projects
		{
			public $title;
			public $role;
			public $start;
			public $end;
			public $description;
			public function __construct($title,$role,$start,$end,$description)
				{	
					$this->title = $title;
					$this->start = $start;
					$this->role = $role;
					$this->end = $end;
					$this->description = $description;
					return $this;
				}
		}				
	
	class skillSet
		{
			public $skills;
			public $rating;
			public function __construct($skills,$rating)
				{	
					$this->skills = $skills;
					$this->rating = $rating;
					return $this;
				}
		}		
		
	class socialMedia
		{
			public $facebookId;
			public $googleId;
			public $twitterId;
			public $linkedinId;
			public function __construct($facebookId,$googleId,$twitterId,$linkedinId)
				{	 
					$this->facebookId = $facebookId;
					$this->googleId = $googleId;
					$this->twitterId = $twitterId;
					$this->linkedinId = $linkedinId;
					return $this;
				}
		}
		

	class toolkit
		{
			public $tools;
			public function __construct($tools)
				{	
					$this->tools = $tools;
					return $this;
				}
		}

	class workshops
		{
			public $start;
			public $end;
			public $title;
			public $place;
			public $attendes;
			public function __construct($start,$end,$title,$place,$attendes)
				{	
					$this->start = $start;
					$this->end = $end;
					$this->title = $title;
					$this->place = $place;
					$this->attendes = $attendes;
					return $this;
				}
		}

			
				
		
	

			
		
		
		
	

	
	
	
	
?>