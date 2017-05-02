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

jimport('joomla.application.component.view');
if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');
if (!class_exists ('calculationHelper')) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'calculationh.php');


/**
 * View class for a list of Easycompare.
 */
class EasycompareViewEasycompares extends JView
{
	protected $items;
	protected $fields;
	protected $pagination;
	protected $state;
    protected $params;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

        $app                = JFactory::getApplication();
        $this->state		= $this->get('State');
        $this->params       = $app->getParams('com_easycompare');
		$this->productIds	= $this->get('Products');
		//$this->items		= $this->get('Items');
		$this->fields		= $this->get('Fields');
		
		$this->productModel = VmModel::getModel('product');
		$this->items        = array();

		if(count($this->productIds) > 0)
		{
			foreach($this->productIds as $pid)
			{
				$product 			= $this->productModel->getProduct($pid);
				$this->productModel->addImages($product);
				$this->items[] 		= $product;
			}

			$this->currency		= CurrencyDisplay::getInstance();
		}
        
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {;
            throw new Exception(implode("\n", $errors));
        }
        
        $this->_prepareDocument();
        parent::display($tpl);
	}


	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('com_easycompare_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}    
    	
}
