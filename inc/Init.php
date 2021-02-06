<?php
/**
 * @package KbsPlugin
*/
namespace Inc;

final class Init
{
	/**
	 * Store all classes inside an array
	 * @return array Full list of classes
	 */

	public static function get_services(){
		return[	
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeController::class,
			Base\TaxonomyController::class,
			Base\MediaWidgetController::class,
			Base\GalleryController::class,
			Base\TestimonialController::class,
			Base\TemplatesController::class,
			Base\MembershipController::class,
			Base\ChatController::class,
			Base\LoginController::class,
		];
	}

	/**
	 * Loop through the classes, initialize them
	 * and call the register() methord if it exists
	 * @return 
	 */

	public static function register_services(){
		foreach (self::get_services() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param class $class class from the services array
	 * @return class instance new instance of the class
	 */

	private static function instantiate($class){
		$service = new $class();
		return $service;
	}
}
