<?php get_header(); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		// thumbnail
		if ( has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		} else {
			$thumb = get_post_meta( $post->ID, 'thumb', true );
			$thumb = wp_get_attachment_image_src( $thumb, 'full' );
		}

		$overlay = get_post_meta( $post->ID, 'coll_thumb_overlay_opacity', true );
		$overlay = ( $overlay ) ? ' style="opacity:' . $overlay . '" ' : '';

		$outputT = '<section class="background js-coll-page-section coll-page-section">';
		$outputT .= '<div class="js-coll-parallax coll-section-background">';
		$outputT .= '<img class="coll-bg-image js-coll-lazy"
                            width="' . $thumb[1] . '"
                            height="' . $thumb[2] . '"
                            data-coll-src="' . $thumb[0] . '"
                            alt="' . get_the_title( $post->ID ) . '"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            />';
		$outputT .= '<div class="color-overlay" ' . $overlay . '></div>';
		$outputT .= '</div>';
		$outputT .= '';
		$outputT .= '';
		$outputT .= '</section>';

		// assets
		$cmeta = get_post_meta( $post->ID, 'assets_content', true );
		$cmeta = html_entity_decode( $cmeta );
		$data  = json_decode( $cmeta, true );

		$outputA = '';
		foreach ( $data as $item ) {

			switch ( $item['type'] ):
				case 'image':
					$outputA .= '<div class="item">';
					$img      = wp_get_attachment_image_src( $item['id'], 'full' );
					$img_meta = coll_get_attachment( $item['id'] );
					if ( ! empty( $img_meta['caption'] ) ) {
						$outputA .= '<div class="caption"><p class="text">' . $img_meta['caption'] . '</p></div>';
					}
					$outputA .= '<img class="img js-coll-lazy"
                                    width="' . $img[1] . '"
                                    height="' . $img[2] . '"
                                    data-coll-src="' . $img[0] . '"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                                    />';
					$outputA .= '</div>';
					break;
				case 'video':
					$outputA .= '<div class="item js-fit-video js-coll-video coll-lightbox-on">';
					$outputA .= $item[ ecode ];
					$outputA .= '</div>';
					break;
			endswitch;

		}

		// client  role  proj url
		$client  = get_post_meta( $post->ID, 'coll_client', true );
		$role    = get_post_meta( $post->ID, 'coll_role', true );
		$link    = get_post_meta( $post->ID, 'coll_proj_url', true );
		$outputD = '';
		if ( ! empty( $client ) || ! empty( $role ) ) {
			$outputD .= '<ul class="list">';
			if ( ! empty( $client ) ) {
				$outputD .= '<li class="client">';
				$outputD .= '<h5 class="title">' . __( 'Client:', 'framework' ) . '</h5>';
				$outputD .= '<p class="text">' . $client . '</p>';
				$outputD .= '</li>';
			}
			if ( ! empty( $role ) ) {
				$outputD .= '<li class="role">';
				$outputD .= '<h5 class="title">' . __( 'Our Role:', 'framework' ) . '</h5>';
				$outputD .= '<p class="text">' . $role . '</p>';
				$outputD .= '</li>';
			}
			$outputD .= '</ul>';
		}
		if ( ! empty( $link ) ) {
			$outputD .= ' <a class="coll-button coll-accent-color proj" href="' . $link . '" target="_blank">' . __( 'view online', 'framework' ) . '</a>';
		}

		?>
		<div class="wrapper common coll-single coll-parallax" id="skrollr-body">
		<?php echo $outputT; ?>
		<section class="title-container js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="coll-section-divider title-divider">
						<span class="text large-2 medium-2"><?php _e( 'project name', 'framework' ); ?></span>
						<span class="line large-10 medium-10"><span class="color"></span></span>
					</div>

					<div class="title-wrapper">
						<h1 class="title-text"><?php the_title(); ?></h1>

						<h3 class="subtitle-text"><?php the_excerpt(); ?></h3>
						<ul class="icons">
							<li><a class="link"
							       target="_blank"
							       href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=Currently reading <?php the_title(); ?>">
									<i class="fa fa-twitter"></i> </a></li>
							<li><a class="link"
							       target="_blank"
							       href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>">
									<i class="fa fa-facebook"></i></a></li>
							<li><a class="link"
							       target="_blank"
							       href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php the_permalink(); ?>">
									<i class="fa fa-google-plus"></i></a></li>
							<li><a class="link"
							       target="_blank"
							       href="javascript:void((function(){var e=document.createElement('script'); e.setAttribute('type','text/javascript'); e.setAttribute('charset','UTF-8'); e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());">
									<i class="fa fa-pinterest"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="coll-section-divider content-divider">
						<span class="text large-2 medium-2"><?php _e( 'description', 'framework' ); ?></span>
						<span class="line large-10 medium-10"><span class="color"></span></span>
					</div>
					<div class="copy-container large-10 large-offset-2 medium-10 medium-offset-2">
						<div class="content-wrapper">
							<div class="info coll-clear">
								<?php echo $outputD; ?>
							</div>
							<article class="entry-content">
								<?php the_content(); ?>
							</article>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="asset-container js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="large-10 large-offset-2 medium-10 medium-offset-2">
						<div class="asset-wrapper">
							<?php echo $outputA; ?>
						</div>
					</div>
				</div>
			</div>

		</section>
		<section class="navigation-container js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="coll-section-divider">
						<span class="text large-2 medium-2"><?php _e( 'More Projects', 'framework' ); ?></span>
						<span class="line large-10 medium-10"><span class="color"></span></span>
					</div>
					<div class="large-10 large-offset-2 medium-10 medium-offset-2">
						<div class="row">
							<div class="previous large-6 medium-6 columns">
								<?php if ( get_next_post() ) : $pID = get_next_post()->ID; ?>
									<a class="arrow" href="<?php echo get_permalink( $pID ); ?>">
										<div class="icon"><i class="fa fa-long-arrow-left"></i></div>
										<div class="info">
											<label><?php _e( 'Previous', 'framework' ); ?></label>

											<h3 class="title-text"><?php echo get_the_title( $pID ); ?></h3>
										</div>

									</a>
								<?php endif; ?>
							</div>
							<div class="next large-6 medium-6  columns">
								<?php if ( get_previous_post() ) : $pID = get_previous_post()->ID; ?>

									<a class="arrow" href="<?php echo get_permalink( $pID ); ?>">
										<div class="icon"><i class="fa fa-long-arrow-right"></i></div>
										<div class="info">
											<label><?php _e( 'Next', 'framework' ); ?></label>

											<h3 class="title-text"><?php echo get_the_title( $pID ); ?></h3>
										</div>


									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php
	endwhile;
endif; ?>
<?php get_footer(); ?>