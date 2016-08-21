<?php
require get_stylesheet_directory() . '/inc/woo-setup.php';
require get_stylesheet_directory() . '/inc/extras.php';

function tweak_parent_theme2(){ 
	//remove_filter('wp_nav_menu_items','shapely_woomenucart',10);
	remove_action( 'wp_enqueue_scripts', 'shapely_scripts' );
}
add_action('after_setup_theme','tweak_parent_theme2');
/** remove style and style from parent theme, load theme again adding child styles **/
//remove_action( 'wp_enqueue_scripts', 'shapely_scripts' );
function shapelychild_scripts() {
	
// Add Bootstrap default CSS
    wp_enqueue_style( 'shapely-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

    // Add Font Awesome stylesheet
    wp_enqueue_style( 'shapely-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

    // Add Google Fonts
    wp_enqueue_style( 'shapely-fonts', '//fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700%7COpen+Sans:400,500,600');


    // Add slider CSS only if is front page ans slider is enabled
    if( ( is_home() || is_front_page() ) ) {
      wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
    }

    //Add custom theme css
    wp_enqueue_style( 'shapely-style', get_template_directory_uri() . '/style.css'); //--- 1st modification vs shapely theme ---
		wp_enqueue_script( 'shapely-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
		wp_enqueue_script( 'shapely-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160115', true );
	
	// --- 2nd modification : Add child style ---
	wp_enqueue_style( 'child-style', get_stylesheet_uri());
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    if( post_type_exists( 'jetpack-portfolio' ) ){
    	 wp_enqueue_script( 'jquery-masonry' );
    	}

    if (post_type_exists( 'jetpack-portfolio' ) ) {
			wp_enqueue_script( 'jquery-masonry', array( 'jquery' ), '20160115', true );

    }
    
    // Add slider JS only if is front page ans slider is enabled
    if( ( is_home() || is_front_page() ) ) {
      wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/flexslider.min.js', array('jquery'), '20160222', true );
    }

    wp_enqueue_script( 'shapely-scroll', get_template_directory_uri() . '/js/smooth-scroll.min.js', array('jquery'), '20160115', true );

    if ( is_page_template( 'template-home.php' ) ) {
        wp_enqueue_script( 'shapely-parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), '20160115', true );
    }
	
	// tweak parent theme with js
    wp_enqueue_script( 'shapely-scripts', get_stylesheet_directory_uri() . '/js/shapely-scripts.js', array('jquery'), '20160115', true );
	
}
add_action( 'wp_enqueue_scripts', 'shapelychild_scripts' );

?>


