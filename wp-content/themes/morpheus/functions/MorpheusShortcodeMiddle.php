<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeMiddle extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'class' => ''
        ), $atts));

	    $output = '';
	    $output .= '<div class="coll-middle ' . $class . '">';
	    $output .= '<div class="inner">';
	    $output .=  do_shortcode($content);
	    $output .= '</div>';
	    $output .= '</div>';

        return $output;
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;
        }
    }
}

$sc = new MorpheusShortcodeMiddle();
$sc->register('coll_middle');