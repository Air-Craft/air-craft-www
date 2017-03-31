<?php


/**
 * The Class.
 */
class MorpheusPageMeta
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
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function enqueue_admin_scripts()
    {
        $screen = get_current_screen();
        if ($screen->id == 'page') {
            // wp admin scripts
            wp_enqueue_script('morpheus-coll-page', get_template_directory_uri() . '/js/coll-admin-page.js', array('jquery'), '');
        }
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type)
    {
        $post_types = array('page'); //limit meta box to certain post types
        if (in_array($post_type, $post_types)) {
            add_meta_box(
                'coll-page-sections'
                , __('Page Sections', $this->domain)
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
        $mydata = sanitize_text_field($_POST['coll_page_sections_content']);

        // Update the meta field.
        $screen = get_current_screen();
        if ($screen->id == 'page') update_post_meta($post_id, 'sections_content', $mydata);
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
        $value = get_post_meta($post->ID, 'sections_content', true);

        // Display the form, using the current value.
        echo '<input type="hidden" id="coll_page_sections_content" name="coll_page_sections_content"';
        echo 'value="' . esc_attr($value) . '" size="25" />';


        $output = '';
        $output .= '<div class="button-container">';
        $output .= '<select name="section_select" id="coll_select_section">';
        $output .= '<option value >' . __('Add Section', $this->domain) . '</option>';

        // get sections
        $args = array('post_type' => 'coll-page-section', 'posts_per_page' => -1);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
            global $post;
            $output .= ' <option value="' . $post->post_name . '">' . $post->post_title . '</option> ';
        endwhile;
        // end get sections
        $output .= '</select>';
        $output .= '</div>';
        $output .= '<ul class="section-container js-coll-sections clearfix">';
        $output .= '</ul>';

        wp_reset_postdata();


        echo $output;
    }
}