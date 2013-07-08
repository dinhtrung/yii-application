<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
$pk = '\'id\' => $model->primaryKey';
if (is_array($this->getTableSchema()->primaryKey)) $pk = '$model->primaryKey';

$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
?>

?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('app', '$label')=>array('index'),
	\$model->$nameColumn=>array('view',{$pk}),
	Yii::t('app', 'Update'),
);\n";
?>

$this->renderPartial('_menu<?php echo $this->modelClass; ?>');
?>

<h1><?php echo "<?php echo \$this->pageTitle = Yii::t('app', '<small>Update {$this->modelClass}</small> :title', array(':title' => \$model->$nameColumn)); ?>"?></h1>

<?php echo "<?php \$this->renderPartial('_form{$this->modelClass}', array('model'=>\$model)); ?>"; ?>