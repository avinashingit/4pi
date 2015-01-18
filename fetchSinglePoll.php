<?php
session_start();

	include_once('header.php'); 
	include_once('topbar.php');

	require_once 'QOB/qobConfig.php';

	if(!isset($_GET['ref']))
	{	
		echo '<script>alert("Invalid url. Redirecting to home page..");window.location.href="http://localhost/4pi";</script>';
	}
	else
	{
		echo '<script>var pollIdHash="'.$_GET['ref'].'";</script>';
	}

?>

<script>

function fetchSinglePoll()
{
	$.post('/4pi/handlers/fetchSinglePoll.php',{
		_pollId:pollIdHash
	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			
			if(data==404)
			{
				alert("The poll does not exist.");
			}
			else if(data==505)
			{
				alert("The poll is not shared with you.");
			}
			else
			{
				console.log(data);
				data=JSON.parse(data);
				insertPoll(data,"first");
			}
			$('.timeago').timeago();
		}
	});
}


$(document).ready(function(){
	fetchSinglePoll();
});

var userIdHash="<?php echo $_SESSION['vj'];?>";

</script>


<body style="padding:0px;" >
    <div id="wrap" >

	<div class="row">
		<!-- left column code starts here -->
		<?php 
		
		//echo $_SESSION['vj'];
		
		include_once('leftBlock.php'); ?>
		<!-- left column code ends here  -->
		
		<?php include_once('singlePollBlock.php'); ?>
		
		<!-- BLOCK in the right code starts here  -->
		 <?php include_once('rightBlock.php');?>
		<!-- right block code ends here  -->

	</div>
	
	
	
	
<?php
	include_once("footer.php");
?>