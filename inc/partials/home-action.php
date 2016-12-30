<?php
global $home_icons;
$home_icons[] = 'arrow-down';
?>

	<section id="home-action" class="hidden">
		<img class="home-action-image"
		     src="<?php echo get_stylesheet_directory_uri() . '/assets/images/house.jpg'; ?>"/>

		<div class="home-action-icons">
			<?php
			foreach ( $home_icons as $id ) :

				$heading = get_option( "vd_icon_{$id}_heading", false ) ? get_option( "vd_icon_{$id}_heading" ) : '';
				$body    = get_option( "vd_icon_{$id}_body", false ) ? get_option( "vd_icon_{$id}_body" ) : '';

				if ( $id !== 'information' && $id !== 'arrow-down' ) {
					$link = get_option( "vd_icon_{$id}_link", false ) ? get_option( "vd_icon_{$id}_link" ) : false;
					$link = $link ? get_permalink( $link ) : '';
				} else {
					$link = '#home-content';
				}
				?>
				<a href="<?php echo $link; ?>">
					<div class="icon-<?php echo $id;
					echo $id === 'arrow-down' ? ' hidden' : ''; ?>">
						<div class="color-fill">
							<div class="content">
								<h4 class="title">
									<?php echo $heading ?>
								</h4>

								<p class="body">
									<?php echo $body; ?>
								</p>
							</div>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

<?php
if ( ( $key = array_search( 'arrow-down', $home_icons ) ) !== false ) {
	unset( $home_icons[ $key ] );
}