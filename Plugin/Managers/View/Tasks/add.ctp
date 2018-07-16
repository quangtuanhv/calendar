<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $title_for_layout; ?></b></h3>
	</div>
	<div class="panel-body">
		<?php 
			echo $this->Form->create('Task', $options = array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'label' => false,
					'div' => array('class' => 'form-group')
				)
			));
			echo $this->Form->input('project_id', $options = array(
				'empty' => __d('croogo', 'Select project'),
				'required' => true
			));
			if($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 7 || $this->Session->read('Auth.User.role_id') == 8){
				$disable = '';
				$class = '';
			}else{
				$disable = 'true';
				$class = 'hidden';
			}
			echo $this->Form->input('user_id', $options = array(
				'empty' => __d('croogo', 'Select user'),
				'required' => true,
				'value' => $this->Session->read('Auth.User.id'),
				//'disabled' => $disable
				'class' => 'form-control '.$class
			));
			echo $this->Form->input('title', $options = array(
				'placeholder' => __d('croogo', 'Task name'),
				'required' => true
			));
			echo $this->Form->input('body', $options = array(
				'placeholder' => __d('croogo', 'Task detail'),
				'required' => true
			));
			echo $this->Form->input('url', $options = array(
				'placeholder' => __d('croogo', 'Page url'),
			));
			echo $this->Form->input('start', $options = array(
				'label' => __d('croogo', 'Start time'),
				'required' => true,
				'type' => 'text',
				'class' => 'form-control datetime',
				'value' => date('Y-m-d 08:00')
			));
			echo $this->Form->input('end', $options = array(
				'label' => __d('croogo', 'End time'),
				'required' => true,
				'type' => 'text',
				'class' => 'form-control datetime',
				'value' => date('Y-m-d 17:30')
			));
			echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Save'), $options = array(
				'class' => 'btn btn-info btn-sm'
			));
			echo $this->Form->end($options = null);
		?>
	</div>
</div>