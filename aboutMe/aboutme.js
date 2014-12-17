var userId=window.location.href.lastIndexOf('/');
var commonURLAbout="http://localhost/4pi/";
// fetch and insert top  && fetch and insert bottom && fetch and insert Projects && fetch and insert skills  &&fetch and insert experiences && fetch and insert workshops && fetch and insert academics && fetch and insert certifications && fetch and insert achievements are over
// pending skills,interests,tools
function insertTopPart(data)
{
	var topPart="";

				topPart+='<div class="col-md-2" id="personPicture">';

					topPart+='<a href="'+commonURLAbout+userId+'" class="thumbnail"><img src="../img/hpics/'+data.profilePictureHash+'.jpg"  alt="'+data.userName+'" class="img-responsive"/></a>';

					topPart+='<h4 class="text-center" id="personRollNumber">'+userId+'</h4>';

				topPart+='</div><!-- end id personPicture -->';

				topPart+='<div class="col-md-10" id="personInfo">';
					
					topPart+='<div class="row" id="personName">';

						topPart+='<div class="col-md-11">';

							topPart+='<h3 id="personNameText">'+data.userName+'</h3><br/>';

						topPart+='</div>';

						topPart+='<div class="col-md-1 text-right">';

							topPart+='<i class="fa fa-pencil" title="Edit" onclick="editPersonInfo();"></i>';

						topPart+='</div>';

					topPart+='</div><!-- end id person name -->';

					topPart+='<div class="row" id="personDetails">';

						topPart+='<div class="col-md-3">';

							topPart+='<div class="text-left" id="personDOB">'+data.userDOB+'</div><br/>';

							topPart+='<div class="text-left" id="personHighestDegree">'+data.personHighestDegree+'</div><br/>';

							topPart+='<div class="text-left" id="personCurrentProfession">'+data.persnCurrentProfession+'</div><br/>';

							topPart+='<div class="text-left" id="personResumeLink">';

								topPart+='<a href="'+data.resumeLink+'"><button class="btn btn-primary">Find my resume&nbsp;&nbsp;<i class="fa fa-external-link"></i></button></a>';

							topPart+='</div><!-- end person resume link id -->';

						topPart+='</div>';

						topPart+='<div class="col-md-9" id="personDescription">';

							topPart+='<p style="text-align:justify;line-height:22px;">'+data.aboutPerson+'</p>';

						topPart+='</div><!-- end class col-md-8 -->';

					topPart+='</div><!-- end person details id -->';


				topPart+='</div>';

	$('#topContent').html(topPart);
}

function fetchTopPart()
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchTopPart.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkdata(data)==1)
		{
			console.log(checkData(data)+" this is checkdata");
			x=JSON.parse(data);
			insertTopPart(x);
		}
	});
}

