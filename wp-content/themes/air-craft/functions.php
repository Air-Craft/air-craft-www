<?php

// ENQUEUE CHILD THEME SCRIPTS
add_action( 'wp_enqueue_scripts', 'ac_enqueue_parent_styles' );
function ac_enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', trailingslashit(get_template_directory_uri()).'style.css' );
    // wp_enqueue_style( 'flare-style', trailingslashit(get_stylesheet_directory_uri()).'js/pe.flare/jquery.pixelentity.flare.min.css' );
    wp_enqueue_style( 'colorbox-style', get_stylesheet_directory_uri().'/js/colorbox/colorbox.css' );
}

function ac_add_theme_scripts() {
	wp_enqueue_script('youtube_iframe_api', '//www.youtube.com/iframe_api', null, null, false);
	wp_enqueue_script('ac_typekit_script', trailingslashit(get_stylesheet_directory_uri()).'js/typekit.js', null, '1.0', false);
	// wp_enqueue_script('flare_script', trailingslashit(get_stylesheet_directory_uri()).'js/pe.flare/jquery.pixelentity.flare.min.js', array('jquery'), '1.0', false);
	wp_enqueue_script('colorbox_js', trailingslashit(get_stylesheet_directory_uri()).'js/colorbox/jquery.colorbox-min.js', array('jquery'), '1.0', false);
	wp_enqueue_script('ac_autoplay_detect_script', trailingslashit(get_stylesheet_directory_uri()).'js/autoplay-detect.js', array('jquery'), '1.0', false);
}

add_action( 'wp_enqueue_scripts', 'ac_add_theme_scripts' );  

// REMOVE UNNECESSARY SCRIPTS
add_action('wp_print_scripts', function () {
	
	wp_dequeue_script( 'page.single' );
	wp_deregister_script( 'page.single' );
	wp_enqueue_script( 'page.single', trailingslashit(get_stylesheet_directory_uri()) . 'js/page.single.js', '', null, true );
		
	if (is_page_template('home-sabre.php')) {
		wp_enqueue_script( 'page.sections', trailingslashit(get_stylesheet_directory_uri()) . 'js/page.sections.js', '', null, true );	
	}
	if (is_page_template('launch.php')) {
		// For now this is just launch
		wp_enqueue_script('ac_site', trailingslashit(get_stylesheet_directory_uri()).'js/site.js', array('jquery', 'ac_autoplay_detect_script', 'youtube_iframe_api'), '1.0', false);
		
		
		wp_dequeue_script('page.sections');
		wp_dequeue_script( 'foundation' );
		wp_dequeue_script( 'scrollbar' );
		wp_dequeue_script( 'sresize' );
        wp_dequeue_script( 'mousewheel.s' );
        wp_dequeue_script( 'mousewheel' );
		wp_dequeue_script( 'comment-reply' );
		wp_dequeue_script( 'swipe' );
		wp_dequeue_script( 'sresize' );
		wp_dequeue_script( 'superfish' );
		wp_dequeue_script( 'fitvid' );
		wp_dequeue_script( 'isotope' );
		wp_dequeue_script( 'popup' );
		wp_dequeue_script( 'lasyload' );
		wp_dequeue_script( 'flexslider' );
		wp_dequeue_script( 'knob' );
		wp_dequeue_script( 'parallax' );
		wp_dequeue_script( 'countdown' );
		wp_dequeue_script( 'shortcodes' );
		wp_dequeue_script( 'commons' );
		wp_dequeue_script( 'retina' );
        wp_dequeue_script( 'page.sections' );
		wp_dequeue_script( 'page.single' );
		wp_dequeue_script( 'custom.structure.s' );
        wp_dequeue_script( 'custom.structure' );
			
		
        wp_dequeue_script( 'greensock' );
        wp_dequeue_script( 'layerslider' );
		wp_dequeue_script( 'layerslider-transitions' );
		wp_dequeue_script( 'jquery-ui' );
		wp_dequeue_script( 'layerslider' );
		wp_dequeue_script( 'smartresize' );
		wp_dequeue_script( 'jquery-smartresize' );
		
	}
});

/////////////////////////////////////////////////////////////////////////
// FOOTER
/////////////////////////////////////////////////////////////////////////

add_action('wp_footer', 'ac_analytics');
function ac_analytics()
{
	echo <<<EOF
		<script>
		    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		    ga('create', 'UA-50711534-2', 'auto');
		    ga('send', 'pageview');
		</script>
EOF;
}    


/////////////////////////////////////////////////////////////////////////
// HEADER
/////////////////////////////////////////////////////////////////////////

add_action('wp_head', 'ac_icons_header');

// Overrides
function coll_favicon() {}
function coll_theme_styling() {}

function ac_icons_header() {
	$base = trailingslashit(get_stylesheet_directory_uri());
	echo <<<EOF
		<link rel="apple-touch-icon" sizes="60x60" href="{$base}icons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="{$base}icons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="{$base}icons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="{$base}icons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="{$base}icons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="{$base}icons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="{$base}icons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="{$base}icons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="{$base}icons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="{$base}icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="{$base}icons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="{$base}icons/favicon-16x16.png">
		<link rel="manifest" href="{$base}icons/manifest.json">
		<meta name="msapplication-TileColor" content="#000000">
		<meta name="msapplication-TileImage" content="{$base}icons/ms-icon-144x144.png">
		<meta name="theme-color" content="#000000">
EOF;
}





/////////////////////////////////////////////////////////////////////////
// THEME OPTIONS 
/////////////////////////////////////////////////////////////////////////

add_action('admin_init', 'ac_custom_theme_options', 9999999);

/**
 * Build the custom settings & update OptionTree.
 */
function ac_custom_theme_options()
{
	$custom_settings = $saved_settings = get_option('option_tree_settings', array());

    // Check whether we've done our additions
    $has_additions = false;
    foreach($custom_settings['sections'] as $entry)
	{
		if ($entry['id'] == 'air-craft') {
			$has_additions = true;
			break;
		}
	}
	
	$section_entry = array( 'id' => 'air-craft', 'title' => 'Air Craft');
	
	$settings_entries = array(
		array(
            'id' => 'ac-background-video-embed',
            'label' => 'BG Video Embed',
			'desc' => 'YouTube embed code for background video. Must include jsapi=1',
			'std' => '',
			'type' => 'text',
			'section' => 'air-craft',
			'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => ''
   		),
   		array(
            'id' => 'ac-mobile-video-link',
            'label' => 'Linked Video',
			'desc' => 'Link to video page for mobile (since it doesnt support autoplay)',
			'std' => '',
			'type' => 'text',
			'section' => 'air-craft',
			'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => ''
   		),
   		array(
            'id' => 'ac-public-email',
            'label' => 'Public Email',
			'desc' => 'Email contact for Launch page, etc.',
			'std' => '',
			'type' => 'text',
			'section' => 'air-craft',
			'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => ''
   		),
   	);
	
	array_unshift($custom_settings['sections'], $section_entry);
	$custom_settings['settings'] = array_merge($custom_settings['settings'], $settings_entries);
	
	// var_dump($custom_settings);
	// die();
	
	// allow settings to be filtered before saving 
    $custom_settings = apply_filters('option_tree_settings_args', $custom_settings);

    // settings are not the same update the DB 
    if ($saved_settings !== $custom_settings) {
        update_option('option_tree_settings', $custom_settings);
    }
}

