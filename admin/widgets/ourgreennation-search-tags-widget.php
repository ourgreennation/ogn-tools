<?php
// Register our widget
add_action('widgets_init', 'ourgreenation_search_tags_load_widgets');
function ourgreenation_search_tags_load_widgets() {
	register_widget('ourgreenation_Search_Tags_Widget');
}

class ourgreenation_Search_Tags_Widget extends WP_Widget {

	function ourgreenation_Search_Tags_Widget() {
		$widget_ops = array('classname' => 'ourgreenation_search_tags', 'description' => 'Search by tags only');

		$control_ops = array('id_base' => 'ourgreenation_search_tags-widget');

		$this->WP_Widget('ourgreenation_search_tags-widget', __( 'Search Tags', 'ourgreenation_theme' ), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

        extract( $args );

        $title = $instance['title'];


		echo $before_widget;

		?>

		<form role="search" method="get" id="searchform" action="/">
		<div>
		<label for="s">Search for:</label>
		<input type="text" value="" name="tag" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
		</div>
		</form>

		<?php

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
		                	'title' => 'Search by Tag'
		                );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ourgreenation_theme' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php }
}