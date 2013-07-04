<?php
/* @var $this CategoryController */
/* @var $model LoaiSanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'Loai San Phams')	=>	array('index'),
	$model->tieuDe,
);

$this->renderPartial('_menuLoaiSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Details of LoaiSanPham :tieuDe', array(':tieuDe' => $model->tieuDe)); ?></h1>

<div class="well well-small">
<?php $this->beginWidget('CMarkdown'); ?><?php echo $model->moTa; ?><?php $this->endWidget(); ?>
</div>

<?php /* $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'thoiGianTao:datetime',
		'thoiGianSua:datetime',
	),
)); */ ?>

<?php 
$related = new SanPham('search');
$related->loaiSanPham = $model->primaryKey;
$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$related->search(),
	'itemView'=>'shop.views.products._viewSanPham',
));; ?>

