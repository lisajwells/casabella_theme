<?php
/**
 * Add a slider to the home page, if there is one to add
 *
 * @link http://blackhillswebworks.com/?p=4986
 */

// take away the page title
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	add_action( 'genesis_before_content_sidebar_wrap', 'casabella_home_add_soliloquy_slider' );
	function casabella_home_add_soliloquy_slider() {
	
		if ( function_exists( 'soliloquy' ) ) { 
			
			soliloquy( '69' ); 
		} 
	}

	add_action( 'genesis_before_content_sidebar_wrap', 'casabella_home_add_tagline_image' );
	function casabella_home_add_tagline_image() { 

		echo '<div id="tagline_image"><img src="'. get_home_url() .'/wp-content/uploads/2015/12/casa_tagline.png" alt="Become Inspired" /></div>';

	}

	add_action( 'genesis_before_content', 'casabella_home_add_locations' );
	function casabella_home_add_locations() { 

		echo '<h1 id="locations">Cape Cod | Boston | New&nbsp;York</h1>';

	}

	add_action( 'genesis_after_content', 'casabella_home_add_ctas');
	function casabella_home_add_ctas() { 

		echo '<div class="sub-content">

			<a id="link-to-shop" href="'. get_home_url() .'/furniture-stores-cape-cod">
			<div class="notch-wrapper">
				<div class="inverted-corner">
				    <div class="top">&nbsp; </div>
						Visit the Shop
				    <div class="bottom"> </div>
				</div>
			</div>
			</a>

			<a id="link-to-services" href="'. get_home_url() .'/interior-design-massachusetts">
			<div class="notch-wrapper">
				<div class="inverted-corner inverted-corner-dark">
				    <div class="top">&nbsp; </div>
						Explore our Interior Design Services
				    <div class="bottom"> </div>
				</div>
			</div>
			</a>
			
		</div>';

	}

	add_action( 'genesis_before_footer', 'home_press_section');
	function home_press_section() {
		echo '<div class="section" id="home-press">
			  <p>Featured in...</p>
			  <a href="'. get_home_url() .'/interior-design-press">
			  <div class="home-press-logos" id="home-press-images_1"><img src="'. get_home_url() .'/wp-content/uploads/2015/12/press-imgs-combo-left_50_75_50.jpg" alt="Press Logos" /></div>
			  <div class="home-press-logos" id="home-press-images_2"><img src="'. get_home_url() .'/wp-content/uploads/2015/12/press-imgs-combo-right_60_60_70.jpg" alt="Press Logos" /></div>
			  </a>
	          </div> ';
	}


genesis();
