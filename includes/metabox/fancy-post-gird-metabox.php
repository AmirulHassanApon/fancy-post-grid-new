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
    $fpg_slider_style = get_post_meta($post->ID, 'fancy_slider_style', true);
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
            <li><a href="#tab-1"><?php esc_html_e( 'Query Build', 'fancy-post-grid' ); ?></a></li>
            <li><a href="#tab-2"><?php esc_html_e( 'Grid Settings', 'fancy-post-grid' ); ?></a></li>
            <li><a href="#tab-3"><?php esc_html_e( 'Slider Settings', 'fancy-post-grid' ); ?></a></li>
            <li><a href="#tab-4"><?php esc_html_e( 'Post Style', 'fancy-post-grid' ); ?></a></li>
            <li><a href="#tab-5"><?php esc_html_e( 'Post Style Hover', 'fancy-post-grid' ); ?></a></li>
        </ul>
        
        <div id="tab-1" class="fpg-tab-content">
            <label for="fpg_layout_select"><?php esc_html_e( 'Select Post Type:', 'fancy-post-grid' ); ?></label>
            <select id="fpg_layout_select" name="fpg_layout_select">
                <option value="grid" <?php selected( $fpg_layout_select, 'grid' ); ?>><?php esc_html_e( 'Grid', 'fancy-post-grid' ); ?></option>
                <option value="slider" <?php selected( $fpg_layout_select, 'slider' ); ?>><?php esc_html_e( 'Slider', 'fancy-post-grid' ); ?></option>
                <option value="light" <?php selected( $fpg_layout_select, 'light' ); ?>><?php esc_html_e( 'Light Box Style (Pro)', 'fancy-post-grid' ); ?></option>
                <option value="isotope" <?php selected( $fpg_layout_select, 'isotope' ); ?>><?php esc_html_e( 'Filter Style (Pro)', 'fancy-post-grid' ); ?></option>
                <option value="list" <?php selected( $fpg_layout_select, 'list' ); ?>><?php esc_html_e( 'List Style (Pro)', 'fancy-post-grid' ); ?></option>
                <option value="flip" <?php selected( $fpg_layout_select, 'flip' ); ?>><?php esc_html_e( 'Flip Style (Pro)', 'fancy-post-grid' ); ?></option>
            </select><br />
            
            <label for="fpg_post_per_page"><?php esc_html_e( 'Post Per Page:', 'fancy-post-grid' ); ?></label>
            <input type="text" id="fpg_post_per_page" name="fpg_post_per_page" value="<?php echo esc_attr( $fpg_post_per_page ); ?>" placeholder="-1" /><br />
        </div>

        <div id="tab-2" class="fpg-tab-content">
            <label for="fancy_post_grid_style"><?php esc_html_e( 'Style:', 'fancy-post-grid' ); ?></label>
            <select id="fancy_post_grid_style" name="fancy_post_grid_style">
                <option value="style1" <?php selected( $fancy_post_grid_style, 'style1' ); ?>><?php esc_html_e( 'Style 01', 'fancy-post-grid' ); ?></option>
                <option value="style2" <?php selected( $fancy_post_grid_style, 'style2' ); ?>><?php esc_html_e( 'Style 02', 'fancy-post-grid' ); ?></option>
                <option value="style3" <?php selected( $fancy_post_grid_style, 'style3' ); ?>><?php esc_html_e( 'Style 03', 'fancy-post-grid' ); ?></option>
            </select><br />
            
            <label for="fancy_post_grid_column"><?php esc_html_e( 'Column:', 'fancy-post-grid' ); ?></label>
            <select id="fancy_post_grid_column" name="fancy_post_grid_column">
                <option value="6" <?php selected( $fancy_post_grid_column, '6' ); ?>><?php esc_html_e( 'Column 2 (Pro)', 'fancy-post-grid' ); ?></option>
                <option value="4" <?php selected( $fancy_post_grid_column, '4' ); ?>><?php esc_html_e( 'Column 3', 'fancy-post-grid' ); ?></option>
                <option value="3" <?php selected( $fancy_post_grid_column, '3' ); ?>><?php esc_html_e( 'Column 4', 'fancy-post-grid' ); ?></option>
                <option value="2" <?php selected( $fancy_post_grid_column, '2' ); ?>><?php esc_html_e( 'Column 6 (Pro)', 'fancy-post-grid' ); ?></option>
            </select><br />
        </div>

        <div id="tab-3" class="fpg-tab-content">
            <label for="fpg_slider_style"><?php esc_html_e( 'Select Slider Style:', 'fancy-post-grid' ); ?></label>
            <select id="fpg_slider_style" name="fpg_slider_style">
                <option value="style-1" <?php selected($fpg_slider_style, 'style-1'); ?>><?php esc_html_e( 'Style 1', 'fancy-post-grid' ); ?></option>
                <option value="style-2" <?php selected($fpg_slider_style, 'style-2'); ?>><?php esc_html_e( 'Style 2', 'fancy-post-grid' ); ?></option>
                <option value="style-3" <?php selected($fpg_slider_style, 'style-3'); ?>><?php esc_html_e( 'Style 3', 'fancy-post-grid' ); ?></option>
            </select><br />

            <label for="fancy_post_grid_slider_column"><?php esc_html_e( 'Column:', 'fancy-post-grid' ); ?></label>
            <select id="fancy_post_grid_slider_column" name="fancy_post_grid_slider_column">
                <option value="2" <?php selected( $fancy_post_grid_slider_column, '2' ); ?>><?php esc_html_e( '2 Column', 'fancy-post-grid' ); ?></option>
                <option value="3" <?php selected( $fancy_post_grid_slider_column, '3' ); ?>><?php esc_html_e( '3 Column', 'fancy-post-grid' ); ?></option>
                <option value="4" <?php selected( $fancy_post_grid_slider_column, '4' ); ?>><?php esc_html_e( '4 Column', 'fancy-post-grid' ); ?></option>
                <option value="6" <?php selected( $fancy_post_grid_slider_column, '6' ); ?>><?php esc_html_e( '6 Column', 'fancy-post-grid' ); ?></option>
            </select><br />
        </div>

        <div id="tab-4" class="fpg-tab-content">
            <h3><?php esc_html_e( 'Title Settings', 'fancy-post-grid' ); ?></h3>
            
            <label for="fpg_title_color"><?php esc_html_e( 'Title Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_title_color" name="fpg_title_color" value="<?php echo esc_attr( $fpg_title_color ); ?>" />

            <label for="fpg_title_bg_color"><?php esc_html_e( 'Title Background Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_title_bg_color" name="fpg_title_bg_color" value="<?php echo esc_attr( $fpg_title_bg_color ); ?>" />

            <h3><?php esc_html_e( 'Description Settings', 'fancy-post-grid' ); ?></h3>
            <label for="fpg_description_color"><?php esc_html_e( 'Description Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_description_color" name="fpg_description_color" value="<?php echo esc_attr( $fpg_description_color ); ?>" /><br />

            <h3><?php esc_html_e( 'Read More Button', 'fancy-post-grid' ); ?></h3>
            <label for="fpg_read_more_color"><?php esc_html_e( 'Read More Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_read_more_color" name="fpg_read_more_color" value="<?php echo esc_attr( $fpg_read_more_color ); ?>" /><br />

            <h3><?php esc_html_e( 'Meta Settings', 'fancy-post-grid' ); ?></h3>
            <label for="fpg_meta_date_color"><?php esc_html_e( 'Meta Date Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_meta_date_color" name="fpg_meta_date_color" value="<?php echo esc_attr( $fpg_meta_date_color ); ?>" /><br />

            <label for="fpg_meta_date_icon_color"><?php esc_html_e( 'Meta Date Icon Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_meta_date_icon_color" name="fpg_meta_date_icon_color" value="<?php echo esc_attr( $fpg_meta_date_icon_color ); ?>" /><br />

            <label for="fpg_meta_author_color"><?php esc_html_e( 'Meta Author Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_meta_author_color" name="fpg_meta_author_color" value="<?php echo esc_attr( $fpg_meta_author_color ); ?>" /><br />

            <label for="fpg_meta_author_icon_color"><?php esc_html_e( 'Meta Author Icon Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_meta_author_icon_color" name="fpg_meta_author_icon_color" value="<?php echo esc_attr( $fpg_meta_author_icon_color ); ?>" /><br />
        </div>

        <div id="tab-5" class="fpg-tab-content">
            <label for="fpg_title_hover_color"><?php esc_html_e( 'Title Hover Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_title_hover_color" name="fpg_title_hover_color" value="<?php echo esc_attr( $fpg_title_hover_color ); ?>" /><br />

            <label for="fpg_description_hover_color"><?php esc_html_e( 'Description Hover Color:', 'fancy-post-grid' ); ?></label>
            <input type="color" id="fpg_description_hover_color" name="fpg_description_hover_color" value="<?php echo esc_attr( $fpg_description_hover_color ); ?>" /><br />
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
    if ( isset( $_POST['fpg_slider_style'] ) ) {
        update_post_meta( $post_id, 'fpg_slider_style', sanitize_text_field( $_POST['fpg_slider_style'] ) );
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
