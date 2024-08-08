<?php
ob_start();
?>
<!-- ==== Blog Layout 5 ==== -->
<section class="rs-blog-layout-12 grey">
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
                $main_cl_sm = empty($fancy_post_cl_sm) ? 'cl-sm-6' : 'col-sm-' . $fancy_post_cl_sm;
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
                        <div class="pre-blog-item style_12 pre-blog-meta-style2 default <?php echo esc_attr($hover_class); ?>">
                            <div class="blog-inner-wrap pre-thum-default pre-meta-blocks top">
                                <?php if (!$hide_feature_image && $fpg_field_group_image) : ?>
                                <div class="pre-image-wrap">
                                    <?php if ($feature_image_url) : ?>
                                        <a class="pre-pointer-events"href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                            <img src="<?php echo esc_url($feature_image_url); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                                
                                <div class="pre-blog-content">
                                    <div class="pre-cat-list">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $category = $categories[0]; // Use the first category
                                        ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                                <img decoding="async" src="" >
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    
                                    <h3 class="pre-post-title" style="color: <?php echo esc_attr($fpg_title_color); ?>; font-size: <?php echo esc_attr($fpg_font_size_title); ?>px; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                            onmouseover=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_hover_color); ?>';"
                                            onmouseout=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_color); ?>';">
                                            <a class="pre-pointer-events" href="<?php the_permalink(); ?>"onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; "><?php the_title(); ?>
                                                
                                            </a>
                                    </h3>
                                    <p class="pre-content" style="color: <?php echo esc_attr($fpg_description_color); ?>; font-size: <?php echo esc_attr($fpg_description_font_size); ?>px; background-color: <?php echo esc_attr($fpg_description_bg_color); ?>;" href="<?php the_permalink(); ?>"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_description_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_hover_color); ?>';"
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_description_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_description_bg_color); ?>';">
                                        <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                                        
                                    </p>

                                    <div class="blog-btn-part">
                                        <a class="blog-btn icon-after" style="color: <?php echo esc_attr($fpg_read_more_color); ?>; font-size: <?php echo esc_attr($fpg_read_more_font_size); ?>px; background-color: <?php echo esc_attr($fpg_read_more_bg_color); ?>;" href="<?php the_permalink(); ?>" 
                                            onmouseover="this.style.color='<?php echo esc_attr($fpg_read_more_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_hover_color); ?>';"
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_read_more_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_color); ?>';">
                                            <span class="btn-txt"><?php esc_html_e('Read More', 'fancy-post-grid'); ?>
                                                
                                            </span>
                                            <i class="ri-arrow-right-circle-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                // Restore original post data
                wp_reset_postdata();
            
            ?>
        </div>
        <?php if ($fancy_post_pagination === 'on') : ?>
            <div class="fpg-pagination">
                <?php
                echo paginate_links(array(
                    'total'   => $query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'format'  => '?paged=%#%',
                    'show_all' => false,
                    'type'     => 'list',
                    'prev_text' => __('« Prev', 'fancy-post-grid'),
                    'next_text' => __('Next »', 'fancy-post-grid'),
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
$grid5 = ob_get_clean();
?>
