<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeButtons extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'url' => '#',
            'target' => '_self',
            'background_color' => '',
            'background_color_hover' => ot_get_option('coll_accent_color'),
            'color' => '#000',
            'color_hover' => '#fff',
            'border' => '2px solid #000',
            'border_hover' => '2px solid ' . ot_get_option('coll_accent_color'),
            'radius' => '0',
            'class' => ''
        ), $atts));


        $data = '';
        $data .= ' data-coll-color="' . $color . '"';
        $data .= ' data-coll-color-hover="' . $color_hover . '"';
        $data .= ' data-coll-border="' . $border . '"';
        $data .= ' data-coll-border-hover="' . $border_hover . '"';
        $data .= ' data-coll-background-color="' . $background_color . '"';
        $data .= ' data-coll-background-color-hover="' . $background_color_hover . '"';


        $output = '<a   style="border-radius : ' . $radius . 'px; -moz-border-radius:' . $radius . 'px; -webkit-border-radius' . $radius . 'px;"
                        class="coll-button js-coll-button ' . $class . '"
                        href="' . $url . '"
                        target="' . $target . '"
                        ' . $data . '>' . do_shortcode($content) . '</a>';
        return $output;
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;

        }
    }
}

$sc = new MorpheusShortcodeButtons();
$sc->register('coll_button');