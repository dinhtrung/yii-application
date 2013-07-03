<?php
/* @var $this TagsController */
/* @var $data ThePhanLoai */
?>

<div class="view">
					
	<h3><?php echo CHtml::link($data->title, array('view', 'id' => $data->primaryKey)); ?></h3>
					


	<b><?php echo CHtml::encode($data->getAttributeLabel('the')); ?>:</b>
	<?php echo CHtml::encode($data->the); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('soLuong')); ?>:</b>
	<?php echo CHtml::encode($data->soLuong); ?>
	<br />


</div>