<?php 
	$tasks = $this->requestAction(array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'doing_tasks'));
	if(!empty($tasks)){
?>
<div class="popup-task">
	<a href="javascript:void(0)" class="close-popup" title="Doing tasks"><i class="glyphicon glyphicon-plus"></i></a>
	<div class="relative">
		<div class="panel panel-info hidden">
			<div class="panel-heading"><h3 class="panel-title"><b><?php echo __d('croogo', 'Doing tasks').' ( '.count($tasks).' )'; ?></b></h3></div>
			<div class="panel-body">
				<div class="filter-doing-tasks">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<?php 
								$projects = $this->requestAction(array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'request'));
								foreach ($projects as $key => $p) {
									if(count($p['Task']) > 0){
										$project[$p['Project']['id']] = $p['Project']['title'].' ( '.count($p['Task']).' )';
									}
								}
								echo $this->Form->input('project_id', $options = array(
									'empty' => 'Select project',
									'class' => 'form-control input-sm',
									'options' => $project,
									'label' => false,
									'div' => array(
										'class' => 'form-group'
									)
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<?php 
								$roles = $this->requestAction(array('plugin' => 'users', 'controller' => 'roles', 'action' => 'request'));
								foreach ($roles as $key => $r) {
									$role[$r['Role']['id']] = $r['Role']['title'];
								}
								echo $this->Form->input('role_id', $options = array(
									'empty' => 'Select group',
									'class' => 'form-control group-list input-sm',
									'label' => false,
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $role
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<?php 
								$users = $this->requestAction(array('plugin' => 'users', 'controller' => 'users', 'action' => 'request'));
								foreach ($users as $key => $u) {
									$user[$u['User']['id']] = $u['User']['name'];
								}
								echo $this->Form->input('user_id', $options = array(
									'empty' => 'Select user',
									'class' => 'form-control select-user input-sm',
									'label' => false,
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $user
								));
							?>
						</div>
					</div>
				</div>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Tasks'); ?></th>
							<th><?php echo __d('croogo', 'Project'); ?></th>
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'End time'); ?></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="load_doing_task">
						<?php 
							foreach ($tasks as $key => $task) {
						?>
						<tr class="project-<?php echo $task['Project']['id']; ?> role-<?php echo $task['User']['role_id']; ?> user-<?php echo $task['User']['id']; ?>" id="row<?php echo $task['Task']['id']; ?>">
							<td><?php echo $key+1; ?></td>
							<td><?php echo $task['Task']['title']; ?></td>
							<td>
								<?php 
									echo $this->Html->link($task['Project']['title'], array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'view', 'id' => $task['Project']['id'], 'slug' => Inflector::slug($task['Project']['title'], $replacement = '-')));
								?>
							</td>
							<td><?php echo $task['User']['name']; ?></td>
							<td><?php echo $task['Task']['end']; ?></td>
							<td>
								<?php 
									echo $this->Form->create('Task', $options = array(
										'inputDefaults' => array(
											'class' => 'form-control',
											'label' => false,
											'div' => array(
												'class' => 'form-group'
											)
										),
										'url' => array(
											'plugin' => 'managers',
											'controller' => 'tasks',
											'action' => 'change_status',
											$task['Task']['id']
										)
									));
									echo $this->Form->input('id', $options = array(
										'value' => $task['Task']['id']
									));
									echo $this->Form->input('status', $options = array(
										'value' => 1,
										'type' => 'hidden',
										'label' => 'Check done'
									));
									if($this->Session->read('Auth.User.id') == $task['User']['name'] || $this->Session->read('Auth.User.role_id') == 1){
										$class = '';
									}else{
										$class = ' disabled'; 
									}
									echo $this->Form->button('<i class="fa fa-check-square-o"></i> Check done', $options = array(
										'class' => 'btn btn-success btn-sm'.$class.'',
										'taskid' => $task['Task']['id']
									));
									echo $this->Form->end($options = null);
								?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php } ?>