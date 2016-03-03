<?php
get_header();

$ID = get_option('page_for_posts');
$content_columns = ot_get_option('coll_blog_sidebar') ? '9' : '12';

// thumbnail
$outputT = '';
if (has_post_thumbnail($ID)) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID), 'full');

    $outputT .= '<section class="background drop-menu-after js-coll-page-section coll-page-section">';
    $outputT .= '<div class="js-coll-parallax coll-section-background">';
    $outputT .= '<img class="coll-bg-image js-coll-lazy"
                            width="' . $thumb[1] . '"
                            height="' . $thumb[2] . '"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            data-coll-src="' . $thumb[0] . '"
                            alt="' . get_the_title($ID) . '" />';
    $outputT .= '<div class="color-overlay"></div>';
    $outputT .= '</div>';
    $outputT .= '</section>';
}


?>
<div class="wrapper common coll-single <?php if (has_post_thumbnail($ID)) {
    echo 'coll-parallax';
} ?>" id="skrollr-body">
<?php echo $outputT; ?>
    <section class="title-container js-coll-page-section coll-page-section">
        <div class="row">
            <div class="large-12 columns">
                <div class="title-wrapper">
                    <h1 class="title-text"><?php echo get_the_title($ID); ?></h1>

                    <h3 class="subtitle-text">
                        <?php echo coll_get_excerpt_by_id($ID, ot_get_option('coll_excerpt_length'), '<a><em><strong>', ''); ?>
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <section class="content-container js-coll-page-section coll-page-section">
        <div class="row">
            <div class="large-<?php echo $content_columns; ?> columns coll-post-list">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <!--BEGIN .hentry -->
                        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                            <div class="coll-section-divider title-divider">
                                <span class="text large-2 medium-2"><a class="no-border"
                                                                       href="<?php the_permalink(); ?>"><?php the_time('d M Y'); ?></a></span>
                                <span class="line large-10 medium-10"><span class="color"></span></span>
                            </div>
                            <div class="wrapper large-10 large-offset-2 medium-10 medium-offset-2">
                                <h2 class="title"><a class="no-border"
                                                     href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                <div class="post-meta">
                                    <span class="by-author"><?php _e('By ', 'framework');
                                        the_author(); ?></span>
                                </div>
                                <?php
                                $output = '';
                                if (has_post_thumbnail()) :
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                    $output .= '<img class="image js-coll-lazy"
                                                        width="' . $thumb[1] . '"
                                                        height="' . $thumb[2] . '"
                                                        data-coll-src="' . $thumb[0] . '" />';
                                    ?>
                                    <div class="asset">
                                        <a class="no-border"
                                           href="<?php the_permalink(); ?>"><?php echo $output; ?> </a>
                                    </div>
                                <?php endif; ?>

                                <div class="content clearfix">
                                    <?php
                                    if (strpos($post->post_content, '<!--more-->')) {
                                        the_content('');
                                        $post_url = get_the_permalink();
                                        $post_url .= '#more-' . get_the_ID();
                                        echo "<a href='" . $post_url . "' class='more-link '>Continue Reading...</a>";
                                    } else {
                                        the_content('');
                                    }
                                    ?>
                                </div>


                                <footer class="coll-post-info">
                                    <?php

                                    $categ = get_the_category()[0];
                                    $categ_link = get_category_link($categ->term_id);
                                    $tags = get_the_tags();

                                    ?>
                                    <div class="taxonomy">
                                        <a class="category" href="<?php echo esc_url($categ_link)?>"><?php echo esc_html($categ->name) ?></a>
                                        <?php if ($tags): foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id))?>"><?php echo esc_html($tag->name) ?></a>
                                        <?php endforeach; endif;?>
                                    </div>
                                </footer>

                            </div>
                        </article>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
            <?php if (ot_get_option('coll_blog_sidebar')) : ?>
                <div class="large-3 columns coll-sidebar">
                    <div class="sidebar-container">
                        <?php //if (!dynamic_sidebar()) dynamic_sidebar('coll-blog-sidebar'); ?>
                        <?php get_template_part("template-sidebar"); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php if (get_previous_posts_link() || get_next_posts_link()) : ?>
    <section class="navigation-container coll-blog-navi js-coll-page-section coll-page-section">
        <div class="row">
            <div class="large-<?php echo $content_columns; ?> columns">
                <div class="coll-section-divider">
                    <span class="text large-2 medium-2"><?php _e('More Posts', 'framework'); ?></span>
                    <span class="line large-10 medium-10"><span class="color"></span></span>
                </div>
                <div class="large-10 medium-10 large-offset-2 medium-offset-2">
                    <div class="row">
                        <div class="previous large-6 columns">
                            <?php if (get_previous_posts_link()) : ?>
                                <a class="arrow" href="<?php echo coll_get_url(get_previous_posts_link()); ?>">
                                    <div class="icon"><i class="fa fa-long-arrow-left"></i></div>
                                    <div class="info">
                                        <h3 class="title-text"> <?php _e('Newer Posts', 'framework'); ?></h3>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="next large-6 columns">
                            <?php if (get_next_posts_link()) : ?>
                                <a class="arrow" href="<?php echo coll_get_url(get_next_posts_link()); ?>">
                                    <div class="icon"><i class="fa fa-long-arrow-right"></i></div>
                                    <div class="info">
                                        <h3 class="title-text"> <?php _e('Older Posts', 'framework'); ?></h3>
                                    </div>
                                </a>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>