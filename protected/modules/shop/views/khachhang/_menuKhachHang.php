<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage KhachHang'),
	'url'	=>	array('/shop/khachhang/admin'),
	'visible' => Yii::app()->user->checkAccess('shop/khachhang/admin'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/khachhang/create'),
	'visible' => Yii::app()->user->checkAccess('shop/khachhang/create'),
);
$this->menu['index'] = array(
	'label' => Yii::t('app', 'List KhachHang'),
	'url'	=>	array('/shop/khachhang/index'),
	'visible' => Yii::app()->user->checkAccess('shop/khachhang/index'),
);