<?php

//------Credits------//
//
//
//---Author : Hari Krishna Majety ,COE12B013.
//---Email: majetyhk@gmail.com
//
//
//---Credits Ends---//

class miniPoll
{
	public $pollIdHash;
	public $userName;

	public $pollQuestion;
	public $pollType;
	public $pollOptions;//array of options
	public $pollOptionsType;
	public $sharedWith;

	public $hasVoted;
	public $optionVotes;//array of votes to each option
	public $pollCreationTime;
	public $pollStatus;//open or closed
	public $isOwner;
	/*public $gender;
	public $profilePicExists;*/
	public $userIdHash;
	public $isSAC;
	public $approvalStatus;

	function __construct($pollIdHash,$userName,$pollQuestion,$pollType,$pollOptions,$pollOptionsType,
		$sharedWith,$hasVoted,$optionVotes,$pollCreationTime,$pollStatus,$isOwner,$userIdHash,$isSAC,$approvalStatus)
	{
		$this->pollIdHash=$pollIdHash;
		$this->userName=addslashes($userName);
		
		$this->pollQuestion=($pollQuestion);
		$this->pollType=$pollType;
		$this->pollOptions=$pollOptions;
		$this->pollOptionsType=$pollOptionsType;
		$this->sharedWith=$sharedWith;

		$this->hasVoted=$hasVoted;
		$this->optionVotes=$optionVotes;
		$this->pollCreationTime=$pollCreationTime;
		$this->pollStatus=$pollStatus;
		$this->isOwner=$isOwner;
		/*$this->gender = $gender;
		$this->profilePicExists = $profilePicExists;*/
		$this->userIdHash = $userIdHash;
		$this->isSAC= $isSAC;
		$this->approvalStatus=$approvalStatus;
		return $this;
	}


}

?>