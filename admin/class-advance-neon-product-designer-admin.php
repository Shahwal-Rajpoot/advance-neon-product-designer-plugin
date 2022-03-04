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

			$labels = array(
				'name' => _x( 'Configurator', 'Post Type General Name', 'advance-neon-product-designer' ),
				'singular_name' => _x( 'Configurator ', 'Post Type Singular Name', 'advance-neon-product-designer' ),
				'menu_name' => _x( 'APDS', 'Admin Menu text', 'advance-neon-product-designer' ),
				'name_admin_bar' => _x( 'Configurator ', 'Add New on Toolbar', 'advance-neon-product-designer' ),
				'archives' => __( 'Configurator  Archives', 'advance-neon-product-designer' ),
				'attributes' => __( 'Configurator  Attributes', 'advance-neon-product-designer' ),
				'parent_item_colon' => __( 'Parent Configurator :', 'advance-neon-product-designer' ),
				'all_items' => __( 'All APDS', 'advance-neon-product-designer' ),
				'add_new_item' => __( 'Add New Configurator ', 'advance-neon-product-designer' ),
				'add_new' => __( 'Add New Configurator', 'advance-neon-product-designer' ),
				'new_item' => __( 'New Configurator ', 'advance-neon-product-designer' ),
				'edit_item' => __( 'Edit Configurator ', 'advance-neon-product-designer' ),
				'update_item' => __( 'Update Configurator ', 'advance-neon-product-designer' ),
				'view_item' => __( 'View Configurator ', 'advance-neon-product-designer' ),
				'view_items' => __( 'View Configurator', 'advance-neon-product-designer' ),
				'search_items' => __( 'Search Configurator ', 'advance-neon-product-designer' ),
				'not_found' => __( 'Not found', 'advance-neon-product-designer' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'advance-neon-product-designer' ),
				'featured_image' => __( 'Featured Image', 'advance-neon-product-designer' ),
				'set_featured_image' => __( 'Set featured image', 'advance-neon-product-designer' ),
				'remove_featured_image' => __( 'Remove featured image', 'advance-neon-product-designer' ),
				'use_featured_image' => __( 'Use as featured image', 'advance-neon-product-designer' ),
				'insert_into_item' => __( 'Insert into Configurator ', 'advance-neon-product-designer' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Configurator ', 'advance-neon-product-designer' ),
				'items_list' => __( 'APDS list', 'advance-neon-product-designer' ),
				'items_list_navigation' => __( 'APDS list navigation', 'advance-neon-product-designer' ),
				'filter_items_list' => __( 'Filter APDS list', 'advance-neon-product-designer' ),
			);
			$args = array(
				'label' => __( 'Configurator ', 'advance-neon-product-designer' ),
				'description' => __( 'Advance Neon Product Designer By Qwerty Experts', 'advance-neon-product-designer' ),
				'labels' => $labels,
				'menu_icon' => '',
				'supports' => array('title'),
				'taxonomies' => array(),
				'public' => false,
				'show_ui' => true,
				'show_in_menu' => false,
				'menu_position' => 5,
				'show_in_admin_bar' => false,
				'show_in_nav_menus' => false,
				'can_export' => true,
				'has_archive' => false,
				'hierarchical' => false,
				'exclude_from_search' => true,
				'show_in_rest' => false,
				'publicly_queryable' => false,
				'capability_type' => 'post',
			);
			register_post_type( 'anpd-configurator', $args );
	}


	// Add colors Meta Box to post
	public function anpd_colors_rapater_meta_boxes() {
		$screens = array( 'anpd-configurator' );

		foreach ( $screens as $screen ) {

			add_meta_box(
				'anpd-colors-repeter-data',
				__( 'ANPD Colors', 'neon-product-designer' ),
				array( $this, 'anpd_colors_meta_box_callback' ),
				$screen
			);
		}
	}

	//meta box callback function for colors
	public function anpd_colors_meta_box_callback($post) {
		global $post;
		$anpd_color_group = get_post_meta($post->ID, 'anpd_color_group', true);
		wp_nonce_field( 'repeterBox-colors', 'anpd-colors' );
		?>
		<table class="anpd-table" id="repeatable-fieldset-one" width="100%">
			<thead>
				<tr>
					<th>Title</th>
					<th>Color</th>
					<th>Color Price</th>
					<th>Remove</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ( $anpd_color_group ) :
					foreach ( $anpd_color_group as $field ) {
						?>
						<tr>
							<td><input type="text"  style="width:98%;" name="title[]" value="<?php if($field['title'] != '') echo esc_attr( $field['title'] ); ?>" placeholder="Title" /></td>
							<td><input class="getColor" type="color"  style="width:15%;" name="getcolor[]" value="<?php if ($field['getcolor'] != '') echo esc_attr( $field['getcolor'] ); ?>" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;" value="<?php if ($field['outputcolor'] != '') echo esc_attr( $field['outputcolor'] ); ?>"></td>
							<td><input type="number" style="width:98%;" name="price[]" value="<?php if ($field['price'] != '') echo esc_attr( $field['price'] ); ?>" placeholder="Price"/></td>
							<td style="text-align: center;"><a class="button remove-row" href="#1">Remove</a></td>
						</tr>
						<?php
					}
				else :
					?>
					<tr>
						<td><input type="text" style="width:98%;" name="title[]" placeholder="Title"/></td>
						<td><input class="getColor" type="color"  style="width:15%;" name="getcolor[]" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;"></td>
						<td><input type="number" style="width:98%;" name="price[]" placeholder="Price"/></td>
						<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
					</tr>
				<?php endif; ?>
				<tr class="empty-row custom-repeter-text" style="display: none">
					<td><input type="text" style="width:98%;" name="title[]" placeholder="Title"/></td>
					<td><input class="getColor" type="color" style="width:15%;" name="getcolor[]" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;"></td>
					<td><input type="number" style="width:98%;" name="price[]" placeholder="Price"/></td>
					<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
				</tr>
				
			</tbody>
		</table>
		<p><a id="add-row" class="button" href="#">Add another</a></p>
	
		<?php
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



