jQuery(document).ready(function(e){

    jQuery(document).on('change', '#import-file', function(){
        
        var filename = jQuery(this).val().replace(/C:\\fakepath\\/i, '');
        jQuery(document).find('#fileLabel').text(filename);
    });

    jQuery(document).find("#formStep1").validate();
    jQuery(document).find("#formStep2").validate();
    jQuery(document).find("#formStep3").validate();
    jQuery(document).find("#formStep4").validate();
    jQuery(document).find("#formStep5").validate();
    
    // <! ---- STEP #1 ---- >
    jQuery(document).on('submit', '#formStep1', function(e) {

		e.preventDefault();

		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=step1',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery('#stepCount > li:nth-child(2)').addClass('form-step-current-item');
        		jQuery("#formStepWrap").html(value.html);
        		
        		if( value.old_session !== '' )
    		    {
    		        if( value.old_session.registered_domain == 'yes' )
    		        {
    		            jQuery(document).find('#yes').prop('checked', true);
    		            jQuery(document).find('input[type="text"][name="domain_names"]').val(value.old_session.domain_names);
		                jQuery(document).find('input[type="text"][name="registration_date"]').val(value.old_session.registration_date);
    		        }
    		        else if( value.old_session.registered_domain == 'no' )
    		        {
    		            jQuery(document).find('#no').prop('checked', true);
    		        }
    		    }
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});
	
	// <! ---- STEP #2 ---- >
    jQuery(document).on('submit', '#formStep2', function(e) {

		e.preventDefault();
        
        if( jQuery('#yes').is(':checked'))
        {
            if( jQuery('input[type="text"][name="domain_names"]').val() == '' || jQuery('input[type="text"][name="registration_date"]').val() == '' )
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fields are required!',
                    text: 'Please write your Domain name & Registration date'
                });
                
                return;
            }
        }
        
		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=step2',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery('#stepCount > li:nth-child(3)').addClass('form-step-current-item');
        		jQuery("#formStepWrap").html(value.html);
        		
    		    if( value.old_session !== '' )
    		    {
    		        if( value.old_session.trademark == 'yes' )
    		        {
    		            jQuery(document).find('#yes').prop('checked', true);
    		            jQuery(document).find('input[type="text"][name="what_national_or_international_class_it_was_registered"]').val(value.old_session.what_national_or_international_class_it_was_registered);
		                jQuery(document).find('input[type="text"][name="trade_registration_date"]').val(value.old_session.trade_registration_date);
    		        }
    		        else if( value.old_session.trademark == 'no' )
    		        {
    		            jQuery(document).find('#no').prop('checked', true);
    		        }
    		    }
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});
	
	// <! ---- STEP #3 ---- >
    jQuery(document).on('submit', '#formStep3', function(e) {

		e.preventDefault();
        
        if( jQuery('#yes').is(':checked'))
        {
            if( jQuery('input[type="text"][name="what-national_or_international_class_it_was_registered"]').val() == '' || jQuery('input[type="text"][name="trade_registration_date"]').val() == '' )
            {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fields are required!',
                    text: 'Please write your Registered Trademarks Info.'
                });
                
                return;
            }
        }
        
		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=step3',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery('#stepCount > li:nth-child(4)').addClass('form-step-current-item');
        		jQuery("#formStepWrap").html(value.html);
        		
        		if( value.old_session )
    		    {
                    jQuery(document).find('[name="notes"]').val(value.old_session.notes);
    		    }
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});
	
	// <! ---- STEP #4 ---- >
    jQuery(document).on('submit', '#formStep4', function(e) {

		e.preventDefault();

		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=step4',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery('#stepCount > li:nth-child(5)').addClass('form-step-current-item');
        		jQuery("#formStepWrap").html(value.html);
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});
	
	// <! ---- STEP #5 ---- >
    jQuery(document).on('submit', '#formStep5', function(e) {

		e.preventDefault();

		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=step5',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery('#stepCount > li:nth-child(2)').removeClass('form-step-current-item');
        		jQuery('#stepCount > li:nth-child(3)').removeClass('form-step-current-item');
        		jQuery('#stepCount > li:nth-child(4)').removeClass('form-step-current-item');
        		jQuery('#stepCount > li:nth-child(5)').removeClass('form-step-current-item');
        		jQuery("#formStepWrap").html(value.html);
        		
        		Swal.fire({
                    title: 'Thank You',
                    text: value.message,
                    imageUrl: handler_object.site_url + '/wp-content/uploads/2022/09/OK.svg',
                    imageWidth: 105,
                    imageHeight: 105,
                    imageAlt: 'Success',
                });
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});
	
	// <! ---- ONE STEP BACK ---- >
	jQuery(document).on('click', '#backBtn', function(e) {

		e.preventDefault();

		jQuery('#formStepWrap').LoadingOverlay("show", {
		    background: 'rgba(0, 0, 0, 0.5)',
		    imageColor: '#fff'
		});
		
        var step_no = jQuery(this).data('goto');
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=one_step_back_func',
			dataType: 'json',
			data: { 'step_no' : step_no },
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#formStepWrap').LoadingOverlay("hide");
        		jQuery("#formStepWrap").html(value.html);
        		
        		if( value.step_on == 1 )
        		{
        		    if( value.session_data !== '' )
        		    {
    		            jQuery(document).find('input[type="text"][name="full_name"]').val(value.session_data.full_name);
    		            jQuery(document).find('input[type="tel"][name="phone_number"]').val(value.session_data.phone_number);
    		            jQuery(document).find('input[type="email"][name="your_email"]').val(value.session_data.your_email);
    		            jQuery(document).find('[name="about_your_business"]').val(value.session_data.about_your_business);
        		    }
        		    
        		    jQuery('#stepCount > li:nth-child(2)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(3)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(4)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(5)').removeClass('form-step-current-item');
        		}
        		else if( value.step_on == 2 )
        		{
        		    if( value.session_data !== '' )
        		    {
        		        if( value.session_data.registered_domain == 'yes' )
        		        {
        		            jQuery(document).find('#yes').prop('checked', true);
        		            jQuery(document).find('input[type="text"][name="domain_names"]').val(value.session_data.domain_names);
    		                jQuery(document).find('input[type="text"][name="registration_date"]').val(value.session_data.registration_date);
        		        }
        		        else if( value.session_data.registered_domain == 'no' )
        		        {
        		            jQuery(document).find('#no').prop('checked', true);
        		        }
        		    }
        		    
        		    jQuery('#stepCount > li:nth-child(3)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(4)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(5)').removeClass('form-step-current-item');
        		}
        		else if( value.step_on == 3 )
        		{
        		    if( value.session_data !== '' )
        		    {
        		        if( value.session_data.trademark == 'yes' )
        		        {
        		            jQuery(document).find('#yes').prop('checked', true);
        		            jQuery(document).find('input[type="text"][name="what_national_or_international_class_it_was_registered"]').val(value.session_data.what_national_or_international_class_it_was_registered);
    		                jQuery(document).find('input[type="text"][name="trade_registration_date"]').val(value.session_data.trade_registration_date);
        		        }
        		        else if( value.session_data.trademark == 'no' )
        		        {
        		            jQuery(document).find('#no').prop('checked', true);
        		        }
        		    }
        		    
        		    jQuery('#stepCount > li:nth-child(4)').removeClass('form-step-current-item');
        		    jQuery('#stepCount > li:nth-child(5)').removeClass('form-step-current-item');
        		}
        		else if( value.step_on == 4 )
        		{
        		    if( value.session_data !== '' || value.session_file !== '' )
        		    {
                        jQuery(document).find('[name="notes"]').val(value.session_data.notes);
        		    }
        		    jQuery('#stepCount > li:nth-child(5)').removeClass('form-step-current-item');
        		}
            }
            else
            {
                jQuery('#formStepWrap').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Unexpected Response!'
                });
            }
		});
	});

});