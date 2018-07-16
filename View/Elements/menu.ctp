<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="top-menu">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">MENU</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li>
				<?php 
					echo $this->Html->link('<i class="glyphicon glyphicon-home"></i> '.__d('croogo', 'Home'), array('plugin' => 'managers', 'controller' => 'events', 'action' => 'index'), array('escape' => false));
				?>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i> <?php echo __d('croogo', 'Projects'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> '.__d('croogo', 'All projects'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'index'), array('escape' => false));
							?>
							<?php 
								echo $this->Html->link('<i class="fa fa-list-ol"></i> '.__d('croogo', 'My projects'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'my_projects'), array('escape' => false));
							?>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__d('croogo', 'Add project'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'add'), array('escape' => false));
							?>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> <?php echo __d('croogo', 'Tasks'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-list"></i> '.__d('croogo', 'All tasks'), array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'index'), array('escape' => false));
							?>
							<?php 
								echo $this->Html->link('<i class="fa fa-list-ol"></i> '.__d('croogo', 'My tasks'), array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'my_tasks'), array('escape' => false));
							?>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__d('croogo', 'Add task'), array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'add'), array('escape' => false));
							?>
						</li>
					</ul>
				</li>
				<li>
					<?php 
						echo $this->Html->link('<i class="glyphicon glyphicon-warning-sign"></i> '.__d('croogo', 'Errors'), array('plugin' => 'managers', 'controller' => 'errors', 'action' => 'index'), array('escape' => false));
					?>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?php 
						echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> '.__d('croogo', 'Skills'), array('plugin' => 'managers', 'controller' => 'skills', 'action' => 'index'), array('escape' => false));
					?>
				</li>
				<li>
					<?php 
						echo $this->Html->link('<i class="glyphicon glyphicon-usd"></i> '.__d('croogo', 'Revenue'), array('plugin' => 'managers', 'controller' => 'months', 'action' => 'index'), array('escape' => false));
					?>
				</li>
				<li>
					<?php 
						echo $this->Html->link('<i class="glyphicon glyphicon-stats"></i> '.__d('croogo', 'Statistical'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'statistical'), array('escape' => false));
					?>
				</li>
				<li class="dropdown">
				<?php if($this->Session->read('Auth.User.id') != NULL){ ?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $this->Session->read('Auth.User.name'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-info-sign"></i> '.__d('croogo', 'Profile'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'), array('escape' => false));
							?>
						</li>
						<li>
							<?php 
								echo $this->Html->link('<i class="fa fa-th-list"></i> '.__d('croogo', 'My projects'), array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'my_projects'), array('escape' => false));
							?>
						</li>
						<li>
							<?php 
								echo $this->Html->link('<i class="fa fa-list-ol"></i> '.__d('croogo', 'My tasks'), array('plugin' => 'managers', 'controller' => 'tasks', 'action' => 'my_tasks'), array('escape' => false));
							?>
						</li>
						<li>
							<?php 
								echo $this->Html->link('<i class="fa fa-clock-o"></i> '.__d('croogo', 'My events'), array('plugin' => 'managers', 'controller' => 'events', 'action' => 'my_events'), array('escape' => false));
							?>
						</li>
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-warning-sign"></i> '.__d('croogo', 'My errors'), array('plugin' => 'managers', 'controller' => 'errors', 'action' => 'my_errors'), array('escape' => false));
							?>
						</li>
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-log-out"></i> '.__d('croogo', 'Logout'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout'), array('escape' => false));
							?>
						</li>
					</ul>
				<?php }else{ ?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo __d('croogo', 'Tài khoản'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-log-in"></i> '.__d('croogo', 'Login'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'), array('escape' => false));
							?>
						</li>
						<!-- <li>
							<?php 
								echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i> '.__d('croogo', 'Create an account'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'add'), array('escape' => false));
							?>
						</li> -->
					</ul>
				<?php } ?>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>