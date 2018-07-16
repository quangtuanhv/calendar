<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#all-tasks" aria-controls="all-tasks" role="tab" data-toggle="tab"><?php echo __d('croogo', 'All tasks') ?></a>
		</li>
		<li role="presentation">
			<a href="#list-view" aria-controls="list-view" role="tab" data-toggle="tab"><?php echo __d('croogo', 'List') ?></a>
		</li>
		<li role="presentation">
			<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Calendar') ?></a>
		</li>
		<li role="presentation">
			<a href="#statistical" aria-controls="tatistical" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Statistical') ?></a>
		</li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="all-tasks">
			<?php
				$month = date('m');
				$year = date('Y');
				$start_date = "01-".$month."-".$year;
				$start_time = strtotime($start_date);
				$end_time = strtotime("+1 month", $start_time);
				// Current week
				$monday = strtotime("last monday");
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
				$this_week_start = date("Y-m-d",$monday);
				$this_week_end = date("Y-m-d",$sunday);
			?>
			<div id="current_time">
				<button class="btn btn-default btn-sm"><i class="fa fa-clock-o"></i> <?php echo date('Y-m').' | From '.$this_week_start.' to '.$this_week_end; ?></button>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 check_month">
							<button id="last_month" class="btn btn-default btn-sm" data-tooltip="tooltip" title="Last month" data-month="<?php echo date('Y-m',strtotime("-1 month")); ?>"><i class="fa fa-angle-left"></i></button>
							<button id="current_month" class="btn btn-default btn-sm" data-month="<?php echo date('Y-m'); ?>" data-tooltip="tooltip" title="Current month"><i class="fa fa-clock-o"></i> <?php echo date('Y-m'); ?></button>
							<button id="next_month" class="btn btn-default btn-sm" data-tooltip="tooltip" title="Next month" data-month="<?php echo date('Y-m',strtotime("+1 month")); ?>"><i class="fa fa-angle-right"></i></button>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 check_week">
							<div class="form-group">
								<?php 
									$current_week = strtotime('W');
									$last_week = $current_week - 604800;
									$next_week = $current_week + 604800;
								?>
								<button data-tooltip="tooltip" title="Last week" class="btn btn-default btn-sm" data-week="<?php echo $last_week; ?>" id="last_week"><i class="fa fa-angle-left"></i></button>
								<button class="btn btn-default btn-sm" id="current_week" data-week="<?php echo $current_week; ?>" data-tooltip="tooltip" title="Current week"><i class="fa fa-clock-o"></i> Week <?php echo date('W'); ?></button>
								<button data-tooltip="tooltip" title="Next week" class="btn btn-default btn-sm" data-week="<?php echo $next_week; ?>" id="next_week"><i class="fa fa-angle-right"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 text-center month-title">
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-4">
							<div class="form-group">
								<span class="btn btn-default btn-sm" id="all"><i class="fa fa-adn"></i> All</span>
								<span class="btn btn-success btn-sm" id="done"><i class="fa fa-check-square-o"></i> Done</span> 
								<span class="btn btn-warning btn-sm" id="doing"><i class="fa fa-angle-double-right"></i> Doing</span> 
								<span class="btn btn-danger btn-sm" id="error"><i class="fa fa-exclamation-triangle"></i> Error</span>
							</div>
						</div>
						<?php 
							echo $this->Form->create('Task', $options = array(
								'inputDefaults' => array(
									'class' => 'form-control input-sm',
									'label' => false,
									'div' => array(
										'class' => 'form-group'
									)
								)
							));
						?>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<?php 
										echo $this->Form->input('project_id', $options = array(
											'empty' => 'Select project',
											'class' => 'form-control project-list input-sm'
										));
									?>	
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<?php 
										echo $this->Form->input('role_id', $options = array(
											'empty' => 'Select group',
											'class' => 'form-control group-list input-sm'
										));
									?>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<?php 
										foreach ($users as $key => $u) {
											$user[$u['User']['id']] = $u['User']['name'];
										}
										echo $this->Form->input('user_id', $options = array(
											'empty' => 'Select user',
											'class' => 'form-control select-user input-sm',
											'label' => false,
											'options' => $user,
											'div' => array(
												'class' => 'form-group'
											)
										));
									?>
								</div>
							</div>
						</div>
						<?php 
							echo $this->Form->end($options = null);
						?>
					</div>
				</div>
			</div>
			<div class="table-responsive scroll-table">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="name-full">Name/Date</td>
							<?php 
								for($i=$start_time; $i<$end_time; $i+=86400){ 
									$list = date('Y-m-d', $i);
									$day = date('D', $i);
									$today = date('Y-m-d');
									if($day == 'Sun'){
										$bgcolor = 'rgba(217,83,79,0.5)';
										$color = '#fff';
									}elseif ($day == 'Sat') {
										$bgcolor = 'rgba(216,151,31,0.5)';
										$color = '#fff';
									}elseif ($today == $list) {
										$bgcolor = '#eee';
										$color = '#000';
									}else{
										$bgcolor = '#fff';
										$color = '#000';
									}
									if(strtotime($list) >= $monday && strtotime($list) <= $sunday){
										$classday = 'curent_week';
									}else{
										$classday = 'other_week';
									}

									if(strtotime($list) < $monday){
										$classleft = 'left-day'; 
									}else{
										$classleft = '';
									}
							?>
							<td class="date-full <?php echo $classday.' '.$classleft; ?>" style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>">
								<?php echo $list; ?><br>
							</td>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($users as $key => $u) { 
						?>
						<tr class="user-name user-<?php echo $u['User']['id']; ?> group-<?php echo $u['User']['role_id']; ?>">
							<td style="color: #fff;" bgcolor="<?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?> <span><small><?php echo count($u['Task']); ?></small></span></td>
							<?php 
								for($i=$start_time; $i<$end_time; $i+=86400){ 
									$list = date('Y-m-d', $i);
									$day = date('D', $i);
									$today = date('Y-m-d');
									if($day == 'Sun'){
										$bgcolor = 'rgba(217,83,79,0.5)';
										$color = '#fff';
									}elseif ($day == 'Sat') {
										$bgcolor = 'rgba(216,151,31,0.5)';
										$color = '#fff';
									}elseif ($today == $list) {
										$bgcolor = '#eee';
										$color = '#000';
									}else{
										$bgcolor = '#fff';
										$color = '#000';
									}
									$start_day = $list.' 00:00:00';
									$end_date = $list.' 23:59:00';
									if(strtotime($list) >= $monday && strtotime($list) <= $sunday){
										$classday = 'curent_week';
									}else{
										$classday = 'other_week';
									}
							?>
							<td style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>" class="<?php echo $day.' '.$classday; ?>">
								<div class="task-name">
									<?php if($day != 'Sun' && $day != 'Sat'){ ?>
										<?php
											if($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 7 || $this->Session->read('Auth.User.role_id') == 8 || $this->Session->read('Auth.User.id') == $u['User']['id'] || $this->Session->read('Auth.User.id') == 16 || $this->Session->read('Auth.User.id') == 12){
										?>
										<a href="#add-task" data-toggle="modal" data-user="<?php echo $u['User']['id']; ?>" data-date="<?php echo $list; ?>" data-user-name="<?php echo $u['User']['name']; ?>" class="add-task-td"><i class="fa fa-plus"></i></a>
										<?php } ?>
									<?php } ?>
									<?php 
										foreach ($u['Task'] as $key => $t) {
											$start = strtotime($t['start']);
											$end = strtotime($t['end']);
											if($end >= strtotime($start_day) && $start <= strtotime($end_date)){
												if(count($t['Error']) > 0){
													$status = 'Error';
													$bgcolor = '#d9534f';
													$class = 'error';
												} else {
													if ($t['status'] == 0 ) { 
														$status = 'Doing'; 
														$bgcolor = '#f0ad4e'; 
														$class = 'doing';
													} elseif ($t['status'] == 2) {
														$status = 'Error';
														$bgcolor = '#d9534f';
														$class = 'error';
													} else { 
														$status = 'Done'; 
														$bgcolor = '#449d44'; 
														$class = 'done';
													}
												}
												$project = $this->Html->link($t['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $t['Project']['id'], 'slug' => Inflector::slug($t['Project']['title'], $replacement = '-')));
												echo '<div class="task-row task-row-'.$class.' project-'.$t['Project']['id'].'" style="background: '.$bgcolor.'"><small><a href="javascript:void(0)" data-toggle="popover" title="'.$t['title'].'" data-content="User: '.$u['User']['name'].'<br>Project: '.$t['Project']['title'].'<br>Start time: '.$t['start'].'<br>End time: '.$t['end'].'<br>Status: '.$status.'"><i class="fa fa-list-ol"></i> '.$t['title'].'</a><br><i class="fa fa-th-list"></i> '.$project.'</small></div>';
											}
										}
									?>
								</div>
							</td>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="list-view">
			<div class="row" id="filter-tasks">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<?php 	
						echo $this->Form->input('project_id', $options = array(
							'class' => 'form-control select_project input-sm',
							'label' => false,
							'empty' => __d('croogo', 'Select project')
						));
					?>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<?php 
						echo $this->Form->input('role_id', $options = array(
							'empty' => 'Select group', 
							'class' => 'form-control group-list input-sm'
						));
					?>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<?php 	
						foreach ($users as $key => $u) {
							$user[$u['User']['id']] = $u['User']['name'];
						}
						echo $this->Form->input('user_id', $options = array(
							'class' => 'form-control select_user input-sm select-user',
							'label' => false,
							'empty' => __d('croogo', 'Select user'),
							'options' => $user
						));
					?>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<?php 
						$status = array(0 => __d('croogo', 'Doing'), 1 => __d('croogo', 'Done'), 2 => __d('croogo', 'Error'));	
						echo $this->Form->input('status', $options = array(
							'class' => 'form-control select_status input-sm',
							'label' => false,
							'empty' => __d('croogo', 'Select status'),
							'options' => $status
						));
					?>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Task'); ?></th>
							<th><?php echo __d('croogo', 'Project'); ?></th>
							<th class="col-lg-2"><?php echo __d('croogo', 'User'); ?></th>
							<th class="col-lg-2"><?php echo __d('croogo', 'Start'); ?></th>
							<th class="col-lg-2"><?php echo __d('croogo', 'End'); ?></th>
							<th><?php echo __d('croogo', 'Status'); ?></th>
							<th><?php echo __d('croogo', 'Errors'); ?></th>
							<?php if($this->Session->read('Auth.User.role_id') == 1){ ?>
							<th>Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody class="load">
						<?php foreach ($tasks as $key => $task) { ?>
						<tr class="tr<?php echo $task['Task']['id']; ?>">
							<td><?php echo $key+1; ?></td>
							<td>
								<?php echo $task['Task']['title']; ?>
							</td>
							<td>
								<?php 
									echo $this->Html->link($task['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $task['Project']['id'], 'slug' => Inflector::slug($task['Project']['title'], $replacement = '-')), array('target' => '_blank'));
								?>
							</td>
							<td>
								<?php echo $task['User']['name']; ?>
							</td>
							<td>
								<?php echo $task['Task']['start']; ?>
							</td>
							<td>
								<?php echo $task['Task']['end']; ?>
							</td>
							<td class="col-xs-2 col-lg-1">
								<?php 
									echo $this->Form->create('Task', $options = array(
										'url' => array(
											'controller' => 'tasks',
											'action' => 'change_status',
											$task['Task']['id']
										),
										'class' => 'edit_form'
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
										$class = 'btn btn-warning';
									}elseif ($task['Task']['status'] == 1) {
										$class = 'btn btn-success';
									}else{
										$class = 'btn-danger';
									}
									if(count($tasks[$key]['Error']) > 0){
										$value = 2;
										$class = 'btn-danger';
									}else{
										$value = $task['Task']['status'];
									}
									echo $this->Form->input('status', $options = array(
										'label' => false,
										'class' => 'form-control btn '.$class.' btn-sm input-sm confirm',
										'value' => $value,
										'options' => $status,
										'disabled' => $disable,
										'taskid' => $task['Task']['id']
									));
									echo $this->Form->end($options = null);
								?>
							</td>
							<td>
								<?php 
									if (count($tasks[$key]['Error']) > 0) {
										if($task['Task']['user_id'] == $this->Session->read('Auth.User.id')){
											echo $this->Html->link(count($tasks[$key]['Error']), array('controller' => 'errors', 'action' => 'my_errors'), array('class' => 'btn btn-danger btn-sm'));
										}else{
											echo '<span class="btn btn-default btn-sm">'.count($tasks[$key]['Error']).'</span';
										}
									}else{
										echo '<span class="btn btn-default btn-sm">'.count($tasks[$key]['Error']).'</span';
									}
								?>
							</td>
							<?php if($this->Session->read('Auth.User.role_id') == 1){ ?>
							<td>
								 <?php 
								 	echo $this->Form->create('Task', $options = array(
								 		'url' => array(
								 			'action' => 'delete',
								 			$task['Task']['id']
								 		),
								 		'class' => 'delete-task',
								 		'taskid' => $task['Task']['id']
								 	));
								 	echo $this->Form->input('id', $options = array(
								 		'value' => $task['Task']['id']
								 	));
								 	echo $this->Form->button('<i class="fa fa-trash-o"></i>', $options = array(
								 		'class' => 'btn btn-danger btn-sm delete_task',
								 		'escape' => false,
								 		'title' => 'Delete',
								 		'data-tooltip' => 'tooltip',
								 	));
								 	echo $this->Form->end($options = null);
								 ?>
							</td>
							<?php } ?>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="9">
								<div class="text-center">
									<ul class="pagination pagination-sm" id="tasks-pagination">
									<?php 
										$total_pages = ceil($total_tasks/10);
										for ($i=1; $i <= $total_pages; $i++) { 
									?>
									<li <?php if($i == 1){ echo 'class="active"';} ?> data-page="<?php echo $i; ?>" data-project="" data-group="" data-user="" data-status=""><a href="javascript: void(0)"><?php echo $i; ?></a></li>
									<?php
										}
									?>
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tab">
			<div id="calendar"></div>
		</div>
		<!-- Statistical tab -->
		<div role="tabpanel" class="tab-pane" id="statistical">
			<div class="statistical">
				<?php 
					echo $this->Form->create('Task', $options = array(
						'inputDefaults' => array(
							'div' => array(
								'class' => 'form-group'
							),
							'label' => false
						),
						'class' => 'navbar-form navbar-left',
						'type' => 'GET'
					));
					echo $this->Form->input('month', $options = array(
						'class' => 'form-control month input-sm stat-month',
						'type' => 'text',
						'value' => date('Y-m')
					));
					echo $this->Form->button('Filter', $options = array(
						'class' => 'btn btn-info btn-sm'
					));
					echo $this->Form->end($options = null);
				?>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th class="col-lg-1 text-center">#</th>
							<th class="col-lg-2 col-md-3 col-sm-4 col-xs-5">Name</th>
							<th class="text-center">All tasks</th>
							<th class="text-center">Done</th>
							<th class="text-center">Doing</th>
							<th class="text-center">Error</th>
						</tr>
					</thead>
					<tbody class="load_stat_month">
						<?php 
							foreach ($users as $key => $u) { 
						?>
						<tr>
							<td class="text-center"><?php echo $key+1; ?></td>
							<td style="color: #fff; background: <?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?></td>
							<td class="text-center">
								<?php if(count($u['Task']) != 0){ ?>
								<a class="btn btn-default btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="" data-month="<?php echo date('Y-m'); ?>"><?php echo count($u['Task']); ?></a>
								<?php }else{ ?>
								<span class="btn btn-default btn-sm disabled"><?php echo count($u['Task']); ?></span>
								<?php } ?>
							</td>
							<td class="text-center">
								<?php 
									$done = 0;
									$doing = 0;
									$error = 0;
									foreach ($u['Task'] as $key => $t) {
										if($t['status'] == 1){
											$done += count($t['id']);
										}elseif ($t['status'] == 0) {
											$doing += count($t['id']);
										}else{
											$error += count($t['id']);
										}
									}
									if($done != 0){
								?>
								<a class="btn btn-success btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="1" data-month="<?php echo date('Y-m'); ?>"><?php echo $done; ?></a>
								<?php
									}else{
										echo '<span class="btn btn-success btn-sm disabled">'.$done.'</span>';
									}
								?>
							</td>
							<td class="text-center">
								<?php if($doing != 0){ ?>
								<a class="btn btn-warning btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="0" data-month="<?php echo date('Y-m'); ?>"><?php echo $doing; ?></a>
								<?php }else{ echo '<span class="btn btn-warning btn-sm disabled">'.$doing.'</span>'; } ?>
							</td>
							<td class="text-center">
								<?php if($error != 0){ ?>
								<a class="btn btn-danger btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="2" data-month="<?php echo date('Y-m'); ?>"><?php echo $error; ?></a>
								<?php }else{ echo '<span class="btn btn-danger btn-sm disabled">'.$error.'</span>'; } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- POPUP CALENDAR VIEW -->
<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-info"><a id="eventUrl" target="_blank"><?php echo __d('croogo', 'More').' <i class="fa fa-angle-double-right"></i>' ?></a></button>
            </div>
        </div>
    </div>
</div>
<!-- POPUP ADD TASK -->
<div class="modal fade in" id="add-task">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add task to <span class="user-name-task"></span></h4>
			</div>
			<div class="modal-body">
				<?php if($this->Session->read('Auth.User.role_id') != 0) { ?>
				<?php 
					echo $this->Form->create('Task', $options = array(
						'url' => array(
							'action' => 'add'
						),
						'inputDefaults' => array(
							'class' => 'form-control',
							'label' => false,
							'div' => array(
								'class' => 'form-group'
							)
						)
					));
					echo $this->Form->input('project_id', $options = array(
						'empty' => 'Select project',
						'required' => true
					));
					foreach ($users as $key => $u) {
						$user[$u['User']['id']] = $u['User']['name'];
					}
					echo $this->Form->input('user_id', $options = array(
						'required' => true,
						'empty' => 'Select user',
						'options' => $user,
						//'disabled' => true,
						'class' => 'form-control user_id hidden'
					));
					echo $this->Form->input('title', $options = array(
						'required' => true,
						'placeholder' => 'Task name'
					));
					echo $this->Form->input('body', $options = array(
						'required' => true,
						'placeholder' => 'Task detail'
					));
					echo $this->Form->input('url', $options = array(
						'placeholder' => 'Page url'
					));
					echo $this->Form->input('start', $options = array(
						'required' => true,
						'class' => 'form-control datetime start_time',
						'type' => 'text',
						'label' => 'Start time'
					));
					echo $this->Form->input('end', $options = array(
						'required' => true,
						'class' => 'form-control datetime end_time',
						'type' => 'text',
						'label' => 'End time'
					));
				?>
				<?php }else{ echo 'Please login to add task!'; } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<?php if($this->Session->read('Auth.User.role_id') != 0) { ?>
				<?php 
					echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', $options = array(
						'class' => 'btn btn-info submit_task'
					));
					echo $this->Form->end($options = null);
				?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- View task of user -->
<div class="modal fade" id="view-task-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="get_username">Modal title</h4>
			</div>
			<div class="modal-body" id="view_task_user">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="loading-tasks"></div>
<!-- Script -->
<script>
	$(document).ready(function() {
		$('a[href="#tab"]').on('shown.bs.tab', function (e) {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listWeek'
				},
				navLinks: true, // can click day/week names to navigate views
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: {
					url: '<?php echo Router::url(array('plugin'=>'managers','controller'=>'tasks', 'action'=>'index', '1.json'), true); ?>',
					error: function() {
						$('#script-warning').show();
					}
				},
				eventRender: function(event, element) {
			      	$(element).tooltip({title: '<p class="text-left">'+event.title+"<br><i class='fa fa-user'></i> "+event.user+"<br><?php echo __d('croogo', 'From'); ?>: "+event.bd+"<br><?php echo __d('croogo', 'To'); ?>: "+event.stop+'<p>',container: "body", html: true});  
			      	element.find('.fc-title').append("<br/><i class='glyphicon glyphicon-th-list'></i> "+event.project+"<br/><i class='fa fa-user'></i> " + event.user);           
			  	},
			  	eventClick:  function(event, jsEvent, view) {
		            $('#modalTitle').html(event.title);
		            $('#modalBody').html(event.body+'<br><i class="fa fa-user"></i> '+event.user+'<br><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'Start time') ?>: '+event.bd+'<br><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'Start time') ?>: '+event.stop);
		            $('#eventUrl').attr('href',event.url);
		            $('#fullCalModal').modal();
		            return false;
		        }
			});
		});
		// Get data by week or month
		var numbers_td_left = $('.left-day').length;
		var left_td_width = $('.left-day').outerWidth();
		var width = numbers_td_left*left_td_width;
		// Filter by week
		$('body').on('click', '.check_week button', function () {
			$('.loading-tasks').fadeIn('slow');
			var id = $(this).attr('id');
			var week = parseInt($(this).attr('data-week'));
			if(id == 'last_week'){
			 	$(this).attr('data-week', week - 604800);
			 	$('#next_week').attr('data-week', week + 604800);
			} else if (id == 'next_week'){
				$(this).attr('data-week', week + 604800);
				$('#last_week').attr('data-week', week - 604800);
			} else {
			 	$('#next_week').attr('data-week', week + 604800);
			 	$('#last_week').attr('data-week', week - 604800);
			}
			$.ajax({
				url: '/calendar/managers/tasks/tasks_by_week/',
				method: 'GET',
				data: { week : week },
				dataType: "html",
				success: function(result){
	                $(".scroll-table").html(result);
	            }
			});
			setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
		});
		// Filter tasks by month
		$('body').on('click', '.check_month button', function () {
			$('.loading-tasks').fadeIn('slow');
			var id = $(this).attr('id');
			var month = $(this).attr('data-month');
			var myDate = new Date(month);  
			//alert(myDate);
			if(id == 'last_month'){
				var last_month = new Date(myDate.setMonth(myDate.getMonth() - 1));
				//var last_month = <?php echo date('Y-m', strtotime($month . "-1 months") ); ?>;
				var next_month = new Date(myDate.setMonth(myDate.getMonth() + 2));
				$(this).attr('data-month', last_month);
				$('#next_month').attr('data-month', next_month);
				var get_month = new Date(myDate.setMonth(myDate.getMonth() - 1));
			} else if (id == 'next_month'){
				var next_month = new Date(myDate.setMonth(myDate.getMonth() + 1));
				var last_month = new Date(myDate.setMonth(myDate.getMonth() - 2));
				$(this).attr('data-month', next_month);
				$('#last_month').attr('data-month', last_month);
				var get_month = new Date(myDate.setMonth(myDate.getMonth() + 1));
			} else {
				var last_month = new Date(myDate.setMonth(myDate.getMonth() - 1));
				var next_month = new Date(myDate.setMonth(myDate.getMonth() + 2));
				$('#last_month').attr('data-month', last_month);
				$('#next_month').attr('data-month', next_month);
				var get_month = new Date();
			}
			$.ajax({
				url: '/calendar/managers/tasks/tasks_by_month/',
				method: 'GET',
				data: { get_month : get_month },
				dataType: "html",
				success: function(result){
	                $(".scroll-table").html(result);
	            }
			});
			setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
		});
		// Pagination tasks
		$('body').on('click', '#tasks-pagination li', function () {
			$('.loading-tasks').fadeIn('slow');
			var page = $(this).attr('data-page'); 
			var project_id = $(this).attr('data-project');
			var role_id = $(this).attr('data-group');
			var user_id = $(this).attr('data-user');
			var status = $(this).attr('data-status');
			//alert(page);
			$.ajax({
	            url: "/calendar/managers/tasks/pagination/", 
	            method: "GET",
	            data: { page : page, project_id : project_id, role_id : role_id, user_id : user_id, status : status},
	            dataType: "html",
	            success: function(result){
	                $(".load").html(result);
	                $('#tasks-pagination li').attr('data-project', project_id);
	                $('#tasks-pagination li').attr('data-group', role_id);
	                $('#tasks-pagination li').attr('data-user', user_id);
	                $('#tasks-pagination li').attr('data-status', status);
	            }
	        });
	        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
	        $('#tasks-pagination li').removeClass('active');
	        $(this).addClass('active');
		});
		// View tasks of user
		$('body').on('click', '.view-task-user', function () {
			var user_id = $(this).attr('data-userid');
			var user_name = $(this).attr('data-username');
			var status = $(this).attr('data-status');
			var thang = $(this).attr('data-month');
			//alert(user_id);
			$.ajax({
	            url: "/calendar/managers/tasks/view_task_user/", 
	            method: "GET",
	            data: { user_id : user_id, status : status, thang: thang},
	            dataType: "html",
	            success: function(result){
	                $("#view_task_user").html(result);
	            }
	        });
	        $('#get_username').text(user_name);
		});
		// Add task ajax
		var frm = $('#TaskAddForm');
	    var submit = $('.submit_task');  // submit button
	    frm.submit(function (ev) {
	    	$('.loading-tasks').fadeIn('slow');
	        $.ajax({
	            type: frm.attr('method'),
	            url: frm.attr('action'),
	            dataType: 'html',
	            data: frm.serialize(),
	            success: function (data) {
	                frm.trigger('reset'); // reset form
	                $('.load_doing_task').load('# .load_doing_task tr');
	                $('.scroll-table').load('# .scroll-table table');
	                $('.load_stat_month').load('# .load_stat_month tr');
	                $('#add-task').modal('hide');
	                $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Created your task success!</strong></div>');
	                $("#calendar").fullCalendar("refetchEvents");
	            },
	            error: function(data){
			        $('.scroll-table').load('# .scroll-table table');
			        $('#add-task').modal('hide');
			    }
	        });
	        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
	        setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
	        ev.preventDefault();
	    });
	    // Staticial by month
	    $('body').on('submit', '#TaskIndexForm', function (v) {
	    	$('.loading-tasks').fadeIn('slow');
	    	var thang = $(this).find('.stat-month').val();
	    	$.ajax({
	    		method: 'GET',
	    		url: '/calendar/managers/tasks/statmonth/',
	    		data: { thang : thang},
	    		dataType: 'html',
	    		success: function (data) {
	    			$('.load_stat_month').html(data);
	    		}
	    	});
	    	setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
	    	v.preventDefault();
	    });
	});
</script>