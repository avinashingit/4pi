<script>
	/*$(document).ready(function(){
	var s = $("#rightBox");
    
    var pos = s.position(); 
    
    $(window).scroll(function() {
    
        var windowpos = $(window).scrollTop();
    
        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
    
        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');
    
        if (windowpos >= pos.top+50) {
    		s.removeClass('hidden');
            s.addClass("stick");
    
            //$('#topBarNew').show();
    
           // $('#rightBox').hide();
    
            //$('#topBar').hide();

        } 

        else {
        	s.addClass('hidden');
            s.removeClass("stick");

            //$('#topBarNew').hide();

            //$('#topBar').show();

            //$('#rightBox').show();

        }
    });
	});*/

	/*$.fn.isOnScreen = function(){
    
	    var win = $(window);
	    
	    var viewport = {
	        top : win.scrollTop(),
	        left : win.scrollLeft()
	    };
	    viewport.right = viewport.left + win.width();
	    viewport.bottom = viewport.top + win.height();
	    
	    var bounds = this.offset();
	    bounds.right = bounds.left + this.outerWidth() - 75;
	    bounds.bottom = bounds.top + this.outerHeight() - 75;
	    
	    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
	    
	};*/

	/*if($('#rightBox').isOnScreen)
	{
		$('#rightBox').addClass('stick');
	}
	else
	{
		$('#rightBox').removeClass('stick');
	}*/

	function putInView()
	{
		var inViewElement=$("#inViewElement").html();
		if(inViewElement==998 || inViewElement==997 || inViewElement==999)
		{
			$("#rightBlock1").hide();
			$("#rightBlock2").show();
			$("#rightBlock3").show();
			$(".postsGroup").hide();
			$(".eventsGroup").show();
			$(".pollsGroup").show();
			// $("#rightBlock2").css({'margin-top':'7px !important'});
		}

		else if(inViewElement==1001 || inViewElement==1002 || inViewElement==1003)
		{
			$("#rightBlock1").show();
			$("#rightBlock2").hide();
			$("#rightBlock3").show();
			$(".eventsGroup").hide();
			$(".postsGroup").show();
			$(".pollsGroup").show();
			// $("#rightBlock2").css({'margin-top':'0px !important'});
		}
		else if(inViewElement==1004)
		{
			$("#rightBlock1").show();
			$("#rightBlock2").show();
			$("#rightBlock3").hide();
			$(".pollsGroup").hide();
			$(".postsGroup").show();
			$(".eventsGroup").show();
			// $("#rightBlock2").css({'margin-top':'0px'});
		}

		else
		{
			$("#rightBlock1").show();
			$("#rightBlock2").show();
			$("#rightBlock3").show();
			$(".postsGroup").show();
			$(".eventsGroup").show();
			$(".pollsGroup").show();
		}
	}

	setInterval(function(){putInView();},500);

	function insertLittlePost(data)
	{
		var littlePost="";

		if(data!="empty")
		{
			if(window.location.href.indexOf('fetchSingle')>-1)
			{
				littlePost+='<a href="/4pi/fetchSinglePost.php?ref='+data.postIdHash+'" class="list-group-item break-word littlePost"><i style="color:#004160;" class="fa fa-list-ul"></i>&nbsp;&nbsp;'+data.postDetails+'</li></a>';
			}
			else
			{
				littlePost+='<a target="_blank"  href="/4pi/fetchSinglePost.php?ref='+data.postIdHash+'" class="list-group-item break-word littlePost"><i style="color:#004160;" class="fa fa-list-ul"></i>&nbsp;&nbsp;'+data.postDetails+'</li></a>';
			}

			$("#rightBlock1").find(".emptyPostsRight").addClass('hidden');
		}

		else
		{
			$("#rightBlock1").find(".emptyPostsRight").removeClass('hidden');
		}
	
		$('#rightBlock1').find('ul').append(littlePost);

	}

	function insertLittleEvent(data)
	{
		var littleEvent="";

		if(data!="empty")
		{
			if(window.location.href.indexOf('fetchSingle')>-1)
			{
				littleEvent+='<a href="/4pi/fetchSingleEvent.php?ref='+data.eventIdHash+'" class="list-group-item break-word littleEvent"><i style="color:#98001D;" class="fa fa-calendar"></i>&nbsp;&nbsp;'+data.eventDetails+'</li></a>';	
			}
			else
			{
				littleEvent+='<a target="_blank" href="/4pi/fetchSingleEvent.php?ref='+data.eventIdHash+'" class="list-group-item break-word littleEvent"><i style="color:#98001D;" class="fa fa-calendar"></i>&nbsp;&nbsp;'+data.eventDetails+'</li></a>';
			}

			$("#rightBlock2").find(".emptyEventsRight").addClass('hidden');
		}
		else
		{
			$("#rightBlock2").find(".emptyEventsRight").removeClass('hidden');
		}

		$('#rightBlock2').find('ul').append(littleEvent);

	}

	function insertLittlePoll(data)
	{
		var littlePoll="";

		if(data!="empty")
		{
			if(window.location.href.indexOf('fetchSingle')>-1)
			{
				littlePoll+='<a href="/4pi/fetchSinglePoll.php?ref='+data.pollIdHash+'" class="list-group-item break-word littlePoll"><i style="color:#78009F;" class="fa fa-pie-chart"></i>&nbsp;&nbsp;'+data.pollQuestion+'</li></a>';
			}
			else
			{
				littlePoll+='<a target="_blank"  href="/4pi/fetchSinglePoll.php?ref='+data.pollIdHash+'" class="list-group-item break-word littlePoll"><i style="color:#78009F;" class="fa fa-pie-chart"></i>&nbsp;&nbsp;'+data.pollQuestion+'</li></a>';
			}

			$("#rightBlock3").find(".emptyPollsRight").addClass('hidden');
		}

		else
		{
			$("#rightBlock3").find(".emptyPollsRight").removeClass('hidden');
		}

		$('#rightBlock3').find('ul').append(littlePoll);

	}


	function fetchLittlePosts()
	{
		$.post('/4pi/handlers/postHandlers/fetchLittlePosts.php',{

		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				// console.log(data);
				$('#rightBlock1').find('ul').find('.littlePost').each(function(){
					$(this).remove();
				});
				

				if(data==404)
				{
					insertLittlePost("empty");
				}
				else
				{
					data=JSON.parse(data);
					for(i=0;i<data.length;i++)
					{
						insertLittlePost(data[i]);
					}
				}
				
			}
		});
	}

	function fetchLittleEvents()
	{
		$.post('/4pi/handlers/eventHandlers/fetchLittleEvents.php',{

		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				// console.log(data);
				$('#rightBlock2').find('ul').find('.littleEvent').each(function(){
					$(this).remove();
				});
				
				if(data==404)
				{
					insertLittleEvent("empty");
				}
				else
				{
					data=JSON.parse(data);
					for(i=0;i<data.length;i++)
					{
						insertLittleEvent(data[i]);
					}
				}
				
			}
		});
	}

	function fetchLittlePolls()
	{
		$.post('/4pi/handlers/pollHandlers/fetchLittlePolls.php',{

		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				//console.log(data);
				$('#rightBlock3').find('ul').find('.littlePoll').each(function(){
					$(this).remove();
				});
				
				if(data==404)
				{
					insertLittlePoll("empty");
				}
				else
				{
					data=JSON.parse(data);
					for(i=0;i<data.length;i++)
					{
						insertLittlePoll(data[i]);
					}
				}
				
			}
		});
	}


	$(document).ready(function(){
		fetchLittlePosts();
		fetchLittleEvents();
		fetchLittlePolls();
		$("#rightBlock1").hide();
		$("#rightBlock2").hide();
		$("#rightBlock3").hide();
	});

	setInterval(function(){
		fetchLittlePosts();
		fetchLittleEvents();
		fetchLittlePolls();
	},30000);



