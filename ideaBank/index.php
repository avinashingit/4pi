 <?php
session_start();
// $_SESSION['vj']='0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22';
	//require_once('/handlers/ideahandlers/createIdeapost.php');
	require_once('../QOB/qob.php');
	//require_once('/handlers/fetch.php');
 ?>
<!DOCTYPE html>
<html >
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Hemanth" />

	<title>Idea Bank</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/BS/bootstrap.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/custom.css" />
    <!-- Animate css 
    <link rel="stylesheet" type="text/css" href="css/TP/animate.css" />-->
	<!-- Font awesome --->
    <link rel="stylesheet" type="text/css" href="../css/FA/css/font-awesome.min.css"/>
    <!-- Hexagon honeycomb CSS -->
    <!--<link rel="stylesheet" type="text/css" href="./css/homeycombs.css" /> -->
    
    <link rel="stylesheet" href="css/odometer-theme-car.css" />
    
    <!-- Roboto font 
    <link href='http://fonts.googleapis.com/css?family=Roboto:300&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'> -->
    <!-- jquery js -->
    <script src="../js/Jquery/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap javascript -->
    <script src="../js/BS/bootstrap.min.js" type="text/javascript"></script>
    
     <!-- Autosize Text Area -->
     <script src="../js/TP/jquery.autosize.js" type="text/javascript"></script>
     <!--360 degrees rotate plugin -->
     <!--<script type="text/javascript" src="js/cs/jquery.threesixty.js"></script>  -->
	
     <script src="js/odometer.js"></script>


</head>

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
					<a href="index.php"><img src="./images/fourpi.png" width="40px" height="auto" style="padding-top:7px;"/></a>
				</div>
            </div>
        </div>
        <div class="col-md-4 " >
        	<div class="btn-group " >        
            	<div class="btn-group">
                	<button type="button" id="ideaButton" class="btn btn-success" data-toggle="modal" data-target="#idea"><a href="#" style="color:white;" ><i class="fa fa-plus" id="plusId"></i>&nbsp;<span id="postingIdea">Post New Idea</span></a></button>
                </div>
             </div><!--End of btn-group -->
        </div><!--End of col-md-4 -->
        <div class="col-md-4">
        <img src="images/logo1.png" height="42px;" style="padding-top: 3px;">
        </div>
		<div class="col-md-3">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="ideaSearch">
              <form class="navbar-form navbar-left floatRight" role="search" >
                <div class="form-group">
                  <input id="ideaSearchBefore" type="text" onkeyup="fetchIdeaSearchResults();" class="form-control searchExpand" placeholder="Search">
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
	<div class="col-md-9"  id="final">
	
	<div class="col-md-4"  id="fc">
	
	</div>
	
	<div class="col-md-4" id="sc">
	<!--<div style="postion: absolute !important;bottom: 0px !important" id="finalbottom"></div> -->
	</div>
	
	<div class="col-md-4"  id="tc">
	
	</div>
	
	</div>
	
	
	<div class="col-md-2 col-md-offset-10 fixedElement text-center" style="color:grey;">
	<div class="fading hidden" id="oneplus">
        <div class="text-animated-one">+1</div>    
    </div>
	<i class="fa fa-university " style="font-size: 180px; padding-bottom: 5px; " ></i>
	<div class="odometer" id="odometer" style="font-size: 20px;">0</div>
	</div>


                         <!--create post modal -->   
                            <div class="modal fade" id="idea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                              
                                <div class="modal-content">
                                
                                  <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> &nbsp;Create New Idea&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Maximum size of the post can be 3MB. Post content can contain upto 8000 characters."></i>]</h4>
                                  </div>
                                  
                                  <div class="modal-body">
                                   <form role="form">
                                      <div class="form-group">
                                        <label for="ideaContent">Description</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post description is compulsory."></i>]
                                        <textarea type="text" name="ideaContent" id="createIdeaContent" style="background-color:white;border-radius:0px;resize:none;" class="form-control" ></textarea>
                                      </div>
                                    </form><br />
                                    
                                  </div>
                                  
                                  <div class="modal-footer">
									<button onclick="createIdeaPost();" class="btn btn-primary">Post Idea</button>
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                            </div>
                        <!--End of create post modal -->
                        
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
				
				
				<!-- Search Idea modal -->
			<div class="modal fade" id="searchIdeaModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="searchIdeaModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;<strong></span><span class="sr-only">Close</span></strong></button>
						        <h4 class="modal-title" id="searchIdeaHead"></h4>
						</div>
						<div id="searchIdeaPostId" class="hidden"></div>
						<div class="modal-body">
                            <div  id="searchIdeaContent" style="background-color:white; border-radius:0px;" ></div>
                        </div> 
						<input class="hidden" id="searchPostId" name="searchPostId">
						<div class="modal-footer">
							<button style="float: right" data-dismiss="modal" class="btn btn-danger">Close</button>
						</div>
					</div>
				</div>
			</div>
				 <!--Search Idea modal -->
				
