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
	 * Online Service Plugin Default Options
	 *
	 * @var array
	 */
	private $def_options = array( 
		'online_service_wait_image_url' => '', 
		'title_html'                    => '%message_date% <br class="sp_br">%message_title%',
		'embed_youtube_html'            => '<iframe frameborder="0" height="450" src="%embed_url%" width="100%"></iframe>
											<a href="%url%" target="_blank" rel="noopener noreferrer">Youtubeで見る</a>',
		'wait_youtube_html'             => '<a href="javascript:location.reload();"><img class="alignnone size-full" src="%image_url%" alt="" width="100%"></a>',
		'message_pdf_html'              => '<a style="font-weight: bold; font-size: 1.3em;" href="%message_pdf%" target="_blank" rel="noopener noreferrer">%linktext%</a>',
		'shuho1_html'                   => '<a href="$pdf"><img class="alignnone size-full" style="border: 1px solid #ddd;" src="%image_url%" alt="" width="100%"></a>',
		'shuho2_html'                   => '<a href="$pdf"><img class="alignnone size-full" style="border: 1px solid #ddd;" src="%image_url%" alt="" width="100%"></a>',
		'message_mp3_html'              => '[audio mp3="%message_mp3%"][/audio]' . "\n\n" . '<a href="%message_mp3%">MP3ダウンロード</a>',
		'entry_form_html'               => '<div class="online-service-entry-box"><div class="title"><span class="online-service-entry-box-title"><span class="post-title">%title%</span> 出席報告</span></div>
											<div class="inner"><p>オンライン礼拝に参加された方は氏名を入力して「出席しました」を押してください。</p>
											<form class="os-entry-form">%name_input% %submit_button%<br>%result_message%</form></div></div>',
		'disable_embbed_youtube_html'   => '<a href="%url%" target="_blank" style="display:block; padding:120px; border:1px solid #aaa; font-weight:bold; text-align:center;">現在の時間はYoutubeからご視聴ください。<br>ここをクリックするとYoutubeに移動します。</a>',
		'online_service_backnumber_url' => '',
		'embbed_start_time'             => '12:00',
	);

	/**
	 * Service Model
	 *
	 * @var BF_Online_Service\Service_Model
	 */
	private $services;

	/**
	 * Archive mode flag
	 *
	 * @var boolean
	 */
	private $is_archive_mode = false;

	/**
	 * Plugin option name
	 *
	 * @var string
	 */
	private $option_name = 'online_service_setting';


	/**
	 * __construct
	 */
	public function __construct() {
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/class-custom-fields-services.php';
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/custom-field-builder/custom-field-builder.php';
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/class-post-type-service.php';
		require_once BF_ONLINE_SERVICE_PLUGIN_PATH . '/includes/class-service-model.php';

		$this->set_options();

		global $custom_field_builder_url;
		$custom_field_builder_url = BF_ONLINE_SERVICE_PLUGIN_URL . '/includes/custom-field-builder/';
		BF_Online_Service\Custom_Fields_Services::init();
		BF_Online_Service\Post_Type_Service::init();

		$target_date = '';
		if ( array_key_exists( 'date', $_GET ) ) {
			$this->is_archive_mode = true;
			$target_date           = $_GET['date'];
		}

		$this->services = new BF_Online_Service\Service_Model( $target_date );

	}

	/**
	 * Get options
	 *
	 * @return void
	 */
	public function set_options() {
		$this->options = get_option( $this->option_name );
		foreach ( (array) $this->options as $opt_key => $opt_val ) {
			if ( $opt_key && ! $opt_val ) {
				$this->options[ $opt_key ] = $this->def_options[ $opt_key ];
			}
		}

		foreach ( (array) $this->def_options as $opt_key => $opt_val ) {
			if ( ! array_key_exists( $opt_key, (array) $this->options ) ) {
				$this->options[ $opt_key ] = $this->def_options[ $opt_key ];
			}
		}
	}



}

new BF_Online_Service;
