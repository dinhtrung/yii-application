<?php
/* @var $this AdminController */
/* @var $model SanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New SanPham'); ?></h1>

<?php $this->renderPartial('_formSanPham', array('model'=>$model)); ?>