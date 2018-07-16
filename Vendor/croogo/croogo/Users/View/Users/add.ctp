<div class="users form">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php 
		echo $this->Form->create('User', array(
			'inputDefaults' => array(
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group'
				)
			)
		));
	?>
		<fieldset>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password', array('value' => ''));
			echo $this->Form->input('verify_password', array('type' => 'password', 'value' => ''));
			echo $this->Form->input('name');
			echo $this->Form->input('email');
			echo $this->Form->hidden('website');
		?>
		</fieldset>
	<?php 
		echo $this->Form->end(array(
			'class' => 'btn btn-info btn-sm',
			'label' => __d('croogo', 'Save')
		));
	?>
</div>