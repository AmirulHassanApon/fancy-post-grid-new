<?php
ob_start();
?>

<!-- ==== Blog Layout 6 ==== -->
<section class="rs-blog-layout-13">
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
                $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-6' : 'col-lg-' . $fancy_post_grid_column;
            ?>

                    <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
                        <div class="rs-blog-layout-13-item">
                            <div class="rs-thumb">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => get_the_title()));
                                }
                                ?>
                                <div class="pre-blog-meta">
                                    <span class="pre-date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; "> <?php echo get_the_date('d'); ?></span>
                                        <span class="pre-month" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; "> <?php echo get_the_date('F'); ?>
                                    
                                    </span>
                                </div>
                            </div>
                            <div class="rs-content">
                                <div class="rs-meta">
                                    <ul>
                                        <li> <?php esc_html_e('by ', 'fancy-post-grid'); ?> <?php the_author(); ?></li>
                                        <li><?php esc_html_e('News in ', 'fancy-post-grid'); ?> <?php echo get_the_date('Y'); ?></li>
                                    </ul>
                                </div>
                                
                                <h3 class="title" style="color: <?php echo esc_attr($fpg_title_color); ?>; font-size: <?php echo esc_attr($fpg_font_size_title); ?>px; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                        onmouseover=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_hover_color); ?>';"
                                        onmouseout=" this.style.backgroundColor='<?php echo esc_attr($fpg_title_bg_color); ?>';">
                                        <a href="<?php the_permalink(); ?>"
                                            onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; ">
                                           <?php the_title(); ?>
                                        </a>
                                    </h3>

                                <a class="blog-btn" style="color: <?php echo esc_attr($fpg_read_more_color); ?>; font-size: <?php echo esc_attr($fpg_read_more_font_size); ?>px; background-color: <?php echo esc_attr($fpg_read_more_bg_color); ?>;" href="<?php the_permalink(); ?>"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_read_more_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_hover_color); ?>';"
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_read_more_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_read_more_bg_color); ?>';">
                                    <?php esc_html_e('Read More', 'fancy-post-grid'); ?> 
                                    <i class="ri-arrow-right-fill"></i>
                                    
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

<!-- ==== End Blog Layout 6 ==== -->

<?php
$grid6 = ob_get_clean();
?>