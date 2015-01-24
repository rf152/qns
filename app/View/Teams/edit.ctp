<?php

echo $this->Form->create(
	'Team',
	array(
		'inputDefaults' => array(
			'label' => false,
			'div' => false,
		),
	)
);

?>
<table cellpadding="0" cellspacing="0" class="narrowtable">
	<thead>
		<tr>
			<th>Current</th>
			<th>New</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($teams as $i=>$team):
		?>
		<tr>
			<td>
				<label for="<?php echo 'Team.' . $i . '.name'?> ">
					<?php echo $team['Team']['name']; ?>
				</label>
				<?php
				echo $this->Form->input(
					'Team.' . $i . '.id',
					array(
						'default' => $team['Team']['id'],
					)
				);
				?>
			</td>
			<td>
				<?php
				echo $this->Form->input(
					'Team.' . $i . '.name',
					array(
						'placeholder' => $team['Team']['name'],
						'type' => 'text',
					)
				);
				?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" class="actions">
				<?php echo $this->Form->submit('Save'); ?>
			</td>
		</tr>
	</tbody>
</table>
