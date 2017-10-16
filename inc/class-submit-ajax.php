<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Submit_AJAX();

class Submit_AJAX {

	public function __construct() {
		add_shortcode( 'parse-ajax-form', array( $this, 'parse_ajax_form' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'parse_ajax_scripts' ) );
		add_action( 'wp_ajax_tie_into_php', array( $this, 'parse_ajax_return_function' ) );
		add_action( 'wp_ajax_nopriv_tie_into_php', array( $this, 'parse_ajax_return_function' ) );
	}

	public function parse_ajax_scripts() {

		wp_enqueue_style( 'parse-ajax', plugins_url( '/css/parse-ajax.css', __FILE__ ) );
		wp_enqueue_script( 'parse-ajax', plugins_url( '/js/parse-ajax-submit.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script(
			'parse-ajax', 'Parse_Ajax', array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'parse_ajax_nonce' => wp_create_nonce( 'parse-ajax-nonce' ),
			)
		);

	}

	public function parse_ajax_return_function() {
		// check nonce
		$nonce = $_POST['parse_ajax_nonce'];
		$number = $_POST['number'];
		$hidden = $_POST['hidden-number'];
		if ( ! wp_verify_nonce( $nonce, 'parse-ajax-nonce' ) ) {
			die( 'Busted! Nonce didn\'t verify' );
		}

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
	?>
		<div class="form-signin">
			<h2>Input Title</h2>

			<div class="control-group wrapper">
				<form id="whatever-form">
					<input type="hidden" name="hidden-number" id="hidden-number" value="1287">
					<p>
						<label for="">Your name</label>
						<input type="text" name="number" class="input-block-level" placeholder="Input Number">
					</p>
					<p>
						<label for="">Email</label>
						<input type="text" required="required" name="title" class="input-block-level" placeholder="Input Title">
					</p>
					<p class="submit-wrapper">
						<button class="btn btn-large" id="submit-parse">Submit Parse</button>
					</p>
				</form>
			</div>
		</div>
		<div id="the-parse-response"></div>
		<?php
		if ( isset( $hidden ) ) {
			echo $hidden;
		}
	}
}
