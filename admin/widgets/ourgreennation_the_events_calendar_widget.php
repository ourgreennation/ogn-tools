<?php
// Register our widget
add_action('widgets_init', 'ourgreenation_tribe_upcoming_events_load_widgets');
function ourgreenation_tribe_upcoming_events_load_widgets() {
	register_widget('ourgreenation_Tribe_Upcoming_Events_Widget');
}

class ourgreenation_Tribe_Upcoming_Events_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'ourgreenation_tribe_upcoming_events-widget',
			__( 'Upcoming Events', 'our-green-nation' ),
			array(
			      'description' => __( 'Show upcoming events from The Events Calendar', 'our-green-nation' ),
			      'classname' => 'tribe-events-adv-list-widget',
			      )
		);
	}
	// tribe-events-adv-list-widget

	function widget($args, $instance) {

        extract( $args );

        $title = $instance['title'];
        $number_events = $instance['number_events'];


		echo $before_widget;

			echo '<h3>' . $title . '</h3>';

			// WP_Query arguments
			$event_args = array (
				'post_type'  				=> 'tribe_events',
				'cache_results' 			=> true,
				'update_post_meta_cache' 	=> true,
				'update_post_term_cache' 	=> true,
				'ignore_sticky_posts'   	=> true,
				'posts_per_page'         	=> $number_events,
			);

			// The Query
			$event_query = new WP_Query( $event_args );

			if( $event_query->have_posts() ):

				while( $event_query->have_posts() ) : $event_query->the_post();

					echo '<div class="type-tribe_events">';

						echo '<div class="tribe-mini-calendar-event">';
							echo '<div class="list-date">';
								echo '<span class="list-dayname">' . tribe_get_start_date( null, true, 'M' ) . '</span>';
								echo '<span class="list-daynumber">' . tribe_get_start_date( null, true, 'j' ) . '</span>';
							echo '</div>';

							echo '<div class="list-info">';
								echo '<h2 class="tribe-events-title">';
									echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
								echo '</h2>';

								echo '<div class="tribe-events-duration">';
									// echo '<span class="tribe-event-date-start">November 30 @ 12:30 pm</span> - <span class="tribe-event-time">2:30 pm</span> <span class="timezone"> MST </span>';
									echo tribe_events_event_schedule_details();
								echo '</div>';
							echo '</div> <!-- .list-info -->';
						echo '</div>';

					echo '</div>';

					wp_reset_postdata();

				endwhile;

			wp_reset_query();

			echo '<p class="tribe-events-widget-link"><a href="' . get_home_url() . '/events/" rel="bookmark">View More…</a></p>';

			endif;

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['number_events'] = $new_instance['number_events'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
		                	'title' => 'Attend an Event',
		                	'number_events' => 5
		                );

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'ourgreenation_theme' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number_events'); ?>"><?php _e( 'Number of Events to Show', 'ourgreenation_theme' ) ?></label>
			<input type="number" class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('number_events'); ?>" name="<?php echo $this->get_field_name('number_events'); ?>" value="<?php echo $instance['number_events']; ?>" />
		</p>
	<?php }
}