<?php
session_start();
	require('../QOB/qobConfig.php');

	if(!isset($_GET['ref']))
	{	
		echo '<script>alert("Invalid url. Redirecting to home page..");window.location.href="/4pi";</script>';
	}
	else
	{
		echo '<script>var ideaPostIdHash="'.$_GET['ref'].'";</script>';
	}
	require_once('ideaHeader.php');
?>


<script>

function fetchSingleIdea(){
	//console.log(ideaPostIdHash);
	y = $.post('/4pi/ideaBank/ideaHandlers/retrieveSingleIdea.php', {
                _ideaPostIdHash: ideaPostIdHash,
                //_files:files,
            })
	
	.error(function() {
                alert("Post Creation Failed" + y.status);
            })
           .success(function(data) {
                data = data.trim();
				//console.log(data);
                if (data == 12) {
                   alert("Sorry. We encountered an error in creating your post ");
                } else if (data == 13) {
                    alert("Do not fiddle with 4pi");
                } else if (data == 16) {
                    alert("Please check the post details you have entered");
                } else {
                    
                   var data1 = JSON.parse(data);
					insertIdea(data1);
					callAfterAjax();
				}
			}); 	
}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function insertIdea(data1)
{
					var res="";
					res+='<div class="row ideaPostSearchResult" style="width: 90%; border:1px solid #e6e6e6;padding:5%;">';
					res+='<div class="col-md-11" id=idea'+data1.ideaPostId+'>';
					
					res+='<div class="row  ideaHeadGrad" >';
	
					res+='<div class="col-md-9" id="ideaProfilePic">';
					
					data1.name = toTitleCase(data1.name);
					
					if( data1.name.length>14 )
					{
						result = data1.name.slice(0,13);
						var redundant = "...";
						result = result.concat(redundant);
					}
					else{
						result = data1.name;
					}
					if(data1.proPicExists == 1){
						res+='<a href="'+ genUrl + data1.userId +'" id="postOwnerURL" title='+data1.name+'><h4 id="ideaCreatedBy"><img title="' + data1.name + '"  src="/4pi/img/proPics/'+ data1.userIdHash +'.jpg" class="img-circle" width="40" height="40"  />'+'&nbsp;&nbsp;&nbsp;'+ result +'</h4></a>';
					}
					else{
						if(data1.gender=='M'){
							res+='<a href="'+ genUrl + data1.userId +'" id="postOwnerURL" title='+data1.name+'><h4 id="ideaCreatedBy"><img title="' + data1.name + '"  src="/4pi/img/defaultMan1.jpg" class="img-circle" width="40" height="40"  />'+'&nbsp;&nbsp;&nbsp;'+ result +'</h4></a>';
						}
						else{
							res+='<a href="'+ genUrl + data1.userId +'" id="postOwnerURL" title='+data1.name+'><h4 id="ideaCreatedBy"><img title="' + data1.name + '"  src="/4pi/img/defaultWomen1.jpg" class="img-circle" width="40" height="40"  />'+'&nbsp;&nbsp;&nbsp;'+ result +'</h4></a>';
						}
					}
					res+='</div> <!-- end class col-md-8 id ideaProfile Pic --> ';
										
					
					
					if(data1.postOwner == 1)
					{
						res+='<div class="col-md-1 ">';
						res+='<h5 id="ideaOptions" ><i class="fa fa-pencil faColor"  data-toggle="modal"  onclick="editIdea(this);" title="Edit Idea"> </i>&nbsp;&nbsp;</h5>';
						res+='</div><!-- End of col-md-1 -->';
					}
					
					if(data1.postOwner == 1)
					{
						res+='<div class="col-md-1 trashRight" id="deleteIdea">';
						res+='<h5  id="ideaDelete"><i style="padding-top: 3px !important" id="trashId'+data1.ideaPostId+'" class="fa fa-trash faColor" onClick="deleteIdea(\'' + data1.ideaPostId + '\');"   title="Delete Idea"> </i>&nbsp;&nbsp;</h5>';
						res+='</div> <!-- end class col-md-1 -->';
					}
										
					res+='</div> <!-- end class ROW tag-->';

					
					
					res+='<div id="postSubjectText" style="background-color: white; font-size:18px; padding: 3%;">'+data1.ideaDescription+'</div>';
					
					res+='<div class="row" style="background-color: white" id="ideaIcons" >';
				
					res+='<div class="col-md-1 col-md-offset-8 ideaStarBox" >';
					
					if (data1.hasAppreciated == 1) {
						res+='<a><img src="http://localhost/4pi/ideaBank/images/app.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" title="Appreciate" /></a><span class="ideaStarCount">'+data1.appreciateCount+'</span></div>';
					}else{
						if(data1.hasDepreciated ==1)
						{
									res+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" onClick="starClick('+data1.ideaPostId+');" title="Appreciate" /></a><span class="ideaStarCount">'+data1.appreciateCount+'</span></div>';
						}
						else{
						res+='<a class="" id="deactiveapp'+data1.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" onClick="starClick('+data1.ideaPostId+');" title="Appreciate" /></a><span class="ideaStarCount">'+data1.appreciateCount+'</span></div>';
						}
					}
					
					res+='<div class="col-md-1 col-md-offset-9 ideaStarBox" >';
					
					if (data1.hasDepreciated == 1) {
						res+='<a><img src="http://localhost/4pi/ideaBank/images/dep.SVG" height="26" class="ideaDepreciateIcon" id="depreciate'+data1.ideaPostId+'" title="Depreciate" /></a><span id="ideaUnStarCount">'+data1.depreciateCount+'</span></div>';
					}
					else{
						if(data1.hasAppreciated == 1)
						{
							res+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data1.ideaPostId+'" onClick="stopClick('+data1.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+data1.depreciateCount+'</span></div>';
						}
						else{
						res+='<a class="" id="deactivedep'+data1.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data1.ideaPostId+'" onClick="stopClick('+data1.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+data1.depreciateCount+'</span></div>';
						}
					}
					
					res+='<div class="col-md-2 ideaDateBoxsi text-center" style="padding-top: 3px;" >';
					
					res+='<em><time class="timeago" style="font-size:12px;" >'+data1.ideaPostDate+'</time></em></div>';
					//res+='<div class="col-md-1 col-md-offset-11">clear</div>';										
					res+='</div><!-- End of ROW tag id-ideaIcons -->';
					
					res+='</div>';
					res+='</div>';
					
					$('#ideaFinal').html(res);
					
}


