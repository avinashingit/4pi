<?php

	mysql_connect("localhost","root","root");

	mysql_select_db("iiitdmstudentsportal");

	$sql="SELECT * FROM users WHERE userIdHash=".$_SESSION['vj'];

	$res=mysql_query($sql);

	$rows=mysql_num_rows($res);

	if($rows==1)
	{
		while($row=mysql_fetch_array($rows))
		{

		}
	}

<div class="col-md-2" id="userDetails" style="padding:0px !important;" >

	<br/>

	<div id="userImage">

		<a href="#" ><h4 class="text-center" style="margin-bottom:10px;" ><img src="/4pi/img/hpics/3.jpg" width="120" height="120" class="img-responsive img-circle"/></h4></a>
		
		<h4 class="text-center" ><a href="#" style="color:white;" >Preetham</a></h4>

	</div>

	<!--<div id="userBadges">

		<h4 class="text-center"><i class="fa fa-bomb colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-briefcase colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bullhorn colorWhite cursorPointer"></i></h4>

	</div> -->

	<br/>

	<div id="userGroups">

		<div class="table-responsive" id="userGroups">

		  	<table class="table" style="width:100%;" >

		    	<tr class="group cursorPointer">

		    		<td><i class="fa fa-gear colorWhite groupIcons"></i></td>

		    		<td title="Mechanical Community">Mechanical Comm...</td>

	    		</tr>

	    		<tr class="group cursorPointer">

		    		<td><i class="fa fa-sort colorWhite groupIcons"></i></td>

		    		<td>Zerone</td>

	    		</tr>

	    		<tr class="group cursorPointer">

		    		<td><i class="fa fa-space-shuttle groupIcons colorWhite"></i></td>

		    		<td>Product Design Club</td>

	    		</tr>

	    		<tr class="group cursorPointer">

		    		<td><i class="fa fa-square colorWhite groupIcons "></i></td>

		    		<td>Graphic Design Club</td>

	    		</tr>

	    		<tr class="group cursorPointer">

		    		<td><i class="fa fa-tags colorWhite groupIcons"></i></td>

		    		<td> Industrial Design Club</td>

	    		</tr>

		  	</table>

		</div>

		<!--<div class="text-center cursorPointer group"><i class="fa fa-gear colorWhite groupIcons"></i> Mechanical Community</div>

		<div class="text-center cursorPointer group"><i class="fa fa-sort colorWhite groupIcons"></i> Zerone</div>

		<div class="text-center cursorPointer group"><i class="fa fa-space-shuttle groupIcons colorWhite"></i>  Product Design Club</div>

		<div class="text-center cursorPointer group"><i class="fa fa-square colorWhite groupIcons "></i>  Graphic Design Club</div>

		<div class="text-center cursorPointer group"><i class="fa fa-tags colorWhite groupIcons"></i> Industrial Design Club</div>-->

	</div>	
	<br/><br/>
	<div class="text-center">
	<!--<a href="http://localhost/frontEnd/executiveWing/"><button style="background:linear-gradient(#5541BA, #503DB0) !important;color:white;" class="btn btn-lg">People</button></a>-->
	
	<table align="center" >
		<tr>
			<td style="cursor:pointer;width:70px;height:70px;color:white;"    ><a  class=" blcs" data-toggle="tooltip"  title="People"  onmouseover="$(this).tooltip('show');"  href="/4pi/people/" style="color:white;" ><i class="  fa fa-building fa-2x"></i></a></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Clubs"  onmouseover="$(this).tooltip('show');" class=" blcs"title="Clubs"  href="/4pi/clubs/" style="display:block;color:white;"  ><i class="fa fa-share-alt fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Feedback"  onmouseover="$(this).tooltip('show');" class=" blcs"title="Feedback"  href="#feedback" style="display:block;color:white;"  ><i class="fa fa-envelope fa-2x"></i></td>
			
		</tr>
		
		<tr>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="About"  onmouseover="$(this).tooltip('show');" class="blcs" title="About"  href="/4pi/about/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-info-circle fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="WebOps"  onmouseover="$(this).tooltip('show');" class=" blcs"  href="/4pi/team/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-users fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a  data-toggle="tooltip"  title="Idea Bank"  onmouseover="$(this).tooltip('show');" class=" blcs" title="Idea Bank" href="/4pi/ideaBank/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-exclamation fa-2x"></i></td>
			
		</tr>
		
		
		
		
		
	</table>
	
	

	</div>
	<br/><br/>

</div>

<!-- left column code ends here -->