function insertBottomPart(data)
{
	var bottomPart="";

				bottomPart+='<br/>';

				bottomPart+='<div id="contact">';

					bottomPart+='<div class="row">';

						bottomPart+='<div class="col-md-5" style="border-right:1px solid #E6E6E6;">';

							bottomPart+='<div class="row">';

								bottomPart+='<h4 style="color:rgba(3, 184, 206, 1) ;"><i class="fa fa-envelope"></i>&nbsp;Leave a message</h4>';

							bottomPart+='</div>';

							bottomPart+='<br/>';

							bottomPart+='<form>';

								bottomPart+='<input type="text" id="leaveMessageName" class="form-control" placeholder="Your name"><br/>';

								bottomPart+='<input type="text" id="leaveMessageEmail" class="form-control" placeholder="Your email"><br/>';

								bottomPart+='<textarea type="text" id="leaveMessageTextMessage" class="form-control" placeholder="Your message"></textarea><br/>';

								bottomPart+='<button class="btn btn-primary">Send</button>';


							bottomPart+='</form>';


						bottomPart+='</div><!-- end class col-md-6 -->';

						bottomPart+='<div class="col-md-6 col-md-offset-1">';

							bottomPart+='<div class="row">';
	
								bottomPart+='<h4 style="color:rgba(222, 123, 26, 1);"><i class="fa fa-share-alt"></i>&nbsp;Lets get connected</h4>';

							bottomPart+='</div>';

							bottomPart+='<br/>';

							bottomPart+='<div class="row" >';

							if(data.facebookId!="")
							{
								bottomPart+='<div class="col-md-2">';
									bottomPart+='<a href="'+data.facebookId+'" class="icon-button facebook" ><i class="fa fa-facebook" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}
								
							if(data.twitterId!="")
							{
								bottomPart+='<div class="col-md-2">';
									bottomPart+='<a href="'+data.twitterId+'"  class="icon-button twitter"><i class="fa fa-twitter" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.gplusId!="")
							{
								bottomPart+='<div class="col-md-2">';
									bottomPart+='<a href="#" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.linkedinId!="")
							{
								bottomPart+='<div class="col-md-2">';
									bottomPart+='<a href="#" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.pinterestId!="")
							{
								bottomPart+='<div class="col-md-2">';
									bottomPart+='<a href="#" class="icon-button pinterest"><i class="fa fa-pinterest" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							bottomPart+='</div>';

							bottomPart+='<br/>';

							bottomPart+='<div class="row">';

							if(data.userEmails.length!=0)
							{
								bottomPart+='<div class="text-left col-md-4">';

									bottomPart+='<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-envelope"></i>&nbsp;Email(s)</h4>';

									bottomPart+='<br/>';

									for(i=0;i<data.userEmails.length;i++)
									{
										bottomPart+='<p>'+data.userEmails[i]+'</p>';
									}

								bottomPart+='</div>';
							}

							if(data.address.length!=0)
							{
								bottomPart+='<div class="text-left col-md-4">';

									bottomPart+='<h4 style="color:rgba(80, 183, 154, 1);"><i class="fa fa-map-marker"></i>&nbsp;Address</h4>';

									bottomPart+='<br/>';

									bottomPart+='<p>'+data.address+'</p>';

								bottomPart+='</div>';
							}

							if(data.contact.length!=0)
							{
								bottomPart+='<div class="text-left col-md-4">';

									bottomPart+='<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-mobile-phone"></i>&nbsp;Contact</h4>';

									bottomPart+='<br/>';

									for(i=0;i<data.contacts.length;i++)
									{
										bottomPart+='<p>'+data.contacts[i]+'</p>';
									}

								bottomPart+='</div>';
							}

							bottomPart+='</div>';

						bottomPart+='</div><!-- end class col-md-6 -->';

					bottomPart+='</div><!-- end class row -->';

				bottomPart+='</div><!--end id contact -->';

	$('#bottomContent').html(bottomPart);
}

function fetchBottomPart()
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchBottomPart.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkdata(data)==1)
		{
			console.log(checkData(data)+" this is checkdata");
			x=JSON.parse(data);
			insertBottomPart(x);
		}
	});
}

function insertSkills(data)
{
	$('#skills').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Skillset'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
			max:100,
            title: {
                text: 'Percentage'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.1f} %</b>'
        },
        series: [{
            name: 'Skill',
            data: data,
            dataLabels: {
                enabled: true,
                color: '#000000',
                x: 0,
                y: 0,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
}

function fetchSkills()
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchSkills.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkdata(data)==1)
		{
			console.log(checkData(data)+" this is checkdata");
			// x=JSON.parse(data);
			insertSkills(data);
		}
	});
}

