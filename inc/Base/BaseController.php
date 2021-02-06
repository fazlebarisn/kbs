<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public $managers = array();

	public function __construct(){
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3) ) . '/kbs.php';

		// This array use in inc/Pages/Admin.php file for set setSettings
		$this->managers = [
			'cpt_manager'         => 'Active CPT Manager',
			'taxonomy_manager'    => 'Active Taxonomy Manager',
			'media_widget'        => 'Active Media Widget',
			'gallery_manager'     => 'Active Gallery Manager',
			'testimonial_manager' => 'Active Testimonial Manager',
			'templates_manager'   => 'Active Template Manager',
			'login_manager'       => 'Active Login Manager',
			'membership_manager'  => 'Active Membership Manager',
			'chat_manager'        => 'Active Membership Manager',
		];

	}


	// Check the checkbox is checked or not from Dashbord page
	public function activated( string $key ){

		$option = get_option( 'kbs_plugin' );
		return isset( $option[$key] ) ? $option[$key] : false;
		
	}
}