$(document).ready(function(){
	fetchSingleIdea();
	
});


</script>


<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
    	<div class="col-md-1" >
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              	<div id="brand" class="text-center"> 
					<a href="../index.php"><img src="./images/fourpi.png" width="40px" height="auto" style="padding-top:7px;"/></a>
				</div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4">
        <a href="index.php"><img src="images/logo1.png" height="42px;" style="padding-top: 3px;"></a>
        </div>
		<div class="col-md-3 ">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="ideaSearch">
              <form class="navbar-form navbar-left floatRight" role="search" >
                <div class="form-group">
                  <input id="ideaSearchBefore" autocomplete="off" type="text" onkeyup="fetchIdeaSearchResults();" class="form-control searchExpand" placeholder="Search">
                </div>
              </form>
			  
			  <div id="ideaSearchResults1" style="background-color:white;">

				<div id="ideaPeopleSearch">

				<h4 class="text-center searchback">People</h4><br/>

				<div style="margin-top: -20px !important;" class="text-center" id="ideaPeopleSearchEmptyMessage"></div>

				</div>

				<div id="ideaPostsSearch">

				<h4 class="text-center searchback">Ideas</h4><br/>

				<div style="margin-top: -20px !important;" class="text-center" id="ideaPostsSearchEmptyMessage"></div>

				</div>
			  </div><!-- Idea Search Results1 -->
			  
            </div><!-- /.navbar-collapse -->
			
        </div>
	</div>
  </div><!-- /.container-fluid -->
</nav>


<div class="row classRowBody"  id="rowIdeaBody">
	
    <div class="col-md-1 ">
    <div class="fixedElement1" >
	
    <img src="images/logo2.png" /></div>
    </div>
	<div id="final1"></div>
	<div class="col-md-9" >
	
	<div id="ideaFinal">
	
	</div>
	
	</div>
	
	
	<div class="col-md-2 col-md-offset-10 fixedElement text-center" style="color:grey;">
	<div class="fading hidden" id="oneplus">
        <div class="text-animated-one">+1</div>    
    </div>
	<i class="fa fa-university " style="font-size: 180px; padding-bottom: 5px; " ></i>
	<div class="odometer" id="odometer" style="font-size: 20px;">0</div>
	</div>
                <!-- Edit post modal  -->
						<div class="modal fade" id="editIdeaModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="editIdeaModal" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;<strong></span><span class="sr-only">Close</span></strong></button>
						        <h4 class="modal-title" id="editIdea"><i class="fa fa-pencil"></i> &nbsp;Edit Idea</h4>
						      </div>
							  <div id="editIdeaPostId" class="hidden"></div>
						      <div class="modal-body">
                                   <form role="form">
                                      <div class="form-group">
                                        <label for="ideaContent">Description</label>
                                        <textarea type="text" name="ideaContent" id="editIdeaContent" style="background-color:white;border-radius:0px;" class="form-control" ></textarea>
                                      </div>
								  <input class="hidden" id="postId" name="postId">
								</form><br />
								<button onclick="editedPostSend();" id="editIdeaButton" class="btn btn-primary">Update Idea</button>
						      </div>
						    </div>
						  </div>
						</div>
				<!-- Edit post modal -->
				
