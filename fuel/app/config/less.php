<?php
/**
 * FuelPHP LessCSS package implementation. This namespace controls all Google
 * package functionality, including multiple sub-namespaces for the various
 * tools.
 *
 * @author     Kriansa
 * @version    1.0
 * @package    Fuel
 * @subpackage Less
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * An array of paths that will be searched for lesscss assets.
	 * You should probably keep them out of public access
	 * This MUST include the trailing slash ('/')
	 *
	 * Default: APPPATH.'vendor/less/'
	 */
	'less_source_dir' => Config::get('theme.paths.0').'/'.Config::get('theme.active').'/'.Config::get('theme.assets_folder').'/less/',
	
	/**
	 * As the asset config is a array with multiple paths, you must tell
	 * what is the default path where the compiled less files will be
	 * The value means the key of asset.paths that will be used
	 * 
	 * This MUST include the trailing slash ('/')
	 *
	 * Default: Config::get('asset.paths.0').Config::get('asset.css_dir'),
	 */
	'less_output_dir' => Config::get('theme.paths.0').'/'.Config::get('theme.active').'/'.Config::get('theme.assets_folder').'/css/',
);
