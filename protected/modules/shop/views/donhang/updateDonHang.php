
?>
<?php
/* @var $this DonhangController */
/* @var $model DonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Don Hangs')=>array('index'),
	$model->title=>array('view','id' => $model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update DonHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->renderPartial('_formDonHang', array('model'=>$model)); ?>