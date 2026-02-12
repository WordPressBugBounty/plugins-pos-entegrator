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
		register_activation_hook( $this->plugin->get_basefile(), array( $this, 'activation' ) );
		register_deactivation_hook( $this->plugin->get_basefile(), array( $this, 'deactivation' ) );
		add_filter( 'plugin_action_links_' . $this->plugin->get_basename(), array( $this, 'plugin_action_links' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'wp_ajax_' . $this->plugin->get_plugin_slug() . '_deactivate_reasons', array( $this, 'deactivate_reasons' ), 10, 2 );
	}

	/**
	 * Eklenti aktif edilme kancasına tutunan method.
	 *
	 * @return void
	 */
	public function activation() {
		$this->change_active_status();
		$this->send_data();
	}

	/**
	 * Eklenti deaktif edilme kancasına tutunan method.
	 *
	 * @return void
	 */
	public function deactivation() {
		$this->change_active_status( 0 );
	}

	/**
	 * Eklentinin açılıp kapanması durumunda bilgilendirme yapar.
	 *
	 * @param int $status 1 yada 0 alabilir
	 *
	 * @return array
	 */
	public function change_active_status( $status = 1 ) {

		return $this->request(
			array(
				'url'       => str_replace( array( 'https://', 'http://' ), '', esc_url( home_url() ) ),
				'plugin'    => $this->plugin->get_plugin_slug(),
				'is_active' => $status,
			),
			'activeStatusChanged'
		);
	}

	/**
	 * Eklenti için gönderilecek verileri düzenler.
	 *
	 * @return void
	 */
	public function send_data() {
		$this->request(
			array(
				'url'              => str_replace( array( 'https://', 'http://' ), '', esc_url( home_url() ) ),
				'site_name'        => $this->get_site_name(),
				'admin_email'      => get_option( 'admin_email' ),
				'plugin'           => $this->plugin->get_plugin_slug(),
				'plugin_version'   => $this->plugin->get_current_version(),
				'is_local'         => $this->is_local(),
			),
			'trackingData'
		);
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

	/**
	 * Varsa site ismini yok ise urlini döndürür.
	 *
	 * @return string $site_name.
	 */
	private function get_site_name() {
		$site_name = get_bloginfo( 'name' );

		if ( empty( $site_name ) ) {
			$site_name = get_bloginfo( 'description' );
			$site_name = wp_trim_words( $site_name, 3, '' );
		}

		if ( empty( $site_name ) ) {
			$site_name = esc_url( home_url() );
		}

		return $site_name;
	}

	/**
	 * Site'in local olup olmadığını kontrol eder.
	 *
	 * @return bool
	 */
	private function is_local() {
		$is_local = 'no';
		$host     = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : 'localhost';

		if ( ! strpos( $host, '.' ) || in_array( strrchr( $host, '.' ), array( '.test', '.testing', '.local', '.localhost', '.localdomain' ), true ) || false !== strpos( $host, 'instawp.xyz' ) ) {
			$is_local = 'yes';
		}

		return $is_local;
	}
}
