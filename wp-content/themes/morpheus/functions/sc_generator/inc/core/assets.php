<?php

/**
 * Class for managing plugin assets
 */
class Su_Assets {

	/**
	 * Set of queried assets
	 *
	 * @var array
	 */
	static $assets = array( 'css' => array(), 'js' => array() );

	/**
	 * Constructor
	 */
	function __construct() {
		// Register
		add_action( 'wp_head',                     array( __CLASS__, 'register' ) );
		add_action( 'admin_head',                  array( __CLASS__, 'register' ) );
		add_action( 'su/generator/preview/before', array( __CLASS__, 'register' ) );
		add_action( 'su/examples/preview/before',  array( __CLASS__, 'register' ) );
		// Enqueue
		add_action( 'wp_footer',                   array( __CLASS__, 'enqueue' ) );
		add_action( 'admin_footer',                array( __CLASS__, 'enqueue' ) );
		// Print
		add_action( 'su/generator/preview/after',  array( __CLASS__, 'prnt' ) );
		add_action( 'su/examples/preview/after',   array( __CLASS__, 'prnt' ) );
		// Custom CSS
		add_action( 'wp_footer',                   array( __CLASS__, 'custom_css' ), 99 );
		add_action( 'su/generator/preview/after',  array( __CLASS__, 'custom_css' ), 99 );
		add_action( 'su/examples/preview/after',   array( __CLASS__, 'custom_css' ), 99 );
		// Custom TinyMCE CSS and JS
		// add_filter( 'mce_css',                     array( __CLASS__, 'mce_css' ) );
		// add_filter( 'mce_external_plugins',        array( __CLASS__, 'mce_js' ) );
	}

