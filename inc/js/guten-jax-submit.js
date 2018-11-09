jQuery(document).ready(function($) {
    $("#gutijax-butt").click(function(e) {
    	// var kiml = guten_ajax_object.guten_nerd;
    	// alert('gutijax-butt '+kiml);
        e.preventDefault();
        // We'll pass this variable to the PHP function example_ajax_request
        var fruit = 'Banana';
    	// alert('fruit');

        // // This does the ajax request
        $.ajax({
            type: "POST",
            url: guten_ajax_object.guten_ajax_ajaxurl,
            // url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            data: {
                'action': 'tie_into_guten',
                'fruit' : fruit,
                'something_imp': $('#the-guten-form').serialize(),
                'name': $('#client-name').val(),
                'email': $('#client-email').val(),
                'guten_nurd' : guten_ajax_object.guten_nerd,
                'guten_ajax_ajaxurl' : guten_ajax_object.guten_ajax_ajaxurl,
                // 'guten_ajax_nonce' : guten_ajax_object.guten_ajax_nonce,
            },
            success:function(data) {
                $( '#the-guten-response' ).html(data);
                // This outputs the result of the ajax request
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }
        });  
    });      
});
