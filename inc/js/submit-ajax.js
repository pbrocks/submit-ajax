jQuery(document).ready(function($) {
    $("#submit-parse").click(function(e) {
        e.preventDefault();
        // We'll pass this variable to the PHP function example_ajax_request
        var fruit = 'Banana';
        // // This does the ajax request
        $.ajax({
            type: "POST",
			url: ajax_object.parse_ajax_url,
            // url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            data: {
                'action': 'tie_into_php',
                'fruit' : fruit,
                'parse_ajax_ajaxurl' : ajax_object.parse_ajax_url,
				'parse_ajax_nonce' : ajax_object.parse_ajax_nonce
                'random_number'    : ajax_object.random_number,
				'hidden'           : $('#hidden-number').val(),
				'name'             : $('input[name=client-name]').val(),
				'email'            : $('input[name=client-email]').val(),
				'file'             : 'submit-ajax.js',
			},
            success:function(data) {
                $( '#the-parse-response' ).html(data);
                // This outputs the result of the ajax request
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }
        });  
    });      
});
