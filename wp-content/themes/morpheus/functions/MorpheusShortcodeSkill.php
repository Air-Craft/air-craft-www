<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeSkill extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => 'Skill',
            'title_color' => '#000',
            'number' => '35',
            'number_color' => '#aaa',
            'width' => '150',
            'height' => '150',
            'thickness' => '0.05',
            'full_color' => '#aaa',
            'percent_color' => ot_get_option('coll_accent_color'),
            'class' => ''
        ), $atts));


        $output = '';


        $output .= '<div class="coll-skill">';
        $output .= '<input  class="knob"
                            data-readOnly=true
                            data-width="' . $width . '"
                            data-height="' . $height . '"
                            data-thickness="' . $thickness . '"
                            data-bgColor="' . $full_color . '"
                            data-fgColor="' . $percent_color . '"
                            data-inputColor="' . $number_color . '"
                            value="' . $number . '" >';
        $output .= '<h4 class="text" style="color : '. $title_color.'" >' . $title . '</h4>';
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

$sc = new MorpheusShortcodeSkill();
$sc->register('coll_skill');