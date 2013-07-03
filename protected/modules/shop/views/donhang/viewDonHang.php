<?php
/* @var $this DonhangController */
/* @var $model DonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Don Hangs')	=>	array('index'),
	$model->title,
);

$this->renderPartial('_menuDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Details of DonHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'maDonHang',
		'uid',
		'ngayTao',
		'ghiChu',
		'trangThai',
	),
)); ?>