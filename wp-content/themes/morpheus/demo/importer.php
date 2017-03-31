<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

/*
|--------------------------------------------------------------------------
| Demo Importer Menu Item
|--------------------------------------------------------------------------
*/


if ( ! function_exists( 'coll_demo_importer_menu' ) ) {

	function coll_demo_importer_menu() {

		add_submenu_page( 'themes.php', 'Demos', 'Install Demo', 'manage_options', 'coll_install_demo', 'coll_build_demos_page' );

	}

	add_action( 'admin_menu', 'coll_demo_importer_menu' );
}

/*
|--------------------------------------------------------------------------
| Demo Importer Styles
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'coll_add_importer_scripts' ) ) {

	function coll_add_importer_scripts() {

		wp_enqueue_style( 'coll-importer-css', get_template_directory_uri() . '/css/importer.css', null, null );
		wp_enqueue_script( 'coll-importer-js', get_template_directory_uri() . '/js/importer.js', null, null );
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'coll_install_demo' ) {
		add_action( 'admin_enqueue_scripts', 'coll_add_importer_scripts' );
	}

}


/*
|--------------------------------------------------------------------------
| Demo Importer Interface
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'coll_build_demos_page' ) ) {

	function coll_build_demos_page() {
		?>
		<div id="coll-demos" class="wrapper">
			<h2><?php _e( 'Install Demo', 'framework' ); ?><span class="xml-count">5</span></h2>



			<?php
			$no_form = false;
			/*
			|--------------------------------------------------------------------------
			| Notifications
			|--------------------------------------------------------------------------
			*/
			if ( file_exists( ABSPATH . 'wp-content/uploads/' ) ) {

				/* wp-content upload folder not writeable  */
				if ( ! coll_is_writable( ABSPATH . 'wp-content/uploads/' ) ) :

					echo '<div class="error"><p>';

					echo '<strong>' . __( 'Your upload folder is not writeable! The importer won\'t be able to import the placeholder images. Please check the folder permissions for', 'framework' ) . '</strong><br />';
					echo ABSPATH . 'wp-content/uploads/';

					echo '</p></div>';

					$no_form = true;

				endif;


			} else {

				/* wp-content folder not writeable  */
				if ( ! coll_is_writable( ABSPATH . 'wp-content/uploads/' ) ) :

					echo '<div class="error"><p>';

					echo '<strong>' . __( 'Your wp-content folder is not writeable! The importer won\'t be able to import the placeholder images. Please check the folder permissions for', 'framework' ) . '</strong><br />';
					echo ABSPATH . 'wp-content/';

					echo '</p></div>';

					$no_form = true;

				endif;

			}

			/* some plugins need to be installed before the importer can be executed */
			if ( ! coll_is_plugin_active( 'LayerSlider/layerslider.php' ) ) :
				echo '<div class="error"><p>' . __( 'Layer Slider Plugin is not active, please install or activate it before importing the demo content.', 'framework' ) . '</p></div>';
			endif;


			/* importer has been used before */
			if ( get_option( 'coll_demo_installed' ) == 'active' &&  !isset( $_GET['coll_install_msg'] )) :
				echo '<div class="error"><p>' . __( 'You have imported demo content before.', 'framework' ) .  '</p></div>';
				$no_form = true;
			endif;

			/* import was successful */
			if ( isset( $_GET['coll_install_msg'] ) && $_GET['coll_install_msg'] == 'success' ) :
				echo '<div class="updated"><p>' . __( 'Import was successful, have fun!', 'framework' ) . '</p></div>';
				$no_form = true;
			endif;

			?>

			<?php if ( ! $no_form ) { ?>

				<form id="coll-demos-form" method="POST" action="?page=coll_install_demo" class="form-horizontal">

					<ul class="choices-container">
						<li class="choice">
							<input type="radio" id="demo0" name="coll_demo_file" value="demo0" checked
							       class="coll-choose-demo">
							<label class="img" for="demo0">
								<img src="<?php echo get_template_directory_uri(); ?>/img/demo0.jpg"/>
							</label>
							<a target="_blank"
							   href="http://themes.cubalicious.net/morpheus/"
							   class="preview button button-primary"
								><?php _e( 'Preview', 'framework' ); ?></a>
						</li>
						<li class="choice">
							<input type="radio" id="demo1" name="coll_demo_file" value="demo1" class="coll-choose-demo">
							<label class="img" for="demo1">
								<img src="<?php echo get_template_directory_uri(); ?>/img/demo1.jpg"/>
							</label>
							<a target="_blank"
							   href="http://themes.cubalicious.net/morpheus/demo1/"
							   class="preview button button-primary"
								><?php _e( 'Preview', 'framework' ); ?></a>
						</li>
						<li class="choice">
							<input type="radio" id="demo2" name="coll_demo_file" value="demo2" class="coll-choose-demo">
							<label class="img" for="demo2">
								<img src="<?php echo get_template_directory_uri(); ?>/img/demo2.jpg"/>
							</label>
							<a target="_blank"
							   href="http://themes.cubalicious.net/morpheus/demo2/"
							   class="preview button button-primary"
								><?php _e( 'Preview', 'framework' ); ?></a>
						</li>
						<li class="choice">
							<input type="radio" id="demo3" name="coll_demo_file" value="demo3" class="coll-choose-demo">
							<label class="img" for="demo3">
								<img src="<?php echo get_template_directory_uri(); ?>/img/demo3.jpg"/>
							</label>
							<a target="_blank"
							   href="http://themes.cubalicious.net/morpheus/demo3/"
							   class="preview button button-primary"
								><?php _e( 'Preview', 'framework' ); ?></a>
						</li>
						<li class="choice">
							<input type="radio" id="demo4" name="coll_demo_file" value="demo4" class="coll-choose-demo">
							<label class="img" for="demo4">
								<img src="<?php echo get_template_directory_uri(); ?>/img/demo4.jpg"/>
							</label>
							<a target="_blank"
							   href="http://themes.cubalicious.net/morpheus/demo4/"
							   class="preview button button-primary"
								><?php _e( 'Preview', 'framework' ); ?></a>
						</li>
					</ul>

					<div class="coll-info updated">
						<h3><?php _e('Important Notices : ' , 'framework'); ?></h3>
						<ol>
							<li><?php _e('We recommend to run this importer on a clean WordPress installation.' , 'framework'); ?></li>
							<li><?php _e('Please choose the demo wisely, you can only run the importer <b>once</b>.
							You will need to reset the Wordpress instalation in order to do it again. Check the Documentation for additional infromation' , 'framework'); ?></li>

						</ol>



					</div>

					<div class="coll-install-button">
						<input type="hidden" name="coll_install_demo_content" value="true"/>
						<input type="submit" value="<?php _e( 'Install', 'framework' ); ?>"
						       class="button button-primary"
						       id="submit" name="submit">
					</div>


				</form>
			<?php } ?>
		</div>

	<?php
	}
}

