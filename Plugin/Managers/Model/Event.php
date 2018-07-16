<?php 
	class Event extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'Users.User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
			'Confirmer' => array(
				'className' => 'Users.User',
				'foreignKey' => 'confirmer',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
	}