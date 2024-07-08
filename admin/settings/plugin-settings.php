<?php

    add_action( 'admin_menu', 'fpg_create_admin_page' );
    add_action( 'admin_init', 'fpg_settings_page_general' );
    add_action( 'admin_init', 'fpg_settings_page_ed_css' );
    add_action( 'admin_init', 'fpg_settings_page_ed_js' );


	function fpg_create_admin_page(){
		$page_title = __( 'Settings', 'fancy-post-grid' );
		$menu_title = __( 'Settings', 'fancy-post-grid' );
		$capability = 'manage_options';
		$slug       = 'fpgsettings';
		$callback   = 'fpg_page_content';
		add_submenu_page( 'edit.php?post_type=wp-fpg',$page_title, $menu_title, $capability, $slug, $callback );
	}

    function fpg_page_content() {
		$settings_options = get_option( 'fpg_settings_option' ); ?>

		<div class="wrap">
			<?php settings_errors(); ?>
            <form method="post" action="options.php" class="fpg-form">
                <div class="fpg-setting-container">
                    <div id="fpg-setting-tabs" class="fpg-setting-tabs">
                        <ul>
                            <li><a href="#tabs-1"><?php esc_html_e( 'General', 'fancy-post-grid' );?></a></li>      
                            <li><a href="#tabs-2"><?php esc_html_e( 'Enable/Disable CSS', 'fancy-post-grid' );?></a></li>
                            <li><a href="#tabs-3"><?php esc_html_e( 'Enable/Disable JS', 'fancy-post-grid' );?></a></li>
                            <li><a href="#tabs-4"><?php esc_html_e( 'Overview', 'fancy-post-grid' );?></a></li>
                        </ul>
                        <div id="tabs-1" class="ui-tabs-panel">
                            <?php
                            settings_fields( 'fpg_settings_option_group' );
                            do_settings_sections( 'fpg_settings_admin' );
                            submit_button();
                            ?>
                        </div>
                        
                        <div id="tabs-2" class="ui-tabs-panel ui-tabs-hide">
                            <?php
                            settings_fields( 'fpg_settings_option_group_ed_css' );
                            do_settings_sections( 'fpg_settings_admin-ed_css' );
                            submit_button();
                            ?>
                        </div>
                        <div id="tabs-3" class="ui-tabs-panel ui-tabs-hide">
                            <?php
                            settings_fields( 'fpg_settings_option_group_ed_js' );
                            do_settings_sections( 'fpg_settings_admin-ed_js' );
                            submit_button();
                            ?>

                        </div>
                        <div id="tabs-4" class="ui-tabs-panel ui-tabs-hide">
                            <?php $settings_options = get_option( 'fpg_settings_option' ); ?>
                            <table class="fpg-setting-tabs-overview">
                                <tr>
                                    <th><?php esc_html_e( 'Features', 'fancy-post-grid' ); ?></th>
                                    <th><?php esc_html_e( 'Status', 'fancy-post-grid' ); ?></th>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Primary Color', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <div style="background-color: <?php fpg_settings_option_field( 'primary_color_0' ); ?>; width: 50px; height: 20px"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Secondary Color', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <div style="background-color: <?php fpg_settings_option_field( 'secondary_color_1' ); ?>; width: 50px; height: 20px"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Select Single Template', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'select_single_template_2' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Single Template Padding Top/Bottom', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 's_template_p_t_b' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable Details Page', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'details_page_enable_3' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable Boostrap CSS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_bootstrap_library_disable' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable Fontawesome CSS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_fontawesome_library_disable' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable owl carousel CSS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_owl_library_disable' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable FlexSlider CSS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_flex_library_disable' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable magnific popup CSS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_magnific_library_disable' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable Isotope JS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_isotope_library_disable_js' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable owl carousel JS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_owl_library_disable_js' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable FlexSlider JS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_flex_library_disable_js' ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php esc_html_e( 'Disable magnific popup JS', 'fancy-post-grid' ); ?></td>
                                    <td>
                                        <?php fpg_settings_option_field( 'plugin_magnific_library_disable_js' ); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>

			</form>

		</div>

	<?php }

    function fpg_settings_option_field( $settings_field_id ){
        $settings_options = get_option( 'fpg_settings_option' );
        if( isset( $settings_options[ $settings_field_id ] ) ){
            $settings_option_field = $settings_options[ $settings_field_id ];
        }
        if( !empty( $settings_option_field ) ){
            echo esc_html( $settings_option_field );
        }
        else{
            esc_html_e( 'Not Selected', 'fancy-post-grid' );
        }
    }

	function fpg_settings_page_general() {
		register_setting(
			'fpg_settings_option_group', // option_group
			'fpg_settings_option', // option_name
		);

		add_settings_section(
			'fpg_setting_section',
			'',
			'settings_section_info_fpg',
			'fpg_settings_admin'
		);

		add_settings_field(
			'primary_color_0',
			esc_html__( 'Primary Color', 'fancy-post-grid' ),
			'primary_color_0_callback_fpg',
			'fpg_settings_admin',
			'fpg_setting_section'
		);

		add_settings_field(
			'secondary_color_1',
			esc_html__( 'Secondary Color', 'fancy-post-grid' ),
			'secondary_color_1_callback_fpg',
			'fpg_settings_admin',
			'fpg_setting_section'
		);

		add_settings_field(
			'select_single_template_2',
			esc_html__( 'Select Single Template', 'fancy-post-grid' ),
			'select_single_template_2_callback_fpg',
			'fpg_settings_admin',
			'fpg_setting_section'
		);

		add_settings_field(
			'single_template_p_t_b',
			esc_html__( 'Single Template Padding Top/Bottom', 'fancy-post-grid' ),
			'single_template_p_t_b_callback_fpg',
			'fpg_settings_admin',
			'fpg_setting_section'
		);

		add_settings_field(
			'details_page_enable_3',
			esc_html__( 'Disable Details Page', 'fancy-post-grid' ),
			'details_page_enable_3_callback_fpg',
			'fpg_settings_admin',
			'fpg_setting_section'
		);

	}

	function settings_sanitize_fpg($input) {
		$sanitary_values = array();
		if ( isset( $input['primary_color_0'] ) ) {
			$sanitary_values['primary_color_0'] = sanitize_text_field( $input['primary_color_0'] );
		}

		if ( isset( $input['secondary_color_1'] ) ) {
			$sanitary_values['secondary_color_1'] = sanitize_text_field( $input['secondary_color_1'] );
		}

		if ( isset( $input['select_single_template_2'] ) ) {
			$sanitary_values['select_single_template_2'] = $input['select_single_template_2'];
		}

		if ( isset( $input['details_page_enable_3'] ) ) {
			$sanitary_values['details_page_enable_3'] = $input['details_page_enable_3'];
		}
        
        if ( isset( $input['uteam_url_rewrite'] ) ) {
			$sanitary_values['uteam_url_rewrite'] = $input['uteam_url_rewrite'];
		}

		return $sanitary_values;
	}

	function settings_section_info_fpg() {}

	function primary_color_0_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
		printf(
			'<input class="regular-text-color" type="text" name="fpg_settings_option[primary_color_0]" id="primary_color_0" value="%s">',
			isset( $settings_options['primary_color_0'] ) ? esc_attr( $settings_options['primary_color_0']) : ''
		);
	}

	function secondary_color_1_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
		printf(
			'<input class="regular-text-color" type="text" name="fpg_settings_option[secondary_color_1]" id="secondary_color_1" value="%s">',
			isset( $settings_options['secondary_color_1'] ) ? esc_attr( $settings_options['secondary_color_1']) : ''
		);
	}

	function select_single_template_2_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
		?> 
        <select name="fpg_settings_option[select_single_template_2]" id="select_single_template_2">
            <?php $selected = (isset( $settings_options['select_single_template_2'] ) && $settings_options['select_single_template_2'] === 'plugin') ? 'selected' : '' ; ?>
            <option value="plugin" <?php echo esc_attr( $selected ); ?>><?php esc_html_e( 'From Plugin', 'fancy-post-grid' ); ?></option>
            <?php $selected = (isset( $settings_options['select_single_template_2'] ) && $settings_options['select_single_template_2'] === 'theme') ? 'selected' : '' ; ?>
            <option value="theme" <?php echo esc_attr( $selected ); ?>><?php esc_html_e( 'From Theme', 'fancy-post-grid' );?></option>
		</select> 
        <?php
	}

    function single_template_p_t_b_callback_fpg(){
        $settings_options = get_option( 'fpg_settings_option' );
		printf(
			'<label class="">
                <input type="text" name="fpg_settings_option[s_template_p_t_b]" id="s_template_p_t_b" value="%s">
                    </label>',
            isset($settings_options['s_template_p_t_b']) ? $settings_options['s_template_p_t_b'] : '80px'
		);
    }

	function details_page_enable_3_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
		printf(
			'<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[details_page_enable_3]" id="details_page_enable_3" value="details_page_disable" %s> <div class="slider-rs round"></div>
                    </label>',
			( isset( $settings_options['details_page_enable_3'] ) && $settings_options['details_page_enable_3'] === 'details_page_disable' ) ? 'checked' : ''
		);
	}

    /*
     * Enable/Disable CSS
     * */
    function fpg_settings_page_ed_css() {
        register_setting(
            'fpg_settings_option_group_ed_css',
            'fpg_settings_option',
        );

        add_settings_section(
            'fpg_setting_section',
            '',
            'settings_section_info_fpg',
            'fpg_settings_admin-ed_css'
        );
        add_settings_field(
            'plugin_bootstrap_library_disable',
            esc_html__( 'Disable Boostrap CSS', 'fancy-post-grid' ),
            'plugin_bootstrap_library_disable_callback_fpg',
            'fpg_settings_admin-ed_css',
            'fpg_setting_section'
        );
        add_settings_field(
            'plugin_fontawesome_library_disable',
            esc_html__( 'Disable Fontawesome CSS', 'fancy-post-grid' ),
            'plugin_fontawesome_library_disable_callback_fpg',
            'fpg_settings_admin-ed_css',
            'fpg_setting_section'
        );

        add_settings_field(
            'plugin_owl_library_disable',
            esc_html__( 'Disable owl carousel CSS', 'fancy-post-grid' ),
            'plugin_owl_library_disable_callback_fpg',
            'fpg_settings_admin-ed_css',
            'fpg_setting_section'
        );
        add_settings_field(
            'plugin_flex_library_disable',
            esc_html__( 'Disable FlexSlider CSS', 'fancy-post-grid' ),
            'plugin_flex_library_disable_callback_fpg',
            'fpg_settings_admin-ed_css',
            'fpg_setting_section'
        );

        add_settings_field(
            'plugin_magnific_library_disable',
            esc_html__( 'Disable magnific popup CSS', 'fancy-post-grid' ),
            'plugin_magnific_library_disable_callback_fpg',
            'fpg_settings_admin-ed_css',
            'fpg_setting_section'
        );
    }

    function plugin_bootstrap_library_disable_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_bootstrap_library_disable]" id="plugin_bootstrap_library_disable" value="bootstrap_css" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_bootstrap_library_disable'] ) && $settings_options['plugin_bootstrap_library_disable'] === 'bootstrap_css' ) ? 'checked' : ''
        );
    }

    function plugin_fontawesome_library_disable_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_fontawesome_library_disable]" id="plugin_fontawesome_library_disable" value="fontawesome" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_fontawesome_library_disable'] ) && $settings_options['plugin_fontawesome_library_disable'] === 'fontawesome' ) ? 'checked' : ''
        );
    }

    function plugin_owl_library_disable_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_owl_library_disable]" id="plugin_owl_library_disable" value="owl" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_owl_library_disable'] ) && $settings_options['plugin_owl_library_disable'] === 'owl' ) ? 'checked' : ''
        );
    }

    function plugin_flex_library_disable_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_flex_library_disable]" id="plugin_flex_library_disable" value="flex" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_flex_library_disable'] ) && $settings_options['plugin_flex_library_disable'] === 'flex' ) ? 'checked' : ''
        );
    }

    function plugin_magnific_library_disable_callback_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_magnific_library_disable]" id="plugin_magnific_library_disable" value="magnific" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_magnific_library_disable'] ) && $settings_options['plugin_magnific_library_disable'] === 'magnific' ) ? 'checked' : ''
        );
    }

    /*
     * Enable/Disable JS
     * */
    function fpg_settings_page_ed_js(){
        register_setting(
            'fpg_settings_option_group_ed_js',
            'fpg_settings_option',
        );

        add_settings_section(
            'fpg_setting_section',
            '',
            'settings_section_info_fpg',
            'fpg_settings_admin-ed_js'
        );


        add_settings_field(
            'plugin_isotope_library_disable_js',
            esc_html__( 'Disable Isotope JS', 'fancy-post-grid' ),
            'plugin_isotope_library_disable_callback_js_fpg',
            'fpg_settings_admin-ed_js',
            'fpg_setting_section'
        );

        add_settings_field(
            'plugin_owl_library_disable_js',
            esc_html__( 'Disable owl carousel JS', 'fancy-post-grid' ),
            'plugin_owl_library_disable_callback_fpg_js',
            'fpg_settings_admin-ed_js',
            'fpg_setting_section'
        );
        add_settings_field(
            'plugin_flex_library_disable_js',
            esc_html__( 'Disable FlexSlider JS', 'fancy-post-grid' ),
            'plugin_flex_library_disable_callback_fpg_js',
            'fpg_settings_admin-ed_js',
            'fpg_setting_section'
        );

        add_settings_field(
            'plugin_magnific_library_disable_js',
            esc_html__( 'Disable magnific popup JS', 'fancy-post-grid' ),
            'plugin_magnific_library_disable_callback_fpg_js',
            'fpg_settings_admin-ed_js',
            'fpg_setting_section'
        );
    }

    function plugin_isotope_library_disable_callback_js_fpg() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_isotope_library_disable_js]" id="plugin_isotope_library_disable_js" value="isotope_js" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_isotope_library_disable_js'] ) && $settings_options['plugin_isotope_library_disable_js'] === 'isotope_js' ) ? 'checked' : ''
        );
    }

    function plugin_owl_library_disable_callback_fpg_js() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_owl_library_disable_js]" id="plugin_owl_library_disable_js" value="owl" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_owl_library_disable_js'] ) && $settings_options['plugin_owl_library_disable_js'] === 'owl' ) ? 'checked' : ''
        );
    }

    function plugin_flex_library_disable_callback_fpg_js() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_flex_library_disable_js]" id="plugin_flex_library_disable_js" value="flex" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_flex_library_disable_js'] ) && $settings_options['plugin_flex_library_disable_js'] === 'flex' ) ? 'checked' : ''
        );
    }

    function plugin_magnific_library_disable_callback_fpg_js() {
        $settings_options = get_option( 'fpg_settings_option' );
        printf('
			<label class="switch-rs-settings"><input type="checkbox" name="fpg_settings_option[plugin_magnific_library_disable_js]" id="plugin_magnific_library_disable_js" value="magnific" %s> <div class="slider-rs round"></div>
            </label>',
            ( isset( $settings_options['plugin_magnific_library_disable_js'] ) && $settings_options['plugin_magnific_library_disable_js'] === 'magnific' ) ? 'checked' : ''
        );
    }

