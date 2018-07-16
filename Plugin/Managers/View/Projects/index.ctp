<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#calendar-view" aria-controls="calendar-view" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Calendar'); ?></a>
		</li>
		<li role="presentation">
			<a href="#list-view" aria-controls="list-view" role="tab" data-toggle="tab"><?php echo __d('croogo', 'List'); ?></a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="calendar-view">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="form-group">
					<?php 
						foreach ($roles as $key => $r) {
					?>
						<button class="btn btn-sm" style="background: <?php echo $r['Role']['color']; ?>; color: #fff;"><?php echo $r['Role']['title'] ?></button>
					<?php
						}
					?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php 
								foreach ($roles as $key => $r) {
									$role[$r['Role']['id']] = $r['Role']['title'];
								}
								echo $this->Form->input('role_id', $options = array(
									'class' => 'form-control input-sm group-list',
									'label' => false,
									'empty' => 'Select group',
									'div' => array(
										'class' => 'form-group'
									),
									'options' => $role
								));
							?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php 
								echo $this->Form->input('user_id', $options = array(
									'class' => 'form-control input-sm select-user',
									'label' => false,
									'empty' => 'Select user',
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
		<div role="tabpanel" class="tab-pane" id="list-view">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __d('croogo', 'Project'); ?></th>
							<th><?php echo __d('croogo', 'Project manager'); ?></th>
							<th><?php echo __d('croogo', 'Start'); ?></th>
							<th><?php echo __d('croogo', 'End'); ?></th>
							<th><?php echo __d('croogo', 'Tasks'); ?></th>
						</tr>
					</thead>
					<tbody class="load_pagination_projects">
						<?php 
							foreach ($projects as $key => $project) { 
								if($key < 10){
						?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td>
								<?php 
									echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $project['Project']['id'], 'slug' => Inflector::slug($project['Project']['title'], $replacement = '-')));
								?>
							</td>
							<td>
								<?php echo $project['User']['name']; ?>
							</td>
							<td>
								<?php echo $project['Project']['start']; ?>
							</td>
							<td>
								<?php echo $project['Project']['end']; ?>
							</td>
							<td>
								<?php echo count($projects[$key]['Task']); ?>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
				<div class="text-center">
					<ul class="pagination pagination-sm" id="pagination-projects">
						<?php 
							$count = ceil(count($projects)/10);
						?>
						<li><a href="javascript:void(0)" data-page="1" class="hidden prev">&laquo;</a></li>
						<?php for ($i = 1; $i <= $count; $i++){ ?>
						<li <?php if($i==1){ echo 'class="active"';} ?>><a href="javascript:void(0)" data-page="<?php echo $i; ?>" class="normal"><?php echo $i; ?></a></li>
						<?php } ?>
						<li><a href="javascript:void(0)" data-page="2" class="next">&raquo;</a></li>
					</ul>
				</div>
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
				url: '<?php echo Router::url(array('plugin'=>'managers','controller'=>'projects', 'action'=>'index', '1.json'), true); ?>',
				error: function() {
					$('#script-warning').show();
				}
			},
			eventRender: function(event, element) {
		      	$(element).tooltip({title: '<p class="text-left">'+event.title+"<br><i class='fa fa-user'></i> "+event.user+"<br><?php echo __d('croogo', 'From'); ?>: "+event.bd+"<br><?php echo __d('croogo', 'To'); ?>: "+event.stop+'<p>',container: "body", html: true});   
		      	element.find('.fc-title').append("<br/><i class='fa fa-user'></i> " + event.user);  
		      	// Filter by group
		      	var group = false;
		      	var groupVal = ['',event.group];
            	$('#role_id option:selected').each(function(index, el){
	                if (groupVal.indexOf($(this).val()) >= 0) group = true;
	            });
	            // Filter by user
	            var user = false; 
	            var userVal = ['',event.user_id];  
	            $('#user_id option:selected').each(function(index, el){
	                if (userVal.indexOf($(this).val()) >= 0) user = true;
	            }); 
	            return (group && user);       
		  	},
		  	eventClick:  function(event, jsEvent, view) {
	            $('#modalTitle').html(event.title);
	            $('#modalBody').html(event.body+'<br><i class="fa fa-user"></i> <?php echo __d('croogo', 'Project manager') ?>: '+event.user+'<br><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'Start time') ?>: '+event.bd+'<br><i class="glyphicon glyphicon-time"></i> <?php echo __d('croogo', 'End time') ?>: '+event.stop);
	            $('#eventUrl').attr('href',event.url);
	            $('#fullCalModal').modal();
	            return false;
	        },
	        // Click td add project 06-10-2017
	        dayClick: function(date, jsEvent, view) {
		        //alert('Clicked on: ' + date.format());
		        // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
		        // alert('Current view: ' + view.name);
		        // // change the day's background color just for fun
		        // $(this).css('background-color', 'red');
		        $('#addproject').modal();
		        $('#ProjectStart').val(date.format());
		        $('#ProjectEnd').val(date.format());
		    }
		});
		$('#role_id, #user_id').on('change',function(){
			$('.loading-tasks').fadeIn('slow');
    		$('#calendar').fullCalendar('rerenderEvents');
    		setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
		});
		// Pagination projects
		$('body').on('click', '#pagination-projects a', function () {
			var classs = $(this).attr('class');
			var page = $(this).attr('data-page');
			var max = '<?php echo $count; ?>';
			$('.loading-tasks').fadeIn('slow');
			$('#pagination-projects li').removeClass('active');
			$(this).parent().addClass('active');
			$('.prev, .next').parent('li').removeClass('active');
			if (page > 1) {
				var prev = page - 1;
				$('a.prev').removeClass('hidden');
				$('a.prev').attr('data-page', prev);
			} else {
				$('a.prev').addClass('hidden');
			}

			if (page == max) {
				$('a.next').addClass('hidden');
			} else {
				var next = parseInt(page) + 1;
				$('a.next').removeClass('hidden');
				$('a.next').attr('data-page', next);
			}

			if(classs == 'prev' || classs == 'next'){
				$('#pagination-projects a').removeClass('active');
				$('#pagination-projects').find('[data-page="'+page+'"]').addClass('active');
			} else {
				$('#pagination-projects a').removeClass('active');
			}
			var url = '<?php echo $this->base; ?>/managers/projects/paginaion';
			$.ajax({
	    		method: 'GET',
	    		url: url,
	    		data: { page : page},
	    		dataType: 'html',
	    		success: function (data) {
	    			$('.load_pagination_projects').html(data);
	    		}
	    	});
	    	setTimeout(function(){$('.loading-tasks').fadeOut();},700);
		});
	});
