<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       internet-cossacks.com
 * @since      1.0.0
 *
 * @package    Multisite_Anchors_Settings
 * @subpackage Multisite_Anchors_Settings/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multisite_Anchors_Settings
 * @subpackage Multisite_Anchors_Settings/admin
 * @author     Yurii Kovalenko <ethingwillbefine@gmail.com>
 */
class Multisite_Anchors_Settings_Admin {

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
		 * defined in Multisite_Anchors_Settings_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multisite_Anchors_Settings_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multisite-anchors-settings-admin.css', array(), $this->version, 'all' );

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
		 * defined in Multisite_Anchors_Settings_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multisite_Anchors_Settings_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/multisite-anchors-settings-admin.js', array( 'jquery' ), $this->version, false );


	}
	public function create_menu(){

		add_action('network_admin_menu', 'add_network_admin_menu');
		function add_network_admin_menu() {
			add_menu_page(
				"Multisite anchors settings",
				"Multisite anchors settings",
				'capability',
				'multisite-anchors-settings',
				'settings_page'
			);
		}
		function settings_page(){
		require ('partials/multisite-anchors-settings-admin-display.php');

			}


		}
		public function ajax_request(){

				add_action('wp_ajax_ajax_change_anchor', 'ajax_change_anchor');
				add_action('wp_ajax_no_priv_ajax_change_anchor', 'ajax_change_anchor');

			function ajax_change_anchor() {
					$test_id = false;
					$blog_id = $_POST['blog_id'];
					$post_id = $_POST['post_id'];
					$current_anchor = trim($_POST['current_anchor']);
					$new_anchor = $_POST['new_anchor'];
					$referrer = $_POST['referrer'];
					switch_to_blog($blog_id );
					$post = get_post($post_id);
					$post_content = $post->post_content;
					$regexed_anchor = preg_quote($current_anchor,'/');
					$regex = sprintf('/<a[^>]+href=\".*?\"[^>]*>(%s)<\/a>/',$regexed_anchor);
					preg_match_all($regex, $post_content , $matches,PREG_SET_ORDER);

					function replace_anchor ($matches){
						$pattern = '/(<a[^>]+href=\".*?\"[^>]*>)(.+?)(<\/a>)/';
						$replacement = '$1' . $_POST['new_anchor'] . '$3';
						$new_anchor = preg_replace( $pattern, $replacement, $matches[0]);
						return $new_anchor;
					}
					function replace_link ($matches){
						$replaced_anchor = $matches[1];
						return $replaced_anchor;
					}
					if ( $referrer === 'mas-change-anchor-btn' && $matches){
						$post_content = preg_replace_callback( $regex,'replace_anchor', $post_content);
					}
					elseif ( $referrer === 'mas-delete-link-btn' && $matches){
						$post_content = preg_replace_callback( $regex,'replace_link', $post_content);
					}
					$my_post = array();
					$my_post['ID'] = $post_id;
					$my_post['post_content'] = $post_content;

					// Обновляем данные в БД
					wp_update_post( wp_slash($my_post) );



				$return = array(
							'blog_id' => $blog_id,
							'post_id' => $post_id,
							'current_anchor' => $current_anchor,
							'new_anchor' => $new_anchor,
							'post_content' => $post_content,
					'matches' => $matches
						);

						wp_send_json($return);


					wp_die();
				}



		}

}
