<?php 
	include_once("../header_initial.php");
?>

<link rel="stylesheet" type="text/css" href="css/sidebar.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/inputs.css" />
<script src="js/snap.svg-min.js"></script>
<link rel="stylesheet" type="text/css" href="css/button.css" />


<style>

	@font-face 
	{    
	    font-family: openSans;
	    src: url(../fonts/OpenSans-Light.ttf);
	}

	body
	{
		font-family:openSans !important;
	}

	.formLink
	{
		font-size:16px;
		cursor:pointer;
	}

	.fontSize16
	{
		font-size:16px;
	}

	input.pw
	{
   		-webkit-text-security: disc;
	}

</style>

<script>

$(document).ready(function(){
	$('#secondContent').hide();
	setInterval(function(){
		$('#firstContent').fadeOut(function(){
			$('#secondContent').fadeIn();
		});
	},00);
	$('.formLink').each(function(){
		var els=$(this).attr("data-target");
		$(els).hide();
		
	});
	$('#home').show();
	$('.formLink').click(function(){
		var els=$(this).attr("data-target");
		$('.formLink').each(function(){
			var ls=$(this).attr("data-target");
			$(ls).hide();
		});
		$(els).show();
	});
});

var userId="COE12B009";
function submitAuthentication()
{
	var p1=$('#authenicationForm').find('#password').val();
	var p2=$('#authenicationForm').find('#passwordAgain').val();
	if(p1.length<8)
	{
		alert("Password should consist of atleast 8 characters");
	}
	else if(p1!=p2)
	{
		alert("Passwords do not match");
	}
	else
	{
		$('#authenicationButton').find('.button__text').html("Submitting").attr("onclick","");
		$.post('/4pi/handlers/initial/insertPassword.php',{
			_passwordOne:p1,
			_passwordTwo:p2,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
				$('#authenicationButton').find('.button__text').html("Submit").attr("onclick","submitAuthentication();");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#authentication').hide();
				$('.formLink').each(function(){
					if($(this).attr("data-target")=="#authentication")
					{
						$(this).remove();
					}
				});
				$('#topPart').show();
			}
			else
			{
				$('#authenicationButton').find('.button__text').html("Submitting").attr("onclick","submitAuthentication();");
			}
		});
	}
}

function submitTopPart()
{
	alert("Vafjldas");
	var alias=$('#topPartForm').find('#topPartAlias').val().trim();
	var degree=$('#topPartForm').find('#topPartCurrentDegree').val().trim();
	var profession=$('#topPartForm').find('#topPartCurrentProfesssion').val().trim();
	var dob=$('#topPartForm').find('#topPartDOB').val().trim();
	var aboutme=$('#topPartForm').find('#topPartAboutme').val().trim();
	if(alias.length==0 || degree.length==0 || profession.length==0 || dob.length==0 || aboutme.length==0)
	{
		alert("Please fill all the fields.");
	}
	else if(dob.length!=10)
	{
		alert("Please enter the exact date of birth in dd/mm/yyyy format");
	}
	else
	{
		$('#topPartButton').find('.button__text').html("Submitting").attr("onclick","");
		$.post('/4pi/handlers/initial/insertTopPart.php',{
			_alias:alias,
			_degree:degree,
			_profession:profession,
			_dob:dob,
			_aboutme:aboutme
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
				$('#topPartButton').find('.button__text').html("Submit").attr("onclick","submitTopPart();");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#topPart').hide();
				$('.formLink').each(function(){
					if($(this).atrr("data-target")=="#topPart")
					{
						$(this).remove();
					}
				});
			}
			else
			{
				$('#topPartButton').find('.button__text').html("Submit").attr("onclick","submitTopPart();");
			}
		});
	}
}


</script>

