<?php
ob_start();
?>
<!-- Blog Grid 1 -->

<section class="rs-blog-layout-5">
    <div class="container">
        <div class="row">

            <?php
            // Default number of posts per page
            $default_posts_per_page = -1;

            // Check if pagination is on or off
            if ($fancy_post_pagination === 'off') {
                $posts_per_page = $default_posts_per_page;
            }

            // Query posts from the custom post type 'your_custom_post_type'
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
                'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Get current page number
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
                    $feature_image_url = !empty($img_src[1]) ? $img_src[1] : '';
                } else {
                    $feature_image_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                }

                // Apply hover animation class if needed
                $hover_class = $hover_animation !== 'none' ? 'hover-' . esc_attr($hover_animation) : '';
            ?>

                <div class="<?php echo esc_attr($main_cl_lg . ' ' .  $main_cl_md . ' ' . $main_cl_sm . ' ' . $main_cl_mobile); ?>">
                    <div class="rs-blog__single mt-30 <?php echo esc_attr($hover_class); ?>">
                            <?php if (!$hide_feature_image) : ?>
                                <div class="rs-thumb">
                                    <?php if ($feature_image_url) : ?>
                                        <a href="<?php the_permalink(); ?>" <?php echo esc_html_e($target_blank); ?>>
                                            <img src="<?php echo esc_url($feature_image_url); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <div class="rs-content">
                            <ul>
                                <li style="color: <?php echo esc_attr($fpg_meta_date_color); ?>;">
                                    <i class="ri-calendar-2-line" style="color: <?php echo esc_attr($fpg_meta_date_icon_color); ?>;"></i>
                                    <?php echo get_the_date('M d, Y'); ?>
                                </li>
                                <li style="color: <?php echo esc_attr($fpg_meta_author_color); ?>;">
                                    <i class="ri-user-line" style="color: <?php echo esc_attr($fpg_meta_author_icon_color); ?>;"></i>
                                    <?php the_author(); ?>
                                </li>
                            </ul>

                            <<?php echo esc_attr($title_tag); ?> class="title" style="color: <?php echo esc_attr($fpg_title_color); ?>; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;">
                                <?php if ($fancy_link_details === 'on') : ?>
                                    <a href="<?php the_permalink(); ?>"
                                       <?php echo esc_html_e($target_blank); ?>
                                       onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>';"
                                       onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>';">
                                        <?php the_title(); ?>
                                    </a>
                                <?php else : ?>
                                    <?php the_title(); ?>
                                <?php endif; ?>
                            </<?php echo esc_attr($title_tag); ?>>

                            <?php if ($fancy_link_details === 'on') : ?>
                                <a class="rs-link" style="color: <?php echo esc_attr($fpg_read_more_color); ?>;" href="<?php the_permalink(); ?>" <?php echo esc_html_e($target_blank); ?>>
                                    <?php esc_html_e('Continue Reading', 'fancy-post-grid'); ?>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata(); // Reset the custom query to avoid conflicts
            ?>

        </div>

        <?php if ($fancy_post_pagination === 'on') : ?>
            <div class="pagination">
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

<!-- End Blog Grid Layout 1 -->
<?php
$grid1 = ob_get_clean();
?>
