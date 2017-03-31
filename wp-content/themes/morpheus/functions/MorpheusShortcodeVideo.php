<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeVideo extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'lightbox' => 'no',
			'class'    => ''
		), $atts ) );

		$lightbox = ( $lightbox == 'yes' ) ? 'coll-lightbox-on' : '';
		$class .= 'coll-video-wrap js-coll-video ' . $lightbox;

		$output = '';
		$output .= '<div class="' . $class . '">';
		$output .= $content;
		$output .= '</div>';

		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeVideo();
$sc->register( 'coll_video' );