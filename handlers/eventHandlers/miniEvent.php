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

	function __construct($eventIdHash,$eventOrgName,$eventName,$eventType,$eventContent,
		$eventDate,$eventTime,$eventVenue,$attendCount,$sharedWith, $seenCount,$eventOwner,$isAttender,$eventDurationHrs,$eventDurationMin,$eventStatus)
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
		$this->eventDuration=$eventDurationHrs;
		$this->eventDurationMin=$eventDurationMin;
		$this->eventStatus=$eventStatus;
		return $this;

	}
}
?>