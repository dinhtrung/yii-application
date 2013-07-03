<?php
/* @var $this ThongkeController */
/* @var $data SanPhamDonHang */
?>

<div class="view">
				
	<h3><?php echo CHtml::link($data->title, array('view', $data->primaryKey)); ?></h3>
					


	<b><?php echo CHtml::encode($data->getAttributeLabel('soLuong')); ?>:</b>
	<?php echo CHtml::encode($data->soLuong); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donGiaSp')); ?>:</b>
	<?php echo CHtml::encode($data->donGiaSp); ?>
	<br />


</div>