</div><!--End of ROW tag -->
	
</body>
	
<?php
	include_once("../footer.php");
?>
<script>
	var ob;
 
	$('#icons div i').css({'cursor':'pointer'});
	
$('.searchExpand').focusin(function(){
	$(this).animate({'width':'160%'},500);
}); 
$('.searchExpand').focusout(function(){
	$(this).animate({'width':'100%'},500);
	}); 

function callAfterAjax(){

 var y = $.post('/4pi/ideaBank/ideaHandlers/ideaPostNumber.php')

          .error(function() {
                alert("Post Creation Failed" + y.status);
            })
           .success(function(data) {
                data = data.trim();
				data = Number(data);
				//alert(typeof(data));
	setTimeout(function(){
    	odometer.innerHTML = data;
	}, 100, data);
	
	}); 
	
	var temp = Math.floor(Math.random()*13);
	var array1 = ["colorgrad1", "colorgrad2", "colorgrad3", "colorgrad4", "colorgrad5", "colorgrad6", "colorgrad7", "colorgrad8", "colorgrad9", "colorgrad10","colorgrad11", "colorgrad12"];

	$('.col-md-11').find('.ideaHeadGrad').addClass(array1[temp]);
			
		
	var myArray = ["200px","210px","220px","230px","240px","250px","260px","270px","280px","290px", "300px","310px","320px","330px","340px","350px","360px","370px","380px","390px","400px"];

}

	$('textarea').autosize();


function editIdea(ele){
	$('#editIdeaModal').modal('show');
	var x=$(ele).parent().parent().parent().parent();
	//console.log(x);
	 var y =$(ele).parent().parent().parent().parent().attr("id");
    //alert(y);
    $('#editIdeaPostId').html(y);
	var content=x.find("#postSubjectText").html();
	
	//var tags=x.find('#editIdeaTags').html();
	
	$('#editIdeaModal').find('#editIdeaContent').val(content);
	//$('#editIdeaModal').find('#editIdeaTags').val(tags);
}

$(window).scroll(function(e){ 
  $el = $('.fixedElement'); 
  if ($(this).scrollTop() > 200 && $el.css('position') != 'fixed'){ 
    $('.fixedElement').css({'position': 'fixed', 'top': '80px'}); 
  }
  if ($(this).scrollTop() < 200 && $el.css('position') == 'fixed')
  {
    $('.fixedElement').css({ 'top': '80px','right':'0px;'}); 
  } 
});

$(window).scroll(function(e){ 
  $el = $('.fixedElement1'); 
  if ($(this).scrollTop() > 200 && $el.css('position') != 'fixed'){ 
    $('.fixedElement1').css({'position': 'fixed', 'top': '80px'}); 
  }
  if ($(this).scrollTop() < 200 && $el.css('position') == 'fixed')
  {
    $('.fixedElement1').css({ 'top': '80px','left':'0px;'}); 
  } 
});

var genUrl = "/4pi/";


function deleteIdea(id){
	if (confirm("Do you really want to delete your Idea ??") == true) {
	 //$('#'+id).remove();
	// console.log("Deleted");
	$('#trashId'+id).removeClass("fa-trash");
	$('#trashId'+id).html(".....");
	$('.ideaPostSearchResult').addClass("hidden");
	//$('#ideaContent'+id).fadeIn(3000).html("<h4>Your Idea is getting deleted. Please wait !!! ");
	 $.post('/4pi/ideaBank/ideaHandlers/deleteIdeaPost.php',{
		_ideaPostId : id
	 })
	
	 .error(function() {
			//console.log('Error');
        })
        .success(function(data) {
			
            data = data.trim();
			//console.log(data);
            if (data == 13) {
                alert("Don't mess with 4pi");
                window.location.href = "4pi/index.php";
            } else if (data == 12) {
                alert("Database error. Admin has been notified");
            } else if (data == 14) {
                alert("You have been blocked for messing with 4pi");
                window.location.href = "4pi/index.php";
            } else if (data == 3) {
				//$('#'+id).addClass("hidden");
				//alert("Succes");
              /*  $('#final').find('#' + id).css({
                    "border": "none"
                });
                $('#final').find('#' + id).html("");
				var temp; */
				for(i=0; i<ob.length; i++)
				{
					if(id == ob[i].ideaPostId)
					{
						break;
					}
				}
				
				if(i> -1)
				{
					//alert(i);
					ob.splice(i, 1);
				}
				
				$('.condense').each(function() {
						$(this).remove();
						$(this).css({
									'border': 'none'
							});
						});				
				for (i = 0; i < ob.length; i++) {
					//alert(ob.indexOf(i));
					postInsert('last', ob[i] , i);
				}	
                callAfterAjax();  
            }
        }); 
	}
}


