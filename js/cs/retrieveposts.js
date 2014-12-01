var genUrl = "http:localhost/4pi/";

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
    else if(data==3) {
        return 1;
    }
    else if(data==1)
    {
        return 1;
    }
    else if(data==11)
    {
        alert("Please login to continue");
        window.location.href = "/4pi/index.php";
    }
    else
    {
        return "error";
    }
}

function callAfterAjax() {
    $('.postCommentIcon').click(function() {

        //console.log($(this).parent().parent().parent().parent().next().find('.postComments'));
        $(this).parent().parent().parent().parent().next().find('.postComments').toggleClass('hidden');
        $(this).parent().parent().parent().parent().next().find('.postComments').show(500);
        /*		$(this).parent().parent().parent().parent().next().find('.loadmoreComments').toggleClass('hidden');
			$(this).parent().parent().parent().parent().next().find('.loadmoreComments').show(500);*/
    });
    $(".post").each(function() {
        $(this).find('#postContent').shorten({
            "showChars": 347,
            "moreText": "<br/>See More",
            "lessText": "",
            ellipsesText: "",
        });
        $('time.timeago').timeago();
        $('textarea').autosize();
    });
}




$(function() {
    //$('#myTab a:first').tab('show');
});

function exchange(el, el2) {

	// console.log(el);

    $(el2).removeClass('fa-pencil').addClass('fa-close').attr("title", "Press Esc to cancel");
    commentDiv = $('#' + el);
    commentText = commentDiv.find('.commentText').html();
    var ie = document.all && !document.getElementById ? document.all : 0;
    var toObjId = /b$/.test(el) ? el.replace(/b$/, '') : el + 'b';
    var toObj = ie ? ie[toObjId] : document.getElementById(toObjId);
    if (/b$/.test(el))
        toObj.innerHTML = commentText;
    else {
        toObj.style.width = commentDiv.find('textarea').offsetWidth + 7 + 'px';
        toObj.value = commentText;
    }
    commentDiv.find('.commentText').css({
        "display": "none"
    });
    commentDiv.find('textarea').css({
        "display": "block"
    });
    toObj.style.display = 'inline';
}

function exchange2(el, el2, key) {

    if (key == "enter") {
        commentDiv = $('#' + el);
        commentText = $(el2).val();
        commentTextAreaDivId = $('#' + el).find('textarea').attr("id");
        var ie = document.all && !document.getElementById ? document.all : 0;
        var toObjId = /b$/.test(commentTextAreaDivId) ? commentTextAreaDivId.replace(/b$/, '') : commentTextAreaDivId + 'b';
        var toObj = ie ? ie[toObjId] : document.getElementById(toObjId);
        // console.log($(toObj).find('.commentText').html());
        if (/b$/.test(commentTextAreaDivId))
            $(toObj).find('.commentText').html(commentText);
        else {
            //toObj.style.width=commentDiv.find('#commentText').offsetWidth+7+'px';
            $(toObj).find('.commentText').html(commentText);
        }
        commentDiv.find('textarea').css({
            "display": "none"
        });
        commentDiv.find('.commentText').css({
            "display": "block"
        });
        $('#' + el).find('.fa-close').removeClass('fa-close').addClass('fa-pencil').attr("title", "Edit");
    } else {
        commentDiv = $('#' + el);
        commentText = $(el2).val();
        commentTextAreaDivId = $('#' + el).find('textarea').attr("id");
        var ie = document.all && !document.getElementById ? document.all : 0;
        var toObjId = /b$/.test(commentTextAreaDivId) ? commentTextAreaDivId.replace(/b$/, '') : commentTextAreaDivId + 'b';
        var toObj = ie ? ie[toObjId] : document.getElementById(toObjId);
        x = $(toObj).find('.commentText').html();
        if (/b$/.test(commentTextAreaDivId))
            $(toObj).find('.commentText').html(x);
        else {
            //toObj.style.width=commentDiv.find('#commentText').offsetWidth+7+'px';
            $(toObj).find('.commentText').html(x);
        }
        commentDiv.find('textarea').css({
            "display": "none"
        });
        commentDiv.find('.commentText').css({
            "display": "block"
        });
        $('#' + el).find('.fa-close').removeClass('fa-close').addClass('fa-pencil').attr("title", "Edit");
    }


    // toObj.style.display='inline';
}


