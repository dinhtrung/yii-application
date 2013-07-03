
?>
<?php
/* @var $this CategoryController */
/* @var $model LoaiSanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'Loai San Phams')=>array('index'),
	$model->tieuDe=>array('view','id' => $model->primaryKey),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menuLoaiSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update LoaiSanPham :title', array(':title' => $model->tieuDe)); ?></h1>

<?php $this->renderPartial('_formLoaiSanPham', array('model'=>$model)); ?>