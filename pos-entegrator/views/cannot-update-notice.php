<?php
/**
 * GurmePOS güncellenemiyor şablonu
 *
 * @package Gurmehub
 *
 * @var string $plugin_name
 */

defined( 'ABSPATH' ) || exit;

?>
<tr class="plugin-update-tr active">
	<td colspan="4">
		<div class="update-message notice inline notice-warning notice-alt">
			<p>
			<?php
			echo wp_kses_post(
				sprintf(
					// translators: Plugin name
					__( 'Please complete the update of the <strong>%s</strong> plugin\plugins first.', 'gurmepos' ),
					$plugin_name,
				),
			);
			?>
			</p>
		</div>
	</td>
</tr>
<script>
	jQuery('tr[data-slug="pos-entegrator"]').addClass('update');
</script>
