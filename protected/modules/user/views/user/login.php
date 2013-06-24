<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->breadcrumbs=array(
	Yii::t('app', 'Login'),
);
?>
<div class="span8 offset2">

<h1><?php echo $this->pageTitle = Yii::t('app', ':app Login', array(':app' => Yii::app()->name)); ?></h1>

<?php echo TbHtml::well(Yii::t('app', 'Please fill out the following form with your login credentials')); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'action' => Yii::app()->user->loginUrl,
    'layout'=> TbHtml::FORM_LAYOUT_HORIZONTAL,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<?php echo $form->textFieldControlGroup($model,'username'); ?>

	<?php echo $form->passwordFieldControlGroup($model,'password'); ?>

	<?php echo $form->checkBoxControlGroup($model,'rememberMe'); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Login'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton('Reset'),
	)); ?>
<?php $this->endWidget(); ?>
</div>
