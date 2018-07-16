<?php 
	class OrdersController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Add order
		public function add()
		{
			if ($this->request->is('post')) {
				$this->Order->create();
				if ($this->Order->save($this->request->data)) {
					$this->Session->setFlash(__d('croogo','Creating order successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'months' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// View order detail
		public function view($month_id = null)
		{
			$month_id = $_GET['month_id'];
			$orders = $this->Order->find('all', array(
				'conditions' => array(
					'Order.month_id' => $month_id
				)
			));
			$this->set(compact('orders'));
		}
	}