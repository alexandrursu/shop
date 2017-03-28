<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2014 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 02/04/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

	
$document->addCustomTag('
<style type="text/css">

.ext_owl_carousel_'.$ext_id.' {
	max-width: '.$ext_width_block.'px;
}

</style>');
?>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#owl-example-<?php echo $ext_id;?>").owlCarousel({
		items : <?php echo $ext_items; ?>,		

		navigation : <?php echo $ext_navigation; ?>,
		pagination : <?php echo $ext_pagination; ?>,
		
		paginationNumbers : <?php echo $ext_paginationnumbers; ?>	
		
		
	});
	
  
});


</script>

<div class="mod_ext_owl_carousel_images ext_owl_carousel_<?php echo $ext_id; ?> <?php echo $moduleclass_sfx ?>">	
	<div id="owl-example-<?php echo $ext_id; ?>" class="owl-carousel owl-theme" >	
		<?php	
		for($n=0;$n < count($img);$n++) {			
			if( $img[$n] != '') {		
				if ($url[$n] != '') {
					echo '<div class="ext-item-wrap">';
					echo '<a href="'.$url[$n].'" target="'.$target[$n].'"><img src="'.$img[$n].'" alt="'.$alt[$n].'" /></a>';
					if ($html[$n] != '') {
						echo '<div class="ext-item-html">'.$html[$n].'</div>';
					}
					echo '</div>';
					
				
				} else {
						echo '<div class="ext-item-wrap">';
						echo '<img src="'.$img[$n].'" alt="'.$alt[$n].'" />';
						if ($html[$n] != '') {
							echo '<div class="ext-item-html">'.$html[$n].'</div>';
						}
						echo '</div>';
					}

			}
		}	
		?>
	</div>	
	
	<div style="clear:both;"></div>
</div>

