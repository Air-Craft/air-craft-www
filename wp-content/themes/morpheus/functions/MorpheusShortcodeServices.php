<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeServices extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {

        extract(shortcode_atts(array(
            'group' => '',
            'width' => 3,
            'medium_width' => 6,
            'image_type' => '',
            'name_color' => '#000',
            'class' => ''
        ), $atts));

        // get first if none was provided
        if (empty($group)) {
            $cats = array();
            foreach ((array)get_terms('coll-service-group', array('hide_empty' => false)) as $cat) $cats[] = $cat->slug;
	        $group = implode($cats, ', ');
        } else {

        }
        $Qargs = array(
            'post_type' => 'coll-service',
            'coll-service-group' => $group,
            'posts_per_page' => -1
        );


        // build it
        $output = '';
        $output .= '<div class="coll-shortcode-services row ' . $class . '">';

        // items
        $loop = new WP_Query($Qargs);
        while ($loop->have_posts()) : $loop->the_post();
            global $post;

            // get info
            //$columns = 12 / $columns;
            $class = join(" ", get_post_class());
            $class .= ' large-' . $width . ' medium-' . $medium_width . ' columns';

            $tmb_html = '';
            if (has_post_thumbnail($post->ID)) {
                $data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');

                if ($image_type == 'round') {
                    $tmb_html .= '<div  class="coll-image-wrapper round">';
                } else {
                    $tmb_html .= '<div class="coll-image-wrapper">';
                }



                $tmb_html .= '<img  class="image"
                                    src="' . $data[0] . '"
                                    alt="' . get_the_title($post->ID) . '" />';
                $tmb_html .= '</div>';
            }


            // build
            $output .= '<article id="' . $post->post_name . '" class="' . $class . '" >';
	        $output .= '<div class="js-coll-inner">';
            $output .= $tmb_html;
            $output .= '<div class="title">';
            $output .= '<h4 class="text" style="color : '. $name_color.'">' . get_the_title() . '</h4>';
            $output .= '</div>';
            $output .= '<div class="content">' . MorpheusUtils::get_the_content(get_the_ID()) . '</div>';
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

$sc = new MorpheusShortcodeServices();
$sc->register('coll_services');