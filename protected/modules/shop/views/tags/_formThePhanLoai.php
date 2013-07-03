<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */
/* @var $form TbActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'the-phan-loai-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo TbHtml::well(Yii::t('app', 'Fields with <span class="required">*</span> are required.')); ?>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldControlGroup($model,'the',array('span'=>5,'maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'soLuong',array('span'=>5)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset')),
	)); ?>
<?php $this->endWidget(); ?>
