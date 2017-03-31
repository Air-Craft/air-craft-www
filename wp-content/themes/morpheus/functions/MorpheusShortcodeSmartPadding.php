<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeSmartPadding extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts,$content=null)
    {
        extract(shortcode_atts(array(
            'min' => '0',
            'max' => '20'
        ), $atts));

        $data = 'data-coll-padding=\'{"max":' . $max . ',"min":' . $min . '}\'';
        return '<div class="js-coll-smart-padding" ' . $data . '></div>';
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;

        }
    }
}

$sc = new MorpheusShortcodeSmartPadding();
$sc->register('coll_smart_padding');