</div><!--End of ROW tag -->
<span id="noIdeas"></span>
<?php
	include_once("../footer.php");
?>
</body>
</html>


<script>
	
	var ob;
	
	//$('.form-control').css({'border-radius':'0px !important'}); 
	$('#icons div i').css({'cursor':'pointer'});
	//$("#brainimg").threesixty({images:["side.png","front.png","front1.png","side1.png"], method:'click', direction:'forward', sensibility: 1}); 
	 $('#topBarNew').hide();
$('.searchExpand').focusin(function(){
//	$(this).css({'background-color':'#fff','color':'#000'});
	$(this).animate({'width':'160%'},500);


}); 
$('.searchExpand').focusout(function(){
//	$(this).css({'background-color':'#484848','color':'white','border':'1px solid #484848'});
	$(this).animate({'width':'100%'},500);
	}); 

function callAfterAjax(){

 var y = $.post('http://localhost/4pi/ideaBank/ideaHandlers/ideaPostNumber.php')

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
	
	var firstCol = $('#fc').children();
	var secondCol = $('#sc').children();
	var thirdCol = $('#tc').children();
	
	var counter = firstCol.length + secondCol.length + thirdCol.length;
	var iteration = 0;
	var prevTemp1 = -1, prevTemp2 = -1, prevTemp3 = -1;
	while(counter>0)
		{

			temp1= 	Math.floor(Math.random()*12);
			while(temp1==prevTemp1 || temp1 == prevTemp2 || temp1 == prevTemp3)
				{
					temp1= 	Math.floor(Math.random()*12);
				}
			
			
			$(firstCol[iteration]).find('.ideaHeadGrad').addClass(array1[temp1]);
			prevTemp1 = temp1;
			
			temp2= 	Math.floor(Math.random()*12);
			while(temp2==temp1 || temp2==prevTemp2 || temp2 == prevTemp1 || temp2 == prevTemp3)
				{
					temp2= 	Math.floor(Math.random()*12);
				}
			$(secondCol[iteration]).find('.ideaHeadGrad').addClass(array1[temp2]);
			prevTemp2=temp2;
			
			
			temp3= 	Math.floor(Math.random()*12);
			while(temp3==temp1 || temp3==temp2 || temp3==prevTemp3 || temp3 == prevTemp1 || temp3 == prevTemp2)
				{
					temp3= 	Math.floor(Math.random()*12);
				}
			$(thirdCol[iteration]).find('.ideaHeadGrad').addClass(array1[temp3]);
			prevTemp3=temp3;
			
			iteration++;
			
			counter = counter-1;
		}
		
	var myArray = ["200px","210px","220px","230px","240px","250px","260px","270px","280px","290px", "300px","310px","320px","330px","340px","350px","360px","370px","380px","390px","400px"];
$('.condense').each(function(){
	var tempVal = Math.floor(Math.random()*21);
	$(this).css({'max-height':myArray[tempVal]});
});

}

	$('textarea').autosize();


function editIdea(ele){
	$('#editIdeaModal').modal('show');
	var x=$(ele).parent().parent().parent().parent();
	//console.log(x);
	 var y =$(ele).parent().parent().parent().parent().attr("id");
    //alert(y);
    $('#editIdeaPostId').html(y);
	var content=x.find("#ideaBody").find("div").find("p").html();
	
	//var tags=x.find('#editIdeaTags').html();
	
	$('#editIdeaModal').find('#editIdeaContent').val(content);
	//$('#editIdeaModal').find('#editIdeaTags').val(tags);
}

