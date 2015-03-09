<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TrafficBox Console Application',

	// preloading 'log' component
	'preload'=>array('log'),
    
    'import'=>array(
		'application.models.*',
                'application.components.*'
	),

	// application components
	'components'=>array(

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=trafficbox',
			'emulatePrepare' => true,
			'username' => 'traffic',
			'password' => 'marvin',
			'charset' => 'utf8',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);