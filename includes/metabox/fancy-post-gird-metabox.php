<?php

add_action( 'add_meta_boxes', 'fpg_custom_settings_shortcode_metabox' );
function fpg_custom_settings_shortcode_metabox() {
    add_meta_box(
        'fpg_metabox_shortcode',
        __( 'Shortcode Generator', 'fancy-post-grid' ),
        'fpg_metabox_shortcode_callback',
        'wp-fpg', // Replace 'wp-fpg' with your custom post type slug
        'normal',
        'high'
    );
}

/**
 * Callback function for metabox content.
 */
function fpg_metabox_shortcode_callback( $post ) {
    // Add nonce for security verification
    wp_nonce_field( 'fpg_metabox_nonce', 'fpg_metabox_nonce' );

    // Retrieve existing metabox fields
    // tab-1
    $fancy_post_type                            = get_post_meta( $post->ID, 'fancy_post_type', true );
    $fpg_include_only                           = get_post_meta( $post->ID, 'fpg_include_only', true );
    $fpg_exclude                                = get_post_meta( $post->ID, 'fpg_exclude', true );
    $fpg_limit                                  = get_post_meta( $post->ID, 'fpg_limit', true );

    if ( empty( $fpg_limit ) ) {
        $fpg_limit = '5'; 
    }
    $fpg_filter_categories                      = get_post_meta( $post->ID, 'fpg_filter_categories', true );
    $fpg_filter_tags                            = get_post_meta( $post->ID, 'fpg_filter_tags', true );
    $fpg_field_group_taxonomy                   = get_post_meta( $post->ID, 'fpg_field_group_taxonomy', true );
    $fpg_filter_category_terms                  = get_post_meta( $post->ID, 'fpg_filter_category_terms', true );
    $fpg_filter_tags_terms                      = get_post_meta( $post->ID, 'fpg_filter_tags_terms', true );
    $fpg_category_operator                      = get_post_meta( $post->ID, 'fpg_category_operator', true );
    $fpg_tags_operator                          = get_post_meta( $post->ID, 'fpg_tags_operator', true );
    $fpg_relation                               = get_post_meta( $post->ID, 'fpg_relation', true );
    $fpg_order_by                               = get_post_meta( $post->ID, 'fpg_order_by', true );
    $fpg_order                                  = get_post_meta( $post->ID, 'fpg_order', true );
    $fpg_filter_authors                         = get_post_meta( $post->ID, 'fpg_filter_authors', true );
    $fpg_filter_statuses                        = get_post_meta( $post->ID, 'fpg_filter_statuses', true );
    
    
    // tab-2
    $fpg_layout_select                          = get_post_meta( $post->ID, 'fpg_layout_select', true );
    if ( empty( $fpg_layout_select ) ) {
        $fpg_layout_select = 'grid'; // Set default to 'grid'
    }
    $fancy_post_grid_style                      = get_post_meta( $post->ID, 'fancy_post_grid_style', true );
    if ( empty( $fancy_post_grid_style ) ) {
        $fancy_post_grid_style = 'style1'; // Set default to 'style1'
    }
    $fancy_slider_style                         = get_post_meta( $post->ID, 'fancy_slider_style', true );
    if ( empty( $fancy_slider_style ) ) {
        $fancy_slider_style = 'style1'; // Set default to 'style1'
    }
    
    $fancy_post_pagination                      = get_post_meta( $post->ID, 'fancy_post_pagination', true );
    $fpg_post_per_page                          = get_post_meta( $post->ID, 'fpg_post_per_page', true );

    // Column
    $fancy_post_cl_lg                           = get_post_meta( $post->ID, 'fancy_post_cl_lg', true );
    if ( empty( $fancy_post_cl_lg ) ) {
        $fancy_post_cl_lg = '4'; 
    }

    $fancy_post_cl_md                           = get_post_meta( $post->ID, 'fancy_post_cl_md', true );
    if ( empty( $fancy_post_cl_md ) ) {
        $fancy_post_cl_md = '4'; 
    }

    $fancy_post_cl_sm                           = get_post_meta( $post->ID, 'fancy_post_cl_sm', true );
    if ( empty( $fancy_post_cl_sm ) ) {
        $fancy_post_cl_sm = '6'; 
    }

    $fancy_post_cl_mobile                       = get_post_meta( $post->ID, 'fancy_post_cl_mobile', true );
    if ( empty( $fancy_post_cl_mobile ) ) {
        $fancy_post_cl_mobile = '12'; 
    }

    $fancy_post_cl_lg_slider                           = get_post_meta( $post->ID, 'fancy_post_cl_lg_slider', true );
    if ( empty( $fancy_post_cl_lg_slider ) ) {
        $fancy_post_cl_lg_slider = '3'; 
    }

    $fancy_post_cl_md_silder                           = get_post_meta( $post->ID, 'fancy_post_cl_md_silder', true );
    if ( empty( $fancy_post_cl_md_silder ) ) {
        $fancy_post_cl_md_silder = '3'; 
    }

    $fancy_post_cl_sm_slider                           = get_post_meta( $post->ID, 'fancy_post_cl_sm_slider', true );
    if ( empty( $fancy_post_cl_sm_slider ) ) {
        $fancy_post_cl_sm_slider = '2'; 
    }

    $fancy_post_cl_mobile_slider                       = get_post_meta( $post->ID, 'fancy_post_cl_mobile_slider', true );
    if ( empty( $fancy_post_cl_mobile_slider ) ) {
        $fancy_post_cl_mobile_slider = '1'; 
    }

    $fancy_link_details                         = get_post_meta( $post->ID, 'fancy_link_details', true );
    $fancy_link_target                          = get_post_meta( $post->ID, 'fancy_link_target', true );
    if ( empty( $fancy_link_target ) ) {
        $fancy_link_target = 'same'; 
    }

    // tab-3-Advanced-Settings
    
    $fancy_post_title_tag                       = get_post_meta( $post->ID, 'fancy_post_title_tag', true );    
    if ( empty( $fancy_post_title_tag ) ) {
        $fancy_post_title_tag = 'h3'; 
    }

    $fancy_post_title_limit                       = get_post_meta( $post->ID, 'fancy_post_title_limit', true );  
    if ( empty( $fancy_post_title_limit ) ) {
        $fancy_post_title_limit = '7'; 
    }

    $fancy_post_title_more_text                       = get_post_meta( $post->ID, 'fancy_post_title_more_text', true ); 
    if ( empty( $fancy_post_title_more_text ) ) {
        $fancy_post_title_more_text = '...'; 
    }
    //Feature-image
    $fancy_post_hide_feature_image              = get_post_meta( $post->ID, 'fancy_post_hide_feature_image', true );
    if ( empty( $fancy_post_hide_feature_image ) ) {
        $fancy_post_hide_feature_image = 'on'; // image
    }
    $fancy_post_feature_image_size              = get_post_meta( $post->ID, 'fancy_post_feature_image_size', true );
    if ( empty( $fancy_post_feature_image_size ) ) {
        $fancy_post_feature_image_size ="full";
    }
    $fancy_post_media_source                    = get_post_meta( $post->ID, 'fancy_post_media_source', true );
    if ( empty( $fancy_post_media_source ) ) {
        $fancy_post_media_source ="feature_image";
    }

    $fancy_post_hover_animation                 = get_post_meta( $post->ID, 'fancy_post_hover_animation', true );

    $fancy_post_excerpt_more_text               = get_post_meta( $post->ID, 'fancy_post_excerpt_more_text', true );
    if ( empty( $fancy_post_excerpt_more_text ) ) {
        $fancy_post_excerpt_more_text = '...'; 
    }
    $fancy_post_excerpt_limit                   = get_post_meta( $post->ID, 'fancy_post_excerpt_limit', true );
    if ( empty( $fancy_post_excerpt_limit ) ) {
        $fancy_post_excerpt_limit = '10'; 
    }

    // Button
    $fancy_button_option                        = get_post_meta( $post->ID, 'fancy_button_option', true );
    if ( empty( $fancy_button_option ) ) {
        $fancy_button_option = 'filled'; 
    }
    $fancy_button_border_style                  = get_post_meta( $post->ID, 'fancy_button_border_style', true );
    if ( empty( $fancy_button_border_style ) ) {
        $fancy_button_border_style = 'dotted'; 
    }

    $fancy_post_read_more_border_radius         = get_post_meta( $post->ID, 'fancy_post_read_more_border_radius', true );
    $fancy_post_button_padding                  = get_post_meta( $post->ID, 'fancy_post_button_padding', true );
    $fancy_post_border_width                    = get_post_meta( $post->ID, 'fancy_post_border_width', true );
    
    $fancy_post_read_more_alignment             = get_post_meta( $post->ID, 'fancy_post_read_more_alignment', true );
    if ( empty( $fancy_post_read_more_alignment ) ) {
        $fancy_post_read_more_alignment = 'left'; 
    }
    $fancy_post_read_more_text                  = get_post_meta( $post->ID, 'fancy_post_read_more_text', true );
    if ( empty( $fancy_post_read_more_text ) ) {
        $fancy_post_read_more_text = 'Read More'; 
    }
    
    //Field Selector
    
    $fpg_field_group_title                      = get_post_meta( $post->ID, 'fpg_field_group_title', true, );  
    $fpg_field_group_excerpt                    = get_post_meta( $post->ID, 'fpg_field_group_excerpt', true );
    $fpg_field_group_read_more                  = get_post_meta( $post->ID, 'fpg_field_group_read_more', true );
    $fpg_field_group_image                      = get_post_meta( $post->ID, 'fpg_field_group_image', true );
    $fpg_field_group_post_date                  = get_post_meta( $post->ID, 'fpg_field_group_post_date', true );
    $fpg_field_group_author                     = get_post_meta( $post->ID, 'fpg_field_group_author', true );
    $fpg_field_group_categories                 = get_post_meta( $post->ID, 'fpg_field_group_categories', true );
    $fpg_field_group_tag                        = get_post_meta( $post->ID, 'fpg_field_group_tag', true );
    $fpg_field_group_comment_count              = get_post_meta( $post->ID, 'fpg_field_group_comment_count', true );
    

    // tab-4 Title Settings
    
    //Button
    $fpg_button_background_color                = get_post_meta( $post->ID,'fpg_button_background_color', true); 
    $fpg_button_hover_background_color          = get_post_meta( $post->ID,'fpg_button_hover_background_color', true); 
    $fpg_button_text_color                      = get_post_meta( $post->ID,'fpg_button_text_color', true ); 
    $fpg_button_text_hover_color                = get_post_meta( $post->ID,'fpg_button_text_hover_color', true ); 
    $fpg_button_border_color                    = get_post_meta( $post->ID,'fpg_button_border_color', true ); 

    //full Section
    $fpg_section_background_color               = get_post_meta( $post->ID, 'fpg_section_background_color', true );
    $fpg_section_margin                         = get_post_meta( $post->ID, 'fpg_section_margin', true );
    $fpg_section_padding                        = get_post_meta( $post->ID, 'fpg_section_padding', true );

    // Title
    $fpg_title_color                            = get_post_meta( $post->ID,'fpg_title_color', true); 
    $fpg_title_font_size                        = get_post_meta( $post->ID,'fpg_title_font_size', true); 
    if ( empty( $fpg_title_font_size ) ) {
        $fpg_title_font_size = '30'; 
    }
    $fpg_title_font_weight                      = get_post_meta( $post->ID,'fpg_title_font_weight', true ); 
    if ( empty( $fpg_title_font_weight ) ) {
        $fpg_title_font_weight = '600'; 
    }
    $fpg_title_alignment                        = get_post_meta( $post->ID,'fpg_title_alignment', true ); 

    //Title Hover
    $fpg_title_hover_color                      = get_post_meta( $post->ID,'fpg_title_hover_color', true); 
    $fpg_title_hover_font_size                  = get_post_meta( $post->ID,'fpg_title_hover_font_size', true); 
    if ( empty( $fpg_title_hover_font_size ) ) {
        $fpg_title_hover_font_size = '30'; 
    }
    $fpg_title_hover_font_weight                = get_post_meta( $post->ID,'fpg_title_hover_font_weight', true ); 
    if ( empty( $fpg_title_hover_font_weight ) ) {
        $fpg_title_hover_font_weight = '600'; 
    }
    $fpg_title_hover_alignment                  = get_post_meta( $post->ID,'fpg_title_hover_alignment', true ); 

    //Excerpt
    $fpg_excerpt_color                          = get_post_meta( $post->ID,'fpg_excerpt_color', true); // Default to black if not set
    $fpg_excerpt_size                           = get_post_meta( $post->ID,'fpg_excerpt_size', true); 
    if ( empty( $fpg_excerpt_size ) ) {
        $fpg_excerpt_size = '16'; 
    }
    $fpg_excerpt_font_weight                    = get_post_meta( $post->ID,'fpg_excerpt_font_weight', true ); 
    if ( empty( $fpg_excerpt_font_weight ) ) {
        $fpg_excerpt_font_weight = '400'; 
    }
    $fpg_excerpt_alignment                      = get_post_meta( $post->ID,'fpg_excerpt_alignment', true ); 

    //Meta Data
    $fpg_meta_color                             = get_post_meta( $post->ID,'fpg_meta_color', true); 
    $fpg_meta_size                              = get_post_meta( $post->ID,'fpg_meta_size', true); 
    if ( empty( $fpg_meta_size ) ) {
        $fpg_meta_size = '16'; 
    }
    $fpg_meta_font_weight                       = get_post_meta( $post->ID,'fpg_meta_font_weight', true ); 
    if ( empty( $fpg_meta_font_weight ) ) {
        $fpg_meta_font_weight = '400'; 
    }
    $fpg_meta_alignment                         = get_post_meta( $post->ID,'fpg_meta_alignment', true ); // Default to left if not set



    // Output for the metabox content
    ?>
    <div id="fpg_metabox_tabs">
        <ul>
            <li>
                <a href="#tab-1" class="fpg-nav-tab active">
                    <div class="fpg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                        <defs></defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path d="M 80.644 67.765 L 69.069 56.19 c -1.439 -1.438 -3.7 -1.533 -5.266 -0.314 l -4.014 -4.014 c 3.395 -3.74 5.274 -8.526 5.274 -13.612 c 0 -5.422 -2.112 -10.52 -5.946 -14.354 s -8.931 -5.945 -14.353 -5.945 s -10.52 2.111 -14.354 5.945 s -5.945 8.931 -5.945 14.354 c 0 5.422 2.111 10.519 5.945 14.353 s 8.932 5.946 14.354 5.946 c 5.086 0 9.872 -1.879 13.612 -5.274 l 4.013 4.013 c -0.543 0.696 -0.852 1.541 -0.852 2.441 c 0 1.07 0.414 2.074 1.167 2.826 l 11.574 11.575 c 0.779 0.779 1.803 1.169 2.826 1.169 c 1.022 0 2.046 -0.39 2.825 -1.169 l 0.715 -0.715 C 82.202 71.858 82.202 69.323 80.644 67.765 z M 31.823 51.189 c -3.456 -3.456 -5.359 -8.051 -5.359 -12.939 s 1.903 -9.483 5.359 -12.939 c 3.457 -3.456 8.052 -5.359 12.94 -5.359 s 9.483 1.903 12.939 5.359 s 5.36 8.052 5.36 12.939 s -1.904 9.483 -5.36 12.939 s -8.051 5.36 -12.939 5.36 S 35.28 54.646 31.823 51.189 z M 79.229 72.003 l -0.715 0.715 c -0.75 0.751 -2.073 0.749 -2.823 0 L 64.117 61.143 c -0.375 -0.375 -0.581 -0.876 -0.581 -1.412 c 0 -0.535 0.206 -1.036 0.581 -1.411 l 0.715 -0.715 c 0.375 -0.375 0.876 -0.581 1.411 -0.581 c 0.536 0 1.037 0.206 1.412 0.581 l 11.574 11.574 C 80.008 69.957 80.008 71.225 79.229 72.003 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 31.425 45.3 c -0.303 0 -0.602 -0.137 -0.798 -0.396 c -0.333 -0.44 -0.247 -1.068 0.194 -1.401 l 18.395 -13.92 c 0.226 -0.171 0.516 -0.239 0.79 -0.185 c 0.277 0.053 0.52 0.22 0.667 0.461 l 5.851 9.589 l 2.155 -1.549 c 0.449 -0.324 1.074 -0.22 1.396 0.229 c 0.322 0.448 0.22 1.073 -0.229 1.396 l -3.031 2.178 c -0.227 0.162 -0.512 0.225 -0.782 0.168 c -0.273 -0.055 -0.511 -0.222 -0.655 -0.459 l -5.837 -9.566 L 32.027 45.097 C 31.847 45.234 31.635 45.3 31.425 45.3 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 85.396 10.052 H 4.604 C 2.065 10.052 0 12.117 0 14.655 v 46.655 c 0 2.538 2.065 4.604 4.604 4.604 h 31.272 v 12.034 H 23.189 c -0.552 0 -1 0.447 -1 1 s 0.448 1 1 1 h 43.621 c 0.553 0 1 -0.447 1 -1 s -0.447 -1 -1 -1 H 54.124 V 65.914 h 4.285 c 0.553 0 1 -0.447 1 -1 s -0.447 -1 -1 -1 H 4.604 C 3.168 63.914 2 62.746 2 61.311 v -8.911 l 10.492 -7.789 l 5.804 9.5 c 0.147 0.241 0.39 0.408 0.667 0.461 c 0.062 0.012 0.124 0.018 0.186 0.018 c 0.216 0 0.428 -0.07 0.604 -0.202 l 4.04 -3.058 c 0.44 -0.334 0.527 -0.961 0.194 -1.401 s -0.96 -0.526 -1.401 -0.194 l -3.159 2.392 l -5.799 -9.491 c -0.146 -0.24 -0.387 -0.407 -0.663 -0.46 c -0.276 -0.056 -0.562 0.011 -0.787 0.179 L 2 49.909 V 14.655 c 0 -1.436 1.168 -2.604 2.604 -2.604 h 80.793 c 1.436 0 2.604 1.168 2.604 2.604 v 2.177 L 67.549 31.525 c -0.448 0.322 -0.551 0.947 -0.229 1.396 c 0.195 0.272 0.502 0.417 0.813 0.417 c 0.202 0 0.406 -0.061 0.582 -0.188 L 88 19.295 v 42.016 c 0 1.436 -1.168 2.604 -2.604 2.604 h -1.747 c -0.553 0 -1 0.447 -1 1 s 0.447 1 1 1 h 1.747 c 2.538 0 4.604 -2.065 4.604 -4.604 V 14.655 C 90 12.117 87.935 10.052 85.396 10.052 z M 52.124 77.948 H 37.876 V 65.914 h 14.248 V 77.948 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                        </g>
                    </svg>
                    </div>
                    <?php esc_html_e( 'Query Build', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-2" class="fpg-nav-tab">
                    <div class="fpg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                        <defs></defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path d="M 63.409 90 H 8.08 C 3.625 90 0 86.375 0 81.92 V 8.08 C 0 3.625 3.625 0 8.08 0 h 73.84 C 86.375 0 90 3.625 90 8.08 v 57.44 c 0 0.553 -0.447 1 -1 1 s -1 -0.447 -1 -1 V 8.08 C 88 4.728 85.272 2 81.92 2 H 8.08 C 4.728 2 2 4.728 2 8.08 v 73.84 C 2 85.272 4.728 88 8.08 88 h 55.329 c 0.553 0 1 0.447 1 1 S 63.962 90 63.409 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 79.181 89.997 c -1.626 0 -3.252 -0.619 -4.489 -1.856 L 52.982 66.433 c -1.323 -1.324 -2.312 -2.971 -2.858 -4.76 l -3.479 -11.384 c -0.316 -1.034 -0.038 -2.151 0.728 -2.916 c 0.765 -0.766 1.887 -1.046 2.916 -0.728 l 11.384 3.479 c 1.789 0.547 3.436 1.535 4.76 2.858 l 21.708 21.709 c 2.476 2.476 2.476 6.503 0 8.979 l -4.471 4.471 C 82.433 89.378 80.807 89.997 79.181 89.997 z M 49.425 48.515 c -0.324 0 -0.545 0.18 -0.638 0.272 c -0.117 0.117 -0.375 0.441 -0.229 0.918 l 3.479 11.384 c 0.452 1.478 1.268 2.836 2.36 3.93 l 21.709 21.708 c 1.695 1.695 4.455 1.695 6.15 0 l 4.471 -4.471 c 1.695 -1.695 1.695 -4.455 0 -6.15 L 65.019 54.396 c -1.094 -1.093 -2.452 -1.908 -3.93 -2.36 l 0 0 l -11.384 -3.479 C 49.604 48.527 49.511 48.515 49.425 48.515 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 70.886 83.922 c -0.256 0 -0.512 -0.098 -0.707 -0.293 c -0.391 -0.391 -0.391 -1.023 0 -1.414 l 12.036 -12.036 c 0.391 -0.391 1.023 -0.391 1.414 0 s 0.391 1.023 0 1.414 L 71.593 83.629 C 71.397 83.824 71.142 83.922 70.886 83.922 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 72.719 22 H 17.281 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 55.438 c 0.553 0 1 0.448 1 1 S 73.271 22 72.719 22 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 72.719 38 H 17.281 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 55.438 c 0.553 0 1 0.448 1 1 S 73.271 38 72.719 38 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 32.719 54 H 17.281 c -0.552 0 -1 -0.447 -1 -1 s 0.448 -1 1 -1 h 15.438 c 0.552 0 1 0.447 1 1 S 33.271 54 32.719 54 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 42.719 70 H 17.281 c -0.552 0 -1 -0.447 -1 -1 s 0.448 -1 1 -1 h 25.438 c 0.552 0 1 0.447 1 1 S 43.271 70 42.719 70 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                        </g>
                    </svg>

                    </div>
                    <?php esc_html_e( 'Field Selector', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-3" class="fpg-nav-tab">
                    <div class="fpg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                        <defs></defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path d="M 45 54.733 c -0.868 0 -1.736 -0.208 -2.527 -0.624 L 1.818 32.727 C 0.696 32.137 0 30.983 0 29.717 s 0.697 -2.42 1.818 -3.009 L 42.473 5.325 c 1.582 -0.833 3.47 -0.832 5.054 0 l 40.655 21.383 C 89.304 27.297 90 28.45 90 29.717 s -0.696 2.42 -1.817 3.01 L 47.527 54.109 C 46.736 54.525 45.868 54.733 45 54.733 z M 45 6.701 c -0.548 0 -1.096 0.131 -1.596 0.395 L 2.749 28.478 C 2.28 28.724 2 29.188 2 29.717 c 0 0.53 0.28 0.993 0.749 1.24 L 43.404 52.34 c 1 0.525 2.194 0.525 3.192 0 l 40.655 -21.383 C 87.72 30.71 88 30.247 88 29.717 c 0 -0.529 -0.28 -0.993 -0.748 -1.239 L 46.596 7.095 C 46.097 6.832 45.548 6.701 45 6.701 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 45 70.016 c -0.868 0 -1.736 -0.208 -2.527 -0.624 L 1.818 48.009 C 0.697 47.42 0 46.267 0 45 c 0 -1.267 0.696 -2.42 1.818 -3.01 L 5.8 39.896 c 0.489 -0.257 1.094 -0.069 1.351 0.42 s 0.069 1.093 -0.42 1.351 l -3.982 2.095 C 2.28 44.007 2 44.471 2 45 s 0.28 0.993 0.749 1.239 l 40.655 21.383 c 1 0.525 2.194 0.525 3.192 0 l 40.655 -21.383 C 87.72 45.993 88 45.529 88 45 s -0.28 -0.993 -0.749 -1.239 l -3.982 -2.095 c -0.488 -0.257 -0.677 -0.862 -0.419 -1.351 c 0.257 -0.489 0.862 -0.677 1.351 -0.42 l 3.982 2.095 C 89.304 42.58 90 43.733 90 45 c 0 1.266 -0.696 2.419 -1.818 3.008 L 47.527 69.392 C 46.736 69.808 45.868 70.016 45 70.016 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 45 85.299 c -0.868 0 -1.736 -0.208 -2.527 -0.624 L 1.818 63.292 C 0.697 62.703 0 61.55 0 60.284 c 0 -1.268 0.696 -2.421 1.817 -3.011 L 5.8 55.179 c 0.489 -0.258 1.094 -0.069 1.351 0.419 c 0.257 0.489 0.069 1.094 -0.42 1.351 l -3.982 2.095 C 2.28 59.29 2 59.754 2 60.283 s 0.28 0.992 0.749 1.239 l 40.655 21.383 c 1 0.525 2.194 0.525 3.192 0 l 40.655 -21.383 C 87.72 61.275 88 60.812 88 60.283 s -0.28 -0.993 -0.749 -1.24 l -3.982 -2.095 c -0.488 -0.257 -0.677 -0.861 -0.419 -1.351 c 0.257 -0.489 0.862 -0.676 1.351 -0.419 l 3.982 2.095 C 89.304 57.863 90 59.017 90 60.284 c 0 1.266 -0.697 2.419 -1.818 3.008 L 47.527 84.675 C 46.736 85.091 45.868 85.299 45 85.299 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                        </g>
                    </svg>
                    </div>
                    <?php esc_html_e( 'Layout Settings', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-4" class="fpg-nav-tab">
                    <div class="fpg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">

                        <defs>
                        </defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                            <path d="M 16.253 90 c -1.72 0 -3.46 -0.275 -5.16 -0.839 c -0.329 -0.109 -0.578 -0.381 -0.658 -0.719 c -0.08 -0.338 0.021 -0.692 0.266 -0.937 l 7.189 -7.189 c 1.096 -1.096 1.7 -2.553 1.7 -4.104 s -0.603 -3.007 -1.699 -4.104 c -2.264 -2.263 -5.946 -2.263 -8.207 0 l -7.189 7.189 c -0.245 0.244 -0.602 0.347 -0.937 0.266 c -0.337 -0.079 -0.609 -0.329 -0.719 -0.658 c -1.945 -5.866 -0.449 -12.215 3.906 -16.57 c 4.463 -4.462 11.051 -5.916 16.948 -3.792 l 36.851 -36.851 c -2.124 -5.9 -0.671 -12.486 3.792 -16.948 c 4.354 -4.355 10.707 -5.852 16.57 -3.906 c 0.329 0.109 0.579 0.381 0.658 0.719 c 0.08 0.337 -0.021 0.692 -0.266 0.937 L 72.11 9.683 c -2.262 2.263 -2.262 5.944 0 8.207 c 1.096 1.096 2.553 1.699 4.104 1.699 c 1.55 0 3.007 -0.603 4.104 -1.7 l 7.189 -7.189 c 0.245 -0.246 0.603 -0.344 0.937 -0.266 c 0.338 0.08 0.609 0.329 0.719 0.658 c 1.946 5.866 0.449 12.215 -3.906 16.57 c -4.463 4.464 -11.048 5.915 -16.948 3.793 L 31.456 68.307 c 2.124 5.899 0.67 12.485 -3.793 16.948 C 24.571 88.348 20.471 90 16.253 90 z M 13.336 87.698 c 4.668 0.974 9.493 -0.436 12.913 -3.857 c 4.051 -4.051 5.274 -10.098 3.115 -15.406 c -0.151 -0.373 -0.065 -0.8 0.219 -1.084 l 37.769 -37.769 c 0.285 -0.285 0.712 -0.371 1.084 -0.219 c 5.307 2.161 11.355 0.936 15.406 -3.115 c 3.42 -3.421 4.829 -8.246 3.857 -12.913 l -5.967 5.967 c -1.473 1.474 -3.433 2.286 -5.517 2.286 c -2.084 0 -4.044 -0.811 -5.517 -2.285 c -3.042 -3.043 -3.042 -7.993 0 -11.035 l 5.967 -5.968 C 71.993 1.33 67.17 2.738 63.749 6.158 c -4.051 4.051 -5.273 10.098 -3.114 15.406 c 0.151 0.372 0.064 0.8 -0.22 1.084 L 22.648 60.416 c -0.285 0.284 -0.712 0.367 -1.084 0.22 c -5.308 -2.162 -11.355 -0.937 -15.406 3.114 c -3.421 3.421 -4.829 8.246 -3.857 12.914 l 5.968 -5.967 c 3.042 -3.042 7.992 -3.042 11.035 0 c 1.474 1.473 2.286 3.433 2.285 5.517 c 0 2.084 -0.812 4.044 -2.286 5.517 L 13.336 87.698 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 29.621 61.379 c -0.256 0 -0.512 -0.098 -0.707 -0.293 c -0.391 -0.391 -0.391 -1.023 0 -1.414 l 30.758 -30.758 c 0.391 -0.391 1.023 -0.391 1.414 0 c 0.391 0.391 0.391 1.023 0 1.414 L 30.327 61.086 C 30.132 61.281 29.876 61.379 29.621 61.379 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 79.625 89.833 c -2.654 0 -5.308 -1.01 -7.328 -3.031 L 57.424 71.93 c -0.177 -0.177 -0.28 -0.413 -0.292 -0.662 c -0.155 -3.46 -1.876 -7.076 -4.72 -9.921 c -2.794 -2.793 -6.352 -4.511 -9.76 -4.712 c -0.552 -0.032 -0.972 -0.506 -0.939 -1.056 c 0.032 -0.552 0.505 -0.967 1.056 -0.939 c 3.891 0.228 7.921 2.159 11.057 5.294 c 3.087 3.088 4.996 7.021 5.28 10.851 L 73.71 85.389 c 3.262 3.262 8.57 3.26 11.83 0 c 3.261 -3.262 3.261 -8.568 0 -11.83 L 70.936 58.955 c -3.831 -0.284 -7.764 -2.193 -10.851 -5.28 c -3.135 -3.136 -5.065 -7.166 -5.294 -11.057 c -0.032 -0.551 0.388 -1.024 0.939 -1.056 c 0.539 -0.041 1.024 0.388 1.056 0.939 c 0.201 3.408 1.918 6.966 4.712 9.76 c 2.844 2.844 6.459 4.564 9.921 4.72 c 0.249 0.012 0.485 0.115 0.662 0.292 l 14.873 14.873 c 4.04 4.041 4.04 10.617 0 14.658 C 84.934 88.824 82.279 89.833 79.625 89.833 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 81.007 81.856 c -0.256 0 -0.512 -0.098 -0.707 -0.293 L 52.382 53.645 c -0.391 -0.391 -0.391 -1.023 0 -1.414 s 1.023 -0.391 1.414 0 l 27.918 27.917 c 0.391 0.391 0.391 1.023 0 1.414 C 81.519 81.758 81.263 81.856 81.007 81.856 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 39.138 43.512 c -0.256 0 -0.512 -0.098 -0.707 -0.293 l -26.69 -26.69 l -5.818 -1.89 c -0.239 -0.078 -0.44 -0.243 -0.563 -0.462 L 0.138 4.874 c -0.219 -0.391 -0.152 -0.879 0.165 -1.196 l 3.224 -3.223 C 3.843 0.139 4.333 0.071 4.723 0.29 l 9.303 5.221 c 0.219 0.123 0.384 0.324 0.462 0.563 l 1.89 5.818 l 26.69 26.69 c 0.391 0.391 0.391 1.023 0 1.414 c -0.391 0.391 -1.023 0.391 -1.414 0 l -26.859 -26.86 c -0.112 -0.111 -0.195 -0.248 -0.244 -0.398 l -1.843 -5.675 l -8.302 -4.66 L 2.252 4.556 l 4.66 8.302 l 5.675 1.843 c 0.15 0.049 0.287 0.132 0.398 0.244 l 26.86 26.86 c 0.391 0.391 0.391 1.023 0 1.414 C 39.65 43.415 39.394 43.512 39.138 43.512 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg>

                    </div>
                    <?php esc_html_e( 'Advanced Settings', 'fancy-post-grid' ); ?>
                </a>
            </li>
            
            <li>
                <a href="#tab-5" class="fpg-nav-tab">
                    <div class="fpg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" viewBox="0 0 256 256" xml:space="preserve">
                        <defs></defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path d="M 50.004 2.245 c 19.73 2.292 35.46 18.022 37.751 37.751 H 50.004 V 2.245 M 48.004 0.055 v 41.941 h 41.941 C 88.463 19.509 70.491 1.537 48.004 0.055 L 48.004 0.055 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 87.755 50.004 c -1.275 10.994 -6.739 21.059 -15.276 28.143 L 54.213 50.004 H 87.755 M 89.945 48.004 H 50.53 l 21.465 33.071 C 82.209 73.419 89.054 61.525 89.945 48.004 L 89.945 48.004 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 39.996 2.245 v 39.9 L 5.637 62.446 C 3.186 56.943 1.945 51.084 1.945 45 C 1.945 23.118 18.491 4.737 39.996 2.245 M 41.996 0.055 C 18.515 1.603 -0.055 21.127 -0.055 45 c 0 7.298 1.746 14.184 4.826 20.282 l 37.226 -21.996 V 0.055 L 41.996 0.055 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                            <path d="M 43.415 51.749 l 20.669 31.846 C 58.176 86.518 51.622 88.055 45 88.055 c -13.481 0 -26.135 -6.315 -34.268 -16.995 L 43.415 51.749 M 44.049 49.051 L 7.827 70.454 C 15.946 82.289 29.564 90.055 45 90.055 c 7.973 0 15.457 -2.079 21.954 -5.713 L 44.049 49.051 L 44.049 49.051 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #A3ACB9; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"></path>
                        </g>
                    </svg>
                    </div>
                    <?php esc_html_e( 'Style', 'fancy-post-grid' ); ?>
                </a>
            </li>
        </ul>
        
        <div id="tab-1" class="fpg-tab-content active">
            
            <!-- Layout Type -->
            <div class="fpg-post-type fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Post Type:', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select">
                        <label for="fancy_post_type"><?php esc_html_e( 'Type:', 'fancy-post-grid' ); ?></label>
                        <select id="fancy_post_type" name="fancy_post_type" style="width: 100%;">
                            <option value="post" <?php selected( $fancy_post_type, 'post' ); ?>><?php esc_html_e( 'Post', 'fancy-post-grid' ); ?></option>
                            
                        </select>
                    </div> 
                </fieldset>
            </div>

            <!-- Filters -->
            <div class="fpg-common-filters fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Common Filters:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-common-filters-box">
                        <div class="fpg-margin-box">
                            <label for="fpg_include_only"><?php esc_html_e( 'Include only:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fpg_include_only" name="fpg_include_only" value="<?php echo esc_attr( $fpg_include_only ); ?>" placeholder="1,2,3" />
                            <p><?php esc_html_e( 'List of post IDs to show (comma-separated values, for example: 1,2,3)', 'fancy-post-grid' ); ?></p>
                        </div> 

                        <div class="fpg-margin-box">
                            <label for="fpg_exclude"><?php esc_html_e( 'Exclude:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fpg_exclude" name="fpg_exclude" value="<?php echo esc_attr( $fpg_exclude ); ?>" placeholder="1,2,3" />
                            <p><?php esc_html_e( 'List of post IDs to hide (comma-separated values, for example: 1,2,3)', 'fancy-post-grid' ); ?></p>
                        </div> 

                        <div class="fpg-margin-box">
                            <label for="fpg_limit"><?php esc_html_e( 'Limit:', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fpg_limit" name="fpg_limit" value="<?php echo esc_attr( $fpg_limit ); ?>" placeholder="5" />
                            <p><?php esc_html_e( 'The number of posts to show. Set empty to show all found posts.', 'fancy-post-grid' ); ?></p>
                        </div> 
                    </div> 

                     
                </fieldset>
            </div>

            <!-- Advanced Filters -->
            <div class="fpg-advanced-filters fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Advanced Filters:', 'fancy-post-grid' ); ?></legend>
                        <!-- Taxonomy -->
                        <fieldset>
                            <legend><?php esc_html_e( 'Taxonomy:', 'fancy-post-grid' ); ?></legend>
                            <div class="fpg-field-group fpg-common">
                                <input type="checkbox" id="fpg_field_group_category" name="fpg_field_group_taxonomy[]" value="category" <?php checked( in_array( 'category', (array) $fpg_field_group_taxonomy ) ); ?> />
                                <label for="fpg_field_group_category">
                                    <span></span>
                                    <?php esc_html_e( 'Category', 'fancy-post-grid' ); ?>
                                </label>
                            </div>
                            <div class="fpg-field-group fpg-common">
                                <input type="checkbox" id="fpg_field_group_tags" name="fpg_field_group_taxonomy[]" value="tags" <?php checked( in_array( 'tags', (array) $fpg_field_group_taxonomy ) ); ?> />
                                <label for="fpg_field_group_tags">
                                    <span></span>
                                    <?php esc_html_e( 'Tags', 'fancy-post-grid' ); ?>
                                </label>
                            </div>
                            <fieldset id="fpg-terms">
                                <legend><?php esc_html_e( 'Terms:', 'fancy-post-grid' ); ?></legend>
                                <!-- Category Terms -->
                                <div id="fpg_category_terms" class="fpg-terms-select2" style="display: none;">
                                    <label for="fpg_filter_category_terms"><?php esc_html_e( 'Select Categories:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_filter_category_terms" name="fpg_filter_category_terms[]" multiple="multiple" style="width: 100%;">
                                        <?php
                                        $categories = get_categories( array(
                                            'hide_empty' => false,
                                        ) );
                                        foreach ( $categories as $category ) {
                                            echo '<option value="' . esc_attr( $category->term_id ) . '" ' . (in_array( $category->term_id, (array) $fpg_filter_category_terms ) ? 'selected="selected"' : '') . '>' . esc_html( $category->name ) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Category Operator -->
                                <div id="fpg_category_operator" class="fpg-terms-select2" style="display: none;">
                                    <label for="fpg_category_operator"><?php esc_html_e( 'Category Operator:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_category_operator" name="fpg_category_operator" style="width: 100%;">
                                        <option value="IN" <?php selected( $fpg_category_operator, 'IN' ); ?>><?php esc_html_e( 'IN — show posts which associate with one or more of selected terms', 'fancy-post-grid' ); ?></option>
                                        <option value="NOT IN" <?php selected( $fpg_category_operator, 'NOT IN' ); ?>><?php esc_html_e( 'NOT IN — show posts which do not associate with any of selected terms', 'fancy-post-grid' ); ?></option>
                                        <option value="AND" <?php selected( $fpg_category_operator, 'AND' ); ?>><?php esc_html_e( 'AND', 'fancy-post-grid' ); ?></option>
                                    </select>
                                </div>

                                <!-- Tags Terms -->
                                <div id="fpg_tags_terms" class="fpg-terms-select2" style="display: none;">
                                    <label for="fpg_filter_tags_terms"><?php esc_html_e( 'Select Tags:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_filter_tags_terms" name="fpg_filter_tags_terms[]" multiple="multiple" style="width: 100%;">
                                        <?php
                                        $tags = get_tags( array(
                                            'hide_empty' => false,
                                        ) );
                                        foreach ( $tags as $tag ) {
                                            echo '<option value="' . esc_attr( $tag->term_id ) . '" ' . (in_array( $tag->term_id, (array) $fpg_filter_tags_terms ) ? 'selected="selected"' : '') . '>' . esc_html( $tag->name ) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Tags Operator -->
                                <div id="fpg_tags_operator" class="fpg-terms-select2" style="display: none;">
                                    <label for="fpg_tags_operator"><?php esc_html_e( 'Tags Operator:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_tags_operator" name="fpg_tags_operator" style="width: 100%;">
                                        <option value="IN" <?php selected( $fpg_tags_operator, 'IN' ); ?>><?php esc_html_e( 'IN — show posts which associate with one or more of selected terms', 'fancy-post-grid' ); ?></option>
                                        <option value="NOT IN" <?php selected( $fpg_tags_operator, 'NOT IN' ); ?>><?php esc_html_e( 'NOT IN — show posts which do not associate with any of selected terms', 'fancy-post-grid' ); ?></option>
                                        <option value="AND" <?php selected( $fpg_tags_operator, 'AND' ); ?>><?php esc_html_e( 'AND — show posts which associate with all of selected terms', 'fancy-post-grid' ); ?></option>
                                    </select>
                                </div>
                            </fieldset>    
                            <!-- Relation -->
                            <div id="fpg_relation" class="fpg-terms-select2" style="display: none;">
                                <label for="fpg_relation"><?php esc_html_e( 'Relation:', 'fancy-post-grid' ); ?></label>
                                <select id="fpg_relation" name="fpg_relation" style="width: 100%;">
                                    <option value="OR" <?php selected( $fpg_relation, 'OR' ); ?>><?php esc_html_e( 'OR — show posts which match one or more settings', 'fancy-post-grid' ); ?></option>
                                    
                                    <option value="AND" <?php selected( $fpg_relation, 'AND' ); ?>><?php esc_html_e( 'AND — show posts which match all settings', 'fancy-post-grid' ); ?></option>
                                </select>
                            </div>
                        </fieldset> 
                        <!-- Order  -->
                        <fieldset>
                            <legend><?php esc_html_e( 'Order:', 'fancy-post-grid' ); ?></legend>
                            <div class="fpg-common-order-box">

                                <!-- Order By -->
                                <div class="fpg-order-by fpg-common">
                                    <label for="fpg_order_by"><?php esc_html_e( 'Order By:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_order_by" name="fpg_order_by" style="width: 100%;">
                                        <option value="title" <?php selected( $fpg_order_by, 'title' ); ?>><?php esc_html_e( 'Title', 'fancy-post-grid' ); ?></option>
                                        <option value="date" <?php selected( $fpg_order_by, 'date' ); ?>><?php esc_html_e( 'Create Date', 'fancy-post-grid' ); ?></option>
                                        <option value="modified" <?php selected( $fpg_order_by, 'modified' ); ?>><?php esc_html_e( 'Modified Date', 'fancy-post-grid' ); ?></option>
                                        <option value="menu_order" <?php selected( $fpg_order_by, 'menu_order' ); ?>><?php esc_html_e( 'Menu Order', 'fancy-post-grid' ); ?></option>
                                    </select>
                                </div>

                                <!-- Order -->
                                <div class="fpg-order fpg-common">
                                    <label for="fpg_order"><?php esc_html_e( 'Order:', 'fancy-post-grid' ); ?></label>
                                    <select id="fpg_order" name="fpg_order" style="width: 100%;">
                                        <option value="ASC" <?php selected( $fpg_order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'fancy-post-grid' ); ?></option>
                                        <option value="DESC" <?php selected( $fpg_order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'fancy-post-grid' ); ?></option>
                                    </select>
                                </div>

                            </div>
                        </fieldset>   
                        <!-- Author  -->
                        <fieldset>
                            <legend><?php esc_html_e( 'Author:', 'fancy-post-grid' ); ?></legend>
                            <!-- Author Terms -->
                            <div id="fpg_author_terms" class="fpg-terms-select2">
                                <label for="fpg_filter_authors"><?php esc_html_e( 'Select Authors:', 'fancy-post-grid' ); ?></label>
                                <select id="fpg_filter_authors" name="fpg_filter_authors[]" multiple="multiple" style="width: 100%;">
                                    <?php
                                    $authors = get_users( array(
                                        'who' => 'authors',
                                    ) );
                                    foreach ( $authors as $author ) {
                                        echo '<option value="' . esc_attr( $author->ID ) . '" ' . (in_array( $author->ID, (array) $fpg_filter_authors ) ? 'selected="selected"' : '') . '>' . esc_html( $author->display_name ) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </fieldset> 
                        <!-- Status Terms -->
                        
                        <fieldset>
                            <legend><?php esc_html_e( 'Status:', 'fancy-post-grid' ); ?></legend>
                            <div id="fpg_status_terms" class="fpg-terms-select2">
                                <label for="fpg_filter_statuses"><?php esc_html_e( 'Select Statuses:', 'fancy-post-grid' ); ?></label>
                                <select id="fpg_filter_statuses" name="fpg_filter_statuses[]" multiple="multiple" style="width: 100%;">
                                    <?php
                                    // Ensure $fpg_filter_statuses is properly initialized
                                    $fpg_filter_statuses = isset($fpg_filter_statuses) ? (array) $fpg_filter_statuses : array();

                                    // Define available statuses
                                    $statuses = array(
                                        'publish' => 'Published',
                                        'pending' => 'Pending',
                                        'draft' => 'Draft',
                                        'private' => 'Private',
                                        'trash' => 'Trash',
                                        'auto-draft' => 'Auto Draft',
                                    );

                                    // Loop through statuses and output options
                                    foreach ( $statuses as $status => $label ) {
                                        echo '<option value="' . esc_attr( $status ) . '" ' . selected( in_array( $status, $fpg_filter_statuses ), true, false ) . '>' . esc_html( $label ) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </fieldset> 
                        
                        
                </fieldset>                  
            </div>
        </div>

        <div id="tab-2" class="fpg-tab-content">
            <div class="fpg-field-selection fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Field Selection', 'fancy-post-grid' ); ?></legend>

                    <!-- Field Group Checkboxes -->
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_title" name="fpg_field_group_title" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_title', true ), '1' ); ?> />
                        <label for="fpg_field_group_title">
                            <span></span>
                            <?php esc_html_e( 'Title', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_excerpt" name="fpg_field_group_excerpt" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_excerpt', true ), '1' ); ?> />
                        <label for="fpg_field_group_excerpt">
                            <span></span>
                            <?php esc_html_e( 'Excerpt', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_read_more" name="fpg_field_group_read_more" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_read_more', true ), '1' ); ?> />
                        <label for="fpg_field_group_read_more">
                            <span></span>
                            <?php esc_html_e( 'Read More', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_image" name="fpg_field_group_image" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_image', true ), '1' ); ?> />
                        <label for="fpg_field_group_image">
                            <span></span>
                            <?php esc_html_e( 'Image', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_post_date" name="fpg_field_group_post_date" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_post_date', true ), '1' ); ?> />
                        <label for="fpg_field_group_post_date">
                            <span></span>
                            <?php esc_html_e( 'Post Date', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_author" name="fpg_field_group_author" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_author', true ), '1' ); ?> />
                        <label for="fpg_field_group_author">
                            <span></span>
                            <?php esc_html_e( 'Author', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_categories" name="fpg_field_group_categories" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_categories', true ), '1' ); ?> />
                        <label for="fpg_field_group_categories">
                            <span></span>
                            <?php esc_html_e( 'Categories', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_tag" name="fpg_field_group_tag" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_tag', true ), '1' ); ?> />
                        <label for="fpg_field_group_tag">                            
                            <span></span>
                            <?php esc_html_e( 'Tags', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <input type="checkbox" id="fpg_field_group_comment_count" name="fpg_field_group_comment_count" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_comment_count', true ), '1' ); ?> />
                        <label for="fpg_field_group_comment_count">
                            <span></span>
                            <?php esc_html_e( 'Comment Count', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                </fieldset>
            </div>
        </div>

        <div id="tab-3" class="fpg-tab-content">
            
            <!-- Layout Type -->
            <div class="fpg-layout-select-post fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Layout Type:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-radio-list">
                        <input type="radio" id="fpg_layout_grid" name="fpg_layout_select" value="grid" <?php checked( $fpg_layout_select, 'grid', true ); ?> />
                        <label for="fpg_layout_grid">
                            <span></span>
                            <img class="fpg_logo" src="<?php echo plugins_url( 'img/grid_style_main.png', __FILE__ ); ?>" alt="Grid Style">
                            <p><?php esc_html_e( 'Grid', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                    <div class="fpg-radio-list">
                        <input type="radio" id="fpg_layout_slider" name="fpg_layout_select" value="slider" <?php checked( $fpg_layout_select, 'slider',true ); ?> />
                        <label for="fpg_layout_slider">
                            <span></span>
                            <img class="fpg_logo" src="<?php echo plugins_url( 'img/slider_style_main.png', __FILE__ ); ?>" alt="Slider Style">
                            <p><?php esc_html_e( 'Slider', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                </fieldset>
            </div>

            <!-- Grid Layout Settings -->
            <div class="fancy-post-grid-style fpg-common" id="fancy_post_grid_style">
                <fieldset>
                    <legend><?php esc_html_e( 'Grid Layout:', 'fancy-post-grid' ); ?></legend>
                    <?php
                    $styles = [
                        'style1' => 'Grid Layout 1',
                        'style2' => 'Grid Layout 2',
                        'style3' => 'Grid Layout 3',
                        'style4' => 'Grid Layout 4',
                        'style5' => 'Grid Layout 5',
                        'style6' => 'Grid Layout 6',
                        'style7' => 'Grid Layout 7',
                        'style8' => 'Grid Layout 8',
                        'style9' => 'Grid Layout 9',
                        'style10' => 'Grid Layout 10',
                        'style11' => 'Grid Layout 11',
                        'style12' => 'Grid Layout 12',
                        
                    ];

                    foreach ($styles as $style_value => $style_label) :
                        $image_url = plugins_url( 'img/' . $style_value . '.png', __FILE__ );
                    ?>
                        <div class="fpg-radio-list">
                            <input type="radio" id="fancy_post_grid_style_<?php echo esc_attr($style_value); ?>" name="fancy_post_grid_style" value="<?php echo esc_attr($style_value); ?>" <?php checked($fancy_post_grid_style, $style_value); ?> />
                            <label for="fancy_post_grid_style_<?php echo esc_attr($style_value); ?>">
                                <span></span>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($style_label); ?>" style="max-width: 50px; max-height: 50px; vertical-align: middle;">
                                <p><?php echo esc_html($style_label); ?></p>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            </div>

            <!-- Slider Layout Settings -->
            <div class="fancy-post-grid-style fpg-common" id="fancy_post_slider_style">
                <fieldset>
                    <legend><?php esc_html_e( 'Slider Layout:', 'fancy-post-grid' ); ?></legend>
                    <?php
                    $styles = [
                        'style1' => 'Slider Layout 1',
                        'style2' => 'Slider Layout 2',
                        'style3' => 'Slider Layout 3',
                        'style4' => 'Slider Layout 4',
                        'style5' => 'Slider Layout 5',
                        'style6' => 'Slider Layout 6',
                        'style7' => 'Slider Layout 7',
                    ];

                    foreach ($styles as $style_value => $style_label) :
                        $image_url = plugins_url( 'img/' . $style_value . '.png', __FILE__ );
                    ?>
                        <div class="fpg-radio-list">
                            <input type="radio" id="fancy_slider_style_<?php echo esc_attr($style_value); ?>" name="fancy_slider_style" value="<?php echo esc_attr($style_value); ?>" <?php checked($fancy_slider_style, $style_value); ?> />
                            <label for="fancy_slider_style_<?php echo esc_attr($style_value); ?>">
                                <span></span>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($style_label); ?>" style="max-width: 50px; max-height: 50px; vertical-align: middle;">
                                <p><?php echo esc_html($style_label); ?></p>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            </div>

            <!-- Column Grid Settings -->
            <div class="fancy-post-column fpg-common" id="fancy_post_column_grid">
                <fieldset>
                    <legend><?php esc_html_e( 'Column Settings:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_lg"><?php esc_html_e( 'Large Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_lg" name="fancy_post_cl_lg" style="width: 100%;">
                                <option value="12" <?php selected( $fancy_post_cl_lg, '12' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_lg, '6' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_lg, '4' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_lg, '3' ); ?>><?php esc_html_e( '4 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_lg, '2' ); ?>><?php esc_html_e( '6 Columns', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_md"><?php esc_html_e( 'Medium Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_md" name="fancy_post_cl_md" style="width: 100%;">
                                <option value="12" <?php selected( $fancy_post_cl_md, '12' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_md, '6' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_md, '4' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_md, '3' ); ?>><?php esc_html_e( '4 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_md, '2' ); ?>><?php esc_html_e( '6 Columns', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_sm"><?php esc_html_e( 'Small Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_sm" name="fancy_post_cl_sm" style="width: 100%;">

                                <option value="12" <?php selected( $fancy_post_cl_sm, '12' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_sm, '6' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_sm, '4' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_mobile"><?php esc_html_e( 'Mobile Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_mobile" name="fancy_post_cl_mobile" style="width: 100%;">
                                <option value="12" <?php selected( $fancy_post_cl_mobile, '12' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_mobile, '6' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_mobile, '4' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>                                
                            </select>
                        </div>
                    </div>                    
                </fieldset>
            </div>

            <!-- Column Slider Settings -->
            <div class="fancy-post-column fpg-common" id="fancy_post_column_slider">
                <fieldset>
                    <legend><?php esc_html_e( 'Column Settings:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_lg_slider"><?php esc_html_e( 'Large Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_lg_slider" name="fancy_post_cl_lg_slider" style="width: 100%;">
                                <option value="1" <?php selected( $fancy_post_cl_lg_slider, '1' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_lg_slider, '2' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_lg_slider, '3' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_lg_slider, '4' ); ?>><?php esc_html_e( '4 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_lg_slider, '6' ); ?>><?php esc_html_e( '6 Columns', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_md_silder"><?php esc_html_e( 'Medium Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_md_silder" name="fancy_post_cl_md_silder" style="width: 100%;">
                                <option value="1" <?php selected( $fancy_post_cl_md_silder, '1' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_md_silder, '2' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_md_silder, '3' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_md_silder, '4' ); ?>><?php esc_html_e( '4 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_md_silder, '6' ); ?>><?php esc_html_e( '6 Columns', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_sm_slider"><?php esc_html_e( 'Small Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_sm_slider" name="fancy_post_cl_sm_slider" style="width: 100%;">

                                <option value="1" <?php selected( $fancy_post_cl_sm_slider, '1' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_sm_slider, '2' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_sm_slider, '3' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                
                            </select>
                        </div>
                        <div class="fpg-post-select">
                            <label for="fancy_post_cl_mobile_slider"><?php esc_html_e( 'Mobile Screen Column:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_cl_mobile_slider" name="fancy_post_cl_mobile_slider" style="width: 100%;">
                                <option value="1" <?php selected( $fancy_post_cl_mobile_slider, '1' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_mobile_slider, '2' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_mobile_slider, '3' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>                                
                            </select>
                        </div>
                    </div>                    
                </fieldset>
            </div>

            <!-- Pagination -->
            <div class="fpg-pagination fpg-common" id="fpg_pagination">
                <fieldset>
                    <legend><?php esc_html_e( 'Pagination:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-container">
                        <div class="switch switch--horizontal">
                            <input id="fancy_post_pagination_off" type="radio" name="fancy_post_pagination" value="off" <?php checked( $fancy_post_pagination, 'off' ); ?> />
                            <label for="fancy_post_pagination_off"><?php esc_html_e( 'Off', 'fancy-post-grid' ); ?></label>
                            
                            <input id="fancy_post_pagination_on" type="radio" name="fancy_post_pagination" value="on" <?php checked( $fancy_post_pagination, 'on' ); ?> />
                            <label for="fancy_post_pagination_on"><?php esc_html_e( 'On', 'fancy-post-grid' ); ?></label>
                            <span class="toggle-outside">
                                <span class="toggle-inside"></span>
                            </span>                            
                        </div>
                    </div>
                </fieldset>
                <fieldset id="fpg_post_per_page_fieldset">
                    <legend><?php esc_html_e( 'Post Per Page:', 'fancy-post-grid' ); ?></legend>
                    <input type="text" id="fpg_post_per_page" name="fpg_post_per_page" value="<?php echo esc_attr( $fpg_post_per_page ); ?>" placeholder="-1" />
                </fieldset>
            </div>

            <!-- link-page -->
            <div class="fpg-link-page fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Link To Detail Page:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-container">
                        <div class="switch switch--horizontal">
                            <input id="fancy_link_details_off" type="radio" name="fancy_link_details" value="off" <?php checked( $fancy_link_details, 'off' ); ?> />
                            <label for="fancy_link_details_off"><?php esc_html_e( 'Off', 'fancy-post-grid' ); ?></label>
                            
                            <input id="fancy_link_details_on" type="radio" name="fancy_link_details" value="on" <?php checked( $fancy_link_details, 'on' ); ?> />
                            <label for="fancy_link_details_on"><?php esc_html_e( 'On', 'fancy-post-grid' ); ?></label>
                            <span class="toggle-outside">
                                <span class="toggle-inside"></span>
                            </span>                            
                        </div>
                    </div>
                </fieldset>

                
                <fieldset>
                    <legend><?php esc_html_e( 'Link Target:', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-radio-list-wrapper fpg-radio-list">
                        <input type="radio" id="fancy_link_target_same" name="fancy_link_target" value="same" <?php checked( $fancy_link_target, 'same', true ); ?> />
                        <label for="fancy_link_target_same">
                            <span></span>
                            <p><?php esc_html_e( 'Same Window', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                    <div class="fpg-radio-list-wrapper fpg-radio-list">
                        <input type="radio" id="fancy_link_target_new" name="fancy_link_target" value="new" <?php checked( $fancy_link_target, 'new',true ); ?> />
                        <label for="fancy_link_target_new">
                            <span></span>
                            <p><?php esc_html_e( 'New Window', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                </fieldset>
                
            </div>
        </div>

        <div id="tab-4" class="fpg-tab-content">           
            <div class="fpg-title-settings fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Title Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <!-- Title Tag Select -->
                        <div class="fpg-post-select">
                            <label for="fancy_post_title_tag"><?php esc_html_e( 'Title Tag:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_title_tag" name="fancy_post_title_tag" style="width: 100%;">
                                <option value="h1" <?php selected( $fancy_post_title_tag, 'h1' ); ?>><?php esc_html_e( 'H1', 'fancy-post-grid' ); ?></option>
                                <option value="h2" <?php selected( $fancy_post_title_tag, 'h2' ); ?>><?php esc_html_e( 'H2', 'fancy-post-grid' ); ?></option>
                                <option value="h3" <?php selected( $fancy_post_title_tag, 'h3' ); ?>><?php esc_html_e( 'H3', 'fancy-post-grid' ); ?></option>
                                <option value="h4" <?php selected( $fancy_post_title_tag, 'h4' ); ?>><?php esc_html_e( 'H4', 'fancy-post-grid' ); ?></option>
                                <option value="h5" <?php selected( $fancy_post_title_tag, 'h5' ); ?>><?php esc_html_e( 'H5', 'fancy-post-grid' ); ?></option>
                                <option value="h6" <?php selected( $fancy_post_title_tag, 'h6' ); ?>><?php esc_html_e( 'H6', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                        <div class="fpg-title-limit fpg-common">
                            <label for="fancy_post_title_limit"><?php esc_html_e( 'Title Word Limit:', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fancy_post_title_limit" name="fancy_post_title_limit" value="<?php echo esc_attr( $fancy_post_title_limit ); ?>" />
                        </div>

                        <div class="fpg-title-more-text fpg-common">
                            <label for="fancy_post_title_more_text"><?php esc_html_e( 'Title More Text:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_title_more_text" name="fancy_post_title_more_text" value="<?php echo esc_attr( $fancy_post_title_more_text ); ?>" placeholder="..." />
                        </div>
                        
                    </div>    
                </fieldset>
            </div>

            <div class="fpg-image-settings fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Image Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <!-- Hide Feature Image -->
                        <div class="fpg-hide-feature-image fpg-common">                       
                            <label><?php esc_html_e( 'Feature Image', 'fancy-post-grid' ); ?></label>
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_hide_feature_image_off" name="fancy_post_hide_feature_image" value="off" <?php checked( $fancy_post_hide_feature_image, 'off', true ); ?> />
                                    <label for="fancy_post_hide_feature_image_off">
                                        <span></span>
                                        <p><?php esc_html_e( 'Off', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_hide_feature_image_on" name="fancy_post_hide_feature_image" value="on" <?php checked( $fancy_post_hide_feature_image, 'on',true ); ?> />
                                    <label for="fancy_post_hide_feature_image_on">
                                        <span></span>
                                        <p><?php esc_html_e( 'On', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                            </div>                       
                        </div>
                        
                        <!-- Feature Image Size -->
                        <div class="fpg-feature-image-size fpg-common" id="fpg-feature-image-size">
                            <label for="fancy_post_feature_image_size"><?php esc_html_e( 'Feature Image Size:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_feature_image_size" name="fancy_post_feature_image_size" style="width: 100%;">
                                <?php 
                                
                                $sizes = [
                                    'thumbnail' => 'thumbnail',
                                    'medium' => 'medium',
                                    'medium_large' => 'medium_large',
                                    'large' => 'large',
                                    'full' => 'full',                                    
                                    
                                ];
                                foreach ($sizes as $size) {
                                    echo '<option value="' . esc_attr($size) . '" ' . selected($fancy_post_feature_image_size, $size, false) . '>' . esc_html($size) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Media Source -->
                        <div class="fpg-media-source fpg-common" id="fpg-media-source">
                            
                            <label><?php esc_html_e( 'Media Source', 'fancy-post-grid' ); ?></label>
                            
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_media_source_feature_image" name="fancy_post_media_source" value="feature_image" <?php checked( $fancy_post_media_source, 'feature_image', true ); ?> />
                                    <label for="fancy_post_media_source_feature_image">
                                        <span></span>
                                        <p><?php esc_html_e( 'Feature Image', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_media_source_first_image" name="fancy_post_media_source" value="first_image" <?php checked( $fancy_post_media_source, 'first_image',true ); ?> />
                                    <label for="fancy_post_media_source_first_image">
                                        <span></span>
                                        <p><?php esc_html_e( 'First Image From Content', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                            </div>                      
                        </div>

                        <!-- Hover Animation -->
                        <div class="fpg-hover-animation fpg-common" id="fpg-hover-animation">
                            <label for="fancy_post_hover_animation"><?php esc_html_e( 'Hover Animation:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_post_hover_animation" name="fancy_post_hover_animation" style="width: 100%;">
                                <option value="none" <?php selected( $fancy_post_hover_animation, 'none' ); ?>><?php esc_html_e( 'None', 'fancy-post-grid' ); ?></option>
                                <option value="zoom_in" <?php selected( $fancy_post_hover_animation, 'zoom_in' ); ?>><?php esc_html_e( 'Zoom In', 'fancy-post-grid' ); ?></option>
                                <option value="zoom_out" <?php selected( $fancy_post_hover_animation, 'zoom_out' ); ?>><?php esc_html_e( 'Zoom Out', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                    </div>    
                </fieldset>
            </div>

            <div class="fpg-excerpt-settings fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Excerpt Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <!-- Excerpt Word Limit -->
                        <div class="fpg-excerpt-limit fpg-common">
                            <label for="fancy_post_excerpt_limit"><?php esc_html_e( 'Excerpt Word Limit:', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fancy_post_excerpt_limit" name="fancy_post_excerpt_limit" value="<?php echo esc_attr( $fancy_post_excerpt_limit ); ?>" />
                        </div>        
                        <!-- Excerpt More Text -->
                        <div class="fpg-excerpt-more-text fpg-common">
                            <label for="fancy_post_excerpt_more_text"><?php esc_html_e( 'Excerpt More Text:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_excerpt_more_text" name="fancy_post_excerpt_more_text" value="<?php echo esc_attr( $fancy_post_excerpt_more_text ); ?>" placeholder="..." />
                        </div>
                    </div>    
                </fieldset>
            </div>
            <div class="fpg-read-more-button-settings fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Read More Button Settings', 'fancy-post-grid' ); ?></legend>

                    <div class="fpg-button-option fpg-common" id="fpg-button-option">
                        <label for="fancy_button_option"><?php esc_html_e( 'Button Layout:', 'fancy-post-grid' ); ?></label>
                        <select id="fancy_button_option" name="fancy_button_option">
                            <option value="filled" <?php selected( $fancy_button_option, 'filled' ); ?>><?php esc_html_e( 'Filled', 'fancy-post-grid' ); ?></option>
                            <option value="border" <?php selected( $fancy_button_option, 'border' ); ?>><?php esc_html_e( 'Border', 'fancy-post-grid' ); ?></option>
                            <option value="flat" <?php selected( $fancy_button_option, 'flat' ); ?>><?php esc_html_e( 'Flat', 'fancy-post-grid' ); ?></option>
                        </select>
                    </div>

                    <div class="fpg-post-select-main" id="fpg_post_select_button">
                        <!-- Border Radius -->
                        <div class="fpg-read-more-border-radius fpg-common">
                            <label for="fancy_post_read_more_border_radius"><?php esc_html_e( 'Border Radius:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_read_more_border_radius" name="fancy_post_read_more_border_radius" value="<?php echo esc_attr( $fancy_post_read_more_border_radius ); ?>" placeholder="e.g., 2px 3px 4px 5px" />
                        </div>

                        <!-- button padding -->
                        <div class="fpg-read-more-padding fpg-common">
                            <label for="fancy_post_button_padding"><?php esc_html_e( 'Padding:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_button_padding" name="fancy_post_button_padding" value="<?php echo esc_attr( $fancy_post_button_padding ); ?>"placeholder="e.g., 2px 3px 4px 5px"  />
                        </div>
                        <!-- Border width -->
                        <div class="fpg-read-more-button-width fpg-common">
                            <label for="fancy_post_border_width"><?php esc_html_e( 'Border Width:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_border_width" name="fancy_post_border_width" value="<?php echo esc_attr( $fancy_post_border_width ); ?>"placeholder="e.g., 2px 3px 4px 5px"  />
                        </div>

                        <div class="fpg-button-border-style fpg-common" id="fpg-button-border-style">
                            <label for="fancy_button_border_style"><?php esc_html_e( 'Border Style:', 'fancy-post-grid' ); ?></label>
                            <select id="fancy_button_border_style" name="fancy_button_border_style">
                                <option value="dotted" <?php selected( $fancy_button_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'fancy-post-grid' ); ?></option>
                                <option value="dashed" <?php selected( $fancy_button_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'fancy-post-grid' ); ?></option>
                                <option value="solid" <?php selected( $fancy_button_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'fancy-post-grid' ); ?></option>
                                <option value="double" <?php selected( $fancy_button_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'fancy-post-grid' ); ?></option>
                                <option value="groove" <?php selected( $fancy_button_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'fancy-post-grid' ); ?></option>
                                
                            </select>
                        </div>
                    </div>  
                    <div class="fpg-post-select-main">
                        <!-- Alignment -->
                        <div class="fpg-read-more-alignment fpg-common">
                            
                            <label for="fancy_post_read_more_alignment"><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></label>
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_read_more_alignment_left" name="fancy_post_read_more_alignment" value="left" <?php checked( $fancy_post_read_more_alignment, 'left', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_left">
                                        <span></span>
                                        <p><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_read_more_alignment_center" name="fancy_post_read_more_alignment" value="center" <?php checked( $fancy_post_read_more_alignment, 'center', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_center">
                                        <span></span>
                                        <p><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper fpg-radio-list">
                                    <input type="radio" id="fancy_post_read_more_alignment_right" name="fancy_post_read_more_alignment" value="right" <?php checked( $fancy_post_read_more_alignment, 'right', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_right">
                                        <span></span>
                                        <p><?php esc_html_e( 'Right', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Button Text -->
                        <div class="fpg-read-more-text fpg-common">
                            <label for="fancy_post_read_more_text"><?php esc_html_e( 'Read More Text:', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fancy_post_read_more_text" name="fancy_post_read_more_text" value="<?php echo esc_attr( $fancy_post_read_more_text ); ?>" />
                        </div>
                    </div>  
                </fieldset>
            </div>
        </div>

        <div id="tab-5" class="fpg-tab-content">
            
            <div class="fancy-post-grid-button fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Button Color', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-color-box-wrapper">
                        <div class="fpg-color-box" id="fpg_button_bg_color">
                            <label for="fpg_button_background_color"><?php esc_html_e( 'Background:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_background_color" name="fpg_button_background_color" value="<?php echo esc_attr( $fpg_button_background_color ); ?>" />
                        </div>

                        <div class="fpg-color-box" id="fpg_button_bg_hover_color">
                            <label for="fpg_button_hover_background_color"><?php esc_html_e( 'Hover Background:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_hover_background_color" name="fpg_button_hover_background_color" value="<?php echo esc_attr( $fpg_button_hover_background_color ); ?>" />
                        </div>

                        <div class="fpg-color-box">
                            <label for="fpg_button_text_color"><?php esc_html_e( 'Text Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_text_color" name="fpg_button_text_color" value="<?php echo esc_attr( $fpg_button_text_color ); ?>" />
                        </div>

                        <div class="fpg-color-box">
                            <label for="fpg_button_text_hover_color"><?php esc_html_e( 'Text Hover Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_text_hover_color" name="fpg_button_text_hover_color" value="<?php echo esc_attr( $fpg_button_text_hover_color ); ?>" />
                        </div>

                        <div class="fpg-color-box" id="fpg_button_br_color">
                            <label for="fpg_button_border_color"><?php esc_html_e( 'Border Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_border_color" name="fpg_button_border_color" value="<?php echo esc_attr( $fpg_button_border_color ); ?>" />
                        </div>
                    </div>
                       
                </fieldset>
            </div>
            <div class="fancy-post-grid-full-area fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Full Area / Section', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select-main">
                        <!-- Background Color -->
                        <div class="fpg-color-box">
                            <label for="fpg_section_background_color"><?php esc_html_e( 'Background Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_section_background_color" name="fpg_section_background_color" value="<?php echo esc_attr( $fpg_section_background_color ); ?>" />
                        </div>

                        <!-- Margin -->
                        <div class="fpg-margin-box">
                            <label for="fpg_section_margin"><?php esc_html_e( 'Margin (space-separated):', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fpg_section_margin" name="fpg_section_margin" value="<?php echo esc_attr( $fpg_section_margin ); ?>" placeholder="e.g., 120px 30px 40px 50px" />
                        </div>

                        <!-- Padding -->
                        <div class="fpg-padding-box">
                            <label for="fpg_section_padding"><?php esc_html_e( 'Padding (space-separated):', 'fancy-post-grid' ); ?></label>
                            <input type="text" id="fpg_section_padding" name="fpg_section_padding" value="<?php echo esc_attr( $fpg_section_padding ); ?>" placeholder="e.g., 20px 30px 40px 50px" />
                        </div>
                    </div>    
                </fieldset>
            </div>

            <div class="fancy-post-grid-title fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Title Settings', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select-main">
                        <div class="fpg-color-box">
                            <label for="fpg_title_color"><?php esc_html_e( 'Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_title_color" name="fpg_title_color" value="<?php echo esc_attr( $fpg_title_color ); ?>" />
                        </div>

                        <div class="fpg-font-size-box">
                            <label for="fpg_title_font_size"><?php esc_html_e( 'Font Size (11-50px):', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fpg_title_font_size" name="fpg_title_font_size" min="11" max="50" value="<?php echo esc_attr( $fpg_title_font_size ); ?>" />
                        </div>

                        <div class="fpg-font-weight-box">
                            <label for="fpg_title_font_weight"><?php esc_html_e( 'Font Weight:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_title_font_weight" name="fpg_title_font_weight">
                                <?php 
                                $weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
                                foreach ( $weights as $weight ) {
                                    echo '<option value="' . esc_attr( $weight ) . '"' . selected( $fpg_title_font_weight, $weight, false ) . '>' . esc_html( $weight ) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="fpg-alignment-box">
                            <label for="fpg_title_alignment"><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_title_alignment" name="fpg_title_alignment">
                                <option value="left" <?php selected( $fpg_title_alignment, 'left' ); ?>><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></option>
                                <option value="center" <?php selected( $fpg_title_alignment, 'center' ); ?>><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></option>
                                <option value="right" <?php selected( $fpg_title_alignment, 'right' ); ?>><?php esc_html_e( 'Right', 'fancy-post-grid' ); ?></option>
                                <option value="justify" <?php selected( $fpg_title_alignment, 'justify' ); ?>><?php esc_html_e( 'Justify', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                    </div>    
                </fieldset>
            </div>
            <div class="fancy-post-grid-title-hover fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Title Hover Settings', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select-main">
                        <div class="fpg-color-box">
                            <label for="fpg_title_hover_color"><?php esc_html_e( 'Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_title_hover_color" name="fpg_title_hover_color" value="<?php echo esc_attr( $fpg_title_hover_color ); ?>" />
                        </div>

                        <div class="fpg-font-size-box">
                            <label for="fpg_title_hover_font_size"><?php esc_html_e( 'Font Size (11-50px):', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fpg_title_hover_font_size" name="fpg_title_hover_font_size" min="11" max="50" value="<?php echo esc_attr( $fpg_title_hover_font_size ); ?>" />
                        </div>

                        <div class="fpg-font-weight-box">
                            <label for="fpg_title_hover_font_weight"><?php esc_html_e( 'Font Weight:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_title_hover_font_weight" name="fpg_title_hover_font_weight">
                                <?php 
                                $weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
                                foreach ( $weights as $weight ) {
                                    echo '<option value="' . esc_attr( $weight ) . '"' . selected( $fpg_title_hover_font_weight, $weight, false ) . '>' . esc_html( $weight ) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="fpg-alignment-box">
                            <label for="fpg_title_hover_alignment"><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_title_hover_alignment" name="fpg_title_hover_alignment">
                                <option value="left" <?php selected( $fpg_title_hover_alignment, 'left' ); ?>><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></option>
                                <option value="center" <?php selected( $fpg_title_hover_alignment, 'center' ); ?>><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></option>
                                <option value="right" <?php selected( $fpg_title_hover_alignment, 'right' ); ?>><?php esc_html_e( 'Right', 'fancy-post-grid' ); ?></option>
                                <option value="justify" <?php selected( $fpg_title_hover_alignment, 'justify' ); ?>><?php esc_html_e( 'Justify', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fancy-post-grid-excerpt fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Excerpt Settings', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select-main">
                        <div class="fpg-color-box">
                            <label for="fpg_excerpt_color"><?php esc_html_e( 'Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_excerpt_color" name="fpg_excerpt_color" value="<?php echo esc_attr( $fpg_excerpt_color ); ?>" />
                        </div>

                        <div class="fpg-font-size-box">
                            <label for="fpg_excerpt_size"><?php esc_html_e( 'Font Size (11-50px):', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fpg_excerpt_size" name="fpg_excerpt_size" min="11" max="50" value="<?php echo esc_attr( $fpg_excerpt_size ); ?>" />
                        </div>

                        <div class="fpg-font-weight-box">
                            <label for="fpg_excerpt_font_weight"><?php esc_html_e( 'Font Weight:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_excerpt_font_weight" name="fpg_excerpt_font_weight">
                                <?php 
                                $weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
                                foreach ( $weights as $weight ) {
                                    echo '<option value="' . esc_attr( $weight ) . '"' . selected( $fpg_excerpt_font_weight, $weight, false ) . '>' . esc_html( $weight ) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="fpg-alignment-box">
                            <label for="fpg_excerpt_alignment"><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_excerpt_alignment" name="fpg_excerpt_alignment">
                                <option value="left" <?php selected( $fpg_excerpt_alignment, 'left' ); ?>><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></option>
                                <option value="center" <?php selected( $fpg_excerpt_alignment, 'center' ); ?>><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></option>
                                <option value="right" <?php selected( $fpg_excerpt_alignment, 'right' ); ?>><?php esc_html_e( 'Right', 'fancy-post-grid' ); ?></option>
                                <option value="justify" <?php selected( $fpg_excerpt_alignment, 'justify' ); ?>><?php esc_html_e( 'Justify', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fancy-post-grid-meta-data fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Meta Data Settings', 'fancy-post-grid' ); ?></legend>
                    
                    <div class="fpg-post-select-main">
                        <div class="fpg-color-box">
                            <label for="fpg_meta_color"><?php esc_html_e( 'Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_meta_color" name="fpg_meta_color" value="<?php echo esc_attr( $fpg_meta_color ); ?>" />
                        </div>

                        <div class="fpg-font-size-box">
                            <label for="fpg_meta_size"><?php esc_html_e( 'Font Size (11-50px):', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fpg_meta_size" name="fpg_meta_size" min="11" max="50" value="<?php echo esc_attr( $fpg_meta_size ); ?>" />
                        </div>

                        <div class="fpg-font-weight-box">
                            <label for="fpg_meta_font_weight"><?php esc_html_e( 'Font Weight:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_meta_font_weight" name="fpg_meta_font_weight">
                                <?php 
                                $weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
                                foreach ( $weights as $weight ) {
                                    echo '<option value="' . esc_attr( $weight ) . '"' . selected( $fpg_meta_font_weight, $weight, false ) . '>' . esc_html( $weight ) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="fpg-alignment-box">
                            <label for="fpg_meta_alignment"><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></label>
                            <select id="fpg_meta_alignment" name="fpg_meta_alignment">
                                <option value="left" <?php selected( $fpg_meta_alignment, 'left' ); ?>><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></option>
                                <option value="center" <?php selected( $fpg_meta_alignment, 'center' ); ?>><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></option>
                                <option value="right" <?php selected( $fpg_meta_alignment, 'right' ); ?>><?php esc_html_e( 'Right', 'fancy-post-grid' ); ?></option>
                                <option value="justify" <?php selected( $fpg_meta_alignment, 'justify' ); ?>><?php esc_html_e( 'Justify', 'fancy-post-grid' ); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Save metabox data when the post is saved.
 */
function fpg_save_metabox_data( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['fpg_metabox_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['fpg_metabox_nonce'], 'fpg_metabox_nonce' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'wp-fpg' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Update or delete post meta data as necessary.
    
    if ( isset( $_POST['fancy_post_type'] ) ) {
        update_post_meta( $post_id, 'fancy_post_type', sanitize_text_field( $_POST['fancy_post_type'] ) );
    }
    //Common Filters
    if ( isset( $_POST['fpg_include_only'] ) ) {
        update_post_meta( $post_id, 'fpg_include_only', sanitize_text_field( $_POST['fpg_include_only'] ) );
    }
    if ( isset( $_POST['fpg_exclude'] ) ) {
        update_post_meta( $post_id, 'fpg_exclude', sanitize_text_field( $_POST['fpg_exclude'] ) );
    }
    if ( isset( $_POST['fpg_limit'] ) ) {
        update_post_meta( $post_id, 'fpg_limit', sanitize_text_field( $_POST['fpg_limit'] ) );
    }
    
    // Advanced Filters
    //Categories
    if ( isset( $_POST['fpg_filter_categories'] ) ) {
        update_post_meta( $post_id, 'fpg_filter_categories', sanitize_text_field( $_POST['fpg_filter_categories'] ) );
    }
    if ( isset( $_POST['fpg_filter_tags'] ) ) {
        update_post_meta( $post_id, 'fpg_filter_tags', sanitize_text_field( $_POST['fpg_filter_tags'] ) );
    }
    
    // Sanitize user input.
    $new_category_terms = isset( $_POST['fpg_filter_category_terms'] ) ? array_map( 'sanitize_text_field', $_POST['fpg_filter_category_terms'] ) : array();
    $new_tags_terms = isset( $_POST['fpg_filter_tags_terms'] ) ? array_map( 'sanitize_text_field', $_POST['fpg_filter_tags_terms'] ) : array();
    $new_category_operator = isset( $_POST['fpg_category_operator'] ) ? sanitize_text_field( $_POST['fpg_category_operator'] ) : '';
    $new_tags_operator = isset( $_POST['fpg_tags_operator'] ) ? sanitize_text_field( $_POST['fpg_tags_operator'] ) : '';
    $new_filter_authors = isset( $_POST['fpg_filter_authors'] ) ? array_map( 'sanitize_text_field', $_POST['fpg_filter_authors'] ) : array();
    $new_filter_statuses = isset( $_POST['fpg_filter_statuses'] ) ? array_map( 'sanitize_text_field', $_POST['fpg_filter_statuses'] ) : array();


    // Update the meta fields.
    update_post_meta( $post_id, 'fpg_filter_category_terms', $new_category_terms );
    update_post_meta( $post_id, 'fpg_filter_tags_terms', $new_tags_terms );
    update_post_meta( $post_id, 'fpg_category_operator', $new_category_operator );
    update_post_meta( $post_id, 'fpg_tags_operator', $new_tags_operator );
    update_post_meta( $post_id, 'fpg_filter_authors', $new_filter_authors );
    update_post_meta( $post_id, 'fpg_filter_statuses', $new_filter_statuses );


    if ( isset( $_POST['fpg_relation'] ) ) {
        update_post_meta( $post_id, 'fpg_relation', sanitize_text_field( $_POST['fpg_relation'] ) );
    }
    

    if ( isset( $_POST['fpg_order_by'] ) ) {
        update_post_meta( $post_id, 'fpg_order_by', sanitize_text_field( $_POST['fpg_order_by'] ) );
    }
    if ( isset( $_POST['fpg_order'] ) ) {
        update_post_meta( $post_id, 'fpg_order', sanitize_text_field( $_POST['fpg_order'] ) );
    }

    if ( isset( $_POST['fpg_post_per_page'] ) ) {
        update_post_meta( $post_id, 'fpg_post_per_page', sanitize_text_field( $_POST['fpg_post_per_page'] ) );
    }
    //Layout
    if ( isset( $_POST['fpg_layout_select'] ) ) {
        update_post_meta( $post_id, 'fpg_layout_select', sanitize_text_field( $_POST['fpg_layout_select'] ) );
    }
    if ( isset( $_POST['fancy_post_grid_style'] ) ) {
        update_post_meta( $post_id, 'fancy_post_grid_style', sanitize_text_field( $_POST['fancy_post_grid_style'] ) );
    }
    if ( isset( $_POST['fancy_slider_style'] ) ) {
        update_post_meta( $post_id, 'fancy_slider_style', sanitize_text_field( $_POST['fancy_slider_style'] ) );
    }
    // Column
    if ( isset( $_POST['fancy_post_cl_lg'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_lg', sanitize_text_field( $_POST['fancy_post_cl_lg'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_md'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_md', sanitize_text_field( $_POST['fancy_post_cl_md'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_sm'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_sm', sanitize_text_field( $_POST['fancy_post_cl_sm'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_mobile'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_mobile', sanitize_text_field( $_POST['fancy_post_cl_mobile'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_lg_slider'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_lg_slider', sanitize_text_field( $_POST['fancy_post_cl_lg_slider'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_md_silder'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_md_silder', sanitize_text_field( $_POST['fancy_post_cl_md_silder'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_sm_slider'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_sm_slider', sanitize_text_field( $_POST['fancy_post_cl_sm_slider'] ) );
    }
    if ( isset( $_POST['fancy_post_cl_mobile_slider'] ) ) {
        update_post_meta( $post_id, 'fancy_post_cl_mobile_slider', sanitize_text_field( $_POST['fancy_post_cl_mobile_slider'] ) );
    }
    if ( isset( $_POST['fancy_post_pagination'] ) ) {
        update_post_meta( $post_id, 'fancy_post_pagination', sanitize_text_field( $_POST['fancy_post_pagination'] ) );
    }
    if ( isset( $_POST['fancy_link_details'] ) ) {
        update_post_meta( $post_id, 'fancy_link_details', sanitize_text_field( $_POST['fancy_link_details'] ) );
    }
    if ( isset( $_POST['fancy_link_target'] ) ) {
        update_post_meta( $post_id, 'fancy_link_target', sanitize_text_field( $_POST['fancy_link_target'] ) );
    }
    //tab3
    
    if ( isset( $_POST['fancy_post_title_tag'] ) ) {
        update_post_meta( $post_id, 'fancy_post_title_tag', sanitize_text_field( $_POST['fancy_post_title_tag'] ) );
    }
    if ( isset( $_POST['fancy_post_title_limit'] ) ) {
        update_post_meta( $post_id, 'fancy_post_title_limit', sanitize_text_field( $_POST['fancy_post_title_limit'] ) );
    }
    if ( isset( $_POST['fancy_post_title_more_text'] ) ) {
        update_post_meta( $post_id, 'fancy_post_title_more_text', sanitize_text_field( $_POST['fancy_post_title_more_text'] ) );
    }
    
    if ( isset( $_POST['fancy_post_hide_feature_image'] ) ) {
        update_post_meta( $post_id, 'fancy_post_hide_feature_image', sanitize_text_field( $_POST['fancy_post_hide_feature_image'] ) );
    }
    if ( isset( $_POST['fancy_post_feature_image_size'] ) ) {
        update_post_meta( $post_id, 'fancy_post_feature_image_size', sanitize_text_field( $_POST['fancy_post_feature_image_size'] ) );
    }
    if ( isset( $_POST['fancy_post_media_source'] ) ) {
        update_post_meta( $post_id, 'fancy_post_media_source', sanitize_text_field( $_POST['fancy_post_media_source'] ) );
    }
    if ( isset( $_POST['fancy_post_hover_animation'] ) ) {
        update_post_meta( $post_id, 'fancy_post_hover_animation', sanitize_text_field( $_POST['fancy_post_hover_animation'] ) );
    }
    
    if ( isset( $_POST['fancy_post_excerpt_more_text'] ) ) {
        update_post_meta( $post_id, 'fancy_post_excerpt_more_text', sanitize_text_field( $_POST['fancy_post_excerpt_more_text'] ) );
    }
    if ( isset( $_POST['fancy_post_excerpt_limit'] ) ) {
        update_post_meta( $post_id, 'fancy_post_excerpt_limit', sanitize_text_field( $_POST['fancy_post_excerpt_limit'] ) );
    }
    if ( isset( $_POST['fancy_button_option'] ) ) {
        update_post_meta( $post_id, 'fancy_button_option', sanitize_text_field( $_POST['fancy_button_option'] ) );
    }
    if ( isset( $_POST['fancy_button_border_style'] ) ) {
        update_post_meta( $post_id, 'fancy_button_border_style', sanitize_text_field( $_POST['fancy_button_border_style'] ) );
    }
    if ( isset( $_POST['fancy_post_button_padding'] ) ) {
        update_post_meta( $post_id, 'fancy_post_button_padding', sanitize_text_field( $_POST['fancy_post_button_padding'] ) );
    }
    if ( isset( $_POST['fancy_post_border_width'] ) ) {
        update_post_meta( $post_id, 'fancy_post_border_width', sanitize_text_field( $_POST['fancy_post_border_width'] ) );
    }
    if ( isset( $_POST['fancy_post_read_more_border_radius'] ) ) {
        update_post_meta( $post_id, 'fancy_post_read_more_border_radius', sanitize_text_field( $_POST['fancy_post_read_more_border_radius'] ) );
    }
    if ( isset( $_POST['fancy_post_read_more_alignment'] ) ) {
        update_post_meta( $post_id, 'fancy_post_read_more_alignment', sanitize_text_field( $_POST['fancy_post_read_more_alignment'] ) );
    }
    if ( isset( $_POST['fancy_post_read_more_text'] ) ) {
        update_post_meta( $post_id, 'fancy_post_read_more_text', sanitize_text_field( $_POST['fancy_post_read_more_text'] ) );
    }
    
    if ( isset( $_POST['fpg_field_group'] ) ) {
        $fpg_field_group = array_map( 'sanitize_text_field', $_POST['fpg_field_group'] );
        update_post_meta( $post_id, 'fpg_field_group', $fpg_field_group );
    } else {
        delete_post_meta( $post_id, 'fpg_field_group' );
    }
    $fields = [
        'fpg_field_group_title',
        'fpg_field_group_excerpt',
        'fpg_field_group_read_more',
        'fpg_field_group_image',
        'fpg_field_group_post_date',
        'fpg_field_group_author',
        'fpg_field_group_categories',
        'fpg_field_group_tag',
        'fpg_field_group_comment_count',
    ];

    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, $field, '1' );
        } else {
            delete_post_meta( $post_id, $field );
        }
    }

    if ( isset( $_POST['fpg_field_group_taxonomy'] ) ) {
        $fpg_field_group_taxonomy = array_map( 'sanitize_text_field', $_POST['fpg_field_group_taxonomy'] );
        update_post_meta( $post_id, 'fpg_field_group_taxonomy', $fpg_field_group_taxonomy );
    } else {
        delete_post_meta( $post_id, 'fpg_field_group_taxonomy' );
    }
    
    //Button 
    if ( isset( $_POST['fpg_button_background_color'] ) ) {
        update_post_meta( $post_id, 'fpg_button_background_color', sanitize_hex_color( $_POST['fpg_button_background_color'] ) );
    }
    if ( isset( $_POST['fpg_button_hover_background_color'] ) ) {
        update_post_meta( $post_id, 'fpg_button_hover_background_color', sanitize_hex_color( $_POST['fpg_button_hover_background_color'] ) );
    }
    if ( isset( $_POST['fpg_button_text_color'] ) ) {
        update_post_meta( $post_id, 'fpg_button_text_color', sanitize_hex_color( $_POST['fpg_button_text_color'] ) );
    }
    if ( isset( $_POST['fpg_button_text_hover_color'] ) ) {
        update_post_meta( $post_id, 'fpg_button_text_hover_color', sanitize_hex_color( $_POST['fpg_button_text_hover_color'] ) );
    }
    if ( isset( $_POST['fpg_button_border_color'] ) ) {
        update_post_meta( $post_id, 'fpg_button_border_color', sanitize_hex_color( $_POST['fpg_button_border_color'] ) );
    }
    //Full Sections
    if ( isset( $_POST['fpg_section_background_color'] ) ) {
        update_post_meta( $post_id, 'fpg_section_background_color', sanitize_hex_color( $_POST['fpg_section_background_color'] ) );
    }

    if ( isset( $_POST['fpg_section_margin'] ) ) {
        update_post_meta( $post_id, 'fpg_section_margin', sanitize_text_field( $_POST['fpg_section_margin'] ) );
    }

    if ( isset( $_POST['fpg_section_padding'] ) ) {
        update_post_meta( $post_id, 'fpg_section_padding', sanitize_text_field( $_POST['fpg_section_padding'] ) );
    }

    //Title 
    if ( isset( $_POST['fpg_title_color'] ) ) {
        update_post_meta( $post_id, 'fpg_title_color', sanitize_hex_color( $_POST['fpg_title_color'] ) );
    }
    if ( isset( $_POST['fpg_title_font_size'] ) ) {
        update_post_meta( $post_id, 'fpg_title_font_size', sanitize_text_field( $_POST['fpg_title_font_size'] ) );
    }
    if ( isset( $_POST['fpg_title_font_weight'] ) ) {
        update_post_meta( $post_id, 'fpg_title_font_weight', sanitize_text_field( $_POST['fpg_title_font_weight'] ) );
    }
    if ( isset( $_POST['fpg_title_alignment'] ) ) {
        update_post_meta( $post_id, 'fpg_title_alignment', sanitize_text_field( $_POST['fpg_title_alignment'] ) );
    }
    //Title Hover
    if ( isset( $_POST['fpg_title_hover_color'] ) ) {
        update_post_meta( $post_id, 'fpg_title_hover_color', sanitize_hex_color( $_POST['fpg_title_hover_color'] ) );
    }
    if ( isset( $_POST['fpg_title_hover_font_size'] ) ) {
        update_post_meta( $post_id, 'fpg_title_hover_font_size', sanitize_text_field( $_POST['fpg_title_hover_font_size'] ) );
    }
    if ( isset( $_POST['fpg_title_hover_font_weight'] ) ) {
        update_post_meta( $post_id, 'fpg_title_hover_font_weight', sanitize_text_field( $_POST['fpg_title_hover_font_weight'] ) );
    }
    if ( isset( $_POST['fpg_title_hover_alignment'] ) ) {
        update_post_meta( $post_id, 'fpg_title_hover_alignment', sanitize_text_field( $_POST['fpg_title_hover_alignment'] ) );
    }
    //Excerpt
    if ( isset( $_POST['fpg_excerpt_color'] ) ) {
        update_post_meta( $post_id, 'fpg_excerpt_color', sanitize_hex_color( $_POST['fpg_excerpt_color'] ) );
    }
    if ( isset( $_POST['fpg_excerpt_size'] ) ) {
        update_post_meta( $post_id, 'fpg_excerpt_size', sanitize_text_field( $_POST['fpg_excerpt_size'] ) );
    }
    if ( isset( $_POST['fpg_excerpt_font_weight'] ) ) {
        update_post_meta( $post_id, 'fpg_excerpt_font_weight', sanitize_text_field( $_POST['fpg_excerpt_font_weight'] ) );
    }
    if ( isset( $_POST['fpg_excerpt_alignment'] ) ) {
        update_post_meta( $post_id, 'fpg_excerpt_alignment', sanitize_text_field( $_POST['fpg_excerpt_alignment'] ) );
    }
    //Meta Data
    if ( isset( $_POST['fpg_meta_color'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_color', sanitize_hex_color( $_POST['fpg_meta_color'] ) );
    }
    if ( isset( $_POST['fpg_meta_size'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_size', sanitize_text_field( $_POST['fpg_meta_size'] ) );
    }
    if ( isset( $_POST['fpg_meta_font_weight'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_font_weight', sanitize_text_field( $_POST['fpg_meta_font_weight'] ) );
    }
    if ( isset( $_POST['fpg_meta_alignment'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_alignment', sanitize_text_field( $_POST['fpg_meta_alignment'] ) );
    }
    
}
add_action( 'save_post', 'fpg_save_metabox_data' );

/**
 * Enqueue scripts and styles for the metabox.
 */
function fpg_metabox_enqueue_scripts( $hook ) {
    // Enqueue scripts and styles only on your custom post type edit screen
    global $post_type;
    if ( 'wp-fpg' === $post_type ) {
        // Enqueue your scripts and styles here
        wp_enqueue_script( 'fpg-admin-script',  plugins_url('custom/js/admin-script.js', __FILE__), array( 'jquery' ), '1.0', true );
        wp_enqueue_style( 'fpg-admin-style', plugins_url('custom/css/admin-style.css', __FILE__),array(),'1.0' );
    }
}
add_action( 'admin_enqueue_scripts', 'fpg_metabox_enqueue_scripts' );
?>
