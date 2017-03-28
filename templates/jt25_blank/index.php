<?php /**  * @copyright	Copyright (C) 2011 TemplatesJoomla.org - All Rights Reserved. **/
defined( '_JEXEC' ) or die( 'Restricted access' ); define( 'YOURBASEPATH', dirname(__FILE__) );?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">

<!--<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script> -->
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/css/concat/template.concat.css" type="text/css" />

<?php
$lang =& JFactory::getLanguage();
if($lang->getTag() == 'ru-RU'): ?>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/js-ru.js"></script>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles-ru.css" type="text/css" />
<?php elseif($lang->getTag() == 'ro-RO'): ?>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/js-en.js"></script>
<?php else: ?>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/js-ro.js"></script>
<?php endif; ?>

<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/common.css" type="text/css" />-->
<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/font-awesome.min.css" type="text/css" />-->
<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/reset.css" type="text/css" />-->
<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fonts/fonts.css" type="text/css" />-->
<!--<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/map.js"></script>-->

<?php
   $menu = &JSite::getMenu();
   $active = $menu->getActive();
   $pageclass = "";
   if (is_object( $active )) :
   $params = new JParameter( $active->params );
   $pageclass = $params->get( 'pageclass_sfx' );
endif; ?>
</head>

<body id="top" class="<?php echo $pageclass ? $pageclass : 'default'; ?>">
	<header id="header">
	    <div class="container">
	        <div class="row row-no-padding">
	            <!-- Desktop -->
	            <div class="col-md-3 hidden-xs hidden-sm">
	                <a class="logo" href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" /></a>
	            </div>
	            <div class="col-md-5 hidden-xs hidden-sm">
                </div>
                <div class="col-md-4 hidden-xs hidden-sm">
                	<div class="row row-no-padding">
                	    <div class="col-md-12 hidden-xs hidden-sm">
                            <ul class="menu-header">
                                 <li>Bine ai venit!</li>
                                 <li>
                                     <?php $lang =& JFactory::getLanguage();
                                     if($lang->getTag() == 'ru-RU'): ?>
                                        <a href="./ru/kontakt-maicom">Контакты </a>
                                     <?php elseif($lang->getTag() == 'ro-RO'): ?>
                                        <a href="./ro/our-contacts">Contacts </a>
                                     <?php else: ?>
                                        <a href="./rom/contacte">Contact </a>
                                     <?php endif; ?>
                                 </li>
                                 <li class="cosul-desktop">
                                     <?php $lang =& JFactory::getLanguage();
                                     if($lang->getTag() == 'ru-RU'): ?>
                                         <div class="fl">Корзина </div>
                                     <?php elseif($lang->getTag() == 'ro-RO'): ?>
                                         <div class="fl">Cart </div>
                                     <?php else: ?>
                                         <div class="fl">Coș </div>
                                     <?php endif; ?>
                                     <span class="shopping-bag-icon fl"></span>
                                     <jdoc:include type="modules" name="cosul" style="none" />
                                 </li>
                            </ul>
                        </div>
                        <div class="col-md-12 hidden-xs hidden-sm">
                            <ul class="menu-wishlist">
                                <!--- If user is logged in --->
                                <?php $user = JFactory::getUser();
                                 if ($user->get('guest')): ?>
                                    <li>
                                         <?php $lang =& JFactory::getLanguage();
                                         if($lang->getTag() == 'ru-RU'): ?>
                                             <a href="/ru/login">Вход</a>
                                         <?php elseif($lang->getTag() == 'ro-RO'): ?>
                                             <a href="/ro/login">Login</a>
                                         <?php else: ?>
                                             <a href="/rom/login">Logare</a>
                                         <?php endif; ?>
                                         <span class="shopping-bag-icon fl"></span>
                                         <jdoc:include type="modules" name="login" style="none" />
                                    </li>
                                <?php else: ?>
                                    <li><jdoc:include type="modules" name="login" style="none" /></li>
                                <?php endif; ?>
                                <!--- If user is logged in --->

                                 <li>Wishlist <jdoc:include type="modules" name="contacte-top" style="none" /><i class="fa fa-heart-o" aria-hidden="true"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
	            <!-- Desktop -->
            </div>
		</div>
	</header>
	<div class="clear"></div>
	<nav>
    	<div class="container">
    	    <div class="row row-no-padding">
    	       <!-- Desktop -->
               <div class="col-md-12 hidden-xs hidden-sm">
                   <?php if ($this->countModules('menu')) : ?>
                       <div id="menu">
                           <jdoc:include type="modules" name="menu" style="none" />
                       </div>
                   <?php endif; ?>
                   <div class="right-absolute">
                       <div class="styled-select">
                           <jdoc:include type="modules" name="register" style="none" />
                       </div>
                   </div>
               </div>
    	     <!-- Desktop -->

    	     <!-- Mobile -->
                <div class="col-xs-12 hidden-md hidden-lg">
                    <div class="mobile-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <jdoc:include type="modules" name="menu" style="xhtml"/>
                        <a class="logo-mobile" href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" /></a>
                        <!--- If user is logged in --->
                        <?php $user = JFactory::getUser();
                              if ($user->get('guest')): ?>
                                <?php $lang =& JFactory::getLanguage();
                                    if($lang->getTag() == 'ru-RU'): ?>
                                         <a class="login-mobile" href="/ru/login"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                                    <?php elseif($lang->getTag() == 'ro-RO'): ?>
                                          <a class="login-mobile" href="/ro/login"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                                    <?php else: ?>
                                         <a class="login-mobile" href="/rom/login"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                                <?php endif; ?>
                        <?php else: ?>
                                <jdoc:include type="modules" name="login" style="none" />
                        <?php endif; ?>
                        <!--- If user is logged in --->


                        <span class="shopping-bag-icon fr"></span>
                        <jdoc:include type="modules" name="cosul" style="none" />
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <jdoc:include type="modules" name="register" style="none" />
                    </div>
                </div>
    	     <!-- Mobile -->
           </div>
    	</div>
	</nav>
