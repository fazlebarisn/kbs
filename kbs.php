<?php
/**
 * @package KbsPlugin
*/

/*
Plugin Name: Kbs Plugin
Plugin URI: https://www.chitabd.com/
Description: My New Plugin
Version: 1.0.0
Author: Fazle Bari
Author URI: https://www.chitabd.com/
Licence: GPL Or leater
Text Domain: Kbs Plugin
*/

/*
This is a free plugin
*/

// if(!defined('ABSPATH')){
// 	die;
// }

defined('ABSPATH') or die('Nice Try!');

if( file_exists(dirname( __FILE__ ). '/vendor/autoload.php')){
	require_once dirname( __FILE__ ). '/vendor/autoload.php';
}


// Active Plugin
function activate_kbs_plugin(){
	Inc\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activate_kbs_plugin');

// Deactive Plugin
function deactivate_kbs_plugin(){
	Inc\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_kbs_plugin');

/**
 * Initialize all the core classess of the plugin
 */
if (class_exists("Inc\\Init")) {
	Inc\Init::register_services();
}

