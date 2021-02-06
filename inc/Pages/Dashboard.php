<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
	public $settings;
	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();
	//public $subpages = array();

	public function register(){

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();
		//$this->setSubPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();


		$this->settings->addPages($this->pages)->withSubPage('Dashbord')->register();
	}

	public function setPages(){
		$this->pages = array(
			array(
				'page_title' => 'Kbs Plugin',
				'menu_title' => 'KBS',
				'capability' => 'manage_options',
				'menu_slug'  => 'kbs_plugin',
				'callback'   => array( $this->callbacks, 'adminDashboard' ),
				'icon_url'   => 'dashicons-store',
				'position'   => 110
			)
		);

	}

	/*
	* Register custom fiels section start 
	* 'checkboxSanitize' callback  function is in the inc/Api/Callbacks/ManagerCallbacks.php file 
	*/

	public function setSettings(){

		$args = array(
			array(
				'option_group' => 'kbs_plugin_settings',
				'option_name'  => 'kbs_plugin', // option name should be the same as page 
				'callback'     => array( $this->callbacks_mngr, 'checkboxSanitize' ),
			)			
		);

		$this->settings->setSettings( $args );
	}	

	public function setSections(){
		$args = array(
			array(
				'id'       => 'kbs_admin_index',
				'title'    => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page'     => 'kbs_plugin'
			)
		);

		$this->settings->setSections( $args );
	}	

	public function setFields(){

		$args = array();

		// get $this->managers array from inc/Base/BaseController.php

		foreach( $this->managers as $key => $value ){

			$args[] = array(
				'id'       => $key,
				'title'    =>  $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page'     => 'kbs_plugin',
				'section'  => 'kbs_admin_index',
				'args'     => array(
					'option_name' => 'kbs_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle',
		)
			);

		}
		
		$this->settings->setFields( $args );
	}

}