jQuery(document).ready(function(e){

    const append_track = [];
    jQuery('#checkoutStatus').text('No Item Selected.');
    
    jQuery(document).on('change', 'input[type="checkbox"]', function(){
        
        var checkbox_cal = 0.00;
        var grand_total = 0;
        var current_row = 0;
        
        if( jQuery(this).is(':checked') )
        {
            current_row = '<tr id="'+jQuery(this).data('unique')+'"><td>'+jQuery(this).data('title')+'</td><td class="price-td">'+jQuery(this).data('price')+'</td></tr>';
            jQuery('#calTable').append(current_row);
            append_track.push( jQuery(this).data('unique') );
        }
        else
        {
            if(jQuery.inArray(jQuery(this).data('unique'), append_track) !== -1)
            {
                jQuery(document).find('#'+jQuery(this).data('unique')).remove();
                append_track.splice(append_track.indexOf( jQuery(this).data('unique') ), 1);
            }
        }
        
        if( append_track.length == 0 )
        {
            jQuery('#checkoutStatus').text('No Item Selected.');
        }
        else
        {
            jQuery('#checkoutStatus').text(' ');
        }
        
        jQuery('#calculatePrice').find(':checkbox:checked').each(function(i) {
            checkbox_cal = checkbox_cal + jQuery(this).data('price');
        });
        
        grand_total = checkbox_cal;
        
        jQuery(document).find('#grandTotalCost').text('$'+grand_total);
        jQuery('#calculatePrice').find('input[type="hidden"][name="grand_total_hidden"]').val(grand_total);
        
    });


    // AJAX CALL
    
    
    jQuery(document).on('click', 'input[type="button"]', function(e){
        e.preventDefault();
        
        jQuery('#getPersonalInfo').slideDown();
        jQuery(this).attr('type', 'submit');
    });
    
    jQuery("#calculatePrice").validate();
    jQuery(document).on('submit', '#calculatePrice', function(e) {

		e.preventDefault();

        if( jQuery(this).find('input[type="checkbox"').is(':checked') )
        {
            const self = jQuery(this);
            
    		jQuery('#calculatePrice').LoadingOverlay("show", {
                image       : "",
                text        : "Please Wait..."
            });
    		
            var form = jQuery(this);
    		var formData = new FormData(form[0]);
    		jQuery.ajax({
    			type: 'post',
    			url: handler_object.ajax_url+'?action=process_consultation_function_one',
    			contentType: false,
    			processData: false,
    			dataType: 'json',
    			data: formData,
    		})
    		.done(function(value){
                if(value.status)
                {
            		jQuery('#calculatePrice').LoadingOverlay("hide");
            		self[0].reset();
            		Swal.fire({
                        icon: 'success',
                        title: "Successfully Submitted!",
                        text: value.message,
                    }).then(function() {
                      location.reload();
                    });
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: "Oops!",
                        text: value.message,
                    });
                }
    		});
        }
        else
        {
            Swal.fire({
                icon: 'error',
                title: "Invalid Input",
                text: 'Please Select At Least One Item!',
            });
        }

	});

});