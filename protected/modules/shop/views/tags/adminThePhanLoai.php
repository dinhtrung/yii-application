<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */

$this->breadcrumbs=array(
	Yii::t('app', 'The Phan Loais') => array('index'),
	Yii::t('app', 'Manage'),
);

$this->renderPartial('_menuThePhanLoai');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#the-phan-loai-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage The Phan Loais'); ?></h1>

<?php echo TbHtml::well(Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.')); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchThePhanLoai',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'the-phan-loai-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'the',
		'soLuong',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>