function replaceIt(y, z, x, event, val) {
    //alert("hello"+event.keyCode

    if (event.keyCode == 13 && !event.shiftKey) {
        event.preventDefault();

        m=function(result){
        	if(result==1)
        	{
        		exchange2(z, x, 'enter');
        	}
        };

        editComment(y,z,m);
    } 
    else if (event.keyCode == 27) {
        event.preventDefault();
        exchange2(z, x, 'escape');
    }
}


function modifyPost(id, data) {

    console.log(data);
    alert("Called");
    data = JSON.parse(data);
    var e = $('#' + id);
    e.find('#postSharedWith').html(data.sharedWith);
    e.find('#postValidity').html(data.postValidity);
    e.find('#postSubject').html(data.postSubject);
    e.find('#postContent').html(data.postContent);
    e.find('#starCount').html(data.noOfStars);
    e.find('#commentCount').html(data.noOfComments);
    e.find('#mailCount').html(data.noOfMailTos);
    e.find('#postSeenByNumber').html(data.postSeenNumber);

}

function editPost(ele) {

    $('#editPostModal').modal('show');
    var x = $(ele).parent().parent().parent().parent();
    var y = x.parent().attr("id");
    //console.log(y);
    $('#editPostId').html(y);
    var subject = x.find("#postSubject").html();
    // var postContent=x.find('#postContent').html();
    // console.log(x.find('#postContent'));
    if (x.find("#postContent").html().length > 300) {
        postContent = x.find('#postContent').find('.shortcontent').html();
        postContent += x.find('#postContent').find('.allcontent').html();
    } else {
        postContent = x.find('#postContent').html();
    }
    // console.log(postContent);
    var postSharedWith = x.find('#postSharedWith').html();
    var postValidity = x.find('#postValidity').html();
    var postId = x.parent().id;
    //console.log(subject);
    $('#editPostModal').find('#editPostLivingTime').val(postValidity);
    $('#editPostModal').find('#editPostSharedWith').val(postSharedWith);
    $('#editPostModal').find('#editPostContent').css({
        'height': '50px'
    });
    $('#editPostModal').find('#editPostContent').val(postContent);
    $('#editPostModal').find('#editPostSubject').val(subject);
    $('#editPostModal').find('#postId').val(postId);
    $('#editPostModal').find('#editPostContent').autosize();
}

function editedPostSend() {

    //alert("HEll");	
    var postId = $('#editPostModal').find('#editPostId').html().trim();
    // console.log(postId);
    var postSubject = $('#editPostSubject').val().trim();
    //console.log(postSubject);
    var postContent = $('#editPostContent').val().trim();
    var done=1;
    if (postContent.length == 0) {
        alert("Post content is to be filled");
        done=0;
    } 
        //var files[]=$('#editPostFileInput').val();
    var sharedWith = $('#editPostSharedWith').val().trim();
    if(sharedWith.length==0)
    {
        alert("Please tell us to whom the post should be shared with. :)");
        done=0;
    }
    var postValidity = $('#editPostLivingTime').val().trim();
    if(postValidity.length==0)
    {
        alert("You are trying to mess with 4pi. :(");
        done=0;
    }
    if(done==1)
    {
        var y = $.post('./handlers/postHandlers/editPost.php', {
            _subject: postSubject,
            _postContent: postContent,
            /*_files:files,*/
            _share: sharedWith,
            _validity: postValidity,
            _postId: postId
        })
        .error(function() {
            alert("Post edit Failed");
        })
        .success(
            function(data) {

                console.log(data);
                
                $('#editPostModal').modal('hide');
                alert(checkData(data));
                // if (checkData(data) == 1) {

                    modifyPost(postId, data);

                // }
            }
        );
    }

}

