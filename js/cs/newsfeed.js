var done=1;
$(document).ready(function(){

        var sn = $("#userDetails");

        var posn = sn.position();          

        var windowposn = $(window).scrollTop();

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

        var windowposns = $(window).scrollTop();

        if (windowposns >= posns.top-50) {

            sns.addClass("stickTopMenu");

        }

        else {

           sns.removeClass("stickTopMenu");

        }

        /*if($(document).height()-200<=$(window).scrollTop()+$(window).height())
        {
            if(done!=0)
            {
                $('.loader').css({'display':'block'});

                //alert(inView);
                if(inView=="events")
                {
                    // var pageRetrieveUrl="./handlers/eventHandlers/";

                    retrieveLatestEvents('add',1);
                    done=0;
                }

                else if(inView=="999")
                {
                    // var pageRetrieveUrl="./handlers/postHandlers/";

                    retrieveLatestPosts('add',1);
                    done=0;
                }

                else if(inView=="997")
                {
                    retrieveImportantPosts('add',1);
                    done=0;
                }

                else if(inView=="998")
                {
                    retrievePopularPosts('add',1);
                    done=0;
                }

                /*else if(inView=="polls")
                {
                    retrieveLatestPolls('add',1);
                }

                else if(inView=="polls")
                {
                    var pageRetrieveUrl="./handlers/pollHandlers/";
                }*/
           /* }
            

        }*/

    });

    var detailsHeight=window.innerHeight;

    // $('textarea').autosize({'append':'false'});
    $(document).on('click','.fa-bars',function(){
         $(this).parent().parent().parent().parent().hide();
         $(this).parent().parent().parent().parent().next().removeClass('hidden');
         $(this).parent().parent().parent().parent().next().show();
    });
    $(document).on('click','.back .fa-mail-reply',function(){
        $(this).parent().parent().parent().parent().hide();
        $(this).parent().parent().parent().parent().parent().find('.front').show();
    });   




