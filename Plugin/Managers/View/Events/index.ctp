<a class="btn btn-info btn-sm" data-toggle="modal" href='#add-event'><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'Add event'); ?></a>
<a class="btn btn-warning btn-sm" data-toggle="modal" href='#waiting'><i class="glyphicon glyphicon-retweet"></i> <?php echo __d('croogo', 'Waiting confirm'); ?></a>
<a class="btn btn-danger btn-sm" data-toggle="modal" href='#deny'><i class="glyphicon glyphicon-lock"></i> <?php echo __d('croogo', 'Deny'); ?></a>
<a class="btn btn-success btn-sm" data-toggle="modal" href='#birthday'><i class="glyphicon glyphicon-gift"></i> <?php echo __d('croogo', 'Birthday of month'); ?></a>
<a class="btn btn-default btn-sm" data-toggle="modal" href='#stat'><i class="glyphicon glyphicon-stats"></i> <?php echo __d('croogo', 'Statistical'); ?></a>
<hr>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#event-calendar" aria-controls="event-calendar" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Calendar'); ?></a>
		</li>
		<li role="presentation">
			<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Events list'); ?></a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="event-calendar">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="form-group">
					<?php 
						foreach ($roles as $key => $r) {
							$role[$r['Role']['id']] = $r['Role']['title'];
					?>
					<button class="btn btn-sm" id="group-<?php echo $r['Role']['id'] ?>" style="background: <?php echo $r['Role']['color']; ?>; color: #fff;"><i class="<?php echo $r['Role']['icon']; ?>"></i> <?php echo $r['Role']['title']; ?></button>
					<?php
						}
					?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">	
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<?php 
								$status = array(
									0 => 'Wating confirm',
									1 => 'Confirmed',
									2 => 'Deny'
								);
								echo $this->Form->input('status', $options = array(
									'label' => false,
									'empty' => 'Select status',
									'class' => 'form-control input-sm',
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $status
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<?php 
								$types = array(
									1 => 'Full day',
									2 => 'Half day',
									3 => 'Later',
									4 => 'Early'
								);
								echo $this->Form->input('type', $options = array(
									'label' => false,
									'empty' => 'Select type',
									'class' => 'form-control input-sm select-type',
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $types
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<?php 
								echo $this->Form->input('role_id', $options = array(
									'label' => false,
									'empty' => 'Select group',
									'class' => 'form-control input-sm group-list',
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $role
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<?php 
								echo $this->Form->input('user_id', $options = array(
									'label' => false,
									'empty' => 'Select user',
									'class' => 'form-control input-sm select-user',
									'div' => array(
										'class' => 'form-group'
									)
								));
							?>
						</div>
					</div>
				</div>
			</div>
			<div id="calendar"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tab">
			<div class="filter-events-ajax" data-page="1">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							echo $this->Form->input('role_id', $options = array(
								'label' => false,
								'class' => 'form-control input-sm group-list',
								'empty' => 'Select group',
								'div' => array(
									'class' => 'form-group'
								),
								'options' => $role,
							));
						?>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							echo $this->Form->input('user_id', $options = array(
								'label' => false,
								'class' => 'form-control input-sm select-user',
								'empty' => 'Select user',
								'div' => array(
									'class' => 'form-group'
								)
							));
						?>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							$types = array(
								1 => 'Full day',
								2 => 'Half day',
								3 => 'Later',
								4 => 'Early'
							);
							echo $this->Form->input('type', $options = array(
								'label' => false,
								'class' => 'form-control input-sm',
								'empty' => 'Select type',
								'div' => array(
									'class' => 'form-group'
								),
								'options' => $types
							));
						?>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							$status = array(
								0 => 'Waiting confirm',
								1 => 'Confirmed',
								2 => 'Denied'
							);
							echo $this->Form->input('status', $options = array(
								'label' => false,
								'class' => 'form-control input-sm',
								'empty' => 'Select status',
								'div' => array(
									'class' => 'form-group'
								),
								'options' => $status
							));
						?>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Title'); ?></th>
						<th><?php echo __d('croogo', 'User'); ?></th>
						<th><?php echo __d('croogo', 'Start'); ?></th>
						<th><?php echo __d('croogo', 'End'); ?></th>
						<th><?php echo __d('croogo', 'Type'); ?></th>
						<th class="col-lg-1"><?php echo __d('croogo', 'Status'); ?></th>
					</tr>
				</thead>
				<tbody class="load_pagination">
					<?php foreach ($events as $key => $event) { ?>
					<tr id="event<?php echo $event['Event']['id']; ?>">
						<td><?php echo $key+1; ?></td>
						<td>
							<?php 
								echo $this->Html->link($event['Event']['title'], array('controller' => 'events', 'action' => 'view', 'id' => $event['Event']['id'], 'slug' => Inflector::slug($event['Event']['title'], $replacement = '-')), array('data-tooltip' => 'tooltip', 'title' => '<p class="text-left">'.$event['Event']['body'].'</p>'));
							?>
						</td>
						<td><?php echo $event['User']['name']; ?></td>
						<td><?php echo $event['Event']['start']; ?></td>
						<td><?php echo $event['Event']['end']; ?></td>
						<td>
							<?php 
								if ($event['Event']['type'] == 1) {
									echo __d('croogo', 'Full day');
								}elseif ($event['Event']['type'] == 2) {
									echo __d('croogo', 'Hafl day');
								}elseif ($event['Event']['type'] == 3) {
									echo __d('croogo', 'Later');
								}else{
									echo __d('croogo', 'Early');
								}
							?>
						</td>
						<td>
							<?php 
								// Button color of status
								if ($event['Event']['status'] == 0) {
									$class = 'btn btn-warning btn-sm';
								}elseif ($event['Event']['status'] == 1) {
									$class = 'btn btn-success btn-sm';
								}else{
									$class = 'btn btn-danger btn-sm';
								}
								// Disabled of user role
								if($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 7 || $this->Session->read('Auth.User.role_id') == 8){
									$disabled = '';
								}else{
									$disabled = 'disabled';
								}
							?>
							<?php 
								echo $this->Form->create('Event', $options = array(
									'url' => array(
										'action' => 'confirm',
										$event['Event']['id']
									),
									'class' => 'confirm-events'
								));
								echo $this->Form->input('id', $options = array(
									'value' => $event['Event']['id']
								));
								$status = array(
									0 => 'Waiting',
									1 => 'Confirmed',
									2 => 'Denied'
								);
								echo $this->Form->input('status', $options = array(
									'value' => $event['Event']['status'],
									'label' => false,
									'class' => 'form-control input-sm '.$class.' confirm-input',
									'options' => $status,
									'disabled' => $disabled,
									'div' => array(
										'class' => 'form-group'
									),
									'eventid' => $event['Event']['id']
								));
								echo $this->Form->end($options = null);
							?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="7" class="text-center">
							<ul class="pagination pagination-sm" id="pagination-events">
								<?php 
									$count = ceil(count($calendar_events)/10);
								?>
								<li><a href="javascript:void(0)" data-page="1" data-group="" data-user="" data-type="" data-status="" class="hidden prev">&laquo;</a></li>
								<?php for ($i = 1; $i <= $count; $i++){ ?>
								<li <?php if($i==1){ echo 'class="active"';} ?>><a href="javascript:void(0)" data-page="<?php echo $i; ?>" data-group="" data-user="" data-type="" data-status="" class="normal"><?php echo $i; ?></a></li>
								<?php } ?>
								<li><a href="javascript:void(0)" data-page="2" data-group="" data-type="" data-status="" data-user="" class="next">&raquo;</a></li>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Popup add event -->
<div class="modal fade" id="add-event">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Add event'); ?></h4>
			</div>
			<div class="modal-body">
				<?php 
					if($this->Session->read('Auth.User.id') != NULL){
						echo $this->Form->create('Event', $options = array(
							'url' => array(
								'controller' => 'events',
								'action' => 'add'
							),
							'inputDefaults' => array(
								'class' => 'form-control',
								'label' => false,
								'div' => array('class' => 'form-group')
							)
						));
						$types = array(
							1 => __d('croogo', 'Full day'),
							2 => __d('croogo', 'Half day'),
							3 => __d('croogo', 'Later'),
							4 => __d('croogo', 'Early'),
						);
						echo $this->Form->input('type', $options = array(
							'empty' => __d('croogo', 'Select type'),
							'required' => true,
							'options' => $types
						));
						echo $this->Form->input('title', $options = array(
							'placeholder' => __d('croogo', 'Please enter title'),
							'required' => true
						));
						echo $this->Form->input('body', $options = array(
							'placeholder' => __d('croogo', 'Please enter reason'),
							'required' => true
						));
						echo $this->Form->input('start', $options = array(
							'class' => 'form-control datetime',
							'type' => 'text',
							'value' => date('Y-m-d 08:00'),
							'required' => true,
							'label' => __d('croogo', 'From time')
						));
						echo $this->Form->input('end', $options = array(
							'class' => 'form-control datetime',
							'type' => 'text',
							'value' => date('Y-m-d 17:30'),
							'required' => true,
							'label' => __d('croogo', 'To time')
						));
						echo $this->Form->input('vacation', $options = array(
							'type' => 'checkbox',
							'label' => __d('croogo', 'Using vacation day'),
							'div' => array('class' => 'form-group vacation'),
							'class' => null
						));
					}else{
						echo __d('croogo', 'Please login to add event');
					}
				?>
			</div>
			<div class="modal-footer">
				<?php 
					if($this->Session->read('Auth.User.id') != NULL){
						echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Save'), $options = array(
							'class' => 'btn btn-info btn-sm'
						));
						echo $this->Form->end($options = null);
					}else{
				?>
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
<!-- Popup waiting events-->
<div class="modal fade" id="waiting">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Waiting confirm list'); ?></h4>
			</div>
			<div class="modal-body">
				<?php if (!empty($waitings)) { ?>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Title'); ?></th>
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'Type'); ?></th>
							<th><?php echo __d('croogo', 'Start'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($waitings as $key => $w) { ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td>
								<?php 
									echo $this->Html->link($w['Event']['title'], array('controller' => 'events', 'action' => 'view', 'id' => $w['Event']['id'], 'slug' => Inflector::slug($w['Event']['title'], $replacement = '-')), array('data-tooltip' => 'tooltip', 'title' => '<p class="text-left">'.$w['Event']['body'].'</p>'));
								?>
							</td>
							<td><?php echo $w['User']['name']; ?></td>
							<td>
								<?php 
									if ($w['Event']['type'] == 1) {
										echo '<span class="btn btn-danger btn-xs">'.__d('croogo', 'Full day').'</span>';
									}elseif ($w['Event']['type'] == 2) {
										echo '<span class="btn btn-warning btn-xs">'.__d('croogo', 'Half day').'</span>';
									}elseif ($w['Event']['type'] == 3) {
										echo '<span>'.__d('croogo', 'Later').'</span>';
									}else{
										echo '<span class="btn btn-success btn-xs">'.__d('croogo', 'Early').'</span>';
									}
								?>
							</td>
							<td><?php echo $w['Event']['start']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php 
					echo $this->Html->link('<i class="fa fa-angle-double-right"></i> '.__('More'), array('controller' => 'events', 'action' => 'waiting'), array('class' => 'btn btn-info btn-sm', 'escape' => false));
				?>
			</div>
		</div>
	</div>
</div>
<!-- Popup deny events-->
<div class="modal fade" id="deny">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Deny events list'); ?></h4>
			</div>
			<div class="modal-body">
				<?php if(!empty($denies)){ ?>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Title'); ?></th>
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'Confirmer'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($denies as $key => $deny) { ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $deny['Event']['title']; ?></td>
							<td><?php echo $deny['User']['name']; ?></td>
							<td><?php echo $deny['Confirmer']['name']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php }else{ echo __d('croogo', "Don't have events!"); } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>
<!-- Popup birthday-->
<div class="modal fade" id="birthday">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Birthday of month'); ?></h4>
			</div>
			<div class="modal-body">
				<?php 
					$birthdays = json_decode($json_birthday);
					if(!empty($birthdays)){
				?>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'User'); ?></th>
							<th><?php echo __d('croogo', 'Birthday'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($birthdays as $key => $b) {
						?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $b->user; ?></td>
							<td><?php echo $b->birthday; ?></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				<?php 
					}else{
						echo __d('croogo', "Don't have birthday on this month!");
					}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>
<!-- Popup stat -->
<div class="modal fade" id="stat">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Statistical'); ?></h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->Form->create('Event', $options = array(
						'url' => array(
							'controller' => 'events',
							'action' => 'month'
						),
						'type' => 'GET',
						'inputDefaults' => array(
							'div' => array('class' => 'form-group'),
							'label' => false,
							'class' => 'form-control'
						)
					));
					echo $this->Form->input('thang', $options = array(
						'type' => 'text',
						'class' => 'form-control month',
						'value' => date('Y-m'),
						'label' => __d('croogo', 'Input month'),
						'required' => true
					));
					echo $this->Form->input('user_id', $options = array(
						'empty' => __d('croogo', 'Select user')
					));
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php 
					echo $this->Form->button('<i class="glyphicon glyphicon-stats"></i> '.__d('croogo', 'Statistical'), $options = array(
						'class' => 'btn btn-info btn-sm'
					));
					echo $this->Form->end($options = null);
				?>
			</div>
		</div>
	</div>
</div>
<!-- Popup view event-->
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
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button class="btn btn-info btn-sm"><a id="eventUrl" target="_blank"><?php echo __d('croogo', 'More').' <i class="fa fa-angle-double-right"></i>' ?></a></button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function() {
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
				url: '<?php echo Router::url(array('plugin'=>'managers','controller'=>'events', 'action'=>'index', '1.json'), true); ?>',
				error: function() {
					$('#script-warning').show();
				}
			},
			eventRender: function(event, element) {
		      	$(element).tooltip({title: '<p class="text-left">'+event.body+"<br><i class='fa fa-user'></i> "+event.user+"<br><?php echo __d('croogo', 'From'); ?>: "+event.bd+"<br><?php echo __d('croogo', 'To'); ?>: "+event.stop+'<p>',container: "body", html: true});    
		      	element.find('.fc-title').append("<br/><span style='background: "+event.bgcolor+"; padding: 0 3px'><i class='"+event.icon+"'></i></span> " + event.user + " <i class='"+event.confirm+"' style='float: right; margin-right: 5px;'></i>");  
		      	// Filter status
		      	var status = false;
		      	var statusVal = ['',event.tinhtrang];
		      	$('#status option:selected').each(function(index, el){
	                if (statusVal.indexOf($(this).val()) >= 0) status = true;
	            });
		      	// Filter group
		      	var group = false;
            	var groupVal = ['',event.role];
            	$('#role_id option:selected').each(function(index, el){
	                if (groupVal.indexOf($(this).val()) >= 0) group = true;
	            });
	            // Filter user
	            var user = false;
	            var userVal = ['',event.userid];
	            $('#user_id option:selected').each(function(index, el){
	                if (userVal.indexOf($(this).val()) >= 0) user = true;
	            });
	            // Filter by type
	            var type = false;
	            var typeVal = ['',event.type];
	            $('.select-type option:selected').each(function(index, el){
	                if (typeVal.indexOf($(this).val()) >= 0) type = true;
	            });
	            return (status && group && user && type);       
		  	},
		  	eventClick:  function(event, jsEvent, view) {
	            $('#modalTitle').html(event.title);
	            $('#modalBody').html('<p>'+event.body+'</p><p><i class="fa fa-user"></i> '+event.user+'</p><p><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'Start time') ?>: '+event.bd+'</p><p><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'End time') ?>: '+event.stop+'</p><span class="'+event.class+'">'+event.status+'</span>');
	            $('#eventUrl').attr('href',event.url);
	            $('#fullCalModal').modal();
	            return false;
	        },
	        dayClick: function(date, jsEvent, view) {
		        $('#add-event').modal();
		        $('#EventStart').val(date.format()+' 08:00');
		        $('#EventEnd').val(date.format()+' 17:30');
		    }
		});
		$('#role_id, #user_id, .select-type, #status').on('change',function(){
			$('.loading-tasks').fadeIn('slow');
    		$('#calendar').fullCalendar('rerenderEvents');
    		setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
		});
		$('.fc-next-button, .fc-prev-button, .fc-today-button').click(function () {
			$('.loading-tasks').fadeIn('slow');
			setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
		});
	});
</script>
<div class="loading-tasks"></div>