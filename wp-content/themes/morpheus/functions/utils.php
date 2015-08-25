<?php

/*

      Custom css
______________________________________________________________
*/
if (!function_exists('coll_theme_styling')) {
    function coll_theme_styling()
    {
        $output = '';

        //fonts
        $output .= coll_font_style('body', 'coll_font_body');
        $output .= coll_font_style('h1', 'coll_font_hone');
        $output .= coll_font_style('h2', 'coll_font_htwo');
        $output .= coll_font_style('h3', 'coll_font_htree');
        $output .= coll_font_style('h4', 'coll_font_hfour');
        $output .= coll_font_style('h5', 'coll_font_hfive');
        $output .= coll_font_style('h6', 'coll_font_hsix');
        $output .= coll_font_style('.sf-menu a', 'coll_font_menu');


        // accenr color
        $a_color = ot_get_option('coll_accent_color');

        $output .= ".coll-single .navigation-container .arrow:hover > div.info > label,
                    .coll-single .navigation-container .arrow:hover > div.info > .title-text
                    {\n\t";
        $output .= "color: " . $a_color . ";\n\t";
        $output .= "}\n";

        $output .= ".coll-button.coll-accent-color:hover,
                    .coll-single.lightbox,
                    .comment-reply-link:hover,
                    .coll-single .navigation-container .arrow:hover .fa,
                    .coll-single .title-wrapper .icons .link:hover,
                    .coll-post-info .categories a:hover
                    {\n\t";
        $output .= "border-color: " . $a_color . ";\n\t";
        $output .= "}\n";

        $output .= ".coll-single .navigation-container .arrow:hover .fa,
                    .coll-button.coll-accent-color:hover,
                    .comment-reply-link:hover,
                    .coll-single .title-wrapper .icons .link:hover,
                    .coll-shortcode-portfolio .items .hentry .wrapper .under
                    {\n\t";
        $output .= "background-color: " . $a_color . ";\n\t";
        $output .= "}\n";


        /* Output our custom styles --------------------------*/
        if ($output <> '') {
            $output = "<!-- Theme Custom Styling -->\n<style type=\"text/css\" id=\"theme-custom\">\n" . $output . "</style>\n";
            echo stripslashes($output);
        }

    }

    function coll_font_style($selector, $id)
    {
        $output = '';
        $data = ot_get_option($id);
        $output .= $selector . " {\n\t";
        if (!empty($data['font-color'])) {
            $output .= "color: " . $data['font-color'] . ";\n\t";
        }
        if (!empty($data['font-family'])) {
            $output .= "font-family: " . $data['font-family'] . " , Arial, Helvetica;\n\t";
        }
        if (!empty($data['font-size'])) {
            $output .= "font-size: " . $data['font-size'] . ";\n\t";
        }
        if (!empty($data['font-style'])) {
            $output .= "font-style: " . $data['font-style'] . ";\n\t";
        }
        if (!empty($data['font-variant'])) {
            $output .= "font-variant: " . $data['font-variant'] . ";\n\t";
        }
        if (!empty($data['font-weight'])) {
            $output .= "font-weight: " . $data['font-weight'] . ";\n\t";
        }
        if (!empty($data['letter-spacing'])) {
            $output .= "letter-spacing: " . $data['letter-spacing'] . ";\n\t";
        }
        if (!empty($data['line-height'])) {
            $output .= "line-height: " . $data['line-height'] . ";\n\t";
        }
        if (!empty($data['text-decoration'])) {
            $output .= "text-decoration: " . $data['text-decoration'] . ";\n\t";
        }
        if (!empty($data['text-transform'])) {
            $output .= "text-transform: " . $data['text-transform'] . ";\n\t";
        }
        $output .= "}\n";

        return $output;
    }

    add_action('wp_head', 'coll_theme_styling');


}
if (!function_exists('coll_other_css')) {
    function coll_other_css()
    {

        $output = '';
        // preloader
        $pcolor = ot_get_option('coll_preloader_color');
        $pbgcolor = ot_get_option('coll_preloader_bg_color');
        if (!empty($pcolor)) {
            $output .= ".coll-site-preloader .spinner  {\n\t background-color: $pcolor; \n}\n";
        }
        if (!empty($pbgcolor)) {
            $output .= ".coll-site-preloader {\n\t background-color: $pbgcolor; \n}\n";
        }

        // header
        $header = ot_get_option('coll_header_height');
        $output .= ".site-header {\n\t";
        if (!empty($header)) {
            $output .= "height: " . $header . "px;\n\t";
        }
        $output .= "}\n";
        // header bg
        $header = ot_get_option('coll_header_background');
        $output .= ".site-header .background {\n\t";
        if (!empty($header['background-color'])) {
            $output .= "background-color: " . $header['background-color'] . ";\n\t";
        }
        if (!empty($header['background-repeat'])) {
            $output .= "background-repeat: " . $header['background-repeat'] . ";\n\t";
        }
        if (!empty($header['background-attachment'])) {
            $output .= "background-attachment: " . $header['background-attachment'] . ";\n\t";
        }
        if (!empty($header['background-position'])) {
            $output .= "background-position: " . $header['background-position'] . ";\n\t";
        }
        if (!empty($header['background-image'])) {
            $output .= "background-image: url(" . $header['background-image'] . ");\n";
        }
        $output .= "}\n";
        // header border
        $header = ot_get_option('coll_header_border_color');
        $output .= ".site-header.skrollable {\n\t";
        if (!empty($header)) {
            $output .= "border-bottom-color: " . $header . ";\n";
        }
        $output .= "}\n";


        // header logo position
        $logopos = ot_get_option('coll_logo_position');
        $logopos = ($logopos) ? $logopos : 'coll-left';
        $logov = ot_get_option('coll_logo_vmargin');
        $logoh = ot_get_option('coll_logo_hmargin');
        $logoh = ($logopos == 'coll-left') ? 'left:' . $logoh : 'right:' . $logoh;
        $output .= ".site-header .logo {\n\t";
        if (!empty($logov)) {
            $output .= "top: " . $logov . "px;\n\t";
        }
        if (!empty($logoh)) {
            $output .= $logoh . "px;\n\t";
        }
        $output .= "}\n";

        // header menu position
        $menupos = ot_get_option('coll_menu_position');
        $menupos = ($menupos) ? $menupos : 'coll-left';
        $menuv = ot_get_option('coll_menu_vmargin');
        $menuh = ot_get_option('coll_menu_hmargin');
        $menuh = ($menupos == 'coll-left') ? 'left:' . $menuh : 'right:' . $menuh;
        $output .= ".site-header .mainmenu {\n\t";
        if (!empty($menuv)) {
            $output .= "top: " . $menuv . "px;\n\t";
        }
        if (!empty($menuh)) {
            $output .= $menuh . "px;\n\t";
        }
        $output .= "}\n";

        // header menu color
        $color = ot_get_option('coll_menu_color');
        $colorh = ot_get_option('coll_menu_hcolor');
        $hslide = ot_get_option('coll_header_slide');
        $scolor = ot_get_option('coll_static_menu_color');
        $scolorh = ot_get_option('coll_static_menu_hcolor');
        if (!empty($color)) {
            $output .= ".sf-menu a, .sf-menu a:visited  {\n\t color: $color; \n}\n";
        }
        if (!empty($colorh)) {
            $output .= ".sf-menu a:hover, .sf-menu .current-menu-item > a {\n\t color: $colorh; \n}\n";
        }
        // static menu color
        if (!empty($hslide)) {
            if (!empty($scolor)) {
                $output .= ".site-header.static .sf-menu a, .site-header.static .sf-menu a:visited  {\n\t color: $scolor; \n}\n";
            }
            if (!empty($scolorh)) {
                $output .= ".site-header.static .sf-menu a:hover, .site-header.static  .sf-menu .current-menu-item > a {\n\t color: $scolorh; \n}\n";
            }
        }


        // mobile menu
        $mmiconcolor = ot_get_option('coll_mobile_menu_icon');
        $output .= ".site-header.mobile #coll-menu-icon {\n\t";
        if (!empty($mmiconcolor)) {
            $output .= "color: " . $mmiconcolor . ";\n";
        }
        $output .= "}\n";
        $color = ot_get_option('coll_mobile_menu_border');
        if (!empty($color)) {
            $output .= ".site-header.mobile .sf-menu li {\n\t border-color: $color; \n}\n";
            $output .= ".site-header.mobile .sf-menu  ul > li > a:before  {\n\t color: $color; \n}\n";
            $output .= ".site-header.mobile .sf-menu .mobnav-subarrow  {\n\t color: $color; \n}\n";
        }


        // footer bg
        $footer = ot_get_option('coll_footer_background');
        $output .= ".site-footer .background {\n\t";
        if (!empty($footer['background-color'])) {
            $output .= "background-color: " . $footer['background-color'] . ";\n\t";
        }
        if (!empty($footer['background-repeat'])) {
            $output .= "background-repeat: " . $footer['background-repeat'] . ";\n\t";
        }
        if (!empty($footer['background-attachment'])) {
            $output .= "background-attachment: " . $footer['background-attachment'] . ";\n\t";
        }
        if (!empty($footer['background-position'])) {
            $output .= "background-position: " . $footer['background-position'] . ";\n\t";
        }
        if (!empty($footer['background-image'])) {
            $output .= "background-image: url(" . $footer['background-image'] . ");\n";
        }
        $output .= "}\n";

        //footer horizontal margin
        $footer_h_m = ot_get_option('coll_footer_hmargin');
        $output .= "@media only screen and (min-width : 1025px) {\n\t";
        $output .= ".coll-footer-wrapper  {\n\t";
        if (!empty($footer_h_m)) {
            $output .= "padding: 0px " . $footer_h_m . "px;\n\t";
        }
        $output .= "}\n";
        $output .= "}\n";

        //footer border color
        $footer_border = ot_get_option('coll_footer_border');
        $output .= ".site-footer .bottom {\n\t";
        if (!empty($footer_h_m)) {
            $output .= "border-top-color: " . $footer_border . ";\n\t";
        }
        $output .= "}\n";


        /* Output our custom styles --------------------------*/
        if ($output <> '') {
            $output = "<!-- Other Custom Styling -->\n<style type=\"text/css\" id=\"other-custom\">\n" . $output . "</style>\n";
            echo stripslashes($output);
        }

    }

    add_action('wp_head', 'coll_other_css');
}

if (!function_exists('coll_custom_css')) {
    function coll_custom_css()
    {


    }

    add_action('wp_head', 'coll_custom_css');
}

/*

      Detect device
______________________________________________________________
*/
$coll_is_mobile = false;
$coll_is_phone = false;
$coll_is_tablet = false;
$coll_is_desktop = false;
$coll_parallax_enabled = true;
if (!function_exists('coll_mobile_parallax')) {

    function coll_mobile_parallax()
    {
        global $coll_is_mobile, $coll_is_phone, $coll_is_tablet, $coll_is_desktop, $coll_parallax_enabled;

        $coll_detect = new Mobile_Detect;
        $opt = ot_get_option('coll_disable_parallax');
        $phone = !empty($opt) ? $opt[0] : 0;
        $tablet = !empty($opt) ? $opt[1] : 0;
        if ($coll_detect->isMobile()) {
            $coll_is_mobile = true;
            if ($coll_detect->isTablet()) {
                $coll_is_tablet = true;
                if ($tablet) {
                    $coll_parallax_enabled = false;
                } else {
                    $coll_parallax_enabled = true;
                };
            } else {
                $coll_is_phone = true;
                if ($phone) {
                    $coll_parallax_enabled = false;
                } else {
                    $coll_parallax_enabled = true;
                };
            }
        } else {
            $coll_is_desktop = true;
            $coll_parallax_enabled = true;
        }
    }

    add_action('init', 'coll_mobile_parallax');
}


function is_safari($needle = "Safari") {
    //if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && strpos($_SERVER['HTTP_USER_AGENT'], 'Mac')) {
        return true;
    }
    return false;
    //return true;
}


/*

      Body class
______________________________________________________________
*/
if (!function_exists('coll_body_class')) {
    function coll_body_class($classes)
    {
        global $coll_is_mobile;


        $classes[] = 'coll-custom-structure';
        if ($coll_is_mobile) {
            $classes[] = 'coll-mobile';
        }

        $coll_detect = new Mobile_Detect;
        if( $coll_detect->isiOS() ){
            $ver = $coll_detect->version('iOS');
            if ($ver[0] == 8){
                $classes[] = 'coll-safari8';
            }
        }

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
            $ver = $coll_detect->version('Safari');
            if ($ver[0] == 8) {
                $classes[] = 'coll-safari8';
            }
        }
        return $classes;
    }

    add_filter('body_class', 'coll_body_class');
}
/*

      Read more class
______________________________________________________________
*/
if (!function_exists('coll_add_morelink_class')) {
    function coll_add_morelink_class($link, $text)
    {
        return str_replace(
            'more-link'
            , 'more-link coll-button coll-accent-color'
            , $link
        );
    }

    add_filter('the_content_more_link', 'coll_add_morelink_class', 10, 2);
}
if (!function_exists('coll_remove_more_link_scroll')) {
    function coll_remove_more_link_scroll($link)
    {
        $link = preg_replace('|#more-[0-9]+|', '', $link);

        return $link;
    }

    add_filter('the_content_more_link', 'coll_remove_more_link_scroll');
}
/*

    Change section urls
______________________________________________________________
*/
if (!function_exists('coll_fix_menu')) {
    function  coll_fix_menu($items)
    {
        $url = get_permalink();
        foreach ($items as $item) {
            // save parent
            if ($item->menu_item_parent == 0) {
                $parent_url = $item->url;
            }

            if ($item->object == 'custom') {
                // leave only hash if the page contains the section
                $iurl = preg_replace('/#.*/', '', $item->url);
                if ($url == $iurl) {
                    $item->url = "#" . parse_url($item->url, PHP_URL_FRAGMENT);
                }

                //remove current-menu-item
                if (!empty($item->classes[4]) && $item->classes[4] == 'current-menu-item') {
                    $item->classes[4] = '';
                }


            }


            // transform the url's of page sections
            if ($item->object == 'coll-page-section') {
                //get front page section info
                $post = get_post($item->object_id);

                // if it's a submenu
                if ($item->menu_item_parent != 0) {
                    // if the page contains the front page section
                    if ($url == $parent_url) {
                        $item->url = "#" . $post->post_name;
                    } else {
                        // it doesn't
                        $item->url = $parent_url . "#" . $post->post_name;
                    }
                } else {
                    //it's a main menu
                    $item->url = (is_front_page()) ? "#" . $post->post_name : home_url() . "/#" . $post->post_name;
                }
            }
        }

        return $items;
    }

    add_filter('wp_nav_menu_objects', 'coll_fix_menu');

}
if (!function_exists('coll_add_class_menu_anchor')) {
    function coll_add_class_menu_anchor($item_output, $item, $depth, $args)
    {

        $iurl = $item->url;
        if ($iurl[0] == '#') {
            $item_output = preg_replace('/<a /', '<a class="js-coll-local-link" ', $item_output, 1);
        } else {
            $item_output = preg_replace('/<a /', '<a class="no-border" ', $item_output, 1);
        }



        return $item_output;
    }

    add_filter('walker_nav_menu_start_el', 'coll_add_class_menu_anchor', 10, 4);
}
/*

      Retrieve image id
______________________________________________________________
*/
if (!function_exists('coll_get_attachment_id')) {
    function coll_get_attachment_id($image_url)
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $image_url));

        return $attachment[0];
    }
}


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

