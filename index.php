<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once('handlers/fetch.php');
require_once('QOB/qob.php');
if($_GET['logout']=="yes")
	{
		$logId=$_SESSION['logId'];
		logoutLog($logId);
		unset($_SESSION['vj']);
		unset($_SESSION['tn']);
		unset($_SESSION['mq']);
		unset($_SESSION['jq']);
		unset($_SESSION['qq']);
		unset($_SESSION['mc']);
		session_destroy();
		
//echo '<script>window.location="index.php";</script>';
}
if(!isset($_SESSION['vj']))
{
require("header.php");
?>
<script>
//to detect enter key press in login form
function checkKeyEnter(e){
	var code = (e.keyCode ? e.keyCode : e.which);
	 if(code == 13) { //Enter keycode
	   userLogin();
	 }

}

function showSearchModal()
{
	$('#searchModal').modal('show');
	$('#searchResults').find('.searchResult').each(function(){
		$(this).remove();
	});
	$('#searchModal').find('#searchModalInput').val("");
}

var result="";

function imageInsertSearch(data,val)
{
	if(val==0)
	{
		if(data.gender=="M")
			{
				var result="";
				result+='<div class="row searchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

				result+='<div class="col-md-1" id="userImage">';

				result+='<img src="/4pi/img/defaultMan1.jpg" alt="'+data.name+'" width="30" height="30"/>';

				result+='</div>';

				result+='<div class="col-md-11" id="userName">';

				result+='<a href="/4pi/aboutMe/index.php?userId='+data.userId+'"><h4 style="padding-top:2px;" id="userNameText" class="text-left">'+data.name+'</h4></a>';

				result+='</div>';

				result+='</div>';

				$('#searchResults').append(result);
			}
			else
			{

				var result="";
				result+='<div class="row searchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

				result+='<div class="col-md-1" id="userImage">';


				// console.log("WENT");
				result+='<img src="/4pi/img/defaultWoman1.jpg" alt="'+data.name+'" width="30" height="30"/>';

				result+='</div>';

				result+='<div class="col-md-11" id="userName">';

				result+='<a href="/4pi/aboutMe/index.php?userId='+data.userId+'"><h4 style="padding-top:2px;" id="userNameText" class="text-left">'+data.name+'</h4></a>';

				result+='</div>';

				result+='</div>';

				$('#searchResults').append(result);
				
			}
	}
	else
	{
		var result="";
		result+='<div class="row searchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';

		result+='<div class="col-md-1" id="userImage">';


		// console.log("WENT");
		result+='<img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.name+'" width="30" height="30"/>';

		result+='</div>';

		result+='<div class="col-md-11" id="userName">';

		result+='<a href="/4pi/aboutMe/index.php?userId='+data.userId+'"><h4 style="padding-top:2px;" id="userNameText" class="text-left">'+data.name+'</h4></a>';

		result+='</div>';

		result+='</div>';

		$('#searchResults').append(result);
	}

	// $('#searchResults').append(result);
}

function checkIfImageExists(url,data,res)
{
	$.ajax(url,{
			x:url
		})
		.error(function(){
			// console.log(data.gender);
			imageInsertSearch(data,0);
		})
		.success(function(){
			imageInsertSearch(data,1);
		});
}


function insertSearchResult(data)
{
	
		// alert(url);
		// 
		// $('#searchResults').append(result);
		var url="/4pi/img/proPics/"+data.userIdHash+".jpg";
		checkIfImageExists(url,data);
			
		// result="";
}

var change=0;
function homeSearch(el)
{
	var v=$(el).val();
	if(change==0)
	{
		change=1;
		$.post('./handlers/homeSearch.php',{
			_inputVal:v
		})
		.error(function(){

		})
		.success(function(data){
			console.log(data);
			data=JSON.parse(data);
			$('.searchResult').each(function(){
				$(this).remove();
			});
			if(data==131)
			{
				$('#noResultForSearch').html("<h4>No results found.</h4>");
				change=0;
			}
			else
			{  
				$('#noResultForSearch').html("");
				for(i=0;i<data.length;i++)
				{
					insertSearchResult(data[i]);
				}
				change=0;
			}
		});
	}
	
}
</script>
<body>
	<div id="wrap-body" >
		<div class="container-fluid text-center" >
			
			
			
			
			<div id="section1"> <!-- logo of iiitdm and the login part -->
			<div class="row">
				<div class="col-md-3 text-left" >
					<a href="http://www.iiitdm.ac.in" target="_blank">
						<div>
							<div id="instiLogo" >
								<img src="./img/appImgs/iiitdm - inside.svg" class="img-responsive" id="instiLogoInside"   />
								<img src="./img/appImgs/iiitdm - ring.svg"  class="img-responsive" id="instiLogoOutside"  />
							</div>
							<span id="collegeName" >IIITD&amp;M Kancheepuram</span>
						</div>
					</a>
				</div>
				
				
				<div class="col-md-6">
					<a id="portalName" title="4&#960; - Students Portal @ IIITD&ampM Kancheepuram" href="javascript:void(0)" onclick="/4pi" >Student Portal</a>
				</div>
				
				<div class="col-md-3 login">
					<a class="btn btn-primary" id="loginButton" >
						<i class="fa fa-user"></i> Login
					</a>
					
					<div id="loginForm" class="aClose" >
						
						<form method="post" class="aClose" >
							
							<span id="loginClose" >
							<i class="fa fa-times " ></i>
							</span>
							
							<div class="aClose" >
								<i class="fa fa-user aClose"></i>&nbsp;&nbsp;
								<input type="text" class="form-control input-md aClose" onkeypress="checkKeyEnter(event);" name="loginUsername" id="loginUsername" placeholder="Username..." style="" required/>
							</div>
							
							<br />
							
							<div class="aClose" >
								<i class="fa fa-unlock aClose"></i>&nbsp;
								<input type="password" class="form-control aClose input-md" onkeypress="checkKeyEnter(event);" name="loginPassword" id="loginPassword" placeholder="Password..." autocomplete="off"  required/>
							</div>
							
							<br />
							
							<a name="login"  onclick="userLogin();"  class="aClose btn btn-success" id="loginButtonIn" >
								<i class="fa fa-check aClose" ></i> Go
							</a>

							<br/>

							<a href="javascript:void(0)" onclick="window.location.href='/4pi/handlers/forgotPassword.php'">Forgot password?</a>
							
							<div id="loginError" class="text-error aClose" ></div>
							
						</form>
					</div>
					
				</div>
			</div>
			</div><!-- end of section 1 -->
			
			<div id="section5">
				<div class="row">
					<div class="col-md-4 text-center col-md-offset-4">
						An informative hub
					</div>
					<div class="col-md-4">
								<a href="javascript:void(0)"><div class="socialIcons" id="facebook" ></div></a>
								<a href="javascript:void(0)"><div class="socialIcons" id="twitter" ></div></a>
								<a href="javascript:void(0)"><div class="socialIcons" id="gplus" ></div></a>
					</div>
				</div>
			</div>
			<br/>
			
			<div id="section2">
				<div class="row text-center" >
					<div class="col-md-5 "   >
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'"  ><canvas class="hex" width="84" height="72" ></canvas></a></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb"  width="84" height="72" ></canvas></a>
						</div>
						<div class="lowerRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="lowerRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
					</div>
					
					<div class="col-md-2 text-center" id="logArea"  >
						<a href="/4pi/team/" >
							<img id="pilogo" title="The 4&#960; Team - WebOps" class="img-responsive" src="img/appImgs/fourpi.svg" />
						</a>
					</div>
					
					<div class="col-md-5  "   id="rightCanvasContainer" >
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="lowerRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="lowerRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
						<div class="upperRow">
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex" width="84" height="72" ></canvas></a>
							<a href="javascript:void(0)" onclick="window.location.href='/4pi/index.php'" ><canvas class="hex lastComb" width="84" height="72" ></canvas></a>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="section3"> <!-- links to other pages -->
			<div class="row">
				<div class="col-md-3 blocks" >
					<a href="javascript:void(0)" onclick="window.location.href='/4pi/people'" class="blcs" title="Student Representatives" >
						<div id="ew" >
							<i class="fa fa-bank "></i>
							<p>Representatives</p>
						</div>
					</a>
					</div><!-- end of class col-md-3 -->
					<div class="col-md-3 blocks" >
						<a href="javascript:void(0)" onclick="window.location.href='/4pi/clubs'" class="blcs" title="Clubs" >
							<div id="sig" >
								<i class="fa fa-share-alt "></i>
								<p>Clubs</p>
							</div>
						</a>
						</div><!-- end of class col-md-3 -->
						<div class="col-md-3  blocks " >
							<a href="javascript:void(0)" onclick="showSearchModal();" role="button" title="Search students" class=" blcs" data-toggle="modal">
								<div id="fb">
									<i class="fa fa-search "></i>
									<p>Search</p>
								</div>
							</a>
							</div><!-- end of class col-md-3 -->
							<div class="col-md-3   blocks" >
								<a href="javascript:void(0)" onclick="window.location.href='/4pi/about'" title="About 4pi" class=" blcs" >
									<div id="aaq">
										<i class="fa fa-info-circle" ></i>
										<p >About</p>
									</div>
								</a>
								</div><!-- end of class col-md-3 -->
								</div><!-- end of class row in section 3 -->
								
								<!-- search -->
								<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h3><i class="fa fa-search"></i> Search students</h3>
											</div>
											<div class="modal-body">
												<h4><b>Enter student name</b></h4>
												<br />
												<div class="row" style="border-bottom:1px solid #e6e6e6;padding-bottom:20px;">
													<div class="col-md-8 col-md-offset-2">
														<input type="text" id="searchModalInput" class="form-control input-md" onkeyup="homeSearch(this,event);" placeholder="Only 100 characters allowed..." />
													</div>
												</div>

												<div id="searchResults" style="min-height:100px;"  >
													

												</div>

												<div  id="noResultForSearch"></div>
												
											</div>
										</div>
									</div>
								</div>
								<!-- -->
								
								
								
								<!-- feedback modal -->
								<div id="fdback" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">
										<i class="fa fa-envelope"></i> Feedback
										</h3>
									</div>
									<div class="modal-body">
										<p>We value your feedback...</p>
										<textarea name="feedback" id="feed"  class="text" placeholder="1000 characters allowed..." maxlength="1000" ></textarea>
										<br />
										<b>Characters left: </b>
										<col-md- id="charCountF" >1000</col-md->
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
										<button class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
									</div>
								</div>
								<!-- feedback modal -->
								
								
								
								</div><!-- end of section 3 -->
								<br />
								</div><!--to close container -->
								<?php
									}
								else
									{
								echo '<script>window.location="newsfeed.php";</script>';
								}
								?>
								<script>
									
								
								
								</script>
								<?php
									echo '<br/>';
									require("footer.php");
								?>