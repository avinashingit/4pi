//data attributes not written for any
//set mode bit also	
//top part done, bottom part done, interests part done, acheivements part done, certifications part done, workshops attended done, academics done, experiences done, projects done, 
//---------------------------------------------------------------//
function topPartInsert(data)
{

	var top="";
	top+='<div class="row" >';
	top+='<div class="col-md-10 col-md-offset-1" style="background-color:white;border-left:1px solid rgba(0,0,0,0.2); border-right:1px solid rgba(0,0,0,0.2); margin-top:35px;padding:30px 15px 0px 15px;"  >';


	top+='<div class="row" style="margin-bottom:20px;" ><!-- row div -->';

	top+='<div class="col-md-2 text-center" ><!-- INFO div -->';
	top+='<div style="float:left;">';
	top+='<img src="/4pi/img/hpics/'+data.profilePicture+'.jpg"  width="180" style="border-radius:100%;" />';
	top+='<div class="roll" style="font-size:23px;margin-top:10px;" >'+data.rollNo+'</div>';

	top+='</div>';
	top+='</div><!--End of INFO div -->';


	top+='<div class="col-md-10  maininfo " style="margin-top:2%;"  >';

	top+='<div class="row">';
	top+='<div class="col-md-12">';
	top+='<p style="font-size:33px;padding-left:20px;">'+data.name+'</p>';
	top+='</div>';
	top+='</div>';



	top+='<div class="row">';
	top+='<div class="col-md-4" style="padding-left:20px;" >';


	top+='<p style="font-size:15px;"><em>28-06-1994</em></p>';
	top+='<p style="font-size:17px;">B.Tech, Computer Engineering</p>';
	top+='<p style="font-size:18px;">CEO at apple.inc</p>';
	top+='<a href="'+data/resumeLink+'"  class="btn btn-primary" >Find My Resume <i class="fa fa-external-link"></i></a>';

	top+='</div>';

	top+='<div class="col-md-8 "  ><!-- profile pic div -->';
	top+='<br />';
	top+='<!--<h4>Objective</h4>-->';
	top+='<div style="text-align:justify;margin-top:10px;border-left:1px solid grey;padding-left:10px;font-weight:italic;" class="edittext" >I think it</div>';
	top+='<span id="tcontents" ></span>';
	top+='</div><!--end div profile pic -->';

	top+='</div>';
	top+='</div><!--End of short description div  -->';


	top+='</div> <!--End of row div -->';


	top+='</div>';
	top+='</div>';
}

function topPartFetch()
{
	var userName="COE12009";
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_userName:userName,
		_mode:1
	})
	.error(function(){
		alert("Server overload. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			topPartInsert(data);
		}
	});
}

//----------------------------------------------------------------//

