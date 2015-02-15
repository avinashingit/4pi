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

	.skillValue
	{
		padding-top:5px;
		padding-bottom:5px;
		background-color:#C2C2C2;
		color:#000;
	}

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
		max-height:400px;
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

					<div class="row">

						<div class="col-md-6">

							<label for=""><i title="Facebook" class="fa fa-facebook"></i></label>

							<input type="url" id="fbURL" class="form-control" placeholder="Facebook">

						</div>

						<div class="col-md-6">

							<label for=""><i title="Twitter" class="fa fa-twitter"></i></label>

							<input type="url" id="twitterURL" class="form-control" placeholder="Twitter">

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for=""><i title="Google plus" class="fa fa-google-plus"></i></label>

							<input type="url" id="gplusURL" class="form-control" placeholder="Google plus">

						</div>

						<div class="col-md-6">

							<label for=""><i title="Linkedin" class="fa fa-linkedin"></i></label>

							<input type="url" id="inURL" class="form-control" placeholder="Linkedin">

						</div>
						
					</div>

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for=""><i title="Instagram" class="fa fa-instagram"></i></label>

							<input type="url" id="pinURL" class="form-control" placeholder="Instagram">

						</div>

						<div class="col-md-6">

							<label for=""><i class="fa fa-map-marker"></i>&nbsp;Address</label>

							<input type="text" id="address" class="form-control">

						</div>
						
					</div>

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for=""><i class="fa fa-at"></i>&nbsp;Email id</label>

							<input type="email" id="email2" class="form-control">

						</div>

						<div class="col-md-3">

							<label for=""><i class="fa fa-mobile"></i>&nbsp;Contact 1</label>

							<input type="text" id="contactNumber1" class="form-control"></input>

						</div>

						<div class="col-md-3">

							<label for=""><i class="fa fa-mobile"></i>&nbsp;Contact 2</label>

							<input type="text" id="contactNumber2" class="form-control"></input>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="">Show email id [<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Show your email id to others"></i>]</label><br>

							<label>Yes &nbsp;&nbsp;<input type="radio" id="showEmailIdValue" value="1" name="showEmailIdValue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

							<label>No &nbsp;&nbsp;<input type="radio" id="showEmailIdValue" value="2" name="showEmailIdValue"></label>

						</div>

						<div class="col-md-6">

							<label for="">Show contacts [<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Show your contacts id to others"></i>]</label><br/>

							<label>Yes &nbsp;&nbsp;<input type="radio" id="showContactsValue" value="1" name="showContactsValue" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

							<label>No &nbsp;&nbsp;<input type="radio" id="showContactsValue" value="2" name="showContactsValue"></label>

						</div>


					</div>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<label for="personDescription">About you  ( <span id="descriptionLetterCount"></span> characters )</label> 

					<textarea type="text" style="resize:none;" id="editPersonInfoModalPersonDescription" onkeyup="$('#descriptionLetterCount').html($(this).val().length);" class="autosize form-control"></textarea>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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
		x.find('#descriptionLetterCount').html(ob2.find('#personDescription').find('p').html().length);
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

			var toolsColumn1Length=$("#toolsColumn1").find(".tool").length;
			var toolsColumn2Length=$("#toolsColumn2").find(".tool").length;
			var toolsColumn3Length=$("#toolsColumn3").find(".tool").length;

			var c1=0,c2=0,c3=0;

			var toolColumn1Array=new Array();
			var toolColumn2Array=new Array();
			var toolColumn3Array=new Array();

			$("#tools").find('#toolsColumn1').find('.tool').each(function(){
				toolColumn1Array[c1]=$(this).find("#toolName").html();
				c1++;
			});

			$("#tools").find('#toolsColumn2').find('.tool').each(function(){
				toolColumn2Array[c2]=$(this).find("#toolName").html();
				c2++;
			});

			$("#tools").find('#toolsColumn3').find('.tool').each(function(){
				toolColumn3Array[c3]=$(this).find("#toolName").html();
				c3++;
			});

			var totalToolCount=c1+c2+c3;

			var count=c1;
			i=0;
			while(count!=0)
			{
				toolArray[i]=toolColumn1Array[c1-count];
				i=i+3;
				count--;
			}

			count=c2;
			i=1;
			while(count!=0)
			{
				toolArray[i]=toolColumn2Array[c2-count];
				i=i+3;
				count--;
			}

			var count=c3;
			i=2;
			while(count!=0)
			{
				toolArray[i]=toolColumn3Array[c3-count];
				i=i+3;
				count--;
			}

			console.log(toolArray);

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

				editToolsSendData();
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
		$('#addAcademicsModal').find("#CGPAElements").hide();
	}

	function editAcademics(n)
	{
		$('#editAcademicsModal').modal('show');

		var x=$('#editAcademicsModal');
		var y=$('#'+n);
		var scoreType=y.find("#scoreType").html();
		if(scoreType==1)
		{
			x.find("#CGPAElements").hide();
			$("#editAcademicsModalPercentage").val(y.find("#percentage").html().split('%')[0]);
		}
		else
		{
			x.find("#PercentageElements").hide();
			$("#editAcademicsModalCGPA").val(y.find("#percentage").html().split('/')[0]);
			$("#editAcademicsModalCGPAScale").val(y.find("#percentage").html().split('/')[1]);
		}
		x.find('#editAcademicsModalDegree').val(y.find('#degree').html());
		x.find("#editAcademicsModalPercentageType").val(y.find("#scoreType").html());
		x.find('#editAcademicsModalSchoolName').val(y.find('#school').html());
		var z=y.find('#duration').attr("title").split("-");
		x.find('#editAcademicsModalDurationFrom').val(z[0]);
		x.find('#editAcademicsModalDurationTo').val(z[1]);
		x.find('#editAcademicsModalSchoolLocation').val(y.find('#location').html());
		x.find('#editAcademicsModalId').html(n);
		
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
		x.find("#editAchievementModalId").html(n);
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

			var interestsColumn1Length=$("#interestsContainer1").find(".interest").length;
			var interestsColumn2Length=$("#interestsContainer2").find(".interest").length;
			var interestsColumn3Length=$("#interestsContainer3").find(".interest").length;

			var c1=0,c2=0,c3=0;

			var interestsColumn1Array=new Array();
			var interestsColumn2Array=new Array();
			var interestsColumn3Array=new Array();

			$("#interests").find('#interestsContainer1').find('.interest').each(function(){
				interestsColumn1Array[c1]=$(this).find("#interestName").html();
				c1++;
			});

			$("#interests").find('#interestsContainer2').find('.interest').each(function(){
				interestsColumn2Array[c2]=$(this).find("#interestName").html();
				c2++;
			});

			$("#interests").find('#interestsContainer3').find('.interest').each(function(){
				interestsColumn3Array[c3]=$(this).find("#interestName").html();
				c3++;
			});

			var totalInterestCount=c1+c2+c3;

			var count=c1;
			i=0;
			while(count!=0)
			{
				interestsArray[i]=interestsColumn1Array[c1-count];
				i=i+3;
				count--;
			}

			count=c2;
			i=1;
			while(count!=0)
			{
				interestsArray[i]=interestsColumn2Array[c2-count];
				i=i+3;
				count--;
			}

			var count=c3;
			i=2;
			while(count!=0)
			{
				interestsArray[i]=interestsColumn3Array[c3-count];
				i=i+3;
				count--;
			}

			console.log(interestsArray);

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

				var interestsColumn1Length=$("#interestsContainer1").find(".interest").length;
				var interestsColumn2Length=$("#interestsContainer2").find(".interest").length;
				var interestsColumn3Length=$("#interestsContainer3").find(".interest").length;

				var c1=0,c2=0,c3=0;

				var interestsColumn1Array=new Array();
				var interestsColumn2Array=new Array();
				var interestsColumn3Array=new Array();

				$("#interests").find('#interestsContainer1').find('.interest').each(function(){
					interestsColumn1Array[c1]=$(this).find("#interestName").html();
					c1++;
				});

				$("#interests").find('#interestsContainer2').find('.interest').each(function(){
					interestsColumn2Array[c2]=$(this).find("#interestName").html();
					c2++;
				});

				$("#interests").find('#interestsContainer3').find('.interest').each(function(){
					interestsColumn3Array[c3]=$(this).find("#interestName").html();
					c3++;
				});

				var totalInterestCount=c1+c2+c3;

				var count=c1;
				i=0;
				while(count!=0)
				{
					interestsArray[i]=interestsColumn1Array[c1-count];
					i=i+3;
					count--;
				}

				count=c2;
				i=1;
				while(count!=0)
				{
					interestsArray[i]=interestsColumn2Array[c2-count];
					i=i+3;
					count--;
				}

				var count=c3;
				i=2;
				while(count!=0)
				{
					interestsArray[i]=interestsColumn3Array[c3-count];
					i=i+3;
					count--;
				}

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

					editInterestsSendData()

				}
			}

			
		}
	}


