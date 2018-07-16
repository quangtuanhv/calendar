<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#users-list" aria-controls="users-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'User'); ?> ( <?php echo count($users); ?> )</a>
		</li>
		<li role="presentation">
			<a href="#projects-list" aria-controls="projects-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Project'); ?> ( <?php echo count($projects); ?> )</a>
		</li>
		<li role="presentation">
			<a href="#tasks-list" aria-controls="tasks-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Tasks'); ?> ( <?php echo count($tasks); ?> )</a>
		</li>
		<li role="presentation">
			<a href="#errors-list" aria-controls="errors-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Errors'); ?> ( <?php echo count($errorss); ?> )</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="users-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Name'); ?></th>
						<th><?php echo __d('croogo', 'Username'); ?></th>
						<th><?php echo __d('croogo', 'Birthday'); ?></th>
						<th><?php echo __d('croogo', 'Email'); ?></th>
						<th><?php echo __d('croogo', 'Phone'); ?></th>
						<th class="text-center"><?php echo __d('croogo', 'Tasks'); ?></th>
						<th class="text-center"><?php echo __d('croogo', 'Errors'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $key => $user) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td>
							<?php echo $user['User']['name']; ?>
						</td>
						<td>
							<?php echo $user['User']['username']; ?>
						</td>
						<td>
							<?php echo $user['User']['birthday']; ?>
						</td>
						<td>
							<?php echo $user['User']['email']; ?>
						</td>
						<td>
							<?php echo $user['User']['phone']; ?>
						</td>
						<td class="text-center">
							<?php 
								echo $this->Html->link(count($users[$key]['Task']), array('plugin' => 'users', 'controller' => 'users', 'action' => 'view', 'username' => $user['User']['username'].'#tasks-list'));
							?>
						</td>
						<td class="text-center">
							<?php 
								$errors = 0;
								foreach ($user['Task'] as $number => $task) {
									$errors += count($user['Task'][$number]['Error']);
								}
								echo $this->Html->link($errors, array('plugin' => 'users', 'controller' => 'users', 'action' => 'view', 'username' => $user['User']['username'].'#errors-list'));
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="projects-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Project'); ?></th>
						<th><?php echo __d('croogo', 'PM'); ?></th>
						<th><?php echo __d('croogo', 'Start'); ?></th>
						<th><?php echo __d('croogo', 'End'); ?></th>
						<th><?php echo __d('croogo', 'Tasks'); ?></th>
						<th><?php echo __d('croogo', 'Errors'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($projects as $key => $project) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td>
							<?php 
								echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $project['Project']['id'], 'slug' => Inflector::slug($project['Project']['title'], $replacement = '-')));
							?>
						</td>
						<td><?php echo $project['User']['name']; ?></td>
						<td><?php echo $project['Project']['start']; ?></td>
						<td><?php echo $project['Project']['end']; ?></td>
						<td>
							<?php echo count($projects[$key]['Task']); ?>
						</td>
						<td>
							<?php 
								$errors = 0;
								foreach ($project['Task'] as $number => $task) {
									$errors += count($project['Task'][$number]['Error']);
								}
								echo $errors;
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="tasks-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Task'); ?></th>
						<th><?php echo __d('croogo', 'User'); ?></th>
						<th><?php echo __d('croogo', 'Project'); ?></th>
						<th><?php echo __d('croogo', 'Errors'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tasks as $key => $task) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $task['Task']['title']; ?></td>
						<td><?php echo $task['User']['name']; ?></td>
						<td><?php echo $task['Project']['title']; ?></td>
						<td>
							<?php 
								echo count($tasks[$key]['Error']);
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="errors-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Error'); ?></th>
						<th><?php echo __d('croogo', 'Task'); ?></th>
						<th><?php echo __d('croogo', 'User'); ?></th>
						<th><?php echo __d('croogo', 'Status'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($errorss as $key => $error) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $error['Error']['title']; ?></td>
						<td><?php echo $error['Task']['title']; ?></td>
						<td>
							<?php echo $error['Task']['User']['name']; ?>
						</td>
						<td>
							<?php 
								if ($error['Error']['status'] == 0) {
									echo '<span class="btn btn-danger btn-sm">'.__d('croogo', 'Fixing').'</span>';
								}else{
									echo '<span class="btn btn-success btn-sm">'.__d('croogo', 'Done').'</span>';
								}
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>