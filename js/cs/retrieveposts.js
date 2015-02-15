var genUrl = "";
var contentLoadedPosts=0;
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
        return -1;
    }
    else if(data==5)
    {
        alert("Committed action is being redone. ");
    }
    else if(data==6)
    {
        alert("The details you have referred to are not present. ");
    }
    else
    {
        return 1;
    }
}

function callAfterAjax() {
    $('.postCommentIcon').click(function() {

        //////console.log($(this).parent().parent().parent().parent().next().find('.postComments'));
        $(this).parent().parent().parent().parent().next().find('.postComments').toggleClass('hidden');
        $(this).parent().parent().parent().parent().next().find('.postComments').show(500);

        // $(this).parent().parent().parent().find('.loadmoreComments').toggleClass('hidden');
             $(this).parent().parent().parent().parent().next().find('.loadmoreComments').toggleClass('hidden');
            // $(this).parent().parent().parent().parent().next().find('.loadmoreComments').show(500);
    });
    $(".post").each(function() {
        $(this).find('#postContent').shorten({
            "showChars": 347,
            "moreText": "<br/>See More",
            "lessText": "",
            ellipsesText: "",
        });
        $('time.timeago').timeago();
        $('textarea').autosize({'line-height':'1.3'});
    });

    $(".starHover").mouseover(function(){
        $(this).removeClass('fa-star-o');
        $(this).addClass('fa-star');
    });
    $(".starHover").mouseout(function(){
        $(this).removeClass('fa-star');
        $(this).addClass('fa-star-o');
    });
}


$(function() {
    //$('#myTab a:first').tab('show');
});

function exchange(el, el2) {

    // ////console.log(el);

    $(el2).removeClass('fa-pencil').addClass('fa-question').attr("title", "Press Esc to cancel");
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
        // ////console.log($(toObj).find('.commentText').html());
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
        $('#' + el).find('.fa-close').removeClass('fa-question').addClass('fa-pencil').attr("title", "Edit");
    } 
    else {
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
        $('#' + el).find('.fa-close').removeClass('fa-question').addClass('fa-pencil').attr("title", "Edit");
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

    ////console.log(data);
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
    //////console.log(y);
    $('#editPostId').html(y);
    var subject = x.find("#postSubject").html();
    // var postContent=x.find('#postContent').html();
    // ////console.log(x.find('#postContent'));
    if (x.find("#postContent").html().length > 300) {
        postContent = x.find('#postContent').find('.shortcontent').html();
        postContent += x.find('#postContent').find('.allcontent').html();
    } else {
        postContent = x.find('#postContent').html();
    }
    // ////console.log(postContent);
    var postSharedWith = x.find('#postSharedWith').html();
    var postValidity = x.find('#postValidity').html();
    var postId = x.parent().id;
    //////console.log(subject);
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

function editedPostSend()
{

    //alert("HEll");    
    var postId = $('#editPostModal').find('#editPostId').html().trim();
    // ////console.log(postId);
    var postSubject = $('#editPostSubject').val().trim();
    //////console.log(postSubject);
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

                ////console.log(data);
                data.trim();

                
                
                $('#editPostModal').modal('hide');

                if(checkData(data)==1)
                {
                    // data=JSON.parse(data);
                    modifyPost(postId, data);
                }

                    
            }
        );
    }
}

function createPost() 
{


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

    else if(postContent.length>8000)
    {
        alert("Content can only have 8000 characters.");
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
                //console.log(data);
                ////console.log(data);
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
                    //////console.log(data);
                    var x = JSON.parse(data);
                    //////console.log(data);
                    postInsert("first", x);
                    callAfterAjax();
                }
            }
    );
    }
}

