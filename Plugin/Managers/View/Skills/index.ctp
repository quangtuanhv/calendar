<button class="btn btn-success btn-sm"><?php echo __d('croogo', 'Master'); ?></button>
<button class="btn btn-primary btn-sm"><?php echo __d('croogo', 'Senior'); ?></button>
<button class="btn btn-info btn-sm"><?php echo __d('croogo', 'Junior'); ?></button>
<button class="btn btn-warning btn-sm"><?php echo __d('croogo', 'Begin'); ?></button>
<button class="btn btn-danger btn-sm"><?php echo __d('croogo', 'Unknown'); ?></button>
<button class="btn btn-default btn-sm"><?php echo __d('croogo', 'Un choose'); ?></button>
<hr>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __d('croogo', 'Skills'); ?></th>
				<?php 
					foreach ($skills as $key => $skill) {
				?>
				<th class="text-center" rowspan="2"><?php echo $skill['Skill']['title']; ?></th>
				<?php
					}
				?>
			</tr>
			<tr>
				<th><?php echo __d('croogo', 'User'); ?></th>
			</tr>
		</thead>
		<tbody class="load">
			<?php foreach ($users as $key => $user) { ?>
			<tr>
				<th class="user_name"><?php echo $user['User']['name']; ?></th>
				<?php 
					foreach ($skills as $key => $skill) {
				?>
				<td>
					<?php 
						$model = ClassRegistry::init('Myskill');
						$myskills = $model->find('first', array(
							'conditions' => array(
								'Myskill.user_id' => $user['User']['id'],
								'Myskill.skill_id' => $skill['Skill']['id']
							),
							'fields' => array(
								'Myskill.user_id',
								'Myskill.skill_id',
								'Myskill.id',
								'Myskill.level',
							)
						));
						$levels = array(
							1 => __d('croogo', 'Master'),
							2 => __d('croogo', 'Senior'),
							3 => __d('croogo', 'Junior'),
							4 => __d('croogo', 'Begin'),
							5 => __d('croogo', 'Unknown'),
						);
						//pr($myskills);
						if(!empty($myskills)){
							if($myskills['Myskill']['level'] == 1){
								$class = 'btn btn-success btn-xs';
								$title = 'Master';
							}elseif ($myskills['Myskill']['level'] == 2) {
								$class = 'btn btn-primary btn-xs';
								$title = 'Senior';
							}elseif ($myskills['Myskill']['level'] == 3) {
								$class = 'btn btn-info btn-xs';
								$title = 'Junior';
							}elseif ($myskills['Myskill']['level'] == 4) {
								$class = 'btn btn-warning btn-xs';
								$title = 'Begin';
							}elseif ($myskills['Myskill']['level'] == 5) {
								$class = 'btn btn-danger btn-xs';
								$title = 'Unknown';
							}else{
								$class = 'btn btn-default btn-xs';
								$title = 'Select level';
							}
							echo $this->Form->create('Myskill', $options = array(
								'url' => array(
									'controller' => 'myskills',
									'action' => 'edit',
									$myskills['Myskill']['id']
								),
								'class' => 'update_skill'
							));
							echo $this->Form->input('id', $options = array(
								'value' => $myskills['Myskill']['id']
							));
							if($this->Session->read('Auth.User.id') == $myskills['Myskill']['user_id'] || $this->Session->read('Auth.User.role_id') == 1){
								$disabled = null;
							}else{
								$disabled = 'disabled';
							}
							echo $this->Form->input('level', $options = array(
								'value' => $myskills['Myskill']['level'],
								'options' => $levels,
								'label' => false,
								'class' => 'form-control input-sm change_status '.$class,
								'skillid' => $myskills['Myskill']['id'],
								'disabled' => $disabled,
								'title' => $skill['Skill']['title'].' - '.$title,
								'data-tooltip' => 'tooltip'
							));
							echo $this->Form->end($options = null);
						}else{
							echo $this->Form->create('Myskill', $options = array(
								'url' => array(
									'controller' => 'myskills',
									'action' => 'add'
								),
								'class' => 'add_skill'
							));
							if ($this->Session->read('Auth.User.id') == $user['User']['id'] || $this->Session->read('Auth.User.role_id') == 1) {
								$disabled = null;
							}else{
								$disabled = 'disabled';
							}
							echo $this->Form->input('level', $options = array(
								'class' => 'form-control input-sm add-skill',
								'options' => $levels,
								'label' => false,
								'empty' => __d('croogo', 'Level'),
								'disabled' => $disabled,
								'title' => $skill['Skill']['title'],
								'data-tooltip' => 'tooltip'
							));
							echo $this->Form->hidden('user_id', $options = array(
								'value' => $user['User']['id']
							));
							echo $this->Form->hidden('skill_id', $options = array(
								'value' => $skill['Skill']['id']
							));
							echo $this->Form->end($options = null);
						}
					?>
				</td>
				<?php
					}
				?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(this).bind("contextmenu", function(e) {
        e.preventDefault();
        alert('Xem làm chi thím!');
    });
    $('td, th').css({'vertical-align':'middle', 'min-width': '100px'});
    $('.user_name').css({'min-width':'200px'});
</script>