<div id="container-main">
<div id="body">
    <div class="container">
        <div class="row row-no-padding">
             <div class="col-md-12 col-xs-12">
                <?php if ($this->countModules('slider')) : ?>
                <div class="main-slider">
                    <jdoc:include type="modules" name="slider" style="xhtml" />
                </div>
                <?php endif; ?>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <jdoc:include type="modules" name="basic" style="xhtml" />
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <jdoc:include type="modules" name="active" style="xhtml" />
             </div>
        </div>
    </div>

	<div id="breadcrumbs" <?php if ($this->countModules( 'acymailing' )){ echo 'class="no-breadcrumbs"'; }  ?>><jdoc:include type="modules" name="breadcrumbs" style="xhtml" /></div>
	<div id="content" <?php if ($this->countModules( 'magazin' )){ echo 'class="smaller-container"'; }  ?>>   
		<div class="fl-mega"><jdoc:include type="modules" name="sidebar" style="xhtml" /></div>
		
		<div id="component" <?php if ($this->countModules( 'sidebar' )){ echo 'class="smaller-container"'; }  ?>>
			<?php if ($this->countModules('sidebar')) : ?><jdoc:include type="modules" name="category" style="xhtml" /><?php endif; ?>
            <?php if ($this->countModules('stock')) : ?><jdoc:include type="modules" name="stock" style="xhtml" /><?php endif; ?>
            <?php if ($this->countModules('content-maps')) : ?><jdoc:include type="modules" name="content-maps" style="xhtml" /><?php endif; ?>
            <?php if ($this->countModules('right-sidebar')) : ?><div class="right-sidebars"><jdoc:include type="modules" name="right-sidebar" style="xhtml" /></div><?php endif; ?>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			
		</div>
		<div id="recent-vizitate"><jdoc:include type="modules" name="recent-vizitate" style="xhtml" /></div>
		<?php if ($this->countModules('right')) : ?>
			<div id="rightbar">
				<jdoc:include type="modules" name="right" style="xhtml" />
			</div>
		<?php endif; ?>
		<div class="clr"></div>
		<?php if ($this->countModules('slider')) : ?>
			<div class="middle">
				<div class="discount colectii-banner">
					<jdoc:include type="modules" name="collection" style="xhtml" />
				</div>