function retrieveLatestPosts(value, call) {
    $('.row .postMenu').find('#latestPostsButton').find('i').addClass('fa-spin');
    $('#loadMorePostsButton').show();
    $('#loadMorePostsButton').html("Loading");

    var posts=[];
    if(call==1)
    {
        var i=0;
        $('.post').each(function(){
            posts[i]=$(this).attr("id");
            ////console.log(posts[i]);
            i++;
        });
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
            $('#inViewElement').html("999");
            ////console.log(data);
            $('.row .postMenu').find('#latestPostsButton').find('i').removeClass('fa-spin');
            $('.row .postMenu').find('#latestPostsButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid black'});
            $('.row .postMenu').find('#importantPostsButton').css({'box-shadow':'inset #5CB85C 0px 3px 0 0','border-top':'1px solid #5CB85C'});
            $('.row .postMenu').find('#popularPostsButton').css({'box-shadow':'inset #D9534F 0px 3px 0 0','border-top':'1px solid #D9534F'});
    

            data = data.trim();
            console.log(data);
            if (value == "empty") {
                // alert(value);
                $('.post').each(function() {
                    $(this).remove();

                    $(this).css({
                        'border': 'none'
                    });
                });
            }

            if (data != 404) {
                $('#postEmptyMessage').find("#messageEmpty").html("");
                // ////console.log(data);
                var ob = JSON.parse(data);
                for (i = 0; i < ob.length; i++) {
                    postInsert('last', ob[i]);
                    if (ob[i].comments == null) {
                        var cLength = 0;
                    } else {
                        var cLength = ob[i].comments.length;
                    }
                    // var cLength = ob[i].comments.length;

                    for (j = 0; j<cLength; j++) {
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
                $('#postEmptyMessage').find('#messageEmpty').html("No posts to display.");
                $('#loadMorePostsButton').hide();
            }
            contentLoadedPosts=0;
            done=1;

        });
}

function retrieveImportantPosts(value, call) {

    $('.row .postMenu').find('#importantPostsButton').find('i').addClass('fa-spin');
    $('#loadMorePostsButton').show();
    $('#loadMorePostsButton').html("Loading");
    var posts=[];
    var i=0;
    $('.post').each(function(){
        posts[i]=$(this).attr("id");
        i++;
    });

    $.post('./handlers/postHandlers/important.php', {
        _posts:posts,
        _call: call
    })
        .error(function() {

        })
        .success(function(data) {
            $('#inViewElement').html("997");
            $('.row .postMenu').find('#importantPostsButton').find('i').removeClass('fa-spin');
            $('.row .postMenu').find('#latestPostsButton').css({'box-shadow':'inset #428BCA 0px 3px 0 0','border-top':'1px solid #428BCA'});
            $('.row .postMenu').find('#importantPostsButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid #000'});
            $('.row .postMenu').find('#popularPostsButton').css({'box-shadow':'inset #D9534F 0px 3px 0 0','border-top':'1px solid #D9534F'});
            data = data.trim();
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
                $('#postEmptyMessage').find('#messageEmpty').html("");
                // ////console.log(data);
                var ob = JSON.parse(data);
                for (i = 0; i < ob.length; i++) {
                    postInsert('last', ob[i]);
                    if (ob[i].comments == null) {
                        var cLength = 0;
                    } else {
                        var cLength = ob[i].comments.length;
                    }
                    // var cLength = ob[i].comments.length;

                    for (j = 0; j<cLength; j++) {
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
                $('#postEmptyMessage').find('#messageEmpty').html("No posts to display.");
                $('#loadMorePostsButton').hide();
            }
            contentLoadedPosts=0;
            done=1;
        });
}

