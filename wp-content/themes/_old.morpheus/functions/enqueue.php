<?php
/*

    Styles
______________________________________________________________________________________________________________
*/
if ( ! function_exists( 'coll_enqueue_admin_styles' ) ) {
	function coll_enqueue_admin_styles() {
		//wp admin css
		wp_enqueue_style( '-portboxcss', get_template_directory_uri() . '/css/portBox.css', array() );
		wp_enqueue_style( '-coll-admin-styles', get_template_directory_uri() . '/css/coll-admin.css', array() );

		$screen = get_current_screen();
		if ( $screen->id == 'coll-flexslider' ) {
			wp_enqueue_style( '-coll-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array() );
		}

		if ( $screen->id == 'coll-portfolio' ) {
			// wp admin scripts
			wp_enqueue_script( '-portboxjs', get_template_directory_uri() . '/js/portBox.min.js', array( 'jquery' ), '' );
			wp_enqueue_script( '-coll-portfolio', get_template_directory_uri() . '/js/coll-admin-portfolio.js', array( 'jquery' ), '' );
		}

		if ( $screen->id == 'coll-background' ) {
			wp_enqueue_script( '-admin-background', get_template_directory_uri() . '/js/coll-admin-background.js', array( 'jquery' ), '' );
		}

	}

	add_action( 'admin_enqueue_scripts', 'coll_enqueue_admin_styles' );

}
if ( ! function_exists( 'coll_enqueue_styles' ) ) {
	function coll_enqueue_styles() {
		global $coll_is_mobile;
		if ( ! $coll_is_mobile ) {
			wp_register_style( 'scrollbar', get_template_directory_uri() . '/css/perfect-scrollbar.css' );
			wp_enqueue_style( 'scrollbar' );
		}


		wp_register_style( 'googlefonts', '//fonts.googleapis.com/css?family=Bentham|Pinyon+Script|Bitter:400,700|Raleway:300,400,500,600|Sacramento|Lato:300,400,900|Open+Sans:400,700,800|Pacifico|Lobster|Roboto:400,900,700|Oswald:400,700' );
		wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
		wp_register_style( 'foundation', get_template_directory_uri() . '/css/foundation.css', null, null );
		wp_register_style( 'magicpopup', get_template_directory_uri() . '/css/magnific-popup.css' );
		wp_register_style( 'icons', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_register_style( 'superfish', get_template_directory_uri() . '/css/superfish.css' );
		wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', null, null );
		wp_register_style( 'plugin', get_template_directory_uri() . '/css/plugin.css', null, null );
		wp_register_style( 'public', get_template_directory_uri() . '/css/public.css', null, null );

		wp_register_style( 'morpheus', get_stylesheet_uri(), null, null );


		wp_enqueue_style( 'googlefonts' );
		wp_enqueue_style( 'foundation' );
		wp_enqueue_style( 'magicpopup' );
		wp_enqueue_style( 'icons' );
		wp_enqueue_style( 'superfish' );
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_style( 'plugin' );
		wp_enqueue_style( 'public' );
		wp_enqueue_style( 'morpheus' );

		// add custom css
		$custom_css = ot_get_option( 'coll_custom_css' );
		if ( ! empty( $custom_css ) ) {
			wp_add_inline_style( 'morpheus', $custom_css );
		}
	}

	add_action( 'wp_enqueue_scripts', 'coll_enqueue_styles' );
}
/*

   Embed javascripts
______________________________________________________________________________________________________________
*/

if ( ! function_exists( 'coll_enqueue_scripts' ) ) {
	function coll_enqueue_scripts() {
		global $coll_is_mobile;
		// script
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', '', null, false );
		wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', '', null, false );
		wp_register_script( 'jqueryui', get_template_directory_uri() . '/js/jquery-ui.min.js', '', null, true );
		wp_register_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', '', null, true );


		wp_register_script( 'sresize', get_template_directory_uri() . '/js/jquery.smartresize.js', '', null, true );
		wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', '', null, true );
		wp_register_script( 'swipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', '', null, true );
		wp_register_script( 'fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', '', null, true );
		wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', '', null, true );
		wp_register_script( 'popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', '', null, true );
		wp_register_script( 'lasyload', get_template_directory_uri() . '/js/jquery.lazyload.js', '', null, true );
		wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', '', null, true );
		wp_register_script( 'knob', get_template_directory_uri() . '/js/jquery.knob.js', '', null, true );
		wp_register_script( 'parallax', get_template_directory_uri() . '/js/skrollr.min.js', '', null, true );
		wp_register_script( 'scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.js', '', null, true );
		wp_register_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.js', '', null, true );
		wp_register_script( 'mousewheel.s', get_template_directory_uri() . '/js/jquery.mousewheel.s.js', '', null, true );
		wp_register_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.js', '', null, true );


		wp_register_script( 'shortcodes', get_template_directory_uri() . '/js/shortcodes.js', '', null, true );
		wp_register_script( 'commons', get_template_directory_uri() . '/js/common.js', '', null, true );
		wp_register_script( 'page.sections', get_template_directory_uri() . '/js/page.sections.js', '', null, true );
		wp_register_script( 'page.single', get_template_directory_uri() . '/js/page.single.js', '', null, true );
		wp_register_script( 'custom.structure', get_template_directory_uri() . '/js/custom.structure.js', '', null, true );
		wp_register_script( 'custom.structure.s', get_template_directory_uri() . '/js/custom.structure.s.js', '', null, true );


		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jqueryui' );
		wp_enqueue_script( 'retina' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'scrollbar' );
		wp_enqueue_script( 'sresize' );

		if ( ! $coll_is_mobile ) {
            if (is_safari()) {
                wp_enqueue_script( 'mousewheel.s' );
            }
			 else {
                 wp_enqueue_script( 'mousewheel' );
             }
		}


		if ( is_singular( 'post' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}


		wp_enqueue_script( 'swipe' );
		wp_enqueue_script( 'sresize' );
		wp_enqueue_script( 'superfish' );
		wp_enqueue_script( 'fitvid' );
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'popup' );
		wp_enqueue_script( 'lasyload' );
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'knob' );
		wp_enqueue_script( 'parallax' );
		wp_enqueue_script( 'countdown' );
		wp_enqueue_script( 'shortcodes' );
		wp_enqueue_script( 'commons' );

		if ( is_page_template( 'template-sectioned.php' ) ) {
			wp_enqueue_script( 'page.sections' );
		}
		if ( is_singular( 'coll-portfolio' ) ) {
			wp_enqueue_script( 'page.single' );
		}
		if ( is_singular( 'post' ) && has_post_thumbnail() ) {
			wp_enqueue_script( 'page.single' );
		}
		if ( is_page() && has_post_thumbnail() ) {
			wp_enqueue_script( 'page.single' );
		}
		if ( is_404() ) {
			wp_enqueue_script( 'page.single' );
		}

		// blog
		if ( ( is_home() || is_archive() || is_search() ) && has_post_thumbnail( get_option( 'page_for_posts' ) ) ) {
			wp_enqueue_script( 'page.single' );
		}


        if ( ! $coll_is_mobile && is_safari() ) {
            wp_enqueue_script( 'custom.structure.s' );
        } else {
            wp_enqueue_script( 'custom.structure' );
        }

	}

	add_action( 'wp_enqueue_scripts', 'coll_enqueue_scripts' );
}