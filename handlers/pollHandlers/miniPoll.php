<?php
class miniPoll
{
	public $pollIdHash;
	public $userName;

	public $pollQuestion;
	public $pollType;
	public $pollOptions;//array of options
	public $pollOptionsType;
	//public $sharedWith;//not using because no editing of polls once displayed

	public $hasVoted;
	public $optionVotes;//array of votes to each option
	public $pollCreationTime;
	public $pollStatus;
	public $isOwner;

	function __construct($pollIdHash,$userName,$pollQuestion,$pollType,$pollOptions,$pollOptionsType,
		$hasVoted,$optionVotes,$pollCreationTime,$pollStatus,$isOwner)
	{
		$this->pollIdHash=$pollIdHash;
		$this->userName=$userName;
		
		$this->pollQuestion=$pollQuestion;
		$this->pollType=$pollType;
		$this->pollOptions=$pollOptions;
		$this->pollOptionsType=$pollOptionsType;
		//$this->sharedWith=$sharedWith;

		$this->hasVoted=$hasVoted;
		$this->optionVotes=$optionVotes;
		$this->pollCreationTime=$pollCreationTime;
		$this->pollStatus=$pollStatus;
		$this->isOwner=$isOwner;
	}


}

?>