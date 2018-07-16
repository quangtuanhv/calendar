<?php 
	class MonthsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Quản lý thu chi
		public function index()
		{
			$this->layout = 'calendar';
			$this->Month->Fund->User->recursive = -1;
			$title_for_layout = __d('croogo', 'Quản lý thu chi');
			$months = $this->Month->find('all', array(
				'order' => array(
					'Month.title' => 'DESC'
				),
				'contain' => array(
					'Fund',
					'Order' => array(
						'fields' => array(
							//'count(Order.id) as count'
							'Order.total',
							'Order.month_id'
						)
					)
				)
			));
			$users = $this->Month->Fund->User->find('all', array(
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'User.email',
					'User.phone',
					'User.birthday',
				),
				'conditions' => array(
					'AND' => array(
						'User.role_id !=' => array(4,7,8),
					)
				),
				'order' => array(
					'User.name' => 'ASC'
				)
			));
			//pr($users); die();
			//pr($months); die();
			$this->set(compact('title_for_layout', 'months', 'users'));
		}
		// Add month
		public function add()
		{
			if ($this->request->is('post')) {
				$this->Month->create();
				if ($this->Month->save($this->request->data)) {
					$this->Session->setFlash(__d('croogo','Creating month successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'months' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
	}