function insertProjects(data,type)
{
	var projects="";

	if(type=="single")
	{
		x=1;
	}

	else
	{
		x=data.length;
	}

	for(i=0;i<x;i=i+1)
	{
		projects+='<div class="row project" id="'+data[i].projectId+'">';

								projects+='<div class="row">';

									projects+='<div class="col-md-5 text-left">';

										projects+='<h4 class="textPadding" style="font-weight:bold;" id="projectTitle">'+data[i].projectTitle+'</h4>';

									projects+='</div><!-- end class col-md- 3 -->';

									projects+='<div class="col-md-4 text-left">';

										projects+='<h4 class="textPadding"  id="projectCompany">'+data[i].projectCompany+'</h4>';

									projects+='</div><!-- end class col-md- 3 -->';

									projects+='<div class="col-md-3 text-right">';
										
										projects+='<h5 class="textPadding"><i onclick="editProject('+data[i].projectId+');" class="fa fa-trash"></i>&nbsp;<i onclick="deleteProject('+data[i].projectId+');" class="fa fa-pencil"></i>&nbsp;<span id="projectDuration" title="'+data[i].projectDuration+'">'+data[i].projectMinDuration+'</span></h5>';

									projects+='</div><!-- end class col-md- 3 -->';


								projects+='</div><!-- end class row -->';

								projects+='<div class="row">';
									
									projects+='<div class="col-md-3 text-left">';

										projects+='<h5 class="textPadding" id="projectRole">'+data[i].projectRole+'</h5>';

									projects+='</div><!-- end class col-md- 3 -->';

									projects+='<div class="col-md-9 text-right">';

										projects+='<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">'+data[i].pojectTeam+'</span></h5>';

									projects+='</div><!-- end class col-md- 3 -->';

								projects+='</div><!-- end class row -->';

								projects+='<div class="row">';

									projects+='<p class="text-center" style="text-align:justify;" id="projectDescription">'+data[i].projectDescription+'</p>';

								projects+='</div><!-- end class row -->';

							projects+='</div>';
	}

	$('#projects').find('#projectContainer').append(projects);
}

function fetchProjects()
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchProjects.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkdata(data)==1)
		{
			console.log(checkData(data)+" this is checkdata");
			x=JSON.parse(data);
			insertProjects(x,"multiple");
		}
	});
}

function insertExperience(data)
{
	var experience="";
	
	for(i=0;i<data.length;i+=2)
	{
		experience+='<div class="row experience" id="'+data[i].experienceId+'">';

		experience+='<div class="row">';

			experience+='<div class="text-left col-md-7">';

				experience+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">'+data[i].company+'</span></div>';

			experience+='</div>';

			experience+='<div class="col-md-3 text-right col-md-offset-2">';

				experience+='<div style="font-size:14px;" class="text-right textPadding"><i  onclick="editExperience('+data[i].experienceId+');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteExperience('+data[i].experienceId+');" class="fa fa-trash"></i></div>';

			experience+='</div>';

		experience+='</div>';

		experience+='<br/>';

		experience+='<div class="row">';

			experience+='<div class="text-left col-md-7">';

				experience+='<div style="font-size:16px;" class="text-left" id="role">'+data[i].role+'</div>';

			experience+='</div>';

			experience+='<div class="col-md-5">';

				experience+='<div style="font-size:16px;" title="'+data[i].duration+'" class="text-right" id="duration">'+data[i].minDuration+'</div>';

			experience+='</div>';

		experience+='</div>';



		experience+='</div><!-- end class experience -->';
	}

	$('#experiences').find('#experienceContainer1').html(experience);
	experience="";
	for(i=1;i<data.length;i+=2)
	{
		
		experience+='<div class="row experience" id="'+data[i].experienceId+'">';

		experience+='<div class="row">';

			experience+='<div class="text-left col-md-7">';

				experience+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">'+data[i].company+'</span></div>';

			experience+='</div>';

			experience+='<div class="col-md-3 text-right col-md-offset-2">';

				experience+='<div style="font-size:14px;" class="text-right textPadding"><i  onclick="editExperience(1);" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteExperience('+data[i].experienceId+');" class="fa fa-trash"></i></div>';

			experience+='</div>';

		experience+='</div>';

		experience+='<br/>';

		experience+='<div class="row">';

			experience+='<div class="text-left col-md-7">';

				experience+='<div style="font-size:16px;" class="text-left" id="role">'+data[i].role+'</div>';

			experience+='</div>';

			experience+='<div class="col-md-5">';

				experience+='<div style="font-size:16px;" title="'+data[i].duration+'" class="text-right" id="duration">'+data[i].minDuration+'</div>';

			experience+='</div>';

		experience+='</div>';



		experience+='</div><!-- end class experience -->';
	}
	$('#experiences').find('#experienceContainer2').html(experience);
}

