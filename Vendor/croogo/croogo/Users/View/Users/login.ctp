<div class="users form">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));?>
		<fieldset>
		<?php
			echo $this->Form->input('username', array(
				'placeholder' => __d('croogo', 'Username'),
				'class' => 'form-control',
				'label' => false,
				'div' => array('class' => 'form-group')
			));
			echo $this->Form->input('password', array(
				'placeholder' => __d('croogo', 'Password'),
				'class' => 'form-control',
				'label' => false,
				'div' => array('class' => 'form-group')
			));
			if (Configure::read('Access Control.autoLoginDuration')):
				echo $this->Form->input('remember', array(
					'label' => __d('croogo', 'Remember me?'),
					'type' => 'checkbox',
					'default' => false,
					'div' => array('class' => 'form-group'),
					'checked' => 'checked'
			));
		endif;
		?>
		</fieldset>
	<?php 
		echo $this->Form->end(array(
			'class' => 'btn btn-info'
		)); 
	?>
</div>