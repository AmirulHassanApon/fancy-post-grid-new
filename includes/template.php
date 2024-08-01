<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


 /*=====================================================================
	// Fancy Post Grid ShortCode
  =======================================================================*/

function fpg_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'id' => "", 
		), $atts);
		global $post;
		$post_id = $atts['id'];		
		if($post_id!='xx'){	

 /*===========================================================
       //retrive settings value form settings page
   ============================================================*/

		
		//Tab-4 Title Settings
		$fancy_post_type                            = get_post_meta( $post_id, 'fancy_post_type', true );
	    $fpg_include_only                           = get_post_meta( $post_id, 'fpg_include_only', true );
	    $fpg_exclude                                = get_post_meta( $post_id, 'fpg_exclude', true );
	    $fpg_limit                                  = get_post_meta( $post_id, 'fpg_limit', true );
	    $fpg_offset                                 = get_post_meta( $post_id, 'fpg_offset', true );
	    $fpg_filter_categories                      = get_post_meta( $post_id, 'fpg_filter_categories', true );
	    $fpg_filter_tags                            = get_post_meta( $post_id, 'fpg_filter_tags', true );
	    $fpg_field_group_taxonomy                   = get_post_meta( $post_id, 'fpg_field_group_taxonomy', true );
	    $fpg_filter_category_terms                  = get_post_meta( $post_id, 'fpg_filter_category_terms', true );
	    $fpg_filter_tags_terms                      = get_post_meta( $post_id, 'fpg_filter_tags_terms', true );
	    $fpg_category_operator                      = get_post_meta( $post_id, 'fpg_category_operator', true );
	    $fpg_tags_operator                          = get_post_meta( $post_id, 'fpg_tags_operator', true );
	    $fpg_relation                               = get_post_meta( $post_id, 'fpg_relation', true );
	    $fpg_order_by                               = get_post_meta( $post_id, 'fpg_order_by', true );
	    $fpg_order                                  = get_post_meta( $post_id, 'fpg_order', true );
	    $fpg_filter_authors                         = get_post_meta( $post_id, 'fpg_filter_authors', true );
	    $fpg_filter_statuses                        = get_post_meta( $post_id, 'fpg_filter_statuses', true );

	    $fpg_search                                 = get_post_meta( $post_id, 'fpg_search', true );
		
		//tab-8 Hover color
		$fpg_title_hover_color         = get_post_meta($post_id, 'fpg_title_hover_color', true);
		$fpg_description_hover_color   = get_post_meta($post_id, 'fpg_description_hover_color', true);

		//tab-2-Layout Settings
		//Start
		$layout_type                   = get_post_meta($post_id, 'fpg_layout_select', true);
		$fpg_grid_style                = get_post_meta($post_id, 'fancy_post_grid_style', true);
		$fancy_slider_style              = get_post_meta($post_id, 'fancy_slider_style', true);

		//Columns		
		$fancy_post_cl_lg                           = get_post_meta( $post_id, 'fancy_post_cl_lg', true );
	    $fancy_post_cl_md                           = get_post_meta( $post_id, 'fancy_post_cl_md', true );
	    $fancy_post_cl_xs                           = get_post_meta( $post_id, 'fancy_post_cl_xs', true );
	    $fancy_post_cl_mobile                       = get_post_meta( $post_id, 'fancy_post_cl_mobile', true );

	    //Pagination
	    $fancy_post_pagination                      = get_post_meta( $post_id, 'fancy_post_pagination', true );
	    $posts_per_page                				= get_post_meta($post_id, 'fpg_post_per_page', true);

	    //Link
	    $fancy_link_details                         = get_post_meta( $post_id, 'fancy_link_details', true );
    	$fancy_link_target                          = get_post_meta( $post_id, 'fancy_link_target', true );

    	//tab-3 Advanced Settings
    	$fancy_post_title_tag                       = get_post_meta( $post_id, 'fancy_post_title_tag', true );
    	$fancy_post_title_limit_type                = get_post_meta( $post_id, 'fancy_post_title_limit_type', true );
    	$fancy_post_title_limit                     = get_post_meta( $post_id, 'fancy_post_title_limit', true );

    	//feature-image
    	$fancy_post_hide_feature_image              = get_post_meta( $post_id, 'fancy_post_hide_feature_image', true );	    
	    $fancy_post_feature_image_size              = get_post_meta( $post_id, 'fancy_post_feature_image_size', true );
	    $fancy_post_media_source                    = get_post_meta( $post_id, 'fancy_post_media_source', true ); 
	    $fancy_post_hover_animation                 = get_post_meta( $post_id, 'fancy_post_hover_animation', true );

	    //Excerpt
	    $fancy_post_excerpt_limit                   = get_post_meta( $post_id, 'fancy_post_excerpt_limit', true );
	    $fancy_post_excerpt_type                    = get_post_meta( $post_id, 'fancy_post_excerpt_type', true );
	    $fancy_post_excerpt_more_text               = get_post_meta( $post_id, 'fancy_post_excerpt_more_text', true );
	    //Read Button
	    $fancy_post_read_more_border_radius         = get_post_meta( $post_id, 'fancy_post_read_more_border_radius', true );
    	$fancy_post_read_more_alignment             = get_post_meta( $post_id, 'fancy_post_read_more_alignment', true );
    	$fancy_post_read_more_text                  = get_post_meta( $post_id, 'fancy_post_read_more_text', true );
    	
    	//Field Selector -Tab-4
    	$fpg_field_group_title                      = get_post_meta( $post_id, 'fpg_field_group_title', true );
	    $fpg_field_group_excerpt                    = get_post_meta( $post_id, 'fpg_field_group_excerpt', true );
	    $fpg_field_group_read_more                  = get_post_meta( $post_id, 'fpg_field_group_read_more', true );
	    $fpg_field_group_image                      = get_post_meta( $post_id, 'fpg_field_group_image', true );
	    $fpg_field_group_post_date                  = get_post_meta( $post_id, 'fpg_field_group_post_date', true );
	    $fpg_field_group_author                     = get_post_meta( $post_id, 'fpg_field_group_author', true );
	    $fpg_field_group_categories                 = get_post_meta( $post_id, 'fpg_field_group_categories', true );
	    $fpg_field_group_tags                       = get_post_meta( $post_id, 'fpg_field_group_tags', true );
	    $fpg_field_group_comment_count              = get_post_meta( $post_id, 'fpg_field_group_comment_count', true );

	    //Style
	    $fpg_primary_color                          = get_post_meta( $post_id,'fpg_primary_color', true); 
	    //Button
	    $fpg_button_background_color                = get_post_meta( $post_id,'fpg_button_background_color', true); 
	    $fpg_button_hover_background_color          = get_post_meta( $post_id,'fpg_button_hover_background_color', true); 
	    $fpg_button_text_color                      = get_post_meta( $post_id,'fpg_button_text_color', true ); 
	    $fpg_button_text_hover_color                = get_post_meta( $post_id,'fpg_button_text_hover_color', true ); 
	    //full Section
	    $fpg_section_background_color               = get_post_meta( $post_id, 'fpg_section_background_color', true );
	    $fpg_section_margin                         = get_post_meta( $post_id, 'fpg_section_margin', true );
	    $fpg_section_padding                        = get_post_meta( $post_id, 'fpg_section_padding', true );


	    // Title
	    $fpg_title_color                            = get_post_meta( $post_id,'fpg_title_color', true); 
	    $fpg_title_font_size                        = get_post_meta( $post_id,'fpg_title_font_size', true); 
	    $fpg_title_font_weight                      = get_post_meta( $post_id,'fpg_title_font_weight', true ); 
	    $fpg_title_alignment                        = get_post_meta( $post_id,'fpg_title_alignment', true ); 

	    //Title Hover
	    $fpg_title_hover_color                      = get_post_meta( $post_id,'fpg_title_hover_color', true); 
	    $fpg_title_hover_font_size                  = get_post_meta( $post_id,'fpg_title_hover_font_size', true); 
	    $fpg_title_hover_font_weight                = get_post_meta( $post_id,'fpg_title_hover_font_weight', true ); 
	    $fpg_title_hover_alignment                  = get_post_meta( $post_id,'fpg_title_hover_alignment', true ); 

	    //Excerpt
	    $fpg_excerpt_color                          = get_post_meta( $post_id,'fpg_excerpt_color', true); 
	    $fpg_excerpt_size                           = get_post_meta( $post_id,'fpg_excerpt_size', true); 
	    $fpg_excerpt_font_weight                    = get_post_meta( $post_id,'fpg_excerpt_font_weight', true ); 
	    $fpg_excerpt_alignment                      = get_post_meta( $post_id,'fpg_excerpt_alignment', true ); 

	    //Meta Data
	    $fpg_meta_color                             = get_post_meta( $post_id,'fpg_meta_color', true); 
	    $fpg_meta_size                              = get_post_meta( $post_id,'fpg_meta_size', true); 
	    $fpg_meta_font_weight                       = get_post_meta( $post_id,'fpg_meta_font_weight', true ); 
	    $fpg_meta_alignment                         = get_post_meta( $post_id,'fpg_meta_alignment', true ); 
	    	
       
		$dir = plugin_dir_path( __FILE__ );

	 	/*=====================================================================
		//Grid type check 
	  	=======================================================================*/
	
		if($layout_type == "grid"){

			if( $fpg_grid_style  == 'style1'){				
				require  $dir.'view/grid1.php';	
				return $grid1;		
			}
			if( $fpg_grid_style  == 'style2'){				
				require  $dir.'view/grid2.php';	
				return $grid2;		
			}

			if( $fpg_grid_style  == 'style3'){				
				require  $dir.'view/grid3.php';	
				return $grid3;		
			}
			if( $fpg_grid_style  == 'style4'){				
				require  $dir.'view/grid4.php';	
				return $grid4;		
			}
			if( $fpg_grid_style  == 'style5'){				
				require  $dir.'view/grid5.php';	
				return $grid5;		
			}

			if( $fpg_grid_style  == 'style6'){				
				require  $dir.'view/grid6.php';	
				return $grid6;		
			}
			if( $fpg_grid_style  == 'style7'){				
				require  $dir.'view/grid7.php';	
				return $grid7;		
			}
			if( $fpg_grid_style  == 'style8'){				
				require  $dir.'view/grid8.php';	
				return $grid8;		
			}

			if( $fpg_grid_style  == 'style9'){				
				require  $dir.'view/grid9.php';	
				return $grid9;		
			}
			if( $fpg_grid_style  == 'style10'){				
				require  $dir.'view/grid10.php';	
				return $grid10;		
			}
			if( $fpg_grid_style  == 'style11'){				
				require  $dir.'view/grid11.php';	
				return $grid11;		
			}

			if( $fpg_grid_style  == 'style12'){				
				require  $dir.'view/grid12.php';	
				return $grid12;		
			}
			if( $fpg_grid_style  == 'style13'){				
				require  $dir.'view/grid13.php';	
				return $grid13;		
			}
			
		}

		/*=====================================================================
		//Slider type check 
	 	=======================================================================*/

		elseif($layout_type == "slider"){			

		   	if( $fancy_slider_style == 'style1'){				
				require  $dir.'view/slider1.php';	
				return $slider1;		
			}

			if( $fancy_slider_style == 'style2'){				
				require  $dir.'view/slider2.php';
				return $slider2;		
			}

			if( $fancy_slider_style == 'style3'){				
				require  $dir.'view/slider3.php';	
				return $slider3;		
			}

			if( $fancy_slider_style == 'style4'){				
				require  $dir.'view/slider4.php';	
				return $slider4;		
			}

			if( $fancy_slider_style == 'style5'){				
				require  $dir.'view/slider5.php';
				return $slider5;		
			}

			if( $fancy_slider_style == 'style6'){				
				require  $dir.'view/slider6.php';	
				return $slider6;		
			}
			if( $fancy_slider_style == 'style7'){				
				require  $dir.'view/slider7.php';	
				return $slider7;		
			}
		}

	}
}
add_shortcode( 'fancy_gird_post_shortcode', 'fpg_shortcode' );