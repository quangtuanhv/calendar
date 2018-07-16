<?php 
	echo $this->Form->create('Task', $options = array(
		'url' => array(
			'controller' => 'tasks',
			'action' => 'change_status',
			$task['Task']['id']
		),
		'class' => 'edit_form'
	));
	echo $this->Form->input('id', $options = array(
		'value' => $task['Task']['id']
	));
	$status = array(0 => __d('croogo', 'Doing'), 1 => __d('croogo', 'Done'), 2 => __d('croogo', 'Error'));
	if($task['Task']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role_id') == 1){
		$disable = '';
	}else{
		$disable = 'true';
	}
	if($task['Task']['status'] == 0){
		$class = 'btn btn-warning';
	}elseif ($task['Task']['status'] == 1) {
		$class = 'btn btn-success';
	}else{
		$class = 'btn-danger';
	}
	if(count($task['Error']) > 0){
		$value = 2;
		$class = 'btn-danger';
	}else{
		$value = $task['Task']['status'];
	}
	echo $this->Form->input('status', $options = array(
		'label' => false,
		'class' => 'form-control btn '.$class.' btn-sm input-sm confirm',
		'value' => $value,
		'options' => $status,
		'disabled' => $disable,
		'taskid' => $task['Task']['id']
	));
	echo $this->Form->end($options = null);
?>