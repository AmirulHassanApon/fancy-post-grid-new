<?php
ob_start();
?>
<section class="rs-blog-layout-23 grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":10,
                        "slidesPerView":3,
                        "freeMode":false,
                        "loop": true,
                        "autoplay":{"delay":"5000"},
                        "keyboard": {"enabled":"true"},
                        "breakpoints":{
                            "10":{"slidesPerView":1,"spaceBetween":10},
                            "576":{"slidesPerView":2,"spaceBetween":10},
                            "768":{"slidesPerView":2,"spaceBetween":10},
                            "992":{"slidesPerView":3,"spaceBetween":10}
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
                                    <div class="rs-blog-layout-23-item">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                        <div class="rs-blog-layout-23-overlay">
                                            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <a class="rs-btn" href="<?php the_permalink(); ?>">Read More <i class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile;
                            wp_reset_postdata(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider6 = ob_get_clean();
?>