
function eventInsert(position,data)
{
	var event="";

	event+='<div class="row event" id="'+data.eventIdHash+'" style="border:1px solid gray;margin-bottom:10px;">';

	event+='<div id="eventSharedWith" class="hidden" >'+data.sharedWith+'</div>';

	event+='<div id="eventStatus" class="hidden" >'+data.eventStatus+'</div>';

	event+='<div id="eventType" class="hidden">'+data.eventType+'</div>';

	event+='<div class="row" id="eventNameTime">';

	event+='<div class="col-md-6 text-left" id="eventNameAndClub">';

	event+='<div style="font-size:18px;"><a href="#"><span id="eventOrganizer" class="text-bold">'+data.eventOrgName+'</span></a> - <span id="eventName" class="text-bold">'+data.eventName+'</span></div>';

	event+='</div>';

	if(data.eventOwner==1)
	{
		event+='<div class="col-md-2 col-md-offset-1"  id="editEvent">';

		event+='<p class="text-right"><i class="fa fa-pencil" title="Edit Event" onclick="editEvent(\''+data.eventIdHash+'\');"></i>&nbsp;';

		event+='<i class="fa fa-trash" title="Delete Event" onclick="deleteEvent(\''+data.eventIdHash+'\');"></i></p>';

		event+='</div>';

		event+='<div class="col-md-3 text-right" id="eventPostedTime">';
	}

	else
	{
		event+='<div class="col-md-3 col-md-offset-3 text-right" id="eventPostedTime">';
	}
	
	event+='<time class="timeago" id="eventPostedTimeValue" datetime="'+data.eventTimestamp+'" title="">'+data.eventTimestamp+'</time>';

	event+='</div>';

	event+='</div>';

	event+='<br/>';

	event+='<div class="row">';

	event+='<div class="col-md-12">';

	event+='<p id="eventContent" style="white-space:pre-wrap">'+data.eventContent+'</p>';

	event+='</div>';

	event+='</div>';

		
	event+='<div class="row" id="eventDetails">';

	event+='<div class="col-md-10 col-md-offset-1">';

	event+='<div class="btn-group btn-group-justified">';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn" style="background-color:#FFD1A3;"title="Event Venue"><p class="venueDateTimeEvent text-center" ><i class="fa fa-map-marker" title="Venue"></i>&nbsp;&nbsp;<span id="eventVenue">'+data.eventVenue+'</span></p></button>';
				  
	event+='</div>';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn" style="background-color:#D6FFFF;"title="Event Date"><p class="venueDateTimeEvent text-center"><i class="fa fa-calendar" title="Date"></i>&nbsp;&nbsp;<span id="eventDate">'+data.eventDate+'</span></p></button>';
	
	event+='</div>';
				  
	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn" style="background-color:#ADFF85;"title="Event Time" ><p class="venueDateTimeEvent text-center"><i class="fa fa-clock-o" title="Time"></i>&nbsp;<span id="eventTime">'+data.eventTime+'</span></p></button>';
				  
	event+='</div>';

	event+='<div class="btn-group">';
				  
	event+='<button type="button" class="btn"style="background-color:#ADFF5C;"title="Event Duration"><p class="venueDateTimeEvent text-center"><i class="fa fa-arrows-h" title="Duration"></i>&nbsp;<span id="eventDurationHours">'+data.eventDurationHrs+'</span>:<span id="eventDurationMinutes">'+data.eventDurationMin+'</span></p></button>';
				  
	event+='</div>';
				
	event+='</div>';

	event+='</div>';

	event+='</div>';

	event+='<br/>';

	event+='<div class="row" id="eventIcons">';

	event+='<div class="col-md-3 col-md-offset-1">';

	event+='<span id="eventAttendeeNumber"><i class="fa fa-check" title="No of Attenders"></i>&nbsp;<span id="eventAttendersValue">'+data.attendCount+'</span></span>';

	event+='</div>';

	event+='<div class="col-md-3 col-md-offset-1">';

	event+='<p><i class="fa fa-eye" title="Seen By"></i>&nbsp;<span id="eventSeenByNumber">'+data.seenCount+'</span></p>';

	event+='</div>';

	event+='<div class="col-md-3 col-md-offset-1 text-left">';

	if(data.isAttender!=1)
	{
		event+='<button class="btn btn-sm btn-success" id="attend" onclick="attendEvent(\''+data.eventIdHash+'\');"><i class="fa fa-check"></i>&nbsp; Attend</button>';
		event+='<button class="btn btn-sm btn-success visibleHidden" id="attending"><i class="fa fa-check"></i>&nbsp; Attending</button>';		
	}

	else
	{
		event+='<button class="btn btn-sm btn-success" id="attending"><i class="fa fa-check"></i>&nbsp; Attending</button>';
	}



	event+='</div>';

	event+='</div>';

	event+='<br/>';

	event+='</div>';

	event+='</div>';

	// console.log("HEEEE");

	if(position=="first")
	{
		$("#eventArea").prepend(event).hide().fadeIn('slow');
	}

	else
	{
		$('#eventArea').append(event).hide().fadeIn('slow');
	}

	// console.log(event);

}

