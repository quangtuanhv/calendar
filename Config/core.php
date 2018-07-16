<?php

if (file_exists(APP . 'Config' . DS . 'croogo.php')) {
	require APP . 'Config' . DS . 'croogo.php';
} else {
	if (!defined('LOG_ERROR')) {
		define('LOG_ERROR', LOG_ERR);
	}

	$cacheDefaultConfig = array(
		'duration' => '+1 hour',
		'engine' => 'File',
		'prefix' => 'croogo_install_',
	);
	Configure::write('Cache.defaultConfig', $cacheDefaultConfig);

	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));

	Configure::write('Session', array(
		'defaults' => 'php',
		'ini' => array(
			'session.cookie_httponly' => 1
		)
	));
}
