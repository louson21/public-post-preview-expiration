<?php
/**
 * Plugin Name: PPP Extension
 * Description: Extends the Public Post Preview plugin with custom functionality.
 * Version: 1.0.4
 * Author: Louie Sonugan
 * Author URI: https://louiesonugan.com/
 * License: GPLv2 or later
 */

// Check if Public Post Preview plugin is active
if ( ! function_exists( 'pppex_is_ppp_active' ) ) {
	function pppex_is_ppp_active() {
		return class_exists( 'DS_Public_Post_Preview' );
	}
}

// Add settings menu in the WordPress admin panel
if ( ! function_exists( 'pppex_add_admin_menu' ) ) {
	function pppex_add_admin_menu() {
		add_options_page(
			'PPP Extension Settings',
			'PPP Extension',
			'manage_options',
			'pppex-expiration',
			'pppex_settings_page'
		);
	}
}

add_action( 'admin_menu', 'pppex_add_admin_menu' );

// Create the settings page
if ( ! function_exists( 'pppex_settings_page' ) ) {
	function pppex_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to access this page.', 'ppp-extension' ) );
		}
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'PPP Extension Settings', 'ppp-extension' ); ?></h1>
			
			<?php if ( ! pppex_is_ppp_active() ) : ?>
				<div class="notice notice-warning is-dismissible">
					<p><?php esc_html_e( 'Public Post Preview plugin is not active. This extension requires it to function.', 'ppp-extension' ); ?></p>
				</div>
			<?php endif; ?>
			
			<form method="post" action="options.php">
				<?php
				settings_fields( 'pppex_options' );
				do_settings_sections( 'pppex-expiration' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}

// Register settings
if ( ! function_exists( 'pppex_settings_init' ) ) {
	function pppex_settings_init() {
		register_setting( 
			'pppex_options', 
			'pppex_expiration_time', 
			array(
				'type' => 'integer',
				'sanitize_callback' => 'pppex_sanitize',
				'show_in_rest' => true,
			)
		);

		add_settings_section(
			'pppex_expiration_section',
			esc_html__( 'Expiration Time Settings for Public Post Preview', 'ppp-extension' ),
			'__return_false',
			'pppex-expiration'
		);

		add_settings_field(
			'pppex_expiration_time',
			esc_html__( 'Set Expiration Time (in minutes)', 'ppp-extension' ),
			'pppex_expiration_time_field',
			'pppex-expiration',
			'pppex_expiration_section'
		);
	}
}

// Settings link in the Plugins folder
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $actions ) {
	$settings_link = '<a href="options-general.php?page=pppex-expiration">' . esc_html__( 'Settings', 'ppp-extension' ) . '</a>';
	array_unshift( $actions, $settings_link );
	return $actions;
} );

add_action( 'admin_init', 'pppex_settings_init' );

// Secure the input before saving
if ( ! function_exists( 'pppex_sanitize' ) ) {
	function pppex_sanitize( $input ) {
		$input = intval( $input );
		if ( $input < 1 ) {
			$input = 1; // Minimum 1 minute
		} elseif ( $input > 43200 ) {
			$input = 43200; // Maximum 30 days
		}
		return $input;
	}
}

// Field for expiration time
if ( ! function_exists( 'pppex_expiration_time_field' ) ) {
	function pppex_expiration_time_field() {
		$value = get_option( 'pppex_expiration_time', 30 ); // Default to 30 minutes
		?>
		<input type="number" name="pppex_expiration_time" value="<?php echo esc_attr( $value ); ?>" min="1" max="43200" step="1"> 
		<span><?php esc_html_e( 'minute(s)', 'ppp-extension' ); ?></span>
		<p class="description"><?php esc_html_e( 'Set between 1 minute and 43200 minutes (30 days)', 'ppp-extension' ); ?></p>
		<?php
	}
}

// Modify nonce expiration dynamically
if ( ! function_exists( 'pppex_nonce_life' ) ) {
	function pppex_nonce_life( $nonce_life ) {
		if ( pppex_is_ppp_active() ) {
			$custom_expiration = get_option( 'pppex_expiration_time', 30 );
			return (int) $custom_expiration * 60;
		}
		return $nonce_life;
	}
}

add_filter( 'ppp_nonce_life', 'pppex_nonce_life' );

?>