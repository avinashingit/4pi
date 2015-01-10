<style>

.poll
{
	background-color:white;
}


</style>

<style>

	.poll
	{
		border:1px solid #CCCCCC;
		margin-bottom:10px;
		padding:5px;
		padding-bottom:10px;
	}

	.poll:hover
	{
		box-shadow:0px 5px 0px #33FF4B inset;
	}

	.fa-trash
	{
		color:maroon;
	}
	.fa-pencil
	{
		color:#0041CF;
	}
	#pollQuestion
	{
		font-weight:bold;
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

		// alert("called");
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
		// alert("called")
		var pollQuestion =$('#'+id).find('#pollQuestion').html();
		if(hUh==1)
		{
			$('#'+id+'Content').hide();
		}
		$('#'+id).highcharts({
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
            },
            series: {
                dataLabels: {
                	enabled:true,
                    formatter: function() {
                        return Math.round(this.percentage*100)/100 + ' %';
                    },
                    distance: -20,
                    color:'white'
                }
            }
        },
        series: [{
            name: 'No. of Votes',
            data: json
        }]
    });
	}
	//---------------------------------------------------------------------------------------------//
	/*function voteSend(value,id)
	{
		// alert("Hello");
		$.post('./handlers/pollHandlers/votePoll.php',{
			_pollId:id,
			_votes:value
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			//console.log(data);
			// displayChart(data,id+'b',id,1);
		});
	}*/

	//--------------------------------------------------------------------------------//
	function sendVoteMultipleOptions(id)
	{
		// alert("Hello");
		var options=[];
		//console.log($('#'+id));
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
			//console.log(data);
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
		var optionLength=data.pollOptions.length;
		var poll="";
		if(data.pollOptionsType==1)
		{
			poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				poll+='<br/>';

				poll+='<div class="row" id="'+data.pollIdHash+'b">';

				poll+='</div>';

				poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

				poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

				poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';


				poll+='<div class="row '+data.pollIdHash+'Content">';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<div style="font-size:16px">'+data.pollQuestion+'</div>';

						poll+='</div>';

						poll+='<div class="col-md-3" id="pollCreatorOptions">';

							poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp;<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

						poll+='</div>';

						poll+='<div class="col-md-2" id="pollCreatedTime">';

							poll+='<time class="time timeago" title="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

							poll+='<div class="col-md-6">';

								for(var i=0;i<optionLength;i+=2)
								{
									//console.log(i);
									poll+='<p><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></p><br/>';
								}


							poll+='</div>';

							poll+='<div class="col-md-6">';

								for(var i=1;i<optionLength;i=i+2)
								{
									//console.log(i);
									poll+='<p><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></p><br/>';
								}


							poll+='</div>';


							

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="text-center">';

							poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\''+data.pollType+'\');" class="btn btn-md btn-success">Vote</button>';

						poll+='</div>';

					poll+='</div>';

				poll+='</div>';

			poll+='</div>';
		}

		else if(data.pollOptionsType==2)
		{
			poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				poll+='<br/>';

				poll+='<div class="row" id="'+data.pollIdHash+'b">';

				poll+='</div>';

				poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

				poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

				poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';


				poll+='<div class="row '+data.pollIdHash+'Content">';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<div style="font-size:16px">'+data.pollQuestion+'</div>';

						poll+='</div>';

						poll+='<div class="col-md-3" id="pollCreatorOptions">';

							poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp;<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

						poll+='</div>';

						poll+='<div class="col-md-2" id="pollCreatedTime">';

							poll+='<time class="time timeago" title="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

							poll+='<div class="col-md-6">';

								for(var i=0;i<data.pollOptions.length;i=i+2)
								{
									poll+='<p><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></p><br/>';
								}


							poll+='</div>';

							poll+='<div class="col-md-6">';

								for(var i=1;i<data.pollOptions.length;i=i+2)
								{
									poll+='<p><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></p><br/>';
								}


							poll+='</div>';


							

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="text-center">';

							poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\''+data.pollType+'\');" class="btn btn-md btn-success">Vote</button>';

						poll+='</div>';

					poll+='</div>';

				poll+='</div>';

			poll+='</div>';
		}

		if(position=="first")
		{
			$('#pollArea').prepend(poll).hide().fadeIn(500);
		}
		else if(position=="last")
		{
			$('#pollArea').append(poll).hide().fadeIn(500);
		}
	}

	//-------------------------------------------------------------------------------//
	//fetchPolls
	//
	function fetchLatestPolls(call)
	{
		$.post('./handlers/pollHandlers/latestPolls.php',{
			_call:call
		})
		.error(function(){
			alert("Server overload. Please try again.");
		})
		.success(function(data){
			//console.log(data);
			if(checkData(data)==1)
			{
				datas=JSON.parse(data);
				for(i=0;i<datas.length;i++)
				{
					insertPoll(datas[i],"last");
				}

				//console.log(datas.length);
				insertPoll(datas[0],"last");
				$('time.timeago').timeago();
			}
		});
	}

	$(document).ready(function(){
		fetchLatestPolls(1);
	});
