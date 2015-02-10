<script>
	function insertPeopleSearch(data,val)
	{
		if(val==0)
		{
			var res="";
			res+='<div class="row peopleSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
			res+='<div class="col-md-11" id="userName">';
			if(data.gender="M")
			{
			res+='<span><a href="/4pi/'+data.userId+'"><img src="/4pi/img/defaultMan1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			else
			{
			res+='<span><a href="/4pi/'+data.userId+'"><img src="/4pi/img/defaultWoman.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			res+='</div>';
			res+='</div>';
			$('#peopleSearch').append(res);
		}
		else if(val==1)
		{
			var res="";
			res+='<div class="row peopleSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
			res+='<div class="col-md-11" id="userName">';
			res+='<span><a href="/4pi/'+data.userId+'"><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			
			res+='</div>';
			res+='</div>';
			$('#peopleSearchResult').append(res);
		}
	}
	function checkIfPeopleImageExists(data)
	{
		var url="/4pi/img/proPics/"+data.userIdHash+".jpg";
		$.post(url,{})
		.error(function(){
			insertPeopleSearch(data,0);
		})
		.success(function(){
			insertPeopleSearch(data,0);
		});
	}
	function globalSearchInsertPeople(data)
	{
		checkIfPeopleImageExists(data);
	}
	function globalSearchInsertPosts(data)
	{
		var res="";
		res+='<div class="row postSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
		res+='<div class="col-md-11" id="postName">';
		if(data.postSubject.length==0)
		{
			res+='<span><a href="/4pi/posts/?ref=\''+data.postIdHash+'\'"><img src="/4pi/img/post.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.postContent+'</span></a></span>';
		}
		else
		{
			res+='<span><a href="/4pi/posts/?ref=\''+data.postIdHash+'\'"><img src="/4pi/img/post.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.postSubject+'</span></a></span>';
		}
		res+='</div>';
		res+='</div>';
		$('#postsSearch').append(res);
	}
	function globalSearchInsertEvents(data)
	{
		var res="";
		res+='<div class="row eventSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
		res+='<div class="col-md-11" id="eventName">';
		res+='<span><a href="/4pi/events/?ref=\''+data.eventIdHash+'\'"><img src="/4pi/img/event.png" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:18px;" class="text-left">'+data.eventName+'</span></a></span>';
		res+='</div>';
		res+='</div>';
		$('#eventsSearch').append(res);
	}
	function globalSearchInsertEvents(data)
	{
		var res="";
		res+='<div class="row pollSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
		res+='<div class="col-md-11" id="pollName">';
		res+='<span><a href="/4pi/polls/?ref=\''+data.pollIdHash+'\'"><img src="/4pi/img/poll.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:18px;" class="text-left">'+data.pollDescription+'</span></a></span>';
		res+='</div>';
		res+='</div>';
		$('#pollsSearch').append(res);
	}
	function fetchGlobalSearchResults()
	{
		var input=$('#searchBefore').val().trim();
		$.post('/4pi/handlers/globalSearch.php',{
			_inputVal:input
		})
		.error(function(){
			alert("Server overload. Please try again");
		})
		.success(function(data){
			//console.log(data);
			data=JSON.parse(data);
			$('.peopleSearchResult').each(function(){
				$(this).remove();
			});
			$('.postSearchResult').each(function(){
				$(this).remove();
			});
			$('.eventSearchResult').each(function(){
				$(this).remove();
			});
			$('.pollSearchResult').each(function(){
				$(this).remove();
			});
			if(data[0].length==0)
			{
				$('#peopleSearchEmptyMessage').html("<h4>No people found</h4>");
			}
			else
			{
				for(i=0;i<data[0].length;i++)
				{
					globalSearchInsertPeople(data[0][i]);
				}	
			}
			if(data[1].length==0)
			{
				$("#postsSearchEmptyMessage").html("<h4>No posts found</h4>");
			}
			else
			{
				for(i=0;i<data[1].length;i++)
				{
					globalSearchInsertPosts(data[1][i]);
				}
			}
			if(data[2].length==0)
			{
				$('#eventsSearchEmptyMessage').html("<h4>No events found</h4>");
			}
			else
			{
				for(i=0;i<data[2].length;i++)
				{
					globalSearchInsertEvents(data[2][i]);
				}
			}
			if(data[3].length==0)
			{
				$('#pollsSearchEmptyMessage').html("<h4>No polls found</h4>");
			}
			else
			{
				for(i=0;i<data[3].length;i++)
				{
					globalSearchInsertPeople(data[3][i]);
				}
			}
			
		});
	}
</script>


<div class="row navbar-inverse" id="topBar">

	<div id="logo" class="col-md-2">

		<div id="icons" style="position:absolute;top:0;left:0;right:0;bottom:0;">

			<div  class="text-center" style="padding-top:5px;font-size:20px;" ><a style="color:white !important;" href="/4pi"><i class="fa fa-home colorWhite"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp; --><!-- <i class="fa fa-comment  colorWhite"></i> -->
			
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

		    <input id="searchBefore" type="text" onkeyup="fetchGlobalSearchResults();" class="form-control input-md" style="border-radius:0px;width:100%;margin-left:-15px;" placeholder="Search">

		  </div>

		</form>

		<div id="searchResults1" style="background-color:white;">

			<div id="peopleSearch">

				<h4 class="text-center">People</h4><br/>

				<div class="text-center" id="peopleSearchEmptyMessage"></div>

			</div>

			<div id="postsSearch">

				<h4 class="text-center">Posts</h4><br/>

				<div class="text-center" id="postsSearchEmptyMessage"></div>

			</div>

			<div id="eventsSearch">

				<h4 class="text-center">Events</h4><br/>

				<div class="text-center" id="eventsSearchEmptyMessage"></div>

			</div>

			<div id="pollsSearch">

				<h4 class="text-center">Polls</h4><br/>

				<div class="text-center" id="pollsSearchEmptyMessage"></div>

			</div>

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
	$('#search').focusin(function(){
		$('#searchResults1').slideDown(500);
	});
	$('#search').focusout(function(){
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