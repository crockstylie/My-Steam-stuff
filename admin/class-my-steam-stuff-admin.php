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
	 * Registers the admin menu element
	 */
	public function register_mss_admin_menu_elements(  ) {
		add_menu_page(
			'My Steam stuff',
			'My Steam stuff',
			'activate_plugins',
			'mss',
			array(
				$this,
				'register_mss_admin_display'
			),
			'dashicons-heart',
			'2'
		);
	}

	/**
	 * Registers the admin page display
	 */
	public function register_mss_admin_display(  ) {
		require_once plugin_dir_path( __FILE__ ) . 'partials/my-steam-stuff-admin-display.php';
	}

	/**
	 * Registers the defaults settings values
	 *
	 * @return array
	 */
	public function default_mss_settings_values() {
		$defaults = array(
			'key'                       => '491FEDB45824501BAA0025982807E08A',
			'steamid'                   => '76561198048836101',
			'format'                    => 'json',
			'include_played_free_games' => '1',
			'include_appinfo'           => '1'
		);
		return $defaults;
	}

	public function mss_settings_form_callback() {
		$options = get_option('mss_settings');
	}

	public function mss_key_setting_callback() {
		$options = get_option( 'mss_settings' );
		echo '<input type="text" id="mss-key" name="mss_settings[key]" value="' . $options['key'] . '" />';
	}

	public function mss_steamid_setting_callback() {
		$options = get_option( 'mss_settings' );
		echo '<input type="text" id="mss-steamid" name="mss_settings[steamid]" value="' . $options['steamid'] . '" />';
	}

	public function mss_format_setting_callback() {
		$options = get_option( 'mss_settings' );
		$radioInputDisplay = '<input type="radio" name="mss_settings[format]" value="json"';
		$radioInputDisplay .= checked('json', $options['format'], false);
		$radioInputDisplay .= '>json';
		$radioInputDisplay .= '&nbsp;&nbsp;';
		$radioInputDisplay .= '<input type="radio" name="mss_settings[format]" value="xml"';
		$radioInputDisplay .= checked('xml', $options['format'], false);
		$radioInputDisplay .= '>xml';
		$radioInputDisplay .= '&nbsp;&nbsp;';
		$radioInputDisplay .= '<input type="radio" name="mss_settings[format]" value="vdf"';
		$radioInputDisplay .= checked('vdf', $options['format'], false);
		$radioInputDisplay .= '>vdf';
		echo $radioInputDisplay;
	}

	public function mss_include_played_free_games_setting_callback() {
		$options = get_option( 'mss_settings' );
		$radioInputDisplay = '<input type="radio" name="mss_settings[include_played_free_games]" value="1"';
		$radioInputDisplay .= checked(1, $options['include_played_free_games'], false);
		$radioInputDisplay .= '>Oui';
		$radioInputDisplay .= '&nbsp;&nbsp;';
		$radioInputDisplay .= '<input type="radio" name="mss_settings[include_played_free_games]" value="0"';
		$radioInputDisplay .= checked(0, $options['include_played_free_games'], false);
		$radioInputDisplay .= '>Non';
		echo $radioInputDisplay;
	}

	public function mss_include_appinfo_setting_callback() {
		$options = get_option( 'mss_settings' );
		$radioInputDisplay = '<input type="radio" name="mss_settings[include_appinfo]" value="1"';
		$radioInputDisplay .= checked(1, $options['include_appinfo'], false);
		$radioInputDisplay .= '>Oui';
		$radioInputDisplay .= '&nbsp;&nbsp;';
		$radioInputDisplay .= '<input type="radio" name="mss_settings[include_appinfo]" value="0"';
		$radioInputDisplay .= checked(0, $options['include_appinfo'], false);
		$radioInputDisplay .= '>Non';
		echo $radioInputDisplay;
	}

	public function validate_mss_settings( $input ) {
		$output = array();
		foreach( $input as $key => $value ) {
			if( isset( $input[$key] ) ) {
				$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			}
		}
		return apply_filters( 'validate_input_examples', $output, $input );
	}

	public function register_mss_settings(  ) {
		if( false == get_option( 'mss_settings' ) ) {
			$default_array = $this->default_mss_settings_values();
			update_option( 'mss_settings', $default_array );
		}

		add_settings_section(
			'mss_settings_section',
			__( 'Options pour My Steam stuff', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_settings_form_callback'),
			'mss_settings'
		);

		add_settings_field(
			'key',
			__( 'Clé API Steam', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_key_setting_callback'),
			'mss_settings',
			'mss_settings_section'
		);

		add_settings_field(
			'steamid',
			__( 'Votre SteamID', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_steamid_setting_callback'),
			'mss_settings',
			'mss_settings_section'
		);

		add_settings_field(
			'format',
			__( 'Format de la réponse', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_format_setting_callback'),
			'mss_settings',
			'mss_settings_section'
		);

		add_settings_field(
			'include_played_free_games',
			__( 'Inclure les jeux gratuits auxquels vous avez déjà joué', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_include_played_free_games_setting_callback'),
			'mss_settings',
			'mss_settings_section'
		);

		add_settings_field(
			'include_appinfo',
			__( 'Inclure les informations sur les jeux (titres, images)', 'my-steam-stuff-plugin' ),
			array( $this, 'mss_include_appinfo_setting_callback'),
			'mss_settings',
			'mss_settings_section'
		);

		register_setting(
			'mss_settings',
			'mss_settings',
			array( $this, 'validate_mss_settings')
		);
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
