<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th><?php echo __d('croogo', 'Task'); ?></th>
				<th><?php echo __d('croogo', 'Project'); ?></th>
				<th><?php echo __d('croogo', 'Start'); ?></th>
				<th><?php echo __d('croogo', 'End'); ?></th>
				<th><?php echo __d('croogo', 'Status'); ?></th>
				<th><?php echo __d('croogo', 'Errors'); ?></th>
				<th class="col-lg-1">Action</th>
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
					<?php echo $task['Project']['title']; ?>
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
						if($task['Task']['status'] == 0){
							$class = 'btn btn-warning';
						}elseif ($task['Task']['status'] == 1) {
							$class = 'btn btn-success';
						}else{
                                $class = 'btn btn-danger';
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
							'taskid' => $task['Task']['id']
						));
						echo $this->Form->end($options = null);
					?>
				</td>
				<td>
					<?php 
						if (count($tasks[$key]['Error']) > 0) {
							echo $this->Html->link(count($tasks[$key]['Error']), array('controller' => 'errors', 'action' => 'my_errors'), array('class' => 'btn btn-danger btn-sm'));
						}else{
							echo '<span class="btn btn-default btn-sm">'.count($tasks[$key]['Error']).'</span>';
						}
					?>
				</td>
				<td>
					<a href="#edit-task" class="btn btn-info btn-sm edit_task" data-tooltip="tooltip" title="Edit task" data-toggle="modal" data-id="<?php echo $task['Task']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
					<a href="#add-error" class="btn btn-danger btn-sm add_error" data-tooltip="tooltip" title="Add error" data-toggle="modal" data-task="<?php echo $task['Task']['id']; ?>"><i class="fa fa-exclamation-triangle"></i></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<!-- Pagination -->
<div class="text-center">
	<ul class="pagination"><?php echo $this->Paginator->numbers(); ?></ul>
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