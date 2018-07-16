<?php 
	class NotesController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Add note
		public function add($taskid = NULL)
		{
			$taskid = $_GET['taskid'];
			//echo $taskid; die();
			if ($this->request->is('post')) {
				$this->Note->create();
				$this->request->data['Note']['user_id'] = $this->Session->read('Auth.User.id');
				$this->request->data['Note']['task_id'] = $taskid;
				if ($this->Note->save($this->request->data)) {
					//$this->Session->setFlash(__d('croogo','Creating Note successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'notes' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// View notes
		public function tasks($taskid = NULL)
		{
			$taskid = $_GET['taskid'];
			$notes = $this->Note->find('all', array(
				'conditions' => array(
					'Note.task_id' => $taskid
				),
				'order' => array(
					'Note.created' => 'DESC'
				)
			));
			$this->set(compact(notes));
		}
	}