<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeSocialIcon extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'name' => 'facebook',
            'url' => '#',
            'font_size' => '1em',
            'width' => '36px',
            'height' => '36px',
            'radius' => '50%',
            'padding' => '10px',
            'target' => '_self',
            'color' => '#000',
            'color_hover' => '#fff',
            'border_color' => '#000',
            'background_color_hover' => ot_get_option('coll_accent_color'),
            'class' => ''
        ), $atts));

        $style =    'font-size :' . $font_size . ';' .
                    'width :' . $width . ';' .
                    'height :' . $height . ';' .
                    'border-radius :' . $radius . ';';

        $output = '<div class="coll-social-icon" style="padding:' . $padding . '">';
        $output .= '<a  style="' . $style . '"
                        class="js-coll-social-icon' . $class . '"
                        href="' . $url . '"
                        target="' . $target . '"
                        data-coll-color="' . $color . '"
                        data-coll-color-hover="' . $color_hover . '"
                        data-coll-border-color="' . $border_color . '"
                        data-coll-background-color-hover="' . $background_color_hover . '"
                    >';
        $output .= '<i class="fa fa-' . $name . '"></i>';
        $output .= '</a>';
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

$sc = new MorpheusShortcodeSocialIcon();
$sc->register('coll_social_icon');