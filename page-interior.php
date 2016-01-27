<?php
/*
 * Template Name: Interior
 */

add_action( 'genesis_before_content_sidebar_wrap', 'casabella_interior_add_navpics' );
function casabella_interior_add_navpics() {

	echo '
		<div id="interior-picnav">
			<a href="'. get_home_url() .'/interior-design-massachusetts/home-interior-design"><figure class="navpic-wrapper" id="navpic-residential">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/01/a-la-carte-2.jpg" alt="Residential"/>
				<p class="interior-nav-label" id="residential-label">Residential</p>
			</figure></a>
			
			<a href="'. get_home_url() .'/interior-design-massachusetts/commercial-interior-design"><figure class="navpic-wrapper" id="navpic-commercial">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/01/a-la-carte-2.jpg" alt="Commercial"/>
				<p class="interior-nav-label" id="commercial-label">Commercial</p>
			</figure></a>

			<a href="'. get_home_url() .'/interior-design-massachusetts/interior-design-firms"><figure class="navpic-wrapper" id="navpic-construction">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/01/a-la-carte-2.jpg" alt="Construction"/>
				<p class="interior-nav-label" id="construction-label">Construction Phase</p>
			</figure></a>

			<a href="'. get_home_url() .'/interior-design-massachusetts/interior-design-services"><figure class="navpic-wrapper" id="navpic-alacarte">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/01/a-la-carte-2.jpg" alt="A la Carte"/>
				<p class="interior-nav-label" id="alacarte-label">A la Carte Services</p>
			</figure></a>
		</div>
		';
}

// don't want the page title to display on Interior Main
add_action( 'get_header', 'remove_titles_from_pages' );
function remove_titles_from_pages() {
    if ( is_page( 'interior-design-massachusetts' ) ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}



genesis();