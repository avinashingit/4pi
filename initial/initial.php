<?php 

	include_once("../header_initial.php");
	error_reporting(E_ALL ^E_NOTICE^E_WARNING^E_DEPRECATED);
	/*if($_GET['ref']=="")
	{
		echo '<script>alert("The url does not exist.");</script>';
		echo "<script>window.open('','_parent','');window.close();</script>";
	}*/
?>
<script>


	var userId="<?php echo $_GET['ref'];?>";
	console.log(userId);

	var userName="<?php
	$con=mysql_connect("localhost","root","root");
	mysql_select_db("iiitdmstudentsportal");
	$sql="SELECT name FROM users WHERE userIdHash='".$_GET['ref']."'";
	$res=mysql_query($sql);
	while($row=mysql_fetch_array($res))
	{
		echo $row[0];
	}
	?>";

	var userRollNumber="<?php
	$con=mysql_connect("localhost","root","root");
	mysql_select_db("iiitdmstudentsportal");
	$sql="SELECT userId FROM users WHERE userIdHash='".$_GET['ref']."'";
	$res=mysql_query($sql);
	while($row=mysql_fetch_array($res))
	{
		echo $row[0];
	}
	?>";
</script>

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
		$('#authenticationForm').find('#currentUserName').html(userName);
		$('#authenticationForm').find('#currentUserRollNumber').html(userRollNumber);
		$('#secondContent').hide();
		setInterval(function(){
			$('#firstContent').fadeOut(function(){
				$('#secondContent').fadeIn();
			});
		},100);
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
	function submitAuthentication(e)
	{
		alert("Authentication");
		e.preventDefault();
		var p1=$('#authenticationForm').find('#password').val();
		var p2=$('#authenticationForm').find('#passwordAgain').val();
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
			$('#authenticationButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertPassword.php',{
				_passwordOne:p1,
				_passwordTwo:p2,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
					$('#authenticationButton').find('.button__text').html("Submit").attr("onclick","submitAuthentication();");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#authentication').remove();
					$('.formLink').each(function(){if($(this).attr('data-target')=='#topPart'){$(this).toggleClass('hidden');}});
					$('.formLink').each(function(){
						if($(this).attr("data-target")=="#authentication")
						{
							$(this).remove();
							$('#topPart').show();
						}
					});
				}
				else
				{
					$('#authenticationButton').find('.button__text').html("Submitting").attr("onclick","submitAuthentication();");
				}
			});
		}
	}

	function submitTopPart(e)
	{
		alert("Vafjldas");
		e.preventDefault();
		var alias=$('#topPartForm').find('#topPartAlias').val().trim();
		/*var degree=$('#topPartForm').find('#topPartCurrentDegree').val().trim();
		var profession=$('#topPartForm').find('#topPartCurrentProfesssion').val().trim();*/
		var dob=$('#topPartForm').find('#topPartDOB').val().trim();
		var aboutme=$('#topPartForm').find('#topPartAboutme').val().trim();
		if(alias.length==0 || dob.length==0 || aboutme.length==0)
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
				_dob:dob,
				_aboutme:aboutme,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
					$('#topPartButton').find('.button__text').html("Submit").attr("onclick","submitTopPart();");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#topPart').remove();
					$('#topPart').hide();$('.formLink').each(function(){if($(this).attr('data-target')=='#bottomPart'){$(this).toggleClass('hidden');}});
					$('.formLink').each(function(){
						if($(this).attr("data-target")=="#topPart")
						{
							$(this).remove();
							$('#bottomPart').show();
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

	function submitBottomPart(e)
	{ 
		alert("Bottompart");
		e.preventDefault();
		var link=$("#bottomPartForm");
		var aEmail=link.find('#alternateEmail').val().trim();
		var addressLine1=link.find('#addressLine1').val().trim();
		var addressLine2=link.find('#addressLine2').val().trim();
		var cNumber1=link.find('#contactNumber1').val().trim();
		var cNumber2=link.find('#contactNumber2').val().trim();
		var facebook=link.find('#facebookURL').val().trim();
		var twitter=link.find('#twitterURL').val().trim();
		var gplus=link.find('#googlePlusURL').val().trim();
		var linkedin=link.find('#linkedinURL').val().trim();
		var pintrest=link.find('#pintrestURL').val().trim();
		$('#bottomPartButton').find('.button__text').html("Submitting").attr("onclick","");
		alert("done");
		$.post('/4pi/handlers/initial/insertBottomPart.php',{
			_alternateEmail:aEmail,
			_aLine1:addressLine1,
			_aLine2:addressLine2,
			_cNumber1:cNumber1,
			_cNumber2:cNumber2,
			_facebook:facebook,
			_twitter:twitter,
			_gplus:gplus,
			_linkedin:linkedin,
			_pintrest:pintrest,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
			$('#bottomPartButton').find('.button__text').html("Submit").attr("onclick","submitBottomPart(event);");
		})
		.success(function(data){
			alert(data);
			if(checkData(data)==1)
			{
				alert("success");
				$('#bottomPart').remove();
				$('.formLink').each(function(){
						if($(this).attr('data-target')=='#projects')
						{
							if($(this).hasClass('hidden')){
								$(this).removeClass('hidden');
							}
						}
					});
				$('.formLink').each(function(){
					if($(this).attr("data-target")=="#bottomPart")
					{
						$(this).remove();
						
					}
				});
				$("#projects").show();
			}
			else
			{
				$('#bottomPartButton').find('.button__text').html("Submit").attr("onclick","submitBottomPart(event);");
			}
		});
	}

	function submitProject(e)
	{
		var link=$('#projectsForm');
		e.preventDefault();
		var title=link.find('#projectTitle').val().trim();
		var company=link.find('#projectCompany').val().trim();
		var position=link.find('#projectPosition').val().trim();
		var team=link.find('#projectTeam').val().trim();
		var desc1=link.find('#projectDescriptionLine1').val().trim();
		var desc2=link.find('#projectDescriptionLine2').val().trim();
		var duration=link.find('#projectDurationFrom').val().trim()+"-"+link.find('#projectDurationTo').val().trim();
		if(title.length==0)
		{
			alert("Please enter the title");
		}
		else
		{
			$('#projectButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertProject.php',{
				_title:title,
				_company:company,
				_position:position,
				_team:team,
				_desc1:desc1,
				_desc2:desc2,
				_duration:duration,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$('#projectButton').find('.button__text').html("Submit").attr("onclick","submitProject(event);");
			})
			.success(function(data){
				// alert(data);
				if(checkData(data)==1)
				{
					$('#projects').hide();
					$('.formLink').each(function(){
						if($(this).attr('data-target')=='#skills')
							{
								if($(this).hasClass('hidden'))
								{
									$(this).removeClass('hidden');
								}
							}
						});
					$('#projectButton').find('.button__text').html("Submit").attr("onclick","submitProject(event);");
					$('.formLink').each(function(){
						if($(this).attr('data-target')=="#skills")
						{
							if($(this).hasClass('hidden'))
							{
								$(this).removeClass('hidden');
							}
						}
					});
					$('#skills').show();
				}
				else
				{
					$('#projectButton').find('.button__text').html("Submit").attr("onclick","submitProject(event);");
				}
			});
		}
	}

	function submitSkills(e)
	{
		e.preventDefault();
		var link=$('#skillsForm');
		var skill=link.find('#skillName1').val().trim();
		var value=link.find('#skillValue1').val().trim();
		if(skill.length==0 || value.length==0)
		{
			alert("Please fill all the fields");
		}
		else if(value<0 && value>100)
		{
			alert("Please dont underrate or overrate yourself.")
		}
		else
		{
			$('#skillButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertSkill.php',{
				_skill:skill,
				_value:value,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again.")
				$('#skillButton').find('.button__text').html("Submit").attr("onclick","submitSkills(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#skills').hide();
					$('#tools').show();
					$('#skillButton').find('.button__text').html("Submit").attr("onclick","submitSkills(event);");
					$('.formLink').each(function(){
						if($(this).attr('data-target')=="#tools")
						{
							if($(this).hasClass('hidden'))
							{
								$(this).removeClass('hidden');
							}
						}
					});
				}
				else
				{
					$('#skillButton').find('.button__text').html("Submit").attr("onclick","submitSkills(event);");
				}
			});
		}
	}

	function submitTools(e)
	{
		e.preventDefault();
		var toolName=$('#toolsForm').find('#toolName').val().trim();
		if(toolName.length==0)
		{
			alert("Please enter the tool name.");
		}
		else
		{
			$('#toolButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertTool.php',{
				_tool:toolName,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$('#toolButton').find('.button__text').html("Submit").attr("onclick","submitTools(event);");
			})
			.success(function(){
				if(checkData(data)==1)
				{
					$('#tools').hide();
					$('.formLink').each(function(){
						if($(this).attr('data-target')=='#academics')
						{
							if($(this).hasClass('hidden'))
							{
								$(this).removeClass('hidden');
							}
							
						}
					});
					$('#academics').show();
					$('#toolButton').find('.button__text').html("Submit").attr("onclick","submitTools();");
				}
				else
				{
					$('#toolButton').find('.button__text').html("Submit").attr("onclick","submitTools(event);");
				}
			});
		}
	}

	function submitAcademics(e)
	{
		e.preventDefault();
		var link=$('#academicsForm');
		var degree=link.find('#academicDegree').val().trim();
		var institute=link.find('#academicInstitution').val().trim();
		var location=link.find('#academicLocation').val().trim();
		var percentage=link.find('#academicPercentage').val().trim();
		var from=link.find('#academicDurationFrom').val().trim();
		var to=link.find('#academicDurationTo').val().trim();
		if(degree.length==0)
		{
			alert("Please enter the degree.");
		}
		else
		{
			$('#academicsButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertAcademics.php',{
				_userId:userId,
				_degree:degree,
				_institute:institute,
				_location:location,
				_percentage:percentage,
				_from:from,
				_to:to
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$('#academicsButton').find('.button__text').html("Submit").attr("onclick","submitAcademics(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#academics').hide();
					$('.formLink').each(function(){
						if($(this).attr('data-target')=='#certifications')
						{
							if($(this).hasClass('hidden'))
							{
								$(this).toggleClass('hidden');
							}
						}
					});
					$('#certifications').show();
					$('#academicsButton').find('.button__text').html("Submit").attr("onclick","submitAcademics(event);");

				}
				else
				{
					$('#academicsButton').find('.button__text').html("Submit").attr("onclick","submitAcademics(event);");
				}
			});
		}
	}

	function submitCertifications(e)
	{
		e.preventDefault();
		var link=$('#certificaitonsForm');
		var course=link.find('#certificationsCourseName').val().trim();
		var institute=link.find('#certificationsInstitute').val().trim();
		var from=link.find('#certificationsDurationFrom').val().trim();
		var to=link.find('#certificationsDurationTo').val().trim();
		if(course.length==0)
		{
			alert("Please enter the course name");
		}
		else
		{
			$('#certificationsButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertCertification.php',{
				_course:course,
				_institute:institute,
				_from:from,
				_to:to,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again.");
				$('#certificationsButton').find('.button__text').html("Submit").attr("onclick","submitCertifications(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#certifications').hide();
					$('.formLink').each(function(){
						if($(this).attr('data-target')=='#workshops')
						{
							if($(this).hasClass('hidden'))
							{
								$(this).removeClass('hidden');
							}
							
						}
					});
					$('#workshops').show();
					$('#certificationsButton').find('.button__text').html("Submit").attr("onclick","submitCertifications(event);");
				}
				else
				{
					$('#certificationsButton').find('.button__text').html("Submit").attr("onclick","submitCertifications(event);");
				}
			});
		}
	}

	function submitWorkshops(e)
	{
		e.preventDefault();
		var link=$('#workshopsForm');
		var name=link.find('#workshopName').val().trim();
		var location=link.find('#workshopLocation').val().trim();
		var attendee=link.find('#workshopPeopleNumber').val().trim();
		var from=link.find('#workshopDurationFrom').val().trim();
		var to=link.find('#workshopDurationTo').val().trim();
		if(name.length==0)
		{
			alert("Please enter the workshop name.");
		}
		else
		{
			$("#workshopsButton").find(".button__text").html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertWorkshop.php',{
				_name:name,
				_location:location,
				_attendee:attendee,
				_from:from,
				_to:to,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$("#workshopsButton").find(".button__text").html("Submit").attr("onclick","submitWorkshops(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$("#workshopsButton").find(".button__text").html("Submit").attr("onclick","submitWorkshops(event);");
					$('#workshops').hide();
					$('#interests').show();
				}
				else
				{
					$("#workshopsButton").find(".button__text").html("Submit").attr("onclick","submitWorkshops(event);");
				}
			});
		}
	}

	function submitInterests(e)
	{
		e.preventDefault;
		var interestName=$('#interestsForm').find('#interestName').val().trim();
		if(toolName.length==0)
		{
			alert("Please enter the interest name.");
		}
		else
		{
			$('#interestsButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertInterest.php',{
				_interest:interestName,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$('#interestsButton').find('.button__text').html("Submit").attr("onclick","submitInterests(event);");
			})
			.success(function(){
				if(checkData(data)==1)
				{
					$('#interests').hide();
					$('#achievements').show();
					$('#interestsButton').find('.button__text').html("Submit").attr("onclick","submitInterests(event);");
				}
				else
				{
					$('#interestsButton').find('.button__text').html("Submit").attr("onclick","submitInterests(event);");
				}
			});
		}
	}

	function submitAchievements(e)
	{
		e.preventDefault();
		var link=$("#achievementsForm");
		var name=link.find('#achievementsName').val().trim();
		var location=link.find('#achievementsLocation').val().trim();
		var description=link.find('#achievementsDescription').val().trim();
		var from=link.find('#achievementsDurationFrom').val().trim();
		var to=link.find('#achievementsDurationTo').val().trim();
		if(name.length==0)
		{
			alert("Please enter the achivement name");
		}
		else
		{
			$('#achievementsButton').find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertAchievement.php',{
				_name:name,
				_location:location,
				_description:description,
				_from:from,
				_to:to,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again.");
				$('#achievementsButton').find('.button__text').html("Submit").attr("onclick","submitAchievements(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#achievements').hide();
					$('#experience').show();
					$('#achievementsButton').find('.button__text').html("Submit").attr("onclick","submitAchievements(event);");
					$('#achievementsForm').find('input').val("");
				}
				else
				{
					$('#achievementsButton').find('.button__text').html("Submit").attr("onclick","submitAchievements(event);");
				}
			});
		}
	}

	function submitExperience(e)
	{
		e.preventDefault();
		var link=$('#experienceForm');
		var company=link.find('#experienceCompanyName').val().trim();
		var role=link.find('#experienceRole').val().trim();
		var from=link.find('#experienceDurationFrom').val().trim();
		var to=link.find('#experienceDurationTo').val().trim();
		if(company.length==0)
		{
			alert("Please enter the company or organisation name");
		}
		else
		{
			$("#experienceButton").find('.button__text').html("Submitting").attr("onclick","");
			$.post('/4pi/handlers/initial/insertExperience.php',{
				_company:company,
				_role:role,
				_from:from,
				_to:to,
				_userId:userId
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
				$("#experienceButton").find('.button__text').html("Submit").attr("onclick","submitExperience(event);");
			})
			.success(function(data){
				if(checkData(data)==1)
				{
					$('#experience').hide();
					$('#uploads').show();
					$("#experienceButton").find('.button__text').html("Submit").attr("onclick","submitExperience(event);");
				}
				else
				{
					$("#experienceButton").find('.button__text').html("Submit").attr("onclick","submitExperience(event);");
				}
			});
		}
	}

