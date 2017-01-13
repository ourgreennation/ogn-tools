<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://davidlaietta.com
 * @since      1.0.0
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/public
 * @author     David Laietta <david@orangeblossommedia.com>
 */
class Ogn_Tools_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ogn_Tools_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ogn_Tools_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ogn-tools-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ogn_Tools_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ogn_Tools_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ogn-tools-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register new reactions for BP Reactions Plugin
	 *
	 * @since    1.0.0
	 */
	public function ourgreennation_bp_reactions() {

		if ( is_plugin_active( 'bp-reactions/bp-reactions.php' ) ) {
			bp_reactions_register_reaction( 'smiley', array(
				'emoji'           => '0x1F603',
				'description'     => __( 'Smile', 'bp-reactions' ),
				'label'           => __( 'Smile', 'bp-reactions' ),
			) );

			bp_reactions_register_reaction( 'Angry', array(
				'emoji'           => '0x1F620',
				'description'     => __( 'Angry', 'bp-reactions' ),
				'label'           => __( 'Angry', 'bp-reactions' ),
			) );

			bp_reactions_register_reaction( 'worried', array(
				'emoji'           => '0x1F61F',
				'description'     => __( 'worried', 'bp-reactions' ),
				'label'           => __( 'worried', 'bp-reactions' ),
			) );

			bp_reactions_register_reaction( 'Laughing', array(
				'emoji'           => '0x1F606',
				'description'     => __( 'Laughing', 'bp-reactions' ),
				'label'           => __( 'Laughing', 'bp-reactions' ),
			) );
		}

	}


	function ourgreennation_wp_admin_bar_custom_account_menu( $wp_admin_bar ) {

		$user_id = get_current_user_id();
		$current_user = wp_get_current_user();
		$profile_url = get_edit_profile_url( $user_id );

		if ( 0 != $user_id ) {

			/* Add the "My Account" menu */
			$avatar = get_avatar( $user_id, 28 );
			$howdy = sprintf( __('%1$s'), $current_user->display_name );
			$class = empty( $avatar ) ? '' : 'with-avatar';

			$wp_admin_bar->add_menu( array(
				'id' => 'my-account',
				'parent' => 'top-secondary',
				'title' => $howdy . $avatar,
				'href' => $profile_url,
				'meta' => array(
					'class' => $class,
					),
				)
			);

		}

	}

	/**
	 * Register Shortcode
	 *
	 * @return void
	 */
	public function register_shortcodes() {
		add_shortcode( 'OGN-Guide', array( $this, 'register_ogn_guide_shortcode' ) );
		add_shortcode( 'OGN-Helpful-Info', array( $this, 'register_ogn_helpful_info_shortcode' ) );
		add_shortcode( 'OGN-Current-User', array( $this, 'register_ogn_user_shortcut_shortcode' ) );
	}

	/**
	 * Register OGN-Guide Shortcode
	 *
	 * @param  array  $atts Array of shortcode attributes
	 * @return string       The parsed shortcode string
	 */
	final public function register_ogn_guide_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'text'		=> 'My Activity',
		), $atts );

		$link = home_url( 'members/' . bp_core_get_username( get_current_user_id() ) . '/activity/' );

		$menu = '';

		if( is_user_logged_in() ) {
			$menu .= '<ul class="fa-ul" style="text-transform: uppercase;">';
				$menu .= '<li class="fa fa-li fa-user-circle"><a href="' . esc_attr( $link ) . '">My Activity</a></li>';
				$menu .= '<li class="fa fa-li fa-tachometer"><a href="' . get_home_url() . '/activity/">Main Activity Stream</a></li>';
				$menu .= '<li class="fa fa-li fa-user"><a href="' . get_home_url() . '/members/">Community Directory</a></li>';
				$menu .= '<li class="fa fa-li fa-users"><a href="' . get_home_url() . '/groups/">Community Groups</a></li>';
				$menu .= '<li class="fa fa-li fa-calendar"><a href="' . get_home_url() . '/events/">Events</a></li>';
				$menu .= '<li class="fa fa-li fa-wrench"><a href="' . get_home_url() . '/solutions-center/">Solutions Center</a></li>';
			$menu .= '</ul>';

			$menu .= '<hr style="color: #BDBBBC; height: 1px;">';
		}

		$menu .= '<h3 class="widget-title">Helpful Info</h3>';
		$menu .= '<ul class="fa-ul" style="text-transform: uppercase;">';
			$menu .= '<li class="fa fa-li fa-heart"><a href="' . get_home_url() . '/about/">Our Mission</a></li>';
			$menu .= '<li class="fa fa-li fa-question"><a href="' . get_home_url() . '/faqs/">FAQS</a></li>';
			$menu .= '<li class="fa fa-li fa-flag"><a href="' . get_home_url() . '/member-pledge/">Member Pledge</a></li>';
			$menu .= '<li class="fa fa-li fa-flag"><a href="' . get_home_url() . '/contributor-pledge/">Contributor Pledge</a></li>';
			$menu .= '<li class="fa fa-li fa-television"><a href="' . get_home_url() . '/video-tutorials/">Video Tutorials</a></li>';
			if( is_user_logged_in() ) {
				$menu .= '<li class="fa fa-li fa-star-o"><a href="' . get_home_url() . '/apply-to-contribute/">Apply to Contribute</a></li>';
			} else {
				$menu .= '<li class="fa fa-li fa-star-o"><a href="' . get_home_url() . '/register/">Join Us</a></li>';
			}
		$menu .= '</ul>';

		return $menu;
	}

	/**
	 * Register OGN-Helpful-Info Shortcode
	 *
	 * @param  array  $atts Array of shortcode attributes
	 * @return string       The parsed shortcode string
	 */
	final public function register_ogn_helpful_info_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'text'		=> 'My Activity',
		), $atts );

		$link = home_url( 'members/' . bp_core_get_username( get_current_user_id() ) . '/activity/' );

		$menu = '<ul class="fa-ul" style="text-transform: uppercase;">';
			if( is_user_logged_in() ) {
				$menu .= '<li class="fa fa-li fa-user-circle"><a href="' . esc_attr( $link ) . '">My Activity</a></li>';
				$menu .= '<li class="fa fa-li fa-tachometer"><a href="' . get_home_url() . '/activity/">Main Activity Stream</a></li>';
				$menu .= '<li class="fa fa-li fa-user"><a href="' . get_home_url() . '/members/">Community Directory</a></li>';
				$menu .= '<li class="fa fa-li fa-calendar"><a href="' . get_home_url() . '/events/">Events</a></li>';
				$menu .= '<li class="fa fa-li fa-users"><a href="' . get_home_url() . '/groups/">Community Groups</a></li>';
				$menu .= '<li class="fa fa-li fa-wrench"><a href="' . get_home_url() . '/solutions-center/">Solutions Center</a></li>';
			}
			$menu .= '<li class="fa fa-li fa-heart"><a href="' . get_home_url() . '/about/">Our Mission</a></li>';
			$menu .= '<li class="fa fa-li fa-question"><a href="' . get_home_url() . '/faqs/">FAQS</a></li>';
			$menu .= '<li class="fa fa-li fa-flag"><a href="' . get_home_url() . '/member-pledge/">Member Pledge</a></li>';
			$menu .= '<li class="fa fa-li fa-flag"><a href="' . get_home_url() . '/contributor-pledge/">Contributor Pledge</a></li>';
			$menu .= '<li class="fa fa-li fa-television"><a href="' . get_home_url() . '/video-tutorials/">Video Tutorials</a></li>';
			if( is_user_logged_in() ) {
				$menu .= '<li class="fa fa-li fa-star-o"><a href="' . get_home_url() . '/apply-to-contribute/">Apply to Contribute</a></li>';
			} else {
				$menu .= '<li class="fa fa-li fa-star-o"><a href="' . get_home_url() . '/register/">Join Us</a></li>';
			}
		$menu .= '</ul>';

		return $menu;
	}

	/**
	 * Register OGN-Current-User Shortcode
	 *
	 * @param  array  $atts Array of shortcode attributes
	 * @return string       The parsed shortcode string
	 */
	final public function register_ogn_user_shortcut_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'text'		=> 'My Activity',
		), $atts );

		if( !is_user_logged_in() )
			return '';

		$link = home_url( 'members/' . bp_core_get_username( get_current_user_id() ) . '/activity/' );

		return '<li class="fa fa-li fa-user-circle"><a href="' . esc_attr( $link ) . '"">' . $atts['text'] . '</a></li>';
	}
}