function searchIdea(id){
	$('#searchIdeaModal').modal('show');
	$('#searchIdeaModal').find('#searchIdeaContent').fadeIn(3000).html("<center><strong>Content is loading !!!</strong></center>");
	var ideaPostId = id.substring(7,9);
	console.log(ideaPostId);
	//var content=$(id).find("span").find("a").attr("title");
	//console.log(content);
	y = $.post('http://localhost/4pi/ideaBank/ideaHandlers/retrieveSingleIdea.php', {
                _ideaPostId: ideaPostId,
                //_files:files,
            })
	
	.error(function() {
                alert("Post Creation Failed" + y.status);
            })
           .success(function(data) {
                data = data.trim();
				console.log(data);
                if (data == 12) {
                   alert("Sorry. We encountered an error in creating your post ");
                } else if (data == 13) {
                    alert("Do not fiddle with 4pi");
                } else if (data == 16) {
                    alert("Please check the post details you have entered");
                } else {
                    //$('#idea').modal('hide');
                    //console.log(data);
                   var data1 = JSON.parse(data);
                    //console.log(data);
                    //postInsert("first", x,0);
					//ob.unshift(x);
					//console.log(ob);
					//$('.condense').each(function() {
						//$(this).remove();
						//$(this).css({
							//		'border': 'none'
							//});
						//});					
					//for (i = 0; i < ob.length; i++) {
					//	postInsert('last', ob[i] , i);
					//}
					content = searchIdeaInsertModal(data1);
					console.log(content);
					$('#searchIdeaModal').find('#searchIdeaContent').html(content);
				}
			}); 	
					
	//$('#searchIdeaModal').find('#searchIdeaContent').html(content);
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

/*************** CREATE POST ************************/

function createIdeaPost() {
	
	$('#oneplus').removeClass("hidden");
	$('#plusId').addClass("fa-spin");
	$('#postingIdea').html("Posting New Idea....");
    var ideaContent = $('#createIdeaContent').val();
        if (ideaContent.length == 0) {
            alert("Post content is to be filled");
        } 
		else {
            $('#idea').find('#createIdeaContent').val("");
            $('.navbar .navbar-inverse').find('#ideaButton').attr("data-target", "").find('a span').html("Posting New Idea...");
            $('.navbar .navbar-inverse').find('#ideaButton').find('.fa-plus').addClass('fa-spin');
            $('#idea').modal('hide');

            var y = $.post('http://localhost/4pi/ideaBank/ideaHandlers/createIdeaPost.php', {
                _ideaContent: ideaContent,
                //_files:files,
            })

          .error(function() {
                alert("Idea Creation Failed" + y.status);
            })
           .success(function(data) {
                data = data.trim();
				//console.log(data);
                $('.navbar .navbar-inverse').find('#ideaButton').attr("data-target", "").find('a span').html("Post New Idea");
                $('.navbar .navbar-inverse').find('#ideaButton').find('.fa-plus').removeClass('fa-spin');
                if (data == 12) {
                   alert("Sorry. We encountered an error in creating your post ");
                } else if (data == 13) {
                    alert("Do not fiddle with 4pi");
                } else if (data == 16) {
                    alert("Please check the post details you have entered");
                } else {
                    $('#idea').modal('hide');
                    //console.log(data);
                   var x = JSON.parse(data);
                    //console.log(data);
                    //postInsert("first", x,0);
					ob.unshift(x);
					//console.log(ob);
					$('.condense').each(function() {
						$(this).remove();
						$(this).css({
									'border': 'none'
							});
						});					
					for (i = 0; i < ob.length; i++) {
						postInsert('last', ob[i] , i);
					}
					
                    callAfterAjax(); 
					$('#oneplus').addClass("hidden");
					$('#plusId').removeClass("fa-spin");
					$('#postingIdea').html("Post New Idea");
                }
            }); 
		}

}
//************************ Fetch More Posts **********************
function fetchMoreIdeaPosts(e)
{
	console.log($('#loadMoreIdeaPostsButton').find('button').html());
	$('#loadButton').html("Loading...").attr("onclick","");
	console.log($('#loadMoreIdeaPostsButton').find('button').html());
	e.preventDefault();
    retrieveLatestPosts("noempty",1);
    $('#loadButton').html("Loading...").attr("onclick","fetchMorePosts(event)");
	console.log($('#loadMoreIdeaPostsButton').find('button').html());
}



//************************* Retrieve Idea Posts ********************

$(document).ready(function(){
	retrieveLatestPosts('empty',-1);	
});


function retrieveLatestPosts(value, call) {
	if(call == -1){
		$('#final1').fadeOut(2000).html("<h3 class='spanLoadAfter'>Please wait !!!! posts are loading....</h3>");
	}
	
	var posts=[0];
    if(call==1)
    {
		
        var i=0;
        $('.ideaContentSide').each(function(){
            posts[i]=$(this).attr("id");
			//console.log(String(posts[i]));
            i++;
        });
		//alert(posts.length);
		//console.log($('#final').children());
    }
	
    $.post('http://localhost/4pi/ideaBank/ideaHandlers/retrieveIdeaPost.php', {
		_ideaPosts: posts,
        _postOffset: 6,
        _call: call,
        dataType: "json",
        contentType: 'application/json'
    })
    .error(function() {

    })
    .success(function(data) {

		data = data.trim();
        if (value == "empty") {
        //alert(value);
			$('.condense').each(function() {
				$(this).remove();

				$(this).css({
                    'border': 'none'
				});
			});
        }
		if (data != 404) {
                $('#loadMoreIdeaPostsButton').remove();
                ob = JSON.parse(data);
                for (i = 0; i < ob.length; i++) {
                    postInsert('last', ob[i] , i, ob.length);
					
                }

                callAfterAjax();
				
            } 
			else if(data == 11){
				alert("Please login to continue");
                window.location.href = "/4pi/index.php";
			}
			else if (data == 404) {
				$('#loadButton').remove();
				//$('#loadMoreIdeaPostsButton').removeClass("spanLoadBefore");
				//$('#loadMoreIdeaPostsButton').addClass("spanLoadAfter");
				//$('#loadMoreIdeaPostsButton').html("That's all folks for today !!!");
				$('#noIdeas').addClass("spanLoadAfter");
				$('#noIdeas').html("That's all folks for today !!!");
				console.log(data);
                //$('#postArea').find('#postEmptyMessage').html("Sorry! No more posts to display.");
            }
			
        }); 

}


var genUrl = "http://localhost/4pi/";
function postInsert(position, data1, num, len) {
	var res;
	var idCol;
	var post="";

	if((num%3) == 0)
	{
		idCol = 'fc';
	}
	else if((num%3) == 1)
	{
		idCol = 'sc';
	}
	else if((num%3) == 2)
	{
		idCol ='tc';
	}
	//post+='<div class="col-md-4 " id="'+idCol+'" >';
				
	post+='<div class="condense ideaContentSide" id="'+data1.ideaPostId+'">';
    
	post+='<div class="row  ideaHeadGrad" >';
	
	post+='<div class="col-md-8" id="ideaProfilePic">';
	
	data1.name = data1.name.toLowerCase();
	
	if( data1.name.length>14 )
	{
		res = data1.name.slice(0,13);
		var redundant = "...";
		res = res.concat(redundant);
	}
	else{
		res = data1.name;
	}

	post+='<a href="'+ genUrl + data1.userId +'" id="postOwnerURL" title='+data1.name+'><h4 id="ideaCreatedBy"><img title="' + data1.name + '"  src="../img/people/'+ data1.userIdHash +'.jpg" class="img-circle" width="40" height="40"  />'+' '+ res +'</h4></a>';

	post+='</div> <!-- end class col-md-8 id ideaProfile Pic --> ';
						
	
	
	if(data1.postOwner == 1)
	{
		post+='<div class="col-md-1 ">';
		post+='<h5 id="ideaOptions" ><i class="fa fa-pencil faColor"  data-toggle="modal"  onclick="editIdea(this);" title="Edit Idea"> </i>&nbsp;&nbsp;</h5>';
		post+='</div><!-- End of col-md-2 -->';
	}
	
	if(data1.postOwner == 1)
	{
		post+='<div class="col-md-1 trashRight" id="deleteIdea">';
		post+='<h5  id="ideaDelete"><i style="padding-top: 3px !important" id="trashId'+data1.ideaPostId+'" class="fa fa-trash faColor" onClick="deleteIdea(\'' + data1.ideaPostId + '\');"   title="Delete Idea"> </i>&nbsp;&nbsp;</h5>';
		post+='</div> <!-- end class col-md-1 -->';
	}
						
	post+='</div> <!-- end class ROW tag-->';
                
    post+='<div class="row" id="ideaBody">';
								                        
    post+='<div class="col-md-12" >';
					
    post+='<p id="ideaContent'+data1.ideaPostId+'">'+data1.ideaDescription+'</p>'; 
    
    post+='</div>';
                    
	post+='</div><!-- End of ROW tag -->';
    
    post+='<div class="row" id="ideaIcons" >';
	
    post+='<div class="col-md-3 col-md-offset-2 ideaStarBox" >';
	
	if (data1.hasAppreciated == 1) {
		post+='<a><img src="http://localhost/4pi/ideaBank/images/app.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" title="Appreciate" /></a><span id="ideaStarCount">'+'  '+data1.appreciateCount+'</span></div>';
	}else{
		if(data1.hasDepreciated ==1)
		{
					post+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" onClick="starClick('+data1.ideaPostId+');" title="Appreciate" /></a><span id="ideaStarCount">'+'  '+data1.appreciateCount+'</span></div>';
		}
		else{
		post+='<a class="" id="deactiveapp'+data1.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data1.ideaPostId+'" onClick="starClick('+data1.ideaPostId+');" title="Appreciate" /></a><span id="ideaStarCount">'+'  '+data1.appreciateCount+'</span></div>';
		}
	}
	
	 post+='<div class="col-md-3 col-md-offset-5 ideaStarBox" >';
	
	if (data1.hasDepreciated == 1) {
		post+='<a><img src="http://localhost/4pi/ideaBank/images/dep.SVG" height="26" class="ideaDepreciateIcon" id="depreciate'+data1.ideaPostId+'" title="Depreciate" /></a><span id="ideaUnStarCount">'+'  '+data1.depreciateCount+'</span></div>';
	}
	else{
		if(data1.hasAppreciated == 1)
		{
			post+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data1.ideaPostId+'" onClick="stopClick('+data1.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+'  '+data1.depreciateCount+'</span></div>';
		}
		else{
		post+='<a class="" id="deactivedep'+data1.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data1.ideaPostId+'" onClick="stopClick('+data1.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+'  '+data1.depreciateCount+'</span></div>';
		}
	}
	
	post+='<div class="col-md-4 ideaDateBox" >';
	
    post+='<em><time class="timeago" style="font-size:12px;" >'+data1.ideaPostDate+'</time></em></div>';
                        
    post+='</div><!-- End of ROW tag id-ideaIcons -->';
	
    post+='</div></div>';
	
	//console.log(num);
	//console.log(len);
	if(position == "last")
	{
		$('#'+idCol).append(post);
	}
	else if(position == "first")
	{
		 $('#'+idCol).prepend(post);
	}
	
	if((num+1)== len)
	{
		var loadmore=""
		loadmore+='<span class="spanLoadBefore" id="loadMoreIdeaPostsButton" ><strong><button type="button" id="loadButton" onclick="fetchMoreIdeaPosts(event);" class="btn btn-info">Load more</button></strong></span>';
		$('#sc').append(loadmore).hide().fadeIn('slow');
	}

}


function deleteIdea(id){
	if (confirm("Do you really want to delete your Idea ??") == true) {
	 //$('#'+id).remove();
	// console.log("Deleted");
	$('#trashId'+id).removeClass("fa-trash");
	$('#trashId'+id).html(".....");
	$('#ideaContent'+id).fadeOut(3000).delay(3000).html();
	//$('#ideaContent'+id).fadeIn(3000).html("<h4>Your Idea is getting deleted. Please wait !!! ");
	 $.post('http://localhost/4pi/ideaBank/ideaHandlers/deleteIdeaPost.php',{
		_ideaPostId : id
	 })
	
	 .error(function() {
			console.log('Error');
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
        var y = $.post('http://localhost/4pi/ideaBank/ideaHandlers/editIdeaPost.php', {
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
					console.log(data);
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
	var count = $('#' + id).find('#ideaStarCount').html();
	var val = parseInt(count);
	val = val+1;
	count = val.toString();
	$('#' + id).find('#ideaStarCount').html(' '+count);
    $.post('http://localhost/4pi/ideaBank/ideaHandlers/appreciatePost.php', {
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
    $.post('http://localhost/4pi/ideaBank/ideaHandlers/depreciatePost.php', {
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
			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img class="img-circle" src="/4pi/img/defaultMan1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			}
			else
			{
			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img class="img-circle" src="/4pi/img/defaultWoman1.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
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
			res+='<span><a href="http://localhost/4pi/'+data.userId+'"><img src="/4pi/img/proPics/'+data.userIdHash+'.jpg" alt="'+data.name+'" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="userNameText" style="font-size:18px;" class="text-left">'+data.name+'</span></a></span>';
			
			res+='</div>';
			res+='</div>';
			$('#ideaPeopleSearch').append(res);
		}
	}
	function checkIfPeopleImageExists(data)
	{
		var url="http://localhost/4pi/img/proPics/"+data.userIdHash+".jpg";
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
		
		res+='<span><a style="cursor:pointer" title="'+data.ideaDescription+'" onclick="searchIdea(\'#search'+data.ideaPostId+'\');"><img src="/4pi/img/logo2.PNG" alt="post" width="30" height="30"/>&nbsp;&nbsp;&nbsp;<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.ideaContent+'</span></a></span>';
		
		res+='</div>';
		res+='</div>';
		$('#ideaPostsSearch').append(res);
	}
	function searchIdeaInsertModal(data)
	{
		var res="";
		res+='<div class="row ideaPostSearchResult" style="border-bottom:1px solid #e6e6e6;padding-bottom:5px;padding-top:5px;">';
		res+='<div class="col-md-11" id="search'+data.ideaPostId+'">';
		
		res+='<span id="postSubjectText" style="font-size:18px;" class="text-left">'+data.ideaDescription+'</span>';
		
		res+='<div class="row" id="ideaIcons" >';
	
		res+='<div class="col-md-2 col-md-offset-5 ideaStarBox" >';
		
		if (data.hasAppreciated == 1) {
			res+='<a><img src="http://localhost/4pi/ideaBank/images/app.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data.ideaPostId+'" title="Appreciate" /></a><span id="ideaStarCount">'+data.appreciateCount+'</span></div>';
		}else{
			if(data.hasDepreciated ==1)
			{
						res+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data.ideaPostId+'" onClick="starClick('+data.ideaPostId+');" title="Appreciate" /></a><span id="ideaStarCount">'+data.appreciateCount+'</span></div>';
			}
			else{
			res+='<a class="" id="deactiveapp'+data.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/app1.SVG" height="25" class = "ideaAppreciateIcon" id="appreciate'+data.ideaPostId+'" onClick="starClick('+data.ideaPostId+');" title="Appreciate" /></a><span id="ideaStarCount">'+data.appreciateCount+'</span></div>';
			}
		}
		
		res+='<div class="col-md-2 col-md-offset-7 ideaStarBox" >';
		
		if (data.hasDepreciated == 1) {
			res+='<a><img src="http://localhost/4pi/ideaBank/images/dep.SVG" height="26" class="ideaDepreciateIcon" id="depreciate'+data.ideaPostId+'" title="Depreciate" /></a><span id="ideaUnStarCount">'+data.depreciateCount+'</span></div>';
		}
		else{
			if(data.hasAppreciated == 1)
			{
				res+='<a class="deactive" ><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data.ideaPostId+'" onClick="stopClick('+data.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+data.depreciateCount+'</span></div>';
			}
			else{
			res+='<a class="" id="deactivedep'+data.ideaPostId+'"><img src="http://localhost/4pi/ideaBank/images/dep.SVG" class="ideaDepreciateIcon" height="26" id="depreciate'+data.ideaPostId+'" onClick="stopClick('+data.ideaPostId+');" title="Depreciate" /></a><span id="ideaUnStarCount">'+data.depreciateCount+'</span></div>';
			}
		}
		
		res+='<div class="col-md-3 ideaDateBox text-center" >';
		
		res+='<em><time class="timeago" style="font-size:12px;" >'+data.ideaPostDate+'</time></em></div>';
							
		res+='</div><!-- End of ROW tag id-ideaIcons -->';
		
		res+='</div>';
		res+='</div>';
		return res;
	}
	
	function fetchIdeaSearchResults()
	{
		var input=$('#ideaSearchBefore').val().trim();
		$.post('http://localhost/4pi/ideaBank/ideaBankSearch.php',{
			_inputVal:input
		})
		.error(function(){
			alert("Server overload. Please try again");
		})
		.success(function(data){
			data = data.trim();
			console.log(data);
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
			console.log(data);
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
	    $('#topBar').addClass("sticky");
	    // $('#topBarNew').addClass("sticky");
	  }
	  else{
	    $('#topBar').removeClass("sticky");
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

<style>
	#ideaSearchResults1{
		position:absolute;
		z-index:154897;
		border:1px solid gray;
		padding:0px;
		top: 42px !important;
		margin-left: 15px !important;
		width:94.5% !important ;
	}
	#ideaSearch{
		padding-left:0px;
	}
	#topBarNew{
		position:abolsute;
	}
	.sticky{
		position:fixed;
		top:0px;
		z-index:99;
		width:93%;
	}
	.scrollactive{
		width: 50% !important;
	}
</style>
	
