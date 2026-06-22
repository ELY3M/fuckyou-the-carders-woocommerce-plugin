<? 

/**
 * Plugin Name: Fuck you the carders
 * Plugin URI: https://bmx3r.com
 * Description: 
 * Version: 1.0.0
 * Author: ELY M.
 * Author URI: https://bmx3r.com
 * License: GPL-2.0+
 * License URI: <http://www.gnu.org/licenses/gpl-2.0.txt>
 * Text Domain: fuckyou-the-carders
 * Domain Path: fuckyou-the-carders
 * Requires at least: 5.2
 * Requires PHP: 7.4
 * WC requires at least: 3.0
 * WC tested up to: 9.2
 *

https://www.denialdesign.co.uk/blocking-card-testing-attacks-in-woocommerce/ 
https://stackoverflow.com/questions/73652697/fully-disable-woocommerce-endpoints

 */


function prevent_get_request_add_cart_item( $passed, $product_id, $quantity, $variation_id = '', $variations= '' ) {

    if (isset($_GET['add-to-cart'])) {
        // show error if you want
        // 
		
		wc_add_notice('GET requests for add to cart is not allowed.', 'error');

        return false;
    }

    return $passed;

}
add_filter( 'woocommerce_add_to_cart_validation', 'prevent_get_request_add_cart_item', 10, 5 );


/** disable wc_endpoint to stop carding attacks **/
function disable_wc_endpoint_v1() {
$current_url = $_SERVER['REQUEST_URI'];
if (strpos($current_url, '/wp-json/wc/store/v1/checkout') !== false) {
wp_redirect(home_url('/404.php'));
exit;
}
}
add_action('rest_api_init', 'disable_wc_endpoint_v1');



/** disable wc_endpoint to stop carding attacks **/
function disable_wc_endpoint() {
$current_url = $_SERVER['REQUEST_URI'];
if (strpos($current_url, '/wp-json/wc/store/checkout') !== false) {
wp_redirect(home_url('/404.php'));
exit;
}
}
add_action('rest_api_init', 'disable_wc_endpoint');



/*
function redirect_forbidden_access(){
    $current_endpoint = WC()->query->get_current_endpoint();
    if($current_endpoint == "payment-methods" 
      || $current_endpoint == "add-payment-method"
      || $current_endpoint == "edit-payment-method" 
      || $current_endpoint == "checkout")
    {
        wp_redirect(wc_get_account_endpoint_url('dashboard'));
    }
}
add_action('wp', 'redirect_forbidden_access');
*/ 


?>