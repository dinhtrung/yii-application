<?php
/* @var $this AdminController */
/* @var $model SanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams') => array('index'),
	Yii::t('app', 'Manage'),
);

$this->renderPartial('_menuSanPham');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#san-pham-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage San Phams'); ?></h1>

<?php echo TbHtml::well(Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchSanPham',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'san-pham-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'tenSanPham',
		'moTa',
		'anh',
		'giaBan',
		'thoiGianTao',
		/*
		'thoiGianSua',
		'loaiSanPham',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>