function createPost() {


    var postSubject = $('#createPostSubject').val().trim();
    var done=1;
    if (postSubject.length > 40) {
        alert("Please limit the subject length to 40 characters");
        done=0;
    }
    var postContent = $('#createPostContent').val().trim();
    if (postContent.length == 0) {
        alert("Post content is to be filled");
        done=0;
    }
    var sharedWith = $('#createPostSharedWith').val().trim();
    if(sharedWith.length==0)
    {
        alert("Please tell us to whom the post should be shared with");
        done=0;
    }
    var postValidity = $('#createPostLivingTime').val().trim();
    if(postValidity.length==0)
    {
        alert("You are trying to mess with 4pi. :(");
            done=0;
    }
    if(done==1)
    {
        $('#createPostModal').find('#createPostSubject').val("");
    $('#createPostModal').find('#createPostContent').val("");
    $('#createPostModal').find('#createPostSharedWith').val("All");
    $('#createPostModal').find('#createPostLivingTime').val("1");
    $('.row .postMenu').find('#createPostButton').attr("data-target", "").find('a span').html("Creating post...");
    $('.row .postMenu').find('#createPostButton').find('.fa-plus').addClass('fa-spin');
    $('#createPostModal').modal('hide');

    var y = $.post('http://localhost/4pi/handlers/postHandlers/createPost.php', {
        _subject: postSubject,
        _postContent: postContent,
        //_files:files,
        _share: sharedWith,
        _validity: postValidity
    })

    .error(function() {
        alert("Post Creation Failed" + y.status);
    })
        .success(
            function(data) {
                // console.log(data);
                console.log(data);
                data = data.trim();
                $('.row .postMenu').find('#createPostButton').attr("data-target", "#createPostModal").find('a span').html("Create Post");
                $('.row .postMenu').find('#createPostButton').find('.fa-plus').removeClass('fa-spin');

                if (data == "12") {
                    alert("Sorry. We encountered an error in creating your post ");
                } else if (data == 13) {
                    alert("Do not fiddle with 4pi");
                } else if (data == 16) {
                    alert("Please check the post details you have entered");
                } else {
                    $('#createPostModal').modal('hide');
                    //console.log(data);
                    var x = JSON.parse(data);
                    //console.log(data);
                    postInsert("first", x);
                    callAfterAjax();
                }
            }
    );
    }
    

}




function retrieveLatestPosts(value, call) {

    $('.row .postMenu').find('#latestPostsButton').find('i').addClass('fa-spin');

    var posts=[];
    if(call==1)
    {
        var i=0;
        $('.post').each(function(){
            posts[i]=$(this).attr("id");
            i++;
        });

        console.log("                  posts sent");
        console.log(posts);
    }

    $.post('./handlers/postHandlers/latest.php', {
        _posts:posts,
        _postOffset: 5,
        _call: call,
        dataType: "json",
        contentType: 'application/json'
    })
        .error(function() {

        })
        .success(function(data) {

            // console.log(data);



            $('.row .postMenu').find('#latestPostsButton').find('i').removeClass('fa-spin');

            data = data.trim();
            // console.log(data);
            if (value == "empty") {
                //alert(value);
                $('.post').each(function() {
                    $(this).remove();

                    $(this).css({
                        'border': 'none'
                    });
                });
            }


            if (data != 404) {
                $('#postEmptyMessage').html("");
                // console.log(data);
                var ob = JSON.parse(data);
                for (i = 0; i < ob.length; i++) {
                    postInsert('last', ob[i]);
                    if (ob[i].comments == null) {
                        var cLength = 0;
                    } else {
                        var cLength = ob[i].comments.length;
                    }
                    // var cLength = ob[i].comments.length;

                    for (j = 0; j < cLength; j++) {
                        commentInsert('first', ob[i].comments[j], ob[i].postId);
                    }
                }

                callAfterAjax();
            } 
            else if(data==11)
            {
                alert("Please login to continue");
                window.location.href = "/4pi/index.php";
            }
            else if (data == 404) {
                // alert("HE::L");
                $('#postEmptyMessage').html("<p class='text-center'>Sorry! No more posts to display.</p>");
            }

        });



}



function retrieveImportantPosts(value, call) {

    $('.row .postMenu').find('#importantPostsButton').find('i').addClass('fa-spin');

    var posts=[];
    if(call==1)
    {
        var i=0;
        $('.post').each(function(){
            posts[i]=$(this).attr("id");
            i++;
        });
    }

    $.post('./handlers/postHandlers/important.php', {
        _posts:posts,
        _call: call
    })
        .error(function() {

        })
        .success(function(data) {

            $('.row .postMenu').find('#importantPostsButton').find('i').removeClass('fa-spin');

            var ob = JSON.parse(data);
            if (value == "empty") {
                //alert(value);
                $('.post').each(function() {
                    $(this).remove();

                    $(this).css({
                        'border': 'none'
                    });
                });
            }
            //alert(data);
            //datad=jQuery.parseJSON(data[0]);
            for (i = 0; i < ob.length; i++) {
                postInsert('last', ob[i]);
                if (ob[i].comments == null) {
                    var cLength = 0;
                } else {
                    var cLength = ob[i].comments.length;
                }
                // var cLength = ob[i].comments.length;

                for (j = 0; j < cLength; j++) {
                    commentInsert('first', ob[i].comments[j], ob[i].postId);
                }

            }
            callAfterAjax();
        });
}

