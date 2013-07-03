
?>
<?php
/* @var $this ThongkeController */
/* @var $model SanPhamDonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'San Pham Don Hangs')=>array('index'),
	$model->title=>array('view',$model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuSanPhamDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update SanPhamDonHang :title', array(':title' => $model->title)); ?></h1>

<?php $this->renderPartial('_formSanPhamDonHang', array('model'=>$model)); ?>