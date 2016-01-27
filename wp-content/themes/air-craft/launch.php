<?php
/*
Template Name: Launch
*/
?>

<?php
$obfuscated_email = antispambot(ot_get_option('ac-public-email'));
?>

<?php get_header(); ?>


<div class="fullscreen-bg">
	<video autoplay loop muted preload="auto">
	<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/mp4" />
	<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/ogg" />
	<source src="/wp-content/uploads/AC-Home-Video.mp4" type="video/webm" />
</video>
<?php //echo ot_get_option('ac-background-video-embed') ?>
</div>

<div class="notouch"></div>
<section class="launch"><div>
	<img class="logo" alt="Air Craft" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-logo-for-launch-page@2x.png">
	<h1><img alt="AC Sabre" src="<?php echo trailingslashit(get_theme_root_uri())?>air-craft/img/ac-sabre-text-for-launch-page@2x.png"></h1>
	<p class="msg">Launching End of 2015</p>
	
	
	<a class="prevent-underline-on-fa colorbox" 
	   id="video-play-btn" 
	   href="http://www.youtube.com/embed/NF3sdN4YKmM?rel=0&autoplay=1&loop=1&list=PLIGYA0fOa0PtVH05vQSB38VYVxkDHp6sS"
	   ><i class="fa fa-play-circle"></i><br><span>Demo</span></a>
	
	<div class="form">
		<form method="post" action="//air-craft.us11.list-manage.com/subscribe/post?u=c2e364dea4eef797148ed9557&amp;id=ac0d7d90d1">	
			<p>Get Notified</p>
			<p>
				<input type="email" name="EMAIL" placeholder="Your Email Address" required />
				<input type="hidden" name="ORIGIN" value="launch-page" />
				<input type="submit" value="Submit" />
			</p>
			<div style="position: absolute; left: -5000px;"><input type="text" name="b_c2e364dea4eef797148ed9557_ac0d7d90d1" tabindex="-1" value=""></div>
		</form>
	</div>	
	
	<?php //<div class="mute-btn"><a href="#" id="video-mute-btn" class="prevent-line"><i class="fa fa-volume-up"></i></a></div>?>

</div></section>

<div id="launch-footer"><span>Copyright &#169; 2015 Air Craft Media LTD, London UK</span>
	<a href="http://facebook.com/AirCraftHQ" target="_blank" class="fa fa-facebook"></a>
	<a href="http://twitter.com/AirCraftHQ" target="_blank" class="fa fa-twitter"></a>
	<a href="mailto:<?php echo $obfuscated_email ?>" class="fa fa-envelope"></a>
</div>

<?php get_footer(); ?>