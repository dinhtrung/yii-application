<?php
/* @var $this KhachhangController */
/* @var $model KhachHang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldControlGroup($model,'uid',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'soDienThoai',array('span'=>5)); ?>


	<?php echo $form->textFieldControlGroup($model,'diaChi',array('span'=>5,'maxlength'=>255)); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->