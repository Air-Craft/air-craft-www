<?php
/**
 Template Name: Sabre Home
 */

get_header();

global $coll_parallax_enabled;
$sl_main_id = ($coll_parallax_enabled) ? 'id="skrollr-body"' : '';
global $coll_is_mobile;
?>

<div <?php echo $sl_main_id; ?> role="main" class="wrapper common">

	<section id="home" class="page-section js-coll-window post-62 coll-page-section type-coll-page-section status-publish hentry">
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
			<div class="columns entry-title coll-hide-title" >
				<h2 class="title" style="color: #fff">Home</h2><h4 class="subtitle" style="color: #fff"></h4>
			</div>
			<div class="entry-content columns">
				<div class="coll-middle ">
					<div class="inner">
						</p>
						<p>
							<div class="columns large-6 medium-6 text-left">
						</p>
						<h1 style="color:#fff">The AC Sabre</h1>
						<p style="color:#fff">
							Movement. Music. Amazing.
						</p>
						<p>
							<a   style="border-radius : 4px; -moz-border-radius:4px; -webkit-border-radius4px;"
							class="coll-button js-coll-button "
							href="https://itunes.apple.com/gb/app/sound-wand-midi.../id587658542?mt=8"
							target="_blank"
							data-coll-color="#ffffff" data-coll-color-hover="#fff" data-coll-border="1px solid #ffffff" data-coll-border-hover="1px solid #502b42" data-coll-background-color="" data-coll-background-color-hover="#502b42">On the App Store </a>
						</p>
						<p>
							<a   style="border-radius : 4px; -moz-border-radius:4px; -webkit-border-radius4px;"
							class="coll-button js-coll-button "
							href="/ac-sabre"
							target="_self"
							data-coll-color="#ffffff" data-coll-color-hover="#fff" data-coll-border="1px solid #ffffff" data-coll-border-hover="1px solid #502b42" data-coll-background-color="" data-coll-background-color-hover="#502b42">Watch Demos</a>
						</p>
						<p>
					</div></p>
					<p>
				</div>
			</div>
		</div>
