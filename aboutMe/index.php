



<?php 
include('../header.php');

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
	include("../offlineHeader.php");
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
						
						
						
							<div id="skills" class="tabContents"  >
							<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="row">		
									<div class="col-md-10" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-bar-chart"></i> Skill set</div>
										<br />
									</div>		
								    <div class="col-md-2 text-right">		
								    	<a href="#" title="Add a skill" data-toggle="modal" data-target="#addSkill" class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
									
									
										<div class="modal hide fade"id="addSkill" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add new Skill		</h4>
													</div>		
													<div class="modal-body">		
														<table class="table-condensed">		
															<tr>		
																<td><span class="text-error" >*</span> Skill:</td>		
																<td><input class="form-control" type="text" class="input class="form-control"-large" tabindex="1" required ></td>		
															</tr>		
															<tr>		
																<td><span class="text-error" >*</span> Percentage:</td>		
																<td><input class="form-control" type="range"  value="3" onchange="rangevalueAdd.value=value" min="3" max="100" 		step="1" class="input class="form-control"-small" tabindex="2" required ><output id="rangevalueAdd">3</output>%</td>
															</tr>		
								                     
														</table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								    
								    	
								    		
								    	
								
								       <div class="modal hide fade"id="editSkill" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit Skill</h4>		
													</div>		
													<div class="modal-body">		
														<table class="table-condensed">		
								                 			
															<tr>		
																<td><span class="text-error" >*</span> Skill:</td>		
																<td><input class="form-control" type="text" tabindex="1" required ></td>		
															</tr>		
															<tr>		
																<td><span class="text-error" >*</span> Percentage:</td>		
																<td><input class="form-control" type="range" onchange="rangevalueEdit.value=value" min="3" max="100" 		step="1" class="input class="form-control"-small" tabindex="2" required ><output id="rangevalueEdit">3</output>%</td>
															</tr>		
								                     		
														</table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>		
								                        		
								    	
								</div>        		
							    
								<div class="row">		
									<div class="col-md-12">		
										<div id="chart">
											
											
											<ul id="numbers" style="border-right:1px solid #000; padding-top: 15px;">		
												<li><span>100%</span></li>		
												<li><span>90%</span></li>		
												<li><span>80%</span></li>		
												<li><span>70%</span></li>		
												<li><span>60%</span></li>		
												<li><span>50%</span></li>		
												<li><span>40%</span></li>		
												<li><span>30%</span></li>		
												<li><span>20%</span></li>		
												<li><span>10%</span></li>		
												<li><span>0%</span></li>		
											</ul>		
											
											
											
											<ul id="bars" style="border-bottom:1px solid black;" >		
												<li  ><div data-percentage="100" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 1 <br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												
												
												<li  ><div data-percentage="93" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 2 <br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												
												<li  ><div data-percentage="80" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 3 <br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												
												<li  ><div data-percentage="75" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 4 <br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												
												
												<li  ><div data-percentage="67" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 5 <br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												
												
												<li  ><div data-percentage="50" title="100%" class="bar" style="border-top:0px;" ></div><span id="skillName" >Skill 6<br /><a href="#" data-target="#editSkill" data-toggle="modal" ><i class="fa fa-pencil"></i></a></span></li>
												

											</ul>
											
											<div style="position:absolute;bottom:40px;left:0px;">
											<a href="#"><i class="fa fa-2x fa-angle-double-left"></i></a> &nbsp;<a href="#"><i class="fa fa-angle-left fa-2x"></i></a>
											</div>
											
											<div style="position:absolute;bottom:40px;right:90px;">
											<a href="#"><i class="fa fa-2x fa-angle-right"></i></a> &nbsp;<a href="#"><i class="fa fa-angle-double-right fa-2x"></i></a>
											</div>
										</div>		
									</div>		
								</div>		
						
							</div>
							
							
							
							
							</div>
							</div>
							
							
							
							
							
						
							<div id="tools" class="tabContents"  >
							<div class="row">
							<div class="col-md-12">
								<div class="row">		
									<div class="col-md-10" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-wrench"></i> Tool set</div>
									</div>		
								    <div class="col-md-2 text-right">		
								    	<a href="#" title="Add a tool" data-toggle="modal" data-target="#addTool" style="float:right" class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
										<div class="modal hide fade"id="addTool" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add New Tool		</h4>
													</div>		
													<div class="modal-body">		
														<table class="table-condensed">		
															<tr>		
																<td><span class="text-error" >*</span> Tool:</td>		
																<td><input class="form-control" type="text" class="input class="form-control"-medium" tabindex="1" required ></td>
															</tr>		
																
								                     
														</table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								    	
								    
								    		
								    	
								
								       <div class="modal hide fade"id="editTool" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Tool set</h4>		
													</div>		
													<div class="modal-body">		
														<table class="table-condensed">		
								                 			
															<tr>		
																<td><span class="text-error" >*</span> Tool:</td>		
																<td><input class="form-control" type="text" class="input class="form-control"-medium" tabindex="1" required ></td>		
															</tr>		
																	
								                     		
														</table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>		
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-4">	
										<table cellpadding="15" style="font-size:18px;" >
											<tr>
												<td style="width:10px;" ><a href="#" data-toggle="modal" data-target="#editTool" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Adobe Photoshop CS6</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Adobe After Effects CS6</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Adobe Premiere Pro CS6</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											
											
										</table>	
									</div>
									
									<div class="col-md-4">	
										<table cellpadding="15" style="font-size:18px;" >
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											
										</table>	
									</div>
									
									<div class="col-md-4">	
										<table cellpadding="15" style="font-size:18px;" >
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											<tr>
												<td style="width:10px;" ><a  data-toggle="modal" data-target="#editTool" href="#" ><i class="fa fa-pencil" style="font-size:15px;"></i></a></td>
												<td><i class="fa  fa-th-large"	></i> Tool 1</td>
											</tr>
											
										</table>	
									</div>
									
									
								</div>  		
						
							</div>
							</div>
							</div>
							
	
	
						
							
						
							<div id="projects" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-database"></i> Projects</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add a Project" data-toggle="modal" data-target="#addProject"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
										<div class="modal hide fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add New Project</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="table-condensed ">
														 	<thead>
														    </thead>
														    <tr>
														     <td><span class="text-error" >*</span> Name:</td>
														     <td><input class="form-control" type="text" required ></td>
														 	</tr>
														    <tr>
														     <td><span class="text-error" >*</span> From:</td>
														     <td><input class="form-control" type="date" class="input class="form-control"-medium" required> &nbsp;&nbsp;<span class="text-error" >*</span> To: <input class="form-control"  class="input class="form-control"-medium" type="date" required ></td>
															</tr>
														    <tr> 
														     <td><span class="text-error" >*</span> Project Role:</td>
														     <td><input class="form-control" type="text" required ></td>
														  	</tr>
														    <tr>
														  	 <td><span class="text-error" >*</span> Description:</td>
														     <td><textarea class="form-control" style="min-height:50px; min-width:250px;max-width:300px;max-height:150px;" required></textarea class="form-control"></td>
														  	</tr>
														  </table>		
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!--<a href="#" data-toggle="modal" data-target="#editTool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>-->
								
								       <div class="modal hide fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit project details</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="table-condensed ">
														 	
														    <tr>
														     <td><span class="text-error" >*</span> Name:</td>
														     <td><input class="form-control" type="text" required ></td>
														 	</tr>
														    <tr>
														     <td><span class="text-error" >*</span> From:</td>
														     <td><input class="form-control" type="date" class="input class="form-control"-medium" required> &nbsp;&nbsp;<span class="text-error" >*</span> To: <input class="form-control"  class="input class="form-control"-medium" type="date" required ></td>
															</tr>
														    <tr> 
														     <td><span class="text-error" >*</span> Project Role:</td>
														     <td><input class="form-control" type="text" required ></td>
														  	</tr>
														    <tr>
														  	 <td><span class="text-error" >*</span> Description:</td>
														     <td><textarea class="form-control" style="min-height:50px; min-width:250px;max-width:300px;max-height:150px;" required></textarea class="form-control"></td>
														  	</tr>
														  </table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-6"  >	
										<div class="project" >
										<div class="row">
											<div class="col-md-8 text-left" >                
										        <div class="edittext" style="font-size:18px;" >Project Title</div>
										    </div>
											<div class="col-md-4 muted text-right" >
												
										        <em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp; June-July, 2014</div></em>
										    </div>
										 </div>
										 
										 <div class="row">
											<div class="col-md-5" style="font-size:14x;color:#333;" >
												<div>Lead Developer</div>
										    </div>
										    <div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
												@ <span>Company Name</span>
										    </div>
										 </div>
										 
										 <div class="row">
										    <div class="col-md-12" >
										        <ul class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >
												<li>This is some text. This is some text. This is some text. This is some text.This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												</ul>
										    </div>
										 </div>
										</div>	
										
										<div class="project" >
										<div class="row">
											<div class="col-md-8 text-left" >                
										        <div class="edittext" style="font-size:18px;" >Project Title</div>
										    </div>
											<div class="col-md-4 muted text-right" >
												
										        <em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp; June-July, 2014</div></em>
										    </div>
										 </div>
										 
										 <div class="row">
											<div class="col-md-5" style="font-size:14x;color:#333;" >
												<div>Lead Developer</div>
										    </div>
										    <div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
												@ <span>Company Name</span>
										    </div>
										 </div>
										 
										 <div class="row">
										    <div class="col-md-12" >
										        <ul class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >
												<li>This is some text. This is some text. This is some text. This is some text.This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												</ul>
										    </div>
										 </div>
										</div>	
										
									
										
									</div>
									
									
									<div class="col-md-6" >	
										<div class="project" >
										<div class="row">
											<div class="col-md-8 text-left" >                
										        <div class="edittext" style="font-size:18px;" >Project Title</div>
										    </div>
											<div class="col-md-4 muted text-right" >
												
										        <em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp; June-July, 2014</div></em>
										    </div>
										 </div>
										 
										 <div class="row">
											<div class="col-md-5" style="font-size:14x;color:#333;" >
												<div>Lead Developer</div>
										    </div>
										    <div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
												@ <span>Company Name</span>
										    </div>
										 </div>
										 
										 <div class="row">
										    <div class="col-md-12" >
										        <ul class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >
												<li>This is some text. This is some text. This is some text. This is some text.This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												</ul>
										    </div>
										 </div>
										</div>	
										
										<div class="project" >
										<div class="row">
											<div class="col-md-8 text-left" >                
										        <div class="edittext" style="font-size:18px;" >Project Title</div>
										    </div>
											<div class="col-md-4 muted text-right" >
												
										        <em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp; June-July, 2014</div></em>
										    </div>
										 </div>
										 
										 <div class="row">
											<div class="col-md-5" style="font-size:14x;color:#333;" >
												<div>Lead Developer</div>
										    </div>
										    <div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
												@ <span>Company Name</span>
										    </div>
										 </div>
										 
										 <div class="row">
										    <div class="col-md-12" >
										        <ul class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >
												<li>This is some text. This is some text. This is some text. This is some text.This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												<li>This is some text. This is some text. This is some text. This is some text.</li>
												</ul>
										    </div>
										 </div>
										</div>	
										
									
										
									</div>
									
									
									
							</div>  		
						
							</div>
							

	
	
	
							
							
						
							<div id="experience" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-fighter-jet"></i> Experience</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add an Experience" data-toggle="modal" data-target="#addExperience"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
										<div class="modal hide fade " id="addExperience" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add New Experience</h4>
													</div>	
													
													<div class="modal-body">		
														 <table>
														 	
														    <tr>
														     <td><label for="company"><span class="text-error" >*</span> Company/org:</label></td>
														     <td><input class="form-control" id="company" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error" >*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error" >*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr> 
														     <td><label id="designation" ><span class="text-error" >*</span>  Designation:</label></td>
														     <td><input class="form-control" id="designation"  type="text"  class="input class="form-control"-medium"  required ></td>
														  	</tr>
														    <tr>
														  	 <td><label id="description" ><span class="text-error" >*</span> Description:</label></td>
														     <td><textarea class="form-control" id="description"  style="min-height:50px; min-width:250px;max-height:150px;max-width:300px;" ></textarea class="form-control"></td>
														  	</tr>
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!--<a href="#" data-toggle="modal" data-target="#editTool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>-->
								
								       <div class="modal hide fade" id="editExperience" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit experience details</h4>		
													</div>		
													<div class="modal-body">		
														 <table>
														 	
														    <tr>
														     <td><label for="company"><span class="text-error" >*</span> Company/org:</label></td>
														     <td><input class="form-control" id="company" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error" >*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error" >*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr> 
														     <td><label id="designation" ><span class="text-error" >*</span>  Designation:</label></td>
														     <td><input class="form-control" id="designation"  type="text"  class="input class="form-control"-medium"  required ></td>
														  	</tr>
														    <tr>
														  	 <td><label id="description" ><span class="text-error" >*</span> Description:</label></td>
														     <td><textarea class="form-control" id="description"  style="min-height:50px; min-width:250px;max-height:150px;max-width:300px;" ></textarea class="form-control"></td>
														  	</tr>
														  </table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row"  style="padding-top:10px;"  >
									<div class="col-md-6" >
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										

										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										
									</div>
									
									
									<div class="col-md-6" >	
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										

										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small> Company/organisation</p>
											        
											    </div>
												<div class="col-md-2 text-right" >
													<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:16px;" class="edittext">Role/Position</p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										 
										  
										</div>
										
										
										
									</div>
									
									
									
							</div>  		
						
							</div>
							


							
							
							
							
							
							
						
							<div id="academics" class="tabContents" >
						
								<div class="row">		
									<div class="col-md-10" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-mortar-board"></i> Academics</div>
									</div>		
								    <div class="col-md-2 text-right">		
								    	<a href="#" title="Add an school" data-toggle="modal" data-target="#addSchool"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>	
										<div class="modal hide fade" id="addSchool" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add a School</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="degree"><span class="text-error" >*</span> Degree:</label></td>
														     <td><input class="form-control" id="degree" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="school"><span class="text-error" >*</span> Institution/School:</label></td>
														     <td><input class="form-control" id="school" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error" >*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error" >*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr>
														  	 <td><label id="location" ><span class="text-error" >*</span> Location:</label></td>
														     <td><input class="form-control" id="location" type="text"  class="input class="form-control"-medium" required ></td>
														  	</tr>
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!---->
								
								       <div class="modal hide fade" id="editSchool" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit School details</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="degree"><span class="text-error" >*</span> Degree:</label></td>
														     <td><input class="form-control" id="degree" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="school"><span class="text-error" >*</span> Institution/School:</label></td>
														     <td><input class="form-control" id="school" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error" >*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error" >*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr>
														  	 <td><label id="location" ><span class="text-error" >*</span> Location:</label></td>
														     <td><input class="form-control" id="location" type="text"  class="input class="form-control"-medium" required ></td>
														  	</tr>
														  </table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-6" >
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										
									</div>
									
									
									<div class="col-md-6" >	
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-9" >
											        
											        <p style="font-size:19px;" class="edittext">Degree</p>
											        
											    </div>
												<div class="col-md-3 text-right">
													<span style="font-size:16px;" class="badge">98%</span>
												</div>
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ Location</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										  
									</div>
										
										
										
										
								</div>
									
									
									
							</div>  		
						
							
							

			
							
							
							
							
						
							<div id="workshops" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-gears"></i> Workshops attended</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add an school" data-toggle="modal" data-target="#addWorkshop"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
										<div class="modal hide fade text-left" id="addWorkshop" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add a Workshop</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Venue:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error">*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error">*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr> 
														     <td><label id="attendees" ><span class="text-error">*</span> No. of attendees:</label></td>
														     <td><input class="form-control" id="attendees"  type="text"  class="input class="form-control"-medium"  required ></td>
														  	</tr>
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!---->
								
								       <div class="modal hide fade" id="editWorkshop" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit workshop details</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Venue:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error">*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error">*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														    <tr> 
														     <td><label id="attendees" ><span class="text-error">*</span> No. of attendees:</label></td>
														     <td><input class="form-control" id="attendees"  type="text"  class="input class="form-control"-medium"  required ></td>
														  	</tr>
														  </table>	
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-6" >
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
									</div>
									
									
									<div class="col-md-6" >	
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small> Workshop Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Location</em><br /><span style="font-size:14px;" class="muted">333 people attended</span></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										  
										</div>
										
										
										
										
									</div>
									
									
									
								</div>  		
						
							
							

							
							
							
						
							<div id="certifications" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-certificate"></i> Course Certifications</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add a Course Certification" data-toggle="modal" data-target="#addCertificate"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
										<div class="modal hide fade " id="addCertificate" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add a Course Certification</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="">
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Course Name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Institution Name:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error">*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error">*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!---->
								
								       <div class="modal hide fade" id="editCertification" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit Certification details</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="">
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Course Name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Institution Name:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="from" ><span class="text-error">*</span> From:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
														     <td><label for="to" ><span class="text-error">*</span> To:</label></td>
														     <td><input class="form-control" id="to" type="date"  class="input class="form-control"-small" required ></td>
															</tr>
														  </table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-6" >
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
								
									</div>
									
									
									<div class="col-md-6" >	
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
										<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-10" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small> Course Name</p>
											        
											    </div>
												
												<div class="col-md-2 text-right" >
													<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Institution Name</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Duration</p>
											        
											    </div>
											 </div>
										  
										</div>
										
										
											  
										</div>
										
										
										
										
									</div>
									
									
									
								</div>  		
						
							
			
							
							
							
							<div id="achievements" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-trophy"></i> Achievements</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add an Achievement" data-toggle="modal" data-target="#addAchievement"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
									
									
										<div class="modal hide fade text-left" id="addAchievement" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add an Achievement</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Event name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Prize/Medal:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="year" ><span class="text-error"><span class="text-error">*</span> </span> Year:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
															</tr>
														    <tr>
														     <td><label for="venue" ><span class="text-error"><span class="text-error">*</span> </span> Venue:</label></td>
														     <td><input class="form-control"  type="text"  class="input class="form-control"-small" id="from"  required></td>
															</tr>
															
															<tr>
														     <td><label for="description" ><span class="text-error"><span class="text-error">*</span> </span> Description:</label></td>
														     <td><textarea class="form-control"  type="text" id="description"  required></textarea class="form-control"></td>
															</tr>
															
															
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!---->
								
								       <div class="modal hide fade" id="editAchievement" tabindex="-1" role="dialog" aria-labelledby=		"basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit Achievent details</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="name"><span class="text-error">*</span> Event name:</label></td>
														     <td><input class="form-control" id="name" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
															<tr>
														     <td><label for="venue"><span class="text-error">*</span> Prize/Medal:</label></td>
														     <td><input class="form-control" id="venue" type="text" class="input class="form-control"-medium" required ></td>
														 	</tr>
														    <tr>
														     <td><label for="year" ><span class="text-error"><span class="text-error">*</span> </span> Year:</label></td>
														     <td><input class="form-control"  type="date"  class="input class="form-control"-small" id="from"  required></td>
															</tr>
														    <tr>
														     <td><label for="venue" ><span class="text-error"><span class="text-error">*</span> </span> Venue:</label></td>
														     <td><input class="form-control"  type="text"  class="input class="form-control"-small" id="from"  required></td>
															</tr>
															
															<tr>
														     <td><label for="description" ><span class="text-error"><span class="text-error">*</span> </span> Description:</label></td>
														     <td><textarea class="form-control"  type="text" id="description"  required></textarea class="form-control"></td>
															</tr>
															
															
														  </table>	
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								    	
								</div>        		
							    
							   <div class="row" style="padding-top:10px;" >
									<div class="col-md-6" >
										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

	
										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

									
									</div>
									
									
									<div class="col-md-6" >	
										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

	
										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

										<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" > 
											<div class="row" >
											    <div class="col-md-8" >
											        
											        <p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small> Event name</p>
											        
											    </div>
												<div class="col-md-4 text-right">
													<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp; Prize/Medal</p>
											        
												</div>
												
											 </div>
											 <div class="row" >
											    <div class="col-md-6" >
											        
											        <p style="font-size:15px;" class="edittext"><em>@ Venue</em></p>
											        
											    </div>
												<div class="col-md-6 text-right" >
											        
											        <p style="font-size:14px;" class="edittext">Year													
													</p>
											        
											    </div>
											 </div>
											<div class="row" >
											    <div class="col-md-12" >
											        
											        <p style="font-size:14px;" class="edittext">Description</p>
											    </div>
											 </div>
										</div>
	

							
									</div>
									
									
									
								</div>  	
							
							
							
						</div>
					



					
							
							<div id="ints" class="tabContents"  >
						
								<div class="row">		
									<div class="col-md-8" >		
										<div style="font-size:25px;color:#004087;" ><i class="fa fa-star"></i> Interests</div>
									</div>		
								    <div class="col-md-2 col-md-offset-2 text-right">		
								    	<a href="#" title="Add an Interest" data-toggle="modal" data-target="#addInterest"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>
									</div>
									
										<div class="modal hide fade" id="addInterest" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add an Interest</h4>
													</div>	
													
													<div class="modal-body">		
														 <table class="">
														 	
														    <tr>
														     <td><label for="interest" ><span class="text-error">*</span> Interest:</label></td>
														     <td><input class="form-control" id="interest" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															
														  </table>	
													</div>	
													
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save</button>
													</div>		
												</div>		
											</div>		
								        </div>		
							    
								   	
								    		
								    	<!---->
								
								       <div class="modal hide fade" id="editInterest" tabindex="-1" role="dialog"   aria-labelledby="basicModal"   aria-hidden="true">
											<div class="modal-dialog">		
												<div class="modal-content">		
													<div class="modal-header">		
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">		&times;</button>
														<h4 class="modal-title" id="myModalLabel">Edit Interest</h4>		
													</div>		
													<div class="modal-body">		
														 <table class="">
														    <tr>
														     <td><label for="interest" ><span class="text-error">*</span> Interest:</label></td>
														     <td><input class="form-control" id="interest" type="text" class="input class="form-control"-large" required ></td>
														 	</tr>
															
														  </table>		
													</div>		
													<div class="modal-footer">		
														<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>		
														<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style=		"padding-right:5px"></i>Save changes</button>
													</div>		
												</div>		
											</div>		
								        </div>	
								                        		
								   	
								</div>        		
							    

								<div class="row" style="padding-top:10px;" >
								    <div class="col-md-4" >
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
								    </div>	

								    <div class="col-md-4" >
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
								    </div>	
									
								    <div class="col-md-4" >
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
										<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" data-toggle="modal" data-target="#editInterest"  class="text-error"  ><i class="fa fa-pencil" ></i></a> Interest1</div>
										
								    </div>	
								 </div>

						</div>
							
							
							
							
							
						
				        
						
					</div>
					
					
					
				</div>
			</div>
					
					
					
					
					
			<div class="row" style="margin-top:0px;" >
				<div class="col-md-10 col-md-offset-1" id="contact" style="background-color:white;border-left:1px solid rgba(0,0,0,0.2); border-right:1px solid rgba(0,0,0,0.2); padding:20px;margin-top:0px;border-top:5px solid #007890;border-bottom:1px solid rgba(0,0,0,0.2);"  >
				
				
					<div class="row">
						<div class="col-md-6">
							<div style="font-size:25px;color:#004087;" ><i class="fa fa-envelope"></i> Leave a message</div>
							
							<br />
							<form id="contact-form" action="/" method="post">
								<small class="text-error" > * required</small>
								<table>
									<tr>
										<td>
											<input class="form-control" type="text" name="guestName" placeholder="Your Name..."  required/><small class="text-error" > *</small>
										</td>
									</tr>
									<tr>
										<td>
											<input class="form-control" type="email" name="guestEmailID" placeholder="Your Email ID..."  required/><small class="text-error" > *</small><small class="muted" > (your email id will not be disclosed)</small>
										</td>
									</tr>
									<tr>
										<td>
											<textarea class="form-control"  name="message" style="width:400px;max-width:400px;min-height:100px;" rows="4" cols="20" placeholder="Your message..."  required></textarea class="form-control"><small class="text-error" > *</small>
										</td>
									</tr>
									
									<tr>
										<td style="text-align:center;" >
											<button type="submit" class="btn btn-primary" name="submitMessage"  ><i class="fa fa-check"></i> Send</button>
										</td>
									</tr>
								</table>
							</form>
						</div>
						
						<div class="col-md-6">
						
							<div class="row">
							
								<div class="col-md-8" >
									<div style="font-size:25px;color:#004087;" ><i class="fa fa-share-alt"></i> Lets get connected</div>
								</div>
								
								
								
								<div class="col-md-2 col-md-offset-2">
									<a href="#" class="text-error" data-toggle="modal" data-target="#edit"  ><i class="fa fa-pencil" ></i> Edit</a>
    
									<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 id="myModalLabel"><i class="fa fa-pencil"></i> Edit Social media links</h4>
										</div>
										<div class="modal-body">
											<table class="table-condensed">
												<tr>
													<td><label for="facebk" ><img src="img/fbsmall.png" /></label></td>	
													<td><input class="form-control" type="url" id="facebk" ></td>	
												</tr>	
												<tr>	
													<td><label for="twtr" ><img src="img/twittersmall.png" /></label></td>	
													<td><input class="form-control" type="url" id="twtr" /></td>	
												</tr>	
												<tr>	
													<td><label for="gooplus" ><img src="img/googlesmall.png"/></label></td>	
													<td><input class="form-control" type="url" id="gooplus" ></td>	
												</tr>	
												<tr>	
													<td><label for="linkin" ><img src="img/linksmall.png" /></label></td>	
													<td><input class="form-control" type="url" id="linkin" ></td>	
												</tr>	
												<tr>	
													<td><label for="pterest" ><img src="img/pinsmall.png" /></label></td>	
													<td><input class="form-control" type="url" id="pterest" ></td>	
												</tr>	
											</table>	
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
													<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o" style="padding-right:5px"></i>Save Changes</button>
										</div>
									</div>
                
								</div>
								
								
								
								
							</div>
							
							<br />
							<div class="row" >
								
								<div class="col-md-2">
									<a href="#" class="icon-button facebook" ><i class="fa fa-facebook" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2">
									<a href="#"  class="icon-button twitter"><i class="fa fa-twitter" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2">
									<a href="#" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2">
									<a href="#" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>
								
								<div class="col-md-2">
									<a href="#" class="icon-button pinterest"><i class="fa fa-pinterest" style="font-size:25px;margin-top:15px;"></i><span></span></a>
								</div>

							</div>
							
							<br />
							<div class="row">
								<div class="col-md-12" >
									<div style="font-size:18px;color:#004087;" ><i class="fa fa-info-circle" ></i> more info</div>
										<table>
											<tr>
												<td style="vertical-align:top;" ><b>Email-id: </b></td>
												<td style="vertical-align:top;" >someone@gmail.com<br />someone@gmail.com</td>
												
												<td style="vertical-align:top;" ><b>&nbsp;&nbsp;&nbsp;Address: </b></td>
											    <td style="vertical-align:top;" >DieSachbearbeiter<br />
													Schönhauser Allee 167c<br />
													10435 Berlin<br />
													Germany<br />
											    </td>
											</tr>
											
											<tr>
												<td style="vertical-align:top;" ><b>Contact no: </b></td>
											    <td><em>+91 - 7299836756<br />+91 - 7299836756</em></td>
											</tr>
											
										</table>

								</div>
            
							</div>
							
						</div>
					</div>
					

					
			
					
				</div>
			</div>	
					







<?php
include("../footer.php");
?>

	
