<?php
ob_start();
?>

<!--Blog Grid Style 10 -->
<section class="rs-blog-layout-19 grey">
    <div class="container">
        <div class="row">

            <?php
            // Assuming you have a custom post type named 'your_custom_post_type'
            $args = array(
                'post_type'      => $post_type,
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
            );


            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-4' : 'col-lg-' . $fancy_post_grid_column;
            ?>

                    <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
                        <div class="rs-blog-layout-19-item">
                            <div class="rs-thumb">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="">
                            </div>
                            <div class="rs-content">
                                <div class="rs-meta">
                                    <ul>
                                        <li style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; ">
                                            <i class="ri-calendar-line" style="color: <?php echo esc_attr($fpg_meta_date_icon_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_icon_font_size); ?>px;"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_icon_hover_color); ?>'; " 
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_icon_color); ?>'; "> 
                                                    
                                            </i> <?php echo esc_html(get_the_date()); ?>
                                        </li>
                                        <li style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; font-size: <?php echo esc_attr($fpg_meta_author_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_author_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_author_color); ?>'; ">
                                        <a href="<?php the_permalink(); ?>"><i class="ri-user-line" style="color: <?php echo esc_attr($fpg_meta_author_icon_color); ?>; font-size: <?php echo esc_attr($fpg_meta_author_icon_font_size); ?>px;" 
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_author_icon_hover_color); ?>'; "
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_author_icon_color); ?>'; ">
                                                
                                            </i> <?php the_author(); ?></a></li>
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
$grid10 = ob_get_clean();
?>