<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'Loai San Phams'),
);

$this->menu=array(
	array('label'=>'Create LoaiSanPham','url'=>array('create')),
	array('label'=>'Manage LoaiSanPham','url'=>array('admin')),
);
?>

<h1>Loai San Phams</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewLoaiSanPham',
)); ?>