<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeTabs extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'active' => 1,
            'active_color' => ot_get_option('coll_accent_color'),
            'vertical' => 'no',
            'bg_color' => '',
            'class' => ''
        ), $atts));

        // Extract the tab titles for use in the tab widget.
        preg_match_all('/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

        $tab_titles = array();
        if (isset($matches[1])) {
            $tab_titles = $matches[1];
        }

        // add active
        $string = $content;
        $needle = "[coll_tab";
        $replace = '[coll_tab active=true';

        if (substr_count($string, $needle) < $active) {
            $active = 1;
        }
        $count = 0;
        $index = 0;
        while ($count++ < $active) {
            $index = strpos($string, $needle, $index) + strlen($needle);
        }
        $content = substr($string, 0, $index - strlen($needle)) . $replace . substr($string, $index);

	    // active border
	    $active_border = '';
	    if ($vertical != "yes"){
		    $active_border  .='style="border-top-color:' . $active_color . '"';
	    }
	    else {
		    $active_border  .='style="border-left-color:' . $active_color . '"';
	    }

        // add vertical
        $vertical = ($vertical == "yes") ? ' vertical' : ' horizontal';

        // bg
        if (!empty($bg_color)) $bg_color = 'style="background-color:' . $bg_color . '" ';


        // build
        $output = '';
        if (count($tab_titles)) {
            $index = 1;
            $active_class = '';

            $output .= '<div class="coll-tabs ' . $class . $vertical . '" ' . $bg_color . '>';
            $output .= '<dl class="tabs ' . $vertical . '" data-tab >';


            foreach ($tab_titles as $tab) {
                if ($index == $active) {
                    $active_class = 'active';
                }
                $output .= '<dd class="' . $active_class . '">';
                $output .= '<a  href="#tab-' . sanitize_title($tab[0]) . '"
                                class="no-border"
                                >';
                $output .= '<span class="orig">' . $tab[0] . '</span>';
                $output .= '<span class="hover" ' . $active_border . ' >' . $tab[0] . '</span>';
                $output .= '</a>';
                $active_class = '';
                $index++;
            }
            $output .= '</dl>';
            $output .= '<div class="tabs-content ' . $vertical . '">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            $output .= '</div>';


        }

        return $output;
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;

        }
    }
}

$sc = new MorpheusShortcodeTabs();
$sc->register('coll_tabs');