if (!function_exists('coll_favicon')) {
    function coll_favicon()
    {
        $fav = ot_get_option('coll_favicon');
        if (!empty($fav)) {
            echo '<link rel="shortcut icon" href="' . $fav . '"/>' . "\n";
        } else {
            echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/img/favicon.ico" />';
        }
    }

    add_action('wp_head', 'coll_favicon');
}

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if (!function_exists('coll_comment')) {
    function coll_comment($comment, $args, $depth)
    {

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> >
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-meta">
                <div class="image"><?php echo get_avatar($comment, 100); ?></div>
                <div class="text">
                    <span class="author"><?php comment_author_link(); ?> </span>
                    <span class="date"><?php comment_date('F jS, Y g:iA'); ?></span>
                </div>
            </div>
            <div class="comment-body ">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>
                    <br/>
                <?php endif; ?>
                <?php comment_text() ?>
            </div>
            <?php if (comments_open()) : ?>

                <div class="comment-reply">
                    <?php comment_reply_link(array_merge($args, array(
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    ))) ?>
                </div>
            <?php endif; ?>
        </div>

    <?php

    }
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if (!function_exists('coll_pings')) {
    function coll_pings($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment; ?>
        <li class="ping comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?></li>
    <?php

    }
}
if (!function_exists('coll_comment_author_link_window')) {
// Make comment author link URL open in new window
    function coll_comment_author_link_window()
    {
        global $comment;
        $url = get_comment_author_url();
        $author = get_comment_author();

        if (empty($url) || 'http://' == $url)
            $return = $author;
        else
            $return = "<a href='$url' rel='external nofollow' target='_blank'>$author</a>";

        return $return;
    }

    add_filter('get_comment_author_link', 'coll_comment_author_link_window');
}
/*-----------------------------------------------------------------------------------*/
/*	CUSTOM COMMENT FORM
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_comment_form')) {
    function coll_comment_form($form_options)
    {
        global $post_id, $user_identity;
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');

        // Fields Array
        $fields = array(

            'author' =>
                '<p class="comment-form-author">' .
                //            ($req ? '<span class="required">*</span>' : '') .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' placeholder="' . __('NAME', 'framework') . '" />' .
                '</p>',
            'email' =>
                '<p class="comment-form-email">' .
                //            ($req ? '<span class="required">*</span>' : '') .
                '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . __('EMAIL', 'framework') . '" />' .
                '</p>',
            'url' =>
                '<p class="comment-form-url">' .
                '<input name="url" size="30" id="url" value="' . esc_attr($commenter['comment_author_url']) . '" type="text" placeholder="' . __('WEBSITE (optional)', 'framework') . '" />' .
                '</p>',

        );

        // Form Options Array
        $form_options = array(
            // Include Fields Array
            'fields' => apply_filters('comment_form_default_fields', $fields),
            // Template Options
            'comment_field' =>
                '<p class="comment-form-comment">' .
                '<textarea name="comment" id="comment" aria-required="true" rows="8" cols="45" placeholder="' . _x('MESSAGE', 'noun', 'framework') . '"></textarea>' .
                '</p>',
            'must_log_in' =>
                '<p class="must-log-in">' .
                sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'),
                    wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) .
                '</p>',
            'logged_in_as' =>
                '<p class="logged-in-as">' .
                sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'),
                    admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) .
                '</p>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            // Rest of Options
            'id_form' => 'commentForm',
            'id_submit' => 'comment-submit',
            'title_reply' => __('', 'framework'),
            'title_reply_to' => __('Leave a Reply to %s', 'framework'),
            'cancel_reply_link' => __('Cancel', 'framework'),
            'label_submit' => __('Submit', 'framework'),
            'name_submit' => 'submit',
            'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
            'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
        );

        return $form_options;
    }

    add_filter('comment_form_defaults', 'coll_comment_form');
}
if (!function_exists('coll_output_comment_form')) {
    function coll_output_comment_form($args = array(), $post_id = null)
    {
        if (isset($args['class_submit'])) {
            ob_start();
            comment_form($args, $post_id);

            $string = str_replace('<a rel="nofollow" id="cancel-comment-reply-link"', '<a class="coll-button coll-accent-color ' . $args['class_submit'] . '" rel="nofollow" id="cancel-comment-reply-link" ', ob_get_contents());
            $string = str_replace('<input name="submit"', '<input class="coll-button coll-accent-color ' . $args['class_submit'] . '" name="submit" ', $string);
            ob_end_clean();

            // submit
            echo $string;
        } else {
            comment_form($args, $post_id);
        }
    }
}
/**/
if (!function_exists('coll_get_attachment')) {
    function coll_get_attachment($attachment_id)
    {
        $attachment = get_post($attachment_id);

        return array(
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink($attachment->ID),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
    }
}

/*

     Other usefull functions
______________________________________________________________
*/
if (!function_exists('coll_special_divider')) {
    function coll_special_divider($text)
    {
        $output = '<div class="row">';
        $output .= '<div class="coll-section-divider large-12 columns">';
        $output .= '<span class="text">' . $text . '</span>';
        $output .= '<span class="line"><span class="color"></span></span>';
        $output .= '</div>';
        $output .= '</div>';

        echo $output;
    }
}
/**
 * Get the excerpt of a specific post ID or object
 *
 * @author Pippin Williamson
 * @link http://goo.gl/lhtZD
 *
 * @param object /int $post The ID or object of the post to get the excerpt of
 * @param int $length The length of the excerpt in words
 * @param string $tags The allowed HTML tags. These will not be stripped out
 * @param string $extra Text to append to the end of the excerpt
 */
if (!function_exists('coll_get_excerpt_by_id')) {
    function coll_get_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = '&hellip;')
    {
        //if (is_int($post)) {
        $post = get_post($post);
        // } elseif (!is_object($post)) {
        //   return false;
        // }

        if (has_excerpt($post->ID)) {
            $the_excerpt = $post->post_excerpt;

            return apply_filters('the_content', $the_excerpt);
        } else {
            $the_excerpt = $post->post_content;
        }

        $the_excerpt = strip_shortcodes(strip_tags($the_excerpt, $tags));
        $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2 + 1);
        $excerpt_waste = array_pop($the_excerpt);
        $the_excerpt = implode($the_excerpt);
        $the_excerpt .= $extra;

        return apply_filters('the_content', $the_excerpt);
    }
}
// get url from anchor html
if (!function_exists('coll_get_url')) {
    function coll_get_url($html)
    {
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//a/@href');
        foreach ($nodes as $href) {
            return $href->nodeValue; // echo current attribute value

        }
    }
}

