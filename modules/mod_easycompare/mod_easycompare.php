<?php
/*
 * @package   Joomla 2.5
 * @author    Easy Software s.r.o.
 * @authorurl http://www.easysoftware.cz 
 * @license   GNU/GPL
 * 
 * General module - main script
 */ 
defined('_JEXEC') or die('Restricted access');

//recommended variable to use as prefix for html id attributes, so multiple instances can be at one page
$unique_id = uniqid('mod_easycompare_'); 

//css
if( $params->get('use_css', 1) ){

    $doc = JFactory::getDocument();
    $doc->addStyleSheet('/components/com_easycompare/assets/css/easycompare.css');
}

$session = JFactory::getSession();
$products2easycompare = (array)$session->get('products2easycompare');

$products = array();

//try to find itemid
$menu	= $app->getMenu();
$menuItem = $menu->getItems(array('link'), array('index.php?option=com_easycompare&view=easycompares'), true);
if($menuItem && isset($menuItem->id))
{
	$itemIdString = '&Itemid='.(int)$menuItem->id;
}

if($products2easycompare){
	$lang =& JFactory::getLanguage();
	$langTag = str_replace('-', '_', strtolower($lang->getTag()));

	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query->select('virtuemart_product_id, product_name');
	$query->from('#__virtuemart_products_'.$langTag.' p'.$langTag);
	$query->where('virtuemart_product_id IN('.  implode(',', $products2easycompare).')');
	$db->setQuery($query);
	$products = $db->loadObjectList('virtuemart_product_id');
}

//tmpl
require JModuleHelper::getLayoutPath( 'mod_easycompare', 'default' );
?>