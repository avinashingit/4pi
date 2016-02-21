function showAlertToContinueModal() {
    $("#showContinueModal").modal("show")
}

function redirectPageToLogin() {
    window.location.href = "/4pi"
}

function checkData(t) {
    if (t = t.trim(), 12 == t) return alert(" Some technical problem. Please try again later."), -1;
    if (13 == t) return alert("You don't mess with 4pi"), window.location.href = "/4pi/index.php", -1;
    if (14 == t) return alert("You have been blocked for messing with 4pi. Contact Admin @4pi"), window.location.href = "/4pi/index.php", -1;
    if (16 == t) return alert("Invalid Input"), -1;
    if (3 == t) return 1;
    if (1 == t) return 1;
    if (11 == t) return showAlertToContinueModal(), -1;
    if (5 == t) alert("Committed action is being redone. ");
    else if (6 == t) alert("The details you have referred to are not present. ");
    else {
        if (10 != t) return 1;
        alert("Some error occurred")
    }
}

function callAfterAjax() {
    $(".postCommentIcon").click(function() {
        $(this).parent().parent().parent().parent().parent().find(".postComments").toggleClass("hidden"), $(this).parent().parent().parent().parent().parent().find(".postComments").show(500), $(this).parent().parent().parent().parent().parent().find(".loadmoreComments").toggleClass("hidden")
    }), $("#postArea").on("click", ".fa-bars", function() {
        $(this).parent().parent().parent().parent().hide(), $(this).parent().parent().parent().parent().next().removeClass("hidden"), $(this).parent().parent().parent().parent().next().show()
    }), $("#postArea").on("click", ".back .fa-mail-reply", function() {
        $(this).parent().parent().parent().parent().hide(), $(this).parent().parent().parent().parent().parent().find(".front").show()
    }), $(".post").each(function() {
        /*$(this).find("#postContent").shorten({
            showChars: 347,
            moreText: "<br/>See More",
            lessText: "",
            ellipsesText: ""
        }),*/ $("time.timeago").timeago(), $("textarea").autosize({
            "line-height": "1.3"
        })
    }), $(".starHover").mouseover(function() {
        $(this).removeClass("fa-star-o"), $(this).addClass("fa-star")
    }), $(".starHover").mouseout(function() {
        $(this).removeClass("fa-star"), $(this).addClass("fa-star-o")
    })
}

function exchange(t, e) {
    $(e).addClass("hidden").parent().find(".commentClose").removeClass("hidden"), commentDiv = $("#" + t), commentText = commentDiv.find(".commentText").html();
    var o = document.all && !document.getElementById ? document.all : 0,
        s = /-$/.test(t) ? t.replace(/-$/, "") : t + "-",
        n = o ? o[s] : document.getElementById(s);
    /-$/.test(t) ? n.innerHTML = commentText : (n.style.width = commentDiv.find("textarea").offsetWidth + 7 + "px", n.value = commentText), commentDiv.find(".commentText").css({
        display: "none"
    }), commentDiv.find("textarea").css({
        display: "block"
    }), n.style.display = "inline"
}

function exchange2(t, e, o) {
    if ("enter" == o) {
        commentDiv = $("#" + t), commentText = $(e).val(), commentTextAreaDivId = $("#" + t).find("textarea").attr("id");
        var s = document.all && !document.getElementById ? document.all : 0,
            n = /-$/.test(commentTextAreaDivId) ? commentTextAreaDivId.replace(/-$/, "") : commentTextAreaDivId + "-",
            a = s ? s[n] : document.getElementById(n);
        $(a).find(".commentText").html(/-$/.test(commentTextAreaDivId) ? commentText : commentText), commentDiv.find("textarea").css({
            display: "none"
        }), commentDiv.find(".commentText").css({
            display: "block"
        }), $("#" + t).find(".commentClose").addClass("hidden").parent().find(".commentEdit").removeClass("hidden")
    } else {
        commentDiv = $("#" + t), commentText = $(e).val(), commentTextAreaDivId = $("#" + t).find("textarea").attr("id");
        var s = document.all && !document.getElementById ? document.all : 0,
            n = /-$/.test(commentTextAreaDivId) ? commentTextAreaDivId.replace(/-$/, "") : commentTextAreaDivId + "-",
            a = s ? s[n] : document.getElementById(n);
        x = $(a).find(".commentText").html(), $(a).find(".commentText").html(/-$/.test(commentTextAreaDivId) ? x : x), commentDiv.find("textarea").css({
            display: "none"
        }), commentDiv.find(".commentText").css({
            display: "block"
        }), $("#" + t).find(".commentClose").addClass("hidden").parent().find(".commentEdit").removeClass("hidden")
    }
}

