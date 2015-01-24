<?php
$k = 0;

echo $this->Form->create(
	'Score',
	array(
		'inputDefaults' => array(
			'label' => false,
			'div' => false,
		),
	)
);
?>
<div id="tabs">
	<ul>
		<?php foreach ($rounds as $i => $round): ?>
		<li>
			<a href="#tabs-<?php echo $i; ?>">
				<?php echo $round['Round']['round_name']; ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php foreach($rounds as $i => $round): ?>
	<div id="tabs-<?php echo $i; ?>">
		<table cellpadding="0" cellspacing="0" class="narrowtable">
			<thead>
				<tr>
					<th colspan="2">
						Round <?php echo $round['Round']['round_name']; ?>
					</th>
					<th>
						J
					</th>
					<th>
						C
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($round['Round_Score'] as $score): ?>
				<tr>
					<td>
						<label for="<?php echo 'Score.' . $k . '.value'?>">
							<?php echo $score['Score_Team']['name']; ?>
						</label>
						<?php
						if (isset($score['id'])) {
							echo $this->Form->input(
								'Score.' . $k . '.id',
								array(
									'default' => $score['id'],
								)
							);
						}
						echo $this->Form->input(
							'Score.' . $k . '.team_id',
							array(
								'default' => $score['team_id'],
								'type' => 'hidden',
							)
						);
						echo $this->Form->input(
							'Score.' . $k . '.round_id',
							array(
								'default' => $score['round_id'],
								'type' => 'hidden',
							)
						);
						?>
					</td>
					<td>
						<?php
						echo $this->Form->input(
							'Score.' . $k . '.value',
							array(
								'default' => $score['value'],
							)
						);
						?>
					</td>
					<td>
						<?php
						echo $this->Form->input(
							'Score.' . $k . '.joker',
							array(
								'default' => $score['joker'],
							)
						);
						?>
					</td>
					<td>
						<?php
						echo $this->Form->input(
							'Score.' . $k . '.chicken',
							array(
								'default' => $score['chicken'],
							)
						);
						?>
					</td>
				</tr>
				<?php $k++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
</div>
<?php
echo $this->Form->submit('Save');
?>
<script>
	$(function() {
		$( "#tabs" ).tabs({active:<?php echo $roundid; ?>});
	});
</script>
