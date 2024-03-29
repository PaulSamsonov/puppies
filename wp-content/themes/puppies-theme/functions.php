<?php
/**
 * Puppies for Sale Today Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Puppies for Sale Today
 * @since 1.0.1
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_PUPPIES_FOR_SALE_TODAY_VERSION', '1.0.1' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	//wp_enqueue_style( 'puppies-for-sale-today-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_PUPPIES_FOR_SALE_TODAY_VERSION );
  wp_enqueue_style( 'puppies-for-sale-today-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), time() );
  wp_enqueue_script( 'puppies-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '', true );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Billing details' :
            $translated_text = __( 'Billing Address', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );
/***** Redirect add to cart to checkout page *******/
add_filter ('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');

 function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}