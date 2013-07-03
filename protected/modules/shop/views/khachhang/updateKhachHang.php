
?>
<?php
/* @var $this KhachhangController */
/* @var $model KhachHang */

$this->breadcrumbs=array(
	Yii::t('app', 'Khach Hangs')=>array('index'),
	$model->title=>array('view','id' => $model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuKhachHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update KhachHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->renderPartial('_formKhachHang', array('model'=>$model)); ?>