<?php

/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/25/13
 * Time: 1:15 PM
 * To change this template use File | Settings | File Templates.
 */
class MorpheusMetaBoxes {


	public function __construct() {
		add_action( 'admin_init', array( $this, 'init' ) );

	}

	public function init() {
		self::page();
		self::page_sections();
		self::parallax_background();
		self::portfolio();
		self::flexslider();
		self::pricing_table();
		self::clients();
	}

	private function page() {
		// custom page metaboxes
		load_template( trailingslashit( get_template_directory() ) . 'functions/metaboxes/MorpheusPageMeta.php' );
		$page = new MorpheusPageMeta( 'framework' );
	}

	private function page_sections() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_settings_meta_box',
				'title'    => 'Settings',
				'desc'     => '',
				'pages'    => array( 'coll-page-section' ),
				'context'  => 'normal',
				'priority' => '',
				'fields'   => array(
					array(
						'id'      => 'coll_full_width',
						'label'   => 'Remove Horizontal Padding',
						'desc'    => __( 'Check this if you want to remove the left and right padding, making the section have the width of the browser window', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'Yes'
							)
						),
						'class'   => ''

					),
					array(
						'id'      => 'coll_full_height',
						'label'   => 'Remove Vertical Padding',
						'desc'    => __( 'Check this if you want to remove the top and bottom padding of the section', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'Yes'
							)
						),
						'class'   => ''
					),
					array(
						'id'      => 'coll_content_height',
						'label'   => __( 'Content Height', 'framework' ),
						'desc'    => __( 'Select the type of section content height', 'framework' ),
						'std'     => 1,
						'type'    => 'radio',
						'choices' => array(
							array(
								'label' => __( 'Default : the section will be at least as high as the content, but no less the window height', 'framework' ),
								'value' => 1
							),
							array(
								'label' => __( 'Content : the section will be as high as the content (may be smaller than the window)', 'framework' ),
								'value' => 2
							),
							array(
								'label' => __( 'Window : the section will be as high as the window, regardless of the height of the content', 'framework' ),
								'value' => 3
							)
						),
						'class'   => ''
					),
					array(
						'id'      => 'coll_content_none',
						'label'   => __( 'Hide Content', 'framework' ),
						'desc'    => __( 'Check this if you want the content of the section to be hidden. <br /> <b>Recommended</b> for sections with sliders as backgrounds', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'Yes'
							)
						),
						'class'   => ''
					),
					array(
						'id'      => 'coll_hide_title',
						'label'   => 'Hide Title',
						'desc'    => __( 'Check this if you want the title of the section to be hidden', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'yes'
							)
						),
						'class'   => ''
					),
					array(
						'id'      => 'coll_subtitle',
						'label'   => 'Subtitle',
						'desc'    => __( 'Insert a subtitle', 'framework' ),
						'std'     => '',
						'type'    => 'textarea',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_title_color',
						'label'   => 'Title Color',
						'desc'    => __( 'Select the color of the title text', 'framework' ),
						'std'     => '#fff',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_subtitle_color',
						'label'   => 'Subtitle Color',
						'desc'    => __( 'Select the color of the subtitle text', 'framework' ),
						'std'     => '#fff',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_border_color',
						'label'   => 'Border Color',
						'desc'    => __( 'Select the color of the border', 'framework' ),
						'std'     => '',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					)
				)
			);

			ot_register_meta_box( $my_meta_box );

			$my_meta_box = array(

				'id'       => 'coll_bg_meta_box',
				'title'    => 'Background Settings',
				'desc'     => __( 'Choose the background color and/or image ', 'framework' ),
				'pages'    => array( 'coll-page-section' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'id'      => 'coll_bg_color',
						'label'   => 'Background Color',
						'desc'    => 'Select a background color for this section',
						'std'     => '#fff',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'        => 'coll_bg_parallax',
						'label'     => 'Parallax Background',
						'desc'      => 'Select a parallax background',
						'std'       => '',
						'type'      => 'custom-post-type-select',
						'post_type' => 'coll-background',
						'class'     => '',
						'choices'   => array()
					),
					array(
						'id'      => 'coll_bg_overlay',
						'label'   => 'Background Overlay',
						'desc'    => 'Select an overlay (pattern/color) overlay for the background',
						'std'     => '',
						'type'    => 'background',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_bg_overlay_opacity',
						'label'   => 'Background Overlay transparency',
						'desc'    => 'If a value is entered (0 < value <= 1), the background will have a transparent (set above) overlay',
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					)
				)
			);


			ot_register_meta_box( $my_meta_box );
		}
	}

	private function parallax_background() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_parallax_meta_box',
				'title'    => 'Background Settings',
				'desc'     => __( 'Setup the background', 'framework' ),
				'pages'    => array( 'coll-background' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'id'      => 'coll_bg_type',
						'label'   => __( 'Background Type', 'framework' ),
						'desc'    => __( 'Choose the background type', 'framework' ),
						'std'     => '',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'image',
								'label' => __( 'Image', 'framework' ),
							),
							array(
								'value' => 'pattern',
								'label' => __( 'Pattern', 'framework' ),
							),
							array(
								'value' => 'slider',
								'label' => __( 'Slider', 'framework' ),
							),
							array(
								'value' => 'video',
								'label' => __( 'Video', 'framework' ),
							)

						),
					),
					array(
						'id'      => 'coll_bg_img',
						'label'   => 'Background Image',
						'desc'    => 'Select a background image for this section',
						'std'     => '',
						'type'    => 'upload',
						'class'   => 'background-type-image',
						'choices' => array()
					),
					array(
						'id'      => 'coll_bg_pattern',
						'label'   => 'Background Pattern',
						'desc'    => 'Select a background pattern for this section',
						'std'     => '',
						'type'    => 'upload',
						'class'   => 'background-type-pattern',
						'choices' => array()
					),
					array(
						'id'      => 'coll_bg_slider_type',
						'label'   => __( 'Slider Type', 'framework' ),
						'desc'    => __( 'Choose the slider type', 'framework' ),
						'std'     => '',
						'type'    => 'radio',
						'class'   => 'background-type-slider',
						'choices' => array(
							array(
								'value' => 'flex',
								'label' => __( 'Flex Slider', 'framework' ),
							),
							array(
								'value' => 'layer',
								'label' => __( 'Layer Slider', 'framework' ),
							)
						),
					),
					array(
						'id'        => 'coll_bg_flexslider',
						'label'     => __( 'Flex Slider', 'framework' ),
						'desc'      => __( 'Select a flex slider', 'framework' ),
						'std'       => '',
						'type'      => 'custom-post-type-select',
						'post_type' => 'coll-flexslider',
						'class'     => 'background-type-slider slider-type-flex',
						'choices'   =>  MorpheusUtils::get_flex_sliders()
					),
					array(
						'id'        => 'coll_bg_layerslider',
						'label'     => __( 'Layer Slider', 'framework' ),
						'desc'      => __( 'Select a layer slider', 'framework' ),
						'std'       => '',
						'type'      => 'select',
						'post_type' => '',
						'class'     => 'background-type-slider slider-type-layer',
						'choices'   => MorpheusUtils::get_layer_sliders()
					),
					array(
						'id'      => 'coll_bg_video',
						'label'   => 'Background Video',
						'desc'    => __( 'Paste your youtube / vimeo iframe embed code here', 'framework' ),
						'std'     => '',
						'type'    => 'textarea',
						'class'   => 'background-type-video',
						'choices' => array()
					),
					array(
						'id'      => 'coll_bg_video_mute',
						'label'   => 'Mute Video',
						'desc'    => __( 'Check this if you want the video to be muted', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'yes'
							)
						),
						'class'   => 'background-type-video'
					),
					array(
						'id'      => 'coll_bg_video_button',
						'label'   => 'Mute Button',
						'desc'    => __( 'Check this if you want to display a mute/unmute button over the video', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'yes'
							)
						),
						'class'   => 'background-type-video'
					),
					array(
						'id'      => 'coll_bg_video_img',
						'label'   => __( 'Image replacement', 'framework' ),
						'desc'    => __( 'Select an image as a replacement for the video on mobile devices.', 'framework' ),
						'std'     => '',
						'type'    => 'upload',
						'class'   => 'background-type-video',
						'choices' => array()
					),
				)
			);


			ot_register_meta_box( $my_meta_box );
		}
	}

	private function portfolio() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_portfolio_settings',
				'title'    => __( 'Settings', 'framework' ),
				'desc'     => __( '', 'framework' ),
				'pages'    => array( 'coll-portfolio' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'id'      => 'coll_thumb_color',
						'label'   => __( 'Thumb Color', 'framework' ),
						'desc'    => __( 'Select a color for when a user hovers over the thumbnail', 'framework' ),
						'std'     => '#fff',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_thumb_hover_opacity',
						'label'   => __( 'Thumb hover opacity', 'framework' ),
						'desc'    => __( 'Set an opacity value (between 0 and 1) for the thumbnail when a user hovers over it. leave blank for full transparency', 'framework' ),
						'std'     => '0',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_client',
						'label'   => __( 'Client', 'framework' ),
						'desc'    => __( 'Insert the client name', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_role',
						'label'   => __( 'Role', 'framework' ),
						'desc'    => __( 'Insert your role', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_proj_url',
						'label'   => __( 'Project Url', 'framework' ),
						'desc'    => __( 'Insert a project url', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_open',
						'label'   => __( 'Thumbnail Open', 'framework' ),
						'desc'    => __( 'Choose what will happen when clicking the portfolio thumbnail', 'framework' ),
						'std'     => 1,
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 1,
								'label' => __( 'Single', 'framework' ),
							),
							array(
								'value' => 2,
								'label' => __( 'Url in new tab', 'framework' ),
							),
							array(
								'value' => 3,
								'label' => __( 'Lightbox on same page', 'framework' ),
							)
						),
					)

				)
			);
			ot_register_meta_box( $my_meta_box );
		}
		// custom protfolio metaboxes                             MorpheusPageMeta
		load_template( trailingslashit( get_template_directory() ) . 'functions/metaboxes/MorpheusPortfolioMeta.php' );
		$port = new MorpheusPortfolioMeta( 'framework' );
	}

	private function flexslider() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_option_settings',
				'title'    => __( 'Settings', 'framework' ),
				'desc'     => __( '', 'framework' ),
				'pages'    => array( 'coll-flexslider' ),
				'context'  => 'normal',
				'priority' => '',
				'fields'   => array(
					array(
						'id'      => 'coll_background',
						'label'   => __( 'Background', 'framework' ),
						'desc'    => __( 'Choose a color for the slider background.', 'framework' ),
						'std'     => '',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_color',
						'label'   => __( 'Color', 'framework' ),
						'desc'    => __( 'Choose a color all the elements.', 'framework' ),
						'std'     => '#bdc3c7',
						'type'    => 'colorpicker',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_slideshow',
						'label'   => __( 'Slideshow', 'framework' ),
						'desc'    => __( 'Enable/disable slideshow', 'framework' ),
						'std'     => 'true',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'true',
								'label' => __( 'Enabled', 'framework' ),
							),
							array(
								'value' => 'false',
								'label' => __( 'Disabled', 'framework' ),
							)
						),
					),
					array(
						'id'      => 'coll_arrows',
						'label'   => __( 'Show Arrows', 'framework' ),
						'desc'    => __( 'Choose when to show arrows', 'framework' ),
						'std'     => 'hover',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'hover',
								'label' => __( 'Hover', 'framework' ),
							),
							array(
								'value' => 'always',
								'label' => __( 'Always', 'framework' ),
							),
							array(
								'value' => 'never',
								'label' => __( 'Never', 'framework' ),
							)
						),
					),
					array(
						'id'      => 'coll_arrows_position',
						'label'   => __( 'Arrows Position', 'framework' ),
						'desc'    => __( 'Choose where you want the arrows', 'framework' ),
						'std'     => 'in',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'in',
								'label' => __( 'Inside the slider', 'framework' ),
							),
							array(
								'value' => 'out',
								'label' => __( 'Outside the slider', 'framework' ),
							)
						),
					),
					array(
						'id'      => 'coll_bullets',
						'label'   => __( 'Show Bullets', 'framework' ),
						'desc'    => __( 'Choose when to show bullets', 'framework' ),
						'std'     => 'always',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'always',
								'label' => __( 'Always', 'framework' ),
							),
							array(
								'value' => 'never',
								'label' => __( 'Never', 'framework' ),
							)
						),
					),
					array(
						'id'      => 'coll_captions',
						'label'   => __( 'Show Captions', 'framework' ),
						'desc'    => __( 'Choose when to show captions', 'framework' ),
						'std'     => 'always',
						'type'    => 'radio',
						'class'   => '',
						'choices' => array(
							array(
								'value' => 'always',
								'label' => __( 'Always', 'framework' ),
							),
							array(
								'value' => 'never',
								'label' => __( 'Never', 'framework' ),
							)
						),
					),
				)
			);
			ot_register_meta_box( $my_meta_box );
		}


		load_template( trailingslashit( get_template_directory() ) . 'functions/metaboxes/MorpheusFlexSliderMeta.php' );
		$port = new MorpheusFlexSliderMeta( 'framework' );
	}

	private function pricing_table() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_option_settings',
				'title'    => __( 'Settings', 'framework' ),
				'desc'     => __( '', 'framework' ),
				'pages'    => array( 'coll-pricing' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'id'      => 'coll_standout',
						'label'   => __( 'Standout', 'framework' ),
						'desc'    => __( 'Check this if you want this option to stand out', 'framework' ),
						'std'     => '',
						'type'    => 'checkbox',
						'choices' => array(
							array(
								'label' => 'Yes',
								'value' => 'Yes'
							)
						),
						'class'   => ''

					),
					array(
						'id'      => 'coll_price',
						'label'   => __( 'Price', 'framework' ),
						'desc'    => __( 'Insert the price for this option', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_link_text',
						'label'   => __( 'Purchase text', 'framework' ),
						'desc'    => __( 'Insert a text for the purchase button', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					),
					array(
						'id'      => 'coll_link_url',
						'label'   => __( 'Purchase url', 'framework' ),
						'desc'    => __( 'Insert an url for the purchase button', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					)
				)
			);
			ot_register_meta_box( $my_meta_box );
		}
	}

	private function clients() {
		if ( function_exists( 'ot_register_meta_box' ) ) {
			$my_meta_box = array(
				'id'       => 'coll_option_settings',
				'title'    => __( 'Settings', 'framework' ),
				'desc'     => __( '', 'framework' ),
				'pages'    => array( 'coll-clients' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'id'      => 'coll_link_url',
						'label'   => __( 'Client url', 'framework' ),
						'desc'    => __( 'Insert the url the client\'s website', 'framework' ),
						'std'     => '',
						'type'    => 'text',
						'class'   => '',
						'choices' => array()
					)
				)
			);
			ot_register_meta_box( $my_meta_box );
		}
	}

}

new MorpheusMetaBoxes;