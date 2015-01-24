<?php
$numrounds = count($game['Game_Round']);
$leaders = $game['Game_Team'][0]['name'];
$highscore = $game['Game_Team'][0]['total'];
?>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>
				Team
			</th>
			<?php foreach ($game['Game_Round'] as $round): ?>
			<th>
				<?php echo $round['round_name']; ?>
			</th>
			<?php endforeach; ?>
			<th>
				Total
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($game['Game_Team'] as $team): ?>
		<tr>
			<td>
				<strong>
					<?php echo $team['name']; ?>
				</strong>
			</td>
			<?php
			for ($i=0; $i<$numrounds; $i++):
			if (isset($team['Team_Score'][$i])) {
				$score = $team['Team_Score'][$i];
			} else {
				$score = array(
					'value' => '-',
					'joker' => 0,
					'chicken' => 0,
				);
			}
			$class = '';
			$class = $score['joker'] ? 'score-joker' : $class;
			$class = $score['chicken'] ? 'score-chicken' : $class;
			?>
			<td class="<?php echo $class; ?>">
				<?php echo $score['value']; ?>
			</td>
			<?php endfor; ?>
			<td>
				<?php echo $team['total']; ?>
			</td>
		</tr>
		<?php endforeach; ?>
</table>
