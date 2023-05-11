<?php
/**
 * Basic Custom Post Types. Custom Post Types include Team, Clients,
 * Portfolios, Our Story and Testimonials.
 *
 * @package CPTpress
 *
 * @wordpress-plugin
 * Plugin Name: CPT Press
 * Plugin URI:  https://github.com/Ahmadraza9/cptpress
 * Description: Basic Custom Post Types. Custom Post Types includes  Team, Portfolio, Case Study, Clients, FAQs. You can  register and unregister CPTs.
 * Version: 1.3.0
 * Author: Ahmad Raza
 * Author URI: http://ahmedraza.dev/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cptpress
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'CPT_PRESS_VERSION', '1.3.0' );

defined( 'CPT_PRESS_NAME' ) or define( 'CPT_PRESS_NAME', 'ataki-team' );

defined( 'CPT_PRESS_BASE_FILE' ) or define( 'CPT_PRESS_BASE_FILE', __FILE__ );

define( 'CPT_PRESS_BASE_DIR', plugin_dir_path( __FILE__ ) );

require 'class-cpt-press-portfolio-colors-metabox.php';
require 'class-cpt-press-template-loader.php';
require 'cpt-press-custom-post-type.php';


require 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/AhmadRaza9/cptpress/',
	__FILE__,
	'cptpress'
);


//$UpdateChecker->setBranch('main');
$UpdateChecker->getVcsApi()->enableReleaseAssets();


function cptpress_field_team_cpt( $args ) {

	$options = get_option( 'cptpress_options_team' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_team[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="team" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'Team', 'cptpress' ); ?></label><br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create Team CPT', 'cptpress' ); ?>
    </p>
	<?php

}

function cptpress_field_portfolio_cpt( $args ) {

	$options = get_option( 'cptpress_options_portfolio' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_portfolio[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="portfolio" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'Portfolio', 'cptpress' ); ?></label>
    <br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create Portfolio CPT', 'cptpress' ); ?>
    </p>
	<?php

}

function cptpress_field_case_study_cpt( $args ) {

	$options = get_option( 'cptpress_options_case_study' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_case_study[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="case_study" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'Case Study', 'cptpress' ); ?></label>
    <br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create Case Study CPT', 'cptpress' ); ?>
    </p>
	<?php

}

function cptpress_field_client_cpt( $args ) {

	$options = get_option( 'cptpress_options_clients' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_clients[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="clients" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'Client', 'cptpress' ); ?></label><br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create Client CPT', 'cptpress' ); ?>
    </p>
	<?php

}

function cptpress_field_faqs_cpt( $args ) {

	$options = get_option( 'cptpress_options_faqs' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_faqs[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="faqs" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'FAQs', 'cptpress' ); ?></label><br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create FAQs CPT', 'cptpress' ); ?>
    </p>
	<?php

}

function cptpress_field_book_cpt( $args ) {

	$options = get_option( 'cptpress_options_book' );
	?>

    <input type="checkbox" data-custom="<?php echo esc_attr( $args['cptpress_custom_data'] ); ?>"
           id="<?php echo esc_attr( $args['label_for'] ); ?>"
           name="cptpress_options_book[<?php echo esc_attr( $args['label_for'] ); ?>]"
           value="book" <?php echo( isset( $options[ $args['label_for'] ] ) === true ? 'checked' : '' ); ?>>
    <label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php esc_html_e( 'Book', 'cptpress' ); ?></label>
    <br>

    <p class="description">
		<?php esc_html_e( 'Check the box to create Book CPT', 'cptpress' ); ?>
    </p>
	<?php

}

/**
 * custom option and settings
 */
function cptpress_settings_init() {
	// Register a new setting for page.
	register_setting( 'cptpress', 'cptpress_options_team' );
	register_setting( 'cptpress', 'cptpress_options_portfolio' );
	register_setting( 'cptpress', 'cptpress_options_case_study' );
	register_setting( 'cptpress', 'cptpress_options_clients' );
	register_setting( 'cptpress', 'cptpress_options_faqs' );
	register_setting( 'cptpress', 'cptpress_options_book' );


	// Register a new section in the page.
	add_settings_section(
		'cptpress_section_developers',
		__( '', 'cptpress' ), '',
		'cptpress'
	);

	add_settings_field(
		'cptpress_field_team_cpt',
		__( 'Register Team CPT', 'cptpress' ),
		'cptpress_field_team_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_team_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );

	add_settings_field(
		'cptpress_field_portfolio_cpt',
		__( 'Register Portfolio CPT', 'cptpress' ),
		'cptpress_field_portfolio_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_portfolio_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );

	add_settings_field(
		'cptpress_field_case_study_cpt',
		__( 'Register Case Study CPT', 'cptpress' ),
		'cptpress_field_case_study_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_case_study_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );

	add_settings_field(
		'cptpress_field_client_cpt',
		__( 'Register Client CPT', 'cptpress' ),
		'cptpress_field_client_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_client_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );

	add_settings_field(
		'cptpress_field_faqs_cpt',
		__( 'Register FAQs CPT', 'cptpress' ),
		'cptpress_field_faqs_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_faqs_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );
	add_settings_field(
		'cptpress_field_book_cpt',
		__( 'Register Book CPT', 'cptpress' ),
		'cptpress_field_book_cpt',
		'cptpress',
		'cptpress_section_developers',
		array(
			'label_for'            => 'cptpress_field_book_cpt',
			'class'                => 'cptpress_row',
			'cptpress_custom_data' => 'custom',
		) );

}

add_action( 'admin_init', 'cptpress_settings_init' );

/**
 * Top level menu callback function
 */
function cptpress_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'cptpress_messages', 'cptpress_message', __( 'Settings Saved', 'cptpress' ), 'updated' );
	}

	// show error/update messages
	settings_errors( 'cptpress_messages' );
	?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "cptpress"
			settings_fields( 'cptpress' );
			// output setting sections and their fields
			// (sections are registered for "cptpress", each field is registered to a specific section)
			do_settings_sections( 'cptpress' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
        </form>
    </div>
	<?php
}

/**
 * Add the top level menu page.
 */
function cptpress_options_page() {
	add_menu_page(
		'CPT Press',
		'CPT Press',
		'manage_options',
		'options.php',
		'cptpress_options_page_html',
		'dashicons-list-view',
		null
	);

}

/**
 * Register our wporg_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'cptpress_options_page' );
