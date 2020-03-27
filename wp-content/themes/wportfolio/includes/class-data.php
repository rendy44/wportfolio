<?php
/**
 * Data Class.
 * Class to store dummy data, for a better customization you should get the data from db.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.6
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
		 * Get empty data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.6
		 */
		public function get_empty() {
			$data = [
				'post' => __( 'No posts found', 'wportfolio' ),
			];

			/**
			 * WPortfolio data empty filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_empty', $data );
		}

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
		 * Get sections data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.3
		 */
		public function get_sections() {
			$data = [
				'about'   => __( 'Hi There!', 'wportfolio' ),
				'focus'   => __( 'Specialisation', 'wportfolio' ),
				'blog'    => __( 'Latest Posts', 'wportfolio' ),
				'contact' => __( 'Get in Touch', 'wportfolio' ),
			];

			/**
			 * WPortfolio data sections filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_sections', $data );
		}

		/**
		 * Get about data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.4
		 */
		public function get_about() {
			$data = [
				'content' => __( 'I am a WordPress Developer based in Yogyakarta, Indonesia. I am passionate to write clean and efficient code but highly customizable.', 'wportfolio' ),
			];

			/**
			 * WPortfolio data about filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_about', $data );
		}

		/**
		 * Get focus data.
		 *
		 * @return mixed|void
		 *
		 * @version 0.0.2
		 * @since 0.0.5
		 */
		public function get_focus() {
			$data = [
				[
					'id'    => 'wpcs',
					'title' => __( 'WPCS Compliant', 'wportfolio' ),
					'desc'  => __( 'By following WPCS we can expect most of what WordPress can offers.', 'wportfolio' ),
				],
				[
					'id'    => 'config',
					'title' => __( 'Customizable', 'wportfolio' ),
					'desc'  => __( 'Thanks to WordPress hooks, they make development way easier and simpler.', 'wportfolio' ),
				],
				[
					'id'    => 'secure',
					'title' => __( 'Secure', 'wportfolio' ),
					'desc'  => __( 'Beautiful and cutting-edge website is worth nothing if it is not secure.', 'wportfolio' ),
				],
			];

			/**
			 * WPortfolio data focus filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_focus', $data );
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
				'content'  => __( 'If you have projects that need to be get started, you may need some helps or just saying hey, let\'s get in touch.', 'wportfolio' ),
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