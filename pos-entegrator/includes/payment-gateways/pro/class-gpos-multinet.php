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
	 * Ödeme adımları için açıklama alanı
	 *
	 * @return array
	 */
	public function get_payment_steps_description() {
		return apply_filters(
			"gpos_gateway_{$this->id}_payment_steps",
			array(
				// translators: %s: Ödeme geçidi ismi.
				sprintf( __( 'When you click on the payment button, you will be directed to the %s payment form.', 'gurmepos' ), $this->title ),
				__( 'Complete your payment with your Multinet card or mobile app on the page that opens.', 'gurmepos' ),
				__( 'When the payment process is completed, the payment completed page is displayed.', 'gurmepos' ),
			)
		);
	}

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
