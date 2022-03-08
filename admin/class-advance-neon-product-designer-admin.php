<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    advance-neon-product-designer
 * @subpackage advance-neon-product-designer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    advance-neon-product-designer
 * @subpackage advance-neon-product-designer/admin
 * @author     Your Name <email@example.com>
 */
class ANPD_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in ANPD_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ANPD_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/advance-neon-product-designer-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version, 'all' );

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
		 * defined in ANPD_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ANPD_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			'iris',
			admin_url( 'js/iris.min.js' ),
			array(
				'jquery-ui-draggable',
				'jquery-ui-slider',
				'jquery-touch-punch',
			),
			$this->version,
			1
		);

		$colorpicker_l10n = array(
			'clear'         => __( 'Clear' ),
			'defaultString' => __( 'Default' ),
			'pick'          => __( 'Select Color' ),
			'current'       => __( 'Current Color' ),
		);

		wp_localize_script(
			'wp-color-picker',
			'wpColorPickerL10n',
			$colorpicker_l10n
		);

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) .
			'js/advance-neon-product-designer-admin.js',
			array( 'jquery' ),
			$this->version,
			false
		);

		wp_enqueue_script(
			'vc-admin',
			plugin_dir_url( __FILE__ ) . 'js/vc-admin-utils-scripts.js',
			array(
				'jquery',
				'jquery-ui-sortable',
			),
			$this->version,
			false
		);

		wp_localize_script(
			'vc-admin',
			'home_url',
			array(
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			'data_var_1'	=> 'value 1',
			'data_var_2'	=> 'value 2',
			)
			
		);

		// wp_enqueue_script(
		// 	'select2-js',
		// 	plugin_dir_url( __FILE__ ) . 'js/select2.min.js',
		// 	array( 'jquery' ),
		// 	$this->version,
		// 	'all'
		// );

	}
	/**
	 * Builds all the plugin menu and submenu
	 */
	public function add_ANPD_parts_submenu() {
		global $submenu;
		add_menu_page( 
	        __( 'Advance Neon Product Designer', 'advance-neon-product-designer' ),
	        'ANPD',
	        'manage_options',
	        'edit.php?post_type=anpd-configurator',
	        false,
	        'dashicons-cart',
	        6
	    );
	    add_submenu_page(
			'edit.php?post_type=anpd-configurator',
			__( 'All Configurator', 'advance-neon-product-designer' ),
			__( 'All Configurator', 'advance-neon-product-designer' ),
			'manage_options',
			'edit.php?post_type=anpd-configurator',
			false,
		);
	    add_submenu_page(
			'edit.php?post_type=anpd-configurator',
			__( 'Add Configurator', 'advance-neon-product-designer' ),
			__( 'Add Configurator', 'advance-neon-product-designer' ),
			'manage_options',
			'post-new.php?post_type=anpd-configurator',
			false,
		);
	}
	/**
	 * Register the anpd postype.
	 */
	public function Rigister_cpt_ANPD(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/cpt-product-design.php';
	}


	// Add Meta Box to post
	public function anpd_add_repeter_meta_boxes($id,$title,$callback) {
		$screens = array( 'anpd-configurator' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				$id,
				__( $title, 'neon-product-designer' ),
				array( $this, $callback ),
				$screen
			);
		}
	}


	//Add backing meta box to post
	public function anpd_backing_repeter_meta_boxes(){
		$this->anpd_add_repeter_meta_boxes('anpd-backing-repeter-data','ANPD Backing','anpd_backing_meta_box_callback');
	}


	//meta box callback function for backing
	public function anpd_backing_meta_box_callback($post) {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/product-backing-option.php';
	}

	// Save backing Meta Box values
	public function anpd_backing_meta_box_save($post_id) {
		global $post;
		if (!isset($_POST['anpd-backings']) || !wp_verify_nonce($_POST['anpd-backings'], 'repeterBox-backings'))
			return;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;

		if (!current_user_can('edit_post', $post_id))
			return;

		$old = get_post_meta($post_id, 'anpd_backing_group', true);

		$new = array();
		$titles = $_POST['backing_title'];
		$price = $_POST['backing_price'];
		$count = count( $titles );
		for ( $i = 0; $i < $count; $i++ ) {
			if ( $titles[$i] != '' ) {
				$new[$i]['backing_title'] = stripslashes( strip_tags( $titles[$i] ) );
				$new[$i]['backing_price'] = stripslashes( $price[$i] );
			}
		}

		if ( !empty( $new ) && $new != $old ){
			update_post_meta( $post_id, 'anpd_backing_group', $new );
		} elseif ( empty($new) && $old ) {
			delete_post_meta( $post_id, 'anpd_backing_group', $old );
		}
		$anpd_backing= $_REQUEST['anpd_backing'];
		update_post_meta( $post_id, 'anpd_backing', $anpd_backing );
	}


	//Add colors meta box to post
	public function anpd_colors_repeter_meta_boxes(){
		$this->anpd_add_repeter_meta_boxes('anpd-colors-repeter-data','ANPD Colors','anpd_colors_meta_box_callback');
	}


	//meta box callback function for colors
	public function anpd_colors_meta_box_callback($post) {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/product-colors-option.php';
	}

	// Save colors Meta Box values
	public function anpd_colors_meta_box_save($post_id) {
		global $post;
		if (!isset($_POST['anpd-colors']) || !wp_verify_nonce($_POST['anpd-colors'], 'repeterBox-colors'))
			return;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;

		if (!current_user_can('edit_post', $post_id))
			return;

		$old = get_post_meta($post_id, 'anpd_color_group', true);

		$new = array();
		$titles = $_POST['title'];
		$getcolors = $_POST['getcolor'];
		$outputcolor = $_POST['outputcolor'];
		$price = $_POST['price'];
		$count = count( $titles );
		for ( $i = 0; $i < $count; $i++ ) {
			if ( $titles[$i] != '' ) {
				$new[$i]['title'] = stripslashes( strip_tags( $titles[$i] ) );
				$new[$i]['getcolor'] = stripslashes( $getcolors[$i] );
				$new[$i]['outputcolor'] = stripslashes( $outputcolor[$i] );
				$new[$i]['price'] = stripslashes( $price[$i] );
			}
		}

		if ( !empty( $new ) && $new != $old ){
			update_post_meta( $post_id, 'anpd_color_group', $new );
		} elseif ( empty($new) && $old ) {
			delete_post_meta( $post_id, 'anpd_color_group', $old );
		}
		$anpd_color= $_REQUEST['anpd_color'];
		update_post_meta( $post_id, 'anpd_color', $anpd_color );
	}

}