function bottomPartInsert(data)
{
	var bot="";
	bot+='<div class="row">';
	bot+='<div class="col-md-6">';
	bot+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-envelope"></i> Leave a message</div>';

	bot+='<br />';
	bot+='<form id="contact-form" action="/" method="post">';
	bot+='<small class="text-error" > * required</small>';
	bot+='<table>';
	bot+='<tr>';
	bot+='<td>';
	bot+='<input class="form-control" type="text" name="guestName" placeholder="Your Name..."  required/><small class="text-error" > *</small>';
	bot+='</td>';
	bot+='</tr>';
	bot+='<tr>';
	bot+='<td>';
	bot+='<input class="form-control" type="email" name="guestEmailID" placeholder="Your Email ID..."  required/><small class="text-error" > *</small><small class="muted" > (your email id will not be disclosed)</small>';
	bot+='</td>';
	bot+='</tr>';
	bot+='<tr>';
	bot+='<td>';
	bot+='<textarea class="form-control"  name="message" style="width:400px;max-width:400px;min-height:100px;" rows="4" cols="20" placeholder="Your message..."  required></textarea class="form-control"><small class="text-error" > *</small>';
	bot+='</td>';
	bot+='</tr>';

	bot+='<tr>';
	bot+='<td style="text-align:center;" >';
	bot+='<button type="submit" class="btn btn-primary" name="submitMessage"  ><i class="fa fa-check"></i> Send</button>';
	bot+='</td>';
	bot+='</tr>';
	bot+='</table>';
	bot+='</form>';
	bot+='</div>';

	bot+='<div class="col-md-6">';

	bot+='<div class="row">';

	bot+='<div class="col-md-8" >';
	bot+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-share-alt"></i> Lets get connected</div>';
	bot+='</div>';

	bot+='<div class="col-md-2 col-md-offset-2">';
	bot+='<a href="#" class="text-error" data-toggle="modal" data-target="#edit"  ><i class="fa fa-pencil" ></i> Edit</a>';
	bot+='</div>';

	bot+='</div>';

	bot+='<br />';

	bot+='<div class="row" >';

	if(data.facebookId!="")
	{
	bot+='<div class="col-md-2">';
	bot+='<a href="'+data.facebookId+'" class="icon-button facebook" ><i class="fa fa-facebook" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
	bot+='</div>';
	}

	if(data.twitterId!="")
	{
	bot+='<div class="col-md-2">';
	bot+='<a href="'+data.twitterId+'"  class="icon-button twitter"><i class="fa fa-twitter" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
	bot+='</div>';
	}

	if(data.gplusId!="")
	{
	bot+='<div class="col-md-2">';
	bot+='<a href="'+data.gplusId+'" class="icon-button google-plus"><i class="fa fa-google-plus" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
	bot+='</div>';
	}

	if(data.linId!="")
	{
	bot+='<div class="col-md-2">';
	bot+='<a href="'+data.linId+'" class="icon-button linkedin"><i class="fa fa-linkedin" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
	bot+='</div>';
	}

	if(data.ptrestId!="")
	{
	bot+='<div class="col-md-2">';
	bot+='<a href="'+data.ptrestId+'" class="icon-button pinterest"><i class="fa fa-pinterest" style="font-size:25px;margin-top:15px;"></i><span></span></a>';
	bot+='</div>';
	}

	bot+='</div>';

	bot+='<br />';
	bot+='<div class="row">';
	bot+='<div class="col-md-12" >';
	bot+='<div style="font-size:18px;color:#004087;" ><i class="fa fa-info-circle" ></i> more info</div>';
	bot+='<table>';
	bot+='<tr>';
	if(data.emailId1!="")
	{
	bot+='<td style="vertical-align:top;" ><b>Email-id: </b></td>';
	bot+='<td style="vertical-align:top;" >'+data.emailId1+'<br />'+data.emailId2+'</td>';
	}

	if(data.address!="")
	{
	bot+='<td style="vertical-align:top;" ><b>&nbsp;&nbsp;&nbsp;Address: </b></td>';
	bot+='<td style="vertical-align:top;" >'+data.address+'</td>';

	}

	bot+='</tr>';

	bot+='<tr>';
	if(data.pNumber1!="")
	{
	bot+='<td style="vertical-align:top;" ><b>Contact no: </b></td>';
	bot+='<td><em>'+data.pNumber1+'<br />'+data.pNumber2+'</em></td>';
	}

	bot+='</tr>';

	bot+='</table>';

	bot+='</div>';

	bot+='</div>';

	bot+='</div>';
	bot+='</div>';
}

function bottomPartFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		bottomPartInsert(data);
	});
}
//----------------------------------------------------------------//
function interestsInsert(data)
{
	var inte="";
	inte+='<div class="row">	';	
	inte+='<div class="col-md-8" >';	
	inte+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-star"></i> Interests</div>';
	inte+='</div>		';
	inte+='<div class="col-md-2 col-md-offset-2 text-right">	';	
	inte+='<a href="#" title="Add an Interest" data-toggle="modal" data-target="#addInterest"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
	inte+='</div>';
	inte+='</div>';       		
							    

	inte+='<div class="row" style="padding-top:10px;" >';
	for(i=0;i<data.interests.length;i++)
	{
		inte+='<div class="col-md-4" >
			<div class="interest" style="font-size:15px;border-bottom:1px solid rgba(0,0,0,0.1);" ><a href="#" class="text-error"><i class="fa fa-pencil" onclick="interestEditModal(this);"></i></a>'+data.interests[i]+'</div>';
	    inte+='</div>';
	}
 	inte+='</div>';
}

function interestsFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			interestsInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function achInsert(data)
{
	var ach="";
	ach+='<div class="row">';
	ach+='<div class="col-md-8" >';	
		ach+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-trophy"></i> Achievements</div>';
	ach+='</div>';
	ach+='<div class="col-md-2 col-md-offset-2 text-right">';	
		ach+='<a href="#" title="Add an Achievement" data-toggle="modal" data-target="#addAchievement"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
	ach+='</div>';
	ach+='</div>';	
							    
    ach+='<div class="row" style="padding-top:10px;" >';
    ach+='<div class="col-md-6" >';
    for(i=0;i<data.length;i+=2)
    {
		
		ach+='<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" >';
			ach+='<div class="row" >';
			    ach+='<div class="col-md-8" >';
			        
			        ach+='<p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small>'+data[i].competitionName+'</p>';
			        
			    ach+='</div>';
				ach+='<div class="col-md-4 text-right">';
					ach+='<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp;'+data[i].position+'</p>';
			        
				ach+='</div>';
				
			 ach+='</div>';
			 ach+='<div class="row" >';
			    ach+='<div class="col-md-6" >';
			        
			        ach+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].venue+'</em></p>';
			        
			    ach+='</div>';
				ach+='<div class="col-md-6 text-right" >';
			        
			        ach+='<p style="font-size:14px;" class="edittext">'+data[i].year+'';													
					ach+='</p>';
			        
			    ach+='</div>';
			 ach+='</div>';
			ach+='<div class="row" >';
			    ach+='<div class="col-md-12" >';
			        
			        ach+='<p style="font-size:14px;" class="edittext">'+data[i].description+'</p>';
			    ach+='</div>';
			 ach+='</div>';
		ach+='</div>';
		
    }
    ach+='</div>';
    ach+='<div class="col-md-6" >';
    for(i=1;i<data.length;i+=2)
    {
		
		ach+='<div class="achievement" style="border-bottom:1px solid rgba(0,0,0,0.1);" >';
			ach+='<div class="row" >';
			    ach+='<div class="col-md-8" >';
			        
			        ach+='<p style="font-size:19px;" class="edittext"><small><i class="fa fa-trophy"></i></small>'+data[i].competitionName+'</p>';
			        
			    ach+='</div>';
				ach+='<div class="col-md-4 text-right">';
					ach+='<p style="font-size:15px;" class="edittext"><small><a href="#" data-toggle="modal" data-target="#editAchievement"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></small>&nbsp;'+data[i].position+'</p>';
			        
				ach+='</div>';
				
			 ach+='</div>';
			 ach+='<div class="row" >';
			    ach+='<div class="col-md-6" >';
			        
			        ach+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].venue+'</em></p>';
			        
			    ach+='</div>';
				ach+='<div class="col-md-6 text-right" >';
			        
			        ach+='<p style="font-size:14px;" class="edittext">'+data[i].year+'';													
					ach+='</p>';
			        
			    ach+='</div>';
			 ach+='</div>';
			ach+='<div class="row" >';
			    ach+='<div class="col-md-12" >';
			        
			        ach+='<p style="font-size:14px;" class="edittext">'+data[i].description+'</p>';
			    ach+='</div>';
			 ach+='</div>';
		
		
    }
    ach+='</div>';
    ach+='</div>';
	
}

function achFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again. :(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			achInsert(data);
		}
	})
}
//----------------------------------------------------------------//
function certiInsert(data)
{
	var certi="";
	certi+='<div class="row">	';	
		certi+='<div class="col-md-8" >	';	
			certi+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-certificate"></i> Course Certifications</div>';
		certi+='</div>		';
	    certi+='<div class="col-md-2 col-md-offset-2 text-right">	';	
	    	certi+='<a href="#" title="Add a Course Certification" data-toggle="modal" data-target="#addCertificate"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
		certi+='</div>';
	certi+='</div> ';	
							    
   certi+='<div class="row" style="padding-top:10px;" >';
		certi+='<div class="col-md-6" >';
		for(i=0;i<data.length;i+=2)
		{
			certi+='<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" >'; 
				certi+='<div class="row" >';
				    certi+='<div class="col-md-10" >';
				        
				        certi+='<p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small>'+data[i].courseName+'</p>';
				        
				    certi+='</div>';
					
					certi+='<div class="col-md-2 text-right" >';
						certi+='<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>';
					certi+='</div>';
					
				 certi+='</div>';
				 certi+='<div class="row" >';
				    certi+='<div class="col-md-6" >';
				        
				        certi+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].instituteName+'</em></p>';
				        
				    certi+='</div>';
					certi+='<div class="col-md-6 text-right" >';
				        
				        certi+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    certi+='</div>';
				 certi+='</div>';
			certi+='</div>';
		}
		certi+='</div>';
		certi+='<div class="col-md-6" >';
		for(i=1;i<data.length;i+=2)
		{
			certi+='<div class="certification" style="border-bottom:1px solid rgba(0,0,0,0.1);" >'; 
				certi+='<div class="row" >';
				    certi+='<div class="col-md-10" >';
				        
				        certi+='<p style="font-size:19px;" class="edittext"><small><i class="fa fa-chevron-right"></i></small>'+data[i].courseName+'</p>';
				        
				    certi+='</div>';
					
					certi+='<div class="col-md-2 text-right" >';
						certi+='<a href="#" data-toggle="modal" data-target="#editCertification"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>';
					certi+='</div>';
					
				 certi+='</div>';
				 certi+='<div class="row" >';
				    certi+='<div class="col-md-6" >';
				        
				        certi+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].instituteName+'</em></p>';
				        
				    certi+='</div>';
					certi+='<div class="col-md-6 text-right" >';
				        
				        certi+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    certi+='</div>';
				 certi+='</div>';
			certi+='</div>';
		}
		certi+='</div>';
	certi+='</div>';
}

function certiFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			certiInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function wsaInsert(data)
{
	var ws="";
	ws+='<div class="row">	';	
		ws+='<div class="col-md-8" >';		
			ws+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-gears"></i> Workshops attended</div>';
		ws+='</div>		';
	    ws+='<div class="col-md-2 col-md-offset-2 text-right">	';	
	    	ws+='<a href="#" title="Add an school" data-toggle="modal" data-target="#addWorkshop"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
		ws+='</div>';
	                        		
	    	
	ws+='</div>   ';     		
							    
    ws+='<div class="row" style="padding-top:10px;" >';
		ws+='<div class="col-md-6" >';
		for(i=0;i<data.length;i+=2)
		{

			ws+='<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				ws+='<div class="row" >';
				   ws+=' <div class="col-md-10" >';
				        
				       ws+=' <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small>'+data[i].workshopName+'</p>';
				        
				    ws+='</div>';
					
					ws+='<div class="col-md-2 text-right" >';
						ws+='<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>';
					ws+='</div>';
					
				 ws+='</div>';
				 ws+='<div class="row" >';
				    ws+='<div class="col-md-6" >';
				        
				        ws+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].location+'</em><br /><span style="font-size:14px;" class="muted">'+data[i].peopleAttended+'</span></p>';
				        
				    ws+='</div>';
					ws+='<div class="col-md-6 text-right" >';
				        
				        ws+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    ws+='</div>';
				 ws+='</div>';
			  
			ws+='</div>';
		}	
		ws+='</div>';

		ws+='<div class="col-md-6" >';
		for(i=0;i<data.length;i+=2)
		{

			ws+='<div class="workshop" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				ws+='<div class="row" >';
				   ws+=' <div class="col-md-10" >';
				        
				       ws+=' <p style="font-size:19px;" class="edittext"><small><i class="fa fa-gear"></i></small>'+data[i].workshopName+'</p>';
				        
				    ws+='</div>';
					
					ws+='<div class="col-md-2 text-right" >';
						ws+='<a href="#" data-toggle="modal" data-target="#editWorkshop"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>';
					ws+='</div>';
					
				 ws+='</div>';
				 ws+='<div class="row" >';
				    ws+='<div class="col-md-6" >';
				        
				        ws+='<p style="font-size:15px;" class="edittext"><em>@'+data[i].location+'</em><br /><span style="font-size:14px;" class="muted">'+data[i].peopleAttended+'</span></p>';
				        
				    ws+='</div>';
					ws+='<div class="col-md-6 text-right" >';
				        
				        ws+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    ws+='</div>';
				 ws+='</div>';
			  
			ws+='</div>';
		}	
		ws+='</div>';
	ws+='</div>';
}

function wsaFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			wsaInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function acadInsert(data)
{
	var acad="";
	acad+='<div class="row">	';	
		acad+='<div class="col-md-10" >	';	
			acad+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-mortar-board"></i> Academics</div>';
		acad+='</div>		';
	    acad+='<div class="col-md-2 text-right">';		
	    	acad+='<a href="#" title="Add an school" data-toggle="modal" data-target="#addSchool"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
		acad+='</div>	';	
	                        		
	    	
	acad+='</div>    ';    		
							    
   	acad+='<div class="row" style="padding-top:10px;" >';
		acad+='<div class="col-md-6" >';
		for(i=0;i<data.length;i+=2)
		{
			acad+='<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				acad+='<div class="row" >';
				    acad+='<div class="col-md-9" >';
				        
				       acad+=' <p style="font-size:19px;" class="edittext">'+data[i].degree+'</p>';
				        
				    acad+='</div>';
					acad+='<div class="col-md-3 text-right">';
						acad+='<span style="font-size:16px;" class="badge">'+data[i].percentage+'</span>';
					acad+='</div>';
				 acad+='</div>';
				 acad+='<div class="row" >';
				    acad+='<div class="col-md-6" >';
				        
				        acad+='<p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ '+data[i].location+'</span></p>';
				        
				    acad+='</div>';
					acad+='<div class="col-md-6 text-right" >';
				        
				        acad+='<p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>';
				        
				    acad+='</div>';
				 acad+='</div>';
			  
			acad+='</div>';
		}
			
		acad+='</div>';

		acad+='<div class="col-md-6" >';
		for(i=1;i<data.length;i+=2)
		{
			acad+='<div class="school" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				acad+='<div class="row" >';
				    acad+='<div class="col-md-9" >';
				        
				       acad+=' <p style="font-size:19px;" class="edittext">'+data[i].degree+'</p>';
				        
				    acad+='</div>';
					acad+='<div class="col-md-3 text-right">';
						acad+='<span style="font-size:16px;" class="badge">'+data[i].percentage+'</span>';
					acad+='</div>';
				 acad+='</div>';
				 acad+='<div class="row" >';
				    acad+='<div class="col-md-6" >';
				        
				        acad+='<p style="font-size:15px;" class="edittext"><em>School/Institution Name</em><br /><span style="font-size:14px;" class="muted">@ '+data[i].location+'</span></p>';
				        
				    acad+='</div>';
					acad+='<div class="col-md-6 text-right" >';
				        
				        acad+='<p style="font-size:14px;" class="edittext">Duration<br /><a href="#" data-toggle="modal" data-target="#editSchool"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a></p>';
				        
				    acad+='</div>';
				 acad+='</div>';
			  
			acad+='</div>';
		}
			
		acad+='</div>';
	acad+='</div>';
}

function acadFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			acadInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function expInsert(data)
{
	var exp="";

	exp+='<div class="row">		';
		exp+='<div class="col-md-8" >	';	
			exp+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-fighter-jet"></i> Experience</div>';
		exp+='</div>		';
	    exp+='<div class="col-md-2 col-md-offset-2 text-right">	';	
	    	exp+='<a href="#" title="Add an Experience" data-toggle="modal" data-target="#addExperience"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
		exp+='</div>      ';    		
	    	
	exp+='</div>        	';	
							    
	exp+='<div class="row"  style="padding-top:10px;"  >';
	exp+='<div class="col-md-6" >';
	for(i=0;i<data.length;i+=2)
	{
			exp+='<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				exp+='<div class="row" >';
				    exp+='<div class="col-md-10" >';
				        
				        exp+='<p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small>'+data[i].company+'</p>';
				        
				    exp+='</div>';
					exp+='<div class="col-md-2 text-right" >';
						exp+='<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>';
					exp+='</div>';
				 exp+='</div>';
				 exp+='<div class="row" >';
				    exp+='<div class="col-md-6" >';
				        
				        exp+='<p style="font-size:16px;" class="edittext">'+data[i].position+'</p>';
				        
				    exp+='</div>';
					exp+='<div class="col-md-6 text-right" >';
				        
				        exp+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    exp+='</div>';
				 exp+='</div>';
			 
			  
			exp+='</div>';
		
	}
	exp+='</div>';

	exp+='<div class="col-md-6" >';
	for(i=1;i<data.length;i+=2)
	{
			exp+='<div class="experiences" style="border-bottom:1px solid rgba(0,0,0,0.1);" > ';
				exp+='<div class="row" >';
				    exp+='<div class="col-md-10" >';
				        
				        exp+='<p style="font-size:18px;" class="edittext"><small><i class="fa fa-suitcase"></i></small>'+data[i].company+'</p>';
				        
				    exp+='</div>';
					exp+='<div class="col-md-2 text-right" >';
						exp+='<a href="#" title="Edit Experience details" data-toggle="modal" data-target="#editExperience"  class="text-error" ><i class="fa fa-pencil" ></i> Edit</a>';
					exp+='</div>';
				 exp+='</div>';
				 exp+='<div class="row" >';
				    exp+='<div class="col-md-6" >';
				        
				        exp+='<p style="font-size:16px;" class="edittext">'+data[i].position+'</p>';
				        
				    exp+='</div>';
					exp+='<div class="col-md-6 text-right" >';
				        
				        exp+='<p style="font-size:14px;" class="edittext">'+data[i].duration+'</p>';
				        
				    exp+='</div>';
				 exp+='</div>';
			 
			  
			exp+='</div>';
		
	}
	exp+='</div>';
		
	exp+='</div> ';
}

function expFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			expInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function projInsert(data)
{
	var pro="";
	pro+='<div class="row">';	
		pro+='<div class="col-md-8" >';		
			pro+='<div style="font-size:25px;color:#004087;" ><i class="fa fa-database"></i> Projects</div>';
		pro+='</div>	';	
	    pro+='<div class="col-md-2 col-md-offset-2 text-right">';		
	    	pro+='<a href="#" title="Add a Project" data-toggle="modal" data-target="#addProject"  class="text-success" ><i class="fa fa-plus" ></i> Add</a>';
		pro+='</div>';
	                        		
	    	
	pro+='</div> ';       		
							    
   pro+='<div class="row" style="padding-top:10px;" >';
		pro+='<div class="col-md-6"  >';	
		for(i=0;i<data.length;i+=2)
		{
			pro+='<div class="project" >';
				pro+='<div class="row">';
					pro+='<div class="col-md-8 text-left" >';                
				        pro+='<div class="edittext" style="font-size:18px;" >'+data[i].title+'</div>';
				    pro+='</div>';
					pro+='<div class="col-md-4 muted text-right" >';
						
				        pro+='<em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp;'+data[i].duration+'</div></em>';
				    pro+='</div>';
				 pro+='</div>';
				 
				 pro+='<div class="row">';
					pro+='<div class="col-md-5" style="font-size:14x;color:#333;" >
						<div>'+data[i].position+'</div>';
				    pro+='</div>';
				    pro+='<div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
						@ <span>'+data[i].companyName+'</span>';
				    pro+='</div>';
				 pro+='</div>';
				 
				 pro+='<div class="row">';
				    pro+='<div class="col-md-12" >';
				        pro+='<p class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >'+data[i].description+'';
						pro+='</p>';
				    pro+='</div>';
				 pro+='</div>';
			pro+='</div>';
		}
		pro+='</div>';
		pro+='<div class="col-md-6"  >';	
		for(i=1;i<data.length;i+=2)
		{
			pro+='<div class="project" >';
				pro+='<div class="row">';
					pro+='<div class="col-md-8 text-left" >';                
				        pro+='<div class="edittext" style="font-size:18px;" >'+data[i].title+'</div>';
				    pro+='</div>';
					pro+='<div class="col-md-4 muted text-right" >';
						
				        pro+='<em><div class="edittext" style="font-size:12px;" ><a href="#" data-toggle="modal" data-target="#editProject"  class="text-error"  ><i class="fa fa-pencil" ></i> Edit</a>&nbsp;'+data[i].duration+'</div></em>';
				    pro+='</div>';
				 pro+='</div>';
				 
				 pro+='<div class="row">';
					pro+='<div class="col-md-5" style="font-size:14x;color:#333;" >
						<div>'+data[i].position+'</div>';
				    pro+='</div>';
				    pro+='<div class="col-md-7 text-right" style="font-size:14px;color:#8E9200;" >
						@ <span>'+data[i].companyName+'</span>';
				    pro+='</div>';
				 pro+='</div>';
				 
				 pro+='<div class="row">';
				    pro+='<div class="col-md-12" >';
				        pro+='<p class="edittext"  style="text-align:justify;font-size:13px;margin-left:15px;list-style-type:circle;" >'+data[i].description+'';
						pro+='</p>';
				    pro+='</div>';
				 pro+='</div>';
			pro+='</div>';
		}
		pro+='</div>';
	pro+='</div> ';
}
function projFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			projInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function toolInsert(data)
{
	
}

function toolFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			toolInsert(data);
		}
	});
}
//----------------------------------------------------------------//
function skillInsert(data)
{

}

function skillFetch()
{
	$.post('./handlers/aboutHandlers/aboutMe.php',{
		_mode:1
	})
	.error(function(){
		alert("Server overload error. Please try again.:(");
	})
	.success(function(data){
		if(checkData(data)==1)
		{
			skillInsert(data);
		}
	});
}
//----------------------------------------------------------------//