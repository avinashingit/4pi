
//--------------------------------------------------------------------------//
//add option input
function createPollAddInput()
{
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
function createPollDeleteInput(el)
{
	$(el).parent().parent().parent().remove();
}

//----------------------------------------------------------------------------//
// Create Poll Function
function createPollSP()
{
	$("#pollCreateModal").find("#loadingImage").removeClass('hidden');
	$("#pollCreateModal").find("#createPollButton").hide();
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
			$("#pollCreateModal").find("#createPollQuestion").focus();
		}
		else if(pollOptionType!=1 && pollOptionType!=2)
		{
			alert("Please enter the poll option type.");
			$("#pollCreateModal").find("#createPollOptionType").focus();
		}
		else if(pollType!=1 && pollType!=2 && pollType!=3)
		{
			alert("Please enter the poll type.");
			$("#pollCreateModal").find("#createPollType").focus();

		}
		else
		{
			for(i=0;i<numberOfOptions;i++){
				options[i]=$('#pollCreateModal').find('.inputOption').eq(i).val();
			}

			var unfilled="yes";
			var limit="no";
			for(i=0;i<numberOfOptions;i++)
			{
				if(options[i].length==0)
				{
					unfilled="no";
				}
			}

			for(i=0;i<numberOfOptions;i++)
			{
				if(options[i].length>36)
				{
					limit="yes";
				}
			}				

			if(unfilled=="no")
			{
				alert("Please fill all the options");
			}

			else if(limit=="yes")
			{
				alert("Poll option length should not exceed 40 characters.");
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

					console.log(data);
					if(checkData(data)==1)
					{
						data=JSON.parse(data);
						$('#pollCreateModal').modal('hide');
						$("#pollCreateModal").find("#loadingImage").addClass('hidden');
						$("#pollCreateModal").find("#createPollButton").show();
						alert("Your poll is sent for approval. Please wait until it is approved.");
						insertPoll(data,"first");
						$('#pollCreateModal').find('input').each(function(){
							$(this).val("");
						});

						$('#pollCreateModal').find('textarea').each(function(){
							$(this).val("");
						});

						$('#pollCreateModal').find('select').each(function(){
							$(this).val("1");
						});

						$('#pollCreateModal').find('#createPollSharedWith').val("All");
					}
					else
					{
						$("#pollCreateModal").find("#loadingImage").addClass('hidden');
						$("#pollCreateModal").find("#createPollButton").show();
					}

					$('time.timeago').timeago();

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
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
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
	// ////console.log("called "+json+" "+idC+" "+id);
	////console.log(json);
	// var pollQuestion =PollQuestion;
	// var pollQuestion="Avinash";
	if(hUh==1)
	{
		$('#'+id).find('.pollIdContent').hide();
	}
	// json=JSON.parse(json);
	$('#'+idC).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text:""
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
        	type:'pie',
            name: 'No. of Votes',
            data: json
        }]
    });
}

function displayPollResults(id,option)
{
	$('#'+id).find('#pollsResultViewbutton').html("Fetching results").attr("onclick","");
	$.post('/4pi/handlers/pollHandlers/viewPollResults.php',{
		_pollId:id
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
		$('#'+id).find('#pollsResultViewbutton').html("View results").attr("onclick","displayPollResults(\'"+id+"\');");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			data=data.trim();
			displayChart(JSON.parse(data),id+'b',id,option);
			$('#'+id).find('#pollsResultViewbutton').remove();
		}
		
	});
}

function approvePoll(id,val)
{
	$.post('/4pi/handlers/pollHandlers/approvePoll.php',{
		_pollId:id,
		_status:val
	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			$("#"+id).find('.approve').remove();
		}
	});
}

