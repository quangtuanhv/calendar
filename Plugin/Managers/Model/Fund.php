<?php 
	class Fund extends AppModel {
		public $belongsTo = array(
			'Month' => array(
				'className' => 'Managers.Month',
				'foreignKey' => 'month_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
			'User' => array(
				'className' => 'Users.User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
		);
	}