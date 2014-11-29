<script>
var userIdHash="<?php echo $_SESSION['vj']; ?>";
var inView="<?php echo $_SESSION['jx'];?>";
</script>
<div class="col-md-7" id="posts">

			<div class="row postMenu topMenu" style="z-index:1040;" >
				
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
								  <div class="form-group">
								    <label for="postContent">Content</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Content is compulsory"></i>]
								    <textarea type="text" name="postContent" id="createPostContent" style="background-color:white;border-radius:0px;resize:none;" class="form-control" id="createPostContent"></textarea>
								  </div>
								  <!-- <div class="form-group">
								    <label for="fileInput">Attach Image </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Allowed Extensions are .jpg, .png."></i>]
								    <input name="fileInput" type="file"  id="createPostFileInput">
								  </div> -->
								  <div class="form-group">
								    <label for="shareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Leaving it blank makes the post visible to everyone. Examples would be like COE12, B.Tech12, etc. You can share the post with multiple groups by separating the groups with commas."></i>]
								    <input name="createPostSharedWith" value="Everyone" class="form-control"type="text" id="createPostSharedWith">
								  </div>
								  <div class="form-group">
								    <label for="porstValidity">Post Validity</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="A post lives only for a fixed time. You can also REQUEST for a lifetime validity. "></i>]
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
								<button onclick="createPost();" class="btn btn-primary">Post</button>
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
								    <label for="postContent">Content</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Post Content is compulsory"></i>]
								    <textarea type="text" name="postContent" id="editPostContent" style="background-color:white;border-radius:0px;resize:none;" class="form-control" id="exampleInputPassword1"></textarea>
								  </div>
								  <!-- <div class="form-group">
								    <label for="fileInput">Attach Image </label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Allowed Extensions are .jpg, .png."></i>]
								    <input name="fileInput" type="file"  id="fileInput">
								  </div>  -->
								  <div class="form-group">
								    <label for="shareWith">Share with</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Leaving it blank makes the post visible to everyone. Examples would be like COE12, B.Tech12, etc. You can share the post with multiple groups by separating the groups with commas."></i>]
								    <input name="editPostSharedWith" class="form-control"type="text" id="editPostSharedWith">
								  </div>
								  <div class="form-group">
								    <label for="editPostValidity">Post Validity</label>&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="A post lives only for a fixed time. You can also REQUEST for a lifetime validity. "></i>]
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
								<button onclick="editedPostSend();" class="btn btn-primary">Post</button>
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

		<div id="#postEmptyMessage">

		</div>
		<!-- end post area -->
	</div>		

<script>

$(document).ready(function(){
	retrieveLatestPosts('empty','-1');	
});

</script>


 