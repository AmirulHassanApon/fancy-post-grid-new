<?php
ob_start();
?>

<!-- ==== Blog Grid Layout 7 ==== -->
<section class="rs-blog-layout-14 grey">
    <div class="container">
        <div class="row">

            <?php
            // Default number of posts per page
            $default_posts_per_page = -1;

            // Check if pagination is on or off
            if ($fancy_post_pagination === 'off') {
                $posts_per_page = $default_posts_per_page;
            }
            $selected_authors = array(1, 2, 3); // Author IDs
            $selected_statuses = array('publish', 'draft'); // Statuses
            $selected_post_in = array();
            $selected_post_not_in = array();

            // Get values from the form inputs
            
            $args = array(
                'post_type'      => 'post',
                'post_status'    => $selected_statuses, // Add status filter
                'posts_per_page' => $posts_per_page, // Number of posts to display
                'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Get current page number
                'orderby'        => $fpg_order_by, // Order by
                'order'          => $fpg_order,   // Order direction
                'author__in'     => $selected_authors, // Add author filter
                'post__in'       => $selected_post_in, // Include only specific posts
                'post__not_in'   => $selected_post_not_in, // Exclude specific posts
                
                               
            );

            $query = new WP_Query($args);

            // Loop through the custom query
            while ($query->have_posts()) : $query->the_post();

                $main_cl_lg = empty($fancy_post_cl_lg) ? 'col-lg-4' : 'col-lg-' . $fancy_post_cl_lg;
                $main_cl_md = empty($fancy_post_cl_md) ? 'col-md-4' : 'col-md-' . $fancy_post_cl_md;
                $main_cl_sm = empty($fancy_post_cl_sm) ? 'col-sm-6' : 'col-sm-' . $fancy_post_cl_sm;
                $main_cl_mobile = empty($fancy_post_cl_mobile) ? 'col-sm-12' : 'col-sm-' . $fancy_post_cl_mobile;

                // Check if the link should open in a new tab
                $target_blank = ($fancy_link_target === 'new') ? 'target="_blank"' : '';
                
                // Determine the title tag
                $title_tag = !empty($fancy_post_title_tag) ? $fancy_post_title_tag : 'h3';
                
                // Determine if the feature image should be hidden
                $hide_feature_image = isset($fancy_post_hide_feature_image) && $fancy_post_hide_feature_image === 'off';
                
                // Determine the feature image size
                $feature_image_size = isset($fancy_post_feature_image_size) ? (string) $fancy_post_feature_image_size : 'large';  
                           
                // Determine the media source
                $media_source = isset($fancy_post_media_source) ? $fancy_post_media_source : 'feature_image';
                
                // Determine the hover animation
                $hover_animation = !empty($fancy_post_hover_animation) ? $fancy_post_hover_animation : 'none';
                
                // Get the feature image or first image from content
                if ($media_source === 'first_image') {

                    $content = get_the_content();
                    preg_match_all('/<img[^>]+>/i', $content, $matches);
                    $first_image = !empty($matches[0][0]) ? $matches[0][0] : '';
                    preg_match('/src="([^"]+)"/i', $first_image, $img_src);
                    $feature_image_url = !empty($img_src[1]) ? $img_src[1] : get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                } else {
                    $feature_image_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                }

                // Apply hover animation class if needed
                $hover_class = $hover_animation !== 'none' ? 'hover-' . esc_attr($hover_animation) : '';
            ?>
                    
                <div class="<?php echo esc_attr($main_cl_lg . ' ' .  $main_cl_md . ' ' . $main_cl_sm . ' ' . $main_cl_mobile); ?>">
                    <div class="rs-blog-layout-14-item">
                        <div class="rs-thumb">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => get_the_title()));
                            }
                            ?>
                        </div>
                        <div class="rs-content">
                            <h3 class="title" style="color: <?php echo esc_attr($fpg_title_color); ?>; font-size: <?php echo esc_attr($fpg_font_size_title); ?>px; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                    onmouseover=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_hover_color); ?>';"
                                    onmouseout=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_color); ?>';">
                                    <a href="<?php the_permalink(); ?>"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; ">
                                       <?php the_title(); ?>    
                                    </a>
                                </h3>
                            <div class="rs-meta">
                                <span class="meta-date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; " >
                                    <?php echo get_the_date('M j, Y'); ?>
                                                
                                </span>
                                <a class="meta-date"style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; font-size: <?php echo esc_attr($fpg_meta_author_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_author_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_author_color); ?>'; "> 
                                    <?php esc_html_e('by ', 'fancy-post-grid'); ?><?php the_author(); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                endwhile;
                wp_reset_postdata(); // Reset post data to the main query
            
            ?>

        </div>
    </div>
</section>
<!-- ==== End Blog Grid Layout 7 ==== -->

<?php
$grid7 = ob_get_clean();
?>
