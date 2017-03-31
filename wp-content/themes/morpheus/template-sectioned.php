<?php
/*
Template Name: Page with sections
*/

get_header();

global $coll_parallax_enabled;
$sl_main_id = ($coll_parallax_enabled) ? 'id="skrollr-body"' : '';
global $coll_is_mobile;

?>

<div <?php echo $sl_main_id; ?> role="main" class="wrapper common">
<?php if (have_posts()) :
    while (have_posts()) :
        the_post();

        // get page section slugs
        $cmeta = get_post_meta($post->ID, 'sections_content', true);
        $cmeta = html_entity_decode($cmeta);
        $data = json_decode($cmeta, true);
        $slugs = array_map(create_function('$o', 'return $o["slug"];'), $data);

        $output = '';

        foreach ($slugs as $slug) {

            // retrieve page section
            $Qargs = array(
                'post_type' => 'coll-page-section',
                'name' => $slug,
            );

            $loop = new WP_Query($Qargs);
            while ($loop->have_posts()) : $loop->the_post();
                global $post;

                // get info
                // section
                $sclasses = array();
                $sclasses[] = 'page-section';
                $sfullh = get_post_meta(get_the_ID(), 'coll_full_height', true);
                if ($sfullh) {
                    $sclasses[] = 'coll-full-height';
                }
                $sfullw = get_post_meta(get_the_ID(), 'coll_full_width', true);
                if ($sfullw) {
                    $sclasses[] = 'coll-full-width';
                }
                $scontenth = get_post_meta(get_the_ID(), 'coll_content_height', true);
                switch ($scontenth) {
                    case 1:
                        $sclasses[] = 'js-coll-window-min';
                        break;
                    case 2:
                        $sclasses[] = '';
                        break;
                    case 3:
                        $sclasses[] = 'js-coll-window';
                        break;

                    default:
                        $sclasses[] = 'js-coll-window-min';
                }

                $showContent = (get_post_meta(get_the_ID(), 'coll_content_none', true)) ? 'coll-hide-content' : '';

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
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                                    width="' . $dim[1] . '"
                                    height="' . $dim[2] . '"
                                    data-coll-ar="' . $dim[1] / $dim[2] . '"
                                    data-coll-src="' . $bgImg . '"
                                    alt="bg image" />';
                            break;
                        case 'pattern':
                            $bgPattern = get_post_meta($bgParallax, 'coll_bg_pattern', true);
                            $bg_output .= '<div class="coll-bg-pattern" style="background: url(' . $bgPattern . ') repeat" ></div>';
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
                                // slideshow enabled
                                $son = '';
                                if (class_exists('LS_Sliders')) {
                                    $slider = LS_Sliders::find($bgSliderId);
                                    if ($slider['data']['properties']['autostart']) {
                                        $son .= 'coll-slideshow';
                                    }
                                }
                                $bg_output .= '<div class="coll-layerslider coll-bg-slider ' . $son . '">';
                                // add init event
                                add_filter('layerslider_pre_parse_defaults', 'coll_add_ls_callback');
                                $bg_output .= do_shortcode('[layerslider id="' . $bgSliderId . '"]');
                                $bg_output .= '<script type="text/javascript">
                                            jQuery(document).ready(function ($) {
                                                    var _slider = $("#layerslider_' . $bgSliderId . '");
                                                    var _container = _slider.parent();

                                                     // pause slider on scroll
                                                     if (_container.hasClass("coll-slideshow")){
                                                      window.addEventListener("coll.panim.start", function(){
                                                            _slider.layerSlider("stop");
                                                        })
                                                        window.addEventListener("coll.panim.end", function(){
                                                            _slider.layerSlider("start");
                                                        })
                                                      }

                                            });
                                            </script>';
                                $bg_output .= '</div>';
                            }
                            break;
                        case 'video':

                            $bgVideo = get_post_meta($bgParallax, 'coll_bg_video', true);
                            $bgMute = get_post_meta($bgParallax, 'coll_bg_video_mute', true);
                            $bgMuteButton = get_post_meta($bgParallax, 'coll_bg_video_button', true);
                            $bgRepImg = get_post_meta($bgParallax, 'coll_bg_video_img', true);

                            if (!$coll_is_mobile) {
                                if ($bgMute) {
                                    $bgMute = 'coll-to-mute';
                                }
                                $bgVideo = MorpheusUtils::fix_video($bgVideo);

                                $bg_output .= '<div class="coll-bg-video ' . $bgMute . '" >';

                                $bg_output .= $bgVideo;
                                $bg_output .= '</div>';
                                $bg_output .= '<div class="coll-bg-video-overlay"></div>';
                                if ($bgMuteButton) {
                                    $bg_output .= '<div class="coll-bg-video-mute">';
                                    $bg_output .= '<a href="#" class="js-coll-video-sound"><i class="fa"></i></a>';
                                    $bg_output .= '</div>';
                                }
                            } else {
                                if (!empty($bgRepImg)) {
                                    $image = wp_get_attachment_image_src(coll_get_attachment_id($bgRepImg), 'full');
                                    $bg_output .= '<img class="coll-bg-image js-coll-lazy"
					                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
					                                    width="' . $image[1] . '"
					                                    height="' . $image[2] . '"
					                                    data-coll-ar="' . $image[1] / $image[2] . '"
					                                    data-coll-src="' . $image[0] . '"
					                                    alt="bg image" />';
                                }
                            }


                            break;
                        default:

                    }
                }

                // background overlay

                if ($bgOverlay) {
                    $style = '';
                    if (!empty($bgOverlay['background-color'])) {
                        $style .= "background-color: " . $bgOverlay['background-color'] . ";\n\t";
                    }
                    if (!empty($bgOverlay['background-repeat'])) {
                        $style .= "background-repeat: " . $bgOverlay['background-repeat'] . ";\n\t";
                    }
                    if (!empty($bgOverlay['background-attachment'])) {
                        $style .= "background-attachment: " . $bgOverlay['background-attachment'] . ";\n\t";
                    }
                    if (!empty($bgOverlay['background-position'])) {
                        $style .= "background-position: " . $bgOverlay['background-position'] . ";\n\t";
                    }
                    if (!empty($bgOverlay['background-image'])) {
                        $style .= "background-image: url(" . $bgOverlay['background-image'] . ");\n";
                    }
                    if ($bgOverlayOpacity) {
                        $style .= 'opacity:' . $bgOverlayOpacity;
                    }
                    $bg_output .= '<div class="overlay" style="' . $style . '" ></div>';
                }

                $bg_output .= '</div>'; // end background


                // build  section
                $output .= '<section id="' . $post->post_name . '" class="' . implode(get_post_class($sclasses, get_the_ID()), ' ') . '">';
                $output .= $bg_output;
                $output .= '<div class="section-content row ' . $showContent . '">';
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
        }

        echo $output;

    endwhile;
else:
    // no content
endif; ?>

<?php get_footer(); ?>