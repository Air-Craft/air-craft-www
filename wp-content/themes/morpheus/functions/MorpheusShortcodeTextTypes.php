<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeTextTypes extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type'          => '01',
			'max_font_size' => '',
			'min_font_size' => '',
			'color'         => "#000",
			'class'         => ""
		), $atts ) );


		// defaults
		$text = array(
			'01' => array(
				'max' => '90',
				'min' => '50'
			),
			'02' => array(
				'max' => '90',
				'min' => '30'
			),
			'03' => array(
				'max' => '40',
				'min' => '26'
			),
			'04' => array(
				'max' => '120',
				'min' => '80'
			),
			'05' => array(
				'max' => '40',
				'min' => '26'
			),
			'06' => array(
				'max' => '50',
				'min' => '40'
			),
			'07' => array(
				'max' => '100',
				'min' => '40'
			),
			'08' => array(
				'max' => '50',
				'min' => '26'
			),
			'09' => array(
				'max' => '50',
				'min' => '28'
			),
			'10' => array(
				'max' => '140',
				'min' => '120'
			),
			'11' => array(
				'max' => '60',
				'min' => '40'
			),
			'12' => array(
				'max' => '140',
				'min' => '70'
			),
			'13' => array(
				'max' => '40',
				'min' => '24'
			),
		);


		if ( ! empty( $max_font_size ) ) {
			$text[ $type ]['max'] = $max_font_size;
		}
		if ( ! empty( $min_font_size ) ) {
			$text[ $type ]['min'] = $min_font_size;
		}

		$output = '';

		$class .= ' coll-text type-' . $type;
		$class .= ' js-coll-texttype-resize';
		$style = ' style="color:' . $color . ';border-color:' . $color . '"';
		$data  = 'data-coll-font-size=\'{"max":' . $text[ $type ]['max'] . ',"min":' . $text[ $type ]['min'] . '}\'';


		$output .= '<div class="' . $class . '" ' . $data . $style . ' >';
		$output .= '<span class="text">' . do_shortcode( $content ) . '</span>';
		$output .= '</div>';

		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeTextTypes();
$sc->register( 'coll_text' );