function fetchExperience()
{
	$.post('./4pi/handlers/aboutMeHandlers/fetchExperience.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertExperience(x);
		}
	});
}

function insertAcademics(data)
{
	var academics="";

	for(i=0;i<data.length;i+=2)
	{
		academics+='<div class="row academics" id="'+data[i].academicsId+'">';

		academics+='<div class="row">';

			academics+='<div class="col-md-4 text-left">';

				academics+='<div style="font-size:18px;" id="degree">'+data[i].degree+'</div>';

			academics+='</div>';

			academics+='<div class="col-md-2 col-md-offset-6 text-center">';

				academics+='<div style="font-size:16px;" class="percentage" id="percentage">'+data[i].percentage+'%</div>';

			academics+='</div>';

		academics+='</div><!-- end class row -->';

		academics+='<br/>';

		academics+='<div class="row">';

			academics+='<div class="col-md-4 text-left">';

				academics+='<em><div style="font-size:14px;" id="school">'+data[i].schoolName+'</div></em>';

			academics+='</div>';

			academics+='<div class="col-md-4 col-md-offset-4 text-right">';

				academics+='<div style="font-size:14px;" title="'+data[i].duration+'"id="duration">'+data[i].minDuration+'</div>';

			academics+='</div>';

		academics+='</div><!-- end class row -->';

		academics+='<div class="row">';

			academics+='<div class="col-md-8 text-left">';

				academics+='<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">'+data[i].location+'</span></div>';

			academics+='</div><!--end class col-md-8 -->';

			academics+='<div class="col-md-4 text-right">';

				academics+='<div style="font-size:14px;"><i class="fa fa-pencil" onclick="editAcademics('+data[i].academicsId+');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAcademics('+data[i].academicsId+');"></i></div>';

			academics+='</div><!--end class col-md-8 -->';

		academics+='</div><!-- end class row -->';


		academics+='</div><!-- end class academics -->';
	}
	$('#academics').find('#academicsContainer1').html(academics);

	academics="";

	for(i=1;i<data.length;i+=2)
	{
		academics+='<div class="row academics" id="'+data[i].academicsId+'">';

		academics+='<div class="row">';

			academics+='<div class="col-md-4 text-left">';

				academics+='<div style="font-size:18px;" id="degree">'+data[i].degree+'</div>';

			academics+='</div>';

			academics+='<div class="col-md-2 col-md-offset-6 text-center">';

				academics+='<div style="font-size:16px;" class="percentage" id="percentage">'+data[i].percentage+'%</div>';

			academics+='</div>';

		academics+='</div><!-- end class row -->';

		academics+='<br/>';

		academics+='<div class="row">';

			academics+='<div class="col-md-4 text-left">';

				academics+='<em><div style="font-size:14px;" id="school">'+data[i].schoolName+'</div></em>';

			academics+='</div>';

			academics+='<div class="col-md-4 col-md-offset-4 text-right">';

				academics+='<div style="font-size:14px;" title="'+data[i].duration+'"id="duration">'+data[i].minDuration+'</div>';

			academics+='</div>';

		academics+='</div><!-- end class row -->';

		academics+='<div class="row">';

			academics+='<div class="col-md-8 text-left">';

				academics+='<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">'+data[i].location+'</span></div>';

			academics+='</div><!--end class col-md-8 -->';

			academics+='<div class="col-md-4 text-right">';

				academics+='<div style="font-size:14px;"><i class="fa fa-pencil" onclick="editAcademics('+data[i].academicsId+');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAcademics('+data[i].academicsId+');"></i></div>';

			academics+='</div><!--end class col-md-8 -->';

		academics+='</div><!-- end class row -->';


		academics+='</div><!-- end class academics -->';
	}
	$('#academics').find('#academicsContainer2').html(academics);
}