// Hook importer into admin init
add_action( 'admin_init', 'coll_importer' );
function coll_importer() {
	global $wpdb;


	$demos = array(
		'demo0' => array(
			'name'  => 'demo0',
			'hmenu' => 'Main Menu',
			'fmenu' => 'Footer Menu',
			'home'  => 'Home',
			'blog'  => 'Blog'
		),
		'demo1' => array(
			'name'  => 'demo1',
			'hmenu' => 'Main Menu',
			'fmenu' => 'Footer Menu',
			'home'  => 'Home',
			'blog'  => 'Blog'
		),
		'demo2' => array(
			'name'  => 'demo2',
			'hmenu' => 'Main Menu',
			'fmenu' => 'Footer Menu',
			'home'  => 'Home',
			'blog'  => ''
		),
		'demo3' => array(
			'name'  => 'demo3',
			'hmenu' => 'Main Menu',
			'fmenu' => 'Footer Menu',
			'home'  => 'Home',
			'blog'  => ''
		),
		'demo4' => array(
			'name'  => 'demo4',
			'hmenu' => 'Main Menu',
			'fmenu' => 'Footer Menu',
			'home'  => 'Home Page',
			'blog'  => 'Blog'
		)

	);

	/* add option flag to wordpress */
	add_option( 'coll_demo_installed' );

	if ( current_user_can( 'manage_options' ) && isset( $_POST['coll_install_demo_content'] ) && ! empty( $_POST['coll_demo_file'] ) ) {
		if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
			define( 'WP_LOAD_IMPORTERS', true );
		} // we are loading importers

		if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
			$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			include $wp_importer;
		}

		if ( ! class_exists( 'WP_Import' ) ) { // if WP importer doesn't exist
			$wp_import = get_template_directory() . '/demo/wordpress-importer.php';
			include $wp_import;
		}


		$demo_file         = sanitize_file_name( $_POST['coll_demo_file'] );
		$theme_xml         = get_template_directory() . '/demo/data/' . $demos[ $demo_file ]['name'] . '/morpheus.xml';
		$theme_options_txt = get_template_directory_uri() . '/demo/data/' . $demos[ $demo_file ]['name'] . '/theme_options.txt';

		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class

			$importer = new WP_Import();

			/* First Import Posts, Pages, Portfolio Content, FAQ, Images, Menus */
			//$theme_xml = get_template_directory() . '/demo/data/morpheus.xml';
			$importer->fetch_attachments = true;
			ob_start();
			$importer->import( $theme_xml );
			ob_end_clean();


			// Set imported menus to registered theme locations
			$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
			$menus     = wp_get_nav_menus(); // registered menus

			if ( $menus ) {
				foreach ( $menus as $menu ) { // assign menus to theme locations
					if ( $menu->name == $demos[ $demo_file ]['hmenu'] ) {
						$locations['primary-menu'] = $menu->term_id;
					} else if ( $menu->name == $demos[ $demo_file ]['fmenu'] ) {
						$locations['footer-menu'] = $menu->term_id;
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations

			// Import Theme Options
			//$theme_options_txt = get_template_directory_uri() . '/demo/data/theme_options.txt'; // theme options data file
			$theme_options_txt = wp_remote_get( $theme_options_txt );
			$data              = unserialize( base64_decode( $theme_options_txt['body'] ) );
			update_option( 'option_tree', $data ); // update theme options


			// Set reading options
			update_option( 'show_on_front', 'page' );
			$homepage = get_page_by_title( $demos[ $demo_file ]['home'] );
			if ( $homepage->ID ) {
				update_option( 'page_on_front', $homepage->ID ); // Front Page
			}

			$posts_page = get_page_by_title( $demos[ $demo_file ]['blog'] );
			if ( $homepage->ID && $posts_page->ID ) {
				update_option( 'page_for_posts', $posts_page->ID ); // Blog Page
			}

			// import layer slider demo sliders
			if ( coll_is_plugin_active( 'LayerSlider/layerslider.php' ) ) {
				include LS_ROOT_PATH . '/classes/class.ls.importutil.php';
				$import = new LS_ImportUtil( get_template_directory() . '/demo/data/' . $demos[ $demo_file ]['name'] . '/ls.zip' );
			}

			/*
			|--------------------------------------------------------------------------
			| Update Import Flag
			|--------------------------------------------------------------------------
			*/
			update_option( 'coll_demo_installed', 'active' );


			// finally redirect to success page
			wp_redirect( admin_url( 'themes.php?page=coll_install_demo&coll_install_msg=success' ) );
		}

	}
}

/*
|--------------------------------------------------------------------------
| Check if wp-content is writable for demo images
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'coll_is_writable' ) ) {

	function coll_is_writable( $path ) {

		if ( $path{strlen( $path ) - 1} == '/' ) {
			return coll_is_writable( $path . uniqid( mt_rand() ) . '.tmp' );
		}

		if ( file_exists( $path ) ) {
			if ( ! ( $f = @fopen( $path, 'r+' ) ) ) {
				return false;
			}
			fclose( $f );

			return true;
		}

		if ( ! ( $f = @fopen( $path, 'w' ) ) ) {
			return false;
		}
		fclose( $f );
		unlink( $path );

		return true;

	}

}
