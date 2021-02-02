<?php
/**
 * @package KbsPlugin
*/
namespace Inc\Base;

class Activate
{
	public static function activate(){
		flush_rewrite_rules();

		/*
		** Set some default data when plugin install for first time
		*** if we not set default data 
		*** when we active plugin for first time and try to active any section from dashboard, 
		*** all section will active
		 */

		 // if active any section from before, then do not change anything
		 if( get_option( 'kbs_plugin' ) ){
			 return;
		 }

		 // Set default vale
		 $default = array();
		 update_option( 'kbs_plugin' , $default );
	}
}