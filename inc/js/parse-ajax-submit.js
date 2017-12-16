jQuery(function ($) {
	$(document).ready(function () {
		$('#submit-parse').click(function () {
			$.post(
				ajax_object.parse_ajax_ajaxurl,
				{
					// wp ajax action
			    	action: 'tie_into_php',

					// vars
					hidden: $('#hidden-number').val(),
					title : $('input[name=title]').val(),
					number: $('input[name=number]').val(),
					file  : 'parse-ajax-submit.js',
					stg   : ajax_object.parse_ajax_url,
					notes   : ajax_object.get_notes,
					// serial: $('input').serialize(),

					// send the nonce along with the request
					parse_ajax_nonce: ajax_object.parse_ajax_nonce
				},
				function (response) {
					$( '#the-parse-response' ).html( response );
					console.log(response);
				}
			);
			return false;
		});
	});
});