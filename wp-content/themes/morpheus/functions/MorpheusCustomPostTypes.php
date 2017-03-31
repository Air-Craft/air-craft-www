<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/25/13
 * Time: 1:15 PM
 * To change this template use File | Settings | File Templates.
 */
class MorpheusCustomPostTypes
{           
    public function __construct()
    {
        self::page_sections();
        self::parallax_background();
        self::portfolio();
        self::flexslider();
        self::team();
        self::pricing_table();
        self::clients();
        self::service();
    }

    private function page_sections()
    {

        // create labels
        $labels = array(
            'name' => __('Page Sections', 'framework'),
            'singular_name' => __('Page Section', 'framework'),
            'add_new' => __('Add New', 'framework'),
            'add_new_item' => __('Add New Post type', 'framework'),
            'edit_item' => __('Edit Section', 'framework'),
            'new_item' => __('New Page Section', 'framework'),
            'all_items' => __('All Page Sections', 'framework'),
            'view_item' => __('View Section', 'framework'),
            'search_items' => __('Search Section', 'framework'),
            'not_found' => __('No Section found', 'framework'),
            'not_found_in_trash' => __('No Section found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Page Sections', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'page',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'revisions')
        );
        register_post_type('coll-page-section', $args);

    }

    private function parallax_background()
    {
        // create labels
        $labels = array(
            'name' => __('Parallax Background', 'framework'),
            'singular_name' => __('Parallax Background', 'framework'),
            'add_new' => __('Add New Background', 'framework'),
            'add_new_item' => __('Add New Background', 'framework'),
            'edit_item' => __('Edit Background', 'framework'),
            'new_item' => __('New Background', 'framework'),
            'all_items' => __('All Backgrounds', 'framework'),
            'view_item' => __('View Background', 'framework'),
            'search_items' => __('Search Backgrounds', 'framework'),
            'not_found' => __('No Background found', 'framework'),
            'not_found_in_trash' => __('No Background found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Parallax', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'parallax'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title')
        );
        register_post_type('coll-background', $args);


    }

    private function portfolio()
    {
        // create labels
        $labels = array(
            'name' => __('Portfolio', 'framework'),
            'singular_name' => __('Portfolio Item', 'framework'),
            'add_new' => __('Add New', 'framework'),
            'add_new_item' => __('Add New Portfolio Item', 'framework'),
            'edit_item' => __('Edit Portfolio Item', 'framework'),
            'new_item' => __('New Portfolio Item', 'framework'),
            'all_items' => __('All Portfolio Items', 'framework'),
            'view_item' => __('View Portfolio Item', 'framework'),
            'search_items' => __('Search Portfolio', 'framework'),
            'not_found' => __('No Portfolio Item found', 'framework'),
            'not_found_in_trash' => __('No Portfolio Item found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Portfolio', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'portfolio'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
        );
        register_post_type('coll-portfolio', $args);


        // Labels part for the GUI
        $labels = array(
            'name' => __('Categories', 'taxonomy general name', 'framework'),
            'singular_name' => __('Category', 'taxonomy singular name', 'framework'),
            'search_items' => __('Search Categories', 'framework'),
            'popular_items' => __('Popular Categories', 'framework'),
            'all_items' => __('All Categories', 'framework'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Category', 'framework'),
            'update_item' => __('Update Category', 'framework'),
            'add_new_item' => __('Add New', 'framework'),
            'new_item_name' => __('New Category Name', 'framework'),
            'separate_items_with_commas' => __('Separate Categories with commas', 'framework'),
            'add_or_remove_items' => __('Add or remove Categories', 'framework'),
            'choose_from_most_used' => __('Choose from the most used Categories', 'framework'),
            'menu_name' => __('Categories', 'framework'),
        );

        // Now register the non-hierarchical taxonomy like tag
        register_taxonomy('coll-portfolio-category', 'coll-portfolio', array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'portfolio-category'),
        ));

    }

    private function flexslider()
    {
        // create labels
        $labels = array(
            'name' => __('FlexSlider', 'framework'),
            'singular_name' => __('FlexSlider', 'framework'),
            'add_new' => __('Add New', 'framework'),
            'add_new_item' => __('Add Flex Slider', 'framework'),
            'edit_item' => __('Edit Flex Slider', 'framework'),
            'new_item' => __('New Flex Slider', 'framework'),
            'all_items' => __('All Flex Sliders', 'framework'),
            'view_item' => __('View Flex Slider', 'framework'),
            'search_items' => __('Search FlexSlider', 'framework'),
            'not_found' => __('No Flex Slider found', 'framework'),
            'not_found_in_trash' => __('No Flex Slider found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('FlexSlider', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'flexslider'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title')
        );
        register_post_type('coll-flexslider', $args);
    }

    private function team()
    {
        // create labels
        $labels = array(
            'name' => __('Team', 'framework'),
            'singular_name' => __('Team', 'framework'),
            'add_new' => __('Add New Member', 'framework'),
            'add_new_item' => __('Add Team Member', 'framework'),
            'edit_item' => __('Edit Team Member', 'framework'),
            'new_item' => __('New Team Member', 'framework'),
            'all_items' => __('All Team Members', 'framework'),
            'view_item' => __('View Team Member', 'framework'),
            'search_items' => __('Search Team Members', 'framework'),
            'not_found' => __('No Team Member found', 'framework'),
            'not_found_in_trash' => __('No Team Member found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Team', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'team'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'thumbnail', 'revisions')
        );
        register_post_type('coll-team', $args);

        // Labels part for the GUI
        $labels = array(
            'name' => __('Teams', 'framework'),
            'singular_name' => __('Team', 'framework'),
            'search_items' => __('Search Teams', 'framework'),
            'popular_items' => __('Popular Teams', 'framework'),
            'all_items' => __('All Teams', 'framework'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Team', 'framework'),
            'update_item' => __('Update Team', 'framework'),
            'add_new_item' => __('Add New', 'framework'),
            'new_item_name' => __('New Team Name', 'framework'),
            'separate_items_with_commas' => __('Separate Teams with commas', 'framework'),
            'add_or_remove_items' => __('Add or remove Teams', 'framework'),
            'choose_from_most_used' => __('Choose from the most used Teams', 'framework'),
            'menu_name' => __('Teams', 'framework'),
        );

        // Now register the non-hierarchical taxonomy like tag
        register_taxonomy('coll-team-teams', 'coll-team', array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'teams'),
        ));

    }
	private function service()
	{
		// create labels
		$labels = array(
			'name' => __('Service', 'framework'),
			'singular_name' => __('Service', 'framework'),
			'add_new' => __('Add New Service', 'framework'),
			'add_new_item' => __('Add Service', 'framework'),
			'edit_item' => __('Edit Service', 'framework'),
			'new_item' => __('New Service', 'framework'),
			'all_items' => __('All Services', 'framework'),
			'view_item' => __('View Service', 'framework'),
			'search_items' => __('Search Services', 'framework'),
			'not_found' => __('No Service found', 'framework'),
			'not_found_in_trash' => __('No Service found in Trash', 'framework'),
			'parent_item_colon' => '',
			'menu_name' => __('Services', 'framework')
		);

		// register post type
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'service'),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail', 'revisions')
		);
		register_post_type('coll-service', $args);

		// Labels part for the GUI
		$labels = array(
			'name' => __('Group', 'framework'),
			'singular_name' => __('Group', 'framework'),
			'search_items' => __('Search Groups', 'framework'),
			'popular_items' => __('Popular Groups', 'framework'),
			'all_items' => __('All Groups', 'framework'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Edit Groups', 'framework'),
			'update_item' => __('Update Groups', 'framework'),
			'add_new_item' => __('Add New', 'framework'),
			'new_item_name' => __('New Group Name', 'framework'),
			'separate_items_with_commas' => __('Separate Groups with commas', 'framework'),
			'add_or_remove_items' => __('Add or remove Groups', 'framework'),
			'choose_from_most_used' => __('Choose from the most used Groups', 'framework'),
			'menu_name' => __('Groups', 'framework'),
		);

		// Now register the non-hierarchical taxonomy like tag
		register_taxonomy('coll-service-group', 'coll-service', array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array('slug' => 'services-group'),
		));

	}

    private function pricing_table()
    {
        // create labels
        $labels = array(
            'name' => __('Pricing Table', 'framework'),
            'singular_name' => __('Option', 'framework'),
            'add_new' => __('Add New Option', 'framework'),
            'add_new_item' => __('Add Option', 'framework'),
            'edit_item' => __('Edit Option', 'framework'),
            'new_item' => __('New Option', 'framework'),
            'all_items' => __('All Options', 'framework'),
            'view_item' => __('View Option', 'framework'),
            'search_items' => __('Search Options', 'framework'),
            'not_found' => __('No Option found', 'framework'),
            'not_found_in_trash' => __('No Option found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Pricing Table', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'pricing'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'revisions')
        );
        register_post_type('coll-pricing', $args);

        // Labels part for the GUI
        $labels = array(
            'name' => __('Tables', 'framework'),
            'singular_name' => __('Table', 'framework'),
            'search_items' => __('Search Tables', 'framework'),
            'popular_items' => __('Popular Tables', 'framework'),
            'all_items' => __('All Tables', 'framework'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Table', 'framework'),
            'update_item' => __('Update Table', 'framework'),
            'add_new_item' => __('Add New', 'framework'),
            'new_item_name' => __('New Table Name', 'framework'),
            'separate_items_with_commas' => __('Separate Tables with commas', 'framework'),
            'add_or_remove_items' => __('Add or remove Tables', 'framework'),
            'choose_from_most_used' => __('Choose from the most used Tables', 'framework'),
            'menu_name' => __('Tables', 'framework'),
        );

        // Now register the non-hierarchical taxonomy like tag
        register_taxonomy('coll-pricing-table', 'coll-pricing', array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'pricing-table'),
        ));

    }
    private function clients()
    {
        // create labels
        $labels = array(
            'name' => __('Clients', 'framework'),
            'singular_name' => __('Client', 'framework'),
            'add_new' => __('Add New Client', 'framework'),
            'add_new_item' => __('Add Client', 'framework'),
            'edit_item' => __('Edit Client', 'framework'),
            'new_item' => __('New Client', 'framework'),
            'all_items' => __('All Clients', 'framework'),
            'view_item' => __('View Client', 'framework'),
            'search_items' => __('Search Clients', 'framework'),
            'not_found' => __('No Client found', 'framework'),
            'not_found_in_trash' => __('No Client found in Trash', 'framework'),
            'parent_item_colon' => '',
            'menu_name' => __('Clients', 'framework')
        );

        // register post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'clients'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'thumbnail')
        );
        register_post_type('coll-clients', $args);

        // Labels part for the GUI
        $labels = array(
            'name' => __('Group', 'framework'),
            'singular_name' => __('Group', 'framework'),
            'search_items' => __('Search Groups', 'framework'),
            'popular_items' => __('Popular Groups', 'framework'),
            'all_items' => __('All Groups', 'framework'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Group', 'framework'),
            'update_item' => __('Update Group', 'framework'),
            'add_new_item' => __('Add New', 'framework'),
            'new_item_name' => __('New Group Name', 'framework'),
            'separate_items_with_commas' => __('Separate Groups with commas', 'framework'),
            'add_or_remove_items' => __('Add or remove Groups', 'framework'),
            'choose_from_most_used' => __('Choose from the most used Groups', 'framework'),
            'menu_name' => __('Groups', 'framework'),
        );

        // Now register the non-hierarchical taxonomy like tag
        register_taxonomy('coll-clients-group', 'coll-clients', array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'clients-group'),
        ));

    }
}

new MorpheusCustomPostTypes;