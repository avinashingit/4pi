<?php
class miniNotification
{
	public $userIdHash;
	public $userName;

	public $notification;
	public $objectId;//though written Id send hash
	public $timestamp;
	public $isRead;


	function __construct($pollIdHash,$userName,$notification,$objectId,$timestamp,$isRead)
	{
		$this->pollIdHash=$pollIdHash;
		$this->userName=$userName;
		
		
		$this->notification=$notification;
		$this->objectId=$objectId;
		$this->timestamp=$timestamp;
		$this->isOwner=$isOwner;
	}


}

?>