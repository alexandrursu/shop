<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 6433 2012-09-12 15:08:50Z openglobal $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
if (isset($this->product->step_order_level))
	$step=$this->product->step_order_level;
else
	$step=1;
if($step==0)
	$step=1;
$alert=JText::sprintf ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED', $step);
?>

<div class="addtocart-area">

	<form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php',false); ?>">
		<input name="quantity" type="hidden" value="<?php echo $step ?>" />
		<?php // Product custom_fields
		if (!empty($this->product->customfieldsCart)) {
			?>
			<div class="product-fields">
				<?php foreach ($this->product->customfieldsCart as $field) { ?>
				<div class="product-field product-field-type-<?php echo $field->field_type ?>">
					<?php if ($field->show_title) { ?>
						<span class="product-fields-title-wrapper"><span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
					<?php }
					if ($field->custom_tip) {
						echo JHTML::tooltip (vmText::_($field->custom_tip), vmText::_ ($field->custom_title), 'tooltip.png');
					} ?></span>
					<span class="product-field-display"><?php echo $field->display ?></span>
					<span class="product-field-desc"><?php echo vmText::_($field->custom_field_desc) ?></span>
				</div><br/>
				<?php } ?>
			</div>
			<?php
		}
		/* Product custom Childs
			 * to display a simple link use $field->virtuemart_product_id as link to child product_id
			 * custom_value is relation value to child
			 */

		if (!empty($this->product->customsChilds)) {
			?>
			<div class="product-fields">
				<?php foreach ($this->product->customsChilds as $field) { ?>
				<div class="product-field product-field-type-<?php echo $field->field->field_type ?>">
					<span class="product-fields-title"><strong><?php echo JText::_ ($field->field->custom_title) ?></strong></span>
					<span class="product-field-desc"><?php echo JText::_ ($field->field->custom_value) ?></span>
					<span class="product-field-display"><?php echo $field->display ?></span>

				</div><br/>
				<?php } ?>
			</div>
		<?php
		}

		if (!VmConfig::get('use_as_catalog', 0)  ) {
		?>

		<div class="addtocart-bar">

<script type="text/javascript">
		function check(obj) {
 		// use the modulus operator '%' to see if there is a remainder
		remainder=obj.value % <?php echo $step?>;
		quantity=obj.value;
 		if (remainder  != 0) {
 			alert('<?php echo $alert?>!');
 			obj.value = quantity-remainder;
 			return false;
 			}
 		return true;
 		}
</script> 

		<?php // Display the quantity box

			$stockhandle = VmConfig::get ('stockhandle', 'none');
			if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($this->product->product_in_stock - $this->product->product_ordered) < 1) {
				?>
				<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $this->product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>
				<?php
			} else {
				$tmpPrice = (float) $this->product->prices['costPrice'];
				if (!( VmConfig::get('askprice', 0) and empty($tmpPrice) ) ) {
					?>
					
					<div class="quantity-superbox">
					<span class="quantity-box">
						<!--<input type="text" class="quantity-input js-recalculate" name="quantity[]" onblur="check(this);"
							   value="<?php if (isset($this->product->step_order_level) && (int)$this->product->step_order_level > 0) {
									echo $this->product->step_order_level;
								} else if(!empty($this->product->min_order_level)){
									echo $this->product->min_order_level;
								}else {
									echo '1';
								} ?>"/>-->
       <label for="quantity<?php echo $this->product->virtuemart_product_id; ?>" class="quantity_box"><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> 
        <div class="FlexibleProductDetailsSelectBox">
                <select class="quantity-input js-recalculate" name="quantity[]">
  	    <option value="1">1</option>
  	    <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>   
		</select>  
         </div>

					</span>
					<span class="quantity-controls js-recalculate">
					<input type="button" class="quantity-controls quantity-plus"/>
					<input type="button" class="quantity-controls quantity-minus"/>
					</span>
					</div>
					<?php // Display the quantity box END

					// Display the add to cart button ?>
													   <div class="product-short-description">
                                        	    	    	<?php  echo nl2br($this->product->product_s_desc); ?>

                                   	                 </div>
                    <div class="row">
                      <div class="col-md-8 col-xs-8">
                        <span class="addtocart-button">
                        <?php echo shopFunctionsF::getAddToCartButton ($this->product->orderable);
                            // Display the add to cart button END  ?>
                         </span>
                        <input type="hidden" class="pname" value="<?php echo htmlentities($this->product->product_name, ENT_QUOTES, 'utf-8') ?>"/>
                        <input type="hidden" name="view" value="cart"/>
                        <noscript><input type="hidden" name="task" value="add"/></noscript>
                        <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $this->product->virtuemart_product_id ?>"/>
					  </div>
					  <div class="col-md-4 col-xs-4">
                           {easycompare}
					  </div>
					</div>
				<?php
				}
				?>
			<?php
			}
			?>
			<div class="clear"></div>
		</div>
		<?php
		}
		?>
		<input type="hidden" name="option" value="com_virtuemart"/>

	</form>
	<div class="clear"></div>
</div>
