<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>


<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<?php echo TbHtml::heroUnit($this->pageTitle, Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')); ?>

<?php echo TbHtml::well(Yii::t('app','Fields with <span class="required">*</span> are required.'));?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'layout'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'name'); ?>

    <?php echo $form->textFieldControlGroup($model,'email'); ?>

    <?php echo $form->textFieldControlGroup($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textAreaControlGroup($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php 
			echo $form->textFieldControlGroup($model,'verifyCode',array(
            'help'=>$this->widget('CCaptcha', array(), TRUE),
        )); ?>
	<?php endif; ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset')),
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>