<?php
/* @var $this AdminController */
/* @var $model SanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams')	=>	array('index'),
	$model->tenSanPham,
);

$this->renderPartial('_menuSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', '<small>SanPham</small> :title', array(':title' => $model->tenSanPham)); ?></h1>

<?php echo TbHtml::imagePolaroid(Yii::app()->baseUrl . SanPham::$thumbUrl . '/' . $model->anh); ?>

<?php $this->beginWidget('CMarkdown'); ?>
<?php echo $model->moTa; ?>
<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'anh',
		'giaBan',
		'thoiGianTao',
		'thoiGianSua',
		'loaiSanPham',
	),
)); ?>

<?php
$slides = array(); 
foreach ($model->slide as $img){
	$slides[] = array('image' => Yii::app()->baseUrl . SanPham::$slideUrl . '/' . $img->tenFile, 'label' => $model->tenSanPham);
} 
echo TbHtml::carousel($slides); ?>