<?php 
	include('../header_adv.php');
?>

<style>
	.leftMenItem
		{
			background-color:#007870;
			border-bottom:1px solid white;
			color:white;padding:13px;
			text-align:center;
		}
		
		
	.leftMenItem:hover
		{
			background-color:black;
		}
		
		
	.leftMenItemHover
		{
			background-color:black;
		}
		
		
	.aboutTab:hover
		{
			background-color:black;
		}
		
	
	.workshop, .experiences, .school, .certification, .achievement, .project, .interest
		{
			padding:10px;
			padding-left:15px;
			cursor:pointer;
		}
		
		
	.interest
		{
			padding: 5px;
			padding-left:10px;
			background-color: rgba(0,0,0,0.05);
			margin: 15px;
			
		}
		
	
	.project
		{
			border-bottom: 1px solid rgba(0,0,0,0.2);
			padding-bottom:20px;
			
		}
	.workshop:hover, .experiences:hover, .school:hover, .certification:hover, .achievement:hover, .project:hover, .interest:hover
		{
			background-color: rgba(0,0,0,0.02);
		}
	.experiences:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(154, 105, 170, 1) inset;
		}
	.workshop:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(3, 184, 206, 1) inset;
		}
	.school:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(222, 123, 26, 1) inset;
		}
	.certification:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(0, 150, 18, 1) inset;
		}
	.achievement:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(192, 54, 117, 1) inset;
		}
	.project:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(80, 183, 154, 1) inset;
		}
	.interest:hover
		{
			box-shadow: 5px 0px 0px 0px rgba(80, 183, 154, 1) inset;
		}
</style>


<body style="padding:0px;" >
    
    <div id="wrap" >

		
		
<?php
	include("../topBar.php");
