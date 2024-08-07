<?php
ob_start();
?>
<!-- Blog Grid 1 -->

<section class="rs-blog-layout-5">
    <div class="container">
        <div class="row">

            <?php
            // Default number of posts per page
            $default_posts_per_page = -1;

            // Check if pagination is on or off
            if ($fancy_post_pagination === 'off') {
                $posts_per_page = $default_posts_per_page;
            }
            $selected_authors = array(1, 2, 3); // Author IDs
            $selected_statuses = array('publish', 'draft'); // Statuses
            $selected_post_in = array();
            $selected_post_not_in = array();

            // Get values from the form inputs
            
            $args = array(
                'post_type'      => 'post',
                'post_status'    => $selected_statuses, // Add status filter
                'posts_per_page' => $posts_per_page, // Number of posts to display
                'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Get current page number
                'orderby'        => $fpg_order_by, // Order by
                'order'          => $fpg_order,   // Order direction
                'author__in'     => $selected_authors, // Add author filter
                'post__in'       => $selected_post_in, // Include only specific posts
                'post__not_in'   => $selected_post_not_in, // Exclude specific posts
                // Static Taxonomy
                
                
            );

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
                    <div class="rs-blog__single mt-30 <?php echo esc_attr($hover_class); ?>">
                            <?php if (!$hide_feature_image && $fpg_field_group_image) : ?>
                                <div class="rs-thumb">
                                    <?php if ($feature_image_url) : ?>
                                        <a href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                            <img src="<?php echo esc_url($feature_image_url); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <div class="rs-content">
                            <ul class="meta-data-list">
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
                                <?php if ($fpg_field_group_tags) : ?>
                                    <li class="meta-tags">
                                        <i class="ri-price-tag-3-line"></i>
                                        <?php the_tags('', ', ', ''); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <?php if ($fpg_field_group_title) : ?>
                                <<?php echo esc_attr($title_tag); ?> class="title">
                                    <?php if ($fancy_link_details === 'on') : ?>
                                        <a href="<?php the_permalink(); ?>"
                                           <?php echo $target_blank; ?>
                                           class="title-link">
                                            <?php the_title(); ?>
                                        </a>
                                    <?php else : ?>
                                        <?php the_title(); ?>
                                    <?php endif; ?>
                                </<?php echo esc_attr($title_tag); ?>>
                            <?php endif; ?>

                            <?php if ($fpg_field_group_excerpt) : ?>
                                <div class="fpg-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            
                             <!-- Display the custom excerpt here -->
                            <?php if ($fancy_link_details === 'on' && $fpg_field_group_read_more) : ?>
                                <a class="rs-link read-more" href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                    <?php echo esc_html($fancy_post_read_more_text); ?>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata(); // Reset the custom query to avoid conflicts
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
<style type="text/css">
    /* General Styles */
.rs-blog-layout-5 {
    background-color: <?php echo esc_attr($fpg_section_background_color); ?>;
    margin: <?php echo esc_attr($fpg_section_margin); ?>;
    padding: <?php echo esc_attr($fpg_section_padding); ?>;
}

/* Title Styles */
.rs-blog-layout-5 .rs-blog__single .rs-content .title a {
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
.rs-blog-layout-5 .read-more {
    border-radius: <?php echo esc_attr($fancy_post_read_more_border_radius); ?>;
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

<!-- End Blog Grid Layout 1 -->
<?php
$grid1 = ob_get_clean();
?>
