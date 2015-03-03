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
define("SALT",211019931503);


//Salt for SESSION 2 Hashing
define("SALT2",9876501234);

//Salt for POST HASHING
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


// Hashing Algorithms used for different sections
//Polls and events - sha224
//Posts            - sha256
//comments         - sha384
//users            - sha512

/*********************Secretaries and Admins*************************/

//SAC Speaker
define("SAC", "MDM11B014");

// Co-Curricular Affairs Secretary
define("COCAS", "EDM11B011");

//Cultural Secretary
define("CULSEC", "MDM11B020");

//Student General Secretary
/*define("GEN", "COE11B005");*/

//Admin
/*define("ADMIN", "COE12B005");*/


?>