</script>
<script>



	function submitVote(pollId,type,result)
	{
		if(type=='single')
		{
			var checkedOption=new Array();
			var option=$('#'+pollId).find('input');
			for (i =0;i<option.length;i++)
			{
				if(option[i].checked)
				{
					checkedOption[0]=i;
				}
			}
			$.post('./handlers/pollHandlers/votePoll.php',{
				_pollId:pollId,
				_votes:checkedOption[0]
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
			})
			.success(function(data){
				console.log(data);
				if(checkData(data)==1)
				{
					displayChart(data,pollId+'b',pollId,1);
				}
			});
		}

		else if(type=="multiple")
		{
			var option=$('#'+pollId).find('input');
			for (i =0;i<option.length;i++)
			{
				if(option[i].checked)
				{
					alert(option[i].value);
				}
			}
		}
	}

	function deletePoll(pollId)
	{
		if(confirm("Do you want to delete the poll")==true)
		{
			$('#'+pollId).remove();
		}
	}

	function editPollAddInput(){
		var numberOfOptionsCurrent=$('#pollEditModal').find('.inputOption').length;
		var current=$('#pollEditModal').find('#option2').clone();
		var optionVal=numberOfOptionsCurrent+1;
		current.attr('id',optionVal);
		current.find('.inputOption').attr("id",optionVal);
		placeHolder="Option ";
		current.find('.inputOption').attr("placeholder",placeHolder);
		current.find('.inputOption').val("");
		current.find('label').html(placeHolder);
		current.find('#deleteOption').removeClass('hidden');
		$('#pollEditModal').find('.modal-body').find('form .row').append(current);
	}

	//----------------------------------------------------------------------------//
	//delete option input
	function editPollDeleteInput(el){
		$(el).parent().parent().parent().remove();
	}

	function editPoll(pollId)
	{
		$('#pollEditModal').find('#pollOptionsDiv').find('div').each(function(){
			if($(this).attr('id')=='#option1' || $(this).attr('id')=='#option2')
			{
				$(this).find('input').val("");
			}
			else
			{
				$(this).remove();
			}
		});
		$('#pollEditModal').modal('show');
		var olink=$('#'+pollId);
		var link=$('#pollEditModal');
		link.find('#editPollQuestion').val(olink.find('#pollQuestion').find('div').html());
		link.find('#editPollOptionType').val(olink.find('#pollOptionType').html());
		link.find('#editPollSharedWith').val(olink.find('#pollShareWith').html());
		link.find('#editPollType').val(olink.find('#pollResultType').html());
		var options=olink.find('input').length;
		if(link.find('#pollOptionsDiv').find('input').length!=options)
		{
			link.find('#option1').find('input').val(olink.find('#pollOption0').next().html());
			link.find('#option2').find('input').val(olink.find('#pollOption1').next().html());

			if(options>=3)
			{
				for(i=3;i<=options;i++)
				{
					editPollAddInput();
					link.find('#'+i+1).find('input').val(olink.find('#pollOption'+i-1).next().html());
				}
			}
			
			
		}
	}
	

</script>

<div class="modal fade slow" id="pollEditModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

	  	<div class="modal-dialog">

	    	<div class="modal-content">

		      	<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

	        		<h4 class="modal-title" id="editModalLabel"><i class="fa fa-plus"></i> &nbsp;Edit Poll&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="The poll will be shown to the users of 4pi only after SAC speaker's approval. You will not allowed to edit the poll once approved."></i>]</h4>

	      		</div>

		      	<div class="modal-body">

	      		    <form role="form">

				  		<div class="form-group">

				   			<label for="pollName">Poll on</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

				    		<input type="text" name="pollQuestion" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="editPollQuestion" placeholder="Poll on"></input>

				  		</div>

				  		<!-- <div class="form-group">

				   			<label for="pollDuration">Poll duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Basically, how long the poll should be conduted."></i>]

				    		<input type="text" name="pollDuration" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="createPollDuration" placeholder="Poll on"></input>

				  		</div> -->

				  		<div class="form-group">

				   			<label for="pollName">Poll option type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Single option selection or multiple option types."></i>]

				    		<select name="pollType" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editPollOptionType" >
				    			
				    			<option value="1">Single option selection</option>

				    			<option value="2">Multiple options selection</option>

				    		</select>

				  		</div>

				  		<div class="form-group">

				   			<label for="pollName">Poll type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

				    		<select name="pollType" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editPollType" >
				    			
				    			<option value="1">Display results after the user votes</option>

				    			<option value="2">Display results along with options</option>

				    			<option value="3">Display results after the poll has ended</option>


				    		</select>

				  		</div>

				  		<div class="form-group">

				   			<label for="pollShareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="In short, the poll question."></i>]

				    		<input name="pollShareWith" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editPollSharedWith" >

				  		</div>


				  		<div class="row" id="pollOptionsDiv">


							<div class="form-group col-md-6" id="option1">
					   			
					   			<label for="pollOptions">Option</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Options for poll."></i>]

								<!-- <div class="input-group"> -->
					    			
				    			<input  type="text" name="pollOptions" class="inputOption form-control input-sm" style="background-color:white !important;border-radius:0px;" placeholder="Option"></input>

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
					    			
					    			<input type="text" name="pollOptions" class="inputOption form-control input-sm" style="background-color:white !important;border-radius:0px;"placeholder="Option 2"></input>

					    			<span class="input-group-addon" id="addOption">

										<i class="fa fa-plus" onclick="editPollAddInput();"></i>

					    			</span>

					    			<span class="input-group-addon hidden" id="deleteOption">

										<i class="fa fa-minus" onclick="editPollDeleteInput(this);"></i>

					    			</span>

				    			</div>

				    		</div>


			    		</div>
					
					</form>

					<br/>

					<button onclick="editedPollSend();" class="btn btn-primary">Create Poll</button>

				</div>
				
			</div>

		</div>

</div> <!-- end modals -->