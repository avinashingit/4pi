function approveEvent(id,val)
{
	$.post('/4pi/handlers/eventHandlers/approveEvent.php',{
		_eventId:id,
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


function eventInsert(position,data,past)
{
	var event="";

	event+='<div class="row event" id="'+data.eventIdHash+'" style="border:1px solid #cecece;margin-bottom:10px;">';

	if(data.isCOCAS==1 && data.isApproved!=1)
	{
		event+='<div class="row approve" style="padding-top:10px;">';

		event+='<div class="col-md-6 text-center">';

			event+='<button class="btn btn-success btn-md" onclick="approveEvent(\''+data.eventIdHash+'\',1)">Approve</button>';

		event+='</div>';

		event+='<div class="col-md-6 text-center">';

			event+='<button class="btn btn-danger btn-md" onclick="approveEvent(\''+data.eventIdHash+'\',-1)">Reject</button>';

		event+='</div>';

		event+='</div>';
	}

	else if(data.isCOCAS!=1 && data.isApproved!=1)
	{
		event+="<br/><p class='text-center' style='color:red'>Your events is sent for approval</p>";
	}

	event+='<div id="eventSharedWith" class="hidden" >'+data.sharedWith+'</div>';

	event+='<div id="eventStatus" class="hidden" >'+data.eventStatus+'</div>';

	event+='<div id="eventType" class="hidden">'+data.eventType+'</div>';

	event+='<div id="eventCategory" class="hidden">'+data.eventCategory+'</div>';

	event+='<div class="row" id="eventNameTime">';

	event+='<div class="col-md-8 text-left" id="eventNameAndClub">';

	event+='<div style="font-size:18px;"><a href="#"><span id="eventOrganizer" class="text-bold">'+data.eventOrgName+'</span></a> - <span id="eventName" class="text-bold">'+data.eventName+'</span></div>';

	event+='</div>';

	var time=iso8601ToReadable(data.eventTimestamp);

	if(data.eventOwner==1)
	{
		event+='<div class="col-md-3 col-md-offset-1 text-right"  id="editEvent">';

		event+='<p class="text-right">';

		event+='<span id="eventPostedTime">';

			event+='<small><time class="timeago" id="eventPostedTimeValue" datetime="'+data.eventTimestamp+'" title="'+time+'">'+data.eventTimestamp+'</time></small>';

		event+='</span>&nbsp;&nbsp;<i class="fa fa-pencil" title="Edit Event" onclick="editEvent(\''+data.eventIdHash+'\');"></i>&nbsp;';

		event+='<i class="fa fa-trash" title="Delete Event" onclick="deleteEvent(\''+data.eventIdHash+'\');"></i></p>';

		event+='</div>';
	}

	else
	{
		event+='<div class="col-md-3 col-md-offset-1 text-right" id="eventPostedTime">';

			event+='<small><time class="timeago" id="eventPostedTimeValue" datetime="'+data.eventTimestamp+'" title="'+time+'">'+data.eventTimestamp+'</time></small>';

		event+='</div>';
	}

	event+='<br/>';

	/*event+='<div class="row">';

	event+='<div class="col-md-12">';

	event+='<p id="eventCreatedBy" style="white-space:pre-wrap">Event created by <a href="/4pi/aboutMe/index.php?userId='+data.eventUserId+'">'+data.eventOwnerName+'</a></p>';

	event+='</div>';

	event+='</div>';*/

	event+='<div class="row" style="padding-top:20px;">';

	event+='<div class="col-md-12">';

	event+='<p id="eventContent" class="break-word" style="white-space:pre-wrap">'+data.eventContent+'</p>';

	event+='</div>';

	event+='</div>';

		
	event+='<div class="row" id="eventDetails">';

	event+='<div class="col-md-10 col-md-offset-1">';

	event+='<div class="btn-group btn-group-justified">';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn btn-default"  style="cursor:default !important"  title="Event Venue"><p  style="cursor:default !important" class="venueDateTimeEvent text-center" ><i style="cursor:default !important"  class="fa fa-map-marker" title="Venue"></i>&nbsp;&nbsp;<span id="eventVenue">'+data.eventVenue+'</span></p></button>';
				  
	event+='</div>';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn btn-default" style="cursor:default !important"  title="Event Date"><p style="cursor:default !important"  class="venueDateTimeEvent text-center"><i  style="cursor:default !important"  class="fa fa-calendar" title="Date"></i>&nbsp;&nbsp;<span id="eventDate">'+data.eventDate+'</span></p></button>';
	
	event+='</div>';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn btn-default" style="cursor:default !important"  title="Event Time" ><p  style="cursor:default !important"  class="venueDateTimeEvent text-center"><i  style="cursor:default !important"  class="fa fa-clock-o" title="Time"></i>&nbsp;<span id="eventTime">'+data.eventTime+'</span></p></button>';
				  
	event+='</div>';

	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn btn-default" style="cursor:default !important" title="Event Duration"><p  style="cursor:default !important"  class="venueDateTimeEvent text-center"><i style="cursor:default !important"  class="fa fa-arrows-h" title="Duration"></i>&nbsp;<span id="eventDurationHours">'+data.eventDurationHrs+'</span>:<span id="eventDurationMinutes">'+data.eventDurationMin+'</span>&nbsp;hrs</p></button>';
				  
	event+='</div>';
				
	event+='</div>';

	event+='</div>';

	event+='</div>';

	event+='<br/>';

	event+='<div class="row" id="eventIcons">';

	event+='<div class="col-md-2 col-md-offset-1">';

	event+='<span id="eventAttendeeNumber" ><i class="fa fa-check" style="padding-top:7px;" title="No of Attenders"></i>&nbsp;<span id="eventAttendersValue">'+data.attendCount+'</span></span>';

	event+='</div>';

	event+='<div class="col-md-4 col-md-offset-1">';

	event+='<p style="padding-top:7px;"><b>Event status:</b>'+data.eventStatus+'</p>';

	event+='</div>';

	if(past!=1)
	{
		event+='<div class="col-md-2 col-md-offset-1 text-left">';

		if(data.isAttender!=1)
		{
			event+='<button class="btn btn-sm btn-success" id="attend" onclick="attendEvent(\''+data.eventIdHash+'\');"><i class="fa fa-check"></i>&nbsp; Attend</button>';
			event+='<button class="btn btn-sm btn-danger visibleHidden" style="cursor:not-allowed !important"  id="attending"> Attending</button>';		
		}

		else
		{
			event+='<button class="btn btn-sm btn-danger"  style="cursor:not-allowed !important"  id="attending">Attending</button>';
		}

		event+='</div>';
	}

	

	event+='</div>';

	event+='<br/>';

	event+='</div>';

	event+='</div>';

	// //console.log("HEEEE");

	if(position=="first")
	{
		$("#eventArea").prepend(event).hide().fadeIn('slow');
	}

	else
	{
		$('#eventArea').append(event).hide().fadeIn('slow');
	}

	// //console.log(event);
}

function editEvent(id)
{
	
	$('#editEventModal').modal('show');
	
	$('#editEventModal').find('#editEventId').html(id);
	
	var eventOrganizerName=$('#'+id).find('#eventOrganizer').html();
	
	var eventName=$('#'+id).find('#eventName').html();
	
	var eventContent=$('#'+id).find('#eventContent').html();

	// alert(eventContent);
	
	// var eventFiles=$('#'+id).find('#eventFiles').html();
	
	var eventSharedWith=$('#'+id).find('#eventSharedWith').html();
	
	var eventVenue=$('#'+id).find('#eventVenue').html();
	
	var eventDate=$('#'+id).find('#eventDate').html();
	
	var eventTime=$('#'+id).find('#eventTime').html();

	var eventDurationHours=$('#'+id).find('#eventDurationHours').html();

	//console.log(eventDurationHours);
	
	var eventDurationMinutes=$('#'+id).find('#eventDurationMinutes').html();
	
	var eventType=$('#'+id).find('#eventType').html();

	var eventStatus=$('#'+id).find('#eventStatus').html();

	var eventCategory=$('#'+id).find("#eventCategory").html();
	
	$('#editEventModal').find('#editEventOrganizerName').val(eventOrganizerName);
	
	$('#editEventModal').find('#editEventName').val(eventName);
	
	$('#editEventModal').find('#editEventContent').val(eventContent);
	
	//$('#editEventModal').find('#editEventFileInput').val(eventFiles);
	
	$('#editEventModal').find('#editEventSharedWith').val(eventSharedWith);
	
	$('#editEventModal').find('#editEventVenue').val(eventVenue);
	
	$('#editEventModal').find('#editEventDate').val(eventDate);
	
	$('#editEventModal').find('#editEventTime').val(eventTime);

	$('#editEventModal').find('#editEventDurationHours').val(eventDurationHours);

	$('#editEventModal').find('#editEventDurationMinutes').val(eventDurationMinutes);
	
	$('#editEventModal').find('#editEventType').val(eventType);

	$('#editEventModal').find('#editEventStatus').val("As Scheduled");

	$('#editEventModal').find('#editEventCategory').val(eventCategory);
	
	$('#editEventModal').find('#editEventId').html(id);
}

function modifyEvent(data,id)
{
	$('#'+id).find('#eventOrganizer').html(data.eventOrgName);
	
	$('#'+id).find('#eventName').html(data.eventName);
	
	$('#'+id).find('#eventContent').html(data.eventContent);
	
	// var eventFiles=$('#'+id).find('#eventFiles').html();
	
	$('#'+id).find('#eventSharedWith').html(data.sharedWith);
	
	$('#'+id).find('#eventVenue').html(data.eventVenue);
	
	$('#'+id).find('#eventDate').html(data.eventDate);
	
	$('#'+id).find('#eventTime').html(data.eventTime);

	$('#'+id).find('#eventDurationHours').html(data.eventDurationHrs);
	
	$('#'+id).find('#eventDurationMinutes').html(data.eventDurationMin);
	
	$('#'+id).find('#eventType').html(data.eventType);

	$('#'+id).find('#eventStatus').html(data.eventStatus);

	$('#'+id).find('#eventCategory').html(data.eventCategory);
}

function editedEventSend()
{
	$("#editEventModal").find("#loadingImage").removeClass('hidden');

	$("#editEventModal").find("#editEventButton").hide();
	
	var eventId=$('#editEventModal').find('#editEventId').html();
	
	var eventClubName=$('#editEventModal').find('#editEventOrganizerName').val();
	
	var eventName=$('#editEventModal').find('#editEventName').val();
	
	var eventContent=$('#editEventModal').find('#editEventContent').val();
	
	//$('#editEventModal').find('#editEventFileInput').val(eventFiles);
	
	var eventSharedWith=$('#editEventModal').find('#editEventSharedWith').val();

	var eventVenue=$('#editEventModal').find('#editEventVenue').val();
	
	var eventDate=$('#editEventModal').find('#editEventDate').val();
	
	var eventTimeHours=$('#editEventModal').find('#editEventTime').val();

	var eventDurationHours=$('#editEventModal').find('#editEventDurationHours').val();

	var eventDurationMinutes=$('#editEventModal').find('#editEventDurationMinutes').val();

	var eventStatus=$('#editEventModal').find('#editEventStatus').val();

	var eventType=$('#editEventModal').find('#editEventType').val();

	var eventCategory=$('#editEventModal').find('#editEventCategory').val();

	if(eventClubName.length==0 || eventName.length==0 || eventContent.length==0 || eventContent.length>10000 || eventVenue.length==0 || eventDate.length==0 )
	{
		alert("Please fill in the required fields.")
	}

	/*else if(eventDurationHours<0)
	{
		alert("Event duration hours cannot be less than 0");
	}

	else if(eventDurationMinutes!=00 ||eventDurationMinutes!=15 || eventDurationMinutes!=30 ||eventDurationMinutes!=45)
	{
		alert("Event duration minutes can be either 00 or 15 or 30 or 45 only.");
	}

	else if(validateDate(eventDate)!=1)
	{
		alert("Event date should be of dd/mm/yyyy format only and should be a valid one.");
	}

	else if(validateTime(eventTimeHours)!=1)
	{
		alert("Event time is not acceptable");
	}*/

	else

	{

		
		
		$.post("./handlers/eventHandlers/editEvent.php",{
		
			_eventId:eventId,
		
			_eventOrgName:eventClubName,
		
			_eventName:eventName,

			_content:eventContent,
		
			_sharedWith:eventSharedWith,
		
			_venue:eventVenue,
		
			_eventDate:eventDate,
		
			_eventTime:eventTimeHours,

			_eventDurationHrs:eventDurationHours,

			_eventDurationMin:eventDurationMinutes,

			_status:eventStatus,

			_eventType:eventType,

			_eventCategory:eventCategory
		
		})
		
		.error(function (){



		})

		.success(function (data){

			console.log(data);
			if(checkData(data)==1)
			{
				$('#editEventModal').modal('hide');
				$("#editEventModal").find("#loadingImage").addClass('hidden');

				$("#editEventModal").find("#editEventButton").show();
				data=JSON.parse(data);
				modifyEvent(data,eventId);
			}
			else
			{
				$("#editEventModal").find("#loadingImage").addClass('hidden');

				$("#editEventModal").find("#editEventButton").show();
			}

		});
	}
}

function createEventSP()
{
	$("#eventCreateModal").find("#loadingImage").removeClass('hidden');

	$("#eventCreateModal").find("#createEventButton").hide();

	$('.row .eventMenu').find('#createEventButton').find('i').addClass('fa-spin');
	
	var eventClubName=$('#createEventOrganizerName').val().trim();
	
	var eventName=$('#createEventName').val().trim();
	
	var eventContent=$('#createEventContent').val().trim();
	
	var eventSharedWith=$('#createEventSharedWith').val().trim();
	
	var eventVenue=$('#createEventVenue').val().trim();
	
	var eventDate=$('#createEventDate').val().trim();

	var parts=eventDate.split("/");

	console.log(parts);

	eventDate=parts[1]+"/"+parts[0]+"/"+parts[2];
	
	var eventTime=$('#createEventTime').val().trim();

	var eventDurationHours=$('#createEventDurationHours').val().trim();

	var eventDurationMinutes=$('#createEventDurationMinutes').val().trim();

	/*if(isNaN(Number(eventDurationHours)) || isNaN(Number(eventDurationMinutes)))
	{
		alert("Please enter correct values in duration. :)");
	} */

	
	
	var eventType=$('#createEventType').val().trim();

	var eventCategory=$('#createEventCategory').val().trim();
	

	if(eventClubName.length==0 || eventName.length==0 || eventContent.length==0|| eventVenue.length==0 || eventDate.length==0 )
	{
		alert("Please fill in the required fields.")
	}
	else if(eventContent.length>10000)
	{
		alert("Please limit the event content to 1000 characters.")
	}
	/*else if(eventDurationHours<0)
	{
		alert("Event duration hours cannot be less than 0");
	}
	else if(validateDate(eventDate)!=1)
	{
		alert("Event date should be of dd/mm/yyyy format only and should be a valid date.");
	}
	else if(validateTime(eventTimeHours)!=1)
	{
		alert("Event time is not acceptable");
	}*/
	else
	{
		

		$.post('./handlers/eventHandlers/createEvent.php',{

			_eventOrgName:eventClubName,

			_eventName:eventName,

			_content:eventContent,

			_sharedWith:eventSharedWith,

			_venue:eventVenue,

			_eventDate:eventDate,

			_eventTime:eventTime,

			_eventDurationHrs:eventDurationHours,

			_eventDurationMin:eventDurationMinutes,

			_eventType:eventType,

			_eventCategory:eventCategory

			// _eventFile:eventFiles

		})

		.error(function(){

			alert("Server Overload. Please try again.");

		})

		.success(function(data){

			console.log(data);

			if(checkData(data)==1)
			{


				x=JSON.parse(data);

				eventInsert("first",x,2);

				$('.timeago').timeago();

				$('.row .eventMenu').find('#createEventButton').find('i').removeClass('fa-spin');

				$('#eventCreateModal').modal('hide');

				$("#eventCreateModal").find("#loadingImage").addClass('hidden');

				$("#eventCreateModal").find("#createEventButton").show();

				$('#createEventOrganizerName').val("");

				$('#createEventName').val("");

				$('#createEventName').val("");

				$('#createEventContent').val("");

				$('#createEventSharedWith').val("All");

				$('#createEventVenue').val("");

				$('#createEventDate').val("");

				$('#createEventTime').val("");

				$('#createEventDurationHours').val("2");

				$('#createEventDurationMinutes').val("00");

				$('#createEventType').val("competition");

				$('#createEventCategory').val('technical');
			}
			else
			{
				$("#eventCreateModal").find("#loadingImage").addClass('hidden');

				$("#eventCreateModal").find("#createEventButton").show();
			}

		});

	}
}


function attendEvent(id)
{

	x=$('#'+id).find('#eventIcons').find('#eventAttendeeNumber').find('#eventAttendersValue').html();

	y=parseInt(x);

	y=y+1;

	$('#'+id).find('#eventIcons').find('#eventAttendeeNumber').find('#eventAttendersValue').html(y);

	/*$('#'+id).find('#attend').toggleClass('visibleHidden');

	$('#'+id).find('#attend').next().toggleClass('visibleHidden');*/

	$.post('./handlers/eventHandlers/attendEvent.php',{

		_eventId:id

	})

	.error(function (){



	})

	.success(function (data){

		// x=JSON.parse(data);
		// 
		//console.log(data);
		// 
		data=data.trim();

		if(checkData(data)==1)
		{
			$('#'+id).find("#evenAttendeeNumber").html(data.eventAttendeeCount);

			$('#'+id).find("#attend").toggleClass('visibleHidden');

			$('#'+id).find("#attending").toggleClass('visibleHidden');
		}


	});
}

function deleteEvent(id)
{

	$('#deleteEventModal').modal('show');

	$('#deleteEventModal').find('#deleteEventId').html(id);
}

function deleteEventSend()
{

	var eventId=$('#deleteEventModal').find('#deleteEventId').html();

	$('#deleteEventModal').modal('hide');

	$('#'+eventId).hide();

	$.post('./handlers/eventHandlers/deleteEvent.php',{

		_eventId:eventId

	})

	.error(function (){



	})

	.success(function(data){

		//console.log(data);

		if(data==1)

		{

			$('#'+eventId).remove();

		}

	});
}

function latestEventsFetch(value,call)
{
	$('#loadMoreEventsButton').html("Loading").attr("onclick","");
	$('.row .eventMenu').find('#latestEventsButton').find('i').addClass('fa-spin');
	if(call==-1)
	{
		$('.event').remove();
	}
	var eventsCurrent=[];
	var i=0;
	$('.event').each(function(){
		eventsCurrent[i]=$(this).attr("id");
		i++;
	});
	// console.log(eventsCurrent);
	$.post('/4pi/handlers/eventHandlers/latestEvents.php',{
		_sgk:eventsCurrent,
		_refresh:call
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
		$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
	})
	.success(function(data){
		console.log(data);
		$('#inViewElement').html("1001");
		$('.row .eventMenu').find('#latestEventsButton').find('i').removeClass('fa-spin');
		$('.row .eventMenu').find('#latestEventsButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid black'});
            $('.row .eventMenu').find('#upcomingEventsButton').css({'box-shadow':'inset #5CB85C 0px 3px 0 0','border-top':'1px solid #5CB85C'});
            $('.row .eventMenu').find('#eventWinnersButton').css({'box-shadow':'inset #D9534F 0px 3px 0 0','border-top':'1px solid #D9534F'});
		if(value=="empty")
		{
			$('.event').each(function(){
				$(this).remove();
			});
		}
		console.log(data);
		data=data.trim();

		if(checkData(data)==1)
		{
			if(data!=404)
			{
				var x=JSON.parse(data);
				// //console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i],2);
				}
				$('.timeago').timeago();
				$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
			}

			else
			{
				$('#eventEmptyMessage').find('#messageEmpty').html("No events to display.");
				$('#loadMoreEventsButton').hide();
			}
			
			
		}
		$('.row .eventMenu').find('#latestEventsButton').find('i').removeClass('fa-spin');
	});
}

function upcomingEventsFetch(value,call)
{
	$('#loadMoreEventsButton').html("Loading").attr("onclick","");
	$('.row .eventMenu').find('#upcomingEventsButton').find('i').addClass('fa-spin');
	if(call==-1)
	{
		$('.event').remove();
	}
	var eventsCurrent=[];
	var i=0;
	$('.event').each(function(){
		eventsCurrent[i]=$(this).attr("id");
		i++;
	});
	console.log(eventsCurrent);
	$.post('/4pi/handlers/eventHandlers/upcomingEvents.php',{
		_refresh:call,
		_sgk:eventsCurrent
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		$('#inViewElement').html("1002");
		$('.row .eventMenu').find('#upcomingEventsButton').find('i').removeClass('fa-spin');
		$('.row .eventMenu').find('#latestEventsButton').css({'box-shadow':'inset #428BCA 0px 3px 0 0','border-top':'1px solid #428BCA'});
            $('.row .eventMenu').find('#upcomingEventsButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid #000'});
            $('.row .eventMenu').find('#eventWinnersButton').css({'box-shadow':'inset #D9534F 0px 3px 0 0','border-top':'1px solid #D9534F'});
		data=data.trim();

		if(value=="empty")
		{
			$('.event').each(function(){
				$(this).remove();
			});
		}
		console.log(data);
		// console.log(checkData(data));
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				var x=JSON.parse(data);
				// //console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i],2);
				}
				$('.timeago').timeago();
				$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
			}

			else
			{
				$('#eventEmptyMessage').find('#messageEmpty').html("No events to display.");
				$('#loadMoreEventsButton').hide();
			}
		}
		$('.timeago').timeago();
		$('.row .eventMenu').find('#upcomingEventsButton').find('i').removeClass('fa-spin');
	});
}

