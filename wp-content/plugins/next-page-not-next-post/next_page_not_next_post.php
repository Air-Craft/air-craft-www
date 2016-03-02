<?php
/*
Plugin Name: Next Page, Not Next Post
Plugin URI: http://binarym.com/2009/next-page-not-next-post/
Description: Create next/previous navigation for pages. Adds the functions next_page_not_post() & previous_page_not_post() which link sibling pages. Now will traverse to parent & child pages.
Version: 0.3.0
Author: Matt McInvale - BinaryM Inc.
Author URI: http://binarym.com/

This is a terribly inefficient way of doing this, but it works for now. 
This should only use a single query to pull all sibling pages and then only
loop that once as well. Oh well, I'll update that as time permits. Don't hate.
*/

include('shortcodes.php');

function next_page_not_post($anchor='',$loop=NULL, $getPagesQuery='sort_column=menu_order&sort_order=asc', $prefix='', $suffix='', $css_class='npnnp next') {
	global $post;
	$getPages = '';
	
	// cousins will have a similar grandparent
	// find the grandparent
	// query the children of common grandparent
	// combine to get all cousins
	if ($loop == 'cousins' || $loop == 'cousinsloop') {
		$getPages = array();
		$ancestors = get_post_ancestors($post->ID);
		
		if (count($ancestors) > 1) {
			// grandparent is $ancestors[1]
			$pageUncle = get_pages('child_of='. $ancestors[1] . '&parent='.$ancestors[1] . '&' . $getPagesQuery);
		
			foreach ($pageUncle as $uncle) {
				$cousins = get_pages('child_of='. $uncle->ID . '&parent='.$uncle->ID . '&' . $getPagesQuery);
				$getPages = array_merge($getPages, $cousins);
				unset($cousins);
			}
		}
	} elseif ($loop != 'expand') $getPagesQuery .= '&parent='.$post->post_parent;
	
	// only query if we don't have results from cousins
	if (!is_array($getPages)) $getPages = get_pages('child_of='.$post->post_parent.'&'.$getPagesQuery);
	
	$pageCount = count($getPages);
	
	for($p=0; $p < $pageCount; $p++) {
	  	// get the array key for our entry
		if ($post->ID == $getPages[$p]->ID) break;
	}
	
	// assign our next key
	$nextKey = $p+1;
	
	// if there isn't a value assigned for the previous key, go all the way to the end
	if (isset($getPages[$nextKey])) {
		$anchorName = $getPages[$nextKey]->post_title;
		$output = '<a href="'.get_permalink($getPages[$nextKey]->ID).'" title="'.$anchorName.'" class="'.$css_class.'">';
	}
	elseif ($loop == 'expand') {
		// fixed by banesto
		// http://wordpress.org/support/topic/plugin-next-page-not-next-post-link-from-child-to-grand-parent-does-not-work
		// query parent page level, and then loop to find next entry, eke!
		// get grandparent id
		$parentInfo = get_page($post->post_parent);
	
		// query the level above's pages
		// $getParentPages = get_pages('child_of='.$parentInfo->post_parent.'&parent='.$parentInfo->post_parent.'&'.$getPagesQuery);
		$getParentPages = get_pages($getPagesQuery);

		$parentPageCount = count($getParentPages);
	
		for($pp=0; $pp < $parentPageCount; $pp++) {
	  		// get the array key for our entry
			// if ($post->post_parent == $getParentPages[$pp]->ID) break;
			if ($post->ID == $getParentPages[$pp]->ID) break;
		}
	
		// assign our next key
		$parentNextKey = $pp+1;
		
		if (isset($getParentPages[$parentNextKey])) {
			$anchorName = $getParentPages[$parentNextKey]->post_title;
			$output = '<a href="'.get_permalink($getParentPages[$parentNextKey]->ID).'" title="'.esc_attr( $anchorName ).'" class="'.$css_class.'">';
		}
	}	
	elseif (isset($loop) && ($loop != 'cousins')) {
		$anchorName = $getPages[0]->post_title;		
		$output = '<a href="'.get_permalink($getPages[0]->ID).'" title="'.esc_attr( $anchorName ).'" class="'.$css_class.'">';
	}
	
	
	// determine if we have a link and assign some anchor text
	if (!empty($output)) {
		if ($anchor == '') {
			$output .= esc_html($prefix.$anchorName.$suffix);
		} else {
			$output .= esc_html($prefix.str_replace('%title', $anchorName, $anchor).$suffix);
		}	
		$output .= '</a>';

		return $output;

	}
}

function previous_page_not_post($anchor='',$loop=NULL, $getPagesQuery='sort_column=menu_order&sort_order=asc', $prefix='', $suffix='', $css_class='npnnp previous') {
	global $post;
	
	$getPages = '';	

	// cousins will have a similar grandparent
	// find the grandparent
	// query the children of common grandparent
	// combine to get all cousins
	if ($loop == 'cousins' || $loop == 'cousinsloop') {
		$getPages = array();
		$ancestors = get_post_ancestors($post->ID);
		
		if (count($ancestors) > 1) {
			// grandparent is $ancestors[1]
			$pageUncle = get_pages('child_of='. $ancestors[1] . '&parent='.$ancestors[1] . '&' . $getPagesQuery);
		
			foreach ($pageUncle as $uncle) {
				$cousins = get_pages('child_of='. $uncle->ID . '&parent='.$uncle->ID . '&' . $getPagesQuery);
				$getPages = array_merge($getPages, $cousins);
				unset($cousins);
			}
		}
	} elseif ($loop != 'expand') $getPagesQuery .= '&parent='.$post->post_parent;
	
	// only query if we don't have results from cousins
	if (!is_array($getPages)) $getPages = get_pages('child_of='.$post->post_parent.'&'.$getPagesQuery);
	
	$pageCount = count($getPages);
	
	for($p=0; $p < $pageCount; $p++) {
	  // get the array key for our entry
		if ($post->ID == $getPages[$p]->ID) break;
	}
	
	// assign our next & previous keys
	$prevKey = $p-1;
	$lastKey = $pageCount-1;
	
	// if there isn't a value assigned for the previous key, go all the way to the end
	if (isset($getPages[$prevKey])) {
		$anchorName = $getPages[$prevKey]->post_title;
		$output = '<a href="'.get_permalink($getPages[$prevKey]->ID).'" title="'.esc_attr( $anchorName ).'" class="'.$css_class.'">';
	}
	elseif ($loop == 'expand') {
		if ($post->post_parent != 0) {
			$anchorName = get_the_title($post->post_parent);		
			$output = '<a href="'.get_permalink($post->post_parent).'" title="'.esc_attr( $anchorName ).'" class="'.$css_class.'">';
		}
	}
	elseif (isset($loop) && ($loop != 'cousins')) {
		$anchorName = $getPages[$lastKey]->post_title;		
		$output = '<a href="'.get_permalink($getPages[$lastKey]->ID).'" title="'.esc_attr( $anchorName ).'" class="'.$css_class.'">';
	} 

	$prefix = esc_html($prefix);	
	$suffix= esc_html($suffix);
	
	// determine if we have a link and assign some anchor text
	if (!empty($output)) {
		if ($anchor == '') {
			$output .=  $prefix.$anchorName.$suffix;
		} else {
			$output .= $prefix.str_replace('%title', $anchorName, $anchor).$suffix;
		}	
		
		$output .= '</a>';

	  	return $output;

	}
}

