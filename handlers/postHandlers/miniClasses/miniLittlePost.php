<?php
class miniLittlePost{
	public $postIdHash;//to identify the post
	public $postDetails;
	

	public function __construct($postId,$content)
	{
		$this->postIdHash=$postId;
		$this->postDetails=$content;
		return $this;
	}
}


?>