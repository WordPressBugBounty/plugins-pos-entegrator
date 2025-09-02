<?php // phpcs:ignore
namespace GurmeHub;

/**
 * Uygulama sınıfı
 */
class Insights extends \GurmeHub\Api {

	/**
	 * Eklenti tanımlayıcı sınıf
	 *
	 * @var \GurmeHub\Plugin $plugin
	 */
	public $plugin;

	/**
	 * Kurucu method.
	 *
	 * @param \GurmeHub\Plugin $plugin  Eklenti tanımlayıcı sınıf.
	 *
	 * @return void
	 */
	public function __construct( \GurmeHub\Plugin $plugin ) {
		$this->plugin = $plugin;
		add_filter( 'plugin_action_links_' . $this->plugin->get_basename(), array( $this, 'plugin_action_links' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'wp_ajax_' . $this->plugin->get_plugin_slug() . '_deactivate_reasons', array( $this, 'deactivate_reasons' ), 10, 2 );
	}

	/**
	 * Eklenti aksiyon linkleri
	 *
	 * @param array $links Aksiyon linkleri.
	 *
	 * @return array $links Aksiyon linkleri.
	 */
	public function plugin_action_links( $links ) {
		if ( array_key_exists( 'deactivate', $links ) ) {
			$links['deactivate'] = str_replace( '<a', '<a class="gurmehub-deactivate-reason" data-attr-plugin-name="' . $this->plugin->get_plugin_slug() . '"', $links['deactivate'] );
		}

		return $links;
	}

	/**
	 * Admin footer aksiyonları.
	 */
	public function admin_footer() {
		global $pagenow;

		if ( 'plugins.php' === $pagenow ) {

			wp_enqueue_style(
				'gurmehub-plugin-helper-deactivate',
				plugin_dir_url( $this->plugin->get_basefile() ) . 'vendor/gurmehub/plugin-helper/src/asset/deactive.css',
				array(),
				$this->plugin->get_current_version()
			);

			wp_enqueue_script(
				'gurmehub-plugin-helper-deactivate',
				plugin_dir_url( $this->plugin->get_basefile() ) . 'vendor/gurmehub/plugin-helper/src/asset/deactive.js',
				array( 'jquery' ),
				$this->plugin->get_current_version(),
				true
			);

			wp_localize_script(
				'gurmehub-plugin-helper-deactivate',
				'gph',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'ghp_ajax_nonce' ),
				)
			);

			( new \GurmeHub\Frontend( $this->plugin ) )->reason_of_deactivate();
		}
	}

	/**
	 * Deaktiflik nedeni gönderme.
	 */
	public function deactivate_reasons() {
		$plugin_name = $this->plugin->get_plugin_slug();

		if ( check_ajax_referer( 'ghp_ajax_nonce' ) && isset( $_POST['reasons'] ) ) {
			$this->request(
				array(
					'url'     => str_replace( array( 'https://', 'http://' ), '', esc_url( home_url() ) ),
					'plugin'  => $plugin_name,
					'reasons' => $_POST['reasons'], //phpcs:ignore
				),
				'saveDeactivateReasons'
			);
		}

		wp_send_json( true );
	}
}
