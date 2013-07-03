<?php
/* @var $this DonhangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app', 'Don Hangs'),
);

$this->menu=array(
	array('label'=>'Create DonHang','url'=>array('create')),
	array('label'=>'Manage DonHang','url'=>array('admin')),
);
?>

<h1>Don Hangs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewDonHang',
)); ?>