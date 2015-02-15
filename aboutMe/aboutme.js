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

Last edited: 29-01-2015

To do:

Test fetch, insert, edit , delete		 

*********************************************************************/


//var userIdFromURL=window.location.href.lastIndexOf('/');
//var userId = window.location.href.substring(userIdFromURL+1,userIdFromURL+10);
//var userId=userIdFromURL;
//alert(userId);

/*var userId="COE12B025";*/
var commonURLAbout="/4pi/aboutMe/index.php?userId=";

window.userOptionsVisibility=0;
///////////////////////////GENERIC FUNCTIONS STARTS/////////////////////
function showUserOptions()
{
	if(window.userOptionsVisibility==0)
	{
		$(document).find('.visibleForUser').remove();
	}
}

function closeModal(id)
{
	$('#'+id).modal('hide');
}

function updateNumber(element,position)
{
	var numberOfElements=$(element).length;
	position.html(numberOfElements);
}

function callWhen404(element,position)
{
	var text="";

	if(element=="Skills")
	{
		if($('.skill').length==0)
		{
			text="<p id='noskills'>No skills to display</p>";
		}

		else
		{
			$('#noskills').remove();
		}
		
	}

	else if(element=="Tools")
	{

		if($('.tool').length==0)
		{
			text="<p id=\"notools\">No tools to display</p>";
		}
		else
		{
			$("#notools").remove();
		}
	}

	else if(element=="Projects")
	{
		if($('.project').length==0)
		{
			text="<p id=\"noprojects\">No projects to display</p>";
		}
		else
		{
			$("#noprojects").remove();
		}
	}

	else if(element=="Experience")
	{
		if($('.experience').length==0)
		{
			text="<p id=\"noexperiences\">No experiences to display</p>";
		}
		else
		{
			$("#noexperiences").remove();
		}
	}

	else if(element=="Academics")
	{
		if($('.academics').length==0)
		{
			text="<p id=\"noacademics\">No degrees to display</p>";
		}
		else
		{
			$("#noacademics").remove();
		}
	}

	else if(element=="Certifications")
	{
		if($('.certification').length==0)
		{
			text="<p id=\"nocertifications\">No certified courses to display</p>";
		}
		else
		{
			$("#nocertifications").remove();
		}
	}

	else if(element=="Workshops")
	{
		if($('.workshop').length==0)
		{
			text="<p id=\"noworkshops\">No workshops to display</p>";
		}
		else
		{
			$("#noworkshops").remove();
		}
	}

	else if(element="Achievements")
	{
		if($('.achievement').length==0)
		{
			text="<p id=\"noachievements\">No achievements to display</p>";
		}
		else
		{
			$("#noachievements").remove();
		}
	}

	else if(element=="Interests")
	{
		if($('.interest').length==0)
		{
			text="<p id=\"nointerests\">No interests to display</p>";
		}
		else
		{
			$("#nointerests").remove();
		}
	}

	position.html(text);
}

$(document).ready(function(){
	// $('textarea').autosize();
	showValueForSlider();
	fetchTopPart();
	fetchSkills();
	fetchTools();
	fetchProjects();
	fetchExperience();
	fetchAcademics();
	fetchWorkshops();
	fetchCertifications();
	fetchAchievements();
	fetchInterests();
	
});

function afterAjaxCallDisplay()
{
	$('.showOnHover').hide();
	$('.project').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.project').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.tool').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.tool').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.interest').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.interest').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.certification').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.certification').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.academics').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.academics').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.achievement').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.achievement').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.experience').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.experience').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});

	$('.workshop').mouseover(function(){
		$(this).find(".showOnHover").show();
	});
	$('.workshop').mouseout(function(){
		$(this).find(".showOnHover").hide();
	});
}



function showValueForSlider(el)
{
	$(el).parent().parent().find("#sliderValueAddModal").html($(el).val());
}

function addSkillAddInput()
{
	var link=$("#addSkillModal");

	var input="";

	input+='<div class="row addSkillInputClass extraInputs">';

		input+='<div class="col-md-5">';

			input+='<input type="text" id="addSkillModalSkillName" class="form-control">';

		input+='</div>';

		input+='<div class="col-md-4">';

			input+='<input type="range" min="0" style="border:none;" max="100" id="addSkillModalSkillPercentage" onchange="$(this).parent().parent().find(\'#sliderValueAddModal\').parent().removeClass(\'hidden\');showValueForSlider(this);" class="form-control">';

		input+='</div>';

		input+='<div class="hidden col-md-1 text-center skillValue" >';

			input+='<span id="sliderValueAddModal" style="padding-top:10px;"></span>';

		input+='</div>';

		input+='<div class="col-md-2">';

			input+='<span style="cursor:pointer;" class="hidden input-group-addon" onclick="addSkillAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span class="btn btn-sm btn-default" id="deleteOption" onclick="addSkillDeleteInput(this);">';

				input+='<i class="fa fa-minus" ></i>';

			input+='</span>';

		input+='</div>';

	input+='</div>';

	link.find("form").append(input);
}

