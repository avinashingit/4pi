<style>

.poll
{
	background-color:white;
}


</style>

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

				   			<label for="pollName">Poll option type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Single option selection or multiple option types."></i>]

				    		<select name="pollType" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPollOptionType" >
				    			
				    			<option value="1">Single option selection</option>

				    			<option value="2">Multiple options selection</option>

				    		</select>

				  		</div>

				  		<div class="form-group">

				   			<label for="pollName">Poll type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

				    		<select name="pollType" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPollType" >
				    			
				    			<option value="1">Display results after the user votes</option>

				    			<option value="2">Display results along with options</option>

				    			<option value="3">Display results after the poll has ended</option>


				    		</select>

				  		</div>

				  		<div class="form-group">

				   			<label for="pollShareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

				    		<input name="pollShareWith" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPollSharedWith" >

				  		</div>


				  		<div class="row">


							<div class="form-group col-md-6" id="option1">
					   			
					   			<label for="pollOptions">Option</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Options for poll."></i>]

								<!-- <div class="input-group"> -->
					    			
				    			<input  type="text" name="pollOptions" class="inputOption form-control input-sm" style="background-color:white !important;border-radius:0px;" placeholder="Option"></textarea>

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
					    			
					    			<input type="text" name="pollOptions" class="inputOption form-control input-sm" style="background-color:white !important;border-radius:0px;"placeholder="Option 2"></textarea>

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

	</div> <!-- end modals -->

	<div id="pollArea">


	</div>

</div><!-- end polls -->


