<?php
class miniIdeaPost{
	public $userIdHash;
	public $userId;// to show edit and delete #1- Owner# 2 - Not Owner
	public $name;
	public $ideaPostId;//to identify the post
	public $ideaPostIdHash;//tpost id hash
	public $appreciaters;//
	public $appreciateCount;
	public $hasAppreciated;
	public $depreciaters;
	public $depreciateCount;
	public $hasDepreciated;
	public $ideaPostDate;
	public $ideaDescription;
	public $postOwner;
	public $gender;
	public $proPicExists;

	public function __construct($userIdHash, $userId, $name, $ideaPostId, $ideaPostIdHash, $appreciaters, $appreciateCount, $hasAppreciated, $depreciaters, $depreciateCount, $hasDepreciated, $ideaPostDate, $ideaDescription, $postOwner, $proPicExists, $gender)
	{
	
		$this->userIdHash = $userIdHash;
		$this->userId = $userId;
		$this->name = $name;
		$this->ideaPostId = $ideaPostId;
		$this->ideaPostIdHash = $ideaPostIdHash;
		$this->appreciaters = $appreciaters;
		$this->appreciateCount = $appreciateCount;
		$this->hasAppreciated = $hasAppreciated;
		$this->depreciaters = $depreciaters;
		$this->depreciateCount = $depreciateCount;
		$this->hasDepreciated = $hasDepreciated;
		$this->ideaPostDate=$ideaPostDate;
		$this->ideaDescription=$ideaDescription;
		$this->postOwner=$postOwner;
		$this->proPicExists = $proPicExists;
		$this->gender = $gender;

		return $this;
	}
}


?>