function retrievePopularPosts(value, call) {
    $('.row .postMenu').find('#popularPostsButton').find('i').addClass('fa-spin');

    var posts=[];
    if(call==1)
    {
        var i=0;
        $('.post').each(function(){
            posts[i]=$(this).attr("id");
            i++;
        });
    }

    $.post('./handlers/postHandlers/popular.php', {
        _posts:posts,
        _call: call
    })
        .error(function() {

        })
        .success(function(data) {
            $('.row .postMenu').find('#popularPostsButton').find('i').removeClass('fa-spin');
            if (value == "empty") {
                //alert(value);
                $('.post').each(function() {
                    $(this).remove();

                    $(this).css({
                        'border': 'none'
                    });
                });
            }
            var ob = JSON.parse(data);
            //alert(data);
            //datad=jQuery.parseJSON(data[0]);
            for (i = 0; i < ob.length; i++) {
                postInsert('last', ob[i]);
                if (ob[i].comments == null) {
                    var cLength = 0;
                } else {
                    var cLength = ob[i].comments.length;
                }
                // var cLength = ob[i].comments.length;

                for (j = 0; j < cLength; j++) {
                    commentInsert('first', ob[i].comments[j], ob[i].postId);
                }

            }
            callAfterAjax();
        });
}

function commentInsert(position, data, postId) {

    var comment = "";

    comment += '<div class="comment" id="' + data.commentIdHash + '">';

    comment += '<div class="row">';

    comment += '<div class="col-md-1">';

    comment += '<a href="' + genUrl + data.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="./images/' + data.commentUserId + '.jpg" title="' + data.commentUserName + '"/></a>';

    comment += '</div>';

    comment += '<div class="col-md-10">';

    comment += '<div class="commentText fontSize13" style="float:left;white-space:pre-wrap;">' + data.commentContent + '</div>';

    comment += '<form><textarea id="' + data.commentIdHash + 'b" name="commentedText" onkeypress="replaceIt(\'' + postId + '\',\'' + data.commentIdHash + '\',this,event,\'comment\');" class="form-control replace" style="float:left;margin-left:-24px;resize:none;"></textarea></form>';

    comment += '</div>';

    if (data.commentOwner == '1') {

        comment += '<div class="col-md-1">';

        comment += '<p class="text-center"><span class="fontSize13"><i class="fa fa-pencil commentEdit" onclick="exchange(\'' + data.commentIdHash + '\',this);" title="Edit"></i></span>&nbsp;&nbsp;<span class="fontSize13"><i class="fa fa-trash commentDelete" title="Delete" onclick="deleteComment(\'' + data.commentIdHash + '\',\'' + postId + '\');"></i></span></p>';

        comment += '</div>';

    }

    comment += '</div>';

    comment += '<div class="row">';

    comment += '<div class="col-md-2 col-md-offset-10 text-right" >';

    comment += '<time class="timeago text-center" style="font-size:9px;" title="' + data.commentTime + '" datetime="' + data.commentTime + '">' + data.commentTime + '</time>';

    comment += '</div>';

    comment += '</div>';

    comment += '</div> <!--end class comment -->';

    if (position == "first") {
        $('#' + postId).find('.postComments').prepend(comment);
        //$(comment).insertAfter(
    } else if (position == "last") {
        $('#' + postId).find('.postComments').append(comment);
    }

}




