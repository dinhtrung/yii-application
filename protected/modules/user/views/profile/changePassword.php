<?php
$this->breadcrumbs=array(
	Yii::t('user', "Profile") => array('/user/profile'),
	Yii::t('user', "Change Password"),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', "Change password"); ?></h1>

<?php echo $this->renderPartial('_menuProfile'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
));  ?>

<?php echo TbHtml::well(Yii::t('user', 'Fields with <span class="required">*</span> are required.')); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->passwordFieldControlGroup($model,'password', array('help' => Yii::t('user', "Minimal password length 4 symbols."))); ?>

	<?php echo $form->passwordFieldControlGroup($model,'verifyPassword', array('help' => Yii::t('user', "Please type your new password again."))); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)),
	)); ?>
<?php $this->endWidget(); ?>