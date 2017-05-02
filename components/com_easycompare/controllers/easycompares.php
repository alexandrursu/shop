<?php
/**
 * @version     1.0.0
 * @package     com_easycompare
 * @copyright   Copyright (C) 2013 EasyJoomla.org. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      EasyJoomla.org <jan.linhart@easyjoomla.org> - http://easyjoomla.org
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Easycompares list controller class.
 */
class EasycompareControllerEasycompares extends EasycompareController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Easycompares', $prefix = 'EasycompareModel', $config = Array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	public function addProduct(){
		$app = JFactory::getApplication();
		$input = $app->input;
		$productId = (int)$input->get('id');
		$return = base64_decode($input->get('return'));
		$return = urldecode($return);
		
		$session = JFactory::getSession();
		$products2easycompare = $session->get('products2easycompare');
		if (!in_array($productId, $products2easycompare))
		{
			$products2easycompare[] = $productId;
		}
		$session->set('products2easycompare', $products2easycompare);
		
		if($return){
			$app->redirect($return);
		} else {
			$app->redirect(JRoute::_('index.php?option=com_easycompare&view=easycompares'));
		}
	}
	
	public function deleteProduct(){
		$app = JFactory::getApplication();
		$input = $app->input;
		$productId = (int)$input->get('id');
		$return = base64_decode($input->get('return', '', 'BASE64'));
		$return = urldecode($return);

		$session = JFactory::getSession();
		$products2easycompare = $session->get('products2easycompare');
		unset($products2easycompare[array_search($productId, $products2easycompare)]);
		$session->set('products2easycompare', $products2easycompare);
		
		if($return){
			$app->redirect($return);
		} else {
			$app->redirect(JRoute::_('index.php?option=com_easycompare&view=easycompares'));
		}
	}
}