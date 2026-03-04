<?php
/**
 * Ziraat Katılım ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Ziraat_Katilim sınıfı.
 */
class GPOS_Ziraat_Katilim extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'ziraat-katilim';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Ziraat Katılım';
	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/ziraat-katilim.svg';

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
	public $merchant_panel = 'https://vpos.ziraatkatilim.com.tr/login';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() {
		return array(
			array(
				'type'  => 'text',
				'label' => 'Corporate Code',
				'model' => 'corporate_code',
			),
			array(
				'type'  => 'text',
				'label' => 'Merchant Number', // translator: Üye İşyeri Numarası
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => 'Username',
				'model' => 'merchant_user',
			),
			array(
				'type'  => 'text',
				'label' => 'Password',
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
					'3DModel' => '3D',
					'3DPay'   => '3D Pay',
				),
				'label'   => '3D Type',
				'model'   => 'merchant_threed_type',
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
				'bin'          => '5352 4800 9724 4690',
				'expiry_year'  => '2031',
				'expiry_month' => '09',
				'cvv'          => '940',
				'secure'       => '34020 ',
			),
		);
	}
}
