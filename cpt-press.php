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
 * Description: Basic Custom Post Types. Custom Post Types include  Team, Clients, Portfolios, Case Study.
 * Version: 1.0.1
 * Author: Ahmad Raza
 * Author URI: http://ahmedraza.dev/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cptpress
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('CPT_PRESS_VERSION', '1.0.0');

defined('CPT_PRESS_NAME') or define('CPT_PRESS_NAME', 'ataki-team');

defined('CPT_PRESS_BASE_FILE') or define('CPT_PRESS_BASE_FILE', __FILE__);

define('CPT_PRESS_BASE_DIR', plugin_dir_path(__FILE__));

require 'class-cpt-press-portfolio-colors-metabox.php';
require 'class-cpt-press-template-loader.php';
require 'cpt-press-custom-post-type.php';

function cptpress_field_team_cpt($args)
{

    $options = get_option('cptpress_options_team');
    ?>

<input type="checkbox" data-custom="<?php echo esc_attr($args['cptpress_custom_data']); ?>"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="cptpress_options_team[<?php echo esc_attr($args['label_for']); ?>]"
        value="team" <?php echo (isset($options[$args['label_for']]) === true ? 'checked' : ''); ?>>
<label for="<?php echo esc_attr($args['label_for']); ?>"><?php esc_html_e('Team', 'cptpress');?></label><br>

	<p class="description">
		<?php esc_html_e('Check box to create team CPT', 'cptpress');?>
	</p>
<?php

}

function cptpress_field_portfolio_cpt($args)
{

    $options = get_option('cptpress_options_portfolio');
    ?>

<input type="checkbox" data-custom="<?php echo esc_attr($args['cptpress_custom_data']); ?>"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="cptpress_options_portfolio[<?php echo esc_attr($args['label_for']); ?>]"
        value="portfolio" <?php echo (isset($options[$args['label_for']]) === true ? 'checked' : ''); ?>>
<label for="<?php echo esc_attr($args['label_for']); ?>"><?php esc_html_e('Portfolio', 'cptpress');?></label><br>

	<p class="description">
		<?php esc_html_e('Check box to create team Portfolio CPT', 'cptpress');?>
	</p>
<?php

}

function cptpress_field_case_study_cpt($args)
{

    $options = get_option('cptpress_options_case_study');
    ?>

<input type="checkbox" data-custom="<?php echo esc_attr($args['cptpress_custom_data']); ?>"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="cptpress_options_case_study[<?php echo esc_attr($args['label_for']); ?>]"
        value="case_study" <?php echo (isset($options[$args['label_for']]) === true ? 'checked' : ''); ?>>
<label for="<?php echo esc_attr($args['label_for']); ?>"><?php esc_html_e('Case Study', 'cptpress');?></label><br>

	<p class="description">
		<?php esc_html_e('Check box to create team Case Study CPT', 'cptpress');?>
	</p>
<?php

}

function cptpress_field_client_cpt($args)
{

    $options = get_option('cptpress_options_clients');
    ?>

<input type="checkbox" data-custom="<?php echo esc_attr($args['cptpress_custom_data']); ?>"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="cptpress_options_clients[<?php echo esc_attr($args['label_for']); ?>]"
        value="clients" <?php echo (isset($options[$args['label_for']]) === true ? 'checked' : ''); ?>>
<label for="<?php echo esc_attr($args['label_for']); ?>"><?php esc_html_e('Client', 'cptpress');?></label><br>

	<p class="description">
		<?php esc_html_e('Check box to create team Client CPT', 'cptpress');?>
	</p>
<?php

}

/**
 * custom option and settings
 */
function cptpress_settings_init()
{
    // Register a new setting for page.
    register_setting('cptpress', 'cptpress_options_team');
    register_setting('cptpress', 'cptpress_options_portfolio');
    register_setting('cptpress', 'cptpress_options_case_study');
    register_setting('cptpress', 'cptpress_options_clients');

    // Register a new section in the page.
    add_settings_section(
        'cptpress_section_developers',
        __('', 'cptpress'), '',
        'cptpress'
    );

    add_settings_field(
        'cptpress_field_team_cpt',
        __('Register Team CPT', 'cptpress'),
        'cptpress_field_team_cpt',
        'cptpress',
        'cptpress_section_developers',
        array(
            'label_for' => 'cptpress_field_team_cpt',
            'class' => 'cptpress_row',
            'cptpress_custom_data' => 'custom',
        )
    );

    add_settings_field(
        'cptpress_field_portfolio_cpt',
        __('Register Portfolio CPT', 'cptpress'),
        'cptpress_field_portfolio_cpt',
        'cptpress',
        'cptpress_section_developers',
        array(
            'label_for' => 'cptpress_field_portfolio_cpt',
            'class' => 'cptpress_row',
            'cptpress_custom_data' => 'custom',
        )
    );

    add_settings_field(
        'cptpress_field_case_study_cpt',
        __('Register Case Study CPT', 'cptpress'),
        'cptpress_field_case_study_cpt',
        'cptpress',
        'cptpress_section_developers',
        array(
            'label_for' => 'cptpress_field_case_study_cpt',
            'class' => 'cptpress_row',
            'cptpress_custom_data' => 'custom',
        )
    );

    add_settings_field(
        'cptpress_field_client_cpt',
        __('Register Case Study CPT', 'cptpress'),
        'cptpress_field_client_cpt',
        'cptpress',
        'cptpress_section_developers',
        array(
            'label_for' => 'cptpress_field_client_cpt',
            'class' => 'cptpress_row',
            'cptpress_custom_data' => 'custom',
        )
    );

}

add_action('admin_init', 'cptpress_settings_init');

/**
 * Top level menu callback function
 */
function cptpress_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('cptpress_messages', 'cptpress_message', __('Settings Saved', 'cptpress'), 'updated');
    }

    // show error/update messages
    settings_errors('cptpress_messages');
    ?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<form action="options.php" method="post">
			<?php
// output security fields for the registered setting "cptpress"
    settings_fields('cptpress');
    // output setting sections and their fields
    // (sections are registered for "cptpress", each field is registered to a specific section)
    do_settings_sections('cptpress');
    // output save settings button
    submit_button('Save Settings');
    ?>
		</form>
	</div>
	<?php
}

/**
 * Add the top level menu page.
 */
function cptpress_options_page()
{
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
add_action('admin_menu', 'cptpress_options_page');
