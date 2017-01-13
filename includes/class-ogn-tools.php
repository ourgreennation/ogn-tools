<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://davidlaietta.com
 * @since      1.0.0
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 * @author     David Laietta <david@orangeblossommedia.com>
 */
class Ogn_Tools {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ogn_Tools_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'ogn-tools';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ogn_Tools_Loader. Orchestrates the hooks of the plugin.
	 * - Ogn_Tools_i18n. Defines internationalization functionality.
	 * - Ogn_Tools_Admin. Defines all hooks for the admin area.
	 * - Ogn_Tools_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ogn-tools-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ogn-tools-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ogn-tools-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ogn-tools-public.php';

		/**
		 * All Our Green Nation Widgets
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/ourgreennation-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/ourgreennation_popular_categories_widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/ourgreennation_child_categories_widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/ourgreennation_the_events_calendar_widget.php';

		$this->loader = new Ogn_Tools_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ogn_Tools_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ogn_Tools_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ogn_Tools_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_footer_text', $plugin_admin, 'display_custom_admin_footer' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_post_type_ingredients' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_post_type_books' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_skin_type' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_skin_condition' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_product_function' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_ingredient_property' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_ingredient_function' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomy_ingredient_concern' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'assign_ogn_contributor_capabilities' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'ogn_contributor_dashboard_view' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'ogn_contributor_profile_dashboard' );
		$this->loader->add_action( 'wp_before_admin_bar_render', $plugin_admin, 'ogn_contributor_admin_menu_view' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'ogn_contributor_admin_metabox_view', 99 );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'ourgreennation_limit_dashboard' );

		$this->loader->add_filter( 'pre_get_posts', $plugin_admin, 'posts_for_current_author' );
		$this->loader->add_filter( 'posts_where', $plugin_admin, 'hide_media_library' );
		// $this->loader->add_filter( 'wp_dropdown_users', $plugin_admin, 'ourgreennation_switch_users' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ogn_Tools_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_public, 'ourgreennation_bp_reactions', 6 );
		$this->loader->add_action( 'admin_bar_menu', $plugin_public, 'ourgreennation_wp_admin_bar_custom_account_menu', 11 );

		add_filter( 'widget_text', 'do_shortcode' );
		$plugin_public->register_shortcodes();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ogn_Tools_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
