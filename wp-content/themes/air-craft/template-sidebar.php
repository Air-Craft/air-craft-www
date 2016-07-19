<?php

$demo_video = ot_get_option('ac-demo-video-link');
$mailchimp_url = ot_get_option('ac-mailchimp-form-url');
$mailchimp_key = ot_get_option('ac-mailchimp-form-key');

?>

<div id="ac-sidebar">
    <section class="widget categories widget_search">
        <form role="search" method="get" id="searchform" class="subscribe searchform" action="http://ac2.localhost/">
            <div>
                <label class="screen-reader-text" for="s">Search for:</label>
                <input type="text" value="" name="s" id="s" />
                <input type="submit" id="searchsubmit" value="Search" />
            </div>
        </form>
        <?php if (!is_page()): ?>
        <h3>Categories</h3>
        <ul>
            <li><a href="/news" alt="News">News</a></li>
            <li><a href="/music" alt="Music">Music</a></li>
            <li><a href="/code" alt="Code">Code</a></li>
            <?php
        /*$categories = get_categories( array(
            'orderby' => 'name',
                'order'   => 'ASC'
                ) );
        foreach( $categories as $category ) {
            printf( '<li><a href="%1$s" alt="%2$s">%3$s</a></li>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
        }*/
        ?></ul>
        <?php endif; ?>

    </section>

    <section class="widget sabre">
        <a
            href="<?php echo $demo_video?>"
            class="phone row video colorbox prevent-underline-on-fa"><img class="phone" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/sabre-phone-flat-1.png" alt="AC Sabre Instrument View"/><i class="fa fa-play-circle-o"></i></a>
        <img class="title" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-sabre-text.png" alt="AC Sabre"/>
        <p class="byline">Musical Instrument, Evolved</p>
        		<div class="call-to-action">
            <a  href="<?php echo $demo_video?>"
                id="video-play-btn"
                class="row video colorbox prevent-underline-on-fa"><i class="fa fa-play-circle-o"></i> <span>Watch the Demo</span></a></div>                
        <div class=""><a target="_blank" href="https://itunes.apple.com/gb/app/id1039046999?mt=8&at=1000lob4&ct=website" style="position: relative; left: 6px; display:inline-block;overflow:hidden;background:url(https://linkmaker.itunes.apple.com/images/badges/en-us/badge_appstore-lrg.svg) no-repeat;width:165px;height:40px; zoom:1.5"></a></div>

<!-- <div class="row subscribe">
            <i class="fa fa-envelope"></i>
            <div>
                <form method="post" action="<?php echo $mailchimp_url ?>">
                    <input type="email" class="email" name="EMAIL" placeholder="News, sales, freebies..." required />
                    <button type="submit">SUBMIT</button>
                    <div style="position: absolute; left: -5000px;">
                        <input type="text" name="<?php echo $mailchimp_key?>" tabindex="-1" value="">
                    </div>
                    <input type="hidden" name="ORIGIN" value="sabre-home" />
                </form>
            </div>
        </div> -->
        
    </section>
</div>