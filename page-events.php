<?php
/*
 * Template Name: Events
 */
/* based on template Wide, so CSS for Wide copied for Events */

// an example of get the custom field from blog template
//* add the blurb before the loop
// add_action('genesis_before_content', 'casa_blog_blurb');

// function casa_blog_blurb() {
    
//     echo '<p id="blog-blurb">';
// 	echo ( get_post_meta( get_the_ID(), 'blog_blurb', true ) );
//     echo '</p>';
	
// }

// an example of get the custom field from functions
/* Get the banner image URL from custom field and draw that across 6 specific banner pages */
// add_action('genesis_before_content_sidebar_wrap', 'casa_image_banner');

// function casa_image_banner() {
//     if ( is_page( array('interior-design-blog', 'interior-designers-boston', 'portfolio', 'interior-design-press', 'about-michele-chagnon-holbrook', 'cape-cod-decor' ))) {
//         echo '<div class="banner">';
// 		echo '<img src="' . esc_url( get_post_meta( get_the_ID(), 'banner_image_url', true ) ).'"/>';
//         echo '</div>';
// 	}
// }

//* Remove the post content (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

	add_action( 'genesis_entry_content', 'casabella_events_image' );
	function casabella_events_image() { 

		echo '<img class="alignleft forty" src="' . esc_url( get_post_meta( get_the_ID(), 'events_image_url', true ) ).'" alt="' .  get_post_meta( get_the_ID(), 'events_image_alt', true  ).'" width="700" height="1050" />';
		echo '<h2 class="title up"><span>' .  get_post_meta( get_the_ID(), 'events_heading_2', true ).'</span></h2>';

	}
add_action( 'genesis_entry_content', 'genesis_do_post_content' );


genesis();