?>
		
		
		
		
		
		
		
		<div id="container" >
			
			<div class="row" >
				<div class="col-md-10 col-md-offset-1" style="background-color:white;border-left:1px solid rgba(0,0,0,0.2); border-right:1px solid rgba(0,0,0,0.2); margin-top:35px;padding:30px 15px 0px 15px;"  >
				

					<div class="row" style="margin-bottom:20px;" ><!-- row div -->

						<div class="col-md-2 text-center" ><!-- INFO div -->
							<div style="float:left;">
								<img src="/4pi/img/hpics/3.jpg"  width="180" style="border-radius:100%;" />
								<div class="roll" style="font-size:23px;margin-top:10px;" >COE12B001</div>
								
							</div>
						</div><!--End of INFO div -->
		
		
						<div class="col-md-10  maininfo " style="margin-top:2%;"  ><!-- short description div -->
							
							<div class="row">
								<div class="col-md-12">
									<p style="font-size:33px;padding-left:20px;">Sai Hemanth Ghantasala</p>
								</div>
							</div>
							
							
							
							<div class="row">
								<div class="col-md-4" style="padding-left:20px;" >
									
									
									<p style="font-size:15px;"><em>28-06-1994</em></p>
									<p style="font-size:17px;">B.Tech, Computer Engineering</p>
									<p style="font-size:18px;">CEO at apple.inc</p>
									<a href="index.php"  class="btn btn-primary" >Find My Resume <i class="fa fa-external-link"></i></a>
									
								</div>
								
								<div class="col-md-8 "  ><!-- profile pic div -->
									<br />
									<!--<h4>Objective</h4>-->
									<div style="text-align:justify;margin-top:10px;border-left:1px solid grey;padding-left:10px;font-weight:italic;" class="edittext" >I think it's important to always keep professional and surround yourself with good people, work hard, and be nice to everyone. A professional is someone who can do his best work when he doesn't feel like it. I know I'm a good professional, I know that no one's harder on me than myself and that's never going to change, under any circumstances. All I do, really, is go to work and try to be professional, be on time and be prepared.</div>
									<span id="tcontents" ></span>
								</div><!--end div profile pic -->
								
							</div>
						</div><!--End of short description div  -->
			
		    
					</div> <!--End of row div -->
					
					
				</div>
			</div>
					
					
			<div class="row" >
				<div class="col-md-10 col-md-offset-1" style="background-color:white;border-left:1px solid rgba(0,0,0,0.2); border-right:1px solid rgba(0,0,0,0.2);padding:0px !important;"  >
				
					<nav class="navbar navbar-inverse" role="navigation" id="navigation"style="border-radius:0px;" >
					    <div class="navbar-inner" style="border-radius:0px;">
							<div class="container">
					     
					
								
									
									<ul class="nav navbar-nav" style="margin-left:-5px;">
								
								
								
										<li class="aboutTab active"  ><a href="#tcontents" data-target="skills" class="contentTabs"  ><i class="fa fa-bar-chart"></i> Skills</a></li>
										<li class="aboutTab"><a  data-target="tools" href="#tcontents" class="contentTabs"  ><i class="fa fa-wrench"></i> Tools</a></li>
										<li class="aboutTab" ><a data-target="projects" class="contentTabs" href="#tcontents"  ><i class="fa fa-database"></i> Projects</a></li>
										<li class="aboutTab" ><a class="contentTabs" data-target="experience" href="#tcontents"  ><i class="fa fa-fighter-jet"></i> Experience</a></li>
										<li class="aboutTab" ><a data-target="academics" class="contentTabs" href="#tcontents"  ><i class="fa fa-mortar-board"></i> Academics</a></li>
										<li class="aboutTab"  ><a data-target="workshops" class="contentTabs" href="#tcontents"  ><i class="fa fa-gears"></i> Workshops</a></li>
										<li class="aboutTab"><a  data-target="certifications"  class="contentTabs" href="#tcontents"  ><i class="fa fa-certificate"></i> Certifications</a></li>
										<li class="aboutTab"  ><a data-target="achievements" class="contentTabs" href="#tcontents"  ><i class="fa fa-trophy"></i> Achievements</a></li>
										<li class="aboutTab" ><a data-target="ints" class="contentTabs" href="#tcontents"  ><i class="fa fa-star"></i> Interests</a></li>
										<li class="aboutTab" ><a href="#contact" ><i class="fa fa-envelope"></i> Contact</a></li>
										
								
									</ul>
								
					     
							</div>
					    </div>
					</nav>

				</div>
			</div>
			
			
			
			
			

					
			<div class="row" >
				<div class="col-md-1 "  >
					<ul style="list-style-type:none;margin-right:0px;" >
						<a href="#tcontents"  class="contentTabs"  data-target="skills" style="color:white;" ><li  class="leftMenItem" ><i class="fa fa-lg fa-bar-chart"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="tools" style="color:white;" ><li class="leftMenItem" ><i class="fa fa-lg fa-wrench"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="projects" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-database"></i></li></a>
						<a href="#tcontents" class="contentTabs"   data-target="experience" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-fighter-jet"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="academics" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-mortar-board"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="workshops" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-gears"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="certifications" style="color:white;" ><li  class="leftMenItem"  ><i class="fa fa-lg fa-certificate"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="achievements" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-trophy"></i></li></a>
						<a href="#tcontents"  class="contentTabs"  data-target="ints" style="color:white;" ><li   class="leftMenItem" ><i class="fa fa-lg fa-star"></i></li></a>

					</ul>
				</div>
				
				
				
				<div class="col-md-10 " style="background-color:white;border-left:1px solid rgba(0,0,0,0.2); border-right:1px solid rgba(0,0,0,0.2); padding:15px 15px 15px 20px;"  >
					
					<div class="row"  >
						
						<div class="col-md-12" style="min-height:420px;" >
						
						
						<!-- skills -->
							<div id="skills" class="tabContents"  >
							
							</div>

						<!-- tools -->
							<div id="tools" class="tabContents">

							<</div>

						<!-- projects -->
							<div id="projects" class="tabContents"  >
						
								 		
						
							</div>
							

	
	
	
							
							
						<!-- experience -->
							<div id="experience" class="tabContents"  >
						
								 		
						
							</div>
							


							
							
							
							
							
							<!-- academics -->
						
							<div id="academics" class="tabContents" >
									
									
									
							</div>  		
						
							
							

			
							
							
							
							
						<!-- workshops -->
							<div id="workshops" class="tabContents"  >

							</div>
						
							
							

							
							
							
						<!-- certifications -->
							<div id="certifications" class="tabContents"  >
						
							</div>		
						
							
			
							
							
							<!-- achievements -->
							<div id="achievements" class="tabContents"  >
							
							
							
							</div>
					



					
							<!-- interests -->
							<div id="ints" class="tabContents"  >

							</div>
							
							
							
							
							
						
				        
						
					</div>
					
					
					
				</div>
			</div>
					
					
					
					
					<!-- bottom part -->
			<div class="row" style="margin-top:0px;" >
			</div>	
					







<?php
include("../footer.php");
?>

	
