<?php 
	class FundsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Nạp tiền
		public function add()
		{
			if ($this->request->is('post')) {
				$this->Fund->create();
				if ($this->Fund->save($this->request->data)) {
					//$this->Session->setFlash(__d('croogo','Creating Fund successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'funds' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// Change status
		public function edit($id = null)
		{
			if (!empty($this->data)) {
				if ($this->Fund->save($this->data)) {
					$this->redirect(array('controller'=>'months','action' => 'index'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Fund->read(null, $id);
			}
		}
	}