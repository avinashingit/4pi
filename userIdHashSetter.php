<?php
require_once('QOB/qob.php');
$conn=new QoB();
$result=$conn->select("SELECT userId FROM users");
$conn->startTransaction();
while($row=$conn->fetch($result))
{
	$userId=$row['userId'];
	$userIdHash=hash("sha512",$userId.SALT);
	$UpdateHashSQL="UPDATE users  SET userIdHash=? WHERE userId=? ";
	
	
	$values[0]=array($userIdHash => 's');
	$values[1]=array($userId => 's');
	
	print_r($values);
	
	$res=$conn->update($UpdateHashSQL,$values);
	
	
	if($conn->error!=""&&$res==false)
	{
		$cr=$conn->error;
		$conn->rollbackTransaction();
		echo "Error".$cr."! The Database is now reset to its previous state.";
		break;
	}
}
$conn->completeTransaction();
echo "Hashing Complete!!";

?>