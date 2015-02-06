<?php

//------Credits------//
//
//
//---Definitions of all ObjectClasses of aboutMe.
//---Author : K Roopesh Reddy ,COE12B025.
//---Email : coe12b025@iiitdm.ac.in
//
//---Editor-1: Hari Krishna Majety , COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

	class about
	{
		public $userIdHash;
		public $name; 
		public $alias;//alias of the user
		public $dob;
		public $description;
		//public $resume;
		public $highestDegree;
		public $currentProfession;
		//public $hobbies;
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
		//$_POST['_alias'],$_POST['_dob'],$_POST['_description'],$_POST['_highestDegree'],$_POST['_currentProfession'],$_POST['_mailId'],$_POST['_showMailId'],$_POST['_address'],$_POST['_phone'],$_POST['_showPhone'],$_POST['_city'],$_POST['_fbLink'],$_POST['_twitterLink'],$_POST['_g+Link'],$_POST['_inLink'],$_POST['_ptrestLink']
		//$userAlias,$dob,$description,$highestDegree,$currentProfession,$mailId,$showMailId,$address,$phone,$showPhone,$city,$facebookId,$twitterId,$googleId,$linkedinId,$pinterestId,
		public function __construct($userIdHash,$name,$alias,$dob,$description,$highestDegree,
			$currentProfession,$mailId,$showMailId,$address,$phone, $showPhone,
			$city,$facebookId,$twitterId,$googleId, $linkedinId,$pinterestId,$gender,$profilePicExists,$isOwner)
			{
				$this->userIdHash = $userIdHash;
				$this->name = $name; 
				$this->alias= $alias;
				$this->dob = $dob;	
				$this->description = $description;
				$this->highestDegree=$highestDegree;

				$this->currentProfession=$currentProfession;
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
				$this->gender=$gender;
				$this->profilePicExists= $profilePicExists;
				$this->isOwner=$isOwner;

				return $this;
			}
			
	}
	
	class aboutMeTop
	{
		public $userIdHash;
		public $name; 
		public $alias;//alias of the user
		public $dob;
		public $description;
		//public $resume;
		public $highestDegree;
		public $currentProfession;
		public $isOwner;

		public function __construct($userIdHash,$name,$alias,$dob,$description,$highestDegree,
			$currentProfession,$isOwner)
			{
				$this->userIdHash = $userIdHash;
				$this->name = $name; 
				$this->alias = $alias; 
				$this->dob = $dob;	
				$this->description = $description;
				$this->highestDegree=$highestDegree;

				$this->currentProfession=$currentProfession;
				$this->isOwner=$isOwner;

				return $this;
			}
	}

	class aboutMeBottom
	{
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

		public function __construct($mailId,$showMailId,$address,$phone, $showPhone,
			$city,$facebookId,$twitterId,$googleId, $linkedinId,$pinterestId,$isOwner)
			{
				
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
			public $schoolName;
			
			public $location;
			public $duration;
			public $minDuration;
			public $score;
			public $scoreType;
			public $isOwner;
			
			public function __construct($degreeId,$degree,$schoolName,$location,$duration,$minDuration,$score,$scoreType,$isOwner)
				{
					$this->degreeId=$degreeId;
					$this->degree = $degree ;
					$this->schoolName=$schoolName;
					$this->location=$location;
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
			public $isOwner;
			public function __construct($achievementId,$competition,$location,$description,$position,$isOwner)
				{
					$this->achievementId = $achievementId;
					$this->competition = $competition;
					$this->location = $location;
					$this->description = $description;
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
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
			public $isFeaturing;//whether should be displayed in bottom part or not.
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
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
					$this->teamMembers = $teamMembers;
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
					$this->organisation = $organisation;
					$this->isOwner=$isOwner;
					return $this;
				}
		}				
	
	class skillSet
		{
			public $jsonObj; 
			public $skills;
			public $rating;
			public $isOwner;
			public $message;
			public $errorCode;
			public function __construct($skills,$rating,$isOwner,$jsonObj,$message='',$errorCode=3)
				{	
					$this->skills = $skills;
					$this->rating = $rating;
					$this->isOwner=$isOwner;
					$this->jsonObj=$jsonObj;
					$this->message=$message;
					$this->errorCode=$errorCode;
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
			public $message;
			public $errorCode;
			public function __construct($tools,$isOwner,$message='',$errorCode=3)
				{	
					$this->tools = $tools;
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
					$this->isOwner=$isOwner;
					$this->message=$message;
					$this->errorCode=$errorCode;
					return $this;
				}
		}

	class interests
		{
			public $interests;
			public $isOwner;
			public $message;
			public $errorCode;
			public function __construct($interests,$isOwner,$message='',$errorCode=3)
				{	
					$this->interests = $interests;
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
					$this->isOwner=$isOwner;
					$this->message=$message;
					$this->errorCode=$errorCode;
					return $this;
				}
		}

	class workshops
		{
			public $workshopId;
			public $workshopName;
			public $duration;
			public $minDuration;
			public $place;
			public $attendees;
			public $isOwner;
			public function __construct($workshopId,$title,$duration,$minDuration,$place,$attendees,$isOwner)
				{	
					$this->workshopId=$workshopId;
					$this->duration = $duration;
					$this->minDuration = $minDuration;
					$this->workshopName= $title;
					$this->place = $place;
					/*if(=='null')
					{
						$this->='';
					}
					else
					{
						$this->=$
					}*/
					$this->attendees = $attendees;
					$this->isOwner=$isOwner;
					return $this;
				}
		}

			
			
	
	
?>