<?php
class miniPost{
	public $postId;//to identify the post
	public $sharedWith;//to display if he wants to edit in the modal
	public $postValidity;//to display in the edit modal
	//public $postUserId;
	//public $postProfilePic;

	public $postUserName;// to display the name
	public $postSubject;// obvious
	public $postContent;// obvious
	public $noOfStars; 
	public $noOfComments;

	public $noOfMailTos;
	public $postSeenNumber; 
	public $postCreationTime;//In normal Format
	public $followPost;// Boolean - to find out which button to display #1 to follow #2 to unfollow 
	public $postUserIdHash;// to display profile pic

	public $postUserId;// to show edit and delete #1- Owner# -1 - Not Owner
	public $postOwner;

	public function __construct($postId,$sharedWith,$postValidity,$postUserName,$postSubject,$postContent, 
		$noOfStars,$noOfComments, $noOfMailTos,$postSeenNumber,$postCreationTime,$followPost,$postUserIdHash,$postUserId,$postOwner)
	{
		$this->postId=$postId;//Actually postIdHash but used(names) as postId to conform with already existing use.
		$this->sharedWith=$sharedWith;
		$this->postValidity=$postValidity;
		//$this->$postUserId=$postUserId;
		//$this->$postProfilePic=$postProfilePic;

		$this->postUserName=$postUserName;
		$this->postSubject=$postSubject;
		$this->postContent=$postContent;
		$this->noOfStars=$noOfStars;
		$this->noOfComments=$noOfComments;

		$this->noOfMailTos=$noOfMailTos;
		$this->postSeenNumber=$postSeenNumber;
		$this->postCreationTime=$postCreationTime;
		$this->followPost=$followPost;
		$this->postUserIdHash=$postUserIdHash;

		$this->postUserId=$postUserId;
		$this->postOwner = $postOwner;
		return $this;
	}
}


?>