function replaceIt(t, e, o, s) {
    13 != s.keyCode || s.shiftKey ? 27 == s.keyCode && (s.preventDefault(), exchange2(e, o, "escape")) : (s.preventDefault(), m = function(t) {
        1 == t && exchange2(e, o, "enter")
    }, editComment(t, e, m))
}

function modifyPost(t, e) {
    e = JSON.parse(e);
    var o = $("#" + t);
    o.find("#postSharedWith").html(e.sharedWith), o.find("#postValidity").html(e.postValidity), o.find("#postSubject").html(e.postSubject), o.find("#postContent").html(e.postContent), o.find("#starCount").html(e.noOfStars), o.find("#commentCount").html(e.noOfComments), o.find("#mailCount").html(e.noOfMailTos), o.find("#postSeenByNumber").html(e.postSeenNumber)
}

function editPost(t) {
    $("#editPostModal").modal("show");
    var e = $(t).parent().parent().parent().parent(),
        o = e.parent().attr("id");
    $("#editPostId").html(o);
    var s = e.find("#postSubject").html();
    var postContent = e.find("#postContent").html();
    var n = e.find("#postSharedWith").html(),
        a = e.find("#postValidity").html(),
        i = e.parent().id;
    $("#editPostModal").find("#editPostLivingTime").val(a), $("#editPostModal").find("#editPostSharedWith").val(n), $("#editPostModal").find("#editPostContent").val(postContent), $("#editPostModal").find("#editPostSubject").val(s), $("#editPostModal").find("#postId").val(i), $("#editPostModal").find("#editPostContent").autosize()
}

function editedPostSend() {
    $("#editPostModal").find("#editPostButton").attr("onclick", "").html("Saving"), $("#editPostModal").find("loadingImage").removeClass("hidden");
    var t = $("#editPostModal").find("#editPostId").html().trim(),
        e = $("#editPostSubject").val().trim(),
        o = $("#editPostContent").val().trim(),
        s = 1;
    0 == o.length && (alert("Post content is to be filled"), s = 0);
    var n = $("#editPostSharedWith").val().trim();
    0 == n.length && (alert("Please tell us to whom the post should be shared with. :)"), s = 0);
    var a = $("#editPostLivingTime").val().trim();
    if (0 == a.length && (alert("You are trying to mess with 4pi. :("), s = 0), 1 == s) {
        $.post("./handlers/postHandlers/editPost.php", {
            _subject: e,
            _postContent: o,
            _share: n,
            _validity: a,
            _postId: t
        }).error(function() {
            alert("Post edit Failed")
        }).success(function(e) {
            e.trim(), $("#editPostModal").modal("hide"), 1 == checkData(e) && ($("#editPostModal").find("#editPostButton").attr("onclick", "editedPostSend()").html("Save"), $("#editPostModal").find("loadingImage").addClass("hidden"), modifyPost(t, e))
        })
    }
}

function createPost() {
    $("#createPostModal").find("#createPostButton").attr("onclick", "").html("Posting"), $("#createPostModal").find("#loadingImage").removeClass("hidden");
    var t = $("#createPostSubject").val().trim(),
        e = 1;
    t.length > 40 && (alert("Please limit the subject length to 40 characters"), e = 0);
    var o = $("#createPostContent").val().trim();
    0 == o.length ? (alert("Post content is to be filled"), e = 0) : o.length > 8e3 && (alert("Content can only have 8000 characters."), e = 0);
    var s = $("#createPostSharedWith").val().trim();
    0 == s.length && (alert("Please tell us to whom the post should be shared with"), e = 0);
    var n = $("#createPostLivingTime").val().trim();
    if (0 == n.length && (alert("You are trying to mess with 4pi. :("), e = 0), 1 == e) {
        $(".row .postMenu").find("#createPostButton").attr("data-target", "").find("a span").html("Creating post..."), $(".row .postMenu").find("#createPostButton").find(".fa-plus").addClass("fa-spin");
        var a = $.post("/4pi/handlers/postHandlers/createPost.php", {
            _subject: t,
            _postContent: o,
            _share: s,
            _validity: n
        }).error(function() {
            alert("Post Creation Failed" + a.status)
        }).success(function(t) {
            if (1 == checkData(t)) {
                t = t.trim(), $("#createPostModal").find("#createPostSubject").val(""), $("#createPostModal").find("#createPostContent").val(""), $("#createPostModal").find("#createPostSharedWith").val("All"), $("#createPostModal").find("#createPostLivingTime").val("1"), $("#createPostModal").find("#createPostModalContentLength").html("8000"), $(".row .postMenu").find("#createPostButton").attr("data-target", "#createPostModal").find("a span").html("Create Post"), $(".row .postMenu").find("#createPostButton").find(".fa-plus").removeClass("fa-spin"), $("#createPostModal").find("#createPostButton").attr("onclick", "createPost()").html("Post"), $("#createPostModal").find("#loadingImage").addClass("hidden"), $("#createPostModal").modal("hide");
                var e = JSON.parse(t);
                postInsert("first", e), callAfterAjax()
            } else $(".row .postMenu").find("#createPostButton").attr("data-target", "#createPostModal").find("a span").html("Create Post"), $(".row .postMenu").find("#createPostButton").find(".fa-plus").removeClass("fa-spin"), $("#createPostModal").find("#createPostButton").attr("onclick", "createPost()").html("Post"), $("#createPostModal").find("#loadingImage").addClass("hidden")
        })
    }
}

