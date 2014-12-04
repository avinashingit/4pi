<!-- basically the top bar i.e. the header part of the newsfeed, is common to all the users -->

<div class="row navbar-inverse" id="topBar">

	<div id="logo" class="col-md-2">

		<div id="icons" style="position:absolute;top:0;left:0;right:0;bottom:0;">

			<div  class="text-center" style="padding-top:5px;font-size:20px;" ><i class="fa fa-home colorWhite"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment  colorWhite"></i>
			
			    <div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-cog fa-lg" style="font-size:20px;color:white;" ></i>
					<span class="caret" style="color:white;" ></span>
					</a>
					<ul class="dropdown-menu text-left" >
						<li><a href="/4pi/index.php?logout=yes"><i class="fa fa-reply"></i> Logout</a></li>
						<li><a href="settings.php"><i class="fa fa-pencil"></i> Settings</a></li>
					</ul>
				</div>
			
			</div>

		</div>

	</div>

	<div id="brand" class="text-center col-md-2 col-md-offset-3"> 

		<a href="index.php"><img id="pilogo" src="/4pi/img/appImgs/fourpi.svg" width="45" height="auto" style="padding-top:3px;"/></a>

	</div>

	<div id="search" class="col-md-3 col-md-offset-2">

		<form class="navbar-form" role="search" style="padding-right:20px !important;">

		  <div class="form-group">

		    <input id="searchBefore" type="text" class="form-control input-md" style="border-radius:0px;width:100%;margin-left:-15px;" placeholder="Search">

		  </div>

		</form>

	</div>

</div>

<div class="row col-md-3 col-md-offset-9">

	<div id="searchResults1" style="background-color:white;margin-left:-15px;">

		<div class="row">

		<p>HELLOjfdalskfjadslkjgkldsajlkdsfjiejflepaowdsm ofncdsfocidsfui ewfoiadsjiflas</p>	<hr>
		<p>HELLOjfdalskfjadslkjgkldsajlkdsfjiejflepaowdsm ofncdsfocidsfui ewfoiadsjiflas</p> <hr>
		<p>HELLOjfdalskfjadslkjgkldsajlkdsfjiejflepaowdsm ofncdsfocidsfui ewfoiadsjiflas</p>	<hr>
		<p>HELLOjfdalskfjadslkjgkldsajlkdsfjiejflepaowdsm ofncdsfocidsfui ewfoiadsjiflas</p>

		</div>

		</div>
</div>

<!-- <div class="row navbar-inverse" id="topBarNew">

	<div id="logo" class="col-md-2">

		<div id="icons" style="position:absolute;top:0;left:0;right:0;bottom:0;">

			<div  class="text-center" style="padding-top:5px;font-size:20px;" ><i class="fa fa-home colorWhite"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment  colorWhite"></i>
			
			    <div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-cog fa-lg" style="font-size:20px;color:white;" ></i>
					<span class="caret" style="color:white;" ></span>
					</a>
					<ul class="dropdown-menu text-left" >
						<li><a href="logout.php"><i class="fa fa-reply"></i> Logout</a></li>
						<li><a href="settings.php"><i class="fa fa-pencil"></i> Settings</a></li>
					</ul>
				</div>
			
			</div>

		</div>

	</div>

	<div id="brand" class="text-center col-md-2 col-md-offset-1"> 

		<a href="index.php"><img id="pilogo" src="/4pi/img/appImgs/fourpi.svg width="35px" height="auto" style="padding-top:6px;"/></a>

	</div>

	<div id="search" class="col-md-2 col-md-offset-1">

		<form class="navbar-form" role="search">

		  <div class="form-group">

		    <input type="text" id="searchAfter" class="form-control input-md" style="border-radius:0px;width:100%;margin-left:-15px;" placeholder="Search">

		  </div>

		</form>

	</div>

	<div class="col-md-3 col-md-offset-1">

		<div class="btn-group btn-group-justified" id="rightBoxNew">

		  <div class="btn-group">

		    <a href="#rightBlock1"><button type="button" class="btn"  id="miniRightBlock1"><i style="color:white;" class="fa fa-bank" title="Events"></i></button></a>

		  </div>

		  <div class="btn-group">

		    <a href="#rightBlock2"><button type="button" class="btn" id="miniRightBlock2"><i style="color:white;" class="fa fa-gears" title="Threads"></i></button></a>

		  </div>

		  <div class="btn-group">

		    <a href="#rightBlock3"><button type="button" class="btn" id="miniRightBlock3"><i style="color:white;" class="fa fa-cubes" title="Polls"></i></button></a>

		  </div>

		</div>

	</div>

</div> -->

<script>

	//$('#searchBefore','#searchAfter').css({'background-color':'#484848','color':'white','border':'1px solid #484848'});

	$('#icons div i').css({'cursor':'pointer'});

	$('#icons div i').mouseover(function(){

		$(this).css({'color':'#fff'});

	});

	$('#icons div i').mouseout(function(){

		$(this).css({'color':'#e8e8e8'});

	});

	$(window).scroll(function() {

	if ($(this).scrollTop() > 0){  

	    $('#topBar').addClass("sticky");

	    // $('#topBarNew').addClass("sticky");

	  }

	  else{

	    $('#topBar').removeClass("sticky");

	    // $('#topBarNew').removeClass("sticky");

	  }
	  
    var srchResults = $("#searchResults1");
    
    var pos = srchResults.position(); 
    
    
    
        var windowposSearch = $(window).scrollTop();
    
        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
    
        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');
    
		$("#searchResults1").css("position", "fixed");
		$("#searchResults1").css("width", "96%");
		
        if (windowposSearch >= pos.top-50) {
		
				$("#searchResults1").css("margin-top", "50px");
				
				
				
				
            //s.addClass("stick");
    
            //$('#topBarNew').show();
    
            //$('#rightBox').hide();
    
            //$('#topBar').hide();

        }

        else {

			$("#searchResults1").css("margin-top", "0px");

        }
		
	

	});

	//$('#topBarNew').hide();

	$('#searchBefore').focusin(function(){

	$(this).css({'background-color':'#fff !important','color':'#000'});

	$(this).animate({'width':'178%'},500);

	});

	$('#searchBefore').focusout(function(){

	$(this).css({'background-color':'#484848 !important','color':'white','border':'1px solid #484848'});

	$(this).animate({'width':'100%'},500);

	});

	$('#searchResults1').hide();

	$('#searchBefore').focusin(function(){
		$('#searchResults1').slideDown(500);
	});

	$('#searchBefore').focusout(function(){
		$('#searchResults1').slideUp(500);
	});


</script>

<style>

#searchResults1{
	position:absolute;
	z-index:154897;
	border:1px solid gray;
	padding:10px;
	width:96%;
}

#search{
	padding-left:0px;
}



#topBarNew{
	position:abolsute;
}

.sticky{
	position:fixed;
	top:0px;
	z-index:99;
	width:100%;
}

#rightBoxNew{
	padding-top:4px;
}

#searchBefore, #searchAfter{
	height:29px !important;
}
</style>