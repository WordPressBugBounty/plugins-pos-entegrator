<?php // phpcs:ignore 
namespace GurmeHub;

use stdClass;

/**
 * Güncelleme sınıfı
 *
 * Eklentilerin son versiyonununa güncellenmesini sağlar
 */
class Updater extends \GurmeHub\Api {

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

		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_plugin_update' ) );
		add_filter( 'plugins_api', array( $this, 'plugins_api_filter' ), 10, 3 );
		add_action( 'in_plugin_update_message-' . $this->plugin->get_basename(), array( $this, 'plugin_update_message' ), 10, 2 );
	}

	/**
	 * Eklenti son versiyon bilgilerini döndürür.
	 *
	 * @return false|object $latest_info Eklenti güncel bilgileri.
	 */
	public function get_latest_info() {

		$latest_info_data = $this->request(
			array(
				'plugin' => $this->plugin->get_plugin_slug(),
				'url'    => str_replace( array( 'https://', 'http://' ), '', esc_url( home_url() ) ),
			),
			'checkUpdateV2'
		);

		if ( ! is_object( $latest_info_data ) || ! property_exists( $latest_info_data, 'plugin' ) || true === is_wp_error( $latest_info_data ) ) {
			return false;
		}

		$latest_info              = $latest_info_data->plugin;
		$latest_info->banners_rtl = (array) $latest_info->banners_rtl;
		$latest_info->banners     = (array) $latest_info->banners;
		$latest_info->icons       = (array) $latest_info->icons;
		$latest_info->sections    = (array) $latest_info->sections;

		return $latest_info;
	}

	/**
	 * Lisans yenileme mesajı.
	 *
	 * @param array  $plugin_data Eklenti bilgisi.
	 * @param object $response Eklenti güncellemesi için alınan cevap.
	 *
	 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
	 */
	public function plugin_update_message( $plugin_data, $response ) {

		if ( ! $response || ! $response->package ) {
			?>
			<span class="gph-license-error-<?php echo esc_attr( $this->plugin->get_plugin_slug() ); ?>">
				Güncelleme ve destek hizmetlerinden yararlanmaya devam edebilmek için lisansınızı aktif hale getirmeniz gerekmektedir. Lütfen aboneliklerinizi kontrol ederek lisansınızı aktifleştirin.			</span>
			<?php
		}
	}

	/**
	 * WordPress 'pre_set_site_transient_update_plugins' kancası için güncelleme kontrolü
	 *
	 * @param stdClass $transient_data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 *
	 * @return stdClass $transient_data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 */
	public function check_plugin_update( $transient_data ) {

		global $pagenow;

		if ( ! is_object( $transient_data ) ) {
			$transient_data = new stdClass();
		}

		if ( 'plugins.php' === $pagenow && is_multisite() ) {
			return $transient_data;
		}

		$basename        = $this->plugin->get_basename();
		$latest_info     = $this->get_latest_info();
		$current_version = $this->plugin->get_current_version();

		if ( ! $latest_info ) {
			return $transient_data;
		}

		if ( version_compare( $current_version, $latest_info->new_version, '<' ) ) {
			$transient_data->response[ $basename ] = $latest_info;
		}

		return $transient_data;
	}


	/**
	 * WordPress 'plugins_api_filter' kancası için güncelleme bilgileri
	 *
	 * @param object|array $data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 * @param string       $action Bilgilerin gösterileceği aksiyon.
	 * @param bool|object  $args Gösterilecek eklentinin argümanları.
	 *
	 * @return stdClass $transient_data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 */
	public function plugins_api_filter( $data, $action = '', $args = null ) {

		if ( 'plugin_information' !== $action || ! isset( $args->slug ) || 'gurmepos-pro' !== $args->slug ) {
			return $data;
		}

		$latest_info = $this->get_latest_info();

		return false === $latest_info ? $data : $latest_info;
	}
}
