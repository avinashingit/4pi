<!-- basically the top bar i.e. the header part of the newsfeed, is common to all the users -->
<script>
	var userId="<?php echo $_SESSION['userId'];?>";
	function changePassword()
	{
		var p1=$("#changePasswordModal").find("#changePasswordModalP1").val();
		var p2=$("#changePasswordModal").find("#changePasswordModalP2").val();
		var oldP=$("#changePasswordModal").find("#changePasswordModalOldPassword").val();

		if(p1.length<8)
		{
			alert("Your password should be atlease 8 characters.");
		}
		else if(p1!=p2)
		{
			alert("Passwords are not matching");
		}
		else
		{
			$.post('/4pi/handlers/changePassword.php',{
				_password:p1,
				_confirmPassword:p2,
				_oldPassword:oldP
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
			})
			.success(function(data){
				alert(data);
				if(checkData(data)==1)
				{
					if(data.trim()==17)
					{
						alert("Old password is wrong");
					}
					else if(data.trim()==3)
					{
						alert("Password successfully changed");
						$("#changePasswordModal").modal('hide');
						$("#changePasswordModal").find('input').val("");
					}
					
				}
			});
		}
	}

	function sendReadNotifications()
	{
		var readNotifications=new Array();
		var i=0;
		$('#notifications').find('.notification').each(function(){
			readNotifications[i]=$(this).attr("id");
			i++;
		});

		$.post('/4pi/handlers/readNotifications.php',{
			_readNotifications:readNotifications
		})
		.error(function(){
			alert("Server overload. Please try again. :(")
		})
		.success(function(data){
			//console.log(data);
			// alert(data);
		});
	}

	function showNotifications()
	{
		$('#notificationNumber').html("0");
		$('#notifications').toggleClass('hidden').fadeIn(500);
		$('#notifications').css({'z-index':'1052'});
		sendReadNotifications();
	}

	function insertNotifications(data,position)
	{
		// alert("hello");
		var notification="";

		if(data.isRead==1)
		{
			notification+='<div class="row notification showed" id="'+data.notificationId+'">';
		}

		else
		{
			notification+='<div class="row notification pleaseShow" id="'+data.notificationId+'">';
		}

			notification+='<div class="col-md-12 text-left">';

			if(data.objectType==500)
			{
				notification+='<a href="/4pi/fetchSinglePost.php?ref='+data.objectId+'"><p><i class="fa fa-list-ul"></i>&nbsp;&nbsp;'+data.notification+' <b>'+data.label+'</b></p>';

				notification+='</a>';
			}
			else if(data.objectType==600)
			{
				notification+='<a href="/4pi/fetchSingleEvent.php?ref='+data.objectId+'"><p><i class="fa fa-calendar"></i>&nbsp;&nbsp;'+data.notification+' <b>'+data.label+'</b></p>';

				notification+='</a>';
			}
			else if(data.objectType==700)
			{
				notification+='<a href="/4pi/fetchSinglePoll.php?ref='+data.objectId+'"><p><i class="fa fa-pie-chart"></i>&nbsp;&nbsp;'+data.notification+' <b>'+data.label+'</b></p>';

				notification+='</a>';
			}

			notification+='</div>';

		notification+='</div><!-- end class notification -->';

		//console.log(notification);

		$('#notifications').prepend(notification);
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
			// console.log(data);
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
						if(data[i].isRead==0)
						{
							unreadNotificationNumber++;
						}
						insertNotifications(data[i],"first");
					}
					//console.log(unreadNotificationNumber);
					$('#notificationNumber').html(unreadNotificationNumber);
				}
				
			}
		});
	}

	fetchNotifications();

	setInterval(function(){
		fetchNotifications();
	},300000);

	function insertPeopleSearch(data,val)
	{
		if(val==0)
		{
			var res="";

			res+='<div class="row peopleSearchResult" style="border-top:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

			res+='<div class="col-md-11" id="userName">';

			if(data.gender=="M")
			{
			res+='<span><a title="'+data.uname+'" href="/4pi/aboutMe/index.php?userId='+data.userId+'"><img src="/4pi/img/defaultMan1.jpg" alt="'+data.uname+'" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:15px;" class="text-left">'+data.uname.substring(0,20);+'</span></a></span>';
			}
			else
			{
			res+='<span><a title="'+data.uname+'" href="/4pi/aboutMe/index.php?userId='+data.userId+'"><img src="/4pi/img/defaultWoman1.jpg" alt="'+data.uname+'" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:15px;" class="text-left">'+data.uname.substring(0,20);+'</span></a></span>';
			}

			res+='</div>';

			res+='</div>';

			$('#peopleSearch').append(res);
		}
		else if(val==1)
		{
			var res="";

			res+='<div class="row peopleSearchResult" style="border-top:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

			res+='<div class="col-md-11" id="userName">';

			res+='<span><a title="'+data.uname+'" href="/4pi/aboutMe/index.php?userId='+data.userId+'"><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.uname+'" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:15px;" class="text-left">'+data.uname.substring(0,20);+'</span></a></span>';
			
			res+='</div>';

			res+='</div>';

			$('#peopleSearch').append(res);
		}
	}

	function checkIfPeopleImageExists(data)
	{
		/*var url="/4pi/img/proPics/"+data.userIdHash+".jpg";
		$.post(url,{})
		.error(function(){
			insertPeopleSearch(data,0);
		})
		.success(function(){
			insertPeopleSearch(data,1);
		});*/
		if(data.proPicExists==1)
		{
			insertPeopleSearch(data,1);
		}
		else
		{
			insertPeopleSearch(data,0);
		}
		
	}

	function globalSearchInsertPeople(data)
	{
		checkIfPeopleImageExists(data);
	}

	function globalSearchInsertPosts(data)
	{
		var res="";

		res+='<div class="row postSearchResult" style="border-top:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

		res+='<div class="col-md-11" id="postName">';

		if(data.postSubject.length==0)
		{
			res+='<span><a title="'+data.postContent+'" href="/4pi/fetchSinglePost.php?ref='+data.postIdHash+'"><img src="/4pi/img/post.jpg" alt="post" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:15px;" class="text-left">'+data.postContent.substring(0,20);+'</span></a></span>';
		}
		else
		{
			res+='<span><a title="'+data.postSubject+'" href="/4pi/fetchSinglePost.php?ref='+data.postIdHash+'"><img src="/4pi/img/post.jpg" alt="post" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:15px;" class="text-left">'+data.postSubject.substring(0,20);+'</span></a></span>';
		}

		res+='</div>';

		res+='</div>';

		$('#postsSearch').append(res);
	}

	function globalSearchInsertEvents(data)
	{
		var res="";

		res+='<div class="row eventSearchResult" style="border-top:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

		res+='<div class="col-md-11" id="eventName">';

		res+='<span><a title="'+data.eventName+'"href="/4pi/fetchSingleEvent.php?ref='+data.eventIdHash+'"><img src="/4pi/img/event.png" alt="event" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:15px;" class="text-left">'+data.eventName.substring(0,20);+'</span></a></span>';

		res+='</div>';

		res+='</div>';

		$('#eventsSearch').append(res);
	}

	function globalSearchInsertPolls(data)
	{
		var res="";

		res+='<div class="row pollSearchResult" style="border-top:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

		res+='<div class="col-md-11" id="pollName">';

		res+='<span><a title="'+data.pollDescription+'"href="/4pi/fetchSinglePoll.php?ref='+data.pollIdHash+'"><img src="/4pi/img/poll.jpg" alt="poll" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<span id="eventSubjectText" style="font-size:15px;" class="text-left">'+data.pollDescription.substring(0,20);+'</span></a></span>';

		res+='</div>';

		res+='</div>';

		$('#pollsSearch').append(res);
	}

	function fetchGlobalSearchResults()
	{
		$('#peopleSearchEmptyMessage').html("");
		$("#postsSearchEmptyMessage").html("");
		$("#eventsSearchEmptyMessage").html("");
		$("#pollsSearchEmptyMessage").html("");
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

			if(data[0].length==0)
			{
				$('#peopleSearchEmptyMessage').html("<h6 style=\"padding-top:5px\">No people found</h6>");
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
				$("#postsSearchEmptyMessage").html("<h6 style=\"padding-top:5px\">No posts found</h6>");
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
				$('#eventsSearchEmptyMessage').html("<h6 style=\"padding-top:5px\">No events found</h6>");
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
				$('#pollsSearchEmptyMessage').html("<h6 style=\"padding-top:5px\">No polls found</h6>");
			}
			else
			{
				for(i=0;i<data[3].length;i++)
				{
					globalSearchInsertPolls(data[3][i]);
				}
			}
			
		});
	}

