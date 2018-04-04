<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Woo_Razorpay
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	throw new Exception( "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/woo-razorpay.php';
    require dirname( __FILE__ ) . '/factory/order-factory.php';
    require dirname( __FILE__ ) . '/factory/coupon-factory.php';
    require dirname( __FILE__ ) . '/factory/product-factory.php';
    require dirname( __FILE__ ) . '/mock/razorpay-sdk/Razorpay.php';

    require dirname( dirname( __FILE__ ) ) . '/wp-content/plugins/woocommerce/woocommerce.php';

}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';