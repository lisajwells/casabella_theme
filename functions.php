<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'modern-studio', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'modern-studio' ) );

//* Add Accent color to customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Modern Studio Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/modern-studio/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'ms_scripts_styles' );
function ms_scripts_styles() {

	wp_enqueue_script( 'ms-responsive-menu', esc_url( get_stylesheet_directory_uri() ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'ms-sticky-message', esc_url( get_stylesheet_directory_uri() ) . '/js/sticky-message.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic|Montserrat', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background', array(
	'default-attachment' => 'fixed',
	'default-color'      => 'ffffff',
	'default-image'      => get_stylesheet_directory_uri() . '/images/bg.png',
	'default-repeat'     => 'repeat',
	'default-position-x' => 'left',
) );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'default-image'   => get_stylesheet_directory_uri() . '/images/logo.png',
	'width'           => 600,
	'height'          => 206,
	// 'height'          => 206,
	'flex-width'      => false,
	'flex-height'     => false,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Remove style sheet from Visual Form Builder

add_filter( 'visual-form-builder-css', '__return_false' );



//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Hook sticky message before site header
add_action( 'genesis_before', 'ms_sticky_message' );
function ms_sticky_message() {

	genesis_widget_area( 'sticky-message', array(
		'before' => '<div class="sticky-message">',
		'after'  => '</div>',
	) );

}

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//* Rename menus
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Left Navigation Menu', 'modern-studio' ), 'secondary' => __( 'Right Navigation Menu', 'modern-studio' ) ) );

//* Hook menus
add_action( 'genesis_after_header', 'ms_menus_container' );
function ms_menus_container() {

	echo '<div class="navigation-container">';
	do_action( 'ms_menus' );
	echo '</div>';
	
}

//* Relocate Primary (Left) Navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'ms_menus', 'genesis_do_nav' );

//* Relocate Secondary (Right) Navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'ms_menus', 'genesis_do_subnav' );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Hook welcome message widget area before content
add_action( 'genesis_before_loop', 'ms_welcome_message' );
function ms_welcome_message() {

	if ( ! is_front_page() || get_query_var( 'paged' ) >= 2 )
		return;

	genesis_widget_area( 'welcome-message', array(
		'before' => '<div class="welcome-message widget-area">',
		'after'  => '</div>',
	) );

}

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'ms_entry_meta_header' );
function ms_entry_meta_header( $post_info ) {

	$post_info = '[post_date format="m.d.Y"] <span class="by">by</span> [post_author_posts_link] // [post_comments] [post_edit]';

	return $post_info;

}

//* Customize the entry meta in the entry footer
add_filter( 'genesis_post_meta', 'ms_entry_meta_footer' );
function ms_entry_meta_footer( $post_meta ) {

	$post_meta = '[post_categories before="Categories // "] [post_tags before="Tags // "]';

	return $post_meta;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'ms_remove_comment_form_allowed_tags' );
function ms_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'modern-studio' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	$defaults['comment_notes_after'] = '';	

	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'ms_author_box_gravatar' );
function ms_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'ms_comments_gravatar' );
function ms_comments_gravatar( $args ) {

	$args['avatar_size'] = 110;

	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Reposition the site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'genesis_do_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'modern-studio' ),
	'description' => __( 'Widgets in this section will display as a sticky message at the top of pages.', 'modern-studio' ),
) );
genesis_register_sidebar( array(
	'id'          => 'welcome-message',
	'name'        => __( 'Welcome Message', 'modern-studio' ),
	'description' => __( 'Widgets in this section will display above posts at the top of the home page.', 'modern-studio' ),
) );

//*++++++++++++ Custom for Casabella +++++++++++++*/

//* remove extra p from portfolio page content *// 

remove_filter('the_content','wpautop');

//decide when you want to apply the auto paragraph

add_filter('the_content','casa_custom_autop');

