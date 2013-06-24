<?php
$this->breadcrumbs=array(
	Yii::t('site', 'Error'),
);
?>

<h2><?php echo $this->pageTitle = Yii::t('site', ':name - ERROR', array(':name' => Yii::app()->name)); ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>