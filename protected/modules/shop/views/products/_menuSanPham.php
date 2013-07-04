<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage SanPham'),
	'url'	=>	array('/shop/admin/index'),
	'visible' => Yii::app()->user->checkAccess('shop/admin/index'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/admin/create'),
	'visible' => Yii::app()->user->checkAccess('shop/admin/create'),
);
