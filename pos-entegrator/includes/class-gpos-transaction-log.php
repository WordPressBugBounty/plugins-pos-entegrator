<?php
/**
 * GurmePOS için loglama sınıfı olan GPOS_Transaction_Log sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlem log sınıfı
 */
class GPOS_Transaction_Log {

	/**
	 * Log tablosu
	 *
	 * @var string $table_name
	 */
	private $table_name = 'gpos_transaction_log';

	/**
	 * Log tablosu ismi ile WordPress WPDB ön ekini birleştirir.
	 *
	 * @return string
	 */
	private function get_table_name() {
		global $wpdb;
		return $wpdb->prefix . $this->table_name;
	}

	/**
	 * Log kayıt etme.
	 *
	 * @param array $log_data Kayıt verileri.
	 *
	 * @return void
	 */
	public function add( $log_data ) {

		$request  = gpos_mask_log_data( $log_data['request'] );
		$response = gpos_mask_log_data( $log_data['response'] );

		global $wpdb;
		$wpdb->insert( //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
			$this->get_table_name(),
			array(
				'gateway'               => $log_data['gateway'],
				'process'               => $log_data['process'],
				'transaction_id'        => $log_data['transaction_id'],
				'plugin'                => $log_data['plugin'],
				'plugin_transaction_id' => $log_data['plugin_transaction_id'],
				'request'               => $request,
				'response'              => $response,
				'date'                  => current_time( 'mysql' ),
			)
		);
	}

	/**
	 * Log silme.
	 *
	 * @param int|string $transaction_id İşlem kimliği.
	 *
	 * @return void
	 */
	public function delete( $transaction_id ) {

		global $wpdb;
		$wpdb->delete( //phpcs:ignore
			$this->get_table_name(),
			array(
				'transaction_id' => $transaction_id,
			)
		);
	}

	/**
	 * Log kayıtlarını getirme.
	 *
	 * @param string|int $transaction_id İşlem numarası.
	 *
	 * @return array
	 */
	public function get( $transaction_id = 0 ) {
		global $wpdb;
		$table_name = $this->get_table_name();

		if ( 0 === $transaction_id ) {
			$logs = $wpdb->get_results( "SELECT * FROM `{$table_name}`" ); //phpcs:ignore 
		} else {
			$logs = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `{$table_name}` WHERE transaction_id = %s", $transaction_id ) ); //phpcs:ignore 
		}
		return array_reverse( $logs );
	}
}
