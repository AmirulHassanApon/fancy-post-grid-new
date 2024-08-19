<?php
ob_start();
?>

<!-- ==== Blog Slider Layout 2 ==== -->
<section class="rs-blog-layout-1 rs-blog-layout-2 grey">
    <div class="container">
        <div class="row">
            <?php 
            $pagination_config = '';
            echo($pagination_config);
            if ($fpg_pagination_slider === 'normal') {
                $pagination_config = '"pagination": {"el": ".swiper-pagination", "clickable": true}';
            } elseif ($fpg_pagination_slider === 'dynamic') {
                $pagination_config = '"pagination": {"el": ".swiper-pagination", "dynamicBullets": true, "clickable": true}';
            } elseif ($fpg_pagination_slider === 'progress') {
                $pagination_config = '"pagination": {"el": ".swiper-pagination", "type": "progressbar"}';
            } elseif ($fpg_pagination_slider === 'fraction') {
                $pagination_config = '"pagination": {"el": ".swiper-pagination", "type": "fraction"}';
            }

            // If navigation is needed for certain pagination types
            $navigation_config = '"navigation": {"nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev"}';
            ?>
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>,
                        "slidesPerView":<?php echo esc_attr($fancy_post_cl_lg_slider); ?>,
                        "freeMode":<?php echo esc_attr($fancy_free_mode); ?>, 
                        "loop": <?php echo esc_attr($fancy_loop); ?>, 
                        <?php echo $pagination_config; ?>,
                        <?php if (in_array($fpg_pagination_slider, ['progress', 'fraction'])) {
                            echo ',' . $navigation_config;
                        } ?>,                      
                        
                        
                        "autoplay":{"delay":"<?php echo esc_attr($fancy_autoplay); ?>"},
                        "keyboard": {"enabled":"<?php echo esc_attr($fancy_keyboard); ?>"},                        
                        "breakpoints":{                                                       
                            "10":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_mobile_slider ); ?>,"spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>},
                            "576":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_sm_slider ); ?>,"spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>},
                            "768":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_md_silder); ?>,"spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>},
                            "992":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_lg_slider); ?>,"spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>}
                        }
                    }'>
                        <div class="swiper-wrapper">

                            <?php
                            // Custom query to fetch posts
                            $args = array(
                                'post_type'      => 'post',
                                'post_status'    => 'publish',
                                'posts_per_page' => $posts_per_page, // Number of posts to display
                            );

                            $query = new WP_Query($args);

                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                                    ?>

                                    <div class="swiper-slide">
                                        <div class="blog-item">
                                            <div class="image-wrap shape-show">
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=""></a>
                                            </div>
                                            <div class="blog-content">
                                                <ul class="blog-meta">
                                                    <li class="admin" style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; ">
                                                        <i class="ri-user-line" style="color: <?php echo esc_attr($fpg_meta_author_icon_color); ?>; " >
                                                            
                                                        </i><?php the_author(); ?>
                                                    </li>
                                                    <li class="date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; " >
                                                        <i class="ri-calendar-2-line" style="color: <?php echo esc_attr($fpg_meta_date_icon_color); ?>; ">
                                                                
                                                        </i><?php echo get_the_date(); ?>
                                                    </li>
                                                </ul>
                                                <h3 class="blog-title"style="color: <?php echo esc_attr($fpg_title_color); ?>; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;">
                                                    <a href="<?php the_permalink(); ?>"
                                                        >
                                                       <?php the_title(); ?>
                                                           
                                                   </a>
                                                </h3>
                                                <div class="desc" style="color: <?php echo esc_attr($fpg_description_color); ?>; " href="<?php the_permalink(); ?>"
                                                    ><?php echo esc_html(get_the_excerpt()); ?>
                                                </div>

                                                <div class="blog-btn"style="color: <?php echo esc_attr($fpg_read_more_color); ?>; " href="<?php the_permalink(); ?>"
                                                        >
                                                       <?php esc_html_e('Read More', 'fancy-post-grid'); ?> 
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endwhile;
                                wp_reset_postdata(); // Reset post data
                            else :
                                echo 'No posts found';
                            endif;
                            ?>

                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider2 = ob_get_clean();
?>
