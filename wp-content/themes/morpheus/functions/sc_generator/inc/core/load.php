<?php
class Shortcodes_Ultimate {

	/**
	 * Constructor
	 */
	function __construct() {
		add_action( 'plugins_loaded',             array( __CLASS__, 'init' ) );
		add_action( 'init',                       array( __CLASS__, 'register' ) );
		add_action( 'init',                       array( __CLASS__, 'update' ), 20 );
		register_activation_hook( SU_PLUGIN_FILE, array( __CLASS__, 'activation' ) );
		register_activation_hook( SU_PLUGIN_FILE, array( __CLASS__, 'deactivation' ) );
	}

	/**
	 * Plugin init
	 */
	public static function init() {

	}

	/**
	 * Plugin activation
	 */
	public static function activation() {
		self::timestamp();
		self::skins_dir();
		update_option( 'su_option_version', SU_PLUGIN_VERSION );
		do_action( 'su/activation' );
	}

	/**
	 * Plugin deactivation
	 */
	public static function deactivation() {
		do_action( 'su/deactivation' );
	}

	/**
	 * Plugin update hook
	 */
	public static function update() {
		$option = get_option( 'su_option_version' );
		if ( $option !== SU_PLUGIN_VERSION ) {
			update_option( 'su_option_version', SU_PLUGIN_VERSION );
			do_action( 'su/update' );
		}
	}

	/**
	 * Register shortcodes
	 */
	public static function register() {
		// Prepare compatibility mode prefix
		$prefix = su_cmpt();
		// Loop through shortcodes
		foreach ( ( array ) Su_Data::shortcodes() as $id => $data ) {
			if ( isset( $data['function'] ) && is_callable( $data['function'] ) ) $func = $data['function'];
			elseif ( is_callable( array( 'Su_Shortcodes', $id ) ) ) $func = array( 'Su_Shortcodes', $id );
			elseif ( is_callable( array( 'Su_Shortcodes', 'su_' . $id ) ) ) $func = array( 'Su_Shortcodes', 'su_' . $id );
			else continue;
			// Register shortcode
			add_shortcode( $prefix . $id, $func );
		}
		// Register [media] manually // 3.x
		add_shortcode( $prefix . 'media', array( 'Su_Shortcodes', 'media' ) );
	}

	/**
	 * Add timestamp
	 */
	public static function timestamp() {
		if ( !get_option( 'su_installed' ) ) update_option( 'su_installed', time() );
	}

	/**
	 * Create directory /wp-content/uploads/shortcodes-ultimate-skins/ on activation
	 */
	public static function skins_dir() {
		$upload_dir = wp_upload_dir();
		$path = trailingslashit( path_join( $upload_dir['basedir'], 'shortcodes-ultimate-skins' ) );
		if ( !file_exists( $path ) ) mkdir( $path, 0755 );
	}

	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=shortcodes-ultimate' ) . '#tab-0">' . __( 'Where to start?', 'su' ) . '</a>';
		return $links;
	}

	/**
	 * Add plugin meta links
	 */
	public static function meta_links( $links, $file ) {
		// Check plugin
		if ( $file === plugin_basename( SU_PLUGIN_FILE ) ) {
			unset( $links[2] );
		}
		return $links;
	}
}

/**
 * Register plugin function to perform checks that plugin is installed
 */
function shortcodes_ultimate() {
	return true;
}

new Shortcodes_Ultimate;
