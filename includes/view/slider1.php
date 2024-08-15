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
                        "spaceBetween":<?php echo esc_attr($fancy_spacebetween); ?>,
                        "slidesPerView":<?php echo esc_attr($fancy_post_cl_lg_slider); ?>,
                        "freeMode":<?php echo esc_attr($fancy_free_mode); ?>, 
                        "loop": <?php echo esc_attr($fancy_loop); ?>,                       
                        "pagination":{"el":".swiper-pagination-1","dynamicBullets": true,"clickable": <?php echo esc_attr($fancy_pagination_clickable); ?>},
                        
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
                                // =======Pagination==========
                                // Check if pagination is on or off
                                
                                $fpg_post_per_page = -1;
                                  
                                //==============STATUS==============
                                // Ensure it's an array
                                if (!is_array($fpg_filter_statuses)) {
                                    // Convert string to array if necessary
                                    if (is_string($fpg_filter_statuses)) {
                                        $fpg_filter_statuses = explode(',', $fpg_filter_statuses);
                                    } else {
                                        $fpg_filter_statuses = array(); // Default to empty array if not an array or string
                                    }
                                }

                                // ==============AUTHOR==========
                                // Unserialize the data if necessary
                                if (is_string($fpg_filter_authors)) {
                                    $fpg_filter_authors = maybe_unserialize($fpg_filter_authors);
                                }

                                // Ensure it's an array
                                if (!is_array($fpg_filter_authors)) {
                                    $fpg_filter_authors = array(); // Default to empty array if not an array
                                }

                                // Sanitize and convert to integers
                                $selected_authors = array_map('intval', $fpg_filter_authors);

                                //==========Include only==========
                                $selected_post_in = !empty($fpg_include_only) ? explode(',', $fpg_include_only) : array();

                                //=======Exclude===============
                                $selected_post_not_in = !empty($fpg_exclude) ? explode(',', $fpg_exclude) : array();

                                //=================More Text==========
                                $excerpt_more_text = isset($fancy_post_excerpt_more_text) ? $fancy_post_excerpt_more_text : '...'; 
                                $title_more_text = isset($fancy_post_title_more_text) ? $fancy_post_title_more_text : '...'; 

                                // ===========Advanced Filter==============
                                // Capture and sanitize category terms if 'category' taxonomy is selected
                                $category_terms = array_map('intval', $fpg_filter_category_terms); 

                                // Capture and sanitize tag terms if 'tags' taxonomy is selected
                                $tag_terms = array_map('intval', $fpg_filter_tags_terms);           

                                // Get values from the form inputs           
                                $args = array(
                                    'post_type'      => $fancy_post_type,
                                    'post_status'    => $fpg_filter_statuses, // Add status filter
                                    'posts_per_page' => $fpg_post_per_page, // Number of posts to display
                                    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Get current page number
                                    'orderby'        => $fpg_order_by, // Order by
                                    'order'          => $fpg_order,   // Order direction
                                    'author__in'     => $selected_authors, // Add author filter                                          
                                );
                                // Add 'post__in' to the query if not empty
                                if (!empty($selected_post_in)) {
                                    $args['post__in'] = $selected_post_in;
                                }

                                // Add 'post__not_in' to the query if not empty
                                if (!empty($selected_post_not_in)) {
                                    $args['post__not_in'] = $selected_post_not_in;
                                }

                                // Run a preliminary query to get all matching post IDs
                                if ($fpg_limit > 0) {
                                    $pre_query = new WP_Query(array_merge($args, array('posts_per_page' => $fpg_limit, 'fields' => 'ids')));
                                    $post_ids = $pre_query->posts;

                                    // Modify the main query to limit the posts
                                    $args['post__in'] = $post_ids;
                                }

                                // Add taxonomy queries
                                $tax_query = array('relation' => $fpg_relation);

                                if (!empty($fpg_field_group_taxonomy) && in_array('category', $fpg_field_group_taxonomy) && !empty($category_terms)) {
                                    $tax_query[] = array(
                                        'taxonomy' => 'category',
                                        'field'    => 'term_id',
                                        'terms'    => $category_terms,
                                        'operator' => $fpg_category_operator,
                                    );
                                }

                                if (!empty($fpg_field_group_taxonomy) && in_array('tags', $fpg_field_group_taxonomy) && !empty($tag_terms)) {
                                    $tax_query[] = array(
                                        'taxonomy' => 'post_tag',
                                        'field'    => 'term_id',
                                        'terms'    => $tag_terms,
                                        'operator' => $fpg_tags_operator,
                                    );
                                }


                                if (!empty($tax_query)) {
                                    $args['tax_query'] = $tax_query;
                                }
                                // echo '<pre>' . print_r($args, true) . '</pre>';


                                $query = new WP_Query($args);
                            
                            
                                while ($query->have_posts()) : $query->the_post();
                                    // Check if the link should open in a new tab
                                    $target_blank = ($fancy_link_target === 'new') ? 'target="_blank"' : '';
                                    
                                    // Determine the title tag
                                    $title_tag = !empty($fancy_post_title_tag) ? $fancy_post_title_tag : 'h3';
                                    
                                    // Determine if the feature image should be hidden
                                    $hide_feature_image = isset($fancy_post_hide_feature_image) && $fancy_post_hide_feature_image === 'off';
                                    
                                    // Determine the feature image size
                                    $feature_image_size = isset($fancy_post_feature_image_size) ? (string) $fancy_post_feature_image_size : 'large';  
                                               
                                    // Determine the media source
                                    $media_source = isset($fancy_post_media_source) ? $fancy_post_media_source : 'feature_image';
                                    
                                    // Determine the hover animation
                                    $hover_animation = !empty($fancy_post_hover_animation) ? $fancy_post_hover_animation : 'none';
                                    
                                    // Get the feature image or first image from content
                                    if ($media_source === 'first_image') {

                                        $content = get_the_content();
                                        preg_match_all('/<img[^>]+>/i', $content, $matches);
                                        $first_image = !empty($matches[0][0]) ? $matches[0][0] : '';
                                        preg_match('/src="([^"]+)"/i', $first_image, $img_src);
                                        $feature_image_url = !empty($img_src[1]) ? $img_src[1] : get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                                    } else {
                                        $feature_image_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                                    }

                                    // Apply hover animation class if needed
                                    $hover_class = $hover_animation !== 'none' ? 'hover-' . esc_attr($hover_animation) : '';
                                ?>

                                    <div class="swiper-slide">
                                        <div class="blog-item">
                                            
                                            <?php if (!$hide_feature_image && $fpg_field_group_image) : ?>
                                                <div class="image-wrap shape-show">
                                                    <?php if ($feature_image_url) : ?>
                                                        <a href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                                            <img src="<?php echo esc_url($feature_image_url); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="blog-content">
                                                <ul class="blog-meta">
                                                    <?php if ($fpg_field_group_post_date) : ?>
                                                        <li class="meta-date">
                                                            <i class="ri-calendar-2-line"></i>
                                                            <?php echo get_the_date('M d, Y'); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($fpg_field_group_author) : ?>
                                                        <li class="meta-author">
                                                            <i class="ri-user-line"></i>
                                                            <?php the_author(); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($fpg_field_group_categories) : ?>
                                                        <li class="meta-categories">
                                                            <i class="ri-folder-line"></i>
                                                            <?php the_category(', '); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($fpg_field_group_comment_count) : ?>
                                                        <li class="meta-comment-count">
                                                            <i class="ri-chat-3-line"></i>
                                                            <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($fpg_field_group_tag) : ?>
                                                        <li class="meta-tags">
                                                            <i class="ri-price-tag-3-line"></i>
                                                            <?php the_tags('', ', ', ''); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                                
                                                <?php if ($fpg_field_group_title) : ?>
                                                    <<?php echo esc_attr($title_tag); ?> class="blog-title">
                                                        <?php if ($fancy_link_details === 'on') : ?>
                                                            <a href="<?php the_permalink(); ?>"
                                                               <?php echo $target_blank; ?>
                                                               class="title-link">
                                                                <?php echo wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text); ?>
                                                            </a>
                                                        <?php else : ?>
                                                            <?php echo wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text); ?>
                                                        <?php endif; ?>
                                                    </<?php echo esc_attr($title_tag); ?>>
                                                <?php endif; ?>
                                                
                                                <?php if ($fpg_field_group_excerpt) : ?>
                                                    <div class="desc">
                                                        <?php echo wp_trim_words(get_the_content(), $fancy_post_excerpt_limit, $excerpt_more_text); ?>
                                                    </div>
                                                <?php endif; ?>
                                       
                                                <!-- Display the custom excerpt here -->
                                                <?php if ($fancy_link_details === 'on' && $fpg_field_group_read_more) : ?>
                                                    <a href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                                        <div class="blog-btn" >
                                                            <?php echo esc_html($fancy_post_read_more_text); ?>
                                                            <i class="ri-arrow-right-line"></i>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata(); // Reset post data                            
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
    
    .rs-blog-layout-1 .blog-item .blog-content .blog-title {
        text-align: <?php echo esc_attr($fpg_title_alignment); ?>;
    }
    .rs-blog-layout-1 .blog-item .blog-content .blog-title a:hover {
        color: <?php echo esc_attr($fpg_title_hover_color); ?>;
        font-size: <?php echo esc_attr($fpg_title_hover_font_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_title_hover_font_weight); ?>;
    }
    .rs-blog-layout-1 .blog-item .blog-content .blog-title:hover {

        text-align: <?php echo esc_attr($fpg_title_hover_alignment); ?>;
    }

    /* Excerpt Styles */
    .rs-blog-layout-1 .blog-item .blog-content .desc {
        color: <?php echo esc_attr($fpg_excerpt_color); ?>;
        font-size: <?php echo esc_attr($fpg_excerpt_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_excerpt_font_weight); ?>;
        text-align: <?php echo esc_attr($fpg_excerpt_alignment); ?>;
    }
    .rs-blog-layout-1 .blog-item .blog-content .blog-btn {
        border-radius: <?php echo esc_attr($fancy_post_read_more_border_radius); ?>px;
        text-align: <?php echo esc_attr($fancy_post_read_more_alignment); ?>;
    }
    /* Meta Data Styles */
    .rs-blog-layout-1 .blog-item .blog-content .blog-meta ,
    .rs-blog-layout-1 .blog-item .blog-content .blog-meta ul li i,
    .rs-blog-layout-1 .blog-item .blog-content a,
    .rs-blog-layout-1 .blog-meta .meta-date i,
    .rs-blog-layout-1 .blog-meta .meta-author i,
    .rs-blog-layout-1 .blog-meta .meta-categories i,
    .rs-blog-layout-1 .blog-meta .meta-comment-count i,
    .rs-blog-layout-1 .blog-meta .meta-tags i {
        color: <?php echo esc_attr($fpg_meta_color); ?>;
        font-size: <?php echo esc_attr($fpg_meta_size); ?>px;
        font-weight: <?php echo esc_attr($fpg_meta_font_weight); ?>;
        text-align: <?php echo esc_attr($fpg_meta_alignment); ?>;
    }

    /* Button Styles */
    .rs-blog-layout-1 .blog-item .blog-content .blog-btn {
        background-color: <?php echo esc_attr($fpg_button_background_color); ?>;
        color: <?php echo esc_attr($fpg_button_text_color); ?>;
    }

    .rs-blog-layout-1 .blog-item .blog-content .blog-btn:hover {
        background-color: <?php echo esc_attr($fpg_button_hover_background_color); ?>;
        color: <?php echo esc_attr($fpg_button_text_hover_color); ?>;
    }
</style>
<?php
$slider1 = ob_get_clean();
?>