function postInsert(position, data1) {
    //alert(position+" "+data);

    var post = "";

    post += '<div class="row post" style="margin-bottom:10px;" id="' + data1.postId + '">';

    post += '<div class="front">';

    post += '<div id="postSharedWith" class="hidden">' + data1.sharedWith + '</div>';

    post += '<div id="postValidity" class="hidden">' + data1.postValidity + '</div>';

    post += '<div class="row" id="postFrontTop">';

    post += '<div class="col-md-5" id="postProfilePic">';

    post += '<a href="' + genUrl + data1.postUserId + '" id="postOwnerURL"><h5 id="postCreatedBy"><img title="' + data1.postUserName + '" src="./images/' + data1.postUserIdHash + '.jpg" class="postPPic"/>' + data1.postUserName + '</h5></a>';

    post += '</div> <!-- end class col-md-2 id postProfile Pic -->';

    post += '<div class="col-md-4 text-left">';

    post += '<div class="fontSize14 text-left paddingTopRowPost textBold"  id="postSubject">' + data1.postSubject + '</div>';

    post += '</div><!-- end class col-md-6 id postSubject -->';

    post += '<div class="col-md-1 col-md-offset-2" id="linkToPostBack">';

    post += '<div class="text-center paddingTopRowPost"><i class="fa fa-bars" title="More Options"></i>&nbsp;&nbsp;';

    if (data1.postOwner == 1) {
        /*			post+=data.postOwner;
			post+=data.postUserId;*/
        post += '<i class="fa fa-pencil"  data-toggle="modal"  onclick="editPost(this);" title="Edit Post"></i>';
    }

    post += '</div></div> <!-- end class col-md-1 id linkToPostBack -->';

    post += '</div> <!-- end class row id postfronttop-->';

    post += '<div class="row" >';

    post += '<div class="postContent text-center" style="white-space:pre-wrap" id="postContent">' + data1.postContent + '</div>';

    post += '</div><!-- end class row id postContent -->';

    post += '<div class="row" id="postAttributes">';

    post += '<div class="col-md-3">';

    post += '<div id="starCommentMail" class="postBottomRowPadding">';
    if (data1.hasStarred == -1) {
        post += '<p><i class="fa fa-star-o postIconsFrontFontSize" onclick="starPost(\'' + data1.postId + '\');"id="postStarIcon" title="Important"></i>&nbsp;<span id="starCount" class="attrCountPost">' + data1.noOfStars + '</span>&nbsp;&nbsp;&nbsp;';
    } else {
        post += '<p><i class="fa fa-star postIconsFrontFontSize" id="postStarIcon" title="Important"></i>&nbsp;<span id="starCount" class="attrCountPost">' + data1.noOfStars + '</span>&nbsp;&nbsp;&nbsp;';
    }


    post += '<i class="fa fa-comments postCommentIcon postIconsFrontFontSize" id="postCommentIcon" title="Comments"></i>&nbsp;<span id="commentCount" class="attrCountPost">' + data1.noOfComments + '</span>&nbsp;&nbsp;&nbsp;';

    post += '<i class="fa fa-envelope postIconsFrontFontSize has-warning" id="postMailIcon" title="Mail To"></i>&nbsp;<span id="mailCount" class="attrCountPost">' + data1.noOfMailTos + '</span></p>';

    post += '</div>';

    post += '</div> <!-- end class col-md-3 -->';

    post += '<div class="col-md-2 col-md-offset-2" >';

    post += '<div id="postSeenBy" class="text-center postBottomRowPadding">';

    post += '<i class="fa fa-eye" title="Seen By"></i>&nbsp;<span id="postSeenByNumber">' + data1.postSeenNumber + '</span>';

    post += '</div> <!-- end id postSeenBy -->';

    post += '</div> <!-- end class col-md-2 -->';

    post += '<div class="col-md-3  text-right col-md-offset-2 postBottomRowPadding">';

    post += '<time class="timeago" style="font-size:12px;" datetime="' + data1.postCreationTime + '" title="' + data1.postCreationTime + '">' + data1.postCreationTime + '</time>';

    post += '</div><!-- end class col-md-2 -->';

    post += '</div>';

    post += '<div class="row" id="commentsSection">';

    post += '<div class="row">';

    post += '<div class="col-md-1">';

    post += '<a href="#"><img style="float:left;"src="./images/' + userIdHash + '.jpg" class="commentProfilePicture"/></a>';

    post += '</div>';

    post += '<div class="col-md-11">';

    post += '<form id="commentInsertForm">';

    post += '<textarea  rows="1" name="commentedText" id="commentInsertArea" onkeypress="insertCommentToPost(\'' + data1.postId + '\',event);" class="commentInsertArea form-control" style="float:left;resize:none;"></textarea>';

    post += '</form>';

    post += '</div>';

    post += '</div><!-- end class row -->';

    post += '<br>';

    post += '<div class="postComments text-center hidden">';

    if(data1.noOfComments>3)
    {
            post += '<button class="row loadmoreComments btn btn-default text-center" style="cursor:pointer;" onclick="retrieveComments(\'' + data1.postId + '\');">Load All Comments</button>';
    }

    post += '</div><br/> <!-- end id postComments -->';

    post += '</div><!-- end id commentsSection -->';

    post += '</div> <!-- END ID FRONT -->';

    post += '<div class="back hidden">';

    post += '<br/>';

    post += '<div class="row">';

    post += '<div class="col-md-6 col-md-offset-3">';

    post += '<ul class="nav nav-tabs" role="tablist" id="myTab">';

    post += '<li class="active"><a href="#mailPost' + data1.postId + '" role="tab" data-toggle="tab"><i class="fa fa-envelope" title="Mail Post"></i></a></li>';

    if (data1.postOwner == 1) {

        post += '<li><a href="#deletePost' + data1.postId + '" role="tab" data-toggle="tab"><i class="fa fa-trash" title="Delete Post"></i></a></li>';

    }

    post += '<li><a href="#hidePost' + data1.postId + '" role="tab" data-toggle="tab"><i class="fa fa-lock" title="Hide Post"></i></a></li>';

    post += '<li><a href="#reportPost' + data1.postId + '" role="tab" data-toggle="tab"><i class="fa fa-warning" title="Report"></i></a></li>';

    post += '<li><a href="#followUnfollow' + data1.postId + '" role="tab" data-toggle="tab"><i class="fa fa-globe" title="Follow/Unfollow Post"></i></a></li>';

    post += '</ul>';

    post += '<!-- Tab panes -->';

    post += '<div class="tab-content">';

    post += '<div class="tab-pane active" id="mailPost' + data1.postId + '">';

    post += '<div>';

    post += '<p class="text-center">Please enter the emailId of the recipient.</p>';

    post += '<form class="form-horizontal text-center" role="form">';

    post += '<div class="coml-md-10 col-md-offset-1">';

    post += '<div class="form-group">';

    post += '<input type="text" value="' + data1.postUserId + '@iiitdm.ac.in" name="mailTo" class="form-control input-md" id="inputEmailPost" placeholder="Email">';

    post += '</div>';

    post += '</div>';

    post += '<div class="col-md-1 col-md-offset-6">';

    post += '<div class="form-group">';

    post += '<button type="button" id="mailPostButton" class="btn btn-success" onclick="mailPost(\'' + data1.postId + '\');"><i class="fa fa-envelope"></i>&nbsp;Mail</button>';

    post += '</div>';

    post += '</div>';

    post += '</form>';

    post += '<br/>';

    post += '</div>';

    post += '</div>';

    if (data1.postOwner == 1) {

        post += '<div class="tab-pane" id="deletePost' + data1.postId + '">';

        post += '<p class="text-center">This action cannot be reverted.</p>';

        post += '<div class="text-center">';

        post += '<button type="button" class="btn btn-primary" onclick="deletePost(\'' + data1.postId + '\');"><i class="fa fa-trash"></i>&nbsp;Delete</button>';

        post += '</div>';

        post += '<br/><br/>';

        post += '</div>';
    }

    post += '<div class="tab-pane" id="hidePost' + data1.postId + '">';

    post += '<p class="text-center">Once you hide the post you will not see the post again. This action is not revertable.</p>';

    post += '<div class="text-center">';

    post += '<button type="button" class="btn btn-danger" onclick="hidePost(\'' + data1.postId + '\');"><i class="fa fa-lock"></i>&nbsp;Hide</button>';

    post += '</div>';

    post += '<br/><br/><br/><br/>';

    post += '</div>';

    post += '<div class="tab-pane" id="reportPost' + data1.postId + '">';

    post += '<p class="text-center">On reporting the post will be hidden from you and the post will be sent for admin review.</p>';

    // post+='<form class="form-horizontal text-center">';

    post += '<div class="coml-md-10 col-md-offset-1">';

    // post+=' <div class="form-group">';

    post += '<textarea type="email" style="resize:none;" name="reportText" class="form-control input-md" id="inputReport" placeholder="Reason"></textarea>';

    // post+='</div>';

    post += '</div>';

    post += '<div class="col-md-2 col-md-offset-5 text-center">';

    // post+='<div class="form-group">';

    post += '<button class="btn btn-success" onclick="reportPost(\'' + data1.postId + '\');"><i class="fa fa-warning"></i>Report</button>';

    // post+='</div>';

    post += '<br/><br/></div>';

    // post+='</form>';

    post += '<br/>';

    post += '</div>';

    post += '<div class="tab-pane" id="followUnfollow' + data1.postId + '">';

    post += '<br/>On following you will be receiving notifications for all the actions related to the posts.';

    post += '<div class="text-center">';

    if (data1.followPost == 1) {
        post += '<button type="button" class="btn btn-primary" onclick="followPost(\'' + data1.postId + '\');">FOLLOW</button>';
    } else if (data1.followPost == -1) {
        post += '<button type="button" class="btn btn-primary" onclick="followPost(\'' + data1.postId + '\');">UNFOLLOW</button>';
    }

    post += '</div>';

    post += '<br/><br/><br/><br/>';

    post += '</div>';

    post += '</div>';

    post += '</div><!-- end class col-md- 10 -->';

    post += '<div class="col-md-1 col-md-offset-2">';

    post += '<div class="fontSize13"><i class="fa fa-mail-reply"></i></div>';

    post += '</div>				';

    post += '</div><!-- end class row -->';

    post += '</div><!-- end id back -->';

    post += '</div> <!-- END CLASS ROW ID POST -->';


    if (position == "last") {
        $('#postArea').append(post).hide().fadeIn('slow');
    } else if (position == "first") {
        $('#postArea').prepend(post).hide().fadeIn('slow');
    }
}

