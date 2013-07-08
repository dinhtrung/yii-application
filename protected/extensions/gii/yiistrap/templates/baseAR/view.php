<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */

$pk = '\'id\' => $model->primaryKey';
if (is_array($this->getTableSchema()->primaryKey)) $pk = '$model->primaryKey';
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('{$this->t}', '$label')	=>	array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->renderPartial('_menu<?php echo $this->modelClass; ?>');
?>

<h1><?php echo "<?php echo \$this->pageTitle = Yii::t('{$this->t}', '<small>Details of {$this->modelClass}</small> :title', array(':title' => \$model->{$nameColumn})); ?>"?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView',array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>