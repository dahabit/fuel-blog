<?php
/**
 *
 * @version    1.0
 * @author     Daniel Berry
 * @license    MIT License
 * @copyright  2012 Berry Media Group
 * @link       http://berrymediagroup.com
 * @email      daniel@berrymediagroup.com
 * @created    3/1/12 12:09 PM
 */

 class Twig_Custom_Extension extends Twig_Extension
 {

	 /**
	  * Gets the name of the extension.
	  *
	  * @return  string
	  */
	 public function getName()
	 {
		 return 'phoenix';
	 }

	 public function getFunctions()
	 {
		return array(
			'load_asset'    => new Twig_Function_Method($this, 'load_asset'),

			'load_less'      => new Twig_Function_Function('Asset::less'),
			'input_post'     => new Twig_Function_Function('Input::post'),
		);
	 }

	 /**
	  * load an asset from the theme directory
	  *
	  * <code>
	  * {{load_asset('path_to_asset_relative_to_theme_asset_folder')}}
	  * </code>
	  *
	  * @param string $asset
	  * @return mixed
	  */
	 public function load_asset($asset = '')
	 {
		 return \Theme::instance()->asset($asset);
	 }
 }