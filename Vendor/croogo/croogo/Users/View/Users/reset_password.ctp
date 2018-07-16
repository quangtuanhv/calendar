<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#password" aria-controls="password" role="tab" data-toggle="tab"><?php echo $title_for_layout; ?></a>
		</li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="password">
			<?php 
				echo $this->Form->create('User', array(
					'url' => array('plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', $this->Session->read('Auth.User.username')),
					'inputDefaults' => array(
						'class' => 'form-control',
						'label' => false,
						'div' => array('class' => 'form-group')
					)
				));
				echo $this->Form->input('id', array('value' => $this->Session->read('Auth.User.id')));
				echo $this->Form->input('password', $options = array(
					'placeholder' => __d('croogo', 'Nhập mật khẩu mới'),
					'value' => ''
				));
				echo $this->Form->input('verify_password', $options = array(
					'type' => 'password',
					'placeholder' => __d('croogo', 'Xác nhận mật khẩu mới')
				));
				echo $this->Form->end(array(
					'class' => 'btn btn-info btn-sm',
					'div' => array('class' => 'text-center'),
					'label' => __d('croogo', 'Thay mật khẩu')
				));
			?>
		</div>
	</div>
</div>