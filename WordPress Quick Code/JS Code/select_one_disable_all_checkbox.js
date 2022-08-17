$(document).ready(function() {

    // GENERAL EXAMPLE VERIFIED
    $('input[type=checkbox]').on('change', function() {

        if ($('input[type=checkbox]').is(':checked')) {
            $('input[type=checkbox]').not(this).prop('disabled', true);
        } else {
            $('input[type=checkbox]').not(this).prop('disabled', false);
        }
    });

    
    // DISABLE ALL CHECKBOXES IN A GROUP WHEN TYPE (NONE) CHECKBOX IS CHECKED
    jQuery('#checkBoxValidate input[type=checkbox]').on('change', function() {

        if (jQuery('#checkBoxValidate input[name=None]').is(':checked')) {
            jQuery('#checkBoxValidate input[type=checkbox]').not(this).prop('disabled', true);
        } else {
            jQuery('#checkBoxValidate input[type=checkbox]').not(this).prop('disabled', false);
        }
    });

});