<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://crock.fr
 * @since      1.0.0
 *
 * @package    My_Steam_Stuff
 * @subpackage My_Steam_Stuff/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

global $wpdb;
?>
<div class="wrap">
	<?php
    settings_errors();
  ?>
  <h1>Paramètres My Steam stuff</h1>
  <ul>
    <li><a href="https://steamcommunity.com/dev/apikey" target="_blank">Pour récupérer sa clé d'API Steam</a></li>
    <li><a href="http://steamrep.com" target="_blank">Pour récupérer son SteamID</a></li>
  </ul>
  <form method="post" action="options.php">
	  <?php
      settings_fields( 'mss_settings' );
      do_settings_sections( 'mss_settings' );
      submit_button();
	  ?>
  </form>
</div>