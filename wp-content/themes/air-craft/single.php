<?php get_header(); ?>
<?php
$content_columns = ot_get_option('coll_blog_sidebar') ? '9' : '12';

if (have_posts()) :
    while (have_posts()) :
        the_post();
        // thumbnail
        $outputT = '';

		// Grab the header for the blog page
		$ID = get_option('page_for_posts');
		
		// thumbnail
		$outputT = '';
		if (has_post_thumbnail($ID)) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID), 'full');
		// if (has_post_thumbnail()) {
            // $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

            $outputT .= '<section class="background drop-menu-after js-coll-page-section coll-page-section">';
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
        <div class="wrapper page-single common coll-single coll-post coll-parallax" id="skrollr-body">
        <?php echo $outputT; ?>
        <section class="title-container js-coll-page-section coll-page-section">
            <div class="row">
                <div class="large-12 columns">
                    <div class="coll-section-divider title-divider">
                        <span class="text large-2 medium-2"><?php the_time('d M Y'); ?></span>
                        <span class="line large-10 medium-10"><span class="color"></span></span>
                    </div>

                    <div class="title-wrapper">
                        <!-- <h1 class="title-text"><?php the_category(); ?></h1> -->
						<h1 class="title-text"><?php the_title(); ?></h1>

                        <div class="post-meta">
                            <div class="author-meta">
                                <div class="wrapper">
                                    <!-- <div class="image"><?php echo get_avatar(get_the_author_meta('ID'), 100); ?></div> -->
                                    <div class="text">
                                    <span class="by-author"><?php _e('By ', 'framework');
                                        the_author(); ?></span>
                                    </div>
                                </div>
                            </div>
                            <ul class="icons">
                                <li><a class="link"
                                       target="_blank"
                                       href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=Currently reading <?php the_title(); ?>">
                                        <i class="fa fa-twitter"></i> </a></li>
                                <li><a class="link"
                                       target="_blank"
                                       href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>">
                                        <i class="fa fa-facebook"></i></a></li>
                                <li><a class="link"
                                       target="_blank"
                                       href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php the_permalink(); ?>">
                                        <i class="fa fa-google-plus"></i></a></li>
                                <li><a class="link"
                                       target="_blank"
                                       href="javascript:void((function(){var e=document.createElement('script'); e.setAttribute('type','text/javascript'); e.setAttribute('charset','UTF-8'); e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());">
                                        <i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="content-container js-coll-page-section coll-page-section">
	        
            <div class="row">
                <div class="large-<?php echo $content_columns; ?> columns">
                    <div class="coll-section-divider content-divider">
                        <span class="text large-2 medium-2"><?php the_time('d M Y'); ?></span>
                        <span class="line large-10 medium-10"><span class="color"></span></span>
                    </div>
                    <div class="copy-container large-10 large-offset-2 medium-offset-2 medium-10">
                        <div class="content-wrapper">
                            <article class="entry-content clearfix">
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
                            <footer class="coll-post-info">
                                <?php if (false && has_category()) { ?>
                                    <div class="categories">
                                        <span class="caption"><?php _e('Categories ', 'framework'); ?></span>
                                        <span class="list"><?php the_category(' '); ?></span>
                                    </div>
                                <?php } ?>
                                <?php if (has_tag()) { ?>
                                    <div class="tags">
                                        <span class="caption"><?php _e('Tags ', 'framework'); ?></span>
                                        <span class="list"><?php the_tags('', ''); ?></span>
                                    </div>
                                <?php } ?>
                            </footer>
                            <!--                            comment button-->
                            <a class="coll-button coll-accent-color leave-comment"
                               href="<?php echo get_permalink($post->ID); ?>#comments"
                               target="self">
                                <?php _e('Leave a comment', 'framework'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="coll-section-divider">
                        <span class="text large-2 medium-2"><?php _e('More Posts', 'framework'); ?></span>
                        <span class="line large-10 medium-10"><span class="color"></span></span>
                    </div>
                    <div class="navigation-container large-10 large-offset-2 medium-offset-2 medium-10">
                        <div class="row">
                            <div class="previous large-6 medium-6 columns">
                                <?php if (get_previous_post()) : $pID = get_previous_post()->ID; ?>
                                    <a class="arrow" href="<?php echo get_permalink($pID); ?>">
                                        <div class="icon"><i class="fa fa-long-arrow-left"></i></div>
                                        <div class="info">
                                            <label><?php _e('Previous', 'framework'); ?></label>

                                            <h3 class="title-text"><?php echo get_the_title($pID); ?></h3>
                                        </div>

                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="next large-6 medium-6 columns">
                                <?php if (get_next_post()) : $pID = get_next_post()->ID; ?>

                                    <a class="arrow" href="<?php echo get_permalink($pID); ?>">
                                        <div class="icon"><i class="fa fa-long-arrow-right"></i></div>
                                        <div class="info">
                                            <label><?php _e('Next', 'framework'); ?></label>

                                            <h3 class="title-text"><?php echo get_the_title($pID); ?></h3>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div id="comments">

                    </div>

                    <div class="coll-section-divider">
                        <span class="text large-2 medium-2"><?php _e('Comments', 'framework'); ?></span>
                        <span class="line large-10 medium-10"><span class="color"></span></span>
                    </div>
                    <div class="comments-container large-10 large-offset-2  medium-offset-2 medium-10">
                        <?php comments_template('', true); ?>
                    </div>
                    <?php if ('open' == $post->comment_status) : ?>
                        <div class="coll-section-divider">
                            <span class="text large-2 medium-2"><?php _e('Comment', 'framework'); ?></span>
                            <span class="line large-10 medium-10"><span class="color"></span></span>
                        </div>
                        <div class="form-container large-10 large-offset-2 medium-offset-2 medium-10">
                            <?php coll_output_comment_form(array('class_submit' => 'myclass')); ?>
                        </div>
                    <?php endif; ?>

                </div>
                <!--                end left-->
                <?php if (ot_get_option('coll_blog_sidebar')) : ?>
                    <div class="large-3 columns">
                        <div class="sidebar-container">
                            <?php if (!dynamic_sidebar()) dynamic_sidebar('coll-blog-sidebar'); ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
        </section>





    <?php
    endwhile;
endif; ?>
<?php get_footer(); ?>