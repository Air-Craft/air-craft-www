<?php
/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('framework');


/*-----------------------------------------------------------------------------------*/
/*	register WP3.0+ menus
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_register_menu')) {
    function coll_register_menu()
    {
        //register_nav_menu('primary-menu', __('Main Menu', 'framework'));
        register_nav_menus(array(
            'primary-menu' => __('Main Menu', 'framework'),
            'footer-menu' => __('Footer Menu', 'framework')
        ));
    }

    add_action('init', 'coll_register_menu');
}
/*-----------------------------------------------------------------------------------*/
/* enable sidebars
/*-----------------------------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Blog Sidebar',
        'id' => 'coll-blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title"><span>',
        'after_title' => '</span></h6>',
    ));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'coll-page-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title"><span>',
		'after_title' => '</span></h6>',
	));
}

/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_excerpt_length')) {
    function coll_excerpt_length($length)
    {
        return ot_get_option('coll_excerpt_length');
    }

    add_filter('excerpt_length', 'coll_excerpt_length');
}
/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_excerpt_more')) {
    function coll_excerpt_more($excerpt)
    {
        return '';
    }

    add_filter('excerpt_more', 'coll_excerpt_more');

}
/*-----------------------------------------------------------------------------------*/
/* Extra
/*-----------------------------------------------------------------------------------*/
add_post_type_support( 'page', 'excerpt' );
add_theme_support('automatic-feed-links');
if (!isset($content_width)) $content_width = 1000;