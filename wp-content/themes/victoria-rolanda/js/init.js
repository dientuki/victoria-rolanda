$(document).ready(function() {
	
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
	
	$('#ranking').jCarouselLite({
		btnNext: '.next',
		btnPrev: '.prev',
		wrapper: '.carousel-wrapper',
		element: 'ul',
		visible: 1,
		speed: $('#ranking').data('speed') ? $('#ranking').data('speed') : 500,
	    afterEnd: function(element, current) {
	    	$('#ranking div').removeClass('selected');
	    	$('#ranking div:eq(' + (current - 1) + ')').addClass('selected');
	    }				
	});	
	
	$('body').addClass('js-finished');
});