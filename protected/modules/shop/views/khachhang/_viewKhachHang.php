<?php
/* @var $this KhachhangController */
/* @var $data KhachHang */
?>

<div class="view">
					
	<h3><?php echo CHtml::link($data->title, array('view', 'id' => $data->primaryKey)); ?></h3>
					


	<b><?php echo CHtml::encode($data->getAttributeLabel('soDienThoai')); ?>:</b>
	<?php echo CHtml::encode($data->soDienThoai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diaChi')); ?>:</b>
	<?php echo CHtml::encode($data->diaChi); ?>
	<br />


</div>