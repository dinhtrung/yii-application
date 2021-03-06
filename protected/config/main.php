<?php
/**
* Load all minimum required components
**/
return CMap::mergeArray(require(dirname(__FILE__).'/database.php'), array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'language' => 'vi',
	'sourceLanguage' => 'en',

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
					'levels'=>'trace',
				),
			),
		),
		'messages'	=>	array(
			'class'	=>	'CPhpMessageSource',
			'onMissingTranslation' => array('CPhpMessageTranslator', 'appendMessage'),
		),
		'setting' => array(
			'class' => 'application.components.Settings',
		) ,
		// Caching method - for Debug is CDummyCache but for production is CFileCache
		'cache' => array(
				'class' => (YII_DEBUG)?'system.caching.CDummyCache':'system.caching.CFileCache',
		) ,
		'format'	=>	array(
				'class'	=>	'ext.components.EFormatter',
		),
		'mail' => array(
			  'class' => 'ext.mailer.EMailer',
			  'pathViews' => 'application.views.email',
			  'pathLayouts' => 'application.views.email.layouts'
		   ),
		
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),

));