function retrieveLatestPosts(t, e) {
    $(".row .postMenu").find("#latestPostsButton").find("i").addClass("fa-spin"), $("#loadMorePostsButton").show(), $("#loadMorePostsButton").find("button").html("Loading"), -1 == e && $(".post").remove();
    var o = [];
    if (1 == e) {
        var s = 0;
        $(".post").each(function() {
            o[s] = $(this).attr("id"), s++
        })
    }
    $.post("./handlers/postHandlers/latest.php", {
        _posts: o,
        _postOffset: 5,
        _call: e,
        dataType: "json",
        contentType: "application/json"
    }).error(function() {}).success(function(e) {
        if ($("#inViewElement").html("999"), $(".row .postMenu").find("#latestPostsButton").find("i").removeClass("fa-spin"), $(".row .postMenu").find("#latestPostsButton").css({
                "box-shadow": "inset #000 0px 3px 0 0",
                "border-top": "1px solid black"
            }), $(".row .postMenu").find("#importantPostsButton").css({
                "box-shadow": "inset #5CB85C 0px 3px 0 0",
                "border-top": "1px solid #5CB85C"
            }), $(".row .postMenu").find("#popularPostsButton").css({
                "box-shadow": "inset #D9534F 0px 3px 0 0",
                "border-top": "1px solid #D9534F"
            }), e = e.trim(), "empty" == t && $(".post").each(function() {
                $(this).remove(), $(this).css({
                    border: "none"
                })
            }), 404 != e) {
            $("#postEmptyMessage").find("#messageEmpty").html("");
            var o = JSON.parse(e);
            for (s = 0; s < o.length; s++) {
                if (postInsert("last", o[s]), null == o[s].comments) var n = 0;
                else var n = o[s].comments.length;
                var n = o[s].comments.length;
                for (j = 0; n > j; j++) commentInsert("first", o[s].comments[j], o[s].postId)
            }
            $("#loadMorePostsButton").find("button").html("Load more posts"), callAfterAjax()
        } else 11 == e ? (alert("Please login to continue"), window.location.href = "/4pi/index.php") : 404 == e && ($("#postEmptyMessage").find("#messageEmpty").html("No posts to display."), $("#loadMorePostsButton").hide());
        contentLoadedPosts = 0, done = 1
    })
}

function retrieveImportantPosts(t, e) {
    -1 == e && $(".post").remove(), $(".row .postMenu").find("#importantPostsButton").find("i").addClass("fa-spin"), $("#loadMorePostsButton").show(), $("#loadMorePostsButton").find("button").html("Loading");
    var o = [],
        s = 0;
    $(".post").each(function() {
        o[s] = $(this).attr("id"), s++
    }), $.post("./handlers/postHandlers/important.php", {
        _posts: o,
        _call: e
    }).error(function() {}).success(function(e) {
        if ($("#inViewElement").html("997"), $(".row .postMenu").find("#importantPostsButton").find("i").removeClass("fa-spin"), $(".row .postMenu").find("#latestPostsButton").css({
                "box-shadow": "inset #428BCA 0px 3px 0 0",
                "border-top": "1px solid #428BCA"
            }), $(".row .postMenu").find("#importantPostsButton").css({
                "box-shadow": "inset #000 0px 3px 0 0",
                "border-top": "1px solid #000"
            }), $(".row .postMenu").find("#popularPostsButton").css({
                "box-shadow": "inset #D9534F 0px 3px 0 0",
                "border-top": "1px solid #D9534F"
            }), e = e.trim(), "empty" == t && $(".post").each(function() {
                $(this).remove(), $(this).css({
                    border: "none"
                })
            }), 404 != e) {
            $("#postEmptyMessage").find("#messageEmpty").html("");
            var o = JSON.parse(e);
            for (s = 0; s < o.length; s++) {
                if (postInsert("last", o[s]), null == o[s].comments) var n = 0;
                else var n = o[s].comments.length;
                for (j = 0; n > j; j++) commentInsert("first", o[s].comments[j], o[s].postId)
            }
            $("#loadMorePostsButton").find("button").html("Load more posts"), callAfterAjax()
        } else 11 == e ? (alert("Please login to continue"), window.location.href = "/4pi/index.php") : 404 == e && ($("#postEmptyMessage").find("#messageEmpty").html("No posts to display."), $("#loadMorePostsButton").hide());
        contentLoadedPosts = 0, done = 1
    })
}

