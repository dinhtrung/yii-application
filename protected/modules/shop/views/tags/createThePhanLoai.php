<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */

$this->breadcrumbs=array(
	Yii::t('app', 'The Phan Loais') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuThePhanLoai');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New ThePhanLoai'); ?></h1>

<?php $this->renderPartial('_formThePhanLoai', array('model'=>$model)); ?>