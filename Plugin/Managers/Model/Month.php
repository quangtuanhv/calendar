<?php 
	class Month extends AppModel {
		public $hasMany = array(
			'Fund' => array(
				'className' => 'Managers.Fund',
				'foreignKey' => 'month_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
			'Order' => array(
				'className' => 'Managers.Order',
				'foreignKey' => 'month_id',
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