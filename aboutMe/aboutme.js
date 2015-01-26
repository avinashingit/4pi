/***************************************************************


File: aboutme.js

FileDescription: This file contains all the actions related to a persons aboutMe page.
				 The actions include
				 1. Skills insert, delete, add, fetch, modify
				 2. Tools insert, delete, add, fetch, modify
				 3. Academics insert, delete, add, fetch, modify
				 4. Workshops insert, delete, add, fetch, modify
				 5. Certificatoins insert, delete, add, fetch, modify
				 6. Courses insert, delete, add, fetch, modify
				 7. Achievements insert, delete, add, fetch, modify
				 8. Projects insert, delete, add, fetch, modify
				 9. Experience insert, delete, add, fetch, modify
				 10. Intersts insert, delete, add, fetch, modify
				 11. Personal information insert, edit, fetch, modify

Author: Avinash Kadimisetty (www.kavinash.in)

Last edited: 25-01-2015				 


*********************************************************************/


/*var userIdFromURL=window.location.href.lastIndexOf('/');
var userId=userIdFromURL;*/

/*var userId="COE12B025";*/
var commonURLAbout="/4pi/";
///////////////////////////GENERIC FUNCTIONS STARTS/////////////////////

/*$(function () {
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
        data: [
            ['Skill1', 100],
            ['Skill2', 90],
            ['Skill3', 80],
            ['Karachi', 70],
            ['Mumbai', 60],
            ['Moscow', 50],
            ['Karachi', 70],
            ['Mumbai', 60],
            ['Moscow', 50]
        ],
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
});

// $('textarea').autosize({'append':'false'});

$(document).ready(function(){
	$('.navObject').each(function(){
		$(this).hide();
	});
	// $('#skills').hide();
	$('#skills').show();

	$('.middleNavbarA').click(function(){
		$('.middleNavbarA').each(function(){
			$(this).css({'background-color':'','color':''});
		});
		$(this).css({'background-color':'black','color':'white'});
		var href=$(this).attr("data-target");
		
		$('.navObject').each(function(){
			$(this).hide();
		});
		$(href).show();
		
		
		
	});
});

function editPersonInfo()
{
	$('#editPersonInfoModal').modal('show');
	var x=$('#editPersonInfoModal');
	var ob2=$('#entireContent').find('#personInfo');
	x.find('#editPersonInfoModalPersonName').val(ob2.find('#personNameText').html());
	x.find('#editPersonInfoModalPersonDOB').val(ob2.find('#personDOB').html());
	x.find('#editPersonInfoModalPersonHighestDegree').val(ob2.find('#personHighestDegree').html());
	x.find('#editPersonInfoModalPersonCurrentProfession').val(ob2.find('#personCurrentProfession').html());
	x.find('#editPersonInfoModalPersonDescription').val(ob2.find('#personDescription').find('p').html());
}

function editToolColumn(x,y)
{
	var column=x;
	var row=y;
	$('#editToolModal').modal('show');
	$('#editToolModal').find('#editToolModalToolText').val($('#tools').find('#toolsColumn'+x+'Tool'+y).html());
}

function addSkill()
{
	$("#addSkillModal").modal('show');
}

function addTool()
{
	$("#addToolModal").modal('show');
}

function addProject()
{
	$('#addProjectModal').modal('show');
}

function editProject(n)
{
	$('#editProjectModal').modal('show');

	var x=$('#editProjectModal');
	var y=$('#project'+n);
	x.find('#editProjectModalProjectId').val(n);
	x.find('#editProjectModalProjectTitle').val(y.find('#projectTitle').html());
	z=y.find('#projectDuration').attr("title");
	xz=z.split("-");
	x.find('#editProjectModalProjectDurationFrom').val(xz[0]);
	x.find('#editProjectModalProjectDurationTo').val(xz[1]);
	x.find('#editProjectModalProjectRole').val(y.find('#projectRole').html());
	x.find('#editProjectModalProjectCompany').val(y.find('#projectCompany').html());
	x.find('#editProjectModalProjectDescription').val(y.find('#projectDescription').html());
}

function addExperience()
{
	$('#addExperienceModal').modal('show');
}

function editExperience(n)
{
	$('#editExperienceModal').modal('show');

	var x=$('#editExperienceModal');
	var y=$('#experience'+n);
	x.find('#editExperienceModalCompanyName').val(y.find('#company').html());
	x.find('#editExperienceModalRole').val(y.find('#role').html());
	z=y.find('#duration').attr("title");
	xz=z.split("-");
	x.find('#editExperienceModalDurationFrom').val(xz[0]);
	x.find('#editExperienceModalDurationTo').val(xz[1]);
	x.find('#experienceId').val(n);
}

function addCertification()
{
	$('#addCertificationModal').modal('show');
}

function editCertification(n)
{
	$('#editCertificationModal').modal('show');

	var x=$('#editCertificationModal');
	var y=$('#certification'+n);
	x.find('#editCertificationModalCourseName').val(y.find('#courseName').html());
	x.find('#editCertificationModalInstitute').val(y.find('#institute').html());
	z=y.find('#duration').attr("title").split("-");
	x.find('#editCertificationModalCertificationDurationFrom').val(z[0]);
	x.find('#editCertificationModalCertificationDurationTo').val(z[1]);
	x.find('#editCertificationModalId').html(n);
}

function addAcademics()
{
	$('#addAcademicsModal').modal('show');
}

function editAcademics(n)
{
	$('#editAcademicsModal').modal('show');

	var x=$('#editAcademicsModal');
	var y=$('#academics'+n);
	x.find('#editAcademicsModalDegree').val(y.find('#degree').html());
	x.find('#editAcademicsModalPercentage').val(y.find('#percentage').html());
	x.find('#editAcademicsModalSchoolName').val(y.find('#school').html());
	z=y.find('#duration').attr("title").split("-");
	x.find('#editAcademicsModalDurationFrom').val(z[0]);
	x.find('#editAcademicsModalDurationTo').val(z[1]);
	x.find('#editAcademicsModalSchoolLocation').val(y.find('#location').html());
	x.find('#editAcademicsModalId').val(n);
}

function addWorkshop()
{
	$('#addWorkshopModal').modal('show');
}

function editWorkshop(n)
{
	$('#editWorkshopModal').modal('show');

	var x=$('#editWorkshopModal');
	var y=$('#workshop'+n);
	x.find('#editWorkshopModalWorkshopName').val(y.find('#workshopName').html());
	x.find('#editWorkshopModalWorkshopLocation').val(y.find('#workshopLocation').html());
	z=y.find('#workshopDuration').attr("title").split("-");
	x.find('#editWorkshopModalWorkshopDurationFrom').val(z[0]);
	x.find('#editWorkshopModalWorkshopDurationTo').val(z[0]);
	x.find('#editWorkshopModalWorkshopPeopleNumber').val(y.find('#attenderNumber').html());
	x.find('#editWorkshopModalId').html(n);
}

function addAchievement()
{
	$('#addAchievementModal').modal('show');
}

function editAchievement(n)
{
	$('#editAchievementModal').modal('show');

	var x=$('#editAchievementModal');
	var y=$('#achievement'+n);
	x.find('#editAchievementModalEventName').val(y.find('#eventName').html());
	x.find('#editAchievementModalLocation').val(y.find('#eventLocation').html());
	x.find('#editAchievementModalYear').val(y.find('#eventDuration').html());
	x.find('#editAchievementModalDescription').val(y.find('#eventDescription').html());
}*/