</script>

<body>

	<div class="container">

		<div class="row"  id="firstContent">

			<div class="col-md-12 text-center">

				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

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
							<li><a class="formLink hidden" data-target="#authentication"><i class="fa fa-fw fa-unlock"></i><span>Authentication<span></a></li>
							<li><a class="formLink hidden" data-target="#topPart"><i class="fa fa-fw fa-user"></i><span>Personal information<span></a></li>
							<li><a class="formLink hidden" data-target="#bottomPart"><i class="fa fa-fw fa-envelope"></i><span>Contact<span></a></li>
							<li><a class="formLink hidden" data-target="#projects"><i class="fa fa-fw fa-database"></i><span>Projects<span></a></li>
							<li><a class="formLink hidden" data-target="#skills"><i class="fa fa-fw fa-bar-chart"></i><span>Skills<span></a></li>
							<li><a class="formLink hidden" data-target="#tools"><i class="fa fa-fw fa-wrench"></i><span>Tools<span></a></li>
							<li><a class="formLink hidden" data-target="#academics"><i class="fa fa-fw fa-mortar-board"></i><span>Academics<span></a></li>
							<li><a class="formLink hidden" data-target="#certifications"><i class="fa fa-fw fa-certificate"></i><span>Certifications<span></a></li>
							<li><a class="formLink hidden" data-target="#workshops"><i class="fa fa-fw fa-gears"></i><span>Workshops<span></a></li>
							<li><a class="formLink hidden" data-target="#interests"><i class="fa fa-fw fa-star"></i><span>Interests<span></a></li>
							<li><a class="formLink hidden" data-target="#achievements"><i class="fa fa-fw fa-trophy"></i><span>Achievements<span></a></li>
							<li><a class="formLink hidden" data-target="#experience"><i class="fa fa-fw fa-fighter-jet"></i><span>Experience<span></a></li>
							<li><a class="formLink hidden" data-target="#uploads"><i class="fa fa-fw fa-upload"></i><span>Upload<span></a></li>
						</ul>
					</div>
					<div class="morph-shape" data-morph-open="M300-10c0,0,295,164,295,410c0,232-295,410-295,410" data-morph-close="M300-10C300-10,5,154,5,400c0,232,295,410,295,410">
						<svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">
							<path fill="none" d="M300-10c0,0,0,164,0,410c0,232,0,410,0,410"/>
						</svg>
					</div>
				</nav>

			</div>

			<div class="col-md-7 text-center">

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
								<li><h4>The complete, holistic, all-encompassing information portal for you. All that you need to know, ought to know and want to know about our institute will be found here.</h4></li>

								<li><h4>A platform where ideas are shared, sparks are ignited and wonders are created, all through interaction on a platform which breaks down any barriers of accessibility and communication that existed hitherto.</h4></li>

								<li><h4>The one stop destination for institute news and happenings. Workshops, seminars and so forth.</h4></li>

								<li><h4>A platform that enables you to filter out what’s relevant to you, find people whose interests match yours and collaborate to make great things happen.</h4></li>

							</ol>

						</div>

					</div>

					<div class="row">

						<button class="text-center btn btn-primary" onclick="$('#home').hide();$('#authentication').show();$('.formLink').each(function(){
						if($(this).attr('data-target')=='#authentication'){
						$(this).toggleClass('hidden');}});$('.formLink').each(function(){
						if($(this).attr('data-target')=='#home'){
						$(this).remove();}});";>Next</button>

					</div>

				</div><!-- end id home -->

				<div class="row" id="authentication">

					<br/><br/><br/><br/>

					<form id="authenticationForm">

						<h1>Hello , <span id="currentUserName"></span></h1>
						<h3>Your roll number <span id="currentUserRollNumber"></span> is your username</h3>
						<br/>

						<div class="input-container">
							<label class="input-label fontSize16" for="input-1">Password</label>
							<div class="input-wrap">
								<input type="password" id="password"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">Password again</label>
							<div class="input-wrap">
								<input type="password" id="passwordAgain"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<div class="col-md-3 col-md-offset-4">
								<button id="authenticationButton" class="button button--effect-1" onclick="submitAuthentication(event);">
									<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
										<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
											<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
										</svg>
									</span>
									<span style="color:black;" class="button__text">Set password</span>
								</button>
							</div>
						</div>
					
					</form>

				</div><!-- end id authentication -->

				<div class="row" id="topPart">

					<br/><br/><br/>

					<div class="row">

						<div class="text-center" style="font-size:26px;"><b>Personal information <span div style="font-size:16px;"> (*)</span></b></div>

					</div>

					<br/>

					<form id="topPartForm">

						<div class="input-container">
							<label class="input-label fontSize16" for="input-1">Display name (*)</label>
							<div class="input-wrap">
								<input type="text" id="topPartAlias" placeholder="Your alternate name. Required" required/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<!-- <label class="input-label fontSize16" for="input-1">Current degree</label>
							<div class="input-wrap">
								<input type="text" id="topPartCurrentDegree"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br /> -->
							<!-- <label class="input-label fontSize16" for="input-1">Current job</label>
							<div class="input-wrap">
								<input type="text" id="topPartCurrentProfesssion"/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br /> -->
							<label class="input-label fontSize16" for="input-1">Date of Birth</label>
							<div class="input-wrap">
								<input type="text" class="datepicker" id="topPartDOB" placeholder="You can set permissions later.Required." required/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<label class="input-label fontSize16" for="input-1">About you</label>
							<div class="input-wrap">
								<input type="text" id="topPartAboutme" placeholder="Required" required/>
								<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
									<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
										<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
									</svg>
								</span>
							</div>
							<br />
							<div class="col-md-3 col-md-offset-4">
								<button id="topPartButton" class="button button--effect-1" onclick="submitTopPart(event);">
									<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row">

						<div class="text-center col-md-10" style="font-size:26px;">Contact information</div> 

						<div class="col-md-2 text-center">

							<button class="btn btn-sm btn-default" onclick="$('#bottomPart').hide();$('.formLink').each(function(){
								if($(this).attr('data-target')=='#projects')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});$('#projects').show();">Skip</button>



						</div>

					</div>

					<form id="bottomPartForm">

						<div class="row">

							<div class="col-md-6">

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

							</div>

							<div class="col-md-6">

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

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

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

							</div>

							<div class="col-md-6">

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

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

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

							</div>

							<div class="col-md-6">

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

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

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

							</div>

							<div class="col-md-6">

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

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

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

							</div>

							<div class="col-md-6">

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

							</div>

						</div>

						
					
						<div class="col-md-12 text-center">
							<button id="bottomPartButton" class="button button--effect-1" onclick="submitBottomPart(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row text-center">

						<div class="col-md-10 text-center" style="font-size:26px;">Projects</div>

						<div class="col-md-2 text-center"><button class="btn btn-sm btn-default" onclick="$('#projects').hide();$('#skills').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#skills')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>

					</div>

					<br/>

					<form id="projectsForm">

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Title (*)</label>
								<div class="input-wrap">
									<input type="text" id="projectTitle" placeholder="Google search engine" required>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

							<div class="col-md-6">
	
								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Company</label>
								<div class="input-wrap">
									<input type="text" id="projectCompany" placeholder="Google Inc."/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Position</label>
								<div class="input-wrap">
									<input type="text" id="projectPosition" placeholder="Software systems architect"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Team</label>
								<div class="input-wrap">
									<input type="text" id="projectTeam" placeholder="Individual or Avinash,Hari,Sai kumar"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>
					
						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Description line 1</label>
								<div class="input-wrap">
									<input type="text" id="projectDescriptionLine1" placeholder="Short description"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Description line 2</label>
								<div class="input-wrap">
									<input type="text" id="projectDescriptionLine2" placeholder="Short description"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br />

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">From</label>
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

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">To</label>
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

						<div class="col-md-12 text-center">
							<button id="projectButton" class="button button--effect-1" onclick="submitProject(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row">
	
						<div class="col-md-10 text-center" style="font-size:26px;">Skill</div>

						<div class="col-md-2 text-center"><button class="btn btn-default btn-sm" onclick="$('#skills').hide();$('#tools').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#tools')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>
				
					</div>

					<br/>

					<form id="skillsForm">

						<label class="input-label fontSize16" for="input-1">Skill</label>
						<div class="input-wrap">
							<input type="text" id="skillName1" placeholder="Enter the skill. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>

						<br/>

						<label class="input-label fontSize16" for="input-1">Rating</label>
						<div class="input-wrap">
							<input type="number" id="skillValue1" placeholder="Rate yourself out of 100" min="0" max="100" />
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br />

						<div class="col-md-12 text-center">
							<button id="skillButton" class="button button--effect-1" onclick="submitSkills(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row">
	
						<div class="col-md-10 text-center" style="font-size:26px;">Tool</div>

						<div class="col-md-2 text-center"><button class="btn btn-default btn-sm" onclick="$('#tools').hide();$('#academics').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#academics')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>
				
					</div>

					<br/>

					<form id="toolsForm">

						<label class="input-label fontSize16" for="input-1">Tool name</label>
						<div class="input-wrap">
							<input type="text" id="toolName" placeholder="Enter the tool name. Eg. Photoshop"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="col-md-3 col-md-offset-5">
							<button id="toolButton" class="button button--effect-1" onclick="submitTools(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row">
	
						<div class="col-md-10 text-center" style="font-size:26px;">Academics</div>

						<div class="col-md-2 text-center"><button class="btn btn-default btn-sm" onclick="$('#academics').hide();$('#certifications').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#certifications')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>
				
					</div>

					<br/>

					<form id="academicsForm">

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Degree</label>
								<div class="input-wrap">
									<input type="text" id="academicDegree" placeholder="Enter the degree. Eg. B.Tech"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Institution</label>
								<div class="input-wrap">
									<input type="text" id="academicInstitution" placeholder="Enter the degree. Eg. IIITD&M Kancheepuram"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Location</label>
								<div class="input-wrap">
									<input type="text" id="academicLocation" placeholder="Enter the location. Eg. Chennai"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">Percentage/GPA</label>
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

						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">From</label>
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

							<div class="col-md-6">

								<label class="col-md-12 text-center input-label fontSize16" for="input-1">To</label>
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

						<div class="col-md-12 text-center">
							<button id="academicsButton" class="button button--effect-1" onclick="submitAcademics(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
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

					<div class="row">
	
						<div class="col-md-10 text-center" style="font-size:26px;">Certifications</div>

						<div class="col-md-2 text-center"><button class="btn btn-default btn-sm" onclick="$('#certifications').hide();$('#workshops').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#workshops')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>
				
					</div>

					<br/>

					<form id="certificationsForm">

						<div class="row">

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">Course name</label>
								<div class="input-wrap">
									<input type="text" id="certificationsCourseName" placeholder="Eg. Artificial Intelligence . Required ."/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">Institute</label>
								<div class="input-wrap">
									<input type="text" id="certificationsInstitute" placeholder="Eg. MIT"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">From</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="certificationsDurationFrom" placeholder="Eg. 17/1/2014"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">To</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="certificationsDurationTo" placeholder="Eg. 17/10/2014"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

						</div>

						<div class="col-md-3 col-md-offset-4">
							<button id="certificationsButton" class="button button--effect-1" onclick="submitCertifications(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8-5-136-5c-78.2,0-137,5-137,5s5-15.802,5-50.5C18,33.999,13,12,13,12s59,5,137,5c85,0,136-5,136-5s-5,17.598-5,52C281,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id certifications -->

				<div class="row" id="workshops">

					<div class="row">
	
						<div class="col-md-10 text-center" style="font-size:26px;">Workshops</div>

						<div class="col-md-2 text-center"><button class="btn btn-default btn-sm" onclick="$('#workshops').hide();$('#interests').show();
						$('.formLink').each(function(){
								if($(this).attr('data-target')=='#interests')
								{
									if($(this).hasClass('hidden'))
									{
										$(this).removeClass('hidden');
									}
								}
							});">Skip</button></div>
				
					</div>

					<br/>

					<form id="workshopsForm">

						<label class="input-label fontSize16" for="input-1">Workshop</label>
						<div class="input-wrap">
							<input type="text" id="workshopName" placeholder="Eg. Android development"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Location</label>
						<div class="input-wrap">
							<input type="text" id="workshopLocation" placeholder="Eg. IIT Madras"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="row">

							<div class="col-md-4">

								<label class="input-label fontSize16" for="input-1">Attendee no.</label>
								<div class="input-wrap">
									<input type="text" id="workshopPeopleNumber" placeholder="No. of attendees. Eg. 223"/>
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
									<input type="text" class="datepicker" id="workshopDurationFrom" placeholder="Eg. 22/03/1999"/>
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
									<input type="text" class="datepicker" id="workshopDurationTo" placeholder="Eg. 22/05/1999"/>
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
							<button id="workshopsButton" class="button button--effect-1" onclick="submitWorkshops(event);$('.formLink').each(function(){
						if($(this).attr('data-target')=='#interests'){
						$(this).toggleClass('hidden');}});">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>
	
					</form>

				</div><!-- end id workshops -->

				<div class="row" id="interests">

					<form id="interestsForm">

						<label class="input-label fontSize16" for="input-1">Interest</label>
						<div class="input-wrap">
							<input type="text" id="interestName" placeholder="Eg. Playing cricket"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="col-md-3 col-md-offset-5">
							<button id="interestsButton" class="button button--effect-1" onclick="submitInterests(event);$('.formLink').each(function(){
						if($(this).attr('data-target')=='#achievements'){
						$(this).toggleClass('hidden');}});">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id interests -->

				<div class="row" id="achievements">

					<form id="achievementsForm">

						<label class="input-label fontSize16" for="input-1">Event name</label>
						<div class="input-wrap">
							<input type="text" id="achievementsName" placeholder="Eg. Android app development"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Location</label>
						<div class="input-wrap">
							<input type="text" id="achievementsLocation" placeholder="Eg. IIT Madras"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Description</label>
						<div class="input-wrap">
							<input type="text" id="achievementsDescription" placeholder="A little description about the event."/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="row">

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">From</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="achievementsDurationFrom" placeholder="Eg. 22/03/2008"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">To</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="achievementsDurationTo" placeholder="Eg. 22/05/2009"/>
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
							<button id="achievementsButton" class="button button--effect-1" onclick="submitAchievements(event);$('.formLink').each(function(){
						if($(this).attr('data-target')=='#experience'){
						$(this).toggleClass('hidden');}});">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>
	
					</form>

				</div><!-- end id achievements -->

				<div class="row" id="experience">

					<form id="experienceForm">

						<label class="input-label fontSize16" for="input-1">Company</label>
						<div class="input-wrap">
							<input type="text" id="experienceCompanyName" placeholder="Eg. Microsoft"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<label class="input-label fontSize16" for="input-1">Role/position</label>
						<div class="input-wrap">
							<input type="text" id="experienceRole" placeholder="Eg. Software system architect"/>
							<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
								<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
									<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
								</svg>
							</span>
						</div>
						<br/>

						<div class="row">

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">From</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="experienceDurationFrom" placeholder="Eg. 17/1/2014"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

							<div class="col-md-6">

								<label class="input-label fontSize16" for="input-1">To</label>
								<div class="input-wrap">
									<input type="text" class="datepicker" id="experienceDurationTo" placeholder="Eg. 17/10/2014"/>
									<span class="morph-shape" data-morph-active="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s5-10,5-30c0-16-5-30-5-30s75,0,176,0c115,0,174,0,174,0s-5,14-5,30C354,60,359,70,359,70z">
										<svg width="100%" height="100%" viewBox="0 0 370 80" preserveAspectRatio="none">
											<path d="M359,70c0,0-59,0-174,0C84,70,9,70,9,70s0-10,0-30c0-16,0-30,0-30s75,0,176,0c115,0,174,0,174,0s0,14,0,30C359,60,359,70,359,70z"/>
										</svg>
									</span>
								</div>
								<br/>

							</div>

						</div>

						<div class="col-md-3 col-md-offset-4">
							<button id="experienceButton" class="button button--effect-1" onclick="submitExperience(event);">
								<span class="morph-shape" data-morph-active="M286,113c0,0-68.8,9-136,9c-78.2,0-137-9-137-9S3,97.198,3,62.5C3,33.999,13,12,13,12S72,2,150,2c85,0,136,10,136,10s11,17.598,11,52C297,96.398,286,113,286,113z">
									<svg width="100%" height="100%" viewBox="0 0 300 125" preserveAspectRatio="none">
										<path d="M286,113c0,0-68.8,0-136,0c-78.2,0-137,0-137,0s0-15.802,0-50.5C13,33.999,13,12,13,12s59,0,137,0c85,0,136,0,136,0s0,17.598,0,52C286,96.398,286,113,286,113z"/>
									</svg>
								</span>
								<span style="color:black;" class="button__text">Submit</span>
							</button>
						</div>

					</form>

				</div><!-- end id experience -->

				<div class="row" id="uploads">

				</div><!-- end id uploads -->

			</div>

			<div class="col-md-3 text-center">

				<br/><br/><br/><br/><br/><br/><br/><br/><br/>

				<img id="pilogo" title="The 4&#960; Team - WebOps" class="img-responsive" src="/4pi/img/appImgs/fourpi.svg" />

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

	 $( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:"dd/mm/yy"
	});
</script>

</body>