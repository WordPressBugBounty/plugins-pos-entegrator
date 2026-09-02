<?php
/**
 * Multinet yemek kartının tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Multinet sınıfı.
 */
class GPOS_Multinet extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği.
	 *
	 * @var string $id
	 */
	public $id = 'multinet';

	/**
	 * Ödeme geçidi başlığı.
	 *
	 * @var string $title
	 */
	public $title = 'Multinet';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/multinet.png';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'refund', 'cancel', 'check_status' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://www.multinet.com.tr/';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY' );

	/**
	 * Bağlantı kontrolü yapılabiliyor mu ?
	 *
	 * @var boolean $check_connection_is_available
	 */
	public $check_connection_is_available = true;

	/**
	 * Ödeme geçidi tipi
	 *
	 * @var string $payment_method_type
	 *
	 * 'virtual_pos'|'common_form_payment'|'alternative_payment'|'bank_transfer'|'shopping_credit'
	 */
	public $payment_method_type = 'alternative_payment';

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() {
		return array(
			array(
				'type'  => 'text',
				'label' => 'App Token',
				'model' => 'app_token',
			),
			array(
				'type'  => 'text',
				'label' => 'E-Mail',
				'model' => 'email',
			),
			array(
				'type'  => 'text',
				'label' => 'Password',
				'model' => 'password',
			),
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
				'label' => 'Salt Key',
				'model' => 'salt_key',
			),
		);
	}
}
