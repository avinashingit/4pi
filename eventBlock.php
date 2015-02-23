<script>
var inView="<?php echo $_SESSION['jx'];?>";
</script>
<script src="/4pi/js/cs/retrieveEvents.js"></script>
<div class="col-md-7" id="events">
	
	<div class="row eventMenu topMenu" style="z-index:2;margin-bottom:20px;">
	
		<div class="btn-group btn-group-justified" style="padding:10px;">
			
			<div class="btn-group">
			
			    <button type="button" id="eventCreateButton" class="btn btn-warning" data-toggle="modal" data-target="#eventCreateModal"><a style="color:white;" ><i class="fa fa-plus"></i>&nbsp;Create Event</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="latestEventsButton" onclick="latestEventsFetch('empty',-1);" class="btn btn-primary"><a style="color:white;" ><i class="fa fa-calendar"></i>&nbsp;Latest</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="upcomingEventsButton" onclick="upcomingEventsFetch('empty',-1);" class="btn btn-success"><a style="color:white;" ><i class="fa fa-clock-o"></i>&nbsp;Upcoming Events</a></button>
		  	
		  	</div>

		  	<div class="btn-group">
			
			    <button type="button" id="eventWinnersButton" onclick="pastCompetitionsFetch('empty',-1);" class="btn btn-danger"><a style="color:white;" ><i class="fa fa-check"></i>&nbsp;Past Competitions</a></button>
		  	
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

					  		<div class="form-group has-error">

					   			<label for="eventClub">Event Organizer&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. It can either be a club or a special interest group or an individual"></i>]

					    		<input type="text" name="eventClub" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createEventOrganizerName" placeholder="Organizer Name">

					  		</div>      		    

					  		<div class="form-group has-error">

					   			<label for="eventName">Event Name&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Give an appropriate event name"></i>]

					    		<input type="text" name="eventName" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createEventName" placeholder="Event Name">

					  		</div>

					  		<div class="form-group has-error">

					   			 <label for="eventContent">Event Details <small>(<span id="createEventModalContentLength">1000</span> characters left)</small>&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Event Details maximum length 1000 characters."></i>]

					   			 <textarea type="text" name="eventContent" style="background-color:white;border-radius:0px;resize:none;" onkeyup="$('#createEventModalContentLength').html(1000-$(this).val().length);" onkeydown="$('#createEventModalContentLength').html(1000-$(this).val().length);" class="form-control" id="createEventContent"></textarea>

					  		</div>

					 		<!--  <div class="form-group">

					 			  <label for="fileInput">Attach Images </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Optional. You can attach upto 1 image per event. Maximum image size allowed 1MB. Allowed extensions are .jpg, .png"></i>]

					  			  <input name="fileInput[]" type="file"  id="createEventFileInput" multiple="">

					  		</div> -->

					 		 <div class="form-group has-error">

					    			<label for="shareWith">Share With&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)"></i>]

					    			<input value="All" name="createEventSharedWith" class="form-control"type="text" id="createEventSharedWith">

					  		</div>

					  		<div class="form-group col-md-6 has-error">

					  			<label for="eventVenue">Event Venue &nbsp;<span style="color:red;">*</span></label>

					    		<input name="createEventVenue" class="form-control"type="text" id="createEventVenue">

					  		</div>
					  		
					  		<div class="form-group col-md-6 has-error">

					  			<label for="eventVenue">Event Date &nbsp;<span style="color:red;">*</span></label>

					    		<input name="createEventDate" data-date-format="dd/mm/yyyy"  class="datepicker form-control" placeholder="dd/mm/yyyy" type="text" id="createEventDate">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventTime">Event Time</label>

					 			<input class="form-control clockpicker" name="createEventTime" id="createEventTime">

					  		</div>

					  		<div class="form-group col-md-6">

						  		<label for="eventType">Event Duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  			<div class="row">

						  				<div class="col-md-6">

						  					<input type="number" name="eventDurationHours" id="createEventDurationHours" placeholder="hours"  min="0" class="form-control"/>

				  						</div>

				  						<div class="col-md-6">

						  					<select type="text" name="eventDurationMinutes" id="createEventDurationMinutes" class="form-control">

						  						<option value="00">00 minutes</option>

						  						<option value="15">15 minutes</option>

						  						<option value="30">30 minutes</option>

						  						<option value="45">45 minutes</option>

					  						</select>

				  						</div>

			  						</div>
					  		</div>

					  		<div class="form-group has-error">

						  		<label for="eventType">Event Category&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event category."></i>]

						  		<select type="select" class="form-control" id="createEventCategory" name="createEventCategory">

						  			<option value="technical">Technical</option>

						  			<option value="nonTechnical">Non technical</option>

					  			</select>

					  		</div>

					  		<div class="form-group has-error">

						  		<label for="eventType">Event Type&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  		<select type="select" class="form-control" id="createEventType" name="createEventType">

						  			<option value="competition">Competition</option>

						  			<option value="others">Others</option>

					  			</select>

					  		</div>

					  		

						</form>

				</div>

				<div class='modal-footer'>

					<div class="row">

						<div class="col-md-1 col-md-offset-5">

							<img src="/4pi/img/728.gif" id="loadingImage" class="hidden">

						</div>

						<div class="col-md-2 col-md-offset-3">

							<button onclick="createEventSP();" id="createEventButton" class="btn btn-primary">Create Event</button>

						</div>

					</div>
					
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

					  		<div class="form-group has-error">

					   			<label for="eventClub">Event Organizer&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. It can either be a club or a special interest group or an individual"></i>]

					    		<input type="text" name="eventClub" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editEventOrganizerName" placeholder="Organizer Name. Required">

					  		</div>      		    

					  		<div class="form-group has-error">

					   			<label for="eventName">Event Name&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Give an appropriate event name"></i>]

					    		<input type="text" name="eventName" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editEventName" placeholder="Event Name. Required">

					  		</div>

					  		<div class="form-group has-error">

					   			 <label for="eventContent">Event details <small>(<span id="editEventModalContentLength"></span> characters left)</small>&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Required. Event Details maximum length 1000 characters."></i>]

					   			 <textarea type="text" name="eventContent" style="background-color:white;border-radius:0px;resize:none;" onkeyup="$('#editEventModalContentLength').html(1000-$(this).val().length);" onkeydown="$('#editEventModalContentLength').html(1000-$(this).val().length);" class="form-control" id="editEventContent" plcaeholder="Required"></textarea>

					  		</div>

					 		<!--  <div class="form-group">

					 			  <label for="fileInput">Attach Images </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Optional. You can attach upto 1 image per event. Maximum image size allowed 1MB. Allowed extensions are .jpg, .png"></i>]

					  			  <input name="fileInput[]" type="file"  id="createEventFileInput" multiple="">

					  		</div> -->

					 		 <div class="form-group has-error">

					    			<label for="shareWith">Share with&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)"></i>]

					    			<input name="editEventSharedWith" value="All" class="form-control"type="text" id="editEventSharedWith">

					  		</div>

					  		<div class="form-group col-md-6 has-error">

					  			<label for="eventVenue">Event Venue &nbsp;<span style="color:red;">*</span></label>

					    		<input name="editEventVenue" class="form-control"type="text" id="editEventVenue">

					  		</div>
					  		
					  		<div class="form-group col-md-6 has-error">

					  			<label for="eventVenue">Event Date &nbsp;<span style="color:red;">*</span></label>

					    		<input name="editEventDate" data-date-format="dd/mm/yyyy"  class="datepicker form-control" placeholder="dd/mm/yyyy" type="text" id="editEventDate">

					  		</div>

					  		<div class="form-group col-md-6">

					  			<label for="eventTime">Event Time</label>

					 			<input class="form-control clockpicker" name="editEventTime" id="editEventTime">

					  		</div>

					  		<div class="form-group col-md-6">

						  		<label for="eventType">Event Duration</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Duration is in hours:minutues format."></i>]

						  			<div class="row">

						  				<div class="col-md-6">

						  					<input type="number" name="eventDurationHours" id="editEventDurationHours" min="0" placeholder="hours" class="form-control"/>

				  						</div>

				  						<div class="col-md-6">

						  					<select type="text" name="eventDurationMinutes" id="editEventDurationMinutes" class="form-control">

						  						<option value="00">00 minutes</option>

						  						<option value="15">15 minutes</option>

						  						<option value="30">30 minutes</option>

						  						<option value="45">45 minutes</option>

					  						</select>

				  						</div>

			  						</div>
					  		</div>

					  		<div class="form-group has-error">

						  		<label for="eventType">Event Category&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Category."></i>]

						  		<select type="select" class="form-control" id="editEventCategory" name="editEventType">

						  			<option value="technical">Technical</option>

						  			<option value="nonTechnical">Non-Technical</option>

					  			</select>

					  		</div>

					  		<div class="form-group has-error">

						  		<label for="eventType">Event Type&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Event Type. If it is a competition you will be given an option of posting winners on this page."></i>]

						  		<select type="select" class="form-control" id="editEventType" name="editEventType">

						  			<option value="competition">Competition</option>

						  			<option value="others">Others</option>

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

		      	</div>

		      	<div class="modal-footer">

		      		<div class="row">

						<div class="col-md-1 col-md-offset-5">

							<img src="/4pi/img/728.gif" id="loadinImage" class="hidden">

						</div>

						<div class="col-md-2 col-md-offset-3">

							<button onclick="editedEventSend();" id="editEventButton" class="btn btn-primary">Edit Event</button>

						</div>

					</div>

					

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

	<div id="eventEmptyMessage">

		<div class="row">

			<div class="col-md-12 text-center">

				<p class="text-center" id="messageEmpty"></p>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="text-center">

			<button style="display:block;width:100%;"  class="btn btn-lg btn-success" id="loadMoreEventsButton" onclick="fetchMoreEvents();">Load more</button>

		</div>

	</div>

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
		margin-top:10px;
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

	.event:hover
	{
		-webkit-box-shadow:0px 5px 0px #AF0021 inset ;
		box-shadow:0px 5px 0px #AF0021 inset ;	
	}

</style>



<style>
.clockpicker-popover{
	z-index:99999;
}

</style>

<script>

$(document).ready(function(){
	latestEventsFetch('empty',1);
});

function fetchMoreEvents()
{
	$('#loadMoreEventsButton').html("Loading").attr("onclick","");
	var inViewElement=$('#inViewElement').html();
	if(inViewElement==1001)
	{
		latestEventsFetch('noempty',1);
	}
	else if(inViewElement==1002)
	{
		upcomingEventsFetch('noempty',1)
	}
	else if(inViewElement==1003)
	{
		pastCompetitionsFetch('noempty',1);
	}

}


</script>