<?php //pr($tasks); die(); ?>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation">
			<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo $title_for_layout; ?></a>
		</li>
		<li role="presentation" class="active">
			<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Tasks'); ?></a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="home">
			<?php 
				echo $this->Form->create('Project', $options = array(
					'url' => array(
						'controller' => 'projects',
						'action' => 'edit',
						$projects['Project']['id']
					),
					'inputDefaults' => array(
						'class' => 'form-control',
						'label' => false
					)
				));
				echo $this->Form->input('id', $options = array(
					'value' => $projects['Project']['id']
				));
			?>
			<table class="table table-hover">
				<tbody>
					<tr>
						<th class="col-lg-2"><?php echo __d('croogo', 'Project name'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('title', $options = array(
									'value' => $projects['Project']['title']
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Project info'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('body', $options = array(
									'value' => $projects['Project']['body']
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Project manager'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('user_id', $options = array(
									'value' => $projects['User']['id']
								));
							?>	
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Start'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('start', $options = array(
									'value' => $projects['Project']['start'],
									'type' => 'text',
									'class' => 'form-control date'
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'End'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('end', $options = array(
									'value' => $projects['Project']['end'],
									'type' => 'text',
									'class' => 'form-control date'
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Url test'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('demo', $options = array(
									'value' => $projects['Project']['demo']
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Domain'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('domain', $options = array(
									'value' => $projects['Project']['domain']
								));
							?>
						</td>
					</tr>
					<?php if($this->Session->read('Auth.User.id') != NULL){ ?>
					<tr>
						<th><?php echo __d('croogo', 'Host'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('host', $options = array(
									'value' => $projects['Project']['host']
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Account'); ?></th>
						<td>
							<?php 
								echo $this->Form->input('account', $options = array(
									'value' => $projects['Project']['account']
								));
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Password'); ?></th>
						<td><?php echo $projects['Project']['pass']; ?>
							<?php 
								echo $this->Form->input('pass', $options = array(
									'value' => $projects['Project']['pass']
								));
							?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th><?php echo __d('croogo', 'Tasks'); ?></th>
						<td><?php echo count($projects['Task']); ?></td>
					</tr>
				</tbody>
			</table>
			<div class="text-center">
				<?php 
					if($this->Session->read('Auth.User.id') != NULL){
						echo $this->Form->button('<i class="fa fa-refresh"></i> Update', $options = array(
							'class' => 'btn btn-info'
						));
					}
					echo $this->Form->end($options = null);
				?>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane active" id="tab">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Task'); ?></th>
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'Start'); ?></th>
							<th><?php echo __d('croogo', 'End'); ?></th>
							<th><?php echo __d('croogo', 'Priority'); ?></th>
							<th><?php echo __d('croogo', 'Status'); ?></th>
							<th class="text-center">Notes</th>
							<th class="text-center"><?php echo __d('croogo', 'Errors'); ?></th>
							<th class="col-lg-2"><?php echo __d('croogo', 'Action'); ?></th>
						</tr>
					</thead>
					<tbody class="load">
						<?php foreach ($tasks as $key => $task) { ?>
						<tr class="tr<?php echo $task['Task']['id']; ?>">
							<td><?php echo $key+1; ?></td>
							<td>
								<?php 
									if (empty($task['Task']['url'])) {
										echo $task['Task']['title'];
									}else{
								?>
									<a target="_blank" href="<?php echo $task['Task']['url']; ?>" title="<?php echo $task['Task']['body']; ?>" data-tooltip="tooltip"><?php echo $task['Task']['title']; ?></a>
								<?php
									}
								?>
							</td>
							<td class="col-lg-2">
								<?php 
									if($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 2 || $this->Session->read('Auth.User.role_id') == 6 || $this->Session->read('Auth.User.role_id') == 7){
										$disable = '';
									}else{
										$disable = 'true';
									}
									echo $this->Form->create('Task', $options = array(
										'url' => array(
											'plugin' => 'managers',
											'controller' => 'tasks',
											'action' => 'change_status',
											$task['Task']['id']	
										),
										'class' => 'edit_form',
										));
									echo $this->Form->input('id', $options = array(
										'value' => $task['Task']['id']
									));
									echo $this->Form->input('user_id', $options = array(
										'class' => 'form-control input-sm confirm',
										'value' => $task['Task']['user_id'],
										'label' => false,
										'taskid' => $task['Task']['id'],
										'disabled' => $disable,
										'style' => array(
											'background:'.$task['User']['color'].';',
											'color:#fff'
										)
									));
									echo $this->Form->end($options = null);
								?>
							</td>
							<td><?php echo $task['Task']['start']; ?></td>
							<td><?php echo $task['Task']['end']; ?></td>
							<td class="col-lg-1">
								<?php 
									echo $this->Form->create('Task', $options = array(
										'url' => array(
											'plugin' => 'managers',
											'controller' => 'tasks',
											'action' => 'change_status',
											$task['Task']['id']	
										),
										'class' => 'edit_form',
									));
									echo $this->Form->input('id', $options = array(
										'value' => $task['Task']['id']
									));
									$priority = array(0 => 'High', 1 => 'Medium', 2 => 'Low');
									if($task['Task']['priority'] == 0){
										$class = 'btn btn-danger btn-xs';
									}elseif ($task['Task']['priority'] == 1) {
										$class = 'btn btn-warning btn-xs';
									}else{
										$class = 'btn btn-success btn-xs';
									}
									echo $this->Form->input('priority', $options = array(
										'value' => $task['Task']['priority'],
										'label' => false,
										'class' => 'form-control input-sm confirm '.$class,
										'options' => $priority,
										'taskid' => $task['Task']['id'],
									));
									echo $this->Form->end($options = null);
								?>
							</td>
							<td class="col-lg-1">
								<?php 
									echo $this->Form->create('Task', $options = array(
										'url' => array(
											'plugin' => 'managers',
											'controller' => 'tasks',
											'action' => 'change_status',
											$task['Task']['id']	
										),
										'class' => 'edit_form',
									));
									echo $this->Form->input('id', $options = array(
										'value' => $task['Task']['id']
									));
									$status = array(0 => __d('croogo', 'Doing'), 1 => __d('croogo', 'Done'), 2 => __d('croogo', 'Error'));
									if($task['Task']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role_id') == 1){
										$disable = '';
									}else{
										$disable = 'true';
									}
									if($task['Task']['status'] == 0){
										$class = 'btn-warning btn-xs';
									}elseif ($task['Task']['status'] == 1) {
										$class = 'btn-success btn-xs';
									}else{
										$class = 'btn-danger btn-xs';
									}
									if(count($tasks[$key]['Error']) > 0){
										$value = 2;
										$class = 'btn-danger';
									}else{
										$value = $task['Task']['status'];
									}
									echo $this->Form->input('status', $options = array(
										'class' => 'form-control '.$class.' input-sm confirm',
										'value' => $value,
										'label' => false,
										'options' => $status,
										'taskid' => $task['Task']['id'],
										'disabled' => $disable
									));
									echo $this->Form->end($options = null);
								?>
							</td>
							<td class="text-center">
								<?php 
									if(count($tasks[$key]['Note']) == 0){
								?>
									<button class="btn btn-default btn-sm"><?php echo count($tasks[$key]['Note']); ?></button>
								<?php
									} else {
								?>
									<a href="#view-notes" class="btn btn-warning btn-sm view_notes" data-toggle="modal" data-tooltip="tooltip" title="View notes" data-task="<?php echo $task['Task']['id']; ?>"><?php echo count($tasks[$key]['Note']); ?></a>
								<?php
									}
								?>
							</td>
							<td class="text-center">
								<?php 
									if (count($tasks[$key]['Error']) > 0) {
								?>
									<a class="btn btn-danger btn-sm view_errors" href="#view-errors" data-toggle="modal" data-tooltip="tooltip" title="View errors" data-taskid="<?php echo $task['Task']['id']; ?>"><?php echo count($tasks[$key]['Error']); ?></a>
								<?php	
									}else{
								?>
									<button class="btn btn-default btn-sm">0</button>
								<?php	
									}
								?>
							</td>
							<td>
								<?php 
									if ($task['Task']['user_id'] == $this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.role_id') == 1) {
										$class = ''; 
									}else{
										$class = 'disabled';
									}
								?>
								<a class="btn btn-info btn-sm edit_task <?php echo $class; ?>" data-toggle="modal" href='#edit-task' title="<?php echo __d('croogo', 'Edit') ?>" data-tooltip="tooltip" data-id="<?php echo $task['Task']['id']; ?>"><i class="glyphicon glyphicon-edit"></i></a>
								<?php 
									if ($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 4 || $this->Session->read('Auth.User.role_id') == 7 || $this->Session->read('Auth.User.role_id') == 8) {
										$class = ''; 
									}else{
										$class = 'disabled';
									}
								?>
								<a class="btn btn-warning btn-sm add_note <?php echo $class; ?>" data-toggle="modal" href='#add-note' data-tooltip="tooltip" title="Add note" data-taskid="<?php echo $task['Task']['id']; ?>"><i class="fa fa-comment-o"></i></a>
								<a class="btn btn-danger btn-sm add_error <?php echo $class; ?>" data-toggle="modal" href='#add-error' title="<?php echo __d('croogo', 'Add error'); ?>" data-tooltip="tooltip" data-task="<?php echo $task['Task']['id']; ?>"><i class="glyphicon glyphicon-warning-sign"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<!-- Pagination tasks -->
				<div class="text-center">
					<ul class="pagination"><?php echo $this->Paginator->numbers(); ?></ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Popup edit task-->
<div class="modal fade" id="edit-task">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Edit task'); ?></h4>
			</div>
			<div class="modal-body" id="load_edit_task_form">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Popup add error-->
<div class="modal fade" id="add-error">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Add error'); ?></h4>
			</div>
			<div class="modal-body" id="load_add_error_form">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Popup add note -->
<div class="modal fade" id="add-note">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add note</h4>
			</div>
			<div class="modal-body add-note">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- POPUP view notes -->
<div class="modal fade" id="view-notes">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">View notes</h4>
			</div>
			<div class="modal-body" id="load_view_notes">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Popup view errors -->
<div class="modal fade" id="view-errors">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">View errors</h4>
			</div>
			<div class="modal-body" id="load_errors_list">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>