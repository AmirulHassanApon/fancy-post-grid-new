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
    $fpg_layout_select = get_post_meta( $post->ID, 'fpg_layout_select', true );
    $fpg_post_per_page = get_post_meta( $post->ID, 'fpg_post_per_page', true );
    // tab-2
    $fancy_post_grid_style = get_post_meta( $post->ID, 'fancy_post_grid_style', true );
    $fancy_post_grid_column = get_post_meta( $post->ID, 'fancy_post_grid_column', true );
    // tab-3
    $fancy_slider_style = get_post_meta($post->ID, 'fancy_slider_style', true);
    $fancy_post_grid_slider_column = get_post_meta( $post->ID, 'fancy_post_grid_slider_column', true );

    // tab-4 Title Settings
    $fpg_title_color               = get_post_meta($post->ID, 'fpg_title_color', true);
    $fpg_title_bg_color            = get_post_meta($post->ID, 'fpg_title_bg_color', true);
    // Description Settings
    $fpg_description_color        = get_post_meta($post->ID, 'fpg_description_color', true);
    // More Post Section
    $fpg_read_more_color           = get_post_meta($post->ID, 'fpg_read_more_color', true);
    // Meta Section
    $fpg_meta_date_color           = get_post_meta($post->ID, 'fpg_meta_date_color', true);
    $fpg_meta_date_icon_color      = get_post_meta($post->ID, 'fpg_meta_date_icon_color', true);
    $fpg_meta_author_color         = get_post_meta($post->ID, 'fpg_meta_author_color', true);
    $fpg_meta_author_icon_color    = get_post_meta($post->ID, 'fpg_meta_author_icon_color', true);

    // tab-5 Hover color
    $fpg_title_hover_color               = get_post_meta($post->ID, 'fpg_title_hover_color', true);
    $fpg_description_hover_color        = get_post_meta($post->ID, 'fpg_description_hover_color', true);


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
                    <?php esc_html_e( 'Grid Settings', 'fancy-post-grid' ); ?>
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
                    <?php esc_html_e( 'Slider Settings', 'fancy-post-grid' ); ?>
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
                    <?php esc_html_e( 'Post Style', 'fancy-post-grid' ); ?>
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
                    <?php esc_html_e( 'Post Style Hover', 'fancy-post-grid' ); ?>
                </a>
            </li>
        </ul>
        
        <div id="tab-1" class="fpg-tab-content active">
            <div class="fpg-layout-select-post fpg-common">
                <label><?php esc_html_e( 'Select Post Type:', 'fancy-post-grid' ); ?></label>
                <div>
                    <label for="fpg_layout_grid">
                        <input type="radio" id="fpg_layout_grid" name="fpg_layout_select" value="grid" <?php checked( $fpg_layout_select, 'grid' ); ?> />
                        <img class="fpg_logo" src="<?php echo plugins_url( 'img/grid_style_main.png', __FILE__ ); ?>" alt="Grid Style">
                        <?php esc_html_e( 'Grid', 'fancy-post-grid' ); ?>
                    </label>
                </div>
                <div>
                    <label for="fpg_layout_slider">
                        <input type="radio" id="fpg_layout_slider" name="fpg_layout_select" value="slider" <?php checked( $fpg_layout_select, 'slider' ); ?> />
                        <img class="fpg_logo" src="<?php echo plugins_url( 'img/slider_style_main.png', __FILE__ ); ?>" alt="Slider Style">
                        <?php esc_html_e( 'Slider', 'fancy-post-grid' ); ?>
                    </label>
                </div>
            </div>
           
            <div class="fpg-post-per-page fpg-common">
                <label for="fpg_post_per_page"><?php esc_html_e( 'Post Per Page:', 'fancy-post-grid' ); ?></label>
                <input type="text" id="fpg_post_per_page" name="fpg_post_per_page" value="<?php echo esc_attr( $fpg_post_per_page ); ?>" placeholder="-1" />
            </div>
        </div>

        <div id="tab-2" class="fpg-tab-content">
            
            <div class="fancy-post-grid-style fpg-common">
                <label><?php esc_html_e( 'Style:', 'fancy-post-grid' ); ?></label>
                <div>
                    <?php
                    $styles = [
                        'style1' => 'Style 01',
                        'style2' => 'Style 02',
                        'style3' => 'Style 03',
                        'style4' => 'Style 04',
                        'style5' => 'Style 05',
                        'style6' => 'Style 06',
                        'style7' => 'Style 07',
                        'style8' => 'Style 08',
                        'style9' => 'Style 09',
                        'style10' => 'Style 10',
                        'style11' => 'Style 11',
                        'style12' => 'Style 12',
                        'style13' => 'Style 13',
                    ];

                    foreach ($styles as $style_value => $style_label) :
                        $image_url = plugins_url( 'img/' . $style_value . '.png', __FILE__ );
                    ?>
                        <div>
                            <label for="fancy_post_grid_style_<?php echo esc_attr($style_value); ?>">
                                <input type="radio" id="fancy_post_grid_style_<?php echo esc_attr($style_value); ?>" name="fancy_post_grid_style" value="<?php echo esc_attr($style_value); ?>" <?php checked($fancy_post_grid_style, $style_value); ?> />
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($style_label); ?>" style="max-width: 50px; max-height: 50px; vertical-align: middle;">
                                <?php echo esc_html($style_label); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="fancy-post-grid-column fpg-common">
                <label for="fancy_post_grid_column"><?php esc_html_e( 'Column:', 'fancy-post-grid' ); ?></label>
                <select id="fancy_post_grid_column" name="fancy_post_grid_column">
                    <option value="6" <?php selected( $fancy_post_grid_column, '6' ); ?>><?php esc_html_e( 'Column 2', 'fancy-post-grid' ); ?></option>
                    <option value="4" <?php selected( $fancy_post_grid_column, '4' ); ?>><?php esc_html_e( 'Column 3', 'fancy-post-grid' ); ?></option>
                    <option value="3" <?php selected( $fancy_post_grid_column, '3' ); ?>><?php esc_html_e( 'Column 4', 'fancy-post-grid' ); ?></option>
                    <option value="2" <?php selected( $fancy_post_grid_column, '2' ); ?>><?php esc_html_e( 'Column 6', 'fancy-post-grid' ); ?></option>
                </select>
            </div>
        </div>

        <div id="tab-3" class="fpg-tab-content">           
            <div class="fpg-slider-style fpg-common">
                <label><?php esc_html_e( 'Style:', 'fancy-post-grid' ); ?></label>
                <div>
                    <?php
                    $styles = [
                        'style1' => 'Style 01',
                        'style2' => 'Style 02',
                        'style3' => 'Style 03',
                        'style4' => 'Style 04',
                        'style5' => 'Style 05',
                        'style6' => 'Style 06',
                        'style7' => 'Style 07',
                        
                    ];

                    foreach ($styles as $style_value => $style_label) :
                        $image_url = plugins_url( 'img/' . $style_value . '.png', __FILE__ );
                    ?>
                        <div>
                            <label for="fancy_slider_style_<?php echo esc_attr($style_value); ?>">
                                <input type="radio" id="fancy_slider_style_<?php echo esc_attr($style_value); ?>" name="fancy_slider_style" value="<?php echo esc_attr($style_value); ?>" <?php checked($fancy_slider_style, $style_value); ?> />
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($style_label); ?>" style="max-width: 50px; max-height: 50px; vertical-align: middle;">
                                <?php echo esc_html($style_label); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="fancy-post-grid-slider-column fpg-common">
                <label for="fancy_post_grid_slider_column"><?php esc_html_e( 'Column:', 'fancy-post-grid' ); ?></label>
                <select id="fancy_post_grid_slider_column" name="fancy_post_grid_slider_column" style="width: 100%;">
                    <option value="6" <?php selected( $fancy_post_grid_slider_column, '6' ); ?>><?php esc_html_e( '2 Column', 'fancy-post-grid' ); ?></option>
                    <option value="4" <?php selected( $fancy_post_grid_slider_column, '4' ); ?>><?php esc_html_e( '3 Column', 'fancy-post-grid' ); ?></option>
                    <option value="3" <?php selected( $fancy_post_grid_slider_column, '3' ); ?>><?php esc_html_e( '4 Column', 'fancy-post-grid' ); ?></option>
                    <option value="2" <?php selected( $fancy_post_grid_slider_column, '6' ); ?>><?php esc_html_e( '6 Column', 'fancy-post-grid' ); ?></option>
                </select>
            </div>
        </div>

        <div id="tab-4" class="fpg-tab-content">
            <div class="fancy-post-grid-title fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Title Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_title_color"><?php esc_html_e( 'Title Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_title_color" name="fpg_title_color" value="<?php echo esc_attr( $fpg_title_color ); ?>" />
                    </div>
                    <div class="fpg-color-box">
                        <label for="fpg_title_bg_color"><?php esc_html_e( 'Title Background Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_title_bg_color" name="fpg_title_bg_color" value="<?php echo esc_attr( $fpg_title_bg_color ); ?>" />
                    </div>
                </fieldset>
            </div>

            
            <div class="fancy-post-grid-description fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Description Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_description_color"><?php esc_html_e( 'Description Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_description_color" name="fpg_description_color" value="<?php echo esc_attr( $fpg_description_color ); ?>" />
                    </div>
                </fieldset>
            </div>
            <div class="fancy-post-grid-read-more fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Read More Button', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_read_more_color"><?php esc_html_e( 'Read More Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_read_more_color" name="fpg_read_more_color" value="<?php echo esc_attr( $fpg_read_more_color ); ?>" />
                    </div>
                </fieldset>
            </div>
            <div class="fancy-post-grid-meta fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Meta Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_meta_date_color"><?php esc_html_e( 'Meta Date Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_meta_date_color" name="fpg_meta_date_color" value="<?php echo esc_attr( $fpg_meta_date_color ); ?>" />
                    </div>
                    <div class="fpg-color-box">
                        <label for="fpg_meta_date_icon_color"><?php esc_html_e( 'Meta Date Icon Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_meta_date_icon_color" name="fpg_meta_date_icon_color" value="<?php echo esc_attr( $fpg_meta_date_icon_color ); ?>" />
                    </div>
                    <div class="fpg-color-box">
                        <label for="fpg_meta_author_color"><?php esc_html_e( 'Meta Author Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_meta_author_color" name="fpg_meta_author_color" value="<?php echo esc_attr( $fpg_meta_author_color ); ?>" />
                    </div>
                    <div class="fpg-color-box">
                        <label for="fpg_meta_author_icon_color"><?php esc_html_e( 'Meta Author Icon Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_meta_author_icon_color" name="fpg_meta_author_icon_color" value="<?php echo esc_attr( $fpg_meta_author_icon_color ); ?>" />
                    </div>
                </fieldset>
            </div>
        </div>

        <div id="tab-5" class="fpg-tab-content">
            <div class="fancy-post-grid-title-hover fpg-common">
                <fieldset>
                    <legend><?php esc_html_e( 'Text Hover Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_title_hover_color"><?php esc_html_e( 'Title Hover Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_title_hover_color" name="fpg_title_hover_color" value="<?php echo esc_attr( $fpg_title_hover_color ); ?>" />
                    </div>
                </fieldset>
                <fieldset>
                    <legend><?php esc_html_e( 'Description Hover Settings', 'fancy-post-grid' ); ?></legend>
                    <div class="fpg-color-box">
                        <label for="fpg_description_hover_color"><?php esc_html_e( 'Description Hover Color:', 'fancy-post-grid' ); ?></label>
                        <input type="text" class="color-field" id="fpg_description_hover_color" name="fpg_description_hover_color" value="<?php echo esc_attr( $fpg_description_hover_color ); ?>" />
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
    if ( isset( $_POST['fpg_layout_select'] ) ) {
        update_post_meta( $post_id, 'fpg_layout_select', sanitize_text_field( $_POST['fpg_layout_select'] ) );
    }
    if ( isset( $_POST['fpg_post_per_page'] ) ) {
        update_post_meta( $post_id, 'fpg_post_per_page', sanitize_text_field( $_POST['fpg_post_per_page'] ) );
    }
    if ( isset( $_POST['fancy_post_grid_style'] ) ) {
        update_post_meta( $post_id, 'fancy_post_grid_style', sanitize_text_field( $_POST['fancy_post_grid_style'] ) );
    }
    if ( isset( $_POST['fancy_post_grid_column'] ) ) {
        update_post_meta( $post_id, 'fancy_post_grid_column', sanitize_text_field( $_POST['fancy_post_grid_column'] ) );
    }
    if ( isset( $_POST['fancy_slider_style'] ) ) {
        update_post_meta( $post_id, 'fancy_slider_style', sanitize_text_field( $_POST['fancy_slider_style'] ) );
    }
    if ( isset( $_POST['fancy_post_grid_slider_column'] ) ) {
        update_post_meta( $post_id, 'fancy_post_grid_slider_column', sanitize_text_field( $_POST['fancy_post_grid_slider_column'] ) );
    }
    if ( isset( $_POST['fpg_title_color'] ) ) {
        update_post_meta( $post_id, 'fpg_title_color', sanitize_hex_color( $_POST['fpg_title_color'] ) );
    }
    if ( isset( $_POST['fpg_title_bg_color'] ) ) {
        update_post_meta( $post_id, 'fpg_title_bg_color', sanitize_hex_color( $_POST['fpg_title_bg_color'] ) );
    }
    if ( isset( $_POST['fpg_description_color'] ) ) {
        update_post_meta( $post_id, 'fpg_description_color', sanitize_hex_color( $_POST['fpg_description_color'] ) );
    }
    if ( isset( $_POST['fpg_read_more_color'] ) ) {
        update_post_meta( $post_id, 'fpg_read_more_color', sanitize_hex_color( $_POST['fpg_read_more_color'] ) );
    }
    if ( isset( $_POST['fpg_meta_date_color'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_date_color', sanitize_hex_color( $_POST['fpg_meta_date_color'] ) );
    }
    if ( isset( $_POST['fpg_meta_date_icon_color'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_date_icon_color', sanitize_hex_color( $_POST['fpg_meta_date_icon_color'] ) );
    }
    if ( isset( $_POST['fpg_meta_author_color'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_author_color', sanitize_hex_color( $_POST['fpg_meta_author_color'] ) );
    }
    if ( isset( $_POST['fpg_meta_author_icon_color'] ) ) {
        update_post_meta( $post_id, 'fpg_meta_author_icon_color', sanitize_hex_color( $_POST['fpg_meta_author_icon_color'] ) );
    }
    if ( isset( $_POST['fpg_title_hover_color'] ) ) {
        update_post_meta( $post_id, 'fpg_title_hover_color', sanitize_hex_color( $_POST['fpg_title_hover_color'] ) );
    }
    if ( isset( $_POST['fpg_description_hover_color'] ) ) {
        update_post_meta( $post_id, 'fpg_description_hover_color', sanitize_hex_color( $_POST['fpg_description_hover_color'] ) );
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
