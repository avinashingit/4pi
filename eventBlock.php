<div class="col-md-7" id="events">
	
	<div class="row eventMenu topMenu" style="z-index:1040;margin-bottom:20px;">
	
		<div class="btn-group btn-group-justified" style="padding:10px;">
			
			<div class="btn-group">
			
			    <button type="button" id="eventCreateButton" class="btn btn-warning" data-toggle="modal" data-target="#eventCreateModal"><a style="color:white;" ><i class="fa fa-plus"></i>&nbsp;Create Event</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="latestEventsButton" onclick="latestEventsFetch('empty',-1);" class="btn btn-info"><a style="color:white;" ><i class="fa fa-calendar"></i>&nbsp;Latest</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="upcomingEventsButton" onclick="upcomingEventsFetch('empty',-1);" class="btn btn-success"><a style="color:white;" ><i class="fa fa-clock-o"></i>&nbsp;Upcoming Events</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="eventWinnersButton" onclick="pastCompetitionsFetch('empty',-1);" class="btn btn-primary"><a style="color:white;" ><i class="fa fa-check"></i>&nbsp;Past Competitions</a></button>
		  	
		  	</div>
			
		</div>

	</div>

	<br/><br/>

	<div class="modal fade slow" id="eventCreateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

	  	<div class="modal-dialog">

	    	<div class="modal-content">

		      	<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

	        		<h4 class="modal-title" id="editModalLabel"><i class="fa fa-plus"></i> &nbsp;Create Event&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event will be made visible to the users of Student Portal only after Co-Curricular affairs secretary's approval."></i>]</h4>

	      		</div>

		      	<div class="modal-body">

		      		    <form role="form">

					  		<div class="form-group">

					   			<label for="eventClub">Event Organizer</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. It can either be a club or a special interest group or an individual"></i>]

					    		<input type="text" name="eventClub" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createEventOrganizerName" placeholder="Organizer Name">

					  		</div>      		    

					  		<div class="form-group">

					   			<label for="eventName">Event Name</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Give an appropriate event name"></i>]

					    		<input type="text" name="eventName" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createEventName" placeholder="Event Name">

					  		</div>

					  		<div class="form-group">

					   			 <label for="eventContent">Event Details</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Event Details maximum length 1000 characters."></i>]

					   			 <textarea type="text" name="eventContent" style="background-color:white;border-radius:0px;resize:none;" class="form-control" id="createEventContent"></textarea>

					  		</div>

					 		<!--  <div class="form-group">

					 			  <label for="fileInput">Attach Images </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Optional. You can attach upto 1 image per event. Maximum image size allowed 1MB. Allowed extensions are .jpg, .png"></i>]

					  			  <input name="fileInput[]" type="file"  id="createEventFileInput" multiple="">

					  		</div> -->

					 		 <div class="form-group">

					    			<label for="shareWith">Share With</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Leaving it untouched makes the event visible to everyone. Examples would be like COE12, B.Tech12, etc. You can share the post with multiple groups by separating the groups with commas."></i>]

					    			<input value="All" name="createEventSharedWith" class="form-control"type="text" id="createEventSharedWith">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventVenue">Event Venue (*)</label>

					    		<input name="createEventVenue" class="form-control"type="text" id="createEventVenue">

					  		</div>
					  		
					  		<div class="form-group col-md-6">

					  			<label for="eventVenue">Event Date (*)</label>

					    		<input name="createEventDate" data-date-format="dd/mm/yyyy"  class="datepicker form-control" type="text" id="createEventDate">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventTime">Event Time</label>

					 			<input class="form-control clockpicker" name="createEventTime" id="createEventTime">

					  		</div>

					  		<div class="form-group col-md-6">

						  		<label for="eventType">Event Duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  			<div class="row">

						  				<div class="col-md-6">

						  					<input type="number" name="eventDurationHours" id="createEventDurationHours" class="form-control"/>

				  						</div>

				  						<div class="col-md-6">

						  					<select type="text" name="eventDurationMinutes" id="createEventDurationMinutes" class="form-control">

						  						<option val="00">00</option>

						  						<option val="15">15</option>

						  						<option val="30">30</option>

						  						<option val="45">45</option>

					  						</select>

				  						</div>

			  						</div>
					  		</div>

					  		<div class="form-group">

						  		<label for="eventType">Event Type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  		<select type="select" class="form-control" id="createEventType" name="createEventType">

						  			<option val="competition">Competition</option>

						  			<option val="others">Others</option>

					  			</select>

					  		</div>

						</form>

					<button onclick="createEventSP();" class="btn btn-primary">Create Event</button>

		      	</div>

	    	</div>

	    </div>

	</div>


	<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

	  	<div class="modal-dialog">

	    	<div class="modal-content">

	    		<div id="editEventId" class="hidden"></div>

		      	<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

	        		<h5 class="modal-title" id="editModalLabel"><i class="fa fa-pencil"></i> &nbsp;Edit Event&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event will be made visible to the users of Student Portal only after Co-Curricular affairs secretary's approval."></i>]</h5>

	      		</div>

		      	<div class="modal-body">

		      		    <form role="form">

					  		<div class="form-group">

					   			<label for="eventClub">Event Organizer</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. It can either be a club or a special interest group or an individual"></i>]

					    		<input type="text" name="eventClub" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editEventOrganizerName" placeholder="Organizer Name">

					  		</div>      		    

					  		<div class="form-group">

					   			<label for="eventName">Event Name</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Give an appropriate event name"></i>]

					    		<input type="text" name="eventName" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editEventName" placeholder="Event Name">

					  		</div>

					  		<div class="form-group">

					   			 <label for="eventContent">Event Details</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Event Details maximum length 1000 characters."></i>]

					   			 <textarea type="text" name="eventContent" style="background-color:white;border-radius:0px;resize:none;" class="form-control" id="editEventContent"></textarea>

					  		</div>

					 		<!--  <div class="form-group">

					 			  <label for="fileInput">Attach Images </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Optional. You can attach upto 1 image per event. Maximum image size allowed 1MB. Allowed extensions are .jpg, .png"></i>]

					  			  <input name="fileInput[]" type="file"  id="createEventFileInput" multiple="">

					  		</div> -->

					 		 <div class="form-group">

					    			<label for="shareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Leaving it untouched makes the event visible to everyone. Examples would be like COE12, B.Tech12, etc. You can share the post with multiple groups by separating the groups with commas."></i>]

					    			<input name="editEventSharedWith" value="All" class="form-control"type="text" id="editEventSharedWith">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventVenue">Event Venue (*)</label>

					    		<input name="editEventVenue" class="form-control"type="text" id="editEventVenue">

					  		</div>
					  		
					  		<div class="form-group col-md-6">

					  			<label for="eventVenue">Event Date (*)</label>

					    		<input name="editEventDate" data-date-format="dd/mm/yyyy"  class="datepicker form-control" type="text" id="editEventDate">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventTime">Event Time</label>

					 			<input class="form-control clockpicker" name="editEventTime" id="editEventTime">

					  		</div>

					  		<div class="form-group col-md-6">

						  		<label for="eventType">Event Duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Duration is in hours:minutues format."></i>]

						  			<div class="row">

						  				<div class="col-md-6">

						  					<input type="number" name="eventDurationHours" id="editEventDurationHours" class="form-control"/>

				  						</div>

				  						<div class="col-md-6">

						  					<select type="text" name="eventDurationMinutes" id="editEventDurationMinutes" class="form-control">

						  						<option val="00">00</option>

						  						<option val="15">15</option>

						  						<option val="30">30</option>

						  						<option val="45">45</option>

					  						</select>

				  						</div>

			  						</div>
					  		</div>

					  		<div class="form-group">

						  		<label for="eventType">Event Type</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  		<select type="select" class="form-control" id="editEventType" name="editEventType">

						  			<option val="competition">Competition</option>

						  			<option val="others">Others</option>

					  			</select>

					  		</div>

					  		<div class="form-group">

						  		<label for="eventStatus">Event Status</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Status. If you want to postpone the event or cancel it or put it on hold please update this field."></i>]

						  		<select type="select" class="form-control" id="editEventStatus" name="editEventType">

						  			<option val="asScheduled">As Scheduled</option>

						  			<option val="postponed">Pospone</option>

						  			<option val="hold">On Hold</option>

						  			<option val="cancel">Cancel</option>

					  			</select>

					  		</div>

						</form>

					<button onclick="editedEventSend();" class="btn btn-primary">Edit Event</button>

		      	</div>

	    	</div>

	    </div>


	</div>

	<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

	  	<div class="modal-dialog">

	    	<div class="modal-content">

		      	<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

	        		<h4 class="modal-title" id="deleteEventModal"><i class="fa fa-pencil"></i> &nbsp;Delete Event</h4>

	      		</div>

	      		<div id="deleteEventId" class="hidden"></div>

		      	<div class="modal-body">

		      		    <form role="form">

					  		<div class="form-group">

					   			<label for="deleteEventQuestion">Do you want to delete this event?</label>

					    		<!-- <input type="email" name="eventClub" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editEventClubName" placeholder="Club Name"> -->

					  		</div>      		    

						</form>

					<button onclick="deleteEventSend();" class="btn btn-primary">Delete Event</button>

		      	</div>

	    	</div>

	    </div>

	</div>

	<div id="eventArea">



	</div><!-- end id eventArea -->

