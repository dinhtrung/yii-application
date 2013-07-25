<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'cart-form',
	'action' => array('/shop/product/checkout'),
	'enableAjaxValidation'=>false,
)); ?>
<?php if ($items): ?>
<table class="table table-condensed">
	<caption>Giỏ hàng của bạn</caption>
	<thead>
	    <tr>
			<th>Sản phẩm</th>
			<th>Đơn giá</th>
			<th>Số lượng</th>
		</tr>
	</thead>
	<tbody>
	   	<?php $sum = 0; 
	   	foreach ($items as $i){
			$sum += $i->giaBan * $i->soLuong; 
		?>
	    <tr>
			<th><?php echo $i->tenSanPham; ?></th>
			<td><?php echo $i->giaBan; ?></td>
			<td><?php echo $form->textField($i, 'soLuong', array('size' => TbHtml::INPUT_SIZE_MINI)); ?></td>
		</tr>
   	<?php }; ?>
	</tbody>
	<tfoot>
		<tr>
			<th>Tổng cộng</th>
			<th colspan="2"><?php echo $sum; ?></th>
		</tr>
	</tfoot>
</table>
<?php endif; ?>



	<?php echo TbHtml::submitButton(Yii::t('app', 'Update'), array('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'name' => 'update'));
		echo TbHtml::submitButton(Yii::t('app', 'Checkout'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'name' => 'checkout'));
		echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)); ?>
	<?php $this->endWidget(); ?>
