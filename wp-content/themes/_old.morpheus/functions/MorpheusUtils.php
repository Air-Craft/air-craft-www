<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */
class MorpheusUtils
{

    public function __construct()
    {
        add_filter('post_class', array($this, 'add_portfolio_post_classes'));
        add_action('wp_ajax_get_thumbs', array($this, 'retrieve_thumb_from_id'));
        add_action('wp_ajax_nopriv_send_mail', array($this, 'send_email'));
        add_action('wp_ajax_send_mail', array($this, 'send_email'));
    }

    /*-----------------------------------------------------------------------------------*/
    /* add tag classes to the portfolio item post_class
    /*-----------------------------------------------------------------------------------*/
    public function add_portfolio_post_classes($classes)
    {
        global $post;
        $terms = wp_get_object_terms($post->ID, 'coll-portfolio-category');
        foreach ($terms as $tag) {
            $classes[] = $tag->slug;
        }
        return $classes;
    }

    public function retrieve_thumb_from_id()
    {
        global $wpdb; // this is how you get access to the database
        $id = intval($_POST['id']);
        $thumb_src = wp_get_attachment_image_src($id, 'thumbnail');
        echo $thumb_src[0];
        die(); // this is required to return a proper result
    }

    public function send_email()
    {

        if ($_POST) {
            //check if its an ajax request, exit if not
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                die();
            }
            //check $_POST vars are set, exit if any missing
            if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["message"])) {
                die();
            }

            //Sanitize input data using PHP filter_var().

            $subject = __('Contact form', 'framework'); //Subject line for emails
            $to_Email = filter_var($_POST["to_email"], FILTER_SANITIZE_EMAIL);

            $user_Name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
            $user_Email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $user_Message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

            //additional php validation
            if (strlen($user_Name) < 4) // If length is less than 4 it will throw an HTTP error.
            {
                header('HTTP/1.1 500 Name is too short or empty!');
                exit();
            }
            if (!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
            {
                header('HTTP/1.1 500 Please enter a valid email!');
                exit();
            }
            if (strlen($user_Message) < 15) //check emtpy message
            {
                header('HTTP/1.1 500 Too short message! Please enter something.');
                exit();
            }

            //proceed with PHP email.

            $headers = 'From: ' . $user_Name . ' <' . $user_Email . '>' . '' . "\n" .
                'Reply-To: ' . $user_Name . ' <' . $user_Email . '>' . '' . "\n" .
                'X-Mailer: PHP/' . phpversion();

            @$sentMail = wp_mail($to_Email, $subject, $user_Message, $headers);

            if (!$sentMail) {
                header('HTTP/1.1 500 Couldnot send mail! Sorry..');
                exit();
            } else {
                echo __('Your message has been sent. Thank you!', 'framework');
            }
        }

        die(); // this is required to return a proper result
    }


    public static function the_content($id = NULL)
    {
        if (!$id) {
            global $post;
            $id = $post->ID;
        }

        echo self::get_the_content($id);
    }


    public static function get_the_content($id = NULL)
    {
        if (!$id) {
            global $post;
            $id = $post->ID;
        }

        $post_data = get_post($id);
        $the_content = str_replace(']]>', ']]&gt>', apply_filters('the_content', $post_data->post_content));

        return $the_content;
    }

    public static function first_word($str = '')
    {
        $output = '';
        $space_pos = strpos($str, ' ');
        $before = '<span class="coll-first-word">';
        $after = '</span>';

        if ($space_pos) {
            $title = $before . $str;
            $output = substr_replace($title, $after . ' ', $space_pos + strlen($before), 1);
        } else {
            $output = $before . $str . $after;
        }

        return $output;
    }

    public static function fix_video($input)
    {
        $output = '';
        preg_match('#<iframe[^>]+src=([\'"])(.*)\1#isU', $input, $matches);
        $src = $matches[2];
        if (false !== strstr($src, 'youtube')) {
            //fix src
            if (false !== strstr($src, '?')) {
                $src .= '&enablejsapi=1&hd=1&controls=0&html5=1&showinfo=0&autoplay=1';
            } else {
                $src .= '?enablejsapi=1&hd=1&controls=0&html5=1&showinfo=0&autoplay=1';
            }
            $output .= preg_replace('#' . preg_quote($matches[2]) . '#', $src, $input);
            // add id
            $output = substr_replace($output, ' id="yt-' . rand(1, 1000) . '"', -10, -10);
        } else {
            if (false !== strstr($src, '?')) {
                $src .= '&amp;api=1';
            } else {
                $src .= '?api=1';
            }
            $output .= preg_replace('#' . preg_quote($matches[2]) . '#', $src, $input);


        }


        return $output;
    }
	public static function get_flex_sliders()
	{
		$arr = array();
		// first
		$arr[] = array(
			'label' => __('-- Choose One --', 'framework'),
			'value' => ''
		);


		$args = array(
			'post_type' => 'coll-flexslider',
			'posts_per_page' => -1
		);
		$query = new WP_Query($args);
		//print_r($query);
		if (is_array($query->posts)) {
			foreach ($query->posts as $post) {
				$arr[] = array(
					'label' => $post->post_title,
					'value' => $post->ID
				);
			}
		}

		return $arr;
	}
    public static function get_layer_sliders()
    {
        $arr = array();
        // first
        $arr[] = array(
            'label' => __('-- Choose One --', 'framework'),
            'value' => ''
        );

        // add
        if (class_exists('LS_Sliders')) {
            $sliders = LS_Sliders::find(array('limit' => 100));
            foreach ($sliders as $slider) {
                $arr[] = array(
                    'label' => $slider['name'],
                    'value' => $slider['id']
                );
            }
        }
        return $arr;
    }
}


new MorpheusUtils;