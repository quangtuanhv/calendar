<?php

CroogoRouter::mapResources('Users.Users', array(
	'prefix' => '/:api/:prefix/',
));

Router::connect('/:api/:prefix/users/lookup', array(
	'plugin' => 'users',
	'controller' => 'users',
	'action' => 'lookup',
), array(
	'routeClass' => 'ApiRoute',
));

// Users
CroogoRouter::connect('/register', array('plugin' => 'users', 'controller' => 'users', 'action' => 'add'));

CroogoRouter::connect('/user/:username', array(
	'plugin' => 'users', 'controller' => 'users', 'action' => 'view'), array('pass' => array('username')
));
CroogoRouter::connect('/change-password/:username', array(
	'plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password'), array('pass' => array('username')
));
CroogoRouter::connect('/statistical.html/*', array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'statistical'));
// Quản lý thu chi
CroogoRouter::connect('/revenue.html/*', array('plugin' => 'managers', 'controller' => 'months', 'action' => 'index'));
// SKills
CroogoRouter::connect('/change-skill/*', array('plugin' => 'managers', 'controller' => 'myskills', 'action' => 'edit'));
CroogoRouter::connect('/add-skill/*', array('plugin' => 'managers', 'controller' => 'myskills', 'action' => 'add'));
CroogoRouter::connect('/members-skills.html/*', array('plugin' => 'managers', 'controller' => 'skills', 'action' => 'index'));
CroogoRouter::connect('/event-detail/:slug-:id.html', array(
	'plugin' => 'managers', 'controller' => 'events', 'action' => 'view'), array('pass' => array('id', 'slug')
));
CroogoRouter::connect('/edit-event/:slug-:id.html', array(
	'plugin' => 'managers', 'controller' => 'events', 'action' => 'edit'), array('pass' => array('id', 'slug')
));
CroogoRouter::connect('/statistical-events.html/*', array('plugin' => 'managers', 'controller' => 'events', 'action' => 'month'));
CroogoRouter::connect('/waiting-events-list.html/*', array('plugin' => 'managers', 'controller' => 'events', 'action' => 'waiting'));
CroogoRouter::connect('/my-events-list.html/*', array('plugin' => 'managers', 'controller' => 'events', 'action' => 'my_events'));
CroogoRouter::connect('/projects.html/*', array('plugin' => 'managers', 'controller' => 'projects', 'action' => 'index'));