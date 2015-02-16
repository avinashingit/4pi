<?php
class miniEvent
{
	public $eventIdHash;
	public $eventOrgName;// What the creater of the event enters the organiser name to be
	public $eventName;
	public $eventType;
	public $eventContent;

	public $eventDate;
	public $eventTime;
	public $eventVenue;
	public $attendCount;
	public $sharedWith;

	public $seenCount;
	public $eventOwner;//whether the user is the event owner or not
	public $isAttender;
	public $eventDurationHrs;
	public $eventDurationMin;

	public $eventStatus;
	public $eventTimestamp;
	public $gender;
	public $profilePicExists;

	public $eventOwnerName; //Creater's alias // only till release of final version with approvals
	public $eventUserIdHash;//creater's id hash // only till release of final version with approvals
	public $eventOwnerId;//
	public $eventOwnerFullName;//Creater's Full name
	public $isCOCAS;
	public $isApproved;

	function __construct($eventIdHash,$eventOrgName,$eventName,$eventType,$eventContent,
		$eventDate,$eventTime,$eventVenue,$attendCount,$sharedWith, 
		$seenCount,$eventOwner,$isAttender,$eventDurationHrs,$eventDurationMin, $eventStatus,$eventTimestamp,$gender,$profilePicExists,$eventOwnerName,$eventUserIdHash,$eventOwnerId,$eventOwnerFullName,$isCOCAS,$isApproved)
	{
		$this->eventIdHash=$eventIdHash;
		$this->eventOrgName=$eventOrgName;
		$this->eventName=$eventName;
		$this->eventType=$eventType;
		$this->eventContent=$eventContent;

		$this->eventDate=$eventDate;
		$this->eventTime=$eventTime;
		$this->eventVenue=$eventVenue;
		$this->attendCount=$attendCount;
		$this->sharedWith=$sharedWith;

		$this->seenCount=$seenCount;
		$this->eventOwner=$eventOwner;
		$this->isAttender=$isAttender;
		$this->eventDurationHrs=$eventDurationHrs;
		$this->eventDurationMin=$eventDurationMin;

		$this->eventStatus=$eventStatus;
		$this->eventTimestamp=$eventTimestamp;
		$this->gender = $gender;
		$this->profilePicExists = $profilePicExists;
		$this->eventOwnerName=$eventOwnerName;

		$this->eventUserIdHash=$eventUserIdHash;
		$this->eventOwnerId=$eventOwnerId;
		$this->eventOwnerFullName=$eventOwnerFullName;
		$this->isCOCAS=$isCOCAS;
		$this->isApproved=$isApproved;
		return $this;

	}
}
?>