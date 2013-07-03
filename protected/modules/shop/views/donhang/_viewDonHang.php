<?php
/* @var $this DonhangController */
/* @var $data DonHang */
?>

<div class="view">
					
	<h3><?php echo CHtml::link($data->title, array('view', 'id' => $data->primaryKey)); ?></h3>
					


	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ngayTao')); ?>:</b>
	<?php echo CHtml::encode($data->ngayTao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ghiChu')); ?>:</b>
	<?php echo CHtml::encode($data->ghiChu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trangThai')); ?>:</b>
	<?php echo CHtml::encode($data->trangThai); ?>
	<br />


</div>