<?php
class miniNotification
{
	public $notificationId;//Hash though written as Id
	//public $userName;

	public $notification;
	public $notificationType;
	public $objectId;//though written Id send hash
	public $objectType;
	public $timestamp;
	public $isRead;
	public $label;//Post Subject or event name or poll question or thread question


	function __construct($notificationId,$notification,$notificationType,$objectId,$objectType,$timestamp,$isRead,$label)
	{
		$this->notificationId=$notificationId;
		//$this->userName=$userName;
		
		
		$this->notification=$notification;
		$this->notificationType=$notificationType;
		$this->objectId=$objectId;
		$this->objectType=$objectType;
		$this->timestamp=$timestamp;
		$this->isRead=$isRead;
		$this->label=$label
	}


}

?>