function retrievePopularPosts(t, e) {
    -1 == e && $(".post").remove(), $(".row .postMenu").find("#popularPostsButton").find("i").addClass("fa-spin"), $("#loadMorePostsButton").show(), $("#loadMorePostsButton").find("button").html("Loading");
    var o = [],
        s = 0;
    $(".post").each(function() {
        o[s] = $(this).attr("id"), s++
    }), $.post("./handlers/postHandlers/popular.php", {
        _posts: o,
        _call: e
    }).error(function() {}).success(function(e) {
        if ($("#inViewElement").html("998"), $(".row .postMenu").find("#popularPostsButton").find("i").removeClass("fa-spin"), $(".row .postMenu").find("#latestPostsButton").css({
                "box-shadow": "inset #428BCA 0px 3px 0 0",
                "border-top": "1px solid #428BCA"
            }), $(".row .postMenu").find("#importantPostsButton").css({
                "box-shadow": "inset #5CB85C 0px 3px 0 0",
                "border-top": "1px solid #5CB85C"
            }), $(".row .postMenu").find("#popularPostsButton").css({
                "box-shadow": "inset #000 0px 3px 0 0",
                "border-top": "1px solid #000"
            }), e = e.trim(), "empty" == t && $(".post").each(function() {
                $(this).remove(), $(this).css({
                    border: "none"
                })
            }), 404 != e) {
            $("#postEmptyMessage").find("#messageEmpty").html("");
            var o = JSON.parse(e);
            for (s = 0; s < o.length; s++) {
                if (postInsert("last", o[s]), null == o[s].comments) var n = 0;
                else var n = o[s].comments.length;
                for (j = 0; n > j; j++) commentInsert("first", o[s].comments[j], o[s].postId)
            }
            $("#loadMorePostsButton").find("button").html("Load more posts"), callAfterAjax()
        } else 11 == e ? (alert("Please login to continue"), window.location.href = "/4pi/index.php") : 404 == e && ($("#postEmptyMessage").find("#messageEmpty").html("No posts to display."), $("#loadMorePostsButton").hide());
        contentLoadedPosts = 0, done = 1
    })
}

