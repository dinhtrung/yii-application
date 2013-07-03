
?>
<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */

$this->breadcrumbs=array(
	Yii::t('app', 'The Phan Loais')=>array('index'),
	$model->title=>array('view','id' => $model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuThePhanLoai');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update ThePhanLoai :title', array(':title' => $model->title)); ?></h1>

<?php $this->renderPartial('_formThePhanLoai', array('model'=>$model)); ?>