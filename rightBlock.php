<script>
	$(document).ready(function(){
		/*var s = $("#rightBox");
    
    var pos = s.position(); 
    
    $(window).scroll(function() {
    
        var windowpos = $(window).scrollTop();
    
        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
    
        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');
    
        if (windowpos >= pos.top+300) {
    
            s.addClass("stick");
    
            //$('#topBarNew').show();
    
           // $('#rightBox').hide();
    
            //$('#topBar').hide();

        } 

        else {

            s.removeClass("stick");

            //$('#topBarNew').hide();

            //$('#topBar').show();

            //$('#rightBox').show();

        }
    });*/
	});

	$.fn.isOnScreen = function(){
    
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
	    
	};

	if($('#rightBox').isOnScreen)
	{
		$('#rightBox').addClass('stick');
	}
	else
	{
		$('#rightBox').removeClass('stick');
	}

	function insertLittlePost(data)
	{
		var littlePost="";

		littlePost+='<a target="_blank"  href="/4pi/fetchSinglePost.php?ref='+data.postIdHash+'" class="list-group-item littlePost"><i style="color:#004160;" class="fa fa-list-ul"></i>&nbsp;&nbsp;'+data.postDetails+'</li></a>'
	
		$('#rightBlock1').find('ul').append(littlePost);

	}

	function insertLittleEvent(data)
	{
		var littleEvent="";

		littleEvent+='<a target="_blank" href="/4pi/fetchSingleEvent.php?ref='+data.eventIdHash+'" class="list-group-item littleEvent"><i style="color:#98001D;" class="fa fa-calendar"></i>&nbsp;&nbsp;'+data.eventDetails+'</li></a>'
	
		$('#rightBlock2').find('ul').append(littleEvent);

	}

	function insertLittlePoll(data)
	{
		var littlePoll="";

		littlePoll+='<a target="_blank"  href="/4pi/fetchSinglePoll.php?ref='+data.pollIdHash+'" class="list-group-item littlePoll"><i style="color:#78009F;" class="fa fa-pie-chart"></i>&nbsp;&nbsp;'+data.pollQuestion+'</li></a>'
	
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
				data=JSON.parse(data);
				for(i=0;i<data.length;i++)
				{
					insertLittlePost(data[i]);
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
				//console.log(data);
				$('#rightBlock2').find('ul').find('.littleEvent').each(function(){
					$(this).remove();
				});
				data=JSON.parse(data);
				for(i=0;i<data.length;i++)
				{
					insertLittleEvent(data[i]);
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
				data=JSON.parse(data);
				for(i=0;i<data.length;i++)
				{
					insertLittlePoll(data[i]);
				}
			}
		});
	}


	$(document).ready(function(){
		fetchLittlePosts();
		fetchLittleEvents();
		fetchLittlePolls();
	});

	setInterval(function(){
		fetchLittlePosts();
		fetchLittleEvents();
		fetchLittlePolls();
	},10000);



</script>

<div class="col-md-3" id="rightBlock" style="color:white;">

	<div class="row panel" id="rightBlock1" >

		<a href="newsfeed.php" style="color:white;"><div class="panel-heading text-center cursorPointer " style="font-size:18px;"><i class="fa fa-list-ul"></i>&nbsp;Posts</div></a>

			<ul class="list-group">

			</ul>

	</div>

	<div class=" row panel panel-success" id="rightBlock2" >

		<a href="events.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-calendar"></i>&nbsp;Events</div></a>

			<ul class="list-group">

		  	</ul>

	</div>

	<div class="row panel panel-info"  id="rightBlock3">

		<a href="polls.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-pie-chart"></i>&nbsp;Polls</div></a>

			<ul class="list-group">

		  	</ul>

	</div>

	<div class="btn-group btn-group-justified" id="rightBox">

	  <div class="btn-group">

	    <a href="#rightBlock1"><button type="button" class="btn"  id="miniRightBlock1"><i style="color:white;" class="fa fa-list-ul" title="Events"></i></button></a>

	  </div>

	  <div class="btn-group">

	    <a href="#rightBlock2"><button type="button" class="btn" id="miniRightBlock2"><i style="color:white;" class="fa fa-calendar" title="Threads"></i></button></a>

	  </div>

	  <div class="btn-group">

	    <a href="#rightBlock3"><button type="button" class="btn" id="miniRightBlock3"><i style="color:white;" class="fa fa-pie-chart" title="Polls"></i></button></a>

	  </div>

	</div>

</div>

<!-- end right block code -->

<style>

.list-group-item
{
	padding:6px !important;
}


</style>