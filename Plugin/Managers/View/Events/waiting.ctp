<div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $title_for_layout; ?></b></h3>
	</div>
	<div class="panel-body">
		<?php if (!empty($events)) { ?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th><?php echo __d('croogo', 'Title'); ?></th>
					<th><?php echo __d('croogo', 'User'); ?></th>
					<th><?php echo __d('croogo', 'Type'); ?></th>
					<th><?php echo __d('croogo', 'From'); ?></th>
					<th><?php echo __d('croogo', 'To'); ?></th>
					<th><?php echo __d('croogo', 'Status'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($events as $key => $event) { ?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td>
						<a href="#" title="<p class='text-left'><?php echo $event['Event']['body']; ?></p>" data-tooltip="tooltip"><?php echo $event['Event']['title']; ?></a>
					</td>
					<td><?php echo $event['User']['name']; ?></td>
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
					<td><?php echo $event['Event']['start']; ?></td>
					<td><?php echo $event['Event']['end']; ?></td>
					<td>
						<?php 
							echo $this->Form->create('Event', $options = array(
								'url' => array(
									'controller' => 'events',
									'action' => 'confirm',
									$event['Event']['id']
								)
							));
							echo $this->Form->input('id', $options = array(
								'value' => $event['Event']['id']
							));
							$status = array(0 => __d('croogo', 'Waiting'), 1 => __d('croogo', 'Confirm'), 2 => __d('croogo', 'Deny'));
							if($event['Event']['status'] == 0){
								$class = 'btn-warning';
							}elseif ($event['Event']['status'] == 1) {
								$class = 'btn-success';
							}else{
								$class= 'btn-danger';
							}
							echo $this->Form->input('status', $options = array(
								'value' => $event['Event']['status'],
								'label' => false,
								'class' => 'form-control input-sm btn btn-xs '.$class,
								'options' => $status,
								'onchange' => 'this.form.submit()'
							));
							echo $this->Form->end($options = null);
						?>	
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
	</div>
</div>