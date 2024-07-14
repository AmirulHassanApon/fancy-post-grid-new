<?php
ob_start();
?>
<!-- ==== Blog Layout 5 ==== -->
<section class="rs-blog-layout-12 grey">
    <div class="container">
        <div class="row">
            <?php

            $args = array(
                'post_type'      => $post_type,
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
            );

            $query = new WP_Query($args);

            // Check if there are posts
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $column_width_class = empty($fancy_post_grid_column) ? 'col-lg-6' : 'col-lg-' . $fancy_post_grid_column;
            ?>
                    <div class="<?php echo esc_attr($column_width_class . ' col-md-6'); ?>">
                        <div class="pre-blog-item style_12 pre-blog-meta-style2 default">
                            <div class="blog-inner-wrap pre-thum-default pre-meta-blocks top">
                                <div class="pre-image-wrap">
                                    <a class="pre-pointer-events" href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('roofio_new_size', array('class' => 'attachment-roofio_new_size size-roofio_new_size wp-post-image', 'alt' => get_the_title())); ?>
                                    </a>
                                    <div class="pre-blog-meta">
                                        <span class="pre-date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; "> <?php echo get_the_date('d'); ?></span>
                                        <span class="pre-month" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; "> <?php echo get_the_date('F'); ?></span>
                                    </div>
                                </div>
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
            else :
                echo 'No posts found';
            endif;
            ?>
        </div>
    </div>
</section>
<?php
$grid5 = ob_get_clean();
?>