</script>


<div class="row navbar-inverse" id="topBar">

	<div id="logo" class="col-md-2">

		<div id="icons" style="position:absolute;top:0;left:0;right:0;bottom:0;">

			<div  class="text-center" style="padding-top:5px;font-size:20px;" >

				<a style="color:white !important;" href="/4pi"><i class="fa fa-home colorWhite"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<i onclick="showNotifications();" class="fa fa-globe  colorWhite"></i>&nbsp;<span class="badge" id="notificationNumber"></span>

				<div id="notifications" class="hidden">

					


				</div>
			
			    <div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-cog fa-lg" style="font-size:20px;color:white;" ></i>
					<span class="caret" style="color:white;" ></span>
					</a>
					<ul class="dropdown-menu text-left" >
						<li><a href="/4pi/index.php?logout=yes"><i class="fa fa-reply"></i> Logout</a></li>
						<li><a href="#changePasswordModal" data-toggle="modal"><i class="fa fa-pencil"></i> Change password</a></li>
					</ul>
				</div>
			
			</div>

		</div>

	</div>

	<div id="brand" class="text-center col-md-2 col-md-offset-3"> 

		<a href="/4pi/index.php"><img id="pilogo" src="/4pi/img/appImgs/fourpi.svg" width="45" height="auto" style="padding-top:3px;"/></a>

	</div>

	<div id="search" class="col-md-3 col-md-offset-2">

		<form class="navbar-form" role="search" style="padding-right:20px !important;">

		  <div class="form-group">

		    <input id="searchBefore" type="text" onkeyup="if($(this).val().length!=0){fetchGlobalSearchResults();$('#searchResults1').removeClass('hidden');}" class="form-control input-md" style="border-radius:0px;width:100%;margin-left:-15px;" placeholder="Search">

		  </div>

		</form>

		<div id="searchResults1" class="hidden" style="background-color:white;">

			<div id="peopleSearch">

				<h5 class="text-center" style="padding-bottom:5px"><b>People</b></h5>

				<div class="text-center" id="peopleSearchEmptyMessage"></div>

			</div>

			<hr>

			<div id="postsSearch">

				<h5 class="text-center" style="padding-bottom:5px"><b>Posts</b></h5>

				<div class="text-center" id="postsSearchEmptyMessage"></div>

			</div>

			<hr>

			<div id="eventsSearch">

				<h5 class="text-center" style="padding-bottom:5px"><b>Events</b></h5>

				<div class="text-center" id="eventsSearchEmptyMessage"></div>

			</div>

			<hr>

			<div id="pollsSearch">

				<h5 class="text-center" style="padding-bottom:5px"><b>Polls</b></h5>

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
		/*background-color:#fff;*/
	}

	.notification.pleaseShow
	{
		background-color:#efefef;
		/*background-color:#fff;*/
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

<div class="hidden" id="inViewElement"></div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<span><p  style="font-size:15px;" class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> &nbsp;Change password&nbsp;&nbsp;</p></span>
			</div>
			<div class="modal-body">
				<form role="form">
					
					<div class="row">

						<div class="col-md-12">

							<input  class="form-control" type="password" id="changePasswordModalOldPassword" placeholder="Type current password."><br/>

							<input  class="form-control" type="password" id="changePasswordModalP1" placeholder="Type new password."><br/>

							<input class="form-control"  type="password" id="changePasswordModalP2" placeholder="Confirm new password."><br/>

						</div>

					</div>

				</form>
				<button onclick="changePassword();" class="btn btn-primary">Change</button>
			</div>
		</div>
	</div>	
</div>

<div class="modal fade" id="showContinueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
					
					<div class="row">

						<div class="col-md-12 text-center">

							<h4 class="text-center">Please login to continue.</h4>

							<button class="btn btn-md btn-primary text-center" onclick="redirectPageToLogin();">Ok</button>

						</div>

					</div>
			</div>
		</div>
	</div>	
</div>