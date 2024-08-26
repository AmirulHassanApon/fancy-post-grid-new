(function($){  
    "use strict";
    $('.regular-text-color').wpColorPicker();
    $( "#fpg-setting-tabs" ).tabs();

    /**
     *
     */
    jQuery(document).ready(function($) {

        function toggleLayoutActiveFields() {
            var selectedLayout = $('input[name="fpg_layout_select"]:checked').val();
            var selectedStyle = $('input[name="fancy_post_grid_style"]:checked').val();
            
            if (selectedLayout === 'grid') {
                if (selectedStyle === 'style1') {
                     
                }else if (selectedStyle === 'style6') {
                    $('#fpg_field_group_excerpt_main').hide(); 
                    $('#fpg_excerpt_order_main').hide(); 
                    $('#fpg_field_group_categories_main').hide(); 
                    $('#fpg_field_group_tag_main').hide(); 
                    $('#fpg_field_group_comment_count_main').hide(); 
                    $('#fpg_excerpt_setting_main').hide(); 
                    $('#fpg_excerpt_main').hide(); 
                    $('#fpg_meta_hover_color_main').hide();
                     
                }else if (selectedStyle === 'style7') {
                    $('#fpg_field_group_excerpt_main').hide(); 
                    $('#fpg_excerpt_order_main').hide(); 
                    $('#fpg_field_group_categories_main').hide(); 
                    $('#fpg_field_group_tag_main').hide(); 
                    $('#fpg_field_group_comment_count_main').hide(); 
                    $('#fpg_excerpt_setting_main').hide(); 
                    $('#fpg_excerpt_main').hide(); 
                    $('#fpg_meta_hover_color_main').hide();
                    $('#fpg_field_group_button_main').hide();
                    $('#fpg_button_settings_main').hide();
                    $('#fancy_button_option_main').hide();
                     
                } else {
                    $('#fancy_post_cl_lg_main').show();
                    $('#fpg_field_group_excerpt_main').show();
                    $('#fpg_excerpt_order_main').show(); 
                    $('#fpg_field_group_categories_main').show();
                    $('#fpg_field_group_tag_main').show();
                    $('#fpg_field_group_comment_count_main').show(); 
                    $('#fpg_excerpt_setting_main').show(); 
                    $('#fpg_excerpt_main').show(); 
                    $('#fpg_meta_hover_color_main').show();
                    $('#fpg_field_group_button_main').show(); 
                    $('#fpg_button_settings_main').show();
                    $('#fancy_button_option_main').show();
                    
                }
            } else if (selectedLayout === 'slider') {
                // Handle the slider layout if needed
                $('#fancy_post_cl_lg_main').show(); // Ensure it shows for slider
            }
        }

        function toggleLayoutFields() {
            var selectedLayout = $('input[name="fpg_layout_select"]:checked').val();
            if (selectedLayout === 'grid') {
                $('#fancy_post_grid_style').show();
                $('#fancy_post_column_grid').show();
                $('#fancy_post_slider_style').hide();
                $('#fancy_post_column_slider').hide();
                $('#fpg_slider_option').hide();
                $('#fpg_slider_pagination_option').hide();
                $('#fpg_pagination').show();
            } else if (selectedLayout === 'slider') {
                $('#fancy_post_grid_style').hide();
                $('#fpg_pagination').hide();
                $('#fancy_post_column_grid').hide();
                $('#fancy_post_slider_style').show();
                $('#fancy_post_column_slider').show();
                $('#fpg_slider_option').show();
                $('#fpg_slider_pagination_option').show();

            }
        }

        function toggleButtonFields() {
            var selectedLayout = $('#fancy_button_option').val();
            if (selectedLayout === 'filled') {
                $('#fpg_post_select_button').show();
                $('#fpg_button_br_color').hide();
                $('#fpg_button_bg_color').show();
                $('#fpg_button_bg_hover_color').show();
            } else if (selectedLayout === 'flat') {
                $('#fpg_post_select_button').hide();
                $('#fpg_button_br_color').hide();
                $('#fpg_button_bg_color').hide();
                $('#fpg_button_bg_hover_color').hide();

            } else {
                $('#fpg_post_select_button').hide();
                $('#fpg_button_br_color').show();
                $('#fpg_button_bg_color').hide();
                $('#fpg_button_bg_hover_color').hide();
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
        toggleLayoutActiveFields();
        toggleLayoutFields();
        toggleButtonFields();
        togglePaginationFields();
    
        // Bind the function to the change event for both layout and style radio buttons
        $('input[name="fpg_layout_select"], input[name="fancy_post_grid_style"]').on('change', function() {
            toggleLayoutActiveFields();
        });

        $('input[name="fpg_layout_select"]').change(function() {
            toggleLayoutFields();
        });

        // Change event for the Button selection (updated to handle <select> dropdown)
        $('#fancy_button_option').change(function() {
            toggleButtonFields();
        });
    
        // Change event for the pagination
        $('input[name="fancy_post_pagination"]').change(function() {
            togglePaginationFields();
        });
    
        // Initialize Select2 for the dropdowns
        $('#fancy_post_cl_lg, #fancy_post_cl_md, #fancy_post_cl_sm, #fancy_post_cl_mobile').select2({
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
                $('.fpg-image-border-radius').hide();
            } else {
                $('.fpg-feature-image-size').show();
                $('.fpg-media-source').show();
                $('.fpg-hover-animation').show();
                $('.fpg-image-border-radius').show();
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
    $(' #fpg_filter_authors').select2({
        placeholder: 'Select Authors',
        allowClear: true
    });
    $(' #fpg_filter_statuses').select2({
        placeholder: 'Select Status',
        allowClear: true
    });

});
    
    
})(jQuery);
