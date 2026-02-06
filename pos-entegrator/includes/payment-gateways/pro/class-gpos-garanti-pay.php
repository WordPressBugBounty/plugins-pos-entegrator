<?php
/**
 * Garanti Pay ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Garanti sınıfı.
 */
class GPOS_Garanti_Pay extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'garanti-pay';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Garanti Pay';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/garanti-pay.svg';

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
	public $merchant_panel = 'https://sube.garantibbva.com.tr/isube/login/login/passwordentrypersonal-tr';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD', 'GBP', 'JPY', 'RUB' );

	/**
	 * Ödeme geçidi tipi
	 *
	 * @var string $payment_method_type
	 *
	 * 'virtual_pos'|'common_form_payment'|'alternative_payment'|'bank_transfer'|'shopping_credit'
	 */
	public $payment_method_type = 'alternative_payment';

	/**
	 * Ödeme geçidi form tipi
	 *
	 * @var string $payment_form_type
	 *
	 * 'card_form'|'empty_form'
	 */
	public $payment_form_type = 'empty_form';

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() {
		return array(
			array(
				'type'  => 'text',
				'label' => 'Garanti Pay Ödeme Ekranında Gösterilecek Firma Adı',
				'model' => 'company_name',
			),
			array(
				'type'  => 'text',
				'label' => 'Garanti Pay\'e kayıtlı sunucu IP adresi',
				'model' => 'server_ip',
			),
			array(
				'type'  => 'text',
				'label' => 'Merchant K Değeri',
				'model' => 'merchant_k_value',
			),
			array(
				'type'  => 'text',
				'label' => 'Merchant KID Değeri',
				'model' => 'merchant_kid_value',
			),
		);
	}

	/**
	 * Test ödemesi için kredi kartı
	 *
	 * @return array
	 */
	public function get_test_credit_cards() {
		return array();
	}
}