function commentInsert(t, e, o) {
    var s = "";
    s += '<div class="comment" id="' + e.commentIdHash + '">', s += '<div class="row">', s += '<div class="col-md-1">', s += 1 == e.profilePicExists ? '<a href="/4pi/aboutMe/index.php?userId=' + e.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/proPics/' + e.commentUserIdHash + '.jpg" title="' + e.commentUserName + '"/></a>' : "M" == e.gender ? '<a href="/4pi/aboutMe/index.php?userId=' + e.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultMan1.jpg" title="' + e.commentUserName + '"/></a>' : "F" == e.gender ? '<a href="/4pi/aboutMe/index.php?userId=' + e.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultWoman1.jpg" title="' + e.commentUserName + '"/></a>' : '<a href="/4pi/aboutMe/index.php?userId=' + e.commentUserId + '"><img style="float:left;" class="commentProfilePicture"  src="/4pi/img/defaultMan.png" title="' + e.commentUserName + '"/></a>', s += "</div>", s += '<div class="col-md-10">', s += '<div class="commentText break-word fontSize13" style="float:left;white-space:pre-wrap;">' + e.commentContent + "</div>", s += '<form><textarea id="' + e.commentIdHash + '-" name="commentedText" onkeypress="replaceIt(\'' + o + "','" + e.commentIdHash + '\',this,event,\'comment\');" class="form-control replace" style="float:left;margin-left:-24px;resize:none;"></textarea></form>', s += "</div>", "1" == e.commentOwner && (s += '<div class="col-md-1">', s += '<p class="text-center"><span class="fontSize13"><i class="fa fa-pencil commentEdit" onclick="exchange(\'' + e.commentIdHash + '\',this);" title="Edit"></i><i class="hidden fa fa-close commentClose" onclick="exchange2(\'' + e.commentIdHash + '\',this,\'escape\');" title="Cancel"></i></span>&nbsp;&nbsp;<span class="fontSize13"><i class="fa fa-trash commentDelete" title="Delete" onclick="deleteComment(\'' + e.commentIdHash + "','" + o + "');\"></i></span></p>", s += "</div>"), s += "</div>", s += '<div class="row">', s += '<div class="col-md-2 col-md-offset-10 text-right" >';
    var n = iso8601ToReadable(e.commentTime);
    s += '<time class="timeago text-center" style="font-size:9px;" title="' + n + '" datetime="' + e.commentTime + '">' + e.commentTime + "</time>", s += "</div>", s += "</div>", s += "</div> <!--end class comment -->", "first" == t ? $("#" + o).find(".postComments").prepend(s) : "last" == t && $("#" + o).find(".postComments").append(s)
}

function postInsert(t, e) {
    var o = "";
    o += '<div class="row post" style="margin-bottom:10px;" id="' + e.postId + '">', o += '<div class="front">', o += '<div id="postSharedWith" class="hidden">' + e.sharedWith + "</div>", o += 1 == e.isPermanent ? '<div id="postValidity" class="hidden">9999</div>' : '<div id="postValidity" class="hidden">' + e.postValidity + "</div>", o += '<div class="row" id="postFrontTop">', o += '<div class="col-md-4 profilePicPostsFront" id="postProfilePic">', o += 1 == e.profilePicExists ? '<h5><a href="/4pi/aboutMe/index.php?userId=' + e.postUserId + '" id="postOwnerURL"><span class="break-word" title="' + e.postUserFullName + "(" + e.postUserId + ')" id="postCreatedBy"><img  src="/4pi/img/proPics/' + e.postUserIdHash + '.jpg" class="postPPic"/>' + e.postUserName + "</span></a></h5>" : "M" == e.gender ? '<h5><a href="/4pi/aboutMe/index.php?userId=' + e.postUserId + '" id="postOwnerURL"><span class="break-word" title="' + e.postUserFullName + "(" + e.postUserId + ')" id="postCreatedBy"><img  src="/4pi/img/defaultMan1.jpg" class="postPPic"/>' + e.postUserName + "</span></a></h5>" : "F" == e.gender ? '<h5><a href="/4pi/aboutMe/index.php?userId=' + e.postUserId + '" id="postOwnerURL"><span class="break-word" title="' + e.postUserFullName + "(" + e.postUserId + ')" id="postCreatedBy"><img  src="/4pi/img/defaultWoman1.jpg" class="postPPic"/>' + e.postUserName + "</span></a></h5>" : '<h5><a href="/4pi/aboutMe/index.php?userId=' + e.postUserId + '" id="postOwnerURL"><span class="break-word" title="' + e.postUserFullName + "(" + e.postUserId + ')" id="postCreatedBy"><img  src="/4pi/img/defaultMan.png" class="postPPic"/>' + e.postUserName + "</span></a></h5>", o += "</div> <!-- end class col-md-2 id postProfile Pic -->", o += '<div class="col-md-6 col-md-offset-1 text-left">', o += '<div class="fontSize14 text-left break-word paddingTopRowPost textBold" title="Subject" id="postSubject">' + e.postSubject + "</div>", o += "</div><!-- end class col-md-6 id postSubject -->", o += '<div class="col-md-1" id="linkToPostBack">', o += '<div class="text-center paddingTopRowPost"><i class="fa fa-bars linkToPostBack" title="More Options"></i>&nbsp;&nbsp;', 1 == e.postOwner && (o += '<i class="fa fa-pencil editDelete"  data-toggle="modal"  onclick="editPost(this);" title="Edit Post"></i>'), o += "</div></div> <!-- end class col-md-1 id linkToPostBack -->", o += "</div> <!-- end class row id postfronttop-->", o += '<div class="row" >', o += '<div class="justify postContent text-center break-word" style="white-space:pre-wrap" id="postContent">' + e.postContent + "</div>", o += "</div><!-- end class row id postContent -->", o += '<div class="row" id="postAttributes">', o += '<div class="col-md-3">', o += '<div id="starCommentMail" class="postBottomRowPadding">', o += -1 == e.hasStarred ? '<p><i class="fa fa-star-o postIconsFrontFontSize" onclick="starPost(\'' + e.postId + '\');"id="postStarIcon" title="Star?"></i>&nbsp;<span id="starCount" class="attrCountPost">' + e.noOfStars + "</span>&nbsp;&nbsp;&nbsp;" : '<p><i class="fa fa-star postIconsFrontFontSize" id="postStarIcon" title="Starred"></i>&nbsp;<span id="starCount" class="attrCountPost">' + e.noOfStars + "</span>&nbsp;&nbsp;&nbsp;", o += '<i class="fa fa-comments postCommentIcon postIconsFrontFontSize" id="postCommentIcon" title="Toggle comments"></i>&nbsp;<span id="commentCount" class="attrCountPost">' + e.noOfComments + "</span>&nbsp;&nbsp;&nbsp;", o += '<i class="fa fa-envelope postIconsFrontFontSize has-warning" id="postMailIcon" title="Mailed by"></i>&nbsp;<span id="mailCount" class="attrCountPost">' + e.noOfMailTos + "</span></p>", o += "</div>", o += "</div> <!-- end class col-md-3 -->", o += '<div class="col-md-2 col-md-offset-2" >', o += "</div> <!-- end class col-md-2 -->", o += '<div class="col-md-3  text-right col-md-offset-2 postBottomRowPadding">';
    var s = iso8601ToReadable(e.postCreationTime);
    o += '<time class="timeago" sty le="font-size:12px;" datetime="' + e.postCreationTime + '" title="' + s + '">' + e.postCreationTime + "</time>", o += "</div><!-- end class col-md-2 -->", o += "</div>", o += '<div class="row" id="commentsSection">', o += '<div class="postComments text-center hidden">', o += "</div><br/> <!-- end id postComments -->", e.noOfComments > 3 && (o += '<div class="row" style="margin-bottom:5px;margin-top:-15px;">', o += '<div class="col-md-12 text-center">', o += '<button class="text-center hidden loadmoreComments btn btn-default text-center" style="cursor:pointer;" onclick="retrieveComments(\'' + e.postId + "');$(this).hide();\">Load All Comments</button>", o += "</div>", o += "</div>"), o += '<div class="row">', o += '<div class="col-md-1 profilePicPostsFront">';
    var n = $("#userDetails").find("#userImage").find("img").attr("src");
    o += '<a href="/4pi/aboutMe/index.php?userId=' + e.postUserId + '"><img style="float:left;"src="' + n + '" class="commentProfilePicture"/></a>', o += "</div>", o += '<div class="col-md-11">', o += '<form id="commentInsertForm">', o += '<textarea  rows="1" name="commentedText" id="commentInsertArea" onkeypress="insertCommentToPost(\'' + e.postId + '\',event);" class="commentInsertArea form-control" style="float:left;resize:none;"></textarea>', o += "</form>", o += "</div>", o += "</div><!-- end class row -->", o += "<br/>", o += "</div><!-- end id commentsSection -->", o += "</div> <!-- END ID FRONT -->", o += '<div class="back hidden">', o += "<br/>", o += '<div class="row">', o += '<div class="col-md-6 col-md-offset-3">', o += '<ul class="nav nav-tabs" role="tablist" id="myTab">', o += '<li class="active"><a href="#mailPost' + e.postId + '" role="tab" data-toggle="tab"><i class="fa fa-envelope" title="Mail Post"></i></a></li>', 1 == e.postOwner && (o += '<li><a href="#deletePost' + e.postId + '" role="tab" data-toggle="tab"><i class="fa fa-trash" title="Delete Post"></i></a></li>'), o += '<li><a href="#hidePost' + e.postId + '" role="tab" data-toggle="tab"><i class="fa fa-lock" title="Hide Post"></i></a></li>', o += '<li><a href="#reportPost' + e.postId + '" role="tab" data-toggle="tab"><i class="fa fa-warning" title="Report"></i></a></li>', o += '<li><a href="#followUnfollow' + e.postId + '" role="tab" data-toggle="tab"><i class="fa fa-globe" title="Follow/Unfollow Post"></i></a></li>', o += "</ul>", o += "<!-- Tab panes -->", o += '<div class="tab-content">', o += '<div class="tab-pane active" id="mailPost' + e.postId + '">', o += "<div>", o += '<br/><p class="text-center">Please enter the email id of the recipient.</p><br/>', o += '<form class="form-horizontal text-center" role="form">', o += '<div class="coml-md-10 col-md-offset-1">', o += '<div class="form-group">', o += '<input type="text" value="' + userId + '@iiitdm.ac.in" name="mailTo" class="form-control input-md" id="inputEmailPost" placeholder="Email">', o += "</div>", o += "</div>", o += '<div class="col-md-1 col-md-offset-5 text-center">', o += '<div class="form-group">', o += '<br/><button type="button" id="mailPostButton" class="btn btn-success" onclick="mailPost(\'' + e.postId + '\');"><i class="fa fa-envelope"></i>&nbsp;Mail</button>', o += "<br/><br/></div>", o += "</div>", o += "</form>", o += "<br/>", o += "</div>", o += "</div>", 1 == e.postOwner && (o += '<div class="tab-pane" id="deletePost' + e.postId + '">', o += '<br/><p class="text-center">This action cannot be reverted.</p><br/>', o += '<div class="text-center">', o += '<button type="button" class="btn btn-primary" onclick="deletePost(\'' + e.postId + '\');"><i class="fa fa-trash"></i>&nbsp;Delete</button>', o += "</div>", o += "<br/><br/>", o += "</div>"), o += '<div class="tab-pane" id="hidePost' + e.postId + '">', o += '<br/><p class="text-center">Once you hide the post you will not see the post again. This action is not revertable.</p>', o += '<br/><div class="text-center">', o += '<button type="button" class="btn btn-danger" onclick="hidePost(\'' + e.postId + '\');"><i class="fa fa-lock"></i>&nbsp;Hide</button>', o += "</div>", o += "<br/><br/><br/><br/>", o += "</div>", o += '<div class="tab-pane" id="reportPost' + e.postId + '">', o += '<br/><p class="text-center">On reporting, the post will be hidden from you and the post will be sent for admin review.</p>', o += '<br/><div class="coml-md-10 col-md-offset-1">', o += '<textarea type="email" style="resize:none;" name="reportText" class="form-control input-md" id="inputReport" placeholder="Reason"></textarea>', o += "</div>", o += '<div class="col-md-2 col-md-offset-5 text-center">', o += '<br/><button class="btn btn-success" onclick="reportPost(\'' + e.postId + '\');"><i class="fa fa-warning"></i>&nbsp;Report</button>', o += "<br/><br/></div>", o += "<br/>", o += "</div>", o += '<div class="tab-pane" id="followUnfollow' + e.postId + '">', o += '<div class="text-center">', 1 == e.followPost ? (o += '<br/><p class="futext text-center">Follow to receive notifications for all the actions related to the post.</p>', o += '<br/><button type="button" class="btn btn-primary" onclick="followPost(\'' + e.postId + "');\">FOLLOW</button>") : -1 == e.followPost && (o += '<br/><p class="futext text-center">Unfollow to stop receiving notifications for any action related to the post.</p>', o += '<br/><button type="button" class="btn btn-primary" onclick="followPost(\'' + e.postId + "');\">UNFOLLOW</button>"), o += "</div>", o += "<br/><br/><br/><br/>", o += "</div>", o += "</div>", o += "</div><!-- end class col-md- 10 -->", o += '<div class="col-md-1 col-md-offset-2">', o += '<div class="fontSize13"><i class="fa fa-mail-reply"></i></div>', o += "</div>             ", o += "</div><!-- end class row -->", o += "</div><!-- end id back -->", o += "</div> <!-- END CLASS ROW ID POST -->", "last" == t ? $("#postArea").append(o) : "first" == t && $("#postArea").prepend(o)
}

function retrieveComments(t) {
    $.post("./handlers/postHandlers/loadAllComments.php", {
        _postId: t
    }).error(function() {
        alert("Server overload. Please try again. :(")
    }).success(function(e) {
        for (e = e.trim(), x = JSON.parse(e), $("#" + t).find(".postComments").html(""), i = 0; i < x.length; i++) commentInsert("last", x[i], t);
        $(".timeago").timeago()
    })
}

function mailPost(t) {
    var e = $("#" + t).find("#inputEmailPost").val().trim();
    $("#" + t).find("#mailPostButton").html("Mailing").attr("onclick", "");
    var o = 1;
    0 == e.length && (alert("Please tell us to whom the post is to be mailed to. :)"), o = 0), 1 == o && $.post("./handlers/postHandlers/mailPost.php", {
        _email: e,
        _postId: t
    }).error(function() {
        alert("Unable to mail post with id " + t), $("#" + t).find("#mailPostButton").html('<i class="fa fa-envelope"></i>&nbsp;Mail').attr("onclick", "mailPost('" + t + "'')")
    }).success(function(e) {
        1 == checkData(e) && (alert("Mailed successfully"), e = JSON.parse(e), $("#" + t).find("#mailCount").html(e), $("#" + t).find("#mailPostButton").html('<i class="fa fa-envelope"></i>&nbsp;Mail').attr("onclick", "mailPost('" + t + "'')"), $("#" + t).find(".back").hide(), $("#" + t).find(".front").show())
    })
}

function deletePost(t) {
    confirm("Do you want to delete the post?") && $.post("./handlers/postHandlers/deletePost.php", {
        _postId: t
    }).error(function() {}).success(function(e) {
        e = e.trim(), 1 == checkData(e) && ($("#postArea").find("#" + t).remove(), alert("The post is deleted. :)"))
    })
}

function hidePost(t) {
    confirm("The post will be hidden from you. Ok?") && $.post("./handlers/postHandlers/hidePost.php", {
        _postId: t
    }).error(function() {
        alert("Server Overload. Please try later")
    }).success(function(e) {
        1 == checkData(e) && ($("#postArea").find("#" + t).remove(), alert("The post is hidden from you. You will not see it anymore. :)"))
    })
}

function followPost(t) {
    html = $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html(), at = $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").attr("onclick"), "FOLLOW" == html ? $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html("Following").attr("onclick", "") : $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html("Unfollowing").attr("onclick", ""), $.post("./handlers/postHandlers/followPost.php", {
        _postId: t
    }).error(function() {}).success(function(e) {
        1 == checkData(e) && (html = $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html(), "Following" == html ? ($("#" + t).find(".tab-pane#followUnfollow" + t + " .futext").html("Unfollow to stop receiving notifications for any action related to the post."), $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html("UNFOLLOW").attr("onclick", at)) : ($("#" + t).find(".tab-pane#followUnfollow" + t + " .futext").html("Follow to receive notifications for all the actions related to the post."), $("#" + t).find(".tab-pane#followUnfollow" + t + " .btn").html("FOLLOW").attr("onclick", at)))
    })
}