function fetchAcademics()
{
	$.post('./4pi/handlers/aboutMeHandlers/fetchAcademics.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertAcademics(x);
		}
	});
}

function insertWorkshop(data)
{
	var workshop="";
	for(i=0;i<data.length;i+=2)
	{
		workshop+='<div class="row workshop" id="'+data[i].workshopId+'">';

			workshop+='<div class="row">';

				workshop+='<div class="col-md-6 text-left">';

					workshop+='<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">'+data[i].name+'</span></div>';

				workshop+='</div><!-- end class col-md-6 -->';

				workshop+='<div class="col-md-3 text-right col-md-offset-3">';

					workshop+='<div style="font-size:14px;"><i  onclick="editWorkshop('+data[i].workshopId+');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteWorkshop('+data[i].workshopId+');" class="fa fa-trash"></i></div>';

				workshop+='</div><!-- end classc col-md-3 -->';

			workshop+='</div><!-- end class row -->';

			workshop+='<br/>';

			workshop+='<div class="row">';

				workshop+='<div class="col-md-6 text-left">';

					workshop+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">'+data[i].location+'</span></div>';

				workshop+='</div><!-- end class col-md-6 -->';

				workshop+='<div class="col-md-4 text-right col-md-offset-2">';

					workshop+='<div style="font-size:15px;" id="workshopDuration" title="'+data[i].Duration+'">'+data[i].minDuration+'</div>';

				workshop+='</div><!-- end classc col-md-3 -->';

			workshop+='</div><!-- end class row -->';

			if(data[i].numPeopleAttended!="")
			{
				workshop+='<div class="col-md-6 text-left">';

					workshop+='<em><div style="font-size:14px;"><span id="attenderNumber">'+data[i].numPeopleAttended+'</span>&nbsp; people attended</div></em>';

				workshop+='</div>';
			}

		workshop+='</div><!-- end class workshop -->';
	}
	$('#workshops').find('#workshopContainer1').html(workshop);
	workshop="";
	for(i=1;i<data.length;i+=2)
	{
		workshop+='<div class="row workshop" id="'+data[i].workshopId+'">';

			workshop+='<div class="row">';

				workshop+='<div class="col-md-6 text-left">';

					workshop+='<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">'+data[i].name+'</span></div>';

				workshop+='</div><!-- end class col-md-6 -->';

				workshop+='<div class="col-md-3 text-right col-md-offset-3">';

					workshop+='<div style="font-size:14px;"><i  onclick="editWorkshop('+data[i].workshopId+');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteWorkshop('+data[i].workshopId+');" class="fa fa-trash"></i></div>';

				workshop+='</div><!-- end classc col-md-3 -->';

			workshop+='</div><!-- end class row -->';

			workshop+='<br/>';

			workshop+='<div class="row">';

				workshop+='<div class="col-md-6 text-left">';

					workshop+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">'+data[i].location+'</span></div>';

				workshop+='</div><!-- end class col-md-6 -->';

				workshop+='<div class="col-md-4 text-right col-md-offset-2">';

					workshop+='<div style="font-size:15px;" id="workshopDuration" title="'+data[i].Duration+'">'+data[i].minDuration+'</div>';

				workshop+='</div><!-- end classc col-md-3 -->';

			workshop+='</div><!-- end class row -->';

			if(data[i].numPeopleAttended!="")
			{
				workshop+='<div class="col-md-6 text-left">';

					workshop+='<em><div style="font-size:14px;"><span id="attenderNumber">'+data[i].numPeopleAttended+'</span>&nbsp; people attended</div></em>';

				workshop+='</div>';
			}

		workshop+='</div><!-- end class workshop -->';
	}
	$('#workshops').find('#workshopContainer2').html(workshop);
}

function fetchWorkshops()
{
	$.post('./4pi/handlers/aboutMeHandlers/fetchWorkshops.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertWorkshop(x);
		}
	});
}

