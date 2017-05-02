<?php
/**
 * @version     1.0.0
 * @package     com_easycompare
 * @copyright   Copyright (C) 2013 EasyJoomla.org. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      EasyJoomla.org <jan.linhart@easyjoomla.org> - http://easyjoomla.org
 */

// No direct access
defined('_JEXEC') or die;

/**
 * @param	array	A named array
 * @return	array
 */
// function EasycompareBuildRoute(&$query)
// {
// 	$segments = array();
    
// 	if (isset($query['task'])) {
// 		$segments[] = implode('/',explode('.',$query['task']));
// 		unset($query['task']);
// 	}
// 	if (isset($query['id'])) {
// 		$segments[] = $query['id'];
// 		unset($query['id']);
// 	}
// 	if (isset($query['view'])) {
// 		$segments[] = $query['view'];
// 		unset($query['view']);
// 	}

// 	return $segments;
// }

// *
//  * @param	array	A named array
//  * @param	array
//  *
//  * Formats:
//  *
//  * index.php?/easycompare/task/id/Itemid
//  *
//  * index.php?/easycompare/id/Itemid
 
// function EasycompareParseRoute($segments)
// {
// 	$vars = array();

// 	// view is always the first element of the array
// 	$count = count($segments);
    
//     if ($count)
// 	{
// 		$count--;
// 		$segment = array_pop($segments) ;
// 		if (is_numeric($segment)) {
// 			$vars['id'] = $segment;
// 		}
//         else{
//             $count--;
//             $vars['task'] = array_pop($segments) . '.' . $segment;
//         }
// 	}

// 	if ($count)
// 	{   
//         $vars['task'] = implode('.',$segments);
// 	}
// 	return $vars;
// }

/**
 * Build the route for the com_contact component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */
function EasycompareBuildRoute(&$query){
	$segments = array();

	// get a menu item based on Itemid or currently active
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$advanced = false;

	if (empty($query['Itemid'])) {
		$menuItem = $menu->getActive();
	} else {
		$menuItem = $menu->getItem($query['Itemid']);
	}
	$mView	= (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
	$mCatid	= (empty($menuItem->query['catid'])) ? null : $menuItem->query['catid'];
	$mId	= (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

	if (isset($query['view']))
	{
		$view = $query['view'];
		if (empty($query['Itemid'])) {
			$segments[] = $query['view'];
		}
		unset($query['view']);
	};

	// are we dealing with a contact that is attached to a menu item?
	if (isset($view) && ($mView == $view) and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
		unset($query['catid']);
		unset($query['id']);
		return $segments;
	}

	if (isset($view) and ($view == 'category' or $view == 'contact')) {
		if ($mId != intval($query['id']) || $mView != $view) {
			if($view == 'contact' && isset($query['catid']))
			{
				$catid = $query['catid'];
			} elseif(isset($query['id'])) {
				$catid = $query['id'];
			}
		}
		unset($query['id']);
		unset($query['catid']);
	}

	if (isset($query['layout']))
	{
		if (!empty($query['Itemid']) && isset($menuItem->query['layout']))
		{
			if ($query['layout'] == $menuItem->query['layout']) {

				unset($query['layout']);
			}
		}
		else
		{
			if ($query['layout'] == 'default') {
				unset($query['layout']);
			}
		}
	};

	return $segments;
}
/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function EasycompareParseRoute($segments)
{
	$vars = array();

	//Get the active menu item.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$item	= $menu->getActive();
	$advanced = false;

	// Count route segments
	$count = count($segments);

	// Standard routing for newsfeeds.
	if (!isset($item))
	{
		$vars['view']	= $segments[0];
		$vars['id']		= $segments[$count - 1];
		return $vars;
	}

	// From the categories view, we can only jump to a category.
	$id = (isset($item->query['id']) && $item->query['id'] > 1) ? $item->query['id'] : 'root';

	$contactCategory = JCategories::getInstance('Contact')->get($id);

	$categories = ($contactCategory) ? $contactCategory->getChildren() : array();
	$vars['catid'] = $id;
	$vars['id'] = $id;
	$found = 0;
	foreach($segments as $segment)
	{
		$segment = $advanced ? str_replace(':', '-', $segment) : $segment;
		foreach($categories as $category)
		{
			if ($category->slug == $segment || $category->alias == $segment)
			{
				$vars['id'] = $category->id;
				$vars['catid'] = $category->id;
				$vars['view'] = 'category';
				$categories = $category->getChildren();
				$found = 1;
				break;
			}
		}
		if ($found == 0)
		{
			if($advanced)
			{
				$db = JFactory::getDBO();
				$query = 'SELECT id FROM #__contact_details WHERE catid = '.$vars['catid'].' AND alias = '.$db->Quote($segment);
				$db->setQuery($query);
				$nid = $db->loadResult();
			} else {
				$nid = $segment;
			}
			$vars['id'] = $nid;
			$vars['view'] = 'contact';
		}
		$found = 0;
	}
	return $vars;
}
