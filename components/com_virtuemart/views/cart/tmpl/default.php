<?php
/**
 *
 * Layout for the shopping cart
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
if(VmConfig::get('usefancy',0)){
	vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
	vmJsApi::css('jquery.fancybox-1.3.4');
	$box = "
//<![CDATA[
	jQuery(document).ready(function($) {
		$('div#full-tos').hide();
		var con = $('div#full-tos').html();
		$('a#terms-of-service').click(function(event) {
			event.preventDefault();
			$.fancybox ({ div: '#full-tos', content: con });
		});
	});

//]]>
";
} else {
	vmJsApi::js ('facebox');
	vmJsApi::css ('facebox');
	$box = "
//<![CDATA[
	jQuery(document).ready(function($) {
		$('div#full-tos').hide();
		$('a#terms-of-service').click(function(event) {
			event.preventDefault();
			$.facebox( { div: '#full-tos' }, 'my-groovy-style');
		});
	});

//]]>
";
}

JHtml::_ ('behavior.formvalidation');
$document = JFactory::getDocument ();
$document->addScriptDeclaration ($box);
$document->addScriptDeclaration ("

//<![CDATA[
	jQuery(document).ready(function($) {
	if ( $('#STsameAsBTjs').is(':checked') ) {
				$('#output-shipto-display').hide();
			} else {
				$('#output-shipto-display').show();
			}
		$('#STsameAsBTjs').click(function(event) {
			if($(this).is(':checked')){
				$('#STsameAsBT').val('1') ;
				$('#output-shipto-display').hide();
			} else {
				$('#STsameAsBT').val('0') ;
				$('#output-shipto-display').show();
			}
		});
	});

//]]>

");
$document->addStyleDeclaration ('#facebox .content {display: block !important; height: 480px !important; overflow: auto; width: 560px !important; }');

?>

<div class="cart-view">
    <div class="container">
        <div class="useless">
            <div class="width50 floatleft">
                <h1><?php echo JText::_ ('COM_VIRTUEMART_CART_TITLE'); ?></h1>
            </div>
            <?php if (VmConfig::get ('oncheckout_show_steps', 1) && $this->checkout_task === 'confirm') {
            vmdebug ('checkout_task', $this->checkout_task);
            echo '<div class="container"><div class="checkoutStep" id="checkoutStep4">' . JText::_ ('COM_VIRTUEMART_USER_FORM_CART_STEP4') . '</div></div>';
        } ?>
            <div class="width50 floatleft right">
                <?php // Continue Shopping Button
                if (!empty($this->continue_link_html)) {
                    echo $this->continue_link_html;
                } ?>
            </div>
            <div class="clear"></div>
        </div>



        <?php echo shopFunctionsF::getLoginForm ($this->cart, FALSE);

        // This displays the form to change the current shopper
        $adminID = JFactory::getSession()->get('vmAdminID');
        if ((JFactory::getUser()->authorise('core.admin', 'com_virtuemart') || JFactory::getUser($adminID)->authorise('core.admin', 'com_virtuemart')) && (VmConfig::get ('oncheckout_change_shopper', 0))) {
            echo $this->loadTemplate ('shopperform');
        }



        // This displays the pricelist MUST be done with tables, because it is also used for the emails
        echo $this->loadTemplate ('pricelist');

        // added in 2.0.8
        ?>
        <div id="checkout-advertise-box">
            <?php
            if (!empty($this->checkoutAdvertise)) {
                foreach ($this->checkoutAdvertise as $checkoutAdvertise) {
                    ?>
                    <div class="checkout-advertise">
                        <?php echo $checkoutAdvertise; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </div>
</div>
