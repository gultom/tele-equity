<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?= $this->Html->charset(); ?>
    
	<title><?= $title_for_layout ?></title>
	<?= $this->Html->meta('icon'); ?>
    
    <?= 
        $this->Html->css(array(
            'default/style',
            'lib/jquery-ui/south-street/jquery-ui-1.8.18.custom'
        )); 
    ?>
    
    <?= 
        $this->Html->script(array(
            'lib/jquery/jquery-1.8.2.min',
            'lib/jquery-ui/jquery-ui-1.9.1.custom.min',
            'lib/prototype/prototype',
            'app/Functions',
            'app/Users'
        ));
    
        $this->Html->scriptBlock('
        var Functions = new Functions();
        var Users = new Users();
        
        jQuery(document).ready(function($) {
            Functions.initConfirmationDialog("logoutDialog", "Confirmation", 340, 160, function() {Users.logout()});
        })
        
        ', array('inline' => FALSE));
        
        $scripts_for_layout;
    ?>
    
    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
    <?= $this->fetch('script'); ?>

</head>
<body>
	<div id="container">
		<div id="header">
            <?= $this->Html->tag('div', 'Are sure want to logout this session ?', array('id' => 'logoutDialog')); ?>
            
            <?= $this->Html->tag('div', $this->Html->link($this->Html->image('icons/icon-logout.png', array('border' => 0)), 'javascript:void(0)', array('title' => 'Logout Session', 'onclick' => 'Users.initLogoutDialog()', 'escape' => false))); ?>
            
            <?= $this->Html->image('header-main.gif', array('alt' => 'Equity Life Indonesia', 'border' => 0)); ?>
		</div>
		<div id="content">
            
			<?= $this->Session->flash(); ?>
            
			<?= $this->fetch('content'); ?>
		</div>
		<div id="footer">
            &copy; 2012 - Jaring Synergi Mandiri
		</div>
	</div>
</body>
</html>
