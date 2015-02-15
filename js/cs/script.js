
$('.subsec').hide();//to hide all hostel secretary tabs
$('.ew').hide();//to hide the executive wing tab
 
function validateTime(str)
{
	var parts=str.split(":");
	if(parts.length!=2)
	{
		return -1;
	}
	else
	{
		if(parts[0]<0 || parts[0]>23)
		{
			return -1;
		}

		else if(parts[1]<0 ||parts[1]>59)
		{
			return -1;
		}

		else 
		{
			return 1;
		}
	}
}


function validateDate(str)
{
	var parts=str.split("/");
	var arrayOfDates=[31,28,31,30,31,30,31,31,30,31,30,31];
	var arrayOfLDates=[31,29,31,30,31,30,31,31,30,31,30,31];
	if(parts.length!=3)
	{
		return -1;
	}
	else
	{
		if(parts[1]<1 || parts[1]>12)
		{
			return -1;
		}
		else if(parts[2]<2014)
		{
			return -1;
		}
		else if(parts[2]%4==0)
		{
			if(parts[0]<0 || parts[0]>arrayOfLDates[parts[1]-1])
			{
				return -1;
			}
		}
		else if(parts[2]%4!=0)
		{
			if(parts[0]<0 || parts[0]>arrayOfDates[parts[1]-1])
			{
				return -1;
			}
		}

		else
		{
			return 1;
		}
	}
	
}


function iso8601ToReadable(str)
{
	var parts=str.split("T");
	var date=parts[0].split("-");
	var part=parts[1].split("+");
	var time=part[0];
	var months=['January','February','March','April','May','June','July','August','September','October','November','December'];

	var result="";
	result+=date[2]+" "+months[date[1]-1]+" "+date[0]+" at "+ time;
	return result;
}


