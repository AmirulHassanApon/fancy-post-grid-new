<?php
ob_start();
?>
<!-- ==== Blog Slider Layout 4 ==== -->
<section class="rs-blog-layout-4 grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":30,
                        "slidesPerView":3,
                        "freeMode":true,
                        "loop": true,
                        "pagination":{"el":".swiper-pagination-4","clickable": true},
                        "autoplay":{"delay":"5000"},
                        "keyboard": {"enabled":"true"},
                        "breakpoints":{
                            "10":{"slidesPerView":1,"spaceBetween":30},
                            "576":{"slidesPerView":2,"spaceBetween":30},
                            "768":{"slidesPerView":2,"spaceBetween":30},
                            "992":{"slidesPerView":3,"spaceBetween":30}
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
                                        <div class="rs-blog__item">
                                            <div class="rs-thumb">
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=""></a>
                                            </div>
                                            <div class="rs-content">
                                                <div class="rs-category">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if (!empty($categories)) {
                                                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                                    }
                                                    ?>
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
                                                <p style="color: <?php echo esc_attr($fpg_description_color); ?>; font-size: <?php echo esc_attr($fpg_description_font_size); ?>px; background-color: <?php echo esc_attr($fpg_description_bg_color); ?>;" href="<?php the_permalink(); ?>"
                                                    onmouseover="this.style.color='<?php echo esc_attr($fpg_description_hover_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_description_bg_hover_color); ?>';"
                                                    onmouseout="this.style.color='<?php echo esc_attr($fpg_description_color); ?>'; this.style.backgroundColor='<?php echo esc_attr($fpg_description_bg_color); ?>';">
                                                    <?php the_excerpt(); ?>
                                                        
                                                </p>
                                                <div class="rs-blog-footer">
                                                    <span>
                                                        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2.97 8.83317L0 11.1665V0.833171C0 0.65636 0.0702379 0.48679 0.195262 0.361766C0.320286 0.236742 0.489856 0.166504 0.666667 0.166504H10.6667C10.8435 0.166504 11.013 0.236742 11.1381 0.361766C11.2631 0.48679 11.3333 0.65636 11.3333 0.833171V8.83317H2.97ZM2.50867 7.49984H10V1.49984H1.33333V8.42317L2.50867 7.49984ZM4.66667 10.1665H11.4913L12.6667 11.0898V4.1665H13.3333C13.5101 4.1665 13.6797 4.23674 13.8047 4.36177C13.9298 4.48679 14 4.65636 14 4.83317V13.8332L11.03 11.4998H5.33333C5.15652 11.4998 4.98695 11.4296 4.86193 11.3046C4.7369 11.1796 4.66667 11.01 4.66667 10.8332V10.1665Z" fill="#F79C53"></path>
                                                        </svg>
                                                        <?php echo esc_html(get_comments_number()); ?> Comments
                                                    </span>
                                                    
                                                    <a style="color: <?php echo esc_attr($fpg_read_more_color); ?>; font-size: <?php echo esc_attr($fpg_read_more_font_size); ?>px; " href="<?php the_permalink(); ?>"
                                                        onmouseover="this.style.color='<?php echo esc_attr($fpg_read_more_hover_color); ?>';"
                                                        onmouseout="this.style.color='<?php echo esc_attr($fpg_read_more_color); ?>';"> <?php esc_html_e('Read Post', 'fancy-post-grid'); ?>  
                                                            <i class="ri-arrow-right-fill"></i>
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
                    <div class="swiper-pagination swiper-pagination-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider4 = ob_get_clean();
?>
