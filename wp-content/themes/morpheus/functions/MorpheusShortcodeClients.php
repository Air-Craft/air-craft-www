<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeClients extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'group'        => '',
			'width'        => 3,
			'medium_width' => 6,
			'small_width' => 12,
			'target'       => '_self',
			'class'        => ''
		), $atts ) );


		// get first if none was provided
		if ( empty( $group ) ) {
			$cats = array();
			foreach ( (array) get_terms( 'coll-clients-group', array( 'hide_empty' => false ) ) as $cat ) {
				$cats[] = $cat->slug;
			}
			$group = implode( $cats, ', ' );
		} else {

		}

		$Qargs = array(
			'post_type'           => 'coll-clients',
			'coll-clients-group' => $group,
			'posts_per_page'      => - 1
		);


		// build it
		$output = '';
		$output .= '<div class="coll-shortcode-clients row collapse' . $class . '">';

		// items
		$loop = new WP_Query( $Qargs );
		while ( $loop->have_posts() ) : $loop->the_post();
			global $post;

			// get info
			$class = join( " ", get_post_class() );
			$class .= ' large-' . $width . ' medium-' . $medium_width . ' small-' . $small_width . ' columns';
			$link_url = get_post_meta( get_the_ID(), 'coll_link_url', true );
			$tmb_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			// build
			$output .= '<article id="' . $post->post_name . '" class="' . $class . '">';
			$output .= '<div class="wrapper">';
			if ( ! empty( $link_url ) ) {
				$output .= '<a  class="link" href="' . $link_url . '" target="' . $target . '">';
				$output .= '<img  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                                  class="image js-coll-lazy"
                                  width="' . $tmb_data[1] . '"
                                  height="' . $tmb_data[2] . '"
                                  data-coll-src="' . $tmb_data[0] . '"
                                  alt="' . get_the_title( $post->ID ) . '" />';
				$output .= '</a>';
			} else {
				$output .= '<img  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                                  class="image js-coll-lazy"
                                  width="' . $tmb_data[1] . '"
                                  height="' . $tmb_data[2] . '"
                                  data-coll-src="' . $tmb_data[0] . '"
                                  alt="' . get_the_title( $post->ID ) . '" />';
			}
			$output .= '</div>';
			$output .= '</article>';




		endwhile; //end items
		$output .= '</div>'; // end team ;

		wp_reset_postdata();

		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeClients();
$sc->register( 'coll_clients' );