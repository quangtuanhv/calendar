<?php foreach ($errors as $key => $e) { ?>
	<tr>
		<td class="text-center"><?php echo $key+1; ?></td>
		<td>
			<strong><?php echo $e['Error']['title']; ?></strong>
			<p><?php echo $e['Error']['body']; ?></p>
		</td>
		<td>
			<?php 
				echo $this->Form->create('Error', $options = array(
					'url' => array(
						'controller' => 'errors',
						'action' => 'change_status',
						$e['Error']['id']
					),
					'inputDefaults' => array(
						'class' => 'form-control input-sm',
						'label' => false,
						'div' => array(
							'class' => 'form-group'
						)
					)
				));
				echo $this->Form->input('id', $options = array(
					'value' => $e['Error']['id']
				));
				$status = array(0 => __d('croogo', 'Fixing'), 1 => __d('croogo', 'Done'));
				if($e['Error']['status'] == 0){
					$class = 'btn-danger';
				}elseif ($e['Error']['status'] == 1) {
					$class = 'btn-success';
				}
				echo $this->Form->input('status', $options = array(
					'options' => $status,
					'error_id' => $e['Error']['id'],
					'class' => 'form-control input-sm '.$class.'',
					'value' => $e['Error']['status'],
					'taskid' => $e['Error']['task_id']
				));
				echo $this->Form->end($options = null);
			?>
		</td>
	</tr>
	<?php } ?>