<?php
$this->mainMenu['rights'] = array(
	'label' => Yii::t('rights', 'Rights'),
	'items'=>array(
		array(
				'label' => Yii::t('rights', 'Assignment'),
				'url'=>array('/rights/assignment'),
				'visible' => Yii::app()->user->checkAccess('rights/assignment/view')
			),
		array(
				'label' => Yii::t('rights', 'Permissions'),
				'url'=>array('/rights/authitem/permissions'),
				'visible' => Yii::app()->user->checkAccess('rights/assignment/permissions')
			),
		array(
				'label' => Yii::t('rights', 'Roles'),
				'url'=>array('/rights/authitem/roles'),
				'visible' => Yii::app()->user->checkAccess('rights/assignment/roles')
			),
		array(
				'label' => Yii::t('rights', 'Tasks'),
				'url'=>array('/rights/authitem/tasks'),
				'visible' => Yii::app()->user->checkAccess('rights/assignment/tasks')
			),
		array(
				'label' => Yii::t('rights', 'Operations'),
				'url'=>array('/rights/authitem/operations'),
				'visible' => Yii::app()->user->checkAccess('rights/assignment/operations')
			),
	),
);