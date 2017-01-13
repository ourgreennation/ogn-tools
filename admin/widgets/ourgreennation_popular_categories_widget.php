<?php
// Register our widget
add_action('widgets_init', 'ourgreenation_popular_categories_load_widgets');
function ourgreenation_popular_categories_load_widgets() {
	register_widget('ourgreenation_PopularCategories_Widget');
}

class ourgreenation_PopularCategories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'ourgreenation_popular_categories-widget',
			__( 'Popular Categories', 'our-green-nation' ),
			array( 'description' => __( 'Show the top popular categories', 'our-green-nation' ), )
		);
	}

	function widget($args, $instance) {

        extract( $args );

        $title = $instance['title'];


		echo $before_widget;

			echo '<h3>' . $title . '</h3>';

			echo '<ul>';
				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );
			echo '</ul>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
		                	'title' => 'Search Categories'
		                );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ourgreenation_theme' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php }
}