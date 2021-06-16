<?php
/**
 * Custom_Fields カスタムフィールドの定義
 *
 * @package bf-online-service
 */

namespace BF_Online_Service;
require_once 'custom-field-builder/custom-field-builder.php';
use VK_Custom_Field_Builder;

/**
 * Custom_Fields class
 */
class Custom_Fields_Services {
	/**
	 * Undocumented function
	 *
	 * @return array
	 */
	public static function get_fields() {
		return array(
			'service_date'  => array(
				'label'       => __( '日付', 'bf-online-service' ),
				'type'        => 'datepicker',
				'description' => __( '礼拝日付を指定してください', 'bf-online-service' ),
				'required'    => true,
			),
			'message_title' => array(
				'label'       => __( '説教題', 'bf-online-service' ),
				'type'        => 'text',
				'description' => __( '説教題を入力してください。', 'bf-online-service' ),
				'required'    => false,
			),
			'youtube_url'   => array(
				'label'       => __( 'Youtube URL', 'bf-online-service' ),
				'type'        => 'text',
				'description' => __( '埋め込みたいYoutube動画のURLを入力してください。', 'bf-online-service' ),
				'required'    => false,
			),
			'shuho_pdf'     => array(
				'label'       => __( '週報PDF', 'bf-online-service' ),
				'type'        => 'file',
				'description' => __( '週報のPDFをアップロードしてください。', 'bf-online-service' ),
				'required'    => false,
			),
			'message_pdf'   => array(
				'label'       => __( '説教要旨PDF', 'bf-online-service' ),
				'type'        => 'file',
				'description' => __( '説教要旨やレジュメなどのPDFをアップロードしてください。', 'bf-online-service' ),
				'required'    => false,
			),
			'message_mp3'   => array(
				'label'       => __( '説教音声MP3', 'bf-online-service' ),
				'type'        => 'file',
				'description' => __( '説教の音声データ（MP3形式）をアップロードしてください。', 'bf-online-service' ),
				'required'    => false,
			),
		);
	}

	/**
	 * __construct
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_metabox' ), 10, 2 );
		add_action( 'save_post', array( __CLASS__, 'save_custom_fields' ), 10, 2 );
	}

	/**
	 * 礼拝情報用のmeta boxを追加
	 *
	 * @return void
	 */
	public static function add_metabox() {
		$id            = 'meta_box_bf_online_service_services';
		$title         = __( '礼拝情報', '' );
		$callback      = array( __CLASS__, 'fields_form' );
		$screen        = 'online_service';
		$context       = 'advanced';
		$priority      = 'high';
		$callback_args = '';

		add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
	}

	/**
	 * フィームの表示
	 *
	 * @return void
	 */
	public static function fields_form() {
		global $post;

		$custom_fields = Custom_Fields_Services::get_fields();
		$before_custom_fields = '';
		VK_Custom_Field_Builder::form_table( $custom_fields, $before_custom_fields );
	}

	/**
	 * 入力値の保存
	 *
	 * @return void
	 */
	public static function save_custom_fields() {
		$custom_fields = Custom_Fields_Services::get_fields();
		VK_Custom_Field_Builder::save_cf_value( $custom_fields );
	}


}
