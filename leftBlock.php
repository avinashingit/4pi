<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

	require_once '/QOB/qobConfig.php';

	mysql_connect(HOST,USER,PASSWORD) or die("Unable to connect to the server.");

	mysql_select_db(DB);

	$sql=sprintf("SELECT * FROM users WHERE userIdHash='%s'",mysql_real_escape_string($_SESSION['vj']));

	$results=mysql_query($sql);

	$row=mysql_fetch_object($results);

	// var_dump($row);

	$icons=array();
	$icons[0]="fa-gear";$icons[1]="fa-sort";$icons[2]="fa-space-shuttle";$icons[3]="fa-square";$icons[4]="fa-tags";

	$groups=array();
	$groups=explode(",",$row->clubsInvolved);



echo '



<div class="col-md-2" id="userDetails" style="padding:0px !important;" >

	<br/>

	<div id="userImage">

		<a href="http://localhost/4pi/'.$row->userId.'" ><h4 class="text-center" style="margin-bottom:10px;" ><img src="/4pi/img/proPics/'.$row->userIdHash.'.jpg" width="120" height="120" class="img-responsive img-circle"/></h4></a>
		
		<h4 class="text-center" ><a title="'.$row->name.'"href="http://localhost/4pi/'.$row->userId.'" style="color:white;" >'.substr($row->name,0,18).'...</a></h4>

	</div>

	<!--<div id="userBadges">

		<h4 class="text-center"><i class="fa fa-bomb colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-briefcase colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bullhorn colorWhite cursorPointer"></i></h4>

	</div> -->

	<br/>';

	echo '

	<div id="userGroups">

		<div class="table-responsive" id="userGroups">

		  	<table class="table" style="width:100%;" >';

		  	for($i=0;$i<count($groups);$i++)
		  	{
		  		echo '<tr class="group cursorPointer">

		    		<td><i class="fa '.$icons[$i].' colorWhite groupIcons"></i></td>

		    		<td title="'.$groups[$i].'">'.$groups[$i].'</td>

	    		</tr>';
		  	}

		  	echo '

		  	</table>

		</div>

	</div>	
	<br/><br/>
	<div class="text-center">
	<!--<a href="http://localhost/frontEnd/executiveWing/"><button style="background:linear-gradient(#5541BA, #503DB0) !important;color:white;" class="btn btn-lg">People</button></a>-->
	
	<table align="center" >
		<tr>
			<td style="cursor:pointer;width:70px;height:70px;color:white;"    ><a  class=" blcs" data-toggle="tooltip"  title="People"  onmouseover="$(this).tooltip(\'show\');"  href="/4pi/people/" style="color:white;" ><i class="  fa fa-building fa-2x"></i></a></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Clubs"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"title="Clubs"  href="/4pi/clubs/" style="display:block;color:white;"  ><i class="fa fa-share-alt fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Feedback"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"title="Feedback"  href="#feedback" style="display:block;color:white;"  ><i class="fa fa-envelope fa-2x"></i></td>
			
		</tr>
		
		<tr>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="About"  onmouseover="$(this).tooltip(\'show\');" class="blcs" title="About"  href="/4pi/about/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-info-circle fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="WebOps"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"  href="/4pi/team/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-users fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Idea Bank"  onmouseover="$(this).tooltip(\'show\');" class=" blcs" title="Idea Bank" href="/4pi/ideaBank/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-exclamation fa-2x"></i></td>
			
		</tr>
		
		
		
		
		
	</table>
	
	

	</div>
	<br/><br/>

</div>

<!-- left column code ends here -->';