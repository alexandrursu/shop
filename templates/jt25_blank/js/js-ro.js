$jQ = jQuery.noConflict();
    $jQ(document).ready(function() {
        	//$jQ('.addtocart-button').click(function(e){
		//    alert("Ne cerem scuze. \nPentru moment compania Maicom nu primeste comezi on-line.");
		//    e.stopPropagation();
  		//	return false;
		//});
        	  // blog link from frontpage aidanews hover
    $jQ('#top .aidanews2_mainC a').attr("href","http://maicom.md/blog");
   // blog link from frontpage aidanews hover  
   $jQ( ".only-home .vmgroup.home-featured li" ).append( '<span class="readon">TOP VÂNZĂRI</span>' );
});