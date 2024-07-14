<?php
ob_start();
?>

<!-- ==== Blog Grid Layout 7 ==== -->
<section class="rs-blog-layout-14 grey">
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
                    $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-6' : 'col-lg-' . $fancy_post_grid_column;
            ?>

                    
                    <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
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
            else :
                echo 'No posts found';
            endif;
            ?>

        </div>
    </div>
</section>
<!-- ==== End Blog Grid Layout 7 ==== -->

<?php
$grid7 = ob_get_clean();
?>