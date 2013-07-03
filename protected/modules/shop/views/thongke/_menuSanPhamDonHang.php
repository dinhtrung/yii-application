<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage SanPhamDonHang'),
	'url'	=>	array('/shop/thongke/admin'),
	'visible' => Yii::app()->user->checkAccess('shop/thongke/admin'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/thongke/create'),
	'visible' => Yii::app()->user->checkAccess('shop/thongke/create'),
);
$this->menu['index'] = array(
	'label' => Yii::t('app', 'List SanPhamDonHang'),
	'url'	=>	array('/shop/thongke/index'),
	'visible' => Yii::app()->user->checkAccess('shop/thongke/index'),
);