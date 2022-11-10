jQuery(document).ready(function(){
    
    jQuery(document).on('click', '#doInquire', function(e){
        e.preventDefault();
        jQuery(this).next().slideToggle();
    });
    
	jQuery(document).on('click', '#showPass', function(e){
		e.preventDefault();
		jQuery(this).find('i').toggleClass('fa-eye fa-eye-slash');
		
		if( jQuery(this).prev().attr('type') == 'text' )
		{
			jQuery(this).prev().attr('type', 'password');
		}
		else
		{
			jQuery(this).prev().attr('type', 'text');
		}
		
	});
	
	jQuery(document).on('click', '.action-delete', function(e){
	    e.preventDefault();
	    if (confirm('Are you sure you want to delete the listing?')) 
	    {
            var post_id = jQuery(this).data('id');
            var self = jQuery(this);
            jQuery.ajax({
    			type: 'post',
    			url: handler_object.ajax_url+'?action=user_can_delete_post',
    			dataType: 'json',
    			data: {'post_id': post_id},
    		})
    		.done(function(value){
                if(value.status)
                {
            		self.parent().parent().hide();
            		get_all_published_listing_by_user();
            		get_all_draft_listing_by_user();
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: value.message
                    });
                }
		    });
        }
	});
	
    jQuery(document).on('click', '.remove-sg', function(e){
	    e.preventDefault();
	    if ( confirm('Are you sure you want to delete the photo?') )
	    {
	        jQuery(this).parent().LoadingOverlay("show");
            var img_id = jQuery(this).data('id');
            var self = jQuery(this);
            jQuery.ajax({
    			type: 'post',
    			url: handler_object.ajax_url+'?action=delete_one_image_from_gallery',
    			dataType: 'json',
    			data: {'img_id': img_id},
    		})
    		.done(function(value){
                if(value.status)
                {
            		self.parent().hide();
            		get_all_published_listing_by_user();
            		get_all_draft_listing_by_user();
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: value.message
                    });
                }
		    });
        }
	});
	
	
    // Multistep Form Listing FORM
	
    jQuery('#listingStepOne').validate();
    jQuery('#listingStepTwo').validate();
    jQuery('#listingStepTwoA').validate();
    jQuery('#listingStepThree').validate();
    jQuery('#inquireNowForm').validate();
    jQuery('#PrimaryListingSearch').validate();
    
    jQuery("#username").on("keyup", function(){ jQuery(this).val(jQuery(this).val().toString().replace(" ","").replace(/[_\W]+/g, "_")); });
    
    // <!--- STEP 1 --->
    jQuery(document).on('submit', '#listingStepOne', function(e){
        e.preventDefault();
        
        jQuery('#listingHouseContent').LoadingOverlay("show", {
            image       : "",
            text        : "Signing In...",
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=register_new_user',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#listingHouseContent').LoadingOverlay("hide");
        		jQuery("#listingHouseContent").html(value.html);
        		
        		if( value.session_data !== '' )
        		{
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="house_name"]').val(value.session_data.house_name);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="dream_price"]').val(value.session_data.dream_price);
        		    jQuery(document).find('#listingHouseContent [name="sell_your_hourse"]').val(value.session_data.sell_your_hourse);
        		    jQuery(document).find('#listingHouseContent [name="style_of_house"]').val(value.session_data.style_of_house);
        		    
        		    jQuery.each(value.session_data.amenities, function(index, val) {
        		        
        		        if( val == 'School District' ) { jQuery(document).find('#amen1').prop('checked', true); }
        		        if( val == 'Nearby Restaurants' ) { jQuery(document).find('#amen2').prop('checked', true); }
        		        if( val == 'Access to Highway' ) { jQuery(document).find('#amen3').prop('checked', true); }
        		        if( val == 'Nearby Nature / Parks' ) { jQuery(document).find('#amen4').prop('checked', true); }
        		        if( val == 'Close to Hospital' ) { jQuery(document).find('#amen5').prop('checked', true); }
        		        if( val == 'Close to Fire Station' ) { jQuery(document).find('#amen6').prop('checked', true); }
        		        if( val == 'Hardwood floors' ) { jQuery(document).find('#amen7').prop('checked', true); }
        		        if( val == 'Pool / Jacuzzi' ) { jQuery(document).find('#amen8').prop('checked', true); }
        		        if( val == 'Big Yard' ) { jQuery(document).find('#amen9').prop('checked', true); }
        		    });
        		}
            }
            else
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		});
        
    });
    
    // <!--- STEP 2 --->
    jQuery(document).on('submit', '#listingStepTwo', function(e){
        e.preventDefault();
        
        jQuery('#listingHouseContent').LoadingOverlay("show", {
            image       : "",
            text        : "Creating New House Listing..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=listing_house_info',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#listingHouseContent').LoadingOverlay("hide");
        		jQuery("#listingHouseContent").html(value.html);
        		
        		if( value.session_data !== '' )
        		{
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="physical_address"]').val(value.session_data.physical_address);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="city_state"]').val(value.session_data.city_state);
        		    jQuery(document).find('#listingHouseContent input[type="number"][name="zip_code"]').val(value.session_data.zip_code);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="area_squarefeet"]').val(value.session_data.area_squarefeet);
        		    jQuery(document).find('#listingHouseContent [name="number_of_bedrooms"]').val(value.session_data.number_of_bedrooms);
        		    jQuery(document).find('#listingHouseContent [name="number_of_bathrooms"]').val(value.session_data.number_of_bathrooms);
        		}
            }
            else
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		});
        
    });
    
    // <!--- BACK TO STEP #1 & #2 & #3 --->
    jQuery(document).on('click', '#backwardBtn', function(e){
        e.preventDefault();
        
        jQuery('#listingHouseContent').LoadingOverlay("show");
        
        var step_no = jQuery(this).data('goto');
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=get_previous_step',
			dataType: 'json',
			data: { 'step_no' : step_no }
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#listingHouseContent').LoadingOverlay("hide");
        		jQuery("#listingHouseContent").html(value.html);
        		
        		if( step_no == 1 )
        		{
        		    jQuery(document).find('#username').val(value.session_data.user_login);
        		    jQuery(document).find('#listingHouseContent input[type="password"]').val(value.session_data.user_pass);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="first_name"]').val(value.session_data.first_name);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="last_name"]').val(value.session_data.last_name);
        		    jQuery(document).find('#listingHouseContent input[type="email"][name="email_address"]').val(value.session_data.user_email);
        		    jQuery(document).find('#listingHouseContent input[type="tel"][name="phone_number"]').val(value.session_data.phone_number);
        		}
        		else if( step_no == 2 )
        		{
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="house_name"]').val(value.session_data.house_name);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="dream_price"]').val(value.session_data.dream_price);
        		    jQuery(document).find('#listingHouseContent [name="sell_your_hourse"]').val(value.session_data.sell_your_hourse);
        		    jQuery(document).find('#listingHouseContent [name="style_of_house"]').val(value.session_data.style_of_house);
        		    
        		    jQuery.each(value.session_data.amenities, function(index, val) {
        		        
        		        if( val == 'School District' ) { jQuery(document).find('#amen1').prop('checked', true); }
        		        if( val == 'Nearby Restaurants' ) { jQuery(document).find('#amen2').prop('checked', true); }
        		        if( val == 'Access to Highway' ) { jQuery(document).find('#amen3').prop('checked', true); }
        		        if( val == 'Nearby Nature / Parks' ) { jQuery(document).find('#amen4').prop('checked', true); }
        		        if( val == 'Close to Hospital' ) { jQuery(document).find('#amen5').prop('checked', true); }
        		        if( val == 'Close to Fire Station' ) { jQuery(document).find('#amen6').prop('checked', true); }
        		        if( val == 'Hardwood floors' ) { jQuery(document).find('#amen7').prop('checked', true); }
        		        if( val == 'Pool / Jacuzzi' ) { jQuery(document).find('#amen8').prop('checked', true); }
        		        if( val == 'Big Yard' ) { jQuery(document).find('#amen9').prop('checked', true); }
        		    });
        		}
        		else if( step_no == 3 )
        		{
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="physical_address"]').val(value.session_data.physical_address);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="city_state"]').val(value.session_data.city_state);
        		    jQuery(document).find('#listingHouseContent input[type="number"][name="zip_code"]').val(value.session_data.zip_code);
        		    jQuery(document).find('#listingHouseContent input[type="text"][name="area_squarefeet"]').val(value.session_data.area_squarefeet);
        		    jQuery(document).find('#listingHouseContent [name="number_of_bedrooms"]').val(value.session_data.number_of_bedrooms);
        		    jQuery(document).find('#listingHouseContent [name="number_of_bathrooms"]').val(value.session_data.number_of_bathrooms);
        		}
            }
            else
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		});
        
    });
    

    
    // <!--- STEP 2A --->
    jQuery(document).on('submit', '#listingStepTwoA', function(e){
        e.preventDefault();
        
        jQuery('#listingHouseContent').LoadingOverlay("show", {
            image       : "",
            text        : "Processing Info..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=listing_house_additional_info',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery('#listingHouseContent').LoadingOverlay("hide");
        		jQuery("#listingHouseContent").html(value.html);
            }
            else
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		});
        
    });
    
    
    // <!--- STEP BREAK ----- FILE UPLOAD --->
    jQuery(document).on('change', '#fImage', function(){
        
        jQuery(document).find('.single-upload-progress>.perc').text('0%');
        jQuery(document).find('.single-upload-progress>.perc').removeClass('file-ok file-error');
        jQuery(document).find('.single-upload-progress>.perc').css('width', '0%');
        jQuery(document).find('#listingStepThree input[type="hidden"][name="featured_image_id"]').val(' ');
        
        var selfImage = jQuery(this);
        var selfImageVal = jQuery(this).val().replace(/C:\\fakepath\\/i, '');
		jQuery('#FinalSubmit').prop('disabled', true);
		jQuery('#singleFileUpload').addClass('uploading');
		jQuery(document).find('#fImageLabel span').text(selfImageVal);
        
        if( jQuery(this).val() !== '' )
        {
            var form = jQuery('#listingStepThree');
		    var formData = new FormData(form[0]);
		
            var single_file = jQuery(this).val();
            jQuery.ajax({
    			type: 'post',
    			url: handler_object.ajax_url+'?action=upload_single_file_func',
    			contentType: false,
    			processData: false,
    			cache: false,
    			dataType: 'json',
    			data: formData,
    			xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            jQuery(document).find('.single-upload-progress > .perc').text(parseInt(percentComplete)+'%');
                            jQuery(document).find('.single-upload-progress>.perc').css('width', parseInt(percentComplete) + '%');
                        }
                    }, false);
                    return xhr;
                },
    		})
    		.done(function(value){
                if(value.status)
                {
                    jQuery(document).find('.single-upload-progress>.perc').addClass(value.s_class);
                    jQuery(document).find('.single-upload-progress>.perc').text(value.message);
                    jQuery(document).find('#listingStepThree input[type="hidden"][name="featured_image_id"]').val(value.data);
                    selfImage.val('');
					jQuery('#FinalSubmit').prop('disabled', false);
					jQuery('#singleFileUpload').removeClass('uploading');
                }
                else
                {
                    jQuery(document).find('.single-upload-progress>.perc').addClass(value.message);
					jQuery('#FinalSubmit').prop('disabled', false);
					jQuery('#singleFileUpload').removeClass('uploading');
                }
    		});
        }
    });
    
    // <!--- STEP BREAK ----- FILE UPLOAD (MULTI) --->
    jQuery(document).on('change', '#gImage', function(){
        
        jQuery(document).find('.multi-upload-progress>.perc').text('0%');
        jQuery(document).find('.multi-upload-progress>.perc').removeClass('file-ok file-error');
        jQuery(document).find('.multi-upload-progress>.perc').css('width', '0%');
        jQuery(document).find('#listingStepThree input[type="hidden"][name="gallery_image_id"]').val(' ');
        
        var selfImage = jQuery(this);
		jQuery('#FinalSubmit').prop('disabled', true);
		var selfImageVal2 = jQuery(this)[0].files.length;
        jQuery(document).find('#gImageLabel span').text(selfImageVal2  + ' file(s) selected');
		jQuery('#multiFileUpload').addClass('uploading');
        
        if( jQuery(this).val() !== '' )
        {
            var form = jQuery('#listingStepThree');
		    var formData = new FormData(form[0]);
		
            var single_file = jQuery(this).val();
            jQuery.ajax({
    			type: 'post',
    			url: handler_object.ajax_url+'?action=upload_multiple_file_func',
    			contentType: false,
    			processData: false,
    			cache: false,
    			dataType: 'json',
    			data: formData,
    			xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            jQuery(document).find('.multi-upload-progress > .perc').text(parseInt(percentComplete)+'%');
                            jQuery(document).find('.multi-upload-progress>.perc').css('width', parseInt(percentComplete) + '%');
                        }
                    }, false);
                    return xhr;
                },
    		})
    		.done(function(value){
                if(value.status)
                {
                    jQuery(document).find('.multi-upload-progress>.perc').addClass(value.s_class);
                    jQuery(document).find('.multi-upload-progress>.perc').text(value.message);
                    jQuery(document).find('#listingStepThree input[type="hidden"][name="gallery_image_id"]').val(value.data);
                    selfImage.val('');
                    
					jQuery('#FinalSubmit').prop('disabled', false);
					jQuery('#multiFileUpload').removeClass('uploading');
                }
                else
                {
                    jQuery(document).find('.multi-upload-progress>.perc').addClass(value.message);
					jQuery('#FinalSubmit').prop('disabled', false);
					jQuery('#multiFileUpload').removeClass('uploading');
                }
    		});
        }
    });
    
    
    
    // <!--- STEP 3 --->
    jQuery(document).on('submit', '#listingStepThree', function(e){
        e.preventDefault();
        
        jQuery('#listingHouseContent').LoadingOverlay("show", {
            image       : "",
            text        : "Uploading Media, Please Wait..."
        });
        setTimeout(function(){
            jQuery('#listingHouseContent').LoadingOverlay("text", "It'll Take a While...");
        }, 5000);
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=publish_listing_info',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
        		Swal.fire({icon: 'success',title: 'Success!', text: value.message });
        		jQuery("#listingHouseContent").html(value.html);
            }
            else
            {
                jQuery('#listingHouseContent').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		})
		.fail(function(request, status, error){
		    jQuery('#listingHouseContent').LoadingOverlay("hide");
            Swal.fire({
                icon: 'error',
                title: 'Server Issue',
                text: 'Your post may have been submitted - Please check your dashboard!'
            });
		});
    });
    
    // <!--- Single Inquire Now --->
    jQuery(document).on('submit', '#inquireNowForm', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=send_new_inquire_to_owner',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        		jQuery('#inquireNowForm')[0].reset();
        		Swal.fire({icon: 'success', title: 'Done!', text: value.message });
            }
            else
            {
                jQuery.LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		});
        
    });
    
    // <!--- Single Inquire Now --->
    
    jQuery(document).on('submit', '#PrimaryListingSearch', function(e){
        e.preventDefault();
        
        jQuery.LoadingOverlay("show", {
            image       : "",
            text        : "Processing..."
        });
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=primary_listing_search_func',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
        		jQuery.LoadingOverlay("hide");
        		var listing_data = '';
                listing_data += '<div class="row">';
                
                jQuery.each(value.data, function(index, val) {
                    listing_data += '<div class="col-lg-3 col-md-4 col-sm-6">';
                    listing_data += '<div class="house-listing" onclick="window.location.href = ">';
                    listing_data += '<div class="hs-feature">';
                    listing_data += '<img src="'+val.listing_thumbnail+'" alt="Picture" class="featured-image">';
                    listing_data += '</div>';
                    listing_data += '<div class="hs-content">';
                    listing_data += '<h6 class="hs-pricing">$'+val.listing_price+'</h6>';
                    listing_data += '<p class="hs-address">'+val.listing_address+'<span>'+val.listing_citystate+', '+ val.listing_zipcode +'</span></p>';
                    listing_data += '<div class="hs-additional-details">';
                    listing_data += '<div class="hsad-box">';
                    listing_data += '<img src="'+val.site_url+'/wp-content/uploads/2022/06/listing-icons-3.svg" alt="" class="hsad-icon">';
                    listing_data += '<p class="hsad-title">AREA AQFT</p>';
                    listing_data += '<p class="hsad-area">'+val.listing_area+'</p>';
                    listing_data += '</div>';
                    listing_data += '<div class="hsad-box">';
                    listing_data += '<img src="'+val.site_url+'/wp-content/uploads/2022/06/listing-icons-2.svg" alt="" class="hsad-icon">';
                    listing_data += '<p class="hsad-title">BEDROOMS</p>';
                    listing_data += '<p class="hsad-area">'+val.listing_bedroom+'</p>';
                    listing_data += '</div>';
                    listing_data += '<div class="hsad-box">';
                    listing_data += '<img src="'+val.site_url+'/wp-content/uploads/2022/06/listing-icons-1.svg" alt="" class="hsad-icon">';
                    listing_data += '<p class="hsad-title">BATHROOMS</p>';
                    listing_data += '<p class="hsad-area">'+val.listing_bathroom+'</p>';
                    listing_data += '</div></div></div></div></div>';
                });
                
                listing_data += '</div>';
                jQuery('#listingContentContainer').html(listing_data);
            }
            else
            {
                jQuery.LoadingOverlay("hide");
                jQuery('#listingContentContainer').html(value.norecord);
            }
		});
        
    });
    
    // <!--- Update Listing --->
    jQuery(document).on('submit', '#updateUserListing', function(e){
        e.preventDefault();
        
        jQuery('#updateUserListing').LoadingOverlay("show", {
            image       : "",
            text        : "Updating Info - Please Wait..."
        });
        setTimeout(function(){
            jQuery('#updateUserListing').LoadingOverlay("text", "It'll Take a While...");
        }, 5000);
        
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		
		jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=updating_listing_info',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: formData,
		})
		.done(function(value){
            if(value.status)
            {
                if( value.media_error )
                {
                    jQuery('#updateUserListing').LoadingOverlay("hide");
            		Swal.fire({icon: 'success',title: value.message, text: value.file_upload_error_0 });
            		jQuery.magnificPopup.close();
            		get_all_published_listing_by_user();
            		get_all_draft_listing_by_user();
                }
                else
                {
                    jQuery('#updateUserListing').LoadingOverlay("hide");
            		Swal.fire({icon: 'success',title: 'Success!', text: value.message });
            		jQuery.magnificPopup.close();
            		get_all_published_listing_by_user();
            		get_all_draft_listing_by_user();
                }
            }
            else
            {
                jQuery('#updateUserListing').LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: value.message
                });
            }
		})
		.fail(function(request, status, error){
		    jQuery('#listingHouseContent').LoadingOverlay("hide");
            Swal.fire({
                icon: 'error',
                title: 'Server Issue',
                text: 'You post may have been updated - Please refresh the page!'
            });
		});
    });
    
    
    function get_all_published_listing_by_user()
    {
        jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=get_all_published_listing_by_user',
			dataType: 'json',
		})
		.done(function(value){
            if(value.status)
            {
        		var table_row = '';
        		var count_row = 1;
        		jQuery.each(value.data, function(index, val) {
        		    
        		    table_row += '<tr>';
        		    table_row += '<td class="serial-no">'+count_row+'</td>';
        		    table_row += '<td class="list-title">'+val.title+'</td>';
        		    table_row += '<td class="listing-actions">';
        		    table_row += "<button class='btn-action action-edit' data-id='"+val.ID+"' data-json='"+val.raw_json+"'>Edit</button>";
        		    table_row += '<button class="btn-action action-delete" data-id="'+val.ID+'">Delete</button>';
        		    table_row += '</td>';
        		    table_row += '</tr>';
        		    
        		    count_row++;
        		});
        		
        		jQuery(document).find('#publishedListingBody').html(table_row);
            }
            else
            {
                var table_row = '';
                table_row = '<tr><td colspan="3">No Record Found! <a href="'+value.no_record+'">Click Here</a> To Add New Listing</td></tr>';
                jQuery(document).find('#publishedListingBody').html(table_row);
            }
		});
    }
    get_all_published_listing_by_user();
    
    function get_all_draft_listing_by_user()
    {
        jQuery.ajax({
			type: 'post',
			url: handler_object.ajax_url+'?action=get_all_draft_listing_by_user',
			dataType: 'json',
		})
		.done(function(value){
            if(value.status)
            {
        		var table_row2 = '';
        		var count_row2 = 1;
        		jQuery.each(value.data2, function(index, val) {
        		    
        		    table_row2 += '<tr>';
        		    table_row2 += '<td class="serial-no">'+count_row2+'</td>';
        		    table_row2 += '<td class="list-title">'+val.title+'</td>';
        		    table_row2 += '<td class="listing-actions">';
        		    table_row2 += "<button class='btn-action action-edit' data-id='"+val.ID+"' data-json='"+val.raw_json+"'>Edit</button>";
        		    table_row2 += '<button class="btn-action action-delete" data-id="'+val.ID+'">Delete</button>';
        		    table_row2 += '</td>';
        		    table_row2 += '</tr>';
        		    
        		    count_row2++;
        		});
        		
        		jQuery(document).find('#pendingListingBody').html(table_row2);
            }
            else
            {
                var table_row2 = '';
                table_row2 = '<tr><td colspan="3">No Record Found! <a href="'+value.no_record+'">Click Here</a> To Add New Listing</td></tr>';
                jQuery(document).find('#pendingListingBody').html(table_row2);
            }
		});
    }
    get_all_draft_listing_by_user();
    
    jQuery(".owl-carousel-listing").owlCarousel({
        margin: 20,
        dots: false,
        nav: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            600: {
                items: 3,
                nav: true
            },
            1000: {
                items: 6,
                nav: true
            }
        }
    });
    
});

