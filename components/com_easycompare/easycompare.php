<?php
/**
 * @version     1.0.0
 * @package     com_easycompare
 * @copyright   Copyright (C) 2013 EasyJoomla.org. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      EasyJoomla.org <jan.linhart@easyjoomla.org> - http://easyjoomla.org
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JController::getInstance('Easycompare');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
