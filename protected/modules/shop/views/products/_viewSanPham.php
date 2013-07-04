<?php if (($index % 3) == 0) echo '<div class="row">'; ?>
<div class="span3">
	<?php echo TbHtml::link(
			TbHtml::image(
					Yii::app()->baseUrl . SanPham::$thumbUrl . '/' . basename($data->anh),
					$data->tenSanPham,
					array('class' => 'media media-object x256x192')
			),
			array('/shop/products/view', 'id' => $data->id),
			array(
				'title' => $data->tenSanPham,
				'data-content' => $data->moTa,
				'data-toggle'	=>	'popover',
				'class'		=>	'img-polaroid',	
				)
			); ?>
	<nav class="well well-small">
		<?php echo TbHtml::link(Yii::t('app', 'Add to Cart'), array('/shop/products/cart', 'id' => $data->id), array('class' => 'btn btn-danger')); ?>
		<?php echo TbHtml::link(Yii::t('app', 'Details'), array('/shop/products/view', 'id' => $data->id), array('class' => 'btn btn-info pull-right')); ?>
	</nav>
</div>
<?php if (($index % 3) == 2) echo '</div><hr>'; ?>