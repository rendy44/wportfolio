<?php
/**
 * Data Class.
 * Class to store dummy data, for a better customization you should get the data from db.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.1.4
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
		 * Get author data.
		 *
		 * @return string
		 *
		 * @since 0.1.0
		 */
		public function get_author() {
			return Helper::get_author();
		}

		/**
		 * Get github data.
		 *
		 * @return mixed|void
		 *
		 * @version 0.0.2
		 * @since 0.1.1
		 */
		public function get_github() {
			$data = [
				'username'   => 'rendy44',
				'access_key' => '', // TODO: Insert your github access token.
			];

			/**
			 * WPortfolio data github filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_github', $data );
		}

		/**
		 * Get nav data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.6
		 */
		public function get_nav() {
			$data = [
				'link' => home_url(),
				'text' => 'Rendy',
			];

			/**
			 * WPortfolio data nav filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_nav', $data );
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
		 * @version 0.0.4
		 * @since 0.0.3
		 */
		public function get_sections() {
			$data = [
				'about'      => __( 'Hi There!', 'wportfolio' ),
				'focus'      => __( 'Specialisation', 'wportfolio' ),
				'experience' => __( 'Professional Experiences', 'wportfolio' ),
				'project'    => __( 'Experimental Projects', 'wportfolio' ),
				'activity'   => __( 'Summary Activity', 'wportfolio' ),
				'blog'       => __( 'Latest Posts', 'wportfolio' ),
				'contact'    => __( 'Get in Touch', 'wportfolio' ),
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
		 * @version 0.0.3
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
		 * Get experience data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.7
		 */
		public function get_experience() {
			$data = [
				'content' => __( 'Generally, I have more than 7 years of experience as a Software Developer, shrunk to 4 years as a WordPress Developer.', 'wportfolio' ),
				'items'   => [
					[
						'name'     => 'Harnods',
						'location' => __( 'Yogyakarta, Indonesia', 'wportfolio' ),
						'logo'     => 'https://harnods.com/wp-content/uploads/2018/09/harnods-logo.svg',
						'url'      => 'https://harnods.com/',
						'role'     => __( 'WordPress Developer', 'wportfolio' ),
						'start'    => __( 'Apr 2016', 'wportfolio' ),
						'end'      => __( 'Feb 2019', 'wportfolio' ),
					],
					[
						'name'     => 'SoftwareSeni',
						'location' => __( 'Yogyakarta, Indonesia', 'wportfolio' ),
						'logo'     => 'https://www.softwareseni.co.id/wp-content/themes/ss-2018/assets/img/extra/softwareseni_logo.svg',
						'url'      => 'https://www.softwareseni.co.id/',
						'role'     => __( 'WordPress Developer', 'wportfolio' ),
						'start'    => __( 'Feb 2019', 'wportfolio' ),
						'end'      => __( 'Now', 'wportfolio' ),
					],
				],
			];

			/**
			 * WPortfolio data experience filter hook.
			 *
			 * @param array $data default data.
			 *
			 * @since 0.0.1
			 */
			return apply_filters( 'wportfolio_data_experience', $data );
		}

		/**
		 * Get contact data.
		 *
		 * @return mixed|void
		 *
		 * @version 0.0.3
		 * @since 0.0.1
		 */
		public function get_contact() {

			// Get github data.
			$github_data = $this->get_github();

			$data = [
				'content'  => __( 'If you have projects that need to be get started, you may need some helps or just saying hey, let\'s get in touch.', 'wportfolio' ),
				'email'    => 'rendy.de.p@gmail.com',
				'linkedin' => 'https://www.linkedin.com/in/rendi-dwi-p-792576119',
				'github'   => 'https://github.com/' . $github_data['username'],
				'whatsapp' => '6282219186349',
			];

			// Merge the items.
			$data['items'] = [
				[
					'id'  => 'email',
					'url' => 'mailto:' . $data['email'],
				],
				[
					'id'  => 'whatsapp',
					'url' => 'http://wa.me/' . $data['whatsapp'],
				],
				[
					'id'  => 'linkedin',
					'url' => $data['linkedin'],
				],
				[
					'id'  => 'github',
					'url' => $data['github'],
				],
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
