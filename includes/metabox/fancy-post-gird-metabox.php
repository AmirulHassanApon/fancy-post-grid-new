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
    $fpg_offset                                 = get_post_meta( $post->ID, 'fpg_offset', true );
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
    $fpg_search                                 = get_post_meta( $post->ID, 'fpg_search', true );
    
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

    $fancy_link_details                         = get_post_meta( $post->ID, 'fancy_link_details', true );
    $fancy_link_target                          = get_post_meta( $post->ID, 'fancy_link_target', true );
    if ( empty( $fancy_link_target ) ) {
        $fancy_link_target = 'same'; 
    }

    // tab-3-Advanced-Settings
    
    $fancy_post_title_tag                       = get_post_meta( $post->ID, 'fancy_post_title_tag', true );    

    //Feature-image
    $fancy_post_hide_feature_image              = get_post_meta( $post->ID, 'fancy_post_hide_feature_image', true );
    if ( empty( $fancy_post_hide_feature_image ) ) {
        $fancy_post_hide_feature_image = 'on'; // image
    }
    $fancy_post_feature_image_size              = get_post_meta( $post->ID, 'fancy_post_feature_image_size', true );
    $fancy_post_media_source                    = get_post_meta( $post->ID, 'fancy_post_media_source', true );
    if ( empty( $fancy_post_media_source ) ) {
        $fancy_post_media_source ="feature_image";
    }

    $fancy_post_hover_animation                 = get_post_meta( $post->ID, 'fancy_post_hover_animation', true );
    $fancy_post_excerpt_more_text               = get_post_meta( $post->ID, 'fancy_post_excerpt_more_text', true );

    // Button
    $fancy_post_read_more_border_radius         = get_post_meta( $post->ID, 'fancy_post_read_more_border_radius', true );
    $fancy_post_read_more_alignment             = get_post_meta( $post->ID, 'fancy_post_read_more_alignment', true );
    $fancy_post_read_more_text                  = get_post_meta( $post->ID, 'fancy_post_read_more_text', true );
    
    //Field Selector
    
    $fpg_field_group_title                      = get_post_meta( $post->ID, 'fpg_field_group_title', true );
    $fpg_field_group_excerpt                    = get_post_meta( $post->ID, 'fpg_field_group_excerpt', true );
    $fpg_field_group_read_more                  = get_post_meta( $post->ID, 'fpg_field_group_read_more', true );
    $fpg_field_group_image                      = get_post_meta( $post->ID, 'fpg_field_group_image', true );
    $fpg_field_group_post_date                  = get_post_meta( $post->ID, 'fpg_field_group_post_date', true );
    $fpg_field_group_author                     = get_post_meta( $post->ID, 'fpg_field_group_author', true );
    $fpg_field_group_categories                 = get_post_meta( $post->ID, 'fpg_field_group_categories', true );
    $fpg_field_group_tags                       = get_post_meta( $post->ID, 'fpg_field_group_tags', true );
    $fpg_field_group_comment_count              = get_post_meta( $post->ID, 'fpg_field_group_comment_count', true );
    

    // tab-4 Title Settings
    // Primary Color
    $fpg_primary_color                          = get_post_meta( $post->ID,'fpg_primary_color', true); 
    //Button
    $fpg_button_background_color                = get_post_meta( $post->ID,'fpg_button_background_color', true); 
    $fpg_button_hover_background_color          = get_post_meta( $post->ID,'fpg_button_hover_background_color', true); 
    $fpg_button_text_color                      = get_post_meta( $post->ID,'fpg_button_text_color', true ); 
    $fpg_button_text_hover_color                = get_post_meta( $post->ID,'fpg_button_text_hover_color', true ); 

    //full Section
    $fpg_section_background_color               = get_post_meta( $post->ID, 'fpg_section_background_color', true );
    $fpg_section_margin                         = get_post_meta( $post->ID, 'fpg_section_margin', true );
    $fpg_section_padding                        = get_post_meta( $post->ID, 'fpg_section_padding', true );

    // Title
    $fpg_title_color                            = get_post_meta( $post->ID,'fpg_title_color', true); // Default to black if not set
    $fpg_title_font_size                        = get_post_meta( $post->ID,'fpg_title_font_size', true); // Default to 16px if not set
    $fpg_title_font_weight                      = get_post_meta( $post->ID,'fpg_title_font_weight', true ); // Default to 400 if not set
    $fpg_title_alignment                        = get_post_meta( $post->ID,'fpg_title_alignment', true ); // Default to left if not set

    //Title Hover
    $fpg_title_hover_color                      = get_post_meta( $post->ID,'fpg_title_hover_color', true); // Default to black if not set
    $fpg_title_hover_font_size                  = get_post_meta( $post->ID,'fpg_title_hover_font_size', true); // Default to 16px if not set
    $fpg_title_hover_font_weight                = get_post_meta( $post->ID,'fpg_title_hover_font_weight', true ); // Default to 400 if not set
    $fpg_title_hover_alignment                  = get_post_meta( $post->ID,'fpg_title_hover_alignment', true ); // Default to left if not set

    //Excerpt
    $fpg_excerpt_color                          = get_post_meta( $post->ID,'fpg_excerpt_color', true); // Default to black if not set
    $fpg_excerpt_size                           = get_post_meta( $post->ID,'fpg_excerpt_size', true); // Default to 16px if not set
    $fpg_excerpt_font_weight                    = get_post_meta( $post->ID,'fpg_excerpt_font_weight', true ); // Default to 400 if not set
    $fpg_excerpt_alignment                      = get_post_meta( $post->ID,'fpg_excerpt_alignment', true ); // Default to left if not set

    //Meta Data
    $fpg_meta_color                             = get_post_meta( $post->ID,'fpg_meta_color', true); // Default to black if not set
    $fpg_meta_size                              = get_post_meta( $post->ID,'fpg_meta_size', true); // Default to 16px if not set
    $fpg_meta_font_weight                       = get_post_meta( $post->ID,'fpg_meta_font_weight', true ); // Default to 400 if not set
    $fpg_meta_alignment                         = get_post_meta( $post->ID,'fpg_meta_alignment', true ); // Default to left if not set



    // Output for the metabox content
    ?>
    <div id="fpg_metabox_tabs">
        <ul>
            <li>
                <a href="#tab-1" class="fpg-nav-tab active">
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
                    <?php esc_html_e( 'Query Build', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-2" class="fpg-nav-tab">
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
                    <?php esc_html_e( 'Layout Settings', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-3" class="fpg-nav-tab">
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
                    <?php esc_html_e( 'Field Selector', 'fancy-post-grid' ); ?>
                </a>
            </li>
            <li>
                <a href="#tab-5" class="fpg-nav-tab">
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

                    <div class="fpg-margin-box">
                        <label for="fpg_include_only"><?php esc_html_e( 'Include only:', 'fancy-post-grid' ); ?></label>
                        <input type="text" id="fpg_include_only" name="fpg_include_only" value="<?php echo esc_attr( $fpg_include_only ); ?>" placeholder="List of post IDs to show (comma-separated values, for example: 1,2,3)" />
                    </div> 

                    <div class="fpg-margin-box">
                        <label for="fpg_exclude"><?php esc_html_e( 'Exclude:', 'fancy-post-grid' ); ?></label>
                        <input type="text" id="fpg_exclude" name="fpg_exclude" value="<?php echo esc_attr( $fpg_exclude ); ?>" placeholder="List of post IDs to hide (comma-separated values, for example: 1,2,3)" />
                    </div> 

                    <div class="fpg-margin-box">
                        <label for="fpg_limit"><?php esc_html_e( 'Limit:', 'fancy-post-grid' ); ?></label>
                        <input type="number" id="fpg_limit" name="fpg_limit" value="<?php echo esc_attr( $fpg_limit ); ?>" placeholder="The number of posts to show. Set empty to show all found posts." />
                    </div> 

                    <div class="fpg-margin-box">
                        <label for="fpg_offset"><?php esc_html_e( 'Offset:', 'fancy-post-grid' ); ?></label>
                        <input type="number" id="fpg_offset" name="fpg_offset" value="<?php echo esc_attr( $fpg_offset ); ?>" placeholder="The number of posts to skip from start" />
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
                                <label for="fpg_field_group_category">
                                    <input type="checkbox" id="fpg_field_group_category" name="fpg_field_group_taxonomy[]" value="category" <?php checked( in_array( 'category', (array) $fpg_field_group_taxonomy ) ); ?> />
                                    <?php esc_html_e( 'Category', 'fancy-post-grid' ); ?>
                                </label>
                            </div>
                            <div class="fpg-field-group fpg-common">
                                <label for="fpg_field_group_tags">
                                    <input type="checkbox" id="fpg_field_group_tags" name="fpg_field_group_taxonomy[]" value="tags" <?php checked( in_array( 'tags', (array) $fpg_field_group_taxonomy ) ); ?> />
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
                                    $statuses = array(
                                        'publish' => 'Published',
                                        'pending' => 'Pending',
                                        'draft' => 'Draft',
                                        'private' => 'Private',
                                        'trash' => 'Trash',
                                        'auto-draft' => 'Auto Draft',
                                    );
                                    foreach ( $statuses as $status => $label ) {
                                        echo '<option value="' . esc_attr( $status ) . '" ' . (in_array( $status, (array) $fpg_filter_statuses ) ? 'selected="selected"' : '') . '>' . esc_html( $label ) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </fieldset>  
                        <!-- Search -->
                        <fieldset>
                            <legend><?php esc_html_e( 'Search:', 'fancy-post-grid' ); ?></legend>
                            <div id="fpg_search" >
                                <label for="fpg_search"><?php esc_html_e( 'Keyword:', 'fancy-post-grid' ); ?></label>
                                <input type="text" id="fpg_search" name="fpg_search" value="<?php echo esc_attr( $fpg_search ); ?>" />
                            </div>
                        </fieldset>  
                </fieldset>                  
            </div>
        </div>

        <div id="tab-2" class="fpg-tab-content">
            
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
                        'style13' => 'Grid Layout 13',
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

            <!-- Column Settings -->
            <div class="fancy-post-column fpg-common">
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
                                <option value="12" <?php selected( $fancy_post_cl_lg, '12' ); ?>><?php esc_html_e( '1 Column', 'fancy-post-grid' ); ?></option>
                                <option value="6" <?php selected( $fancy_post_cl_lg, '6' ); ?>><?php esc_html_e( '2 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="4" <?php selected( $fancy_post_cl_lg, '4' ); ?>><?php esc_html_e( '3 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="3" <?php selected( $fancy_post_cl_lg, '3' ); ?>><?php esc_html_e( '4 Columns', 'fancy-post-grid' ); ?></option>
                                <option value="2" <?php selected( $fancy_post_cl_lg, '2' ); ?>><?php esc_html_e( '6 Columns', 'fancy-post-grid' ); ?></option>
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

            <!-- Pagination -->
            <div class="fpg-pagination fpg-common">
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
                    <div class="fpg-radio-list-wrapper">
                        <input type="radio" id="fancy_link_target_same" name="fancy_link_target" value="same" <?php checked( $fancy_link_target, 'same', true ); ?> />
                        <label for="fancy_link_target_same">
                            <p><?php esc_html_e( 'Same Window', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                    <div class="fpg-radio-list-wrapper">
                        <input type="radio" id="fancy_link_target_new" name="fancy_link_target" value="new" <?php checked( $fancy_link_target, 'new',true ); ?> />
                        <label for="fancy_link_target_new">
                            <p><?php esc_html_e( 'New Window', 'fancy-post-grid' ); ?></p>
                        </label>
                    </div>
                </fieldset>
                
            </div>
        </div>

        <div id="tab-3" class="fpg-tab-content">           
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
                        
                    </div>    
                </fieldset>
            </div>

            <div class="fpg-image-settings fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Image Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-post-select-main">
                        <!-- Hide Feature Image -->
                        <div class="fpg-hide-feature-image fpg-common">                       
                            <legend><?php esc_html_e( 'Feature Image', 'fancy-post-grid' ); ?></legend>
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_hide_feature_image_off" name="fancy_post_hide_feature_image" value="off" <?php checked( $fancy_post_hide_feature_image, 'off', true ); ?> />
                                    <label for="fancy_post_hide_feature_image_off">
                                        <p><?php esc_html_e( 'Off', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_hide_feature_image_on" name="fancy_post_hide_feature_image" value="on" <?php checked( $fancy_post_hide_feature_image, 'on',true ); ?> />
                                    <label for="fancy_post_hide_feature_image_on">
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
                            
                            <legend><?php esc_html_e( 'Media Source', 'fancy-post-grid' ); ?></legend>
                            
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_media_source_feature_image" name="fancy_post_media_source" value="feature_image" <?php checked( $fancy_post_media_source, 'feature_image', true ); ?> />
                                    <label for="fancy_post_media_source_feature_image">
                                        <p><?php esc_html_e( 'Feature Image', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_media_source_first_image" name="fancy_post_media_source" value="first_image" <?php checked( $fancy_post_media_source, 'first_image',true ); ?> />
                                    <label for="fancy_post_media_source_first_image">
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
                    <div class="fpg-post-select-main">
                        <!-- Border Radius -->
                        <div class="fpg-read-more-border-radius fpg-common">
                            <label for="fancy_post_read_more_border_radius"><?php esc_html_e( 'Border Radius:', 'fancy-post-grid' ); ?></label>
                            <input type="number" id="fancy_post_read_more_border_radius" name="fancy_post_read_more_border_radius" value="<?php echo esc_attr( $fancy_post_read_more_border_radius ); ?>" />
                        </div>

                        <!-- Alignment -->
                        <div class="fpg-read-more-alignment fpg-common">
                            <legend><?php esc_html_e( 'Alignment:', 'fancy-post-grid' ); ?></legend>
                            <div class="fpg-container">
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_read_more_alignment_left" name="fancy_post_read_more_alignment" value="left" <?php checked( $fancy_post_read_more_alignment, 'left', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_left">
                                        <p><?php esc_html_e( 'Left', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_read_more_alignment_center" name="fancy_post_read_more_alignment" value="center" <?php checked( $fancy_post_read_more_alignment, 'center', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_center">
                                        <p><?php esc_html_e( 'Center', 'fancy-post-grid' ); ?></p>
                                    </label>
                                </div>
                                <div class="fpg-radio-list-wrapper">
                                    <input type="radio" id="fancy_post_read_more_alignment_right" name="fancy_post_read_more_alignment" value="right" <?php checked( $fancy_post_read_more_alignment, 'right', true ); ?> />
                                    <label for="fancy_post_read_more_alignment_right">
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

        <div id="tab-4" class="fpg-tab-content">
            <div class="fpg-field-selection fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Field Selection', 'fancy-post-grid' ); ?></legend>

                    <!-- Field Group Checkboxes -->
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_title">
                            <input type="checkbox" id="fpg_field_group_title" name="fpg_field_group_title" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_title', true ), '1' ); ?> />
                            <?php esc_html_e( 'Title', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_excerpt">
                            <input type="checkbox" id="fpg_field_group_excerpt" name="fpg_field_group_excerpt" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_excerpt', true ), '1' ); ?> />
                            <?php esc_html_e( 'Excerpt', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_read_more">
                            <input type="checkbox" id="fpg_field_group_read_more" name="fpg_field_group_read_more" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_read_more', true ), '1' ); ?> />
                            <?php esc_html_e( 'Read More', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_image">
                            <input type="checkbox" id="fpg_field_group_image" name="fpg_field_group_image" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_image', true ), '1' ); ?> />
                            <?php esc_html_e( 'Image', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_post_date">
                            <input type="checkbox" id="fpg_field_group_post_date" name="fpg_field_group_post_date" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_post_date', true ), '1' ); ?> />
                            <?php esc_html_e( 'Post Date', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_author">
                            <input type="checkbox" id="fpg_field_group_author" name="fpg_field_group_author" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_author', true ), '1' ); ?> />
                            <?php esc_html_e( 'Author', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_categories">
                            <input type="checkbox" id="fpg_field_group_categories" name="fpg_field_group_categories" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_categories', true ), '1' ); ?> />
                            <?php esc_html_e( 'Categories', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_tags">
                            <input type="checkbox" id="fpg_field_group_tags" name="fpg_field_group_tags" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_tags', true ), '1' ); ?> />
                            <?php esc_html_e( 'Tags', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                    <div class="fpg-field-group fpg-common">
                        <label for="fpg_field_group_comment_count">
                            <input type="checkbox" id="fpg_field_group_comment_count" name="fpg_field_group_comment_count" value="1" <?php checked( get_post_meta( $post->ID, 'fpg_field_group_comment_count', true ), '1' ); ?> />
                            <?php esc_html_e( 'Comment Count', 'fancy-post-grid' ); ?>
                        </label>
                    </div>
                </fieldset>
            </div>
        </div>


        <div id="tab-5" class="fpg-tab-content">
            <div class="fancy-post-grid-primary fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Primary Color', 'fancy-post-grid' ); ?></legend>
                        <div class="fpg-color-box">
                            <label for="fpg_primary_color"><?php esc_html_e( 'Color:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_primary_color" name="fpg_primary_color" value="<?php echo esc_attr( $fpg_primary_color ); ?>" />
                        </div>      
                </fieldset>
            </div>
            <div class="fancy-post-grid-button fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Button Color', 'fancy-post-grid' ); ?></legend>
                    
                    
                        <div class="fpg-color-box">
                            <label for="fpg_button_background_color"><?php esc_html_e( 'Background:', 'fancy-post-grid' ); ?></label>
                            <input type="text" class="color-field" id="fpg_button_background_color" name="fpg_button_background_color" value="<?php echo esc_attr( $fpg_button_background_color ); ?>" />
                        </div>

                        <div class="fpg-color-box">
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
    if ( isset( $_POST['fpg_offset'] ) ) {
        update_post_meta( $post_id, 'fpg_offset', sanitize_text_field( $_POST['fpg_offset'] ) );
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
    if ( isset( $_POST['fpg_search'] ) ) {
        update_post_meta( $post_id, 'fpg_search', sanitize_text_field( $_POST['fpg_search'] ) );
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
        'fpg_field_group_tags',
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
    //Primary 
    if ( isset( $_POST['fpg_primary_color'] ) ) {
        update_post_meta( $post_id, 'fpg_primary_color', sanitize_hex_color( $_POST['fpg_primary_color'] ) );
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