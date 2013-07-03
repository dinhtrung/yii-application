<?php
/* @var $this KhachhangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'Khach Hangs'),
);

$this->menu=array(
	array('label'=>'Create KhachHang','url'=>array('create')),
	array('label'=>'Manage KhachHang','url'=>array('admin')),
);
?>

<h1>Khach Hangs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewKhachHang',
)); ?>