function insertCertification(data)
{
	var certification="";
	for(i=0;i<data.length;i+=2)
	{
		certification+='<div class="row certification" id="'+data[i].certificationId+'">';

			certification+='<div class="row">';

				certification+='<div class="text-left col-md-7">';

					certification+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">'+data[i].courseName+'</span></div>';

				certification+='</div>';

				certification+='<div class="col-md-3 text-right col-md-offset-2">';

					certification+='<div style="font-size:14px;" class="text-right textPadding" ><i onclick="editCertification('+data[i].certificationId+');" class="fa fa-pencil"></i>&nbsp;<i onclick="deleteCertification('+data[i].certificationId+');" class="fa fa-trash"></i</div>';

				certification+='</div>';

			certification+='</div>';

			certification+='<br/>';

			certification+='<div class="row">';

				certification+='<div class="text-left col-md-7">';

					certification+='<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">'+data[i].institute+'</span></div>';

				certification+='</div>';

				certification+='<div class="col-md-5">';

					certification+='<div title="'+data[i].duration+'" style="font-size:16px;" class="text-right" id="duration">'+data[i].minDuration+'</div>';

				certification+='</div>';

			certification+='</div>';

		certification+='</div><!-- end class certification -->';
	}
	$('#certifications').find('#certificationContainer1').html(certification);
	certification="";
	for(i=1;i<data.length;i+=2)
	{

		certification+='<div class="row certification" id="'+data[i].certificationId+'">';

			certification+='<div class="row">';

				certification+='<div class="text-left col-md-7">';

					certification+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">'+data[i].courseName+'</span></div>';

				certification+='</div>';

				certification+='<div class="col-md-3 text-right col-md-offset-2">';

					certification+='<div style="font-size:14px;" class="text-right textPadding" ><i onclick="editCertification('+data[i].certificationId+');" class="fa fa-pencil"></i>&nbsp;<i onclick="deleteCertification('+data[i].certificationId+');" class="fa fa-trash"></i</div>';

				certification+='</div>';

			certification+='</div>';

			certification+='<br/>';

			certification+='<div class="row">';

				certification+='<div class="text-left col-md-7">';

					certification+='<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">'+data[i].institute+'</span></div>';

				certification+='</div>';

				certification+='<div class="col-md-5">';

					certification+='<div title="'+data[i].duration+'" style="font-size:16px;" class="text-right" id="duration">'+data[i].minDuration+'</div>';

				certification+='</div>';

			certification+='</div>';

		certification+='</div><!-- end class certification -->';
	}
	$('#certifications').find('#certificationContainer2').html(certification);
}

function fetchCertifications()
{
	$.post('./4pi/handlers/aboutMeHandlers/fetchCertifications.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertCertification(x);
		}
	});
}

