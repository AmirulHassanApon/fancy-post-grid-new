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
                        "slidesPerView":<?php echo esc_attr($fancy_post_cl_lg_slider); ?>,
                        "freeMode":false, 
                        "loop": true,                       
                        "pagination":{"el":".swiper-pagination-1","clickable": false},
                        "autoplay":{"delay":"3000"},
                        "keyboard": {"enabled":"true"},                        
                        "breakpoints":{                                                       
                            "10":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_mobile_slider ); ?>,"spaceBetween":0},
                            "576":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_sm_slider ); ?>,"spaceBetween":0},
                            "768":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_md_silder); ?>,"spaceBetween":0},
                            "992":{"slidesPerView":<?php echo esc_attr($fancy_post_cl_lg_slider); ?>,"spaceBetween":0}
                        }
                    }'>

                        <div class="swiper-wrapper">

                            <?php
                            // Custom query to fetch posts
                            $args = array(
                                'post_type'      => $fancy_post_type,
                                'post_status'    => 'publish',
                                'posts_per_page' => $fpg_post_per_page, // Number of posts to display
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
                                                    <li class="admin" >
                                                        <i class="ri-user-line" >
                                                            
                                                        </i><?php the_author(); ?>
                                                    </li>
                                                    <li class="date" >
                                                        <i class="ri-calendar-2-line" >
                                                                
                                                        </i><?php echo get_the_date(); ?>
                                                    </li>
                                                </ul>
                                                <h3 class="blog-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                       <?php the_title(); ?>
                                                           
                                                   </a>
                                                </h3>
                                                <div class="desc" href="<?php the_permalink(); ?>"
                                                    ><?php echo esc_html(get_the_excerpt()); ?>
                                                </div>

                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="blog-btn" >
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
<style type="text/css">

    /* General Styles */
    .rs-blog-layout-1 {
        background-color: <?php echo esc_attr($fpg_section_background_color); ?>;
        margin: <?php echo esc_attr($fpg_section_margin); ?>;
        padding: <?php echo esc_attr($fpg_section_padding); ?>;
    }
    .rs-blog-layout-1 .blog-item .blog-content .blog-title a {
        color: <?php echo esc_attr($fpg_title_color); ?>;
        font-size: <?php echo esc_attr($fpg_title_font_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_title_font_weight); ?>;
    }
    
    .rs-blog-layout-5 .rs-blog__single .rs-content .title {
        text-align: <?php echo esc_attr($fpg_title_alignment); ?>;
    }
    .rs-blog-layout-5 .rs-blog__single .rs-content .title a:hover {
        color: <?php echo esc_attr($fpg_title_hover_color); ?>;
        font-size: <?php echo esc_attr($fpg_title_hover_font_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_title_hover_font_weight); ?>;
    }
    .rs-blog-layout-5 .rs-blog__single .rs-content .title:hover {

        text-align: <?php echo esc_attr($fpg_title_hover_alignment); ?>;
    }

    .rs-blog-layout-5 .title-link {
        color: <?php echo esc_attr($fpg_title_color); ?>;
    }

    .rs-blog-layout-5 .title-link:hover {
        color: <?php echo esc_attr($fpg_title_hover_color); ?>;
    }

    /* Excerpt Styles */
    .rs-blog-layout-5 .fpg-excerpt {
        color: <?php echo esc_attr($fpg_excerpt_color); ?>;
        font-size: <?php echo esc_attr($fpg_excerpt_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_excerpt_font_weight); ?>;
        text-align: <?php echo esc_attr($fpg_excerpt_alignment); ?>;
    }
    .rs-blog-layout-5 .rs-blog__single .rs-content .rs-link.read-more {
        border-radius: <?php echo esc_attr($fancy_post_read_more_border_radius); ?>px;
        text-align: <?php echo esc_attr($fancy_post_read_more_alignment); ?>;
    }
    /* Meta Data Styles */
    .rs-blog-layout-5 .rs-blog__single .rs-content ul li ,
    .rs-blog-layout-5 .rs-blog__single .rs-content ul li i,
    .rs-blog-layout-5 .rs-blog__single .rs-content ul li a,
    .rs-blog-layout-5 .meta-data-list .meta-date i,
    .rs-blog-layout-5 .meta-data-list .meta-author i,
    .rs-blog-layout-5 .meta-data-list .meta-categories i,
    .rs-blog-layout-5 .meta-data-list .meta-comment-count i,
    .rs-blog-layout-5 .meta-data-list .meta-tags i ,
    .rs-blog-layout-5 .fpg-pagination{
        color: <?php echo esc_attr($fpg_meta_color); ?>;
        font-size: <?php echo esc_attr($fpg_meta_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_meta_font_weight); ?>;
        text-align: <?php echo esc_attr($fpg_meta_alignment); ?>;
    }

    /* Button Styles */
    .rs-blog-layout-5 .rs-blog__single .rs-content .rs-link {
        background-color: <?php echo esc_attr($fpg_button_background_color); ?>;
        color: <?php echo esc_attr($fpg_button_text_color); ?>;
    }

    .rs-blog-layout-5 .rs-blog__single .rs-content .rs-link:hover {
        background-color: <?php echo esc_attr($fpg_button_hover_background_color); ?>;
        color: <?php echo esc_attr($fpg_button_text_hover_color); ?>;
    }
</style>
<?php
$slider1 = ob_get_clean();
?>
