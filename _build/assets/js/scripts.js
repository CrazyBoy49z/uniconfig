$(function(){
	$('#sidebar-sm').click(function(){
		if(window.matchMedia('(max-width: 992px)').matches){
			$('#sidebar').toggleClass('sidebar-show').fadeIn("slow");
			$(document).click( function(event){
				if( $(event.target).closest("#sidebar-sm").length ) 
					return;
				$("#sidebar").removeClass("sidebar-show").fadeIn("slow");
				event.stopPropagation();
			});
		}else{
		$('#sidebar').toggleClass('sidebar-sm').fadeIn("slow");
		$('#content').toggleClass('content-sm').fadeIn("slow");
		if ($('#sidebar').hasClass('sidebar-sm')){
  		$.cookie('sidebar_sm', 'true', {
        expires: 5,
        secure: true
    });
		}else{
		  $.cookie('sidebar_sm', 'false', {
        expires: 5,
        secure: true
    });
		}
		}
		return false;

		
	})
		$(document).on('af_complete', function(event, response) {
				var form = response.form;
				if (response.success) {
						// Если у формы определённый id
						if (form.attr('id') == 'auth') {
								location.reload();
						}
				}
		});
//PJax
$(document).pjax("a", '.pjax-container', {fragment: '.pjax-container'});

$('.pjax-container').on('pjax:beforeReplace', function(){
	$.pjax({
		url: window.location.href,
		container: '.sidebar-nav',
		fragment: '.sidebar-nav'
	})
})
$(document).on('pjax:start', function() { NProgress.start(); });
$(document).on('pjax:end',   function() { NProgress.done();  });
});