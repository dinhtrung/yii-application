<?php
/* @var $this TagsController */
/* @var $model ThePhanLoai */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'the',array('span'=>5,'maxlength'=>255)); ?>


	<?php echo $form->textFieldControlGroup($model,'soLuong',array('span'=>5)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->