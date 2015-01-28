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

Author: Avinash Kadimisetty, COE12B009 (www.kavinash.in)

Last edited: 28-01-2015

To do:

Test fetch, insert, edit , delete		 


*********************************************************************/


//var userIdFromURL=window.location.href.lastIndexOf('/');
//var userId = window.location.href.substring(userIdFromURL+1,userIdFromURL+10);
//var userId=userIdFromURL;
//alert(userId);

/*var userId="COE12B025";*/
var commonURLAbout="/4pi/";
///////////////////////////GENERIC FUNCTIONS STARTS/////////////////////

$(document).ready(function(){
	fetchTools();
});

function addSkillAddInput()
{
	var link=$("#addSkillModal");

	var input="";

	input+='<div class="row addSkillInputClass extraInputs">';

		input+='<div class="col-md-5">';

			input+='<input type="text" id="addSkillModalSkillName" class="form-control">';

		input+='</div>';

		input+='<div class="col-md-5">';

			input+='<input type="number" pattern="[0-9]*" min="0" max="100" id="addSkillModalSkillPercentage" class="form-control">';

		input+='</div>';

		input+='<div class="col-md-2">';

			input+='<span style="cursor:pointer;" class="input-group-addon" onclick="addSkillAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span class="input-group-addon" id="deleteOption">';

				input+='<i class="fa fa-minus" onclick="addSkillDeleteInput(this);"></i>';

			input+='</span>';

		input+='</div>';

	input+='</div>';

	link.find("form").append(input);
}

function addSkillDeleteInput(el)
{
	$(el).parent().parent().parent().remove();
}

function editSkillDeleteInput(el)
{
	$(el).parent().parent().parent().remove();
}

function addToolAddInput()
{
	var link=$("#addToolModal");

	var input="";

	input+='<div class="row addToolInputClass extraInput">';

		input+='<div class="col-md-10">';

			input+='<input type="text" placeholder="Tool name" id="addToolModalToolText" class="form-control">';

		input+='</div>';

		input+='<div class="col-md-2">';

			input+='<span style="cursor:pointer;" class="input-group-addon" onclick="addToolAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span style="cursor:pointer;" class="input-group-addon" onclick="addToolDeleteInput(this);" id="addOption">';

				input+='<i class="fa fa-minus" ></i>';

			input+='</span>';

		input+='</div>';

	input+='</div>';

	link.find('form').append(input);
}

function addToolDeleteInput(el)
{
	$(el).parent().parent().remove();
}

function editToolDeleteInput(el)
{
	$(el).parent().parent().parent().remove();
}


function addInterestAddInput()
{
	var link=$("#addInterestModal");

	var input="";

	input+='<div class="row addInterestInputClass extraInput">';

		input+='<div class="col-md-10">';

			input+='<input type="text" placeholder="Interest" id="addInterestModalInterestName" class="form-control">';

		input+='</div>';

		input+='<div class="col-md-2">';

			input+='<span style="cursor:pointer;" class="input-group-addon" onclick="addInterestAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span style="cursor:pointer;" class="input-group-addon" onclick="addInterestDeleteInput(this);" id="addOption">';

				input+='<i class="fa fa-minus" ></i>';

			input+='</span>';

		input+='</div>';

	input+='</div>';

	link.find('form').append(input);
}

function addInterestDeleteInput(el)
{
	$(el).parent().parent().remove();
}

