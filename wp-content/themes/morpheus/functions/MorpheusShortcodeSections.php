<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeSections extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {

        extract(shortcode_atts(array(
            'group' => ''
        ), $atts));

        $Qargs = array(
            'post_type' => 'coll-page-section',
            'tax_query' => array(
                array(
                    'taxonomy' => 'coll-page-section-group', //(string) - Taxonomy.
                    'field' => 'slug', //(string) - Select taxonomy term by ('id' or 'slug')
                    'terms' => $group, //(int/string/array) - Taxonomy term(s).
                    'operator' => 'IN' //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
                )
            ),
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => -1
        );

        global $coll_is_mobile;

        $output = '';

        $loop = new WP_Query($Qargs);
        while ($loop->have_posts()) : $loop->the_post();
            global $post;

            // get info
            // section
            $sclasses = array();
            $sclasses[] = 'page-section';
            $sfullh = get_post_meta(get_the_ID(), 'coll_full_height', true);
            if ($sfullh) $sclasses[] = 'coll-full-height';
            $sfullw = get_post_meta(get_the_ID(), 'coll_full_width', true);
            if ($sfullw) $sclasses[] = 'coll-full-width';
            $scontenth = get_post_meta(get_the_ID(), 'coll_content_high', true);
            if (!$scontenth) $sclasses[] = 'js-coll-window-min';


            // title
            $showTitle = (get_post_meta(get_the_ID(), 'coll_hide_title', true)) ? 'coll-hide-title' : '';
            $subtitle = get_post_meta(get_the_ID(), 'coll_subtitle', true);
            $titleColor = get_post_meta(get_the_ID(), 'coll_title_color', true);
            $subtitleColor = get_post_meta(get_the_ID(), 'coll_subtitle_color', true);
            $borderColor = get_post_meta(get_the_ID(), 'coll_border_color', true);
            $titleBorder = $borderColor ? 'style="border-bottom: 1px solid ' . $borderColor . '"' : '';

            // background
            $bgclasses = array();
            $bgclasses[] = 'coll-section-background';
            $bgclasses[] = 'js-coll-parallax';

            $bgColor = get_post_meta(get_the_ID(), 'coll_bg_color', true);
            $bgParallax = get_post_meta(get_the_ID(), 'coll_bg_parallax', true);
            $bgOverlay = get_post_meta(get_the_ID(), 'coll_bg_overlay', true);
            $bgOverlayOpacity = get_post_meta(get_the_ID(), 'coll_bg_overlay_opacity', true);

            // start background
            $bg_output = '';

            $bg_output .= '<div class="' . implode($bgclasses, ' ') . '"  style="background-color: ' . $bgColor . '" >';

            if (!empty($bgParallax)) {
                $bgtype = get_post_meta($bgParallax, 'coll_bg_type', true);
                switch ($bgtype) {
                    case 'image':
                        $bgImg = get_post_meta($bgParallax, 'coll_bg_img', true);
                        $dim = wp_get_attachment_image_src(coll_get_attachment_id($bgImg), 'full');
                        $bg_output .= '<img class="coll-bg-image js-coll-lazy"
                                    width="' . $dim[1] . '"
                                    height="' . $dim[2] . '"
                                    data-coll-ar="' . $dim[1] / $dim[2] . '"
                                    data-coll-src="' . $bgImg . '"
                                    alt="bg image" />';
                        break;
                    case 'pattern':
                        $bgPattern = get_post_meta($bgParallax, 'coll_bg_pattern', true);
                        $bg_output .= '<div class="coll-bg-pattern" style="background: url(' . $bgPattern . ') repeat" >';
                        break;
                    case 'slider':
                        $bgSliderType = get_post_meta($bgParallax, 'coll_bg_slider_type', true);
                        if ($bgSliderType == 'flex') {
                            $bgSliderId = get_post_meta($bgParallax, 'coll_bg_flexslider', true);
                            //$bg_output .= '<div class="coll-layerslider coll-bg-slider">';
                            $bg_output .= do_shortcode('[coll_flexslider id="' . $bgSliderId . '" class="coll-bg-slider"]');
                            // $bg_output .= '</div>';
                        }
                        if ($bgSliderType == 'layer') {
                            $bgSliderId = get_post_meta($bgParallax, 'coll_bg_layerslider', true);
                            $bg_output .= '<div class="coll-layerslider coll-bg-slider">';
                            $bg_output .= do_shortcode('[layerslider id="' . $bgSliderId . '"]');
                            $bg_output .= '</div>';
                        }
                        break;
                    case 'video':
                        $bgVideo = get_post_meta($bgParallax, 'coll_bg_video', true);
                        $bgMute = get_post_meta($bgParallax, 'coll_bg_video_mute', true);
                        if ($bgMute) {
                            $bgMute = 'coll-to-mute';
                        }
                        $bgMuteButton = get_post_meta($bgParallax, 'coll_bg_video_button', true);
                        $bgRepImg = get_post_meta($bgParallax, 'coll_bg_video_img', true);

                        $bgVideo = MorpheusUtils::fix_video($bgVideo);

                        $bg_output .= '<div class="coll-bg-video ' . $bgMute . '" >';
                        $bg_output .= $bgVideo;
                        $bg_output .= '<img class="coll-replacement" src="' . $bgRepImg . '" alt="bg image"/>';
                        $bg_output .= '</div>';
                        $bg_output .= '<div class="coll-bg-video-overlay"></div>';
                        if ($bgMuteButton) {
                            $bg_output .= '<div class="coll-bg-video-mute">';
                            $bg_output .= '<a href="#" class="js-coll-video-sound"><i class="fa"></i></a>';
                            $bg_output .= '</div>';
                        }
                        break;
                    default:

                }
            }

            // background overlay

            if ($bgOverlay) {
                $style = '';
                if (!empty($bgOverlay['background-color'])) $style .= "background-color: " . $bgOverlay['background-color'] . ";\n\t";
                if (!empty($bgOverlay['background-repeat'])) $style .= "background-repeat: " . $bgOverlay['background-repeat'] . ";\n\t";
                if (!empty($bgOverlay['background-attachment'])) $style .= "background-attachment: " . $bgOverlay['background-attachment'] . ";\n\t";
                if (!empty($bgOverlay['background-position'])) $style .= "background-position: " . $bgOverlay['background-position'] . ";\n\t";
                if (!empty($bgOverlay['background-image'])) $style .= "background-image: url(" . $bgOverlay['background-image'] . ");\n";
                if ($bgOverlayOpacity) $style .= 'opacity:' . $bgOverlayOpacity;
                $bg_output .= '<div class="overlay" style="' . $style . '" ></div>';
            }

            $bg_output .= '</div>'; // end background


            // build  section
            $output .= '<section id="' . $post->post_name . '" class="' . implode(get_post_class($sclasses, get_the_ID()), ' ') . '">';
            $output .= $bg_output;
            $output .= '<div class="section-content row">';
            $output .= '<div class="columns entry-title ' . $showTitle . '" ' . $titleBorder . '>';
            $output .= '<h2 class="title" style="color: ' . $titleColor . '">' . get_the_title() . '</h2>';
            $output .= '<h4 class="subtitle" style="color: ' . $subtitleColor . '">' . $subtitle . '</h4>';
            $output .= '</div>';
            $output .= '<div class="entry-content columns">';
            $output .= apply_filters('the_content', get_the_content());
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</section>';

        endwhile;
        wp_reset_postdata();

        return $output;
    }

    public
    function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;
        }
    }
}


$sc = new MorpheusShortcodeSections();
$sc->register('coll_section');