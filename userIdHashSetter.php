<?php
require_once('QOB/qob.php');
// $conn=new QoB();
// $result=$conn->select("SELECT userId FROM users");
mysql_connect("localhost","root","isquarer");
mysql_select_db("iiitdmstudentsportal");
$file = fopen("2015.csv","r");
$c = 0;
if($file)
{
/*	while(($line = fgets($file))!==false)
	{*/

		// $x = split(",",$line);
		$userIdHash=hash("sha512","COE12B031".SALT);
		$c++;
		$sq = "INSERT INTO users(name, userId, gender,userIdHash) VALUES('ADMIN','COE12B031','M','".$userIdHash."')";
		echo $sq;
		mysql_query($sq) or die("F".mysql_error().$c);

	/*}
	fclose($file);
	echo $c."Finisahed";*/
}
else
{
	echo "Error opening";
}
/*
while()
{
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        // process the line read.
	        echo $line;
	    }

	    fclose($handle);
	} else {
	    // error opening the file.
	} 
}*/
/*
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
echo "Hashing Complete!!";*/

?>