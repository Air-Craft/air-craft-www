<?php
/*
Template Name: Blog Archive
*/

get_header();

$content_columns = ot_get_option( 'coll_page_sidebar' ) ? '9' : '12';

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		// thumbnail
		$outputT = '';
		if ( has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			$outputT .= '<section class="background js-coll-page-section coll-page-section">';
			$outputT .= '<div class="js-coll-parallax coll-section-background">';
			$outputT .= '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            class="coll-bg-image js-coll-lazy"
                            width="' . $thumb[1] . '"
                            height="' . $thumb[2] . '"
                            data-coll-src="' . $thumb[0] . '"
                            alt="' . get_the_title( $post->ID ) . '" />';
			$outputT .= '<div class="color-overlay"></div>';
			$outputT .= '</div>';
			$outputT .= '</section>';
		}

		?>
		<div class="wrapper common coll-single <?php if ( has_post_thumbnail() ) {
		echo 'coll-parallax';
} ?>" id="skrollr-body">
		<?php echo $outputT; ?>
		<section class="title-container js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="title-wrapper">
						<h1 class="title-text"><?php echo get_the_title( get_the_ID() ); ?></h1>

						<h3 class="subtitle-text">
							<?php echo coll_get_excerpt_by_id( get_the_ID(), ot_get_option( 'coll_excerpt_length' ), '<a><em><strong>', '' ); ?>
						</h3>
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
						</div>
					</div>
					<div class="archives-container">
						<div class="columns large-4 ">
							<h3><?php _e('Last 30 Posts', 'framework') ?></h3>

							<ul>
								<?php $archive_30 = get_posts('numberposts=30');
								foreach ($archive_30 as $post) : ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="columns large-4 ">
							<h3><?php _e('Archives by Month', 'framework') ?></h3>
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
						</div>
						<div class="columns large-4 ">
							<h3><?php _e('Archives by Category', 'framework') ?></h3>
							<ul>
								<?php wp_list_categories('hierarchical=0&title_li='); ?>
							</ul>
						</div>
					</div>
				</div>

				<!--                end left-->
				<?php if ( ot_get_option( 'coll_page_sidebar' ) ) : ?>
					<div class="large-3 columns">
						<div class="sidebar-container">
							<?php if ( ! dynamic_sidebar() )
								dynamic_sidebar( 'coll-page-sidebar' ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</section>





	<?php
	endwhile;
endif; ?>
<?php get_footer(); ?>