<?php
/**
 Template Name: Sabre Home
 */

get_header();

global $coll_parallax_enabled;
$sl_main_id = ($coll_parallax_enabled) ? 'id="skrollr-body"' : '';
global $coll_is_mobile;

$demo_video = ot_get_option('ac-demo-video-link');

$contact_email = antispambot(ot_get_option('ac-public-email'));
$press_email = antispambot(ot_get_option('ac-press-email'));
$skype = antispambot(ot_get_option('ac-skype-link'));
$mailchimp_url = ot_get_option('ac-mailchimp-form-url');
$mailchimp_key = ot_get_option('ac-mailchimp-form-key');
$facebook = ot_get_option('ac-facebook-page');
$twitter = ot_get_option('ac-twitter-page');
$youtube = ot_get_option('ac-youtube-page');
$soundcloud = ot_get_option('ac-soundcloud-page');
$instagram = ot_get_option('ac-instagram-page');

$custom_fields = get_post_meta(get_the_ID());

$imgurl_base = trailingslashit(get_stylesheet_directory_uri()).'img/';

$NEWS_CATEG_ID = 10;
?>

<div <?php echo $sl_main_id; ?> role="main" class="wrapper common">

<section id="home-main" class="sabre-home page-section js-coll-window coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #d7d7d7" >
		<div class="coll-bg-video " >
			<div class="fullscreen-bg">
				<video autoplay loop muted preload="auto">
					<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/mp4" />
					<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/ogg" />
					<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/webm" />
				</video>
			</div>
		</div><div class="coll-bg-video-overlay"></div>
		<div class="coll-bg-video-mute">
			<a href="#" class="js-coll-video-sound"><i class="fa"></i></a>
		</div>
	</div>
	<div class="section-content row ">
		<div class="entry-content columns">
			<div class="coll-middle ">
				<div class="inner">
					<img class="logo" alt="Air Craft" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-logo-for-launch-page@2x.png">
					<h1><img alt="AC Sabre" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-sabre-text-for-launch-page@2x.png"></h1>
					<p class="msg">Musical Instrument, Evolved</p>
					<div class="call-to-action">	
						<a 
						href="<?php echo $demo_video?>"
						id="video-play-btn" 
						class="row video colorbox prevent-underline-on-fa"><i class="fa fa-play-circle-o"></i> <span>Watch the Demo</span></a>
						<div class="row subscribe">
							<i class="fa fa-envelope"></i> 
							<div>
								<div class="text">Launching Soon</div>
								<div class="form">
									<form method="post" action="<?php echo $mailchimp_url ?>">
										<input type="email" class="email" name="EMAIL" placeholder="GET NOTIFIED" required />
										<button type="submit">SUBMIT</button>
										<div style="position: absolute; left: -5000px;">
											<input type="text" name="<?php echo $mailchimp_key?>" tabindex="-1" value="">
										</div>
										<input type="hidden" name="ORIGIN" value="ac-home" />
									</form>
								</div>
							</div>
						</div>
					</div>	
				</div>	
			</div>
		</div>
	</div>
