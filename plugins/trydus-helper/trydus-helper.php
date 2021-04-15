<?php
/**
 * Plugin Name: Trydus Helper
 * Description: Helper plugin for Trydus thme
 * Plugin URI:  https://uxtheme.net/
 * Version:     1.0.0
 * Author:      Grayic
 * Author URI:  https://uxtheme.net/
 * Text Domain: trydus-hp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Trydus_Helper {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Trydus_Helper The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Trydus_Helper An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'trydus-hp' );

	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
	
		require_once( __DIR__ . '/inc/elementor-extender.php' );
		require_once( __DIR__ . '/inc/custom-post-type.php' );

		$this->i18n();

		// Add Plugin actions
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/logo.php' );
		require_once( __DIR__ . '/widgets/menu.php' );
		require_once( __DIR__ . '/widgets/slider.php' );
		require_once( __DIR__ . '/widgets/heading.php' );
		require_once( __DIR__ . '/widgets/service.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Trydus_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Trydus_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Trydus_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Trydus_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Trydus_Service() );

	}

	/**
	 *  Trydus Helper Styles
	 */
	public function widget_styles() {

		wp_enqueue_style('owl-carousel', plugins_url('/assets/css/owl.carousel.min.css', __FILE__), [], microtime());
		wp_enqueue_style( 'fontawesome', plugins_url( 'assets/css/all.min.css', __FILE__ ) );
		wp_enqueue_style( 'trydus-addon', plugins_url( 'assets/css/addons.css', __FILE__ ) );

	}

	/**
	 *  Trydus Helper Styles
	 */
	public function widget_scripts() {

		wp_register_script('owl-carousel', plugins_url('/assets/js/owl.carousel.min.js', __FILE__), array(), '1.1.0', 'true'); 
        wp_enqueue_script('owl-carousel'); 
		wp_enqueue_script( 'trydus-addon', plugins_url( 'assets/js/addons.js', __FILE__ ), ['jquery'] );


	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'trydus-hp' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'trydus-hp' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'trydus-hp' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'trydus-hp' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'trydus-hp' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'trydus-hp' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'trydus-hp' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'trydus-hp' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'trydus-hp' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

Trydus_Helper::instance();


/**
 * adding new category
 */
function trydus_add_elementor_widget_categories($elements_manager)
{

	$elements_manager->add_category(
		'trydus-addons',
		[
			'title' => __('Trydus addons', 'trydus-hp'),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action('elementor/elements/categories_registered', 'trydus_add_elementor_widget_categories');