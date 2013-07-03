<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage DonHang'),
	'url'	=>	array('/shop/donhang/admin'),
	'visible' => Yii::app()->user->checkAccess('shop/donhang/admin'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/donhang/create'),
	'visible' => Yii::app()->user->checkAccess('shop/donhang/create'),
);
$this->menu['index'] = array(
	'label' => Yii::t('app', 'List DonHang'),
	'url'	=>	array('/shop/donhang/index'),
	'visible' => Yii::app()->user->checkAccess('shop/donhang/index'),
);