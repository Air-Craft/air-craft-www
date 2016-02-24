<?php
/**
 Template Name: Sabre Home
 */

get_header();

global $coll_parallax_enabled;
$sl_main_id = ($coll_parallax_enabled) ? 'id="skrollr-body"' : '';
global $coll_is_mobile;

$demo_video = ot_get_option('ac-demo-video-link');

$mailchimp_url = ot_get_option('ac-mailchimp-form-url');
$mailchimp_key = ot_get_option('ac-mailchimp-form-key');

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
<section id="home-description" class="page-section  coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"></div>
	<div class="section-content row ">
		<div class="entry-content columns">
			<div class="coll-layerslider coll-slideshow">
				<div class="quote">
					<h3>It’s great for controlling fat, nasty bass patches...</h3>
					<p>&ndash; App Store Reviewer</p>
				</div>
				<div class="description">
					<h2>Your MIDI Controller are Boring</h2>
					<p>The controllers we use for haven’t changed in 30 years. 
						Buttons, knobs, and faders &ndash; handy for tweaking but linear and lifeless 
						for performance and riff-making. AC Sabre is a MIDI controller revolution. 
						Experience a whole new dimension to your sound library that will have you giddy 
						like the first time all over again.</p>
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
<section id="ac-sabre-highlights-1" class="page-section  post-165 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #0a0808" ><img class="coll-bg-image js-coll-lazy"
		src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
		width=""
		height=""
		data-coll-ar=""
		data-coll-src="http://air-craft.co/wp-content/uploads/2015/06/ac-sabre-on-device-3-e1435675942634.png"
		alt="bg image" />
	</div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">AC Sabre Highlights 1</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="columns large-6 medium-6 text-left">
				</p>
				<h1><span style="color: #ffffff;">Intuitive, with Precision</span></h1>
				<p>
					<span style="color: #ffffff;">Intuitive control of multiple parameters simultaneously with your movements. No interpretative &#8216;magic&#8217;. What you intend is what you get.</span>
				</p>
				<p>
			</div>
		</div>
	</div>
</section>
<section id="ac-sabre-highlights-2" class="page-section  post-170 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #0a0000" ><img class="coll-bg-image js-coll-lazy"
		src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
		width="550"
		height="472"
		data-coll-ar="1.16525423729"
		data-coll-src="http://air-craft.co/wp-content/uploads/2015/06/ac-sabre-on-device-1.png"
		alt="bg image" />
	</div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">AC Sabre Highlights 2</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="columns large-6 medium-6 text-left"></div>
			<div class="columns large-6 medium-6 text-right">
				</p>
				<h1 style="color: #fff;">Music, Mastered</h1>
				<p style="color: #fff;">
					Arpeggios, harmonies, trills, modal key changes, 200+ scales, portamento &amp; legato, scale-locked note bending, ribbons…A maestro&#8217;s palette at your command.
				</p>
				<p>
			</div>
		</div>
	</div>
</section>
<section id="ac-sabre-highlights-3" class="page-section  post-172 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #0da59b" ><img class="coll-bg-image js-coll-lazy"
		src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
		width=""
		height=""
		data-coll-ar=""
		data-coll-src="http://air-craft.co/wp-content/uploads/2015/06/ac-sabre-on-device-3-e1435675942634.png"
		alt="bg image" />
	</div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">AC Sabre Highlights 3</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="columns large-6 medium-6 text-left">
				</p>
				<h1 style="color:#fff">Power Interface</h1>
				<p  style="color:#fff">
					The elegant  multi-touch interface is intuitive at first touch with depth on-demand. Finely tuned touch controls go way beyond mere buttons…
				</p>
				<p>
			</div>
		</div>
	</div>
</section>
<section id="ac-sabre-highlights-4" class="page-section  post-174 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #cea473" ><img class="coll-bg-image js-coll-lazy"
		src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
		width="550"
		height="472"
		data-coll-ar="1.16525423729"
		data-coll-src="http://air-craft.co/wp-content/uploads/2015/06/ac-sabre-on-device-1.png"
		alt="bg image" />
	</div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">AC Sabre Highlights 4</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="columns large-6 medium-6 text-left"></div>
			<div class="columns large-6 medium-6 text-right">
				</p>
				<h1 style="color:#fff">And a little extra&#8230;</h1>
				<p  style="color:#fff">
					Get your bagpipe on with the Drone or blow your mind with &#8220;Tap&#8221; Mode
				</p>
				<p>
					<a   style="border-radius : 0px; -moz-border-radius:0px; -webkit-border-radius0px;"
					class="coll-button js-coll-button "
					href="#"
					target="_self"
					data-coll-color="#000" data-coll-color-hover="#fff" data-coll-border="2px solid #000" data-coll-border-hover="2px solid #502b42" data-coll-background-color="" data-coll-background-color-hover="#502b42">Watch Demo »</a>
				</p>
				<p>
			</div>
		</div>
	</div>
