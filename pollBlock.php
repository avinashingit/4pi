<div class="col-md-7" id="polls">
<div class="row pollMenu topMenu" style="z-index:1040;">
	
		<div class="btn-group btn-group-justified" style="padding:10px;">
			
			<div class="btn-group">
			
			    <button type="button" id="pollCreateButton" class="btn btn-warning" data-toggle="modal" data-target="#pollCreateModal"><a style="color:white;" ><i class="fa fa-plus"></i>&nbsp;Create Poll</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="latestPollsButton" class="btn btn-danger"><a style="color:white;" ><i class="fa fa-calendar"></i>&nbsp;Latest Polls</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="completedPollsButton" class="btn btn-primary"><a style="color:white;" ><i class="fa fa-clock-o"></i>&nbsp;Completed Polls</a></button>
		  	
		  	</div>
			
		</div>

</div><!-- end class pollMenu.topMenu -->


<!-- Modals for create poll -->

<!-- there is no modal for edit poll because users might have already voted for the poll -->


<div class="modal fade slow" id="pollCreateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

  	<div class="modal-dialog">

    	<div class="modal-content">

	      	<div class="modal-header">

        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

        		<h4 class="modal-title" id="createModalLabel"><i class="fa fa-plus"></i> &nbsp;Create Poll&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="The poll will be shown to the users of 4pi only after SAC speaker's approval. You will not allowed to edit the poll once created."></i>]</h4>

      		</div>

	      	<div class="modal-body">

      		    <form role="form">

			  		<div class="form-group">

			   			<label for="pollName">Poll on</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

			    		<textarea type="text" name="pollQuestion" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="createPollQuestion" placeholder="Poll on"></textarea>

			  		</div>

			  		<!-- <div class="form-group">

			   			<label for="pollDuration">Poll duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Basically, how long the poll should be conduted."></i>]

			    		<input type="text" name="pollDuration" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="createPollDuration" placeholder="Poll on"></input>

			  		</div> -->

			  		<div class="form-group">

			   			<label for="pollName">Poll type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

			    		<select name="pollType" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPollType" >
			    			
			    			<option value="1">Display results after the user votes</option>

			    			<option value="2">Display results along with options</option>

			    			<option value="3">Display results after the poll has ended</option>


			    		</select>

			  		</div>


			  		<div class="row">


						<div class="form-group col-md-6" id="option1">
				   			
				   			<label for="pollOptions">Option</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Options for poll."></i>]

							<!-- <div class="input-group"> -->
				    			
			    			<input type="text" name="pollOptions" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" placeholder="Option"></textarea>

				    			<!-- <span class="input-group-addon">

									<i class="fa fa-plus" onclick="createPollAddInput();"></i>

				    			</span>

				    			<span class="input-group-addon hidden">

									<i class="fa fa-minus" onclick="createPollDeleteInput();"></i>

				    			</span> -->

			    			<!-- </div> -->

			    		</div>


			    		<div class="form-group col-md-6" id="option2">
				   			
				   			<label for="pollOptions">Option</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Options for poll. If you want to add one more click '+'. To delete click '-'"></i>]

							<div class="input-group">
				    			
				    			<input type="text" name="pollOptions" class="form-control input-sm" style="background-color:white !important;border-radius:0px;"placeholder="Option 2"></textarea>

				    			<span class="input-group-addon" id="addOption">

									<i class="fa fa-plus" onclick="createPollAddInput();"></i>

				    			</span>

				    			<span class="input-group-addon hidden" id="deleteOption">

									<i class="fa fa-minus" onclick="createPollDeleteInput(this);"></i>

				    			</span>

			    			</div>

			    		</div>


		    		</div>
				
				</form>

				<br/>

				<button onclick="createPollSP();" class="btn btn-primary">Create Poll</button>

			</div>
			
		</div>

	</div>

</div>

</div>


<script>

//--------------------------------------------------------------------------//
//add option input
function createPollAddInput(){
	var numberOfOptionsCurrent=$('#pollCreateModal').find('input').length;
	var current=$('#pollCreateModal').find('#option2').clone();
	var optionVal=numberOfOptionsCurrent+1;
	current.attr('id',optionVal);
	current.find('input').attr("id",optionVal);
	placeHolder="Option ";
	current.find('input').attr("placeholder",placeHolder);
	current.find('input').val("");
	current.find('label').html(placeHolder);
	current.find('#deleteOption').removeClass('hidden');
	$('#pollCreateModal').find('.modal-body').find('form .row').append(current);
}

//----------------------------------------------------------------------------//
//delete option input
function createPollDeleteInput(el){
	$(el).parent().parent().parent().remove();
}

//----------------------------------------------------------------------------//
// Create Poll Function
function createPollSP(){
	var pollQuestion=$('#pollCreateModal').find('#createPollQuestion').val();
	var pollType=$('#pollCreateModal').find('#createPollType').val();
	var options=[];
	var numberOfOptions=$('#pollCreateModal').find('input').length;
	if(numberOfOptions<2)
	{
		alert("Don't mess with 4pi");
	}
	else
	{
		if(pollQuestion.length==0)
		{
			alert("Please enter the poll question");
		}
		else
		{
			for(i=0;i<numberOfOptions;i++){
				options[i]=$('#pollCreateModal').find('input').eq(i).val();
			}

			var unfilled="yes";
			for(i=0;i<numberOfOptions;i++)
			{
				if(options[i].length==0)
				{
					unfilled="no";
				}
			}

			if(unfilled=="no")
			{
				alert("Please fill all the options");
			}

			else
			{
				$.post('./handlers/pollHandlers/createPoll.php', {
					_pollQuestion:pollQuestion,
					_pollType:pollType,
					_pollOptions:options
				})
				.error(function(){
					alert("Server overload. Please try again.")
				})
				.success(function(data){

				});

			}
		}
	}
}



//-------------------------------------------------------------------------------//
//render the donut pie characters
$(function () {

// Radialize the colors
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
			return {
					linearGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
					stops: [
							[0, color],
							[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
					]
			};
	});
});

//-----------------------------------------------------------------------------//
//function to show the poll result on the screen
function getVote(pollValue,el,el2){

	var id=$(el).attr("id");
	var id2=$(el).attr("id")+'b';
	var pollQuestion =$('#'+id).find('#pollQuestion').html();
	$('#'+id).hide();
	var value=3000;
	$('#'+id2).highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 20
            }
        },
        title: {
            text: pollQuestion
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 65
            }
        },
        series: [{
            name: 'No. of Votes',
            data: json
        }]
    });
}
//---------------------------------------------------------------------------//
//insertPollIntopollarea

function insertPoll(data){

	


}
</script>