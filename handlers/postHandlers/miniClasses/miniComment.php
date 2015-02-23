<?php
class miniComment{

	public $commentPostIdHash;//For Displaying under the respective post
	
	public $commentIdHash;//To identify the comment during edit or anywhere else
	
	public $commentUserIdHash;//to display the profile pic
	
	public $commentUserName;//To display the user
	
	public $commentContent;//Obvious

	public $commentTime;//obvious
	
	public $commentUserId;
	
	//public $postCommentCount;
	
	public $commentOwner;//// to display edit and delete.
	
	public $gender;
	
	public $profilePicExists;
	
	public $commentOwnerFullName;


	public function __construct($commentPostIdHash,$commentUserIdHash,$commentContent,$commentTime,
								$commentIdHash,$commentUserId,$commentUserName,$commentOwner,$gender,$profilePicExists,$commentOwnerFullName)
	{
		$this->commentIdHash=$commentIdHash;
		
		$this->commentPostIdHash=$commentPostIdHash;
		
		$this->commentUserIdHash=$commentUserIdHash;
		
		$this->commentUserName=($commentUserName);
		
		$this->commentContent=($commentContent);

		$this->commentTime=$commentTime;

		$this->commentUserId=$commentUserId;

		//$this->postCommentCount=$postCommentCount;

		$this->commentOwner=$commentOwner;

		$this->gender = $gender;

		$this->profilePicExists = $profilePicExists;

		$this->commentOwnerFullName=($commentOwnerFullName);

		return $this;
	}
}