function retrieveComments(id)
{
    alert("called");

    $.post('./handlers/postHandlers/loadAllComments.php',{
        _postId:id
    })
    .error(function(){
        alert("Server overload. Please try again. :(");
    })
    .success(function(data){
        data=data.trim();
        // console.log(data);
        x=JSON.parse(data);
        $('#'+id).find('.postComments').html("");
        for(i=0;i<x.length;i++)
        {
            commentInsert("last",x[i],id);
        }
    });

}









function mailPost(id, event) {
    // alert("CLICKED");
    var email = $('#' + id).find('#inputEmailPost').val().trim();
    $('#'+id).find('#mailPostButton').html("Mailing").attr("onclick","");
    var done=1;
    if(email.length==0)
    {
        alert("Please tell us to whom the post is to be mailed to. :)");
        done=0;
    }
    if(done==1)
    {
        $.post('./handlers/postHandlers/mailPost.php', {
        _emailId: email,
        _postId: id
        })
        .error(function() {
            alert("Unable to mail post with id " + id);
        })
        .success(function(data) {
            alert(data);
            if(checkData(data)==1)
            {
                alert("Mailed successfully");
                $('#' + id).find('#mailCount').html(data);
                $('#'+id).find('#mailPostButton').html('<i class="fa fa-envelope"></i>&nbsp;Mail').attr("onclick","mailPost("+id+")");
                
                $('#'+id).find(".back").hide();
                $('#'+id).find(".front").show();
            }
            
        });
    }
    
}

