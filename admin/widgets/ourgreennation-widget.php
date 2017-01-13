<?php
// Register our widget
add_action('widgets_init', 'ourgreenation_widgetname_load_widgets');
function ourgreenation_widgetname_load_widgets() {
	register_widget('ourgreenation_Widgetname_Widget');
}

class ourgreenation_Widgetname_Widget extends WP_Widget {

	function ourgreenation_Widgetname_Widget() {
		$widget_ops = array('classname' => 'ourgreenation_widgetname', 'description' => 'widgetdescription');

		$control_ops = array('id_base' => 'ourgreenation_widgetname-widget');

		$this->WP_Widget('ourgreenation_widgetname-widget', __( 'Widget_Name', 'ourgreenation_theme' ), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

        extract( $args );

        $title = $instance['title'];


		echo $before_widget;


		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
		                	'title' => 'Contributors'
		                );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ourgreenation_theme' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php }
}