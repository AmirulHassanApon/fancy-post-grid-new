<?php
ob_start();
?>
<!-- ==== Blog Layout 11 ==== -->
<section class="rs-blog-layout-26">
    <div class="container">
        <div class="row">

            <?php
            // Assuming you have a custom post type named 'your_custom_post_type'
            $args = array(
                'post_type'      => 'wp-fpg',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-4' : 'col-lg-' . $fancy_post_grid_column;
            ?>

                    <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
                        <div class="rs-blog-layout-26-item">
                            <div class="rs-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="">
                                </a>
                                <svg viewBox="0 0 410 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="shape__rs_course">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M346.69 23.5159C371.59 23.3769 398.013 17.3185 410 4.85404V32H0V9.75773C2.99658 0.284217 26.1914 -2.12936 41.5898 1.81449C49.0762 3.72855 55.7041 6.53361 62.3281 9.33695C69.3286 12.2997 76.3247 15.2605 84.3242 17.1654C111.49 25.8323 134.405 18.6565 157.427 11.4472C171.419 7.06559 185.451 2.67167 200.5 1.81449C217.549 0.842933 234.721 5.15653 251.493 9.36967C259.098 11.2798 266.62 13.1693 274.011 14.5363C278.288 15.3272 282.339 16.1309 286.297 16.9161C304.269 20.4812 320.31 23.6632 346.69 23.5159Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="rs-content">
                                <div class="rs-meta">
                                    <div class="meta-date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                            onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; ">
                                            <span><?php echo esc_html(get_the_date('d M Y')); ?></span>
                                    </div>
                                    <div class="meta-category">
                                        <?php the_category('<a href="#">', '</a>'); ?>
                                    </div>
                                    
                                </div>
                                <h3 class="title"style="color: <?php echo esc_attr($fpg_title_color); ?>; font-size: <?php echo esc_attr($fpg_font_size_title); ?>px; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                        onmouseover=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_hover_color); ?>';"
                                        onmouseout=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_color); ?>';">
                                        <a href="<?php the_permalink(); ?>"
                                            onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; ">
                                           <?php the_title(); ?>  
                                        </a>
                                </h3>
                                <p style="color: <?php echo esc_attr($fpg_description_color); ?>; font-size: <?php echo esc_attr($fpg_description_font_size); ?>px; background-color: <?php echo esc_attr($fpg_description_bg_color); ?>;" href="<?php the_permalink(); ?>"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_description_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_hover_color); ?>';"
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_description_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_description_bg_color); ?>';">
                                        <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                                        
                                    </p>
                                <a class="rs-btn" style="color: <?php echo esc_attr($fpg_read_more_color); ?>; font-size: <?php echo esc_attr($fpg_read_more_font_size); ?>px; background-color: <?php echo esc_attr($fpg_read_more_bg_color); ?>;" href="<?php the_permalink(); ?>"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_read_more_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_hover_color); ?>';"
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_read_more_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_color); ?>';">
                                   <?php esc_html_e('Read More', 'fancy-post-grid'); ?> 
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata(); // Reset post data to the main query
            else :
                echo 'No posts found';
            endif;
            ?>

        </div>
    </div>
</section>
<?php
$grid12 = ob_get_clean();
?>
