<?php
ob_start();
?>

<!-- Blog Grid Layout 8  -->
<section class="rs-blog-layout-15">
    <div class="container">
        <div class="row">

            <?php
            // Assuming you have a custom post type named 'your_custom_post_type'
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page, // Number of posts to display
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                $main_cl_lg = empty($fancy_post_cl_lg) ? 'col-lg-4' : 'col-lg-' . $fancy_post_cl_lg;
                $main_cl_md = empty($fancy_post_cl_md) ? 'col-md-4' : 'col-md-' . $fancy_post_cl_md;
                $main_cl_sm = empty($fancy_post_cl_sm) ? 'cl-sm-6' : 'col-sm-' . $fancy_post_cl_sm;
                $main_cl_mobile = empty($fancy_post_cl_mobile) ? 'col-sm-12' : 'col-sm-' . $fancy_post_cl_mobile;
            ?>

                <div class="<?php echo esc_attr($main_cl_lg . ' ' .  $main_cl_md . ' ' . $main_cl_sm . ' ' . $main_cl_mobile); ?>">
                    <div class="rs-blog-layout-15-item">
                        <div class="rs-content">
                            <div class="rs-meta">
                                <div class="meta-date">
                                    <span style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; " >
                                        <?php echo get_the_date('M j, Y'); ?>
                                        
                                    </span>
                                </div>
                                <div class="meta-author">
                                    <a style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; font-size: <?php echo esc_attr($fpg_meta_author_font_size); ?>px;"
                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_author_hover_color); ?>'; " 
                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_author_color); ?>'; " href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                </div>
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
                        </div>
                        <div class="rs-thumb">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => get_the_title()));
                            }
                            ?>
                            <div class="rs-category">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $category = $categories[0]; // Use the first category
                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '"><i class="ri-bookmark-line"></i>' . esc_html($category->name) . '</a>';
                                }
                                ?>
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
<!-- End Blog Grid Layout 8  -->

<?php
$grid8 = ob_get_clean();
?>