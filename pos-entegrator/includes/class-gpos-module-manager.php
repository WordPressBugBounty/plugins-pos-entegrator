<?php
/**
 * GurmePOS için pro, form gibi modüllerin güncellemelerini kontrol edip GurmePOS un güncellemelerini organize eder.
 * Aktif edilme durumlarını hook aksiyonlarını organize eder.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS güncelleme engelleme sınıfı
 */
class GPOS_Module_Manager {

	/**
	 * Modüllerin entegre olduğu kanca..
	 */
	public function gpos_loaded() {
		if ( defined( 'GPOSPRO_VERSION' ) ) {
			$pro_version = defined( 'GPOS_PRODUCTION' ) && true === GPOS_PRODUCTION ? GPOSPRO_VERSION : '100';
			if ( version_compare( $pro_version, '2.6.71', '>=' ) ) {
				do_action( 'gpos_loaded_for_pro' );
			}
		}

		if ( defined( 'GPOSFORM_VERSION' ) ) {
			$form_version = defined( 'GPOS_PRODUCTION' ) && true === GPOS_PRODUCTION ? GPOSFORM_VERSION : '100';
			if ( version_compare( $form_version, '1.0.34', '>=' ) ) {
				do_action( 'gpos_loaded_for_form' );
			}
		}
	}
}
