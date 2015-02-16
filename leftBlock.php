<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

	session_start();

	require_once '/QOB/qobConfig.php';

	mysql_connect(HOST,USER,PASSWORD) or die("Unable to connect to the server.");

	mysql_select_db(DB);

	$sql=sprintf("SELECT * FROM users WHERE userIdHash='%s'",mysql_real_escape_string($_SESSION['vj']));

	$results=mysql_query($sql);

	$row=mysql_fetch_object($results);

	// var_dump($row);
	// echo $sql;
	// echo $_SESSION['vj'].'<br/>';

	$icons=array();
	$icons[0]="fa-gear";$icons[1]="fa-sort";$icons[2]="fa-space-shuttle";$icons[3]="fa-square";$icons[4]="fa-tags";

	$groups=array();
	$groups=explode(",",$row->clubsInvolved);

	$exists=0;
	if(file_exists(__DIR__."/img/proPics/".$row->userIdHash.".jpg"))
	{
		$exists=1;
	}
	else
	{
		$exists=0;
	}




echo '
<div class="col-md-2" id="userDetails" style="padding:0px !important;" >

	<br/>

	<div id="userImage">';

	if($exists==1)
	{
		echo '<a href="/4pi/aboutMe/index.php?userId='.$row->userId.'" ><h4 class="text-center" style="margin-bottom:10px;" ><img src="/4pi/img/proPics/'.$row->userIdHash.'.jpg" width="120" height="120" class="img-responsive img-circle"/></h4></a>';
	}

	else
	{
		if($row->gender=="M")
		{
			echo '<a href="/4pi/aboutMe/index.php?userId='.$row->userId.'" ><h4 class="text-center" style="margin-bottom:10px;" ><img src="/4pi/img/defaultMan1.jpg" width="120" height="120" class="img-responsive img-circle"/></h4></a>';
		}
		else
		{
			echo '<a href="/4pi/aboutMe/index.php?userId='.$row->userId.'" ><h4 class="text-center" style="margin-bottom:10px;" ><img src="/4pi/img/defaultWoman1.jpg" width="120" height="120" class="img-responsive img-circle"/></h4></a>';
		}
	}

	echo '	<h4 class="text-center" ><a title="'.ucwords(strtolower($row->name)).'"href="/4pi/aboutMe/index.php?userId='.$row->userId.'" style="color:white;" >'.ucwords(strtolower(substr($row->name,0,18))).'...</a></h4>

	</div>

	<!--<div id="userBadges">

		<h4 class="text-center"><i class="fa fa-bomb colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-briefcase colorWhite cursorPointer"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bullhorn colorWhite cursorPointer"></i></h4>

	</div> -->

	<br/>';

	/*echo '

	<div id="userGroups">

		<div class="table-responsive" id="userGroups">

		  	<table class="table" style="width:100%;" >';

		  	for($i=0;$i<count($groups);$i++)
		  	{
		  		echo '<tr class="group cursorPointer">

		    		<td><i class="fa '.$icons[$i].' colorWhite groupIcons"></i></td>

		    		<td title="'.$groups[$i].'">'.$groups[$i].'</td>

	    		</tr>';
		  	}

		  	echo '

		  	</table>

		</div>

	</div>	
	<br/><br/>
	<div class="text-center">
	<!--<a href="http://localhost/frontEnd/executiveWing/"><button style="background:linear-gradient(#5541BA, #503DB0) !important;color:white;" class="btn btn-lg">People</button></a>-->
	';*/

	echo '<p style="padding:10px;border-top:1px solid #fff;border-bottom:1px solid #fff;"><br/>This is a beta version. Please try to deploy and report bugs to the admin via <a style="cursor:pointer" onclick="$(\'#feedbackModal\').modal(\'show\');">feedback</a>.<br/>';
	echo '<br/>
	<table style="text-align:center;position:absolute;bottom:15px;" >
		<tr>
			<td style="cursor:pointer;width:70px;height:70px;color:white;"    ><a  target="_blank" class=" blcs" data-toggle="tooltip"  title="People"  onmouseover="$(this).tooltip(\'show\');"  href="/4pi/people/" style="color:white;" ><i class="  fa fa-building fa-2x"></i></a></td>
			<td style="width:70px;height:70px;color:white;" ><a   target="_blank"  data-toggle="tooltip"  title="Clubs"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"title="Clubs"  href="/4pi/clubs/" style="display:block;color:white;"  ><i class="fa fa-share-alt fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" onclick="$(\'#feedbackModal\').modal(\'show\');"><a  target="_blank"   data-toggle="tooltip"  title="Feedback"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"title="Feedback" style="display:block;color:white;"  ><i class="fa fa-envelope fa-2x"></i></td>
			
		</tr>
		
		<tr>
			<td style="width:70px;height:70px;color:white;" ><a  target="_blank"   data-toggle="tooltip"  title="About"  onmouseover="$(this).tooltip(\'show\');" class="blcs" title="About"  href="/4pi/about/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-info-circle fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a   target="_blank"  data-toggle="tooltip"  title="WebOps"  onmouseover="$(this).tooltip(\'show\');" class=" blcs"  href="/4pi/team/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-users fa-2x"></i></td>
			<td style="width:70px;height:70px;color:white;" ><a   target="_blank"  data-toggle="tooltip"  title="Idea Bank"  onmouseover="$(this).tooltip(\'show\');" class=" blcs" title="Idea Bank" href="/4pi/ideaBank/" style="display:block;color:white;margin-top:-15px !important;"  ><i class="fa fa-exclamation fa-2x"></i></td>
			
		</tr>
		
		
		
		
		
	</table>';
	
	
// echo '</div>';
	
	echo '<br/><br/>

</div>

<!-- left column code ends here -->';
?>
<script>
$(document).ready(function(){
	var sn = $("#userDetails");

    var posn = sn.position();          

    var windowposn = $(window).scrollTop();

    if (windowposn >= posn.top-50) {

        sn.addClass("stickDetails");

        $('#posts').css({'margin-left':'16.5%'});
        $('#events').css({'margin-left':'16.5%'});
        $('#polls').css({'margin-left':'16.5%'});

    }

    else {

       sn.removeClass("stickDetails");

        $('#posts').css({'margin-left':'0%'});
        $('#events').css({'margin-left':'0%'});
        $('#polls').css({'margin-left':'0%'});

    }
});
	
	function sendFeedback()
	{
		var content=$('#feedbackModal').find('#feedbackInput').val().trim();
		if(content.length==0)
		{
			alert("We don't accept empty feedback.");
		}
		else
		{
			$('#feedbackModal').find('#feedbackSendButton').html("Sending").attr("onclick","");
			$.post('/4pi/handlers/insertFeedback.php',{
				_feedback:content
			})
			.error(function(){
				alert("Server overload. Please try again :(");
				$('#feedbackModal').find('#feedbackSendButton').html("Send").attr("onclick","sendFeedback();");
			})
			.success(function(data){
				
				if(checkData(data)==1)
				{
					$('#feedbackModal').modal('hide');
					alert("Thanks for your feedback.");
					$('#feedbackModal').find('#feedbackSendButton').html("Send").attr("onclick","sendFeedback();");
				}
				else
				{
					$('#feedbackModal').find('#feedbackSendButton').html("Send").attr("onclick","sendFeedback();");
				}
				
			});
		}
	}
</script>

<div class="modal fade slow" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

	  	<div class="modal-dialog">

	    	<div class="modal-content">

		      	<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

	        		<h4 class="modal-title"><i class="fa fa-envelope"></i> &nbsp;Feedback&nbsp;&nbsp;</h4>

	      		</div>

		      	<div class="modal-body">

	      		    <form role="form">

				  		<div class="form-group">

				   			<label for="feedbackInput">Message</label>

				    		<textarea type="text" name="feedbackInput" class="form-control input-sm" style="background-color:white !important;border-radius:0px;resize:none;" id="feedbackInput"></textarea>

				  		</div>
					
					</form>

					<br/>

					<button  id="feedbackSendButton" onclick="sendFeedback();" class="btn btn-primary">Send</button>

				</div>
				
			</div>

		</div>

	</div> <!-- end modals -->