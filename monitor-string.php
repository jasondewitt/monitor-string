<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.roxet.net
 * @since             1.0.0
 * @package           Monitor_String
 *
 * @wordpress-plugin
 * Plugin Name:       monitor-string
 * Plugin URI:        http://www.gitub.com/jasondewitt/monitor-string
 * Description:       Adds a random string to the footer of your WP theme for all your uptime monitor string matching needs.
 * Version:           1.0.0
 * Author:            Jason DeWitt
 * Author URI:        http://www.roxet.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       monitor-string
 * Domain Path:       /languages
 */

namespace Monitor_String;

define('PLUGIN_NAME', 'monitor-string');


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

# add admin setting page
function plugin_menu() {
  add_options_page( 'String Monitor Setup', 'String Monitor', 'manage_options', PLUGIN_NAME, __NAMESPACE__ . '\options_page' );
}

add_action( 'admin_menu', __NAMESPACE__ . '\plugin_menu');

function options_page() {
  ?>
  <script type="text/javascript">
    function randomString(length) {
        var result = '';
        var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
        return result;
    }
  </script>
  <div class="wrap">

      <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

      <form method="post" name="monitor_string_options" action="options.php">

        <?php
          //Grab all options
          $options = get_option(PLUGIN_NAME);

          $string_to_monitor = $options['string'];
          settings_fields(PLUGIN_NAME);
          do_settings_sections(PLUGIN_NAME);
        ?>
      <p>String to check for: <input type="text" id=<?php echo PLUGIN_NAME?>-string name="<?php echo PLUGIN_NAME?>[string]" value="<?php echo $string_to_monitor?>" class="regular-text" /><br /><br />
        <input class="button-secondary" type="button" onclick='jQuery("#monitor-string-string").val(randomString(32));' value="<?php esc_attr_e( 'Generate Random String' ); ?>" />
      <?php submit_button('Save', 'primary','submit', false); ?>

     </form>

  </div>

  <?php
}

function settings_init() {
   register_setting(PLUGIN_NAME, PLUGIN_NAME, __NAMESPACE__ . '\validate' );
}
add_action( 'admin_init', __NAMESPACE__ . '\settings_init' );

function validate($input) {
    // All checkboxes inputs
    $valid = array();

    if (isset($input['string']) && !empty($input['string'])) {
      $valid['string'] = sanitize_text_field($input['string']);
    } else {
      add_settings_error(
        'monitor_string_invalid',
        'monitor_string_empty',
        'please enter a string',
        'error'
      );
    }

    return $valid;

}

function render_monitor_string() {
	$string = get_option( PLUGIN_NAME, false )['string'];

	if ( ! $string ) {
		return;
	}

	printf( "<!-- Monitor-String %s -->", esc_html( $string ) );
}
add_action( 'wp_footer', __NAMESPACE__ . '\render_monitor_string', 1000 );