////////////////////////////GENERIC FUNCTIONS END///////////////////
///
///
///
///
///
/////////////////PERSONAL INFORMATION STARTS///////////////////////

//function to insert top part. It accepts data as a JSON object and inserts the object in to the web page

function insertTopPart(data)
{
	alert("Called");
	console.log(data);
	var topPart="";

	topPart+='<div class="col-md-2" id="personPicture">';

		topPart+='<a href="'+commonURLAbout+userId+'" class="thumbnail"><img src="../img/hpics/'+data.profilePicture+'.jpg"  alt="'+data.name+'" class="img-responsive"/></a>';

		topPart+='<h4 class="text-center" id="personRollNumber">'+userId+'</h4>';

	topPart+='</div><!-- end id personPicture -->';

	topPart+='<div class="col-md-10" id="personInfo">';
		
		topPart+='<div class="row" id="personName">';

			topPart+='<div class="col-md-11">';

				topPart+='<h3 id="personNameText">'+data.name+'</h3><br/>';

			topPart+='</div>';

			topPart+='<div class="col-md-1 text-right">';

				topPart+='<i class="fa fa-pencil" title="Edit" onclick="editPersonInfo();"></i>';

			topPart+='</div>';

		topPart+='</div><!-- end id person name -->';

		topPart+='<div class="row" id="personDetails">';

			topPart+='<div class="col-md-3">';

				topPart+='<div class="text-left" id="personDOB">'+data.dob+'</div><br/>';

				topPart+='<div class="text-left" id="personHighestDegree">'+data.highestDegree+'</div><br/>';

				topPart+='<div class="text-left" id="personCurrentProfession">'+data.currentProfession+'</div><br/>';

				topPart+='<div class="text-left" id="personResumeLink">';

					topPart+='<a href="'+data.resume+'"><button class="btn btn-primary">Find my resume&nbsp;&nbsp;<i class="fa fa-external-link"></i></button></a>';

				topPart+='</div><!-- end person resume link id -->';

			topPart+='</div>';

			topPart+='<div class="col-md-9" id="personDescription">';

				topPart+='<p style="text-align:justify;line-height:22px;">'+data.description+'</p>';

			topPart+='</div><!-- end class col-md-8 -->';

		topPart+='</div><!-- end person details id -->';


	topPart+='</div>';

	$('#topContent').html(topPart);
}

