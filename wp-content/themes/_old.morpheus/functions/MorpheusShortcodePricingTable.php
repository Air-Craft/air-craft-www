<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodePricingTable extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {

        extract(shortcode_atts(array(
            'table' => '',
            'width' => 3,
            'medium_width' => 6,
            'title_color' => '#000',
            'text_color' => '#bbb',
            'link_hover_color' => '#fff',
            'link_hover_color_background' => ot_get_option('coll_accent_color'),
            'bg_color' => '',
            'class' => ''
        ), $atts));

        // bg
        if ( ! empty( $bg_color ) ) {
            $bg_color = 'style="background-color:' . $bg_color . '" ';
        }

        // get first if none was provided
        if (empty($table)) {
            $cats = array();
            foreach ((array)get_terms('coll-pricing-table', array('hide_empty' => false)) as $cat) $cats[] = $cat->slug;
            $table = implode($cats, ', ');
        } else {

        }


        $Qargs = array(
            'post_type' => 'coll-pricing',
            'coll-pricing-table' => $table,
            'posts_per_page' => -1
        );


        // build it
        $output = '';
        $output .= '<div class="coll-shortcode-pricing-table row ' . $class . '">';

        // items
        $loop = new WP_Query($Qargs);
        while ($loop->have_posts()) : $loop->the_post();
            global $post;

            // get info
            $class = join(" ", get_post_class());
            $class .= ' large-' . $width . ' medium-' . $medium_width . ' columns';
            $link_url = get_post_meta(get_the_ID(), 'coll_link_url', true);
            $link_text = get_post_meta(get_the_ID(), 'coll_link_text', true);
            $price = get_post_meta(get_the_ID(), 'coll_price', true);
            $standout = get_post_meta(get_the_ID(), 'coll_standout', true);
            $standout = $standout ? 'standout' : '';


            // build
            $output .= '<article id="' . $post->post_name . '" class="' . $class . '" style="color : ' . $text_color . '">';
            $output .= '<div class="wrapper ' . $standout . '" '. $bg_color .'>';
            $output .= '<div class="js-coll-inner">';
            $output .= '<div class="title">';
            $output .= '<h3 class="text" style="color : ' . $title_color . '">' . get_the_title() . '</h3>';
            $output .= '</div>';
            $output .= '<div class="price">';
            $output .= '<p class="text">' . $price . '</p>';
            $output .= '</div>';
            $output .= '<div class="content">' . MorpheusUtils::get_the_content(get_the_ID());
            if (!empty($link_url)) {
                $output .= '<div class="link">';
                $output .= '<a  class="coll-button js-coll-pt-purchase"
                                href="' . $link_url . '"
                                data-coll-color-hover="' . $link_hover_color . '"
                                data-coll-background-color-hover="' . $link_hover_color_background . '"
                                >' . $link_text . '</a>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</article>';




        endwhile; //end items
        $output .= '</div>'; // end team ;

        wp_reset_postdata();

        return $output;
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;

        }
    }
}

$sc = new MorpheusShortcodePricingTable();
$sc->register('coll_pricing_table');