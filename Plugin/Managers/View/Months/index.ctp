<a class="btn btn-info btn-sm" data-toggle="modal" href='#add-month'><i class="glyphicon glyphicon-plus-sign"></i> <?php echo __d('croogo', 'Add month'); ?></a>
<a class="btn btn-info btn-sm" data-toggle="modal" href='#add-order'><i class="glyphicon glyphicon-plus-sign"></i> <?php echo __d('croogo', 'Add order'); ?></a>
<hr>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<?php 
			foreach ($months as $key => $m) {
				if($key == 0){
					$class = 'active';
				}else{
					$class = null;
				}
				$thangs[$m['Month']['id']] = $m['Month']['title'];
		?>
		<li role="presentation" class="<?php echo $class; ?>">
			<a href="#<?php echo $m['Month']['id']; ?>" aria-controls="<?php echo $m['Month']['id']; ?>" role="tab" data-toggle="tab"><?php echo $m['Month']['title']; ?></a>
		</li>
		<?php
			}
		?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php 
			foreach ($months as $key => $m) {
				if($key == 0){
					$class = 'active';
				}else{
					$class = null;
				}
		?>
		<div role="tabpanel" class="tab-pane <?php echo $class; ?>" id="<?php echo $m['Month']['id']; ?>">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'User'); ?></th>
						<th><?php echo __d('croogo', 'Email'); ?></th>
						<th><?php echo __d('croogo', 'Phone'); ?></th>
						<th><?php echo __d('croogo', 'Birthday'); ?></th>
						<th><?php echo __d('croogo', 'Status'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 0;
						foreach ($users as $key => $user) { 
					?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $user['User']['name']; ?></td>
						<td><?php echo $user['User']['email']; ?></td>
						<td><?php echo $user['User']['phone']; ?></td>
						<td><?php echo $user['User']['birthday']; ?></td>
						<td class="col-lg-1">
							<?php 
								$model = ClassRegistry::init('Fund');
								$funds = $model->find('first', array(
									'conditions' => array(
										'Fund.month_id' => $m['Month']['id'],
										'Fund.user_id' => $user['User']['id']
									),
									'fields' => array(
										'Fund.id',
										'Fund.month_id',
										'Fund.user_id',
										'Fund.status'
									)
								));
								if($this->Session->read('Auth.User.role_id') != 1){
							 		$disabled = 'disabled';
							 	}else{
							 		$disabled = null;
							 	}
								//pr($funds);
								if(empty($funds)){
									echo $this->Form->create('Fund', $options = array(
								 		'url' => array(
								 			'controller' => 'funds',
								 			'action' => 'add',
								 		),
								 		'class' => 'funds_form'
								 	));
								 	echo $this->Form->hidden('user_id', $options = array(
								 		'value' => $user['User']['id']
								 	));
								 	echo $this->Form->hidden('month_id', $options = array(
								 		'value' => $m['Month']['id']
								 	));
								 	$status = array(0 => __d('croogo', 'Not yet'), 1 => __d('croogo', '50K'));
								 	echo $this->Form->input('status', $options = array(
										'class' => 'form-control input-sm add_money',
										'options' => $status,
										'label' => false,
										'disabled' => $disabled 
									));
									echo $this->Form->end($options = null);
								}else{
									$i += $funds['Fund']['status'];
									echo $this->Form->create('Fund', $options = array(
										'url' => array(
											'controller' => 'funds',
											'action' => 'edit',
											$funds['Fund']['id']
										),
										'class' => 'edit_fund'
									));
									echo $this->Form->input('id', $options = array(
										'value' => $funds['Fund']['id']
									));
									echo $this->Form->hidden('user_id', $options = array(
										'value' => $funds['Fund']['user_id']
									));
									echo $this->Form->hidden('month_id', $options = array(
										'value' => $funds['Fund']['month_id']
									));
									$status = array(0 => __d('croogo', 'Not yet'), 1 => __d('croogo', '50K'));
									if($funds['Fund']['status'] == 1){
										$bg = '#4cae4c';
										$color = '#fff';
										//$disabled = '';
									}else{
										$bg = '#fff';
										$color = '#555';
									}
									echo $this->Form->input('status', $options = array(
										'class' => 'form-control input-sm',
										'options' => $status,
										'label' => false,
										'value' => $funds['Fund']['status'],
										'style' => array(
											'background: '.$bg.'; color: '.$color.''
										),
										'disabled' => $disabled,
										'fundid' => $funds['Fund']['id']
									));
									echo $this->Form->end($options = null);
								}
							?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th colspan="5"><?php echo __d('croogo', 'Total'); ?></th>
						<td>
							<?php 
								$money = $i*50;
								echo $money.' K';
							?>
						</td>
					</tr>
					<tr>
						<th colspan="5"><?php echo __d('croogo', 'Order'); ?></th>
						<td>
							<?php 
								$order = ClassRegistry::init('Order');
								$orders = $order->find('all', array(
									'conditions' => array(
										'Order.month_id' => $m['Month']['id']
									)
								));
								$output = 0;
								foreach ($orders as $key => $o) {
									$output += $o['Order']['total'];
								}
								echo "<a class='btn btn-info btn-sm w100 view-order' data-toggle='modal' href='#view-order' month_id=".$m['Month']['id'].">".$output." K <i class='glyphicon glyphicon-eye-open'></i></a>";
							?>
						</td>
					</tr>
					<tr>
						<th colspan="5"><?php echo __d('croogo', 'Remain'); ?></th>
						<td>
							<?php 
								$remain = $money - $output;
								if($remain >= 0){
									echo '<span class="btn btn-success btn-sm w100">'.$remain.' K</span>';
								}
								else{
									echo '<span class="btn btn-danger btn-sm w100">'.$remain.' K</span>';
								}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
			}
		?>
	</div>
</div>
<!-- Popup add month -->
<div class="modal fade" id="add-month">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Add month'); ?></h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->Form->create('Month', $options = array(
						'url' => array(
							'controller' => 'months',
							'action' => 'add'
						)
					));
					echo $this->Form->input('title', $options = array(
						'label' => false,
						'placeholder' => __d('croogo', 'Month'),
						'type' => 'text',
						'class' => 'form-control month',
						'required' => true
					));
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php 
					echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Save'), $options = array(
						'class' => 'btn btn-info btn-sm'
					));
					echo $this->Form->end($options = null);
				?>
			</div>
		</div>
	</div>
</div>
<!-- Popup add order-->
<div class="modal fade" id="add-order">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Add order'); ?></h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->Form->create('Order', $options = array(
						'url' => array(
							'controller' => 'orders',
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
						'placeholder' => __d('croogo', 'Reason'),
						'required' => true
					));
					echo $this->Form->input('month_id', $options = array(
						'empty' => __d('croogo', 'Select month'),
						'required' => true,
						'options' => $thangs
					));
					echo $this->Form->input('date', $options = array(
						'placeholder' => __d('croogo', 'Order date'),
						'required' => true,
						'type' => 'text',
						'class' => 'form-control date'
					));
					echo $this->Form->input('total', $options = array(
						'placeholder' => __d('croogo', 'Money'),
						'required' => true
					));
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				<?php 
					echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Save'), $options = array(
						'class' => 'btn btn-info btn-sm'
					));
					echo $this->Form->end($options = null);
				?>
			</div>
		</div>
	</div>
</div>
<!-- Popup view order-->
<div class="modal fade" id="view-order">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo __d('croogo', 'Order detail'); ?></h4>
			</div>
			<div class="modal-body load_view_order">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>