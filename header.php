
<?php
/*****************************************************************************************************
 * header.php - a helper file to attach the website header to any page

 * Purpose: in includes all the website header details and can be included in any page

 * Major changes made:
   Date          Time        Description
   13-09-2014    12:17:26    file was created 


 * Bug fixes:
   Date          Time        Description

 * Developer: Battinoju Sai Kumar, 13/9/2014, 12:17:26

 * Comments:

 *****************************************************************************************************/
error_reporting(E_ALL ^ E_NOTICE);


?>

<!DOCTYPE html>
<html lang="en" >
  <head>

	<!--TITLE-->
		<title>4&#960; - Students Portal @ IIITD&ampM Kancheepuram</title>
	<!--TITLE-->
	
	
	<!--META DATA-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="4&#960; - Students Portal @ IIITD&amp;M Kancheepuram">
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">

		<!--AUTHORS-->
			<meta name="author" content="Battinoju Sai Kumar">
			<meta name="author" content="Kadimisetty Avinash">
			<meta name="author" content="Majety Hari Krishna">
			<meta name="author" content="Gantasala Hemanth">
			<meta name="author" content="Praneeth Ponnekanti">
			
			<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">-->
			
		<!--AUTHORS-->

		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<!--META DATA-->
	
	
	
	<!--FAVICON-->
		<link rel="shortcut icon" href="/4pi/img/appImgs/favicon.png">
	<!--FAVICON-->
	
	
	
	<!--CSS-->
		<!--INCLUDES-->
			<link href="/4pi/css/BS/bootstrap.min.css" rel="stylesheet"  type="text/css" media="screen" >

			<link href="/4pi/css/FA/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen"  >
		<!--INCLUDES-->
		
		<!--CUSTOM-->
			<link rel="stylesheet" href="/4pi/css/cs/style.css" type="text/css" >

			<!-- for notification Display-->
			<link rel="stylesheet" href="/4pi/css/TP/ns-default.css" type="text/css" >
			<link rel="stylesheet" href="/4pi/css/TP/ns-style-other.css" type="text/css" >
			
			<!-- for homepage tiles animation-->
			<link rel="stylesheet" href="/4pi/css/TP/animate.css" type="text/css" >

			<link rel="stylesheet" href="/4pi/css/Toottips/tooltip-line.css" type="text/css" >
			
			<link rel="stylesheet" href="/4pi/css/cs/newsfeed.css" type="text/css" >
			
			<!--<link rel="stylesheet" type="text/css" href="css/homeycombs.css" />-->
			
			<link rel="stylesheet" type="text/css" href="/4pi/css/BS/bsClCa/bootstrap-clockpicker.min.css">
			
			
		<!--CUSTOM-->
		
		<!--CDN-->
			<!-- for all external jquery effects-->
 			<link rel="stylesheet" href="/4pi/css/TP/jquery-ui.css">			
			
			<!--<link href='http://fonts.googleapis.com/css?family=Roboto:300&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>-->
			
			<!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
		<!--CDN-->

		<!-- For custom scroll bars -->
		<link rel="stylesheet" href="/4pi/css/TP/jquery.mCustomScrollbar.css" />
		
	<!--CSS-->


		<script>var randomNumber=Math.random();</script>
	
		<script src="/4pi/js/Jquery/jquery.min.js"></script>
		
		<!--BOOTSTRAP-->
		<script src="/4pi/js/BS/bootstrap.min.js"></script>
		<!--BOOTSTRAP-->
		
		<script src="/4pi/js/TP/timeago.js"></script>

		<script src="/4pi/js/cs/script.js?v=randomNumber"></script>

		<script src="/4pi/js/TP/jquery.shorten.js"></script>

		<!-- for notifications -->
		<script src="/4pi/js/TP/classie.js"></script>
		<script src="/4pi/js/TP/modernizr.custom.js"></script>
		<script src="/4pi/js/TP/notificationFx.js"></script>

		<script src="/4pi/js/cs/retrievePosts.js?v=randomNumber"></script>

		<script src="/4pi/js/cs/retrieveEvents.js?v=randomNumber"></script>

		<!-- <script src="/4pi/js/cs/retrievePolls.js"></script> -->
		
		<script src="/4pi/js/cs/newsfeed.js?v=randomNumber"></script>

		<script src="/4pi/js/TP/jquery-ui.js"></script>

		<script src="/4pi/js/BS/bsClCa/bootstrap-clockpicker.min.js"></script>

		<script src="/4pi/js/TP/highcharts.js"></script>
		
		<script src="/4pi/js/TP/highcharts-3d.js"></script>
	

		<!-- For custom scroll bar -->
		<script src="/4pi/js/TP/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<!--<script type='text/javascript' src="https://github.com/petersendidit/jquery-timeago/raw/master/jquery.timeago.js"></script>-->
		

		
		<!--<script type="text/javascript" src="http://viralpatel.net/blogs/demo/jquery/jquery.shorten.1.0.js"></script>-->
		
		

  </head>




<script>
$(document).ready(function(){




			 var s='\n\t\t				 010110101010              10101010101010101001001010010010010010100101\n';
				s+='\t\t				1010110101011              01010101010010010010101010101010101010101010\n';
				s+='\t\t			   00101010101011              01010101010101010101010101010101010100101010\n';
				s+='\t\t			  11011     10101                      		   01010010101\n';
				s+='\t\t 			 10101		10110 					   		   01011010111\n';
				s+='\t\t			01010		10100 					   		  10100 0 10100\n';
				s+='\t\t		   00101		01011                      		 01011 000 10101\n';
				s+='\t\t	      11010			10101                      		10100 00000 01010\n';
				s+='\t\t		 10110			10110                      	   01010 0000000 10110\n';
				s+='\t\t		01010			10101                      	  01010           01110\n';
				s+='\t\t	   10101            01011                      	 10100             11011\n';
				s+='\t\t	  01011				10110                      	01010               01000\n';
				s+='\t\t	 10110              01010                      11100           		 01101\n';
				s+='\t\t	01010 				10101                     00010            		  11001\n';
				s+='\t\t   01010				10110                    01010              	   00100\n';
			    s+='\t\t  11011					10101                   00110               	    11011\n';
			 s+='\t\t 00101					10100                  10100                	     01100\n';
			 s+='\t\t11010					10110                 10110                 	      11011\n';
			 s+='\t\t00101001010101010110101010101110101001010101110010                  		   00100\n';
			 s+='\t\t0101010101010101010100101111010101010101101011001                    		    10111\n';
			 s+='\t\t101010101010101010101010101010111010101010011010                     			 11010\n';
			 s+='\t\t						10101          	 10101                      			  00100\n';
			 s+='\t\t						10111           00110                       			   01101\n';
			 s+='\t\t						10100          10110                        			    10010\n';
			 s+='\t\t						10111         10111                                          01101\n';
			 s+='\t\t						10101        00110                                            10010\n';
			 s+='\t\t						10110       01001                                              10101\n';
			 s+='\t\t						10100      01010                                                01010\n';

												
console.log(s);
});
</script>





