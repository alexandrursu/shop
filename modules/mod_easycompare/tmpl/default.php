<?php
/*
 * @package   Joomla 2.5
 * @author    Easy Software s.r.o.
 * @authorurl http://www.easysoftware.cz 
 * @license   GNU/GPL
 * 
 * General module - default template
 */ 
defined('_JEXEC') or die('Restricted access'); 
$return = base64_encode(JURI::getInstance()->toString());
?>
<div class="mod_easycompare" id="<?php echo $unique_id; ?>">  
	<?php if(is_array($products) && count($products) > 0){ ?>
	<?php foreach($products as $product){//virtuemart_product_id ?>
		<div class="modEasyCompareItem">
			<a class="easyCompareButton uncompare" href="<?php echo JRoute::_('index.php?option=com_easycompare&task=easycompares.deleteproduct&id='.$product->virtuemart_product_id.'&return='.$return); ?>">
				<img src="components/com_easycompare/assets/images/remove_small.png" alt="<?php echo JText::_('MOD_EASYCOMPARE_BUTTON_UNCOMPARE'); ?>" />
			</a>
			
			<a class="product_name" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id); ?>">
			<?php echo $product->product_name; ?>
			</span>
			
		</div>
	<?php }//endforeach ?>
	
	<a class="btn easyCompareButton showCompare" href="<?php echo JRoute::_('index.php?option=com_easycompare&view=easycompares'.$itemIdString); ?>">
		<?php echo JText::_('MOD_EASYCOMPARE_BUTTON_GO_TO_COMPARE'); ?>
	</a>
	<?php } else { ?>
	<p><?php echo JText::_('MOD_EASYCOMPARE_HELP_NOTE'); ?></p>
	<?php }//endif ?>

</div>