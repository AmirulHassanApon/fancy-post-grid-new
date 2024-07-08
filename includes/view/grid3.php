<?php
ob_start();
?>
<!-- ==== Blog Grid Layout 3 ==== -->
<section class="rs-blog-layout-5 rs-blog-layout-7">
    <div class="container">
        <div class="row">

            <?php
            // Query posts from the custom post type 'your_custom_post_type'
            $args = array(
                'post_type'      => $post_type,
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
            );

            $query = new WP_Query($args);
            

            // Loop through the custom query
            while ($query->have_posts()) : $query->the_post();
                
                $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-4' : 'col-lg-' . $fancy_post_grid_column;
            ?>

                <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
                    <div class="rs-blog__single mt-30">
                        <div class="rs-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=""></a>
                        </div>
                        <div class="rs-content">

                            <ul >
                                <li style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; ">

                                    <i class="ri-calendar-2-line" style="color: <?php echo esc_attr($fpg_meta_date_icon_color); ?>; "> 
                                    </i> 
                                    <?php echo get_the_date('M d, Y'); ?>
                                </li>
                                <li style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; ">
                                    <i class="ri-user-line" style="color: <?php echo esc_attr($fpg_meta_author_icon_color); ?>; " >
                                    </i> 
                                    <?php the_author(); ?>
                                </li>
                            </ul>

                            <h3 class="title" style="color: <?php echo esc_attr($fpg_title_color); ?>; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;">
                                <a href="<?php the_permalink(); ?>"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; ">
                                   <?php the_title(); ?>
                                </a>
                            </h3>

                            <a class="rs-main-btn" style="color: <?php echo esc_attr($fpg_read_more_color); ?>; " href="<?php the_permalink(); ?>">
                                <?php esc_html_e('Read More', 'fancy-post-grid'); ?> 
                                <i class="ri-arrow-right-line"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata(); // Reset the custom query to avoid conflicts
            ?>

        </div>
    </div>
</section>

<!-- ==== Blog Grid Layout 3  ==== -->

<?php
$grid3 = ob_get_clean();
?>