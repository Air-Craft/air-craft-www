<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('MorpheusShortCodeScriptLoader.php');

class MorpheusShortcodeContact extends MorpheusShortCodeScriptLoader
{

    static $addedAlready = false;

    public function handleShortcode($atts, $output = null)
    {
        extract(shortcode_atts(array(
            'to' => get_bloginfo('admin_email'),
            'uid' => rand(1, 9999),
            'color' => '#000',
            'border_color' => '#d5d5d5',
            'border_color_selected' => '#999',
            'class' => ''
        ), $atts));

        $output = '';
        $output .= '<div class="coll-contact-shortcode js-coll-contact clearfix ' . $class . '"
                         style="color:' . $border_color . '"
                         data-coll-color="' . $color . '"
                         data-coll-border-color="' . $border_color . '"
                         data-coll-border-color-selected="' . $border_color_selected . '"
                         >';
        $output .= '<script type="text/javascript">
                        var $j = jQuery.noConflict();
                        $j(window).load(function(){
                            $j("#contact-form-' . $uid . '").submit(function() {
                              // validate and process form here
                                 var str = $j(this).serialize();

                                 $j.ajax({
                                   type: "POST",
                                   url:"' . site_url() . '/wp-admin/admin-ajax.php",
                                   data: str,
                                   success: function(msg){
                                         $j("#contact-form-' . $uid . '").parent().parent().find(".note").html(msg);
                                         $j("#contact-form-' . $uid . '").parent().hide();;
                                         $j(window).trigger("resize");
                                   },
                                   error : function(err) {
                                        //load any error data
                                        $j("#contact-form-' . $uid . '").parent().parent().find(".note").html(err.statusText);
                                        $j(window).trigger("resize");
                                       }
                                 });
                                return false;
                            });
                        });
                    </script>';
        $output .= '<div class="fields">';
        $output .= '<form id="contact-form-' . $uid . '"  class="coll-contact-form" action="#">';
        $output .= '<input name="to_email" type="hidden" value="' . $to . '" />';
        $output .= '<input type="hidden" name="action" value="send_mail" />';
        $output .= '<p><input class="field" name="name" type="text" placeholder="' . __('YOUR NAME', 'framework') . '"/></p>';
        $output .= '<p><input class="field" name="email" type="text" placeholder="' . __('YOUR EMAIL ADDRESS', 'framework') . '"/></p>';
        $output .= '<p><textarea class="field" name="message" placeholder="' . __('YOUR MESSAGE FOR US', 'framework') . '"></textarea></p>';
        $output .= '<p><input class="coll-button coll-accent-color" type="submit" value="' . __('SEND IT', 'framework') . '"  /></p>';
        $output .= '</form>';
        $output .= '</div><!--end fields-->';
        $output .= '<div class="note"></div> <!--notification area used by jQuery/Ajax -->';
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

$sc = new MorpheusShortcodeContact();
$sc->register('coll_contact');