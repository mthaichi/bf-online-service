<?php
/**
 * Service_model 礼拝情報モデルの定義
 *
 * @package bf-online-service
 */

/**
 * Service_model class
 */
class Service_Model {

	/**
	 * ユーザー情報
	 *
	 * @var object
	 */
	public $attrbutes;

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




}
