<?php
class miniLittlePoll{
	public $pollIdHash;//to identify the post
	public $pollQuestion;
	

	public function __construct($pollId,$content)
	{
		$this->pollIdHash=$pollId;
		$this->pollQuestion=$content;
		return $this;
	}
}


?>