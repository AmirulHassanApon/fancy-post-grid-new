<?php
ob_start();
?>
<!-- ==== Blog Slider Layout 1 ==== -->
<div class="rs-blog-layout-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":0,
                        "slidesPerView":<?php echo esc_attr($cl_lg); ?>,
                        "freeMode":false,
                        
                        "pagination":{"el":".swiper-pagination-1","clickable": false},
                        
                        
                        "breakpoints":{
                            
                            "768":{"slidesPerView":<?php echo esc_attr($cl_md); ?>,"spaceBetween":0},
                            "992":{"slidesPerView":<?php echo esc_attr($cl_lg); ?>,"spaceBetween":0}
                        }
                    }'>

                        <div class="swiper-wrapper">

                            <?php
                            // Custom query to fetch posts
                            $args = array(
                                'post_type'      => $post_type,
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
                                                    <li class="date" style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; ">
                                                        <i class="ri-calendar-2-line" style="color: <?php echo esc_attr($fpg_meta_date_icon_color); ?>; " >
                                                                
                                                        </i><?php echo get_the_date(); ?>
                                                    </li>
                                                </ul>
                                                <h3 class="blog-title"style="color: <?php echo esc_attr($fpg_title_color); ?>;  background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                                    >
                                                    <a href="<?php the_permalink(); ?>"
                                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_title_hover_color); ?>'; " 
                                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_title_color); ?>'; ">
                                                       <?php the_title(); ?>
                                                           
                                                   </a>
                                                </h3>
                                                <div class="desc" style="color: <?php echo esc_attr($fpg_description_color); ?>;  " href="<?php the_permalink(); ?>"
                                                    ><?php echo esc_html(get_the_excerpt()); ?>
                                                </div>

                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="blog-btn" style="color: <?php echo esc_attr($fpg_read_more_color); ?>;">
                                                        <?php esc_html_e('Read More', 'fancy-post-grid'); ?>
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </div>
                                                </a>

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
                    <div class="swiper-pagination swiper-pagination-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$slider1 = ob_get_clean();
?>