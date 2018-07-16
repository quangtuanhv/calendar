<?php 
	class Error extends AppModel {
		public $belongsTo = array(
			'Task' => array(
				'className' => 'Managers.Task',
				'foreignKey' => 'task_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
	}