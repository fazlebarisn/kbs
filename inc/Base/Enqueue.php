<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
	public function register(){
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
	}

	function enqueue(){
		wp_enqueue_style('kbsstyle', $this->plugin_url . 'assets/mystyle.css');
		wp_enqueue_script('kbsscript', $this->plugin_url . 'assets/myscript.js');
	}
}