function insertAchievements(data)
{
	var achievements="";
	for(i=0;i<data.length;i+=2)
	{
		achievements+='<div class="row achievement" id="'+data[i].achievementId+'">';

			achievements+='<div class="row">';

				achievements+='<div class="col-md-6 text-left">';

					achievements+='<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">'+data[i].eventName+'</span></div>';

				achievements+='</div><!-- end class col-md-6 -->';

				achievements+='<div class="col-md-3 text-right col-md-offset-3">';

					achievements+='<div  style="font-size:14px;"><i class="fa fa-pencil" onclick="editAchievement('+data[i].achievementId+');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAchievement('+data[i].achievementId+');"></i></div>';

				achievements+='</div><!-- end classc col-md-3 -->';

			achievements+='</div><!-- end class row -->';

			achievements+='<br/>';

			achievements+='<div class="row">';

				achievements+='<div class="col-md-6 text-left">';

					achievements+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">'data[i].location+'</span></div>';

				achievements+='</div><!-- end class col-md-6 -->';

				achievements+='<div class="col-md-4 text-right col-md-offset-2">';

					achievements+='<div style="font-size:15px;" title="'+data[i].duration+'" id="eventDuration">'+data[i].minDuration+'</div>';

				achievements+='</div><!-- end classc col-md-3 -->';

			achievements+='</div><!-- end class row -->';

			achievements+='<br/>';

			achievements+='<div class="col-md-6 text-left">';

				achievements+='<div style="font-size:14px;" id="eventDescription">'+data[i].description+'</div>';

			achievements+='</div>';

		achievements+='</div><!-- end class achievement -->';
	}
	$('#achievements').find('#achievementContainer').html(achievements);
	achievements="";
	for(i=1;i<data.length;i+=2)
	{

		achievements+='<div class="row achievement" id="'+data[i].achievementId+'">';

			achievements+='<div class="row">';

				achievements+='<div class="col-md-6 text-left">';

					achievements+='<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">'+data[i].eventName+'</span></div>';

				achievements+='</div><!-- end class col-md-6 -->';

				achievements+='<div class="col-md-3 text-right col-md-offset-3">';

					achievements+='<div  style="font-size:14px;"><i class="fa fa-pencil" onclick="editAchievement('+data[i].achievementId+');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAchievement('+data[i].achievementId+');"></i></div>';

				achievements+='</div><!-- end classc col-md-3 -->';

			achievements+='</div><!-- end class row -->';

			achievements+='<br/>';

			achievements+='<div class="row">';

				achievements+='<div class="col-md-6 text-left">';

					achievements+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">'data[i].location+'</span></div>';

				achievements+='</div><!-- end class col-md-6 -->';

				achievements+='<div class="col-md-4 text-right col-md-offset-2">';

					achievements+='<div style="font-size:15px;" title="'+data[i].duration+'" id="eventDuration">'+data[i].minDuration+'</div>';

				achievements+='</div><!-- end classc col-md-3 -->';

			achievements+='</div><!-- end class row -->';

			achievements+='<br/>';

			achievements+='<div class="col-md-6 text-left">';

				achievements+='<div style="font-size:14px;" id="eventDescription">'+data[i].description+'</div>';

			achievements+='</div>';

		achievements+='</div><!-- end class achievement -->';
	}
	$('#achievements').find('#achievementContainer').html(achievements);
}

function fetchAchievements()
{

	$.post('./4pi/handlers/aboutMeHandlers/fetchAchievements.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertAchievements(x);
		}
	});
}

function addProjectSendData()
{
	var ln=$('#addProjectModal');
	var title=ln.find('#addProjectModalProjectTitle').val().trim();
	var duration=ln.find('#addProjectModalProjectDurationFrom').val().trim()+"-"+ln.find('#addProjectModalProjectDurationTo').val().trim();
	var role=ln.find('#addProjectModalProjectRole').val().trim();
	var company=ln.find('#addProjectModalProjectCompany').val().trim();
	var description=ln.find('#addProjectModalProjectDescription').val().trim();
	if(title.length==0)
	{
		alert("Please enter the title");
	}
	else
	{
		$.post('4pi/handlers/aboutMeHandlers/addProject.php',{
			_title:title,
			_duration:duration,
			_role:role,
			_company:company,
			_description:description
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertProjects(data,"single");
			}
		});
	}
}

function addExperienceSendData()
{

	var ln=$('#addExperienceModal');
	var companyName=ln.find('#addExperienceModalCompanyName').val().trim();
	var role=ln.find('#addExperienceModalRole').val().trim();
	var duration=ln.find('#addExperienceModalDurationFrom').val().trim()+"-"+ln.find('#addExperienceModalDurationTo').val().trim();
	if(companyName.length==0)
	{
		alert("Please enter the name of the company");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addExperience.php',{
			_company:companyName,
			_role:role,
			_duration:duration
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertExperience(data,"single");
			}
		});
	}
}

