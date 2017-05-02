<?php defined ('_JEXEC') or die('Restricted access');
/**
 *
 * Layout for the shopping cart
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 * @author Patrick Kohl
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

?>
<div class="row">
    <div class="col-md-8 col-xs-12">
        <fieldset>
            <h2 align="left"><?php echo JText::_ ('COM_VIRTUEMART_CART_OVERVIEW') ?></h2>
            <?php
            $i = 1;
            // 		vmdebug('$this->cart->products',$this->cart->products);
            foreach ($this->cart->products as $pkey => $prow) {
            	?>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <?php if ($prow->virtuemart_media_id) { ?>
                        <span class="cart-images">
                            <?php
                            if (!empty($prow->image)) {
                                echo $prow->image->displayMediaThumb ('', FALSE);
                            }
                            ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="row">
                        <div class="col-md-10 col-xs-6">
                            <?php echo JHTML::link ($prow->url, $prow->product_name, 'class="pdt_name"') . $prow->product_sku; ?>
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <?php
                                if (VmConfig::get ('checkout_show_origprice', 1) && !empty($this->cart->pricesUnformatted[$pkey]['basePriceWithTax']) && $this->cart->pricesUnformatted[$pkey]['basePriceWithTax'] != $this->cart->pricesUnformatted[$pkey]['salesPrice']) {
                                    echo '<span class="line-through">' . $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $this->cart->pricesUnformatted[$pkey], TRUE, FALSE, $prow->quantity) . '</span><br />';
                                }
                            elseif (VmConfig::get ('checkout_show_origprice', 1) && empty($this->cart->pricesUnformatted[$pkey]['basePriceWithTax']) && $this->cart->pricesUnformatted[$pkey]['basePriceVariant'] != $this->cart->pricesUnformatted[$pkey]['salesPrice']) {
                                    echo '<span class="line-through">' . $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $this->cart->pricesUnformatted[$pkey], TRUE, FALSE, $prow->quantity) . '</span><br />';
                                }
                            echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <?php echo JText::_ ('COM_VIRTUEMART_CART_CULOAREA') ?>
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <div class="culoarea"><?php echo JHTML::link ($prow->url, $prow->product_name, 'class="pdt_name"') ?></div>
                        </div>
                        <div class="col-md-8 hidden-xs">
                            <a class="remove-from-cart" title="<?php echo JText::_ ('COM_VIRTUEMART_CART_DELETE') ?>" align="middle" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id=' . $prow->cart_item_id) ?>" rel="nofollow"><i class="fa fa-close"></i> M-am razgîndit</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <?php echo JText::_ ('COM_VIRTUEMART_CART_MARIMEA') ?>
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <div class="marimea"><?php echo $prow->customfields; ?></div>
                        </div>
                        <div class="col-md-8 hidden-xs">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY') ?>
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <form action="<?php echo JRoute::_ ('index.php'); ?>" method="post" class="inline">
                                <input type="hidden" name="option" value="com_virtuemart"/>
                                    <!--<input type="text" title="<?php echo  JText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class="inputbox" size="3" maxlength="4" name="quantity" value="<?php echo $prow->quantity ?>" /> -->
                                <input type="text"
                                       onblur="check<?php echo $step?>(this);"
                                       onclick="check<?php echo $step?>(this);"
                                       onchange="check<?php echo $step?>(this);"
                                       onsubmit="check<?php echo $step?>(this);"
                                       title="<?php echo  JText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class="quantity-input js-recalculate" size="3" maxlength="4" name="quantity" value="<?php echo $prow->quantity ?>" />
                                <input type="hidden" name="view" value="cart"/>
                                <input type="hidden" name="task" value="update"/>
                                <input type="hidden" name="cart_virtuemart_product_id" value="<?php echo $prow->cart_item_id  ?>"/>
                                <input type="submit" class="vmicon vm2-add_quantity_cart" name="update" title="<?php echo  JText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" align="middle" value=" "/>
                            </form>
                        </div>
                        <div class="col-md-5 hidden-xs">
                        </div>
                        <div class="col-md-3 col-xs-6">
                                {easycompare <?php echo $prow->cart_item_id ?>}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 hidden-xs">
                        </div>
                        <div class="col-md-3 col-xs-12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="border-bottom"></div>
            	<?php
            	$i = ($i==1) ? 2 : 1;
            } ?>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                   <?php echo '<a class="continue" href="' . $this->continue_link . '" >' . JText::_('COM_VIRTUEMART_CONTINUE_SHOPPING') . '</a>'; ?>
                </div>
                <div class="col-md-4 col-xs-12">
                   <a class="see-wishlist" href="index.php?option=com_easycompare&view=easycompares">
                     <i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo JText::_ ('COM_VIRTUEMART_VEZI_WISH') ?>
                   </a>
                </div>
                <div class="col-md-4 hidden-xs">
                </div>
            </div>

<table	class="cart-summary" cellspacing="0" cellpadding="0" border="0"	width="100%">
<tr valign="top" class="sectiontableentry<?php echo $i ?> pdt_line">
	<td align="center">
                <!--<?php
		if (VmConfig::get ('checkout_show_origprice', 1) && $this->cart->pricesUnformatted[$pkey]['discountedPriceWithoutTax'] != $this->cart->pricesUnformatted[$pkey]['priceWithoutTax']) {
			echo '<span class="line-through">' . $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $this->cart->pricesUnformatted[$pkey], TRUE, FALSE) . '</span><br />';
		}
		if ($this->cart->pricesUnformatted[$pkey]['discountedPriceWithoutTax']) {
			echo $this->currencyDisplay->createPriceDiv ('discountedPriceWithoutTax', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE);
		} else {
			echo $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE);
		}
		// 					echo $prow->salesPrice ;
		?>-->
	</td>
	<td align="right"><?php
//				$step=$prow->min_order_level;
				if ($prow->step_order_level)
					$step=$prow->step_order_level;
				else
					$step=1;
				if($step==0)
					$step=1;
				$alert=JText::sprintf ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED', $step);
				?>
                <script type="text/javascript">
				function check<?php echo $step?>(obj) {
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
	</td>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) . "</span>" ?></td>
	<?php } ?>
	<td align="right"><?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('discountAmount', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) . "</span>" ?></td>
</tr>
</table>
</fieldset>
</div>

<div class="col-md-4 col-xs-12">
    <div class="billto-shipto">
        <h2 align="left"><?php echo JText::_ ('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL') ?></h2>

	<div class="width100 floatleft">

		<span class="informatii-personale">
			<?php echo JText::_ ('COM_VIRTUEMART_USER_FORM_BILLTO_LBL'); ?>
		</span>
		<a class="fl mr-5" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT', $this->useXHTML, $this->useSSL) ?>" rel="nofollow">
			<i class="fa fa-pencil"></i>
		</a>
		<?php // Output Bill To Address ?>
		<div class="output-billto">
			<?php

			foreach ($this->cart->BTaddress['fields'] as $item) {
				if (!empty($item['value'])) {
					if ($item['name'] === 'agreed') {
						$item['value'] = ($item['value'] === 0) ? JText::_ ('COM_VIRTUEMART_USER_FORM_BILLTO_TOS_NO') : JText::_ ('COM_VIRTUEMART_USER_FORM_BILLTO_TOS_YES');
					}
					?><span class="titles"><?php echo $item['title'] ?></span>
					<span class="values vm2<?php echo '-' . $item['name'] ?>"><?php echo $this->escape ($item['value']) ?></span>
					<?php if ($item['name'] != 'title' and $item['name'] != 'first_name' and $item['name'] != 'middle_name' and $item['name'] != 'zip') { ?>
						<br class="clear"/>
						<?php
					}
				}
			} ?>
			<div class="clear"></div>
		</div>



		<input type="hidden" name="billto" value="<?php echo $this->cart->lists['billTo']; ?>"/>
	</div>

	<!--<div class="width50 floatleft">

		<span><span class="vmicon vm2-shipto-icon"></span>
			<?php echo JText::_ ('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL'); ?></span>
		<?php // Output Bill To Address ?>
		<div class="output-shipto">
			<?php
			if (empty($this->cart->STaddress['fields'])) {
				echo JText::sprintf ('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_EXPLAIN', JText::_ ('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL'));
			} else {
				if (!class_exists ('VmHtml')) {
					require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
				}
				echo JText::_ ('COM_VIRTUEMART_USER_FORM_ST_SAME_AS_BT');
				echo VmHtml::checkbox ('STsameAsBTjs', $this->cart->STsameAsBT) . '<br />';
				?>
				<div id="output-shipto-display">
					<?php
					foreach ($this->cart->STaddress['fields'] as $item) {
						if (!empty($item['value'])) {
							?>
							<!--<span class="titles"><?php echo $item['title'] ?></span> -->
							<?php
							if ($item['name'] == 'first_name' || $item['name'] == 'middle_name' || $item['name'] == 'zip') {
								?>
								<span class="values<?php echo '-' . $item['name'] ?>"><?php echo $this->escape ($item['value']) ?></span>
								<?php } else { ?>
								<span class="values"><?php echo $this->escape ($item['value']) ?></span>
								<br class="clear"/>
								<?php
							}
						}
					}
					?>
				</div>
				<?php
			}
			?>
			<div class="clear"></div>
		</div>
		<?php if (!isset($this->cart->lists['current_id'])) {
		$this->cart->lists['current_id'] = 0;
	} ?>
		<a class="details" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=ST&virtuemart_user_id[]=' . $this->cart->lists['current_id'], $this->useXHTML, $this->useSSL) ?>" rel="nofollow">
			<?php echo JText::_ ('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL'); ?>
		</a>

	</div>-->

	<div class="clear"></div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <hr>
        </div>
    </div>
<!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
<?php if (VmConfig::get ('show_tax')) {
	$colspan = 3;
} else {
	$colspan = 2;
} ?>

<?php
if (VmConfig::get ('coupons_enable')) {
	?>
	<?php if (!empty($this->layoutName) && $this->layoutName == 'default') {
	// echo JHTML::_('link', JRoute::_('index.php?view=cart&task=edit_coupon',$this->useXHTML,$this->useSSL), JText::_('COM_VIRTUEMART_CART_EDIT_COUPON'));
	echo $this->loadTemplate ('coupon');
}
	?>

	<?php if (!empty($this->cart->cartData['couponCode'])) { ?>
	<?php
	echo $this->cart->cartData['couponCode'];
	echo $this->cart->cartData['couponDescr'] ? (' (' . $this->cart->cartData['couponDescr'] . ')') : '';
	?>


					 <?php if (VmConfig::get ('show_tax')) { ?>
		<?php echo $this->currencyDisplay->createPriceDiv ('couponTax', '', $this->cart->pricesUnformatted['couponTax'], FALSE); ?>
		<?php } ?>
	    <?php echo $this->currencyDisplay->createPriceDiv ('salesPriceCoupon', '', $this->cart->pricesUnformatted['salesPriceCoupon'], FALSE); ?>
	<?php } else { ?>

	<?php
}
	?>
	<?php } ?>


<?php
foreach ($this->cart->cartData['DBTaxRulesBill'] as $rule) {
	?>
<div class="sectiontableentry<?php echo $i ?>">
	<span colspan="4" align="right"><?php echo $rule['calc_name'] ?> </span>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<?php } ?>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?></span>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?></span>
</div>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
} ?>

<?php

foreach ($this->cart->cartData['taxRulesBill'] as $rule) {
	?>
<div class="sectiontableentry<?php echo $i ?>">
	<span colspan="4" align="right"><?php echo $rule['calc_name'] ?> </span>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </span>
	<?php } ?>
	<span><?php ?> </span>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </span>
</div>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
}

foreach ($this->cart->cartData['DATaxRulesBill'] as $rule) {
	?>
<div class="sectiontableentry<?php echo $i ?>">
	<span><?php echo   $rule['calc_name'] ?> </span>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<?php } ?>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?>  </span>
	<span><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </span>
</div>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
}

if ($this->checkout_task) {
$taskRoute = '&task=' . $this->checkout_task;
}
else {
$taskRoute = '';
}
if (VmConfig::get('oncheckout_opc', 1)) {
?>


<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>">
	<?php } ?>
	<?php if (!$this->cart->automaticSelectedShipment) { ?>

	<?php /*	<span ><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPPING'); ?> </span> */ ?>
				<?php echo $this->cart->cartData['shipmentName']; ?>
	<?php
	if (!empty($this->layoutName) && $this->layoutName == 'default' && !$this->cart->automaticSelectedShipment) {
		if (VmConfig::get('oncheckout_opc', 1)) {
			$previouslayout = $this->setLayout('select');
			echo $this->loadTemplate('shipment');
			$this->setLayout($previouslayout);
		} else {
			echo JHTML::_('link', JRoute::_('index.php?view=cart&task=edit_shipment', $this->useXHTML, $this->useSSL), $this->select_shipment_text, 'class="fl mr-5"');
		}
	} else {
		echo JText::_ ('COM_VIRTUEMART_CART_SHIPPING');
	}?>
    <?php
    } else {
	?>
	<?php echo $this->cart->cartData['shipmentName']; ?>
	<?php } ?>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<span><?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('shipmentTax', '', $this->cart->pricesUnformatted['shipmentTax'], FALSE) . "</span>"; ?> </span>
	<?php } ?>
	<span class="test1">
	    <?php if($this->cart->pricesUnformatted['salesPriceShipment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->pricesUnformatted['salesPriceShipment'], FALSE); ?>
   </span>
	<span class="shipment-price">
	    <?php echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->pricesUnformatted['salesPriceShipment'], FALSE); ?>
	    <?php if($this->cart->pricesUnformatted['billTotal'] > 500) echo JText::_ ('0 MDL'); ?>
	</span>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <hr>
        </div>
    </div>


<?php if ($this->cart->pricesUnformatted['salesPrice']>0.0 ) { ?>
	<?php if (!$this->cart->automaticSelectedPayment) { ?>

	<span>
		<?php echo $this->cart->cartData['paymentName']; ?>

		<?php if (!empty($this->layoutName) && $this->layoutName == 'default') {
			if (VmConfig::get('oncheckout_opc', 1)) {
				$previouslayout = $this->setLayout('select');
				echo $this->loadTemplate('payment');
				$this->setLayout($previouslayout);
			} else {
				echo JHTML::_('link', JRoute::_('index.php?view=cart&task=editpayment', $this->useXHTML, $this->useSSL), $this->select_payment_text, 'class="fl mr-5"');
			}
		} else {
		echo JText::_ ('COM_VIRTUEMART_CART_PAYMENT');
	} ?> </span>

	</span>
	<?php } else { ?>
	<span><?php echo $this->cart->cartData['paymentName']; ?> </span>
	<?php } ?>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<span><?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('paymentTax', '', $this->cart->pricesUnformatted['paymentTax'], FALSE) . "</span>"; ?> </span>
	<?php } ?>
	<span><?php if($this->cart->pricesUnformatted['salesPricePayment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->pricesUnformatted['salesPricePayment'], FALSE); ?></span>
	<span><?php  echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->pricesUnformatted['salesPricePayment'], FALSE); ?> </span>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <hr class="bold-black">
        </div>
    </div>
    <?php } ?>
        <div class="row">
            <div class="col-md-8">
                <?php echo JText::_ ('COM_VIRTUEMART_CART_TOTAL') ?>:
            </div>
            <div class="col-md-4">
                <!--<?php if (VmConfig::get ('show_tax')) { ?>
                <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('billTaxAmount', '', $this->cart->pricesUnformatted['billTaxAmount'], FALSE) . "</span>" ?>
                <?php } ?>
                <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('billDiscountAmount', '', $this->cart->pricesUnformatted['billDiscountAmount'], FALSE) . "</span>" ?> -->
                <div class="bold"><?php echo $this->currencyDisplay->createPriceDiv ('billTotal', '', $this->cart->pricesUnformatted['billTotal'], FALSE); ?></div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <hr class="bold-black">
        </div>
    </div>



    <?php
    if ($this->totalInPaymentCurrency) {
    ?>
    <div class="row">
        <div class="col-md-8">
            <?php echo JText::_ ('COM_VIRTUEMART_CART_TOTAL_PAYMENT') ?>:
        </div>
        <div class="col-md-8">
            <?php if (VmConfig::get ('show_tax')) { ?>
            <?php } ?>
            <strong><?php echo $this->totalInPaymentCurrency;   ?></strong>
        </div>
	</div>

	<?php
    }
    ?>
        <?php //  Checkout button with agreement start  ?>
        <?php
        if (!VmConfig::get('oncheckout_opc', 1)) {
            if ($this->checkout_task) {
                $taskRoute = '&task=' . $this->checkout_task;
            }
            else {
                $taskRoute = '';
            }
        ?>
        <form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>">
        <?php } ?>
            <?php // Leave A Comment Field ?>
            <div class="customer-comment marginbottom15">
                <span class="comment"><?php echo JText::_ ('COM_VIRTUEMART_COMMENT_CART'); ?></span><br/>
                <textarea class="customer-comment" name="customer_comment" cols="60" rows="1"><?php echo $this->cart->customer_comment; ?></textarea>
            </div>
            <?php // Leave A Comment Field END ?>



            <?php // Continue and Checkout Button ?>
            <div class="checkout-button-top">

                <?php // Terms Of Service Checkbox
                if (!class_exists ('VirtueMartModelUserfields')) {
                    require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'userfields.php');
                }
                $userFieldsModel = VmModel::getModel ('userfields');
                if ($userFieldsModel->getIfRequired ('agreed')) {
                        if (!class_exists ('VmHtml')) {
                            require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
                        }
                        echo VmHtml::checkbox ('tosAccepted', $this->cart->tosAccepted, 1, 0, 'class="terms-of-service"');

                        if (VmConfig::get ('oncheckout_show_legal_info', 1)) {
                            ?>
                            <div class="terms-of-service">

                                <label for="tosAccepted">
                                    <a href="<?php JRoute::_ ('index.php?option=com_virtuemart&view=vendor&layout=tos&virtuemart_vendor_id=1', FALSE) ?>" class="terms-of-service" id="terms-of-service" rel="facebox"
                                     target="_blank">
                                        <span class="vmicon vm2-termsofservice-icon"></span>
                                        <?php echo JText::_ ('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED'); ?>
                                    </a>
                                </label>

                                <div id="full-tos">
                                    <h2><?php echo JText::_ ('COM_VIRTUEMART_CART_TOS'); ?></h2>
                                    <?php echo $this->cart->vendor->vendor_terms_of_service; ?>
                                </div>

                            </div>
                            <?php
                        } // VmConfig::get('oncheckout_show_legal_info',1)
                        //echo '<span class="tos">'. JText::_('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED').'</span>';
                }
                echo $this->checkout_link_html;
                ?>
            </div>
            <?php // Continue and Checkout Button END ?>
            <input type='hidden' name='order_language' value='<?php echo $this->order_language; ?>'/>
            <input type='hidden' id='STsameAsBT' name='STsameAsBT' value='<?php echo $this->cart->STsameAsBT; ?>'/>
            <input type='hidden' name='task' value='<?php echo $this->checkout_task; ?>'/>
            <input type='hidden' name='option' value='com_virtuemart'/>
            <input type='hidden' name='view' value='cart'/>
        </form>
        <?php // Checkout button with agreement end ?>

</div>
</div>
</div>
</div>
