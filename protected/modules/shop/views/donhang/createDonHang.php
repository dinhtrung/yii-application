<?php
/* @var $this DonhangController */
/* @var $model DonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Don Hangs') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New DonHang'); ?></h1>

<?php $this->renderPartial('_formDonHang', array('model'=>$model)); ?>