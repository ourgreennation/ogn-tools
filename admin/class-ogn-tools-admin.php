<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://davidlaietta.com
 * @since      1.0.0
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/admin
 * @author     David Laietta <david@orangeblossommedia.com>
 */
class Ogn_Tools_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ogn-tools-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ogn-tools-admin.js', array( 'jquery' ), $this->version, false );

	}


    /**
     * Display a custom dashboard footer
     *
     * @since    1.0.0
     */
    function display_custom_admin_footer() {
        echo '';
    }


	/**
     * Create a Custom Post Type to manage ingredients
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    public function create_custom_post_type_ingredients() {

        // Register Custom Post Type

        $labels = array(
            'name'                  => _x( 'Ingredients', 'Post Type General Name', $this->plugin_name ),
            'singular_name'         => _x( 'Ingredient', 'Post Type Singular Name', $this->plugin_name ),
            'menu_name'             => __( 'Ingredients', $this->plugin_name ),
            'name_admin_bar'        => __( 'Ingredient', $this->plugin_name ),
            'archives'              => __( 'Ingredient Archives', $this->plugin_name ),
            'parent_item_colon'     => __( 'Parent Ingredient:', $this->plugin_name ),
            'all_items'             => __( 'Ingredients', $this->plugin_name ),
            'add_new_item'          => __( 'Add New Ingredient', $this->plugin_name ),
            'add_new'               => __( 'Add New', $this->plugin_name ),
            'new_item'              => __( 'New Ingredient', $this->plugin_name ),
            'edit_item'             => __( 'Edit Ingredient', $this->plugin_name ),
            'update_item'           => __( 'Update Ingredient', $this->plugin_name ),
            'view_item'             => __( 'View Ingredient', $this->plugin_name ),
            'search_items'          => __( 'Search Ingredient', $this->plugin_name ),
            'not_found'             => __( 'Not found', $this->plugin_name ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->plugin_name ),
            'featured_image'        => __( 'Featured Image', $this->plugin_name ),
            'set_featured_image'    => __( 'Set featured image', $this->plugin_name ),
            'remove_featured_image' => __( 'Remove featured image', $this->plugin_name ),
            'use_featured_image'    => __( 'Use as featured image', $this->plugin_name ),
            'insert_into_item'      => __( 'Insert into item', $this->plugin_name ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', $this->plugin_name ),
            'items_list'            => __( 'Ingredient', $this->plugin_name ),
            'items_list_navigation' => __( 'Ingredient navigation', $this->plugin_name ),
            'filter_items_list'     => __( 'Filter items', $this->plugin_name ),
        );
        $args = array(
            'label'                 => __( 'Ingredient', $this->plugin_name ),
            'description'           => __( 'Ingredients', $this->plugin_name ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', ),
            'taxonomies'            => array(),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-cart',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
			'query_var'          	=> true,
			'rewrite'            	=> array( 'slug' => 'ingredients' ),
            'capability_type'       => 'ogn_ingredient',
        );
        register_post_type( 'ogn_ingredient', $args );

    }



    /**
     * Create a Custom Post Type to manage ingredients
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    public function create_custom_post_type_books() {

        // Register Custom Post Type

        $labels = array(
            'name'                  => _x( 'Books', 'Post Type General Name', $this->plugin_name ),
            'singular_name'         => _x( 'Book', 'Post Type Singular Name', $this->plugin_name ),
            'menu_name'             => __( 'Books', $this->plugin_name ),
            'name_admin_bar'        => __( 'Book', $this->plugin_name ),
            'archives'              => __( 'Book Archives', $this->plugin_name ),
            'parent_item_colon'     => __( 'Parent Book:', $this->plugin_name ),
            'all_items'             => __( 'Books', $this->plugin_name ),
            'add_new_item'          => __( 'Add New Book', $this->plugin_name ),
            'add_new'               => __( 'Add New', $this->plugin_name ),
            'new_item'              => __( 'New Book', $this->plugin_name ),
            'edit_item'             => __( 'Edit Book', $this->plugin_name ),
            'update_item'           => __( 'Update Book', $this->plugin_name ),
            'view_item'             => __( 'View Book', $this->plugin_name ),
            'search_items'          => __( 'Search Book', $this->plugin_name ),
            'not_found'             => __( 'Not found', $this->plugin_name ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->plugin_name ),
            'featured_image'        => __( 'Featured Image', $this->plugin_name ),
            'set_featured_image'    => __( 'Set featured image', $this->plugin_name ),
            'remove_featured_image' => __( 'Remove featured image', $this->plugin_name ),
            'use_featured_image'    => __( 'Use as featured image', $this->plugin_name ),
            'insert_into_item'      => __( 'Insert into item', $this->plugin_name ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', $this->plugin_name ),
            'items_list'            => __( 'Book', $this->plugin_name ),
            'items_list_navigation' => __( 'Book navigation', $this->plugin_name ),
            'filter_items_list'     => __( 'Filter items', $this->plugin_name ),
        );
        $args = array(
            'label'                 => __( 'Book', $this->plugin_name ),
            'description'           => __( 'Books', $this->plugin_name ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', ),
            'taxonomies'            => array(),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-book-alt',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'book' ),
            'capability_type'       => 'ogn_book',
        );
        register_post_type( 'ogn_book', $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredients skin types
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_skin_type() {

        $labels = array(
            'name'                       => _x( 'Skin Types', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Skin Type', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Skin Type', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'skin_type', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredients skin conditions
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_skin_condition() {

        $labels = array(
            'name'                       => _x( 'Skin Conditions', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Skin Condition', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Skin Condition', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'skin_condition', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredients product functions
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_product_function() {

        $labels = array(
            'name'                       => _x( 'Product Functions', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Product Function', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Product Function', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'product_function', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredients skin types
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_ingredient_property() {

        $labels = array(
            'name'                       => _x( 'Ingredient Properties', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Ingredient Property', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Ingredient Property', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'ingredient_property', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredient properties
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_ingredient_function() {

        $labels = array(
            'name'                       => _x( 'Ingredient Functions', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Ingredient Function', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Ingredient Function', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'ingredient_function', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Create a Custom Taxonomy to manage ingredient concerns
     *
     * @param array $post
     *
     * @return int|WP_Error
     */
    function create_custom_taxonomy_ingredient_concern() {

        $labels = array(
            'name'                       => _x( 'Ingredient Concerns', 'Taxonomy General Name', 'our-green-nation' ),
            'singular_name'              => _x( 'Ingredient Concern', 'Taxonomy Singular Name', 'our-green-nation' ),
            'menu_name'                  => __( 'Ingredient Concern', 'our-green-nation' ),
            'all_items'                  => __( 'All Items', 'our-green-nation' ),
            'parent_item'                => __( 'Parent Item', 'our-green-nation' ),
            'parent_item_colon'          => __( 'Parent Item:', 'our-green-nation' ),
            'new_item_name'              => __( 'New Item Name', 'our-green-nation' ),
            'add_new_item'               => __( 'Add New Item', 'our-green-nation' ),
            'edit_item'                  => __( 'Edit Item', 'our-green-nation' ),
            'update_item'                => __( 'Update Item', 'our-green-nation' ),
            'view_item'                  => __( 'View Item', 'our-green-nation' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'our-green-nation' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'our-green-nation' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'our-green-nation' ),
            'popular_items'              => __( 'Popular Items', 'our-green-nation' ),
            'search_items'               => __( 'Search Items', 'our-green-nation' ),
            'not_found'                  => __( 'Not Found', 'our-green-nation' ),
            'no_terms'                   => __( 'No items', 'our-green-nation' ),
            'items_list'                 => __( 'Items list', 'our-green-nation' ),
            'items_list_navigation'      => __( 'Items list navigation', 'our-green-nation' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'ingredient_concern', array( 'ogn_ingredient' ), $args );

    }



    /**
     * Assign capabilities to ogn_contributor role
     *
     * @param array $role
     */
    function assign_ogn_contributor_capabilities() {

        // ogn_contributor role is created in Ogn_Tools_Activator class
        $role = get_role( 'ogn_contributor' );

        $role->add_cap( 'level_1' );

        $role->add_cap( 'create_posts' );
        $role->add_cap( 'edit_posts' );
        $role->add_cap( 'delete_posts' );
        $role->add_cap( 'publish_posts' );
        $role->add_cap( 'edit_published_posts' );
        $role->add_cap( 'delete_published_posts' );
        $role->add_cap( 'upload_files' );

        // The Events Calendar
        $role->add_cap( 'edit_tribe_event' );
        $role->add_cap( 'edit_tribe_events' );
        $role->add_cap( 'read_tribe_event' );
        $role->add_cap( 'delete_tribe_event' );
        $role->add_cap( 'delete_tribe_events' );
        $role->add_cap( 'publish_tribe_events' );
        $role->add_cap( 'edit_published_tribe_events' );
        $role->add_cap( 'delete_published_tribe_events' );

        $role->add_cap( 'edit_tribe_venue' );
        $role->add_cap( 'read_tribe_venue' );
        $role->add_cap( 'delete_tribe_venue' );
        $role->add_cap( 'delete_tribe_venues' );
        $role->add_cap( 'edit_tribe_venues' );
        $role->add_cap( 'publish_tribe_venues' );
        $role->add_cap( 'edit_published_tribe_venues' );
        $role->add_cap( 'delete_published_tribe_venues' );

        $role->add_cap( 'edit_tribe_organizer' );
        $role->add_cap( 'read_tribe_organizer' );
        $role->add_cap( 'delete_tribe_organizer' );
        $role->add_cap( 'delete_tribe_organizers' );
        $role->add_cap( 'edit_tribe_organizers' );
        $role->add_cap( 'publish_tribe_organizers' );
        $role->add_cap( 'edit_published_tribe_organizers' );
        $role->add_cap( 'delete_published_tribe_organizers' );

        // Books
        $role->add_cap( 'edit_ogn_book' );
        $role->add_cap( 'publish_ogn_book' );
        $role->add_cap( 'read_ogn_book' );
        $role->add_cap( 'delete_ogn_book' );

        // FAQs
        $role->remove_cap( 'edit_qa_faqs' );
        $role->remove_cap( 'publish_qa_faqs' );
        $role->remove_cap( 'read_qa_faqs' );
        $role->remove_cap( 'delete_qa_faqs' );

        // Ingredients
        // $role->add_cap( 'edit_ogn_ingredient' );
        // $role->add_cap( 'edit_others_ogn_ingredient' );
        // $role->add_cap( 'publish_ogn_ingredient' );
        // $role->add_cap( 'delete_ogn_ingredient' );
        // $role->add_cap( 'delete_others_ogn_ingredient' );

    }




    /**
     * Modify display of dashboard for ogn_contributor role
     *
     * @param object $query
     */
    public static function posts_for_current_author( $query ) {

        global $pagenow;

        if( 'edit.php' != $pagenow || !$query->is_admin )
            return $query;

        if( !current_user_can( 'edit_others_posts' ) ) {
            global $user_ID;
            $query->set('author', $user_ID );
        }
        return $query;

    }




    /**
     * Hide media library items not belonging to logged in user
     *
     * @param string $where
     */
    public static function hide_media_library( $where ) {

        global $current_user;

        // Confirm that the user is logged in but not an admin
        if( is_user_logged_in() && !current_user_can( 'manage_options' ) ){
             if( isset( $_POST['action'] ) && ( $_POST['action'] == 'query-attachments' ) ){
                $where .= ' AND post_author='.$current_user->data->ID;
            }
        }

        return $where;

    }


    /**
     * Modify display of dashboard for ogn_contributor role
     *
     * @param array $role
     */
    public function ogn_contributor_dashboard_view() {

        if( current_user_can( 'ogn_contributor' ) ) {

            // Remove Meta Boxes from Dashboard page
            remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');       // Activity Widget
            remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );       // Right Now Widget
            remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
            remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
            remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
            remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );     // Quick Press Widget
            remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
            remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         // Wordpress Blog
            remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       // Other Wordpress News
            remove_meta_box( 'jetpack_summary_widget', 'dashboard', 'core' );    // Jetpack
            remove_meta_box( 'pmpro_db_widget', 'dashboard', 'core' );           // Paid Memberships Pro
            remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'core' );  // Yoast SEO Overview
            remove_meta_box( 'tribe_dashboard_widget', 'dashboard', 'core' );    // News from Modern Tribe

            // Remove menu pages from sidebar
            remove_menu_page( 'index.php' );                        // Dashboard
            // remove_menu_page( 'upload.php' );                       // Media
            remove_menu_page( 'jetpack' );                          // Jetpack
            remove_menu_page( 'edit-comments.php' );                // Comments
            remove_menu_page( 'plugins.php' );                      // Plugins
            remove_menu_page( 'themes.php' );                       // Appearance
            remove_menu_page( 'tools.php' );                        // Tools
            remove_menu_page( 'options-general.php' );              // Settings
            remove_menu_page( 'edit.php?post_type=owl-carousel' );  // Owl Carousel
            remove_menu_page( 'edit.php?post_type=qa_faqs' ); // FAQS
        }

    }



    /**
     * Modify display of admin menu for ogn_contributor role
     *
     * @param array $role
     */
    public function ogn_contributor_admin_menu_view() {

        global $wp_admin_bar;

        // Turn these off for all users
        $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
        $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
        $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
        $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
        $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
        $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
        $wp_admin_bar->remove_menu('customize');        // Remove the customize menu
        $wp_admin_bar->remove_menu('stats');        // Remove the customize menu

        // Turn these off for contributors
        if ( current_user_can( 'ogn_contributor' ) ) {

            // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
            $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
            $wp_admin_bar->remove_menu('updates');          // Remove the updates link
            $wp_admin_bar->remove_menu('comments');         // Remove the comments link
            $wp_admin_bar->remove_menu('new-content');      // Remove the content link
            $wp_admin_bar->remove_menu('w3tc');             // Remove the w3 total cache performance link
            // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
            $wp_admin_bar->remove_menu('my-sites');         // Remove the user details tab
            $wp_admin_bar->remove_menu('wpseo-menu');       // Remove the wpseo tab

        }

        // Turn these off for contributors
        if ( !current_user_can( 'manage_options' ) && ! current_user_can( 'ogn_contributor' )  ) {

            $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu

        }

    }



    /**
     * Modify display of metaboxes on post types for ogn_contributor role
     *
     * @param array $role
     */
    public function ogn_contributor_admin_metabox_view() {

        if ( current_user_can( 'ogn_contributor' ) ) {

            // Posts
            remove_meta_box( 'commentsdiv', 'post', 'normal' );
            remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
            remove_meta_box( 'postexcerpt', 'post', 'normal' );
            remove_meta_box( 'postcustom', 'post', 'normal' );
            remove_meta_box( 'sharing_meta', 'post', 'advanced' );

            // Events Calendar
            remove_meta_box( 'commentsdiv', 'tribe_events', 'normal' );
            remove_meta_box( 'commentstatusdiv', 'tribe_events', 'normal' );
            remove_meta_box( 'postexcerpt', 'tribe_events', 'normal' );
            remove_meta_box( 'postcustom', 'tribe_events', 'normal' );
            remove_meta_box( 'sharing_meta', 'tribe_events', 'advanced' );

            // Business Directory
            remove_meta_box( 'commentsdiv', 'wpbdp_listing', 'normal' );
            remove_meta_box( 'commentstatusdiv', 'wpbdp_listing', 'normal' );
            remove_meta_box( 'postexcerpt', 'wpbdp_listing', 'normal' );
            remove_meta_box( 'postcustom', 'wpbdp_listing', 'normal' );
            remove_meta_box( 'sharing_meta', 'wpbdp_listing', 'advanced' );
            // remove_meta_box( 'BusinessDirectory_listinginfo', 'wpbdp_listing', 'side' );

            // Recipes
            remove_meta_box( 'commentsdiv', 'recipe', 'normal' );
            remove_meta_box( 'commentstatusdiv', 'recipe', 'normal' );
            remove_meta_box( 'postexcerpt', 'recipe', 'normal' );
            remove_meta_box( 'postcustom', 'recipe', 'normal' );
            remove_meta_box( 'sharing_meta', 'recipe', 'advanced' );

            // Ingredients
            remove_meta_box( 'commentsdiv', 'ogn_ingredient', 'normal' );
            remove_meta_box( 'commentstatusdiv', 'ogn_ingredient', 'normal' );
            remove_meta_box( 'postexcerpt', 'ogn_ingredient', 'normal' );
            remove_meta_box( 'postcustom', 'ogn_ingredient', 'normal' );
            remove_meta_box( 'sharing_meta', 'ogn_ingredient', 'advanced' );


        }

    }



    /**
     * Modify dashboard profile for role ogn_contributor
     *
     * @param array $role
     */
    public function ogn_contributor_profile_dashboard() {

        if ( current_user_can( 'ogn_contributor' ) ) {

            remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

        }

    }

    /**
     * Dropdown of contributors in dashboard
     *
     * @global post
     */
    public function ourgreennation_switch_users() {

        global $post;

        if( get_post_type() != 'wpbdp_listing' ) {
            //global $post is available here, hence you can check for the post type here
            $admins = get_users('role=administrator');
            $contributors = get_users('role=ogn_contributor');

            echo '<select name="post_author" class="authors">';

            foreach($admins as $admin) {
                echo '<option value="' . $admin->ID . '">' . $admin->display_name . ' (' . $admin->user_login . ')</option>';
            }

            foreach($contributors as $contributor) {
                echo '<option value="' . $contributor->ID . '">' . $contributor->display_name . ' (' . $contributor->user_login . ')</option>';
            }

            echo'</select>';
        }

    }

    /**
     * Limit dashboard access to non-admins/contributors
     *
     */
    public function ourgreennation_limit_dashboard() {


        if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
            wp_redirect( site_url() );
            exit;
        }

    }


    /**
     * Removes Adbutler Dashboard Widget for Non Admins
     *
     * @return void
     */
    final public function fix_adbutler_dashboard_widget() {
        if ( ! current_user_can( 'manage_options' ) ) {
            global $wp_meta_boxes;
            remove_meta_box( 'adbutler_dashboard_summary', 'dashboard', 'normal' );
        }
    }
}