function addSkillDeleteInput(el)
{
	$(el).parent().parent().remove();
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

			input+='<span style="cursor:pointer;" class="hidden input-group-addon" onclick="addToolAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span style="cursor:pointer;" class="btn btn-sm btn-default" onclick="addToolDeleteInput(this);" id="addOption">';

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

			input+='<span style="cursor:pointer;" class="hidden input-group-addon" onclick="addInterestAddInput();" id="addOption">';

				input+='<i class="fa fa-plus" ></i>';

			input+='</span>';

			input+='<span style="cursor:pointer;" class="btn btn-sm btn-default" onclick="addInterestDeleteInput(this);" id="addOption">';

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

function insertTopPart(data,locateProPic)
{
	var topPart="";

	topPart+='<div class="col-md-2" id="personPicture">';

	if(locateProPic==1)
	{
		topPart+='<a href="'+commonURLAbout+userId+'" title="'+data.name+'" class=""><img src="/4pi/img/proPicsTemp/'+data.userIdHash+'.jpg"  alt="'+data.name+'" class="img-responsive"/></a><br/>';
	}
	else
	{
		topPart+='<a href="'+commonURLAbout+userId+'" title="'+data.name+'" class=""><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg"  alt="'+data.name+'" class="img-responsive"/></a><br/>';
	}

		

		topPart+='<h4 class="text-center" id="personRollNumber">'+userId+'</h4>';

	topPart+='</div><!-- end id personPicture -->';

	topPart+='<div class="col-md-10" id="personInfo">';
		
		topPart+='<div class="row" id="personName">';

			topPart+='<div class="col-md-11">';

				topPart+='<h3 class="profileName" id="personNameText">'+data.alias+'</h3><p>('+data.name+')</p><br/>';

			topPart+='</div>';

			if(data.isOwner==1)
			{
				topPart+='<div class="col-md-1 visibleForUser text-right">';

					topPart+='<i class="fa fa-pencil" title="Edit" onclick="editPersonInfo();"></i>';

				topPart+='</div>';
			}

		topPart+='</div><!-- end id person name -->';

		topPart+='<div class="row" id="personDetails">';

			topPart+='<div class="col-md-3">';

				topPart+='<div class="text-left" id="personDOB">'+data.dob+'</div><br/>';

				topPart+='<div class="text-left" id="personHighestDegree">'+data.highestDegree+'</div><br/>';

				topPart+='<div class="text-left" id="personCurrentProfession">'+data.currentProfession+'</div><br/>';

				if(data.resumeExists==1)
				{
					topPart+='<div class="text-left" id="personResumeLink">';

						topPart+='<a href="/4pi/files/resumes/'+data.userIdHash+'.pdf"><button class="btn btn-primary">Find my resume&nbsp;&nbsp;<i class="fa fa-external-link"></i></button></a>';

					topPart+='</div><!-- end person resume link id -->';
				}

			topPart+='</div>';

			topPart+='<div class="col-md-9" id="personDescription">';

				topPart+='<p style="text-align:justify;line-height:22px;word-wrap:break-word;">'+data.description+'</p>';

			topPart+='</div><!-- end class col-md-8 -->';

		topPart+='</div><!-- end person details id -->';

	topPart+='</div>';

	$('#topContent').html(topPart);
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

				bottomPart+='<form id="leaveMessageForm">';

					bottomPart+='<input type="text" id="leaveMessageName" class="form-control" placeholder="Your name"><br/>';

					bottomPart+='<input type="text" id="leaveMessageEmail" class="form-control" placeholder="Your email"><br/>';

					bottomPart+='<textarea type="text" id="leaveMessageTextMessage" class="form-control" placeholder="Your message"></textarea><br/>';

					bottomPart+='<button class="btn btn-primary" onclick="leaveMessage(event);">Send</button>';


				bottomPart+='</form>';


			bottomPart+='</div><!-- end class col-md-6 -->';

			bottomPart+='<div class="col-md-6 col-md-offset-1" id="contactsContainer">';

				bottomPart+='<div class="row">';

					bottomPart+='<div class="col-md-6">';

						bottomPart+='<h4 style="color:rgba(222, 123, 26, 1);"><i class="fa fa-share-alt"></i>&nbsp;Lets get connected</h4>';

					bottomPart+='</div>';

					if(data.isOwner==1)
					{
						bottomPart+='<div class="col-md-1 visibleForUser col-md-offset-5">';
					
							bottomPart+='<i onclick="editContacts();" class="fa fa-pencil text-right"></i>';

						bottomPart+='</div>';
					}

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
						bottomPart+='<a href="'+data.pinterestId+'" class="icon-button pinterest"><i class="fa fa-instagram" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
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
							if(data.showPhone==1)
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

	showUserOptions();
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
			if(data!=404)
			{
				
				x=JSON.parse(data);
				if(x.isOwner==1)
				{
					window.userOptionsVisibility=1;
				}
				insertTopPart(x,0);
				insertBottomPart(x);
			}
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
	var showMailId=link.find("#showEmailIdValue").val();
	var showContactsValue=link.find("#showContactsValue").val();
	if(showMailId!=1 && showMailId!=2)
	{
		alert("There is a problem with your page. Please reload it.");
	}
	else if(showContactsValue!=1 && showContactsValue!=2)
	{
		alert("There is a problem with your page. Please reload it.");
	}
	else
	{
		var phone=[phone1,phone2];
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_userId:userId,
			_mode:11,
			_fbLink:fbURL,
			_gplusLink:gplusURL,
			_inLink:inURL,
			_twitterLink:twitterURL,
			_ptrestLink:pinURL,
			_phone:phone,
			_showMailId:showMailId,
			_showPhone:showContactsValue,
			_address:address,
			_mailId:emailId
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			console.log("HI      "+data);
			if(checkData(data)==1)
			{
				insertBottomPart(JSON.parse(data));
				link.modal('hide');
			}
		});
	}
}

