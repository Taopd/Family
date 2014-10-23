<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$appDescription = 'MOTAPP Shop Management';
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $appDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('font-awesome.min');

        echo $this->Html->script('jquery.min.js');
        echo $this->Html->script('ie10-viewport-bug-workaround.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <style type="text/css">
        body {
            padding-top: 70px;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <?php echo $this->element('navbar');?>
        </div>
    </div>
    <div class="container">
        <?php
        if ($this->Session->check('Message.flash')) {
        ?>
        <div class="alert alert-info" role="alert"><?php echo $this->Session->flash(); ?></div>
        <?php
        }
        ?>

        <?php echo $this->fetch('content'); ?>

        <hr>
        <?php echo $this->element('footer');?>
    </div>
    <?=$this->Html->script('bootstrap.min.js')?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>