//function to fetch top part. This function fetches data from the server and gives it to insert function to put in to the web page.

function fetchTopPart()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:1
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		// console.log(data);
		if(checkData(data)==1)
		{
			console.log(checkData(data)+" this is checkData");
			// console.log(data);
			x=JSON.parse(data);
			insertTopPart(x);
		}
	});
}

$(document).ready(function(){
	fetchTopPart();
	// fetchSkills();
});

//function to insert bottom part. It accepts data as a JSON object and inserts the object in to the web document

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

						bottomPart+='<div class="col-md-6 col-md-offset-1" id="contactsContainer">';

							bottomPart+='<div class="row">';
	
								bottomPart+='<h4 style="color:rgba(222, 123, 26, 1);"><i class="fa fa-share-alt"></i>&nbsp;Lets get connected</h4>';

							bottomPart+='</div>';

							bottomPart+='<br/>';

							bottomPart+='<div class="row" >';

							if(data.facebookId!="")
							{
								bottomPart+='<div class="col-md-2" id="facebookURL">';
									bottomPart+='<a href="'+data.facebookId+'" class="icon-button facebook" ><i class="fa fa-facebook" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}
								
							if(data.twitterId!="")
							{
								bottomPart+='<div class="col-md-2" id="twitterURL">';
									bottomPart+='<a href="'+data.twitterId+'"  class="icon-button twitter"><i class="fa fa-twitter" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.gplusId!="")
							{
								bottomPart+='<div class="col-md-2" id="googlePlusURL">';
									bottomPart+='<a href="#" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.linkedinId!="")
							{
								bottomPart+='<div class="col-md-2" id-"linkedInURL">';
									bottomPart+='<a href="#" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
								bottomPart+='</div>';
							}

							if(data.pinterestId!="")
							{
								bottomPart+='<div class="col-md-2" id="pinterestURL">';
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
										bottomPart+='<p id="email'+i+1+'">'+data.userEmails[i]+'</p>';
									}

								bottomPart+='</div>';
							}

							if(data.address.length!=0)
							{
								bottomPart+='<div class="text-left col-md-4">';

									bottomPart+='<h4 style="color:rgba(80, 183, 154, 1);"><i class="fa fa-map-marker"></i>&nbsp;Address</h4>';

									bottomPart+='<br/>';

									bottomPart+='<p id="address">'+data.address+'</p>';

								bottomPart+='</div>';
							}

							if(data.contact.length!=0)
							{
								bottomPart+='<div class="text-left col-md-4">';

									bottomPart+='<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-mobile-phone"></i>&nbsp;Contact</h4>';

									bottomPart+='<br/>';

									for(i=0;i<data.contacts.length;i++)
									{
										bottomPart+='<p id="userPhone'+i+1+'">'+data.contacts[i]+'</p>';
									}

								bottomPart+='</div>';
							}

							bottomPart+='</div>';

						bottomPart+='</div><!-- end class col-md-6 -->';

					bottomPart+='</div><!-- end class row -->';

				bottomPart+='</div><!--end id contact -->';

	$('#bottomContent').html(bottomPart);
}

//function to fetch top part. This function fetches data from the server and gives it to insert function to put in to the web page.

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
		if(checkData(data)==1)
		{
			console.log(checkData(data)+" this is checkData");
			x=JSON.parse(data);
			insertBottomPart(x);
		}
	});
}

function editContactInfoSendData()
{
	var link=$("#editContactsModal");
	var fbURL=link.find("#fbURL").val().trim();
	var gplusURL=link.find("#gplusURL").val().trim();
	var inURL=link.find("#inURL").val().trim();
	var pinURL=link.find("#pinURL").val().trim();
	var twitterURL=link.find("#twitterURL").val().trim();
	var emailId=link.find("#email2").val().trim();
	var address=link.find("#address").val().trim();
	var phone1=link.find("#contactNumber1").val().trim();
	var phone2=link.find("#contactNumber2").val().trim();
	var phone=[phone1,phone2];
	$.post('/4pi/handlers/aboutHandlers/editBottomPart.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again.");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			insertBottomPart(data);
		}
	});

	
}

