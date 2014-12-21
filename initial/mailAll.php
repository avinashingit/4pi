<?php

$server="localhost";
$db_name="iiitdmstudentsportal";
$username="root";
$password="root";

define("SALT",211019931500);

$con=mysql_connect($server,$username,$password) or die("Could not connect to the server ".mysql_error());
mysql_select_db($db_name);

$sql="SELECT userId FROM users";
$exe=mysql_query($sql);
$num=mysql_num_rows($exe);

while($row=mysql_fetch_assoc($reult))
{
	$emailId=$row[0]."@iiitdm.ac.in";
	$subject="Register at 4pi";
	$headers .= 'From: COE12B009@iiitdm.ac.in' . "\r\n";
	$message="Hi!\nTo register click the following link.\n"."http://localhost/4pi/initial/initial.php?ref=".hash("sha512",$row[0].SALT);
	mail($emailId, $subject, $message,$headers);
}