<?php

add_action( 'add_meta_boxes', '_vandam_metabox_contact_page_add' );

add_action( 'publish_page', '_vandam_metabox_contact_page_save' );
add_action( 'draft_page', '_vandam_metabox_contact_page_save' );
add_action( 'future_page', '_vandam_metabox_contact_page_save' );

function _vandam_metabox_contact_page_add() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'templates/contact.php' ) {

//		remove_post_type_support( 'page', 'editor' );
		remove_meta_box( 'postimagediv', 'page', 'side' );

		add_meta_box(
			'vandam-contact-page-gravity-form',
			'Form',
			'_vandam_metabox_contact_page_gravity_form',
			'page',
			'normal',
			'default'
		);

		add_meta_box(
			'vandam-contact-page-location-boxes',
			'Locations',
			'_vandam_metabox_contact_page_locations_output',
			'page',
			'normal',
			'default'
		);
	}
}

function _vandam_metabox_contact_page_gravity_form() {

	$forms = GFAPI::get_forms();

	if ( $forms ) : ?>
		<select name="contact_form">
			<?php foreach ( $forms as $form ) : ?>
				<option value="<?php echo $form['id']; ?>">
					<?php echo $form['title']; ?>
				</option>
			<?php endforeach; ?>
		</select>
	<?php endif;
}

function _vandam_metabox_contact_page_locations_output() {

	global $post;

	wp_nonce_field( basename( __FILE__ ), 'vandam_contact_page_template_nonce' );

	$locations  = get_option( 'vandam-locations' );
	$_locations = array(
		'kalamazoo',
		'grand rapids',
		'south haven',
	);
	if ( ! $locations || $locations !== $_locations ) {

		update_option( 'vandam-locations', $_locations );
	}

	$meta = get_post_meta( $post->ID, 'vandam_contact_page', true );

	$i = 0;
	foreach ( $locations as $location ) :
		$i ++;
		?>
		<div class="vandam-contact-inputs">
			<h3><?php echo ucwords( $location ); ?></h3>

			<p>
				<label>
					Address<br/>
					<textarea style="height: 70px"
					          name="vandam-locations[<?php echo $location; ?>][address]"><?php echo $meta[ $location ]['address']; ?></textarea>
				</label>

				<label>
					Phone<br/>
					<input type="text" name="vandam-locations[<?php echo $location; ?>][phone]"
					       value="<?php echo $meta[ $location ]['phone']; ?>"/>
				</label>

				<label>
					Fax<br/>
					<input type="text" name="vandam-locations[<?php echo $location; ?>][fax]"
					       value="<?php echo $meta[ $location ]['fax']; ?>"/>
				</label>
			</p>

			<div style="clear: both;"></div>
		</div>

		<?php echo $i !== count( $locations ) ? '<hr/>' : ''; ?>
		<?php
	endforeach;
}

function _vandam_metabox_contact_page_save( $post ) {

	if ( get_post_meta( $post, '_wp_page_template', true ) !== 'templates/contact.php' ) {
		return;
	}

	if ( ! isset( $_POST['vandam_contact_page_template_nonce'] ) ||
	     ! wp_verify_nonce( $_POST['vandam_contact_page_template_nonce'], basename( __FILE__ ) )
	) {
		return;
	}

	if ( isset( $_POST['vandam-locations'] ) ) {

		$new_meta = array();

		foreach ( $_POST['vandam-locations'] as $location => $all_meta ) {
			foreach ( $all_meta as $name => $value ) {
				$new_meta[ $location ][ $name ] = $value;
			}
		}

		update_post_meta( $post, 'vandam_contact_page', $new_meta );
	}

	if ( isset( $_POST['contact_form'] ) ) {
		update_post_meta( $post, 'contact_form', $_POST['contact_form']);
	} else {
		delete_post_meta( $post, 'contact_form' );
	}
}