<?php
/* @var $this AdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams'),
);

$this->menu=array(
	array('label'=>'Create SanPham','url'=>array('create')),
	array('label'=>'Manage SanPham','url'=>array('admin')),
);
?>

<h1>San Phams</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewSanPham',
)); ?>