<?php
/**
 * Custom_Fields カスタムフィールドの定義
 *
 * @package bf-online-service
 */

namespace BF_Online_Service;

/**
 * Custom_Fields class
 */
class Post_Type_Service {

	/**
	 * コンストラクタ
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ), 10, 2 );
	}

	/**
	 * Register post type online service
	 *
	 * @return void
	 */
	public static function register_post_type() {
		register_post_type(
			'online_service',
			array(
				'label'       => 'オンライン礼拝',
				'hierarchial' => false,
				'show_ui'     => true,
				'public'      => true,
				'query_var'   => false,
				'menu_icon'   => '',
				'supports'    => array( 'title' ),
			)
		);
	}
}
