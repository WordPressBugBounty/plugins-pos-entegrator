<?php
/**
 * GurmePOS için verileri kayıt eder.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlemi sınıfı
 */
class GPOS_Tracker {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Firebase url
	 *
	 * @var string $url
	 */
	private $url = 'https://us-central1-gurmepos.cloudfunctions.net';

	/**
	 * Gurmehub Ping API url
	 *
	 * @var string $ping_url
	 */
	private $ping_url = 'https://ping.gurmehub.com/api';

	/**
	 * Http istemcisi
	 *
	 * @var GPOS_Http_Request $http
	 */
	private $http;

	/**
	 * GPOS_Tracker kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->http = gpos_http_request();
	}

	/**
	 * Sitenin notify vs gibi callback adreslerinenin düzgün çalışıp çalışmadığını test eden servise çağrı yapar
	 *
	 * @param array $request Callback kontrol verilerini taşır
	 */
	public function get_callback_status( $request ) {
		return $this->http->request(
			"{$this->url}/checkCallBackUrls ",
			'POST',
			$request
		);
	}

	/**
	 * Kredi kartının ilk 8 hanesi ile sorgumala yaparak, kart ile iligli tip, aile, ülke bilgilerini getirir.
	 *
	 * @param string $card_bin Kartın ilk 8 hanesi.
	 */
	public function bin_retrieve( $card_bin ) {
		$card_bin = substr( preg_replace( '/\D/', '', (string) $card_bin ), 0, 8 );
		$empty    = $this->get_empty_bin_response( $card_bin );
		$ping_url = apply_filters( 'gpos_ping_api_url', $this->ping_url );

		try {
			$response = $this->http
				->set_headers( array( 'Accept' => 'application/json' ) )
				->set_timeout( 10 )
				->request( "{$ping_url}/gpos/bin?bin={$card_bin}", 'GET' );
		} catch ( Exception $e ) {
			return $empty;
		}

		// Engelleme sayfası, hata mesajı vb. beklenmeyen yanıtlarda checkout bozulmasın.
		if ( ! is_array( $response ) || ! is_array( $response['card'] ?? null ) || ! is_array( $response['bank'] ?? null ) || ! is_array( $response['country'] ?? null ) ) {
			return $empty;
		}

		return array_replace_recursive( $empty, $response );
	}

	/**
	 * BIN bilgisi alınamadığında dönülen boş yanıt.
	 *
	 * @param string $card_bin Kartın ilk 8 hanesi.
	 *
	 * @return array
	 */
	private function get_empty_bin_response( $card_bin ) {
		return [
			'country' => [
				'code' => '',
				'name' => '',
			],
			'bank'    => [
				'code' => '',
				'name' => '',
			],
			'bin'     => $card_bin,
			'card'    => [
				'type'   => '',
				'family' => '',
				'brand'  => '',
			],
		];
	}

	/**
	 * Başarılı ödeme verisi kayıt etme.
	 *
	 * @param array $data Ödeme verisi.
	 *
	 * @return void
	 */
	public function add_transaction( array $data ) {

		/**
		 * Ödeme verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "site": "gurmehub.com",
		 *      "payment_gateway": "paratika",
		 *      "payment_plugin": "woocommerce",
		 *      "total": 200,
		 *      "currency": "TRY",
		 *      "is_test": 1,
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addTransaction",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Veri.
			 */
			apply_filters( 'gpos_success_transaction_data', $data ),
		);
	}

	/**
	 * Hata mesajlarını kayıt etme.
	 *
	 * @param array $data Hata verisi.
	 *
	 * @return void
	 */
	public function add_error_message( array $data ) {

		/**
		 * Hata verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "error_code": "100001",
		 *      "error_message": "Yetersiz bakiye",
		 *      "payment_gateway": "paratika",
		 *      "is_test": 1,
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addErrorMessage",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Veri.
			 */
			apply_filters( 'gpos_error_message', $data ),
		);
	}

	/**
	 * AI dan gelen yanıt.
	 *
	 * @param string $log Log.
	 */
	public function consult_ai_assistant( $log ) {
		return $this->http->request(
			"{$this->url}/consultAIAssistant",
			'POST',
			[
				'message' => $log,
				'domain'  => home_url(),
			]
		);
	}

	/**
	 * Zamanlayıcı method.
	 * Tip olarak 'success', 'error', 'info' gönderilebilir.
	 *
	 * @param string $type Veri tipi.
	 * @param array  $data Veri.
	 *
	 * @return void
	 */
	public function schedule_event( string $type, array $data = array() ) {
		$events = array(
			'transaction' => 'add_transaction',
			'error'       => 'add_error_message',
		);

		if ( array_key_exists( $type, $events ) && defined( 'GPOS_PRODUCTION' ) && true === GPOS_PRODUCTION ) {
			wp_schedule_single_event( strtotime( '+10 Minutes' ), "{$this->prefix}_{$events[ $type ]}", array( $data ) );
		}
	}
}
