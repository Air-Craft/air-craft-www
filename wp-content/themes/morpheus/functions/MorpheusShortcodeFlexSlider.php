<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodeFlexSlider extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'id'    => '',
			'class' => ''
		), $atts ) );

		// get slider id
		if ( empty( $id ) ) {
			$args  = array( 'post_type' => 'coll-flexslider', 'posts_per_page' => 1 );
			$posts = get_posts( $args );
			$id    = $posts[0]->ID;
		}
		// meta
		$background     = get_post_meta( $id, 'coll_background', true );
		$styleBg        = $background ? 'style="background : ' . $background . ' ;"' : '';
		$classBg        = $background ? '' : ' coll-no-bg';
		$color          = get_post_meta( $id, 'coll_color', true );
		$slideshow      = get_post_meta( $id, 'coll_slideshow', true );
		$slideshow      = ( ! empty( $slideshow ) ) ? $slideshow : 'true';
		$arrows         = get_post_meta( $id, 'coll_arrows', true );
		$classArrows    = ' coll-arrows-' . $arrows;
		$arrowsPos      = get_post_meta( $id, 'coll_arrows_position', true );
		$classArrowsPos = ' coll-arrows-' . $arrowsPos;
		$bullets        = get_post_meta( $id, 'coll_bullets', true );
		$classBullets   = ' coll-bullets-' . $bullets;
		$captions       = get_post_meta( $id, 'coll_captions', true );
		$classCaptions  = ' coll-captions-' . $captions;


		$uid = rand(1,9999);

		$output = '';

		// start slider
		$output .= '<div    id="slider-' . $uid . '"
                            class="coll-flexslider flexslider ' . $class . $classBg . $classArrows . $classArrowsPos . $classBullets . $classCaptions . '"
                            ' . $styleBg . '
                            >';
		// js
		$output .= '<script type="text/javascript">
                jQuery(document).ready(function ($) {

                    function initSlider(){
                     var _slider = $("#slider-' . $uid . '")

                        _slider.flexslider({
                            slideshow: ' . $slideshow . ',
                            start: function(slider){

                                _slider.find(".flex-control-nav > li > a")
                                    .css("border-color",  \'' . $color . '\')
                                    .hover (
                                        function(){
                                        $(this).css("background-color", "' . $color . '")
                                        },
                                        function(){
                                          $(this).css("background-color", "transparent")
                                        })
		                        _slider.find(".flex-control-nav > li > a.flex-active")
                                    .css("background-color", "' . $color . '")
                                _slider.find(".flex-direction-nav > li > a")
                                    .css("border-color",  \'' . $color . '\')
                                    .css("color",  \'' . $color . '\')
                                    .hover (
                                        function(){
                                        //$(this).css("background", "none")
                                        $(this).css("background-color", "' . $color . '")
                                        },
                                        function(){
                                          $(this).css("background-color", "transparent")
                                        })

                                    _slider.trigger("coll.flexslider.init");
                            },
                            before: function(_slider){
                                _slider.find(".flex-control-nav > li > a.flex-active")
                                    .css("background-color", "transparent")
                            },
                            after: function(_slider){
                                _slider.find(".flex-control-nav > li > a.flex-active")
                                    .css("background-color", "' . $color . '")
                                $(window).trigger("resize");
                            }
                        });
                    }

                    $(window).load(initSlider);
                    $(window).on("coll.shortcodes.update", initSlider);
                });
                </script>';


		// start items
		$output .= '<ul class="slides">';

		$slides = get_post_meta( $id, 'assets_content', true );
		$slides = json_decode( html_entity_decode( $slides ) );
		//print_r($slides);
		foreach ( $slides as $slide ) {
			// get image
			$img      = wp_get_attachment_image_src( $slide->id, 'full' );
			$img_meta = coll_get_attachment( $slide->id );
			// build
			$output .= "<li>";
			$output .= '<img class="img js-coll-lazy"
                                    width="' . $img[1] . '"
                                    height="' . $img[2] . '"
                                    data-coll-src="' . $img[0] . '"
                                    alt="' . $img_meta['alt'] . '"/>';
			$output .= '<footer class="flex-caption">';
			if ( ! empty( $img_meta['caption'] ) ) {
				$output .= '<h3 class="caption">' . $img_meta['caption'] . '</h3>';
			}
			if ( ! empty( $img_meta['description'] ) ) {
				$output .= '<div class="description">' . $img_meta['description'] . '</div>';
			}
			$output .= '</footer>';

			$output .= "</li>";
		}

		$output .= '</ul>'; // end items
		$output .= '</div>'; // end slider




		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;

		}
	}
}

$sc = new MorpheusShortcodeFlexSlider();
$sc->register( 'coll_flexslider' );