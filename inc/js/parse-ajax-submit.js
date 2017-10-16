jQuery(function ($) {
	$(document).ready(function () {
		$('#submit-parse').click(function () {
			$.post(
					Parse_Ajax.ajaxurl,
					{
						// wp ajax action
				    	action: 'tie_into_php',

						// vars
						hidden: $('#hidden-number').val(),
						title: $('input[name=title]').val(),
						number: $('input[name=number]').val(),
						serial: $('input').serialize(),

						// send the nonce along with the request
						parse_ajax_nonce: Parse_Ajax.parse_ajax_nonce
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