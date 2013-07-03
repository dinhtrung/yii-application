<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */

$this->breadcrumbs=array(
	Yii::t('app', 'The Phan Loais')	=>	array('index'),
	$model->title,
);

$this->renderPartial('_menuThePhanLoai');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Details of ThePhanLoai :title', array(':title' => $model->title)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'the',
		'soLuong',
	),
)); ?>