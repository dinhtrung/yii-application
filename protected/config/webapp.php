<?php
Yii::setPathOfAlias("bootstrap", realpath(__DIR__ . '/../extensions/bootstrap'));
return CMap::mergeArray(require(dirname(__FILE__).'/main.php'),	array(
	'theme'		=>	'bootstrap',
	'preload' 	=>	array('bootstrap'),
	'import'	=>	array('bootstrap.helpers.TbHtml'),
	'components'=>array(
		'bootstrap'	=> array(
			'class' => 'bootstrap.components.TbApi', 
		),
		// Yii::app()->urlManager
		'urlManager'=>array(
			'urlFormat'=>'get',			// @FIXME: `path` for better SEO, but require server configuration
			'showScriptName' => TRUE,	// @FIXME: FALSE for better SEO, but require server configuration
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'assetManager' => array(
			'linkAssets' => TRUE,		// @FIXME: `FALSE` if server does not support Follow Symlinks
		),
		'user'		=>	array(
			'allowAutoLogin'	=>	TRUE,	// @FIXME: For Secure sites, do not use this
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	'modules'	=>	array(
		// Use this to generate the template
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'myroot',
			'generatorPaths' => array(
				'ext.gtc',			//	Gii Template Collection
				'bootstrap.gii',	// 	YiiStrap
				'ext.gii',			// 	Customized templates
			)
		) ,
	),
));
