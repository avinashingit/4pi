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
	top+='<a href="index.php"  class="btn btn-primary" >Find My Resume <i class="fa fa-external-link"></i></a>';

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

