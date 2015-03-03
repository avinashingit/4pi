<?php 
include_once("header.php");
include_once("QOB/qob.php");
include_once("handlers/fetch.php")
?>

<?php
	error_reporting(E_WARNING ^ E_ALL ^ E_DEPRECATED);
	if(!isset($_GET['ref']))
	{
		echo "<script>alert('The url does not exist');window.location.href='/4pi/index.php';</script>";
		exit();
	}
	else
	{
		$userIdHash=$_GET['ref'];
		if(($row=getUserFromHash($userIdHash))!=false)
		{
			if($row['isActive']==1)
			{
				echo "<script>alert('You have already registered. Please login to continue!!!');window.location.href='/4pi/index.php';</script>";
				exit();
			}
			else
			{
				global $userName;
				$userName=$row['name'];
				global $userId;
				$userId=$row['userId'];
			}
			
		}

	}
?>

<script>
var userIdHash="<?php echo $_GET['ref'];?>";
var userName='<?php
	
		echo $row["name"];
	?>';

var userRollNumber='<?php
	echo $row["userId"];
?>';
$(document).ready(function(){
	$('.second').hide();
	$(".third").hide();
	$('.fourth').hide();
	setInterval(function(){
		$('.first').fadeOut(function(){
			$('.third').fadeIn(function(){
				setInterval(function(){$('.third').fadeOut(function(){$('.third').remove();$('.second').fadeIn('fast');});},3000);
			});
		});
	},1500);

	$("#userName").html(userName);
	$("#userId").html(userRollNumber);
	
});


function setPassword(e)
{
	e.preventDefault();
	// alert("Called");
	var p1=$("#password1").val();
	var p2=$("#password2").val();
	var alias=$("#aliasName").val().trim();
	if(p1.length<8 || p2.length < 8)
	{
		alert("The password should be atleast 8 characters length.");
	}
	else if(p1!=p2)
	{
		alert("Password not matching");
	}
	else if(alias.length==0)
	{
		alert("Alias cannot be empty");
	}
	else
	{
		// alert(p1+"       "+p2);
		$.post('/4pi/handlers/setPassword.php',{
			_p1:p1,
			_p2:p2,
			_p3:alias,
			_userIdHash:userIdHash
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			// alert(data);
			if(checkData(data)==1)
			{
				alert("Registration successfull. Congrats, "+userName+". YAAY!!!!");
				window.location.href="/4pi/index.php";
			}
		});
	}
}


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
		
			<img id="pilogo" title="The 4&#960; Team - WebOps" class="img-responsive" src="img/appImgs/fourpi.svg" />
	
	</div>

	<div class="fourth row">

		<div class="col-md-3">

			<br/><br/><br/><br/><br/><br/><br/>
	
			<img id="pilogo" class="img-responsive" title="The 4&#960; Team - WebOps" class="img-responsive" src="img/appImgs/fourpi.svg" />

		</div>

		<div class="col-md-5 col-md-offset-1 text-center">

			<br/><br/><br/><br/><br/><br/>

			<div class="row">

				<h1 class="text-center">Hello, <span id="userName"></span></h1>

				<h3  class="text-center">Your roll number (<span id="userId"></span>) is your username</h3>

			</div>

			<br/><br/>

			<div class="row">

				<form>

					<div class="form-group has-error">

						<input class="form-control" type="password" id="password1" placeholder="Type your password.Minimum 8 characters."><br/>

					</div>

					<div class="form-group has-error">

						<input class="form-control" type="password" id="password2" placeholder="Type password again.Minimum 8 characters."><br/>

					</div>

					<div class="form-group has-error">

						<input class="form-control" type="text" id="aliasName" placeholder="It is your display name. Used every where on 4pi."><br/>

					</div>

					<button class="btn btn-primary btn-md" onclick="setPassword(event);">Save changes</button>

				</form>

			</div>

		</div>
		

	</div>

</div>