//////////////////////////////PERSONAL INFO ENDS/////////////////////
///
///
///
///
///////////////////////////////SKILLS STARTS////////////////////////////

function insertSkills(data)
{
	alert("Called insert");
	$('#skills').find('#skillData').highcharts({
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
	alert("Called");
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:10
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			insertSkills(data);
		}
	});
}

function addSkillSendData()
{
	var link=$("#addSkillModal");
	var skillName=link.find("#addSkillModalSkillName").val().trim();
	var skillPercentage=link.find("#addSkillModalSkillPercentage").val().trim();

	if(skillName.length==0)
	{
		alert("Empty skills are not allowed");
	}
	else if(isNaN(skillPercentage))
	{
		alert("Our bot does not understand text");
	}
	else if(skillPercentage==0)
	{
		alert("Hey come on! Zero is not a good number here.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/insertSkill.php',{
			_skillName:skillName,
			_skillPercentage:skillPercentage
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				insertSkills(data.JSONObject);
				var skillNames=data.skillNames.join();
				var skillPercentages=data.skillPercentages.join();
				$("#skills").find("#skillNames").html(skillNames);
				$("#skills").find("#skillPercentages").html(skillPercentages);
			}
		});
	}
}

function modifySkill(data)
{
	insertSkills(data.JSONobject);
}

function editSkillsSendData()
{
	var link=$("#editSkillsModal");
	var skills=new Array();
	var i=0;
	link.find("skillsForm").find('.skillName').each(function(){
		skills[i]=$(this).val();
		i++;
	});

	var error=0;
	for(j=0;j<skills.length;j++)
	{
		if(skills[j].length==0)
		{
			error=1;
		}
	}

	if(error==0)
	{
		alert("Please enter all the skills");
	}

	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editSkills.php',{
			_skills:skills
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifySkills(data);
			}
		})
	}
}


////////////////////////////SKILLS ENDS/////////////////////////////////////
///
///
///
///
//////////////////////////////TOOLS STARTS/////////////////////////////////

function insertTool(data)
{
	var tool="";

	tool+='<p class="tool">'+data+'</p><br/>';

	var length=$("#tools").find(".tool").length;
	var position=(length%3)+1;

	$("#tools").find('#toolsColumn'+position).append(tool);
}

function fetchTools(data)
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchTools.php',{

	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			for(i=0;i<data.length;i++)
			{
				insertTool(data[i]);
			}
		}
	});
}

function addToolSendData()
{
	var toolName=$("#addToolModal").find("#toolName").val().trim();

	if(toolName.length==0)
	{
		alert("Please enter the tool name");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addTool.php',{
			_toolName:toolName
		})
		.error(function(){
			alert("Server overload. Please try again");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				insertTool(data);
			}
		})
	}
}

function modifyTools(data)
{
	$("tools").find('.tool').each(function(){
		$(this).remove();
	});
	for(i=0;i<data.length;i++)
	{
		insertTool(data[i]);
	}
}

function editToolSendData()
{
	var link=$("#editToolsModal");
	var intersts=new Array();
	var i=0;
	link.find("toolsForm").find('.toolName').each(function(){
		tools[i]=$(this).val();
		i++;
	});

	var error=0;
	for(j=0;j<tools.length;j++)
	{
		if(tools[j].length==0)
		{
			error=1;
		}
	}

	if(error==0)
	{
		alert("Please enter all the tools");
	}

	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editTools.php',{
			_tools:tools
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifyTools(data);
			}
		})
	}
}

//////////////////////////////TOOLS ENDS/////////////////////////////////
///
///
///
///
////////////////////////////PROJECTS STARTS////////////////////////////////



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
					
					projects+='<h5 class="textPadding"><i onclick="editProject(\''+data[i].projectId+'\');" class="fa fa-trash"></i>&nbsp;<i onclick="deleteProject(\''+data[i].projectId+'\');" class="fa fa-pencil"></i>&nbsp;<span id="projectDuration" title="'+data[i].projectDuration+'">'+data[i].projectMinDuration+'</span></h5>';

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
		if(checkData(data)==1)
		{
			console.log(checkData(data)+" this is checkData");
			x=JSON.parse(data);
			insertProjects(x,"multiple");
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

function deleteProject(id)
{
	if(confirm("Do you want to delete this project?"))
	{
		$.post('/4pi/handlers/aboutMe/deleteProject.php',{
			_projectId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#projects').find('#'+id).remove();
			}
		});
	}
}




///////////////////////PROJECTS END/////////////////////
///
///
///
///
///////////////////////EXPERIENCE STARTS///////////////