function editTopPartSendData()
{
	var link=$("#editPersonInfoModal").find("#topPartEditForm");

	var error=0;

	var image=link.find("#editPersonInfoModalPersonImage")[0].files[0];

	if(image.size>8000000)
	{
		alert("Image size cannot be greater than 8 MB.");
		error=1;
	}

	var sFileName=link.find("#editPersonInfoModalPersonImage").val();

	var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();

	var resumeFile=link.find("#editPersonInfoModalPersonResume").val();

	var resumeFileExtension = resumeFile.split('.')[resumeFile.split('.').length - 1].toLowerCase();

	if(resumeFileExtension.length!=0)
	{
		if(resumeFileExtension!="pdf" || resumeFileExtension!="docx")
		{
			alert("Only .pdf and .docx are allowed for resume.");
			error=1;
		}
	}
	// alert(sFileExtension);
	if(sFileExtension.length!=0)
	{
		if(sFileExtension!="jpg")
		{
			error=1;
			alert("Only .jpg images are allowed");
		}
	}

	if(link.find("#editPersonInfoModalPersonDescription").val().trim().length>387)
	{
		error=1;
		alert("Please limit your description to 380 characters.");
	}
	
	if(error==0)
	{
		var new_data=new FormData($("#editPersonInfoModal").find("#topPartEditForm")[0]);

		

		//console.log(link.find("#editPersonInfoModalPersonName").val().trim());

		new_data.append("_alias",link.find("#editPersonInfoModalPersonName").val());
		new_data.append("_mode",1);
		new_data.append("_dob",link.find("#editPersonInfoModalPersonDOB").val().trim());
		new_data.append("_description",link.find("#editPersonInfoModalPersonDescription").val().trim());

		new_data.append("_resume",link.find("#editPersonInfoModalPersonResume")[0].files[0]);

		new_data.append("_profilePic",link.find("#editPersonInfoModalPersonImage")[0].files[0]);

		new_data.append("_highestDegree",$("#topContent").find("#personHighestDegree").html());

		new_data.append("_currentProfession",$("#topContent").find("#personCurrentProfession").html())

		// //console.log(new_data);
		// 
		$.ajax({
			url:'/4pi/handlers/aboutHandlers/aboutMeEdit.php',
			type:'POST',
			data:new_data,
			processData: false,
	    	contentType: false,
	    	success:function(data){
	    		console.log(data);
	    		insertTopPart(JSON.parse(data),1);
	    		$('#editPersonInfoModal').modal('hide');
	    	}
		});
	}
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
	// alert("Called");
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:8
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				data=JSON.parse(data);
				$("#skills").find("#skillNames").html(data.skills);
				$("#skills").find("#skillPercentages").html(data.rating);
				insertSkills(data.jsonObj);
			}

			else if(data==404)
			{
				callWhen404('Skills',$("#skills").find('#skillData'));
			}
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_skill:skillArray,
			_rating:percentageArray,
			_userId:userId,
			_mode:8
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertSkills(data.jsonObj);
				$("#skills").find("#skillNames").html(data.skills);
				$("#skills").find("#skillPercentages").html(data.rating);

				if(data.message.length!=0)
				{
					alert(data.message);
				}
				$('#addSkillModal').modal('hide');
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_skill:skillArray,
			_rating:percentageArray,
			_userId:userId,
			_mode:8
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);

				insertSkills(data.jsonObj);
				$("#skills").find("#skillNames").html(data.skills);
				$("#skills").find("#skillPercentages").html(data.rating);

				if(data.message.length!=0)
				{
					alert(data.message);
				}
				$("#editSkillModal").modal('hide');
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

