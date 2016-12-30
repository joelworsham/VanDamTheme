<?php
/*
 * Template Name: Contact Page
 */
get_header();

global $post;
the_post();

$locations = get_option( 'vandam-locations' );
$meta      = get_post_meta( $post->ID, 'vandam_contact_page', true );

$alt = isset( $_GET['contact-alt'] ) ? true : false;
?>

	<div class="body-content contact">

		<h1 class="page-title">
			<?php the_title(); ?>
			<?php edit_post_link( '<span class="icon-pencil"></span>' ); ?>
		</h1>

		<?php the_content(); ?>

		<?php // Contact Locations ?>
		<div class="row">

			<div class="columns small-12 hide-for-large-up">
				<a href="#contact-locations" class="button full-width">Locations</a>
				<a href="#contact-map" class="button full-width">Map</a>
				<a href="#contact-form" class="button full-width">Email</a>
			</div>

			<div class="clear"></div>

			<div id="contact-locations" class="columns small-12" itemscope itemtype="http://schema.org/LocalBusiness">
				<div class="row">
					<?php foreach ( $locations as $location ) :
						$googlelocations[] = array(
							'address' => $meta[ $location ]['address'],
							'name'    => ucwords( $location ),
						); ?>
						<div class="columns small-12 large-4">
							<div class="container">
								<h3>
									<?php echo ucwords( $location ); ?>
								</h3>

								<?php if ( ! empty( $meta[ $location ]['address'] ) ) : ?>
									<p class="address" itemprop="address">
										<?php echo wpautop( $meta[ $location ]['address'] ); ?>
									</p>
								<?php endif; ?>

								<?php if ( ! empty( $meta[ $location ]['phone'] ) ) : ?>
									<p class="phone" itemprop="telephone">
										<?php echo $meta[ $location ]['phone']; ?>
									</p>
								<?php endif; ?>

								<?php if ( ! empty( $meta[ $location ]['fax'] ) ) : ?>
									<p class="fax" itemprop="faxNumber">
										Fax: <?php echo $meta[ $location ]['fax']; ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php // Google Map ?>
			<div id="contact-map" class="columns small-12 large-6">
				<div id="google-map" style="width: 100%; height:400px;"></div>

				<script type="text/javascript">
					jQuery('#google-map').data('locations', <?php echo json_encode( $googlelocations ); ?>);
				</script>
			</div>

			<?php // Contact Form ?>
			<?php if ( function_exists( 'gravity_form' ) && $form = get_post_meta( get_the_ID(), 'contact_form', true ) ) : ?>
				<div id="contact-form" class="columns small-12 large-6">
					<?php gravity_form( $form, false, false ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>