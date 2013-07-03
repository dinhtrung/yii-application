<?php
/* @var $this ThongkeController */
/* @var $model SanPhamDonHang */

$this->breadcrumbs=array(
	Yii::t('app', 'San Pham Don Hangs') =>array('index'),
	Yii::t('app', 'Create'),
);
$this->renderPartial('_menuSanPhamDonHang');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create New SanPhamDonHang'); ?></h1>

<?php $this->renderPartial('_formSanPhamDonHang', array('model'=>$model)); ?>