function casa_custom_autop($content){
if(is_page ('portfolio') || is_page('furniture-stores-cape-cod')) 
    return $content;//no autop
else
 return wpautop($content);
}

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Customize the footer
add_filter( 'genesis_footer_output', 'casa_custom_footer' );
function casa_custom_footer(  ) {

	echo '<section id="footer-nav">
		<div class="one-fifth">
			<a href="'. get_home_url() .'/interior-designers-boston"><h4>About</h4></a>
			<a href="'. get_home_url() .'/cape-cod-decor"><p>Why Us?</p></a>
			<a href="'. get_home_url() .'/interior-design-press"><p>Press</p></a>
			<a href="'. get_home_url() .'/interior-design-blog"><p>Style Guide</p></a>
                        <a href="'. get_home_url() .'/interior-designers-boston/about-michele-chagnon-holbrook"><p>Design Team</p></a>
                        <a href="'. get_home_url() .'/portfolio"><p>Portfolio</p></a>
		</div>

		<div class="one-fifth">
			<a href="'. get_home_url() .'/furniture-stores-cape-cod"><h4>The Shop</h4></a>
			<a href="'. get_home_url() .'/furniture-stores-cape-cod"><p>Hours</p></a>
			<a target="_blank" href="https://www.google.com/maps/dir/\'\'/389+MA-6A,+Sandwich,+MA+02537/@41.7405724,-70.4507868,17z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x89e4cb24aa70e829:0x6dac2669ff37c62f!2m2!1d-70.4485981!2d41.7405724"><p>Directions</p></a>
			<a href="'. get_home_url() .'/furniture-stores-cape-cod"><p>Product Inquiry</p></a>
		</div>

		<div class="one-fifth">
			<a href="'. get_home_url() .'/interior-design-massachusetts"><h4>Interior Design</h4></a>
			<a href="'. get_home_url() .'/interior-design-massachusetts/home-interior-design"><p>Residential</p></a>
			<a href="'. get_home_url() .'/interior-design-massachusetts/commercial-interior-design"><p>Commercial</p></a>
			<a href="'. get_home_url() .'/interior-design-massachusetts/interior-design-firms"><p>Construction Phase</p></a>
			<a href="'. get_home_url() .'/interior-design-massachusetts/interior-design-services"><p>A la Carte</p></a>
			<a href="'. get_home_url() .'/hire-us"><p>Contact Us</p></a>
		</div>

		<div class="one-fifth">
			<a href="'. get_home_url() .'/hire-us"><h4>Contact</h4></a>
			<p>389 Route 6A</p>
			<p>East Sandwich, MA 02537</p>
			<a title="Email" href="mailto:info@casabellainteriors.com" target="_blank"><p>info@casabellainteriors.com</p></a>
			<p><a href="tel:1-508-888-8688">508-888-8688</a></p>
		</div>

		<div class="one-fifth">
			<a href="'. get_home_url() .'/hire-us"><h4>Connect</h4></a>
			<a href="'. get_home_url() .'/furniture-stores-cape-cod/events"><p>Events</p></a>
			<a href="http://www.houzz.com/pro/casabellahomefurnishings/casabella-interiors" target="_blank"><p>Houzz</p></a>
			<a href="https://www.facebook.com/casabellahomefurnishingsinteriors/" target="_blank"><p>Facebook</p></a>
		</div>
		</section>

		<section id="footer-branding">
			<img src="'. get_home_url() .'/wp-content/themes/Casabella/images/Casabella-LOGO-408x124.png">
			<p><a href="#">Privacy Policy</a> | <a href="http://casabella.flywheelsites.com/sitemap">Sitemap</a></p>
			<p>Copyright Casabella Inc &copy; 2011&ndash;'. date ( 'Y' ) .'. All rights reserved.</p>
		</section>' ;

}

/* Get the banner image URL from custom field and draw that across 6 specific banner pages */
add_action('genesis_before_content_sidebar_wrap', 'casa_image_banner');

function casa_image_banner() {
    if ( is_page( array('interior-design-blog', 'interior-designers-boston', 'portfolio', 'interior-design-press', 'about-michele-chagnon-holbrook', 'cape-cod-decor' ))) {
        echo '<div class="banner">';
		echo '<img src="' . esc_url( get_post_meta( get_the_ID(), 'banner_image_url', true ) ).'"/>';
        echo '</div>';
	}
}


//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	$post_info = '[post_date] by [post_author_posts_link]';
	return $post_info;
}