<?php
/* @var $this ThongkeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'San Pham Don Hangs'),
);

$this->menu=array(
	array('label'=>'Create SanPhamDonHang','url'=>array('create')),
	array('label'=>'Manage SanPhamDonHang','url'=>array('admin')),
);
?>

<h1>San Pham Don Hangs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewSanPhamDonHang',
)); ?>