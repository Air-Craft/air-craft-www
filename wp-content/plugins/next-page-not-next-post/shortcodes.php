<?php

	add_shortcode('next_page', 'next_page_shortcode');
	add_shortcode('previous_page', 'previous_page_shortcode');
	
	function next_page_shortcode($attributes) {
		extract(shortcode_atts(array(
			'anchor' => '',
			'loop' => NULL,
			'get_pages_query' => 'sort_column=menu_order&sort_order=asc',
			'class' => 'npnnp next',
			'prefix' => '',
			'suffix' => ''			
		), $attributes));
	
		return next_page_not_post($anchor, $loop, $get_pages_query, $prefix, $suffix, $class);
	}
	
	function previous_page_shortcode($attributes) {
		extract(shortcode_atts(array(
			'anchor' => '',
			'loop' => NULL,
			'get_pages_query' => 'sort_column=menu_order&sort_order=asc',
			'class' => 'npnnp previous',
			'prefix' => '',
			'suffix' => ''
		), $attributes));
	
		return previous_page_not_post($anchor, $loop, $get_pages_query, $prefix, $suffix, $class);
	}

