<div class="span4">
	<h3><?php echo CHtml::link($data->tenSanPham, array('/shop/products/view', 'id' => $data->primaryKey)); ?></h3>
	
	<time pubdate="pubdate" datetime="<?php echo date('Y-m-d H:i:s', $data->thoiGianTao); ?>">
		<?php echo date('d/m/Y', (($data->thoiGianSua > $data->thoiGianTao)?$data->thoiGianSua:$data->thoiGianTao)); ?>
	</time>
<?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($data->moTa); ?><?php $this->endWidget(); ?>

<?php echo TbHtml::imagePolaroid(Yii::app()->baseUrl . SanPham::$thumbUrl . $data->anh); ?>

	<?php echo TbHtml::link(number_format($data->giaBan, 0) . '.000<sup>VND</sup>', array('/shop/products/view', 'id' => $data->id), array('color' => TbHtml::BUTTON_COLOR_SUCCESS)); ?>
</div>