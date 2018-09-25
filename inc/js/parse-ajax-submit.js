jQuery(document).ready(function($) {
	$('#submit-parse').click(function() {
		$.post(
			ajax_object.parse_ajax_ajaxurl,{
				// wp ajax action
		    	action: 'tie_into_php',

				// vars
				hidden : $('#hidden-number').val(),
				select2: $('#getCountry').val(),
				name   : $('input[name=client-name]').val(),
				email  : $('input[name=client-email]').val(),
				file   : 'parse-ajax-submit.js',
				stg    : ajax_object.parse_ajax_url,
				serial : $('input').serialize(),

				// send the nonce along with the request
				parse_ajax_nonce: ajax_object.parse_ajax_nonce
			},
			function (response) {
				$('#the-parse-response').html(response);
				console.log(response);
			}
		);
		return false;
	});
});
