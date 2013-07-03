<?php
/* @var $this ThongkeController */
/* @var $model SanPhamDonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'San Pham Don Hangs')	=>	array('index'),
	$model->title,
);

$this->renderPartial('_menuSanPhamDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Details of SanPhamDonHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'spid',
		'donHang',
		'soLuong',
		'donGiaSp',
	),
)); ?>