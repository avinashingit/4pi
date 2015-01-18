
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




