<?php $this->breadcrumbs=array(
	Yii::t('user', "Profile")=>array('profile'),
	Yii::t('user', "Edit"),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'Edit profile'); ?></h1>
<?php echo $this->renderPartial('_menuProfile'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
// 	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));  ?>

	<?php echo TbHtml::well(Yii::t('user', 'Fields with <span class="required">*</span> are required.')); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->emailFieldControlGroup($model,'email'); ?>
	
	<?php //@TODO: Additional profile fields to suit your needs?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)),
	)); ?>
	
<?php $this->endWidget(); // form?>