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
			?>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<?php 
						echo $this->Form->create('Task', $options = array(
							'inputDefaults' => array(
								'class' => 'form-control input-sm',
								'label' => false,
								'div' => array(
									'class' => 'form-group'
								)
							),
							'url' => array(
								'plugin' => 'managers',
								'controller' => 'tasks',
								'action' => 'month'
							),
							'type' => 'GET',
							//'class' => 'navbar-form navbar-left'
						));
					?>
					<div class="row">
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<?php 
								echo $this->Form->input('thang', $options = array(
									'value' => date('Y-m'),
									'class' => 'form-control month input-sm'
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<?php 
									echo $this->Form->button('<i class="fa fa-search"></i> Filter', $options = array(
										'class' => 'btn btn-default btn-sm'
									));
								?>
							</div>
						</div>
						<?php
							echo $this->Form->end($options = null);
						?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 text-center month-title">
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
							<?php 
								echo $this->Form->input('project_id', $options = array(
									'empty' => 'Select project',
									'class' => 'form-control project-list input-sm'
								));
							?>	
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
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
							?>
							<td class="date-full" style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>">
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
							<td style="color: #fff;" bgcolor="<?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?></td>
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
							?>
							<td style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>" class="<?php echo $day; ?>">
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
												if ($t['status'] == 0) { 
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
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php 	
						echo $this->Form->input('project_id', $options = array(
							'class' => 'form-control select_project input-sm',
							'label' => false,
							'empty' => __d('croogo', 'Select project')
						));
					?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php 	
						foreach ($users as $key => $u) {
							$user[$u['User']['id']] = $u['User']['name'];
						}
						echo $this->Form->input('user_id', $options = array(
							'class' => 'form-control select_user input-sm',
							'label' => false,
							'empty' => __d('croogo', 'Select user'),
							'options' => $user
						));
					?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'Start'); ?></th>
							<th><?php echo __d('croogo', 'End'); ?></th>
							<th><?php echo __d('croogo', 'Status'); ?></th>
							<th><?php echo __d('croogo', 'Errors'); ?></th>
						</tr>
					</thead>
					<tbody class="load">
						<?php //pr($tasks); die(); ?>
						<?php foreach ($tasks as $key => $task) { ?>
						<tr>
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
										'disabled' => $disable
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
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="text-center">
				<ul class="pagination"><?php echo $this->Paginator->numbers(); ?></ul>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tab">
			<div id="calendar"></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
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
		//$('#calendar').fullCalendar('render');
	});
</script>
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
						'class' => 'btn btn-info'
					));
					echo $this->Form->end($options = null);
				?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="loading-tasks"></div>