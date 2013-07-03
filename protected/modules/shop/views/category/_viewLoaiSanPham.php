<?php
/* @var $this CategoryController */
/* @var $data LoaiSanPham */
?>

<div class="view">
					
	<h3><?php echo CHtml::link($data->title, array('view', 'id' => $data->primaryKey)); ?></h3>
					


	<b><?php echo CHtml::encode($data->getAttributeLabel('root')); ?>:</b>
	<?php echo CHtml::encode($data->root); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lft')); ?>:</b>
	<?php echo CHtml::encode($data->lft); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rgt')); ?>:</b>
	<?php echo CHtml::encode($data->rgt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thoiGianTao')); ?>:</b>
	<?php echo CHtml::encode($data->thoiGianTao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thoiGianSua')); ?>:</b>
	<?php echo CHtml::encode($data->thoiGianSua); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tieuDe')); ?>:</b>
	<?php echo CHtml::encode($data->tieuDe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moTa')); ?>:</b>
	<?php echo CHtml::encode($data->moTa); ?>
	<br />

	*/ ?>

</div>