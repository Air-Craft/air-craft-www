<?php

// Site Title.  In case overwritten in morpheus/header.php user:
// <title><?php get_template_part('inc/title') ?[nospace]></title>

if (is_front_page()) {
	single_post_title( '', true );
} else {
	wp_title();
	echo ' - ';
	bloginfo('name');
}
