<?php 
	include('../header_adv.php');
?>
<script>

var userId="<?php echo $_GET['userId'];?>";
if(userId=="")
{
	alert("The url does not exist");
	window.location.href="/4pi";
}

</script>

<script src="aboutMe.js"></script>

<style>

	#personPicture img
	{
		border-radius:78px;
		border:1px solid #cecece;
		padding:5px;
	}

	.profileName
	{
		color:#003B93;
	}

	#personRollNumber
	{
		color:#D40000;
	}

	#personDOB
	{
		color:#125900;
	}

	#personHighestDegree
	{
		color:#710000;
	}

	#personCurrentProfession
	{
		color:#6F0052;
	}

	.modal-body
	{
		overflow-y: auto;
		max-height:450px;
	}

	.editSkillInputClass, .addSkillInputClass, .addToolInputClass, .editToolInputClass, .addInterestInputClass, .editInterestInputClass
	{
		margin-bottom:25px;
	}

	.container
	{
		background-color:white;
		padding:0px !important;
	}

	#topContent
	{
		padding:15px;
	}

	#personNameText
	{
		border-bottom:1px solid #E6E6E6;
		padding-bottom:5px;
	}

	#personDescription
	{
		border-left: 1px solid #E6E6E6;
		padding-left:15px;
	}

	.middleNavbarA
	{
		padding:14px 20px !important;
	}

	.textPadding
	{
		padding-top:5px;
		padding-bottom:5px;
	}

	.cursorPointer
	{
		pointer:cursor;
	}

	textarea
	{
		resize:none;
	}

	.project,.tool,.experience,.certification,.academics,.workshop,.achievement
	{
		padding:15px;
		cursor:pointer;
	}

	.interest,.tool
	{
		background-color:rgba(0, 0, 0, 0.05);
		padding:8px;
		padding-left:12px;
		font-size:15px;
		margin-bottom:10px;
		cursor:pointer;
	}
	.interestEdit
	{
		color:#005A89;
		padding-right:5px;
	}

	.interest:hover
	{
		background-color:rgba(220, 220, 220, 0.05);
		box-shadow: 5px 0px 0px 0px #710024 inset;
	}

	.tool:hover
	{
		background-color:rgba(220, 220, 220, 0.05);
		box-shadow: 5px 0px 0px 0px #00004D inset;
	}

	

	.project
	{
		border-bottom:1px solid #E6E6E6;
	}

	.experience,.academics,.workshop,.certification,.achievement
	{
		border-bottom:1px solid #E6E6E6;
	}

	.project:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px #176F56 inset;
	}

	.experience:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px rgba(154, 105, 170, 1) inset;
	}

	.academics:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px rgba(222, 123, 26, 1) inset;
	}

	.workshop:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px #007887 inset;
	}

	.achievement:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px #008322 inset;
	}

	.certification:hover
	{
		background-color: rgba(0,0,0,0.02);
		box-shadow: 5px 0px 0px 0px rgba(192, 54, 117, 1) inset;
	}

	.percentage
	{
		color:rgba(222, 123, 26, 1);
		/*color:white;*/
	}

	.middleNavbarA
	{
		cursor:pointer;
	}

	li:hover
	{
		background-color:black;
		height:100%;
	}
</style>

<div class="modal fade" id="editContactsModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit info</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="">Facebook link</label>

					<input type="text" id="fbURL" class="form-control">

					<br/>

					<label for="">Twitter link</label>

					<input type="text" id="twitterURL" class="form-control">

					<br/>

					<label for="">Google+ link</label>

					<input type="text" id="gplusURL" class="form-control">

					<br/>

					<label for="">Linkedin link</label>

					<input type="text" id="inURL" class="form-control">

					<br/>
					<label for="">Pinterest link</label>

					<input type="text" id="pinURL" class="form-control">

					<br/>

					<label for="">Email id</label>

					<input type="text" id="email2" class="form-control">

					<br/>

					<label for="">Address</label>

					<input type="text" id="address" class="form-control">

					<br/>

					<label for="">Contact number 1</label>

					<input type="text" id="contactNumber1" class="form-control"></input>

					<br/>

					<label for="">Contact number 2</label>

					<input type="text" id="contactNumber2" class="form-control"></input>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="editContactInfoSendData();" class="btn btn-primary">Save changes</button>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div>

<div class="modal fade" id="editPersonInfoModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit personal info</h4>

			</div>

			<div class="modal-body">

				<form id="topPartEditForm" method="post">

					<label for="personName">Name</label>

					<input type="text" id="editPersonInfoModalPersonName" class="form-control">

					<br/>

					<label for="personDOB">Date of birth</label>

					<input id="editPersonInfoModalPersonDOB" class="form-control datepicker">

					<br/>

					<!-- <label for="personHighestDegree">Highest degree</label>
					
					<input type="text" class="" id="editPersonInfoModalPersonHighestDegree" class="form-control">
					
					<br/>
					
					<label for="personCurrentProfession">Current profession</label>
					
					<input type="text" id="editPersonInfoModalPersonCurrentProfession" class="form-control">
					
					<br/> -->

					<label for="personDescription">About you</label>

					<textarea type="text" style="resize:none;" id="editPersonInfoModalPersonDescription" class="form-control"></textarea>

					<br/>

					<label for="personImage">Your image</label>

					<input type="file" accept="images/jpeg" id="editPersonInfoModalPersonImage">

					<br/>

					<label for="personResume">Your resume</label>

					<input type="file" id="editPersonInfoModalPersonResume">

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button class="btn btn-primary" onclick="editTopPartSendData();">Save changes</button>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div>

<div class="modal fade" id="editSkillModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit skill</h4>

			</div>

			<div class="modal-body">
			
				<form id="editSkillModalForm">
							
					<div class="row">

					</div>
							
					<br/>
							
				</form> 
			
			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="editSkillSendData();">Save</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editToolModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit tools</h4>

			</div>

			<div class="modal-body">
			
				<form id="editToolsModalForm">
							
					<div class="row">

					</div>
							
					<br/>
							
				</form> 
			
			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success" onclick="editToolAddInput();">Add input</button>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="editToolsSendData();">Save</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editInterestModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit interests</h4>

			</div>

			<div class="modal-body">
			
				<form id="editInterestsModalForm">
							
					<div class="row">

					</div>
							
					<br/>
							
				</form> 
			
			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success" onclick="editInterestAddInput();">Add input</button>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="editInterestsSendData();">Save</button>

			</div>

		</div>

	</div>

</div>