function insertTool(data,isOwner)
{
	//console.log(data);
	var tool="";

	tool+='<div class="row tool">';

		tool+='<div class="col-md-2 text-center">';

			if(isOwner==1)
			{
				tool+='<i class="showOnHover fa fa-pencil" onclick="editTools(this,\'edit\');"></i>';
			}

		tool+='</div>';

		tool+='<div class="col-md-8 text-center">';

			tool+='<p id="toolName">'+data+'</p>';

		tool+='</div>';

		tool+='<div class="col-md-2 text-center">';

			if(isOwner==1)
			{
				tool+='<i class="showOnHover fa fa-trash" onclick="editTools(this,\'delete\');"></i>';
			}

		tool+='</div>';

	tool+='</div>';

	var length=$("#tools").find(".tool").length;
	var position=(length%3)+1;

	$("#tools").find('#toolsColumn'+position).append(tool);

	$("#notools").remove();
}

function fetchTools(data)
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:9
	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				data=JSON.parse(data);
				$("#tools").find(".tool").remove();
				var tools=data.tools.split(",");
				for(i=0;i<tools.length;i++)
				{
					insertTool(tools[i], data.isOwner);
				}
				afterAjaxCallDisplay();
			}

			else if(data==404)
			{
				callWhen404('Tools',$("#tools").find('#toolsColumn2'));
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_tools:toolArray,
			_userId:userId,
			_mode:9
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$("#tools").find('.tool').remove();
				data=JSON.parse(data);
				var x=data.tools.split(",");
				if(data.message.length!=0)
				{
					alert(data.message);
				}
				for(i=0;i<x.length;i++)
				{
					insertTool(x[i],data.isOwner);
				}
				$("#addToolModal").modal('hide');
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

	//console.log(toolArray);

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
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_tools:toolArray,
			_userId:userId,
			_mode:9
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$("#tools").find('.tool').remove();
				data=JSON.parse(data);
				var x=data.tools.split(",");
				if(data.message.length==0)
				{
					alert(data.message);
				}
				for(var i=0;i<x.length;i++)
				{
					insertTool(x[i],data.isOwner);
				}
				$("#editToolModal").modal('hide');

				if($('.tool').length==0)
				{
					callWhen404('Tools',$("#tools").find('#toolsColumn2'));
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

				projects+='<h4 class="textPadding" style="color:#176F56;font-weight:bold;"><i class="fa fa-database"></i>&nbsp;&nbsp;<span id="projectTitle">'+data.projectTitle+'</span></h4>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-4 text-left">';

				projects+='<h4 class="textPadding"  id="projectCompany">'+data.organisation+'</h4>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-3 text-right">';

				if(data.isOwner==1)
				{
					projects+='<h5 class="textPadding text-right"><i onclick="editProject(\''+data.projectId+'\');" class="showOnHover fa fa-pencil visibleForUser"></i>&nbsp;<i onclick="deleteProject(\''+data.projectId+'\');" class="showOnHover fa fa-trash visibleForUser"></i>&nbsp;&nbsp;';
				}
				
				projects+='<span class="text-right" id="projectDuration" title="'+data.duration+'">'+data.minDuration+'</span>&nbsp;&nbsp;';
				
				projects+='</h5>';

			projects+='</div><!-- end class col-md- 3 -->';


		projects+='</div><!-- end class row -->';

		projects+='<div class="row">';
			
			projects+='<div class="col-md-3 text-left">';

				projects+='<h5 class="textPadding" id="projectRole">'+data.role+'</h5>';

			projects+='</div><!-- end class col-md- 3 -->';

			projects+='<div class="col-md-9 text-right">';

				if(data.teamMembers.length==0)
				{
					projects+='<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">Not specified</span></h5>';
				}

				else
				{
					projects+='<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">'+data.teamMembers+'</span></h5>';
				}

				

			projects+='</div><!-- end class col-md- 3 -->';

		projects+='</div><!-- end class row -->';

		projects+='<div class="row">';

			projects+='<div class="col-md-12 text-center">';

				projects+='<p class="text-center" style="word-wrap:break-word;text-align:justify;" id="projectDescription">'+data.description+'</p>';

			projects+='</div>';

		projects+='</div><!-- end class row -->';

	projects+='</div>';
	
	$('#projects').find('#projectContainer').append(projects);

	$("#noprojects").remove();

	updateNumber('.project',$("#projects").find('#projectsNumber'));
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
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				// //console.log(checkData(data)+" this is checkData");
				$(".project").remove();
				x=JSON.parse(data);
				for(var i=0;i<x.length;i++)
				{
					insertProjects(x[i]);
				}

				afterAjaxCallDisplay();
			}

			else if(data==404)
			{
				callWhen404('Projects',$("#projects").find('#projectContainer'));
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_projectTitle:title,
			_duration:duration,
			_projectPosition:role,
			_projectCompany:company,
			_projectDescription:description,
			_teamMembers:team,
			_mode:6
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertProjects(data);
				$("#addProjectModal").modal('hide');
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
	var id=ln.find("#editProjectModalProjectId").val();

	alert(id);

	if(title.length==0)
	{
		alert("Please enter the project title");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_projectTitle:title,
			_duration:duration,
			_projectPosition:role,
			_projectCompany:company,
			_projectDescription:description,
			_teamMembers:team,
			_projectId:id,
			_mode:6
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyProject(data);
				$("#editProjectModal").modal('hide');
			}
		});
	}
}

