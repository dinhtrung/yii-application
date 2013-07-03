<?php
/* @var $this KhachhangController */
/* @var $model KhachHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Khach Hangs')	=>	array('index'),
	$model->title,
);

$this->renderPartial('_menuKhachHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Details of KhachHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'soDienThoai',
		'diaChi',
	),
)); ?>