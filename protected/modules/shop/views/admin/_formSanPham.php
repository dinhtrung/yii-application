<?php
/* @var $this AdminController */
/* @var $model SanPham */
/* @var $form TbActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'san-pham-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo TbHtml::well(Yii::t('app', 'Fields with <span class="required">*</span> are required.')); ?>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldControlGroup($model,'tenSanPham',array('size'=>TbHtml::INPUT_SIZE_XXLARGE)); ?>

	<?php echo $form->textAreaControlGroup($model,'moTa',array('rows'=>6,'size'=>TbHtml::INPUT_SIZE_XXLARGE)); ?>

	<?php echo $form->fileFieldControlGroup($model,'anh'); // Anh dai dien cho san pham ?>

	<?php echo $form->numberFieldControlGroup($model,'giaBan',array('size'=>TbHtml::INPUT_SIZE_SMALL, 'append' => '000<sup>VND</sup>')); ?>

	<?php echo $form->dropDownListControlGroup($model,'loaiSanPham',
			array('' => Yii::t('LoaiSanPham', '--- Select Parent Product Category ---')) + LoaiSanPham::getOption(),
			array('size' => TbHtml::INPUT_SIZE_XXLARGE)
	); ?>
	
	<?php $input = $this->widget('CMultiFileUpload', array(
		'model' => $model,
		'attribute' => 'slide',
		'accept' => 'jpg|png|jpeg|gif',
		'options' => array() ,
	), TRUE); ?> 
	
	<?php if (! $model->isNewRecord) {
		$slides = new SlideSanPham('search');
		$slides->spid = $model->primaryKey;
		$input .= $this->widget('bootstrap.widgets.TbGridView', array(
			'id' => 'san-pham-slides-form',
			'type'	=>	array(TbHtml::GRID_TYPE_CONDENSED),
			'dataProvider' => $slides->search(),
			'columns'	=>	array(
				'tenFile',
				array(
					'class' => 'bootstrap.widgets.TbButtonColumn', 
					'template' => '{delete}', 
					'deleteButtonUrl' => 'Yii::app()->controller->createUrl("deleteslide",$data->primaryKey)',
				),
			)
		), TRUE);
	}?>
	
	<?php echo TbHtml::customControlGroup($input, 'slide'); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset')),
	)); ?>
<?php $this->endWidget(); ?>
