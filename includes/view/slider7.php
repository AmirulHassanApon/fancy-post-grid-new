<?php
ob_start();
?>
<section class="rs-blog-layout-28" style="background-image: url(assets/images/blog-bg-home1.webp);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":0,
                        "slidesPerView":3,
                        "freeMode":false,
                        "loop": true,
                        "pagination":{"el":".swiper-pagination-28","clickable": true},
                        "autoplay":{"delay":"5000"},
                        "keyboard": {"enabled":"true"},
                        "breakpoints":{
                            "10":{"slidesPerView":1,"spaceBetween":0},
                            "576":{"slidesPerView":1,"spaceBetween":0},
                            "768":{"slidesPerView":2,"spaceBetween":0},
                            "992":{"slidesPerView":3,"spaceBetween":0}
                        }
                    }'>
                        <div class="swiper-wrapper">
                            <?php
                            // Query WordPress posts
                            $args = array(
                                'post_type'      => 'wp-fpg',
                                'post_status'    => 'publish',
                                'posts_per_page' => $posts_per_page, // Number of posts to display
                            );
                            
                            $query = new WP_Query($args);

                            // Loop through posts
                            while ($query->have_posts()) : $query->the_post();
                            ?>
                                <div class="swiper-slide">
                                    <div class="rs-blog-layout-28-item">
                                        <div class="rs-thumb">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt=""></a>
                                            <div class="rs-meta">
                                                <ul>
                                                    <li><?php echo get_the_date('d M Y'); ?></li>
                                                    <li><a href="#"><?php the_category(', '); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="rs-content">
                                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                            <a class="rs-btn" href="<?php the_permalink(); ?>">Read More <i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-28"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider7 = ob_get_clean();
?>