function editInterestDeleteInput(el)
{
	$(el).parent().parent().parent().remove();
}

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
	var topPart="";

	topPart+='<div class="col-md-2" id="personPicture">';

		topPart+='<a href="'+commonURLAbout+userId+'" title="'+data.name+'" class=""><img src="'+data.profilePicture+'.jpg"  alt="'+data.name+'" class="img-responsive"/></a><br/>';

		topPart+='<h4 class="text-center" id="personRollNumber">'+userId+'</h4>';

	topPart+='</div><!-- end id personPicture -->';

	topPart+='<div class="col-md-10" id="personInfo">';
		
		topPart+='<div class="row" id="personName">';

			topPart+='<div class="col-md-11">';

				topPart+='<h3 class="profileName" id="personNameText">'+data.name+'</h3><br/>';

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

	insertBottomPart(data);
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

			bottomPart+='<div class="col-md-6 col-md-offset-1" id="contactsContainer">';

				bottomPart+='<div class="row">';

					bottomPart+='<h4 style="color:rgba(222, 123, 26, 1);"><i class="fa fa-share-alt"></i>&nbsp;Lets get connected</h4>';

					bottomPart+='<i onclick="editContacts();" class="fa fa-pencil text-right"></i>';

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

				if(data.googleId!="")
				{
					bottomPart+='<div class="col-md-2" id="googlePlusURL">';
						bottomPart+='<a href="'+data.googleId+'" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
					bottomPart+='</div>';
				}

				if(data.linkedinId!="")
				{
					bottomPart+='<div class="col-md-2" id="linkedInURL">';
						bottomPart+='<a href="'+data.linkedinId+'" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
					bottomPart+='</div>';
				}

				if(data.pinterestId!="")
				{
					bottomPart+='<div class="col-md-2" id="pinterestURL">';
						bottomPart+='<a href="'+data.pinterestId+'" class="icon-button pinterest"><i class="fa fa-pinterest" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
					bottomPart+='</div>';
				}

				bottomPart+='</div>';

				bottomPart+='<br/>';

				bottomPart+='<div class="row">';

					bottomPart+='<div class="text-left col-md-4">';

						bottomPart+='<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-envelope"></i>&nbsp;Email(s)</h4>';

						bottomPart+='<br/>';
							
						bottomPart+='<p id="userEmail2">'+data.mailId+'</p>';

						bottomPart+='<p id="userEmail1">'+userId+'@iiitdm.ac.in</p>';

					bottomPart+='</div>';

				if(data.address.length!=0)
				{
					bottomPart+='<div class="text-left col-md-4">';

						bottomPart+='<h4 style="color:rgba(80, 183, 154, 1);"><i class="fa fa-map-marker"></i>&nbsp;Address</h4>';

						bottomPart+='<br/>';

						bottomPart+='<p id="address">'+data.address+'</p>';

					bottomPart+='</div>';
				}

				if(data.phone.length!=0)
				{
					bottomPart+='<div class="text-left col-md-4">';

						bottomPart+='<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-mobile-phone"></i>&nbsp;Contact</h4>';

						bottomPart+='<br/>';

						for(var i=0;i<data.phone.length;i++)
						{
							if(data.showPhone[i]==1)
							{
								var x=i+1;
								bottomPart+='<p id="userPhone'+x+'">'+data.phone[i]+'</p>';
							}
						}

					bottomPart+='</div>';
				}

				bottomPart+='</div>';

			bottomPart+='</div><!-- end class col-md-6 -->';

		bottomPart+='</div><!-- end class row -->';

	bottomPart+='</div><!--end id contact -->';

	$('#bottomContent').html(bottomPart);
}

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
		console.log(data);
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			insertTopPart(x);
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


//to check this function, this is not working.
function editTopPartSendData()
{
	var new_data=new FormData();

	var link=$("#editPersonInfoModal").find("#topPartEditForm");

	console.log(link.find("#editPersonInfoModalPersonName").val().trim());

	new_data.append("_alias","hello");
	new_data.append("_dob",link.find("#editPersonInfoModalPersonDOB").val().trim());
	new_data.append("_description",link.find("#editPersonInfoModalPersonDescription").val().trim());
	new_data.append("_profilePic",link.find("#editPersonInfoModalPersonImage").val().trim());

	new_data.append("_resume",link.find("#editPersonInfoModalPersonResume").val().trim());

	console.log(new_data);
}

//////////////////////////////PERSONAL INFO ENDS/////////////////////
///
///
///
///
///////////////////////////////SKILLS STARTS////////////////////////////

function insertSkills(data)
{
	data=JSON.parse(data);
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
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:8
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			insertSkills(data.jsonObj);
			$("#skills").find("#skillNames").html(data.skills);
			$("#skills").find("#skillPercentages").html(data.rating);
		}
	});
}

function addSkillSendData()
{
	var link=$("#addSkillModal");

	var skillArray=new Array();
	var percentageArray=new Array();

	var i=0;

	link.find(".addSkillInputClass").each(function(){
		skillArray[i]=$(this).find('#addSkillModalSkillName').val().trim();
		percentageArray[i]=$(this).find('#addSkillModalSkillPercentage').val().trim();
		i++;
	});

	var empty=0;
	var inputProblem=0;

	for(var i=0;i<skillArray.length;i++)
	{
		if(skillArray[i].length==0 || percentageArray[i].length==0)
		{
			empty=1;
		}

		else if(isNaN(percentageArray[i]))
		{
			inputProblem=1;
		}
	}

	if(empty!=0)
	{
		alert("Empty fields are not accepted");
	}
	else if(inputProblem!=0)
	{
		alert("Numbers only accepted in rating fields");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/insertSkills.php',{
			_skillArray:skillArray,
			_percentageArray:percentageArray,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				insertSkills(data.jsonObj);
				$("#skills").find("#skillNames").html(data.skills);
				$("#skills").find("#skillPercentages").html(data.rating);

				if(data.message.length!=0)
				{
					alert(data.message);
				}
			}
		});
	}
}

