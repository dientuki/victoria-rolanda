// Variables
WPOLL = {};
WPOLL.poll_id = 0;
WPOLL.poll_answer_id = '';
WPOLL.is_being_voted = false;

WPOLL.pollsL10n = {}
WPOLL.pollsL10n.show_loading = 1;
WPOLL.pollsL10n.show_fading = 1;

WPOLL.pollsL10n.ajax_url = 'wp-content/plugins/wp-polls/wp-polls.php';
WPOLL.pollsL10n.text_wait = 'Your last request is still being processed. Please wait a while ...';
WPOLL.pollsL10n.text_valid = 'Please choose a valid poll answer.';
WPOLL.pollsL10n.text_multiple = 'Maximum number of choices allowed: ';

//When User Vote For Poll 
$('.wp-polls form').submit(function(){
	
	if(!WPOLL.is_being_voted) {
		WPOLL.set_is_being_voted(true);
		WPOLL.poll_id = $(this).find("input[name='poll_id']").val();
		WPOLL.poll_answer_id = '';
		poll_multiple_ans = 0;
		poll_multiple_ans_count = 0;
		
		if($('#poll_multiple_ans_' + WPOLL.poll_id).length) {
			poll_multiple_ans = parseInt($('#poll_multiple_ans_' + WPOLL.poll_id).val());
		}
		
		$(this).find("input").each(function(i){
			if ($(this).is(':checked')) {					
				if(poll_multiple_ans > 0) {
					WPOLL.poll_answer_id = $(this).val() + ',' + WPOLL.poll_answer_id;
					poll_multiple_ans_count++;
				} else {
					WPOLL.poll_answer_id = parseInt($(this).val());
				}
			}
		});
		
		if(poll_multiple_ans > 0) {
			if(poll_multiple_ans_count > 0 && poll_multiple_ans_count <= poll_multiple_ans) {
				WPOLL.poll_answer_id = WPOLL.poll_answer_id.substring(0, (WPOLL.poll_answer_id.length-1));
				WPOLL.poll_process();
			} else if(poll_multiple_ans_count == 0) {
				WPOLL.set_is_being_voted(false);
				alert(WPOLL.pollsL10n.text_valid);
			} else {
				WPOLL.set_is_being_voted(false);
				alert(WPOLL.pollsL10n.text_multiple + ' ' + poll_multiple_ans);
			}
		} else {
			if(WPOLL.poll_answer_id > 0) {
				WPOLL.poll_process();
			} else {
				WPOLL.set_is_being_voted(false);
				alert(WPOLL.pollsL10n.text_valid);
			}
		}
	} else {
		alert(WPOLL.pollsL10n.text_wait);
	}
	return false;
});


// Process Poll
WPOLL.poll_process = function() {
	if(WPOLL.pollsL10n.show_fading) {
		$('#polls-' + WPOLL.poll_id).fadeTo('def', 0, function () {
			if(WPOLL.pollsL10n.show_loading) {
				$('#polls-' + WPOLL.poll_id + '-loading').show();
			}
			$.ajax({type: 'POST', url: WPOLL.pollsL10n.ajax_url, data: 'vote=true&poll_id=' + WPOLL.poll_id + '&poll_' + WPOLL.poll_id + '=' + WPOLL.poll_answer_id, cache: false, success: WPOLL.poll_process_success});
		});
	} else {
		if(WPOLL.pollsL10n.show_loading) {
			$('#polls-' + WPOLL.poll_id + '-loading').show();
		}
		$.ajax({type: 'POST', url: WPOLL.pollsL10n.ajax_url, data: 'vote=true&poll_id=' + WPOLL.poll_id + '&poll_' + WPOLL.poll_id + '=' + WPOLL.poll_answer_id, cache: false, success: WPOLL.poll_process_success});
	}
}

//Poll's Result (User Click "View Results" Link)
$('.wp-polls .see-results').click(function(){

	if(!WPOLL.is_being_voted) {
		WPOLL.set_is_being_voted(true);
		WPOLL.poll_id = $(this).data('poll');
		if(WPOLL.pollsL10n.show_fading) {
			$('#polls-' + WPOLL.poll_id).fadeTo('def', 0, function () {
				if(WPOLL.pollsL10n.show_loading) {
					$('#polls-' + WPOLL.poll_id + '-loading').show();
				}
				$.ajax({type: 'GET', url: WPOLL.pollsL10n.ajax_url, data: 'pollresult=' + WPOLL.poll_id, cache: false, success: WPOLL.poll_process_success});
			});
		} else {
			if(WPOLL.pollsL10n.show_loading) {
				$('#polls-' + WPOLL.poll_id + '-loading').show();
			}
			$.ajax({type: 'GET', url: WPOLL.pollsL10n.ajax_url, data: 'pollresult=' + WPOLL.poll_id, cache: false, success: WPOLL.poll_process_success});
		}
	} else {
		alert(WPOLL.pollsL10n.text_wait);
	}

	return false;
});


// Poll's Voting Booth  (User Click "Vote" Link)
// @todo: fix this
function poll_booth(current_poll_id) {
	if(!WPOLL.is_being_voted) {
		WPOLL.set_is_being_voted(true);
		WPOLL.poll_id = current_poll_id;
		if(WPOLL.pollsL10n.show_fading) {
			$('#polls-' + WPOLL.poll_id).fadeTo('def', 0, function () {
				if(WPOLL.pollsL10n.show_loading) {
					$('#polls-' + WPOLL.poll_id + '-loading').show();
				}
				$.ajax({type: 'GET', url: WPOLL.pollsL10n.ajax_url, data: 'pollbooth=' + WPOLL.poll_id, cache: false, success: WPOLL.poll_process_success});
			});
		} else {
			if(WPOLL.pollsL10n.show_loading) {
				$('#polls-' + WPOLL.poll_id + '-loading').show();
			}
			$.ajax({type: 'GET', url: WPOLL.pollsL10n.ajax_url, data: 'pollbooth=' + WPOLL.poll_id, cache: false, success: WPOLL.poll_process_success});
		}
	} else {
		alert(WPOLL.pollsL10n.text_wait);
	}
}

// Poll Process Successfully
WPOLL.poll_process_success = function(data) {
	$('#polls-' + WPOLL.poll_id).replaceWith(data);
	if(WPOLL.pollsL10n.show_loading) {
		$('#polls-' + WPOLL.poll_id + '-loading').hide();
	}
	if(WPOLL.pollsL10n.show_fading) {
		$('#polls-' + WPOLL.poll_id).fadeTo('def', 1, function () {		
			WPOLL.set_is_being_voted(false);	
		});
	} else {
		WPOLL.set_is_being_voted(false);	
	}
}

// Set is_being_voted Status
WPOLL.set_is_being_voted = function(voted_status) {
	WPOLL.is_being_voted = voted_status;
}