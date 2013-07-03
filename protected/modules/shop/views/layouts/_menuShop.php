<?php
$this->mainMenu['shop'] = array(
	'label' => Yii::t('shop', 'Shop'),
	'visible' => Yii::app()->user->checkAccess('shop/default/index'),
	'items'=>array(
		array(
			'label' => Yii::t('shop', 'Manage Products'),
			'url'=>array('/shop/admin/index'),
			'visible' => Yii::app()->user->checkAccess('shop/admin/index'),
			'items' => array(
				array(
						'label' => Yii::t('shop', 'Create Products'),
						'url'=>array('/shop/admin/create'),
						'visible' => Yii::app()->user->checkAccess('shop/admin/create')
				),
			)
		),
		array(
			'label' => Yii::t('shop', 'Manage Category'),
			'url'=>array('/shop/category/index'),
			'visible' => Yii::app()->user->checkAccess('shop/category/index'),
			'items' => array(
				array(
						'label' => Yii::t('shop', 'Create Category'),
						'url'=>array('/shop/category/create'),
						'visible' => Yii::app()->user->checkAccess('shop/category/create')
				),
			)
		),
	),
);