function retrievePopularPosts(value, call) {
    $('.row .postMenu').find('#popularPostsButton').find('i').addClass('fa-spin');
    $('#loadMorePostsButton').show();
    $('#loadMorePostsButton').html("Loading");
    var posts=[];
    
    var i=0;
    $('.post').each(function(){
        posts[i]=$(this).attr("id");
        i++;
    });

        $.post('./handlers/postHandlers/popular.php', {
            _posts:posts,
            _call: call
        })
        .error(function() {

        })
        .success(function(data) {
            $('#inViewElement').html("998");
            $('.row .postMenu').find('#popularPostsButton').find('i').removeClass('fa-spin');
            $('.row .postMenu').find('#latestPostsButton').css({'box-shadow':'inset #428BCA 0px 3px 0 0','border-top':'1px solid #428BCA'});
            $('.row .postMenu').find('#importantPostsButton').css({'box-shadow':'inset #5CB85C 0px 3px 0 0','border-top':'1px solid #5CB85C'});
            $('.row .postMenu').find('#popularPostsButton').css({'box-shadow':'inset #000 0px 3px 0 0','border-top':'1px solid #000'});
            data = data.trim();
            ////console.log(data);
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
                $('#postEmptyMessage').find('#messageEmpty').html("");
                // ////console.log(data);
                var ob = JSON.parse(data);
                for (i = 0; i < ob.length; i++) {
                    postInsert('last', ob[i]);
                    if (ob[i].comments == null) {
                        var cLength = 0;
                    } else {
                        var cLength = ob[i].comments.length;
                    }
                    // var cLength = ob[i].comments.length;

                    for (j = 0; j<cLength; j++) {
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
                $('#postEmptyMessage').find('#messageEmpty').html("No posts to display.");
                $('#loadMorePostsButton').hide();
            }
            contentLoadedPosts=0;
            done=1;
        });
}

function commentInsert(position, data, postId)
{

    //console.log(data);

    var comment = "";

    comment += '<div class="comment" id="' + data.commentIdHash + '">';

    comment += '<div class="row">';

    comment += '<div class="col-md-1">';

    // alert(data.commentUserIdHash);

    if(data.profilePicExists==1)
    {
        comment += '<a href="/4pi/aboutMe/index.php?userId='+data.commentUserId +'"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/proPics/' + data.commentUserIdHash + '.jpg" title="' + data.commentUserName + '"/></a>';
    }

    else
    {
        if(data.gender=="M")
        {
            comment += '<a href="/4pi/aboutMe/index.php?userId='+ data.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultMan1.jpg" title="' + data.commentUserName + '"/></a>';
        }
        else if(data.gender=="F")
        {
            comment += '<a href="/4pi/aboutMe/index.php?userId='+ data.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultWoman1.jpg" title="' + data.commentUserName + '"/></a>';
        }

        else
        {
            comment += '<a href="/4pi/aboutMe/index.php?userId='+ data.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultMan.png" title="' + data.commentUserName + '"/></a>';
        }
        
    }

    

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

    var time=iso8601ToReadable(data.commentTime);

    comment += '<time class="timeago text-center" style="font-size:9px;" title="' + time + '" datetime="' + data.commentTime + '">' + data.commentTime + '</time>';

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

function postInsert(position, data1)
{
    //alert(position+" "+data);

    var post = "";

    post += '<div class="row post" style="margin-bottom:10px;" id="' + data1.postId + '">';

    post += '<div class="front">';

    post += '<div id="postSharedWith" class="hidden">' + data1.sharedWith + '</div>';

    post += '<div id="postValidity" class="hidden">' + data1.postValidity + '</div>';

    post += '<div class="row" id="postFrontTop">';

    post += '<div class="col-md-5 profilePicPostsFront" id="postProfilePic">';

    ////console.log(data1.profilePicExists);

    if(data1.profilePicExists==1)
    {
        post += '<a href="/4pi/aboutMe/index.php?userId=' + data1.postUserId + '" id="postOwnerURL"><h5 id="postCreatedBy"><img title="' + data1.postUserName + '" src="/4pi/img/proPics/' + data1.postUserIdHash + '.jpg" class="postPPic"/>' + data1.postUserName + '</h5></a>';
    }

    else
    {
        if(data1.gender=="M")
        {
            post += '<a href="/4pi/aboutMe/index.php?userId='+ data1.postUserId + '" id="postOwnerURL"><h5 id="postCreatedBy"><img title="' + data1.postUserName + '" src="/4pi/img/defaultMan1.jpg" class="postPPic"/>' + data1.postUserName + '</h5></a>';
        }

       else if(data1.gender=="F")
        {
            post += '<a href="/4pi/aboutMe/index.php?userId=' + data1.postUserId + '" id="postOwnerURL"><h5 id="postCreatedBy"><img title="' + data1.postUserName + '" src="/4pi/img/defaultWoman1.jpg" class="postPPic"/>' + data1.postUserName + '</h5></a>';
        }

        else
        {
            post += '<a href="/4pi/aboutMe/index.php?userId=' + data1.postUserId + '" id="postOwnerURL"><h5 id="postCreatedBy"><img title="' + data1.postUserName + '" src="/4pi/img/defaultMan.png" class="postPPic"/>' + data1.postUserName + '</h5></a>';
        }
    }

    

    post += '</div> <!-- end class col-md-2 id postProfile Pic -->';

    post += '<div class="col-md-4 text-center">';

    post += '<div class="fontSize14 text-left paddingTopRowPost textBold" title="Subject" id="postSubject">' + data1.postSubject + '</div>';

    post += '</div><!-- end class col-md-6 id postSubject -->';

    post += '<div class="col-md-1 col-md-offset-2" id="linkToPostBack">';

    post += '<div class="text-center paddingTopRowPost"><i class="fa fa-bars" title="More Options"></i>&nbsp;&nbsp;';

    if (data1.postOwner == 1) {
        /*          post+=data.postOwner;
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
        post += '<p><i class="fa fa-star-o postIconsFrontFontSize" onclick="starPost(\'' + data1.postId + '\');"id="postStarIcon" title="Star?"></i>&nbsp;<span id="starCount" class="attrCountPost">' + data1.noOfStars + '</span>&nbsp;&nbsp;&nbsp;';
    } else {
        post += '<p><i class="fa fa-star postIconsFrontFontSize" id="postStarIcon" title="Starred"></i>&nbsp;<span id="starCount" class="attrCountPost">' + data1.noOfStars + '</span>&nbsp;&nbsp;&nbsp;';
    }


    post += '<i class="fa fa-comments postCommentIcon postIconsFrontFontSize" id="postCommentIcon" title="Toggle comments"></i>&nbsp;<span id="commentCount" class="attrCountPost">' + data1.noOfComments + '</span>&nbsp;&nbsp;&nbsp;';

    post += '<i class="fa fa-envelope postIconsFrontFontSize has-warning" id="postMailIcon" title="Mailed by"></i>&nbsp;<span id="mailCount" class="attrCountPost">' + data1.noOfMailTos + '</span></p>';

    post += '</div>';

    post += '</div> <!-- end class col-md-3 -->';

    post += '<div class="col-md-2 col-md-offset-2" >';

    /*post += '<div id="postSeenBy" class="text-center postBottomRowPadding">';

    post += '<i class="fa fa-eye" title="Seen By"></i>&nbsp;<span id="postSeenByNumber">' + data1.postSeenNumber + '</span>';

    post += '</div> <!-- end id postSeenBy -->';*/

    post += '</div> <!-- end class col-md-2 -->';

    post += '<div class="col-md-3  text-right col-md-offset-2 postBottomRowPadding">';

    var time=iso8601ToReadable(data1.postCreationTime);

    post += '<time class="timeago" sty le="font-size:12px;" datetime="' + data1.postCreationTime + '" title="' +time+ '">' + data1.postCreationTime + '</time>';

    post += '</div><!-- end class col-md-2 -->';

    post += '</div>';

    post += '<div class="row" id="commentsSection">';

    post += '<div class="postComments text-center hidden">';

    post += '</div><br/> <!-- end id postComments -->';

    if(data1.noOfComments>3)
    {
        post+='<div class="row" style="margin-bottom:5px;margin-top:-15px;">';

        post+='<div class="col-md-12 text-center">';

            post += '<button class="text-center hidden loadmoreComments btn btn-default text-center" style="cursor:pointer;" onclick="retrieveComments(\'' + data1.postId + '\');$(this).hide();">Load All Comments</button>';

        post+='</div>';

        post+='</div>';
    }

    post += '<div class="row">';

    post += '<div class="col-md-1 profilePicPostsFront">';

    /*if(data1.profilePicExists==1)
    {
        post += '<a href="/4pi/aboutMe/index.php?userId='+userId+'"><img style="float:left;"src="/4pi/img/proPics/' + userIdHash + '.jpg" class="commentProfilePicture"/></a>';
    }
    else
    {
        if(data1.gender=="M")
        {
            post += '<a href="/4pi/aboutMe/index.php?userId='+data1.postUserId+'"><img style="float:left;"src="/4pi/img/defaultMan1.jpg" class="commentProfilePicture"/></a>';
        }

        else if(data1.gender="F")
        {
            post += '<a href="/4pi/aboutMe/index.php?userId='+data1.postUserId+'"><img style="float:left;"src="/4pi/img/defaultWoman1.jpg" class="commentProfilePicture"/></a>';
        }

        else
        {
            post += '<a href="/4pi/aboutMe/index.php?userId='+data1.postUserId+'"><img style="float:left;"src="/4pi/img/defaultMan.png" class="commentProfilePicture"/></a>';
        }
    }*/

    var imageName=$("#userDetails").find("#userImage").find('img').attr("src");

    post += '<a href="/4pi/aboutMe/index.php?userId='+data1.postUserId+'"><img style="float:left;"src="'+imageName+'" class="commentProfilePicture"/></a>';
    

    post += '</div>';

    post += '<div class="col-md-11">';

    post += '<form id="commentInsertForm">';

    post += '<textarea  rows="1" name="commentedText" id="commentInsertArea" onkeypress="insertCommentToPost(\'' + data1.postId + '\',event);" class="commentInsertArea form-control" style="float:left;resize:none;height:30px !important;"></textarea>';

    post += '</form>';

    post += '</div>';

    post += '</div><!-- end class row -->';

    post+='<br/>';

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

    post += '<br/><p class="text-center">Please enter the email id of the recipient.</p><br/>';

    post += '<form class="form-horizontal text-center" role="form">';

    post += '<div class="coml-md-10 col-md-offset-1">';

    post += '<div class="form-group">';

    post += '<input type="text" value="' + userId + '@iiitdm.ac.in" name="mailTo" class="form-control input-md" id="inputEmailPost" placeholder="Email">';

    post += '</div>';

    post += '</div>';

    post += '<div class="col-md-1 col-md-offset-5 text-center">';

    post += '<div class="form-group">';

    post += '<br/><button type="button" id="mailPostButton" class="btn btn-success" onclick="mailPost(\'' + data1.postId + '\');"><i class="fa fa-envelope"></i>&nbsp;Mail</button>';

    post += '<br/><br/></div>';

    post += '</div>';

    post += '</form>';

    post += '<br/>';

    post += '</div>';

    post += '</div>';

    if (data1.postOwner == 1) {

        post += '<div class="tab-pane" id="deletePost' + data1.postId + '">';

        post += '<br/><p class="text-center">This action cannot be reverted.</p><br/>';

        post += '<div class="text-center">';

        post += '<button type="button" class="btn btn-primary" onclick="deletePost(\'' + data1.postId + '\');"><i class="fa fa-trash"></i>&nbsp;Delete</button>';

        post += '</div>';

        post += '<br/><br/>';

        post += '</div>';
    }

    post += '<div class="tab-pane" id="hidePost' + data1.postId + '">';

    post += '<br/><p class="text-center">Once you hide the post you will not see the post again. This action is not revertable.</p>';

    post += '<br/><div class="text-center">';

    post += '<button type="button" class="btn btn-danger" onclick="hidePost(\'' + data1.postId + '\');"><i class="fa fa-lock"></i>&nbsp;Hide</button>';

    post += '</div>';

    post += '<br/><br/><br/><br/>';

    post += '</div>';

    post += '<div class="tab-pane" id="reportPost' + data1.postId + '">';

    post += '<br/><p class="text-center">On reporting, the post will be hidden from you and the post will be sent for admin review.</p>';

    // post+='<form class="form-horizontal text-center">';

    post += '<br/><div class="coml-md-10 col-md-offset-1">';

    // post+=' <div class="form-group">';

    post += '<textarea type="email" style="resize:none;" name="reportText" class="form-control input-md" id="inputReport" placeholder="Reason"></textarea>';

    // post+='</div>';

    post += '</div>';

    post += '<div class="col-md-2 col-md-offset-5 text-center">';

    // post+='<div class="form-group">';

    post += '<br/><button class="btn btn-success" onclick="reportPost(\'' + data1.postId + '\');"><i class="fa fa-warning"></i>&nbsp;Report</button>';

    // post+='</div>';

    post += '<br/><br/></div>';

    // post+='</form>';

    post += '<br/>';

    post += '</div>';

    post += '<div class="tab-pane" id="followUnfollow' + data1.postId + '">';

    

    post += '<div class="text-center">';

    if (data1.followPost == 1) {

        post += '<br/><p class="futext text-center">Follow to receive notifications for all the actions related to the post.</p>';

        post += '<br/><button type="button" class="btn btn-primary" onclick="followPost(\'' + data1.postId + '\');">FOLLOW</button>';
    } else if (data1.followPost == -1) {

        post += '<br/><p class="futext text-center">Unfollow to stop receiving notifications for any action related to the post.</p>';

        post += '<br/><button type="button" class="btn btn-primary" onclick="followPost(\'' + data1.postId + '\');">UNFOLLOW</button>';
    }

    post += '</div>';

    post += '<br/><br/><br/><br/>';

    post += '</div>';

    post += '</div>';

    post += '</div><!-- end class col-md- 10 -->';

    post += '<div class="col-md-1 col-md-offset-2">';

    post += '<div class="fontSize13"><i class="fa fa-mail-reply"></i></div>';

    post += '</div>             ';

    post += '</div><!-- end class row -->';

    post += '</div><!-- end id back -->';

    post += '</div> <!-- END CLASS ROW ID POST -->';


    if (position == "last") {

        $('#postArea').append(post);

    } 
    else if (position == "first") 
    {

        $('#postArea').prepend(post);

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
        console.log(data);
        x=JSON.parse(data);
        $('#'+id).find('.postComments').html("");
        for(i=0;i<x.length;i++)
        {
            commentInsert("last",x[i],id);
        }
        callAfterAjax();
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
        _email: email,
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
    if(confirm("Do you want to delete the post?"))
    {
        $.post('./handlers/postHandlers/deletePost.php', {
            _postId: id
        })
            .error(function() {

            })
            .success(function(data) {
                data = data.trim();
                if (checkData(data)==1)
                {
                    $('#postArea').find('#' + id).remove();
                    alert("The post is deleted. :)");
                }
            });
    }
    
}

function hidePost(id) {
    if(confirm("The post will be hidden from you. Ok?"))
    {
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
    
}

function followPost(id) {
    html = $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html();
    at   = $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').attr("onclick");
    if(html=="FOLLOW")
    {
        $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("Following").attr("onclick","");
    }
    else
    {
        $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("Unfollowing").attr("onclick","");
    }
    
    $.post('./handlers/postHandlers/followPost.php', {
        _postId: id
    })
        .error(function() {

        })

        .success(function(data) {
            ////console.log(data);
            if (checkData(data) == 1) {
                html = $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html();

                if (html == "Following") {
                     $('#'+id).find('.tab-pane#followUnfollow'+id+' .futext').html("Unfollow to stop receiving notifications for any action related to the post.")

                    $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("UNFOLLOW").attr("onclick",at);
                } 
                else {
                    $('#'+id).find('.tab-pane#followUnfollow'+id+' .futext').html("Follow to receive notifications for all the actions related to the post.")

                    $('#' + id).find('.tab-pane#followUnfollow' + id + ' .btn').html("FOLLOW").attr("onclick",at);
                }
            }

        });
}

function reportPost(id) {
    // alert("called");
    var reportContent = $('#' + id).find('#inputReport').val().trim();
    alert(reportContent);
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
        // ////console.log(commentContent);
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
                    //////console.log(data);
                    /*if (checkData(data) == 1) {*/

                        ////console.log(data);
                        var x = JSON.parse(data);
                        commentInsert("first", x, id);
                        $('.comment').each(function() {
                            $('time.timeago').timeago();
                        });

                         $('#postArea').find('#' + id).find('.commentInsertArea').val("");
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
    
    //////console.log(commentContent);
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
    $('#' + id).find('#postStarIcon').attr("title", "Starred");
    $('#' + id).find('#postStarIcon').addClass('fa-star');
    $("#"+id).find("#postStarIcon").removeClass('starHover');
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
            else
            {
                $('#' + id).find('#postStarIcon').removeClass('fa-star').addClass('fa-star-o');
                $('#' + id).find('#postStarIcon').attr("onclick", "starPost(\'"+id+"\');");
            }

        });

}

function deleteComment(cid, pid) {

    if(confirm("The comment will be deleted. Ok?"))
    {
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
}
$(document).ready(function() {
    $('.popOver').popover();
});



