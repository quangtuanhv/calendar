<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $events['Event']['title']; ?></b></h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<tbody>
				<tr>
					<td colspan="2"><?php echo $events['Event']['body']; ?></td>
				</tr>
				<tr>
					<th class="col-lg-2"><?php echo __d('croogo', 'User'); ?></th>
					<td><?php echo $events['User']['name']; ?></td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'Start time'); ?></th>
					<td><?php echo $events['Event']['start']; ?></td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'End time'); ?></th>
					<td><?php echo $events['Event']['end']; ?></td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'Created time'); ?></th>
					<td><?php echo $events['Event']['created']; ?></td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'Updated time'); ?></th>
					<td><?php echo $events['Event']['updated']; ?></td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'Type'); ?></th>
					<td>
						<?php 
							if ($events['Event']['type'] == 1) {
								echo __d('croogo', 'Full day');
							}elseif ($events['Event']['type'] == 2) {
								echo __d('croogo', 'Hafl day');
							}elseif ($events['Event']['type'] == 3) {
								echo __d('croogo', 'Later');
							}else{
								echo __d('croogo', 'Early');
							}
						?>
					</td>
				</tr>
				<tr>
					<th><?php echo __d('croogo', 'Status'); ?></th>
					<td>
						<?php 
							if ($events['Event']['status'] == 0) {
								echo '<span class="btn btn-warning btn-sm">'.__d('croogo', 'Waiting confirm').'</span>';
							}elseif ($events['Event']['status'] == 1) {
								echo '<span class="btn btn-success btn-sm"><i class="glyphicon glyphicon-check"></i> '.__d('croogo', 'Confirmed').'</span>';
							}else{
								echo '<span class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-lock"></i> '.__d('croogo', 'Deny').'</span>';
							}
						?>
					</td>
				</tr>
				<?php 
					if ($events['Event']['status'] != 0) {
				?>
				<tr>
					<th><?php echo __d('croogo', 'Confirmer'); ?></th>
					<td><?php echo $events['Confirmer']['name']; ?></td>
				</tr>
				<?php
					}
				?>
				<?php 
					if ($this->Session->read('Auth.User.id') == 1 || $this->Session->read('Auth.User.id') == 8 || $this->Session->read('Auth.User.id') == 7) {
				?>
				<tr>
					<td colspan="2" class="text-center">
						<?php 
							echo $this->Form->create('Event', $options = array(
								'url' => array(
									'controller' => 'events',
									'action' => 'confirm',
									$events['Event']['id']
								)
							));
							echo $this->Form->input('id', $options = array(
								'value' => $events['Event']['id']
							));
							$status = array(0 => __d('croogo', 'Waiting confirm'), 1 => __d('croogo', 'Confirmed'), 2 => __d('croogo', 'Deny'));
							echo $this->Form->input('status', $options = array(
								'value' => $events['Event']['status'],
								'options' => $status,
								'label' => false,
								'class' => 'form-control',
								'onchange' => 'this.form.submit()'
							));
							echo $this->Form->end($options = null);
						?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>