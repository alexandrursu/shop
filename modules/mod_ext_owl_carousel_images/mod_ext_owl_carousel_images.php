<?php 
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2014 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 02/04/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;
error_reporting(E_ALL & ~E_NOTICE);

$document 					= JFactory::getDocument();

$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.carousel.css');
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.theme.css');
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.transitions.css');

$moduleclass_sfx			= $params->get('moduleclass_sfx');
$ext_id 					= "mod_".$module->id;
$ext_jquery_ver				= $params->get('ext_jquery_ver', '1.10.2');
$ext_load_jquery			= (int)$params->get('ext_load_jquery', 1);
$ext_load_base				= (int)$params->get('ext_load_base', 1);


// Options Owl Carousel http://www.owlgraphic.com/owlcarousel/#customizing
//---------------------------------------------------------------------

//basic:
$ext_width_block			= (int)$params->get('ext_width_block', 600);
$ext_items 					= (int)$params->get('ext_items', 1);
$ext_navigation				= $params->get('ext_navigation', 'true');
$ext_pagination				= $params->get('ext_pagination', 'true');
$ext_paginationnumbers		= $params->get('ext_paginationnumbers', 'false');



	
// Load jQuery
//---------------------------------------------------------------------

$ext_script = <<<SCRIPT


var jQowlImg = false;
function initJQ() {
	if (typeof(jQuery) == 'undefined') {
		if (!jQowlImg) {
			jQowlImg = true;
			document.write('<scr' + 'ipt type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/$ext_jquery_ver/jquery.min.js"></scr' + 'ipt>');
		}
		setTimeout('initJQ()', 500);
	}
}
initJQ(); 
 
 if (jQuery) jQuery.noConflict();    
  
  
 

SCRIPT;

if ($ext_load_jquery  > 0) {
	$document->addScriptDeclaration($ext_script);		
}
if ($ext_load_base  > 0) { 
	$document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'modules/mod_ext_owl_carousel_images/assets/js/owl.carousel.min.js"></script>'); 	
}

// Load img params
//---------------------------------------------------------------------

$names = array('img', 'alt', 'url', 'target', 'html');
$max = 5;
foreach($names as $name) {
    ${$name} = array();
    for($i = 1; $i <= $max; ++$i)
        ${$name}[] = $params->get($name . $i);
}	
require JModuleHelper::getLayoutPath('mod_ext_owl_carousel_images', $params->get('layout', 'default'));
echo JText::_(COP_JOOMLA);
?>