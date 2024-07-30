<?php
ob_start();
?>
<section class="rs-blog-layout-18">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper_wrap">
                    <div class="swiper rs-mySwiper" data-swiper='{
                        "spaceBetween":0,
                        "slidesPerView":3,
                        "freeMode":false,
                        "loop": true,
                        "pagination":{"el":".swiper-pagination-18","clickable": true},
                        "autoplay":{"delay":"5000"},
                        "keyboard": {"enabled":"true"},
                        "breakpoints":{
                            "10":{"slidesPerView":1,"spaceBetween":0},
                            "576":{"slidesPerView":2,"spaceBetween":0},
                            "768":{"slidesPerView":2,"spaceBetween":0},
                            "992":{"slidesPerView":3,"spaceBetween":0}
                        }
                    }'>
                        <div class="swiper-wrapper">

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
                            ?>

                                    <div class="swiper-slide">
                                        <div class="rs-blog-layout-18-item">
                                            <div class="rs-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('full', array('class' => 'img-fluid', 'alt' => get_the_title()));
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="rs-content">
                                                <div class="rs-meta">
                                                    <ul>
                                                        <li><i class="ri-bookmark-line"></i> <?php the_category(', '); ?></li>
                                                        <li><i class="ri-user-line"></i> <?php the_author(); ?></li>
                                                    </ul>
                                                </div>
                                                
                                                <h3 class="title">
                                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                                </h3>
                                                <a class="rs-btn" href="<?php the_permalink(); ?>">Read More</a>
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
                    <div class="swiper-pagination swiper-pagination-18"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$slider5 = ob_get_clean();
?>