function editEvent(id)
{
	
	$('#editEventModal').modal('show');
	
	$('#editEventModal').find('#editEventId').html(id);
	
	var eventOrganizerName=$('#'+id).find('#eventOrganizer').html();
	
	var eventName=$('#'+id).find('#eventName').html();
	
	var eventContent=$('#'+id).find('#eventContent').html();
	
	// var eventFiles=$('#'+id).find('#eventFiles').html();
	
	var eventSharedWith=$('#'+id).find('#eventSharedWith').html();
	
	var eventVenue=$('#'+id).find('#eventVenue').html();
	
	var eventDate=$('#'+id).find('#eventDate').html();
	
	var eventTime=$('#'+id).find('#eventTime').html();

	var eventDurationHours=$('#'+id).find('#eventDurationHours').html();

	console.log(eventDurationHours);
	
	var eventDurationMinutes=$('#'+id).find('#eventDurationMinutes').html();
	
	var eventType=$('#'+id).find('#eventType').html();

	var eventStatus=$('#'+id).find('#eventStatus').html();
	
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

	$('#editEventModal').find('#editEventStatus').val(eventStatus);
	
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
}

function editedEventSend()

{
	
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

	if(eventClubName.length==0 || eventName.length==0 || eventContent.length==0 || eventContent.length>1000 || eventVenue.length==0 || eventDate.length==0 )

	{

		alert("Please fill in the required fields.")

	}

	else

	{

		$('#editEventModal').modal('hide');
		
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

			_eventType:eventType
		
		})
		
		.error(function (){



		})

		.success(function (data){

			console.log(data);
			if(checkData(data)==1)
			{
				data=JSON.parse(data);
				modifyEvent(data,eventId);
			}

		});
	}

}

function createEventSP()