function modifySkill(data)
{
	insertSkills(data);
}

function editSkillSendData()
{
	var link=$("#editSkillModal");

	var skillArray=new Array();
	var percentageArray=new Array();

	var i=0;
	var empty=0;
	var inputProblem=0;

	link.find("form").find(".editSkillInputClass").each(function(){
		skillArray[i]=$(this).find("#editSkillModalSkillName").val().trim();
		percentageArray[i]=$(this).find("#editSkillModalSkillPercentage").val().trim();
		i++;
	});

	console.log(skillArray);

	var empty=0;
	var inputProblem=0;

	for(var i=0;i<skillArray.length;i++)
	{
		if(skillArray[i].length==0 || percentageArray[i].length==0)
		{
			empty=1;
		}

		else if(isNaN(percentageArray[i]))
		{
			inputProblem=1;
		}
	}

	if(empty!=0)
	{
		alert("Empty fields are not accepted");
	}
	else if(inputProblem!=0)
	{
		alert("Numbers only accepted in rating fields");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/editSkills.php',{
			_skillArray:skillArray,
			_percentageArray:percentageArray,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				modifySkill(data.jsonObj);
				$("#skills").find("#skillNames").html(data.skills);
				$("#skills").find("#skillPercentages").html(data.rating);

				if(data.message.length!=0)
				{
					alert(data.message);
				}
			}
		});
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
	console.log(data);
	var tool="";

	tool+='<div class="row tool">';

		tool+='<div class="col-md-2 text-center">';

			tool+='<i class="fa fa-pencil" onclick="editTools();"></i>';

		tool+='</div>';

		tool+='<div class="col-md-8 text-center">';

			tool+='<p id="toolName">'+data+'</p>';

		tool+='</div>';

		tool+='<div class="col-md-2 text-center">';

			tool+='<i class="fa fa-close" onclick="deleteTool(this);"></i>';

		tool+='</div>';

	tool+='</div>';

	var length=$("#tools").find(".tool").length;
	var position=(length%3)+1;

	$("#tools").find('#toolsColumn'+position).append(tool);
}

function fetchTools(data)
{
	$.post('/4pi/handlers/aboutHandlers/fetchTools.php',{

	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			data=JSON.parse(data);
			$("#tools").find(".tool").remove();

			for(i=0;i<data.length;i++)
			{
				insertTool(data[i]);
			}
		}
	});
}

function addToolsSendData()
{
	var link=$("#addToolModal");

	var toolArray=new Array();
	var i=0;

	link.find(".addToolInputClass").each(function(){
		toolArray[i]=$(this).find('#addToolModalToolText').val().trim();
		i++;
	});

	var empty=0;
	for(var i=0;i<toolArray.length;i++)
	{
		if(toolArray[i].length==0)
		{
			empty=1;
		}
	}

	if(empty==1)
	{
		alert("Empty tools are not allwoed");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/insertTools.php',{
			_toolArray:toolArray,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			console.log(data);
			if(checkData(data)==1)
			{
				$("#tools").find('.tool').remove();
				var x=JSON.parse(data);
				for(i=0;i<x.length;i++)
				{
					insertTool(x[i]);
				}
			}
		});
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

function editToolsSendData()
{

	var link=$("#editToolModal");

	var toolArray=new Array();
	var i=0;

	link.find(".editToolInputClass").each(function(){
		toolArray[i]=$(this).find('#editToolModalToolName').val().trim();
		i++;
	});

	var empty=0;
	for(var i=0;i<toolArray.length;i++)
	{
		if(toolArray[i].length==0)
		{
			empty=1;
		}
	}

	if(empty==1)
	{
		alert("Empty tools are not allwoed");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/editTools.php',{
			_toolArray:toolArray,
			_userId:userId
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$("#tools").find("#toolsColumn1").html("");
				$("#tools").find("#toolsColumn2").html("");
				$("#tools").find("#toolsColumn3").html("");
				var x=JSON.parse(data);
				for(i=0;i<x.length;i++)
				{
					insertTool(x[i]);
				}
			}
		});
	}
}


//////////////////////////////TOOLS ENDS/////////////////////////////////
///
///
///
///
////////////////////////////PROJECTS STARTS////////////////////////////////



