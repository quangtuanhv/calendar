<?php

CroogoRouter::mapResources('Nodes.Nodes', array(
	'prefix' => '/:api/:prefix/',
));

Router::connect('/:api/:prefix/nodes/lookup', array(
	'plugin' => 'nodes',
	'controller' => 'nodes',
	'action' => 'lookup',
), array(
	'routeClass' => 'ApiRoute',
));

// Basic
CroogoRouter::connect('/', array(
	'plugin' => 'managers', 'controller' => 'events', 'action' => 'index'
));
CroogoRouter::connect('/add-project', array(
	'plugin' => 'managers', 'controller' => 'projects', 'action' => 'add'
));
CroogoRouter::connect('/add-task', array(
	'plugin' => 'managers', 'controller' => 'tasks', 'action' => 'add'
));
CroogoRouter::connect('/promoted/*', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'promoted'
));

CroogoRouter::connect('/search/*', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'search'
));

// Content types
CroogoRouter::contentType('blog');
CroogoRouter::contentType('node');
if (Configure::read('Croogo.installed')) {
	CroogoRouter::routableContentTypes();
}

// Page
CroogoRouter::connect('/about', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'view',
	'type' => 'page', 'slug' => 'about'
));
CroogoRouter::connect('/page/:slug', array(
	'plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'view',
	'type' => 'page'
));
// Xem project
CroogoRouter::connect('/project-detail/:slug-:id.html/*', array(
	'plugin' => 'managers', 'controller' => 'projects', 'action' => 'view'), array('pass' => array('id', 'slug')
));
// Change task status
CroogoRouter::connect('/change-status-task/:id/*', array(
	'plugin' => 'managers', 'controller' => 'tasks', 'action' => 'change_status'), array('pass' => array('id')
));
// All tasks
CroogoRouter::connect('/all-tasks.html/*', array(
	'plugin' => 'managers', 'controller' => 'tasks', 'action' => 'index'
));
// My errors
CroogoRouter::connect('/my-errors.html/*', array(
	'plugin' => 'managers', 'controller' => 'errors', 'action' => 'my_errors'
));
CroogoRouter::connect('/errors-list.html/*', array(
	'plugin' => 'managers', 'controller' => 'errors', 'action' => 'index'
));
// My tasks
CroogoRouter::connect('/my-tasks.html/*', array(
	'plugin' => 'managers', 'controller' => 'tasks', 'action' => 'my_tasks'
));
// Tasks on month
CroogoRouter::connect('/tasks-on-month.html/*', array(
	'plugin' => 'managers', 'controller' => 'tasks', 'action' => 'month'
));
// My projects
CroogoRouter::connect('/my-projects.html/*', array(
	'plugin' => 'managers', 'controller' => 'projects', 'action' => 'my_projects'
));