function insertPoll(data,position)
{
	var time=iso8601ToReadable(data.pollCreationTime);

	if(data.pollOptionsType==1)
	{
		if(data.pollType==1)
		{
			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-9 text-left">';

							poll+='<p style="font-size:16px" class="break-word" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion.replace(/'/g, "&#39;");+'</span></p>';

						poll+='</div>';

						poll+='<div class="col-md-3 text-right">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					/*poll+='<div class="row">';

						poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

					poll+='</div>';*/

					poll+='<div class="row" >';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="col-md-12 text-center">';

						poll+='<button class="btn btn-md btn-danger" id="pollsResultViewbutton" onclick="displayPollResults(\''+data.pollIdHash+'\',1);">View results</button>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p style="font-size:16px" class="break-word" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion.replace(/'/g, "&#39;");+'</span></p>';

							/*poll+='<div class="row">';

								poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

							poll+='</div>';*/

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						// alert(data.isOwner+"   "+data.approvalStatus);

						if(data.approvalStatus==1)
						{
							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

							poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}
		else if(data.pollType==2)
		{
			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-9 text-left">';

							poll+='<p style="font-size:16px" class="break-word" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						poll+='<div class="col-md-3 text-right">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					/*poll+='<div class="row">';

						poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

					poll+='</div>';*/

					poll+='<div class="row" >';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12 text-center">';

							poll+='<button class="text-centert btn btn-md btn-danger" id="pollsResultViewbutton" onclick="displayPollResults(\''+data.pollIdHash+'\',1);">View results</button>';

						poll+='</div>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p style="font-size:16px"class="break-word" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

							/*poll+='<div class="row">';

								poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

							poll+='</div>';*/

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="col-md-12 text-center">';

							poll+='<button id="pollsResultViewbutton" class="btn btn-default btn-md" onclick="displayPollResults(\''+data.pollIdHash+'\',0);">View current votes</button>';

						poll+='</div><br/>';

						poll+='<br/>';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						if(data.approvalStatus==1)

						{
							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

							poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}

		else if(data.pollType==3)
		{

			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					/*poll+='<div class="row">';

						poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

					poll+='</div>';*/

					poll+='<div class="row">';

						poll+='<h4 class="text-center">Thanks for voting</h4>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						if(data.approvalStatus==1)
						{
							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

							poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}
	}

	else if(data.pollOptionsType==2)
	{
		if(data.pollType==1)
		{
			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-9 text-left">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						poll+='<div class="col-md-3 text-right">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					/*poll+='<div class="row">';

						poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

					poll+='</div>';*/

					poll+='<div class="row" >';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="text-center">';

						poll+='<button class="btn btn-md btn-danger" id="pollsResultViewbutton" onclick="displayPollResults(\''+data.pollIdHash+'\',1);">View results</button>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

							/*poll+='<div class="row">';

								poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

							poll+='</div>';*/

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						if(data.approvalStatus==1)
						{
							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

							poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}

		else if(data.pollType==2)
		{
			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-9 text-left">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						poll+='<div class="col-md-3 text-right">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					/*poll+='<div class="row">';

						poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

					poll+='</div>';*/

					poll+='<div class="row" >';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12 text-center">';

							poll+='<button class="btn btn-md btn-danger" id="pollsResultViewbutton" onclick="displayPollResults(\''+data.pollIdHash+'\',1);">View results</button>';

						poll+='</div>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="col-md-12 text-center">';

							poll+='<button id="pollsResultViewbutton" class="btn btn-default btn-md" onclick="displayPollResults(\''+data.pollIdHash+'\',0);">View results</button>';

						poll+='</div>';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						if(data.approvalStatus==1)
						{
							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

							poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}

		else if(data.pollType==3)
		{

			if(data.hasVoted==1)
			{
				var poll="";

				poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

							/*poll+='<div class="row">';

								poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

							poll+='</div>';*/

						poll+='</div>';

						poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

							poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

						poll+='</div>';

					poll+='</div>';

					poll+='<div class="row">';

						poll+='<h4 class="text-center">Thanks for voting</h4>';

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}

			else if(data.hasVoted!=1)
			{
				var poll="";

				var optionLength=data.pollOptions.length;

				poll+='<div class="row poll" id="'+data.pollIdHash+'">';

				if(data.isSAC==1 && data.approvalStatus==0)
				{
					poll+='<div class="approve row">';

					poll+='<br/>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-success btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',1)">Approve</button>';

					poll+='</div>';

					poll+='<div class="col-md-6 text-center">';

						poll+='<button class="btn btn-danger btn-md" onclick="approvePoll(\''+data.pollIdHash+'\',-1)">Reject</button>';

					poll+='</div>';

					poll+='</div>';
				}

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-7" id="pollQuestion">';

							poll+='<p class="break-word" style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;<span>'+data.pollQuestion+'</span></p>';

							/*poll+='<div class="row">';

								poll+='<p>Poll created by <a href="/4pi/aboutMe/index.php?userId='+data.userId+'">'+data.userName+'</a></p>';

							poll+='</div>';*/

						poll+='</div>';

						if(data.isOwner==1 && data.approvalStatus!=1)
						{
							poll+='<div class="col-md-2" id="pollCreatorOptions">';

								poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+time+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

						else
						{
							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';
						}

					poll+='</div>';

					poll+='<br/>';

					poll+='<div class="row">';

						poll+='<div class="col-md-12" id="'+data.pollIdHash+'b"></div>';

					poll+='</div>';

					poll+='<div id="pollOptionType" class="hidden">'+data.pollOptionsType+'</div>';

					poll+='<div id="pollResultType" class="hidden">'+data.pollType+'</div>';

					poll+='<div id="pollShareWith" class="hidden">'+data.sharedWith+'</div>';

					poll+='<div class="row pollIdContent">';

						poll+='<div class="row">';

								poll+='<div class="col-md-4" id="pollOptionContainer1">';

									for(var i=0;i<data.pollOptions.length;i+=3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer2">';

									for(var i=1;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';

								poll+='<div class="col-md-4" id="pollOptionContainer3">';

									for(var i=2;i<optionLength;i=i+3)
									{
										poll+='<label class="break-word" style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label><br/>';
									}

								poll+='</div>';
								
						poll+='</div>';

						poll+='<br/>';

						if(data.approvalStatus==1)
						{
							poll+='<div class="row">';

							poll+='<div class="text-center">';

								poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1);" class="btn btn-md btn-success">Vote</button>';

							poll+='</div>';

						poll+='</div>';
						}

						

					poll+='</div>';

				poll+='</div>';

				if(position=="last")
				{
					$('#pollArea').append(poll);
				}

				else if(position=="first")
				{
					$('#pollArea').prepend(poll);
				}
			}
		}
	}	
}

//-------------------------------------------------------------------------------//
//fetchPolls

function fetchLatestPolls(call,value)
{
	if(value=="empty")
	{
		$(".poll").remove();
	}
	$('#loadMorePollsButton').html("Loading").attr("onclick","");
	$('#inViewElement').html('1004');
	var existingPolls=new Array();
	var i=0;
	$('#pollArea').find('.poll').each(function(){
		existingPolls[i]=$(this).attr("id");
		i++;
	});
	if(value=="empty")
	{
		$('#pollArea').find('.poll').each(function(){
			$(this).remove();
		});
	}

	// console.log(existingPolls);

	$.post('./handlers/pollHandlers/latestPolls.php',{
		_call:call,
		_existingPolls:existingPolls
	})
	.error(function(){
		alert("Server overload. Please try again.");
		$('#loadMorePollsButton').html("Load more").attr("onclick","fetchLatestPolls(1,'noempty');");
	})
	.success(function(data){
		$('#inViewElement').html("1004");
		console.log(data);
		data=data.trim();
		if(data==404)
		{
			$('#messageEmpty').html("No more polls to display");
			$('#loadMorePollsButton').hide();
		}

		else
		{
			if(checkData(data)==1)
			{
				if(data!=404)
				{
					datas=JSON.parse(data);
					for(i=0;i<datas.length;i++)
					{
						insertPoll(datas[i],"last");
						console.log(datas[i].isOwner);
					}
					$('time.timeago').timeago();

					$('#loadMorePollsButton').html("Load more").attr("onclick","fetchLatestPolls(1,'noempty');");
				}
				else
				{
					$('#loadMorePollsButton').hide();
					$('#pollArea').find('#pollEmptyMessage').find('p').html("No more polls to display.");
				}
				
			}
			// $('#loadMorePollsButton').html("Load more").attr("onclick","fetchLatestPolls(1,'noempty');");
		}
	});
}

function submitVote(pollId,type,result,pollType)
{
	var option=$('#'+pollId).find('input');
	var good=0; //turns 1 if option is checked
	for(i=0;i<option.length;i++)
	{
		if(option[i].checked)
		{
			good=1;
		}
	}

	if(good==0)
	{
		alert("Hey come on. You have to select atleast one option.");
	}
	else if(good==1)
	{
		// $('.pollIdContent').hide();
		if(type=='single')
		{
			var checkedOption=new Array();
			var optionArray1=$('#'+pollId).find("#pollOptionContainer1").find('input');
			var optionArray2=$("#"+pollId).find("#pollOptionContainer2").find('input');
			var optionArray3=$("#"+pollId).find("#pollOptionContainer3").find('input');

			for(i=0;i<optionArray1.length;i++)
			{
				if(optionArray1[i].checked)
				{
					checkedOption[0]=3*i;
				}
			}

			for(i=0;i<optionArray2.length;i++)
			{
				if(optionArray2[i].checked)
				{
					checkedOption[0]=3*i+1;
				}
			}

			for(i=0;i<optionArray3.length;i++)
			{
				if(optionArray3[i].checked)
				{
					checkedOption[0]=3*i+2;
				}
			}

			/*for (i =0;i<option.length;i++)
			{
				if(option[i].checked)
				{
					checkedOption[0]=i;
				}
			}*/
			////console.log("Option sent"+checkedOption[0]);
			$.post('./handlers/pollHandlers/votePoll.php',{
				_pollId:pollId,
				_votes:checkedOption[0]
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
			})
			.success(function(data){
				////console.log(data);
				
				console.log(data);
				if(checkData(data)==1)
				{
					if(data==3)
					{
						$('#'+pollId).find('.pollIdContent').html("<p class='text-center'>Thanks for voting. Results soon. </p>");
					}
					else
					{
						datas=JSON.parse(data);
						alert(datas.pollType);
						displayChart(datas,pollId+'b',pollId,1);
					}
					
					/*if(datas.pollType!=3)
					{
						
					}

					else
					{
						
					}*/
					
				}
			});
		}

		else if(type=="multiple")
		{
			var checkedOptions=new Array();
			var optionArray1=$('#'+pollId).find("#pollOptionContainer1").find('input');
			var optionArray2=$("#"+pollId).find("#pollOptionContainer2").find('input');
			var optionArray3=$("#"+pollId).find("#pollOptionContainer3").find('input');

			var count=0;

			for(i=0;i<optionArray1.length;i++)
			{
				if(optionArray1[i].checked)
				{
					checkedOptions[count]=3*i;
					count++;
				}
			}

			for(i=0;i<optionArray2.length;i++)
			{
				if(optionArray2[i].checked)
				{
					checkedOptions[count]=3*i+1;
					count++;
				}
			}

			for(i=0;i<optionArray3.length;i++)
			{
				if(optionArray3[i].checked)
				{
					checkedOptions[count]=3*i+2;
					count++;
				}
			}


			/*var option=$('#'+pollId).find('input');
			var count=0;
			for (i =0;i<option.length;i++)
			{
				if(option[i].checked)
				{
					checkedOptions[count]=i;
					count=count+1;
				}
			}*/
			////console.log(checkedOptions);
			$.post('/4pi/handlers/pollHandlers/votePoll.php',{
				_pollId:pollId,
				_votes:checkedOptions
			})
			.error(function(){
				alert("Server overload. Please try again. :(");
			})
			.success(function(data){
				////console.log(data);
				if(checkData(data)==1)
				{
					if(data!=3)
					{
						$('#'+pollId).find('.pollIdContent').html("<p class='text-center'>Thanks for voting. Results soon. </p>");
					}
					else
					{
						datas=JSON.parse(data);
						displayChart(datas,pollId+'b',pollId,1);
					}
					
					/*if(pollType!=3)
					{
						
					}

					else
					{
						
					}*/
				}
			});
		}
	}	
}

function deletePoll(pollId)
{
	if(confirm("Do you want to delete the poll")==true)
	{
		$.post('./handlers/pollHandlers/deletePoll.php',{
			_pollId:pollId
		})
		.error(function(){
			alert("Server overload. Please try again.:(");
		})
		.success(function(data){
			if(checkData(data)==1)
			{
				////console.log(data);
				$('#'+pollId).remove();
			}
		});
	}
}

function modifyPoll(data)
{
	$("#"+data.pollIdHash).remove();
	insertPoll(data,"first");
}

function editedPollSend()
{
	var link=$("#pollEditModal");
	link.find("#loadingImage").removeClass('hidden');
	link.find("#editPollButton").hide();
	var pollId=link.find("#editPollModalPollId").html();
	var pollQuestion=link.find("#editPollQuestion").val().trim();
	var pollOptionType=link.find("#editPollOptionType").val();
	var pollType=link.find("#editPollType").val();
	var pollSharedWith=link.find('#editPollSharedWith').val().trim();
	var pollOptions=new Array();
	var numberOfOptions=link.find('.inputOption').length;
	for(i=0;i<numberOfOptions;i++){
		pollOptions[i]=link.find('.inputOption').eq(i).val().trim();
	}

	var error=0;
	if(pollQuestion.length==0)
	{
		alert("Please enter the poll question");
		link.find("#editPollQuestion").focus();
		error=1;
	}
	else if(pollOptionType!=1 && pollOptionType!=2)
	{
		alert("Please enter the poll option type.");
		link.find("#editPollOptionType").focus();
		error=1;
	}
	else if(pollType!=1 && pollType!=2 && pollType!=3)
	{
		alert("Please enter the poll type.");
		link.find("#editPollType").focus();
		error=1;
	}
	else
	{
		var unfilled=0;
		for(var i=0;i<numberOfOptions;i++)
		{
			if(pollOptions[i].length==0 || pollOptions[i].length>36)
			{
				unfilled=1;
			}
		}

		if(unfilled==1)
		{
			alert("Some options are either empty or characters are more than 36");
		}

		else
		{
			if(error==0)
			{
				$.post('/4pi/handlers/pollHandlers/editPoll.php',{
					_pollId:pollId,
					_pollQuestion:pollQuestion,
					_pollType:pollType,
					_sharedWith:pollSharedWith,
					_pollOptionType:pollOptionType,
					_pollOptions:pollOptions
				})
				.error(function(){
					alert("Server overload. Please try again.:(");
				})
				.success(function(data){
					console.log(data);
					if(checkData(data)==1)
					{
						data=JSON.parse(data);
						modifyPoll(data);
						$("#pollEditModal").modal('hide');
						link.find("#loadingImage").addClass('hidden');
						link.find("#editPollButton").show();
						$('.timeago').timeago();
					}
					else
					{
						link.find("#loadingImage").addClass('hidden');
						link.find("#editPollButton").show();
					}
				});
			}
		}
	}
}

function editPollAddInput()
{
	var numberOfOptionsCurrent=$('#pollEditModal').find('.inputOption').length;
	var current=$('#pollEditModal').find('#option2').clone();
	var optionVal=numberOfOptionsCurrent+1;
	current.attr('id',optionVal);
	current.addClass('extraOption');
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
	$('#pollEditModal').find('.extraOption').remove();
	$('#pollEditModal').find('#editPollModalPollId').html(pollId);
	$('#pollEditModal').find('input').val("");
	$('#pollEditModal').find('.pollOptions').find('div').each(function(){
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
	link.find('#editPollQuestion').val(olink.find('#pollQuestion').find('p').find('span').html());
	link.find('#editPollOptionType').val(olink.find('#pollOptionType').html());
	link.find('#editPollSharedWith').val(olink.find('#pollShareWith').html());
	link.find('#editPollType').val(olink.find('#pollResultType').html());
	var options=olink.find('input').length;
	/*if(link.find('.pollOptions').find('input').length!=options)
	{
		link.find('#option1').find('input').val(olink.find('#pollOption0').next().html());
		link.find('#option2').find('input').val(olink.find('#pollOption1').next().html());

		if(options>=3)
		{
			for(i=3;i<=options;i++)
			{
				editPollAddInput();
				link.find('#'+i).find('input').val(olink.find('#pollOption'+i-2).next().html());
			}
		}
	}*/
	link.find('#option1').find('input').val(olink.find('#pollOption0').next().html());
	link.find('#option2').find('input').val(olink.find('#pollOption1').next().html());
	if(options>=3)
	{
		for(i=3;i<=options;i++)
		{
			editPollAddInput();
			var x=i-1;
			link.find('#'+i).find('input').val(olink.find('#pollOption'+x).parent().find('span').html());
		}
	}
}