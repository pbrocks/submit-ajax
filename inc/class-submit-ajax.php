<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Submit_AJAX();

class Submit_AJAX {

	public function __construct() {
		add_shortcode( 'submit-ajax-form', array( $this, 'parse_ajax_form' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'submit_ajax_scripts' ) );
		add_action( 'wp_ajax_tie_into_php', array( $this, 'parse_ajax_return_function' ) );
		add_action( 'wp_ajax_nopriv_tie_into_php', array( $this, 'parse_ajax_return_function' ) );
	}

	public function submit_ajax_scripts() {
		wp_enqueue_style( 'submit-ajax', plugins_url( '/css/submit-ajax.css', __FILE__ ) );
		wp_register_script( 'submit-ajax', plugins_url( '/js/submit-ajax.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script(
			'parse-ajax',
			'ajax_object',
			array(
				'parse_ajax_ajaxurl' => admin_url( 'admin-ajax.php' ),
				'parse_ajax_nonce'   => wp_create_nonce( 'parse-ajax-nonce' ),
				'parse_ajax_url'     => home_url( 'parse-ajax-nonce' ),
			)
		);
	}

	public function parse_ajax_scripts() {

		wp_enqueue_style( 'parse-ajax', plugins_url( '/css/parse-ajax.css', __FILE__ ) );
		wp_register_script( 'parse-ajax', plugins_url( '/js/parse-ajax-submit.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script(
			'parse-ajax',
			'ajax_object',
			array(
				'parse_ajax_ajaxurl' => admin_url( 'admin-ajax.php' ),
				'parse_ajax_nonce'   => wp_create_nonce( 'parse-ajax-nonce' ),
				'parse_ajax_url'     => home_url( 'parse-ajax-nonce' ),
				// 'get_notes' => json_encode( get_transient( 'notes' ) ),
			)
		);
	}

	public function parse_ajax_return_function() {
		// check nonce
		$nonce  = $_POST['parse_ajax_nonce'];
		$number = $_POST['number'];
		$notes  = get_transient( 'notes' );
		// if ( empty( $number ) ) {
			$number = 'no # given';
		// }
		$hidden = $_POST['hidden-number'];
		if ( ! wp_verify_nonce( $nonce, 'parse-ajax-nonce' ) ) {
			die( 'Busted! Nonce didn\'t verify' );
		}

		echo $notes;
		// generate the response
		$response = json_encode( $_POST );
		// response output
		// header( 'Content-Type: application/json' );
		echo $response;
		// echo json_decode( $response );
		echo $hidden;
		echo '<pre>';
		print_r( $_POST );
		echo '</pre>';
		// IMPORTANT: don't forget to "exit"
		exit;
	}

	public function parse_ajax_form() {
		wp_enqueue_script( 'parse-ajax' );
		?>
	<style type="text/css">

	</style>
	<section id="parse-ajax-section">
		<div class="form-signin">
			<h2>Input Title</h2>

			<div class="shortcode-wrapper">
				<form id="whatever-form">
					<input type="hidden" name="hidden-number" id="hidden-number" value="1287">
					<p>
						<label for="client-name">Your name</label>
						<input type="text" name="client-name" class="input-block-level" placeholder="Input Your Name">
					</p>
					<p>
						<label for="client-email">Email</label>
						<!-- ToDo: Filter check for email address -->
						<input type="email" required="required" name="client-email" class="input-block-level" placeholder="Input Your Email Address ( unfiltered )">
					</p>
					<p class="submit-wrapper">
						<button class="btn btn-large" id="submit-parse">Submit Form</button>
					</p>
				</form>
			</div>
		</div>

		<div id="the-parse-response"><div style="width: 77%; margin: 1rem auto; color: maroon;">This text will be replaced with the form data above. When you click <b><em>Submit Form</em></b>, the data is sent to AJAX, PHP prepares it, then ships it to Javascript, and JS will render in the browser here.</div></div>
	</section>
		<?php
		if ( isset( $hidden ) ) {
			echo $hidden;
		}
	}
}
