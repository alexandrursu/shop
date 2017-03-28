<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_images.php 6188 2012-06-29 09:38:30Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
vmJsApi::css('jquery.fancybox-1.3.4');
$document = JFactory::getDocument ();
$imageJS = '
jQuery(document).ready(function() {
	jQuery("a[rel=vm-additional-images]").fancybox({
		"titlePosition" 	: "inside",
		"transitionIn"	:	"elastic",
		"transitionOut"	:	"elastic"
	});
	jQuery(".additional-images .product-image").click(function() {
		jQuery(".main-image img").attr("src",this.src );
		jQuery(".main-image img").attr("alt",this.alt );
		jQuery(".main-image a").attr("href",this.src );
		jQuery(".main-zoom").attr("href",this.src );
		jQuery(".main-image a").attr("title",this.alt );
	}); 
	jQuery(".main-zoom").click(function() {
		jQuery(".main-image a").trigger( "click" );
	});
  if (jQuery(".additional-images .product-image").length <=4 ) {
    jQuery(".arrow-down-product,.arrow-up-product").hide();
    jQuery(".additional-images").css("padding","0")
  };

// slider starts
        var slideCount = jQuery(".additional-images .product-image").length;
        var slideHeight = jQuery(".additional-images .product-image").height();
	var sliderUlHeight = slideCount * slideHeight + (slideCount * 2);
	var marginTopCount = (function(){
		if(slideCount > 4){
			return slideCount - 4;
		}
	})();
        var marginTop = marginTopCount * slideHeight;

// initialize slider
        jQuery(".additional-images .slider-container").css({ height: sliderUlHeight});

// click functions
    function moveTop() {
        jQuery(".additional-images .slider-container").animate({
            top: + slideHeight
        }, 200, function () {

            jQuery(".additional-images .slider-container .floatleft:first-child").appendTo(".additional-images .slider-container");
            jQuery(".additional-images .slider-container").css("bottom", "");
jQuery(".slider-container .floatleft:first-child img").click();
        });
       
        
    };

    function moveBottom() {
        jQuery(".additional-images .slider-container").animate({
            bottom: - slideHeight
        }, 200, function () {
            jQuery(".additional-images .slider-container .floatleft:last-child").prependTo(".additional-images .slider-container");
            jQuery(".additional-images .slider-container").css("top", "");
jQuery(".slider-container .floatleft:first-child img").click();
        });
       
        
    };

    jQuery(".arrow-up-product").click(function () {
        moveTop();
        
    });

    jQuery(".arrow-down-product").click(function () {
        moveBottom();


    });

// click functions


// slider starts

});
';
$document->addScriptDeclaration ($imageJS);

if (!empty($this->product->images)) {
	$image = $this->product->images[0];
	?>
<div class="main-image">
    <span class="main-arrow arrow-up-product "><i class="fa fa-angle-left"></i></span>
    <span class="main-arrow arrow-down-product"><i class="fa fa-angle-right"></i></span>

	<?php
		echo $image->displayMediaFull("",true,"rel='vm-additional-images'");
	?>

	 <div class="clear"></div>
</div>
<?php
	$count_images = count ($this->product->images);
	if ($count_images > 0) {
		?>
    <span class="main-zoom"><i class="fa fa-plus-circle"></i> ZOOM</span>

    <div class="additional-images">
    <span class="arrow-up-product"><i class="fa fa-angle-up"></i></span>
    <span class="arrow-down-product"><i class="fa fa-angle-down"></i></span>
    <div class="slider-container">
		<?php
		for ($i = 0; $i < $count_images; $i++) {
			$image = $this->product->images[$i];
			?>
            <div class="floatleft">
	            <?php
	                echo $image->displayMediaFull('class="product-image" style="cursor: pointer"',false,"");
	            ?>
            </div>
			<?php
		}
		?>
     </div>    
    </div>
	<?php
	}
}
  // Showing The Additional Images END ?>