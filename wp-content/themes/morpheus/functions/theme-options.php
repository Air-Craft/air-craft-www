<?php
/**
 * Initialize the custom theme options.
 */
add_action('admin_init', 'custom_theme_options');

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options()
{
    /**
     * Get a copy of the saved settings array.
     */
    $saved_settings = get_option('option_tree_settings', array());

    /**
     * Custom settings array that will eventually be
     * passes to the OptionTree Settings API Class.
     */
    $custom_settings = array(
        'contextual_help' => array(
            'sidebar' => ''
        ),
        'sections' => array(
            array(
                'id' => 'general',
                'title' => 'General'
            ),
            array(
                'id' => 'header',
                'title' => 'Header'
            ),
            array(
                'id' => 'footer',
                'title' => 'Footer'
            ),
            array(
                'id' => 'coll_page',
                'title' => 'Page'
            ),
            array(
                'id' => 'coll_blog',
                'title' => __('Blog', 'framework')
            ),
            array(
                'id' => 'coll_styling',
                'title' => __('Styling', 'framework')
            ),
            array(
                'id' => 'coll_fonts',
                'title' => __('Fonts', 'framework')
            ),
            array(
                'id' => 'coll_typography',
                'title' => __('Typography', 'framework')
            ),
	        array(
		        'id' => 'coll_misc',
		        'title' => __('Misc', 'framework')
	        )

        ),
        'settings' => array(
            // general jump
            array(
                'id' => 'coll_preloader',
                'label' => __('Preloader', 'framework'),
                'desc' => __('Check the box to enable the Site Prealoder', 'framework'),
                'std' => '',
                'type' => 'checkbox',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'yes',
                        'label' => 'Yes'
                    )
                ),
            ),
            array(
                'id' => 'coll_preloader_color',
                'label' => __('Preloader Color', 'framework'),
                'desc' => __('Set the color of the preloader', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_preloader_bg_color',
                'label' => __('Preloader Background Color', 'framework'),
                'desc' => __('Set the color of the preloader background', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
	        array(
		        'id' => 'coll_favicon',
		        'label' => __('Favicon', 'framework'),
		        'desc' => __('Set the a site favicon', 'framework'),
		        'std' => '',
		        'type' => 'upload',
		        'section' => 'general',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),

            // header jump
            array(
                'id' => 'coll_header_fullwidth',
                'label' => 'Full Width Header',
                'desc' => 'Make the header full width',
                'std' => '',
                'type' => 'checkbox',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'yes',
                        'label' => 'Yes'
                    )
                ),
            ),
            array(
                'id' => 'coll_header_height',
                'label' => 'Header Height',
                'desc' => 'Set the height of the header',
                'std' => '50',
                'type' => 'text',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_header_background',
                'label' => 'Header Background',
                'desc' => 'Set a background for the header',
                'std' => '',
                'type' => 'background',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
	        array(
		        'id' => 'coll_header_border_color',
		        'label' => __('Header Bottom Border Color', 'framework'),
		        'desc' => __('Set the color of the bottom border of the header', 'framework'),
		        'std' => '#DEDEDE',
		        'type' => 'colorpicker',
		        'section' => 'header',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),
            array(
                'id' => 'coll_site_logo',
                'label' => 'Logo',
                'desc' => 'Upload the site\'s logo',
                'std' => '',
                'type' => 'upload',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_logo_position',
                'label' => 'Logo Position',
                'desc' => 'Choose ur logo\'s position',
                'std' => '',
                'type' => 'radio',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'coll-left',
                        'label' => 'Left',
                        'src' => ''
                    ),
                    array(
                        'value' => 'coll-center',
                        'label' => 'Center',
                        'src' => ''
                    ),
                    array(
                        'value' => 'coll-right',
                        'label' => 'Right',
                        'src' => ''
                    )
                ),
            ),
            array(
                'id' => 'coll_logo_vmargin',
                'label' => 'Logo Vertical Margin',
                'desc' => 'Set the top margin of the logo',
                'std' => '20',
                'type' => 'text',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_logo_hmargin',
                'label' => 'Logo Horizontal Margin',
                'desc' => 'Set the horizontal (left or right) margin of the logo',
                'std' => '20',
                'type' => 'text',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_menu_position',
                'label' => 'Menu Position',
                'desc' => 'Choose ur menu\'s position',
                'std' => '',
                'type' => 'radio',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'coll-left',
                        'label' => 'Left',
                        'src' => ''
                    ),
                    array(
                        'value' => 'coll-center',
                        'label' => 'Center',
                        'src' => ''
                    ),
                    array(
                        'value' => 'coll-right',
                        'label' => 'Right',
                        'src' => ''
                    )
                ),
            ),
            array(
                'id' => 'coll_menu_vmargin',
                'label' => 'Menu Vertical Margin',
                'desc' => 'Set the top margin of the menu',
                'std' => '20',
                'type' => 'text',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_menu_hmargin',
                'label' => 'Menu Horizontal Margin',
                'desc' => 'Set the horizontal (left or right) margin of the menu',
                'std' => '20',
                'type' => 'text',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_menu_color',
                'label' => __('Menu Item Color', 'framework'),
                'desc' => __('Set the color of the menu items', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_menu_hcolor',
                'label' => __('Menu Item Hover Color', 'framework'),
                'desc' => __('Set the hover color of the menu items', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_header_slide',
                'label' => 'Slide In Header',
                'desc' => 'Make the header slide in starting with the 2nd page section. aslo, this will create a static menu on the first section',
                'std' => '',
                'type' => 'checkbox',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'js-coll-header-slide',
                        'label' => 'Yes'
                    )
                ),
            ),
            array(
                'id' => 'coll_site_logo_static',
                'label' => 'Static Logo',
                'desc' => 'Upload the site\'s static logo (in case you have checked "slide in header")',
                'std' => '',
                'type' => 'upload',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_static_menu_color',
                'label' => __('Static Menu Item Color', 'framework'),
                'desc' => __('Set the color of the static menu items', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_static_menu_hcolor',
                'label' => __('Static Menu Item Hover Color', 'framework'),
                'desc' => __('Set the hover color of the static menu items', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
	        array(
		        'id' => 'coll_mobile_menu_icon',
		        'label' => __('Mobile Menu Icon Color', 'framework'),
		        'desc' => __('Set the color of the mobile menu icon', 'framework'),
		        'std' => '',
		        'type' => 'colorpicker',
		        'section' => 'header',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),
            array(
                'id' => 'coll_mobile_menu_border',
                'label' => __('Mobile Menu Divider Color', 'framework'),
                'desc' => __('Set the color for the divider between the mobile menu items', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'header',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),

            // footer jump
            array(
                'id' => 'coll_footer_background',
                'label' => 'Footer Background',
                'desc' => 'Set a background for the Footer',
                'std' => '',
                'type' => 'background',
                'section' => 'footer',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_footer_logo',
                'label' => 'Footer Logo',
                'desc' => 'Upload the site\'s footer logo',
                'std' => '',
                'type' => 'upload',
                'section' => 'footer',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
	        array(
		        'id' => 'coll_footer_border',
		        'label' => __('Footer line color', 'framework'),
		        'desc' => __('Set the color of the line above the footer text', 'framework'),
		        'std' => '',
		        'type' => 'colorpicker',
		        'section' => 'footer',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),
            array(
                'id' => 'coll_footer_text',
                'label' => 'Footer text',
                'desc' => '',
                'std' => '',
                'type' => 'textarea-simple',
                'section' => 'footer',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_footer_hmargin',
                'label' => __('Footer Horizontal Margins', 'framework'),
                'desc' => __('Set the horizontal (left and right) margin of the footer', 'framework'),
                'std' => '20',
                'type' => 'text',
                'section' => 'footer',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),

            // page
	        array(
		        'id' => 'coll_page_sidebar',
		        'label' => __('Page Sidebar', 'framework'),
		        'desc' => __('Check this if you want to have a sidebar on pages', 'framework'),
		        'std' => '',
		        'type' => 'checkbox',
		        'section' => 'coll_page',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => '',
		        'choices' => array(
			        array(
				        'value' => 'yes',
				        'label' => 'Yes',
				        'src' => ''
			        )
		        ),
	        ),

            // blog jump
            array(
                'id' => 'coll_excerpt_length',
                'label' => __('Excerpt Length', 'framework'),
                'desc' => __('Set the length in words of the excerpt', 'framework'),
                'std' => '7',
                'type' => 'text',
                'section' => 'coll_blog',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_blog_sidebar',
                'label' => __('Blog Sidebar', 'framework'),
                'desc' => __('Check this if you want to have a sidebar on the blog', 'framework'),
                'std' => '',
                'type' => 'checkbox',
                'section' => 'coll_blog',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'yes',
                        'label' => 'Yes',
                        'src' => ''
                    )
                ),
            ),

            // styling jump
            array(
                'id' => 'coll_accent_color',
                'label' => __('Site Accent Color', 'framework'),
                'desc' => __('Set global site accent color', 'framework'),
                'std' => '#7ee08e',
                'type' => 'colorpicker',
                'section' => 'coll_styling',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
	        array(
		        'id' => 'coll_custom_css',
		        'label' => __('Custom Css', 'framework'),
		        'desc' => __('Insert your custom css here.', 'framework'),
		        'std' => '',
		        'type' => 'textarea-simple',
		        'section' => 'coll_styling',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),

            // fonts jump
            array(
                'id' => 'coll_google_fonts',
                'label' => __('Google Fonts', 'framework'),
                'desc' => __('Add fonts by pasting the "Standard" embed from google fonts', 'framework'),
                'std' => '',
                'type' => 'textarea-simple',
                'section' => 'coll_fonts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),

            // typography jump
            array(
                'id' => 'coll_font_body',
                'label' => __('Body font style ', 'framework'),
                'desc' => __('Customize the boly font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_hone',
                'label' => __('H1 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_htwo',
                'label' => __('H2 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_htree',
                'label' => __('H3 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_hfour',
                'label' => __('H4 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_hfive',
                'label' => __('H5 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_hsix',
                'label' => __('H6 font style ', 'framework'),
                'desc' => __('Customize the heading font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),
            array(
                'id' => 'coll_font_menu',
                'label' => __('Menu font style ', 'framework'),
                'desc' => __('Customize the menu font', 'framework'),
                'std' => '',
                'type' => 'typography',
                'section' => 'coll_typography',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => ''
            ),

	        // misc jump
	        array(
		        'id' => 'coll_404_img',
		        'label' => __('404 Background Image', 'framework'),
		        'desc' => __('Set a background image for the 404 page', 'framework'),
		        'std' => '',
		        'type' => 'upload',
		        'section' => 'coll_misc',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),
	        array(
		        'id' => 'coll_404_text',
		        'label' => __('404 Text', 'framework'),
		        'desc' => __('Insert the text for the 404 page', 'framework'),
		        'std' => '',
		        'type' => 'textarea-simple',
		        'section' => 'coll_misc',
		        'rows' => '',
		        'post_type' => '',
		        'taxonomy' => '',
		        'min_max_step' => '',
		        'class' => ''
	        ),
        )
    );

    /* allow settings to be filtered before saving */
    $custom_settings = apply_filters('option_tree_settings_args', $custom_settings);

    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option('option_tree_settings', $custom_settings);
    }

}