function userLogin(){
	var username=$('#loginUsername').val();
	var password=$('#loginPassword').val();

	var error=0;

	if(username.length==0 || password.length==0)
	{
		error=1;

		$('#loginError').html("Username or password cannot be empty");
	}

	if(error==0)
	{
		//alert("called");
		$.post('/4pi/loginBackend.php',{
			_username:username,
			_password:password
		})
		
		.error(function(data){
			alert("Server Overload. Please try after a few seconds"+data);
			//return false;
		})
		
		.success(function (data){
		data = data.trim();
		alert(data);
		////alert(data);
		//alert(data.length);
			if(data=="-1")
			{
				$('#loginError').html("Username or password wrong!!!");
			}
			else if(data=="9")
			{
				alert("Hey, don't you know that you are blocked??Contact administrator");
			}
			else if(data=="22")
			{
				alert("Server overload. Please try again. :(");
			}
			else if(data=="1")
			{
				//alert("asdf");
				window.location.href="newsfeed.php";
			}
		});
	}
	
}
   
   
$(document).ready(function()
  {
  
  

  
  
  
  
/*                                     ABOUT ME                     */

	$('.contentTabs').click(function () {
		
		var tabId = $(this).attr('data-target');
		
		//$('.leftMenItemHover').removeClass('leftMenItemHover');
		//$('li.active').removeClass('active');
		
		
		$('.contentTabs').parent().removeClass('active');
		
		$('.contentTabs').find('.leftMenItem').removeClass('leftMenItemHover');
		
		$('[data-target="'+tabId+'"]').find('.leftMenItem')
			{
				$('[data-target="'+tabId+'"]').find('.leftMenItem').addClass('leftMenItemHover');
			}
		
		$('[data-target="'+tabId+'"]').parent().hasClass('aboutTab')
			{
				$('[data-target="'+tabId+'"]').parent().addClass('active');
			}
		
		
		
		//alert(tabId);
		var tabContent =  document.getElementById(tabId);
		//alert(tabContent.innerHTML);
		$('.tabContents').hide();
		$(tabContent).show();
		//alert("asdf");
	});
	
	$('.leftMenItem').mouseover(function () {
		//$(this).css("background-color", "black");
	});
	
	$('.leftMenItem').click(function () {
		$('.leftMenItem').removeClass('leftMenItemHover');
		$(this).addClass("leftMenItemHover");
	});

	

	
	$('.aboutTab').click(function () {
		$('.aboutTab').removeClass('active');
		$(this).addClass('active');
	});
	

	
	$('.tabContents').hide();
	$('#skills').show();


$(function () {
    $(".edittext").dblclick(function (e) {
        e.stopPropagation();
		var height = $(this).css("width");
		var width = $(this).css("height");
        height = parseInt(height) - 10;
		height = height + "px";
        var value = $(this).html();
        updateVal($(this), value, height, width);
    });
});



function updateVal(currentEle, value, width, height) {
    $(document).off('click');
    $(currentEle).html('<textarea class="thVal" type="text" style="width:'+width+';height:'+height+'" >'+value+'</textarea>');
    $(".thVal").focus();
    $(".thVal").keyup(function (event) {
        if (event.keyCode == 13) {
            $(currentEle).html($(".thVal").val().trim());
        }
    });

    //$(document).click(function () {
           //$(currentEle).html($(".thVal").val().trim());
    //});
}

/*function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea />");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
    // setup the blur event for this new textarea
    editableText.blur(editableTextBlurred);
}*/

function editableTextBlurred() {
    var html = $(this).val();
    var viewableText = $("<div>");
    viewableText.html(html);
    $(this).replaceWith(viewableText);
    // setup the click event for this new div
    viewableText.click(divClicked);
}

//$(document).ready(function() {
    //$("div").click(divClicked);
//});


$(function() {
  $("#bars li .bar").each( function( key, bar ) {
    var percentage = $(this).data('percentage');
    
    $(this).animate({
      'height' : percentage + '%'
    }, 3000);
  });
});


/*                                     ABOUT ME                     */















  
    $('.blcs').mouseover(function()
      {
        $(this).find('p').addClass('pulse animated');
        $(this).find('i').addClass('wobble animated');
      });
    
    $('.blcs').mouseout(function()
      {
        $(this).find('p').removeClass('pulse animated');
        $(this).find('i').removeClass('wobble animated');
    
      });
	  
    $('.clubs').mouseover(function()
      {
        $(this).addClass('pulse animated');
      });
    
    $('.clubs').mouseout(function()
      {
        $(this).removeClass('pulse animated');
      });
      

	$('#loginButton').mouseover(function () {
			$('#loginForm').slideDown();
		});
		
		
    $('body').click(function(e) 
	  {			
        var tg = e.target.id.toString();
   		
        var ele = e.target.className.toString();				
   

        if(ele.indexOf("aClose")<0)
          {
	        if(tg=="loginButton")
              {
				$('#loginForm').slideDown(); 
	          }
            else
              {
			    $('#loginForm').slideUp();
              }
	      }
      });				
				
    /*$('#feed').keydown(function () 
	  {		
        var feedback = document.getElementById("feed");				
        var count=document.getElementById('charCountF');				
        var len=feedback.value.length;				
        count.innerHTML = 999 - len;				
      });                
    				
    $('#qns').keydown(function () 
	  {			
        var feedback = document.getElementById("qns");				
        var count=document.getElementById('charCountQ');                
        var len=feedback.value.length;                
        count.innerHTML = 999 - len;                
      });		
	*/
	
	
	
	
	
	
	
	
	
function slashedRectWithBG( ctx, x, y, w, h, img, radius, sides, startAngle, anticlockwise)
{
   //alert("asdf");
	ctx.save(); // Save the context before we muck up its properties
  if (sides < 3) return;
  var a = (Math.PI * 2)/sides;
  a = anticlockwise?-a:a;
  ctx.save();
  ctx.translate(x,y);
  ctx.rotate(startAngle);
  ctx.moveTo(radius,0);
  for (var i = 1; i < sides; i++) {
    ctx.lineTo(radius*Math.cos(a*i),radius*Math.sin(a*i));
  }

	// Drop a shadow under this shape
	ctx.save();
	//ctx.shadowColor   = 'rgba(0,0,0,0.4)';
	//ctx.shadowOffsetX = 3;
	//ctx.shadowOffsetY = 3;
	//ctx.shadowBlur    = 15;
	//ctx.fill();
	ctx.restore();

	clippedBackgroundImage( ctx, img, w, h );
	//ctx.stroke();  // Draw our path
    ctx.closePath();
	ctx.restore(); // Put the canvas back how it was before we started
}

function clippedBackgroundImage( ctx, img, w, h )
{
	ctx.save(); // Save the context before clipping
	ctx.clip(); // Clip to whatever path is on the context

	var imgHeight = w / img.width * img.height;
	if (imgHeight < h ){
		ctx.fillStyle = '#111';
		ctx.fill();
	}
	ctx.drawImage(img,-43,-40,w,imgHeight);

	ctx.restore(); // Get rid of the clipping region
}

	
	
	
function shuffle(array) {
              var currentIndex = array.length, temporaryValue, randomIndex ;

               // While there remain elements to shuffle...
              while (0 !== currentIndex) 
			    {

                   // Pick a remaining element...
                   randomIndex = Math.floor(Math.random() * currentIndex);
                   currentIndex -= 1;
               
                   // And swap it with the current element.
                   temporaryValue = array[currentIndex];
                   array[currentIndex] = array[randomIndex];
                   array[randomIndex] = temporaryValue;
                }

             return array;
           }
	
	

	
	var hexes = document.getElementsByClassName("hex");
    var count = hexes.length;
	//alert(hexes[0].width);
	//alert(count);
	//alert(hexes[35].className.toString());
	var padding, slashSize, w, h, x, y, p, i, ctx, j;
	var images = new Array(count);
	var imageNos = new Array(36);
	
	for(i=0;i<36;i++)
		{
			imageNos[i]=i;
		}
	
	
	imageNos=shuffle(imageNos);
	//alert(imageNos);
	for(i=0;i<count;i++)
		{
			images[i] = new Image;
			j = imageNos[i] + 1;

					images[i].src = '/4pi/img/hpics/'+j.toString()+'.jpg';
			
		}
		
			$(images[35]).load(function()
				{
				    //alert(i);
					for(p=0;p<i;p++)
						{
							w = 100;
							h = 100;
							x = 42;
							y = 36;
							
							//alert(images[p].src);
							
							//var c    = document.getElementsByTagName('canvas')[0];
							ctx  = hexes[p].getContext('2d');
							
							//  = 84;
							//hexes[p].height = 72;
							
							slashedRectWithBG( ctx, x, y, w, h, images[p], 40, 6, 0, 0 );
							//context.stroke()
						}
				});




	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/****************************************	EXECUTIVE WING PAGE		*****************************/
	
	
	
		
		
		
		
		//when the executive wing tab is clicked
		$('.ew').click(function () {
			$(this).hide();//first hide itself
			
			$('.subsec').hide();//hide all hostel secretary tabs
			
			$('.isec').show();//show up the executive wing main secretaries
			
			//to make the minus icon plus
			$('.hos').find('.fa-minus-square').removeClass('fa-minus-square').addClass('fa-plus-square');
			
			//to remove the black background color for hostel main tabs
			$('.hos').removeClass('hoveredSec');
			
			//to remove the black background color for hostel sub tabs
			$('.subsec').removeClass('hoveredSec');
			
			//to remove the black background color for all other tabs
			$('.sec').removeClass('hoveredSec');
		});
		

		
		//when one of the executive main secretary tab is clicked, add black background 
		$('.sec').click(function () {
			$('.sec').removeClass('hoveredSec');
			$(this).addClass('hoveredSec');
		});
			
		
		//when one of the hostel secretary tab is clicked, add black background 
		$('.subsec').click(function () {
			$('.subsec').removeClass('hoveredSec');
			$(this).addClass('hoveredSec');
		});
		
        
		
        
		
		//when hostel main tab is clicked, unhide the hostel secretaries
		$('.hos').click(function () {
			
			//check if the clicked tab's children are already visible
			if($(this).parent().find('.subsec').is(":visible"))
				{
					//remove the white border for children
				    $(this).parent().find('.subsec').css('border-bottom', '0px');
					
					//hide children
					$(this).parent().find('.subsec').hide();
					
					//make the minus icon plus
					$(this).parent().find('.fa-minus-square').removeClass('fa-minus-square').addClass('fa-plus-square');
					
					//remove the black background color for the tab
					$(this).parent().find('.sec').removeClass('hoveredSec');
					
					//unhide the executive wing secretaries
					$('.isec').show();
					
					//hide executive wing tab
					$('.ew').hide();
				}
			else
				{
					//remove the background for all the sub secretaries
				    $('.subsec').css('border-bottom', '0px');
					
					//hide all hostel secretaries
					$('.subsec').hide();
					
					//make all the minus icons plus
					$('.fa-minus-square').removeClass('fa-minus-square').addClass('fa-plus-square');
					
					//remove the background for all hostel tabs
					$('.hos').removeClass('hoveredSec');
					
					//unhide the children
					$(this).parent().find('.subsec').show();
					
					//make plus icon minus
					$(this).find('.fa-plus-square').removeClass('fa-plus-square').addClass('fa-minus-square');
					
					//remove the background for current tab
					$(this).parent().find('.sec').addClass('hoveredSec');
					
					//add black bottom border for its children
					$(this).parent().find('.subsec').css('border-bottom', '1px solid white');
					
					//hide the ew secretaries
					$('.isec').hide();
					
					//show the executive wing tab
					$('.ew').show();
				}
			
			//to remove the black background color for hostel secretaries
			$('.subsec').removeClass('hoveredSec');

		});
		
		
		
	/****************************************	EXECUTIVE WING PAGE		*****************************/
	
	
	
	
  });	


  
  
  
  

/*******************************************TOP BAR IN NEWSFEED*************************************/  
			
/*******************************************TOP BAR IN NEWSFEED*************************************/  
                
                
        


    
				
				