</div>

<style>

	.venueDateTimeEvent{
		padding-top:8px;
		/*padding-bottom:5px;*/
	}
	
	p{
		text-align:justify;
	}
	
	.visibleHidden{
		position:absolute;
		visibility:hidden;
	}
	
	#eventNameTime{
		margin-top:5px;
	}
	
	#eventPostedTime, #editEvent{
		margin-top:5px;
	}
	
	.popOver{
		color:gray;
	}

	.event{
		background-color:#fff;
	}

</style>

<script>

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
				  
	event+='<button type="button" class="btn" style="background-color:#FFD1A3;"title="Event Venue"><p class="venueDateTimeEvent text-center" ><i class="fa fa-at" title="Venue"></i>&nbsp;&nbsp;<span id="eventVenue">'+data.eventVenue+'</span></p></button>';
				  
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

	$('#'+id).find('#eventIcons').find('#eventAttendeeNumber').find('#eventAttendersValue').html(y)

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
	})
	.success(function(data){
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
			var x=JSON.parse(data);
			// console.log(x.length);
			for (i=0;i<x.length;i++)
			{
				eventInsert('last',x[i]);
			}
			$('.timeago').timeago();
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
			var x=JSON.parse(data);
			// console.log(x.length);
			for (i=0;i<x.length;i++)
			{
				eventInsert('last',x[i]);
			}
		}
		$('.timeago').timeago();
		$('.row .eventMenu').find('#upcomingEventsButton').find('i').removeClass('fa-spin');
	});

}

function pastCompetitionsFetch(value,call)

{
	
	$('.row .eventMenu').find('#eventWinnersButton').find('i').addClass('fa-spin');

	$.post('/4pi/handlers/eventHandlers/latest.php',{
		_call:call
	})
	.error(function(data){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		data=data.trim();
		if(checkData(data)==1)
		{
			x=JSON.parse(data);
			for (i=0;i<x.length;i++)
			{
				eventInsert('last',x[i]);
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

</script>

<style>
.clockpicker-popover{
	z-index:99999;
}

</style>