</script>

<div class="col-md-3" id="rightBlock" style="height:95vh;position:fixed;top:50px;right:0px;color:white;">

	<div class="row panel" id="rightBlock1" >

		<a href="newsfeed.php" style="color:white;"><div class="panel-heading text-center cursorPointer " style="font-size:18px;"><i class="fa fa-list-ul"></i>&nbsp;Posts</div></a>

			<ul class="list-group">

			</ul>

			<h4 style="color:black;padding:10px;" class="text-center emptyPostsRight hidden">No posts to display</h4>

	</div>

	<div class=" row panel panel-success" style="margin-top:5px;" id="rightBlock2" >

		<a href="events.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-calendar"></i>&nbsp;Events</div></a>

			<ul class="list-group">

		  	</ul>

		  	<h4 style="color:black;padding:10px;" class="text-center emptyEventsRight hidden">No events to display</h4>

	</div>

	<div class="row panel panel-info" id="rightBlock3">

		<a href="polls.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-pie-chart"></i>&nbsp;Polls</div></a>

			<ul class="list-group">

		  	</ul>

		  	<h4 style="color:black;padding:10px;" class="text-center emptyPollsRight hidden">No polls to display</h4>

	</div>

	<br/><br/><br/><br/><br/><br/><br/><br/><br/>

	<div class="row" id="rightBlock4">

		<a href="/4pi/ideaBank" target="_blank" class="ideaBankHeading" style="color:white;position:absolute;bottom:20px;width:96%;height:80px;padding-top:22px;"><div class="text-center cursorPointer" style="font-size:25px;"><i class="fa fa-exclamation"></i>dea Bank</div></a>

	</div>

	<!-- <div class="btn-group btn-group-justified hidden" id="rightBox">
	
	  <div class="btn-group postsGroup">
	
	    <a href="#rightBlock1"><button type="button" class="btn"  id="miniRightBlock1"><i style="color:white;" class="fa fa-list-ul" title="Posts"></i></button></a>
	
	  </div>
	
	  <div class="btn-group eventsGroup">
	
	    <a href="#rightBlock2"><button type="button" class="btn" id="miniRightBlock2"><i style="color:white;" class="fa fa-calendar" title="Events"></i></button></a>
	
	  </div>
	
	  <div class="btn-group pollsGroup">
	
	    <a href="#rightBlock3"><button type="button" class="btn" id="miniRightBlock3"><i style="color:white;" class="fa fa-pie-chart" title="Polls"></i></button></a>
	
	  </div>
	
	</div> -->

	<!-- <div id="ideaBox" class="text-center" style="height:50px;width:100%;position:fixed !important;bottom:15px !important;background-color:black;">
	
		<h1 style="color:white;">Idea Bank</h1>
	
	</div> -->

</div>

<!-- end right block code -->

<style>

.list-group-item
{
	padding:6px !important;
}


</style>