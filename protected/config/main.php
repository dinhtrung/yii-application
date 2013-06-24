<?php
/**
* Load all minimum required components
**/
return CMap::mergeArray(require(dirname(__FILE__).'/database.php'), array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.components.*',
	),

	// application components
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'messages'	=>	array(
			'class'	=>	'CPhpMessageSource',
			'onMissingTranslation' => array('CPhpMessageTranslator', 'writeMessage'),
		),
		'setting' => array(
			'class' => 'application.components.Settings',
		) ,
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),

));