function deleteProject(id)
{
	if(confirm("Do you want to delete this project?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_projectId:id,
			_mode:6
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#projects').find('#'+id).remove();
				if($('.project').length==0)
				{
					callWhen404('Projects',$("#projects").find('#projectContainer'));
				}

				updateNumber('.project',$("#projects").find('#projectsNumber'));
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

	experience+='<div class="hidden" id="featuring">'+data.isFeaturing+'</div>';

	experience+='<div class="row">';

		experience+='<div class="text-left col-md-7">';

			experience+='<div style="font-size:18px;color:#9A69AA;" class="text-left textPadding" ><i class="fa fa-fighter-jet"></i>&nbsp;<span id="company">'+data.organisation+'</span></div>';

		experience+='</div>';

		if(data.isOwner==1)
		{
			experience+='<div class="col-md-3 visibleForUser text-right col-md-offset-2">';

				experience+='<div style="font-size:14px;" class="text-right textPadding"><i  onclick="editExperience(\''+data.experienceId+'\');" class="showOnHover fa fa-pencil"></i>&nbsp;<i  onclick="deleteExperience(\''+data.experienceId+'\');" class="showOnHover fa fa-trash"></i></div>';

			experience+='</div>';
		}

	experience+='</div>';

	experience+='<br/>';

	experience+='<div class="row">';

		experience+='<div class="text-left col-md-7">';

			experience+='<div style="font-size:16px;" class="text-left" id="role">'+data.designation+'</div>';

		experience+='</div>';

		experience+='<div class="col-md-5">';

			experience+='<div style="font-size:16px;" title="'+data.duration+'" class="text-right" id="duration">'+data.minDuration+'</div>';

		experience+='</div>';

	experience+='</div>';

	experience+='</div><!-- end class experience -->';

	var length=$("#experiences").find(".experience").length;

	var position=length%2+1;

	$('#experiences').find('#experienceContainer'+position).append(experience);

	updateNumber('.experience',$("#experiences").find('#experienceNumber'));

	$("#noexperiences").remove();
}

function fetchExperience()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:5
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				x=JSON.parse(data);

				$('.experience').remove();
				for(i=0;i<x.length;i++)
				{
					insertExperience(x[i]);
				}
				afterAjaxCallDisplay();
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
	var featuring=ln.find("#addExperienceModalFeature").val();
	if(companyName.length==0)
	{
		alert("Please enter the name of the company");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_company:companyName,
			_role:role,
			_duration:duration,
			_isFeaturing:featuring,
			_mode:5
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertExperience(data);
				$("#addExperienceModal").modal('hide');
			}
		});
	}
}

function modifyExperience(data)
{
	var link=$('#experiences').find('#'+data.experienceId);
	link.find('#company').html(data.organisation);
	link.find('#role').html(data.role);
	link.find('#duration').attr("title",data.duration);
	link.find('#duration').html(data.minDuration);
	link.find("#featuring").html(data.isFeaturing);
}

function editExperienceSendData()
{
	var link=$('#editExperienceModal');
	var company=link.find('#editExperienceModalCompanyName').val().trim();
	var role=link.find('#editExperienceModalRole').val().trim();
	var duration=link.find('#editExperienceModalDurationFrom').val().trim()+"-"+link.find('#editExperienceModalDurationTo').val().trim();
	var isFeaturing=link.find("#editExperienceModalFeature").val();
	var id=link.find('#experienceId').val();

	if(company.length==0)
	{
		alert("Please enter the company name.");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_experienceId:id,
			_company:company,
			_role:role,
			_duration:duration,
			_isFeaturing:isFeaturing,
			_mode:5
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyExperience(data);
				$("#editExperienceModal").modal('hide');
			}
		});
	}
}