function addAcademicsSendData()
{
	var ln=$('#addAcademicsModal');
	var degree=ln.find('#addAcademicsModalDegree').val().trim();
	var percentage=ln.find('#addAcademicsModalPercentage').val().trim();
	var school=ln.find('#addAcademicsModalSchoolName').val().trim();
	var duration=ln.find('#addAcademicsModalDurationFrom').val().trim()+"-"+ln.find('#addAcademicsModalDurationTo').val().trim();
	var location=ln.find('#addAcademicsModalSchoolLocation').val().trim();
	if(degree.length!="")
	{
		alert("Please enter the degree.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addAcademics.php',{
			_degree:degree,
			_percentage:percentage,
			_school:school,
			_duration:duration,
			_location:location
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(functino(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertAcademics(data,"single");
			}
		});
	}
}

function addWorkshopSendData()
{
	var ln=$('#addWorkshopModal');
	var name=ln.find('#addWorkshopModalWorkshopName').val().trim();
	var location=ln.find('#addWorkshopModalWorkshopLocation').val().trim();
	var duration=ln.find('#addWorkshopModalWorkshopDurationFrom').val().trim()+"-"+ln.find('#addWorkshopModalWorkshopDurationTo').val().trim();
	var peopleNumber=ln.find('#addWorkshopModalWorkshopPeopleNumber').val().trim();
	if(name.length==0)
	{
		alert("Please enter the workshop name.");
	}
	else
	{
		$.post("/4pi/handlers/aboutMeHandlers/addWorkshop.php",{
			_name:name,
			_location:location,
			_duration:duration,
			_peopleNumber:peopleNumber
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertWorkshop(data,"single");
			}
		});
	}
}

function addCertificationSendData()
{
	var ln=$('#addCertificationModal');
	var name=ln.find('#addCertificationModalCourseName').val().trim();
	var institute=ln.find('#addCertificationModalInstitute').val().trim();
	var duration=ln.find('#addCertificationModalDurationFrom').val().trim()+"-"+ln.find('#addCertificationModalDurationTo').val().trim();

	if(name.length==0)
	{
		alert("Please enter the course name");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addCertification.php',{
			_name:name,
			_institute:institute,
			_duration:duration
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertWorkshop(data,"single");
			}
		});
	}
}

function addAchievementSendData()
{
	var ln=$('#addAchievementModal');
	var name=ln.find('#addAchievementModalEventName').val().trim();
	var location=ln.find('#addAchievementModalLocation').val().trim();
	var description=ln.find('#addAchievementModalDescription').val().trim();
	if(name.length==0)
	{
		alert("Please enter the event name");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addAchievement.php',{
			_name:name,
			_location:location,
			_description:description
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertAchievements(data,"single");
			}
		});
	}
}

function modifyProject(data)
{
	var y=$('#'+data.projectId);
	y.find('#projectTitle').html(data.title);
	y.find('#projectDuration').html(data.minDuration);
	y.find('#projectDuration').attr("title",data.projectDuration);
	y.find('#projectRole').html(data.role);
	y.find('#projectCompany').html(data.company);
	y.find('#projectDescription').html(data.description);
}

function editProjectSendData()
{
	var ln=$('#editProjectModal');
	var title=ln.find('#editProjectModalProjectTitle').val().trim();
	var duration=ln.find('#editProjectModalProjectDurationFrom').val().trim()+"-"+ln.find('#editProjectModalProjectDurationTo').val().trim();
	var role=ln.find('#editProjectModalProjectRole').val().trim();
	var company=ln.find('#editProjectModalProjectCompany').val().trim();
	var description=ln.find('#editProjectModalProjectDescription').val().trim();
	var projectId=ln.find('editProjectModalProjectId').val();

	if(title.length==0)
	{
		alert("Please enter the project title");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editProject.php',{
			_title:title,
			_duration:duration,
			_role:role,
			_company:company,
			_description:description,
			_id:projectId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyProject(data);
			}
		});
	}
}

function editSkillsSendData()
{
	
}

function editExperienceSendData()
{
	
}

function editAcademicsSendData()
{

}

function editWorkshopSendData()
{

}

function editCertificationSendData()
{

}

function editAchievementSendData()
{

}