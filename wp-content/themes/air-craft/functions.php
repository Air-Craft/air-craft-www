<?php

// ENQUEUE CHILD THEME SCRIPTS
add_action( 'wp_enqueue_scripts', 'ac_enqueue_parent_styles' );
function ac_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function ac_add_theme_scripts() {
	wp_enqueue_script('youtube_iframe_api', '//www.youtube.com/iframe_api', null, null, false);
	wp_enqueue_script('ac_typekit_script', trailingslashit(get_stylesheet_directory_uri()).'js/typekit.js', null, '1.0', false);
	wp_enqueue_script('ac_autoplay_detect_script', trailingslashit(get_stylesheet_directory_uri()).'js/autoplay-detect.js', array('jquery'), '1.0', false);
	// wp_enqueue_script('ac_typekit_script');
}

add_action( 'wp_enqueue_scripts', 'ac_add_theme_scripts' );  

// REMOVE UNNECESSARY SCRIPTS
add_action('wp_print_scripts', function () {
	
	
	if (is_page_template('launch.php')) {
		// For now this is just launch
		wp_enqueue_script('ac_site', trailingslashit(get_stylesheet_directory_uri()).'js/site.js', array('jquery', 'ac_autoplay_detect_script', 'youtube_iframe_api'), '1.0', false);
		
		
		wp_dequeue_script('page.sections');
		wp_enqueue_script( 'retina' );
		//wp_enqueue_script( 'foundation' );
		wp_dequeue_script( 'scrollbar' );
		wp_dequeue_script( 'sresize' );
        wp_dequeue_script( 'mousewheel.s' );
        wp_dequeue_script( 'mousewheel' );
		wp_dequeue_script( 'comment-reply' );
		wp_dequeue_script( 'swipe' );
		wp_enqueue_script( 'sresize' );
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
		wp_dequeue_script( 'page.sections' );
		wp_dequeue_script( 'page.single' );
		wp_dequeue_script( 'page.single' );
		wp_dequeue_script( 'page.single' );
		wp_dequeue_script( 'page.single' );
		wp_dequeue_script( 'page.single' );
        wp_dequeue_script( 'custom.structure.s' );
        wp_dequeue_script( 'custom.structure' );
		
	}
});

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

