<?php
/**
 * QNS: Quiznight Scoring System
 * Copyright (c) Richard Franks (https://github.com/rf152/qns)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Richard Franks
 * @link          https://github.com/rf152/qns
 * @package       qns.View.Layouts
 * @since         QNS 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		QNS: <?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('generic');
		echo $this->Html->css('jquery-ui');
		echo $this->Html->css('jquery-ui.structure');
		echo $this->Html->css('jquery-ui.theme');
		
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('jquery-ui-1.11.2.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		if (
			$this->Session->read('qns.display') &&
			isset($authuser['id'])
		) {
		?>
		<script type="text/javascript" language="javascript">
			function checkUpdate() {
				$.get( "/games/getTick", processTick );
				setTimeout(checkUpdate, 3000);
			}
			function processTick(data) {
				if (data > tick) {
					$.get( "/scoresheet/index/ajax:1", updateSheet );
					tick = data;
				}
			}
			function updateSheet(data) {
				$("#content").html(data);
			}
			var tick = 0;
			$(document).ready(checkUpdate());
		</script>
		<?php
		}
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php
			if (
				!$this->Session->read('qns.display') &&
				isset($authuser['id'])
			):
			?>
			<ul id="topmenu">
				<li>
					<?php
					echo $this->Html->link(
						'Scoresheet',
						array(
							'controller' => 'scoresheet',
							'action' => 'index',
						)
					);
					?>
				</li>
				<li>
					<?php
					echo $this->Html->link(
						'Team Names',
						array(
							'controller' => 'teams',
							'action' => 'edit',
						)
					);
					?>
				</li>
				<li>
					<?php
					echo $this->Html->link(
						'Scores',
						array(
							'controller' => 'scores',
							'action' => 'edit',
						)
					);
					?>
				</li>
				<li>
					<?php
					echo $this->Html->link(
						'Load Game',
						array(
							'controller' => 'games',
							'action' => 'load',
						)
					);
					?>
				</li>
				<li>
					<?php
					echo $this->Html->link(
						'Increase Tick',
						array(
							'controller' => 'games',
							'action' => 'increaseTick',
						)
					);
					?>
				</li>
				<li class="right">
					<?php
					echo $this->Html->link(
						'Logout',
						array(
							'controller' => 'users',
							'action' => 'logout',
						)
					);
					?>
				</li>
				<li class="right">
					<?php
					echo $this->Html->link(
						'Profile',
						array(
							'controller' => 'users',
							'action' => 'edit',
						)
					);
					?>
				</li>
			</ul>
			<?php endif; ?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
