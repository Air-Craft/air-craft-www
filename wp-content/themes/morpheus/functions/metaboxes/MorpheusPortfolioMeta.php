<?php


/**
 * The Class.
 */
class MorpheusPortfolioMeta
{

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    private $domain;

    public function __construct($domain)
    {

        $this->domain = $domain;

        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save'));
        add_action('save_post', array($this, 'save_tmb'));
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type)
    {
        $post_types = array('coll-portfolio'); //limit meta box to certain post types
        if (in_array($post_type, $post_types)) {
            add_meta_box(
                'coll-portfolio-thumbnail'
                , __('Thumbnail', $this->domain)
                , array($this, 'render_meta_box_content_tmb')
                , $post_type
                , 'advanced'
                , 'high'
            );
            add_meta_box(
                'coll-portfolio-assets'
                , __('Assets', $this->domain)
                , array($this, 'render_meta_box_content')
                , $post_type
                , 'advanced'
                , 'high'
            );
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save($post_id)
    {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['morpheus_inner_custom_box_nonce']))
            return $post_id;

        $nonce = $_POST['morpheus_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'morpheus_inner_custom_box'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;

        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['coll_portfolio_assets_content']);

        // Update the meta field.
        $screen = get_current_screen();
        if ($screen->id == 'coll-portfolio') update_post_meta($post_id, 'assets_content', $mydata);
    }

    public function save_tmb($post_id)
    {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['morpheus_inner_custom_box_tmb_nonce']))
            return $post_id;

        $nonce = $_POST['morpheus_inner_custom_box_tmb_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'morpheus_inner_custom_box_tmb'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;

        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['coll_portfolio_thumb']);

        // Update the meta field.
        $screen = get_current_screen();
        if ($screen->id == 'coll-portfolio') update_post_meta($post_id, 'thumb', $mydata);
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content($post)
    {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('morpheus_inner_custom_box', 'morpheus_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta($post->ID, 'assets_content', true);

        // Display the form, using the current value.
        echo '<input type="hidden" id="coll_portfolio_assets_content" name="coll_portfolio_assets_content"';
        echo 'value="' . esc_attr($value) . '" size="25" />';


        $output = '';
        $output .= '<div class="button-container">';
        $output .= '<button class="button js-coll-add-image">' . __('Add Image', $this->domain) . '</button>';
        $output .= '<button class="button" data-display="video-code" data-animationspeed="0">' . __('Add Video', $this->domain) . '</button>';
        $output .= '</div>';
        $output .= '<ul class="asset-container js-coll-assets clearfix">';
        $output .= '</ul>';


        echo $output;
    }

    public function render_meta_box_content_tmb($post)
    {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('morpheus_inner_custom_box_tmb', 'morpheus_inner_custom_box_tmb_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta($post->ID, 'thumb', true);

        // Display the form, using the current value.
        echo '<input type="hidden" id="coll_portfolio_thumb" name="coll_portfolio_thumb"';
        echo 'value="' . esc_attr($value) . '" size="25" />';


        $output = '';
        $output .= '<div class="button-container">';
        $output .= '<button class="button js-coll-add-thumb">' . __('Add Thumbnail', $this->domain) . '</button>';
        $output .= '</div>';
        $output .= '<div class="thumb-container">';
	    $img = wp_get_attachment_image_src(esc_attr($value), 'full');
        $output .= '<img class="thumb js-coll-thumb-img" src="' . $img[0] . '" alt="' . __('select a thumbnail', $this->domain) . '">';
        $output .= '</div>';


        echo $output;
    }



}