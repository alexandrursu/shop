<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<?php if ($params->get('greeting')) : ?>
<div class="full">
    <div class="middle">
		<div class="login-greeting">
		<?php if($params->get('name') == 0) : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
		} else : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
		} endif; ?>
		</div>
	<?php endif; ?>
		<div class="logout-button">
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.logout" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
</div>
</form>
<?php else : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
<div id="dialog-links-blocks">	
<div class="hidden-pop-up">
<span class="popupClose">X</span>
<div class="left-login">
	<fieldset class="userdata">
	<div class="angro-login">Logare Angro</div>
	<p id="form-login-username">
		<!--<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>-->
		<input id="modlgn-username" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" type="text" name="username" class="inputbox"  size="18" />
	</p>
	<p id="form-login-password">
		<!--<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>-->
		<input id="modlgn-passwd" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" type="password" name="password" class="inputbox" size="18"  />
	</p>
	<!--<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?> tine-ma minte 
	<p id="form-login-remember">
		<label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
	</p>
	<?php endif; ?>-->
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
        </div>
<div class="right-login">
Compania "MAICOM" îşi propune să vă ofere, articole pentru dame, bărbaţi şi copii  de cea mai bună calitate la cele mai avantajoase preţuri.
Punând accent pe calitatea produselor şi promptitudinea cu care răspundem solicitărilor Dumneavoastră suntem siguri că veţi fi mulţumiţi de serviciile noastre.<br/><br/>

Cu certitudine vom fi un sprijin real în creşterea afacerii Dumneavoastră.<br/><br/>

Contactaţi-ne chiar azi, pentru a obţine mai multe detalii despre preţurile şi articolele companiei “MAICOM”.<br/><br/>

Pentru mai multe informaţii vă rugăm să utilizaţi următoarele date de contact:<br/><br/>

Tel.: 	+(373) 78 22 22 11<br/>
Fax: 	+(373) 22 73 11 16<br/>
E-mail: angro@maicom.md<br/><br/>

</div>
</div>
</div>
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
<?php endif; ?>
