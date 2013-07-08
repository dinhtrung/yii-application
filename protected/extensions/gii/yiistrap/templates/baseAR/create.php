<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('app', '$label') =>array('index'),
	Yii::t('app', 'Create'),
);\n";
?>
$this->renderPartial('_menu<?php echo $this->modelClass; ?>');
?>

<h1><?php echo "<?php echo \$this->pageTitle = Yii::t('app', '<small>Create New</small> {$this->modelClass}'); ?>"?></h1>

<?php echo "<?php \$this->renderPartial('_form{$this->modelClass}', array('model'=>\$model)); ?>"; ?>