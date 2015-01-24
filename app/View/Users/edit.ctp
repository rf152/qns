<?php
echo $this->Form->create('User');
?>
<div class="narrow">
<?php
echo $this->Form->input(
	'id',
	array(
		'default' => $user['User']['id'],
	)
);
echo $this->Form->input(
	'name',
	array(
		'default' => $user['User']['name'],
	)
);
echo $this->Form->input(
	'email',
	array(
		'default' => $user['User']['email'],
	)
);
if ($superadmin) {
	echo $this->Form->input('password');
	$disabled = $authuser['id'] == $user['User']['id'];
	echo $this->Form->input(
		'superadmin',
		array(
			'default' => $user['User']['superadmin'],
			'disabled' => $disabled,
		)
	);
}
echo $this->Form->submit('Save');
?>
</div>