function insertProjects(data)
{
	var projects="";


	projects+='<div class="row project" id="'+data.projectId+'">';

		projects+='<div class="row">';

			projects+='<div class="col-md-5 text-left">';

				projects+='<h4 class="textPadding" style="font-weight:bold;" id="projectTitle">'+data.projectTitle+'</h4>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-4 text-left">';

				projects+='<h4 class="textPadding"  id="projectCompany">'+data.organisation+'</h4>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-3 text-right">';
				
				projects+='<h5 class="textPadding"><span id="projectDuration" title="'+data.duration+'">'+data.minDuration+'</span><i onclick="editProject(\''+data.projectId+'\');" class="fa fa-trash"></i>&nbsp;<i onclick="deleteProject(\''+data.projectId+'\');" class="fa fa-pencil"></i>&nbsp;</h5>';

			projects+='</div><!-- end class col-md- 3 -->';


		projects+='</div><!-- end class row -->';

		projects+='<div class="row">';
			
			projects+='<div class="col-md-3 text-left">';

				projects+='<h5 class="textPadding" id="projectRole">'+data.role+'</h5>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-9 text-right">';

				projects+='<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">'+data.teamMembers+'</span></h5>';

			projects+='</div><!-- end class col-md- 3 -->';

		projects+='</div><!-- end class row -->';

		projects+='<div class="row">';

			projects+='<p class="text-center" style="text-align:justify;" id="projectDescription">'+data.description+'</p>';

		projects+='</div><!-- end class row -->';

	projects+='</div>';
	
	$('#projects').find('#projectContainer').append(projects);
}

function fetchProjects()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:6
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
			for(var i=0;i<x.length;i++)
			{
				insertProjects(x[i]);
			}
		}
	});
}

function addProjectSendData()
{
	var ln=$('#addProjectModal');
	var title=ln.find('#addProjectModalProjectTitle').val().trim();
	var team=ln.find('#addProjectModalProjectTeam').val().trim();
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
			_description:description,
			_team:team
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertProjects(data);
			}
		});
	}
}

function modifyProject(data)
{
	var y=$('#'+data.projectId);
	y.find('#projectTitle').html(data.projectTitle);
	y.find('#projectDuration').html(data.minDuration);
	y.find('#projectDuration').attr("title",data.duration);
	y.find('#projectRole').html(data.role);
	y.find('#projectCompany').html(data.organisation);
	y.find('#projectTeam').html(data.teamMembers);
	y.find('#projectDescription').html(data.description);
}

