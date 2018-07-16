<?php 
	class ErrorsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Add error
		public function add($dataid = null)
		{
			$dataid = $_GET['dataid'];
			if ($this->request->is('post')) {
				$this->Error->create();
				$this->request->data['Error']['task_id'] = $dataid;
				//pr($this->request->data['Error']['task_id']); die();
				if ($this->Error->save($this->request->data)) {
					//$this->Session->setFlash(__d('croogo','Creating error successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'errors' ,'action' => 'my_errors'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// My errors
		public function my_errors()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'My errors');
			$this->Error->recursive = 2;
			$this->Paginator->settings = array(
				'conditions' => array(
					'Task.user_id' => $this->Session->read('Auth.User.id'),
					//'Error.status' => 0
				),
				'fields' => array(
					'Error.id',
					'Error.title',
					'Error.body',
					'Error.status',
					'Task.user_id',
					'Task.title',
					'Task.project_id',
				),
				'contain' => array(
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.title',
								'Project.id'
							)
						)
					)
				),
				'limit' => 10
			);
			//pr($errors);
			$this->set('errors', $this->Paginator->paginate());
			$this->set(compact('title_for_layout', 'errors'));
		}
		// Errors index
		public function index()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'Errors list');
			$this->Paginator->settings = array(
				'fields' => array(
					'Error.id',
					'Error.title',
					'Error.body',
					'Error.status',
					'Task.user_id',
					'Task.title',
					'Task.project_id',
				),
				'contain' => array(
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.title',
								'Project.id'
							)
						),
						'User' => array(
							'fields' => array(
								'User.name'
							)
						)
					)
				),
				'order' => array(
					'Project.title' => 'ASC'
				),
				'limit' => 10
			);
			$this->set('errors', $this->Paginator->paginate());
			$this->set(compact('title_for_layout'));
		}
		// Change status
		public function change_status($id = null)
		{
			if (!empty($this->data)) {
				if ($this->Error->save($this->data)) {
					//$this->Session->setFlash(__d('croogo','Đã cập nhật sự kiện thành công!', true), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'errors','action' => 'my_errors'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Error->read(null, $id);
			}
		}
		// View errors of task
		public function tasks($taskid = NULL)
		{
			$this->layout = false;
			$taskid = $_GET['taskid'];
			$errors = $this->Error->find('all', array(
				'conditions' => array(
					'Error.task_id' => $taskid,
					'Error.status' => 0
				),
				'order' => array(
					'Error.created' => 'DESC'
				)
			));
			$this->set(compact('errors'));
		}
		// Load errors after submit
		public function ajax($taskid = null)
		{
			$taskid = $_GET['taskid'];
			$errors = $this->Error->find('all', array(
				'conditions' => array(
					'Error.task_id' => $taskid,
				),
				'order' => array(
					'Error.status' => 'ASC'
				)
			));
			$this->set(compact('errors'));
		}
	}