{
	$('.row .eventMenu').find('#createEventButton').find('i').addClass('fa-spin');
	
	var eventClubName=$('#createEventOrganizerName').val().trim();
	
	var eventName=$('#createEventName').val().trim();
	
	var eventContent=$('#createEventContent').val().trim();
	
	var eventSharedWith=$('#createEventSharedWith').val().trim();
	
	var eventVenue=$('#createEventVenue').val().trim();
	
	var eventDate=$('#createEventDate').val().trim();
	
	var eventTime=$('#createEventTime').val().trim();

	var eventDurationHours=$('#createEventDurationHours').val().trim();

	var eventDurationMinutes=$('#createEventDurationMinutes').val().trim();

	if(isNaN(Number(eventDurationHours)) || isNaN(Number(eventDurationMinutes)))
	{
		alert("Please enter correct values in duration. :)");
	} 

	
	
	var eventType=$('#createEventType').val().trim();
	
	// var eventFiles=$('#createEventFileInput').val();

	$('#createEventOrganizerName').val("");

	$('#createEventName').val("");

	$('#createEventName').val("");

	$('#createEventContent').val("");

	$('#createEventSharedWith').val("");

	$('#createEventVenue').val("");

	$('#createEventDate').val("");

	$('#createEventTime').val("");

	$('#createEventDurationHours').val("");

	$('#createEventDurationMinutes').val("");

	$('#createEventType').val("");





	if(eventClubName.length==0 || eventName.length==0 || eventContent.length==0 || eventContent.length>1000 || eventVenue.length==0 || eventDate.length==0 )

	{

		alert("Please fill in the required fields.")

	}

	else

	{

		$('#eventCreateModal').modal('hide');

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

			_eventType:eventType

			// _eventFile:eventFiles

		})

		.error(function(){

			alert("Server Overload. Please try again.");

		})

		.success(function(data){

			console.log(data);

			// jQuery.parseJSON(data);

			// alert("HELLO event");
			// 
			
			x=JSON.parse(data);

			console.log(x);

			eventInsert("first",x);

			$('.timeago').timeago();

			$('.row .eventMenu').find('#createEventButton').find('i').removeClass('fa-spin');

		});

	}

}

$('.popOver').popover();

$('time.timeago').timeago();

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
		console.log(data);
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

		console.log(data);

		if(data==1)

		{

			$('#'+eventId).remove();

		}

	});

}

function latestEventsFetch(value,call)
{
	$('.row .eventMenu').find('#latestEventsButton').find('i').addClass('fa-spin');
	var eventsCurrent=[];
	var i=0;
	$('.event').each(function(){
		eventsCurrent[i]=$(this).attr("id");
		i++;
	});
	$.post('/4pi/handlers/eventHandlers/latestEvents.php',{
		_sgk:eventsCurrent,
		_refresh:call
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
		$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
	})
	.success(function(data){
		var inView="<?php echo $_SESSION['jx'];?>";
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
				// console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i]);
				}
				$('.timeago').timeago();
			}

			else
			{
				$('#eventEmptyMessage').find('#messageEmpty').html("No events to display.");
			}

			$('#loadMoreEventsButton').html("Load more").attr("onclick","fetchMoreEvents();");
			$('#loadMoreEventsButton').hide();
			
		}
		$('.row .eventMenu').find('#latestEventsButton').find('i').removeClass('fa-spin');
	});

}

function upcomingEventsFetch(value,call)
{

	$('.row .eventMenu').find('#upcomingEventsButton').find('i').addClass('fa-spin');
	var eventsCurrent=[];
	var i=0;
	$('.event').each(function(){
		eventsCurrent[i]=$(this).attr("id");
		i++;
	});

	$.post('/4pi/handlers/eventHandlers/upcomingEvents.php',{
		_refresh:call,
		_sgk:eventsCurrent
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		var inView="<?php echo $_SESSION['jx'];?>";
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
				// console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i]);
				}
				$('.timeago').timeago();
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
	
	$('.row .eventMenu').find('#eventWinnersButton').find('i').addClass('fa-spin');
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
		var inView="<?php echo $_SESSION['jx'];?>";
		$('.row .eventMenu').find('#eventWinnersButton').find('i').removeClass('fa-spin');
		$('.row .eventMenu').find('#latestEventsButton').css({'box-shadow':'inset #428BCA 0px 3px 0 0','border-top':'1px solid #428BCA'});
            $('.row .eventMenu').find('#upcomingEventsButton').css({'box-shadow':'inset #5CB85C 0px 3px 0 0','border-top':'1px solid #5CB85C'});
            $('.row .eventMenu').find('#eventWinnersButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid #000'});
		data=data.trim();
		console.log(data);
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
				// console.log(x.length);
				for (i=0;i<x.length;i++)
				{
					eventInsert('last',x[i]);
				}
				$('.timeago').timeago();
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