<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeAccordion extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'bg_color' => '',
			'class'    => ''
		), $atts ) );


		// bg
		if ( ! empty( $bg_color ) ) {
			$bg_color = 'style="background-color:' . $bg_color . '" ';
		}

		preg_match_all("/data-accordion>(.*?)<\/dl><\/div>/s", do_shortcode( $content ), $output_array);

		$newcontent = implode('',$output_array[1]);

		// build
		$output = '';
		$output .= '<div class="coll-accordion ' . $class . '" ' . $bg_color . '>';
		$output .= '<dl class="accordion" data-accordion >';
		$output .= $newcontent;
		$output .= '</dl>';
		$output .= '</div>';


		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;
		}
	}
}

$sc = new MorpheusShortcodeAccordion();
$sc->register( 'coll_accordion' );