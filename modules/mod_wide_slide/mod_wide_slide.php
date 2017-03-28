<?php
/*
* Pixel Point Creative | Wide Slide Module for Joomla! 
* License: GNU General Public License version 2 
* See: http://www.gnu.org/copyleft/gpl.html
* Copyright (c) Pixel Point Creative LLC.
* More info at http://www.pixelpointcreative.com
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
if (!defined("DS")) {
	define('DS', DIRECTORY_SEPARATOR);
}
$document = &JFactory::getDocument();
jimport('joomla.filesystem.folder');
jimport( 'joomla.html.html' );

require (dirname(__FILE__). DS . 'classes' . DS . 'wideslide.php');
Wideslide::setModule($module);
require_once (dirname(__FILE__).DS.'helper.php');
$folder 			= 	$params->get( 'folder', 'images/gallery' );
$item_default 		= 	$params->get( 'item_default', '1' );
if ($item_default > 0) {
	$item_default 		=   (int)$item_default - 1;
} else {
	$item_default = 0;
}
$descriptions 		= 	$params->get( 'description',"");
$orderby 		= 	$params->get( 'orderby', 0);
$sort 			= 	$params->get( 'sort', '1');
$lwidth 		= 	$params->get( 'lwidth', 550 );
$lheight 		= 	$params->get( 'lheight', 200 );
$twidth 		= 	$params->get( 'twidth', 550 );
$theight 		= 	$params->get( 'theight', 200 );
$show_button 		= 	$params->get( 'show_button', 1 );
$show_thumb 		= 	$params->get( 'show_thumb', 1 );
$auto_play 		= 	$params->get( 'auto_play', 1 );
$speed2			= 	intval($params->get( 'speed2', 5000 ));
$loop 			= 	$params->get( 'loop', 1 );
$showCaption 		= 	$params->get( 'show_caption', 1 );
$showDesc 		= 	$params->get( 'show_desc', 1 );
$showReadmore 		= 	$params->get( 'show_readmore', 1 );
$readmoreText 		= 	$params->get( 'readmoreText', JText::_('Read more') );
$show_time 		= 	$params->get( 'show_time', 1 );
$duration 		= 	intval($params->get( 'duration', 1000 ));
$pause			= 	intval($params->get( 'pause', 5000 ));
$caption_color 		= 	$params->get( 'caption_color', '#FFFFFF' );
$desc_color 		= 	$params->get( 'desc_color', '#FFCC33' );
$readmore_color 	= 	$params->get( 'readmore_color', '#919191' );
$jquery			= 	$params->get('include_jquery', '1');

if (!defined ('PP_WIDESLIDE')) {
	define ('PP_WIDESLIDE', 1);
	if ($jquery)
	if( !defined('PPC_JQUERY_INC') ){
		$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/ppc.safejquery.start.js' );
		$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/jquery.min.js' );
		$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/ppc.safejquery.end.js' );	
		define('PPC_JQUERY_INC', 1);
	}

	$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/ppc.safejqueryplugin.start.js' );
	$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/jquery-ui.min.js' );
	$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/css3-mediaqueries.js' );
	$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/fwslider.js' );
	$document->addScript( JURI::root() . 'modules/mod_wide_slide/assets/ppc.safejqueryplugin.end.js' );
	
	/* Add css*/	
	JHTML::stylesheet('fonts.googleapis.com/css?family=Open+Sans', 'http://');
	$document->addStyleSheet( JURI::root() . 'modules/mod_wide_slide/assets/style.css' );

	
}
$photo = modWideSlide::getInstance($params);
$items = $photo->getInfo($params);
$path = JModuleHelper::getLayoutPath( 'mod_wide_slide' );
if (file_exists($path)) {
	require($path);
}  
?>