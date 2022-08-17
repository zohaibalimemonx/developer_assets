jQuery(document).ready(function() {
    
    // <! - - - STEP #1 - - - >
    jQuery("#step1-form").validate();
    jQuery(document).on('submit', '#step1-form', function(event) {
		event.preventDefault();
		jQuery.LoadingOverlay("show");
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=step1',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        		jQuery("#ajax-content").html(value.html);
            }
		});
	});
   
    // <! - - - STEP #2 - - - > 
    jQuery("#step2-form").validate();
    jQuery(document).on('submit', '#step2-form', function(event) {
		event.preventDefault();
		jQuery.LoadingOverlay("show");
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=step2',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value) {
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");  
        		jQuery("#ajax-content").html(value.html);
            }
		});
	});
    
    // <! - - - STEP #3 - - - >
    jQuery("#step3-form").validate();
    jQuery(document).on('submit', '#step3-form', function(event) {
		event.preventDefault();
		jQuery.LoadingOverlay("show");
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=step3',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value) {
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");  
        		jQuery("#ajax-content").html(value.html);
            }
		});
	});
    
    // <! - - - STEP #4 - - - >
    jQuery("#step4-form").validate();
    jQuery(document).on('submit', '#step4-form', function(event) {
		event.preventDefault();
		jQuery.LoadingOverlay("show");
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=step4',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value) {
            if(value.status)
            {	
				jQuery.LoadingOverlay("hide");
                Swal.fire({icon: 'success',title: 'Thank You!',text: 'Your form has been submitted.'});
        		setTimeout(function(){ 	jQuery("#ajax-content").html(value.html); }, 2500);
            }
		});
	});
});