function editProjectSendData()
{
	var ln=$('#editProjectModal');
	var title=ln.find('#editProjectModalProjectTitle').val().trim();
	var team=ln.find('#editProjectModalProjectTeam').val().trim();
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
		$.post('/4pi/handlers/aboutHandlers/editProject.php',{
			_title:title,
			_duration:duration,
			_role:role,
			_company:company,
			_description:description,
			_id:projectId,
			_team:team
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
	link.find('#duration').html(data.minDuration);
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
	link.find('#duration').attr("title",data.duration);
	link.find('#duration').html(data.minDuration);
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

				workshop+='<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">'+data.workshopName+'</span></div>';

			workshop+='</div><!-- end class col-md-6 -->';

			workshop+='<div class="col-md-3 text-right col-md-offset-3">';

				workshop+='<div style="font-size:14px;"><i  onclick="editWorkshop(\''+data.workshopId+'\');" class="fa fa-pencil"></i>&nbsp;<i  onclick="deleteWorkshop(\''+data.workshopId+'\');" class="fa fa-trash"></i></div>';

			workshop+='</div><!-- end classc col-md-3 -->';

		workshop+='</div><!-- end class row -->';

		workshop+='<br/>';

		workshop+='<div class="row">';

			workshop+='<div class="col-md-6 text-left">';

				workshop+='<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">'+data.place+'</span></div>';

			workshop+='</div><!-- end class col-md-6 -->';

			workshop+='<div class="col-md-4 text-right col-md-offset-2">';

				workshop+='<div style="font-size:15px;" id="workshopDuration" title="'+data.duration+'">'+data.minDuration+'</div>';

			workshop+='</div><!-- end classc col-md-3 -->';

		workshop+='</div><!-- end class row -->';

		if(data.attendees!="")
		{
			workshop+='<div class="col-md-6 text-left">';

				workshop+='<em><div style="font-size:14px;"><span id="attenderNumber">'+data.attendees+'</span>&nbsp; people attended</div></em>';

			workshop+='</div>';
		}

	workshop+='</div><!-- end class workshop -->';

	var length=$("#workshops").find(".workshop").length;

	var position=length%2+1;

	$('#workshops').find('#workshopContainer'+position).append(workshop);
}

function fetchWorkshops()
{
	$.post('./4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:7
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
		$.post("/4pi/handlers/aboutHandlers/insertWorkshop.php",{
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
	link.find('#workshopName').html(data.workshopName);
	link.find('#workshopLocation').html(data.place);
	link.find('#workshopDuration').html(data.minDuration).attr("title",data.duration);
	link.find("#attendeeNumber").html(data.attendees);
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

	certification+='<div class="row certification" id="'+data.courseId+'">';

		certification+='<div class="row">';

			certification+='<div class="text-left col-md-7">';

				certification+='<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">'+data.title+'</span></div>';

			certification+='</div>';

			certification+='<div class="col-md-3 text-right col-md-offset-2">';

				certification+='<div style="font-size:14px;" class="text-right textPadding" ><i onclick="editCertification(\''+data.courseId+'\');" class="fa fa-pencil"></i>&nbsp;<i onclick="deleteCertification(\''+data.courseId+'\');" class="fa fa-trash"></i</div>';

			certification+='</div>';

		certification+='</div>';

		certification+='<br/>';

		certification+='<div class="row">';

			certification+='<div class="text-left col-md-7">';

				certification+='<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">'+data.institutename+'</span></div>';

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
	$.post('./4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:4
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
	var link=$('#certifications').find('#'+data.courseId);
	link.find('#courseName').html(data.title);
	link.find('#institute').html(data.institutename);
	link.find('#duration').attr("title",data.minDuration).html(data.duration);
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

				achievements+='<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">'+data.competition+'</span></div>';

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

				achievements+='<div style="font-size:15px;" id="eventPosition">'+data.position+'</div>';

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

	$.post('./4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:4
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
	var position=ln.find('#addAchievementModalPosition').val().trim();
	if(name.length==0)
	{
		alert("Please enter the event name");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/addAchievement.php',{
			_name:name,
			_location:location,
			_description:description,
			_position:position,
			_userId:userId
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
	link.find('#eventName').html(data.competition);
	link.find('#eventLocation').html(data.location);
	link.find('#eventPosition').html(data.position);
	link.find('#eventDescription').html(data.description);
}

function editAchievementSendData()
{
	var link=$('#editAchievementModal');
	var name=link.find('#editAchievementModalEventName').val().trim();
	var location=link.find('#editAchievementModalLocation').val().trim();
	var position=link.find('#editAchievementModalPosition').val().trim();
	var description=link.find('#editAchievementModalDescription').val().trim();
	var id=link.find('#editAchievementModalId').html();
	if(eventName.length==0)
	{
		alert("Please enter the event name.");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/editAchievement.php',{
			_achievementId:id,
			_name:name,
			_location:location,
			_position:position,
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

function deleteAchievement(id)
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

	interest+='<div class="row interest">';

		interest+='<div class="col-md-2">';

			interest+='<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>';

		interest+='</div>';


		interest+='<div class="col-md-10">';

			interest+='<p id="interestName">'+data+'</p>';

		interest+='</div>';

	interest+='</div>';

	$('#intersts').find("#interestsContainer"+position).append(interest);
}

function fetchInterests(data)
{
	$.post('/4pi/handlers/aboutMeHandlers/fetchInterests.php',{
		_userId:userId
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
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

function addInterestsSendData()
{
	var link=$("#addInterestModal");

	var interestArray=new Array();
	var i=0;

	link.find(".addInterestInputClass").each(function(){
		interestArray[i]=$(this).find("#interestName").html();
		i++;
	});

	var empty=0;

	for(var i=0;i<interestArray.length;i++)
	{
		if(interestArray[i].length==0)
		{
			empty=1;
		}
	}

	if(empty==1)
	{
		alert("Incomplete fields somewhere");
	}

	else
	{
		$.post('/4pi/handlers/aboutHandlers/insertInterests.php',{
			_userId:userId,
			_interestsArray:interestsArray
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$("#interests").find('.interest').remove();
				for(var i=0;i<data.length;i++)
				{
					insertInterests(data[i]);
				}
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

	var link=$("#editInterestModal");

	var interestArray=new Array();
	var i=0;

	link.find(".editInterestInputClass").each(function(){
		interestArray[i]=$(this).find("#interestName").html();
		i++;
	});

	var empty=0;

	for(var i=0;i<interestArray.length;i++)
	{
		if(interestArray[i].length==0)
		{
			empty=1;
		}
	}

	if(empty==1)
	{
		alert("Incomplete fields somewhere");
	}

	else
	{
		$.post('/4pi/handlers/aboutHandlers/editInterests.php',{
			_userId:userId,
			_interestsArray:interestsArray
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				$("#interests").find('.interest').remove();
				for(var i=0;i<data.length;i++)
				{
					insertInterests(data[i]);
				}
			}
		});
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




