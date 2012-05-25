/**
 * Add facebook
 */
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=322236784515173";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

/**
 * Add Twitter
 */
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

$(document).ready(function() {
	
	/**
	 * Switch for specifict content page
	 */
	switch ($('body').data('page'))	{
		case 'home':			
			$('#featured-carousel').jCarouselLite({
				btnNext: '.next',
				btnPrev: '.prev',
				wrapper: '.carousel-wrapper',
				element: 'article',
				visible: 1,
				auto: $('#featured-carousel').data('auto') ? $('#featured-carousel').data('auto') : 5000,
				speed: $('#featured-carousel').data('speed') ? $('#featured-carousel').data('speed') : 500
			});
			
			$('#footer-carousel').jCarouselLite({
				btnNext: '.next',
				btnPrev: '.prev',
				wrapper: '.carousel-wrapper',
				element: 'article',
				visible: 1,
				auto: $('#footer-carousel').data('auto') ? $('#footer-carousel').data('auto') : 5000,
				speed: $('#footer-carousel').data('speed') ? $('#footer-carousel').data('speed') : 500
			});
		break;
	}
	
	/**
	 * Content in all the pages
	 */
	$('#ranking .carousel-wrapper').css('height', $('#ranking .first').height() );

	$('#ranking').jCarouselLite({
		btnNext: '.next',
		btnPrev: '.prev',
		wrapper: '.carousel-wrapper',
		element: 'ul',
		visible: 1,
		circular: false,
		speed: $('#ranking').data('speed') ? $('#ranking').data('speed') : 500,
	    afterEnd: function($element, current) {
	    	$('#ranking div').removeClass('selected');
	    	$('#ranking div:eq(' + (current) + ')').addClass('selected');
	    	var h = 0;
	    	$element.find('li').each(function(i){
	    		h += $(this).outerHeight(true);
	    	});
	    	$('#ranking .carousel-wrapper ul').css('height', h+'px');
	    	$('#ranking .carousel-wrapper').animate({height:h});
	    }				
	});	
	
	if(!Modernizr.input.placeholder){

		$('[placeholder]').focus(function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		}).blur();
		
		$('[placeholder]').parents('form').submit(function() {
		  $(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
			  input.val('');
			}
		  })
		});

	}

	$('body').addClass('js-finished');
});