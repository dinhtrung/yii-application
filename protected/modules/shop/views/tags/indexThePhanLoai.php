<?php
/* @var $this TagsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'The Phan Loais'),
);

$this->menu=array(
	array('label'=>'Create ThePhanLoai','url'=>array('create')),
	array('label'=>'Manage ThePhanLoai','url'=>array('admin')),
);
?>

<h1>The Phan Loais</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewThePhanLoai',
)); ?>