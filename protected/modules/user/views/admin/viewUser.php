<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('admin'),
	$model->username,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'View User').' "'.$model->username.'"'; ?></h1>

<?php echo $this->renderPartial('_menu');


	$attributes = array(
		'username',
		'email',
		array(
			'name' 	=> 'activkey', 
			'value' => TbHtml::link(
					Yii::t('user', 'Activate this User'), 
					array('/user/activation', 
							'email' => $model->email, 
							'activkey' => $model->activkey
					), 
					array('class' => 'btn btn-warning')
				),
			'type'	=>	'raw',
		),
		'createtime:datetime',
		'updatetime:datetime',
		'role',
		'status:boolean',
	);

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));


?>
