<?php
/**
 * @package     com_easycompare
 * @copyright   Copyright (C) 2013 EasyJoomla.org. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      EasyJoomla.org <jan.linhart@easyjoomla.org> - http://easyjoomla.org
 */


// no direct access
defined('_JEXEC') or die;
$return = base64_encode(JURI::getInstance()->toString());
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_easycompare/assets/css/easycompare.css');
?>
<?php if(is_array($this->items) && count($this->items) > 0 && is_array($this->fields) && count($this->fields) > 0){ ?>
<?php $columnWidth = 'style="width:'.(100 / count($this->items)).'%"'; ?>
<div class="container">
<div class="row">


			<?php
			foreach($this->items as $item){
			$fileUrl = JPATH_BASE.DS.$item->images[0]->file_url_thumb;
			$imgUrl = JURI::root().$item->images[0]->file_url_thumb;

			?>

            <div class="col-md-3">
                            <h3 class="easycompare_name">
                                <a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$item->virtuemart_product_id.'&virtuemart_category_id='.$item->virtuemart_category_id); ?>">
                                    <?php echo $item->product_name; ?>
                                </a>
                            </h3>

                            <?php if(JFile::exists($fileUrl) && $this->params->get('show_image', 1)){ ?>
                            <div class="easycompare_image">
                                <a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$item->virtuemart_product_id.'&virtuemart_category_id='.$item->virtuemart_category_id); ?>">
                                    <img src="<?php echo $imgUrl ?>" alt="<?php echo $item->file_title ?>" class="product-image">
                                </a>
                            </div>
                            <?php }//endif ?>

                            <div class="easycompare_uncompare">
                                <a class="btn easyCompareButton uncompare" href="<?php echo JRoute::_('index.php?option=com_easycompare&task=easycompares.deleteproduct&id='.$item->virtuemart_product_id.'&return='.$return); ?>">
                                    <?php echo JText::_('COM_EASYCOMPARE_BUTTON_UNCOMPARE'); ?>
                                </a>
                            </div>
            </div>
			<?php }//endforeach ?>

</div>
</div>
<?php } else { ?>
<p><?php echo JText::_('COM_EASYCOMPARE_HELP_NOTE'); ?></p>
<?php }//endif ?>


<?php if(false){ ?>
<pre><?php var_dump($this->fields); ?></pre>
<pre><?php var_dump($this->items); ?></pre>
<?php }//endif ?>



