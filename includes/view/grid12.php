<?php
ob_start();
?>
<!-- ==== Blog Layout 11 ==== -->
<section class="rs-blog-layout-26">
    <div class="container">
        <div class="row">

            <?php
            // Check if pagination is on or off
            $fpg_post_per_page = -1;
            if ($fancy_post_pagination === 'off') {
                $fpg_post_per_page = -1;
            }  

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

            // Loop through the custom query
            while ($query->have_posts()) : $query->the_post();

                $main_cl_lg = empty($fancy_post_cl_lg) ? 'col-lg-4' : 'col-lg-' . $fancy_post_cl_lg;
                $main_cl_md = empty($fancy_post_cl_md) ? 'col-md-4' : 'col-md-' . $fancy_post_cl_md;
                $main_cl_sm = empty($fancy_post_cl_sm) ? 'col-sm-6' : 'col-sm-' . $fancy_post_cl_sm;
                $main_cl_mobile = empty($fancy_post_cl_mobile) ? 'col-sm-12' : 'col-sm-' . $fancy_post_cl_mobile;

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


                    <div class="<?php echo esc_attr($main_cl_lg . ' ' .  $main_cl_md . ' ' . $main_cl_sm . ' ' . $main_cl_mobile); ?>">
                        <div class="rs-blog-layout-26-item">
                            <div class="rs-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="">
                                </a>
                                <svg viewBox="0 0 410 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="shape__rs_course">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M346.69 23.5159C371.59 23.3769 398.013 17.3185 410 4.85404V32H0V9.75773C2.99658 0.284217 26.1914 -2.12936 41.5898 1.81449C49.0762 3.72855 55.7041 6.53361 62.3281 9.33695C69.3286 12.2997 76.3247 15.2605 84.3242 17.1654C111.49 25.8323 134.405 18.6565 157.427 11.4472C171.419 7.06559 185.451 2.67167 200.5 1.81449C217.549 0.842933 234.721 5.15653 251.493 9.36967C259.098 11.2798 266.62 13.1693 274.011 14.5363C278.288 15.3272 282.339 16.1309 286.297 16.9161C304.269 20.4812 320.31 23.6632 346.69 23.5159Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="rs-content">
                                <div class="rs-meta">
                                    <div class="meta-date" >
                                            <span><?php echo esc_html(get_the_date('d M Y')); ?></span>
                                    </div>
                                    <div class="meta-category">
                                        <?php the_category('<a href="#">', '</a>'); ?>
                                    </div>
                                    
                                </div>
                                <?php if ($fpg_field_group_title) : ?>
                                    <<?php echo esc_attr($title_tag); ?> class="title">
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
                                    <p>
                                        <?php echo wp_trim_words(get_the_content(), $fancy_post_excerpt_limit, $excerpt_more_text); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($fancy_link_details === 'on' && $fpg_field_group_read_more) : ?>
                                    <a class="rs-btn" href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                        <?php echo esc_html($fancy_post_read_more_text); ?>
                                        <i class="ri-arrow-right-line"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata(); // Reset post data to the main query
            
            ?>

        </div>
        <?php if ($fancy_post_pagination === 'on') : ?>
            <div class="fpg-pagination">
                <?php
                echo paginate_links(array(
                    'total'   => $query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'format'  => '?paged=%#%',
                    'show_all' => false,
                    'type'     => 'list',
                    'prev_text' => __('« Prev', 'fancy-post-grid'),
                    'next_text' => __('Next »', 'fancy-post-grid'),
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
$grid12 = ob_get_clean();
?>
