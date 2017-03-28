<?php
/*------------------------------------------------------------------------
# Plg_vmwwmzoompro : WWM Product Zoom Pro for Virtuemart
# ------------------------------------------------------------------------
# author    walkswithme.net
# copyright Copyright (C) 2013 walkswithme.net. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.walkswithme.net/
# Technical Support:  Forum - http://www.walkswithme.net/virtuemart-product-image-zoom-pro
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
jimport('joomla.application.component.helper');
class PlgSystemVmWWMZoomPro extends JPlugin{

	public function onBeforeRender() {
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$view = JRequest::getVar('view');
		if ($app->isAdmin()){
					return true;
				}
			if ($view !='productdetails'){
				return true;
			}
		$wwm_livepath = JURI::root(true).'/plugins/system/vmwwmzoompro/';
		$show_jquery = $this->params->get('show_jquery',1);
			if($show_jquery==1){
				$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/jquery.js"></script>');
				$doc->addCustomtag('<script type="text/javascript">jQuery.noConflict();</script>');
			}
			$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/jquery.nicescroll.min.js"></script>');
			$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/jquery.mousewheel.js"></script>');
			$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/touch.js"></script>');
			$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/zoom.js"></script>');
			
			$doc->addCustomtag('<script type="text/javascript">'.$this->WWM_Custom_Js().'</script>');
			if($this->params->get('slider',1)){
				$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/jcarousel.js"></script>');
				$doc->addCustomtag('<script type="text/javascript" src="'.$wwm_livepath.'js/slider.js"></script>');
			}
			$doc->addStyleSheet($wwm_livepath.'css/zoom.css');	
			if($this->params->get('slider',1))
				$doc->addStyleSheet($wwm_livepath.'css/jcarousel.css');	
			
	}
	public function onAfterRender() {
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$view = JRequest::getVar('view');
		if ($app->isAdmin()){
				return true;
			}
		if ($view !='productdetails'){
			return true;
		}
						
		$buffer = JResponse::getBody();	
		$main_imageClass = 	$this->params->get('mainClass','main-image');
		$more_imageClass = 	$this->params->get('aImageClass','additional-images');
		$regx = '/<div class="'.$main_imageClass.'">([^`]*?)<\/div>/';
		$regx2 = '/<div class="floatleft">([^`]*?)<\/div>/';
		$regx3 = '/<div class="'.$more_imageClass.'">/';
		$WWM_Main_Image = $this->WWM_Main_Image();
		$WWM_Other_Images = $this->WWM_Other_Images();
		
		$buffer = preg_replace($regx2,'',$buffer);		
		$buffer = preg_replace($regx,$WWM_Main_Image,$buffer);	
		$buffer = preg_replace($regx3,$WWM_Other_Images,$buffer);		
			
		JResponse::setBody($buffer);

		return true;
	}
	
	function WWM_Custom_Js(){
		
		$zoomType = 		$this->params->get('zoomType','dock');
		$slider			 = 	$this->params->get('slider',1);
		
		
		
		
		$custome_js  = "";
		
		/*if($slider){
		
		}*/
		
		
		
			$custome_js  .= "jQuery(document).ready(function(){
			jQuery('a#zoom1').swinxyzoom({mode:'".$zoomType."', controls: false, size: '100%', dock: { position: 'right' } }); 
			
			jQuery('.views-gallery .slider a').click(function(e) {
				e.preventDefault();
				
				
				var $this = jQuery(this),
				  largeImage  = $this.attr('href');
				  smallImage  = $this.data('easyzoom-source');
				
                if (!$this.parent().hasClass('thumbnail-active')) {
					jQuery('a#zoom1').swinxyzoom('load', smallImage,  largeImage);
					jQuery('.lightbox-btn').attr('href', largeImage);
					
					jQuery('.views-gallery li').removeClass('thumbnail-active');
					jQuery(this).parent().addClass('thumbnail-active');
				}
				
			});
    	});";
		
		
	return $custome_js;
		
	}
	
	function WWM_Main_Image(){
		if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
		$config = VmConfig::loadConfig();
		$wwm_livepath = JURI::root(true).'/plugins/system/vmwwmzoompro/';
		$product_model = VmModel::getModel('product');
		$virtuemart_product_id = JRequest::getInt('virtuemart_product_id', 0);
		$product = $product_model->getProduct($virtuemart_product_id);
		$images = $product->images;
		$main_image_url = $images[0]->file_url;
		$main_image_title = $images[0]->file_title;
		$main_image_description = $images[0]->file_description;
		$main_image_alt = $images[0]->file_meta;

		$j = count($images);
		$imageWidth = 		trim($this->params->get('imageWidth',350));
		if($imageWidth==''){$imageWidth = 'auto';}
		$imageHeight = 		trim($this->params->get('imageHeight'));
		if($imageHeight==''){$imageHeight = 'auto';}
		$containerwidth 	= 		trim($this->params->get('containerwidth',100));
		//add HTML
		$slider			 = 	$this->params->get('slider',1);
		
		
		$html = "";
		$html .= "<div class=\"wwm_image_zoom\" style='width:".$containerwidth."%;'>";
		$html .= "<a id='zoom1' class='zoom' href='".JURI::root().$main_image_url."'><img src ='".JURI::root().$main_image_url."'
             width='".$imageWidth."' height='".$imageHeight."' /></a>";
		
		if($slider && $j >1){
		
		}else{
			$html .= '</div>';
		}
		
    return $html;
	}
	
	
	function WWM_Other_Images(){
		if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
		$config = VmConfig::loadConfig();
		$wwm_livepath = JURI::root(true).'/plugins/system/vmwwmzoompro/';
		$product_model = VmModel::getModel('product');
		$virtuemart_product_id = JRequest::getInt('virtuemart_product_id', 0);
		$product = $product_model->getProduct($virtuemart_product_id);
		$images = $product->images;
		
		$main_image_url = JURI::root(true). $images[0]->file_url;
		$main_image_title = $images[0]->file_title;
		$main_image_description = $images[0]->file_description;
		$main_image_alt = $images[0]->file_meta;

		$j = count($images);
		$thumbimageWidth = 		trim($this->params->get('thumbimageWidth',80));
		if($thumbimageWidth==''){$thumbimageWidth = 'auto';}
		$thumbimageHeight = 		trim($this->params->get('thumbimageHeight',75));
		if($thumbimageHeight==''){$thumbimageHeight = 'auto';}
		
		
		
		$html = "";
		
		if($j >1){
		$html .= "<div id=\"WWM_thumbs_images\"  class='views-gallery jcarousel-wrapper'>
					<div class='jcarousel'>
					<ul class='slider'>";	
			
				$html .= "<li style='width:".($thumbimageWidth)."px' class='thumbnail-active'>
						  <a class='image' href='".JURI::root().$images[0]->file_url."' data-easyzoom-source='".JURI::root(). $images[0]->file_url."'>
			<img style=\"width:".$thumbimageWidth."px !important;height:auto !important;\"   src='".JURI::root().$images[0]->file_url_thumb."' class='attachment-shop_thumbnail'>
                </a></li>";
			$index_count = 0;
			for($i=1; $i<$j; $i++){
				
				
				 $html .= "<li style='width:".($thumbimageWidth)."px'><a class='image' href='".JURI::root().$images[$i]->file_url."' data-easyzoom-source='".JURI::root(). $images[$i]->file_url."'>    
                    <img style=\"width:".$thumbimageWidth."px !important;height:auto !important;\"   src='".JURI::root().$images[$i]->file_url_thumb."' class='attachment-shop_thumbnail'>
                </a></li>";
				
				$index_count++;
				
				
			}	
		
		
		if($this->params->get('slider',1)){
			$controls = '<a  class="jcarousel-control-prev" href="javascript:;"></a>
				    <a class="jcarousel-control-next" id="next_wwm" href="javascript:;"></a>';
		}else{
			$controls = '';
		}
		
		$html .= '</ul></div>'.$controls.'</div>';
		
		}
    return $html;
	}
	
	
}
