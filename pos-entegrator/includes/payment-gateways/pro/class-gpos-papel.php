<?php
/**
 * Papel ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Papel sınıfı.
 */
class GPOS_Papel extends GPOS_Gateway {


	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'papel';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Papel';

	/**
	 * Bağlantı kontrolü yapılabiliyor mu ?
	 *
	 * @var boolean $check_connection_is_available
	 */
	public $check_connection_is_available = true;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/papel.svg';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed', 'refund' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://papelmerchanthub.papel.com.tr/';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Client ID', 'gurmepos' ),
				'model' => 'api_client_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'API Username', 'gurmepos' ),
				'model' => 'api_username',
			),
			array(
				'type'  => 'text',
				'label' => __( 'API Password', 'gurmepos' ),
				'model' => 'api_password',
			),
		);
	}

	/**
	 * Test ödemesi için kredi kartı
	 *
	 * @return array
	 */
	public function get_test_credit_cards() {
		return array(
			array(
				'brand'        => 'mastercard',
				'type'         => 'credit',
				'bin'          => '5421 1901 2209 0656',
				'expiry_year'  => '2028',
				'expiry_month' => '04',
				'cvv'          => '916',
				'secure'       => '123456',
			),
			array(
				'brand'        => 'visa',
				'type'         => 'credit',
				'bin'          => '5421 1901 2294 4522',
				'expiry_year'  => '2025',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => '',
			),
		);
	}
}
