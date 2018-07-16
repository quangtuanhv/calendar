<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th><?php echo __d('croogo', 'Error'); ?></th>
				<th><?php echo __d('croogo', 'User'); ?></th>
				<th><?php echo __d('croogo', 'Task'); ?></th>
				<th><?php echo __d('croogo', 'Project'); ?></th>
				<th><?php echo __d('croogo', 'Status'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php //pr($errors); die(); ?>
			<?php foreach ($errors as $key => $e ) { ?>
			<tr>
				<td><?php echo $key+1; ?></td>
				<td>
					<a data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse<?php echo $key; ?>"><i class="glyphicon glyphicon-chevron-down"></i> <?php echo $e['Error']['title']; ?></a>
					<p class="collapse" id="collapse<?php echo $key; ?>">
					<?php echo $e['Error']['body']; ?>
					</p>
				</td>
				<td><?php echo $errors[$key]['Task']['User']['name']; ?></td>
				<td><?php echo $e['Task']['title']; ?></td>
				<td>
					<?php 
						echo $this->Html->link($errors[$key]['Task']['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $errors[$key]['Task']['Project']['id'], 'slug' => Inflector::slug($errors[$key]['Task']['Project']['title'], $replacement = '-')), array('target' => '_blank'));
					?>
				</td>
				<td class="col-lg-1">
					<?php 
						$status = array(0 => __d('croogo', 'Fixing'), 1 => __d('croogo', 'Done'));
						if($e['Error']['status'] == 0){
							$class = 'btn-danger';
						}elseif ($e['Error']['status'] == 1) {
							$class = 'btn-success';
						}
						echo $this->Form->input('status', $options = array(
							'class' => 'form-control '.$class.' input-sm',
							'value' => $e['Error']['status'],
							'label' => false,
							'options' => $status,
							'disabled' => true
						));
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