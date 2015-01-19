
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
			else if(pollOptionType!=1 && pollOptionType!=2)
			{
				alert("Please enter the poll option type.");
			}
			else if(pollType!=1 && pollType!=2 && pollType!=3)
			{
				alert("Please enter the poll type.");
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

						console.log(data);
						if(checkData(data)==1)
						{
							data=JSON.parse(data);
							$('#pollCreateModal').modal('hide');
							insertPoll(data,"first");
							$('#pollCreateModal').find('input').each(function(){
								$(this).val("");
							});

							$('#pollCreateModal').find('textarea').each(function(){
								$(this).val("");
							});

							$('#pollCreateModal').find('select').each(function(){
								$(this).val("");
							});

							$('#pollCreateModal').find('#createPollSharedWith').val("All");
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
	function displayChart(json,idC,id,hUh,PollQuestion)
	{
		// console.log("called "+json+" "+idC+" "+id);
		console.log(json);
		var pollQuestion =PollQuestion;
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

	function insertPoll(data,position)
	{
		if(data.pollOptionsType==1)
		{
			if(data.pollType==1)
			{
				if(data.hasVoted==1)
				{
					var poll="";

					poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-9 text-left">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';

						poll+='</div>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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
			}

			else if(data.pollType==2)
			{
				if(data.hasVoted==1)
				{
					var poll="";

					poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-9 text-left">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';

						poll+='</div>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<button id="pollsResultViewbutton" class="btn btn-default btn-md" onclick="displayPollResults(\''+data.pollIdHash+'\',0);">View results</button>';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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
			}

			else if(data.pollType==3)
			{

				if(data.hasVoted==1)
				{
					var poll="";

					poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="radio" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'single\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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

						poll+='<div class="row">';

							poll+='<div class="col-md-9 text-left">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';

						poll+='</div>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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
			}

			else if(data.pollType==2)
			{
				if(data.hasVoted==1)
				{
					var poll="";

					poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-9 text-left">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 text-right">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

							poll+='</div>';

						poll+='</div>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<button id="pollsResultViewbutton" class="btn btn-default btn-md" onclick="displayPollResults(\''+data.pollIdHash+'\',0);">View results</button>';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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
			}

			else if(data.pollType==3)
			{

				if(data.hasVoted==1)
				{
					var poll="";

					poll+='<div class="row poll" id="'+data.pollIdHash+'"><br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							poll+='<div class="col-md-3 col-md-offset-2 text-right" id="pollCreatedTime">';

								poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<br/>';

						poll+='<div class="row">';

							poll+='<div class="col-md-7" id="pollQuestion">';

								poll+='<p style="font-size:16px" id="pollQuestion"><img src="/4pi/img/poll.jpg" width="30" height="30">&nbsp;&nbsp;'+data.pollQuestion+'</p>';

							poll+='</div>';

							if(data.isOwner==1)
							{
								poll+='<div class="col-md-2" id="pollCreatorOptions">';

									/*poll+='<i class="fa fa-pencil" onclick="editPoll(\''+data.pollIdHash+'\');"></i>&nbsp;&nbsp';*/poll+='<i class="fa fa-trash" onclick="deletePoll(\''+data.pollIdHash+'\');"></i>';

								poll+='</div>';

								poll+='<div class="col-md-3 text-right" id="pollCreatedTime">';

									poll+='<time class="time timeago text-right" title="'+data.pollCreationTime+'" datetime="'+data.pollCreationTime+'">'+data.pollCreationTime+'</time>';

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

						poll+='<div id="pollShareWith" class="hidden">'+data.sharedwith+'</div>';

						poll+='<div class="row pollIdContent">';

							poll+='<div class="row">';

									poll+='<div class="col-md-4">';

										for(var i=0;i<data.pollOptions.length;i+=3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=1;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';

									poll+='<div class="col-md-4">';

										for(var i=2;i<optionLength;i=i+3)
										{
											poll+='<label style="margin-bottom:5px;"><input type="checkbox" id="pollOption'+i+'" name="'+data.pollIdHash+'" value="'+i+'">&nbsp;<span>'+data.pollOptions[i]+'</span></label>';
										}

									poll+='</div>';
									
							poll+='</div>';

							poll+='<br/>';

							poll+='<div class="row">';

								poll+='<div class="text-center">';

									poll+='<button onclick="submitVote(\''+data.pollIdHash+'\',\'multiple\',\'yes\',1,\''+data.pollQuestion+'\');" class="btn btn-md btn-success">Vote</button>';

								poll+='</div>';

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
			}

		}
	}

	//-------------------------------------------------------------------------------//
	//fetchPolls
	
	function fetchLatestPolls(call,value)
	{
		$('#loadMorePollsButton').html("Loading").attr("onclick","");
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

		$.post('./handlers/pollHandlers/latestPolls.php',{
			_call:call,
			_existingPolls:existingPolls
		})
		.error(function(){
			alert("Server overload. Please try again.");
			$('#loadMorePollsButton').html("Load more").attr("onclick","fetchLatestPolls(1,'noempty');");
		})
		.success(function(data){
			var inView="<?php echo $_SESSION['jx'];?>";
			console.log(data);
			data=data.trim();
			if(data==404)
			{
				$('#pollArea').find('#pollEmptyMessage').find('p').html("No more polls to display");
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
						}
						$('time.timeago').timeago();
					}
					else
					{
						$('#loadMorePollsButton').hide();
						$('#pollArea').find('#pollEmptyMessage').find('p').html("No more polls to display.");
					}
					
				}
				$('#loadMorePollsButton').html("Load more").attr("onclick","fetchLatestPolls(1,'noempty');");
			}
		});
	}

	

	function submitVote(pollId,type,result, pollType,question)
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
				var option=$('#'+pollId).find('input');
				for (i =0;i<option.length;i++)
				{
					if(option[i].checked)
					{
						checkedOption[0]=i;
					}
				}
				console.log("Option sent"+checkedOption[0]);
				$.post('./handlers/pollHandlers/votePoll.php',{
					_pollId:pollId,
					_votes:checkedOption[0]
				})
				.error(function(){
					alert("Server overload. Please try again. :(");
				})
				.success(function(data){
					console.log(data);
					datas=JSON.parse(data);
					console.log(datas);
					if(checkData(data)==1)
					{
						if(pollType!=3)
						{
							displayChart(datas,pollId+'b',pollId,1,question);
						}

						else
						{
							$('#'+pollId).html("<h3 class='text-center'>Thanks for voting. Results soon. </h3>")
						}
						
					}
				});
			}

			else if(type=="multiple")
			{
				var checkedOptions=new Array();
				var option=$('#'+pollId).find('input');
				var count=0;
				for (i =0;i<option.length;i++)
				{
					if(option[i].checked)
					{
						checkedOptions[count]=i;
						count=count+1;
					}
				}
				console.log(checkedOptions);
				$.post('/4pi/handlers/pollHandlers/votePoll.php',{
					_pollId:pollId,
					_votes:checkedOptions
				})
				.error(function(){
					alert("Server overload. Please try again. :(");
				})
				.success(function(data){
					console.log(data);
					if(checkData(data)==1)
					{
						datas=JSON.parse(data);
						if(pollType!=3)
						{
							displayChart(datas,pollId+'b',pollId,1,question);
						}

						else
						{
							$('#'+pollId).html("<h3 class='text-center'>Thanks for voting. Results soon. </h3>")
						}
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
					console.log(data);
					$('#'+pollId).remove();
				}
			});
		}
	}

	function editPollAddInput()
	{
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
		link.find('#editPollQuestion').val(olink.find('#pollQuestion').find('div').html());
		link.find('#editPollOptionType').val(olink.find('#pollOptionType').html());
		link.find('#editPollSharedWith').val(olink.find('#pollShareWith').html());
		link.find('#editPollType').val(olink.find('#pollResultType').html());
		var options=olink.find('input').length;
		if(link.find('.pollOptions').find('input').length!=options)
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
			
			
		}
	}