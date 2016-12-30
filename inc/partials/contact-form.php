<?php
// Validate form before sending
if ( isset( $_POST['vandam-contact-form-nonce'] ) &&
     wp_verify_nonce( $_POST['vandam-contact-form-nonce'], basename( __FILE__ ) )
) {
	$email   = get_option( 'admin_email' );
	$subject = 'VanDam Contact Form: New Message From ' . $_POST['contact-name'];
	$message = $_POST['contact-message'];

	$html = '<html><body>';
	$html .= '<p>Email: ' . $_POST['contact-email'] . '</p>';
	$html .= '<p>Name: ' . $_POST['contact-name'] . '</p>';
	$html .= wpautop( $message );
	$html .= '</body></html>';

	$headers = "From: " . strip_tags( $_POST['contact-email'] ) . "\r\n";
	$headers .= "Reply-To: " . strip_tags( $_POST['contact-email'] ) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	if ( wp_mail( $email, $subject, $html, $headers ) ) {
		?>
		<div data-alert class="alert-box success">
			Your message has been received and we will get back to you shortly.
			<a href="#" class="close">&times;</a>
		</div>
	<?php
	}
}
?>

<form id="contact-form" method="post" data-abide>

	<?php wp_nonce_field( basename( __FILE__ ), 'vandam-contact-form-nonce' ); ?>

	<h2>Email Us</h2>

	<div class="name-field">
		<label>
			Your name:
			<input type="text" required pattern="[a-zA-Z\s]+" name="contact-name"/>
		</label>
		<small class="error">Name is required and must be a string.</small>
	</div>

	<div class="email-field">
		<label>
			Your email:
			<input type="email" required name="contact-email"/>
		</label>
		<small class="error">An email address is required.</small>
	</div>

	<div class="message-field">
		<label>
			Your message:
			<textarea required name="contact-message"></textarea>
		</label>
		<small class="error">Your message is required.</small>
	</div>

	<input type="submit" value="Submit"/>
</form>