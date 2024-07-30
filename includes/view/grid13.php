<?php
ob_start();
?>
<!-- Grid style 13 -->
<section class="rs-blog-layout-29">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="rs-blog-layout-29-info-box">
                    <span><?php esc_html_e('News', 'fancy-post-grid'); ?> </span>
                    <h2 class="title"><?php esc_html_e('Latest Blog Posts', 'fancy-post-grid'); ?> </h2>
                    <div class="heading-border-line left-style"></div>
                    <p><?php esc_html_e('Tempore corrupti temporibus fuga earum asperiss ores fugit breakpoint for tablet devices for creative agency.', 'fancy-post-grid'); ?> </p>
                    <a class="rs-btn" href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php esc_html_e('More Blog', 'fancy-post-grid'); ?> </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <?php
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
                                <div class="rs-blog-layout-29-item">
                                    <div class="rs-thumb">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
                                    </div>
                                    <div class="rs-content">
                                        <div class="rs-meta">
                                            <ul>
                                                <li style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; font-size: <?php echo esc_attr($fpg_meta_date_font_size); ?>px;"
                                            onmouseover="this.style.color='<?php echo esc_attr($fpg_meta_date_hover_color); ?>'; " 
                                            onmouseout="this.style.color='<?php echo esc_attr($fpg_meta_date_color); ?>'; "><?php echo get_the_date('d M Y'); ?></li>
                                                <li><a href="#"><?php the_category(', '); ?></a></li>
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
                                            
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo 'No posts found';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$grid13 = ob_get_clean();
?>