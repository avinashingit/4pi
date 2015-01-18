

<style>

	.poll
	{
		border:1px solid #CCCCCC;
		margin-bottom:10px;
		padding:5px;
		padding-bottom:10px;
		background-color:#fff;
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

				    		<input type="text" name="pollQuestion" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="createPollQuestion" placeholder="Poll on"></input>

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

				   			<label for="pollShareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Enter 'All' for making it visible to everyone. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number."></i>]

				    		<input name="pollShareWith" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPollSharedWith" value="All" >

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

	<div id="pollArea" style="margin-top:10px;">

		
		

	</div>

</div><!-- end polls -->


<script src="/4pi/js/cs/retrievePolls.js">
	
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