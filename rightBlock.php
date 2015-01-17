<script>

	function insertLittlePost(data)
	{
		var littlePost="";

		littlePost+='<a href="http://localhost/4pi/fetchSinglePost.php?ref='+data.postIdHash+'" class="list-group-item littlePost">'+data.postDetails+'</li></a>'
	
		$('#rightBlock1').find('ul').append(littlePost);

	}

	function insertLittleEvent(data)
	{
		var littleEvent="";

		littleEvent+='<a href="http://localhost/4pi/fetchSingleEvent.php?ref='+data.eventIdHash+'" class="list-group-item littleEvent">'+data.eventDetails+'</li></a>'
	
		$('#rightBlock2').find('ul').append(littleEvent);

	}

	function insertLittlePoll(data)
	{
		var littlePoll="";

		littlePoll+='<a href="http://localhost/4pi/fetchSinglePoll?ref='+data.pollIdHash+'" class="list-group-item littlePoll">'+data.pollQuestion+'</li></a>'
	
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

	/*setInterval(function(){
		fetchLittlePosts();
		fetchLittleEvents();
		fetchLittlePolls();
	},5000);*/



</script>










<div class="col-md-3" id="rightBlock" style="color:white;">

	<div class="row panel" id="rightBlock1" >

		<a href="newsfeed.php" style="color:white;"><div class="panel-heading text-center cursorPointer " style="font-size:18px;"><i class="fa fa-bank"></i>&nbsp;Posts</div></a>

			<ul class="list-group">

			</ul>

	</div>

	<br/>

	<div class=" row panel panel-success" id="rightBlock2" >

		<a href="events.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-gears"></i>&nbsp;Events</div></a>

			<ul class="list-group">

		  	</ul>

	</div>

	<br/>

	<div class="row panel panel-info"  id="rightBlock3">

		<a href="polls.php" style="color:white;"><div class="panel-heading text-center cursorPointer" style="font-size:18px;"><i class="fa fa-cubes"></i>&nbsp;Polls</div></a>

			<ul class="list-group">

		  	</ul>

	</div>

	<br/>

	<div class="btn-group btn-group-justified" id="rightBox">

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

<!-- end right block code -->