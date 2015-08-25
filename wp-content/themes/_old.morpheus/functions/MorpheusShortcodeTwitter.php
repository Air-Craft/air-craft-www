<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeTwitter extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'id' => rand(1, 9999),
            'usr' => 'aplusk',
            'nr' => '2',
            'oat' => '2403135363-ldFj7vdqJ4sb4moanZQgQwMLZoHhY4fNeSW06Em',
            'oats' => 'rwpjO4sZcPKKCE9ZU07HiqTLYZYK9B2UODpAIjFOFBM1u',
            'ck' => 'nABhqKv75G5JNSwsYlSjsNAKf',
            'cks' => 'ZkHjLITRh74QZfLZI64yxXLheYLxF45j5Be9s3iHuP2ds2wV38',
            'color' => '#bdc3c7',
            'text_color' => '#313131',
            'link_color' => '#999',
            'linkh_color' => ot_get_option('coll_accent_color'),
            'class' => ''
        ), $atts));

        $output = '';
        $output .= '<div class="coll-twitter ' . $class . '"
                    data-coll-color=\'{ "m":"' . $color . '",
                                        "t":"' . $text_color . '",
                                        "l":"' . $link_color . '",
                                        "lh":"' . $linkh_color . '"}\';
                    >';
        $output .= '<ul class="logo">';
        $output .= '<li class="left"></li>';
        $output .= '<li class="center"><i class="fa fa-twitter"></i></li>';
        $output .= '<li class="right"></li>';
        $output .= '</ul>';
        $output .= '<div id="twitter-' . $id . '"class="tweets-slider coll-flexslider flexslider" >';
        $output .= '<script type="text/javascript">
                jQuery(document).ready(function($){
                        $("#twitter-' . $id . ' .slides").html(format_tweets(' . getTweets($usr, $nr, $oat, $oats, $ck, $cks) . '));
                });
                </script>';
        $output .= '<script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $(window).load(function() {
                        var _slider = $("#twitter-' . $id . '")

                       _slider.flexslider({
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

                    });
                });
                </script>';

        $output .= '<ul class="slides">';
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';


        return $output;
    }

    public function addScript()
    {
        if (!self::$addedAlready) {
            self::$addedAlready = true;
            wp_register_script('twitter', get_template_directory_uri() . '/js/twitter.js', '', NULL, true);
            wp_enqueue_script('twitter');
        }
    }
}

$sc = new MorpheusShortcodeTwitter();
$sc->register('coll_twitter');