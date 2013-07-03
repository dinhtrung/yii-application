<?php
/* @var $this CategoryController */
/* @var $model LoaiSanPham */
/* @var $form TbActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'loai-san-pham-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo TbHtml::well(Yii::t('app', 'Fields with <span class="required">*</span> are required.')); ?>
	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldControlGroup($model,'tieuDe',array('size' => TbHtml::INPUT_SIZE_XLARGE)); ?>

	<?php echo $form->textAreaControlGroup($model,'moTa',array('rows'=>6,'size' => TbHtml::INPUT_SIZE_XXLARGE)); ?>

	<?php echo $form->dropDownListControlGroup($model,'root',
		array('' => Yii::t('LoaiSanPham', '--- Select Parent Product Category ---')) + LoaiSanPham::getOption(),
		array('size' => TbHtml::INPUT_SIZE_XXLARGE)
	); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset')),
	)); ?>
<?php $this->endWidget(); ?>
