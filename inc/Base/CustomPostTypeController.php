<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomPostTypeController extends BaseController
{
    public $callbacks;
    public $subpages = array();

    public function register(){

        // get the option value
        $option = get_option( 'kbs_plugin' );
        // set the value 
        $activated = isset( $option['cpt_manager'] ) ? $option['cpt_manager'] : false;
        // active the section
        if( !$activated ) return;

        // Create new classess instance
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        // call setSubPages methord for ganarate sub page
        $this->setSubPages();

        $this->settings->addSubPages( $this->subpages )->register();

        add_action( 'init' , array( $this, 'activate' ) );
    }

	public function setSubPages(){

		$this->subpages = array(
			array(
				'parent_slug'=> 'kbs_plugin',
				'page_title' => 'Custom Post Type',
				'menu_title' => 'CPT Manager',
				'capability' => 'manage_options',
				'menu_slug'  => 'kbs_cpt',
				'callback'   => array( $this->callbacks, 'adminCpt' )
			),			

		);
	}

    public function activate(){

        register_post_type( 'kbs_products' ,
            array(
                'labels' => array(
                    'name' => 'Products',
                    'singular_name' => 'Product'
                ),
                'public' => true,
                'has_archive' => true,
            )
        );
    }

}