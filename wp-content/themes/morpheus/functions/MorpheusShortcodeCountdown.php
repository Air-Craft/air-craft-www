<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeCountdown extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'id'    => rand( 1, 9999 ),
			'y'     => 2014,
			'm'     => 7,
			'd'     => 1,
			'h'     => 0,
			'min'   => 0,
			'color' => '#fff',
			'class' => ''
		), $atts ) );

		$output = '';
		$output .= '<div id="coll-countdown-' . $id . '"class="coll-countdown countdownHolder" style="color:' . $color . ';">';
		$output .= '<script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $(window).load(function() {
                        var _count= $("#coll-countdown-' . $id . '"),
                            _time =  new Date(' . $y . ',' . $m . ',' . $d . ',' . $h . ',' . $min . ');
                            if((new Date()) > _time){
						        _time = (new Date()).getTime() + 10*24*60*60*1000;
						    }
                        _count.countdown({timestamp	: _time });
                    });
                });
                </script>';

		$output .= '<span class="countDays cont">';
		$output .= '<label class="text">' . __( 'Days', 'framework' ) . '</label>';
		$output .= '<span class="position"><span class="digit static"></span></span><span class="position"><span class="digit static"></span></span>';
		$output .= '</span>';
		$output .= '<span class="countHours cont">';
		$output .= '<label class="text">' . __( 'Hours', 'framework' ) . '</label>';
		$output .= '<span class="position"><span class="digit static"></span></span><span class="position"><span class="digit static"></span></span>';
		$output .= '</span>';
		$output .= '<span class="countMinutes cont">';
		$output .= '<label class="text">' . __( 'Minutes', 'framework' ) . '</label>';
		$output .= '<span class="position"><span class="digit static"></span></span><span class="position"><span class="digit static"></span></span>';
		$output .= '</span>';
		$output .= '<span class="countSeconds cont">';
		$output .= '<label class="text">' . __( 'Seconds', 'framework' ) . '</label>';
		$output .= '<span class="position"><span class="digit static"></span></span><span class="position"><span class="digit static"></span></span>';
		$output .= '</span>';


		$output .= '</div>';


		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeCountdown();
$sc->register( 'coll_countdown' );