<?php 
	class TasksController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter() {
			parent::beforeFilter();
	    	$this->Components->disable('Security');
        	if (in_array($this->params['action'], array('add', 'edit', 'change_status'))) {
            	$this->Security->validatePost = false;
        	}  
		}
		public function index()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'Tasks list');
			$total_tasks = $this->Task->find('count');
			$json = array();
			$this->Paginator->settings = array(
				'order' => array(
					'Project.created' => 'DESC',
					'Task.created' => 'DESC'
				),
				'fields' => array(
					'Task.id',
					'Task.title',
					'Task.body',
					'Task.start',
					'Task.end',
					'Task.status',
					'Task.user_id',
					'Task.created',
					'User.name',
					'Project.title'
				),
				'limit' => 10,
				'contain' => array(
					'User',
					'Project',
					'Error' => array(
						'conditions' => array(
							'Error.status' => 0
						),
						'fields' => array(
							'Error.id',
							'Error.status',
							'Error.task_id'
						)
					)
				)
			);
			$calendar_tasks = $this->Task->find('all', array(
				'fields' => array(
					'Task.id',
					'Task.title',
					'Task.body',
					'Task.start',
					'Task.end',
					'Task.status',
					'Task.user_id',
					'User.name',
					'Project.title'
				),
			));
			foreach ($calendar_tasks as $key => $task) {
				if($task['Task']['status'] == 0){
					$color = '#f0ad4e';
				} elseif ($task['Task']['status'] == 1) {
					$color = '#5cb85c';
				} else {
					$color = '#c9302c';
				}
				$json[] = array(
					'title' => $task['Task']['title'],
					'start' => $task['Task']['start'],
					'end' => $task['Task']['end'],
					'user' => $task['User']['name'],
					'bd' => $task['Task']['start'],
					'stop' => $task['Task']['end'],
					'body' => $task['Task']['body'],
					'color' => $color,
					'project' => $task['Project']['title']
				);
			}
			$this->set('json', json_encode($json));
			//pr($tasks); die();
			$this->set('tasks', $this->Paginator->paginate('Task'));
			$projects = $this->Task->Project->find('list', array(
				'order' => array('Project.created' => 'DESC')
			));
			// Current month
			$month = date('m');
			$year = date('Y');
			$start_date = $year.'-'.$month.'-01';
			$end_day = date("Y-m-t", strtotime($start_date));
			// Users and tasks of user
			$users = $this->Task->User->find('all', array(
				'order' => array(
					'User.role_id' => 'ASC',
					'User.name' => 'ASC'
				),
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.id !=' => 13,
					'User.status' => 1
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'Role.color'
				),
				'contain' => array(
					'Role',
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.id',
								'Project.title'
							)
						),
						'Error' => array(
							'conditions' => array(
								'Error.status' => 0
							)
						),
						'conditions' => array(
							'DATE(Task.start) <=' => $end_day,
							'DATE(Task.end) >=' => $start_date 
						),
						'order' => array(
							'Task.created' => 'DESC'
						)
					)
				)
			));
			$roles = $this->Task->User->Role->find('list', array(
				'conditions' => array(
					'Role.id !=' => array(3,4,8)
				)
			));
			$this->set(compact('title_for_layout', 'projects', 'users', 'roles', 'total_tasks'));
		}
		public function add()
		{
			$title_for_layout = __d('croogo', 'Add new task');
			if ($this->request->is('post')) {
				$this->Task->create();
				if ($this->Task->save($this->request->data)) {
					$this->Session->setFlash(__d('croogo','Creating task successfully!'), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					return $this->redirect(array('plugin' => 'managers' ,'controller' => 'tasks' ,'action' => 'index'));
				} else {
					$this->Session->setFlash(__d('croogo','Can not save. Please try again!'), 'flash', array('class' => 'alert alert-danger alert-dismissable'));
				}
			}
			$users = $this->Task->User->find('list', array(
				'conditions' => array(
					'User.role_id !=' => array(4, 7, 8)
				)
			));
			$projects = $this->Task->Project->find('list', array(
				'order' => array(
					'Project.created' => 'DESC'
				)
			));
			$this->set(compact('title_for_layout', 'users', 'projects'));
		}
		// Change status
		public function change_status($id = null)
		{
			if (!empty($this->data)) {
				if ($this->Task->save($this->data)) {
					//$this->Session->setFlash(__d('croogo','Đã cập nhật sự kiện thành công!', true), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'tasks','action' => 'my_tasks'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Task->read(null, $id);
			}
		}
		// Edit task
		public function edit($id = null)
		{
			$id = $_GET['dataid'];
			if (!empty($this->data)) {
				if ($this->Task->save($this->data)) {
					//$this->Session->setFlash(__d('croogo','Đã cập nhật sự kiện thành công!', true), 'flash', array('class' => 'alert alert-success alert-dismissable'));
					$this->redirect(array('controller'=>'tasks','action' => 'my_tasks'));
				} else {
					$this->Session->setFlash(__('Không thể cập nhật. Vui lòng thử lại!', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Task->read(null, $id);
			}
		}
		// My tasks
		public function my_tasks()
		{
			$this->layout = 'calendar';
			$title_for_layout = __d('croogo', 'My tasks');
			$this->Paginator->settings = array(
				'conditions' => array('Task.user_id' => $this->Session->read('Auth.User.id')),
				'limit' => 20,
				'order' => array(
					'Task.status' => 'ASC',
					'Project.created' => 'DESC'
				),
				'fields' => array(
					'Task.id',
					'Task.title',
					'Task.body',
					'Task.start',
					'Task.end',
					'Task.status',
					'Task.user_id',
					'Project.title'
				),
				'contain' => array(
					'Project',
					'Error' => array(
						'conditions' => array(
							'Error.status' => 0
						),
						'fields' => array(
							'Error.id',
							'Error.task_id'
						)
					)
				)
			);
			$this->set('tasks', $this->Paginator->paginate('Task'));
			$this->set(compact('title_for_layout'));
		}
		// Filter ajax
		public function ajax($project_id = null, $user_id = null, $status = null, $page = NULL)
		{
			if(!empty($_GET['page'])){
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			if($_GET['status'] != ''){
				$status = $_GET['status'];
			} else {
				$status = array(0,1,2);
			}
			if(!empty($_GET['project_id'])){
				$project_id = $_GET['project_id'];
			}
			if(!empty($_GET['role_id'])){
				$role_id = $_GET['role_id'];
			}
			if(!empty($_GET['user_id'])){
				$user_id = $_GET['user_id'];
			}
			$conditions = array();
			if(!empty($project_id)){
				$conditions[] = array(
					'Task.project_id' => $project_id
				);
			}
			if(!empty($role_id)){
				$conditions[] = array(
					'User.role_id' => $role_id
				);
			}
			if(!empty($user_id)){
				$conditions[] = array(
					'Task.user_id' => $user_id
				);
			}
			if($status != ''){
				$conditions[] = array(
					'Task.status' => $status
				);
			}
			$tasks = $this->Task->find('all', array(
				'conditions' => array($conditions),
				'contain' => array(
					'User' => array(
						'fields' => array(
							'User.id',
							'User.name',
							'User.role_id'
						)
					),
					'Project' => array(
						'fields' => array(
							'Project.id',
							'Project.title',
							'Project.created'
						)
					),
					'Error' => array(
						'conditions' => array(
							'Error.status' => 0
						),
						'fields' => array(
							'Error.status',
							'Error.id'
						)
					)
				),
				'order' => array(
					'Project.created' => 'DESC',
					'Task.created' => 'DESC'
				),
				'limit' => 10,
				'page' => $page
			));
			$total_tasks = $this->Task->find('count', array(
				'conditions' => array($conditions),
			));
			$this->set(compact('tasks', 'total_tasks', 'page'));
		}
		// Pagination ajax
		public function pagination($page = NULL, $project_id = NULL, $role_id = NULL, $user_id = NULL, $status = NULL)
		{
			$page = $_GET['page'];
			$project_id = $_GET['project_id'];
			$role_id = $_GET['role_id'];
			$user_id = $_GET['user_id'];
			if($_GET['status'] != ''){
				$status = $_GET['status'];
			}
			$conditions = array();
			if($status != ''){
				$conditions[] = array(
					'Task.status' => $status
				);
			}
			if(!empty($project_id)){
				$conditions[] = array(
					'Project.id' => $project_id
				);
			}
			if(!empty($role_id)){
				$conditions[] = array(
					'User.role_id' => $role_id
				);
			}
			if(!empty($user_id)){
				$conditions[] = array(
					'User.id' => $user_id
				);
			}
			$tasks = $this->Task->find('all', array(
				'page' => $page,
				'limit' => 10,
				'order' => array(
					'Project.created' => 'DESC',
					'Task.created' => 'DESC'
				),
				'contain' => array(
					'User' => array(
						'fields' => array(
							'User.id',
							'User.name',
							'User.role_id'
						)
					),
					'Project' => array(
						'fields' => array(
							'Project.id',
							'Project.title',
							'Project.created'
						)
					),
					'Error' => array(
						'conditions' => array(
							'Error.status' => 0
						),
						'fields' => array(
							'Error.status',
							'Error.id'
						)
					)
				),
				'conditions' => array(
					$conditions
				)
			));
			$total_tasks = $this->Task->find('count', array(
				'conditions' => array($conditions)
			));
			$this->set(compact('tasks', 'total_tasks', 'page'));
		}
		// Doing tasks
		public function doing_tasks()
		{
			$tasks = $this->Task->find('all', array(
				'fields' => array(
					'Task.id',
					'Task.title',
					'Task.status',
					'Task.end',
					'Project.id',
					'Project.title',
					'User.name',
					'User.id',
					'User.role_id'
				),
				'conditions' => array(
					'Task.status' => 0
				),
				'order' => array(
					'Task.end' => 'ASC'
				)
			));
			if (!empty($this->request->params['requested'])) {
				return $tasks;
			}
			$this->set(compact('tasks'));
		}
		// Tasks on month
		public function month($month = NULL, $group = NULL)
		{
			$this->layout = 'calendar';
			$month = $_GET['thang'];
			$first_day = $month.'-01';
			$end_day = date("Y-m-t", strtotime($first_day));
			$title_for_layout = __d('croogo', 'Tasks on month '.$month);
			$users = $this->Task->User->find('all', array(
				'order' => array('User.role_id' => 'ASC'),
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.id !=' => 13,
					'User.status' => 1,
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'User.status',
					'Role.color'
				),
				'contain' => array(
					'Role',
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.id',
								'Project.title'
							)
						),
						'conditions' => array(
							'DATE(Task.start) <=' => $end_day,
							'DATE(Task.end) >=' => $first_day 
						),
						'order' => array(
							'Task.created' => 'DESC'
						)
					)
				)
			));
			$roles = $this->Task->User->Role->find('list', array(
				'conditions' => array(
					'Role.id !=' => array(3,4,8)
				)
			));
			$projects = $this->Task->Project->find('list', array(
				'order' => array(
					'Project.created' => 'DESC'
				)
			));
			$this->set(compact('month', 'title_for_layout', 'users', 'roles', 'group', 'projects'));
		}
		// view_task_user
		public function view_task_user($user_id = NULL, $status = NULL, $thang = NULL)
		{
			$user_id = $_GET['user_id'];
			if($_GET['status'] != ''){
				$status = $_GET['status'];
			}else{
				$status = array(0,1,2);
			}
			$this->layout = false;
			$this->Task->recursive = -1;
			// Current month
			$month = $_GET['thang'];
			$start_date = $month.'-01';
			$end_day = date("Y-m-t", strtotime($start_date));
			$tasks = $this->Task->find('all', array(
				'conditions' => array(
					'Task.user_id' => $user_id,
					'Task.status' => $status,
					'DATE(Task.start) <=' => $end_day,
					'DATE(Task.end) >=' => $start_date 
				),
				'order' => array(
					'Task.created' => 'DESC'
				),
				'fields' => array(
					'Task.id',
					'Task.title',
					'Task.user_id',
					'Task.status',
					'Task.start',
					'Task.end'
				)
			));
			echo '<table class="table table-hover table-bordered">';
				echo '<thead>';
					echo '<tr>';
						echo '<tr>';
							echo '<td>';
								echo '#';
							echo '</td>';
							echo '<td>';
								echo 'Task name';
							echo '</td>';
							echo '<td>';
								echo 'Start';
							echo '</td>';
							echo '<td>';
								echo 'End';
							echo '</td>';
						echo '</tr>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach ($tasks as $key => $t) {
					echo '<tr>';
						echo '<td>';
							echo $key+1;
						echo '</td>';
						echo '<td>';
							echo $t['Task']['title'];
						echo '</td>';
						echo '<td>';
							echo $t['Task']['start'];
						echo '</td>';
						echo '<td>';
							echo $t['Task']['end'];
						echo '</td>';
					echo '</tr>';
				}
				echo '<tbody>';
			echo '<table>';
			die();
			//pr($tasks); die();
		}
		// FIlter tasks by week
		public function tasks_by_week($week = NULL)
		{
			// Get week
			$week = $_GET['week'];
			$monday = date('Y-m-d', strtotime('last monday', $week));
			$week_start = strtotime($monday);
			$week_end = strtotime(date("Y-m-d",$week_start)." +7 days");
			$sunday = date('Y-m-d', $week_end);
			//pr($monday.'+'.$sunday);
			// Tasks by user
			$users = $this->Task->User->find('all', array(
				'order' => array(
					'User.role_id' => 'ASC',
					'User.name' => 'ASC'
				),
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.id !=' => 13,
					'User.status' => 1
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'Role.color'
				),
				'contain' => array(
					'Role',
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.id',
								'Project.title'
							)
						),
						'Error' => array(
							'conditions' => array(
								'Error.status' => 0
							)
						),
						'conditions' => array(
							'DATE(Task.start) <=' => $sunday,
							'DATE(Task.end) >=' => $monday 
						),
						'order' => array(
							'Task.created' => 'DESC'
						)
					)
				)
			));
			$count = $this->Task->find('count', array(
				'conditions' => array(
					'DATE(Task.start) <=' => $sunday,
					'DATE(Task.end) >=' => $monday 
				)
			));
			$this->set(compact('users', 'week_start', 'week_end', 'count', 'monday', 'sunday'));
		}
		// Filter tasks by month
		public function tasks_by_month($thang = NULL)
		{
			$thang = $_GET['get_month'];
			$thang = explode(' ', $thang);
			$month_str = strtotime($thang[3].'-'.$thang[1]);
			$month = date('Y-m',$month_str);
			$first_day = $month.'-01';
			$end_day = date("Y-m-t", strtotime($first_day));
			$start_time = strtotime($first_day);
			$end_time = strtotime("+1 month", $start_time);;
			$users = $this->Task->User->find('all', array(
				'order' => array('User.role_id' => 'ASC'),
				'conditions' => array(
					'User.role_id !=' => array(4,8),
					'User.id !=' => 13,
					'User.status' => 1,
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'User.status',
					'Role.color'
				),
				'contain' => array(
					'Role',
					'Task' => array(
						'Project' => array(
							'fields' => array(
								'Project.id',
								'Project.title'
							)
						),
						'Error' => array(
							'conditions' => array(
								'Error.status' => 0
							)
						),
						'conditions' => array(
							'DATE(Task.start) <=' => $end_day,
							'DATE(Task.end) >=' => $first_day 
						),
						'order' => array(
							'Task.created' => 'DESC'
						)
					)
				)
			));
			$count = $this->Task->find('count', array(
				'conditions' => array(
					'DATE(Task.start) <=' => $end_day,
					'DATE(Task.end) >=' => $first_day 
				),
			));
			$this->set(compact('users', 'end_time', 'start_time', 'count', 'month'));
		}
		// Stat month
		public function statmonth($thang = NULL)
		{
			$thang = $_GET['thang'];
			$start_day = $thang.'-01';
			$end_day = date("Y-m-t", strtotime($start_day));
			$users = $this->Task->User->find('all', array(
				'contain' => array(
					'Task' => array(
						'conditions' => array(
							'DATE(Task.start) <=' => $end_day,
							'DATE(Task.end) >=' => $start_day
						),
						'fields' => array(
							'Task.id',
							'Task.title',
							'Task.start',
							'Task.end',
							'Task.status',
						)
					),
					'Role'
				),
				'fields' => array(
					'User.id',
					'User.name',
					'User.role_id',
					'Role.color',
					'User.status'
				),
				'order' => array('User.role_id' => 'ASC'),
				'conditions' => array(
					'User.status' => 1,
					'User.role_id !=' => array(4,8),

				)
			));
			//pr($users);
			$this->set(compact('users', 'thang'));
		}
		// Delete task
		public function delete($id = NULL)
		{
			if (!$this->request->is('post')) {
        		throw new MethodNotAllowedException();
    		}
		    $this->Task->id = $id;
		    if (!$this->Task->exists()) {
		        throw new NotFoundException(__('Invalid task'));
		    }
		    if ($this->Task->delete()) {
		        $this->Session->setFlash(__('Deleted task successfully!'));
		        $this->redirect(array('action' => 'index'));
		    }
		    $this->Session->setFlash(__('Task was not deleted'));
		    $this->redirect(array('action' => 'index'));
		}
	}