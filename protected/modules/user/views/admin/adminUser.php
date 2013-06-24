<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')	=>	array('admin'),
	Yii::t('user', 'Manage'),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', "Manage Users"); ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'modelClass'	=>	get_class($this->_model),
	));
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'user-admin-grid',
	'dataProvider'=>$model->search(),
	'filter' => $model,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
		),
		'updatetime:datetime',
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
		),
		array('name' => 'role', 'filter' => FALSE),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