function editedPostSend() {
	$('#editIdeaButton').html('Updating Idea ...');
    var postId = $('#editIdeaModal').find('#editIdeaPostId').html();
	//console.log(String(postId));
    //var postSubject = $('#editPostSubject').val();
    var postContent = $('#editIdeaModal').find('#editIdeaContent').val();
	//console.log(postContent);
    if (postContent.length == 0) {
        alert("Post content is to be filled");
    } else {
        var y = $.post('/4pi/ideaBank/ideaHandlers/editIdeaPost.php', {
                //_subject: postSubject,
                _ideaDescription : postContent,
                /*_files:files,*/
                //_share: sharedWith,
                //_validity: postValidity,
                _ideaPostId: postId
            })
            .error(function() {
                alert("Post edit Failed");
            })
            .success(
                function(data) {
					data = data.trim();
					//console.log(data);
                    $('#editIdeaModal').modal('hide');
                    if (checkData(data) == 1) {
                        modifyPost(postId, data);
                    }
                }
            );
    }
}

function modifyPost(id, data) {
    data = jQuery.parseJSON(data);
    var e = $('#' + id);
    e.find('#ideaContent'+id).html(data.ideaDescription);
}

/***********************  appreciateIdeaPost *****************************/
function starClick(id) {
	var imagePath = $('#appreciate'+id+'').attr("src");
	$('#deactivedep'+id).addClass("deactive");
	if(imagePath == "http://localhost/4pi/ideaBank/images/app.SVG"){
		$('#appreciate'+id+'').attr("src", "http://localhost/4pi/ideaBank/images/app1.SVG");
	}
    $('#' + id).find('#appreciate'+id+'').attr("onclick", "");
	var count = $('#' + id).find('.ideaStarCount').html();
	var val = parseInt(count);
	val = val+1;
	count = val.toString();
	$('#' + id).find('.ideaStarCount').html(' '+count);
	
	//$('#search' + id).find('#appreciate'+id+'').attr("onclick", "");
	//$('#search' + id).find('.ideaStarCount').html(' '+count);
	
    $.post('/4pi/ideaBank/ideaHandlers/appreciatePost.php', {
        _ideaPostId: id
    })
        .error(function() {

            alert("Server overload. Please try later");

        })
        .success(function(data) {
			
        });


}

/************ DEPRECIATE POST ******************/
function stopClick(id) {
	var imagePath = $('#depreciate'+id+'').attr("src");
	$('#deactiveapp'+id).addClass('deactive');
	if(imagePath == "http://localhost/4pi/ideaBank/images/dep.SVG"){
		$('#appreciate'+id+'').attr("src", "http://localhost/4pi/ideaBank/images/dep1.SVG");
	}
    $('#' + id).find('#depreciate'+id+'').attr("onclick", "");
	var count = $('#' + id).find('#ideaUnStarCount').html();
	var val = parseInt(count);
	val = val+1;
	count = val.toString();
	$('#' + id).find('#ideaUnStarCount').html(' '+count);
    $.post('/4pi/ideaBank/ideaHandlers/depreciatePost.php', {
        _ideaPostId: id
    })
        .error(function() {

            alert("Server overload. Please try later");

        })
        .success(function(data) {
			/*data = data.trim();
			//var x = JSON.parse(data);
			//console.log(data);
            if (checkData(data) == 1) {
                $('#' + id).find('#ideaUnStarCount').html(' '+data);
            } */
        });


}