</section>
<section id="home-description" class="home-section page-section  coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"></div>
	<div class="section-content row ">
		<div class="entry-content columns">
			<div class="coll-layerslider coll-slideshow">
				<div class="quote">
					<h3>It’s great for controlling fat, nasty bass patches...</h3>
					<p>&ndash; App Store Reviewer</p>
				</div>
				<div class="description">
					<?php the_post(); the_content() ?>
					<h2>Coming Soon to the App Store</h2>
					<div class="form">
						<i class="fa fa-envelope"></i> 
						<form method="post" action="<?php echo $mailchimp_url ?>">
							<input type="email" class="email" name="EMAIL" placeholder="YOUR EMAIL" required />
							<button type="submit">GET NOTIFIED</button>
							<div style="position: absolute; left: -5000px;">
								<input type="text" name="<?php echo $mailchimp_key?>" tabindex="-1" value="">
							</div>
						<input type="hidden" name="ORIGIN" value="ac-home" />
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="home-highlights" class="page-section coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  ><img class="coll-bg-image"
		src="<?php echo $imgurl_base.'sabre-home-bg1.jpg' ?>"
		width=""
		height=""
		alt="" />
	</div>

	<div class="section-content row text-on-left first">
		<div class="text">
		    <?php echo $custom_fields["Home Highlights HTML 1"][0] ?>
        </div>
        <div class="phone"><img class="coll-bg-image js-coll-lazy"
             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
             width=""
             height=""
             data-coll-ar=""
             data-coll-src="<?php echo $imgurl_base.'sabre-phone-1.png' ?>"
             alt="bg image" /></div>
        <!--<img src="<?php echo $imgurl_base.'sabre-phone-1.png' ?>"/>-->
	</div>
    <div class="section-content row text-on-right last">
        <div class="text">
            <?php echo $custom_fields["Home Highlights HTML 2"][0] ?>
        </div>
        <div class="phone"><img class="coll-bg-image js-coll-lazy"
             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
             width=""
             height=""
             data-coll-ar=""
             data-coll-src="<?php echo $imgurl_base.'sabre-phone-2.png' ?>"
             alt="bg image" /></div>
        <!--<img src="<?php echo $imgurl_base.'sabre-phone-2.png' ?>"/>-->
    </div>
</section>
<section id="home-details" class="home-section page-section  coll-page-section type-coll-page-section status-publish hentry">
    <div class="coll-section-background js-coll-parallax"></div>
    <div class="section-content row ">
        <div class="entry-content columns">
            <div class="coll-layerslider coll-slideshow">
                <div class="quote">
                    <h3 style="font-size: 18px">This app is quite unlike any of the other MIDI controllers...
                        It's great to see developers come up with what are essentially new
                        instruments using the full range of touch and sensor capabilities</h3>
                    <p>&ndash; Apptronica</p>
                </div>
                <div class="description">
                   <h2>Take a Closer Look...</h2>
                   <ul class="closer-look">
                       <li><a href="/support/ac-sabre-manual" class="prevent-underline-on-fa"><i class="manual-icon"></i> AC Sabre User's Guide &raquo;</a></li>
                       <li><a target="_blank" href="<?php echo $youtube_channel?>" class="prevent-underline-on-fa"><i class="fa fa-youtube"></i> Air Craft Youtube Channel &raquo;</a></li>
                       <li><a target="_blank" href="<?php echo $soundcloud_channel?>" class="prevent-underline-on-fa"><i class="fa fa-soundcloud"></i> Air Craft on SoundCloud &raquo;</a></li>
                   </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="misc-section" class="section-content row">
        <div class="subsection contact">
            <h2>Get in Touch</h2>
            <ul class="social sf-menu sf-js-enabled sf-arrows">
                <li><a target="_blank" href="{$public_email}"><i class="fa fa-email"></i></a></li>
                <li><a target="_blank" href="{$skype}"><i class="fa fa-skype"></i></a></li>
                <li><a target="_blank" href="{$facebook}"><i class="fa fa-facebook"></i></a></li>
                <li><a target="_blank" href="{$twitter}"><i class="fa fa-twitter"></i></a></li>
                <li><a target="_blank" href="{$youtube}"><i class="fa fa-youtube"></i></a></li>
                <li><a target="_blank" href="{$soundcloud}"><i class="fa fa-soundcloud"></i></a></li>
                <li><a target="_blank" href="{$instagram}"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>

        <div class="subsection press">
            <h2>Press</h2>
            <p><a href="#">Download Press Pack</a></p>
            <p>Press Contact: <a href="#"><?php echo $press_email?></a></p>
            <h3>Press Releases</h3>
            <ul>
                <li>
                    <a target="_blank" href="#">AC Sabre, Not Since the Electric Guitar&#8230;</a>
                </li>
            </ul>
        </div>

        <div class="subsection blog">
            <h2>News</h2>
            <?php query_posts('cat='.$NEWS_CATEG_ID); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article>
                    <p><?php the_date()?></p>
                    <h3><?php the_title()?></h3>
                    <a class="readmore" href="<?php echo get_the_permalink?>">Continue Reading</a>
                </article>
            <?php endwhile; endif; ?>
        </div>


    </div>
</section>

<?php get_footer(); ?>