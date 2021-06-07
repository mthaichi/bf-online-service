<?php
/**
 * Service_model 礼拝情報モデルの定義
 *
 * @package bf-online-service
 */

namespace BF_Online_Service;

/**
 * Service_model class
 */
class Service_Model {
	/**
	 * 検索クエリ
	 *
	 * @var array
	 */
	public $query = array(
		'posts_per_page' => 1,
		'post_type'      => array(
			'online_service',
		),
		'meta_key'       => 'service_date',
		'orderby'        => 'meta_value',
		'order'          => 'DESC',
	);

	/**
	 * ターゲット日付
	 *
	 * @var string
	 */
	private $target_date;

	/**
	 * 読み込まれたデータ
	 *
	 * @var object
	 */
	private $data;

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		$this->fetch();
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function fetch() {
		$posts = get_posts( $this->query );
		if ( is_array( $posts ) && count( $posts ) > 0 ) {
			$this->data = $posts[0];
		} else {
			$this->data = (object) array(
				'id'            => null,
				'service_date'  => '',
				'message_title' => 'データがありません',
				'youtube_url'   => '',
				'message_pdf'   => '',
				'shuho_pdf'     => '',
				'shuho_image_1' => '',
				'shuho_image_2' => '',
			);
		}
	}

	/**
	 * ターゲット日のセット
	 *
	 * @param string $date 日付を文字列で指定.
	 * @return void
	 */
	public function set_target_date( $date ) {
		$this->target_date = date( 'Y/m/d', strtotime( $date ) ); // phpcs:ignore
		if ( '' !== $date ) {
			$this->query['meta_query'] = array(
				'key'     => 'service_date',
				'value'   => date( 'Y/m/d', strtotime( $date ) ), // phpcs:ignore
				'compare' => '<=',
				'type'    => 'DATE',
			);
		}
	}

	/**
	 * ターゲット日の取得
	 *
	 * @return string ターゲット日(Y/m/d)
	 */
	public function get_target_date() {
		return $this->target_date;
	}

	/**
	 * データの取得
	 *
	 * @param string $key 取得したいキー.
	 * @return mixed
	 */
	public function get( $key ) {
		if ( property_exists( $this->data, $key ) ) {
			return $this->data->{$key};
		}
		return null;
	}
}