function insertExperience(data)
{
	var experience="";

	experience+='<div class="row experience" id="'+data.experienceId+'">';

	experience+='<div class="row">';

		experience+='<div class="text-left col-md-7">';

			experience+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">'+data.company+'</span></div>';

		experience+='</div>';

		experience+='<div class="col-md-3 text-right col-md-offset-2">';

			experience+='<div style="font-size:14px;" class="text-right textPadding"><i  onclick="editExperience(\''+data.experienceId+'\');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteExperience(\''+data.experienceId+'\');" class="fa fa-trash"></i></div>';

		experience+='</div>';

	experience+='</div>';

	experience+='<br/>';

	experience+='<div class="row">';

		experience+='<div class="text-left col-md-7">';

			experience+='<div style="font-size:16px;" class="text-left" id="role">'+data.role+'</div>';

		experience+='</div>';

		experience+='<div class="col-md-5">';

			experience+='<div style="font-size:16px;" title="'+data.duration+'" class="text-right" id="duration">'+data.minDuration+'</div>';

		experience+='</div>';

	experience+='</div>';

	experience+='</div><!-- end class experience -->';

	var length=$("#experience").find(".experience").length;

	var position=length%2+1;

	$('#experiences').find('#experienceContainer'+position).append(experience);
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
			for(i=0;i<x.length;i++)
			{
				insertExperience(x[i]);
			}
		}
	});
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
				insertExperience(data);
			}
		});
	}
}

function modifyExperience(data)
{
	var link=$('#experiences').find('#'+data.experienceId);
	link.find('#company').html(data.companyName);
	link.find('#role').html(data.role);
	link.find('#duration').attr("title",data.duration);
	link.find('#duration').html(data.duration);
}

function editExperienceSendData()
{
	var link=$('#editExperienceModal');
	var company=link.find('#editExperienceModalCompanyName').val().trim();
	var role=link.find('#editExperienceModalRole').val().trim();
	var duration=link.find('#editExperienceModalDurationFrom').val().trim()+"-"+link.find('#editExperienceModalDurationTo').val().trim();
	var id=link.find('#experienceId').html();

	if(company.length==0)
	{
		alert("Please enter the company name.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editExperience.php',{
			_experienceId:id,
			_company:company,
			_role:role,
			_duration:duration
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifyExperience(data);
			}
		});
	}
}

function deleteExperience(id)
{
	if(confirm("Do you want to delete the experience?"))
	{
		$.post('/4pi/handlers/aboutMeHandlers/deleteExperience.php',{
			_experienceId:id
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#experiences').find('#'+id).remove();
			}
		});
	}
}




////////////////////////EXPERIENCE ENDS///////////////
///
///
///
////////////////////////ACADEMICS STARTS/////////////



function insertAcademics(data)
{
	var academics="";

	academics+='<div class="row academics" id="'+data.academicsId+'">';

	academics+='<div class="row">';

		academics+='<div class="col-md-4 text-left">';

			academics+='<div style="font-size:18px;" id="degree">'+data.degree+'</div>';

		academics+='</div>';

		academics+='<div class="col-md-2 col-md-offset-6 text-center">';

			academics+='<div style="font-size:16px;" class="percentage" id="percentage">'+data.percentage+'%</div>';

		academics+='</div>';

	academics+='</div><!-- end class row -->';

	academics+='<br/>';

	academics+='<div class="row">';

		academics+='<div class="col-md-4 text-left">';

			academics+='<em><div style="font-size:14px;" id="school">'+data.schoolName+'</div></em>';

		academics+='</div>';

		academics+='<div class="col-md-4 col-md-offset-4 text-right">';

			academics+='<div style="font-size:14px;" title="'+data.duration+'"id="duration">'+data.minDuration+'</div>';

		academics+='</div>';

	academics+='</div><!-- end class row -->';

	academics+='<div class="row">';

		academics+='<div class="col-md-8 text-left">';

			academics+='<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">'+data.location+'</span></div>';

		academics+='</div><!--end class col-md-8 -->';

		academics+='<div class="col-md-4 text-right">';

			academics+='<div style="font-size:14px;"><i class="fa fa-pencil" onclick="editAcademics(\''+data.academicsId+'\');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAcademics(\''+data.academicsId+'\');"></i></div>';

		academics+='</div><!--end class col-md-8 -->';

	academics+='</div><!-- end class row -->';


	academics+='</div><!-- end class academics -->';

	var length=$("#academics").find('.academics').length;

	var position=length%2+1;

	$('#academics').find('#academicsContainer'+position).append(academics);
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
			for(i=0;i<x.length;i++)
			{
				insertAcademics(x[i]);
			}
			
		}
	});
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
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertAcademics(data);
			}
		});
	}
}

