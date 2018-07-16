<?php 
	class Note extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'Users.User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
			'Task' => array(
				'className' => 'Managers.Task',
				'foreignKey' => 'task_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
	}