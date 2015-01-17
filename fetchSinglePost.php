<?php
session_start();

	include_once('header.php'); 
	include_once('topbar.php');

	require_once 'QOB/qobConfig.php';

	if(!isset($_GET['ref']))
	{	
		echo '<script>alert("Invalid url. Redirecting to home page..");window.location.href="http://localhost/4pi";</script>';
	}
	else
	{
		echo '<script>var postIdHash="'.$_GET['ref'].'";</script>';
	}

?>

<script>

function fetchSinglePost()
{
	$.post('/4pi/handlers/fetchSinglePost.php',{
		_postId:postIdHash
	})
	.error(function(){
		alert("Server overload. Please try again.:(");
	})
	.success(function(data){
		console.log(data);
		if(checkData(data)==1)
		{
			
			if(data==404)
			{
				alert("The post does not exist.");
			}
			else if(data==505)
			{
				alert("The post is not shared with you.");
			}
			else
			{
				console.log(data);
				data=JSON.parse(data);
				postInsert("first",data);
				for(i=0;i<data.comments.length;i++)
					{
						commentInsert('first', data.comments[i], data.postId);
					}
					callAfterAjax();

			}
		}
	});
}


$(document).ready(function(){
	fetchSinglePost();
});

var userIdHash="<?php echo $_SESSION['vj'];?>";

</script>


<body style="padding:0px;" >
    <div id="wrap" >

	<div class="row">
		<!-- left column code starts here -->
		<?php 
		
		//echo $_SESSION['vj'];
		
		include_once('leftBlock.php'); ?>
		<!-- left column code ends here  -->
		
		<?php include_once('singlePostBlock.php'); ?>
		
		<!-- BLOCK in the right code starts here  -->
		 <?php include_once('rightBlock.php');?>
		<!-- right block code ends here  -->

	</div>
	
	
	
	
<?php
	include_once("footer.php");
?>

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