function deletePost(id) {
    $.post('./handlers/postHandlers/deletePost.php', {
        _postId: id
    })
        .error(function() {

        })
        .success(function(data) {
            data = data.trim();
            if (data == 13) {
                alert("Don't mess with 4pi");
                window.location.href = "4pi/index.php";
            } else if (data == 12) {
                alert("Database error. Admin has been notified");
            } else if (data == 14) {
                alert("You have been blocked for messing with 4pi");
                window.location.href = "4pi/index.php";
            } else if (data == 3) {

                $('#postArea').find('#' + id).remove();
                alert("The post is deleted. :)");
            }
        });
}

function hidePost(id) {
    $.post('./handlers/postHandlers/hidePost.php', {
        _postId: id
    })
        .error(function() {
            alert("Server Overload. Please try later");
        })
        .success(function(data) {

            if (checkData(data) == 1) {
                $('#postArea').find('#' + id).remove();
                alert("The post is hidden from you. You will not see it anymore. :)");
            }

        });
}

function followPost(id) {
    $.post('./handlers/postHandlers/followPost.php', {
        _postId: id
    })
        .error(function() {

        })

        .success(function(data) {
            console.log(data);
            if (checkData(data) == 1) {
                html = $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html();

                if (html == "FOLLOW") {
                    $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("UNFOLLOW");
                } else {
                    $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("FOLLOW");
                }
            }

        });
}

