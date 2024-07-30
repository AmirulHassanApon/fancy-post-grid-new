<?php
ob_start();
?>
<!-- Grid style 4 -->
<section class="rs-blog-layout-30 grey">
    <div class="container">
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
                        <div class="rs-blog-layout-30-item">
                            <div class="rs-thumb">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                <div class="meta-date">
                                    <span><?php echo get_the_date('F j, Y'); ?></span>
                                </div>
                            </div>
                            <div class="rs-content">
                                <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="rs-meta">
                                    <ul>
                                        <li><?php the_author(); ?></li>
                                        <li><?php the_category(', '); ?></li>
                                    </ul>
                                </div>
                                <p><?php echo get_the_excerpt(); ?></p>
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
</section>

<?php
$grid4 = ob_get_clean();
?>