<?php
	session_start();
	if(!isset($_SESSION['vj']))
	{
		echo '<script>window.location.href="/4pi/index.php";</script>';
	}

include_once('header.php'); 
include_once('topbar.php');
$_SESSION['mq']=0;
$_SESSION['qq']=0;
$_SESSION['jq']=0;
?>

<script>
console.log("H");
var userId = "<?php  echo $_SESSION['vj']; ?>";
var inView= "<?php echo $_SESSION['jx']; ?>";



</script>



<body style="padding:0px;" >
    <div id="wrap" >

		<div class="row">
			<!-- left column code starts here -->
			<?php 
			
			//echo $_SESSION['vj'];
			
			include_once('leftBlock.php'); ?>
			<!-- left column code ends here  -->
			
			<!--- event area -->
			<?php include_once('eventBlock.php'); ?>
			<!-- event area ends here  -->
			
			<!-- BLOCK in the right code starts here  -->
			<?php include_once('rightBlock.php');?>
			<!-- right block code ends here  -->

		</div>
	
	
	
	


<script>

// $('.row.event').css({'background-color':'#fff'});
// 
var inView="<?php echo $_SESSION['jx'];?>";

latestEventsFetch("empty",-1);

</script>