<?php
class miniEvent
{
	public $eventIdHash;
	public $eventOrgName;
	public $eventName;
	public $eventType;
	public $eventContent;

	public $eventDate;
	public $eventTime;
	public $eventVenue;
	public $attendCount;
	public $sharedWith;

	public $seenCount;
	public $eventOwner;
	public $isAttender;
	public $eventDurationHrs;
	public $eventDurationMin;

	public $eventStatus;
	public $eventTimestamp;

	function __construct($eventIdHash,$eventOrgName,$eventName,$eventType,$eventContent,
		$eventDate,$eventTime,$eventVenue,$attendCount,$sharedWith, 
		$seenCount,$eventOwner,$isAttender,$eventDurationHrs,$eventDurationMin, $eventStatus,$eventTimestamp)
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
		return $this;

	}
}
?>