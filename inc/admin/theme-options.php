<?php

function _vandam_theme_options_output() {
	global $home_icons;

	if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
		?>
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p><strong>Settings saved.</strong></p>
		</div>
	<?php
	}
	?>
	<div class="wrap">
		<h2>Theme Options</h2>

		<form method="post" action="options.php">

			<?php submit_button(); ?>

			<?php settings_fields( 'vd_home_icons' ); ?>

			<h3>Home Icons</h3>
			<hr/>

			<ul class="vd-admin-icons">

				<?php
				foreach ( $home_icons as $id ) :

					$heading = get_option( "vd_icon_{$id}_heading", false ) ? get_option( "vd_icon_{$id}_heading" ) : '';
					$body    = get_option( "vd_icon_{$id}_body", false ) ? get_option( "vd_icon_{$id}_body" ) : '';
					$link    = get_option( "vd_icon_{$id}_link", false ) ? get_option( "vd_icon_{$id}_link" ) : 0;
					?>

					<li class="vd-admin-icon">
						<div class="container">
							<span class="icon-<?php echo $id; ?>"></span>

							<br/>

							<label>
								<span class="label">Icon Heading</span><br/>
								<input type="text" name="vd_icon_<?php echo $id; ?>_heading"
								       value="<?php echo $heading; ?>"/>
							</label>

							<br/>

							<label>
								<span class="label">Icon Body</span><br/>
								<textarea name="vd_icon_<?php echo $id; ?>_body"><?php echo $body; ?></textarea><br/>
								<em><span class="word-count"></span> characters remaining</em>
							</label>

							<?php if ( $id !== 'information' ) : ?>
								<label>
									<span class="label">Page to Link</span>
									<?php
									wp_dropdown_pages( array(
										'selected' => $link,
										'name'     => "vd_icon_{$id}_link",
									) );
									?>
								</label>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="clear"></div>

			<hr/>

			<?php submit_button(); ?>
		</form>
	</div>
<?php
}