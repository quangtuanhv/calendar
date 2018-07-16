<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<?php 
			foreach ($projects as $key => $p) {
				$title = mb_substr($p['Project']['title'],0,10,'UTF-8');
		?>
		<li role="presentation" class="<?php if($key == 0){ echo 'active'; } ?>">
			<a href="#project-<?php echo $key+1; ?>" aria-controls="project-<?php echo $key+1; ?>" role="tab" data-toggle="tab" data-tooltip="tooltip" title="<?php echo $p['Project']['title']; ?>"><?php echo $title; ?></a>
		</li>
		<?php
			}
		?>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<?php 
			foreach ($projects as $key => $p) {
		?>
		<div role="tabpanel" class="tab-pane <?php if($key == 0){ echo 'active'; } ?>" id="project-<?php echo $key+1; ?>">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Task</th>
						<th>User</th>
						<th>Start</th>
						<th>End</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($p['Task'] as $key => $t) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td>
							<?php 
								echo $t['title'];
							?>
						</td>
						<td>
							<?php 
								echo $this->Form->create('Task', $options = array(
									'class' => 'edit_form',
									'url' => array(
										'controller' => 'tasks',
										'action' => 'change_status',
										$t['id']
									)
								));
								echo $this->Form->input('id', $options = array(
									'value' => $t['id']
								));
								echo $this->Form->input('user_id', $options = array(
									'value' => $t['user_id'],
									'style' => array(
										'background:'.$t['User']['color'].';',
										'color:#fff'
									),
									'class' => 'form-control confirm input-sm',
									'label' => false
								));
								echo $this->Form->end($options = null);
							?>
						</td>
						<td><?php echo $t['start']; ?></td>
						<td><?php echo $t['end']; ?></td>
						<td>
							<?php 
								echo $this->Form->create('Task', $options = array(
									'class' => 'edit_form',
									'url' => array(
										'controller' => 'tasks',
										'action' => 'change_status',
										$t['id']
									)
								));
								echo $this->Form->input('id', $options = array(
									'value' => $t['id']
								));
								$status = array(0 => __d('croogo', 'Doing'), 1 => __d('croogo', 'Done'), 2 => __d('croogo', 'Error'));
								if($t['status'] == 0){
									$class = 'btn-warning btn-xs';
								}elseif ($t['status'] == 1) {
									$class = 'btn-success btn-xs';
								}else{
									$class = 'btn-danger btn-xs';
								}
								if(count($t['Error']) > 0){
									$value = 2;
									$class = 'btn-danger';
								}else{
									$value = $t['status'];
								}
								echo $this->Form->input('status', $options = array(
									'value' => $value,
									'options' => $status,
									'class' => 'form-control '.$class.' confirm input-sm',
									'label' => false
								));
								echo $this->Form->end($options = null);
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php
			}
		?>
	</div>
</div>