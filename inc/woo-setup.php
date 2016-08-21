<?php
 /** woocommerce: change position of add-to-cart on single product **/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 12 );
	

/**
 * Add navigation menu on shop 
 */
// Register Navigations
function my_custom_menus() {
   register_nav_menus(array('shop-menu' => __( 'Shop Menu' )));
}
add_action( 'init', 'my_custom_menus' );

// Display the WordPress Custom Menu if available
if ( ! function_exists( 'shapely_shop_menu' ) ) :
function shapely_shop_menu() {
  wp_nav_menu(array(
    'menu'              => 'Shop',
    'menu_id'           => 'shop-menu',
    'theme_location'    => 'shop-menu',
    'depth'             => 3,
    'container'         => 'div',
    'container_class'   => 'shop-menu',
    'menu_class'        => 'menu',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker(),
  ));
} /* end header shop menu */
endif;

/**
 * Modify parent theme
 * Tricky part : this must be called in after_setup_theme otherwise parent theme function is not loaded
 */
function tweak_parent_theme(){ 
	remove_filter('wp_nav_menu_items','shapely_woomenucart',10);
}
add_action('after_setup_theme','tweak_parent_theme');
/**
 * Place a cart icon with number of items and total cost in the menu bar.
 * This the exact copy (replace only primary by shop-menu) of the function in woo-setup.php
 */
function shapely_wooshopmenucart($menu, $args) {
	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'shop-menu' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'shapely');
		$start_shopping = __('Start shopping', 'shapely');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		//$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'shapely'), $cart_contents_count);
		$cart_contents = sprintf(_n('%d ', '%d ', $cart_contents_count, 'shapely'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="menu-item"><a class="woo-menu-cart" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="menu-item"><a class="woo-menu-cart" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-basket"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}
add_filter('wp_nav_menu_items','shapely_wooshopmenucart',10,2);
//}
//add_action('after_setup_theme','tweak_parent_theme');


?>