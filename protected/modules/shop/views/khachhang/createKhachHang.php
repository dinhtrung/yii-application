<?php
/* @var $this KhachhangController */
/* @var $model KhachHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Khach Hangs') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuKhachHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New KhachHang'); ?></h1>

<?php $this->renderPartial('_formKhachHang', array('model'=>$model)); ?>