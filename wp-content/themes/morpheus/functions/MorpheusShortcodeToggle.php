<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeToggle extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'        => '',
			'active'       => 'no',
			'active_color' => ot_get_option( 'coll_accent_color' ),
			'bg_color'     => '',
			'class'        => ''
		), $atts ) );

		$active        = ( $active == 'yes' ) ? ' active' : '';
		$active_border = 'style="border-left-color:' . $active_color . '"';

        //rnd
        $rnd = rand(1,9999);

		// bg
		if ( ! empty( $bg_color ) ) {
			$bg_color = 'style="background-color:' . $bg_color . '" ';
		}


		// build
		$output = '';
		$output .= '<div class="coll-accordion ' . $class . '" ' . $bg_color . '>';
		$output .= '<dl class="accordion" data-accordion>';

		$output .= '<dd class="' . $active . '" ' . $bg_color . ' >';
		$output .= '<a  href="#toggle-' . sanitize_title( $title ) . '-'.$rnd.'"
                                class="no-border" ' . $active_border . '
                                >' . $title . '</a>';

		$output .= '<div id="toggle-' . sanitize_title( $title ) . '-'.$rnd.'" class="content ' . $active . '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= '</dd>';
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

$sc = new MorpheusShortcodeToggle();
$sc->register( 'coll_toggle' );