<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.roxet.net
 * @since      1.0.0
 *
 * @package    Monitor_String
 * @subpackage Monitor_String/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form method="post" name="monitor_string_options" action="options.php">

      <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        $string_to_monitor = $options['string'];
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
      ?>
    <p>String to check for: <input type="text" id=<?php echo $this->plugin_name?>-string name="<?php echo $this->plugin_name?>[string]" value="<?php echo $string_to_monitor?>" class="regular-text" /><br />

    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

   </form>

</div>