</section>
<section id="home-press-blog" class="page-section  post-205 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #f7efde" ></div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">Home: Press &#038; Blog</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="columns large-6 medium-12 ">
				</p>
				<h2 id="Press">Press</h2>
				<ul>
					<li>
						<a href="#">Download Press Pack</a>
					</li>
					<li>
						Press Releases
						<ul>
							<li>
								AC Sabre, Not Since the Electric Guitar&#8230;
							</li>
							<li>
								AC Electric Guitar: Un-silence Your Air Guitar
							</li>
							<li>
								Sound Wand teaches Children to Create Music
							</li>
						</ul>
					</li>
				</ul>
				<h2>Contact</h2>
				<p>
					Hari Karam Singh, Director
					<br />
					P: 0779 055 6418
					<br />
					E: <a href="mailto:singh@ac.localhost">singh@ac.localhost
					<br />
					</a>S: harikaram
					<br />
					T: @air1craft
				</p>
				<p>
			</div>
			<div class="columns large-6 medium-12 ">
				</p>
				<h2>Blog</h2>
				<p>
					<div class="coll-shortcode-blog row">
						<article id='doing-some-cool-trick-in-ableton-thats-very-useful-to-people-and-whatnot' class='post-750 post type-post status-publish format-standard hentry category-tech large-6 medium-6 columns'>
							<div class="js-coll-inner">
								<div class="coll-section-divider ">
									<span class="text" style="color:#000">12 Feb 2016</span><span class="line"><span class="color" style="background-color:#000"></span></span>
								</div><h3 class="title"><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color "
								style="color:#000"
								href="http://ac2.localhost/tech/doing-some-cool-trick-in-ableton-thats-very-useful-to-people-and-whatnot/"
								target="_self">Doing some cool trick in Ableton that&#8217;s very useful to people and whatnot&#8230;</a></h3><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color"
								style="color:#000"
								href="http://ac2.localhost/tech/doing-some-cool-trick-in-ableton-thats-very-useful-to-people-and-whatnot/#comments"
								target="_self"><i class="fa fa-comment-o"></i><span class="comments">0 Comments</span></a>
							</div>
						</article>
						<article id='post-with-image' class='post-209 post type-post status-publish format-standard hentry category-music tag-ableton tag-midi large-6 medium-6 columns'>
							<div class="js-coll-inner">
								<div class="coll-section-divider ">
									<span class="text" style="color:#000">30 Jun 2015</span><span class="line"><span class="color" style="background-color:#000"></span></span>
								</div><h3 class="title"><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color "
								style="color:#000"
								href="http://ac2.localhost/music/post-with-image/"
								target="_self">Duplicating MIDI CC &#038; Envelopes via Arrangement View in Ableton</a></h3><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color"
								style="color:#000"
								href="http://ac2.localhost/music/post-with-image/#comments"
								target="_self"><i class="fa fa-comment-o"></i><span class="comments">0 Comments</span></a>
							</div>
						</article>
						<article id='hello-world-2' class='post-111 post type-post status-publish format-standard hentry category-news large-6 medium-6 columns'>
							<div class="js-coll-inner">
								<div class="coll-section-divider ">
									<span class="text" style="color:#000">16 May 2014</span><span class="line"><span class="color" style="background-color:#000"></span></span>
								</div><h3 class="title"><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color "
								style="color:#000"
								href="http://ac2.localhost/news/hello-world-2/"
								target="_self">Hello world!</a></h3><a data-coll-color="#000"
								data-coll-color-hover="#333"
								class="link-color"
								style="color:#000"
								href="http://ac2.localhost/news/hello-world-2/#comments"
								target="_self"><i class="fa fa-comment-o"></i><span class="comments">1 Comments</span></a>
							</div>
						</article>
					</div>
				</p>
				<p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>