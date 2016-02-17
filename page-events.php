<?php
/*
 * Template Name: Events
 */
/* based on template Wide, so CSS for Wide copied for Events */

//* Remove the post content (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'casabella_events_image' );
function casabella_events_image() { 

	echo '<img class="alignleft forty" src="' . esc_url( get_post_meta( get_the_ID(), 'events_image_url', true ) ).'" alt="' .  get_post_meta( get_the_ID(), 'events_image_alt', true  ).'" width="700" height="1050" />';
	echo '<h2 class="title up"><span>' .  get_post_meta( get_the_ID(), 'events_heading_2', true ).'</span></h2>';

}
add_action( 'genesis_entry_content', 'genesis_do_post_content' );


genesis();