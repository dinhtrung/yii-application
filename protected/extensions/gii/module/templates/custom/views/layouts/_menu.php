<?php echo "<?php\n"; ?>
$this->mainMenu['<?php echo $this->moduleID; ?>'] = array(
	'label' => Yii::t('<?php echo $this->moduleID; ?>', '<?php echo ucfirst($this->moduleID); ?>'),
	'url'=>array('/<?php echo $this->moduleID; ?>/default/index'),
	'visible' => Yii::app()->user->checkAccess('<?php echo ($this->moduleID); ?>/default/index'),	// Landing page
	'items'=>array(
		array(
			'label' => Yii::t('<?php echo $this->moduleID; ?>', '<?php echo ucfirst($this->moduleID); ?>'),
			'url'=>array('/<?php echo $this->moduleID; ?>/<?php echo ($this->moduleID); ?>/index'),
			'visible' => Yii::app()->user->checkAccess('<?php echo $this->moduleID; ?>/<?php echo ($this->moduleID); ?>/index')
		),
		array(
			'label' => Yii::t('<?php echo $this->moduleID; ?>', 'Create new <?php echo ucfirst($this->moduleID); ?>'),
			'url'=>array('/<?php echo $this->moduleID; ?>/<?php echo ($this->moduleID); ?>/create'),			'visible' => Yii::app()->user->checkAccess('<?php echo $this->moduleID; ?>/<?php echo ($this->moduleID); ?>/create')
		),
	),
);