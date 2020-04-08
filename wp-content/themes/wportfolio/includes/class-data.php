<?php
/**
 * Data Class.
 * Class to store dummy data, for a better customization you should get the data from db.
 *
 * @author  WPerfekt
 * @package WPortfolio
 * @version 0.1.6
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
		 * Github api varibale.
		 *
		 * @var null
		 */
		public $github_api = null;

		/**
		 * Data custructor.
		 *
		 * @version 0.0.2
		 * @since 0.0.1
		 */
		public function __construct() {

			// Instance github api.
			$this->github_api = new Github_Api();
		}

		/**
		 * Get empty data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.6
		 */
		public function get_empty() {
			$data = array(
				'post' => __( 'No posts found', 'wportfolio' ),
			);

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
		 * Get nav data.
		 *
		 * @return mixed|void
		 *
		 * @since 0.0.6
		 */
		public function get_nav() {
			$data = array(
				'link' => home_url(),
				'text' => 'Rendy',
			);

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
			$data = array(
				'title'      => __( 'Hi, I am Rendy,', 'wportfolio' ),
				'subtitle'   => __( 'a WordPress Developer.', 'wportfolio' ),
				'home_title' => _x( 'Posts', 'Masthead title', 'wportfolio' ),
			);

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
		 * @since   0.0.3
		 */
		public function get_sections() {
			$data = array(
				'about'      => __( 'Hi There!', 'wportfolio' ),
				'focus'      => __( 'Specialisation', 'wportfolio' ),
				'experience' => __( 'Professional Experiences', 'wportfolio' ),
				'project'    => __( 'Experimental Projects', 'wportfolio' ),
				'activity'   => __( 'Summary Activity', 'wportfolio' ),
				'blog'       => __( 'Latest Posts', 'wportfolio' ),
				'contact'    => __( 'Get in Touch', 'wportfolio' ),
			);

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
		 * @since   0.0.4
		 */
		public function get_about() {
			$data = array(
				'content' => __( 'I am a WordPress Developer based in Yogyakarta, Indonesia. I am passionate to write clean and efficient code but highly customizable.', 'wportfolio' ),
			);

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
		 * @version 0.0.3
		 * @since   0.0.5
		 */
		public function get_focus() {
			$data = array(
				array(
					'id'    => 'wpcs',
					'title' => __( 'WPCS Compliance', 'wportfolio' ),
					'desc'  => __( 'By following WPCS we can expect most of what WordPress can offers.', 'wportfolio' ),
				),
				array(
					'id'    => 'config',
					'title' => __( 'Customizable', 'wportfolio' ),
					'desc'  => __( 'Thanks to WordPress hooks, they make development way easier and simpler.', 'wportfolio' ),
				),
				array(
					'id'    => 'secure',
					'title' => __( 'Secure', 'wportfolio' ),
					'desc'  => __( 'Beautiful and cutting-edge website is worth nothing if it is not secure.', 'wportfolio' ),
				),
			);

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
		 * @version 0.0.2
		 * @since   0.0.7
		 */
		public function get_experience() {
			$data = array(
				'content' => __( 'In general, I have more than 7 years experience as a Software Developer, around more than 4 years as a WordPress Developer.', 'wportfolio' ),
				'items'   => array(
					array(
						'name'     => 'Harnods',
						'location' => __( 'Yogyakarta, Indonesia', 'wportfolio' ),
						'logo'     => 'https://harnods.com/wp-content/uploads/2018/09/harnods-logo.svg',
						'url'      => 'https://harnods.com/',
						'role'     => __( 'WordPress Developer', 'wportfolio' ),
						'start'    => __( 'Apr 2016', 'wportfolio' ),
						'end'      => __( 'Feb 2019', 'wportfolio' ),
					),
					array(
						'name'     => 'SoftwareSeni',
						'location' => __( 'Yogyakarta, Indonesia', 'wportfolio' ),
						'logo'     => 'https://www.softwareseni.co.id/wp-content/themes/ss-2018/assets/img/extra/softwareseni_logo.svg',
						'url'      => 'https://www.softwareseni.co.id/',
						'role'     => __( 'WordPress Developer', 'wportfolio' ),
						'start'    => __( 'Feb 2019', 'wportfolio' ),
						'end'      => __( 'Now', 'wportfolio' ),
					),
				),
			);

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
		 * @version 0.0.6
		 * @since   0.0.1
		 */
		public function get_contact() {

			$data = array(
				'content'  => __( 'If you have projects that need to be get started, you may need some help or just saying hey, let\'s get in touch.', 'wportfolio' ),
				'email'    => 'hello@wperfekt.com',
				'linkedin' => 'https://www.linkedin.com/in/rendi-dwi-p-792576119',
				'github'   => 'https://github.com/' . $this->github_api->get_username(),
				'whatsapp' => '6282219186349',
			);

			// Merge the items.
			$data['items'] = array(
				array(
					'id'  => 'email',
					'url' => 'mailto:' . $data['email'],
				),
				array(
					'id'  => 'whatsapp',
					'url' => 'http://wa.me/' . $data['whatsapp'],
				),
				array(
					'id'  => 'linkedin',
					'url' => $data['linkedin'],
				),
				array(
					'id'  => 'github',
					'url' => $data['github'],
				),
			);

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
