<?php
class miniLittleEvent{
	public $eventIdHash;//to identify the post
	public $eventDetails;
	

	public function __construct($eventId,$content)
	{
		$this->eventIdHash=$eventId;
		$this->eventDetails=$content;
		return $this;
	}
}


?>