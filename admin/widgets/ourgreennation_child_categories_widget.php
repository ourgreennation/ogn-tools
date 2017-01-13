<?php
// Register our widget
add_action('widgets_init', 'ourgreenation_child_categories_load_widgets');
function ourgreenation_child_categories_load_widgets() {
	register_widget('ourgreenation_Child_Categories_Widget');
}

class ourgreenation_Child_Categories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'ourgreenation_child_categories-widget',
			__( 'Child Categories', 'our-green-nation' ),
			array( 'description' => __( 'Display child categories of the current categor', 'our-green-nation' ), )
		);
	}


	function widget($args, $instance) {

        extract( $args );

        $title = $instance['title'];


		echo $before_widget;

			echo '<h3>' . $title . '</h3>';

		    if ( is_category() ) {
		    	$this_category = get_category( get_query_var('cat') );
		    }

			if ( $this_category->category_parent ) {

				$display_args = array (
					'orderby' 				=> 'id',
					'show_count'			=> 0,
					'title_li'				=> '',
					'use_desc_for_title'	=> 1,
					'child_of'				=> $this_category->category_parent,
					'echo'					=> 0,
				    );

			} else {

				$display_args = array (
					// 'orderby' 				=> 'id',
					// 'depth'					=> 1,
					'show_count'			=> 0,
					'title_li'				=> '',
					'use_desc_for_title'	=> 1,
					'child_of'				=> $this_category->cat_ID,
					'echo'					=> 0,
				    );

			}

			$display_category = wp_list_categories( $display_args );

			if ($display_category) {
				// var_dump($this_category);
				echo '<ul>';
					echo $display_category;
				echo '</ul>';
			}

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
		                	'title' => 'Find More Great Information'
		                );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ourgreenation_theme' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php }
}