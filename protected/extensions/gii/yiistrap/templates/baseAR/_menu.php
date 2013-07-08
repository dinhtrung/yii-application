<?php echo "<?php\n"; ?>
$this->menu['admin'] = array(
	'label' => Yii::t('app', 'Manage <?php echo $this->modelClass; ?>'),
	'url'	=>	array('/<?php echo $this->controller; ?>/admin'),
	'visible' => Yii::app()->user->checkAccess('<?php echo $this->controller; ?>/admin'),
);
$this->menu['create'] = array(
	'label' => Yii::t('app', 'Create'),
	'url'	=>	array('/<?php echo $this->controller; ?>/create'),
	'visible' => Yii::app()->user->checkAccess('<?php echo $this->controller; ?>/create'),
);
$this->menu['index'] = array(
	'label' => Yii::t('app', 'List <?php echo $this->modelClass; ?>'),
	'url'	=>	array('/<?php echo $this->controller; ?>/index'),
	'visible' => Yii::app()->user->checkAccess('<?php echo $this->controller; ?>/index'),
);