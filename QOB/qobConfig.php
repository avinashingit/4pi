<?php




/***************************CONNECTION DETAILS**************************/
//your server host name
define("HOST", "localhost");



//username of MySQL database
define("USER", "root");



//password of MySQL database
define("PASSWORD", "isquarer");



//choose your database
define("DB", "iiitdmstudentsportal");
/***************************CONNECTION DETAILS**************************/






/***************************COMMON PARAMETERS**************************/
//defining the default log file name
define("LOG_FILE", "./error.log");



//set the default time zone
define("TIME_ZONE", "Asia/Kolkata");
date_default_timezone_set(TIME_ZONE);



//defining the default log file name
define("C_TIME", time());

//SALT for password Hashing
define("PASSSALT", "PSaSaSwL0RtD");

//Salt for SESSION and USER Hashing
define("SALT",211019931500);


//Salt for SESSION 2 Hashing
define("SALT2",9876501234);

//Salt for POST&COMMENTS HASHING
define("POCHASH", "tlastsop21");

//Salt for Comments
define("COMHASH", "21HCAOSMHents");

//salt for EVENTS
define("POEVHASH", "sloppnstneve21");

//salt for polls
define("POLLHASH", "hsah12tlassllop");

//salt for notifications
define("HASHNOTIF", "s'fitonsisiht");

/***************************COMMON PARAMETERS**************************/



/*********************Secretaries and Admins*************************/

//SAC Speaker
define("SAC", "COE12B009");

// Co-Curricular Affairs Secretary
define("COCAS", "COE12B013");

//Student General Secretary
/*define("GEN", "COE11B005");*/

//Admin
/*define("ADMIN", "COE12B005");*/


?>
