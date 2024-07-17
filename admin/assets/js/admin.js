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
    
        function togglePaginationFields() {
            var paginationStatus = $('input[name="fancy_post_pagination"]:checked').val();
            if (paginationStatus === 'on') {
                $('#fpg_post_per_page_fieldset').show();
            } else {
                $('#fpg_post_per_page_fieldset').hide();
            }
        }
    
        // Initialize the visibility on page load
        toggleLayoutFields();
        togglePaginationFields();
    
        // Change event for the layout selection
        $('input[name="fpg_layout_select"]').change(function() {
            toggleLayoutFields();
        });
    
        // Change event for the pagination
        $('input[name="fancy_post_pagination"]').change(function() {
            togglePaginationFields();
        });
    
        // Initialize Select2 for the dropdowns
        $('#fancy_post_cl_lg, #fancy_post_cl_md, #fancy_post_cl_xs, #fancy_post_cl_mobile').select2({
            placeholder: 'Select Column',
            allowClear: true
        });
        // Initialize Select2 for the title tag select
        $('#fancy_post_title_tag').select2({
            placeholder: 'Select Title Tag',
            allowClear: true
        });

        // Function to toggle visibility of image settings fields
        function toggleImageFields() {
            var hideFeatureImage = $('input[name="fancy_post_hide_feature_image"]:checked').val();
            if (hideFeatureImage === 'off') {
                $('.fpg-feature-image-size').hide();
                $('.fpg-media-source').hide();
                $('.fpg-hover-animation').hide();
            } else {
                $('.fpg-feature-image-size').show();
                $('.fpg-media-source').show();
                $('.fpg-hover-animation').show();
            }
        }

        // Initialize the visibility on page load
        toggleImageFields();

        // Change event for the hide feature image radio buttons
        $('input[name="fancy_post_hide_feature_image"]').change(function() {
            toggleImageFields();
        });

        // Initialize Select2 for the dropdowns
        $('#fancy_post_feature_image_size, #fancy_post_hover_animation').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    });
    
    
})(jQuery);