function modifyAcademics(data)
{
	var link=$('#academics').find('#'+data.academicsId);
	link.find('#degree').html(data.degree);
	link.find('#percentage').html(data.percentage);
	link.find('#school').html(data.school);
	link.find('#location').html(data.location);
	link.find('#duration').attr("title",data.minDuration);
	link.find('#duration').html(data.duration);
}

function editAcademicsSendData()
{
	var link=$('#editAcademicsModal');
	var degree=link.find('#editAcademicsModalDegree').val().trim();
	var percentage=link.find('#editAcademicsModalPercentage').val().trim();
	var school=link.find('#editAcademicsModalSchoolName').val().trim();
	var location=link.find('#editAcademicsModalSchoolLocation').val().trim();
	var duration=link.find('#editAcademicsModalDurationFrom').val().trim()+"-"+link.find('#editAcademicsModalDurationTo').val().trim();
	var id=link.find('#editAcademicsModalId').html();
	if(degree.length==0)
	{
		alert("We hope you have a degree name.")
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editAcademics.php',{
			_academicsId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyAcademics(data);
			}
		});
	}
}

function deleteAcademics(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutMeHandlers/deleteAcademics.php',{
			_academicsId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#academics').find('#'+id).remove();
			}
		});
	}
}


/////////////////////////ACADEMICS ENDS/////////////////
///
///
///
/////////////////////////WORKSHOPS STARTS///////////////


function insertWorkshop(data)
{
	var workshop="";

	workshop+='<div class="row workshop" id="'+data.workshopId+'">';

		workshop+='<div class="row">';

			workshop+='<div class="col-md-6 text-left">';

				workshop+='<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">'+data.name+'</span></div>';

			workshop+='</div><!-- end class col-md-6 -->';

			workshop+='<div class="col-md-3 text-right col-md-offset-3">';

				workshop+='<div style="font-size:14px;"><i  onclick="editWorkshop(\''+data.workshopId+'\');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteWorkshop(\''+data.workshopId+'\');" class="fa fa-trash"></i></div>';

			workshop+='</div><!-- end classc col-md-3 -->';

		workshop+='</div><!-- end class row -->';

		workshop+='<br/>';

		workshop+='<div class="row">';

			workshop+='<div class="col-md-6 text-left">';

				workshop+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">'+data.location+'</span></div>';

			workshop+='</div><!-- end class col-md-6 -->';

			workshop+='<div class="col-md-4 text-right col-md-offset-2">';

				workshop+='<div style="font-size:15px;" id="workshopDuration" title="'+data.duration+'">'+data.minDuration+'</div>';

			workshop+='</div><!-- end classc col-md-3 -->';

		workshop+='</div><!-- end class row -->';

		if(data.numPeopleAttended!="")
		{
			workshop+='<div class="col-md-6 text-left">';

				workshop+='<em><div style="font-size:14px;"><span id="attenderNumber">'+data.numPeopleAttended+'</span>&nbsp; people attended</div></em>';

			workshop+='</div>';
		}

	workshop+='</div><!-- end class workshop -->';

	var length=$("#workshops").find(".workshop").length;

	var position=length%2+1;

	$('#workshops').find('#workshopContainer'+position).append(workshop);
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

			for(i=0;i<x.length;i++)
			{
				insertWorkshop(x[i]);
			}
			
		}
	});
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
				insertWorkshop(data);
			}
		});
	}
}

function modifyWorkshop(data)
{
	var link=$('#workshops').find('#'+data.workshopId);
	link.find('#workshopName').html(data.name);
	link.find('#workshopLocation').html(data.location);
	link.find('#workshopDuration').html(data.duration).attr("title",data.minDuration);
	link.find("#attendeeNumber").html(data.numPeopleAttended);
}

function editWorkshopSendData()
{
	var link=$('#editWorkshopModal');
	var id=link.find('#editWorkshopModalId').html();
	var name=link.find('#editWorkshopModalWorkshopName').val().trim();
	var location=link.find('#editWorkshopModalWorkshopLocation').val().trim();
	var duration=link.find('#editWorkshopModalWorkshopDurationFrom').val().trim()+"-"+link.find('#editWorkshopModalWorkshopDurationTo').val().trim();
	var attendeeNumber=link.find('#editWorkshopModalWorkshopPeopleNumber').val().trim();
	if(name.length==0)
	{
		alert("We hope a name was given to the workshop.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editWorkshop.php',{
			_workshopId:id,
			_workshopName:name,
			_workshopLocation:location,
			_workshopDuration:duration,
			_attendeeNumber:attendeeNumber
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifyWorkshop(data);
			}
		});
	}
}

