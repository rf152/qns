<?php

?>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Game Name</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($games as $game): ?>
		<tr>
			<td><?php echo $game['Game']['name']; ?></td>
			<td>
				<?php
				echo $this->Form->create('Game');
				echo $this->Form->input(
					'id',
					array(
						'default' => $game['Game']['id'],
					)
				);
				echo $this->Form->submit(
					'Load',
					array(
						'div' => false,
					)
				);
				echo $this->Form->end();
				?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2">
				<?php
				echo $this->Form->create(
					'Game',
					array(
						'type' => 'get',
						'action' => 'create',
					)
				);
				echo $this->Form->submit("New Game");
				echo $this->Form->end();
				?>
			</td>
		</tr>
	</tbody>
</table>