function reportPost(t) {
    var e = $("#" + t).find("#inputReport").val().trim(),
        o = 1;
    0 == e.length && (alert("Please tell us the reason for reporting. :("), o = 0), 1 == o && $.post("./handlers/postHandlers/reportPost.php", {
        _postId: t,
        _reason: e
    }).error(function() {}).success(function(e) {
        var o = checkData(e);
        1 == o && ($("#postArea").find("#" + t).remove(), alert("The post has been reported. You will not see it anymore. :)"))
    })
}

function insertCommentToPost(t, e) {
    if (13 == e.keyCode && !e.shiftKey) {
        var o = 1,
            s = $("#postArea").find("#" + t).find(".commentInsertArea").val().trim();
        if (0 == s.length && (alert("Empty comments are not allowed. :)"), o = 0), 1 == o) {
            $("#postArea").find("#" + t).find(".commentInsertArea").val("");
            var n = $("#postArea").find("#" + t).find("#commentCount").html();
            y = parseInt(n), y += 1, $("#postArea").find("#" + t).find("#commentCount").html(y), $("#postArea").find("#" + t).find(".loadmoreComments").html("Commenting...").attr("onclick", ""), $("#postArea").find("#" + t).find(".postComments").removeClass("hidden"), $("#postArea").find("#" + t).find(".loadmoreComments").removeClass("hidden"), $.post("./handlers/postHandlers/insertComment.php", {
                _postId: t,
                _commentContent: s
            }).error(function() {
                alert("Server overload error. Please try again.")
            }).success(function(e) {
                var o = JSON.parse(e);
                commentInsert("last", o, t), $(".comment").each(function() {
                    $("time.timeago").timeago()
                }), $("#postArea").find("#" + t).find(".commentInsertArea").val(""), $("#postArea").find("#" + t).find(".loadmoreComments").html("Load All Comments").attr("onclick", "retrieveComments('" + t + "');"), $("#" + t).find("#commentCount").html(e.postCommentCount)
            })
        }
    }
}

