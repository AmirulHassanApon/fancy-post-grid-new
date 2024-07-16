(function($){  
    "use strict";
    $('.regular-text-color').wpColorPicker();
    $( "#fpg-setting-tabs" ).tabs();

    /**
     *
     */
    jQuery(document).ready(function($) {
        function toggleLayoutFields() {
            var selectedLayout = $('input[name="fpg_layout_select"]:checked').val();
            if (selectedLayout === 'grid') {
                $('#fancy_post_grid_style').show();
                $('#fancy_post_slider_style').hide();
            } else if (selectedLayout === 'slider') {
                $('#fancy_post_grid_style').hide();
                $('#fancy_post_slider_style').show();
            }
        }
    
        // Initialize the visibility on page load
        toggleLayoutFields();
    
        // Change event for the layout selection
        $('input[name="fpg_layout_select"]').change(function() {
            toggleLayoutFields();
        });
    
        // Initialize Select2 for the dropdowns
        $('#fancy_post_grid_slider_column, #fancy_post_grid_column').select2({
            placeholder: 'Select Column',
            allowClear: true
        });
    });
    
})(jQuery);