function reportPost(id) {
    // alert("called");
    var reportContent = $('#' + id).find('#inputReport').val().trim();
    // alert(reportContent);
    var done = 1;
    if(reportContent.length==0)
    {
        alert("Please tell us the reason for reporting. :(");
        done=0;
    }
    if(done==1)
    {
        $.post('./handlers/postHandlers/reportPost.php', {
        _postId: id,
        _reason: reportContent
        })
        .error(function() {

        })
        .success(function(data) {

            console.log(data);
            // alert(data);
            
            var check=checkData(data);
            // alert(check);
            if(check==1)
            {
                $('#postArea').find('#'+id).remove();
                alert("The post has been reported. You will not see it anymore. :)");
            }
        });
    }
    
}

function insertCommentToPost(id, event) {
    if (event.keyCode == 13 && !event.shiftKey) {
        var done=1;
        var commentContent = $('#postArea').find('#' + id).find('.commentInsertArea').val().trim();
        if(commentContent.length==0)
        {
            alert("Empty comments are not allowed. :)");
            done=0;
        }
        // console.log(commentContent);
        if(done==1)
        {
            $('#postArea').find('#' + id).find('.commentInsertArea').val("");
            var x = $('#postArea').find('#' + id).find('#commentCount').html();
            y = parseInt(x);
            y = y + 1;
            $('#postArea').find('#' + id).find('#commentCount').html(y);
            $('#postArea').find('#' + id).find('.loadmoreComments').html("Commenting...").attr("onclick", "");
            $('#postArea').find('#' + id).find('.postComments').removeClass('hidden');
            $.post('./handlers/postHandlers/insertComment.php', {
                _postId: id,
                _commentContent: commentContent
            })
                .error(function() {
                    alert("Server overload error. Please try again.")
                })
                .success(function(data) {
                    //alert(data);
                    //console.log(data);
                    /*if (checkData(data) == 1) {*/

                        console.log(data);
                        var x = JSON.parse(data);
                        commentInsert("first", x, id);
                        $('.comment').each(function() {
                            $('time.timeago').timeago();
                        });
                        $('#postArea').find('#' + id).find('.loadmoreComments').html("Load All Comments").attr("onclick", "retrieveComments('" + id + "');");
                    // }
                    $('#' + id).find('#commentCount').html(data.postCommentCount);
                });
        }
        
    }

}

function editComment(postId, commentId,calslback) {
    var commentContent = $('#' + commentId).find('#' + commentId + 'b').val().trim();
    var done=1;
    if(commentContent.length==0)
    {
        alert("Empty comments are not allowed. :)");
        done=0;
    }
    //console.log(commentContent);
    if(done==1)
    {
        $.post('./handlers/postHandlers/editComment.php', {
        _postId: postId,
        _commentId: commentId,
        _commentContent: commentContent
        })
        .error(function() {

            alert("Server Overload. Please try again.:(")

        })
        .success(function(data) {
            if (checkData(data) == 1) {
                calslback(1);
            } 
            else {
                calslback(1);
            }
        });
    }
    
}

function starPost(id) {
    $('#' + id).find('#postStarIcon').removeClass('fa-star-o');
    $('#' + id).find('#postStarIcon').attr("onclick", "");
    $('#' + id).find('#postStarIcon').addClass('fa-star');
    $.post('./handlers/postHandlers/starPost.php', {
        _postId: id
    })
        .error(function() {

            alert("Server overload. Please try later");

        })
        .success(function(data) {

            if (checkData(data) == 1) {
                var x = JSON.parse(data);
                $('#' + id).find('#starCount').html(x);
            }

        });

}

function deleteComment(cid, pid) {



    $.post('handlers/postHandlers/deleteComment.php', {
        _commentId: cid,
        _postId: pid
    })
    .error(function() {
        alert("Server Overload. Please try later.");
    })
    .success(function(data) {
        if (checkData(data) == 1) {
            $('#postArea').find('#' + pid).find('.postComments').find('#' + cid).hide();
            var x = $('#postArea').find('#' + pid).find('#commentCount').html();
            y = parseInt(x);
            y = y - 1;
            $('#postArea').find('#' + pid).find('#commentCount').html(y);
        }
    });
}
$(document).ready(function() {
    $('.popOver').popover();
});

