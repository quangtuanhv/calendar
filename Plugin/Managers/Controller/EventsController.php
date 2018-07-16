<?php 
	class EventsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Index page
		public function index()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'Event list');
			$calendar_events = $this->Event->find('all', array(
				'contain' => array(
					'User' => array(
						'fields' => array(
							'User.name',
							'User.role_id',
							'User.id',
							'User.status'
						),
						'Role' => array(
							'fields' => array(
								'Role.color',
								'Role.icon'
							)
						)
					)
				),
				'conditions' => array(
					'User.status' => 1
				)
			));
			$json = array();
			foreach ($calendar_events as $key => $event) {
				if($event['Event']['status'] == 0){
					$status = '<i class="glyphicon glyphicon-refresh"></i> '.__d('croogo', 'Waiting confirm');
					$class = 'btn btn-warning btn-sm';
					$confirm = 'fa fa-spinner';
				}elseif ($event['Event']['status'] == 1) {
					$status = '<i class="glyphicon glyphicon-check"></i> '.__d('croogo', 'Confirmed');
					$class = 'btn btn-success btn-sm';
					$confirm = 'fa fa-check-square-o';
				}else{
					$status = '<i class="glyphicon glyphicon-lock"></i> '.__d('croogo', 'Deny');
					$class = 'btn btn-danger btn-sm';
					$confirm = 'fa fa-unlock';
				}
				// Set color
				if ($event['Event']['type'] == 1) {
					$color = '#d43f3a';
				}elseif ($event['Event']['type'] == 2) {
					$color = '#eea236';
				}elseif ($event['Event']['type'] == 3) {
					$color = '#0ba5ed';
				}else{
					$color = '#4cae4c';
				}
				$json[] = array(
					'title' => $event['Event']['title'],
					'start' => $event['Event']['start'],
					'end' => $event['Event']['end'],
					'bd' => $event['Event']['start'],
					'stop' => $event['Event']['end'],
					'user' => $event['User']['name'],
					'body' => $event['Event']['body'],
					'url' => Router::url(array('plugin' => 'managers', 'controller' => 'events', 'action' => 'view', 'id' => $event['Event']['id'], 'slug' => Inflector::slug($event['Event']['title'], $replacement = '-'))),
					'color' => $color,
					'status' => $status,
					'class' => $class,
					'icon' => $event['User']['Role']['icon'],
					'bgcolor' => $event['User']['Role']['color'],
					'role' => $event['User']['role_id'],
					'userid' => $event['User']['id'],
					'type' => $event['Event']['type'],
					'confirm' => $confirm,
					'tinhtrang' => $event['Event']['status']
				);
			}
			$this->set('json', json_encode($json));
			//pr($json); die();
			$waitings = $this->Event->find('all', array(
				'conditions' => array('Event.status' => 0),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.type',
					'Event.status',
					'Event.created',
					'Event.start',
					'Event.body',
					'User.name'
				),
				'order' => array(
					'Event.created' => 'DESC'
				),
				'limit' => 5
			));
			$this->Event->User->recursive = -1;
			$month = date('m');
			$birthdays = $this->Event->User->find('all', array(
				'fields' => array(
					'User.name',
					'User.birthday'
				),
				'order' => array(
					'User.birthday' => 'ASC'
				)
			));
			$json_birthdays = array();
			foreach ($birthdays as $key => $bir) {
				if(date('m', strtotime($bir['User']['birthday'])) == $month){
					$json_birthdays[] = array(
						'user' => $bir['User']['name'],
						'birthday' => $bir['User']['birthday']
					);
				}
			}
			//$this->Event->recursive = 0;
			$events = $this->Event->find('all', array(
				'limit' => 10,
				'order' => array('Event.created' => 'DESC'),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.body',
					'Event.created',
					'Event.type',
					'Event.status',
					'Event.start',
					'Event.end',
					'User.name',
					'User.status'
				),
				'conditions' => array(
					'User.status' => 1
				)
			));
			$denies = $this->Event->find('all', array(
				'conditions' => array(
					'Event.status' => 2,
				),
				'order' => array(
					'Event.created' => 'DESC'
				),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.body',
					'Event.created',
					'Event.type',
					'Event.status',
					'Event.start',
					'Event.end',
					'User.name',
					'Confirmer.name'
				)
			));
			$users = $this->Event->User->find('list', array(
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.status' => 1
				)
			));
			$roles = $this->Event->User->Role->find('all', array(
				'fields' => array(
					'Role.id',
					'Role.title',
					'Role.color',
					'Role.icon'
				),
				'conditions' => array(
					'Role.id' => array(2,5,6,7)
				)
			));
			$this->set('json_birthday', json_encode($json_birthdays));
			$this->set(compact('title_for_layout', 'waitings', 'events', 'denies', 'users', 'roles', 'calendar_events'));
		}
		// Add event
		public function add()
		{
			if ($this->request->is('post')) {
				$this->Event->create();
				$this->request->data['Event']['user_id'] = $this->Session->read('Auth.User.id');
				if ($this->Event->save($this->request->data)) {
					$this->Session->setFlash(__d('croogo','Creating event successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'events' ,'action' => 'my_events'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
		}
		// My events
		public function my_events()
		{
			$title_for_layout = __d('croogo', 'My events list');
			$this->Paginator->settings = array(
				'conditions' => array(
					'Event.user_id' => $this->Session->read('Auth.User.id')
				),
				'order' => array(
					'Event.created' => 'DESC'
				)
			);
			$this->set('events', $this->Paginator->paginate('Event'));
			$this->set(compact('title_for_layout'));
		}
		// View event
		public function view($id = null, $slug = null)
		{
			$events = $this->Event->find('first', array(
				'conditions' => array('Event.id' => $id),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.body',
					'Event.type',
					'Event.status',
					'Event.end',
					'Event.start',
					'Event.confirmer',
					'Event.created',
					'Event.updated',
					'User.name',
					'Confirmer.name'
				)
			));
			//pr($events); die();
			$title_for_layout = $events['Event']['title'];
			$this->set(compact('events', 'title_for_layout'));
		}
		// Edit event
		public function edit($id = null, $slug = null)
		{
			$title_for_layout = __d('croogo', 'Edit my event');
			if (!empty($this->data)) {
				if ($this->Event->save($this->data)) {
					$this->Session->setFlash(__d('croogo','Edited event successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'events','action' => 'my_events'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Event->read(null, $id);
			}
			$this->set(compact('events', 'title_for_layout'));
		}
		// Confirm event
		public function confirm($id = null)
		{
			if (!empty($this->data)) {
				$this->request->data['Event']['confirmer'] = $this->Session->read('Auth.User.id');
				if ($this->Event->save($this->data)) {
					$this->Session->setFlash(__d('croogo','Confirm event successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'events','action' => 'waiting'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Event->read(null, $id);
			}
		}
		// Waiting event
		public function waiting()
		{
			$title_for_layout = __d('croogo', 'Waiting events list');
			$events = $this->Event->find('all', array(
				'conditions' => array(
					'Event.status' => 0
				),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.status',
					'Event.type',
					'Event.body',
					'Event.created',
					'Event.start',
					'Event.end',
					'User.name'
				),
				'order' => array(
					'Event.created' => 'DESC'
				)
			));
			//pr($events); die();
			$this->set(compact('title_for_layout', 'events'));
		}
		// Stat by month
		public function month($thang = null)
		{
			$title_for_layout = __d('croogo', 'Statistical');
			$month = $_GET['thang'];
			$user = $_GET['user_id'];
			if(!empty($user)){
				$events = $this->Event->find('all', array(
					'fields' => array(
						'Event.id',
						'Event.title',
						'Event.body',
						'Event.status',
						'Event.type',
						'Event.start',
						'Event.end',
						'User.name'
					),
					'order' => array(
						'User.name' => 'ASC'
					),
					'conditions' => array(
						'Event.user_id' => $user
					)
				));
			}else{
				$events = $this->Event->find('all', array(
					'fields' => array(
						'Event.id',
						'Event.title',
						'Event.body',
						'Event.status',
						'Event.type',
						'Event.start',
						'Event.end',
						'User.name'
					),
					'order' => array(
						'User.name' => 'ASC'
					)
				));
			}
			$json = array();
			foreach ($events as $key => $event) {
				$start = date('Y-m', strtotime($event['Event']['start']));
				$end = date('Y-m', strtotime($event['Event']['end']));
				if($start == $month || $end == $month){
					$json[] = array(
						'id' => $event['Event']['id'],
						'title' => $event['Event']['title'],
						'body' => $event['Event']['body'],
						'start' => $event['Event']['start'],
						'end' => $event['Event']['end'],
						'user' => $event['User']['name'],
						'type' => $event['Event']['type'],
						'status' => $event['Event']['status']
					);
				}
			}
			//pr($events); die();
			$this->set('json', json_encode($json));
			$this->set(compact('title_for_layout', 'month'));
		}
		// Pagination ajax
		public function paginaion($page = NULL, $group = NULL, $user_id = NULL, $type = NULL, $status = NULL)
		{
			$page = $_GET['page'];
			$group = $_GET['group'];
			$user_id = $_GET['user_id'];
			$type = $_GET['type'];
			//$status = $_GET['status'];
			$conditions = array();
			if($_GET['status'] != ''){
				$conditions[] = array(
					'Event.status' => $_GET['status']
				);
			}else{
				$conditions[] = array(
					'Event.status' => array(0,1,2)
				);
			}
			if(!empty($group)){
				$conditions[] = array(
					'User.role_id' => $group
				);
			}
			if(!empty($user_id)){
				$conditions[] = array(
					'User.id' => $user_id
				);
			}
			if(!empty($type)){
				$conditions[] = array(
					'Event.type' => $type
				);
			}
			$events = $this->Event->find('all', array(
				'page' => $page,
				'order' => array(
					'Event.created' => 'DESC'
				),
				'limit' => 10,
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.body',
					'Event.created',
					'Event.type',
					'Event.status',
					'Event.start',
					'Event.end',
					'Event.created',
					'User.name',
					'User.role_id',
					'User.status'
				),
				'conditions' => array(
					$conditions,
					'User.status' => 1
				)
			));
			$total = $this->Event->find('count', array(
				'conditions' => array(
					$conditions,
					'User.status' => 1
				)
			));
			$this->set(compact('events', 'total', 'page'));
		}
		// Filter ajax
		public function filter($group = NULL, $user_id = NULL, $type = NULL, $status = NULL)
		{
			$group = $_GET['group'];
			$user_id = $_GET['user_id'];
			$type = $_GET['type'];
			$page = $_GET['page'];
			$conditions = array();
			if($_GET['status'] != ''){
				$conditions[] = array(
					'Event.status' => $_GET['status']
				);
			}else{
				$conditions[] = array(
					'Event.status' => array(0,1,2)
				);
			}
			if(!empty($type)){
				$conditions[] = array(
					'Event.type' => $type
				);
			}
			if(!empty($user_id)){
				$conditions[] = array(
					'Event.user_id' => $user_id
				);
			}
			if(!empty($group)){
				$conditions[] = array(
					'User.role_id' => $group
				);
			}
			$events = $this->Event->find('all', array(
				'order' => array(
					'Event.created' => 'DESC'
				),
				'limit' => 10,
				'conditions' => array(
					$conditions,
					'User.status' => 1
				),
				'fields' => array(
					'Event.id',
					'Event.title',
					'Event.body',
					'Event.status',
					'Event.start',
					'Event.end',
					'Event.type',
					'Event.created',
					'User.name',
					'User.role_id',
					'User.status'
				),
				'page' => $page
			));
			$total = $this->Event->find('count', array(
				'conditions' => array(
					$conditions,
					'User.status' => 1
				)
			));
			$this->set(compact('events', 'total', 'page'));
		}
	}