function deleteExperience(id)
{
	if(confirm("Do you want to delete the experience?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_experienceId:id,
			_mode:5
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#experiences').find('#'+id).remove();
				if($('.experience').length==0)
				{
					callWhen404('Experience',$("#experiences").find('#experienceContainer1'));
				}

				updateNumber('.experience',$("#experiences").find('#experienceNumber'));
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

	if(data.scoreType==1)
	{
		if(data.score.length!=0)
		{
			data.score+='%';
		}
	}

	academics+='<div class="row academics" id="'+data.degreeId+'">';

	academics+='<div class="hidden" id="scoreType">'+data.scoreType+'</div>';

	academics+='<div class="row">';

		academics+='<div class="col-md-4 text-left">';

			academics+='<div style="font-size:18px; color:#DE7B1A;"><i class="fa fa-mortar-board"></i>&nbsp;&nbsp;<span id="degree">'+data.degree+'</span></div>';

		academics+='</div>';

		academics+='<div class="col-md-2 col-md-offset-6 text-center">';

			academics+='<div style="font-size:16px;" class="percentage" id="percentage">'+data.score+'</div>';

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

		if(data.isOwner==1)
		{
			academics+='<div class="col-md-4 visibleForUser text-right">';

				academics+='<div style="font-size:14px;"><i class="showOnHover fa fa-pencil" onclick="editAcademics(\''+data.degreeId+'\');"></i>&nbsp;<i class="showOnHover fa fa-trash" onclick="deleteAcademics(\''+data.degreeId+'\');"></i></div>';

			academics+='</div><!--end class col-md-8 -->';
		}

	academics+='</div><!-- end class row -->';


	academics+='</div><!-- end class academics -->';

	var length=$("#academics").find('.academics').length;

	var position=length%2+1;

	$('#academics').find('#academicsContainer'+position).append(academics);

	updateNumber('.academics',$("#academics").find('#academicsNumber'));

	$("#noacademics").remove();
}

function fetchAcademics()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:3
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				x=JSON.parse(data);

				$('.academics').remove();
				for(i=0;i<x.length;i++)
				{
					insertAcademics(x[i]);
				}
				afterAjaxCallDisplay();
			}
		}
	});
}

function addAcademicsSendData()
{
	var ln=$('#addAcademicsModal');
	var degree=ln.find('#addAcademicsModalDegree').val().trim();
	
	var school=ln.find('#addAcademicsModalSchoolName').val().trim();
	var duration=ln.find('#addAcademicsModalDurationFrom').val().trim()+"-"+ln.find('#addAcademicsModalDurationTo').val().trim();
	var location=ln.find('#addAcademicsModalSchoolLocation').val().trim();
	var scoreType=ln.find("#addAcademicsModalPercentageType").val().trim();
	alert(scoreType);
	if(scoreType==1)
	{
		var percentage=ln.find('#addAcademicsModalPercentage').val().trim();
	}
	else if(scoreType==2)
	{
		var percentage=ln.find('#addAcademicsModalCGPA').val().trim()+"/"+ln.find('#addAcademicsModalCGPAScale').val().trim();
	}
	if(degree.length==0)
	{
		alert("Please enter the degree.");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_degree:degree,
			_score:percentage,
			_schoolName:school,
			_duration:duration,
			location:location,
			_scoreType:scoreType,
			_mode:3
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertAcademics(data);
				$("#addAcademicsModal").modal('hide');
			}
		});
	}
}

function modifyAcademics(data)
{
	var link=$('#academics').find('#'+data.degreeId);
	link.find('#degree').html(data.degree);
	link.find('#percentage').html(data.score);
	link.find('#school').html(data.schoolName);
	link.find('#location').html(data.location);
	link.find('#duration').attr("title",data.duration);
	link.find('#duration').html(data.minDuration);
	link.find('#scoreType').html(data.scoreType);
}

function editAcademicsSendData()
{
	var link=$('#editAcademicsModal');
	var degree=link.find('#editAcademicsModalDegree').val().trim();
	var school=link.find('#editAcademicsModalSchoolName').val().trim();
	var scoreType=link.find('#editAcademicsModalPercentageType').val().trim();
	var location=link.find('#editAcademicsModalSchoolLocation').val().trim();
	var duration=link.find('#editAcademicsModalDurationFrom').val().trim()+"-"+link.find('#editAcademicsModalDurationTo').val().trim();
	var id=link.find('#editAcademicsModalId').html();
	alert(id);
	if(scoreType==1)
	{
		var percentage=link.find('#editAcademicsModalPercentage').val().trim();
	}
	else if(scoreType==2)
	{
		var percentage=link.find('#editAcademicsModalCGPA').val().trim()+"/"+link.find('#editAcademicsModalCGPAScale').val().trim();
	}
	if(degree.length==0)
	{
		alert("We hope you have a degree name.")
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_degreeId:id,
			_degree:degree,
			_score:percentage,
			_schoolName:school,
			_scoreType:scoreType,
			_location:location,
			_duration:duration,
			_mode:3
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyAcademics(data);
				$("#editAcademicsModal").modal('hide');
			}
		});
	}
}

function deleteAcademics(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_degreeId:id,
			_mode:2
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#academics').find('#'+id).remove();
				if($('.academics').length==0)
				{
					callWhen404('Academics',$("#academics").find('#academicsContainer1'));
				}

				updateNumber('.academics',$("#academics").find('#academicsNumber'));
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

				workshop+='<div style="font-size:18px;color:#007887;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">'+data.workshopName+'</span></div>';

			workshop+='</div><!-- end class col-md-6 -->';

			if(data.isOwner==1)
			{
				workshop+='<div class="col-md-3 visibleForUser text-right col-md-offset-3">';

					workshop+='<div style="font-size:14px;"><i  onclick="editWorkshop(\''+data.workshopId+'\');" class="showOnHover fa fa-pencil"></i>&nbsp;<i  onclick="deleteWorkshop(\''+data.workshopId+'\');" class="showOnHover fa fa-trash"></i></div>';

				workshop+='</div><!-- end classc col-md-3 -->';
			}

			

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

	updateNumber('.workshop',$("#workshops").find('#workshopsNumber'));

	$("#noworkshops").remove();
}

