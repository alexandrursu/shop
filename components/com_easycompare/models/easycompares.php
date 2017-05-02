<?php

/**
 * @version     1.0.0
 * @package     com_easycompare
 * @copyright   Copyright (C) 2013 EasyJoomla.org. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      EasyJoomla.org <jan.linhart@easyjoomla.org> - http://easyjoomla.org
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');
/**
 * Methods supporting a list of Easycompare records.
 */
class EasycompareModelEasycompares extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {
        
        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);
        
        
        
        // List state information.
        parent::populateState($ordering, $direction);
    }
	
	/**
     * Get product IDs which should be compared
     *
     * @return	array of VM product IDs
     */
    public function getProducts()
	{
		$session = JFactory::getSession();
		$products2easycompare = (array)$session->get('products2easycompare');
		return $products2easycompare;
	}

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery()
	{

			$lang =& JFactory::getLanguage();
			$langTag = str_replace('-', '_', strtolower($lang->getTag()));

			$db		= $this->getDbo();
			$query	= $db->getQuery(true);

			$query->select('p.virtuemart_product_id');
			$query->select('med.file_title');
			$query->select('med.file_url_thumb');
			$query->select('pp.product_price AS salesPrice');
			$query->select('cur.currency_symbol');
			$query->select('cur.currency_decimal_place');
			$query->select('cur.currency_positive_style');
			$query->select('cat.virtuemart_category_id');

			$query->from('#__virtuemart_products p');

			if($langTag){
				$query->leftJoin('#__virtuemart_products_'.$langTag.' p'.$langTag.' USING(virtuemart_product_id)');
				$query->select('p'.$langTag.'.product_name');
				$query->select('p'.$langTag.'.product_s_desc');
				$query->select('p'.$langTag.'.product_desc');
			}

			$query->leftJoin('#__virtuemart_product_categories cat USING(virtuemart_product_id)');
			$query->leftJoin('#__virtuemart_product_medias pmed USING(virtuemart_product_id)');
			$query->leftJoin('#__virtuemart_medias med USING(virtuemart_media_id)');
			$query->leftJoin('#__virtuemart_product_prices pp USING(virtuemart_product_id)');
			$query->leftJoin('#__virtuemart_currencies cur ON cur.virtuemart_currency_id = pp.product_currency');
			if(count($this->getProducts()) > 0){
				$query->where('p.virtuemart_product_id IN('.implode(',', $this->getProducts()).')');
			} else {
				$query->where('p.virtuemart_product_id = "nothing"');
			}

			$query->group('virtuemart_product_id');

			return $query;
	}
	
	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   11.1
	 */
	public function getItems()
	{
		$items	= (array)parent::getItems();
		
		if(is_array($items)){
			
			$db		= $this->getDbo();

			if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');
			if (!class_exists ('calculationHelper')) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'calculationh.php');
		
		
			// foreach($items as $key => $item){

			// 	$calculator = calculationHelper::getInstance ();
			// 	$items[$key]->product_price = $calculator->calculateCostprice($item->virtuemart_product_id, (array)$item);
			// 	$query	= $db->getQuery(true);

			// 	$query->select('pc.virtuemart_custom_id'); 
			// 	$query->select('pc.custom_price');
			// 	$query->select('pc.custom_value');

			// 	$query->from('#__virtuemart_product_customfields pc');
			// 	$query->leftJoin('#__virtuemart_customs c USING(virtuemart_custom_id)');

			// 	$query->where('pc.virtuemart_product_id = '.(int)$item->virtuemart_product_id);
			// 	$query->where('c.published = 1');
			// 	$query->where('c.admin_only = 0');
			// 	$query->where('c.is_hidden = 0');
			// 	$query->where('pc.published = 1');

			// 	$items[$key]->fields = $db->loadObjectList('virtuemart_custom_id');

			// 	$productPrice = str_replace('{number}', round($item->product_price, $item->currency_decimal_place), $item->currency_positive_style);
			// 	$productPrice = str_replace('{symbol}', $item->currency_symbol, $productPrice);

			// 	$items[$key]->fields['price'] = new stdClass();
			// 	$items[$key]->fields['price']->virtuemart_custom_id = 'price';
			// 	$items[$key]->fields['price']->custom_value = $productPrice;

			// 	// if($item->product_weight)
			// 	// {
			// 		$items[$key]->fields['product_weight'] = new stdClass();
			// 		$items[$key]->fields['product_weight']->virtuemart_custom_id = 'product_weight';
			// 		$items[$key]->fields['product_weight']->custom_value = $item->product_weight;
			// 	// }
			// }
			return $items;
		} else {
			return null;
		}
	}
	
	/**
	 * Method to get an array of VM custom fields.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 */
	public function getFields()
	{
		if(count($this->getProducts()) > 0)
		{
			$params = JComponentHelper::getParams('com_easycompare');
			$db		= $this->getDbo();

			$query	= $db->getQuery(true);

			$query->select('c.custom_title');
			$query->select('c.custom_tip');
			$query->select('c.custom_field_desc');
			$query->select('c.virtuemart_custom_id');

			$query->from('#__virtuemart_customs c');
			$query->leftJoin('#__virtuemart_product_customfields pc USING(virtuemart_custom_id)');

			$query->where('pc.virtuemart_product_id IN('.implode(',', $this->getProducts()).')');
			$query->where('c.published = 1');
			$query->where('c.admin_only = 0');
			$query->where('c.is_hidden = 0');
			$query->where('c.custom_title != "COM_VIRTUEMART_RELATED_PRODUCTS"');
			$query->where('c.custom_title != "COM_VIRTUEMART_RELATED_CATEGORIES"');
			$query->where('c.custom_title != "COM_VIRTUEMART_STOCKABLE_PRODUCT"');

			$db->setQuery($query);
			$fields = $db->loadObjectList('virtuemart_custom_id');

			if($params->get('show_product_weight', 1))
			{
				//add product_weight as another CF
				$product_weight = new stdClass();
				$product_weight->custom_title = JText::_('COM_EASYCOMPARE_WEIGHT');
				$product_weight->custom_tip = '';
				$product_weight->custom_field_desc = '';
				$product_weight->virtuemart_custom_id = 'product_weight';
				array_unshift($fields, $product_weight);
			}
			
			if($params->get('show_product_length', 1))
			{
				//add product_length as another CF
				$product_length = new stdClass();
				$product_length->custom_title = JText::_('COM_EASYCOMPARE_LENGTH');
				$product_length->custom_tip = '';
				$product_length->custom_field_desc = '';
				$product_length->virtuemart_custom_id = 'product_length';
				array_unshift($fields, $product_length);
			}

			if($params->get('show_product_width', 1))
			{
				//add product_width as another CF
				$product_width = new stdClass();
				$product_width->custom_title = JText::_('COM_EASYCOMPARE_WIDTH');
				$product_width->custom_tip = '';
				$product_width->custom_field_desc = '';
				$product_width->virtuemart_custom_id = 'product_width';
				array_unshift($fields, $product_width);
			}

			if($params->get('show_product_height', 1))
			{
				//add product_height as another CF
				$product_height = new stdClass();
				$product_height->custom_title = JText::_('COM_EASYCOMPARE_HEIGHT');
				$product_height->custom_tip = '';
				$product_height->custom_field_desc = '';
				$product_height->virtuemart_custom_id = 'product_height';
				array_unshift($fields, $product_height);
			}

			if($params->get('show_product_desc', 1))
			{
				//add product_desc as another CF
				$product_desc = new stdClass();
				$product_desc->custom_title = JText::_('COM_EASYCOMPARE_DESC');
				$product_desc->custom_tip = '';
				$product_desc->custom_field_desc = '';
				$product_desc->virtuemart_custom_id = 'product_desc';
				array_unshift($fields, $product_desc);
			}

			if($params->get('show_product_s_desc', 1))
			{
				//add product_s_desc as another CF
				$product_s_desc = new stdClass();
				$product_s_desc->custom_title = JText::_('COM_EASYCOMPARE_S_DESC');
				$product_s_desc->custom_tip = '';
				$product_s_desc->custom_field_desc = '';
				$product_s_desc->virtuemart_custom_id = 'product_s_desc';
				array_unshift($fields, $product_s_desc);
			}

			if($params->get('show_price', 1))
			{
				//add price as another CF
				$price = new stdClass();
				$price->custom_title = JText::_('COM_EASYCOMPARE_PRICE');
				$price->custom_tip = '';
				$price->custom_field_desc = '';
				$price->virtuemart_custom_id = 'price';
				array_unshift($fields, $price);
			}
			
			return $fields;
		} else {
			return false;
		}
	}
}