function deleteWorkshop(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutMeHandlers/deleteWorkshop.php',{
			_workshopId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#workshops').find('#'+id).remove();
			}
		});
	}
}


/////////////////////////WORKSHOPS ENDS//////////////////
//
//
//
//
//////////////////////////CERTIFICATIONS STARTS////////////

function insertCertification(data)
{
	var certification="";

	certification+='<div class="row certification" id="'+data.certificationId+'">';

		certification+='<div class="row">';

			certification+='<div class="text-left col-md-7">';

				certification+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">'+data.courseName+'</span></div>';

			certification+='</div>';

			certification+='<div class="col-md-3 text-right col-md-offset-2">';

				certification+='<div style="font-size:14px;" class="text-right textPadding" ><i onclick="editCertification(\''+data.certificationId+'\');" class="fa fa-pencil"></i>&nbsp;<i onclick="deleteCertification(\''+data.certificationId+'\');" class="fa fa-trash"></i</div>';

			certification+='</div>';

		certification+='</div>';

		certification+='<br/>';

		certification+='<div class="row">';

			certification+='<div class="text-left col-md-7">';

				certification+='<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">'+data.institute+'</span></div>';

			certification+='</div>';

			certification+='<div class="col-md-5">';

				certification+='<div title="'+data.duration+'" style="font-size:16px;" class="text-right" id="duration">'+data.minDuration+'</div>';

			certification+='</div>';

		certification+='</div>';

	certification+='</div><!-- end class certification -->';

	var length=$("#certifications").find('.certification').length;

	var position=length%2+1;

	$('#certifications').find('#certificationContainer'+position).append(certification);
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
			for(i=0;i,x.length;i++)
			{
				insertCertification(x[i]);
			}
			
		}
	});
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
				insertCertification(data);
			}
		});
	}
}

function modifyCertification(data)
{
	var link=$('#certifications').find('#'+data.certificationId);
	link.find('#courseName').html(data.courseName);
	link.find('#institute').html(data.institute);
	link.find('#duration').attr("title",data.duration).html(data.minDuration);
}

function editCertificationSendData()
{
	var link=$('#editCertificationModal');
	var courseName=link.find('#editCertificationModalCourseName').val().trim();
	var institute=link.find('#editCertificationModalInstitute').val().trim();
	var duration=link.find('#editCertificationModalCertificationDurationFrom').val().trim()+"-"+link.find('#editCertificationModalDurationTo').val().trim();
	var id=link.find('#editCertificationModalId').html();
	if(courseName.length==0)
	{
		alert("Course name is compulsory.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editCertification.php',{
			_certificationId:id,
			_courseName:courseName,
			_institute:institute,
			_duration:duration
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyCertification(data);
			}
		});
	}
}

function deleteCertification(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutMeHandlers/deleteCertification.php',{
			_certificationId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#certifications').find('#'+id).remove();
			}
		});
	}
}



/////////////////////CERTIFICATONS ENDS//////////////////
///
///
///
///
//////////////////////ACHIEVEMENTS STARTS////////////////

function insertAchievements(data)
{
	var achievements="";

	achievements+='<div class="row achievement" id="'+data.achievementId+'">';

		achievements+='<div class="row">';

			achievements+='<div class="col-md-6 text-left">';

				achievements+='<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">'+data.eventName+'</span></div>';

			achievements+='</div><!-- end class col-md-6 -->';

			achievements+='<div class="col-md-3 text-right col-md-offset-3">';

				achievements+='<div  style="font-size:14px;"><i class="fa fa-pencil" onclick="editAchievement(\''+data.achievementId+'\');"></i>&nbsp;<i class="fa fa-pencil" onclick="deleteAchievement(\''+data.achievementId+'\');"></i></div>';

			achievements+='</div><!-- end classc col-md-3 -->';

		achievements+='</div><!-- end class row -->';

		achievements+='<br/>';

		achievements+='<div class="row">';

			achievements+='<div class="col-md-6 text-left">';

				achievements+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">'+data.location+'</span></div>';

			achievements+='</div><!-- end class col-md-6 -->';

			achievements+='<div class="col-md-4 text-right col-md-offset-2">';

				achievements+='<div style="font-size:15px;" title="'+data.duration+'" id="eventDuration">'+data.minDuration+'</div>';

			achievements+='</div><!-- end classc col-md-3 -->';

		achievements+='</div><!-- end class row -->';

		achievements+='<br/>';

		achievements+='<div class="col-md-6 text-left">';

			achievements+='<div style="font-size:14px;" id="eventDescription">'+data.description+'</div>';

		achievements+='</div>';

	achievements+='</div><!-- end class achievement -->';

	var length=$("#achievements").find('.achievement').length;

	var position=length%2+1;

	$('#achievements').find('#achievementContainer'+position).append(achievements);
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

			for(i=0;i<x.length;i++)
			{
				insertAchievements(x[i]);
			}
			
		}
	});
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
				insertAchievements(data);
			}
		});
	}
}

