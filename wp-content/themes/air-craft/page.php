<?php get_header(); ?>
<?php
$content_columns = ot_get_option('coll_page_sidebar') ? '9' : '12';

if (have_posts()) :
    while (have_posts()) :
        the_post();
        // thumbnail
        $outputT = '';

        // Get the header from the top level thumbnail image
        $ancestor_ids = get_ancestors($post->ID, 'page');
        if (!($top_id = end($ancestor_ids)))
            $top_id = $post->ID;

        if (has_post_thumbnail($top_id)) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($top_id), 'full');

            $outputT .= '<section class="drop-menu-after background js-coll-page-section coll-page-section">';
            $outputT .= '<div class="js-coll-parallax coll-section-background">';
            $outputT .= '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            class="coll-bg-image js-coll-lazy"
                            width="' . $thumb[1] . '"
                            height="' . $thumb[2] . '"
                            data-coll-src="' . $thumb[0] . '"
                            alt="' . get_the_title($post->ID) . '" />';
            $outputT .= '<div class="color-overlay"></div>';
            $outputT .= '</div>';
            $outputT .= '</section>';
        }
        // NOTE: make coll-parallax conditional if you want to support no header image
        ?>
        <div class="wrapper page-single common coll-single coll-parallax ?>" id="skrollr-body">
        <?php echo $outputT; ?>
        <section class="title-container js-coll-page-section coll-page-section">
            <div class="row">
                <div class="large-12 columns">
                    <div class="title-wrapper">
                        <h1 class="title-text"><?php echo get_the_title(get_the_ID()); ?></h1>

                        <!--<h3 class="subtitle-text">-->
                            <!---->
                        <!--</h3>-->
                    </div>
                </div>
            </div>
        </section>
        <section class="content-container js-coll-page-section coll-page-section">
            <div class="row">
                <div class="large-<?php echo $content_columns; ?> columns">
                    <div class="copy-container">
                        <div class="content-wrapper">
                            <article class="entry-content">
                                <?php the_content(); ?>
                            </article>
                            <?php
                            $defaults = array(
                                'before' => '<ul class="coll-pagination">',
                                'after' => '</ul>',
                                'link_before' => '<li>',
                                'link_after' => '</li>',
                                'next_or_number' => 'number',
                                'separator' => '',
                                'nextpagelink' => __('Next page'),
                                'previouspagelink' => __('Previous page'),
                                'pagelink' => '%',
                                'echo' => 1
                            );

                            wp_link_pages($defaults);
                            ?>
                        </div>
                    </div>
                </div>
                <!--                end left-->
                <?php if (ot_get_option('coll_page_sidebar')) : ?>
                    <div class="large-3 columns">
                        <div class="sidebar-container">
                            <?php //if (!dynamic_sidebar()) dynamic_sidebar('coll-blog-sidebar'); ?>
                            <?php get_template_part("template-sidebar"); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>






    <?php
    endwhile;
endif; ?>
<?php get_footer(); ?>