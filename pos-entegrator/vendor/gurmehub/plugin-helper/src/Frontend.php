<?php // phpcs:ignore
namespace GurmeHub;

/**
 * Uygulama sınıfı
 */
class Frontend {
	/**
	 * Eklenti.
	 *
	 * @var GurmeHub\Plugin
	 */
	protected $plugin;


	/**
	 * Frontend kurucu method.
	 *
	 * @param GurmeHub\Plugin $plugin Eklenti
	 *
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Deaktif etme nedeni alma arayüzü.
	 *
	 * @return void
	 */
	public function reason_of_deactivate() {
		$plugin_name = $this->plugin->get_plugin_slug();
		?>
			<div class="gph-modal-area" id="<?php echo esc_attr( "{$plugin_name}-deactivate-reason-modal-area" ); ?>">
				<div class="gph-modal">
					<div class="gph-modal-title">
						<?php echo esc_html( sprintf( $this->texts( 'main_title' ), $this->plugin->get_name() ) ); ?>
						<p>
							<?php echo esc_html( $this->texts( 'main_description' ) ); ?>
						</p>
					</div>
					<div class="gph-modal-content">
						<p><?php echo esc_html( $this->texts( 'reasons_title' ) ); ?></p>
						<?php foreach ( $this->get_reasons() as $reason ) : ?>
						<label for="<?php echo esc_attr( "{$plugin_name}-{$reason['value']}" ); ?>">
							<input 
								type="checkbox"
								id="<?php echo esc_attr( "{$plugin_name}-{$reason['value']}" ); ?>"
								name="<?php echo esc_attr( "{$plugin_name}-deactivate-reason" ); ?>"
								value="<?php echo esc_attr( $reason['value'] ); ?>"
								data-label="<?php echo esc_attr( $reason['label'] ); ?>"
								class="<?php echo esc_attr( "{$plugin_name}-deactivate-reason-checkbox" ); ?>"
							>
							<?php echo esc_html( $reason['label'] ); ?>
						</label>
						<?php endforeach; ?>
						<label for="<?php echo esc_attr( "{$plugin_name}-reason-comment" ); ?>">
						<p><?php echo esc_html( $this->texts( 'comment_title' ) ); ?></p>
							<textarea 
								cols="30"
								id="<?php echo esc_attr( "{$plugin_name}-reason-comment" ); ?>"
							></textarea>
						</label>
					</div>
					<div class="gph-modal-footer">
						<div>
							<a href="#" id="<?php echo esc_attr( "{$plugin_name}-skip-reason" ); ?>"><?php echo esc_html( $this->texts( 'skip_button' ) ); ?></a>
						</div>
						<div>
							<button class="button" id="<?php echo esc_attr( "{$plugin_name}-cancel-modal" ); ?>"><?php echo esc_html( $this->texts( 'cancel_button' ) ); ?></button>
							<button class="button button-primary" id="<?php echo esc_attr( "{$plugin_name}-submit-reason" ); ?>"><?php echo esc_html( $this->texts( 'submit_button' ) ); ?></button>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

	/**
	 * Deaktif etme nedenleri.
	 *
	 * @return array
	 */
	private function get_reasons() {
		return apply_filters( "gph_{$this->plugin->get_basename()}_deactive_reasons", array() );
	}

	/**
	 * Deaktif etme nedenleri.
	 *
	 * @param string $button Button text.
	 *
	 * @return string
	 */
	private function texts( $button ) {
		$texts = apply_filters(
			"gph_{$this->plugin->get_basename()}_texts",
			array(
				'skip_button'      => 'Skip & Deactive',
				'submit_button'    => 'Deactive',
				'cancel_button'    => 'Cancel',
				'reasons_title'    => 'Why you are leaving us ?',
				'comment_title'    => 'Comments (Optional)',
				'main_title'       => 'No thanks, i don\'t want the %s',
				'main_description' => 'After a step, the plugin will be deactivated. Could you please take a moment and support us to make your app better?',
			)
		);

		return $texts[ $button ];
	}
}
