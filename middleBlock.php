<script>
var userIdHash="<?php echo $_SESSION['vj']; ?>";
// window.inView=<?php echo $_SESSION['jx'];?>;
</script>
<div class="col-md-7" id="posts">

	<div class="row postMenu topMenu" style="z-index:2;" >
		
			<div class="btn-group btn-group-justified" style="padding:10px;">
				<div class="btn-group">
				    <button type="button" class="btn btn-warning" id="createPostButton" data-toggle="modal" data-target="#createPostModal"><a href="#" style="color:white;" ><i class="fa fa-plus"></i>&nbsp;<span>Create Post</span></a></button>
			  	</div>
			  	<div class="btn-group">
				    <button type="button" class="btn btn-primary" id="latestPostsButton" onclick="retrieveLatestPosts('empty','-1');"><a href="#" style="color:white;"><i class="fa fa-clock-o"></i>&nbsp;Latest Posts</a></button>
			  	</div>
			  	<div class="btn-group">
			    	<button type="button" class="btn btn-success" id="importantPostsButton" onclick="retrieveImportantPosts('empty','-1');"><a href="#" style="color:white;"><i class="fa fa-star"></i>&nbsp;&nbsp;Important Posts</a></button>
			  	</div>
			  	<div class="btn-group">
				    <button type="button" class="btn btn-danger" id="popularPostsButton" onclick="retrievePopularPosts('empty','-1');"><a href="#" style="color:white;"><i class="fa fa-group"></i>&nbsp;Popular Posts</a></button>
			  	</div>
				
			</div>

	</div>

	<br/><br/>
				
	<!-- Create post modal  -->
				<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <span><p  style="font-size:15px;" class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> &nbsp;Create Post&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Maximum size of the post can be 3MB. Post content can contain upto 8000 characters."></i>]</p></span>
				      </div>
				      <div class="modal-body">
				       <form role="form">
						  <div class="form-group">
						    <label for="postSubject">Subject</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Subject is useful when you search for posts. It is not mandatory."></i>]
						    <input type="text" name="postSubject" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="createPostSubject" placeholder="Subject">
						  </div>
						  <div class="form-group has-error">
						    <label for="postContent">Content <small>(<span id="createPostModalContentLength">8000</span> characters left)</small>&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Content is compulsory. Limit to 8000 characters."></i>]
						    <textarea type="text" name="postContent" id="createPostContent" style="background-color:white;border-radius:0px;resize:none;" onkeyup="$('#createPostModalContentLength').html(8000-$(this).val().length);" onkeydown="$('#createPostModalContentLength').html(8000-$(this).val().length);" class="form-control" id="createPostContent"></textarea>
						  </div>
						  <!-- <div class="form-group">
						    <label for="fileInput">Attach Image </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Allowed Extensions are .jpg, .png."></i>]
						    <input name="fileInput" type="file"  id="createPostFileInput">
						  </div> -->
						  <div class="form-group has-error">
						    <label for="shareWith">Share with &nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)"></i>]
						    <input name="createPostSharedWith" value="All" class="popOver form-control"type="text" id="createPostSharedWith" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)">
						  </div>
						  <div class="form-group has-error">
						    <label for="porstValidity">Post Validity&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="A post lives only for a fixed time. You can also REQUEST for a lifetime validity. "></i>]
						    <!-- <input name="postLivingTime" class="form-control" type="text" id="postLivingTime"> -->
						    <select class="form-control"  id="createPostLivingTime" name="createPostLivingTime" >
							  <option value="1">1 day</option>
							  <option value="7">1 week</option>
							  <option value="15">15 days</option>
							  <option value="30">1 month</option>
							  <option value="90">3 months</option>
							  <option value="180">6 months</option>
							  <option value="365">1 year</option>
							  <option value="9999">Request Lifetime</option>
							</select>
						  </div>
						</form>

					</div>
					<div class="modal-footer">

						<div class="row">

							<div class="col-md-1 col-md-offset-5 text-center">

								<img id="loadingImage" src="/4pi/img/728.gif" class="hidden" width="25px" height="25px">
	
							</div>

							<div class="col-md-2 col-md-offset-4">

								<button onclick="createPost();" id="createPostButton" class="btn btn-primary">Post</button>

							</div>

						</div>
						
				      </div>
				    </div>
				  </div>
				</div>
		
		<!-- end create post modal -->




		<!-- edit  post modal  -->
				<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModal" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="editPost"><i class="fa fa-pencil"></i> &nbsp;Edit Post&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Maximum size of the post can be 3MB. Post content can contain upto 8000 characters."></i>]</h4>
				      </div>
				      <div id="editPostId" class="hidden"></div>
				      <div class="modal-body">
				       <form role="form">
						  <div class="form-group">
						    <label for="postSubject">Subject</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Subject is useful when you search for posts. It is not mandatory."></i>]
						    <input type="email" name="postSubject" class="form-control input-sm" style="background-color:white !important;border-radius:0px;" id="editPostSubject" placeholder="Subject">
						  </div>
						  <div class="form-group">
						    <label for="postContent">Content <small>(<span id="editPostModalContentLength"></span> characters left)</small>&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Content is compulsory"></i>]
						    <textarea type="text" name="postContent" id="editPostContent" style="background-color:white;border-radius:0px;resize:none;" onkeyup="$('#editPostModalContentLength').html(8000-$(this).val().length);" onkeydown="$('#editPostModalContentLength').html(8000-$(this).val().length);"class="form-control" id="exampleInputPassword1"></textarea>
						  </div>
						  <!-- <div class="form-group">
						    <label for="fileInput">Attach Image </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Allowed Extensions are .jpg, .png."></i>]
						    <input name="fileInput" type="file"  id="fileInput">
						  </div>  -->
						  <div class="form-group">
						    <label for="shareWith">Share with&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)"></i>]
						    <input name="editPostSharedWith" class="popOver form-control" type="text" id="editPostSharedWith" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Enter 'All' for to provide universal visibility. Otherwise enter 'COE12' for 2012 COE batch or just 'COE' for complete COE stream. For just B.Tech enter B, or for a  particular batch you can enter Bi, i can be the batch number. If you want this post to be visible for B.Tech and M.Des enter 'B,M'. (without quotes)">
						  </div>
						  <div class="form-group">
						    <label for="editPostValidity">Post Validity&nbsp;<span style="color:red;">*</span></label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="A post lives only for a fixed time. You can also REQUEST for a lifetime validity. "></i>]
						    <!-- <input name="postLivingTime" class="form-control" type="text" id="postLivingTime"> -->
						    <!-- <input name="postLivingTime" class="form-control" type="text" id="postLivingTime"> -->
						    <select class="form-control"  id="editPostLivingTime" name="editPostLivingTime" >
							  <option value="1">1 day</option>
							  <option value="7">1 week</option>
							  <option value="15">15 days</option>
							  <option value="30">1 month</option>
							  <option value="90">3 months</option>
							  <option value="180">6 months</option>
							  <option value="365">1 year</option>
							  <option value="9999">Request Lifetime</option>
							</select>
						  </div>

						  <input class="hidden" id="postId" name="postId">
						</form>
					</div>
					<div class="modal-footer">

						<div class="row">

							<div class="col-md-1 col-md-offset-5 text-center">

								<img id="loadingImage" src="/4pi/img/728.gif" class="hidden" width="25px" height="25px">
	
							</div>

							<div class="col-md-2 col-md-offset-4">

								<button onclick="editedPostSend();" id="editPostButton" class="btn btn-primary">Save</button>

							</div>

						</div>
						
					</div>
						
				    </div>
				  </div>
				</div>
		
		<!-- edit create post modal -->

	<!-- ****************************************************************************** -->
	                                   <!--  POST DIV -->
	<!-- ****************************************************************************** -->
		<div id="postArea">

		</div>	

	<div id="postEmptyMessage">

		<div class="row text-center">

			<div class="col-md-12 text-center">

				<span class="text-center messageEmpty" id="messageEmpty"></span>

			</div>

		</div>

	</div>

	<div id="loadMorePostsButton">

		<div class="row text-center">

		<button style="display:block;width:100%;" class="text-center btn btn-lg btn-success" onclick="fetchMorePosts(event);">Load more</button>

		</div>

	</div>
		<!-- end post area -->
	</div>		

<script>

function fetchMorePosts(e)
{
	$('#loadMorePostsButton').find('button').html("Loading").attr("onclick","");
	e.preventDefault();
	var inViewElement=$('#inViewElement').html();
    if(inViewElement==999)
    {
        retrieveLatestPosts("noempty",1);
        $('#loadMorePostsButton').find('button').html("Load more posts").attr("onclick","fetchMorePosts(event)");
    }

    else if(inViewElement==998)
    {
        retrievePopularPosts("noempty",1);
        $('#loadMorePostsButton').find('button').html("Load more posts").attr("onclick","fetchMorePosts(event)");
    }

    else if(inViewElement==997)
    {
        retrieveImportantPosts("noempty",1);
        $('#loadMorePostsButton').find('button').html("Load more posts").attr("onclick","fetchMorePosts(event)");
    }
}

$(document).ready(function(){
	retrieveLatestPosts('empty','-1');	
});

$(document).ready(function(){
	
	var sns = $(".topMenu");

    var posns = sns.position();

    var windowposns = $(window).scrollTop();

    if (windowposns >= posns.top-50) {

        sns.addClass("stickTopMenu");

    }

    else {

       sns.removeClass("stickTopMenu");

    }	
});
   

</script>


 