function pastCompetitionsFetch(value,call)
{
	$('#loadMoreEventsButton').html("Loading").attr("onclick","");
	$('.row .eventMenu').find('#eventWinnersButton').find('i').addClass('fa-spin');
	if(call==-1)
	{
		$('.event').remove();
	}
	var eventsCurrent=[];
	var i=0;
	$('.event').each(function(){
		eventsCurrent[i]=$(this).attr("id");
		i++;
	});

	$.post('/4pi/handlers/eventHandlers/pastEvents.php',{
		_call:call,
		_sgk:eventsCurrent
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		$('#inViewElement').html("1003");
		$('.row .eventMenu').find('#eventWinnersButton').find('i').removeClass('fa-spin');
		$('.row .eventMenu').find('#latestEventsButton').css({'box-shadow':'inset #428BCA 0px 3px 0 0','border-top':'1px solid #428BCA'});
            $('.row .eventMenu').find('#upcomingEventsButton').css({'box-shadow':'inset #5CB85C 0px 3px 0 0','border-top':'1px solid #5CB85C'});
            $('.row .eventMenu').find('#eventWinnersButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid #000'});
		data=data.trim();
		//console.log(data);
		if(value=="empty")
		{
			$('.event').each(function(){
				$(this).remove();
			});
		}
		if(checkData(data)==1)
		{
			if(data!=404)
			{
				var x=JSON.parse(data);
				// //console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i],1);
				}
				$('.timeago').timeago();
				$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
			}

			else
			{
				$('#eventEmptyMessage').find('#messageEmpty').html("No events to display.");
				$('#loadMoreEventsButton').hide();
			}
		}
	});
	$('.row .eventMenu').find('#eventWinnersButton').find('i').removeClass('fa-spin');
}

$(document).ready(function(){

	$('.datepicker').datepicker();

	$('.datepicker').css({'z-index':'1052'});


	 var input1=$('#eventCreateModal').find('#createEventTime');

	 input1.clockpicker({

		placement: 'top', // clock popover placement

		align: 'left',

		donetext: 'Done',

		autoclose:'true'   // vibrate the device when dragging clock hand

		});

	 var input3=$('#editEventModal').find('#editEventTime');

	 input3.clockpicker({

		placement: 'top', // clock popover placement

		align: 'left',

		donetext: 'Done',

		autoclose:'true'   // vibrate the device when dragging clock hand

		});



	$('.popOver').popover();
});

$('.popOver').popover();

$('time.timeago').timeago();