<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );


class Guten_JAX {

	public function __construct() {
		// add_shortcode( 'guten-jax-form', array( $this, 'guten_ajax_form' ) );
		// add_action( 'wp_enqueue_scripts', array( $this, 'guten_ajax_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'guten_ajax_scripts' ), time() );
		add_action( 'wp_ajax_tie_into_guten', array( $this, 'guten_ajax_return_function' ) );
		add_action( 'wp_ajax_nopriv_tie_into_guten', array( $this, 'guten_ajax_return_function' ) );
	}

	public function guten_ajax_scripts() {
		// wp_enqueue_style( 'guten-jax', plugins_url( '/css/guten-jax.css', __FILE__ ) );
		wp_register_script( 'guten-jax', plugins_url( '/js/guten-jax-submit.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script(
			'guten-jax', 'guten_ajax_object', array(
				'guten_ajax_ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'guten_nerd' => 'guten-jax-nonce',
				// 'guten_ajax_nonce' => wp_create_nonce( 'guten-jax-nonce' ),
			)
		);

	}

	public function guten_ajax_return_function() {
		// check nonce
		// if ( ! wp_verify_nonce( $nonce, 'guten-jax-nonce' ) ) {
			// die( 'Busted! Nonce didn\'t verify' );
			// echo 'Busted! Nonce didn\'t verify';
		// }
		$ajax = $_POST;
		$ajax['value'] = 'tantam';

		echo '<pre>';
		print_r( $_POST );
		echo '</pre>';
		// IMPORTANT: don't forget to "exit"
		exit;

	}

	public function guten_ajax_form() {
		wp_enqueue_script( 'guten-jax' );
	?>
	<style type="text/css">

	</style>
	<section id="guten-jax-section">
		<div class="form-signin">
			<h2>Input Title</h2>

			<div class="shortcode-wrapper">
				<form id="the-guten-form">
					<p>
						<label for="client-name">Your name</label>
						<input type="text" name="client-name" id="client-name" value="input-block-level" placeholder="Input Your Name">
					</p>
					<p>
						<label for="client-email">Email</label>
						<!-- ToDo: Filter check for email address -->
						<input type="email" value="address@ema.il" id="client-email" name="client-email" class="input-block-level" placeholder="Input Your Email Address ( unfiltered )">
					</p>
					<p class="submit-wrapper">
						<button class="btn btn-large" id="submit-guten">Guten Form</button>
					</p>
				</form>
			</div>
		</div>

		<div id="the-guten-response"><div style="width: 77%; margin: 1rem auto; color: maroon;">This text will be replaced with the form data above. When you click <b><em>Guten Form</em></b>, the data is sent to AJAX, PHP prepares it, then ships it to Javascript, and JS will render in the browser here.</div></div>
	</section>
		<?php
		if ( isset( $hidden ) ) {
			echo $hidden;
		}
	}
}
new Guten_JAX();
