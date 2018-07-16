<button class="btn btn-info btn-sm w100" type="button" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="users"><i class="glyphicon glyphicon-user"></i> <?php echo __d('croogo', 'My account'); ?></button>
<div class="collapse" id="users">
	<?php 
		echo $this->Html->link('<i class="glyphicon glyphicon-info-sign"></i> '.__d('croogo', 'Profile'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-default btn-sm w100', 'escape' => false));
	?>
	<?php 
		echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i> '.__d('croogo', 'Change password'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', 'username' => $this->Session->read('Auth.User.username')), array('class' => 'btn btn-default btn-sm w100', 'escape' => false));
	?>
	<?php 
		echo $this->Html->link('<i class="glyphicon glyphicon-log-out"></i> '.__d('croogo', 'Logout'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-default btn-sm w100', 'escape' => false));
	?>
</div>
<?php 
	echo $this->Html->link('<i class="fa fa-th-list"></i> '.__d('croogo', 'My projects'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'my_projects'), array('class' => 'btn btn-info btn-sm w100', 'escape' => false));
?>
<?php 
	echo $this->Html->link('<i class="glyphicon glyphicon-list"></i> '.__d('croogo', 'My tasks'), array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'my_tasks'), array('class' => 'btn btn-info btn-sm w100', 'escape' => false));
?>
<?php 
	echo $this->Html->link('<i class="glyphicon glyphicon-warning-sign"></i> '.__d('croogo', 'My errors'), array('plugin' => 'managers', 'controller' => 'errors', 'action' => 'my_errors'), array('class' => 'btn btn-info btn-sm w100', 'escape' => false));
?>
<?php 
	echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i> '.__d('croogo', 'My calendar'), array('plugin' => 'managers', 'controller' => 'events', 'action' => 'my_events'), array('class' => 'btn btn-info btn-sm w100', 'escape' => false));
?>