function modifyAchievement(data)
{
	var link=$('#achievements').find('#'+data.achievementId);
	link.find('#eventName').html(data.eventName);
	link.find('#eventLocation').html(data.eventLocation);
	link.find('#eventDuration').html(data.eventYear);
	link.find('#eventDescription').html(data.eventDescription);
}

function editAchievementSendData()
{
	var link=$('#editAchievementModal');
	var name=link.find('#editAchievementModalEventName').val().trim();
	var location=link.find('#editAchievementModalLocation').val().trim();
	var year=link.find('#editAchievementModalYear').val().trim();
	var description=link.find('#editAchievementModalDescription').val().trim();
	var id=link.find('#editAchievementModalId').html();
	if(eventName.length==0)
	{
		alert("Please enter the event name.");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editAchievement.php',{
			_achievementId:id,
			_name:name,
			_location:location,
			_year:year,
			_description:description
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyAchievement(data);
			}
		});
	}
}

function deleteAchivement(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutMeHandlers/deleteAchivement.php',{
			_achievementId:id
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$('#achievements').find('#'+id).remove();
			}
		});
	}
}


/////////////////////////ACHIEVEMENTS ENDS/////////////////
///
///
///
///
////////////////////////////INTERESTS STARTS//////////////////

function insertInterest(data)
{
	var noOfInterests=$("#interests").find('.interest').length;
	var position=(noOfInterests%3)+1;

	var interest="";
	interest+='<div class="interest"><i class="fa fa-pencil interestEdit" onclick="editInterests();"></i><span>'+data+'</span></div>';

	$('#intersts').find("#interestsContainer"+position).append(interest);
}

function fetchInterests(data)
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchInterests.php',{

	})
	.error(function(){

	})
	.success(function(data){
		if(checkData(data)==1)
		{
			for(i=0;i<data.length;i++)
			{
				insertInterest(data[i]);
			}
		}
	})
}

function addInterestSendData()
{
	var interestName=$('#addInterestModal').find("#interestName").val().trim();
	if(interestName.length==0)
	{
		alert("Please enter interest");
	}
	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/addInterst.php',{
			_interestName:interestName
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				insertInterest(data);
			}
		});
	}
}

function modifyInterests(data)
{
	$('#interests').find('.interest').each(function(){
		$(this).remove();
	});
	for(i=0;i<data.length;i++)
	{
		insertInterst(data[i]);
	}
}

function editInterestSendData()
{
	var link=$("#editInterestsModal");
	var intersts=new Array();
	var i=0;
	link.find("interstsForm").find('.interestName').each(function(){
		interests[i]=$(this).val();
		i++;
	});

	var error=0;
	for(j=0;j<interests.length;j++)
	{
		if(interests[j].length==0)
		{
			error=1;
		}
	}

	if(error==0)
	{
		alert("Please enter all the intersts");
	}

	else
	{
		$.post('/4pi/handlers/aboutMeHandlers/editIntersts.php',{
			_interests:interests
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifyInterests(data);
			}
		})
	}
}

/////////////////////////////INTERESTS ENDS//////////////////////
///
///
///
///
/////////////////////////////////LEAVE MESSAGE/////////////////////////////////////

function leaveMessage()
{
	var link=$('#leaveMessageForm');
	var name=link.find('#leaveMessageName').val();
	var email=link.find('#leaveMessageEmail').val();
	var message=link.find('#leaveMessageTextMessage').val();
	if(name.length==0 || email.length==0 || message.length==0)
	{
		alert("Please fill all the fields");
	}
	else
	{
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	   	 if(re.test(email))
	   	 {
	   	 	$.post('/4pi/handlers/aboutMeHandlers/leaveMessage.php',{
	   	 		_name:name,
	   	 		_email:email,
	   	 		_message:message,
	   	 		_userId:userIdFromURL
	   	 	})
	   	 	.error(function(){
	   	 		alert("Server overload. Please try again.");
	   	 	})
	   	 	.success(function(data){
	   	 		if(checkData(data)==1)
	   	 		{
	   	 			alert("Thank you. The message is delivered.")
	   	 		}
	   	 	});
	   	 }
	   	 else
	   	 {
	   	 	alert("Enter proper email");
	   	 }
	}
}


///////////////////////////////LEAVE MESSAGE ENDS////////////////////////////////




