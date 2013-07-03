<?php
/* @var $this CategoryController */
/* @var $model LoaiSanPham */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'root',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'lft',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'rgt',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'level',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'thoiGianTao',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'thoiGianSua',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'tieuDe',array('span'=>5,'maxlength'=>255)); ?>


	<?php echo $form->textAreaControlGroup($model,'moTa',array('rows'=>6,'span'=>8)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->