<!-- 				<div class="discount discount-banner">
					<jdoc:include type="modules" name="discount" style="xhtml" />
				</div> -->
				<div class="discount sale-banner">
					<jdoc:include type="modules" name="sale" style="xhtml" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
        <?php if ($this->countModules('slider')) : ?>
			<div class="middle only-home">
					<jdoc:include type="modules" name="recent-home" style="xhtml" />             
				<div class="clear"></div>
			</div>
			<div class="middle">
			    <div class="pre-footer">
				    <div class="width33 no-left-margin" >
					<jdoc:include type="modules" name="news" style="xhtml" />
					<div class="video-maicom"><jdoc:include type="modules" name="video" style="xhtml" /></div>
					</div>
					<div class="width33">
					<jdoc:include type="modules" name="contacts" style="xhtml" />
					<jdoc:include type="modules" name="acymailing" style="xhtml" />
					</div>
					<div class="width33">
					<jdoc:include type="modules" name="facebook" style="xhtml" />
					</div>
				</div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

			<ul class="socials-top">
        		<li><a href="https://www.facebook.com/Maicom.md"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        		<li><a href="https://www.instagram.com/maicom.md/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        		<li><a href="https://www.youtube.com/channel/UCxzdfxfmZYgr6HJ_Y697klg"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
        	</ul>
	</div>


	<div class="pop1" style="display:none;">
		<div class="middle"><img src="http://maicom.md/images/maicom/ghid/ghid-marimi.jpg" /><span class="hidden-marimi">X</span></div>
	</div>
	<div class="pop2" style="display:none;">
		<div class="middle"><img src="http://maicom.md/images/maicom/ghid/ghid-simboluri.jpg" /><span class="hidden-marimi">X</span></div>
	</div>
	<div class="pop3" style="display:none;">
		<div class="middle"><img src="http://maicom.md/images/maicom/ghid/ghid-marimi-ru.jpg" /><span class="hidden-marimi">X</span></div>
	</div>
	<div class="pop4" style="display:none;">
		<div class="middle"><img src="http://maicom.md/images/maicom/ghid/ghid-simboluri-ru.jpg" /><span class="hidden-marimi">X</span></div>
	</div>
	<div class="webdesign">
	  <div class="footer-menu">
        <?php
            if($lang->getTag() == 'ru-RU'){
                $heading1 = 'ИНФОРМАЦИЯ';
                $heading2 = 'УСЛУГИ';
                $heading3 = 'KОМПАНИЯ';
                $heading4 = 'СТАНЬ ФАНОМ VIP';
            }elseif ($lang->getTag() == 'ro-RO') {
                $heading1 = 'INFORMATION';
                $heading2 = 'SERVICE';
                $heading3 = 'COMPANY';
                $heading4 = 'BECOME A FAN';
            }else{
                $heading1 = 'INFORMAŢII';
                $heading2 = 'SERVICII';
                $heading3 = 'COMPANIA';
                $heading4 = 'DEVENIŢI FAN';
            }
        ?>
	  	<div class="bottom_menu">
			<h3><?php echo $heading1; ?></h3>
	  		<jdoc:include type="modules" name="bottom1" style="xhtml" />
	  	</div>
	  	<div class="bottom_menu">
	  		<h3><?php echo $heading2; ?></h3>
	  		<jdoc:include type="modules" name="bottom2" style="xhtml" />
	  	</div>
	  	<div class="bottom_menu">
	  		<h3><?php echo $heading3; ?></h3>
	  		<jdoc:include type="modules" name="bottom3" style="xhtml" />
	  	</div>
	  	<div class="bottom_menu">
	  		<h3><?php echo $heading4; ?></h3>
	  		<jdoc:include type="modules" name="bottom4" style="xhtml" />
	  	</div>
	  </div>
	  <span class="copyright">2014 maicom.md Toate drepturile rezervate <a href="https://www.linkedin.com/in/ursu-alexandr-5b212534/" target="_blank" title="Web development">Powered by Ursu A.</a></span>
	</div>
    <div id="footer">
        <jdoc:include type="modules" name="footer"/>
    </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADcoZE_vF1wLs9ojrYdu4vz2beOiD1rR4&hl=ro"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/js/concat/logic.min.js"></script>

<!-- Codul Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-49985473-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- Codul Google Analytics -->

<!-- Codul Google pentru eticheta de remarketing -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 859265109;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.co m/pagead/conversion.js"></script>
    <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick .net/pagead/viewthroughconvers ion/859265109/?guid=ON&amp; script=0"/>
        </div>
    </noscript>
<!-- Codul Google pentru eticheta de remarketing -->

<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "6c6baa79-ab3c-4c4a-a251-848263020e6c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52fd654b2da5feb4" async="async"></script>

</body>
</html>