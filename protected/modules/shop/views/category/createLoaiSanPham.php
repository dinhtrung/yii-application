<?php
/* @var $this CategoryController */
/* @var $model LoaiSanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'Loai San Phams') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuLoaiSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New LoaiSanPham'); ?></h1>

<?php $this->renderPartial('_formLoaiSanPham', array('model'=>$model)); ?>