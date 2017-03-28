$jQ = jQuery.noConflict();
    $jQ(document).ready(function() {
        	//$jQ('.addtocart-button').click(function(e){
		//    alert("На данный момент компания не принимает заказы в режиме онлайн");
		//    e.stopPropagation();
  		//	return false;
		//});
        	  // blog link from frontpage aidanews hover
    $jQ('#top .aidanews2_mainC a').attr("href","http://maicom.md/ru/novosti");
   // blog link from frontpage aidanews hover  
      $jQ( ".only-home .vmgroup.home-featured li" ).append( '<span class="readon">ТОП ПРОДАЖ</span>' );

});