<?php
/*
* Pixel Point Creative | Wide Slide Module for Joomla! 
* License: GNU General Public License version 2 
* See: http://www.gnu.org/copyleft/gpl.html
* Copyright (c) Pixel Point Creative LLC.
* More info at http://www.pixelpointcreative.com
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
$mwidth = $params->get( 'mwidth' );
$timer = $params->get( 'timer' );
$margin_top = $params->get( 'margin_top' );
$document =& JFactory::getDocument();

$styles = '#fwslider'. $module->id .' .title { color: '. ($caption_color) .'; }';
$styles .= '#fwslider'. $module->id .' .description { color: '. ($desc_color) .'; }';
$styles .= '#fwslider'. $module->id .' .readmore { color: '. ($readmore_color) .'; }';
$styles .= '#fwslider'. $module->id .' .slide_content_wrap { margin: '. ($margin_top) .' auto 5% auto; }';

$document->addStyleDeclaration($styles);


?>
<?php if (isset($items['imgs']) && sizeof($items['imgs']) > 0):?>
<div id="fwslider<?php echo $module->id?>" class="fwslider" style="max-width:<?php echo $mwidth?>; margin:auto;">
	<div class="slider_container">
		<?php foreach ($items['imgs'] as $key => $img):?>
		<div class="slide"> 
			<!-- Slide image -->
			<img src="<?php echo $img;?>">
			<!-- /Slide image -->
					
			<!-- Texts container -->
			<div class="slide_content">
				<div class="slide_content_wrap">
					<?php if (isset($items['captions'][$key]) && $items['captions'][$key] != '' && $showCaption):?>
					<!-- Text title -->
					<h4 class="title"><?php echo $items['captions'][$key]?></h4>
					<!-- /Text title -->
					<?php endif; ?>
					<?php if (isset($items['desc'][$key]) && $items['desc'][$key] != '' && $showDesc):?>
					<!-- Text description -->
					<p class="description"><?php echo $items['desc'][$key];?></p>
					<!-- /Text description -->
					<?php endif; ?>	
					<?php if (isset($items['urls'][$key]) && $items['urls'][$key] != '' && $showReadmore):?>
					<!-- Learn more button -->
					<a class="readmore" <?php echo (isset($items['target'][$key]) && $items['target'][$key] != '') ? 'target="' . $items['target'][$key] . '"' : '';?> href="<?php echo $items['urls'][$key];?>"><?php echo $readmoreText?></a>
					<!-- /Learn more button -->
					<?php endif; ?>	
				</div>
			</div>
			<!-- /Texts container -->
		</div>
		<?php endforeach;?>
	</div>
	<?php if ($auto_play) :?>
	<div style="display:<?php echo $timer?>"><div class="timers"></div></div>
	<?php endif; ?>	
	<?php if ($show_button) :?>
	<div class="slidePrev"><span></span></div>
	<div class="slideNext"><span></span></div>
	<?php endif; ?>	
</div> 
<script type="text/javascript">
// <![CDATA[
	
	$jppc(window).load(function(){
		new fwslider().init({
			duration: "<?php echo $duration;?>", /* Fade Speed (miliseconds) */
			pause:    "<?php echo $pause;?>",  /* Autoslide pause between slides (miliseconds)*/
			mID: <?php echo $module->id;?>
		});
	});			
 // ]]>       
</script>
<?php endif;?>