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
		<td class="col-lg-2">
			<?php echo $task['User']['name']; ?>
		</td>
		<td class="col-lg-2">
			<?php echo $task['Task']['start']; ?>
		</td>
		<td class="col-lg-2">
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
					$value = 0;
					$class = 'btn btn-warning';
				}elseif ($task['Task']['status'] == 1) {
					$class = 'btn btn-success';
					$value = 1;
				}elseif ($task['Task']['status'] == 2) {
					$class = 'btn btn-danger';
					$value = 2;
				}
				if(count($tasks[$key]['Error']) > 0){
					$value = 2;
					$class = 'btn-danger';
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
				<li <?php if($i == $page){ echo 'class="active"';} ?> data-page="<?php echo $i; ?>" data-project="" data-group="" data-user="" data-status=""><a href="javascript: void(0)"><?php echo $i; ?></a></li>
				<?php
					}
				?>
				</ul>
			</div>
		</td>
	</tr>