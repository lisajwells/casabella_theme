<?php
/*
 * Template Name: Bleed
 */


// take away the page title
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// put the page title like they are on banner pages
	// add_action('genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 5);


// add_action( 'genesis_before_content_sidebar_wrap', 'casa_add_title_shop_only' );
// function casa_add_title_shop_only() {
//     if ( is_page(array('furniture-stores-cape-cod') ) ) {
//         add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 5 );
//     }
// }




genesis();