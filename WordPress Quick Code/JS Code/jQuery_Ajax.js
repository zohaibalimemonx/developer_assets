jQuery("#registerForm").validate();

jQuery("#userName").on("keyup", function(){ 
    jQuery(this).val( jQuery(this).val().toString().replace(" ","").replace(/[_\W]+/g, "_") ); 
});

jQuery(document).on('submit', '#registerForm', function(event) {
    event.preventDefault();
    
    jQuery.LoadingOverlay("show", {
        image       : "",
        text        : "Processing..."
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
            jQuery.LoadingOverlay("hide");
            Swal.fire({
                icon: 'success',
                title: "Registration Success",
                text: value.message,
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location = value.redirect;
            });
            jQuery("#registerForm")[0].reset();
        }
        else
        {
            jQuery.LoadingOverlay("hide");
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: value.message
            });
        }
    });
});