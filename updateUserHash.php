<?php


include_once('QOB/qobConfig.php');
mysql_connect("localhost","root","isquarer");
mysql_select_db("iiitdmstudentsportal");
$sql="SELECT userId FROM users";
$r=mysql_query($sql);
while($ro=mysql_fetch_array($r))
{
	$userIdHash=hash("sha512",$ro['userId'].SALT);
	// echo $ro['userId']."                ".$userIdHash."<br/>";
	$sql="UPDATE users SET userIdHash='".$userIdHash."' WHERE userId='".$ro['userId']."'";
	// echo $sql;
	mysql_query($sql);
}

?>