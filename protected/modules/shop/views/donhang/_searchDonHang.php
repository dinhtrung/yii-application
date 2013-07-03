<?php
/* @var $this DonhangController */
/* @var $model DonHang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldControlGroup($model,'maDonHang',array('span'=>5,'maxlength'=>64)); ?>


	<?php echo $form->textFieldControlGroup($model,'uid',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'ngayTao',array('span'=>5)); ?>


	<?php echo $form->textAreaControlGroup($model,'ghiChu',array('rows'=>6,'span'=>8)); ?>


	<?php echo $form->textFieldControlGroup($model,'trangThai',array('span'=>5)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->