function fetchWorkshops()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:7
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{

			if(data!=404)
			{
				x=JSON.parse(data);

				$('.workshop').remove();

				for(i=0;i<x.length;i++)
				{
					insertWorkshop(x[i]);
				}
				afterAjaxCallDisplay();
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
		$.post("/4pi/handlers/aboutHandlers/aboutMeInsert.php",{
			_workshopName:name,
			_location:location,
			_duration:duration,
			_peopleAttended:peopleNumber,
			_mode:7
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertWorkshop(data);
				$("#addWorkshopModal").modal('hide');
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_workshopId:id,
			_workshopName:name,
			_location:location,
			_duration:duration,
			_peopleAttended:attendeeNumber,
			_mode:7
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyWorkshop(data);
				$("#editWorkshopModal").modal('hide');
			}
		});
	}
}

function deleteWorkshop(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_workshopId:id,
			_mode:7
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#workshops').find('#'+id).remove();
				if($('.workshop').length==0)
				{
					callWhen404('Workshops',$("#workshops").find('#workshopContainer1'));
				}

				updateNumber('.workshop',$("#workshops").find('#workshopsNumber'));
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

				certification+='<div style="font-size:18px;color:#C03675;" class="text-left textPadding" ><i class="fa fa-certificate"></i>&nbsp;<span id="courseName">'+data.title+'</span></div>';

			certification+='</div>';

			if(data.isOwner==1)
			{
				certification+='<div class="col-md-3 visibleForUser text-right col-md-offset-2">';

					certification+='<div style="font-size:14px;" class="text-right textPadding" ><i onclick="editCertification(\''+data.courseId+'\');" class="showOnHover fa fa-pencil"></i>&nbsp;<i onclick="deleteCertification(\''+data.courseId+'\');" class="showOnHover fa fa-trash"></i></div>';

				certification+='</div>';
			}

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

	updateNumber('.certification',$("#certifications").find('#certificationsNumber'));

	$("#nocertifications").remove();
}

function fetchCertifications()
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:4
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				x=JSON.parse(data);
				$('.certification').remove();
				for(i=0;i<x.length;i++)
				{
					insertCertification(x[i]);
				}
				afterAjaxCallDisplay();
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_courseName:name,
			_institute:institute,
			_duration:duration,
			_mode:4
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertCertification(data);
				$("#addCertificationModal").modal('hide');
			}
		});
	}
}

function modifyCertification(data)
{
	var link=$('#certifications').find('#'+data.courseId);
	link.find('#courseName').html(data.title);
	link.find('#institute').html(data.institutename);
	link.find('#duration').attr("title",data.duration).html(data.minDuration);
}

function editCertificationSendData()
{
	var link=$('#editCertificationModal');
	var courseName=link.find('#editCertificationModalCourseName').val().trim();
	var institute=link.find('#editCertificationModalInstitute').val().trim();
	var duration=link.find('#editCertificationModalCertificationDurationFrom').val().trim()+"-"+link.find('#editCertificationModalCertificationDurationTo').val().trim();
	var id=link.find('#editCertificationModalId').html();
	if(courseName.length==0)
	{
		alert("Course name is compulsory.");
	}
	else
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_courseId:id,
			_courseName:courseName,
			_institute:institute,
			_duration:duration,
			_mode:4
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyCertification(data);
				$("#editCertificationModal").modal('hide');
			}
		});
	}
}

function deleteCertification(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_courseId:id,
			_mode:4
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#certifications').find('#'+id).remove();
				if($('.certification').length==0)
				{
					callWhen404('Certifications',$("#certifications").find('#certificationContainer1'));
				}

				updateNumber('.certification',$("#certifications").find('#certificationsNumber'));
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

				achievements+='<div style="font-size:18px;color:#008322;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">'+data.competition+'</span></div>';

			achievements+='</div><!-- end class col-md-6 -->';

			if(data.isOwner==1)
			{
				achievements+='<div class="col-md-3 visibleForUser text-right col-md-offset-3">';

					achievements+='<div  style="font-size:14px;"><i class="showOnHover fa fa-pencil" onclick="editAchievement(\''+data.achievementId+'\');"></i>&nbsp;<i class="showOnHover fa fa-trash" onclick="deleteAchievement(\''+data.achievementId+'\');"></i></div>';

				achievements+='</div><!-- end classc col-md-3 -->';
			}

			

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

		achievements+='<div class="row">';

			achievements+='<div class="col-md-12 text-left">';

				achievements+='<div style="font-size:14px;" id="eventDescription">'+data.description+'</div>';

			achievements+='</div>';

		achievements+='</div>';

	achievements+='</div><!-- end class achievement -->';

	var length=$("#achievements").find('.achievement').length;

	var position=length%2+1;

	$('#achievements').find('#achievementContainer'+position).append(achievements);

	updateNumber('.achievement',$("#achievements").find('#achievementsNumber'));

	$("#noachievements").remove();
}

