<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeLayerSlider extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {

        extract(shortcode_atts(array(
            'id' => '',
            'class' => ''
        ), $atts));

        $output = '';


        // slideshow enabled
        if (class_exists('LS_Sliders')) {
            $slider = LS_Sliders::find($id);
            if ($slider['data']['properties']['autostart']) {
                $class .= 'coll-slideshow';
            }
        }

        // start slider
        $output .= '<div class="coll-layerslider ' . $class . '">';
        $output .= do_shortcode('[layerslider id="' . $id . '"]');
        if (strpos($class, 'coll-section-background') !== false) {
            // js
            $output .= '<script type="text/javascript">
                jQuery(document).ready(function ($) {
                    function initSlider() {
                    	var _slider = $("#layerslider_' . $id . '");
                    	var _container = _slider.parent();

                        var _nOrigWidth = _slider.width();
	                    var _nOrigHeight = _slider.height();

	                    _container.css("width", _slider.parent().width());
	                    _container.css("height", function () {
	                        return $(this).width() / _nOrigWidth * _nOrigHeight;
	                    });

		                 $(this).smartresize(function(){
		                       _container.css({
		                            "width": "auto",
		                            "height": "auto"
		                       });
		                 });


		                 // pause slider on scroll
		                 //if (_slider.parent().hasClass("coll-slideshow"){
		                  window.addEventListener("coll.panim.start", function(){
                                console.log("start")
                            })
                            window.addEventListener("coll.panim.end", function(){
                                console.log("end")
                            })

                    };

                    $(window).load(initSlider);
                    $(window).on("coll.shortcodes.update", initSlider);
                });
                </script>';
        }
        $output .= '<script type="text/javascript">
                jQuery(document).ready(function ($) {
                    	var _slider = $("#layerslider_' . $id . '");
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

$sc = new MorpheusShortcodeLayerSlider();
$sc->register('coll_layerslider');