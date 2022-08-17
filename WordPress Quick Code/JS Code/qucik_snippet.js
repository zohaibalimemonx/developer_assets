// Validate.JS Library Password Validation

jQuery( "#UserRegisterForm" ).validate({
    rules: {
      cpassword: {
        equalTo: "#password"
      }
    }
});

// Simple JQUERY Username Validation
jQuery("#username").on("keyup", function(){ 
  jQuery(this).val( jQuery(this).val().toString().replace(" ","").replace(/[_\W]+/g, "_") ); 
});

// Loading Overlay Plugin Snippet
jQuery.LoadingOverlay("show", {
  image       : "",
  text        : "Processing..."
});

// SweetAlert Redirect After Register
Swal.fire({
  icon: 'success',
  title: "Success",
  text: value.message,
  showConfirmButton: false,
  timer: 2000
}).then(function() {
  window.location = value.redirect;
});