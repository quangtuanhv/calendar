<?php 
	class SkillsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Index
		public function index()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'Skills of members');
			//$this->Skill->Myskill->User->recursive = -1;
			$skills = $this->Skill->find('all', array(
				'order' => array(
					'Skill.title' => 'ASC'
				)
			));
			//pr($skills); die();
			$users = $this->Skill->Myskill->User->find('all', array(
				'conditions' => array(
					'AND' => array(
						'User.role_id !=' => array(4,5,6,7,8)
					)
				),
				'order' => array(
					'User.name' => 'ASC'
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id'
				),
				'contain' => array(
					'Myskill'
				)
			));
			//pr($users); die();
			$this->set(compact('title_for_layout', 'skills', 'users'));
		}
	}