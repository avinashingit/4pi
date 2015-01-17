<!-- basically the top bar i.e. the header part of the newsfeed, is common to all the users -->

<script>

	function showNotifications()
	{
		$('#notifications').toggleClass('hidden').fadeIn(500);
		$('#notifications').css({'z-index':'1052'});
	}


	function insertNotifications(data,position)
	{
		var notification="";

		if(data.isRead==1)
		{
			notification+='<div class="row notification showed" id="'+data.notificationIdHash+'">';
		}

		else
		{
			notification+='<div class="row notification pleaseShow" id="'+data.notificationIdHash+'">';
		}

			notification+='<div class="col-md-12 text-left">';

			if(data.objectType==700)
			{
				notification+='<a href="http://localhost/4pi/posts/fetchSinglePost?ref='+data.objectId+'"><p><img width="25px" height="25px" src="/4pi/img/appImgs/postImg.jpg"/>&nbsp;&nbsp;'+data.notification+'</p>';

				notification+='</a>';
			}
			else if(data.objectType==800)
			{
				notification+='<a href="http://localhost/4pi/events/fetchSingleEvent?ref='+data.objectId+'"><p><img width="25px" height="25px"src="/4pi/img/appImgs/postImg.jpg"/>&nbsp;&nbsp;'+data.notification+'</p>';

				notification+='</a>';
			}
			else if(data.objectType==900)
			{
				notification+='<a href="http://localhost/4pi/polls/fetchSinglePoll.php?ref='+data.objectId+'"><p><img width="25px" height="25px"src="/4pi/img/appImgs/postImg.jpg"/>&nbsp;&nbsp;'+data.notification+'</p>';

				notification+='</a>';
			}

			notificatoin+='</div>';

		notification+='</div><!-- end class notification -->';

		$('#notfications').prepend(notification).hide().fadeIn(500);
	}

	function fetchNotifications()
	{
		var presentNotifications=new Array();
		var i=0;
		$('#notifications').find('.notificaion').each(function(){
			presentNotifications[i]=$(this).attr("id");
			i++;
		});
		$.post('/4pi/handlers/fetchNotifications.php',{
			_presentNotifications:presentNotifications
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			console.log("fjal"+data);
			if(checkData(data)==1)
			{
				if(data==404)
				{

				}
				else
				{
					data=JSON.parse(data);
					var unreadNotificationNumber=0;
					for(i=0;i<data.length;i++)
					{
						if(data[i].isRead==-1)
						{
							unreadNotificationNumber++;
						}
						insertNotification(data[i],"first");
					}
					$('#notificationNumber').html(unreadNotificationNumber);
				}
				
			}
		});
	}

	fetchNotifications();

	function insertPeopleSearch(data,val)
	{
		if(val==0)
		{
			var res="";

			res+='<div class="row peopleSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

			res+='<div class="col-md-11" id="userName">';

			if(data.gender="M")
			{
			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img src="/4pi/img/defaultMan1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			else
			{
			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img src="/4pi/img/defaultWoman.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
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

			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			
			res+='</div>';

			res+='</div>';
			$('#peopleSearchResult').append(res);
		}
	}

	function checkIfPeopleImageExists(data)
	{
		var url="http://localhost/4pi/img/proPics/"+data.userIdHash+".jpg";
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
			res+='<span><a href="http://localhost/4pi/posts/?ref=\''+data.postIdHash+'\'"><img src="/4pi/img/post.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.postContent+'</span></a></span>';
		}
		else
		{
			res+='<span><a href="http://localhost/4pi/posts/?ref=\''+data.postIdHash+'\'"><img src="/4pi/img/post.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.postSubject+'</span></a></span>';
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

		res+='<span><a href="http://localhost/4pi/events/?ref=\''+data.eventIdHash+'\'"><img src="/4pi/img/event.png" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:18px;" class="text-left">'+data.eventName+'</span></a></span>';

		res+='</div>';

		res+='</div>';

		$('#eventsSearch').append(res);
	}

	function globalSearchInsertEvents(data)
	{
		var res="";

		res+='<div class="row pollSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

		res+='<div class="col-md-11" id="pollName">';

		res+='<span><a href="http://localhost/4pi/polls/?ref=\''+data.pollIdHash+'\'"><img src="/4pi/img/poll.jpg" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:18px;" class="text-left">'+data.pollDescription+'</span></a></span>';

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
			console.log(data);
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

			/*if(data[0].length==0)
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
			}*/
			
		});
	}

