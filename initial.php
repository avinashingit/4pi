<?php include_once("header.php");include_once("QOB/qob.php");?>

<?php

	if(!isset($_GET['ref']))
	{
		echo "<script>alert('The url does not exist');</script>";
		exit();
	}
	else
	{
		$userIdHash=$_GET['ref'];
		$sql="SELECT * FROM users WHERE userIdHash=".$_GET['ref'];
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result))
		{
			$userName=$row['name'];
			$userId=$row['userId'];
		}

	}
?>

<script>
$(document).ready(function(){
	$('.second').hide();
	$(".third").hide();
	$('.fourth').hide();
	setInterval(function(){
		$('.first').fadeOut(function(){
			$('.third').fadeIn(function(){
				setInterval(function(){$('.third').fadeOut(function(){$('.third').remove();$('.second').fadeIn('fast');});},1500);
			});
		});
	},1500);
	
});



</script>


<div class="row">

	<div class="col-md-12 first">

		<h1 class="text-center"><br/><br/><br/><br/><br/><br/>Hi</h1>

	</div>

	<div class="col-md-8 col-md-offset-2 second">

		<br/><br/><br/><br/>

		<h2 class="text-left">4pi is</h2>

		<ul class="text-left" style="text-align:justify;font-size:22px;">
			
			<li>The complete, holistic, all-encompassing information portal for you. All that you need to know, ought to know and want to know about our institute will be found here.</li>

			<li>A platform where ideas are shared, sparks are ignited and wonders are created, all through interaction on a platform which breaks down any barriers of accessibility and communication that existed hitherto.</li>

			<li>The one stop destination for institute news and happenings. Workshops, seminars and so forth.</li>

			<li>A platform that enables you to filter out what’s relevant to you, find people whose interests match yours and collaborate to make great things happen.</li>

		</ul>

		<div class="text-center">

			<button class="btn btn-success btn-lg" onclick="$('.second').remove();$('.fourth').show();">Next</button>

		</div>

	</div>

	<div class="col-md-6 col-md-offset-3 third text-center" id="logArea"  >
		
		<a href="/4pi/team/" >
		
			<img id="pilogo" title="The 4&#960; Team - WebOps" class="img-responsive" src="img/appImgs/fourpi.svg" />
		
		</a>
	
	</div>

	<div class="fourth row">

		<div class="col-md-6 col-md-offset-3 text-center">

			<br/><br/><br/><br/><br/><br/>

			<div class="row">

				<h1 class="text-center">Hello <span id="userName"></span></h1>

				<h3  class="text-center">Your roll number (<span id="userId"></span>) is your username</h3>

			</div>

			<br/><br/>

			<div class="row">

				<form>

					<input class="form-control" type="password" id="password1" placeholder="Type your password."><br/>

					<input class="form-control" type="password" id="password2" placeholder="Type password again."><br/>

					<button class="btn btn-primary btn-md" onclick="setPassword();">Set password</button>

				</form>

			</div>

		</div>
		

	</div>

</div>