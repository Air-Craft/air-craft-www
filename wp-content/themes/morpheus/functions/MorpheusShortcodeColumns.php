<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeColumns extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'width'        => 4,
			'medium_width' => 12,
			'class'        => ''
		), $atts ) );

		return '<div class="columns large-' . $width . ' medium-' . $medium_width . ' ' . $class . '">' . do_shortcode( $content ) . '</div>';
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeColumns();
$sc->register( 'coll_columns' );