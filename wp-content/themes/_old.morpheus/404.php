<?php

get_header();

// bg
$outputImage = '';
$outputImage .= '<section class="background js-coll-page-section coll-page-section">';
$outputImage .= '<div class="js-coll-parallax coll-section-background">';

$img = ot_get_option( 'coll_404_img' );
if ( ! empty( $img ) ) {
	$image = wp_get_attachment_image_src( coll_get_attachment_id( $img ), 'full' );
	$outputImage .= '<img class="coll-bg-image js-coll-lazy"
                            width="' . $image[1] . '"
                            height="' . $image[2] . '"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            data-coll-src="' . $image[0] . '"
                            alt="404 bg image" />';
}
$outputImage .= '<div class="color-overlay"></div>';
$outputImage .= '</div>';
$outputImage .= '</section>';


// content
$content = (ot_get_option( 'coll_404_text' )) ? ot_get_option( 'coll_404_text' ) : __('You have reached the end of the Internet...', 'framework');
$content = do_shortcode( $content );
$content = '[coll_middle]'.$content.'[/coll_middle]';
$content = do_shortcode($content);
?>
<div class="wrapper common coll-single <?php if ( ! empty( $image ) ) {
	echo 'coll-parallax';
} ?>" id="skrollr-body">
<?php echo $outputImage; ?>
	<section class="title-container js-coll-page-section coll-page-section">
		<?php echo $content; ?>
	</section>

<?php get_footer(); ?>