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
		//tab-1
		$layout_type                   = get_post_meta($post_id, 'fpg_layout_select', true);
		$post_type                     = get_post_meta($post_id, 'fpg_post_type', true);
		$post_category                 = get_post_meta($post_id, 'fpg_post_category', true);
		$posts_per_page                = get_post_meta($post_id, 'fpg_post_per_page', true);
        
        //tab-2
		$fpg_grid_style                = get_post_meta($post_id, 'fancy_post_grid_style', true);
		$fancy_post_grid_column 	   = get_post_meta($post_id, 'fancy_post_grid_column', true);
		
		//tab-4
		$fpg_slider_style              = get_post_meta($post_id, 'fancy_slider_style', true);
		
		$primary_color                 = get_post_meta($post_id, 'uteam_pcolor', true);
		$secondary_color               = get_post_meta($post_id, 'uteam_scolor', true);	


		//Tab-7 Title Settings
		$fpg_title_color               = get_post_meta($post_id, 'fpg_title_color', true);
		$fpg_title_bg_color            = get_post_meta($post_id, 'fpg_title_bg_color', true);
		//Description Settings
		$fpg_description_color        = get_post_meta($post_id, 'fpg_description_color', true);
		//More Post Section
		$fpg_read_more_color           = get_post_meta($post_id, 'fpg_read_more_color', true);
		//Meta Section
		$fpg_meta_date_color           = get_post_meta($post_id, 'fpg_meta_date_color', true);
		$fpg_meta_date_icon_color      = get_post_meta($post_id, 'fpg_meta_date_icon_color', true);
		$fpg_meta_author_color         = get_post_meta($post_id, 'fpg_meta_author_color', true);
		$fpg_meta_author_icon_color    = get_post_meta($post_id, 'fpg_meta_author_icon_color', true);
		
		
		//tab-8 Hover color
		$fpg_title_hover_color               = get_post_meta($post_id, 'fpg_title_hover_color', true);
		
		$fpg_description_hover_color        = get_post_meta($post_id, 'fpg_description_hover_color', true);
		

		//setting for slider
		$cl_lg                 = get_post_meta($post_id, 'fpg_cl_lg', true);
		$cl_md                 = get_post_meta($post_id, 'fpg_cl_md', true);

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
			
		}

		/*=====================================================================
		//Slider type check 
	 	=======================================================================*/

		elseif($layout_type == "slider"){			

		   	if( $fpg_slider_style == 'style1'){				
				require  $dir.'view/slider1.php';	
				return $slider1;		
			}

			if( $fpg_slider_style == 'style2'){				
				require  $dir.'view/slider2.php';
				return $slider2;		
			}

			if( $fpg_slider_style == 'style3'){				
				require  $dir.'view/slider3.php';	
				return $slider3;		
			}
		}

	}
}
add_shortcode( 'fancy_gird_post_shortcode', 'fpg_shortcode' );