<?php // phpcs:ignore
/*
Plugin Name: BF Online Service
Plugin URI:
Description: オンライン礼拝を管理するプラグインです。
Author:BREADFISH
Author URI:http://breadfish.jp
Version: 1.0.0
*/

define( 'BF_ONLINE_SERVICE_PLUGIN_VERSION', '2.0.44' );
define( 'BF_ONLINE_SERVICE_MIN_PHP_VERSION', '5.6' );
define( 'BF_ONLINE_SERVICE_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'BF_ONLINE_SERVICE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BF_ONLINE_SERVICE_PLUGIN_FILE', __FILE__ );
define( 'BF_ONLINE_SERVICE_NAME', 'bf-online-service' );

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}


/**
 * BF_Online_Service class.
 */
class BF_Online_Service {

	/**
	 * __construct
	 */
	public function __construct() {
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/class-custom-fields-services.php';
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/custom-field-builder/custom-field-builder.php';
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/class-post-type-service.php';

		global $custom_field_builder_url;
		$custom_field_builder_url = BF_ONLINE_SERVICE_PLUGIN_URL . '/includes/custom-field-builder/';
		BF_Online_Service\Custom_Fields_Services::init();
		BF_Online_Service\Post_Type_Service::init();
	}
}

new BF_Online_Service;