<script>
//--------------------------------------------------------------------------//
//add option input
function createPollAddInput(){
	var numberOfOptionsCurrent=$('#pollCreateModal').find('.inputOption').length;
	var current=$('#pollCreateModal').find('#option2').clone();
	var optionVal=numberOfOptionsCurrent+1;
	current.attr('id',optionVal);
	current.find('.inputOption').attr("id",optionVal);
	placeHolder="Option ";
	current.find('.inputOption').attr("placeholder",placeHolder);
	current.find('.inputOption').val("");
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

	alert("called");
	var pollQuestion=$('#pollCreateModal').find('#createPollQuestion').val();
	var pollType=$('#pollCreateModal').find('#createPollType').val();
	var pollOptionType=$('#pollCreateModal').find('#createPollOptionType').val();
	var sharedWith=$('#pollCreateModal').find('#createPollSharedWith').val();
	var options=[];
	var numberOfOptions=$('#pollCreateModal').find('.inputOption').length;
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
				options[i]=$('#pollCreateModal').find('.inputOption').eq(i).val();
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
					_pollOptions:options,
					_pollOptionType:pollOptionType,
					_sharedWith:sharedWith
				})
				.error(function(){
					alert("Server overload. Please try again.");
				})
				.success(function(data){

					if(checkData(data)==1)
					{
						data=JSON.parse(data);
						$('#pollCreateModal').modal('hide');
						insertPoll(data,"first");
					}

					$('.timeago').timeago();

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


//--------------------------------------------------------------------------------------------//
function displayChart(json,idC,id,hUh)
{
	alert("called")
	var pollQuestion =$('#'+id).find('#pollQuestion').html();
	if(hUh==1)
	{
		$('#'+id).hide();
	}
	$('#'+idC).highcharts({
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
//---------------------------------------------------------------------------------------------//
function voteSend(value,id)
{
	alert("Hello");
	$.post('./handlers/pollHandlers/votePoll.php',{
		_pollId:id,
		_votes:value
	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		console.log(data);
		// displayChart(data,id+'b',id,1);
	});
}

//--------------------------------------------------------------------------------//
function sendVoteMultipleOptions(id)
{
	alert("Hello");
	var options=[];
	console.log($('#'+id));
	$('#'+id).find('#vote:checked').each(function(){

		options.push($(this).val());

	});

	$.post('./handlers/pollHandlers/vote.php',{
		_pollId:id,
		_votes:options
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		console.log(data);
		displayChart(data,id+'b',id,1);
	});
}

//----------------------------------------------------------------------------------//
function sendVoteDontReceive(value,id)
{
	$.post('./handlers/pollHandlers/vote.php',{
		_type:"single",
		_pollId:id,
		_value:value
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			$('#'+id).html("<p class='text-center'>Thanks for voting.</p>");
		}
	});
}

//------------------------------------------------------------------------------------//
function sendVoteDontReceiveMultiple(id)
{
	var options=[];
	$('#'+id+'#vote:checked').each(function(){

		options.push($(this).val());

	});

	$.post('./handlers/pollHandlers/vote.php',{
		_type:"multiple",
		_pollId:id,
		_value:options
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			$('#'+id).html("<p class='text-center'>Thanks for voting.</p>");
		}
	});
}


//---------------------------------------------------------------------------//
//insertPollIntopollarea

function insertPoll(data,position)
{

	alert("called");

	var poll="";

	if(data.pollType==1)
	{
		
		poll+='<div id="'+data.pollIdHash+'b" class="col-md-6 col-md-offset-3 poll"></div>';

		poll+='<div class="row" id="'+data.pollIdHash+'">';

		poll+='<div class="row poll">';

		poll+='<div class="row" id="pollContent">';

		poll+='<div class="col-md-8">';

		poll+='<h4 id="pollQuestion">'+data.pollQuestion+'</h4>';

		poll+='</div>';

		poll+='<div class="col-md-4">';

		poll+='<p><time class="timeago" id="pollCreatedTime" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time></p>';

		poll+='</div>';

		poll+='</div>';

		poll+='<div class="row" id="pollOptions">';

		poll+='<div class="col-md-12">';

		// poll+='<form>';

		poll+='<div class="row">';

		if(data.pollOptionsType==1)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="radio" name="vote" value="'+i+'" onclick="voteSend('+i+',\''+data.pollIdHash+'\');"> &nbsp;'+data.pollOptions[i]+'<br/>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}

		else if(data.pollOptionsType==2)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="checkbox" name="vote" id="vote" value="'+i+'"> &nbsp;'+data.pollOptions[i]+'<br>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='<button class="text-center btn btn-success" onclick="sendVoteMultipleOptions(\''+data.pollIdHash+'\');">Vote</button>';

			// poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}
	}

	else if(data.pollType==2)
	{

		poll+='<div class="row">';

		poll+='<div class="col-md-6">';
		
		poll+='<div id="'+data.pollIdHash+'b" class="col-md-6 col-md-offset-3 poll"></div>';

		poll+='</div>';

		poll+='<div class="col-md-6">';

		poll+='<div class="row" id="'+data.pollIdHash+'">';

		poll+='<div class="col-md-6 col-md-offset-3 poll">';

		poll+='<div class="row" id="pollContent">';

		poll+='<div class="col-md-10">';

		poll+='<h4 id="pollQuestion">'+data.pollQuestion+'</h4>';

		poll+='</div>';

		poll+='<div class="col-md-2">';

		poll+='<time class="timeago" id="pollCreatedTime" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

		poll+='</div>';

		poll+='</div>';

		poll+='<div class="row" id="pollOptions">';

		poll+='<div class="col-md-12">';

		poll+='<form>';

		poll+='div class="row">';

		if(data.pollOptionsType==1)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="radio" name="vote" value="'+i+'" onclick="voteSend(this.value,'+data.pollIdHash+');"> &nbsp;'+data.pollOptions[i]+'<br>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}

		else if(data.pollOptionsType==2)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="checkbox" name="vote" value="'+i+'"> &nbsp;'+data.pollOptions[i]+'<br>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='<button class="text-center btn btn-success" onclick="getVoteMultipleOptions('+data.pollIdHash+');"></button>';

			poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}

		poll+='</div>';

		poll+='</div>';

		displayChart(data.optionVotes,data.pollIdHash+'b',data.pollIdHash,0);
	}

	else if(data.pollType==3)
	{
		
		poll+='<div id="'+data.pollIdHash+'b" class="col-md-6 col-md-offset-3 poll"></div>';

		poll+='<div class="row" id="'+data.pollIdHash+'">';

		poll+='<div class="col-md-6 col-md-offset-3 poll">';

		poll+='<div class="row" id="pollContent">';

		poll+='<div class="col-md-10">';

		poll+='<h4 id="pollQuestion">'+data.pollQuestion+'</h4>';

		poll+='</div>';

		poll+='<div class="col-md-2">';

		poll+='<time class="timeago" id="pollCreatedTime" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

		poll+='</div>';

		poll+='</div>';

		poll+='<div class="row" id="pollOptions">';

		poll+='<div class="col-md-12">';

		poll+='<form>';

		poll+='div class="row">';

		if(data.pollOptionsType==1)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="radio" name="vote" value="'+i+'" onclick=\"voteSend(this.value,'+data.pollIdHash+');\"> &nbsp;'+data.pollOptions[i]+'<br>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}

		else if(data.pollOptionsType==2)
		{
			for ( i = 0; i<data.pollOptions.length;i++)
			{
				poll+='<div class="col-md-6">';

				poll+='<input type="checkbox" name="vote" value="'+i+'"> &nbsp;'+data.pollOptions[i]+'<br>';

				poll+='</div>'
			}

			poll+='</div>';

			poll+='<button class="text-center btn btn-success" onclick="getVoteMultipleOptions('+data.pollIdHash+');"></button>';

			poll+='</form>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';

			poll+='</div>';
		}
	}
	if(position=="first")
	{
		$('#pollArea').prepend(poll).hide().fadeIn(500);
	}
	else 
	{
		$('#pollArea').append(poll).hide().fadeIn(500);
	}
	
}
</script>