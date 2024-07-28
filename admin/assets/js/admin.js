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
    jQuery(document).ready(function($) {
    function toggleTermsFields() {
        if ($('#fpg_field_group_category').is(':checked')) {
            $('#fpg_category_terms').show();
            $('#fpg_category_operator').show();
        } else {
            $('#fpg_category_terms').hide();
            $('#fpg_category_operator').hide();
        }

        if ($('#fpg_field_group_tags').is(':checked')) {
            $('#fpg_tags_terms').show();
            $('#fpg_tags_operator').show();
            
        } else {
            $('#fpg_tags_terms').hide();
            $('#fpg_tags_operator').hide();
        }

        if ($('#fpg_field_group_category').is(':checked') && $('#fpg_field_group_tags').is(':checked')) {
            $('#fpg_relation').show();
        } else {
            $('#fpg_relation').hide();
        }
        if ($('#fpg_field_group_category').is(':checked') || $('#fpg_field_group_tags').is(':checked')) {
            $('#fpg-terms').show();
        } else {
            $('#fpg-terms').hide();
        }
        
    }

    // Initialize visibility on page load
    toggleTermsFields();

    // Change event for checkboxes
    $('#fpg_field_group_category, #fpg_field_group_tags').change(function() {
        toggleTermsFields();
    });

    // Initialize Select2 for the dropdowns
    $('#fpg_filter_category_terms, #fpg_filter_tags_terms').select2({
        placeholder: 'Select terms',
        allowClear: true
    });
    
    // Initialize Select2 for all select elements
    $(' #fpg_filter_authors, #fpg_filter_statuses').select2();
});
    
    
})(jQuery);
