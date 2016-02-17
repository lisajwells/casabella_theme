<?php

//* Template Name: Blog Casabella

/* the top image row is in functions.php */

// take away the page title
	// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// put the page title with the banner
	// add_action('genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 5);



//* Remove the entry meta (categories) in the entry footer and reorder content

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

add_action( 'genesis_entry_footer', 'genesis_post_info', 12 );


//* add the blurb before the loop
add_action('genesis_before_content', 'casa_blog_blurb');

function casa_blog_blurb() {
    
    echo '<p id="blog-blurb">';
	echo ( get_post_meta( get_the_ID(), 'blog_blurb', true ) );
    echo '</p>';
	
}

//* The blog page loop logic is located in lib/structure/loops.php
genesis();