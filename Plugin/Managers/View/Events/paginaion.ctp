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
				$count = ceil($total/10);
			?>
			<li><a href="javascript:void(0)" data-page="<?php echo $page - 1; ?>" data-group="" data-user="" data-type="" class="prev<?php if($page == 1){echo ' hidden'; } ?>">&laquo;</a></li>
			<?php for ($i = 1; $i <= $count; $i++){ ?>
			<li <?php if($i==$page){ echo 'class="active"';} ?>><a href="javascript:void(0)" data-page="<?php echo $i; ?>"  data-group="" data-user="" data-type="" class="normal"><?php echo $i; ?></a></li>
			<?php } ?>
			<li><a href="javascript:void(0)" data-page="<?php echo $page + 1; ?>" data-group="" data-user="" data-type="" class="next<?php if($page == $count){echo ' hidden'; } ?>">&raquo;</a></li>
		</ul>
	</td>
</tr>