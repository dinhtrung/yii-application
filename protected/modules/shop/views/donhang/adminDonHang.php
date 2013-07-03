<?php
/* @var $this DonhangController */
/* @var $model DonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Don Hangs') => array('index'),
	Yii::t('app', 'Manage'),
);

$this->renderPartial('_menuDonHang');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#don-hang-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage Don Hangs'); ?></h1>

<?php echo TbHtml::well(Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchDonHang',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'don-hang-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'maDonHang',
		'uid',
		'ngayTao',
		'ghiChu',
		'trangThai',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>