/************************ Idea Search Posts *************************/

	function insertPeopleSearch(data,val)
	{
		if(val==0)
		{
			var res="";
			res+='<div class="row ideaPeopleSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
			res+='<div class="col-md-11" id="userName">';
			if(data.gender=="M")
			{
			res+='<span><a href="/4pi/'+data.userId+'"><img class="img-circle" src="/4pi/img/defaultMan1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			else
			{
			res+='<span><a href="/4pi/'+data.userId+'"><img class="img-circle" src="/4pi/img/defaultWoman1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			res+='</div>';
			res+='</div>';
			$('#ideaPeopleSearch').append(res);
		}
		else if(val==1)
		{
			var res="";
			res+='<div class="row ideaPeopleSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
			res+='<div class="col-md-11" id="userName">';
			res+='<span><a href="/4pi/'+data.userId+'"><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			
			res+='</div>';
			res+='</div>';
			$('#ideaPeopleSearch').append(res);
		}
	}
	function checkIfPeopleImageExists(data)
	{
		var url="/4pi/img/proPics/"+data.userIdHash+".jpg";
		$.post(url,{})
		.error(function(){
			insertPeopleSearch(data,0);
		})
		.success(function(){
			insertPeopleSearch(data,0);
		});
	}
	function globalSearchInsertPeople(data)
	{
		//console.log(data);
		checkIfPeopleImageExists(data);
	}
	function globalSearchInsertPosts(data)
	{
		var res="";
		res+='<div class="row ideaPostSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
		res+='<div class="col-md-11" id="search'+data.ideaPostId+'">';
		
		res+='<span><a href="/4pi/ideaBank/singleIdea.php?ref='+data.ideaPostIdHash+'" title="'+data.ideaDescription+'" ><img src="/4pi/img/logo2.PNG" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.ideaContent+'</span></a></span>';
		
		res+='</div>';
		res+='</div>';
		$('#ideaPostsSearch').append(res);
	}
	
	function fetchIdeaSearchResults()
	{
		var input=$('#ideaSearchBefore').val().trim();
		$.post('/4pi/ideaBank/ideaBankSearch.php',{
			_inputVal:input
		})
		.error(function(){
			alert("Server overload. Please try again");
		})
		.success(function(data){
			data = data.trim();
			//console.log(data);
			data=JSON.parse(data);
			$('.ideaPeopleSearchResult').each(function(){
				$(this).remove();
			});
			$('.ideaPostSearchResult').each(function(){
				$(this).remove();
			});
			if(data[0].length==0)
			{
				$('#ideaPeopleSearchEmptyMessage').html("<h4>No people found</h4>");
			}
			else
			{
			//console.log(data);
				$('#ideaPeopleSearchEmptyMessage').html("");
				for(i=0;i<data[0].length;i++)
				{
					globalSearchInsertPeople(data[0][i]);
				}	
			}
			if(data[1].length==0)
			{
				$("#ideaPostsSearchEmptyMessage").html("<h4>No posts found</h4>");
			}
			else
			{
				for(i=0;i<data[1].length;i++)
				{
					globalSearchInsertPosts(data[1][i]);
				}
			} 
		});
	}

	$(window).scroll(function() {
	if ($(this).scrollTop() > 0){  
	    $('#ideaSearchBefore').addClass("sticky");
	    // $('#topBarNew').addClass("sticky");
	  }
	  else{
	    $('#ideaSearchBefore').removeClass("sticky");
	    // $('#topBarNew').removeClass("sticky");
	  }
		
	
	});
	//$('#topBarNew').hide();
	$('#ideaSearchBefore').focusin(function(){
	$(this).css({'background-color':'#fff !important','color':'#000'});
	//$(this).animate({'width':'160%'},500);
	});
	$('#ideaSearchBefore').focusout(function(){
	$(this).css({'background-color':'#484848 !important','color':'white','border':'1px solid #484848'});
	//$(this).animate({'width':'100%'},500);
	});
	$('#ideaSearchResults1').hide();
	$('#ideaSearch').focusin(function(){
		$('#ideaSearchResults1').slideDown(500);
	});
	$('#ideaSearch').focusout(function(){
		$('#ideaSearchResults1').slideUp(500);
	});


/* ------------------------------------------------------------ */

function checkData(data) {
    data = data.trim();
    if (data == 12) {
        alert("Could not save your action into the database");
        return -1;
    } else if (data == 13) {
        alert("You don't mess with 4pi");
        window.location.href = "/4pi/index.php";
        return -1;
    } else if (data == 14) {
        alert("You have been blocked for messing with 4pi. Contact Admin @4pi");
        window.location.href = "/4pi/index.php";
        return -1;
    } else if (data == 16) {
        alert("Invalid Input");
        return -1;
    } 
    else {
        return 1;
    }
}

</script>