function editComment(t, e, o) {
    var s = $("#" + e).find("#" + e + "-").val().trim(),
        n = 1;
    0 == s.length && (alert("Empty comments are not allowed. :)"), n = 0), 1 == n && $.post("./handlers/postHandlers/editComment.php", {
        _postId: t,
        _commentId: e,
        _commentContent: s
    }).error(function() {
        alert("Server Overload. Please try again.:(")
    }).success(function(t) {
        o(1 == checkData(t) ? 1 : 1)
    })
}

function starPost(t) {
    $("#" + t).find("#postStarIcon").removeClass("fa-star-o"), $("#" + t).find("#postStarIcon").attr("onclick", ""), $("#" + t).find("#postStarIcon").attr("title", "Starred"), $("#" + t).find("#postStarIcon").addClass("fa-star"), $("#" + t).find("#postStarIcon").removeClass("starHover"), $.post("./handlers/postHandlers/starPost.php", {
        _postId: t
    }).error(function() {
        alert("Server overload. Please try later")
    }).success(function(e) {
        if (1 == checkData(e)) {
            var o = JSON.parse(e);
            $("#" + t).find("#starCount").html(o)
        } else $("#" + t).find("#postStarIcon").removeClass("fa-star").addClass("fa-star-o"), $("#" + t).find("#postStarIcon").attr("onclick", "starPost('" + t + "');")
    })
}

function deleteComment(t, e) {
    confirm("The comment will be deleted. Ok?") && $.post("handlers/postHandlers/deleteComment.php", {
        _commentId: t,
        _postId: e
    }).error(function() {
        alert("Server Overload. Please try later.")
    }).success(function(o) {
        if (1 == checkData(o)) {
            $("#postArea").find("#" + e).find(".postComments").find("#" + t).hide();
            var s = $("#postArea").find("#" + e).find("#commentCount").html();
            y = parseInt(s), y -= 1, $("#postArea").find("#" + e).find("#commentCount").html(y)
        }
    })
}
var genUrl = "",
    contentLoadedPosts = 0;
$(function() {}), $(document).ready(function() {
    $(".popOver").popover()
});