<?php
?>

<div class="narrow">
	<center>
		<h2>QNS: Quiz Night Scoring</h2>
		<h3>Please Log In</h3>
	</center>
	<?php
	echo $this->Form->create('User');

	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->input(
		'display',
		array(
			'type' => 'checkbox',
			'label' => 'Display Mode',
		)
	);
	echo $this->Form->submit();
	?>
</div>