// create google font list
if (!function_exists('coll_google_fonts_list')) {
    function coll_google_fonts_list()
    {

        $embd = ot_get_option('coll_google_fonts');


        $embd = str_replace("<link href='http://fonts.googleapis.com/css?family=", '|', $embd);
        $embd = str_replace("' rel='stylesheet' type='text/css'>", '', $embd);
        $embd = explode('|', $embd);

        $fonts = array();
        foreach ($embd as $font) {
            if (strpos($font, ':') !== false) {
                $font = strstr($font, ':', true);
            }

            $font = str_replace('+', ' ', $font);
            $fonts[$font] = $font;

        }

        $fonts = array_filter($fonts, 'strlen');

        return $fonts;
    }
}
function filter_ot_recognized_font_families($array, $field_id)
{


    $theme_fonts = array(
        'Lato' => '"Lato", sans-serif',
        'Raleway' => '"Raleway", sans-serif',
        'Bentham' => '"Bentham", sans-serif',
        'Pinyon Script' => '"Pinyon Script", sans-serif',
        'Bitter' => '"Bitter", sans-serif',
        'Open Sans' => '"Open Sans", sans-serif',
        'Sacramento' => '"Sacramento", sans-serif',
        'Pacifico' => '"Pacifico", sans-serif',
        'Lobster' => '"Lobster", sans-serif',
        'Roboto' => '"Roboto", sans-serif',
        'Oswald' => '"Oswald", sans-serif',
    );
    $array = array_merge(coll_google_fonts_list(), $theme_fonts, $array);

    return $array;

}

add_filter('ot_recognized_font_families', 'filter_ot_recognized_font_families', 1, 2);

/* helper function to detect already installed plugin */
if (!function_exists('coll_is_plugin_active')) {

    function coll_is_plugin_active($plugin)
    {
        return in_array($plugin, (array)get_option('active_plugins', array()));
    }

}

// p tags
if (!function_exists('coll_fix_shortcodes')) {

}

// add js event to layerslider start
function coll_add_ls_callback($arr)
{
    $arr['properties']['cbinit'] = 'function(slider){slider.trigger("coll.layerslider.init");}';

    return $arr;
}