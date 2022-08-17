jQuery(document).ready(function(){
    
    jQuery("#UserLoginForm").validate();
    jQuery(document).on('submit', '#UserLoginForm', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=login_auth',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        		
        		Swal.fire({
                    icon: 'success',
                    title: "Login Success",
                    text: "Redirecting to My Account",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = value.redirect;
                });
            }
            else
            {
                jQuery.LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Username OR Password!',
                });
            }
		});
        
    });
    
    jQuery( "#UserRegisterForm" ).validate({
      rules: {
        cpassword: {
          equalTo: "#password"
        }
      }
    });
    jQuery(document).on('submit', '#UserRegisterForm', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=register_auth',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        		
        		Swal.fire({
                    icon: 'success',
                    title: "Register Success",
                    text: "Redirecting to Login",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = value.redirect;
                });
            }
            else
            {
                jQuery.LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: value.message,
                });
            }
		});
        
    });
    
    get_user_subscription_data();
    function get_user_subscription_data()
    {
        jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=get_user_subscription',
			dataType: 'json',
		})
		.done(function(value){
            if(value.status)
            {
        	    var event_card = '';	
        		jQuery.each(value.data, function(index, val) {
        		   
                    event_card += '<div class="row event-card-wrap align-items-center">';
                    event_card += '<div class="col-md-4">';
                    event_card += '<div class="event-card-feature">';
                    event_card += '<img src="'+ val.single_feature +'" alt="">';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '<div class="col-md-8">';
                    event_card += '<div class="event-card-content">';
                    event_card += '<p class="event-card-date">'+ val.single_meta_field +'</p>';
                    event_card += '<h3 class="event-card-title"><a href="'+ val.single_permalink +'">'+ val.single_title +'</a></h3>';
                    event_card += '<div class="event-card-action">';
                    event_card += '<a href="'+ val.single_permalink +'">More Info</a>';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '</div>';
                    
        		});
        		
        		jQuery('#getMyEvents').addClass('tab-active');
        		jQuery('#eventsTabContent').html(event_card);
        		
            }
            else
            {
                jQuery('#eventsTabContent').html(value.message);
            }
		});
    }
    
    jQuery(document).on('click', '#getPastEvents', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
		
        jQuery.ajax({
			type: 'post',
			url: cs_object.ajax_url+'?action=get_user_past_events',
			dataType: 'json',
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        	
        	    var event_card = '';	
        		jQuery.each(value.data, function(index, val) {
        		   
                    event_card += '<div class="row event-card-wrap align-items-center">';
                    event_card += '<div class="col-md-4">';
                    event_card += '<div class="event-card-feature">';
                    event_card += '<img src="'+ val.single_feature +'" alt="">';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '<div class="col-md-8">';
                    event_card += '<div class="event-card-content">';
                    event_card += '<p class="event-card-date">'+ val.single_meta_field +'</p>';
                    event_card += '<h3 class="event-card-title"><a href="'+ val.single_permalink +'">'+ val.single_title +'</a></h3>';
                    event_card += '<div class="event-card-action">';
                    event_card += '<a href="'+ val.single_permalink +'">More Info</a>';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '</div>';
                    event_card += '</div>';
                    
        		});
        		
        		jQuery('#getMyEvents').addClass('tab-active');
        		jQuery('#eventsTabContent').html(event_card);
        		
            }
            else
            {
                jQuery.LoadingOverlay("hide");
                jQuery('#eventsTabContent').html(value.message);
            }
		});
        
    });
    
    jQuery(document).on('click', '#getMyEvents', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
            
        get_user_subscription_data();
        
        jQuery.LoadingOverlay("hide");
        
    });
    

	
});