function fetchAchievements()
{

	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:2
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				x=JSON.parse(data);

				$('.achievement').remove();

				for(i=0;i<x.length;i++)
				{
					insertAchievements(x[i]);
				}
				afterAjaxCallDisplay();
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_eventName:name,
			_location:location,
			_description:description,
			_position:position,
			_userId:userId,
			_mode:2
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				insertAchievements(data);
				$("#addAchievementModal").modal('hide');
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_achievementId:id,
			_eventName:name,
			_location:location,
			_position:position,
			_description:description,
			_userId:userId,
			_mode:2
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyAchievement(data);
				$("#editAchievementModal").modal('hide');
			}
		});
	}
}

function deleteAchievement(id)
{
	if(confirm("Do you want to delete this?"))
	{
		$.post('/4pi/handlers/aboutHandlers/aboutMeDelete.php',{
			_achievementId:id,
			_mode:3
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				$('#achievements').find('#'+id).remove();
				if($('.achievement').length==0)
				{
					callWhen404('Achievements',$("#achievements").find('#achievementContainer1'));
				}

				updateNumber('.achievement',$("#achievements").find('#achievementsNumber'));
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

function insertInterest(data,isOwner)
{
	var noOfInterests=$("#interests").find('.interest').length;
	var position=(noOfInterests%3)+1;

	var interest="";

	interest+='<div class="row interest">';

		interest+='<div class="col-md-2 visibleForUser">';

		if(isOwner==1)
		{
			interest+='<i class="showOnHover fa fa-pencil interestEdit" onclick="editInterests(this,\'edit\');"></i>';
		}

		interest+='</div>';


		interest+='<div class="col-md-8">';

			interest+='<p id="interestName">'+data+'</p>';

		interest+='</div>';

		interest+='<div class="col-md-2 visibleForUser">';

		if(isOwner==1)
		{
			interest+='<i class="showOnHover fa fa-trash interestEdit" onclick="editInterests(this,\'delete\');"></i>';
		}

		interest+='</div>';

	interest+='</div>';

	$('#interests').find("#interestsContainer"+position).append(interest);

	$("#nointerests").remove();
}

function fetchInterests(data)
{
	$.post('/4pi/handlers/aboutHandlers/aboutMe.php',{
		_userId:userId,
		_mode:10
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		//console.log(data);
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				var x=JSON.parse(data);

				$('.interest').remove();

				var interests=x.interests.split(",");

				//console.log(interests);

				for(var i=0;i<interests.length;i++)
				{
					insertInterest(interests[i],x.isOwner);
				}
				afterAjaxCallDisplay();
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
		interestArray[i]=$(this).find("#addInterestModalInterestName").val();
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
		$.post('/4pi/handlers/aboutHandlers/aboutMeInsert.php',{
			_userId:userId,
			_interests:interestArray,
			_mode:10
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				var x=data.interests.split(",");
				$("#interests").find('.interest').remove();
				if(data.message.length!=0)
				{
					alert(data.message);
				}
				for(var i=0;i<x.length;i++)
				{
					insertInterest(x[i],data.isOwner);
				}

				$("#addInterestModal").modal('hide');
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

function editInterestsSendData()
{

	var link=$("#editInterestModal");

	var interestArray=new Array();
	var i=0;

	link.find(".editInterestInputClass").each(function(){
		interestArray[i]=$(this).find("#editInterestModalInterestName").val();
		i++;
	});

	//console.log(interestArray);

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
		$.post('/4pi/handlers/aboutHandlers/aboutMeEdit.php',{
			_userId:userId,
			_interests:interestArray,
			_mode:10
		})
		.error(function(){
			alert("Server overload. Please try again. :(");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				var x=data.interests.split(",");
				if(data.message.length!=0)
				{
					alert(data.message);
				}
				if(x!="")
				{
					$("#interests").find('.interest').remove();
					for(var i=0;i<x.length;i++)
					{
						insertInterest(x[i],data.isOwner);
					}

					$("#editInterestModal").modal('hide');

					if($('.interest').length==0)
					{
						callWhen404('Interests',$("#interests").find('#interestsContainer2'));
					}
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

function leaveMessage(e)
{	
	e.preventDefault();
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
	   	 	$.post('/4pi/handlers/saveLeaveMessage.php',{
	   	 		_name:name,
	   	 		_email:email,
	   	 		_message:message,
	   	 		_userId:userIdFromURL
	   	 	})
	   	 	.error(function(){
	   	 		alert("Server overload. Please try again.");
	   	 	})
	   	 	.success(function(data){
	   	 		console.log(data);
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