	/**
	 * Register assets
	 */
	public static function register() {
		// Chart.js
		wp_register_script( 'chartjs', get_template_directory_uri() . '/functions/sc_generator/assets/js/chart.js', false, '0.2', true );
		// noUIslider
		wp_register_script( 'simpleslider', get_template_directory_uri() . '/functions/sc_generator/assets/js/simpleslider.js', array( 'jquery' ), '1.0.0', true );
		wp_register_style( 'simpleslider', get_template_directory_uri() . '/functions/sc_generator/assets/css/simpleslider.css', false, '1.0.0', 'all' );
		// Font Awesome
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/functions/sc_generator/assets/css/font-awesome.css', false, '3.2.1', 'all' );
		// Animate.css
		wp_register_style( 'animate', get_template_directory_uri() . '/functions/sc_generator/assets/css/animate.css', false, '1.0.0', 'all' );
		// InView
		wp_register_script( 'inview', get_template_directory_uri() . '/functions/sc_generator/assets/js/inview.js', array( 'jquery' ), '2.1.1', true );
		// qTip
		wp_register_style( 'qtip', get_template_directory_uri() . '/functions/sc_generator/assets/css/qtip.css', false, '2.1.1', 'all' );
		wp_register_script( 'qtip', get_template_directory_uri() . '/functions/sc_generator/assets/js/qtip.js', array( 'jquery' ), '2.1.1', true );
		// jsRender
		wp_register_script( 'jsrender', get_template_directory_uri() . '/functions/sc_generator/assets/js/jsrender.js', array( 'jquery' ), '1.0.0-beta', true );
		// Magnific Popup
		wp_register_style( 'magnific-popup', get_template_directory_uri() . '/functions/sc_generator/assets/css/magnific-popup.css', false, '0.9.7', 'all' );
		wp_register_script( 'magnific-popup', get_template_directory_uri() . '/functions/sc_generator/assets/js/magnific-popup.js', array( 'jquery' ), '0.9.7', true );
		// Ace
		wp_register_script( 'ace', get_template_directory_uri() . '/functions/sc_generator/assets/js/ace/ace.js', false, '1.1.01', true );
		// Swiper
		wp_register_script( 'swiper', get_template_directory_uri() . '/functions/sc_generator/assets/js/swiper.js', array( 'jquery' ), SU_PLUGIN_VERSION, true );
		// jPlayer
		wp_register_script( 'jplayer', get_template_directory_uri() . '/functions/sc_generator/assets/js/jplayer.js', array( 'jquery' ), SU_PLUGIN_VERSION, true );
		// Options page
		wp_register_style( 'su-options-page', get_template_directory_uri() . '/functions/sc_generator/assets/css/options-page.css', false, SU_PLUGIN_VERSION, 'all' );
		wp_register_script( 'su-options-page', get_template_directory_uri() . '/functions/sc_generator/assets/js/options-page.js', array( 'magnific-popup', 'jquery-ui-sortable', 'ace', 'jsrender' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-options-page', 'su_options_page', array(
				'upload_title' => __( 'Choose files', 'su' ),
				'upload_insert' => __( 'Add selected files', 'su' ),
				'not_clickable' => __( 'This button is not clickable', 'su' )
			) );
		// Generator
		wp_register_style( 'su-generator', get_template_directory_uri() . '/functions/sc_generator/assets/css/generator.css', array( 'farbtastic', 'magnific-popup' ), SU_PLUGIN_VERSION, 'all' );
		wp_register_script( 'su-generator', get_template_directory_uri() . '/functions/sc_generator/assets/js/generator.js', array( 'farbtastic', 'magnific-popup', 'qtip' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-generator', 'su_generator', array(
				'upload_title'         => __( 'Choose file', 'su' ),
				'upload_insert'        => __( 'Insert', 'su' ),
				'isp_media_title'      => __( 'Select images', 'su' ),
				'isp_media_insert'     => __( 'Add selected images', 'su' ),
				'presets_prompt_msg'   => __( 'Please enter a name for new preset', 'su' ),
				'presets_prompt_value' => __( 'New preset', 'su' )
			) );
		// Shortcodes stylesheets
		wp_register_style( 'su-content-shortcodes', self::skin_url( 'content-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-box-shortcodes', self::skin_url( 'box-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-media-shortcodes', self::skin_url( 'media-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-other-shortcodes', self::skin_url( 'other-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-galleries-shortcodes', self::skin_url( 'galleries-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-players-shortcodes', self::skin_url( 'players-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		// Shortcodes scripts
		wp_register_script( 'su-galleries-shortcodes', get_template_directory_uri() . '/functions/sc_generator/assets/js/galleries-shortcodes.js', array( 'jquery', 'swiper' ), SU_PLUGIN_VERSION, true );
		wp_register_script( 'su-players-shortcodes', get_template_directory_uri() . '/functions/sc_generator/assets/js/players-shortcodes.js', array( 'jquery', 'jplayer' ), SU_PLUGIN_VERSION, true );
		wp_register_script( 'su-other-shortcodes', get_template_directory_uri() . '/functions/sc_generator/assets/js/other-shortcodes.js', array( 'jquery' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-other-shortcodes', 'su_other_shortcodes', array( 'no_preview' => __( 'This shortcode doesn\'t work in live preview. Please insert it into editor and preview on the site.', 'su' ) ) );
		// Hook to deregister assets or add custom
		do_action( 'su/assets/register' );
	}

	/**
	 * Enqueue assets
	 */
	public static function enqueue() {
		// Get assets query and plugin object
		$assets = self::assets();
		// Enqueue stylesheets
		foreach ( $assets['css'] as $style ) wp_enqueue_style( $style );
		// Enqueue scripts
		foreach ( $assets['js'] as $script ) wp_enqueue_script( $script );
		// Hook to dequeue assets or add custom
		do_action( 'su/assets/enqueue', $assets );
	}

	/**
	 * Print assets without enqueuing
	 */
	public static function prnt() {
		// Prepare assets set
		$assets = self::assets();
		// Enqueue stylesheets
		wp_print_styles( $assets['css'] );
		// Enqueue scripts
		wp_print_scripts( $assets['js'] );
		// Hook
		do_action( 'su/assets/print', $assets );
	}

	/**
	 * Print custom CSS
	 */
	public static function custom_css() {
		// Get custom CSS and apply filters to it
		$custom_css = apply_filters( 'su/assets/custom_css', str_replace( '&#039;', '\'', html_entity_decode( (string) get_option( 'su_option_custom-css' ) ) ) );
		// Print CSS if exists
		if ( $custom_css ) echo "\n\n<!-- Shortcodes Ultimate custom CSS - begin -->\n<style type='text/css'>\n" . stripslashes( str_replace( array( '%theme_url%', '%home_url%', '%plugin_url%' ), array( trailingslashit( get_stylesheet_directory_uri() ), trailingslashit( home_url() ), trailingslashit( get_template_directory_uri() . '/functions/sc_generator/' ) ), $custom_css ) ) . "\n</style>\n<!-- Shortcodes Ultimate custom CSS - end -->\n\n";
	}

	/**
	 * Styles for visualised shortcodes
	 */
	public static function mce_css( $mce_css ) {
		if ( ! empty( $mce_css ) ) $mce_css .= ',';
		$mce_css .= get_template_directory_uri() . '/functions/sc_generator/assets/css/tinymce.css';
		return $mce_css;
	}

	/**
	 * TinyMCE plugin for visualised shortcodes
	 */
	public static function mce_js( $plugins ) {
		$plugins['shortcodesultimate'] = get_template_directory_uri() . '/functions/sc_generator/assets/js/tinymce.js';
		return $plugins;
	}

	/**
	 * Add asset to the query
	 */
	public static function add( $type, $handle ) {
		// Array with handles
		if ( is_array( $handle ) ) { foreach ( $handle as $h ) self::$assets[$type][$h] = $h; }
		// Single handle
		else self::$assets[$type][$handle] = $handle;
	}
	/**
	 * Get queried assets
	 */
	public static function assets() {
		// Get assets query
		$assets = self::$assets;
		// Apply filters to assets set
		$assets['css'] = array_unique( ( array ) apply_filters( 'su/assets/css', ( array ) array_unique( $assets['css'] ) ) );
		$assets['js'] = array_unique( ( array ) apply_filters( 'su/assets/js', ( array ) array_unique( $assets['js'] ) ) );
		// Return set
		return $assets;
	}

	/**
	 * Helper to get full URL of a skin file
	 */
	public static function skin_url( $file = '' ) {
		$shult = shortcodes_ultimate();
		$skin = get_option( 'su_option_skin' );
		$uploads = wp_upload_dir(); $uploads = $uploads['baseurl'];
		// Prepare url to skin directory
		$url = ( !$skin || $skin === 'default' ) ? get_template_directory_uri() . '/functions/sc_generator/assets/css/' : $uploads . '/shortcodes-ultimate-skins/' . $skin;
		return trailingslashit( apply_filters( 'su/assets/skin', $url ) ) . $file;
	}
}

new Su_Assets;

/**
 * Helper function to add asset to the query
 *
 * @param string  $type   Asset type (css|js)
 * @param mixed   $handle Asset handle or array with handles
 */
function su_query_asset( $type, $handle ) {
	Su_Assets::add( $type, $handle );
}

/**
 * Helper function to get current skin url
 *
 * @param string  $file Asset file name. Example value: box-shortcodes.css
 */
function su_skin_url( $file ) {
	return Su_Assets::skin_url( $file );
}
