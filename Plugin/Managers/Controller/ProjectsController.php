<?php 
	class ProjectsController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		// Trang chủ dự án
		public function index()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'Project managerment');
			$json = array();
			$projects = $this->Project->find('all', array(
				'fields' => array(
					'Project.id',
					'Project.title',
					'Project.body',
					'Project.start',
					'Project.end',
					'Project.created',
					'User.name',
					'User.role_id'
				),
				'order' => array(
					'Project.created' => 'DESC'
				),
				'contain' => array(
					'Task' => array(
						'fields' => array(
							'Task.project_id'
						)
					),
					'User' => array(
						'Role' => array(
							'fields' => array(
								'Role.color'
							)
						)
					)
				)
			));
			//pr($projects); die();
			foreach ($projects as $key => $project) {
				$json[] = array(
					'title' => $project['Project']['title'],
					'start' => $project['Project']['start'],
					'end' => $project['Project']['end'].' 17:30:00',
					'bd' => $project['Project']['start'],
					'stop' => $project['Project']['end'],
					'user' => $project['User']['name'],
					'body' => $project['Project']['body'],
					'url' => Router::url(array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'view', 'id' => $project['Project']['id'], 'slug' => Inflector::slug($project['Project']['title'], $replacement = '-'))),
					'color' => $project['User']['Role']['color'],
					'group' => $project['User']['role_id'],
					'user_id' => $project['User']['id']
				);
			}
			$this->set('json', json_encode($json));
			$users = $this->Project->User->find('list', array(
				'conditions' => array(
					'User.role_id' => array(1,2,5,6,7),
					'User.status' => 1
				),
				'order' => array(
					'User.role_id' => 'ASC'
				)
			));
			$roles = $this->Project->User->Role->find('all', array(
				'fields' => array(
					'Role.id',
					'Role.title',
					'Role.color'
				),
				'conditions' => array(
					'Role.id' => array(2,5,6,7)
				)
			));
			//pr($roles); die();
			$this->set(compact('title_for_layout', 'projects', 'users', 'roles'));
		}
		// Thêm dự án
		public function add()
		{
			$title_for_layout = __d('croogo', 'Add project');
			if ($this->request->is('post')) {
				$this->Project->create();
				if ($this->Project->save($this->request->data)) {
					$this->Session->setFlash(__d('croogo','Creating project successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'projects' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
			$users = $this->Project->User->find('list', array(
				'order' => array('User.name' => 'ASC'),
				'fields' => array(
					'User.id',
					'User.name',
				),
				'conditions' => array(
					'User.role_id !=' => array(4, 7, 8)
				)
			));
			$this->set(compact('title_for_layout', 'users'));
		}
		// Xem dự án
		public function view($id = null, $slug = null)
		{
			$this->layout = 'calendar';
			$projects = $this->Project->find('first', array(
				'conditions' => array(
					'Project.id' => $id
				),
				'fields' => array(
					'Project.id',
					'Project.title',
					'Project.start',
					'Project.end',
					'Project.body',
					'Project.demo',
					'Project.domain',
					'Project.account',
					'Project.host',
					'Project.pass',
					'User.name',
				),
				'contain' => array(
					'User',
					'Task' => array(
						'order' => array(
							'Task.user_id' => 'ASC',
                                                        'Task.created' => 'DESC'
						),
						'fields' => array(
							'Task.id',
							'Task.project_id'
						)
					)
				)
			));
			//pr($projects); die();
			$this->Paginator->settings = array(
				'Task' => array(
					'conditions' => array(
						'Task.project_id' => $projects['Project']['id']
					),
					'fields' => array(
						'Task.id',
						'Task.title',
						'Task.project_id',
						'Task.start',
						'Task.end',
						'Task.status',
						'Task.url',
						'User.name',
						'Task.user_id',
						'Task.body',
						'User.color',
						'Task.priority',
                                                'Task.created'
					),
					'order' => array(
						'User.name' => 'ASC',
                                                'Task.created' => 'DESC'
					),
					'contain' => array(
						'User',
						'Error' => array(
							'fields' => array(
								'Error.task_id',
								'Error.status'
							),
							'conditions' => array(
								'Error.status' => 0
							)
						),
						'Note'
					)
				)
			);
			$this->set('tasks', $this->Paginator->paginate('Task'));
			$title_for_layout = $projects['Project']['title'];
			$this->Project->User->recursive = -1;
			$users = $this->Project->User->find('list', array(
				'fields' => array(
					'User.id',
					'User.name',
				),
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.id !=' => 13,
					'User.status' => 1
				)
			));
			//pr($users); die();
			$this->set(compact('title_for_layout', 'projects', 'users'));
		}
		// Edit project
		public function edit($id = null)
		{
			$this->Project->recursive = -1;
			$projects = $this->Project->find('first', array(
				'conditions' => array(
					'Project.id' => $id
				),
				'fields' => array(
					'Project.id',
					'Project.title'
				)
			));
			if (!empty($this->data)) {
				//pr($projects['Project']['title']); die();
				if ($this->Project->save($this->data)) {
					$this->Session->setFlash(__d('croogo','Update project info successfully!', true), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'projects','action' => 'view', 'id' => $id, 'slug' => Inflector::slug($projects['Project']['title'], $replacement = '-')));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Project->read(null, $id);
			}
		}
		// Thống kê
		public function statistical()
		{
			$title_for_layout = __d('croogo', 'Statistical');
			$this->Project->User->recursive = 1;
			$users = $this->Project->User->find('all', array(
				'fields' => array(
					'User.id',
					'User.name',
					'User.email',
					'User.role_id',
					'User.username',
					'User.phone',
					'User.birthday'
				),
				'contain' => array(
					'Task' => array(
						'fields' => array(
							'Task.user_id'
						),
						'Error' => array(
							'fields' => array(
								'Error.task_id'
							)
						)
					)
				),
				'conditions' => array(
					'User.role_id !=' => 4
				)
			));
			$projects = $this->Project->find('all', array(
				'fields' => array(
					'Project.id',
					'Project.title',
					'Project.created',
					'Project.start',
					'Project.end',
					'User.name'
				),
				'order' => array(
					'Project.created' => 'DESC'
				),
				'contain' => array(
					'User',
					'Task' => array(
						'fields' => array(
							'Task.project_id'
						),
						'Error' => array(
							'fields' => array(
								'Error.task_id'
							)
						)
					)
				)
			));
			$tasks = $this->Project->Task->find('all', array(
				'fields' => array(
					'Task.id',
					'Task.title',
					'Project.title',
					'Project.created',
					'User.name',
				),
				'order' => array(
					'Project.created' => 'DESC'
				)
			));
			$errorss = $this->Project->Task->Error->find('all', array(
				'fields' => array(
					'Error.id',
					'Error.title',
					'Error.status',
					'Task.title',
					'Task.user_id'
				),
				'contain' => array(
					'Task' => array(
						'User' => array(
							'fields' => array(
								'User.name'
							)
						)
					)
				)
			));
			$this->set(compact('title_for_layout', 'projects', 'users', 'tasks', 'errorss'));
		}
		// My projects
		public function my_projects()
		{
			$this->Paginator->settings = array(
				'Task' => array(
					'fields' => array(
						'Task.user_id',
						'Task.project_id',
						'Project.title',
						'Project.user_id',
					),
					'contain' => array(
						'Project' => array(
							'fields' => array(
								'Project.id',
								'Project.user_id',
								'Project.start',
								'Project.end'
							),
							'User' => array(
								'fields' => array(
									'User.name'
								)
							),
							'Task' => array(
								'fields' => array(
									'count(Task.id) as tasks'
								)
							)
						)
					),
					'conditions' => array(
						'OR' => array(
							'Project.user_id' => $this->Session->read('Auth.User.id'),
							'Task.user_id' => $this->Session->read('Auth.User.id')
						)
					),
					'group' => array(
						'Project.id'
					),
					'order' => array(
						'Project.created' => 'DESC'
					),
					'limit' => 15
				)
			);
			$title_for_layout = 'My projects';
			$this->set('projects', $this->Paginator->paginate('Task'));
			$this->set(compact('title_for_layout'));
		}
		// Pagination ajax
		public function paginaion($page= NULL)
		{
			$page = $_GET['page'];
			$projects = $this->Project->find('all', array(
				'fields' => array(
					'Project.id',
					'Project.title',
					'Project.body',
					'Project.start',
					'Project.end',
					'Project.created',
					'User.name',
					'User.role_id'
				),
				'order' => array(
					'Project.created' => 'DESC'
				),
				'contain' => array(
					'Task' => array(
						'fields' => array(
							'Task.project_id'
						)
					),
					'User' => array(
						'Role' => array(
							'fields' => array(
								'Role.color'
							)
						)
					)
				),
				'page' => $page,
				'limit' => 10
			));
			$this->set(compact('projects'));
		}
		// Request action
		public function request()
		{
			$projects = $this->Project->find('all', array(
				'order' => array(
					'Project.created' => 'DESC'
				),
				'fields' => array(
					'Project.id',
					'Project.title',
					'Project.created'
				),
				'contain' => array(
					'Task' => array(
						'conditions' => array(
							'Task.status' => 0
						),
						'fields' => array(
							'Task.id',
							'Task.status',
							'Task.project_id'
						)
					)
				)
			));
			if (!empty($this->request->params['requested'])) {
				return $projects;
			}
			$this->set(compact('projects'));
		}
	}