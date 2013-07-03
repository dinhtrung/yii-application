<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage ThePhanLoai'),
	'url'	=>	array('/shop/tags/admin'),
	'visible' => Yii::app()->user->checkAccess('shop/tags/admin'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/tags/create'),
	'visible' => Yii::app()->user->checkAccess('shop/tags/create'),
);
$this->menu['index'] = array(
	'label' => Yii::t('app', 'List ThePhanLoai'),
	'url'	=>	array('/shop/tags/index'),
	'visible' => Yii::app()->user->checkAccess('shop/tags/index'),
);