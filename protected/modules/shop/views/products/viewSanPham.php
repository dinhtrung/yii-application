<?php
/* @var $this AdminController */
/* @var $model SanPham */

$this->breadcrumbs=array(
	Yii::t('app', 'San Phams')	=>	array('index'),
	$model->tenSanPham,
);

$this->renderPartial('_menuSanPham');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', '<small>SanPham</small> :title', array(':title' => $model->tenSanPham)); ?></h1>

<div class="row">
	<div class="span3">
		<?php echo TbHtml::thumbnail(TbHtml::imagePolaroid(Yii::app()->baseUrl . SanPham::$thumbUrl . '/' . $model->anh)); ?>
	</div>
	<div class="span6">
		<?php $this->beginWidget('CMarkdown'); ?><?php echo $model->moTa; ?><?php $this->endWidget(); ?>
	</div>
</div>

<div class="row">
	<?php
	$slides = array();
	foreach ($model->slide as $img){
		$slides[] = array(
			'image' => Yii::app()->baseUrl . SanPham::$slideUrl . '/' . $img->tenFile, 
//			'label' => $model->tenSanPham,
			'url'   => '#',
			'span'	=>	6,
		);
	}
	echo TbHtml::thumbnails($slides);?>
</div>