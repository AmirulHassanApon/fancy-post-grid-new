<?php
ob_start();
?>
<!-- ==== Blog Slider Layout 3 ==== -->
<section class="rs-blog-layout-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":30,
                        "slidesPerView":3,
                        "freeMode":false,                       
                        "pagination":{"el":".swiper-pagination-1","clickable": false},
                        "breakpoints":{
                            
                            "768":{"slidesPerView":2,"spaceBetween":0},
                            "992":{"slidesPerView":3,"spaceBetween":0}
                        }
                    }'>
                        <div class="swiper-wrapper">
                            <?php
                            // WP Query to fetch posts
                            $args = array(
                                'post_type'      => $post_type,
                                'post_status'    => 'publish',
                                'posts_per_page' => $posts_per_page, // Number of posts to display
                            );

                            $query = new WP_Query($args);
                            function calculate_reading_time($content, $words_per_minute = 200) {
                                // Count words in the content
                                $word_count = str_word_count(wp_strip_all_tags($content));

                                // Calculate reading time
                                $reading_time = ceil($word_count / $words_per_minute);

                                // Return reading time in minutes
                                return $reading_time . ' min read';
                            }


                            // Check if there are posts
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                            ?>
                                    <div class="swiper-slide">
                                        <div class="rs-blog__single">
                                            <div class="thumb">
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=""></a>
                                                <div class="rs-contact-icon">
                                                    <a href="#"><svg width="14" height="16" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.70371 13.1768L7.90054e-06 14L0.823208 10.2963C0.28108 9.28226 -0.00172329 8.14985 7.90054e-06 7C7.90054e-06 3.1339 3.13391 0 7 0C10.8661 0 14 3.1339 14 7C14 10.8661 10.8661 14 7 14C5.85015 14.0017 4.71774 13.7189 3.70371 13.1768Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="rs-blog-category">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if (!empty($categories)) {
                                                        $category = $categories[0];
                                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '"><div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6" fill="none"><path d="M3 0L5.59808 1.5V4.5L3 6L0.401924 4.5V1.5L3 0Z" fill="#513DE8"></path><defs><linearGradient x1="-3.93273e-08" y1="0.803572" x2="6.33755" y2="1.30989" gradientUnits="userSpaceOnUse"><stop stop-color="#513DE8" offset="1"></stop><stop offset="1" stop-color="#8366E3"></stop></linearGradient></defs></svg></div>' . esc_html($category->name) . '</a>';
                                                    }
                                                    ?>
                                                </div>
                                                <h3 class="title">
                                                    <a style="color: <?php echo esc_attr($fpg_title_color); ?>; background-color: <?php echo esc_attr($fpg_title_bg_color); ?>;"
                                                        >  
                                                       <?php the_title(); ?>
                                                   </a>
                                                </h3>
                                                <ul>
                                                    <li style="color: <?php echo esc_attr($fpg_meta_date_color); ?>; "
                                                        >
                                                        <?php echo get_the_date('M j, Y'); ?>
                                                            
                                                    </li>
                                                    <li style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; "
                                                       >
                                                        <div class="rs-icon" ><svg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 6 6" fill="none"><path d="M3 0L5.59808 1.5V4.5L3 6L0.401924 4.5V1.5L3 0Z" fill="#513DE8"></path><defs><linearGradient x1="-3.93273e-08" y1="0.803572" x2="6.33755" y2="1.30989" gradientUnits="userSpaceOnUse"><stop stop-color="#513DE8" offset="1"></stop><stop offset="1" stop-color="#8366E3"></stop></linearGradient></defs></svg></div>  <?php echo esc_html(calculate_reading_time(get_the_content())); ?>

                                                    </li>
                                                </ul>
                                                <?php the_excerpt(); ?>
                                                <div class="rs-blog-author">
                                                    <div class="user">
                                                        <a href="#">
                                                            <div class="author-thumb" style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; ">
                                                                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                                            </div>
                                                            <span style="color: <?php echo esc_attr($fpg_meta_author_color); ?>; ">
                                                                 <?php esc_html_e('by', 'fancy-post-grid'); ?>  
                                                                <?php the_author(); ?>
                                                                
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="rs-link"  href="<?php the_permalink(); ?>">
                                   
                                                        <a style="color: <?php echo esc_attr($fpg_read_more_color); ?>; "> <?php esc_html_e('Read Post', 'fancy-post-grid'); ?>  
                                                            <i class="ri-arrow-right-fill" ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata(); // Reset the query
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-3"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider3 = ob_get_clean();
?>