</script>
<!-- VIEW PROJECT POPUP -->
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
<!-- ADD PROJECT POPUP -->
<div class="modal fade" id="addproject">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add project</h4>
			</div>
			<div class="modal-body">
				<?php 
					if($this->Session->read('Auth.User.id') != NULL){
					echo $this->Form->create('Project', $options = array(
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
					echo $this->Form->input('title', $options = array(
						'required' => true,
						'placeholder' => 'Project name'
					));
					echo $this->Form->input('body', $options = array(
						'required' => true,
						'placeholder' => 'Project detail'
					));
				?>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<?php 
							echo $this->Form->input('start', $options = array(
								'required' => true,
								'class' => 'form-control date',
								'type' => 'text',
								'required' => true,
								'label' => 'Start day'
							));
						?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<?php 
							echo $this->Form->input('end', $options = array(
								'required' => true,
								'class' => 'form-control date',
								'type' => 'text',
								'required' => true,
								'label' => 'End day'
							));
						?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<?php 
							echo $this->Form->input('user_id', $options = array(
								'empty' => 'Project manager',
								'required' => true
							));
						?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<?php 
							echo $this->Form->input('demo', $options = array(
								'placeholder' => 'URL test'
							));
						?>
					</div>
				</div>
				<?php 
					} else{
						echo 'Please login to adding project!';
					}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php 
					if($this->Session->read('Auth.User.id') != NULL){
						echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', $options = array(
							'class' => 'btn btn-info btn-sm'
						));
						echo $this->Form->end($options = null);
					}
				?>
			</div>
		</div>
	</div>
</div>
<div class="loading-tasks"></div>