<?php 
	class Skill extends AppModel {
		public $hasMany = array(
			'Myskill' => array(
				'className' => 'Managers.Myskill',
				'foreignKey' => 'skill_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
	}