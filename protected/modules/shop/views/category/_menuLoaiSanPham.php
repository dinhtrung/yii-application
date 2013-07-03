<?php
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage LoaiSanPham'),
	'url'	=>	array('/shop/category/index'),
	'visible' => Yii::app()->user->checkAccess('shop/category/index'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/shop/category/create'),
	'visible' => Yii::app()->user->checkAccess('shop/category/create'),
);
