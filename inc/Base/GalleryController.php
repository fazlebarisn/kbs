<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class GalleryController extends BaseController
{
    public $callbacks;
    public $subpages = array();

    public function register(){

        // get the option value from BaseController
        if( !$this->activated( 'gallery_manager' ) ) return;

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
				'page_title' => 'Galllery Image',
				'menu_title' => 'Gallery Manager',
				'capability' => 'manage_options',
				'menu_slug'  => 'kbs_galleries',
				'callback'   => array( $this->callbacks, 'adminCpt' )
			),			

		);
    }

    public function activate(){

    }
    
}