</script>

<body style="padding-top:0px;">

	<?php
		echo $_SESSION['vj'];
		if(isset($_SESSION['vj']))
		{

			include_once('../topbar.php');
		}

		else
		{
			include_once('../topBarForAboutMe.php');
		}
	?>

	<div class="container">
		
		<div id="entireContent">

			<div class="row" id="topContent">

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

					<div id="skillNames" class="hidden"></div>

					<div id="skillPercentages" class="hidden"></div>

					<div class="row" id="skillData">


					</div>

				</div><!-- end id skills -->

				<div class="navObject" id="tools">
				
					<div class="row" id="toolsetHeading">
				
						<div class="col-md-2">
				
							<h3 class="text-center" style="color:#00004D;"><i class="fa fa-wrench"></i>&nbsp; Tool set</h3>
				
						</div>
				
						<div class="col-md-1 text-right visibleForUser col-md-offset-9">
				
							<a class="btn btn-sm btn-success cursorPointer" onclick="addTool();"><i class="fa fa-plus" ></i></a>
				
						</div>

					</div>

					<br/>
				
					<div class="row" id="toolContent">
				
						<div class="col-md-4 text-center" id="toolsColumn1">
				
						</div>

						<div class="col-md-4 text-center" id="toolsColumn2">
				
						</div>

						<div class="col-md-4 text-center" id="toolsColumn3">
				
						</div>
				
					</div>
				
				</div>

				<div class="navObject" id="projects">

					<div class="row">

						<div class="col-md-4 text-left">

							<h3 style="color:#176F56;"><i class="fa fa-database"></i>&nbsp;Projects (<span id="projectsNumber"></span>)</h3>

						</div>

						<div class="col-md-2 visibleForUser text-right col-md-offset-6">
		
							<button  onclick="addProject();" class="cursorPointer btn btn-sm btn-success"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-12" id="projectContainer">

						</div><!-- end class col-md-12 -->


					</div><!-- end class row -->

				</div><!-- end id projects -->

				<div class="navObject" id="experiences">

					<div class="row">

						<div class="col-md-5">

							<h3  style="color:rgba(154, 105, 170, 1);" class="text-left"><i class="fa fa-fighter-jet"></i>&nbsp;Experience (<span id="experienceNumber"></span>)</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-sm btn-success" onclick="addExperience();"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="experienceContainer1">

						</div><!-- end class col-md- 6 -->

						<div class="col-md-6" id="experienceContainer2">

						</div><!-- end class col-md- 6 -->

					</div><!-- end class row -->

				</div><!-- end id experience -->

				<div class="navObject" id="academics">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:rgba(222, 123, 26, 1);" class="text-left"><i class="fa fa-mortar-board"></i>&nbsp;Academics (<span id="academicsNumber"></span>)</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-sm btn-success"  onclick="addAcademics();"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="academicsContainer1">

						</div>

						<div class="col-md-6" id="academicsContainer2">

						</div>


					</div><!-- end class row-->					

				</div><!-- end id academics -->

				<div class="navObject" id="workshops">

					<div class="row">

						<div class="col-md-5">

							<h3  style="color:#007887;" class="text-left"><i class="fa fa-gears"></i>&nbsp;Workshops (<span id="workshopsNumber"></span>)</h3>

						</div>

						<div class="col-md-3  visibleForUser text-right col-md-offset-4">
		
							<button  onclick="addWorkshop();" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="workshopContainer1">

						</div>

						<div class="col-md-6" id="workshopContainer2">

						</div>

					</div><!-- end class row -->

				</div><!-- end id workshops -->

				<div class="navObject" id="certifications">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:rgba(192, 54, 117, 1);" class="text-left"><i class="fa fa-certificate"></i>&nbsp;Certified courses (<span id="certificationsNumber"></span>)</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-sm btn-success"  onclick="addCertification();"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="certificationContainer1">

						</div>

						<div class="col-md-6" id="certificationContainer2">

						</div>

					</div>

				</div><!-- end id certifications -->

				<div class="navObject" id="achievements">

					<div class="row">

						<div class="col-md-5">

							<h3 style="color:#008322;" class="text-left"><i class="fa fa-trophy"></i>&nbsp;Achievements (<span id="achievementsNumber"></span>)</h3>

						</div>

						<div class="col-md-3 visibleForUser text-right col-md-offset-4">
		
							<button class="btn btn-sm btn-success"  onclick="addAchievement();"><i class="fa fa-plus"></i></button>

						</div>

					</div>

					<br/>

					<div class="row">

						<div class="col-md-6" id="achievementContainer1">

						</div><!-- end class col-md-6 -->

						<div class="col-md-6" id="achievementContainer2">

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

								<button class="btn btn-sm btn-success" onclick="addInterest();"><i class="fa fa-plus"></i></button>

							</div>

						</div>

						<br/>

						<div class="row">

							<div class="col-md-4 text-left" id="interestsContainer1">

							</div>

							<div class="col-md-4 text-left" id="interestsContainer2">

							</div>

							<div class="col-md-4 text-left" id="interestsContainer3">

							</div>

						</div>

					</div>

				</div><!-- end id interests -->

			</div><!-- end id middle content -->

			<br/>

			<div class="row" id="bottomContent" style="border-top:4px solid rgba(192, 54, 117, 1);">

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

							<input type="text" placeholder="Skill name. Ex: Photoshop. Rating next." id="addSkillModalSkillName" class="form-control">

						</div>

						<div class="col-md-4">

							<input type="range" min="0" style="border:none;" max="100" id="addSkillModalSkillPercentage" onchange="$(this).parent().parent().find('#sliderValueAddModal').parent().removeClass('hidden');showValueForSlider(this);" class="form-control">

						</div>

						<div class="hidden col-md-1 text-center skillValue" >

							<span id="sliderValueAddModal" style="padding-top:10px;"></span>

						</div>

						<div class="col-md-2 hidden">

			    			<span style="cursor:pointer;" class="input-group-addon" onclick="addSkillAddInput();" id="addOption">

								<i class="fa fa-plus" ></i>

			    			</span>

						</div>

					</div>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success" onclick="addSkillAddInput();">Add more skills</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-success" onclick="addToolAddInput();">Add more tools</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<input type="text" placeholder="Ex: Doors 2018" id="addProjectModalProjectTitle" class="form-control">

					<br/>

					<label for="projectTitle">Project team</label>

					<input type="text" placeholder="Ex: Avinash, Hari. Leave it blank if it is an individual project" id="addProjectModalProjectTeam" class="form-control">

					<br/>

					<div class="row">

						<div class="col-md-6">

							<label for="projectDuration">Project Duration From</label>

							<input type="text" id="addProjectModalProjectDurationFrom" class="datepickers form-control">

						</div>

						<div class="col-md-6">

							<label for="projectDuration">Project Duration To</label>

							<input type="text" id="addProjectModalProjectDurationTo" class="datepickers form-control">

						</div>

					</div>

					<br/>

					<label for="projectRole">Position</label>

					<input type="text" placeholder="Web developer" id="addProjectModalProjectRole" class="form-control">

					<br/>

					<label for="projectCompany">Company/Organisation</label>

					<input type="text" placeholder="Megasoft" id="addProjectModalProjectCompany" class="form-control">

					<br/>

					<label for="projectDescription">Project description</label>

					<textarea type="text" id="addProjectModalProjectDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<input type="text" id="editProjectModalProjectId" class="hidden">

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<input type="text" placeholder="Megasoft" id="addExperienceModalCompanyName" class="form-control">

					<br/>

					<label for="experienceRole">Role/position</label>

					<input type="text" placeholder="Developer" id="addExperienceModalRole" class="form-control">

					<br/>

					<label for="experienceFeaturing">Feature in the personal info? [<i class="fa fa-question popOver" data-toggle="popover" data-trigger="hover click" data-content="Check YES if this is your current profession." ></i>]</label>

					<div class="row">

						<div class="col-md-6">

							<label>

								No&nbsp;&nbsp;<input name="featureInPersonalInfo" type="radio" id="addExperienceModalFeature" value="0" class="form-control">

							</label>

						</div>

						<div class="col-md-6">

							<label>

								Yes&nbsp;&nbsp;<input name="featureInPersonalInfo" type="radio" id="addExperienceModalFeature" value="1" class="form-control">

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<label>Feature in personal info?</label>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" onclick="editExperienceSendData();" class="btn btn-primary">Save changes</button>

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

					<label for="percentageType">Score type</label>

					<select onchange="if($(this).val()==1){$('#CGPAElements').hide();$('#PercentageElements').show();}else{$('#PercentageElements').hide();$('#CGPAElements').show();}" id="addAcademicsModalPercentageType" class="form-control" value="1">
	
						<option value="1">Percentage</option>

						<option value="2">CGPA</option>

					</select>

					<br/>

					<div id="PercentageElements">

						<label for="percentage">Percentage</label>

						<input placeholder="95.5" type="number" id="addAcademicsModalPercentage" class="form-control">

						<br/>

					</div>

					<div id="CGPAElements">

						<label for="percentage">CGPA</label>

						<div class="row">

							<div class="col-md-6">

								<input plcaeholder="CGPA" type="text" id="addAcademicsModalCGPA" class="form-control" placeholder="Your CGPA. And the one next to this is 'on which scale'."> &nbsp;

							</div>

							<div class="col-md-6">

								<input placeholder="Scale. Eg. 10" type="number" id="addAcademicsModalCGPAScale" min="4" max="10" class="form-control">

							</div>

						</div>

						<br/>

					</div>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

					<label for="percentageType">Score type</label>

					<select onchange="alert($(this).val());if($(this).val()==1){alert('hi');$('#editAcademicsModal').find('#CGPAElements').hide();$('#editAcademicsModal').find('#PercentageElements').show();}else{$('#editAcademicsModal').find('#PercentageElements').hide();$('#editAcademicsModal').find('#CGPAElements').show();}" id="editAcademicsModalPercentageType" class="form-control">
	
						<option value="1">Percentage</option>

						<option value="2">CGPA</option>

					</select>

					<br/>

					<div id="PercentageElements">

						<label for="percentage">Percentage</label>

						<input placeholder="95.5" type="number" id="editAcademicsModalPercentage" class="form-control">

						<br/>

					</div>

					<div id="CGPAElements">

						<label for="percentage">CGPA</label>

						<div class="row">

							<div class="col-md-6">

								<input plcaeholder="CGPA" type="text" id="editAcademicsModalCGPA" class="form-control">

							</div>

							<div class="col-md-6">

								<input plcaseholder="Scale. Eg. 10" type="number" id="editAcademicsModalCGPAScale" class="form-control">

							</div>

						</div>

						<br/>

					</div>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" onclick="editAcademicsSendData();" class="btn btn-primary">Save changes</button>

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

					<div class="row">

						<div class="col-md-6">

							<label for="duration">From</label>

							<input type="text" id="addWorkshopModalWorkshopDurationFrom" class="form-control datepicker">

						</div>
						
						<div class="col-md-6">

							<label for="duration">To</label>

							<input type="text" id="addWorkshopModalWorkshopDurationTo" class="form-control datepicker">

						</div>

					</div>

					<br/>

					<label for="number">Number of people attended</label>

					<input type="text" id="addWorkshopModalWorkshopPeopleNumber" class="form-control">

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" onclick="editWorkshopSendData();" class="btn btn-primary">Save changes</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" onclick="editCertificationSendData();" class="btn btn-primary">Save changes</button>

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

					<label for="duration">Position/Rank [<i class="fa fa-question popOver" data-toggle="popover" data-trigger="hover click" data-content="For example, FIRST POSITION."></i>]</label>

					<input type="text" id="addAchievementModalPosition" class="form-control">

					<br/>

					<label for="number">Description</label>

					<textarea type="text" id="addAchievementModalDescription" class="form-control"></textarea>

					<br/>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

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

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" onclick="editAchievementSendData();" class="btn btn-primary">Save changes</button>

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

				<button type="button" class="btn btn-success" onclick="addInterestAddInput();">Add more interests</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-primary" onclick="addInterestsSendData();">Add</button>

			</div>

		</div>

	</div>

</div>


<script>

	$(document).ready(function(){
		$( ".datepickers" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"dd/mm/yy"
		});
	});

	

	// $('.datepicker').css({'z-index':'1052'});

</script>