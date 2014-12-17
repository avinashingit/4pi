<?php 
	include_once("../header_initial.php");
	?>
<script>


</script>
<style>

	body
	{
		background-color:black !important;
		font-family:openSans;
		width:100%;
	}

	@font-face {
	    font-family: openSans;
	    src: url(../fonts/OpenSans-Light.ttf);
	}

	body
	{
		-webkit-transition: background-color 0.4s ease;
	    -moz-transition: background-color 0.4s ease;
	    -o-transition: background-color 0.4s ease;
	    transition: background-color 0.4s ease;
	    font-family: openSans !important;
	}
	.text
	{
		color:black;
		font-family:openSans;
	}

</style>

<script>

/*$(document).ready(function(){
	var $els=$('h1[id^=content]'), i=0,len=$els.length;
	$els.slice(1).hide();
    setInterval(function () {
        $els.eq(i).fadeOut(function () {
            i = (i + 1) % len
            $els.eq(i).fadeIn();
        })
    }, 2500)
});*/

$(document).ready(function(){
	// $('#reContent').hide();
	var $els=$('h1[id^=content]'),i=0,len=$els.length;
	$els.slice(1).hide();
	$('#personDOB').datepicker();
	var colors=['#ebc428','#ac8c0e','#b0d114','#35de14','#14de65'];
	/*$('body').css({'background-color':colors[i]});
	setInterval(function(){
		$els.eq(i).fadeOut(function(){
			if(i!=len-1)
			{
				i=i+1;
				$els.eq(i).fadeIn(400);
				$('body').css({'background-color':colors[i]});
				// console.log(i);
				
			}
			else
			{
				$('#reContent').show();
				$('body').css({'background-color':'white'});
			}
			
		})
	},2500);*/

});

$('#topPartForm').submit(function(){
	var x=new FormData($(this)[0]);
	console.log(x);
	$.post('./handlers/initial/topPart.php',
	{
		data:x
	})
	.error(function(){
		alert("server overalofd");
	})
	.success(function(data){
		console.log(data);
	});
});

/*function submitTop(val,e)
{
	e.preventDefault();
	var x=new FormData($('#topPartForm')[0]);
	console.log(x);
	$.post('./handlers/initial/topPart.php',
	{
		data:x
	})
	.error(function(){
		alert("server overalofd");
	})
	.success(function(data){
		console.log(data);
	});
}*/

</script>


<body>

	<div class="container demo-3">

		<div class="row body">

				<div class="content">

					<div id="large-header" class="large-header">
		               
		                <canvas id="demo-canvas"></canvas>
		               
		                <h1 class="main-title">Collab</span></h1>
		            
		            </div>

				</div>

		</div>

	</div>
<script src="js/TweenLite.min.js"></script>
<script src="js/EasePack.min.js"></script>
<script src="js/rAF.js"></script>
<script src="js/demo-3.js"></script>
</body>