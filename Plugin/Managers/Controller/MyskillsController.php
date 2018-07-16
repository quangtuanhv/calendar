<?php 
	class MyskillsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Add my skill
		public function add()
		{
			if ($this->request->is('post')) {
				$this->Myskill->create();
				if ($this->Myskill->save($this->request->data)) {
					//$this->Session->setFlash(__d('croogo','Creating Myskill successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'skills' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// Edit my skill
		public function edit($id = null)
		{
			if (!empty($this->data)) {
				if ($this->Myskill->save($this->data)) {
					$this->redirect(array('controller'=>'skills','action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Myskill->read(null, $id);
			}
		}
	}