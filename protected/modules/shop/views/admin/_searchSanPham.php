<?php
/* @var $this AdminController */
/* @var $model SanPham */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'tenSanPham',array('span'=>5,'maxlength'=>255)); ?>


	<?php echo $form->textAreaControlGroup($model,'moTa',array('rows'=>6,'span'=>8)); ?>


	<?php echo $form->textFieldControlGroup($model,'anh',array('span'=>5,'maxlength'=>255)); ?>


	<?php echo $form->numberFieldControlGroup($model,'giaBan',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'thoiGianTao',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'thoiGianSua',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'loaiSanPham',array('span'=>5)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->