</script>


<div class="row navbar-inverse" id="topBar">

	<div id="logo" class="col-md-2">

		<div id="icons" style="position:absolute;top:0;left:0;right:0;bottom:0;">

			<div  class="text-center" style="padding-top:5px;font-size:20px;" >

				<a style="color:white !important;" href="http://localhost/4pi"><i class="fa fa-home colorWhite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<i onclick="showNotifications();" class="fa fa-globe  colorWhite"></i>&nbsp;<span class="badge" id="notificationNumber">2</span>

				<div id="notifications" class="hidden">

					<div class="row notification" id="notificationid">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas1</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas2</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas3</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas4</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas5</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas6</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas7</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas8</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas9</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas10</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas11</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas12</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas13</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas14</p>

							</a>

						</div>

					</div><!-- end class notification -->

					<div class="row notification">

						<div class="col-md-12 text-left">

							<a><p><img width="25px" height="25px"src="/4pi/images/COE12B009.jpg"/>&nbsp;&nbsp;
							dfjlsafjdklsfjladsjfldkas15</p>

							</a>

						</div>

					</div><!-- end class notification -->

					


				</div>
			
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

		    <input id="searchBefore" type="text" onkeyup="fetchGlobalSearchResults();$('#searchResults1').removeClass('hidden');" class="form-control input-md" style="border-radius:0px;width:100%;margin-left:-15px;" placeholder="Search">

		  </div>

		</form>

		<div id="searchResults1" class="hidden" style="background-color:white;">

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

		 (function($){
	        $(window).load(function(){
	            $("#notifications").mCustomScrollbar({
	            	theme:"rounded-dots-dark"
	            });
	        });
	    })(jQuery);

	$(document).ready(function()
	{
	    $(document).mouseup(function(e)
	    {
	        var subject = $("#notifications"); 

	        if(e.target.id != subject.attr('id') && !subject.has(e.target).length)
	        {
	            if(subject.hasClass('hidden'))
            	{
            		subject.addClass('hidden').fadeOut(500);
            	}
            	else
            	{
            		subject.addClass('hidden').fadeOut(500);
            	}
	        }
	    });

	    $(document).mouseup(function(e)
	    {
	        var subject = $("#searchResults1"); 

	        if(e.target.id != subject.attr('id') && !subject.has(e.target).length)
	        {
	            if(subject.hasClass('hidden'))
            	{
            		subject.addClass('hidden').fadeOut(500);
            	}
            	else
            	{
            		subject.addClass('hidden').fadeOut(500);
            	}
	        }
	    });
	});

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

	  }

	  else{

	    $('#topBar').removeClass("sticky");

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


</script>

<style>
	
	.mCS-rounded-dots-dark
	{
		background-color:#f1f1f1;
		color:#000;
	}

	#notifications
	{
		position:absolute;
		z-index:154897;
		background-color:#FFFFFF;
		border:1px solid gray;
		width:150%;
		height:400px;
		overflow-y:auto;
		overflow-x:hidden;
	}

	.notification
	{
		color:black !important;
		padding:5px !important;
		font-size:13px;
		border-bottom:1px solid #eeeeee;
		
		white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
		white-space: -pre-wrap;      /* Opera 4-6 */
		white-space: -o-pre-wrap;    /* Opera 7 */
		white-space: pre-wrap;       /* css-3 */
		word-wrap: break-word;       /* Internet Explorer 5.5+ */
		word-break: break-all;
		white-space: normal;
		cursor:pointer;
	}

	.notification.showed
	{
		background-color:#f1f1f1;
	}

	.notification.pleaseShow
	{
		background-color:#efefef;
	}

	.notification p
	{
		margin:0px 0px 0px !important;
	}

	.notification a
	{
		color:black !important;
	}

	.notification:hover
	{
		background-color:#fefefe;
	}

	#searchResults1{
		position:absolute;
		z-index:154897;
		background-color:#FFFFFF;
		border:1px solid gray;
		width:96%;
		height:400px;
		overflow-y:auto;
		overflow-x:hidden;
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