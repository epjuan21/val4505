$(function() {
	$('.alert--dismissible').append('<button type="button" class="alert-close">X</button>');

	$('.alert-close').on('click',function(){
	  $(this).closest('.alert').hide();
	});
});