<div class="hero-unit hidden-phone">
	<h1>Khuyễn mại Nhân dịp Khai trương!</h1>
	<p> This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique. </p>

	<p> <a class="btn btn-primary btn-large" href="#">Learn more »</a> </p>
</div>

<hr>

	<?php
	Yii::import('shop.models.*'); 
	$model = new SanPham('search'); 
	$this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$model->search(),
		'itemView'=>'shop.views.products._viewSanPham',
	)); ?>

