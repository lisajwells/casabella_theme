<?php
/*
 * Template Name: Banner
 */

// take away the page title
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// put the page title with the banner
	// add_action('genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 5);

genesis();