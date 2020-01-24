$(function (){
	'use strict';
$("select").selectBoxIt();

	$('[placeholder]').focus(function(){
		$(this).attr('data-text',$(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function(){
$(this).attr('placeholder',$(this).attr('data-text'));
	});
//Add asterisk on Required Field
$('input').each(function(){
	if($(this).attr("required")=== "required"){
		$(this).after('<span class="asterisk">*</span>');
	
}
});
 /*  start show-pass */
var passfield=$('.password');
$('.show-pass').hover(function(){
 passfield.attr('type','text ');

},function(){
	passfield.attr('type','password');

});
/*end show-pass*/
$('.confirm').click(function(){

	return confirm('are you sure');
});
$('.cat h3').click(function(){
  $(this).next('.full-view').fadeToggle(200);
});
$('.option span').click(function(){
	$(this).addClass('active').siblings('span').removeClass('active');
	if($(this).data('view')==='full'){
		$('.cat .full-view').fadeIn(200);
	}
	else{
		$('.cat .full-view').fadeOut(200);
	}
});

});
