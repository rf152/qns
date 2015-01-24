<?php

?>
<div class="narrow">
	<?php
	echo $this->Form->create('Game');
	echo $this->Form->input(
		'name',
		array(
			'label' => 'Game Name',
		)
	);
	echo $this->Form->input(
		'num_rounds',
		array(
			'label' => 'Number of Rounds',
			'type' => 'number',
		)
	);
	echo $this->Form->input(
		'interval_round',
		array(
			'label' => 'Interval round',
			'type' => 'number',
		)
	);
	echo $this->Form->input(
		'num_teams',
		array(
			'label' => 'Number of teams',
			'type' => 'number',
		)
	);
	echo $this->Form->submit('Create Game')
	?>
	
</div>
