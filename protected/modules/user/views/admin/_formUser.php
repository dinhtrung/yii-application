<?php echo TbHtml::well(Yii::t('user', 'Fields with <span class="required">*</span> are required.')); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'	=>	'user-form',
	'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

	<?php echo TbHtml::errorSummary($model); ?>
	
	<?php echo $form->textFieldControlGroup($model, 'username'); ?>

	<?php echo $form->passwordFieldControlGroup($model, 'password'); ?>

	<?php echo $form->textFieldControlGroup($model, 'email'); ?>

	<?php echo $form->checkBoxListControlGroup($model, 'role', Rights::getAuthItemSelectOptions(CAuthItem::TYPE_ROLE)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', User::itemAlias('UserStatus')); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)),
	)); ?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->