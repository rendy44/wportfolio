<?php
/**
 * Data Class.
 * Class to store dummy data, for a better customization you should get the data from db.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */

namespace WPortfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPortfolio\Data' ) ) {

	/**
	 * Class Data
	 *
	 * @package WPortfolio
	 */
	class Data {

		/**
		 * Get masthead data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.2
		 */
		public function get_masthead() {
			$data = [
				'title'      => __( 'Hi, I am Rendy,', 'wportfolio' ),
				'subtitle'   => __( 'a WordPress Developer.', 'wportfolio' ),
				'home_title' => _x( 'Posts', 'Masthead title', 'wportfolio' ),
			];

			/**
			 * WPortfolio data masthead filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_masthead', $data );
		}

		/**
		 * Get contact data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.1
		 */
		public function get_contact() {
			$data = [
				'email'    => 'rendy.de.p@gmail.com',
				'linkedin' => 'https://www.linkedin.com/in/rendi-dwi-p-792576119',
				'github'   => 'https://github.com/rendy44',
				'whatsapp' => '6282219186349',
			];

			/**
			 * WPortfolio data contact filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_contact', $data );
		}
	}
}