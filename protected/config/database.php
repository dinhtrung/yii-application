<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'components'=>array(
		// Main Database Components
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			'tablePrefix' => '',
		),
		// uncomment the following to use a MySQL database
// 		'projectbankDb'=>array(
// 			'class'	=>	'CDbConnection',
// 			'connectionString' => 'mysql:host=localhost;dbname=yii_projectbank',
// 			'emulatePrepare' => true,
// 			'username' => 'root',
// 			'password' => 'myroot',
// 			'charset' => 'utf8',
// 			'tablePrefix' => '',
// 		),
// 		'dienlucDb'=>array(
// 			'class'	=>	'CDbConnection',
// 			'connectionString' => 'mysql:host=localhost;dbname=yii_dienluc',
// 			'emulatePrepare' => true,
// 			'username' => 'root',
// 			'password' => 'myroot',
// 			'charset' => 'utf8',
// 			'tablePrefix' => '',
// 		),
// 		'ussdDb'=>array(
// 			'class'	=>	'CDbConnection',
// 			'connectionString' => 'mysql:host=localhost;dbname=yii_ussd',
// 			'emulatePrepare' => true,
// 			'enableParamLogging' => TRUE,
// 			'username' => 'root',
// 			'password' => 'myroot',
// 			'charset' => 'utf8',
// 			'tablePrefix' => '',
// 		),
// 		'viewsDb'=>array(
// 			'class'	=>	'CDbConnection',
// 			'connectionString' => 'mysql:host=localhost;dbname=yii_views',
// 			'emulatePrepare' => true,
// 			'enableParamLogging' => TRUE,
// 			'username' => 'root',
// 			'password' => 'myroot',
// 			'charset' => 'utf8',
// 			'tablePrefix' => '',
// 		),
// 		'samplesDb'=>array(
// 			'class'	=>	'CDbConnection',
// 			'connectionString' => 'mysql:host=localhost;dbname=classicmodels',
// 			'emulatePrepare' => true,
// 			'enableParamLogging' => TRUE,
// 			'username' => 'root',
// 			'password' => 'myroot',
// 			'charset' => 'utf8',
// 			'tablePrefix' => '',
// 		),
		'shopDb'=>array(
			'class'	=>	'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=yii_shop',
			'emulatePrepare' => true,
			'enableParamLogging' => TRUE,
			'username' => 'root',
			'password' => 'myroot',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
	),
	'modules'	=>	array(
// 		'projectbank',
// 		'dienluc',
// 		'ussd',
// 		'views',
// 		'samples',	// Used for Views
		'shop',
	)
);
