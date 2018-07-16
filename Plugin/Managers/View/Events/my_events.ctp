<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo __d('croogo', 'Title'); ?></th>
			<th><?php echo __d('croogo', 'From'); ?></th>
			<th><?php echo __d('croogo', 'To'); ?></th>
			<th><?php echo __d('croogo', 'Status'); ?></th>
			<th><?php echo __d('croogo', 'Action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($events as $key => $event) { ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><a href="#" data-tooltip="tooltip" title="<?php echo $event['Event']['body']; ?>"><?php echo $event['Event']['title']; ?></a></td>
			<td><?php echo $event['Event']['start']; ?></td>
			<td><?php echo $event['Event']['end']; ?></td>
			<td>
				<?php 
					if ($event['Event']['status'] == 0) {
						echo '<span class="btn btn-warning btn-xs">'.__d('croogo', 'Waiting confirm').'</span>';
					}elseif ($event['Event']['status'] == 1) {
						echo '<span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-check"></i> '.__d('croogo', 'Confirmed').'</span>';
					}else{
						echo '<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-lock"></i> '.__d('croogo', 'Deny').'</span>';
					}
				?>
			</td>
			<td>
				<?php 
					echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', array('controller' => 'events', 'action' => 'view', 'id' => $event['Event']['id'], 'slug' => Inflector::slug($event['Event']['title'], $replacement = '-')), array('escape' => false, 'class' => 'btn btn-info btn-xs', 'title' => 'View', 'data-tooltip' => 'tooltip')).' ';
					if($event['Event']['status'] == 0){
						echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'events', 'action' => 'edit', 'id' => $event['Event']['id'], 'slug' => Inflector::slug($event['Event']['title'], $replacement = '-')), array('escape' => false, 'class' => 'btn btn-warning btn-xs', 'title' => 'Edit', 'data-tooltip' => 'tooltip'));
					}
				?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>