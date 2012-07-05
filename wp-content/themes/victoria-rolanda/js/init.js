/**
 * Add facebook
 */
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=133827663423423";
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
	
		/**
		 * Home page
		 */
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
		
		/**
		 * News page
		 */
		case 'news':
			
			/**
			 * Twitter Connect
			 */
			var ajax_url = VR.base_path + '/wp-admin/admin-ajax.php';
			var data = { action: 'stc_comm_get_display'	}
			$.post(ajax_url, data, function(response) {
				if (response != '0' && response != 0) {
					var $fieldset = $('#comment-form fieldset');
					var $fade = $('#comment-form .fade')
					$fieldset.css('height', $fieldset.height());
					$fade.fadeIn('fast', function(){

						$('#comment-user-details').hide().after(response);
						$fieldset.find('div.textarea').addClass('user-conected');
						$fieldset.animate({height: '138px'}, 750);
						$fade.fadeOut(750);									
						
					});

				}
			});
			
			sfc_update_user_details();
			
			$('#fb-user .logout').live('click', function(){ 
				FB.logout(function(response){
					window.location = window.location.href;
				});
				return false;
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

function sfc_update_user_details(){
	FB.getLoginStatus(function(response) {
		if (response.authResponse) {
			// Show their FB details TODO this should be configurable, or at least prettier...
			if (!$('#fb-user').length) {
				
				var html = new Array();
				html.push("<div id='fb-user' class='social-conect'>");
				html.push("<fb:profile-pic linked='false' uid='loggedinuser' facebook-logo='false' width='48' height='48'></fb:profile-pic>");
				html.push("<div class='user-info'><span clas='user'><fb:name linked='false' uid='loggedinuser' useyou='false'></fb:name></span> &middot; <a href='#' class='logout'>Logout</a></div>");
				html.push("<input type='hidden' name='sfc_user_id' value='"+response.authResponse.userID+"' /><input type='hidden' name='sfc_user_token' value='"+response.authResponse.accessToken+"' />");
				html.push('</div>');
				
				$('#comment-user-details').hide().after(html.join(''));
			}

			// Refresh the DOM
			FB.XFBML.parse();
		} 
	});
}