<script>

	$(function () {
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
            data: [
                ['Skill1', 100],
                ['Skill2', 90],
                ['Skill3', 80],
                ['Karachi', 70],
                ['Mumbai', 60],
                ['Moscow', 50],
                ['Karachi', 70]
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
		$('.middleNavbarA').each(function(){
			if($(this).attr("data-target")=="#skills")
				{
					$(this).css({'background-color':'black','color':'white'});
				}
			});

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
		/*x.find('#editPersonInfoModalPersonHighestDegree').val(ob2.find('#personHighestDegree').html());
		x.find('#editPersonInfoModalPersonCurrentProfession').val(ob2.find('#personCurrentProfession').html());*/
		x.find('#editPersonInfoModalPersonDescription').val(ob2.find('#personDescription').find('p').html());
	}

	function editContacts()
	{
		$("#editContactsModal").modal('show');

		var link=$("#editContactsModal");
		var link2=$("#bottomContent").find("#contactsContainer");
		link.find("#fbURL").val(link2.find("#facebookURL").find('a').attr("href"));
		link.find("#twitterURL").val(link2.find("#twitterURL").find('a').attr("href"));
		link.find("#gplusURL").val(link2.find("#googlePlusURL").find('a').attr("href"));
		link.find("#inURL").val(link2.find("#linkedInURL").find('a').attr("href"));
		link.find("#pinURL").val(link2.find("#pinterestURL").find('a').attr("href"));
		link.find("#email1").val(link2.find("#userEmail1").html());
		link.find("#email2").val(link2.find("#userEmail2").html());
		link.find("#address").val(link2.find("#address").html());
		link.find("#contactNumber1").val(link2.find("#userPhone1").html());
		link.find("#contactNumber2").val(link2.find("#userPhone2").html());
	}

	function addSkill()
	{
		$("#addSkillModal").modal('show');

		$("#addSkillModal").find('.extraInputs').remove();
	}

	function editSkills()
	{
		$("#editSkillModal").modal('show');

		$("#editSkillModal").find(".editSkillInputClass").remove();

		var skills=$("#skills").find("#skillNames").html();
		var percentages=$("#skills").find("#skillPercentages").html();

		var skillArray=skills.split(",");
		var percentagesArray=percentages.split(",");

		for(var i=0; i< skillArray.length; i++)
		{

			var input="";

			input+='<div class="row editSkillInputClass">';

				input+='<div class="col-md-5">';

					input+='<input type="text" id="editSkillModalSkillName" class="form-control" value="'+skillArray[i]+'">';

				input+='</div>';

				input+='<div class="col-md-5">';

					input+='<input type="number" pattern="[0-9]*" min="0" max="100" id="editSkillModalSkillPercentage" class="form-control" value="'+percentagesArray[i]+'">';

				input+='</div>';

				input+='<div class="col-md-2">';

					input+='<span class="input-group-addon" id="deleteOption">';

						input+='<i class="fa fa-close" title="Delete skill" onclick="editSkillDeleteInput(this);"></i>';

					input+='</span>';

				input+='</div>';

			input+='</div>';

			$("#editSkillModal").find('form').append(input);
		}
	}

	function addTool()
	{
		$("#addToolModal").modal('show');
		
		$("#addToolModal").find('.extraInput').remove();
	}

	function editTools(el,type)
	{
		if(type=="edit")
		{
			$("#editToolModal").modal('show');

			$("#editToolModal").find('form').find('.editToolInputClass').remove();

			var currentTool=$(el).parent().parent().find("#toolName").html();

			var toolArray=new Array();
			var i=0;

			$("#tools").find('.tool').each(function(){
				toolArray[i]=$(this).find("#toolName").html();
				i++;
			});

			for(var i=0;i<toolArray.length;i++)
			{
				var input="";

				if(toolArray[i]==currentTool)
				{
					input+='<div class="row editToolInputClass">';
				}
				else
				{
					input+='<div class="row hidden editToolInputClass">';
				}

					input+='<div class="col-md-10">';

						input+='<input type="text" id="editToolModalToolName" class="form-control" value="'+toolArray[i]+'">';

					input+='</div>';

					input+='<div class="col-md-2">';

						input+='<span class="input-group-addon hidden" id="deleteOption">';

							input+='<i class="fa fa-close" title="Delete tool" onclick="editToolDeleteInput(this);"></i>';

						input+='</span>';

					input+='</div>';

				input+='</div>';

				$("#editToolModal").find('form').append(input);

			}
		}

		else
		{
			if(confirm("Do you want to delete this tool?"))
			{
				// $("#editToolModal").modal('show');

				$("#editToolModal").find('form').find('.editToolInputClass').remove();

				var currentTool=$(el).parent().parent().find("#toolName").html();

				var toolArray=new Array();
				var i=0;

				$("#tools").find('.tool').each(function(){
					toolArray[i]=$(this).find("#toolName").html();
					i++;
				});

				for(var i=0;i<toolArray.length;i++)
				{
					var input="";

					if(toolArray[i]!=currentTool)
					{
						input+='<div class="row editToolInputClass">';

						input+='<div class="col-md-10">';

							input+='<input type="text" id="editToolModalToolName" class="form-control" value="'+toolArray[i]+'">';

						input+='</div>';

						input+='<div class="col-md-2">';

							input+='<span class="input-group-addon hidden" id="deleteOption">';

								input+='<i class="fa fa-close" title="Delete tool" onclick="editToolDeleteInput(this);"></i>';

							input+='</span>';

						input+='</div>';

					input+='</div>';

					$("#editToolModal").find('form').append(input);
				}

				}
			}
			
		}
	
	}

	function addProject()
	{
		$('#addProjectModal').modal('show');
	}

	function editProject(n)
	{
		$('#editProjectModal').modal('show');

		var x=$('#editProjectModal');
		var y=$('#'+n);
		x.find('#editProjectModalProjectId').val(n);
		x.find('#editProjectModalProjectTitle').val(y.find('#projectTitle').html());
		x.find('#editProjectModalProjectTeam').val(y.find('#projectTeam').html());
		var z=y.find('#projectDuration').attr("title");
		var xz=z.split("-");
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
		var y=$('#'+n);
		x.find('#editExperienceModalCompanyName').val(y.find('#company').html());
		x.find('#editExperienceModalRole').val(y.find('#role').html());
		var z=y.find('#duration').attr("title");
		var xz=z.split("-");
		x.find('#editExperienceModalDurationFrom').val(xz[0]);
		x.find('#editExperienceModalDurationTo').val(xz[1]);
		x.find('#experienceId').val(n);
		x.find('#editExperienceModalFeature').val(y.find("#featuring").html());
	}

	function addCertification()
	{
		$('#addCertificationModal').modal('show');
	}

	function editCertification(n)
	{
		$('#editCertificationModal').modal('show');

		var x=$('#editCertificationModal');
		var y=$('#'+n);
		x.find('#editCertificationModalCourseName').val(y.find('#courseName').html());
		x.find('#editCertificationModalInstitute').val(y.find('#institute').html());
		var z=y.find('#duration').attr("title").split("-");
		console.log(z);
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
		var y=$('#'+n);
		x.find('#editAcademicsModalDegree').val(y.find('#degree').html());
		x.find('#editAcademicsModalPercentage').val(y.find('#percentage').html());
		x.find('#editAcademicsModalSchoolName').val(y.find('#school').html());
		var z=y.find('#duration').attr("title").split("-");
		x.find('#editAcademicsModalDurationFrom').val(z[0]);
		x.find('#editAcademicsModalDurationTo').val(z[1]);
		x.find('#editAcademicsModalSchoolLocation').val(y.find('#location').html());
		x.find('#editAcademicsModalId').val(n);
		x.find("#editAcademicsModalPercentageType").val(y.find("#scoreType").html());
	}

	function addWorkshop()
	{
		$('#addWorkshopModal').modal('show');
	}

	function editWorkshop(n)
	{
		$('#editWorkshopModal').modal('show');

		var x=$('#editWorkshopModal');
		var y=$('#'+n);
		x.find('#editWorkshopModalWorkshopName').val(y.find('#workshopName').html());
		x.find('#editWorkshopModalWorkshopLocation').val(y.find('#workshopLocation').html());
		var z=y.find('#workshopDuration').attr("title").split("-");
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
		var y=$('#'+n);
		x.find('#editAchievementModalEventName').val(y.find('#eventName').html());
		x.find('#editAchievementModalLocation').val(y.find('#eventLocation').html());
		x.find('#editAchievementModalPosition').val(y.find('#eventPosition').html());
		x.find('#editAchievementModalDescription').val(y.find('#eventDescription').html());
	}

	function addInterest()
	{
		$("#addInterestModal").modal('show');

		$("#addInterestModal").find(".extraInput").remove();
	}

	function editInterests(el,type)
	{	

		var currentInterest=$(el).parent().parent().find("#interestName").html();

		if(type=="edit")
		{
			$("#editInterestModal").modal('show');

			$("#editInterestModal").find('form').find('.editInterestInputClass').remove();

			var interestsArray=new Array();
			var i=0;

			$("#interests").find('.interest').each(function(){
				interestsArray[i]=$(this).find("#interestName").html();
				i++;
			});

			for(var i=0;i<interestsArray.length;i++)
			{
				var input="";

				if(interestsArray[i]==currentInterest)
				{
					input+='<div class="row editInterestInputClass">';
				}

				else
				{
					input+='<div class="row hidden editInterestInputClass">';
				}

					input+='<div class="col-md-10">';

						input+='<input type="text" id="editInterestModalInterestName" class="form-control" value="'+interestsArray[i]+'">';

					input+='</div>';

					input+='<div class="col-md-2">';

						input+='<span class="input-group-addon hidden" id="deleteOption">';

							input+='<i class="fa fa-close" title="Delete tool" onclick="editInterestDeleteInput(this);"></i>';

						input+='</span>';

					input+='</div>';

				input+='</div>';

				$("#editInterestModal").find('form').append(input);

			}
		}

		else
		{
			if(confirm("Do you want to delete this interest?"))
			{
				$("#editInterestModal").find('form').find('.editInterestInputClass').remove();

				var interestsArray=new Array();
				var i=0;

				$("#interests").find('.interest').each(function(){
					interestsArray[i]=$(this).find("#interestName").html();
					i++;
				});

				for(var i=0;i<interestsArray.length;i++)
				{
					var input="";

					if(interestsArray[i]!=currentInterest)
					{
						input+='<div class="row editInterestInputClass">';

							input+='<div class="col-md-10">';

								input+='<input type="text" id="editInterestModalInterestName" class="form-control" value="'+interestsArray[i]+'">';

							input+='</div>';

							input+='<div class="col-md-2">';

								input+='<span class="input-group-addon hidden" id="deleteOption">';

									input+='<i class="fa fa-close" title="Delete tool" onclick="editInterestDeleteInput(this);"></i>';

								input+='</span>';

							input+='</div>';

						input+='</div>';

						$("#editInterestModal").find('form').append(input);
					}

					

				}
			}

			
		}
	}


</script>

<body style="padding-top:0px;">

	<?php
		include('../topBar.php');
	?>

	<div class="container">
		
		<div id="entireContent">

			<div class="row" id="topContent">

				<div class="col-md-2" id="personPicture">

					<a href="#" class=""><img src="../img/hpics/1.jpg"  alt="Avinash Kadimisetty" class="img-responsive"/></a><br/>

					<h4 class="text-center" id="personRollNumber">COE12B009</h4>

				</div><!-- end id personPicture -->

				<div class="col-md-10" id="personInfo">
					
					<div class="row" id="personName">

						<div class="col-md-11">

							<h3 id="personNameText">Avinash Kadimisetty</h3><br/>

						</div>

						<div class="col-md-1 text-right">

							<i class="fa fa-pencil" title="Edit" onclick="editPersonInfo();"></i>

						</div>

					</div><!-- end id person name -->

					<div class="row" id="personDetails">

						<div class="col-md-3">

							<div class="text-left" id="personDOB">14-05-1995</div><br/>

							<div class="text-left" id="personHighestDegree">B.Tech, Computer Engineering</div><br/>

							<div class="text-left" id="personCurrentProfession">CEO, Apple Inc. </div><br/>

							<div class="text-left" id="personResumeLink">

								<a href="link.pdf"><button class="btn btn-primary">Find my resume&nbsp;&nbsp;<i class="fa fa-external-link"></i></button></a>

							</div><!-- end person resume link id -->

						</div>

						<div class="col-md-9" id="personDescription">

							<p style="text-align:justify;line-height:22px;">I think it's important to always keep professional and surround yourself with good people, work hard, and be nice to everyone. A professional is someone who can do his best work when he doesn't feel like it. I know I'm a good professional, I know that no one's harder on me than myself and that's never going to change, under any circumstances. All I do, really, is go to work and try to be professional, be on time and be prepared.A professional is someone who can do his best work when he doesn't feel like it. I know I'm a good professional, I know that no one's harder on me than myself and that's never going to change, under any circumstances. All I do, really, is go to work and try to be professional, be on time and be prepared.</p>

						</div><!-- end class col-md-8 -->

					</div><!-- end person details id -->


				</div>

			</div> <!-- end id topContent -->

			<div class="row" id="middleContent">
		
				<nav class="navbar navbar-inverse middleNavBar" style="border-radius:0px;padding:0px;" role="navigation">
					
					<div class="collapse navbar-collapse">
						
						<ul class="nav navbar-nav" style="padding:0px;">
						
							<li><a class="middleNavbarA" data-target="#skills"><i class="fa fa-bar-chart"></i> &nbsp; Skills</a></li>
						
							<li><a class="middleNavbarA" data-target="#tools"><i class="fa fa-wrench"></i> &nbsp; Tools</a></li>
							
							<li><a class="middleNavbarA" data-target="#projects"><i class="fa fa-database"></i> &nbsp; Projects</a></li>
							
							<li><a class="middleNavbarA" data-target="#experiences"><i class="fa fa-fighter-jet"></i> &nbsp; Experience</a></li>
							
							<li><a class="middleNavbarA" data-target="#academics"><i class="fa fa-mortar-board"></i> &nbsp; Academics</a></li>
							
							<li><a class="middleNavbarA" data-target="#workshops"><i class="fa fa-gears"></i> &nbsp; Workshops</a></li>
							
							<li><a class="middleNavbarA" data-target="#certifications"><i class="fa fa-certificate"></i> &nbsp; Certifications</a></li>
							
							<li><a class="middleNavbarA" data-target="#achievements"><i class="fa fa-trophy"></i> &nbsp; Achievements</a></li>
							
							<li><a class="middleNavbarA" data-target="#interests"><i class="fa fa-star"></i> &nbsp; Interests</a></li>
							
							<!-- <li><a class="middleNavbarA"  data-target="#contact"><i class="fa fa-envelope"></i> &nbsp; Contact</a></li> -->

						</ul>
					
					</div><!-- end class navbar-collapse -->
					
				</nav>

				<div class="navObject" id="skills">

					<div class="row">

						<div class="col-md-2 text-left">

							<h3 style="color:#6F0052"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Skills</h3>

						</div>

						<div class="col-md-2 visibleForUser col-md-offset-8 text-right">

							<button class="btn btn-sm btn-success" onclick="addSkill();"><i class="fa fa-plus"></i></button>&nbsp;&nbsp;<button class="btn btn-sm btn-primary" onclick="editSkills();"><i class="fa fa-pencil"></i></button>

						</div>

					</div>

					<div id="skillNames" class="hidden">Animals,Fruits,Humans,Trees,Nature</div>

					<div id="skillPercentages" class="hidden">20,30,40,50,60</div>

					<div class="row" id="skillData">


					</div>

				</div><!-- end id skills -->

				<div class="navObject" id="tools">
				
					<div class="row" id="toolsetHeading">
				
						<div class="col-md-2">
				
							<h3 class="text-center" style="color:#00004D;"><i class="fa fa-wrench"></i>&nbsp; Tool set</h3>
				
						</div>
				
						<div class="col-md-1 visibleForUser col-md-offset-9">
				
							<a class="cursorPointer" onclick="addTool();"><h5 class="text-center"><i class="fa fa-plus" ></i>&nbsp; Add </h5></a>
				
						</div>

					</div>

					<br/>
				
					<div class="row" id="toolContent">
				
						<div class="col-md-4 text-center" id="toolsColumn1">

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>
				
						</div>

						<div class="col-md-4 text-center" id="toolsColumn2">

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>
				
						</div>

						<div class="col-md-4 text-center" id="toolsColumn3">

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>

							<div class="row tool">

								<div class="col-md-2 text-center">

									<i class="fa fa-pencil" onclick="editTools();"></i>

								</div>

								<div class="col-md-8 text-center">

									<p id="toolName">Tool 1</p>

								</div>

								<div class="col-md-2 text-center">

									<i class="fa fa-close" onclick="deleteTool(this);"></i>

								</div>

							</div>
				
						</div>
				
					</div>
				
				</div>

				<div class="navObject" id="projects">

					<div class="row">

						<div class="col-md-4 text-left">

							<h3 style="color:#176F56;"><i class="fa fa-database"></i>&nbsp;Projects</h3>

						</div>

						<div class="col-md-2 visibleForUser text-right col-md-offset-6">
		
							<button  onclick="addProject();" class="btn btn-success"> <span class="cursorPointer"><i class="fa fa-plus"></i>&nbsp;Add</span></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-12" id="projectContainer">

							<div class="row project" id="project1">

								<div class="row">

									<div class="col-md-5 text-left">

										<h4 class="textPadding" style="font-weight:bold;" id="projectTitle">Project title 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-4 text-left">

										<h4 class="textPadding"  id="projectCompany">Project Company 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-3 text-right">
										
										<h5 class="textPadding"><i onclick="editProject(1);" class="fa fa-pencil"></i>&nbsp;<span id="projectDuration">Jun-July,2014</span></h5>

									</div><!-- end class col-md- 3 -->


								</div><!-- end class row -->

								<div class="row">
									
									<div class="col-md-3 text-left">

										<h5 class="textPadding" id="projectRole">Lead Developer 1</h5>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-9 text-right">

										<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">Avinash,Hari,Sai Kumar</span></h5>

									</div><!-- end class col-md- 3 -->

								</div><!-- end class row -->

								<div class="row">

									<p class="text-center" style="text-align:justify;" id="projectDescription">1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>

								</div><!-- end class row -->

							</div>

							<div class="row project" id="project2">

								<div class="row">

									<div class="col-md-5 text-left">

										<h4 class="textPadding" style="font-weight:bold;" id="projectTitle">Project title 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-4 text-left">

										<h4 class="textPadding"  id="projectCompany">Project Company 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-3 text-right">
										
										<h5 class="textPadding"><i onclick="editProject(1);" class="fa fa-pencil"></i>&nbsp;<span id="projectDuration">Jun-July,2014</span></h5>

									</div><!-- end class col-md- 3 -->


								</div><!-- end class row -->

								<div class="row">
									
									<div class="col-md-3 text-left">

										<h5 class="textPadding" id="projectRole">Lead Developer 1</h5>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-9 text-right">

										<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">Avinash,Hari,Sai Kumar</span></h5>

									</div><!-- end class col-md- 3 -->

								</div><!-- end class row -->

								<div class="row">

									<p class="text-center" style="text-align:justify;" id="projectDescription">1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>

								</div><!-- end class row -->

							</div>

							<div class="row project" id="project3">

								<div class="row">

									<div class="col-md-5 text-left">

										<h4 class="textPadding" style="font-weight:bold;" id="projectTitle">Project title 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-4 text-left">

										<h4 class="textPadding"  id="projectCompany">Project Company 1</h4>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-3 text-right">
										
										<h5 class="textPadding"><i onclick="editProject(1);" class="fa fa-pencil"></i>&nbsp;<span id="projectDuration">Jun-July,2014</span></h5>

									</div><!-- end class col-md- 3 -->


								</div><!-- end class row -->

								<div class="row">
									
									<div class="col-md-3 text-left">

										<h5 class="textPadding" id="projectRole">Lead Developer 1</h5>

									</div><!-- end class col-md- 3 -->

									<div class="col-md-9 text-right">

										<h5 class="textPadding" ><b>Team: </b><span id="projectTeam">Avinash,Hari,Sai Kumar</span></h5>

									</div><!-- end class col-md- 3 -->

								</div><!-- end class row -->

								<div class="row">

									<p class="text-center" style="text-align:justify;" id="projectDescription">1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>

								</div><!-- end class row -->

							</div>

						</div><!-- end class col-md-12 -->


					</div><!-- end class row -->

				</div><!-- end id projects -->

				<div class="navObject" id="experiences">

					<div class="row">

						<div class="col-md-5">

							<h3  style="color:rgba(154, 105, 170, 1);" class="text-left"><i class="fa fa-fighter-jet"></i>&nbsp;Experience</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-success" onclick="addExperience();"> <h5><i class="fa fa-plus"></i>Add</h5></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="experienceContainer1">

							<div class="row experience" id="experience1">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(1);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience2">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(2);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience3">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(3);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience4">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(4);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

						</div><!-- end class col-md- 6 -->

						<div class="col-md-6" id="experienceContainer2">

							<div class="row experience" id="experience5">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(5);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience6">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(6);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience7">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(7);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

							<div class="row experience" id="experience8">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-suitcase"></i>&nbsp;<span id="company">Company/Organisation</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editExperience(8);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left" id="role">Role/Position</div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>



							</div><!-- end class experience -->

						</div><!-- end class col-md- 6 -->

					</div><!-- end class row -->

				</div><!-- end id experience -->

				<div class="navObject" id="academics">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:rgba(222, 123, 26, 1);" class="text-left"><i class="fa fa-mortar-board"></i>&nbsp;Academics</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-success"  onclick="addAcademics();"><h5><i class="fa fa-plus"></i>Add</h5>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="academicsContainer1">

							<div class="row academics" id="academics1">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(1);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics2">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(2);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics3">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(3);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics4">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(4);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

						</div>

						<div class="col-md-6" id="academicsContainer2">

							<div class="row academics" id="academics5">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(5);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics6">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(6);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics7">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(7);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

							<div class="row academics" id="academics8">

								<div class="row">

									<div class="col-md-4 text-left">

										<div style="font-size:18px;" id="degree">Degree</div>

									</div>

									<div class="col-md-2 col-md-offset-6 text-center">

										<div style="font-size:16px;" class="percentage" id="percentage">98%</div>

									</div>

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-4 text-left">

										<em><div style="font-size:14px;" id="school">School name</div></em>

									</div>

									<div class="col-md-4 col-md-offset-4 text-right">

										<div style="font-size:14px;" id="duration">Jun2014-Jul2015</div>

									</div>

								</div><!-- end class row -->

								<div class="row">

									<div class="col-md-8 text-left">

										<div style="font-size:14px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="location">Location</span></div>

									</div><!--end class col-md-8 -->

									<div class="col-md-4 text-right">

										<div onclick="editAcademics(8);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!--end class col-md-8 -->

								</div><!-- end class row -->


							</div><!-- end class academics -->

						</div>


					</div><!-- end class row-->					

				</div><!-- end id academics -->

				<div class="navObject" id="workshops">

					<div class="row">

						<div class="col-md-5">

							<h3  style="color:#007887;" class="text-left"><i class="fa fa-gears"></i>&nbsp;Workshops</h3>

						</div>

						<div class="col-md-3  visibleForUser text-right col-md-offset-4">
		
							<button  onclick="addWorkshop();" class="btn btn-success"><h5><i class="fa fa-plus"></i>&nbsp;Add</h5></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="workshopContainer1">

							<div class="row workshop" id="workshop1">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(1);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop2">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(2);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop3">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(3);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop4">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(4);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

						</div>

						<div class="col-md-6" id="workshopContainer2">

							<div class="row workshop" id="workshop5">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(5);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop6">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(6);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop7">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(7);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

							<div class="row workshop" id="workshop8">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-gear"></i>&nbsp;<span id="workshopName">Workshop</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editWorkshop(8);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="workshopLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="workshopDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<div class="col-md-6 text-left">

									<em><div style="font-size:14px;"><span id="attenderNumber">333</span>&nbsp; people attended</div></em>

								</div>

							</div><!-- end class workshop -->

						</div>

					</div><!-- end class row -->

				</div><!-- end id workshops -->

				<div class="navObject" id="certifications">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:rgba(192, 54, 117, 1);" class="text-left"><i class="fa fa-certificate"></i>&nbsp;Certifications</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-success"  onclick="addCertification();"> <h5><i class="fa fa-plus"></i>Add</h5></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="certificationContainer1">

							<div class="row certification" id="certification1">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(1);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" title="22/07/2014-25/08/2014" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

							<div class="row certification" id="certification2">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(2);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

							<div class="row certification" id="certification3">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(3);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

						</div>

						<div class="col-md-6" id="certificationContainer2">

							<div class="row certification" id="certification4">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(4);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

							<div class="row certification" id="certification5">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(5);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

							<div class="row certification" id="certification6">

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:18px;" class="text-left textPadding" ><i class="fa fa-chevron-right"></i>&nbsp;<span id="courseName">Course Name</span></div>

									</div>

									<div class="col-md-3 text-right col-md-offset-2">
	
										<div style="font-size:14px;" class="text-right textPadding" onclick="editCertification(6);"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div>

								</div>

								<br/>

								<div class="row">

									<div class="text-left col-md-7">
	
										<div style="font-size:16px;" class="text-left"<i class="fa fa-map-marker"></i>&nbsp;<span id="institute">Institute</span></div>

									</div>

									<div class="col-md-5">
	
										<div style="font-size:16px;" class="text-right" id="duration">Duration</div>

									</div>

								</div>

							</div><!-- end class certification -->

						</div>

					</div>

				</div><!-- end id certifications -->

				<div class="navObject" id="achievements">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:#008322;" class="text-left"><i class="fa fa-trophy"></i>&nbsp;Achievements</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-success"  onclick="addAchievement();"> <h5><i class="fa fa-plus"></i>&nbsp;Add</h5></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="achievementContainer1">

							<div class="row achievement" id="achievement1">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(1);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

							<div class="row achievement" id="achievement2">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(2);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

							<div class="row achievement" id="achievement3">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(3);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

						</div><!-- end class col-md-6 -->

						<div class="col-md-6" id="achievementContainer2">

							<div class="row achievement" id="achievement4">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(4);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

							<div class="row achievement" id="achievement5">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(5);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

							<div class="row achievement" id="achievement6">

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:18px;"><i class="fa fa-trophy"></i>&nbsp;<span id="eventName">Event name</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-3 text-right col-md-offset-3">

										<div onclick="editAchievement(6);" style="font-size:14px;"><i class="fa fa-pencil"></i>&nbsp;Edit</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="row">

									<div class="col-md-6 text-left">

										<div style="font-size:15px;"><i class="fa fa-map-marker"></i>&nbsp;<span id="eventLocation">Location</span></div>

									</div><!-- end class col-md-6 -->

									<div class="col-md-4 text-right col-md-offset-2">

										<div style="font-size:15px;" id="eventDuration">Duration</div>

									</div><!-- end classc col-md-3 -->

								</div><!-- end class row -->

								<br/>

								<div class="col-md-6 text-left">

									<div style="font-size:14px;" id="eventDescription">Description</div>

								</div>

							</div><!-- end class achievement -->

						</div><!-- end class col-md-6 -->

					</div>

				</div><!-- end id achievements -->

				<div class="navObject" id="interests">

					<div class="container">

						<div class="row">

							<div class="col-md-2 text-left">

								<h3 style="color:#710024"><i class="fa fa-star"></i>&nbsp;&nbsp;Interests</h3>

							</div>

							<div class="col-md-2 visibleForUser col-md-offset-8 text-right">

								<button class="btn btn-md btn-success" onclick="addInterest();"><i class="fa fa-plus"></i>&nbsp;Add</button>

							</div>

						</div>

						<br/>

						<div class="row">

							<div class="col-md-4 text-left" id="interestsContainer1">

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

							</div>

							<div class="col-md-4 text-left" id="interestsContainer2">

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

							</div>

							<div class="col-md-4 text-left" id="interestsContainer3">

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

								<div class="row interest">

									<div class="col-md-2">

										<i class="fa fa-pencil interestEdit" onclick="editInterests();"></i>
	
									</div>


									<div class="col-md-10">

										<p id="interestName">Interest1</p>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div><!-- end id interests -->

			</div><!-- end id middle content -->

			<br/>

			<div class="row" id="bottomContent" style="border-top:4px solid rgba(192, 54, 117, 1);">

				<br/>

				<div id="contact">

					<div class="row">

						<div class="col-md-5" id="leaveMessageForm" style="border-right:1px solid #E6E6E6;">

							<div class="row">

								<h4 style="color:rgba(3, 184, 206, 1) ;"><i class="fa fa-envelope"></i>&nbsp;Leave a message</h4>

							</div>

							<br/>

							<form>

								<input type="text" id="leaveMessageName" class="form-control" placeholder="Your name" required><br/>

								<input type="email" id="leaveMessageEmail" class="form-control" placeholder="Your email. It will not be disclosed." required><br/>

								<textarea type="text" id="leaveMessageTextMessage" class="form-control" placeholder="Your message" required></textarea><br/>

								<button class="btn btn-primary" onclick="leaveMessage();">Send</button>


							</form>


						</div><!-- end class col-md-6 -->

						<div class="col-md-6 col-md-offset-1" id="contactsContainer">

							<div class="row">
	
								<h4 style="color:rgba(222, 123, 26, 1);"><i class="fa fa-share-alt"></i>&nbsp;Lets get connected</h4>

								<i onclick="editContacts();" class="fa fa-pencil text-right"></i>

							</div>

							<br/>

							<div class="row" >
								
								<div class="col-md-2" id="facebookURL">
									<a href="#" class="icon-button facebook" ><i class="fa fa-facebook" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2" id="twitterURL">
									<a href="#"  class="icon-button twitter"><i class="fa fa-twitter" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2" id="googlePlusURL">
									<a href="#" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2" id="linkedInURL">
									<a href="#" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2" id="pinterestURL">
									<a href="#" class="icon-button pinterest"><i class="fa fa-pinterest" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>

							</div>

							<br/>

							<div class="row">

								<div class="text-left col-md-4">

									<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-envelope"></i>&nbsp;Emails</h4>

									<br/>

									<p id="userEmail1">kavinash366@gmail.com</p>

									<p id="userEmail2">COE12B009@iiitdm.ac.in</p>

								</div>

								<div class="text-left col-md-4">

									<h4 style="color:rgba(80, 183, 154, 1);"><i class="fa fa-map-marker"></i>&nbsp;Address</h4>

									<br/>

									<p id="address">IIITD&M Kancheepuram, Chennai, Tamil Nadu</p>

								</div>

								<div class="text-left col-md-4">

									<h4 style="color:rgba(192, 54, 117, 1);"><i class="fa fa-mobile-phone"></i>&nbsp;Contact</h4>

									<br/>

									<p id="userPhone1">+91-729-910-2491</p>

									<p id="userPhone2">+91-812-542-0661</p>

								</div>


							</div>

						</div><!-- end class col-md-6 -->

					</div><!-- end class row -->

				</div><!--end id contact -->

			</div><!-- end id bottom content -->

		</div><!-- end id entireContent-->

	</div><!-- end class container -->

</body>



<div class="modal fade" id="addSkillModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add skill</h4>

			</div>

			<div class="modal-body">

				<form>

					<div class="row addSkillInputClass">

						<div class="col-md-5">

							<input type="text" id="addSkillModalSkillName" class="form-control">

						</div>

						<div class="col-md-5">

							<input type="range" min="0" style="border:none;" max="100" id="addSkillModalSkillPercentage" onchange="showValueForSlider(this);" class="form-control"><span id="sliderValueAddModal"></span>

						</div>

						<div class="col-md-2">

			    			<span style="cursor:pointer;" class="input-group-addon" onclick="addSkillAddInput();" id="addOption">

								<i class="fa fa-plus" ></i>

			    			</span>

						</div>

					</div>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="addSkillSendData();">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addToolModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add tool</h4>

			</div>

			<div class="modal-body">

				<form>

					<div class="row addToolInputClass">

						<div class="col-md-10">

							<input type="text" placeholder="Tool name" id="addToolModalToolText" class="form-control">

						</div>

						<div class="col-md-2 hidden">

							<span style="cursor:pointer;" class="input-group-addon" onclick="addToolAddInput();" id="addOption">

								<i class="fa fa-plus" ></i>

			    			</span>

						</div>

					</div>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success" onclick="addToolAddInput();">Add input</button>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="addToolsSendData();">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addProjectModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add Project</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="projectTitle">Project title</label>

					<input type="text" id="addProjectModalProjectTitle" class="form-control">

					<br/>

					<label for="projectTitle">Project team</label>

					<input type="text" id="addProjectModalProjectTeam" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="projectDuration">Project Duration From</label>

							<input type="text" id="addProjectModalProjectDurationFrom" class="datepicker form-control">

						</div>

						<div class="col-md-6">

							<label for="projectDuration">Project Duration To</label>

							<input type="text" id="addProjectModalProjectDurationTo" class="datepicker form-control">

						</div>

					</div>

					<br/>

					<label for="projectRole">Position</label>

					<input type="text" id="addProjectModalProjectRole" class="form-control">

					<br/>

					<label for="projectCompany">Company</label>

					<input type="text" id="addProjectModalProjectCompany" class="form-control">

					<br/>

					<label for="projectDescription">Project description</label>

					<textarea type="text" id="addProjectModalProjectDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addProjectSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editProjectModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit Project</h4>

			</div>

			<div class="modal-body">

				<form>

					<input type="text" id="#editProjectModalProjectId" class="hidden">

					<label for="projectTitle">Project title</label>

					<input type="text" id="editProjectModalProjectTitle" class="form-control">

					<br/>

					<label for="projectTitle">Project team</label>

					<input type="text" id="editProjectModalProjectTeam" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="projectDuration">From</label>

							<input type="text" id="editProjectModalProjectDurationFrom" class="datepicker form-control">

						</div>

						<div class="col-md-6">

							<label for="projectDuration">To</label>

							<input type="text" id="editProjectModalProjectDurationTo" class="datepicker form-control">

						</div>

					</div>

					<br/>

					<label for="projectRole">Position</label>

					<input type="text" id="editProjectModalProjectRole" class="form-control">

					<br/>

					<label for="projectCompany">Company</label>

					<input type="text" id="editProjectModalProjectCompany" class="form-control">

					<br/>

					<label for="projectDescription">Project description</label>

					<textarea type="text" id="editProjectModalProjectDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="editProjectSendData();" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addExperienceModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add experience</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="companyName">Company/organisation</label>

					<input type="text" id="addExperienceModalCompanyName" class="form-control">

					<br/>

					<label for="experienceRole">Role/position</label>

					<input type="text" id="addExperienceModalRole" class="form-control">

					<br/>

					<label for="experienceFeaturing">Feature in the personal info?</label>

					<div class="row">

						<div class="col-md-6">

							<label>

								No&nbsp;&nbsp;<input type="radio" id="addExperienceModalFeature" value="0" class="form-control">

							</label>

						</div>

						<div class="col-md-6">

							<label>

								Yes&nbsp;&nbsp;<input type="radio" id="addExperienceModalFeature" value="1" class="form-control">

							</label>

						</div>

					</div>

					<br/>

					<div class="col-md-6">

						<label for="experienceDuration">From</label>

						<input type="text" id="addExperienceModalDurationFrom" class="datepicker form-control">

					</div>

					<div class="col-md-6">

						<label for="experienceDuration">To</label>

						<input type="text" id="addExperienceModalDurationTo" class="datepicker form-control">

					</div>

					<br/>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addExperienceSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editExperienceModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit experience</h4>

			</div>

			<div class="hidden" id="experienceId"></div>

			<div class="modal-body">

				<form>

					<label for="companyName">Company/organisation</label>

					<input type="text" id="editExperienceModalCompanyName" class="form-control">

					<br/>

					<label for="experienceRole">Role/position</label>

					<input type="text" id="editExperienceModalRole" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label>

								No&nbsp;&nbsp;<input type="radio" id="editExperienceModalFeature" value="0" class="form-control">

							</label>

						</div>

						<div class="col-md-6">

							<label>

								Yes&nbsp;&nbsp;<input type="radio" id="editExperienceModalFeature" value="1" class="form-control">

							</label>

						</div>

					</div>

					<div class="row">

						<div class="col-md-6">

							<label for="experienceDurationHours">From</label>

							<input type="text" id="editExperienceModalDurationFrom" class="form-control datepicker">

						</div>

						<div class="col-md-6">

							<label for="experienceDurationMin">To</label>

							<input type="text" id="editExperienceModalDurationTo" class="form-control datepicker">

						</div>

					</div>

					<br/>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addAcademicsModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;Add institution</h4>

			</div>



			<div class="modal-body">

				<form>

					<label for="degree">Degree</label>

					<input type="text" id="addAcademicsModalDegree" class="form-control">

					<br/>

					<label for="percentage">Score</label>

					<input type="text" id="addAcademicsModalPercentage" class="form-control">

					<br/>

					<label for="percentageType">Score type</label>

					<select id="addAcademicsModalPercentageType" class="form-control">
	
						<option value="1">Percentage</option>

						<option value="2">CGPA on 10</option>

						<option value="3">CGPA on 4</option>

					</select>

					<br/>

					<label for="schoolName">School/Institution name</label>

					<input type="text" id="addAcademicsModalSchoolName" class="form-control">

					<br/>

					<label for="location">Location</label>

					<input type="text" id="addAcademicsModalSchoolLocation" class="form-control">

					<br/>

					<div class="col-md-6">

						<label for="duration">From</label>

						<input type="text" id="addAcademicsModalDurationFrom" class="datepicker form-control datepicker">

					</div>

					<div class="col-md-6">

						<label for="duration">To</label>

						<input type="text" id="addAcademicsModalDurationTo" class="datepicker form-control datepicker">

					</div>

					<br/>
					<br/>

					

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addAcademicsSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editAcademicsModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;Edit institution</h4>

			</div>

			<div class="hidden" id="editAcademicsModalId"></div>

			<div class="modal-body">

				<form>

					<label for="degree">Degree</label>

					<input type="text" id="editAcademicsModalDegree" class="form-control">

					<br/>

					<label for="percentage">Percentage/CGPA</label>

					<input type="text" id="editAcademicsModalPercentage" class="form-control">

					<br/>

					<label for="percentageType">Score type</label>

					<select id="editAcademicsModalPercentageType" class="form-control">
	
						<option value="1">Percentage</option>

						<option value="2">CGPA on 10</option>

						<option value="3">CGPA on 4</option>

					</select>

					<br/>

					<label for="schoolName">School/Institution name</label>

					<input type="text" id="editAcademicsModalSchoolName" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="duration">From</label>

							<input type="text" id="editAcademicsModalDurationFrom" class="form-control datepicker">

							<br/>

						</div>

						<div class="col-md-6">

							<label for="duration">To</label>

							<input type="text" id="editAcademicsModalDurationTo" class="form-control datepicker">

							<br/>

						</div>

					</div>

					<label for="location">Location</label>

					<input type="text" id="editAcademicsModalSchoolLocation" class="form-control">

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addWorkshopModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;Add workshop</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="workshopName">Workshop name</label>

					<input type="text" id="addWorkshopModalWorkshopName" class="form-control">

					<br/>

					<label for="location">Location</label>

					<input type="text" id="addWorkshopModalWorkshopLocation" class="form-control">

					<br/>

					<div class="col-md-6">

						<label for="duration">From</label>

						<input type="text" id="addWorkshopModalWorkshopDurationFrom" class="form-control datepicker">

					</div>
					
					<div class="col-md-6">

						<label for="duration">To</label>

						<input type="text" id="addWorkshopModalWorkshopDurationTo" class="form-control datepicker">

					</div>

					<br/>

					<label for="number">Number of people attended</label>

					<input type="text" id="addWorkshopModalWorkshopPeopleNumber" class="form-control">

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addWorkshopSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editWorkshopModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;Editworkshop</h4>

			</div>

			<div class="hidden" id="editWorkshopModalId"></div>

			<div class="modal-body">

				<form>

					<label for="workshopName">Workshop name</label>

					<input type="text" id="editWorkshopModalWorkshopName" class="form-control">

					<br/>

					<label for="location">Location</label>

					<input type="text" id="editWorkshopModalWorkshopLocation" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="duration">From</label>

							<input type="text" id="editWorkshopModalWorkshopDurationFrom" class="form-control datepicker">

							<br/>

						</div>

						<div class="col-md-6">

							<label for="duration">To</label>

							<input type="text" id="editWorkshopModalWorkshopDurationTo" class="form-control datepicker">

							<br/>

						</div>

					</div>

					

					<label for="number">Number of people attended</label>

					<input type="text" id="editWorkshopModalWorkshopPeopleNumber" class="form-control">

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addCertificationModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add certification</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="courseName">Course name</label>

					<input type="text" id="addCertificationModalCourseName" class="form-control">

					<br/>

					<label for="institute">Institute</label>

					<input type="text" id="addCertificationModalInstitute" class="form-control">

					<br/>

					<div class="col-md-6">

						<label for="experienceDuration">From</label>

						<input type="text" id="addCertificationModalDurationFrom" class="form-control datepicker">

					</div>

					<div class="col-md-6">

						<label for="experienceDuration">To</label>

						<input type="text" id="addCertificationModalDurationTo" class="form-control datepicker">

					</div>

					<br/>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addCertificationSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editCertificationModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Edit certification</h4>

			</div>

			<div class="hidden" id="editCertificationModalId"></div>

			<div class="modal-body">

				<form>

					<label for="courseName">Course name</label>

					<input type="text" id="editCertificationModalCourseName" class="form-control">

					<br/>

					<label for="certificationInstitute">Institute</label>

					<input type="text" id="editCertificationModalInstitute" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="duration">From</label>

							<input type="text" id="editCertificationModalCertificationDurationFrom" class="form-control datepicker">

							<br/>

						</div>

						<div class="col-md-6">

							<label for="duration">To</label>

							<input type="text" id="editCertificationModalCertificationDurationTo" class="form-control datepicker">

							<br/>

						</div>

					</div>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addAchievementModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-trophy"></i>&nbsp;Add achievement</h4>

			</div>

			<div class="modal-body">

				<form>

					<label for="workshopName">Event name</label>

					<input type="text" id="addAchievementModalEventName" class="form-control">

					<br/>

					<label for="location">Venue</label>

					<input type="text" id="addAchievementModalLocation" class="form-control">

					<br/>

					<label for="duration">Position</label>

					<input type="text" id="addAchievementModalPosition" class="form-control">

					<br/>

					<label for="number">Description</label>

					<textarea type="text" id="addAchievementModalDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" onclick="addAchievementSendData();" class="btn btn-primary">Add</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="editAchievementModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-trophy"></i>&nbsp;Edit achievement</h4>

			</div>

			<div class="hidden" id="editAchievementModalId"></div>

			<div class="modal-body">

				<form>

					<label for="workshopName">Event name</label>

					<input type="text" id="editAchievementModalEventName" class="form-control">

					<br/>

					<label for="location">Venue</label>

					<input type="text" id="editAchievementModalLocation" class="form-control">

					<br/>

					<label for="duration">Position</label>

					<input type="text" id="editAchievementModalPosition" class="form-control">

					<br/>

					<label for="number">Description</label>

					<textarea type="text" id="editAchievementModalDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary">Save changes</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade" id="addInterestModal">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				&times;</span><span class="sr-only">Close</span></button>
				
				<h4 class="modal-title"><i class="fa fa-pencil"></i>&nbsp;Add interests</h4>

			</div>

			<div class="modal-body">

				<form>

					<div class="row addInterestInputClass">

						<div class="col-md-10">

							<input type="text" placeholder="Interest" id="addInterestModalInterestName" class="form-control">

						</div>

						<div class="col-md-2 hidden">

							<span style="cursor:pointer;" class="input-group-addon" onclick="addInterestAddInput();" id="addOption">

								<i class="fa fa-plus" ></i>

			    			</span>

						</div>

					</div>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success" onclick="addInterestAddInput();">Add input</button>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="addInterestsSendData();">Add</button>

			</div>

		</div>

	</div>

</div>


<script>

	$( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"dd/mm/yy"
		});

	// $('.datepicker').css({'z-index':'1052'});

</script>