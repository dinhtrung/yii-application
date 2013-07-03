
?>
<?php
/* @var $this AdminController */
/* @var $model SanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams')=>array('index'),
	$model->tenSanPham	=>	array('view','id' => $model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update SanPham :title', array(':title' => $model->tenSanPham)); ?></h1>

<?php $this->renderPartial('_formSanPham', array('model'=>$model)); ?>