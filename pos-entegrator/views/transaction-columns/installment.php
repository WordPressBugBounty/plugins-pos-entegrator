<?php
/**
 * İşlem taksit kolonu
 *
 * @var GPOS_Transaction $transaction
 *
 * @package Gurmehub
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="transaction-installment">
	<span><?php echo esc_html( $transaction->get_installment() ); ?></span>
</div>
