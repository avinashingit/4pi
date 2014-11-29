$(document).ready(function(){
    
    var s = $("#rightBox");
    
    var pos = s.position(); 
    
    $(window).scroll(function() {
    
        var windowpos = $(window).scrollTop();
    
        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
    
        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');
    
        if (windowpos >= pos.top-50) {
    
            s.addClass("stick");
    
            //$('#topBarNew').show();
    
           // $('#rightBox').hide();
    
            //$('#topBar').hide();

        } 

        else {

            s.removeClass("stick");

            //$('#topBarNew').hide();

            //$('#topBar').show();

            //$('#rightBox').show();

        }

        var sn = $("#userDetails");

        var posn = sn.position();          

        //console.log("HAI");

        var windowposn = $(window).scrollTop();

        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);

        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');

        if (windowposn >= posn.top-50) {

            sn.addClass("stickDetails");

            $('#posts').css({'margin-left':'16.5%'});
            $('#events').css({'margin-left':'16.5%'});
            $('#polls').css({'margin-left':'16.5%'});

        }

        else {

           sn.removeClass("stickDetails");

            $('#posts').css({'margin-left':'0%'});
            $('#events').css({'margin-left':'0%'});
            $('#polls').css({'margin-left':'0%'});

        }
		
		var sns = $(".topMenu");

        var posns = sns.position();          

        //console.log(sns);

        var windowposns = $(window).scrollTop();

        //s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);

        //s.html('<h5 class="text-center"><a href="#events"><i class="fa fa-gears"></i></a>&nbsp;<a href="#threads"><i class="fa fa-database"></i></a>&nbsp;<a href="#polls"><i class="fa fa-cubes"></i></a></h5>');

        if (windowposns >= posns.top-50) {

            sns.addClass("stickTopMenu");

            // $('#posts').css({'margin-left':'16.5%'});

        }

        else {

           sns.removeClass("stickTopMenu");

            // $('#posts').css({'margin-left':'0%'});

        }

        var no=1;
       if($(document).height()-200<=$(window).scrollTop()+$(window).height())
        {
            

            if(no==1){
                $('.loader').css({'display':'block'});

                //alert(inView);
                if(inView=="events")
                {
                    // var pageRetrieveUrl="./handlers/eventHandlers/";

                    retrieveLatestEvents('add',1);
                }

                else if(inView=="999")
                {
                    // var pageRetrieveUrl="./handlers/postHandlers/";
                    console.log("Called");
                    retrieveLatestPosts('add',1);
                }

                else if(inView=="997")
                {
                    retrieveImportantPosts('add',1);
                }

                else if(inView=="998")
                {
                    retrievePopularPosts('add',1);
                }

                /*else if(inView=="polls")
                {
                    retrieveLatestPolls('add',1);
                }

                else if(inView=="polls")
                {
                    var pageRetrieveUrl="./handlers/pollHandlers/";
                }*/
                no=2;
            }

            

        }

    });

    var detailsHeight=window.innerHeight;
	//var heightNumber = parseInt(detailsHeight) + 500 + 'px';

    //$('#userDetails').css({'height ': + ' ' + heightNumber + ' !important'});
	//$('#userDetails').css({'background-color': ' green'});
	//alert(heightNumber);



/*********************middleBlock.php js **************************/

    /*$(document).on('ready','.postComments',function(){
    $(this).addClass('hidden');
    });*/
     // $('.loadmoreComments').hide();


    $('textarea').autosize({'append':'false'});

    /*$(document).on('click','#postStarIcon',function(){
        $(this).removeClass('fa-star-o');
        $(this).addClass('fa-star');
    });*/

    /*$(document).on('ready','.back',function(){
        $(this).addClass('hidden');
    });*/

    $(document).on('click','.fa-bars',function(){
         $(this).parent().parent().parent().parent().hide();
         $(this).parent().parent().parent().parent().next().removeClass('hidden');
         $(this).parent().parent().parent().parent().next().show();
    });
    $(document).on('click','.back .fa-mail-reply',function(){
        $(this).parent().parent().parent().parent().hide();
        $(this).parent().parent().parent().parent().parent().find('.front').show();
    });

});    




