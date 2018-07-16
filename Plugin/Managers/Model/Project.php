<?php 
	class Project extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'Users.User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
		public $hasMany = array(
			'Task' => array(
				'className' => 'Managers.Task',
				'foreignKey' => 'project_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			)
		);
	}