<body>

	<div class="container">

		<div class="row"  id="firstContent">

			<div class="col-md-12 text-center">

				<br/><br/><br/><br/><br/><br/><br/>

				<h1 class="text-center">Hi</h1>

			</div><!-- end class col-md-12 -->

		</div><!-- end class row -->

		<div class="row" id="secondContent">

			<div class="col-md-2">
				
				<nav id="menu" class="menu">
					<button class="menu__handle"><span>Menu</span></button>
					<div class="menu__inner">
						<ul>
							<li><a class="formLink" data-target="#home"><i class="fa fa-fw fa-home"></i><span>Home<span></a></li>
							<li><a class="formLink" data-target="#authentication"><i class="fa fa-fw fa-unlock"></i><span>Authentication<span></a></li>
							<li><a class="formLink" data-target="#topPart"><i class="fa fa-fw fa-user"></i><span>Personal information<span></a></li>
							<li><a class="formLink" data-target="#bottomPart"><i class="fa fa-fw fa-envelope"></i><span>Contact<span></a></li>
							<li><a class="formLink" data-target="#projects"><i class="fa fa-fw fa-database"></i><span>Projects<span></a></li>
							<li><a class="formLink" data-target="#skills"><i class="fa fa-fw fa-bar-chart"></i><span>Skills<span></a></li>
							<li><a class="formLink" data-target="#tools"><i class="fa fa-fw fa-wrench"></i><span>Tools<span></a></li>
							<li><a class="formLink" data-target="#academics"><i class="fa fa-fw fa-mortar-board"></i><span>Academics<span></a></li>
							<li><a class="formLink" data-target="#certifications"><i class="fa fa-fw fa-certificate"></i><span>Certifications<span></a></li>
							<li><a class="formLink" data-target="#workshops"><i class="fa fa-fw fa-gears"></i><span>Workshops<span></a></li>
							<li><a class="formLink" data-target="#interests"><i class="fa fa-fw fa-star"></i><span>Interests<span></a></li>
							<li><a class="formLink" data-target="#achievements"><i class="fa fa-fw fa-trophy"></i><span>Achievements<span></a></li>
							<li><a class="formLink" data-target="#experience"><i class="fa fa-fw fa-fighter-jet"></i><span>Experience<span></a></li>
						</ul>
					</div>
					<div class="morph-shape" data-morph-open="M300-10c0,0,295,164,295,410c0,232-295,410-295,410" data-morph-close="M300-10C300-10,5,154,5,400c0,232,295,410,295,410">
						<svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">
							<path fill="none" d="M300-10c0,0,0,164,0,410c0,232,0,410,0,410"/>
						</svg>
					</div>
				</nav>

			</div>

			<div class="col-md-10 text-center">

				<div class="row" id="home">

					<div class="row">

						<div class="col-md-12 text-left">

							<h1>Welcome to 4pi</h1>

						</div>

					</div>

					<div class="row">

						<div class="col-md-12 text-left">

							<h2>4pi is </h2>

							<ol>
								<li><h3>The complete, holistic, all-encompassing information portal for you. All that you need to know, ought to know and want to know about our institute will be found here.</h3></li>

								<li><h3>A platform where ideas are shared, sparks are ignited and wonders are created, all through interaction on a platform which breaks down any barriers of accessibility and communication that existed hitherto.</h3></li>

								<li><h3>The one stop destination for institute news and happenings. Workshops, seminars and so forth.</h3></li>

								<li><h3>A platform that enables you to filter out what’s relevant to you, find people whose interests match yours and collaborate to make great things happen.</h3></li>

							</ol>

						</div>

					</div>

				</div><!-- end id home -->

				<div class="row" id="authentication">

					<form id="authenicationForm">

						<h1>Hello , <span id="currentUserName">Avinash</span></h1>
						<h3>Your roll number is your username</h3>
						<br/>

						<div class="input-container">
							<label class="input-label fontSize16" for="input-1">Password</label>
							<div class="input-wrap">
								<input type="text" class="pw" id="password"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">Password again</label>
							<div class="input-wrap">
								<input type="text" class="pw" id="passwordAgain"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<div class="col-md-3 col-md-offset-4">
								<button id="authenticationButton" class="button button--effect-1" onclick="submitAuthentication();">
									<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
										<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
											<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
										</svg>
									</span>
									<span style="color:black;" class="button__text">Submit</span>
								</button>
							</div>
						</div>
					</form>

				</div><!-- end id authentication -->

				<div class="row" id="topPart">

					<form id="topPartForm">

						<div class="input-container">
							<label class="input-label fontSize16" for="input-1">Alias</label>
							<div class="input-wrap">
								<input type="text" id="topPartAlias"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">Current degree</label>
							<div class="input-wrap">
								<input type="text" id="topPartCurrentDegree"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">Current job</label>
							<div class="input-wrap">
								<input type="text" id="topPartCurrentProfesssion"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">Date of Birth</label>
							<div class="input-wrap">
								<input type="text" class="datepicker" id="topPartDOB"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">About you</label>
							<div class="input-wrap">
								<input type="text" id="topPartAboutme"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<div class="col-md-3 col-md-offset-4">
								<button id="topPartButton" class="button button--effect-1" onclick="submitTopPart();">
									<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
										<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
											<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
										</svg>
									</span>
									<span style="color:black;" class="button__text">Submit</span>
								</button>
							</div>
						</div>
						

					</form>

				</div><!-- end id topPart -->

				<div class="row" id="bottomPart">

					<form id="bottomPartForm">
					
						<label class="input-label fontSize16" for="input-1">Alternate email</label>
						<div class="input-wrap">
							<input type="text" id="alternateEmail"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Address line 1</label>
						<div class="input-wrap">
							<input type="text" id="addressLine1"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Address line 2</label>
						<div class="input-wrap">
							<input type="text" id="addressLine2"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Phone number 1</label>
						<div class="input-wrap">
							<input type="text" id="contactNumber1"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Phone number 2</label>
						<div class="input-wrap">
							<input type="text" id="contactNumber2"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Facebook url</label>
						<div class="input-wrap">
							<input type="text" id="facebookURL"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Twitter url</label>
						<div class="input-wrap">
							<input type="text" id="twitterURL"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Google+ url</label>
						<div class="input-wrap">
							<input type="text" id="googlePlusURL"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Linkedin url</label>
						<div class="input-wrap">
							<input type="text" id="linkedinURL"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<label class="input-label fontSize16" for="input-1">Pinterest url</label>
						<div class="input-wrap">
							<input type="text" id="pintrestURL"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />
					
						<div class="col-md-3 col-md-offset-5">
							<button id="bottomPartButton" class="button button--effect-1" onclick="submitBottomPart();">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>
					</form>

				</div><!-- end id bottom part -->

				<div class="row" id="projects">

					<form id="projectsForm">

						<label class="input-label fontSize16" for="input-1">Title</label>
						<div class="input-wrap">
							<input type="text" id="projectTitle"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Company</label>
						<div class="input-wrap">
							<input type="text" id="projectCompany"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Position</label>
						<div class="input-wrap">
							<input type="text" id="projectPosition"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Team</label>
						<div class="input-wrap">
							<input type="text" id="projectTeam"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Description line 1</label>
						<div class="input-wrap">
							<input type="text" id="projectDescriptionLine1"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Description line 2</label>
						<div class="input-wrap">
							<input type="text" id="projectDescriptionLine2"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Description line 1</label>
						<div class="input-wrap">
							<input type="text" id="projectDescriptionLine1"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<div class="row">

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">From</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="projectDurationFrom"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">To</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="projectDurationTo"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

						</div>

						<div class="col-md-3 col-md-offset-4">
							<button id="projectPartButton" class="button button--effect-1" onclick="submitProject();">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id projects -->

				<div class="row" id="skills">

					<form id="skillsForm">

						<label class="input-label fontSize16" for="input-1">Skill</label>
						<div class="input-wrap">
							<input type="text" id="projectSkillName1" placeholder="Enter the skill. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<div class="input-wrap">
							<input type="text" id="projectSkillValue1" placeholder="Enter the percentage. Eg. 93"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Skill</label>
						<div class="input-wrap">
							<input type="text" id="projectSkillName2" placeholder="Enter the skill. Eg. After effects"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<div class="input-wrap">
							<input type="text" id="projectSkillValue2" placeholder="Enter the percentage. Eg. 63"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Skill</label>
						<div class="input-wrap">
							<input type="text" id="projectSkillName3" placeholder="Enter the skill. Eg. PHP"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<div class="input-wrap">
							<input type="text" id="projectSkillValue3" placeholder="Enter the percentage. Eg. 98"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<label class="input-label fontSize16" for="input-1">Skill</label>
						<div class="input-wrap">
							<input type="text" id="projectSkillName4" placeholder="Enter the skill. Eg. Web development"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<div class="input-wrap">
							<input type="text" id="projectSkillValue4" placeholder="Enter the percentage. Eg. 100"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<div class="col-md-3 col-md-offset-4">
							<button id="skillButton" class="button button--effect-1" onclick="submitSkills();">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id skills -->

				<div class="row" id="tools">

					<form id="toolsForm">

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="projectTool1" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="projectTool2" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="projectTool3" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="projectTool4" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="projectTool5" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="col-md-3 col-md-offset-5">
							<button id="skillButton" class="button button--effect-1" onclick="submitTools();">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id tools -->

				<div class="row" id="academics">

					<form id="academicsForm">

						<label class="input-label fontSize16" for="input-1">Degree</label>
						<div class="input-wrap">
							<input type="text" id="academicDegree" placeholder="Enter the degree. Eg. B.Tech"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Institution</label>
						<div class="input-wrap">
							<input type="text" id="academicInstitution" placeholder="Enter the degree. Eg. IIITD&M Kancheepuram"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Location</label>
						<div class="input-wrap">
							<input type="text" id="academicDegree" placeholder="Enter the location. Eg. Chennai"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="row">

							<div class="col-md-4">

								<label class="input-label fontSize16" for="input-1">Percentage/GPA</label>
								<div class="input-wrap">
									<input type="text" id="academicPercentage" placeholder=" Eg. 98% or 9.5"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-4">

								<label class="input-label fontSize16" for="input-1">From</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="academicDurationFrom" placeholder="Eg. 29/12/2014"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>


							</div>

							<div class="col-md-4">

								<label class="input-label fontSize16" for="input-1">To</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="academicDurationTo" placeholder="Eg. 29/12/2015"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

						</div>

						<div class="col-md-3 col-md-offset-5">
							<button id="academicsButton" class="button button--effect-1" onclick="submitAcademics();">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id academics -->

				<div class="row" id="certifications">

				</div><!-- end id certifications -->

				<div class="row" id="workshops">

				</div><!-- end id workshops -->

				<div class="row" id="interests">

				</div><!-- end id interests -->

				<div class="row" id="achievements">

				</div><!-- end id achievements -->

				<div class="row" id="experience">

				</div><!-- end id experience -->

				<div class="row" id="uploads">

				</div><!-- end id uploads -->

			</div>
			

		</div>

	</div>

