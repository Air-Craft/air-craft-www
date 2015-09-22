<?php
/*
Template Name: Launch
*/
?>


<?php get_header(); ?>


<div class="fullscreen-bg">
<?php echo ot_get_option('ac-background-video-embed') ?>
</div>

<div class="notouch"></div>
<section class="launch"><div>
	<img class="logo" alt="Air Craft" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-logo-for-launch-page@2x.png">
	<h1><img alt="AC Sabre" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-sabre-text-for-launch-page@2x.png"></h1>
	<p class="msg">Launching End of 2015</p>
	<p class="no-autoplay" style="display:none"><a class="nothingxxz" id="video-play-btn" href="<?php echo ot_get_option('ac-mobile-video-link') ?>"><i class="fa fa-play-circle"></i></a><br><span>Watch Demo</span></p>
	

	<div class="form">
		<form method="post" action="//air-craft.us11.list-manage.com/subscribe/post?u=c2e364dea4eef797148ed9557&amp;id=ac0d7d90d1">	
			<p>Get Notified<p>
			<input type="email" name="EMAIL" placeholder="Your Email Address" required />
			<input type="hidden" name="ORIGIN" value="launch-page" />
			<input type="submit" value="Submit" />
			</p>
			<div style="position: absolute; left: -5000px;"><input type="text" name="b_c2e364dea4eef797148ed9557_ac0d7d90d1" tabindex="-1" value=""></div>
		</form>
	</div>	
</div></section>

<div class="mute-btn"><a href="#" id="video-mute-btn" class="fa fa-volume-up"><i class="fa"></i></a></div>

<div id="ytdum"></div>

<?php get_footer(); ?>