<?php
/* @var $this ThongkeController */
/* @var $model SanPhamDonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'San Pham Don Hangs') => array('index'),
	Yii::t('app', 'Manage'),
);

$this->renderPartial('_menuSanPhamDonHang');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#san-pham-don-hang-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage San Pham Don Hangs'); ?></h1>

<?php echo TbHtml::well(Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchSanPhamDonHang',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'san-pham-don-hang-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'spid',
		'donHang',
		'soLuong',
		'donGiaSp',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>