<script src="js/classie.js"></script>
<script>
	//for the sidebar menu
	(function() {

		function SVGMenu( el, options ) {
			this.el = el;
			this.init();
		}

		SVGMenu.prototype.init = function() {
			this.trigger = this.el.querySelector( 'button.menu__handle' );
			this.shapeEl = this.el.querySelector( 'div.morph-shape' );

			var s = Snap( this.shapeEl.querySelector( 'svg' ) );
			this.pathEl = s.select( 'path' );
			this.paths = {
				reset : this.pathEl.attr( 'd' ),
				open : this.shapeEl.getAttribute( 'data-morph-open' ),
				close : this.shapeEl.getAttribute( 'data-morph-close' )
			};

			this.isOpen = false;

			this.initEvents();
		};

		SVGMenu.prototype.initEvents = function() {
			this.trigger.addEventListener( 'click', this.toggle.bind(this) );
		};

		SVGMenu.prototype.toggle = function() {
			var self = this;

			if( this.isOpen ) {
				classie.remove( self.el, 'menu--anim' );
				setTimeout( function() { classie.remove( self.el, 'menu--open' );	}, 250 );
			}
			else {
				classie.add( self.el, 'menu--anim' );
				setTimeout( function() { classie.add( self.el, 'menu--open' );	}, 250 );
			}
			this.pathEl.stop().animate( { 'path' : this.isOpen ? this.paths.close : this.paths.open }, 350, mina.easeout, function() {
				self.pathEl.stop().animate( { 'path' : self.paths.reset }, 800, mina.elastic );
			} );
			
			this.isOpen = !this.isOpen;
		};

		new SVGMenu( document.getElementById( 'menu' ) );

	})();

	//for inputs
	(function() {

				function SVGInput( el, options ) {
					this.el = el;
					this.inputEl = this.el.querySelector( 'input' );
					this.init();
				}

				SVGInput.prototype.init = function() {
					this.shapeEl = this.el.querySelector( 'span.morph-shape' );

					var s = Snap( this.shapeEl.querySelector( 'svg' ) );
					this.pathEl = s.select( 'path' );
					this.paths = {
						reset : this.pathEl.attr( 'd' ),
						active : this.shapeEl.getAttribute( 'data-morph-active' )
					};

					this.initEvents();
				};

				SVGInput.prototype.initEvents = function() {
					if( this.inputEl.type === 'checkbox' || this.inputEl.type === 'radio' ) {
						this.el.addEventListener( 'mousedown', this.down.bind(this) );
						this.el.addEventListener( 'touchstart', this.down.bind(this) );

						this.el.addEventListener( 'mouseup', this.up.bind(this) );
						this.el.addEventListener( 'touchend', this.up.bind(this) );

						this.el.addEventListener( 'mouseout', this.up.bind(this) );
					}
					else {
						this.el.addEventListener( 'click', this.toggle.bind(this) );
					}
				};

				SVGInput.prototype.down = function() {
					this.pathEl.stop().animate( { 'path' : this.paths.active }, 150, mina.easein );
				};

				SVGInput.prototype.up = function() {
					this.pathEl.stop().animate( { 'path' : this.paths.reset }, 1000, mina.elastic );
				};

				SVGInput.prototype.toggle = function() {
					var self = this;

					this.pathEl.stop().animate( { 'path' : this.paths.active }, 200, mina.easein, function() {
						self.pathEl.stop().animate( { 'path' : self.paths.reset }, 600, mina.elastic );
					} );
				};

				[].slice.call( document.querySelectorAll( '.input-wrap' ) ).forEach( function( el ) {
					new SVGInput( el );
				} );

	})();

	//for buttons
	(function() {

				function extend( a, b ) {
					for( var key in b ) { 
						if( b.hasOwnProperty( key ) ) {
							a[key] = b[key];
						}
					}
					return a;
				}
				
				function SVGButton( el, options ) {
					this.el = el;
					this.options = extend( {}, this.options );
					extend( this.options, options );
					this.init();
				}

				SVGButton.prototype.options = {
					speed : { reset : 800, active : 150 },
					easing : { reset : mina.elastic, active : mina.easein }
				};

				SVGButton.prototype.init = function() {
					this.shapeEl = this.el.querySelector( 'span.morph-shape' );

					var s = Snap( this.shapeEl.querySelector( 'svg' ) );
					this.pathEl = s.select( 'path' );
					this.paths = {
						reset : this.pathEl.attr( 'd' ),
						active : this.shapeEl.getAttribute( 'data-morph-active' )
					};

					this.initEvents();
				};

				SVGButton.prototype.initEvents = function() {
					this.el.addEventListener( 'mousedown', this.down.bind(this) );
					this.el.addEventListener( 'touchstart', this.down.bind(this) );

					this.el.addEventListener( 'mouseup', this.up.bind(this) );
					this.el.addEventListener( 'touchend', this.up.bind(this) );

					this.el.addEventListener( 'mouseout', this.up.bind(this) );
				};

				SVGButton.prototype.down = function() {
					this.pathEl.stop().animate( { 'path' : this.paths.active }, this.options.speed.active, this.options.easing.active );
				};

				SVGButton.prototype.up = function() {
					this.pathEl.stop().animate( { 'path' : this.paths.reset }, this.options.speed.reset, this.options.easing.reset );
				};

				[].slice.call( document.querySelectorAll( 'button.button--effect-1' ) ).forEach( function( el ) {
					new SVGButton( el );
				} );

				[].slice.call( document.querySelectorAll( 'button.button--effect-2' ) ).forEach( function( el ) {
					new SVGButton( el, {
						speed : { reset : 650, active : 650 },
						easing : { reset : mina.elastic, active : mina.elastic }
					} );
				} );

	})();	

	$('#topPartDOB').datepicker();
</script>

</body>