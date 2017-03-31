<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeBlog extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {

        extract(shortcode_atts(array(
            'categories' => '',
            'width' => 4,
            'medium_width' => 6,
            'number' => get_option('posts_per_page'),
            'lightbox' => 'no',
            'thumb' => 'no',
            'color' => '#000',
            'color_hover' => '#333',
            'target' => '_self',
            'class' => ''
        ), $atts));


        // get all categories if none was provided
        if (empty($categories)) {
            $cats = array();
            foreach ((array)get_terms('category', array('hide_empty' => false)) as $cat) $cats[] = $cat->slug;
            $categories = implode($cats, ', ');
        } else {

        }

        //setup the query args
        $Qargs = array(
            'post_type' => 'post',
            'cat' => $categories,
            'posts_per_page' => $number
        );

        // check if lightbox is enabled.
        $lightbox = ( $lightbox == 'yes' ) ? ' js-coll-blog-lightbox' : '';
        // start building
        $output = '';
        $output .= '<div class="coll-shortcode-blog row' . $class . '">';

        // items
        $loop = new WP_Query($Qargs);
        while ($loop->have_posts()) : $loop->the_post();
            global $post;

            // get info
            $class = join(" ", get_post_class());
            $class .= ' large-' . $width . ' medium-' . $medium_width . ' columns';

            $title = get_the_title(get_the_ID());
            $url = get_permalink(get_the_ID());


            // get featured image if required and exists
            $tmb_html = '';
            if ($thumb == 'yes' && has_post_thumbnail($post->ID) && function_exists('get_post_thumbnail_id')) {
                $data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $tmb_html .= '<div class="coll-img">';
                $tmb_html .= '<a class="' . $lightbox . '" href="' . $url . '" target="' . $target . '" >';
                $tmb_html .= '<img class=""
                                    width="' . $data[1] . '"
                                    height="' . $data[2] . '"
                                    data-coll-src="' . $data[0] . '"
                                    src="' . $data[0] . '"
                                    alt="' . get_the_title($post->ID) . '" />';
                $tmb_html .= '</a>';
                $tmb_html .= '</div>';
            }




            // build
            $output .= "<article id='" . $post->post_name . "' class='" . $class . "'>";
            $output .= '<div class="js-coll-inner">';
            $output .= '<div class="coll-section-divider ">';
            $output .= '<span class="text" style="color:' . $color . '">' . get_the_date('d M Y') . '</span>';
            $output .= '<span class="line"><span class="color" style="background-color:' . $color . '"></span></span>';
            $output .= '</div>';
            $output .= $tmb_html;
            $output .= '<h3 class="title">';
            $output .= '<a data-coll-color="' . $color . '"
                           data-coll-color-hover="' . $color_hover . '"
                           class="link-color ' . $lightbox . '"
                           style="color:' . $color . '"
                           href="' . $url . '"
                           target="' . $target . '">' . $title . '</a>';
            $output .= '</h3>';
            $output .= '<a data-coll-color="' . $color . '"
                           data-coll-color-hover="' . $color_hover . '"
                           class="link-color"
                           style="color:' . $color . '"
                           href="' . $url . '#comments"
                           target="' . $target . '">';
            $output .= '<i class="fa fa-comment-o"></i>';
            $output .= '<span class="comments">';
            $output .= get_comments_number($post->ID) . ' ' . __('Comments', 'framework');
            $output .= '</span>';
            $output .= '</a>';
            $output .= '</div>';
            $output .= '</article>';


        endwhile; //end items
        $output .= '</div>'; // end blog ;

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

$sc = new MorpheusShortcodeBlog();
$sc->register('coll_blog');