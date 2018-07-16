<?php 
	class Myskill extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'Users.User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);

	}