</div></section>
<section id="home-quotes" class="page-section  post-207 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #fcfbea" ></div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">Home: Quotes</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<div class="coll-layerslider coll-slideshow">
				<script data-cfasync="false" type="text/javascript">
					var lsjQuery = jQuery;
				</script>
				<script data-cfasync="false" type="text/javascript">
					lsjQuery(document).ready(function() {
						if ( typeof lsjQuery.fn.layerSlider == "undefined") {
							lsShowNotice('layerslider_2', 'jquery');
						} else {
							lsjQuery("#layerslider_2").layerSlider({
								startInViewport : false,
								keybNav : false,
								touchNav : false,
								skin : 'minimal',
								navPrevNext : false,
								hoverPrevNext : false,
								navStartStop : false,
								navButtons : false,
								showCircleTimer : false,
								thumbnailNavigation : 'disabled',
								skinsPath : 'http://ac2.localhost/wp-content/plugins/LayerSlider/static/skins/'
							})
						}
					});
				</script>
				<div id="layerslider_2" class="ls-wp-container" style="width:800px;height:150px;margin:0 auto;margin-bottom: 0px;">
					<div class="ls-slide" data-ls="slidedelay:2000;transition2d:1;">
						<h1 class="ls-l" style="top:0px;left:0px;white-space: nowrap;" data-ls="durationin:500;durationout:500;showuntil:1500;">Awesomeness, pure awesomeness... </h1>
						<p class="ls-l" style="top:38px;left:8px;white-space: nowrap;">
							- App Store Reviewer
						</p>
					</div>
					<div class="ls-slide" data-ls="slidedelay:2000; transition2d: all;">
						<h1 class="ls-l" style="top:-1px;left:3px;white-space: nowrap;">A seriously unique and sophisticated musical instrument </h1>
						<p class="ls-l" style="top:32px;left:17px;white-space: nowrap;">
							- Mr Reviewer
						</p>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var _slider = $("#layerslider_2");
						var _container = _slider.parent();

						// pause slider on scroll
						if (_container.hasClass("coll-slideshow")) {
							window.addEventListener("coll.panim.start", function() {
								_slider.layerSlider("stop");
							})
							window.addEventListener("coll.panim.end", function() {
								_slider.layerSlider("start");
							})
						}

					});
				</script>
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
<section id="video-demos" class="page-section js-coll-window-min post-227 coll-page-section type-coll-page-section status-publish hentry">
	<div class="coll-section-background js-coll-parallax"  style="background-color: #fffff4" ></div>
	<div class="section-content row ">
		<div class="columns entry-title coll-hide-title" >
			<h2 class="title" style="color: #fff">Video Demos Portfolio</h2><h4 class="subtitle" style="color: #fff"></h4>
		</div>
		<div class="entry-content columns">
			<h1 style="text-align: center;"><span style="color: #333333;">Video Demos</span></h1>
			<p style="text-align: center;">
				<span style="font-size: 16px; line-height: 1.5;">
					<div class="coll-shortcode-portfolio ">
						<div class="items js-coll-portfolio">
							<article id="easy-modal-jazz-with-the-sound-wand"
							class="post-229 coll-portfolio type-coll-portfolio status-publish hentry coll-portfolio-category-video-demos video-demos large-4 medium-6 columns"
							data-coll-hover-opacity="1">
								<div class="wrapper">
									<div class="holder"><img class="hidden"
										width="200"
										height="200"
										alt="Easy Modal Jazz with The Sound Wand"
										src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-5-avatar-e1435749540984.jpg"
										/>
										<div class="inner">
											<a class="thumb" href="http://ac2.localhost/portfolio/easy-modal-jazz-with-the-sound-wand/" ><div class="color under" style="background-color: #fff;"></div><img class="visible"
											width="200"
											height="200"
											alt="Easy Modal Jazz with The Sound Wand"
											src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-5-avatar-e1435749540984.jpg"
											/><div class="color above"></div>
											<div class="info">
												<div class="vcenter">
													<h3 class="title" style="font-size:16px" >_Easy Modal Jazz with The Sound Wand</h3>
												</div>
											</div></a>
										</div>
									</div>
								</div>
							</article>
							<article id="synthesizer-solo-with-sound-wand-pro"
							class="post-226 coll-portfolio type-coll-portfolio status-publish hentry coll-portfolio-category-video-demos video-demos large-4 medium-6 columns"
							data-coll-hover-opacity="1">
								<div class="wrapper">
									<div class="holder"><img class="hidden"
										width="1024"
										height="683"
										alt="Synthesizer Solo with Sound Wand Pro"
										src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-4.jpg"
										/>
										<div class="inner">
											<a class="thumb js-coll-port-lightbox" href="http://ac2.localhost/portfolio/synthesizer-solo-with-sound-wand-pro/" ><div class="color under" style="background-color: #fff;"></div><img class="visible"
											width="1024"
											height="683"
											alt="Synthesizer Solo with Sound Wand Pro"
											src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-4.jpg"
											/><div class="color above"></div>
											<div class="info">
												<div class="vcenter">
													<h3 class="title" style="font-size:16px" >_Synthesizer Solo with Sound Wand Pro</h3>
												</div>
											</div></a>
										</div>
									</div>
								</div>
							</article>
							<article id="the-sound-wand-from-classical-to-dubstep"
							class="post-236 coll-portfolio type-coll-portfolio status-publish hentry coll-portfolio-category-video-demos video-demos large-4 medium-6 columns"
							data-coll-hover-opacity="1">
								<div class="wrapper">
									<div class="holder"><img class="hidden"
										width="266"
										height="678"
										alt="AC Sabre &#8211; From Classical to Dubstep&#8230;"
										src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-6-e1435750490825.jpg"
										/>
										<div class="inner">
											<a class="thumb" href="http://ac2.localhost/portfolio/the-sound-wand-from-classical-to-dubstep/" ><div class="color under" style="background-color: #fff;"></div><img class="visible"
											width="266"
											height="678"
											alt="AC Sabre &#8211; From Classical to Dubstep&#8230;"
											src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-6-e1435750490825.jpg"
											/><div class="color above"></div>
											<div class="info">
												<div class="vcenter">
													<h3 class="title" style="font-size:16px" >_AC Sabre &#8211; From Classical to Dubstep&#8230;</h3>
												</div>
											</div></a>
										</div>
									</div>
								</div>
							</article>
							<article id="blues-showdown-iphone-holds-its-own-with-big-rock-guitar-full-version"
							class="post-239 coll-portfolio type-coll-portfolio status-publish hentry coll-portfolio-category-video-demos video-demos large-4 medium-6 columns"
							data-coll-hover-opacity="1">
								<div class="wrapper">
									<div class="holder"><img class="hidden"
										width="1024"
										height="683"
										alt="Blues Showdown: iPhone Holds Its Own With BIG Rock Guitar (full version)"
										src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-1.jpg"
										/>
										<div class="inner">
											<a class="thumb" href="http://ac2.localhost/portfolio/blues-showdown-iphone-holds-its-own-with-big-rock-guitar-full-version/" ><div class="color under" style="background-color: #fff;"></div><img class="visible"
											width="1024"
											height="683"
											alt="Blues Showdown: iPhone Holds Its Own With BIG Rock Guitar (full version)"
											src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-1.jpg"
											/><div class="color above"></div>
											<div class="info">
												<div class="vcenter">
													<h3 class="title" style="font-size:16px" >_Blues Showdown: iPhone Holds Its Own With BIG Rock Guitar (full version)</h3>
												</div>
											</div></a>
										</div>
									</div>
								</div>
							</article>
							<article id="classical-instruments-articulations-with-ac-sabre"
							class="post-238 coll-portfolio type-coll-portfolio status-publish hentry coll-portfolio-category-video-demos video-demos large-4 medium-6 columns"
							data-coll-hover-opacity="1">
								<div class="wrapper">
									<div class="holder"><img class="hidden"
										width="1024"
										height="683"
										alt="Classical Instruments &#038; Articulations with AC Sabre"
										src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-2.jpg"
										/>
										<div class="inner">
											<a class="thumb" href="http://ac2.localhost/portfolio/classical-instruments-articulations-with-ac-sabre/" ><div class="color under" style="background-color: #fff;"></div><img class="visible"
											width="1024"
											height="683"
											alt="Classical Instruments &#038; Articulations with AC Sabre"
											src="http://ac2.localhost/wp-content/uploads/2015/06/Hari-Karam-Gigging-2.jpg"
											/><div class="color above"></div>
											<div class="info">
												<div class="vcenter">
													<h3 class="title" style="font-size:16px" >_Classical Instruments &#038; Articulations with AC Sabre</h3>
												</div>
											</div></a>
										</div>
									</div>
								</div>
							</article>
						</div>
					</div></span>
			</p>
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

<footer class="site-footer">
	<div class="row">
		<div class="copyright">
			2015&ndash;2016 Air Craft Media Ltd. &bull; London UK
		</div>
		<div class="logo"><img src="http://ac2.localhost/wp-content/themes/air-craft/img/AC-Logo-footer.png" alt="Air Craft — Music, Movement, Amazing"/>
		</div>
	</div>
</footer>

<?php get_footer(); ?>