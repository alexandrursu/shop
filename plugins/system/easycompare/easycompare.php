<?php
/**
 * @subpackage  System.easycomare
 * 
 * @copyright	Copyright (C) Easy Software. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @author      Jan Linhart
 */

defined('JPATH_BASE') or die;

jimport('joomla.utilities.utility');

/**
 * Plugin class defining default language for current language
 *
 * @package	Joomla.Plugin
 * @subpackage	System.easycompare
 */
class plgSystemEasycompare extends JPlugin
{
    /**
    * Object Constructor.
    *
    * @access	public
    * @param	object	The object to observe -- event dispatcher.
    * @param	object	The configuration object for the plugin.
    * @return	void
    * @since	2.5
    * @author  	Jan Linhart
    */
    function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_easycompare', JPATH_ADMINISTRATOR);
    }
    
    /*
     * At this trigger method load plugin settings 
     * and then set VirtueMart currency
     * 
     * @author Jan Linhart
     */
    public function onAfterDispatch()
    {
        
        // Check that we are in the site application.
        if (JFactory::getApplication()->isAdmin())
        {
            return true;
        }

		$app 		= Jfactory::getApplication();
		$input 		= $app->input;
		$view 		= $input->get('view', '', 'cmd');
		$option 	= $input->get('option', '', 'cmd');
		$extensions = ($option == 'com_virtuemart' || $option == 'com_customfilters');
		$views 		= ($view == 'productdetails' || $view == 'category' || $view == 'virtuemart' || $view == 'products');
		$doc 		= (JFactory::getDocument()->getType() !== 'html' || $input->get('tmpl', '', 'cmd') === 'component');
		
		
		if (!$extensions && !$views && !$doc)
		{
			return true;
		}

        $currency_language = $this->params->get('currency_language');
		
		$doc = JFactory::getDocument();
		$buf = $doc->getBuffer('component');
		
		if (strpos($buf, '{easycompare') === false)
		{
			return true;
		}
		
		$regex		= '/{easycompare\s*(.*?)}/i';
		
		$session = JFactory::getSession();
		$products2easycompare = (array)$session->get('products2easycompare');
		
		$uri = JURI::getInstance()->toString();
		// repair ajax returned uRl to be without parameter tmpl=component
		if ($option == 'com_customfilters' && $view == 'products' && $input->get('tmpl', '', 'cmd') === 'component')
		{
			$uri = str_replace("&tmpl=component", "", $uri);
			$uri = str_replace("?tmpl=component&", "?", $uri);
			$uri = str_replace("tmpl=component", "", $uri);
		}
		
		$return = base64_encode(urlencode($uri));
			
		preg_match_all($regex, $buf, $matches, PREG_SET_ORDER);

		if ($matches)
		{
			foreach ($matches as $match)
			{
			
				if (isset($match[1]))
				{
					$productId = (int)$match[1];
				}
				
				if ($extension = $input->get('virtuemart_product_id'))
				{
					$productId = $extension;
				}
				
				$button = '';

				if (isset($productId) && $productId)
				{
					if (is_array($products2easycompare) && in_array($productId, $products2easycompare))
					{
						$uncompare = ' btn-warning uncompare';
						$text = JText::_('PLG_EASYCOMPARE_BUTTON_UNCOMPARE');
						$url = JRoute::_('index.php?option=com_easycompare&task=easycompares.deleteproduct&id='.$productId.'&return='.$return);
					}
					else
					{
						$uncompare = '';
						$text = JText::_('PLG_EASYCOMPARE_BUTTON_COMPARE');
						$url = JRoute::_('index.php?option=com_easycompare&task=easycompares.addproduct&id='.$productId.'&return='.$return);
					}
					
					$button .= '<a class="btn easyCompareButton'.$uncompare.'" href="'.$url.'" >';
					$button .= 'Wishlist';
					$button .= '</a>';
				}
				
				$buf = preg_replace("|$match[0]|", $button, $buf, 1);
				
			}
		}

		$doc->setBuffer($buf, 'component');
    }
}
