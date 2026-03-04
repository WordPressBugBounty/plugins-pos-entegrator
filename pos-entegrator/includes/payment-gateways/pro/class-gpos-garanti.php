<?php
/**
 * Garanti Pay ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Garanti sınıfı.
 */
class GPOS_Garanti extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'garanti';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Garanti';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/garanti.svg';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed', 'regular', 'refund' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://sube.garantibbva.com.tr/isube/login/login/passwordentrypersonal-tr';

	/**
	 * Sanal POS yapılandırmaları için yardım dökümanına yönlendirme
	 *
	 * @var string $help_document
	 */
	public $help_document = 'https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/garanti-bbva-sanal-pos-ayarlari/';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD', 'GBP', 'JPY', 'RUB' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() {
		return array(
			array(
				'type'  => 'text',
				'label' => 'Merchant ID',
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => 'Terminal ID',
				'model' => 'terminal_id',
			),
			array(
				'type'  => 'text',
				'label' => 'Payment User',
				'model' => 'merchant_user',
			),
			array(
				'type'  => 'text',
				'label' => 'Payment User Password',
				'model' => 'merchant_password',
			),
			array(
				'type'  => 'text',
				'label' => '3D Key',
				'model' => 'merchant_threed_store_key',
			),
			array(
				'type'    => 'select',
				'options' => array(
					'3d'     => '3D',
					'3d_pay' => '3D Pay',
				),
				'label'   => '3D Type',
				'model'   => 'merchant_threed_type',
			),
			array(
				'type'  => 'text',
				'label' => 'Refund User',
				'model' => 'refund_user',
			),
			array(
				'type'  => 'text',
				'label' => 'Refund User Password',
				'model' => 'refund_password',
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
				'brand'        => 'visa',
				'type'         => 'credit',
				'bin'          => '4282 2090 0434 8015',
				'expiry_year'  => '2030',
				'expiry_month' => '08',
				'cvv'          => '123',
				'secure'       => '',
			),
		);
	}
}
