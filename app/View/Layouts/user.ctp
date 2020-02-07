<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		MessageBoard:
		<?php echo $this->fetch('title'); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
	<?php
		echo $this->Html->meta('icon', 'img/logo.png');
		echo $this->Html->css('template.dark.min.css', array('media' => '(prefers-color-scheme: dark)'));
		echo $this->Html->css('style.css');
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/all.js');
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/v4-shims.js');
		echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('bootstrap.bundle.min.js');
		echo $this->Html->script('plugins.bundle.js');
		echo $this->Html->script('template.js');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="col-lg-3 col-sm-12 m-auto">
		<?php echo $this->Flash->render(); ?>
	</div>
    <div class="layout">
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center no-gutters min-vh-100">

        <!-- Render View and Flash Messages -->
                
			<?php echo $this->fetch('content'); ?>
                
        <!-- Render View and Flash Messages -->

        </div> <!-- / .row -->
    </div>

    </div><!-- .layout -->

		<!-- <div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div> -->
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
