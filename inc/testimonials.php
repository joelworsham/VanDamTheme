<?php

add_action( 'widgets_init', '_vandam_testimonial_widget' );
add_action( 'init', '_vandam_testimonial_posttype' );
add_filter( 'post_updated_messages', '_vandam_testimoinals_updated_messages' );

class VanDam_TestimonialWidget extends WP_Widget {

	function __construct() {

		parent::__construct(
			'vandam-testimonial',
			'Testimonials',
			array( 'description', 'Shows testimonials' )
		);
	}

	public function widget( $args, $instance ) {

		echo isset( $args['before_widget'] ) ? $args['before_widget'] : '';

		if ( isset( $instance['title'] ) ) {
			echo isset( $args['before_title'] ) ? $args['before_title'] : '';
			echo $instance['title'];
			echo isset( $args['after_title'] ) ? $args['after_title'] : '';
		}

		// Get testimonials
		$testimonials = get_posts( array(
			'post_type'   => 'testimonial',
			'orderby' => 'rand',
			'numberposts' => 3,
		) );

		if ( ! empty( $testimonials ) ) {
			foreach ( $testimonials as $testimonial ) {
				?>
				<div class="testimonial">
					<div class="content">
						<?php echo strip_tags( $testimonial->post_content ); ?>
					</div>

					<div class="author">
						- <?php echo $testimonial->post_title; ?>
					</div>
				</div>
			<?php
			}
		}

		echo isset( $args['after_widget'] ) ? $args['after_widget'] : '';
	}

	public function form( $instance ) {
		?>
		<p>
			<label>
				Title<br/>
				<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"
				       value="<?php echo isset( $instance['title'] ) ? $instance['title'] : ''; ?>"
			</label>
		</p>
	<?php
	}
}

function _vandam_testimonial_widget() {
	register_widget( 'VanDam_TestimonialWidget' );
}

function _vandam_testimonial_posttype() {

	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Testimonial' ),
		'edit_item'          => __( 'Edit Testimonial' ),
		'new_item'           => __( 'New Testimonial' ),
		'all_items'          => __( 'All Testimonials' ),
		'view_item'          => __( 'View Testimonial' ),
		'search_items'       => __( 'Search Testimonials' ),
		'not_found'          => __( 'No testimonials found' ),
		'not_found_in_trash' => __( 'No testimonials found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Testimonials',
		'public'        => false,
		'show_ui'       => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor' ),
		'menu_icon'     => 'dashicons-testimonial'
	);

	register_post_type( 'testimonial', $args );
}

function _vandam_testimoinals_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['testimonial'] = array(
		0  => '',
		1  => sprintf( __( 'Testimonial updated. <a href="%s">View testimonial</a>' ), esc_url( get_permalink( $post_ID ) ) ),
		2  => __( 'Custom field updated.' ),
		3  => __( 'Custom field deleted.' ),
		4  => __( 'Testimonial updated.' ),
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonial restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Testimonial published. <a href="%s">View testimonial</a>' ), esc_url( get_permalink( $post_ID ) ) ),
		7  => __( 'Testimonial saved.' ),
		8  => sprintf( __( 'Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9  => sprintf( __( 'Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}