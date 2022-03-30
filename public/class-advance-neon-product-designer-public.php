<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    advance-neon-product-designer
 * @subpackage advance-neon-product-designer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    advance-neon-product-designer
 * @subpackage advance-neon-product-designer/public
 * @author     Your Name <email@example.com>
 */
class ANPD_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function anpd_enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name.'-fancybox', plugin_dir_url( __FILE__ ) . 'css/jquery.fancybox.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/advance-neon-product-designer-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function anpd_enqueue_scripts() {

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
		wp_enqueue_script( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name.'-fancybox-jquery', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/advance-neon-product-designer-public.js', array( 'jquery' ), $this->version, true );

	}

	public function ANPD_Custom_product_template( $data ) {
    	global $product , $post;
        $configrator = get_post_meta( $post->ID, 'anpd_config_selector', true );
        if(is_singular('product') && !empty($configrator)) {
		  require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/woocommerce/anpd-single-product.php';
        }
	  return $data;
	}

	public function ANPD_remove_hooks_product_page(){
		global $product , $post;
        if(is_singular('product')) {
        	$configrator = get_post_meta( $post->ID, 'anpd_config_selector', true );
        	if (get_post_meta( $post->ID, 'anpd_config_selector', true )) {
	        	// remove title
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
				// remove  rating  stars
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
				// remove product meta 
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
				// remove  description
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
				// remove images
				remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
				// remove related products
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
				// remove additional information tabs
				remove_action('woocommerce_after_single_product_summary ','woocommerce_output_product_data_tabs',10);
			}
        }
	}

}
