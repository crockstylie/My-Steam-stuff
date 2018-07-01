<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    My_Steam_Stuff
 * @subpackage My_Steam_Stuff/admin
 * @author     Your Name <email@example.com>
 */
class My_Steam_Stuff_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $my_steam_stuff    The ID of this plugin.
	 */
	private $my_steam_stuff;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $my_steam_stuff       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $my_steam_stuff, $version ) {

		$this->my_steam_stuff = $my_steam_stuff;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Steam_Stuff_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Steam_Stuff_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->my_steam_stuff, plugin_dir_url( __FILE__ ) . 'css/my-steam-stuff-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Steam_Stuff_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Steam_Stuff_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->my_steam_stuff, plugin_dir_url( __FILE__ ) . 'js/my-steam-stuff-admin.js', array( 'jquery' ), $this->version, false );

	}

}
